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
		.section #queue li,
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
						<div class="col-12 col-md-3 pr-1" >
							<header class="page-header"><h3 class="page-title" style="margin: 0 10px 1rem;">Patient Queue</h3></header>
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
							<header class="page-header"><h3 class="page-title" style="margin: 0 10px 1rem;">Patient Medical Record</h3></header>
							<div class="page-content">
								<div class="section">
									<div class="card mb-0">
										<div class="card-body text-left">
											<div class="profileSec w-100">
												<div class="profile  float-left " style="width: 40%">
													<h5 class="m-0"><span id="name">Mehul Sherdiwala</span></h5>
													<b>Age:</b> <span id="age">20</span>
													<b class="ml-4">Gender:</b> <span id="gender">Male</span>
												</div>
												<div class="profile float-right" style="width: 59%">
													<b>Date:</b> <span id="date">06-03-2020</span>
													<br>
													<b>Description:</b>
													<input type="hidden" id="hiddenDesc">
													<span id="desc">Description</span>
												</div>
											</div>
											<div class="caseSec">
												<div class="row" style="margin: 0">
													<div style="width: 80%">
														<div class="description">
															<b>Case Description</b>
															<b class="ml-4">Date : </b><span id="caseDate"></span>
															<div class="desc">
															</div>
														</div>
													</div>
													<div style="margin-left: 10px;margin-top: 20px;text-align: right">
														<div class="reportsSec">
															<button type="button" class="btn btn-info">
																<b>Medical Reports</b>
															</button>
															<br>
															<br>
															<button type="button" class="btn btn-suc">
																<b>New Case</b>
															</button>
														</div>
													</div>
												</div>
											</div>
											<div class="preSec position-relative">
												<b>Medicine</b>
												<br>
												<label>Date :</label><span id="preDate">06-05-2020</span>
												<button type="button" class="btn btn-suc btn-sm float-right mr-2" style="position: absolute;top:0;right: 15px" id="add-pre"><span class="btn-icon icofont-plus"></span></button>
												<div class="pre">
													<table class="table" id="preMed">
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
							<div class="pageSec d-flex justify-content-between mt-4">
								<button class="btn btn-danger">Absent</button>
								<nav>
									<ul class="pagination" id="pagination">
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
								<!--								<div id="pagination"></div>-->
								<button type="submit" class="btn btn-suc">Next</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</main>
		<div class="content-overlay"></div>
	</div>
</div>
<!-- Add patients modals -->
<div aria-hidden="true" class="modal fade" id="add-patient" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Add new patient</h5></div>
			<div class="modal-body">
				<form>
					<div class="form-group avatar-box d-flex"><img alt="" class="rounded-500 mr-4"
																   height="40" src="<?= base_url() ?>assets/content/anonymous-400.jpg" width="40">
						<button class="btn btn-outline-primary" type="button">Select image<span
								class="btn-icon icofont-ui-user ml-2"></span></button>
					</div>
					<div class="form-group"><input class="form-control" placeholder="Name" type="text"></div>
					<div class="form-group"><input class="form-control" placeholder="Number" type="number"></div>
					<div class="row">
						<div class="col-12 col-sm-6">
							<div class="form-group"><input class="form-control" placeholder="Age" type="number"></div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group"><select class="form-control" title="Gender">
									<option class="d-none">Gender</option>
									<option>Male</option>
									<option>Female</option>
								</select></div>
						</div>
					</div>
					<div class="form-group mb-0"><textarea class="form-control" placeholder="Address"
														   rows="3"></textarea></div>
				</form>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
					<button class="btn btn-info" type="button">Add patient</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- end Add patients modals --><!-- Add patients modals -->
<div aria-hidden="true" class="modal fade" id="settings" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Application's settings</h5></div>
			<div class="modal-body">
				<form>
					<div class="form-group"><label>Layout</label> <select class="form-control" id="layout"
																		  title="Layout">
							<option value="horizontal-layout">Horizontal</option>
							<option value="vertical-layout">Vertical</option>
						</select></div>
					<div class="form-group"><label>Light/dark topbar</label>
						<div class="custom-control custom-switch"><input class="custom-control-input" id="topbar"
																		 type="checkbox"> <label
								class="custom-control-label" for="topbar"></label></div>
					</div>
					<div class="form-group"><label>Light/dark sidebar</label>
						<div class="custom-control custom-switch"><input class="custom-control-input" id="sidebar"
																		 type="checkbox"> <label
								class="custom-control-label" for="sidebar"></label></div>
					</div>
					<div class="form-group mb-0"><label>Boxed/fullwidth mode</label>
						<div class="custom-control custom-switch"><input checked="checked" class="custom-control-input"
																		 id="boxed" type="checkbox"> <label
								class="custom-control-label" for="boxed"></label></div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-secondary" data-dismiss="modal" type="button">Cancel</button>
					<button class="btn btn-error" id="reset-to-default" type="button">Reset to default</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- end Add patients modals --><!-- Add appointment modals -->
<div aria-hidden="true" class="modal fade" id="schedule" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Schedule</h5></div>
			<div class="modal-body" id="body">
				<div class="section" data-rowid="1">
					<div class="row">
						<div class="col-md-11">
							<div class="form-group">
								<label for="">Day</label>
								<select class="form-control daySelector">
									<option value="">Select</option>
									<?php
									foreach ($day as $d)
									{
										echo '<option value="' . $d['wdId'] . '">' . $d['day'] . '</option>';
									}
									?>
								</select>
								<input type="hidden" class="items" value="1">
							</div>
						</div>
						<div class="col-md-1">
							<button type="button" class="btn btn-danger btn-sm btn-square float-right removeRow"
									style="height: 35px;margin-top: -7px;">
								<span class="btn-icon icofont-close"></span>
							</button>
							<button type="button" id="addsy" class="btn btn-suc btn-sm btn-square float-right add-time"
									style="height: 35px;margin-top: 5px;">
								<span class="btn-icon icofont-plus"></span>
							</button>
						</div>
					</div>
					<div class="secTime">
						<div class="row">
							<div class="col-md-11">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="">Start Time</label>
											<input type="text" class="form-control startTime" id="startTime_1">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="">End Time</label>
											<input type="text" class="form-control endTime" id="endTime_1">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-1">
								<button type="button" id="addsy" class="btn btn-danger btn-sm btn-square float-right remove-time"
										style="height: 35px;margin-top: 33px;">
									<span class="btn-icon icofont-close"></span>
								</button>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
					<button type="button" id="addday" class="btn btn-suc btn-sm btn-square float-right"
							style="height: 35px;">
						<span class="btn-icon icofont-plus"></span>
					</button>
					<button class="btn btn-info" data-dismiss="modal" type="button" id="saveTime">Save</button>
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
<!--<script src="<?= base_url() ?>assets/js/jquery.barrating.min.js"></script>-->
<!--<script src="<?= base_url() ?>assets/js/Chart.min.js"></script>-->
<!--<script src="<?= base_url() ?>assets/js/raphael-min.js"></script>-->
<!--<script src="<?= base_url() ?>assets/js/morris.min.js"></script>-->
<!--<script src="<?= base_url() ?>assets/js/echarts.min.js"></script>-->
<!--<script src="<?= base_url() ?>assets/js/echarts-gl.min.js"></script>-->
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

	const med = '<?= $html?>';
	queue();
	async function queue(){
		const response = await fetch('<?= base_url()?>doctor/checkup/queue');
		const data = await response.json();

		let html ='';
		for (let i = 0;i < data.length;i++) {
			html += '<li data-appid="' + data[i].appId + '">\n' +
				'<h4 class="m-0">' + data[i].username + '</h4>\n' +
				'<p>' + data[i].description + '</p>\n' +
				'</li>';
		}
		$("#queue").html(html).fadeIn();
		$("#queue li").on('click', function () {
			const appId = $(this).data('appid');
			fetchDetails(appId);
		});
	}

	const list_element = $('#preMed');
	const pagination_element = $('#pagination');
	const casePagination = $('#casePagination');

	let current_page = 1;
	let current_case = 1;

	async function fetchDetails(appId){
		spinner.removeAttr('hidden');

		const response = await fetch('<?= base_url()?>doctor/checkup/fetchCheckupDetails/' + appId);
		const data = await response.json();

		// console.log(data);
		// console.log(Object.keys(data.pre));

		$("#name").text(data.patient.name);
		$("#age").text(data.patient.age);
		$("#gender").text(data.patient.gender);
		$("#date").text(data.pmr.datetime);
		$("#desc").text(data.pmr.pmrDescription);

		if (data.pmd.length > 0){


			DisplayCase(data.pmd,1,data.pre,1);
			CasePagination(data.pmd, data.pre);

			// for (let i = 0; i < data.pmd.length; i++) {
			//
			// 	console.log(data.pmd[i]);
			//
			// 	$("#caseDate").text(data.pmd[i].datetime);
			// 	if (data.pmd[i].description != '') {
			// 		var HTMLstring = data.pmd[i].description;
			// 		$('.desc').html(HTMLstring);
			// 	} else {
			// 		$('.desc').summernote({
			// 			focus: 0 , toolbar: [
			// 				['style' , ['bold' , 'italic' , 'underline' , 'clear']] ,
			// 				['fontsize' , ['fontsize']] ,
			// 				['color' , ['color']] ,
			// 				['para' , ['ul' , 'ol' , 'paragraph']] ,
			// 				['save' , ['save']]
			// 			] , buttons: {
			// 				save: SaveButton
			// 			}
			// 		});
			// 	}
			// }

		}

		current_page = 1;
		// DisplayList(data.pre, date, list_element, 1);
		// SetupPagination(data.pre,date , pagination_element);


		spinner.attr('hidden', '');
	}

	$("#add-pre").on('click', function () {
		const id = (Math.random() / +new Date()).toString(36).replace(/[^a-z]+/g, '');
		let html = '<tr>\n' +
			'<td>\n' +
			'<select name="" id="selectpicker_' + id + '" class="form-control selectpicker" data-live-search="true">\n' +
			'<option value="">Select Medicine</option>\n' +
			med +
			'</select>\n' +
			'</td>\n' +
			'<td width="150px">\n' +
			'<input type="number" class="form-control" placeholder="Quantity">\n' +
			'</td>\n' +
			'<td width="270px">\n' +
			'<div class="d-flex justify-content-center">\n' +
			'<div class="custom-control custom-radio mb-3">\n' +
			'<input type="radio" class="custom-control-input" id="before_' + id + '" name="eat">\n' +
			'<label class="custom-control-label" for="before_' + id + '">Before</label>\n' +
			'</div> &nbsp;\n' +
			'<div class="custom-control custom-radio mb-3">\n' +
			'<input type="radio" class="custom-control-input" id="after_' + id + '" name="eat">\n' +
			'<label class="custom-control-label" for="after_' + id + '">After</label>\n' +
			'</div>\n' +
			'</div>\n' +
			'<div class="d-flex justify-content-center">\n' +
			'<div class="custom-control custom-checkbox mb-3">\n' +
			'<input type="checkbox" class="custom-control-input" id="morning_' + id + '">\n' +
			'<label class="custom-control-label" for="morning_' + id + '">Morning</label>\n' +
			'</div> &nbsp;\n' +
			'<div class="custom-control custom-checkbox mb-3">\n' +
			'<input type="checkbox" class="custom-control-input" id="noon_' + id + '">\n' +
			'<label class="custom-control-label" for="noon_' + id + '">Noon</label>\n' +
			'</div> &nbsp;\n' +
			'<div class="custom-control custom-checkbox mb-3">\n' +
			'<input type="checkbox" class="custom-control-input" id="night_' + id + '">\n' +
			'<label class="custom-control-label" for="night_' + id + '">Night</label>\n' +
			'</div>\n' +
			'</div>\n' +
			'</td>\n' +
			'<td width="70px">\n' +
			'<button class="btn btn-danger btn-sm btn-square rounded-pill remove"><span class="btn-icon icofont-close"></span></button>\n' +
			'</td>\n' +
			'</tr>';

		$("#preMed").append(html);
		$("#selectpicker_" + id).selectpicker({
			style: '',
			styleBase: 'form-control',
			tickIcon: 'icofont-check-alt'
		});
		$(".remove").on('click', function () {
			$(this).closest('tr').remove();
		});
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
				context.destroy();
			}
		});

		return button.render();
	};
	$(".desc").on('click',function () {
		$('.desc').summernote({focus: 0,toolbar: [
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
		casePage--;
		$("#caseDate").text(items[casePage].datetime);
		if (items[casePage].description != '') {
			var HTMLstring = items[casePage].description;
			$('.desc').html(HTMLstring);
		} else {
			$('.desc').summernote({
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
		const date = Object.keys(dateItem[items[casePage].pmdId]);

		current_page = 1;
		DisplayList(dateItem[items[casePage].pmdId], date, page);
		SetupPagination(dateItem[items[casePage].pmdId],date);

	}

	function DisplayList (items,date, page) {
		list_element.html("");
		page--;
		for (let i = 0; i < items[date[page]].length; i++) {
			$("#preDate").text(date[page]);
			const id = (Math.random() / +new Date()).toString(36).replace(/[^a-z]+/g , '');
			let html = '<tr>\n' +
				'<td>\n' +
				'<select name="" id="selectpicker_' + id + '" class="form-control selectpicker" data-live-search="true">\n' +
				'<option value="">Select Medicine</option>\n' +
				med +
				'</select>\n' +
				'</td>\n' +
				'<td width="150px">\n' +
				'<input type="number" class="form-control" placeholder="Quantity" name="qty[]" value="' + items[date[page]][i].qty + '">\n' +
				'</td>\n' +
				'<td width="270px">\n' +
				'<div class="d-flex justify-content-center">\n' +
				'<div class="custom-control custom-radio mb-3">\n' +
				'<input type="radio" class="custom-control-input" id="before_' + id + '" name="eat[' + id + ']" ' + ((items[date[page]][i].dineSuggestion == 1)? 'checked':'') + '>\n' +
				'<label class="custom-control-label" for="before_' + id + '">Before</label>\n' +
				'</div> &nbsp;\n' +
				'<div class="custom-control custom-radio mb-3">\n' +
				'<input type="radio" class="custom-control-input" id="after_' + id + '" name="eat[' + id + ']" ' + ((items[date[page]][i].dineSuggestion == 2)? 'checked':'') + '>\n' +
				'<label class="custom-control-label" for="after_' + id + '">After</label>\n' +
				'</div>\n' +
				'</div>\n' +
				'<div class="d-flex justify-content-center">\n' +
				'<div class="custom-control custom-checkbox mb-3">\n' +
				'<input type="checkbox" class="custom-control-input" id="morning_' + id + '"  ' + ((items[date[page]][i].timesPerDay.morning == 1)? 'checked':'') + '>\n' +
				'<label class="custom-control-label" for="morning_' + id + '">Morning</label>\n' +
				'</div> &nbsp;\n' +
				'<div class="custom-control custom-checkbox mb-3">\n' +
				'<input type="checkbox" class="custom-control-input" id="noon_' + id + '"  ' + ((items[date[page]][i].timesPerDay.noon == 1)? 'checked':'') + '>\n' +
				'<label class="custom-control-label" for="noon_' + id + '">Noon</label>\n' +
				'</div> &nbsp;\n' +
				'<div class="custom-control custom-checkbox mb-3">\n' +
				'<input type="checkbox" class="custom-control-input" id="night_' + id + '"  ' + ((items[date[page]][i].timesPerDay.night == 1)? 'checked':'') + '>\n' +
				'<label class="custom-control-label" for="night_' + id + '">Night</label>\n' +
				'</div>\n' +
				'</div>\n' +
				'</td>\n' +
				'<td width="70px">\n' +
				'<button class="btn btn-danger btn-sm btn-square rounded-pill remove"><span class="btn-icon icofont-close"></span></button>\n' +
				'</td>\n' +
				'</tr>';

			$("#preMed").append(html);
			$("#selectpicker_" + id + ">option[value=" + items[date[page]][i].pwmId + "]").prop("selected" , true);

			$("#selectpicker_" + id).selectpicker({
				style: '' ,
				styleBase: 'form-control' ,
				tickIcon: 'icofont-check-alt'
			});

		}

	}

	function CasePagination (items, dateItems) {
		casePagination.html("");
		let page_count = items.length;
		let btn = '<li class="page-item previous disabled"> <a aria-disabled="true" aria-label="Previous" class="page-link" href="javascript:void(0)" tabindex="-1"> <span class="icofont-simple-left"></span> </a> </li>';
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
		btn = '<li class="page-item next ' + ((i==2) ? 'disabled' : '') +'"><a aria-label="Next" class="page-link" href="javascript:void(0)"><span class="icofont-simple-right"></span></a></li>';
		casePagination.append(btn);
		$("#casePagination .next").on('click',function (e) {
			if(e.handeled !== true) {
				current_case = $('#casePagination .page-item.active').data('page');
				items[current_case-1].description = $(".desc").text();
				console.log(items);

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
		let btn = '<li class="page-item previous disabled"> <a aria-disabled="true" aria-label="Previous" class="page-link" href="javascript:void(0)" tabindex="-1"> <span class="icofont-simple-left"></span> </a> </li>';
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
		btn = '<li class="page-item next ' + ((i==2) ? 'disabled' : '') +'"><a aria-label="Next" class="page-link" href="javascript:void(0)"><span class="icofont-simple-right"></span></a></li>';
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


</script>
</body>
</html>
