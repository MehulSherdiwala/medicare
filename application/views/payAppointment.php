<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamguys.co.in/demo/doccure/profile-settings.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 07 Jan 2020 18:15:01 GMT -->
<head>
	<meta charset="utf-8">
	<title>MediCare</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

	<!-- Favicons -->
	<link type="image/x-icon" href="<?= base_url() ?>assets/img/fav.png" rel="icon">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/css/bootstrap-3.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/plugins/fontawesome/css/all.min.css">

	<!-- Main CSS -->
<!--	<link rel="stylesheet" href="--><?//= base_url()?><!--assets/css/style.css?version=5">-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?= base_url()?>assets/js/html5shiv.min.js"></script>
	<script src="<?= base_url()?>assets/js/respond.min.js"></script>
	<![endif]-->
	<style>
		body { margin-top:20px; }
		.panel-title {display: inline;font-weight: bold;}
		.checkbox.pull-right { margin: 0; }
		.pl-ziro { padding-left: 0px; }
		.content{
			margin-top: 50px;
		}
		.d-none{
			display: none;
		}
	</style>
</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">

	<!-- Page Content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-6 col-md-offset-3">
					<form action="<?= base_url() ?>appointment/book" method="post">
					<div class="form-group form-focus mb-0">
						<div class="custom-control custom-radio custom-control-inline">
							<input type="radio" id="card" name="paytype" class="custom-control-input" value="card" required checked>
							<label class="custom-control-label" for="card">Credit / Debit Card</label>
						</div>
					</div>
					<div class="panel panel-default" id="cardSec">
						<div class="panel-heading">
							<h3 class="panel-title">
								Payment Details
							</h3>
						</div>
						<br>
						<div class="panel-body">
								<div class="form-group">
									<label for="cardNumber">
										CARD NUMBER</label>
									<div class="input-group">
										<input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number"
											   autofocus />
										<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-7 col-md-7">
										<div class="form-group">
											<label for="expityMonth">
												EXPIRY DATE</label>
											<div class="row" style="margin: 0">
												<div class="col-xs-6 col-lg-6 pl-ziro">
													<input type="text" class="form-control" id="expityMonth" placeholder="MM" />
												</div>
												<div class="col-xs-6 col-lg-6 pl-ziro">
													<input type="text" class="form-control" id="expityYear" placeholder="YY" /></div>
											</div>
										</div>
									</div>
									<div class="col-xs-5 col-md-5 pull-right">
										<div class="form-group">
											<label for="cvCode">
												CV CODE</label>
											<input type="password" class="form-control" id="cvCode" placeholder="CV" />
										</div>
									</div>
								</div>
						</div>
					</div>
					<?php
					$appType = $_POST['appType'];
					if ($balance > 0)
					{
						?>
						<div class="form-group form-focus mb-0">
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="wallet" name="paytype" class="custom-control-input" value="wallet"
									   required>
								<label class="custom-control-label" for="wallet">Pay Through Wallet</label>
							</div>
						</div>
						<div class="panel panel-default" id="cardSec">
							<div class="panel-heading">
								<h2 class="panel-title">
									Balance
									<i class="fas fa-rupee-sign"></i> <?= $balance ?>
								</h2>
							</div>

						</div>
						<?php
					}
					?>
					<ul class="nav nav-pills nav-stacked">
						<li class="active"><a href="#"><span class="badge pull-right"><i class="fas fa-rupee-sign"></i> <?= (($appType == 0)? $_POST['price'] : $_POST['icprice'])?></span> Final Payment</a>
						</li>
					</ul>
					<br/>
						<?php

							if ($appType == 0)
							{
								?>
								<input type="hidden" name="appType" value="<?= $_POST['appType'] ?>">
								<input type="hidden" name="type" value="<?= $_POST['type'] ?>">
								<input type="hidden" name="id" value="<?= $_POST['id'] ?>">
								<input type="hidden" name="date" value="<?= $_POST['date'] ?>">
								<input type="hidden" name="timeSlot" value="<?= $_POST['timeSlot'] ?>">
								<input type="hidden" name="price" value="<?= $_POST['price'] ?>">
								<input type="hidden" name="desc" value="<?= $_POST['desc'] ?>">
								<?php
							} else {
								?>
								<input type="hidden" name="appType" value="<?= $_POST['appType'] ?>">
								<input type="hidden" name="icprice" value="<?= $_POST['icprice'] ?>">
								<?php
							}
						?>

						<button type="submit" class="btn btn-success btn-lg btn-block" id="sub">Pay</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="<?= base_url()?>assets/js/jquery.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?= base_url()?>assets/js/popper.min.js"></script>
<script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url()?>assets/js/script.js?version=3"></script>

<script>
	$(document).ready(function () {
		$("input[name='paytype']").on('change', function () {
			// alert("hh");
			if ($(this).val() === 'card'){
				$("#cardSec").removeClass('d-none');
			} else {
				$("#cardSec").addClass('d-none');
			}
		});
	});
</script>
</body>

</html>
