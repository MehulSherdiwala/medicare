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
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								Payment Details
							</h3>
						</div>
						<br>
						<div class="panel-body">
							<form role="form">
								<div class="form-group">
									<label for="cardNumber">
										CARD NUMBER</label>
									<div class="input-group">
										<input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number"
											   required autofocus />
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
													<input type="text" class="form-control" id="expityMonth" placeholder="MM" required />
												</div>
												<div class="col-xs-6 col-lg-6 pl-ziro">
													<input type="text" class="form-control" id="expityYear" placeholder="YY" required /></div>
											</div>
										</div>
									</div>
									<div class="col-xs-5 col-md-5 pull-right">
										<div class="form-group">
											<label for="cvCode">
												CV CODE</label>
											<input type="password" class="form-control" id="cvCode" placeholder="CV" required />
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<ul class="nav nav-pills nav-stacked">
						<?php
						if (isset($_POST['payOption']))
						{
							$amount = $_POST['totalAmount'];

							if (isset($_POST['payWallet']))
							{
								$amount = $amount - $_POST['wallet'];
							}
						}else {
							$amount = ($_POST['type'] == 0) ?  $_POST['addAmount'] :  $_POST['withdrawAmount'];
						}
						?>
						<li class="active"><a href="#"><span class="badge pull-right"><i class="fas fa-rupee-sign"></i> <?= $amount?></span> Final Payment</a>
						</li>
					</ul>
					<br/>
					<?php
						if (isset($_POST['payOption']))
						{
							?>
							<form action="<?= base_url() ?>shop/order" method="post">
								<input type="hidden" name="payOption" value="<?= $_POST['payOption'] ?>">
								<input type="hidden" name="totalAmount" value="<?= $_POST['totalAmount'] ?>">
								<input type="hidden" name="address" value="<?= $_POST['address'] ?>">
								<input type="hidden" name="type" value="<?= (isset($_POST['type']))? $_POST['type'] : '' ?>">
								<input type="hidden" name="payWallet"
									   value="<?= (isset($_POST['payWallet'])) ? 1 : 0 ?>">
								<input type="hidden" name="amount" value="<?= $amount ?>">

								<?php
									if ($_POST['type'] == 'direct'){
										?>
										<input type="hidden" name="pwmId" value="<?= $_POST['pwmId'] ?>">
										<input type="hidden" name="qty" value="<?= $_POST['qty'] ?>">
										<input type="hidden" name="price" value="<?= $_POST['price'] ?>">

										<?php
									}
								?>

								<button type="submit" class="btn btn-success btn-lg btn-block" id="sub">Pay</button>
							</form>
							<?php
						} else {
							?>
							<form action="<?= base_url().((isset($_POST['phar']))? 'pharmacist/' : ((isset($_POST['doc']))? 'doctor/' : ((isset($_POST['admin']))? 'admin/' : ''))) ?>wallet/transfer" method="post">
								<input type="hidden" name="type" value="<?= $_POST['type'] ?>">
								<input type="hidden" name="walletId" value="<?= $_POST['walletId'] ?>">
								<input type="hidden" name="amount" value="<?= $amount ?>">
								<button type="submit" class="btn btn-success btn-lg btn-block" id="sub">Pay</button>
							</form>
							<?php
						}
					?>
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
<?php
if (isset($_POST['payOption']))
{
	?>
	<script>
		let opt = '<?= $_POST['payOption']?>';

		if (opt == 'wallet' || opt == 'COD') {
			$("#sub").trigger('click');
		}
	</script>
	<?php
}
?>

</body>

</html>
