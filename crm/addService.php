<?
require("./global.php");
if($logged==0)
    header("Location:./index.php");
$new=0;
$productId=clear($_GET['productId']);
$type=clear($_GET['type']);

if(isset($_GET['new']))
	$new=1;

if(isset($_POST['addProduct'])){
    $title=clear($_POST['title']);
    $description=clear($_POST['description']);
    $category=clear($_POST['category']);
    $price=clear($_POST['price']);
    $productId=clear($_POST['productId']);
    $id=generateRandomString();
    $timeAdded=time();
    if($productId==""){
    	$query="insert into sksdm_services set id='$id',title='$title',description='$description',category='$category'";
    	$productId=$id;
    }
    else
		$query="update sksdm_services set title='$title',description='$description',category='$category' where id='$productId'";
    	
	runQuery($query);
	
	$total = count($_FILES['upload']['name']);
	for( $i=0 ; $i < $total ; $i++ ) {
	  $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
	  if ($tmpFilePath != ""){
	    $newFilePath = "./uploads/" . $_FILES['upload']['name'][$i];
		if(move_uploaded_file($tmpFilePath, $newFilePath)) {
			$id=generateRandomString();
			$filename=$_FILES['upload']['name'][$i];
			$query="insert into sksdm_images set id='$id',productId='$productId',image='$filename'";
			runQuery($query);
		}
	  }
	}
	header("Location: ?productId=$productId");
}

if(isset($_GET['removeImage'])){
	$id=clear($_GET['removeImage']);
	$query="delete from sksdm_images where id='$id'";
	runQuery($query);
}

$productDeets=getRow($con,"select * from sksdm_services where id='$productId'");


?>

<html lang="en">
	<head>
		<?require("./includes/views/head.php");?>
	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	    <div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<?require("./includes/views/leftmenu.php");?>
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<?require("./includes/views/topmenu.php");?>
					
					<form method="post" action="" enctype="multipart/form-data">
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<div id="kt_content_container" class="container-xxl" style="max-width: 100%;margin-bottom: 50px;">
								<div class="card card-flush">
									<div class="card-header align-items-center py-5 gap-2 gap-md-5">
										<div class="card-title">
											<div class="d-flex align-items-center position-relative my-1">
												<h2><?if($new){echo "Add ";}else{echo "Edit ";}?> Product/Service</h2>
											</div>
										</div>
										<div class="card-toolbar">
										</div>
									</div>
									<div class="card-body pt-0">
										<div class="row">
											<div class="col-12 mb-10">
												<label>Title</label>
												<input type="text" name="title" class="form-control" value="<?echo $productDeets['title']?>" required>
											</div>
											<div class="col-12 mb-10">
												<label>Category</label>
												<select class="form-control" name="category">
													<option <?if($productDeets['category']=="Plastic"){echo "selected";}?> value="Plastic">Plastic</option>
													<option <?if($productDeets['category']=="Metallic"){echo "selected";}?> value="Metallic">Metallic</option>
													<option <?if($productDeets['category']=="Fiber"){echo "selected";}?> value="Fiber">Fiber</option>
												</select>
											</div>
											<div class="col-12 mb-10">
												<label>Description</label>
												<textarea name="description" class="form-control" rows="8"><?echo $productDeets['description']?></textarea>
											</div>
											<div class="col-12 mb-10">
												<label>Images</label>
												<input name="upload[]" type="file" class="form-control" multiple="multiple"  />
												</div>
											<input type="text" name="productId" value="<?echo $productDeets['id']?>" hidden>
											<?if(!$new){?>
											<div class="col-12 mb-10">
												<label >Images</label>
												<div class="col-12 mt-10">
													<?
								                    $productImages=getAll($con,"select * from sksdm_images where productId='$productId'");
						                            foreach($productImages as $row){?>
						                            <p class="btn btn-light-success btn-sm" style="margin-right:3px;">
						                                <a target="_blank" href="./uploads/<?echo $row['image']?>"><?echo $row['image']?></a>
						                                
						                                <a onclick="return confirm('Are you sure you want to delete this image?');"
						                                 href="?productId=<?echo $productId?>&removeImage=<?echo $row['id']?>" style="margin-left: 10px;color: red;">X</a>
			                					    </p>
			                					    <?}?>
		                					    </div>
											</div>
											<?}?>

											<div class="col-12 mb-10" style="text-align: center !important;">
												<input type="submit" name="addProduct" class="btn btn-primary" value="Save Changes">
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					</form>
					<?require("./includes/views/footer.php");?>
				</div>
			</div>
			<?require("./includes/views/footerjs.php");?>
		</div>
	</body>
</html>