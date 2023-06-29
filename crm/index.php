<?
require("global.php");
if($logged==1)
    header("Location:./home.php");
    
	if (isset($_POST['login'])) {
		$email = mb_htmlentities($_POST['email']);
		$password = mb_htmlentities($_POST['password']); 
		
		$userDeets = getRow($con, "SELECT * FROM jhm_admins WHERE email='$email'");
		
		if (count($userDeets) != 0 && password_verify($password, $userDeets['password'])) {
			$_SESSION['email'] = $userDeets['email'];
			$_SESSION['password'] = $userDeets['password'];
			header("Location: ./home.php");
			exit();
		} else {
			header("Location: ./index.php?err=failed");
			exit();
		}
	}
	
?>
<html lang="en">
	<head>
		<?require("./includes/home/head.php");?>
	</head>
	<body id="kt_body" class="bg-body">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #18c0eb">
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<a href="./index.php" class="py-9 mb-5">
								<img alt="Logo" src="assets/media/logos/logo-2.svg" class="h-60px" />
							</a>
							<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: white;">Welcome to Product Manager </h1>
							<p class="fw-bold fs-2" style="color: white;">Discover Amazing Management
							<br />features with great tools</p>
						</div>
						<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/sketchy-1/13.png)"></div>
					</div>
				</div>
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<form method="post" class="form w-100" action="">
								<div class="text-center mb-10">
								    <a href="./index.php" class="py-9 mb-5">
        								<img style="margin-bottom: 30px;" alt="Logo" src="assets/media/logos/logo-2.svg" class="h-60px" />
        							</a>
									<h1 class="fw-bolder fs-2qx pb-5 pb-md-10">SIGN IN </h1>
									<?if($_GET['err']=="failed"){?>
    									<div style="margin-top: 35px;">
    									    <span  style="background-color: red;color: white;" class="alert alert-danger">Incorrect Credentials Try Again</span>
    								    </div>
									<?}?>
								</div>
								<div class="fv-row mb-10">
									<label class="form-label fs-6 fw-bolder text-dark">Email</label>
									<input class="form-control form-control-lg form-control-solid" type="text" name="email" placeholder="Enter Email" autocomplete="off" />
								</div>
								<div class="fv-row mb-10">
									<div class="d-flex flex-stack mb-2">
										<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
									</div>
									<input class="form-control form-control-lg form-control-solid" type="password" name="password" placeholder="Enter Password" autocomplete="off" />
								</div>
								<div class="text-center">
									<!--begin::Submit button-->
									<button name="login" type="submit" class="btn btn-lg btn-primary w-100 mb-5">
										<span class="indicator-label">Log In</span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>