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
					<h1 class="page-title">Medicine Sales</h1>
					<button type="button" class="btn btn-primary rounded-pill" style="height: 50px;width: 50px;font-size: 16px;"  data-target="#report" data-toggle="modal"><span class="btn-icon icofont-file-alt"></button>
				</header>
				<div class="page-content">
					<div class="card mb-0">
						<div class="card-body">
							<div class="table-responsive" id="data">
								<table class="table" id="data-table">
									<thead>
									<tr>
										<th>Order Id</th>
										<th>Patient Name</th>
										<th>Total Items</th>
										<th>Date</th>
										<th>Delivery Address</th>
										<th>Total Amount</th>
										<th>Payment Method</th>
										<th>Status</th>
										<th width="80px"></th>
									</tr>
									</thead>
									<tbody>
									<?php
									foreach ($sales as $sale)
									{
										?>
										<tr>
											<td><?= $sale['orderId']?></td>
											<td><?= $sale['name']?></td>
											<td><?= $sale['totalItems']?></td>
											<td><?= $sale['date']?></td>
											<td><?= $sale['daAddress']?></td>
											<td><?= $sale['totalAmount']?></td>
											<td><?= $sale['payMethod']?></td>
											<td><?= $sale['status']?></td>
											<td>
												<button class="btn btn-info btn-sm btn-square rounded-pill view-order" data-orderid="<?= $sale['orderId']?>" data-target="#view-order" data-toggle="modal">
													<span class="btn-icon icofont-eye-alt"></span></button>
												<button class="btn btn-success btn-sm btn-square rounded-pill update-status" data-orderid="<?= $sale['orderId']?>" data-target="#update-status" data-toggle="modal">
													<span class="btn-icon icofont-edit-alt"></span></button>
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
		</main>
		<div class="app-footer">
			<div class="footer-wrap">
				<div class="row h-100 align-items-center">
					<div class="col-12 col-md-6 d-none d-md-block">
						<ul class="page-breadcrumbs">
							<li class="item"><a class="link" href="javascript:void(0)">Home</a> <i
									class="separator icofont-thin-right"></i></li>
							<li class="item"><a class="link" href="javascript:void(0)">Pharmacist</a> <i
									class="separator icofont-thin-right"></i></li>
							<li class="item"><a class="link" href="javascript:void(0)">Medicine</a> <i
									class="separator icofont-thin-right"></i></li>
							<li class="item"><a class="link" href="javascript:void(0)">Sales</a> <i
									class="separator icofont-thin-right"></i></li>
						</ul>
					</div>
					<div class="col-12 col-md-6 text-right">
						<div class="d-flex align-items-center justify-content-center justify-content-md-end"><span>Version 1.0.0</span>
							<button class="no-style ml-2 settings-btn" data-target="#settings" data-toggle="modal"><span
									class="icon icofont-ui-settings text-primary"></span></button>
						</div>
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
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Report</h5></div>
			<form action="<?= base_url()?>admin/report/sales" method="post" target="_blank">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-sm-6 offset-3">
							<div class="form-group">
								<label class="control-label">Type :</label>
								<select id="type" name="type" class="form-control selectpicker">
									<option value="0">Select</option>
									<option value="1">Overall</option>
									<option value="2">Pharmacist wise</option>
									<option value="3">User wise</option>
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

<div aria-hidden="true" class="modal fade" id="update-status" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered ">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Update Status</h5></div>
			<div class="modal-body">
				<form action="<?= base_url()?>admin/sales/updateStatus" method="post" id="subForm">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Order Id</label>
								<span id="newOrderId" class="form-control"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Status</label>
								<input type="text" name="status" id="newStatus" class="form-control">
								<input type="hidden" name="orderId" id="oId" >
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
					<button class="btn btn-info" type="button" id="update">Update Status</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- end Add appointment modals -->
<div aria-hidden="true" class="modal fade" id="view-order" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Order Details</h5></div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Order Id</label>
							<span class="form-control" id="orderId"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Date</label>
							<span class="form-control" id="date"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Total Amount</label>
							<span class="form-control" id="totalAmount"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Payment Method</label>
							<span class="form-control" id="payMethod"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Status</label>
							<span class="form-control" id="status"></span>
						</div>
					</div>
				</div>

				<h4>Patient Details</h4>
				<hr>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Patient Name</label>
							<span class="form-control" id="name"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Phone No</label>
							<span class="form-control" id="phone"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Address</label>
							<span class="form-control" id="address"></span>
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


				<h4>Item Details</h4>
				<hr>
				<div class="row">
					<div class="col-md-12" id="items">
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
	$("#data-table").DataTable();

	$(".view-order").on('click', function () {
		const id = $(this).data('orderid');
		fetchDetails(id);
	});

	// fetchDisease();
	async function fetchDetails(id) {
		const response = await fetch('<?= base_url()?>admin/sales/details/'+ id);
		const myJson = await response.json();

		console.log(myJson[2]);

		$("#orderId").text(myJson[0]['orderId']);
		$("#date").text(myJson[0]['date']);
		$("#totalAmount").text(myJson[0]['totalAmount']);
		$("#payMethod").text(myJson[0]['payMethod']);
		$("#status").text(myJson[0]['status']);

		$("#name").text(myJson[1]['name']);
		$("#phone").text(myJson[1]['phone']);
		$("#address").text(myJson[1]['address']);
		$("#pincode").text(myJson[1]['pincode']);
		$("#state").text(myJson[1]['state']);
		$("#city").text(myJson[1]['city']);

		let html = '';
		html += '<table class="table" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">Medicine Id</th>\n' +
			'<th scope="col">Medicine Name</th>\n' +
			'<th scope="col">Medicine Description</th>\n' +
			'<th scope="col">Quantity</th>\n' +
			'<th scope="col">Price</th>\n' +
			'<th scope="col">Dose</th>\n' +
			'<th scope="col">Capacity</th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < myJson[2].length; i++) {

			html += '<tr>\n' +
				'<td>'+ myJson[2][i].medId+'</td>\n' +
				'<td>'+ myJson[2][i].medName+'</td>\n' +
				'<td>'+ myJson[2][i].medDescription+'</td>\n' +
				'<td>'+ myJson[2][i].qty+'</td>\n' +
				'<td>'+ myJson[2][i].price+'</td>\n' +
				'<td>'+ myJson[2][i].dose+'</td>\n' +
				'<td>'+ myJson[2][i].capacity+'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#items").html(html);
	}

	$(".update-status").on('click', function () {
		const id = $(this).data('orderid');

		$.ajax({
			url:'<?= base_url()?>admin/sales/getStatus/'+id,
			success:function (data) {
				let obj = JSON.parse(data);
				$("#newOrderId").text(obj.orderId);
				$("#oId").val(obj.orderId);
				$("#newStatus").val(obj.status);
			}
		})
	});
	$("#update").on('click', function () {
		$("#subForm").submit();
	});

	$("#type").on('change', function () {
		let type = $(this).val();
		if (type==3 || type==2){
			$.ajax({
				url: '<?= base_url()?>admin/sales/fetchUserList',
				method: 'post',
				data: {
					type:type
				},
				dataType: 'json',
				success:function (data) {
					$('#userId')
						.empty()
						.append($("<option></option>")
							.attr("value" , 0)
							.text("-- Select --"));
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
