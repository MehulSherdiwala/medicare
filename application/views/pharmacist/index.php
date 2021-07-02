<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MediCare</title>
	<meta content="MedicApp" name="keywords">
	<meta content="" name="description">
	<meta content="" name="author">
	<meta content="width=device-width,initial-scale=1" name="viewport"><!-- Favicon -->
	<link type="image/x-icon" href="<?= base_url() ?>assets/img/fav.png" rel="icon"><!-- Plugins CSS -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/icofont.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/datatables.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/Chart.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/morris.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/leaflet.css" rel="stylesheet"><!-- Theme CSS -->
	<link href="<?= base_url() ?>assets/css/styleMedic.css" rel="stylesheet">
</head>
<body class="vertical-layout boxed">
<div class="app-loader main-loader">
	<div class="loader-box">
		<div class="bounceball"></div>
		<img src="<?= base_url() ?>assets/img/MediCareLogo.png" alt="logo">
	</div>
</div><!-- .main-loader -->
<div class="page-box">
	<div class="app-container">
		<!-- navbar -->
		<?php
		include "sidebar.php";
		?>
		<!-- end navbar -->
		<main class="main-content">
			<div class="app-loader"><i class="icofont-spinner-alt-4 rotate"></i></div>
			<div class="main-content-wrap">
				<div class="page-content">
					<div class="row">
						<div class="col col-12 col-md-6 col-xl-3">
							<div class="card animated fadeInUp delay-01s bg-light">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col col-5">
											<div class="icon p-0 fs-48 text-primary opacity-50 icofont-cart-alt"></div>
										</div>
										<div class="col col-7"><h6 class="mt-0 mb-1">Sold Medicine</h6>
											<div class="count text-primary fs-20"><?= $data['sold']?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col col-12 col-md-6 col-xl-3">
							<div class="card animated fadeInUp delay-02s bg-light">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col col-5">
											<div class="icon p-0 fs-48 text-primary opacity-50 icofont-wheelchair"></div>
										</div>
										<div class="col col-7"><h6 class="mt-0 mb-1">Patient</h6>
											<div class="count text-primary fs-20"><?= $data['patient']?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col col-12 col-md-6 col-xl-3">
							<div class="card animated fadeInUp delay-03s bg-light">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col col-5">
											<div class="icon p-0 fs-48 text-primary opacity-50 icofont-medicine"></div>
										</div>
										<div class="col col-7"><h6 class="mt-0 mb-1">Medicines</h6>
											<div class="count text-primary fs-20"><?= $data['med']?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col col-12 col-md-6 col-xl-3">
							<div class="card animated fadeInUp delay-04s bg-light">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col col-5">
											<div class="icon p-0 fs-48 text-primary opacity-50 icofont-rupee-true"></div>
										</div>
										<div class="col col-7"><h6 class="mt-0 mb-1 text-nowrap">Wallet</h6>
											<div class="count text-primary fs-20"><span class="icofont icofont-rupee"></span><?= $data['wallet']?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header">Patient Joining survey</div>
						<div class="card-body">
							<div class="chat-container container-h-400" id="newPatient"></div>
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
							<li class="item"><a class="link" href="javascript:void(0)">Dashboards</a> <i
									class="separator icofont-thin-right"></i></li>
							<li class="item"><a class="link" href="javascript:void(0)">Default</a> <i
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
<script src="<?= base_url() ?>assets/js/jquery.barrating.min.js"></script>
<script src="<?= base_url() ?>assets/js/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/js/raphael-min.js"></script>
<script src="<?= base_url() ?>assets/js/morris.min.js"></script>
<script src="<?= base_url() ?>assets/js/echarts.min.js"></script>
<script src="<?= base_url() ?>assets/js/echarts-gl.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>

<script>
	var myChart = echarts.init(document.getElementById('newPatient'));

	var options = {
		color: ['#ed5564'],
		tooltip: {
			trigger: 'none',
			axisPointer: {
				type: 'cross'
			}
		},
		grid: {
			left: 30,
			right: 0,
			top: 50,
			bottom: 50
		},
		xAxis:
			{
				type: 'category',
				axisTick: {
					alignWithLabel: true
				},
				axisLine: {
					onZero: false,
					lineStyle: {
						color: '#336cfb'
					}
				},
				axisPointer: {
					label: {
						formatter: function (params) {
							return 'Medicines ' + params.value + (params.seriesData.length ? '：' + params.seriesData[0].data : '');
						}
					}
				},
				data: ['<?= $data['medicineDate']?>']
			},
		yAxis:
			{
				type: 'value'
			},
		series: {
			name: 'Patients 2018',
			type: 'line',
			smooth: true,
			data: [<?= $data['medicineCnt']?>]
		}
	};

	myChart.setOption(options);
	// Resize chart
	$(function() {
		$(window).on('resize', resize);

		function resize() {
			setTimeout(function() { myChart2.resize() }, 200);
		}
	})
</script>
</body>
</html>
