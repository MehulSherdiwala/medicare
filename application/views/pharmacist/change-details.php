
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
				<header class="page-header"><h1 class="page-title">Change Medicine Details</h1></header>
				<div class="page-content">
					<div class="row justify-content-center">
						<div class="col col-12 col-xl-9">
							<h4>Original Details</h4>
								<div class="row mb-4">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medicine Name</label>
											<input class="form-control" type="text" placeholder="Medicine Name" value="<?= $details->medName ?>">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Disease Name</label>
											<input class="form-control" type="text" placeholder="Medicine Name" value="<?= $details->disName ?>" >
										</div>
									</div>

									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>Medicine Description</label>
											<textarea class="form-control" placeholder="Medicine Description" rows="3" required><?= $details->medDescription?></textarea>
										</div>
									</div>
								</div>
							<hr>
							<h4>New Details</h4>
								<div class="row">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Medicine Name</label>
											<input class="form-control" type="text" placeholder="Medicine Name"  value="<?= ($details->updatedMedName == '')? $details->medName : $details->updatedMedName ?>">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Disease Name</label>
											<input class="form-control" type="text" placeholder="Medicine Name"  value="<?= ($details->updatedDisName == '')? $details->disName :$details->updatedDisName ?>">
										</div>
									</div>
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>Medicine Description</label>
											<textarea class="form-control" placeholder="Medicine Description" rows="3" required><?= ($details->updatedMedDescription == '')? $details->medDescription :$details->updatedMedDescription ?></textarea>
										</div>
									</div>
								</div>
<!--							action="--><?//= base_url()?><!--pharmacist/medicine/change"-->
							<form  method="post">
								<div class="row">
									<div class="col">
										<button type="submit" class="btn btn-danger" name="permission" value="2">Reject</button>
									</div>
									<div class="col text-right">
										<button type="submit" class="btn btn-success" name="permission" value="1">Approve</button>
									</div>
								</div>
							</form>
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
							<li class="item"><a href="javascript:void(0)" class="link">Medicine</a> <i
									class="separator icofont-thin-right"></i></li>
							<li class="item"><a href="javascript:void(0)" class="link">Change Details</a> <i
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





</body>
</html>
