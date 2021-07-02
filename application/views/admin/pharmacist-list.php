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
	<link href="<?= base_url() ?>assets/css/styleMedic.css?version=6" rel="stylesheet">
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
					<h1 class="page-title">Pharmacist</h1>
					<button type="button" class="btn btn-primary rounded-pill" style="height: 50px;width: 50px;font-size: 16px;"  data-target="#report" data-toggle="modal"><span class="btn-icon icofont-file-alt"></button>
				</header>
				<div class="page-content">
					<div class="card mb-0">
						<div class="card-body">
							<div class="table-responsive" id="data">

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
			<form action="<?= base_url()?>admin/report/pharmacist" method="post" target="_blank">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-sm-6 offset-3">
							<div class="form-group">
								<label class="control-label">User Type :</label>
								<select id="type" name="type" class="form-control selectpicker">
									<option value="0">Select</option>
									<option value="1">Overall</option>
									<option value="2">Pharmacist Wise</option>
								</select>
							</div>
							<div class="form-group d-none" id="pharList">
								<label class="control-label">Select Pharmacist</label>
								<select class="form-control selectpicker" name="pharId" id="phar" data-live-search="true">
									<option value="0">Select</option>
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
<div aria-hidden="true" class="modal fade" id="view-doctor" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Pharmacist Details</h5></div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Pharmacist Id</label>
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
							<label for="">Pharmacist Type</label>
							<span class="form-control" id="dpType"></span>
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
				<div class="row">
					<div class="col-md-6 offset-3">
						<div class="form-group">
							<label for="">status</label>
							<span class="form-control" id="status"></span>
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
<div aria-hidden="true" class="modal fade" id="edit-doctor" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Edit Pharmacist</h5></div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Pharmacist Id</label>
					<span class="form-control" id="editdocId"></span>
				</div>
				<div class="form-group">
					<label for="">Pharmacist Name</label>
					<span class="form-control" id="editname"></span>
				</div>
				<div class="form-group">
					<label for="">Pharmacist Status</label>
					<select id="docStatus" class="selectpicker">
						<option value="">Select</option>
						<option value="0">Not Verified</option>
						<option value="1">Verified</option>
						<option value="2">Preferred</option>
					</select>
				</div>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
					<button class="btn btn-info" data-dismiss="modal" type="button" id="editDoc">Update</button>
				</div>
			</div>
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
<script src="<?= base_url() ?>assets/js/main.js"></script>

<script>
	fetchPhar();
	async function fetchPhar() {
		const response = await fetch('<?= base_url()?>admin/Pharmacist/fetchPharmacistList');
		const myJson = await response.json();
		let html = '';
		html += '<table class="table" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">Pharmacist Id</th>\n' +
			'<th scope="col">Pharmacist Name</th>\n' +
			'<th scope="col">Email</th>\n' +
			'<th scope="col">Address</th>\n' +
			'<th scope="col">JoinDate</th>\n' +
			'<th scope="col">Total Medicine</th>\n' +
			'<th scope="col">Profile</th>\n' +
			'<th scope="col">Status</th>\n' +
			'<th scope="col"></th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < myJson.length; i++) {

			html += '<tr>\n' +
				'<td>'+ myJson[i].pharId+'</td>\n' +
				'<td>'+ myJson[i].username+'</td>\n' +
				'<td>'+ myJson[i].email+'</td>\n' +
				'<td>'+ myJson[i].address+'</td>\n' +
				'<td>'+ myJson[i].joindate+'</td>\n' +
				'<td>'+ myJson[i].totalMed+'</td>\n' +
				'<td>'+ ((myJson[i].profile == 0) ? '<span class="badge badge-success">Completed</span>' : '<span class="badge badge-danger">Pending</span>' ) +'</td>\n' +
				'<td>'+ ((myJson[i].status == 0) ? '<span class="badge badge-danger">Not Verified</span>' : ((myJson[i].status == 1) ? '<span class="badge badge-success">Verified</span>' : '<span class="badge badge-warning">Preferred</span>' ) )+'</td>\n' +
				'<td>\n' +
				'<div class="actions">\n' +
				'<button class="btn btn-info btn-sm btn-square rounded-pill edit-doctor" data-pharid="'+ myJson[i].pharId+'" data-target="#edit-doctor" data-toggle="modal"><span\n' +
				'class="btn-icon icofont-ui-edit"></span></button>\n' +
				'<button class="btn btn-success btn-sm btn-square rounded-pill view-doctor" data-pharid="'+ myJson[i].pharId+'" data-target="#view-doctor" data-toggle="modal"><span\n' +
				'class="btn-icon icofont-eye-alt"></span></button>\n' +
				'</div>\n' +
				'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#data").html(html);
		$("#data-table").DataTable();

		$(".view-doctor").on('click',function () {
			const pharId = $(this).data("pharid");
			console.log((pharId));
			viewDoc(pharId);
		});

		$(".edit-doctor").on('click',function () {
			const pharId = $(this).data("pharid");
			// const docStatus = $("#docStatus").val();
			fetchDoc(pharId);
		});
	}

	async function fetchDoc(id) {
		const response = await fetch('<?= base_url()?>admin/pharmacist/fetchPhar/'+ id);
		const myJson = await response.json();

		console.log(myJson);
		$("#editdocId").text(myJson.pharId);
		$("#editname").text(myJson.username);
		$("#docStatus>option[value=" + myJson.status + "]").prop("selected" , true);

		$('.selectpicker').selectpicker('refresh');

	}

	$(".view-doctor").on('click',function () {
		const docId = $(this).data("pharid");
		// console.log((docId));
		viewDoc(docId);
	});

	async function viewDoc(id) {
		const response = await fetch('<?= base_url()?>admin/Pharmacist/pharmacistDetail/' + id);
		const myJson = await response.json();
		// console.log(myJson);

		$("#docId").text(myJson.pharId);
		$("#name").text(myJson.username);
		$("#email").text(myJson.email);
		$("#dpType").text(myJson.dpType);
		$("#pincode").text(myJson.pincode);
		$("#address").text(myJson.address);
		$("#state").text(myJson.stateName);
		$("#city").text(myJson.cityName);
		$("#description").text(myJson.description);
		$("#joindate").text(myJson.joindate);
		$("#status").text(myJson.status);

	}

	$("#editDoc").on('click', function () {
		const pharId = $("#editdocId").text();
		const pharStatus = $("#docStatus").val();

		$.ajax({
			url: '<?= base_url()?>admin/pharmacist/updateStatus' ,
			method: 'post',
			data: {
				pharId:pharId,
				pharStatus:pharStatus,
			},
			success:function (data) {
				fetchPhar();
			}
		});
	});

	$("#type").on('change', function () {
		let type = $(this).val();
		if (type==2){
			$.ajax({
				url: '<?= base_url()?>admin/Pharmacist/fetchPharmacistList',
				dataType: 'json',
				success:function (data) {
					$('#phar')
						.empty()
						.append($("<option></option>")
							.attr("value" , 0)
							.text("--Select Pharmacist--"));
					$.each(data , function (key , value) {
						$('#phar')
							.append($("<option></option>")
								.attr("value" , value.pharId)
								.text(value.username));
					});

					$('.selectpicker').selectpicker('refresh');
				}
			});
			$("#pharList").removeClass('d-none');
		} else {
			$("#pharList").addClass('d-none');
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
