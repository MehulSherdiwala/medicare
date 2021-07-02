<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MediCare</title>
    <meta name="keywords" content="MedicApp">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1"><!-- Favicon -->
    <link type="image/x-icon" href="<?= base_url() ?>assets/img/fav.png" rel="icon"><!-- Plugins CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/icofont.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-select.min.css">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/css/styleMedic.css?version=2">
</head>
<body class="public-layout">
<div class="app-loader main-loader">
    <div class="loader-box">
        <div class="bounceball"></div>
        <img src="<?= base_url() ?>assets/img/MediCareLogo.png" alt="logo">
    </div>
</div><!-- .main-loader -->
<div class="page-box">
    <div class="app-container page-sign-in" align="center" style="background-color: #f1f1f1">
        <div class="content-box" style="align-items: center">
            <div class="content-header">
                <div class="app-logo">
                    <div class="logo-wrap">
                        <img src="<?= base_url() ?>assets/img/MediCareLogo.png" alt="" width="147" height="33" class="logo-img"></div>
                </div>
            </div>
            <div class="content-body">
                <div class="w-100"><h2 class="h4 mt-0 mb-1">Sign in</h2>
                    <p class="text-muted">Sign in to access your Account</p>
                    <form method="post" action="<?= base_url() ?>admin/login/LoginVerify">
                        <div class="form-group"><input class="form-control" type="email" placeholder="Email" name="email" required></div>
                        <div class="form-group"><input class="form-control" type="password" placeholder="Password" name="pwd" required>
                        </div>
                        <div class="row">
                            <div class="form-group custom-control custom-switch col-md-6 offset-1" style="text-align: left">
                                <input type="checkbox" class="custom-control-input" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Remember me</label>
                            </div>
                            <div class="form-group col-md-5" style="text-align: right">
                                <p class="mt-1 mb-1"><a href="<?= base_url() ?>forgotPassword">Forgot password?</a></p>
                            </div>
                        </div>
						<?= validation_errors('<div class="error">','</div>')?>
						<?= isset($error)? '<div class="error">'.$error.'</div>' : ''?>
						<div class="actions justify-content-between">
                            <button class="btn btn-primary"><span class="btn-icon icofont-login mr-2"></span>Sign in</button>
                        </div>
                    </form>
<!--                    <p>Don't have an account? <a href="sign-up.html">Sign up!</a></p></div>-->
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-select.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
</body>
</html>
