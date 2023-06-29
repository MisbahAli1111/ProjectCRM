<?
require("./global.php");
if($logged==0)
    header("Location:./index.php");

if(isset($_GET['delete-product'])){
    $id = clear($_GET['delete-product']);
    $query="delete from ecommerce_customers where id='$id'";
    runQuery($query);
    header("Location:?m=Customer Record deleted successfully");
}

?>

<html lang="en">
	<!--begin::Head-->
	<head>
		<?require("./includes/views/head.php");?>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
	    <div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<?require("./includes/views/leftmenu.php");?>
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<?require("./includes/views/topmenu.php");?>
					
					
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<div id="kt_content_container" class="container-xxl" style="max-width: 100%;margin-bottom: 50px;">
							    <?if(isset($_GET['m'])){
					    			$m=clear($_GET['m']);
							    	?>
                                <div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                    <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="currentColor"></path>
											<path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="currentColor"></path>
										</svg>
									</span>
                                    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                        <h4 class="mb-2 light" style="color: white;margin-top: 5px;"><?echo $m?></h4>
                                    </div>
                                </div>
                                <?}?>



								<!--begin::Category-->
								<div class="card card-flush">
									<!--begin::Card header-->
									<div class="card-header align-items-center py-5 gap-2 gap-md-5">
										<!--begin::Card title-->
										<div class="card-title">
											<!--begin::Search-->
											<div class="d-flex align-items-center position-relative my-1">
												<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
												<span class="svg-icon svg-icon-1 position-absolute ms-4">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
														<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
													</svg>
												</span>
												<!--end::Svg Icon-->
												<input type="text" data-kt-ecommerce-category-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Customers" />
											</div>
										</div>
										
									</div>
									<div class="card-body pt-0">
										<table class="table align-middle table-row-dashed fs-6 gy-5 table-bordered" id="kt_ecommerce_category_table">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
													<th style="text-align: center;">Name</th>
													<th style="text-align: center;">Email</th>
													<th style="text-align: center;">Phone No</th>
                                                    <th style="text-align: center;">Street Address</th>
													<th style="text-align: center;">Post Code</th>
                                                    <th style="text-align: center;">City / Country</th>
													<th style="text-align: center;">Registered On</th>
													<th style="text-align: center;">Actions</th>
												</tr>
											</thead>
											<tbody class="fw-bold text-gray-600">
											    
											    <?$products=getAll($con,"select * from ecommerce_customers order by registered_on desc");
											    foreach($products as $row){?>
											    
												<tr>
                                                    <td style="text-align: center;"><?echo $row['name']?></td>
                                                    <td style="text-align: center;"><?echo $row['email']?></td>
                                                    <td style="text-align: center;"><?echo $row['phone no']?></td>
													<td style="text-align: center;"><?echo $row['address']?></td>
													<td style="text-align: center;"><?echo $row['post_code']?></td>
													<td style="text-align: center;"><?echo $row['city'] ."/". $row['country']?></td>
													<td style="text-align: center;"><?echo date('Y-m-d H:i:s',$row['registered_on'])?></td>
													<td style="text-align: center;">
													  	<a href="#" data-bs-toggle="modal" data-bs-target="#delete_record"  data-url="?delete-product=<?echo $row['id']?>" class="btn btn-danger btn-sm">Delete</a>
													</td>
												</tr>
												<?}?>
											</tbody>
											<!--end::Table body-->
										</table>
										<!--end::Table-->
									</div>
									<!--end::Card body-->
								</div>
								<!--end::Category-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					
					
					
					
					<?require("./includes/views/footer.php");?>
					
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			
			<?require("./includes/views/footerjs.php");?>
	
	
		</div>
	</body>
</html>