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

	<style>
		.section {
			box-shadow: 0 6px 10px rgba(0, 0, 0, 0.21);
			border-radius: 6px;
			border: 1px solid #e0d9d9;
			text-align: center;
			height: 470px;
			padding: 10px;
			overflow: auto;

		}
		.section #queue li{
			cursor: pointer;
		}
		.section #queue li{
			background: #f1f1f1;
			padding: 10px;
			border-radius: 5px;
			margin-bottom: 5px;
		}
		.section .card-body{
			padding: 0;
		}
	</style>

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
							<li class="breadcrumb-item"><a href="index.html">Appointment</a></li>
							<li class="breadcrumb-item active" aria-current="page">Checkup</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Checkup</h2>
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
							<div class="row">
								<div class="col-md-8">
									<h2>Doctor Details</h2>
									<div class="profile">
										<div class="doctor-img float-left">
											<img src="<?= base_url()?>assets/img/doctors/doctor-thumb-02.jpg" class="img-fluid" alt="User Image">
										</div>

										<h2 class="mt-2"><?= $doc['username']?></h2>
										<p class="doc-speciality"><?= $doc['specialization']?></p>
										<p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?= $doc['address']?></p>
										<p class="doc-speciality"><?= $doc['description']?></p>
									</div>
									<?php
										if(isset($clinic)){
											?>
											<h2 class="mt-5">Clinic Details</h2>
											<div class="profile">
												<div class="doctor-img float-left">
													<img src="<?= base_url()?>assets/img/doctors/doctor-thumb-02.jpg" class="img-fluid" alt="User Image">
												</div>

												<h2 class="mt-2"><?= $clinic->clinicName?></h2>
												<p class="doc-speciality"><?= $clinic->clinicDescription?></p>
												<p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?= $clinic->clinicAddress?></p>
											</div>
											<?php
										}
									?>
								</div>
								<div class="col-md-4">
									<div class="section">
										<div class="card mb-0 border-0">
											<div class="card-body text-left">
												<ul style="list-style: none;padding: 0" id="queue">
												</ul>
											</div>
										</div>
									</div>
								</div>
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
<script>
	let hashes = window.location.href;
	let index = hashes.lastIndexOf('/');
	let docId = hashes.substring(index+1);

	queue();
	async function queue(){
		const response = await fetch('<?= base_url()?>doctor/checkup/queue/' + docId);
		const data = await response.json();

		let html ='';
		for (let i = 0;i < data.length;i++) {
			html += '<li>\n' +
				'<h4 class="m-0">' + data[i].username + '</h4>\n' +
				'<p>' + data[i].description + '</p>\n' +
				'</li>';
		}
		$("#queue").html(html).fadeIn();
	}


	setInterval(function () {
		queue()
	},5000);

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
