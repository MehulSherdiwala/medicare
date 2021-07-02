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
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">

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

					<!-- Login Tab Content -->
					<div class="account-content">
						<div class="row align-items-center justify-content-center">
							<div class="col-md-7 col-lg-6 login-left">
								<img src="<?= base_url() ?>assets/img/login-banner.png" class="img-fluid" alt="Doccure Login">
							</div>
							<div class="col-md-12 col-lg-6 login-right">
								<div class="login-right-wrap">
									<h3>Setup New Password</h3>
									<form action="<?= base_url() ?>login/verifyOTP" method="post" >
										<p class="account-subtitle">OTP is sended to Email and Mobile No.</p>
										<div class="form-group">
											<input class="form-control" type="number" name="otp" placeholder="OTP" maxlength="6" minlength="6" required>
										</div>
										<div class="form-group">
											<input class="form-control" type="password" name="pwd" placeholder="New Password" required>
										</div>
										<div class="form-group">
											<input class="form-control" type="password" name="repwd" placeholder="Re Enter Password" required>
										</div>
										<?= ($this->uri->segment(4))? '<div class="error">Wrong OTP. </div>' : ''?>
										<?= validation_errors('<div class="error">','</div>')?>
										<div class="form-group mb-0">
											<button class="btn btn-primary btn-block" type="submit">Reset Password</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- /Login Tab Content -->

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

<!-- Custom JS -->
<script src="<?= base_url() ?>assets/js/script.js"></script>

</body>
</html>
