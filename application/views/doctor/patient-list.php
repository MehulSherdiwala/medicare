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
	<link href="<?= base_url() ?>assets/css/datatables.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/bootstrap-select.min.css" rel="stylesheet">
	<!-- Daterange CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/css/daterangepicker.css">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">
	<!-- Theme CSS -->
	<link href="<?= base_url() ?>assets/css/styleMedic.css?version=5" rel="stylesheet">
	<style>
		span.form-control{
			min-height: 40px!important;
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
					<h1 class="page-title">Patients</h1>
					<button type="button" class="btn btn-primary rounded-pill" style="height: 50px;width: 50px;font-size: 16px;"  data-target="#report" data-toggle="modal"><span class="btn-icon icofont-file-alt"></button>
				</header>
				<div class="page-content">
					<div class="card mb-0">
						<div class="card-body">
							<div class="table-responsive" id="data">
								<table class="table" id="dataTable">
									<thead>
										<tr>
											<th>Patient Name</th>
											<th>Patient Email</th>
											<th>Patient Phone No</th>
											<th>Gender</th>
											<?php
												if ($_SESSION['dptId'] != 2)
												{
													?>
													<th></th>
													<?php
												}
											?>
										</tr>
									</thead>
									<tbody>
									<?php
									foreach ($patient as $item)
									{
										?>
											<tr>
												<td><?= $item['username'] ?></td>
												<td><?= $item['email'] ?></td>
												<td><?= $item['phone'] ?></td>
												<td><?= $item['gender'] ?></td>
												<?php
												if ($_SESSION['dptId'] != 2)
												{
													?>
													<td><div class="actions">
															<a href="<?= base_url()?>doctor/patient/records/<?= $item['pmrId'] ?>" class="btn btn-info btn-sm btn-square rounded-pill <?= (($item['pmrId']==0)? 'disabled': '') ?> " >
																<span class="btn-icon icofont-patient-file"></span></a></td>
													<?php
												}
												?>

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
		</main>
		<div class="app-footer">
			<div class="footer-wrap">
				<div class="row h-100 align-items-center">
					<div class="col-12 col-md-6 d-none d-md-block">
						<ul class="page-breadcrumbs">
							<li class="item"><a class="link" href="javascript:void(0)">Home</a> <i
									class="separator icofont-thin-right"></i></li>
							<li class="item"><a class="link" href="javascript:void(0)">Patient</a> <i
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
			<form action="<?= base_url()?>doctor/report/patient" method="post" target="_blank">
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

<div aria-hidden="true" class="modal fade" id="view-patient" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Patient Details</h5></div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Patient Id</label>
							<span class="form-control" id="docId"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Name</label>
							<span class="form-control" id="name"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Email ID</label>
							<span class="form-control" id="email"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Joining Date</label>
							<span class="form-control" id="joindate"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">status</label>
							<span class="form-control" id="status"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Pincode</label>
							<span class="form-control" id="pincode"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Address</label>
							<span class="form-control" id="address"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">State</label>
							<span class="form-control" id="state"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">City</label>
							<span class="form-control" id="city"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Description</label>
							<span class="form-control" id="description"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Close</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- end Add appointment modals -->
<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-select.min.js"></script>
<!-- Daterange JS -->
<script src="<?= base_url() ?>assets/plugins/daterangepicker/js/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/js/daterangepicker.js"></script>
<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script>
	$("#dataTable").DataTable();

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
