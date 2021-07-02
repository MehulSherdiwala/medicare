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

	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/summernotes/summernote-bs4.css">

	<link href="<?= base_url() ?>assets/css/datatables.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/bootstrap-select.min.css" rel="stylesheet">
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
			box-shadow: 0 6px 10px rgba(0, 0, 0, 0.21);
			border-radius: 6px;
			border: 1px solid #e0d9d9;
			text-align: center;
			height: 470px;
			padding: 10px;
			overflow: auto;

		}
		.section #queue li img{
			max-width: 25%;
			float: left;
			margin-right: 15px;
		}
		.section #reportList li{
			background: rgba(173, 173, 173, 0.72);
			padding: 12px;
			height: 50px;
		}
		.section #reportList li button{
			position: absolute;
			right: 38px;
		}
		.section #queue li,
		.section #reportList li,
		.profile,
		.desc{
			background: #f1f1f1;
			padding: 7px;
			border-radius: 5px;
			margin-bottom: 5px;
		}

		.section #queue li{
			cursor: pointer;
			padding: 12px;
		}
		.profile{
			height: 80px;
			overflow: auto;
		}
		.profile img{
			float: left;
			max-width: 15%;
			margin-right: 10px;
		}
		.desc{
			height: 100px;
			overflow: auto;
		}
		.profileSec{
			display: inline-block;
		}

		.description p {
			margin: 0!important;
		}
		#spinner:not([hidden]) {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			z-index: 111;
			background: rgba(0, 0, 0, 0.15);
		}

		#spinner::after {
			content: "";
			width: 80px;
			height: 80px;
			border: 2px solid #f3f3f3;
			border-top: 3px solid #f25a41;
			border-radius: 100%;
			will-change: transform;
			animation: spin 1s infinite linear
		}

		@keyframes spin {
			from {
				transform: rotate(0deg);
			}
			to {
				transform: rotate(360deg);
			}
		}

		li.disabled{
			pointer-events: none;
		}

		.description .active,
		#preMed .active{
			display: block!important;
			animation: dn 0.5s linear;
		}
		@keyframes dn {
			from {
				opacity: 0;
			}
			to {
				opacity: 1;
			}
		}

		#preMed table td{
			background: rgba(173, 173, 173, 0.72);
		}
		#preMed table{
			border-collapse: separate;
		}

		#preMed table tr td:first-child{
			border-top-left-radius: 8px;
			border-bottom-left-radius: 8px;
		}

		#preMed table tr td:last-child{
			border-top-right-radius: 8px;
			border-bottom-right-radius: 8px;
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

<div hidden id="spinner"></div>
<!-- .main-loader -->
<div class="page-box">
	<div class="app-container"><!-- Horizontal navbar -->

		<?php
		include "sidebar.php"
		?>

		<main class="main-content m-0">
			<div class="app-loader"><i class="icofont-spinner-alt-4 rotate"></i></div>
			<div class="main-content-wrap">
				<form action="<?= base_url()?>doctor/checkup/data" method="post">
					<div class="row">
						<div class="col-12 col-md-12" >
							<header class="page-header"><h3 class="page-title" style="margin: 0 10px 1rem;">Patient Medical Record</h3></header>
							<div class="page-content">
								<div class="section">
									<div class="card mb-0">
										<div class="card-body text-left">
											<div class="profileSec w-100">
												<div class="profile  float-left " style="width: 40%">
													<img src="<?= base_url()?>profile/profile.png" alt="" id="profileImg" class="avatar-img rounded-circle">
													<h5 class="m-0"><span id="name">Mehul Sherdiwala</span></h5>
													<b>Age:</b> <span id="age">20</span>
													<b class="ml-4">Gender:</b> <span id="gender">Male</span>
												</div>
												<div class="profile float-right" style="width: 59%">
													<b>Date:</b> <span id="date"></span>
													<br>
													<span data-target="#add-description" data-toggle="modal">
														<b>Description:</b>
														<input type="hidden" id="pmrId" name="pmrId" value="0">
														<input type="hidden" id="appId" name="appId" value="0">
														<span id="desc">Description</span>
													</span>
												</div>
											</div>
											<div class="caseSec">
												<div class="row" style="margin: 0">
													<div style="width: 83%">
														<b>Case Description</b>
														<b class="ml-4">Date : </b><span id="caseDate"></span>
														<div class="description">
															<div class="desc">
															</div>
														</div>
													</div>
													<div style="margin-left: 10px;margin-top: 20px;text-align: right">
														<div class="reportsSec">
															<button type="button" class="btn btn-info"
																	data-target="#report"
																	data-toggle="modal"
																	id="fetchReport">
																<b>Medical Reports</b>
															</button>
															<input type="hidden" id="pmdId">
														</div>
													</div>
												</div>
											</div>
											<div class="preSec position-relative">
												<b>Medicine</b>
												<br>
												<label>Date :</label><span id="preDate">06-05-2020</span>
												<div class="pre">
													<div id="preMed">
														<table class="table">
															<tr>
																<td>
																	<select name="" id="" class="form-control selectpicker">
																		<option value="">Select Medicine</option>
																		<option value="">Select</option>
																		<option value="">Select</option>
																		<option value="">Select</option>
																	</select>
																</td>
																<td width="150px">
																	<input type="number" class="form-control" placeholder="Quantity">
																</td>
																<td width="270px">
																	<div class="d-flex justify-content-center">
																		<div class="custom-control custom-radio mb-3">
																			<input type="radio" class="custom-control-input" id="before" name="eat">
																			<label class="custom-control-label" for="before">Before</label>
																		</div> &nbsp;
																		<div class="custom-control custom-radio mb-3">
																			<input type="radio" class="custom-control-input" id="after" name="eat">
																			<label class="custom-control-label" for="after">After</label>
																		</div>
																	</div>
																	<div class="d-flex justify-content-center">
																		<div class="custom-control custom-checkbox mb-3">
																			<input type="checkbox" class="custom-control-input" id="morning">
																			<label class="custom-control-label" for="morning">Morning</label>
																		</div> &nbsp;
																		<div class="custom-control custom-checkbox mb-3">
																			<input type="checkbox" class="custom-control-input" id="non">
																			<label class="custom-control-label" for="non">Noon</label>
																		</div> &nbsp;
																		<div class="custom-control custom-checkbox mb-3">
																			<input type="checkbox" class="custom-control-input" id="night">
																			<label class="custom-control-label" for="night">Night</label>
																		</div>
																	</div>
																</td>
																<td width="70px">
																	<button class="btn btn-danger btn-sm btn-square rounded-pill remove"><span class="btn-icon icofont-close"></span></button>
																</td>
															</tr>
														</table>
													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="pageSec d-flex justify-content-center mt-4">
								<nav>
									<ul class="pagination d-flex justify-content-center" id="pagination">
										<li class="page-item disabled">
											<a aria-disabled="true" aria-label="Previous"
											   class="page-link" href="#"
											   tabindex="-1">
												<span class="icofont-simple-left"></span>
											</a>
										</li>
										<li aria-current="page" class="page-item active"><a class="page-link"
																							href="#">1</a>
										</li>
										<li class="page-item"><a class="page-link" href="#">2</a></li>
										<li class="page-item"><a class="page-link" href="#">3</a></li>
										<li class="page-item"><a aria-label="Next" class="page-link"
																 href="#"><span
													class="icofont-simple-right"></span></a></li>
									</ul>
									<ul class="pagination d-flex justify-content-center mt-1" id="casePagination">
										<li class="page-item disabled">
											<a aria-disabled="true" aria-label="Previous"
											   class="page-link" href="#"
											   tabindex="-1">
												<span class="icofont-simple-left"></span>
											</a>
										</li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</form>
			</div>
		</main>
		<div class="content-overlay"></div>
	</div>
</div>
<div aria-hidden="true" class="modal fade" id="report" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Patient Report</h5></div>
			<div class="modal-body">
				<div class="section h-auto overflow-hidden">
					<ul id="reportList" class="list-unstyled text-left">
					</ul>
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
<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/time-picker/mdtimepicker.js"></script>
<script src="<?= base_url() ?>assets/plugins/summernotes/summernote-bs4.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script>
	let hashes = window.location.href;
	let index = hashes.lastIndexOf('/');
	let pmrId = hashes.substring(index+1);


	const list_element = $('#preMed');
	const pagination_element = $('#pagination');
	const casePagination = $('#casePagination');

	let current_page = 1;
	let current_case = 1;

	fetchDetails(pmrId);

	async function fetchDetails(pmrId){
		const response = await fetch('<?= base_url()?>doctor/patient/fetchFileDetails/' + pmrId);
		const data = await response.json();

		$("#date").text(data.pmr.datetime);
		$("#desc").text(data.pmr.pmrDescription);
		$("#name").text(data.patient.name);
		$("#age").text(data.patient.age);
		$("#gender").text(data.patient.gender);
		$("#profileImg").attr('src','<?= base_url()?>profile/' + ((data.patient.profileImg == "")? 'profile.png' : data.patient.profileImg));

		if (data.pmd.length > 0){
			DisplayCase(data.pmd,1,data.pre,1);
			CasePagination(data.pmd, data.pre);
		}
		current_page = 1;
	}

	function DisplayCase (items, casePage, dateItem, page) {
		casePage--;
		$("#pmdId").val(items[casePage].pmdId);
		$("#caseDate").text(items[casePage].datetime);
		if (items[casePage].description != '') {
			var HTMLstring = items[casePage].description;
			$('.desc').html(HTMLstring);
		}
		const date = Object.keys(dateItem[items[casePage].pmdId]);
		current_page = 1;
		DisplayList(dateItem[items[casePage].pmdId], date, page);
		SetupPagination(dateItem[items[casePage].pmdId],date);
	}

	function DisplayList (items,date, page) {
		list_element.html("");
		page--;
		let html = '<table class="table"> ' +
			'<tr>' +
			'<th>Medicine Name</th>' +
			'<th>Quantity</th>' +
			'<th>Dine</th>' +
			'</tr>';
		for (let i = 0; i < items[date[page]].length; i++) {
			$("#preDate").text(date[page]);
			const id = (Math.random() / +new Date()).toString(36).replace(/[^a-z]+/g , '');
			html += '<tr>\n' +
				'<td>\n' +
				items[date[page]][i].medName +
				'</td>\n' +
				'<td width="150px">\n' +
				items[date[page]][i].qty +
				'</td>\n' +
				'<td width="270px">\n' +
				((items[date[page]][i].dineSuggestion == 1)? 'Before Dine':'') +
				((items[date[page]][i].dineSuggestion == 2)? 'After Dine':'') +
				'<br>' +
				items[date[page]][i].timesPerDay+
				'</td>\n' +
				'</tr>';
		}
		html += '</table>';
		$("#preMed").append(html);
	}

	function CasePagination (items, dateItems) {
		casePagination.html("");
		let page_count = items.length;
		let btn = '<li class="page-item previous disabled"> <a aria-disabled="true" aria-label="Previous" class="page-link" href="javascript:void(0)" tabindex="-1"> <span class="fas fa-chevron-left"></span> </a> </li>';
		casePagination.append(btn);
		let i = 1;
		for (i = 1; i < page_count + 1; i++) {
			let active = '';
			if (current_case == i)
			{
				active = 'active';
			}
			let button = '<li class="page-item page '+ active +'" data-page="'+ i +'"><a class="page-link" href="javascript:void(0)">C'+i+'</a></li>';
			casePagination.append(button);
		}
		btn = '<li class="page-item next ' + ((i==2) ? 'disabled' : '') +'"><a aria-label="Next" class="page-link" href="javascript:void(0)"><span class="fas fa-chevron-right"></span></a></li>';
		casePagination.append(btn);
		$("#casePagination .next").on('click',function (e) {
			if(e.handeled !== true) {
				current_case = $('#casePagination .page-item.active').data('page');
				current_case++;
				DisplayCase(items , current_case, dateItems, 1);
				$('#casePagination .page-item.active').removeClass('active');
				$("#casePagination [data-page='" + current_case + "']").addClass('active');
				if (current_case == items.length){
					$("#casePagination .next").addClass('disabled');
				} else {
					$("#casePagination .next").removeClass('disabled');
				}
				if (current_case == 1){
					$("#casePagination .previous").addClass('disabled');
				} else {
					$("#casePagination .previous").removeClass('disabled');
				}
				e.handeled = true;
			}
			return false;
		});
		$("#casePagination .previous").on('click',function (e) {
			if(e.handeled !== true) {
				current_case = $('#casePagination .page-item.active').data('page');
				current_case--;
				DisplayCase(items , current_case, dateItems, 1);
				$('#casePagination .page-item.active').removeClass('active');
				$("#casePagination [data-page='" + current_case + "']").addClass('active');
				if (current_case == items.length){
					$("#casePagination .next").addClass('disabled');
				} else {
					$("#casePagination .next").removeClass('disabled');
				}
				if (current_case == 1){
					$("#casePagination .previous").addClass('disabled');
				} else {
					$("#casePagination .previous").removeClass('disabled');
				}
				e.handeled = true;
			}
			return false;
		});
		$("#casePagination .page").on('click',function (e) {
			if(e.handeled !== true) {
				const page = $(this).data('page');
				current_case = page;
				DisplayCase(items , current_case, dateItems, 1);
				$('#casePagination .page-item.active').removeClass('active');
				$(this).addClass('active');
				if (current_case == items.length){
					$("#casePagination .next").addClass('disabled');
				} else {
					$("#casePagination .next").removeClass('disabled');
				}
				if (current_case == 1){
					$("#casePagination .previous").addClass('disabled');
				} else {
					$("#casePagination .previous").removeClass('disabled');
				}
				e.handeled = true;
			}
			return false;
		});
	}

	function SetupPagination (items,date) {
		pagination_element.html("");
		let page_count = date.length;
		let btn = '<li class="page-item previous disabled"> <a aria-disabled="true" aria-label="Previous" class="page-link" href="javascript:void(0)" tabindex="-1"> <span class="fas fa-chevron-left"></span> </a> </li>';
		pagination_element.append(btn);
		let i = 1;
		for (i = 1; i < page_count + 1; i++) {
			let active = '';
			if (current_page == i)
			{
				active = 'active';
			}
			let button = '<li class="page-item page '+ active +'" data-page="'+ i +'"><a class="page-link" href="javascript:void(0)">'+i+'</a></li>';
			pagination_element.append(button);
		}
		btn = '<li class="page-item next ' + ((i==2) ? 'disabled' : '') +'"><a aria-label="Next" class="page-link" href="javascript:void(0)"><span class="fas fa-chevron-right"></span></a></li>';
		pagination_element.append(btn);
		$("#pagination .next").on('click',function (e) {
			if(e.handeled !== true) {
				current_page = $('#pagination .page-item.active').data('page');
				current_page++;
				DisplayList(items , date , current_page);
				$('#pagination .page-item.active').removeClass('active');
				$("#pagination [data-page='" + current_page + "']").addClass('active');
				if (current_page == date.length){
					$("#pagination .next").addClass('disabled');
				} else {
					$("#pagination .next").removeClass('disabled');
				}
				if (current_page == 1){
					$("#pagination .previous").addClass('disabled');
				} else {
					$("#pagination .previous").removeClass('disabled');
				}
				e.handeled = true;
			}
			return false;
		});
		$("#pagination .previous").on('click',function (e) {
			if(e.handeled !== true) {
				current_page = $('#pagination .page-item.active').data('page');
				current_page--;
				DisplayList(items , date , current_page);
				$('#pagination .page-item.active').removeClass('active');
				$("#pagination [data-page='" + current_page + "']").addClass('active');
				if (current_page == date.length){
					$("#pagination .next").addClass('disabled');
				} else {
					$("#pagination .next").removeClass('disabled');
				}
				if (current_page == 1){
					$("#pagination .previous").addClass('disabled');
				} else {
					$("#pagination .previous").removeClass('disabled');
				}
				e.handeled = true;
			}
			return false;
		});
		$("#pagination .page").on('click',function (e) {
			if(e.handeled !== true) {
				const page = $(this).data('page');
				current_page = page;
				DisplayList(items , date , current_page);
				$('#pagination .page-item.active').removeClass('active');
				$(this).addClass('active');
				if (current_page == date.length){
					$("#pagination .next").addClass('disabled');
				} else {
					$("#pagination .next").removeClass('disabled');
				}
				if (current_page == 1){
					$("#pagination .previous").addClass('disabled');
				} else {
					$("#pagination .previous").removeClass('disabled');
				}
				e.handeled = true;
			}
			return false;
		});
	}

	$("#fetchReport").on('click', function () {
		$("#reportList").html('');
		let pmdId = $("#pmdId").val();
		$.ajax({
			url: '<?= base_url()?>doctor/checkup/fetchReport/'+ pmdId,
			dataType: 'json',
			success:function(data){
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += '<li>\n' +
						'<a href="<?= base_url()?>reports/' + data[i].src + '" style="color: #1f2022;font-size: 17px;" target="_blank">' + data[i].src + '</a>\n' +
						'</li>';
				}
				$("#reportList").html(html);
			}
		});
	});


</script>
</body>
</html>
