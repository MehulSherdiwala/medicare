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
	<link href="<?= base_url() ?>assets/css/styleMedic.css?version=17" rel="stylesheet">
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
			height: 64px;
			overflow: auto;
		}
		.profile img{
			float: left;
			max-width: 15%;
			margin-right: 10px;
		}
		.desc{
			height: 100px;
			/*width: 70%;*/
			overflow: auto;
		}
		.profileSec{
			display: inline-block;
		}


		.note-editor.note-frame {
			border: 1px solid #ddd;
		}

		.description .note-editable {
			height: 100px;
		}

		.description .note-editor {
			margin-bottom: 10px !important;
			/*width: 70%;*/
		}

		.note-view>.btn-fullscreen {
			display: none
		}
		.note-popover .popover-content, .note-toolbar{
			padding: 0 0 5px 5px!important;
			font-size: 0!important;
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
<!-- main-loader -->
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
						<div class="col-12 col-md-3 pr-1" >
							<header class="page-header"><h3 class="page-title" style="margin: 0 10px 1rem;">Patient Queue</h3></header>
							<div class="page-content">
								<div class="section">
									<div class="card mb-0">
										<div class="card-body text-left">
											<ul style="list-style: none;padding: 0" id="queue">
<!--												<li data-appid=" + data[i].appId + ">\n +-->
<!--												<h4 class="m-0"> + data[i].username + </h4>-->
<!--												<p> + data[i].description + </p>-->
<!--												</li>-->
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-md-9 pl-1" >
							<header class="page-header"><h3 class="page-title" style="margin: 0 10px 1rem;">Patient Medical Record</h3></header>
							<div class="page-content">
								<div class="section">
									<div class="card mb-0">
										<div class="card-body text-left d-none" id="structure">
											<div class="profileSec w-100">
												<div class="profile  float-left " style="width: 40%">
													<img src="" alt="" id="" class="avatar-img rounded-circle">
													<h5 class="m-0"><span id="name"></span></h5>
													<b>Age:</b> <span id="age"></span>
													<b class="ml-4">Gender:</b> <span id="gender"></span>
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
													<div style="width: 80%">
														<b>Case Description</b>
														<b class="ml-4">Date : </b><span id="caseDate"></span>
														<div class="description">
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
															<br>
															<br>
															<button type="button" class="btn btn-suc" id="addCase">
																<b>New Case</b>
															</button>
														</div>
													</div>
												</div>
											</div>
											<div class="preSec position-relative">
												<b>Medicine</b>
												<br>
													<label>Date :</label><span id="preDate"></span>
												<button type="button" class="btn btn-suc btn-sm float-right mr-2" style="position: absolute;top:0;right: 15px" id="add-pre"><span class="btn-icon icofont-plus"></span></button>
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
							<div class="pageSec d-flex justify-content-between mt-4">
								<button class="btn btn-danger">Absent</button>
								<nav>
									<ul class="pagination d-flex justify-content-center" id="pagination">

									</ul>
									<ul class="pagination d-flex justify-content-center mt-1" id="casePagination">

									</ul>
								</nav>
								<button type="submit" class="btn btn-suc">Next</button>
							</div>
						</div>
					</div>
				</form>
				<div class="checkup-skeleton queue">
					<div class="sk-queue">
						<span class="sk-queue-item bg animated-bg"></span>
						<span class="sk-queue-item bg animated-bg"></span>
						<span class="sk-queue-item bg animated-bg"></span>
						<span class="sk-queue-item bg animated-bg"></span>
						<span class="sk-queue-item bg animated-bg"></span>
						<span class="sk-queue-item bg animated-bg"></span>
					</div>
				</div>
				<div class="checkup-skeleton checkup-part">
					<div class="sk-queue">
						<div class="w-100 d-flex">
							<span class="sk-queue-item bg animated-bg" style="margin-top: 0;width: 38%"></span>
							<span class="sk-queue-item bg animated-bg" style="margin-top: 0;width: 57%;margin-left: 10px;"></span>
						</div>
						<div class="w-100 d-flex mt-2">
							<span class="sk-queue-item bg animated-bg w-75" style="height: 10rem"></span>
							<div class="w-25">
								<span class="sk-queue-item bg animated-bg" style="height: 2.5rem;margin-left: 14%;width: 70%"></span>
								<span class="sk-queue-item bg animated-bg" style="height: 2.5rem;margin-left: 38%;width: 46%"></span>
							</div>
						</div>
						<span class="sk-queue-item bg animated-bg mt-4" style="height: 6rem;width: 96%"></span>
					</div>
				</div>
			</div>
		</main>
		<div class="content-overlay"></div>
	</div>
</div>
<!-- Add patients modals -->
<div aria-hidden="true" class="modal fade" id="add-description" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Patient Medical Record Description</h5></div>
			<div class="modal-body">
				<div class="form-group">
					<label>Description</label>
					<textarea id="fileDescription" class="form-control"></textarea>
				</div>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
					<button class="btn btn-suc" data-dismiss="modal" id="saveFileDescription" type="button">Save</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div aria-hidden="true" class="modal fade" id="report" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Patient Report</h5></div>
			<div class="modal-body">
				<div class="m-3">
					<input type="file" id="attach" class="d-none">
					<button class="btn btn-outline-primary" type="button" onclick="choose()">Change<span
							class="btn-icon icofont-papers ml-2"></span></button>
				</div>
				<div class="section h-auto overflow-hidden">
					<ul id="reportList" class="list-unstyled text-left">
						<li>
							<a href="#" style="color: #1f2022;font-size: 17px;">Mehul Sherdiwala</a>
							<button type="button" class="float-right btn btn-danger btn-sm btn-square float-right removeRow">
								<span class="btn-icon icofont-close"></span>
							</button>

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
<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<!--<script src="<?= base_url() ?>assets/js/jquery-migrate-1.4.1.min.js"></script>-->
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
<?php
$html = '';
foreach ($med as $m)
{
	$html .= '<option value="' . $m['pwmId'] . '">' . $m['medName'] . '</option>';
}
?>
<script>
	const spinner = $("#spinner");
	let appId = 0;

	$(window).on('load', function () {
		$("#queue li:first-child").trigger('click');
	});


	$( "#add-description" ).on('show.bs.modal', function(){
		const pmrId = $("#pmrId").val();

		$.ajax({
			url: '<?= base_url()?>doctor/checkup/pmrDesc/'+pmrId,
			method: 'get',
			success:function (data) {
				$("#fileDescription").val(data);
			}
		})
	});

	$("#saveFileDescription").on('click', function () {
		const desc = $("#fileDescription").val();
		const pmrId = $("#pmrId").val();

		$.ajax({
			url: '<?= base_url()?>doctor/checkup/pmrDesc/'+pmrId,
			method: 'post',
			data: {
				desc:desc,
				appId:((pmrId == 0) ? appId : 0)
			},
			success:function (data) {
				if(pmrId == 0){
					let obj = JSON.parse(data);
					console.log(obj[desc]);
					$("#pmrId").val(obj.pmrId);
					$("#desc").text(obj.desc);
				} else {
					$("#desc").text(data);
				}
			}
		})
	});

	const med = '<?= $html?>';
	queue();
	async function queue(){
		const response = await fetch('<?= base_url()?>doctor/checkup/queue');
		const data = await response.json();

		if(data.length == 0){
			$("#structure").addClass('d-none');
			$(".checkup-skeleton.queue").removeClass('loaded');
		} else {
			let html ='';
			for (let i = 0;i < data.length;i++) {
				html += '<li data-appid="' + data[i].appId + '">\n' +
						'<div class="avatar">\n' +
						'<img src="<?= base_url()?>profile/' + ((data[i].profileImg == "") ? 'profile.png' : data[i].profileImg) + '" alt="User Image" class="avatar-img rounded-circle">\n' +
						'<h4 class="m-0">' + data[i].username + '</h4>\n' +
						'<p>' + data[i].description + '</p>\n' +
						'</div>\n' +
						'</li>';
			}
			$("#queue").html(html).fadeIn();
			$("#queue li").on('click', function () {
				appId = $(this).data('appid');
				$("#appId").val(appId);
				$(".checkup-skeleton.checkup-part").addClass('loaded');
				fetchDetails(appId);
			});
			$(".checkup-skeleton.queue").addClass('loaded');
		}
		// $(".checkup-skeleton.queue").addClass('loaded');

	}

	const list_element = $('#preMed');
	list_element.html("");
	const pagination_element = $('#pagination');
	const casePagination = $('#casePagination');

	let current_page = 1;
	let current_case = 1;
	let dateArr = new Array();
	let caseDateArr = new Array();
	let date = new Array();
	let newCase = 0;
	let totalCase = 0;
	let description = new Array();
	let d = new Date();
	let month = d.getMonth()+1;
	let day = d.getDate();
	let curDate = ((''+day).length<2 ? '0' : '') + day + '-' +
		((''+month).length<2 ? '0' : '') + month + '-' +
		d.getFullYear();

	async function fetchDetails(appId){
		spinner.removeAttr('hidden');
		list_element.html("");
		pagination_element.html("");
		casePagination.html("");
		$('.description').html("");

		const response = await fetch('<?= base_url()?>doctor/checkup/fetchCheckupDetails/' + appId);
		const data = await response.json();

		$("#name").text(data.patient.name);
		$("#age").text(data.patient.age);
		$("#gender").text(data.patient.gender);
		$("#date").text(data.pmr.datetime);
		$("#desc").text(data.pmr.pmrDescription);
		$("#profileImg").attr('src','<?= base_url()?>profile/' + ((data.patient.profileImg == "")? 'profile.png' : data.patient.profileImg));

		if (data.pmr.length == 0){
			$("#pmrId").val(0);
		} else {
			$("#pmrId").val(data.pmr.pmrId);
		}

		if (data.pmd.length > 0){
			current_case = data.pmd.length;
			newCase = data.pmd.length;
			totalCase = data.pmd.length;

			CasePagination(totalCase);

			for (let i = 0; i < data.pmd.length; i++) {

				DisplayCase(data.pmd , i,data.pre,i);

				date[i+1] = Object.keys(data.pre[data.pmd[i].pmdId]);
				current_page = date.length;
				date[i+1].forEach(function (item,key) {
					DisplayList(data.pre[data.pmd[i].pmdId], item, i+1, key+1);
				});
			}
			$("#case_"+ current_case).addClass("active");
			$("#caseDate").text(caseDateArr[current_case]);

			SetupPagination(date[current_case]);
			$("#page_"+ current_case + "_"+ current_page).addClass("active");
			$("#preDate").text(dateArr[current_case +"_"+ current_page]);
		} else{
			current_case = 0;
			newCase = 0;
			totalCase = 0;
			$("#caseDate,#preDate").text('');
		}

		// current_page = 1;
		spinner.attr('hidden', '');
		$(".desc").on('click',function () {
			$(this).summernote({focus: 0,toolbar: [
					['style', ['bold', 'italic', 'underline', 'clear']],
					['fontsize', ['fontsize']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['save', ['save']]
				],buttons: {
					save: SaveButton
				}});
		});
		$("#structure").removeClass('d-none');
	}

	$("#add-pre").on('click', function () {
		const id = (Math.random() / +new Date()).toString(36).replace(/[^a-z]+/g, '');
		let html = '<tr>\n' +
			'<td>\n' +
			'<select name="pwmId[' + id + ']" id="selectpicker_' + id + '" class="form-control selectpicker" data-live-search="true">\n' +
			'<option value="">Select Medicine</option>\n' +
			med +
			'</select>\n' +
			'</td>\n' +
			'<td width="150px">\n' +
			'<input type="number" class="form-control" placeholder="Quantity" name="qty[' + id + ']">\n' +
			'</td>\n' +
			'<td width="270px">\n' +
			'<div class="d-flex justify-content-center">\n' +
			'<div class="custom-control custom-radio mb-3">\n' +
			'<input type="radio" class="custom-control-input" id="before_' + id + '" name="eat[' + id + ']" value="1" > ' +
			'<label class="custom-control-label" for="before_' + id + '">Before</label>\n' +
			'</div> &nbsp;\n' +
			'<div class="custom-control custom-radio mb-3">\n' +
			'<input type="radio" class="custom-control-input" id="after_' + id + '" name="eat[' + id + ']" value="2">\n' +
			'<label class="custom-control-label" for="after_' + id + '">After</label>\n' +
			'</div>\n' +
			'</div>\n' +
			'<div class="d-flex justify-content-center">\n' +
			'<div class="custom-control custom-checkbox mb-3">\n' +
			'<input type="checkbox" class="custom-control-input" id="morning_' + id + '" name="times[' + id + '][]" value="1">\n' +
			'<label class="custom-control-label" for="morning_' + id + '">Morning</label>\n' +
			'</div> &nbsp;\n' +
			'<div class="custom-control custom-checkbox mb-3">\n' +
			'<input type="checkbox" class="custom-control-input" id="noon_' + id + '" name="times[' + id + '][]" value="2">\n' +
			'<label class="custom-control-label" for="noon_' + id + '">Noon</label>\n' +
			'</div> &nbsp;\n' +
			'<div class="custom-control custom-checkbox mb-3">\n' +
			'<input type="checkbox" class="custom-control-input" id="night_' + id + '" name="times[' + id + '][]" value="4">\n' +
			'<label class="custom-control-label" for="night_' + id + '">Night</label>\n' +
			'</div>\n' +
			'</div>\n' +
			'</td>\n' +
			'<td width="70px">\n' +
			'<button class="btn btn-danger btn-sm btn-square rounded-pill remove"><span class="btn-icon icofont-close"></span></button>\n' +
			'</td>\n' +
			'</tr>';

		$("#page_"+ current_case + "_"+ current_page +" table").append(html);
		$("#selectpicker_" + id).selectpicker({
			style: '',
			styleBase: 'form-control',
			tickIcon: 'icofont-check-alt'
		});

		$("#totalMed_" + newCase).val(parseInt($("#totalMed_" + newCase).val()) + 1);

		$(".remove").on('click', function () {
			$(this).closest('tr').remove();
		});
	});

	$("#addCase").on('click', function () {
		newCase++;
		$(".description div.active").removeClass('active');
		let html = '<div id="case_' + newCase + '" style="display: none" class="active">' +
			'<input type="hidden" name="desc[]" value="" id="desc_' + newCase + '" >' +
			'<input type="hidden" name="pmdId[]" id="pmdId_' + newCase + '" value="0" >' +
			'<input type="hidden" name="totalMed[0]" value="0" id="totalMed_' + newCase + '" >' +
			'<div class="desc"> </div>' +
			'</div>';
		$(".description").append(html);

		$("#caseDate").text(curDate);
		$('#case_' + newCase + ' .desc').summernote({
			focus: 0 , toolbar: [
				['style' , ['bold' , 'italic' , 'underline' , 'clear']] ,
				['fontsize' , ['fontsize']] ,
				['color' , ['color']] ,
				['para' , ['ul' , 'ol' , 'paragraph']] ,
				['save' , ['save']]
			] , buttons: {
				save: SaveButton
			}
		});

		$(".desc").on('click',function () {
			$(this).summernote({focus: 0,toolbar: [
					['style', ['bold', 'italic', 'underline', 'clear']],
					['fontsize', ['fontsize']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['save', ['save']]
				],buttons: {
					save: SaveButton
				}});
		});
		totalCase++;
		current_case = totalCase;

		$("#preMed div.active").removeClass("active");
		html = '<div id="page_' + totalCase + '_1" style="display: none" class="active"><table class="table">';
		list_element.append(html);

		dateArr[totalCase+"_1"] = curDate;
		caseDateArr[totalCase] = curDate;
		date[totalCase]	 = [curDate];

		CasePagination(totalCase);
		SetupPagination(date[totalCase]);
	});

	$(".remove").on('click', function () {
		$(this).closest('tr').remove();
	});

	var SaveButton = function (context) {
		var ui = $.summernote.ui;
		var button = ui.button({
			contents: '<i class="fas fa-save"/> &nbsp; Save',
			tooltip: 'Save',
			click: function () {
				$("#desc_" + current_case).val($('.note-editable').html());
				context.destroy();
			}
		});

		return button.render();
	};

	$(".desc").on('click',function () {
		$(this).summernote({focus: 0,toolbar: [
				['style', ['bold', 'italic', 'underline', 'clear']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['save', ['save']]
			],buttons: {
				save: SaveButton
			}});
	});

	function DisplayCase (items, casePage, dateItem, page) {
		page++;
		let caseSec = '<div id="case_' + page + '" style="display: none"> ' +
			'<input type="hidden" name="desc[]" value="' + items[casePage].description + '" id="desc_' + page + '" >' +
			'<input type="hidden" name="pmdId[]" id="pmdId_' + page + '" value="' + items[casePage].pmdId + '" >' +
			'<input type="hidden" name="totalMed[' + items[casePage].pmdId + ']" value="0" id="totalMed_' + page + '" >' +
			'<div class="desc"></div>' +
			'</div>';

		$(".description").append(caseSec);
		// casePage++;
		caseDateArr[casePage+1] = items[casePage].datetime;

		// $("#caseDate").text(items[casePage].datetime);
		if (items[casePage].description != '') {
			var HTMLstring = items[casePage].description;
			$('#case_' + page + ' .desc').html(HTMLstring);
		} else {
			$('#case_' + page + ' .desc').summernote({
				focus: 0 , toolbar: [
					['style' , ['bold' , 'italic' , 'underline' , 'clear']] ,
					['fontsize' , ['fontsize']] ,
					['color' , ['color']] ,
					['para' , ['ul' , 'ol' , 'paragraph']] ,
					['save' , ['save']]
				] , buttons: {
					save: SaveButton
				}
			});
		}

	}

	function DisplayList (items,date, pmdId,page) {
		// list_element.html("");
		// page--;

		console.log(items);
		let html = '<div id="page_' + pmdId + '_' + page +'" style="display: none"><table class="table">';
		list_element.append(html);
		dateArr[pmdId+"_"+page] = date;
		let medInc = 0;
		for (let i = 0; i < items[date].length; i++) {
			const id = (Math.random() / +new Date()).toString(36).replace(/[^a-z]+/g , '');

			let html = '';
			if(date == curDate) {
				medInc++;
				html = '<tr>\n' +
					'<td>\n' +
					'<select name="pwmId[' + id + ']" id="selectpicker_' + id + '" class="form-control selectpicker" data-live-search="true">\n' +
					'<option value="">Select Medicine</option>\n' +
					med +
					'</select>\n' +
					'</td>\n' +
					'<td width="150px">\n' +
					'<input type="number" class="form-control" placeholder="Quantity" name="qty[' + id + ']" value="' + items[date][i].qty + '">\n' +
					'</td>\n' +
					'<td width="270px">\n' +
					'<div class="d-flex justify-content-center">\n' +
					'<div class="custom-control custom-radio mb-3">\n' +
					'<input type="radio" class="custom-control-input" id="before_' + id + '" name="eat[' + id + ']" ' + ((items[date][i].dineSuggestion == 1) ? 'checked' : '') + ' value="1">\n' +
					'<label class="custom-control-label" for="before_' + id + '">Before</label>\n' +
					'</div> &nbsp;\n' +
					'<div class="custom-control custom-radio mb-3">\n' +
					'<input type="radio" class="custom-control-input" id="after_' + id + '" name="eat[' + id + ']" ' + ((items[date][i].dineSuggestion == 2) ? 'checked' : '') + ' value="2">\n' +
					'<label class="custom-control-label" for="after_' + id + '">After</label>\n' +
					'</div>\n' +
					'</div>\n' +
					'<div class="d-flex justify-content-center">\n' +
					'<div class="custom-control custom-checkbox mb-3">\n' +
					'<input type="checkbox" class="custom-control-input" id="morning_' + id + '"  ' + ((items[date][i].timesPerDay.morning == 1) ? 'checked' : '') + ' name="times[' + id + '][]" value="1">\n' +
					'<label class="custom-control-label" for="morning_' + id + '">Morning</label>\n' +
					'</div> &nbsp;\n' +
					'<div class="custom-control custom-checkbox mb-3">\n' +
					'<input type="checkbox" class="custom-control-input" id="noon_' + id + '"  ' + ((items[date][i].timesPerDay.noon == 1) ? 'checked' : '') + ' name="times[' + id + '][]" value="2">\n' +
					'<label class="custom-control-label" for="noon_' + id + '">Noon</label>\n' +
					'</div> &nbsp;\n' +
					'<div class="custom-control custom-checkbox mb-3">\n' +
					'<input type="checkbox" class="custom-control-input" id="night_' + id + '"  ' + ((items[date][i].timesPerDay.night == 1) ? 'checked' : '') + ' name="times[' + id + '][]" value="4">\n' +
					'<label class="custom-control-label" for="night_' + id + '">Night</label>\n' +
					'</div>\n' +
					'</div>\n' +
					'</td>\n' +
					'<td width="70px">\n' +
					'<button class="btn btn-danger btn-sm btn-square rounded-pill remove"><span class="btn-icon icofont-close"></span></button>\n' +
					'</td>\n' +
					'</tr>';
			} else {
				html = '<tr>\n' +
					'<td>\n' +
					items[date][i].medName +
					'</td>\n' +
					'<td width="150px">\n' +
					items[date][i].qty +
					'</td>\n' +
					'<td width="270px">\n' +
					((items[date][i].dineSuggestion == 1)? 'Before Dine':'') +
					((items[date][i].dineSuggestion == 2)? 'After Dine':'') +
					'<br>' +
					((items[date][i].timesPerDay.morning == 1)? 'Morning':'') +
					((items[date][i].timesPerDay.morning == 1 && items[date][i].timesPerDay.noon == 1)? ' - ':'') +
					((items[date][i].timesPerDay.noon == 1)? 'Noon':'') +
					((items[date][i].timesPerDay.night == 1)? ' -  ':'') +
					((items[date][i].timesPerDay.night == 1)? 'Night ':'') +
					'</td>\n' +
					'</tr>';
			}

			$('#page_' + pmdId + '_' + page + ' table').append(html);
			$("#selectpicker_" + id + ">option[value=" + items[date][i].pwmId + "]").prop("selected" , true);

			$("#selectpicker_" + id).selectpicker({
				style: '' ,
				styleBase: 'form-control' ,
				tickIcon: 'icofont-check-alt'
			});

		}
		html = '</table></div>';
		list_element.append(html);

		$("#totalMed_" + pmdId).val(medInc);

	}

	function CasePagination (items) {
		casePagination.html("");
		let page_count = items;
		let btn = '<li class="page-item previous ' + ((page_count==1) ? 'disabled' : '' ) +'"> <a aria-disabled="true" aria-label="Previous" class="page-link" href="javascript:void(0)" tabindex="-1"> <span class="icofont-simple-left"></span> </a> </li>';
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
		btn = '<li class="page-item next disabled"><a aria-label="Next" class="page-link" href="javascript:void(0)"><span class="icofont-simple-right"></span></a></li>';
		casePagination.append(btn);
		$("#caseDate").text(caseDateArr[current_case]);
		$("#casePagination .next").on('click',function (e) {
			if(e.handeled !== true) {
				current_case = $('#casePagination .page-item.active').data('page');

				current_case++;

				$(".description div.active").removeClass("active");
				$("#case_"+ current_case).addClass("active");

				SetupPagination(date[current_case]);

				$("#preMed div.active").removeClass("active");
				$("#page_"+ current_case + "_"+ current_page).addClass("active");
				$("#caseDate").text(caseDateArr[current_case]);
				$("#preDate").text(dateArr[current_case + "_" + current_page]);

				$('#casePagination .page-item.active').removeClass('active');
				$("#casePagination [data-page='" + current_case + "']").addClass('active');
				if (current_case == items){
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
				$(".description div.active").removeClass("active");
				$("#case_"+ current_case).addClass("active");

				SetupPagination(date[current_case]);

				$("#preMed div.active").removeClass("active");
				$("#page_"+ current_case + "_"+ current_page).addClass("active");
				$("#caseDate").text(caseDateArr[current_case]);
				$("#preDate").text(dateArr[current_case + "_" + current_page]);
				$('#casePagination .page-item.active').removeClass('active');
				$("#casePagination [data-page='" + current_case + "']").addClass('active');
				if (current_case == items){
					$("#casePagination .next").addClass('disabled');
				} else {
					$("#casePagination .next").removeClass('disabled');
				}
				if (current_case == 1){
					$("#casePagination .previous").addClass('disabled');
				} else {
					$("#casePagination .previous").removeClass('disabled');
				}
				console.log(description);
				e.handeled = true;
			}
			return false;
		});
		$("#casePagination .page").on('click',function (e) {
			if(e.handeled !== true) {
				const page = $(this).data('page');
				current_case = page;
				$(".description div.active").removeClass("active");
				$("#case_"+ current_case).addClass("active");

				SetupPagination(date[current_case]);

				$("#preMed div.active").removeClass("active");
				$("#page_"+ current_case + "_"+ current_page).addClass("active");
				$("#caseDate").text(caseDateArr[current_case]);
				$("#preDate").text(dateArr[current_case + "_" + current_page]);
				$('#casePagination .page-item.active').removeClass('active');
				$(this).addClass('active');
				if (current_case == items){
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

	function SetupPagination (date) {
		pagination_element.html("");
		let page_count = date.length;
		current_page = page_count;
		let btn = '<li class="page-item previous  ' + ((page_count==1) ? 'disabled' : '' ) +'"> <a aria-disabled="true" aria-label="Previous" class="page-link" href="javascript:void(0)" tabindex="-1"> <span class="icofont-simple-left"></span> </a> </li>';
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
		btn = '<li class="page-item next disabled"><a aria-label="Next" class="page-link" href="javascript:void(0)"><span class="icofont-simple-right"></span></a></li>';
		pagination_element.append(btn);
		$("#pagination .next").on('click',function (e) {
			if(e.handeled !== true) {
				current_page = $('#pagination .page-item.active').data('page');
				current_page++;

				$("#preMed div.active").removeClass("active");
				$("#page_"+ current_case + "_"+ current_page).addClass("active");
				$("#preDate").text(dateArr[current_case +"_"+ current_page]);

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

				$("#preMed div.active").removeClass("active");
				$("#page_"+ current_case + "_"+ current_page).addClass("active");
				$("#preDate").text(dateArr[current_case +"_"+ current_page]);

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

				$("#preMed div.active").removeClass("active");
				$("#page_"+ current_case + "_"+ current_page).addClass("active");
				$("#preDate").text(dateArr[current_case +"_"+ current_page]);

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

	function choose(){
		$("#attach").trigger('click');
	}

	$("#fetchReport").on('click', function () {
		$("#reportList").html('');
		let pmdId = $("#pmdId_"+ current_case).val();

		$.ajax({
			url: '<?= base_url()?>doctor/checkup/fetchReport/'+ pmdId,
			dataType: 'json',
			success:function(data){
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += '<li>\n' +
						'<a href="<?= base_url()?>reports/' + data[i].src + '" style="color: #1f2022;font-size: 17px;" target="_blank">' + data[i].src + '</a>\n' +
						'<button type="button" class="float-right btn btn-danger btn-sm btn-square float-right removeRow">\n' +
						'<span class="btn-icon icofont-close"></span>\n' +
						'</button>\n' +
						'\n' +
						'</li>';
				}

				$("#reportList").html(html);

			}
		});
	});

	$("#attach").on('change', function () {

		let pmdId = $("#pmdId_"+ current_case).val();
		let fd = new FormData();
		let files = $(this).prop('files')[0];
		fd.append('file', files);
		fd.append('pmdId', pmdId);
		$.ajax({
			url: '<?= base_url()?>doctor/checkup/attachReport' ,
			type: 'post' ,
			data: fd ,
			contentType: false ,
			processData: false ,
			beforeSend: function () {
				spinner.removeAttr('hidden');
			},
			success:function(data){
				const obj = JSON.parse(data);
				let html = '';
				for (let i = 0; i < obj.length; i++) {
					html += '<li>\n' +
						'<a href="<?= base_url()?>reports/' + obj[i].src + '" style="color: #1f2022;font-size: 17px;" target="_blank">' + obj[i].src + '</a>\n' +
						'<button type="button" class="float-right btn btn-danger btn-sm btn-square float-right removeRow">\n' +
						'<span class="btn-icon icofont-close"></span>\n' +
						'</button>\n' +
						'\n' +
						'</li>';
				}

				$("#reportList").html(html);

			},
			complete: function () {
				spinner.attr('hidden', '');
			}

		});
	});


</script>
</body>
</html>
