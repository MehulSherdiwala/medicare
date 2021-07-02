<!DOCTYPE html> 
<html lang="en">
<head>
		<meta charset="utf-8">
		<title>MediCare</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="<?= base_url() ?>assets/img/fav.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css?version=3">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="<?= base_url() ?>assets/js/html5shiv.min.js"></script>
			<script src="<?= base_url() ?>assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<?php
			include ("header.php");
			?>
			<!-- /Header -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">
						
							<!-- Account Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="<?= base_url() ?>assets/img/login-banner.png" class="img-fluid" alt="Login Banner">
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header" style="margin-bottom: 30px;">
											<h3 class="text-center">Doctor or Pharmacist Register </h3>
											<h3><a href="<?= base_url() ?>Register">Not a Doctor or Pharmacist?</a></h3>
										</div>
										
										<!-- Register Form -->
										<form action="<?= base_url()?>register/doctorPharmacist" method="post"  data-parsley-validate>
											<div class="form-group form-focus">
												<input type="text" name="username" class="form-control floating" required>
												<label class="focus-label">Name</label>
											</div>
											<div class="form-group form-focus">
												<input type="email" name="email" class="form-control floating" required>
												<label class="focus-label">Email</label>
											</div>
											<div class="form-group form-focus">
												<input type="password" name="pwd" class="form-control floating" required data-parsley-minlength="6">
												<label class="focus-label">Password</label>
											</div>
											<div class="form-group form-focus">
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" id="doctor" name="type" class="custom-control-input" value="1" required>
													<label class="custom-control-label" for="doctor">Doctor</label>
												</div>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" id="pharmacist" name="type" value="2" class="custom-control-input">
													<label class="custom-control-label" for="pharmacist">Pharmacist</label>
												</div>
											</div>
											<div class="text-right">
												<a class="forgot-link" href="<?= base_url() ?>login">Already have an account?</a>
											</div>
											<?= validation_errors('<div class="error">','</div>')?>
											<?= isset($error)? '<div class="error">'.$error.'</div>' : ''?>

											<button class="btn btn-success btn-block btn-lg login-btn" type="submit">Signup</button>

										</form>
										<!-- /Register Form -->
										
									</div>
								</div>
							</div>
							<!-- /Account Content -->
								
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->

			<?php
			include ("footer.php")
			?>
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
		<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
		<!-- parsley JS -->
		<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>
		<!-- Custom JS -->
		<script src="<?= base_url() ?>assets/js/script.js?version=4"></script>
		
	</body>
</html>
