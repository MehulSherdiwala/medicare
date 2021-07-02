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
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">
	<!-- Theme CSS -->
	<link href="<?= base_url() ?>assets/css/styleMedic.css?version=5" rel="stylesheet">
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
				<header class="page-header"><h1 class="page-title">States</h1></header>
				<div class="page-content">
					<div class="card mb-0">
						<div class="card-body">
							<div class="table-responsive" id="data">

							</div>
						</div>
					</div>
					<div class="add-action-box">
						<button class="btn btn-primary btn-lg btn-square rounded-pill" data-target="#add-state"
								data-toggle="modal"><span class="btn-icon icofont-plus"></span>
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
<div aria-hidden="true" class="modal fade" id="add-state" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Add new State</h5></div>
			<div class="modal-body">
				<form id="add-state-parsley">
					<div class="form-group"><input class="form-control" id="stateName" placeholder="State Name" type="text" required></div>

				</form>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
					<button class="btn btn-info" type="button" id="addS">Add State</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- end Add appointment modals -->
<div aria-hidden="true" class="modal fade" id="edit-state" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Edit State</h5></div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">State Id</label>
					<span class="form-control" id="editstateId"></span>
				</div>
				<div class="form-group">
					<label for="">State Name</label>
					<input type="text" class="form-control" id="editname">
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
<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>

<script>
	let pars = $("#add-state-parsley").parsley();
	fetchStateList();
	async function fetchStateList() {
		const response = await fetch('<?= base_url()?>admin/state/fetchStateList');
		const myJson = await response.json();
		let html = '';
		html += '<table class="table" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">State Id</th>\n' +
			'<th scope="col">State Name</th>\n' +
			'<th scope="col">Total Cities</th>\n' +
			'<th scope="col"></th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < myJson.length; i++) {

			html += '<tr>\n' +
				'<td>'+ myJson[i].stateId+'</td>\n' +
				'<td>'+ myJson[i].stateName+'</td>\n' +
				'<td>'+ myJson[i].totalCity+'</td>\n' +
				'<td>\n' +
				'<div class="actions">\n' +
				'<button class="btn btn-info btn-sm btn-square rounded-pill edit-state" data-stateid="'+ myJson[i].stateId+'" data-target="#edit-state" data-toggle="modal"><span\n' +
				'class="btn-icon icofont-ui-edit"></span></button>\n' +
				'</div>\n' +
				'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#data").html(html);
		$("#data-table").DataTable();


		$(".edit-state").on('click',function () {
			const docId = $(this).data("stateid");
			// const docStatus = $("#docStatus").val();
			fetchState(docId);
		});
	}

	async function fetchState(id) {
		const response = await fetch('<?= base_url()?>admin/state/fetchState/'+ id);
		const myJson = await response.json();

		$("#editstateId").text(myJson.stateId);
		$("#editname").val(myJson.stateName);
	}

	$("#editDoc").on('click', function () {
		const stateId = $("#editstateId").text();
		const stateName = $("#editname").val();

		$.ajax({
			url: '<?= base_url()?>admin/state/updateState' ,
			method: 'post',
			data: {
				stateId:stateId,
				stateName:stateName,
			},
			success:function (data) {
				fetchStateList();
			}
		})

	});

	$("#addS").on('click', function () {
		pars.validate();
		if(pars.isValid()) {
			const stateName = $("#stateName").val();

			$.ajax({
				url: '<?= base_url()?>admin/state/addState' ,
				method: 'post' ,
				data: {
					stateName: stateName ,
				} ,
				success: function (data) {
					fetchStateList();
					$("#add-state").modal('toggle');
					$("#add-state-parsley").trigger('reset');
				}
			})
		}
	});
</script>
</body>
</html>
