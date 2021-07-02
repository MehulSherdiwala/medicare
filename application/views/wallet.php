<?php
$wallet2 = $wallet;
?>
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
	<link rel="stylesheet" href="<?= base_url()?>assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url()?>assets/plugins/fontawesome/css/all.min.css">

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/css/bootstrap-datetimepicker.min.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/plugins/select2/css/select2.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css?version=5">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?= base_url()?>assets/js/html5shiv.min.js"></script>
	<script src="<?= base_url()?>assets/js/respond.min.js"></script>
	<![endif]-->

</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">

	<!-- Header -->
	<?php
	include ("header.php")
	?>
	<!-- /Header -->

	<!-- Breadcrumb -->
	<div class="breadcrumb-bar">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-12 col-12">
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Profile Settings</h2>
				</div>
			</div>
		</div>
	</div>
	<!-- /Breadcrumb -->

	<!-- Page Content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<!-- Profile Sidebar -->
				<?php
				include ("sidebar.php");
				?>
				<!-- /Profile Sidebar -->

				<div class="col-md-7 col-lg-8 col-xl-9">
					<div class="card">
						<div class="card-body">

							<!-- Profile Settings Form -->
							<div class="row form-row" >
								<div class="col-md-9 mt-auto">
									<h3>Wallet</h3>
								</div>
								<div class="col-md-3" style="border-left: 1px solid rgba(0,0,0,.1);">
									<div class="pl-5">
										<h4>Total Balance</h4>
										<i class="fas fa-rupee-sign"></i> <?= $wallet2->amount ?>
									</div>
								</div>
							</div>
							<hr>
							<form action="<?= base_url()?>wallet/paymentGateway" method="post">
								<input type="hidden" name="walletId" value="<?= $wallet2->walletId ?>">
								<div class="row form-row mb-4" >
									<div class="col-md-6 ">
										<h5 class="ml-2">Add Money to Wallet</h5>
										<div class="form-inline ml-2">
											<input type="number" class="form-control" name="addAmount" id="txtAdd" >
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
										if(!empty($tran))
										{
											foreach ($tran as $t)
											{
												?>
												<tr>
													<td><?= date('d M y', strtotime($t['date'])) ?></td>
													<td><?= (($t['type'] == 1) ? '<i class="fas fa-upload"></i> &nbsp; ' : '<i class="fas fa-download"></i> &nbsp;&nbsp;') . $t['desc'] ?></td>
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
							<!-- /Profile Settings Form -->

						</div>
					</div>
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
<script src="<?= base_url()?>assets/js/jquery.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?= base_url()?>assets/js/popper.min.js"></script>
<script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>

<!-- Select2 JS -->
<script src="<?= base_url()?>assets/plugins/select2/js/select2.min.js"></script>

<!-- Datetimepicker JS -->
<script src="<?= base_url()?>assets/js/moment.min.js"></script>
<script src="<?= base_url()?>assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Sticky Sidebar JS -->
<script src="<?= base_url()?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
<script src="<?= base_url()?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
<!-- parsley JS -->
<script src="<?= base_url()?>assets/plugins/parsley/js/parsley.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url()?>assets/js/script.js?version=3"></script>

<?php
	if (isset($_GET['err'])){
		?>
		<script>
			alert('<?= $_GET['err']?>');
		</script>
		<?php
	}
?>

<script>
	$(document).ready(function () {
		$("#addMoney").on('click', function (e) {
			if ($("#txtAdd").val() == 0 || $("#txtAdd").val() == ''){
				e.preventDefault();
				alert("Please Enter Amount");
				$("#txtAdd").focus();
			}
		});
		$("#withdraw").on('click', function (e) {
			if ($("#txtWithdraw").val() == 0 || $("#txtWithdraw").val() == ''){
				e.preventDefault();
				alert("Please Enter Amount");
				$("#txtWithdraw").focus();
			}
		});

	})
</script>
<script>

	checkApp();
	async function checkApp() {
		const res = await fetch('<?= base_url()?>appointment/checkIC');
		const data = await res.json();

		if (data > 0){
			$(".instant-cure").removeClass("d-none");
			$(".instant-cure a").attr('href', '<?= base_url()?>chat/'+ data);
		}
	}
</script>

</body>

</html>
