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
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/simple-line-icons.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery.typeahead.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/datatables.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/Chart.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/morris.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/leaflet.css"><!-- Theme CSS -->
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/styleMedic.css?version=4">
</head>
<body class="vertical-layout boxed">
<div class="app-loader main-loader">
	<div class="loader-box">
		<div class="bounceball"></div>
		<img src="<?= base_url() ?>assets/img/MediCareLogo.png" alt="logo">
	</div>
</div><!-- .main-loader -->
<div class="page-box">
	<div class="app-container"><!-- Horizontal navbar -->

		<?php
		include ("sidebar.php")
		?>

		<main class="main-content">
			<div class="app-loader"><i class="icofont-spinner-alt-4 rotate"></i></div>
			<div class="main-content-wrap">
				<header class="page-header"><h1 class="page-title float-left">Wallet</h1>
					<div style="border-left: 1px solid rgba(0,0,0,.1);">
						<div class="pl-5">
							<h5 class="mt-0">Total Balance</h5>
							<span class="link-icon icofont-rupee"></span> <?= $wallet->amount ?>
						</div>
					</div>
				</header>
				<div class="page-content">
					<hr>

					<form action="<?= base_url()?>wallet/paymentGateway" method="post">
						<input type="hidden" name="walletId" value="<?= $wallet->walletId ?>">
						<div class="row form-row mb-4" >
							<div class="col-md-6 ">
								<h5 class="ml-2">Add Money to Wallet</h5>
								<div class="form-inline ml-2">
									<input type="number" class="form-control" name="addAmount" id="txtAdd" >
									<input type="hidden" name="phar" value="1">
									<button type="submit" class="btn btn-primary ml-2" id="addMoney" name="type" value="0">Add Money</button>
								</div>
							</div>
							<div class="col-md-6">
								<h5>Withdraw Money from Wallet</h5>
								<div class="form-inline">
									<input type="number" class="form-control" name="withdrawAmount" id="txtWithdraw">
									<button type="submit" class="btn btn-primary ml-2" name="type" id="withdraw" value="1">Withdraw Money</button>
								</div>
							</div>
						</div>
					</form>
					<hr>
					<div class="row form-row ml-2" >
						<h5><b>Transactions</b></h5>
					</div>
					<div class="row form-row" >
						<div class="col">
							<table class="table table-bordered ">
								<tr>
									<th>Date</th>
									<th>Description</th>
									<th>Amount</th>
									<th>Status</th>
								</tr>
								<?php
								if (!empty($tran))
								{
									foreach ($tran as $t)
									{
										?>
										<tr>
											<td><?= date('d M y', strtotime($t['date'])) ?></td>
											<td><?= (($t['type'] == 1) ? '<span class="link-icon icofont-upload"></span> &nbsp; ' : '<span class="link-icon icofont-download-alt"></span> &nbsp;&nbsp;') . $t['desc'] ?></td>
											<td><?= (($t['type'] == 1) ? '- ' : '+ ') ?><i
													class="fas fa-rupee-sign"></i> <?= $t['amount'] ?></td>
											<td><?= ($t['status'] == 0) ? 'Success' : 'Failed' ?></td>
										</tr>
										<?php
									}
								}
								?>

							</table>
						</div>
					</div>
				</div>
			</div>
		</main>
		<div class="app-footer">
			<div class="footer-wrap">
				<div class="row h-100 align-items-center">
					<div class="col-12 col-md-6 d-none d-md-block">
						<ul class="page-breadcrumbs">
							<li class="item"><a href="javascript:void(0)" class="link">Home</a> <i
									class="separator icofont-thin-right"></i></li>
							<li class="item"><a href="javascript:void(0)" class="link">Wallet</a> <i
									class="separator icofont-thin-right"></i></li>
						</ul>
					</div>
				</div>
				<div class="footer-skeleton">
					<div class="row align-items-center">
						<div class="col-12 col-md-6 d-none d-md-block">
							<ul class="page-breadcrumbs">
								<li class="item bg-1 animated-bg"></li>
								<li class="item bg animated-bg"></li>
							</ul>
						</div>
						<div class="col-12 col-md-6">
							<div class="info justify-content-center justify-content-md-end">
								<div class="version bg animated-bg"></div>
								<div class="settings animated-bg"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-overlay"></div>
	</div>
</div>
<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.typeahead.min.js"></script>
<script src="<?= base_url() ?>assets/js/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-select.min.js"></script>
<!-- Select2 JS -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>

<script src="<?= base_url() ?>assets/js/main.js"></script>



<script>
</script>

<?php
include ("noti.php");
?>
</body>
</html>
