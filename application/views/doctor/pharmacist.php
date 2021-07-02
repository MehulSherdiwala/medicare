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
				<header class="page-header"><h1 class="page-title">Pharmacist</h1></header>
				<div class="page-content">
					<div class="card mb-0">
						<div class="card-body">
							<div class="table-responsive" id="data">

							</div>
						</div>
					</div>
					<div class="add-action-box">
						<button class="btn btn-primary btn-lg btn-square rounded-pill" id="fetch" data-target="#schedule"
								data-toggle="modal"><span class="btn-icon icofont icofont-plus"></span>
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
			<div class="modal-header"><h5 class="modal-title">Add Pharmacist</h5></div>
			<div class="modal-body" id="body">
				<div class="form-group">
					<label class="control-label">Pharmacist</label>
					<select id="pharId" class="form-control selectpicker" data-live-search="true">
						<option value="0">Select</option>
						<?php
						foreach ($phar as $d)
						{
							echo '<option value="' . $d['pharId'] . '">' . $d['pharName'] . '</option>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
					<button class="btn btn-info" data-dismiss="modal" type="button" id="save">Save</button>
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
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script>

	fetchPhar();
	async function fetchPhar() {
		const response = await fetch('<?= base_url()?>doctor/pharmacist/fetchPhar');
		const myJson = await response.json();
		let html = '';
		html += '<table class="table table-bordered" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">Id</th>\n' +
			'<th scope="col">Pharmacist Id </th>\n' +
			'<th scope="col">Pharmacist Name </th>\n' +
			'<th scope="col"></th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < myJson.length; i++) {

			html += '<tr>\n' +
				'<td>'+ myJson[i].dophId+'</td>\n' +
				'<td>'+ myJson[i].pharId+'</td>\n' +
				'<td>'+ myJson[i].username+'</td>\n' +
				'<td>' +
				'<div class="actions">\n' +
				'<button class="btn btn-error btn-sm btn-square rounded-pill delete-phar" data-dophid="'+ myJson[i].dophId+'"><span\n' +
				'class="btn-icon icofont-ui-delete"></span></button>\n' +
				'</div>\n' +
				'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#data").html(html);

		$(".delete-phar").on('click', function () {
			const dophId = $(this).data('dophid');
			deletePhar(dophId);
		})
	}

	async function deletePhar(dophId){
		const res = await fetch('<?= base_url()?>doctor/pharmacist/deletePhar/' + dophId);
		await fetchPhar();
	}

	$("#save").on('click', function () {
		const pharId = $("#pharId").val();
		$.ajax({
			url: '<?= base_url() ?>doctor/pharmacist/addPhar',
			method: 'post',
			data: {
				pharId:pharId
			},
			dataType: 'json',
			success:function (data) {
				fetchPhar();
			}
		})
	});

</script>
</body>
</html>
