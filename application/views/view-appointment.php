<!DOCTYPE html>
<html lang="en">

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

	<!-- Datatables CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/plugins/datatables/datatables.min.css">
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
							<li class="breadcrumb-item active" aria-current="page">Appointments</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Appointments</h2>
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
							<div class="table-responsive">
								<table class="table dataTable table-bordered table-hover table-center mb-0">
									<thead>
									<tr>
										<th>Doctor</th>
										<th>Description</th>
										<th>Appt Date</th>
										<th>Approx Time</th>
										<th></th>
									</tr>
									</thead>
									<tbody>
									<?php
									foreach ($res as $re)
									{
										?>
										<tr>
											<td>Dr. <?= $re['username']?></td>
											<td><?= $re['description']?></td>
											<td><?= $re['datetime']?></td>
											<td><?= $re['time']?></td>
											<td>
												<?php
													if ($re['status']==0)
													{
														?>
														<a href="<?= base_url() ?>appointment/checkupQueue/<?= $re['docId'] ?>"
														   class="btn btn-sm bg-info-light <?= ($re['enable'] == 0) ? 'disabled' : '' ?>">Checkup</a>
														<?php
													}
												?>
											</td>
										</tr>
										<?php
									}
									?>
									</tbody>
								</table>
							</div>

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

<!-- Sticky Sidebar JS -->
<script src="<?= base_url()?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
<script src="<?= base_url()?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
<!-- parsley JS -->
<script src="<?= base_url()?>assets/plugins/parsley/js/parsley.min.js"></script>

<!-- Datatables JS -->
<script src="<?= base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/datatables.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url()?>assets/js/script.js?version=3"></script>
<script>
	$('.dataTable').DataTable({
		"order": false
	});
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
