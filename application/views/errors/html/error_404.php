<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>MediCare</title>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?= config_item('base_url')?>assets/img/fav.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= config_item('base_url')?>assets/css/bootstrap.min.css">

	<!-- Main CSS -->
<!--	<link rel="stylesheet" href="--><?//= config_item('base_url')?><!--assets/css/style.css">-->

	<!--[if lt IE 9]>
	<script src="<?= config_item('base_url')?>assets/js/html5shiv.min.js"></script>
	<script src="<?= config_item('base_url')?>assets/js/respond.min.js"></script>
	<![endif]-->

	<style>
		body{
			background: rgba(204, 199, 199, 0.18);
			color: #272b41;
			font-family: "Poppins",sans-serif;
			font-size: 0.9375rem;
			height: 100%;
			overflow-x: hidden;
		}
		.error-page {
			align-items: center;
			color: #1f1f1f;
			display: flex;
		}
		.error-page .main-wrapper {
			display: flex;
			flex-wrap: wrap;
			height: auto;
			justify-content: center;
			width: 100%;
			min-height: unset;
		}
		.error-box {
			margin: 7% auto;
			max-width: 480px;
			padding: 1.875rem 0;
			text-align: center;
			width: 100%;
		}
		.error-box h1 {
			color: #ff4c3b;
			font-size: 10em;
		}
		.error-box p {
			margin-bottom: 1.875rem;
		}
		.error-box .btn {
			border-radius: 50px;
			font-size: 18px;
			font-weight: 600;
			min-width: 200px;
			padding: 10px 20px;
		}

	</style>
</head>
<body class="error-page">

<!-- Main Wrapper -->
<div class="main-wrapper">

	<div class="error-box">
		<h1>404</h1>
		<h3 class="h2 mb-3"><i class="far fa-warning"></i> Oops! Page not found!</h3>
		<p class="h4 font-weight-normal">The page you requested was not found.</p>
		<a href="<?= config_item('base_url')?>" class="btn" style="background-color: #ff4c3b;color: #f1f1f1">Back to Home</a>
	</div>

</div>
<!-- /Main Wrapper -->
</body>
</html>
