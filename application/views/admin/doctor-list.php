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
					<h1 class="page-title">Doctors</h1>
					<div>
						<button type="button" class="btn btn-primary rounded-pill" style="height: 50px;width: 50px;font-size: 16px;"  data-target="#ic-report" data-toggle="modal"><span class="btn-icon icofont-headphone-alt"></button>
						&nbsp;&nbsp;
						<button type="button" class="btn btn-primary rounded-pill" style="height: 50px;width: 50px;font-size: 16px;"  data-target="#report" data-toggle="modal"><span class="btn-icon icofont-file-alt"></button>
					</div>
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
							<li class="item"><a class="link" href="javascript:void(0)">Doctor</a> <i
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
<div aria-hidden="true" class="modal fade" id="ic-report" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Instant Cure Report</h5></div>
			<form action="<?= base_url()?>admin/report/ic_doctor" method="post" target="_blank">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-sm-6 offset-3">
							<div class="form-group">
								<label class="control-label">Type :</label>
								<select id="ictype" name="type" class="form-control selectpicker">
									<option value="0">Select</option>
									<option value="1">All</option>
									<option value="2">Doctor Wise</option>
								</select>
							</div>
							<div class="form-group d-none" id="icdocList">
								<label class="control-label">Select Doctor</label>
								<select class="form-control selectpicker" name="docId" id="icdoc" data-live-search="true">
									<option value="0">Select</option>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">Time Period :</label>
								<div class="input-group daterange_btn">
									<button type="button" class="form-control d-flex justify-content-between" id="daterange_btn2">
														<span>
														<i class="far fa-calendar-alt"></i> Choose Time Period
														</span>
										<i class="fa fa-caret-down"></i>
										<input type="hidden" id="dp2" name="time_period">
									</button>
									<div class="input-group-append">
										<span class="form-control text-center" style="line-height: 25px;font-size: 20px;cursor: pointer;border-top-left-radius: 0;border-bottom-left-radius: 0" id="clear_date2"><i class="fa fa-times"></i></span>
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
<div aria-hidden="true" class="modal fade" id="report" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Report</h5></div>
			<form action="<?= base_url()?>admin/report/doctor" method="post" target="_blank">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-sm-6 offset-3">
							<div class="form-group">
								<label class="control-label">User Type :</label>
								<select id="type" name="type" class="form-control selectpicker">
									<option value="0">Select</option>
									<option value="1">Doctor</option>
									<option value="2">Patient</option>
								</select>
							</div>
							<div class="form-group d-none" id="docList">
								<label class="control-label">Select Doctor</label>
								<select class="form-control selectpicker" name="docId" id="doc" data-live-search="true">
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
			<div class="modal-header"><h5 class="modal-title">Doctor Details</h5></div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Doctor Id</label>
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
							<label for="">Gender</label>
							<span class="form-control" id="gender"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Doctor Type</label>
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
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Experience</label>
							<span class="form-control" id="experience"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Estimated Time</label>
							<span class="form-control" id="estimatedTime"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Specialization</label>
							<span class="form-control" id="specialization"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Joining Date</label>
							<span class="form-control" id="joindate"></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">status</label>
							<span class="form-control" id="status"></span>
						</div>
					</div>
				</div>
				<div id="qfsec" class="d-none">
					<h4>Qualification</h4>
					<hr>
					<div id="qualification"></div>
				</div>
				<div id="clinic" class="d-none">
					<h4>Clinic Details</h4>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Clinic Id</label>
								<span class="form-control" id="clinicId"></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Clinic Name</label>
								<span class="form-control" id="clinicName"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Description</label>
								<span class="form-control" id="clinicDescription"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Address</label>
								<span class="form-control" id="clinicAddress"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Pincode</label>
								<span class="form-control" id="clinicPincode"></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">State</label>
								<span class="form-control" id="clinicState"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">City</label>
								<span class="form-control" id="clinicCity"></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Status</label>
								<span class="form-control" id="clinicStatus"></span>
							</div>
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
			<div class="modal-header"><h5 class="modal-title">Edit Doctor</h5></div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">Doctor Id</label>
					<span class="form-control" id="editdocId"></span>
				</div>
				<div class="form-group">
					<label for="">Doctor Name</label>
					<span class="form-control" id="editname"></span>
				</div>
				<div class="form-group">
					<label for="">Doctor Status</label>
					<select id="docStatus" class="selectpicker">
						<option value="">Select</option>
						<option value="0">Not Verified</option>
						<option value="1">Verified</option>
						<option value="2">Preferred</option>
					</select>
				</div>
				<div id="editClinic" class="d-none">
					<h4>Clinic Details</h4>
					<hr>
					<div class="form-group">
						<label for="">Clinic Id</label>
						<span class="form-control" id="editclinicId"></span>
					</div>
					<div class="form-group">
						<label for="">Clinic Name</label>
						<span class="form-control" id="editclinicName"></span>
					</div>
					<div class="form-group">
						<label for="">Clinic Status</label>
						<select id="editclinicStatus" class="selectpicker">
							<option value="">Select</option>
							<option value="0">Pending</option>
							<option value="1">Approved</option>
							<option value="2">Rejected</option>
						</select>
					</div>
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
	fetchDoctor();
	async function fetchDoctor() {
		const response = await fetch('<?= base_url()?>admin/Doctor/fetchDoctorList');
		const myJson = await response.json();
		let html = '';
		html += '<table class="table" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">Doctor Id</th>\n' +
			'<th scope="col">Doctor Name</th>\n' +
			'<th scope="col">Email</th>\n' +
			'<th scope="col">Address</th>\n' +
			'<th scope="col">JoinDate</th>\n' +
			'<th scope="col">Clinic Name</th>\n' +
			'<th scope="col">Profile</th>\n' +
			'<th scope="col">Status</th>\n' +
			'<th scope="col"></th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < myJson.length; i++) {

			html += '<tr>\n' +
				'<td>'+ myJson[i].docId+'</td>\n' +
				'<td>'+ myJson[i].username+'</td>\n' +
				'<td>'+ myJson[i].email+'</td>\n' +
				'<td>'+ myJson[i].address+'</td>\n' +
				'<td>'+ myJson[i].joindate+'</td>\n' +
				'<td>'+ myJson[i].clinicName+'</td>\n' +
				'<td>'+ ((myJson[i].profile == 0) ? '<span class="badge badge-success">Completed</span>' : '<span class="badge badge-danger">Pending</span>' ) +'</td>\n' +
				'<td>'+ ((myJson[i].status == 0) ? '<span class="badge badge-danger">Not Verified</span>' : ((myJson[i].status == 1) ? '<span class="badge badge-success">Verified</span>' : '<span class="badge badge-warning">Preferred</span>' ) )+'</td>\n' +
				'<td>\n' +
				'<div class="actions">\n' +
				'<button class="btn btn-info btn-sm btn-square rounded-pill edit-doctor" data-docid="'+ myJson[i].docId+'" data-target="#edit-doctor" data-toggle="modal"><span\n' +
				'class="btn-icon icofont-ui-edit"></span></button>\n' +
				'<button class="btn btn-success btn-sm btn-square rounded-pill view-doctor" data-docid="'+ myJson[i].docId+'" data-target="#view-doctor" data-toggle="modal"><span\n' +
				'class="btn-icon icofont-eye-alt"></span></button>\n' +
				'</div>\n' +
				'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#data").html(html);
		$("#data-table").DataTable();

		$(".view-doctor").on('click',function () {
			const docId = $(this).data("docid");
			console.log((docId));
			viewDoc(docId);
		});

		$(".edit-doctor").on('click',function () {
			const docId = $(this).data("docid");
			// const docStatus = $("#docStatus").val();
			fetchDoc(docId);
		});
	}

	async function fetchDoc(id) {
		const response = await fetch('<?= base_url()?>admin/Doctor/fetchDoc/'+ id);
		const myJson = await response.json();

		console.log(myJson);
		$("#editdocId").text(myJson.doctor.docId);
		$("#editname").text(myJson.doctor.username);
		$("#docStatus>option[value=" + myJson.doctor.status + "]").prop("selected" , true);

		if(myJson.clinic.length != 0) {
			$("#editClinic").removeClass('d-none');
			$("#editclinicId").text(myJson.clinic.clinicId);
			$("#editclinicName").text(myJson.clinic.clinicName);
			$("#editclinicStatus>option[value=" + myJson.clinic.status + "]").prop("selected" , true).change();
		} else {
			$("#editClinic").addClass('d-none');
		}
		$('.selectpicker').selectpicker('refresh');

	}

	$(".view-doctor").on('click',function () {
		const docId = $(this).data("docid");
		// console.log((docId));
		viewDoc(docId);
	});

	async function viewDoc(id) {
		const response = await fetch('<?= base_url()?>admin/Doctor/doctorDetail/' + id);
		const myJson = await response.json();
		// console.log(myJson);

		$("#docId").text(myJson.doctor.docId);
		$("#name").text(myJson.doctor.username);
		$("#email").text(myJson.doctor.email);
		$("#gender").text(myJson.doctor.gender);
		$("#dpType").text(myJson.doctor.dpType);
		$("#pincode").text(myJson.doctor.pincode);
		$("#address").text(myJson.doctor.address);
		$("#state").text(myJson.doctor.stateName);
		$("#city").text(myJson.doctor.cityName);
		$("#description").text(myJson.doctor.description);
		$("#experience").text(myJson.doctor.experience);
		$("#estimatedTime").text(myJson.doctor.estimatedTime);
		$("#joindate").text(myJson.doctor.joindate);
		$("#status").text(myJson.doctor.status);
		$("#specialization").text(myJson.doctor.specialization);

		if(myJson.clinic.length != 0){
			$("#clinic").removeClass('d-none');
			$("#clinicId").text(myJson.clinic.clinicId);
			$("#clinicName").text(myJson.clinic.clinicName);
			$("#clinicDescription").text(myJson.clinic.clinicDescription);
			$("#clinicAddress").text(myJson.clinic.clinicAddress);
			$("#clinicPincode").text(myJson.clinic.clinicPincode);
			$("#clinicState").text(myJson.clinic.clinicState);
			$("#clinicCity").text(myJson.clinic.clinicCity);
			$("#clinicStatus").text(myJson.clinic.status);
		} else {
			$("#clinic").addClass('d-none');
		}

		if (myJson.qualification.length != 0)
		{
			$("#qfsec").removeClass('d-none');

			let html = '<table class="table">' +
				'<tr>' +
				'<th>Degree</th>' +
				'<th>University</th>' +
				'<th>Passing Year</th>' +
				'</tr>';

			for (let i = 0;i < myJson.qualification.length; i++)
			{
				html +='<tr>' +
					'<td>' + myJson.qualification[i].degree + '</td>' +
					'<td>' + myJson.qualification[i].university + '</td>' +
					'<td>' + myJson.qualification[i].year + '</td>' +
					'</tr>';
			}
			html += '</table>';

			$("#qualification").html(html);
		} else {
			$("#qfsec").addClass('d-none');
		}


	}

	$("#editDoc").on('click', function () {
		const docId = $("#editdocId").text();
		const docStatus = $("#docStatus").val();
		const clinicId = $("#editclinicId").text();
		const editclinicStatus = $("#editclinicStatus").val();

		$.ajax({
			url: '<?= base_url()?>admin/doctor/updateStatus' ,
			method: 'post',
			data: {
				docId:docId,
				docStatus:docStatus,
				clinicId:clinicId,
				clinicStatus:editclinicStatus,
			},
			success:function (data) {
				fetchDoctor();
			}
		})

	});

	$("#type").on('change', function () {
		let type = $(this).val();
		if (type==2){
			$.ajax({
				url: '<?= base_url()?>admin/Doctor/fetchDoctorList',
				dataType: 'json',
				success:function (data) {
					$('#doc')
						.empty()
						.append($("<option></option>")
							.attr("value" , 0)
							.text("--Select Doctor--"));
					$.each(data , function (key , value) {
						$('#doc')
							.append($("<option></option>")
								.attr("value" , value.docId)
								.text(value.username));
					});

					$('.selectpicker').selectpicker('refresh');
				}
			});
			$("#docList").removeClass('d-none');
		} else {
			$("#docList").addClass('d-none');
		}
	});

	$("#ictype").on('change', function () {
		let type = $(this).val();
		if (type==2){
			$.ajax({
				url: '<?= base_url()?>admin/Doctor/fetchICDoctorList',
				dataType: 'json',
				success:function (data) {
					$('#icdoc')
						.empty()
						.append($("<option></option>")
							.attr("value" , 0)
							.text("--Select Doctor--"));
					$.each(data , function (key , value) {
						$('#icdoc')
							.append($("<option></option>")
								.attr("value" , value.docId)
								.text(value.username));
					});

					$('.selectpicker').selectpicker('refresh');
				}
			});
			$("#icdocList").removeClass('d-none');
		} else {
			$("#icdocList").addClass('d-none');
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

	$('#daterange_btn2').daterangepicker({
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
			$('#daterange_btn2 span').html(start.format('D/M/Y') + ' - ' + end.format('D/M/Y'));
			$("#dp2").val(start.format('D-M-Y') + '/' + end.format('D-M-Y'));
		}
	);

	$("#clear_date2").on('click',function () {
		$("#dp2").val('');
		var html1='';
		html1 +='<span>';
		html1 +='<i class="far fa-calendar-alt"></i> Choose Time Period';
		html1 +='</span>';
		html1 +='<i class="fa fa-caret-down"></i>';
		$("#daterange_btn2").html(html1);
	});

</script>
</body>
</html>
