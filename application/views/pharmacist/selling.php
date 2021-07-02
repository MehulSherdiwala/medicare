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

	<link href="<?= base_url() ?>assets/css/jquery.typeahead.css" rel="stylesheet">
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
		.profile{
			background: #f1f1f1;
			padding: 7px;
			border-radius: 5px;
			margin-bottom: 5px;
			height: 80px;
		}
		.section #queue li img{
			max-width: 25%;
			float: left;
			margin-right: 15px;
		}
		.section #queue li h4{
			line-height: 45px;
		}
		.profile{
			overflow: auto;
			height: auto;
		}
		.profileSec{
			display: inline-block;
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

		#preMed table{
			border-collapse: separate;
		}

		#preMed table tr td{
			background: rgba(235, 235, 235, 0.67);
		}

		#preMed table tr td:first-child,
		#preMed table tr th:first-child{
			border-top-left-radius: 8px;
			border-bottom-left-radius: 8px;
		}

		#preMed table tr td:last-child,
		#preMed table tr th:last-child{
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
				<form action="<?= base_url()?>pharmacist/pharmacy/data" method="post">
					<div class="row">
						<div class="col-12 col-md-3 pr-1" >
							<header class="page-header"><h3 class="page-title" style="margin: 0 10px 1rem;">Patient List</h3></header>
							<div class="page-content">
								<div class="section">
									<div class="card mb-0">
										<div class="card-body text-left">
											<ul style="list-style: none;padding: 0" id="queue">
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-9 pl-1" >
							<header class="page-header"><h3 class="page-title" style="margin: 0 10px 1rem;">Patient Prescription</h3></header>
							<div class="page-content">
								<div class="section">
									<div class="card mb-0">
										<div class="card-body text-left">
											<div class="profileSec w-100">
												<div class="profile ">
													<h5 class="m-0 text-center"><span id="name">Patient Name</span></h5>
													<input type="hidden" id="pId" name="pId" value="0">
												</div>
											</div>
											<div class="preSec position-relative">
												<b class="mr-5 float-left">Medicine</b>
												<span id="preDate" class="float-right">13-08-2020</span> <label class="float-right mr-2">Date : </label>
												<div class="pre">
													<div id="preMed">  </div>
												</div>
											</div>
										</div>
									</div>
									<div style="position: absolute;bottom: 10px;width: 95%">
										<div class="pageSec d-flex justify-content-between mt-4">
											<button class="btn btn-danger">Absent</button>

											<button type="submit" class="btn btn-suc">Next</button>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</form>
			</div>
		</main>
		<div class="content-overlay"></div>
	</div>
</div>
<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.typeahead.min.js"></script>
<script src="<?= base_url() ?>assets/js/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-select.min.js"></script>
<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/time-picker/mdtimepicker.js"></script>
<script src="<?= base_url() ?>assets/plugins/summernotes/summernote-bs4.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>

<script>
	const spinner = $("#spinner");
	let appId = 0;

	$(window).on('load', function () {
		$("#queue li:first-child").trigger('click');
	});

	queue();
	async function queue(){
		const response = await fetch('<?= base_url()?>pharmacist/pharmacy/queue');
		const data = await response.json();
		console.log(data);

		let html ='';
		for (let i = 0;i < data.length;i++) {
			html += '<li data-pid="' + data[i].pId + '">\n' +
				'<div class="avatar">\n' +
				'<img src="<?= base_url()?>profile/' + ((data[i].profileImg == "") ? 'profile.png' : data[i].profileImg) + '" alt="User Image" class="avatar-img rounded-circle">\n' +
				'<h4 class="m-0">' + data[i].username + '</h4>\n' +
				'</div>' +
				'</li>';
		}
		$("#queue").html(html).fadeIn();
		$("#queue li").on('click', function () {
			let pId = $(this).data('pid');
			$("#pId").val(pId);
			fetchDetails(pId);
		});
	}

	setInterval(function () {
		queue()
	},5000);

	const list_element = $('#preMed');
	list_element.html("");

	async function fetchDetails(pId){
		spinner.removeAttr('hidden');
		list_element.html("");

		const response = await fetch('<?= base_url()?>pharmacist/pharmacy/fetchPrescriptionDetails/' + pId);
		const data = await response.json();

		console.log(data);
		$("#name").text(data.patient);

		let html = '<table class="table">' +
			'<tr>' +
			'<th>Medicine Name</th>' +
			'<th>Quantity</th>' +
			'<th>Dine</th>' +
			'</tr>';
		for (let i = 0; i < data.pres.length; i++) {
			html +='<tr>' +
				'<td>' + data.pres[i].medName + ' <input type="hidden" name="opId[]" value="' + data.pres[i].opId + '"></td>' +
				'<td>' + data.pres[i].qty + '</td>' +
				'<td>' +
				((data.pres[i].dineSuggestion == 1)? 'Before Dine':'') +
				((data.pres[i].dineSuggestion == 2)? 'After Dine':'') +
				'<br>' +
				data.pres[i].times + '</td>' +
				'</tr>';
		}

		html += '</table>';

		$("#preMed").html(html);
		spinner.attr('hidden', '');

	}

</script>
</body>
</html>
