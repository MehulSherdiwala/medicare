<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MediCare</title>
	<meta content="MedicApp" name="keywords">
	<meta content="" name="description">
	<meta content="" name="author">
	<meta content="width=device-width,initial-scale=1" name="viewport">
	<!-- Favicon -->
	<link type="image/x-icon" href="<?= base_url() ?>assets/img/fav.png" rel="icon">
	<!-- Plugins CSS -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/icofont.min.css" rel="stylesheet">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">

	<link href="<?= base_url() ?>assets/css/jquery.typeahead.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/datatables.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/plugins/time-picker/mdtimepicker.css?version=3" rel="stylesheet">
	<!-- Daterange CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/css/daterangepicker.css">
	<!-- Theme CSS -->
	<link href="<?= base_url() ?>assets/css/styleMedic.css?version=5" rel="stylesheet">
	<style>
		span.form-control{
			min-height: 40px!important;
		}
		.form-control.disabled, .form-control:disabled, .form-control[readonly]{
			color: #2a2b2d;
			cursor: text;
		}
		.section {
			padding: 15px;
			border-radius: 10px;
			border: 1px solid #e0d9d9;
		}
	</style>
</head>
<body class="vertical-layout boxed">
<div class="app-loader main-loader">
	<div class="loader-box">
		<div class="bounceball"></div>
		<img src="<?= base_url() ?>assets/img/MediCareLogo.png" alt="logo">
	</div>
</div>
<!-- .main-loader -->
<div class="page-box">
	<div class="app-container"><!-- Horizontal navbar -->

		<?php
		include "sidebar.php"
		?>

		<main class="main-content">
			<div class="app-loader"><i class="icofont-spinner-alt-4 rotate"></i></div>
			<div class="main-content-wrap">
				<header class="page-header">
					<h1 class="page-title">Instant Cure</h1>
					<button type="button" class="btn btn-primary rounded-pill" style="height: 50px;width: 50px;font-size: 16px;"  data-target="#report" data-toggle="modal"><span class="btn-icon icofont-file-alt"></button>
				</header>
				<div class="page-content">
					<div class="card mb-0">
						<div class="card-body">
							<div class="table-responsive" id="data">
								<table class="table" id="data-table">
									<thead>
									<tr>
										<th>Appointment Id</th>
										<th>Patient Name</th>
										<th>Date</th>
									</tr>
									</thead>
									<tbody>
									<?php
									foreach ($record as $rec)
									{
										?>
										<tr>
											<td><?= $rec['icappId']?></td>
											<td><?= $rec['username']?></td>
											<td><?= $rec['timestamp']?></td>
										</tr>
										<?php
									}
									?>
									</tbody>
								</table>
							</div>

						</div>
					</div>
					<div class="add-action-box">
						<button class="btn btn-primary btn-lg btn-square rounded-pill" id="start" title="Start Instant Cure"><span class="btn-icon fas fa-headset fa-2x"></span>
						</button>
					</div>
				</div>
			</div>
		</main>
		<div class="app-footer">
			<div class="footer-wrap">
				<div class="row h-100 align-items-center">
					<div class="col-12 col-md-6 d-none d-md-block">
						<ul class="page-breadcrumbs">
							<li class="item"><a class="link" href="javascript:void(0)">Home</a> <i
									class="separator icofont-thin-right"></i></li>
							<li class="item"><a class="link" href="javascript:void(0)">Doctor</a> <i
									class="separator icofont-thin-right"></i></li>
							<li class="item"><a class="link" href="javascript:void(0)">Instant Cure</a> <i
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
<div aria-hidden="true" class="modal fade" id="report" role="dialog" tabindex="-1">
	<div class="modal-dialog  modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Report</h5></div>
			<form action="<?= base_url()?>doctor/report/ic_doctor" method="post" target="_blank">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-sm-6 offset-3">
							<div class="form-group">
								<label class="control-label">Time Period :</label>
								<div class="input-group daterange_btn">
									<button type="button" class="form-control d-flex justify-content-between" id="daterange_btn">
														<span>
														<i class="far fa-calendar-alt"></i> Choose Time Period
														</span>
										<i class="fa fa-caret-down"></i>
									</button>
									<input type="hidden" id="dp" name="time_period">
									<div class="input-group-append">
										<span class="form-control text-center" style="line-height: 25px;font-size: 20px;cursor: pointer;border-top-left-radius: 0;border-bottom-left-radius: 0" id="clear_date"><i class="fa fa-times"></i></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer d-block">
					<div class="actions justify-content-between">
						<button class="btn btn-error" data-dismiss="modal" type="button">Close</button>
						<button class="btn btn-success" type="submit">Generate</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div><!-- end Add appointment modals -->
<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.typeahead.min.js"></script>
<script src="<?= base_url() ?>assets/js/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-select.min.js"></script>
<!-- Daterange JS -->
<script src="<?= base_url() ?>assets/plugins/daterangepicker/js/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/js/daterangepicker.js"></script>
<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/time-picker/mdtimepicker.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>

<script>
	$("#data-table").DataTable();
	$("#start").on('click', function () {
		$.ajax({
			url: '<?= base_url()?>doctor/instantCure/start'
		});

		window.location = '<?= base_url()?>doctor/chat';
	});
</script>
<script>

	var dt = moment();
	var sDate = '';
	var eDate = '';
	if (dt.format('M') > 3){
		sDate =  dt.format('YYYY') + '-04-01';
		eDate =  (parseFloat(dt.format('YYYY'))+1) + '-03-31';
	} else {
		sDate =  (parseFloat(dt.format('YYYY'))-1) + '-04-01';
		eDate =  dt.format('YYYY') + '-03-31';
	}
	$('#daterange_btn').daterangepicker({
			ranges: {
				'All': [moment('01-01-2019'),moment()],
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
				'Yearly': [moment(sDate), moment(eDate)]
			},
			startDate: moment().subtract(29, 'days'),
			endDate: moment()
		},
		function (start, end) {
			$('#daterange_btn span').html(start.format('D/M/Y') + ' - ' + end.format('D/M/Y'));
			$("#dp").val(start.format('D-M-Y') + '/' + end.format('D-M-Y'));
		}
	);

	$("#clear_date").on('click',function () {
		$("#dp").val('');
		var html1='';
		html1 +='<span>';
		html1 +='<i class="far fa-calendar-alt"></i> Choose Time Period';
		html1 +='</span>';
		html1 +='<i class="fa fa-caret-down"></i>';
		$("#daterange_btn").html(html1);
	});


</script>

</body>
</html>
