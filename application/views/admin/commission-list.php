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
	<!-- Daterange CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/css/daterangepicker.css">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">
	<link href="<?= base_url() ?>assets/css/styleMedic.css?version=6" rel="stylesheet">
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
		include "sidebar.php"
		?>

		<main class="main-content">
			<div class="app-loader"><i class="icofont-spinner-alt-4 rotate"></i></div>
			<div class="main-content-wrap">
				<header class="page-header">
					<h1 class="page-title">Commission</h1>
					<button type="button" class="btn btn-primary rounded-pill" style="height: 50px;width: 50px;font-size: 16px;"  data-target="#report" data-toggle="modal"><span class="btn-icon icofont-file-alt"></button>
				</header>
				<div class="page-content">
					<div class="card mb-0">
						<div class="card-body">
							<div class="table-responsive">

								<table class="table" id="data-table">
									<thead>
										<tr>
											<th width="15%">Commission Transaction Id</th>
											<th>User Type</th>
											<th>User Name</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($list as $item)
										{
											?>
											<tr>
												<td><?= $item['ctId']?></td>
												<td><?= $item['userType']?></td>
												<td><?= $item['username']?></td>
												<td><?= $item['total']?></td>
												<td><button class="btn btn-info btn-sm btn-square rounded-pill view-commission" data-crid="<?= $item['ctId'] ?>" data-target="#view-commission" data-toggle="modal">
														<span class="btn-icon icofont-eye-alt"></span></button></td>
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
							<li class="item"><a class="link" href="javascript:void(0)">Commission</a> <i
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
	<div aria-hidden="true" class="modal fade" id="report" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-lg modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header"><h5 class="modal-title">Report</h5></div>
				<form action="<?= base_url()?>admin/report/commission" method="post" target="_blank">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6 col-sm-6 offset-3">
								<div class="form-group">
									<label class="control-label">Type :</label>
									<select id="type" name="type" class="form-control selectpicker">
										<option value="0">Select</option>
										<option value="1">All</option>
										<option value="2">User wise</option>
									</select>
								</div>
								<div class="form-group d-none" id="typeList">
									<label class="control-label">User Type :</label>
									<select class="form-control selectpicker" name="userType" id="userType">
										<option value="0">Select</option>
										<option value="1">Doctor</option>
										<option value="2">Pharmacist</option>
									</select>
								</div>
								<div class="form-group d-none" id="userList">
									<label class="control-label">Select User :</label>
									<select class="form-control selectpicker" name="userId" id="userId" data-live-search="true">

									</select>
								</div>
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

	<div aria-hidden="true" class="modal fade" id="view-commission" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header"><h5 class="modal-title">Commission List</h5></div>
				<div class="modal-body">
					<h6 class="m-0">User Type &nbsp;&nbsp;&nbsp;: <span id="userTp"></span></h6>
					<h6 class="mt-0">User Name &nbsp;: <span id="username"></span></h6>

					<div id="data"></div>
				</div>
				<div class="modal-footer d-block">
					<div class="actions justify-content-between">
						<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
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
		$("#data-table").DataTable();

		$(".view-commission").on('click', function () {
			const ctId	=	$(this).data('crid');
			fetchCommission(ctId);
		});
		// fetchCommission();
		async function fetchCommission(ctId) {
			const response = await fetch('<?= base_url()?>admin/Commission/commissionList/' + ctId);
			const myJson = await response.json();
			$("#userTp").text(myJson.type);
			$("#username").text(myJson.username);
			let html = '';
			html += '<table class="table data-table">\n' +
				'<thead>\n' +
				'<tr>\n' +
				'<th scope="col" width="30%">Commission Transaction Id</th>\n' +
				'<th scope="col">Amount</th>\n' +
				'<th scope="col">Date</th>\n' +
				'</tr>\n' +
				'</thead>\n' +
				'<tbody>';
			for (let i = 0; i < myJson['list'].length; i++) {

				html += '<tr>\n' +
					'<td>'+ myJson['list'][i].ctId+'</td>\n' +
					'<td>'+ myJson['list'][i].amount+'</td>\n' +
					'<td>'+ myJson['list'][i].datetime+'</td>\n' +
					'</tr>';
			}
			html += '</tbody></table>';
			$("#data").html(html);
			console.log(html);
			// $(".data-table").DataTable();
		}

		$("#type").on('change', function () {
			let type = $(this).val();
			if (type == 2){
				$("#typeList").removeClass('d-none');
			} else{
				$("#typeList").addClass('d-none');
			}

		});

		$("#userType").on('change', function () {
			let type = $(this).val();
			if (type!=0){
				$.ajax({
					url: '<?= base_url()?>admin/commission/fetchCommissionUser',
					method:'post',
					data:{
						userType:type
					},
					dataType: 'json',
					success:function (data) {
						$('#userId')
							.empty()
							.append($("<option></option>")
								.attr("value" , '')
								.text("--Select--"))
							.append($("<option></option>")
								.attr("value" , 0)
								.text("All"));
						$.each(data , function (key , value) {
							$('#userId')
								.append($("<option></option>")
									.attr("value" , value.userId)
									.text(value.username));
						});

						$('.selectpicker').selectpicker('refresh');
					}
				});
				$("#userList").removeClass('d-none');
			} else {
				$("#userList").addClass('d-none');
			}
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
