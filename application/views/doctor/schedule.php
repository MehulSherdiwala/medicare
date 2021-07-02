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

	<link href="<?= base_url() ?>assets/css/datatables.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/plugins/time-picker/mdtimepicker.css?version=3" rel="stylesheet">
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
			padding: 15px;
			border-radius: 10px;
			border: 1px solid #e0d9d9;
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
				<header class="page-header"><h1 class="page-title">Doctors Schedule</h1></header>
				<div class="page-content">
					<div class="card mb-0">
						<div class="card-body">
							<div class="table-responsive" id="data">

							</div>
						</div>
					</div>
					<div class="add-action-box">
						<button class="btn btn-primary btn-lg btn-square rounded-pill" id="fetch" data-target="#schedule"
								data-toggle="modal"><span class="btn-icon far fa-calendar-plus"></span>
						</button>
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
							<li class="item"><a class="link" href="javascript:void(0)">Schedule</a> <i
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
<script src="<?= base_url() ?>assets/js/main.js"></script>
<?php
foreach ($day as $d)
{
	$html .= '<option value="' . $d['wdId'] . '">' . $d['day'] . '</option>';
}
?>
<script>
	$('#startTime_1').mdtimepicker({theme: 'red'}); //Initializes the time picker
	$('#endTime_1').mdtimepicker({theme: 'red'}); //Initializes the time picker

	let doc = '<?= $html?>';
	$(".add-time").on('click', function (e) {
		if (e.handled !== true) {
			const rowid = $(this).closest(".section").data('rowid');

			addTime(rowid);
			const item = $("[data-rowid='"+ rowid +"'] .items");
			item.val(parseInt(item.val())+1);
			e.handled = true;
		}
		return false;
	});
	let cnt = 1;

	function addTime(rowId){
		cnt++;
		let html = '<div class="row">\n' +
			'<div class="col-md-11">\n' +
			'<div class="row">\n' +
			'<div class="col-md-6">\n' +
			'<div class="form-group">\n' +
			'<label for="">Start Time</label>\n' +
			'<input type="text" class="form-control startTime" id="startTime_'+ cnt +'">\n' +
			'</div>\n' +
			'</div>\n' +
			'<div class="col-md-6">\n' +
			'<div class="form-group">\n' +
			'<label for="">End Time</label>\n' +
			'<input type="text" class="form-control endTime" id="endTime_'+ cnt +'">\n' +
			'</div>\n' +
			'</div>\n' +
			'</div>\n' +
			'</div>\n' +
			'<div class="col-md-1">\n' +
			'<button type="button" class="btn btn-danger btn-sm btn-square float-right remove-time"\n' +
			'style="height: 35px;margin-top: 33px;">\n' +
			'<span class="btn-icon icofont-close"></span>\n' +
			'</button>\n' +
			'</div>\n' +
			'</div>';
		$("[data-rowid='" + rowId + "'] .secTime").append(html);
		$('#startTime_'+ cnt).mdtimepicker({theme: 'red'});
		$('#endTime_'+ cnt).mdtimepicker({theme: 'red'});


		$(".remove-time").on('click', function () {
			const rowid = $(this).closest(".section").data('rowid');
			const item = $("[data-rowid='"+ rowid +"'] .items");
			item.val(parseInt(item.val())-1);
			$(this).closest('.row').remove();
		});
	}

	$(".remove-time").on('click', function () {
		const rowid = $(this).closest(".section").data('rowid');
		const item = $("[data-rowid='"+ rowid +"'] .items");

		item.val(parseInt(item.val())-1);
		$(this).closest('.row').remove();
	});

	$("#addday").on('click', function () {
		addDay();
	});
	let rowCnt = 1;
	function addDay(){
		rowCnt++;
		cnt++;

		let html = '<div class="section mt-3" data-rowid="'+ rowCnt +'">\n'+
			'<div class="row">\n'+
			'<div class="col-md-11">\n'+
			'<div class="form-group">\n'+
			'<label for="">Day</label>\n'+
			'<select class="daySelector form-control">\n'+
			'<option value="">Select</option>\n';
			html += doc;
			html +='</select>\n' +
			'<input type="hidden" class="items" value="1">'+
			'</div>\n'+
			'</div>\n'+
			'<div class="col-md-1">\n'+
			'<button type="button" class="btn btn-danger btn-sm btn-square float-right removeRow"\n'+
			'style="height: 35px;margin-top: -7px;">\n'+
			'<span class="btn-icon icofont-close"></span>\n'+
			'</button>\n'+
			'<button type="button" id="addsy" class="btn btn-suc btn-sm btn-square float-right add-time"\n'+
			'style="height: 35px;margin-top: 5px;">\n'+
			'<span class="btn-icon icofont-plus"></span>\n'+
			'</button>\n'+
			'</div>\n'+
			'</div>\n'+
			'<div class="secTime">\n'+
			'<div class="row">\n'+
			'<div class="col-md-11">\n'+
			'<div class="row">\n'+
			'<div class="col-md-6">\n'+
			'<div class="form-group">\n'+
			'<label for="">Start Time</label>\n'+
			'<input type="text" class="form-control startTime" id="startTime_'+ cnt +'">\n'+
			'</div>\n'+
			'</div>\n'+
			'<div class="col-md-6">\n'+
			'<div class="form-group">\n'+
			'<label for="">End Time</label>\n'+
			'<input type="text" class="form-control endTime" id="endTime_'+ cnt +'">\n'+
			'</div>\n'+
			'</div>\n'+
			'</div>\n'+
			'</div>\n'+
			'<div class="col-md-1">\n'+
			'<button type="button" id="addsy" class="btn btn-danger btn-sm btn-square float-right remove-time"\n'+
			'style="height: 35px;margin-top: 33px;">\n'+
			'<span class="btn-icon icofont-close"></span>\n'+
			'</button>\n'+
			'</div>\n'+
			'</div>\n'+
			'</div>\n'+
			'</div>';

		$("#body").append(html);
		$('#startTime_'+ cnt).mdtimepicker({theme: 'red'});
		$('#endTime_'+ cnt).mdtimepicker({theme: 'red'});
		$(".removeRow").on('click', function () {
			$(this).closest('.section').remove()
		});
		$(".add-time").on('click', function (e) {
			if (e.handled !== true) {
				const rowid = $(this).closest(".section").data('rowid');
				addTime(rowid);
				const item = $("[data-rowid='"+ rowid +"'] .items");
				item.val(parseInt(item.val())+1);
				e.handled = true;
			}
			return false
		});
		$(".remove-time").on('click', function () {
			const rowid = $(this).closest(".section").data('rowid');
			const item = $("[data-rowid='"+ rowid +"'] .items");
			item.val(parseInt(item.val())-1);
			$(this).closest('.row').remove();
		});
	}

	$(".removeRow").on('click', function () {
		$(this).closest('.section').remove()
	});

	$("#saveTime").on('click', function () {
		let day = [];
		$(".daySelector").each(function () {
			day.push($(this).val());
		});
		let items = [];
		$(".items").each(function () {
			items.push($(this).val());
		});
		let startTime = [];
		$(".startTime").each(function () {
			startTime.push($(this).val());
		});
		let endTime = [];
		$(".endTime").each(function () {
			endTime.push($(this).val());
		});
		let acId = [];
		$(".acId").each(function () {
			acId.push($(this).val());
		});

		// console.log(day);

		$.ajax({
			url: '<?= base_url() ?>doctor/schedule/save',
			method: 'post',
			data: {
				day :day,
				items :items,
				startTime :startTime,
				endTime :endTime,
				acId :acId,
			},
			success:function (data) {
				fetchSchedule();
			}
		})
	});

	fetchSchedule();
	async function fetchSchedule() {
		const response = await fetch('<?= base_url()?>doctor/schedule/displaySchedule');
		const myJson = await response.json();
		let html = '';
		html += '<table class="table table-bordered" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">Day</th>\n' +
			'<th scope="col">Timing </th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < myJson.length; i++) {

			html += '<tr>\n' +
				'<td>'+ myJson[i].day+'</td>\n' +
				'<td>'+ myJson[i].time+'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#data").html(html);

	}

	$("#fetch").on('click', function () {
		$.ajax({
			url: '<?= base_url() ?>doctor/schedule/fetchSchedule',
			method: 'post',
			dataType: 'json',
			success:function (data) {
				// console.log(data);

				let html = '';
				for (let i = 0;i < data.length;i++){
					console.log(data[i].day);
					console.log(data[i].time);
					html += '<div class="section mt-3" data-rowid="'+ rowCnt +'">\n'+
						'<div class="row">\n'+
						'<div class="col-md-11">\n'+
						'<div class="form-group">\n'+
						'<label for="">Day</label>\n'+
						'<select class="daySelector form-control" id="daySelector_' + rowCnt + '">\n'+
						'<option value="">Select</option>\n';
					html += doc;
					html +='</select>\n' +
						'<input type="hidden" class="items" value="'+ data[i].time.length +'">'+
						'</div>\n'+
						'</div>\n'+
						'<div class="col-md-1">\n'+
						'<button type="button" class="btn btn-danger btn-sm btn-square float-right removeRow"\n'+
						'style="height: 35px;margin-top: -7px;">\n'+
						'<span class="btn-icon icofont-close"></span>\n'+
						'</button>\n'+
						'<button type="button" id="addsy" class="btn btn-suc btn-sm btn-square float-right add-time"\n'+
						'style="height: 35px;margin-top: 5px;">\n'+
						'<span class="btn-icon icofont-plus"></span>\n'+
						'</button>\n'+
						'</div>\n'+
						'</div>\n'+
						'<div class="secTime">\n';
					for (let j = 0;j < data[i].time.length;j++){
						console.log(data[i].time[j].startTime);
						console.log(data[i].time[j].endTime);
						html += '<div class="row">\n'+
							'<div class="col-md-11">\n'+
							'<div class="row">\n'+
							'<div class="col-md-6">\n'+
							'<div class="form-group">\n'+
							'<label for="">Start Time</label>\n'+
							'<input type="text" class="form-control startTime" id="startTime_'+ cnt +'" value="' + data[i].time[j].startTime + '"> \n' +
							' <input type="hidden" class="acId" value="' + data[i].time[j].acId + '">'+
							'</div>\n'+
							'</div>\n'+
							'<div class="col-md-6">\n'+
							'<div class="form-group">\n'+
							'<label for="">End Time</label>\n'+
							'<input type="text" class="form-control endTime" id="endTime_'+ cnt +'" value="' + data[i].time[j].endTime + '">\n'+
							'</div>\n'+
							'</div>\n'+
							'</div>\n'+
							'</div>\n'+
							'<div class="col-md-1">\n'+
							'<button type="button" id="addsy" class="btn btn-danger btn-sm btn-square float-right remove-time"\n'+
							'style="height: 35px;margin-top: 33px;">\n'+
							'<span class="btn-icon icofont-close"></span>\n'+
							'</button>\n'+
							'</div>\n'+
							'</div>\n';
							$('#startTime_'+ cnt).mdtimepicker({theme: 'red'});
							$('#endTime_'+ cnt).mdtimepicker({theme: 'red'});
						cnt++;

					}
					html += '</div>\n'+
						'</div>\n'+
						'</div>';

					rowCnt++;
				}
				$("#body").html(html);

				$(".daySelector").each(function (a,b) {
					let id = $(this).attr('id');
					$("#" + id + ">option[value=" + data[a].day + "]").prop("selected" , true);
				});
				$('.startTime').each(function (a) {
					let id = $(this).attr('id');
					let et = id.split("_");
					$('#'+ id).mdtimepicker({theme: 'red'});
					$('#endTime_'+ et[1]).mdtimepicker({theme: 'red'});
				});
				$(".removeRow").on('click', function () {
					$(this).closest('.section').remove()
				});
				$(".add-time").on('click', function (e) {
					if (e.handled !== true) {
						const rowid = $(this).closest(".section").data('rowid');
						addTime(rowid);
						const item = $("[data-rowid='"+ rowid +"'] .items");
						item.val(parseInt(item.val())+1);
						e.handled = true;
					}
					return false
				});
				$(".remove-time").on('click', function () {
					const rowid = $(this).closest(".section").data('rowid');
					const item = $("[data-rowid='"+ rowid +"'] .items");
					item.val(parseInt(item.val())-1);
					$(this).closest('.row').remove();
				});
			}
		})
	});

</script>
</body>
</html>
