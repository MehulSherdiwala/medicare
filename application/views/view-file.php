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
		b{
			font-weight: 500!important;
		}
		.section #queue li{
			cursor: pointer;
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
		.profile{
			height: 64px;
			overflow: auto;
		}
		.desc{
			height: 100px;
			overflow: auto;
		}
		.profileSec{
			display: inline-block;
		}

		.description .active,
		.pre .active{
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

		.pre table th{
			background: rgba(31, 32, 34, .1);
			border: none;
		}
		.pre table td{
			background: rgba(235, 235, 235, 0.67);
			border: none;
		}
		.pre table{
			border-collapse: separate;
		}

		.pre table tr th:first-child,
		.pre table tr td:first-child{
			border-top-left-radius: 8px;
			border-bottom-left-radius: 8px;
		}

		.pre table tr th:last-child,
		.pre table tr td:last-child{
			border-top-right-radius: 8px;
			border-bottom-right-radius: 8px;
		}
		.section .card-body{
			padding: 0;
		}
		li.disabled{
			pointer-events: none;
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
							<li class="breadcrumb-item"><a href="index.html">Medical Record</a></li>
							<li class="breadcrumb-item active" aria-current="page">Records</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Records</h2>
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
							<div class="section">
								<div class="card border-0 mb-0">
									<div class="card-body text-left">
										<div class="profileSec w-100">
											<div class="profile float-left" style="width: 70%">
												<b>Date:</b> <span id="date"></span>
												<br>
												<span data-target="#add-description" data-toggle="modal">
														<b>Description:</b>
														<span id="desc">Description</span>
												</span>
											</div>
											<div style="margin-left: 10px;margin-top: 0px;text-align: right">
												<div class="reportsSec">
													<button type="button" class="btn btn-info"
															data-target="#report"
															data-toggle="modal"
															id="fetchReport">
														<b>Medical Reports</b>
													</button>
													<br>
													<button type="button" class="btn btn-success mt-2"
															data-target="#purchaseModal"
															data-toggle="modal"
															id="purchase">
														<b>Purchase Medicine</b>
													</button>
													<input type="hidden" id="pmdId">
												</div>
											</div>
										</div>
										<br>
										<div class="caseSec">
											<div class="row" style="margin: 0">
												<div style="width: 100%">
													<div class="description">
														<b>Case Description</b>
														<b class="ml-4">Date : </b><span id="caseDate"></span>
														<div class="desc">
														</div>
													</div>
												</div>

											</div>
										</div>
										<br>
										<div class="preSec position-relative">
											<b>Medicine</b>
											<br>
											<label>Date :</label><span id="preDate">06-05-2020</span>
											<a href="" class="btn btn-info btn-sm float-right mr-2" style="position: absolute;top:0;right: 15px" id="print-pre" target="_blank">Print</a>
											<div class="pre">
												<table class="table" id="preMed">
												</table>

											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="pageSec d-flex justify-content-center  mt-4">
								<nav>
									<ul class="pagination d-flex justify-content-center " id="pagination">
										<li class="page-item disabled">
											<a aria-disabled="true" aria-label="Previous"
											   class="page-link" href="#"
											   tabindex="-1">
												<span class="fas fa-chevron-left"></span>
											</a>
										</li>
										<li aria-current="page" class="page-item active"><a class="page-link"
																							href="#">1</a>
										</li>
										<li class="page-item"><a class="page-link" href="#">2</a></li>
										<li class="page-item"><a class="page-link" href="#">3</a></li>
										<li class="page-item"><a aria-label="Next" class="page-link"
																 href="#"><span
													class="fas fa-chevron-right"></span></a></li>
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
<div aria-hidden="true" class="modal fade" id="report" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Medical Reports</h5></div>
			<div class="modal-body">
				<div class="section h-auto overflow-hidden">
					<ul id="reportList" class="list-unstyled text-left">
						<li>
							<a href="#" style="color: #1f2022;font-size: 17px;">Mehul Sherdiwala</a>
						</li>
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
<div aria-hidden="true" class="modal fade" id="purchaseModal" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Puchase Medicine</h5></div>
			<div class="modal-body">
				<div class="d-flex justify-content-center">
					<button type="button" class="btn btn-success" id="online">Online</button>&nbsp;&nbsp;&nbsp;
					<button type="button" class="btn btn-success" id="offline">Offline Pharmacy</button>
				</div>
				<div id="purSec" class="mt-2">
				</div>
				<div id="purDateSec" class="mt-2">
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
	const link = '<?= base_url()?>report/prescription/';


	const list_element = $('#preMed');
	const pagination_element = $('#pagination');
	const casePagination = $('#casePagination');

	let current_page = 1;
	let current_case = 1;

	fetchDetails(docId);

	async function fetchDetails(docId){

		const response = await fetch('<?= base_url()?>checkup/fetchFileDetails/' + docId);
		const data = await response.json();

		$("#date").text(data.pmr.datetime);
		$("#desc").text(data.pmr.pmrDescription);

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
		console.log(items);
		let html = '<table class="table"> ' +
				'<tr>' +
				'<th>Medicine Name</th>' +
				'<th>Quantity</th>' +
				'<th>Dine</th>' +
				'</tr>';
		$("#preDate").text(date[page]);
		$("#print-pre").attr('href',link + items[date[page]][0].pmdId + '/' + date[page]);
		for (let i = 0; i < items[date[page]].length; i++) {
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

	$("#purchase").on('click', function () {
		$("#purSec,#purDateSec").html('');
	});

	$("#online").on('click', function () {
		$("#purSec,#purDateSec").html('');
		$.ajax({
			url: '<?= base_url()?>checkup/fetchCase/'+ docId,
			dataType: 'json',
			success:function (data) {
				let html = '<table class="table table-bordered">' +
					'<tr>' +
					'<th>Case No.</th>' +
					'<th>Date</th>' +
					'<th></th>' +
					'</tr>';

				for (let i = 0; i < data.length; i++) {
					html += '<tr data-pmdid="' + data[i].pmdId + '">' +
						'<td>' + data[i].no + '</td>' +
						'<td>' + data[i].datetime + '</td>' +
						'<td><button type="button" class="btn btn-success btn-sm select"><i class="fas fa-check"></i></button></td>' +
						'</tr>';
				}
				html += '</table>';
				$("#purSec").html(html);
				$(".select").on('click', function () {
					let pmdId = $(this).closest('tr').data('pmdid');
					$.ajax({
						url: '<?= base_url()?>checkup/fetchDates/' + pmdId,
						dataType: 'json',
						success:function (data) {
							let html = '<table class="table table-bordered">' +
								'<tr>' +
								'<th>Page No.</th>' +
								'<th>Date</th>' +
								'<th>No. of Medicines</th>' +
								'<th></th>' +
								'</tr>';
							for (let i = 0; i < data.length; i++) {
								html += '<tr data-presid="' + data[i].presId + '">' +
									'<td>' + data[i].no + '</td>' +
									'<td>' + data[i].datetime + '</td>' +
									'<td>' + data[i].med + '</td>' +
									'<td><button type="button" class="btn btn-success btn-sm buy">Buy</button></td>' +
									'</tr>';
							}
							html += '</table>';
							$("#purDateSec").html(html);
							$(".buy").on('click', function () {
								let presId = $(this).closest('tr').data('presid');
								$.ajax({
									url:'<?= base_url()?>checkup/checkMedicine/' + presId,
									dataType: 'json',
									success:function (data) {
										let html = '<table class="table table-bordered">' +
											'<tr>' +
											'<th>No.</th>' +
											'<th>Medicine Name</th>' +
											'<th>Quantity</th>' +
											'<th>Status</th>' +
											'<th>Availability</th>' +
											'</tr>';

										for (let i = 0; i < data.length; i++) {
											html += '<tr>' +
												'<td>' + (i+1) + ((data[i].av==1)? '<input type="hidden" class="presId" value="' + data[i].presId + '">' :' ') + '</td>' +
												'<td>' + data[i].medName + '</td>' +
												'<td>' + data[i].qty + '</td>' +
												'<td>' + ((data[i].status==1)? '<span class="badge" title="Purchased"><i class="fas fa-check-circle fa-2x"></i></span>' : '') + '</td>' +
												'<td>' + ((data[i].av==0)? 'Not Available' : 'Available') + '</td>' +
												'</tr>';
										}
										html += '</table>' +
											'<button type="button" class="btn btn-outline-success buyNow float-right">Buy now</button>';
										$("#purDateSec").html(html);
										$(".buyNow").on('click', function () {
											addToCart()
										})
									}
								})
							})
						}
					});
				});
			}
		})
	});

	$("#offline").on('click', function () {
		$("#purSec,#purDateSec").html('');
		$.ajax({
			url: '<?= base_url()?>checkup/fetchCurrentPrescription/' + docId,
			dataType:'json',
			success:function (data) {
				console.log(data);
				let html = '<h5 class="text-center m-3">Last Case with last checkup Prescription</h5>' +
					'<table class="table">' +
					'<tr>' +
					'<th>Date</th>' +
					'<th>Medicine Name</th>' +
					'<th>Quantity</th>' +
					'</tr>';
				for (let i = 0; i < data.pres.length; i++) {
					html +='<tr>' +
						'<td>'+ data.pres[i].datetime +'<input type="hidden" class="presId" value="' + data.pres[i].presId + '"></td>' +
						'<td>'+ data.pres[i].medName +'</td>' +
						'<td>'+ data.pres[i].qty +'</td>' +
						'</tr>';
					$("#presDate").val(data.pres[i].datetime);
				}
				html += '</table>';
				for (let i = 0; i < data.phar.length; i++) {
					html += '<div class="section ml-4">' +
							'<div class="custom-control custom-radio mb-3">\n' +
							'<input type="radio" class="custom-control-input" id="after_' + data.phar[i].pharId + '" name="pharId" value="' + data.phar[i].pharId + '" checked>\n' +
							'<label class="custom-control-label" for="after_' + data.phar[i].pharId + '">\n' +
							'<h4>' + data.phar[i].username + '</h4>' +
							'<p>' + data.phar[i].address + '</p></label>' +
							'</div>\n' +
							'</div>';
				}
				html += '<button type="button" class="btn btn-outline-success buyNow float-right">Buy now</button><br>';
				$("#purDateSec").html(html);
				$(".buyNow").on('click', function () {
					let presId = [];
					$(".presId").each(function () {
						presId.push($(this).val());
					});
					let pharId = $('input[name="pharId"]').val();
					$.ajax({
						url:'<?= base_url()?>pharmacist/pharmacy/order',
						method:'post',
						data: {
							presId:presId,
							pharId:pharId
						},
						success:function (data) {
							alert(data);
						}
					})
				})
			}
		})
	});

	async function addToCart() {
		let presId = [];
		$(".presId").each(function () {
			presId.push($(this).val());
		});
		$.ajax({
			url:'<?= base_url()?>shop/presAddToCart',
			method:'post',
			data: {
				presId:presId
			},
			success:function (data) {
				alert(data);
			}
		})
	}
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
