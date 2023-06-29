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
	$rating=clear($_POST['rating']);
	$timeAdded=time();
    $id=generateRandomString();
    $timeAdded=time();
    if($productId==""){
		
    	$query="insert into ecommerce_products set id='$id',title='$title',description='$description',timeAdded='$timeAdded',rating='$rating',price='$price',category='$category'";
      	$productId=$id;
		
    }
    else
	$query="update ecommerce_products set title='$title',description='$description',timeAdded='$timeAdded',rating='$rating',price='$price',category='$category' where id='$productId'";
 	
	$result=$con->query($query);
	if(!$result)
			echo $con->error;
			else
			header("Location:home.php?m=Product Updated");
	
	if(isset($_FILES['image']) )
	{
		$target_dir = "../uploads/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
	
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
		{
		$image=htmlspecialchars( basename( $_FILES["image"]["name"]));
		
		$query="update ecommerce_products set image='$image' where id='$productId'";
		
		$result=$con->query($query);
		if(!$result)
			echo $con->error;
			else
			header("Location:home.php?m=Product Updated");
		}
	}
  	if($new)
	header("Location:home.php?m=Entry added successfully");
}
$productDeets=getRow($con,"select * from ecommerce_products where id='$productId'");


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
												<h2><?if($new){echo "Add ";}else{echo "Edit ";}?> Product</h2>
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
											<select class="form-control w-100" name="category">
												<?php
												// Assuming you have a database connection established
												
												// Fetch categories from the database
												$sql = "SELECT * FROM ecommerce_category";
												$result = mysqli_query($con, $sql);
												
												// Generate option tags based on retrieved categories
												while ($row = mysqli_fetch_assoc($result)) {
													$categoryId = $row['id'];
													$categoryName = $row['categories'];
													$selected = ($productDeets['category'] == $categoryName) ? 'selected' : '';
													echo '<option value="' . $categoryName . '" ' . $selected . '>' . $categoryName . '</option>';
												}
												?>
											</select>
										</div>


											<div class="col-12 mb-10">
												<label>Price</label>
												<input type="number" name="price" class="form-control" value="<?echo $productDeets['price']?>" required>
											</div>
											<div class="col-12 mb-10">
												<label>Rating</label>
												<input type="number" name="rating" class="form-control" value="<?echo $productDeets['rating']?>" required>
											</div>	
											<div class="col-12 mb-10">
												<label>Description</label>
												<textarea name="description" class="form-control" rows="8"><?echo $productDeets['description']?></textarea>
											</div>
											<div class="col-12 mb-10">
												<label>Image </label>
												<input type="file" class="form-control" name="image">
											</div>
											<input type="text" name="productId" value="<?echo $productDeets['id']?>" hidden>
									

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