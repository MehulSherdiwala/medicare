<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MediCare</title>
	<meta content="MedicApp" name="keywords">
	<meta content="" name="description">
	<meta content="" name="author">
	<meta content="width=device-width,initial-scale=1" name="viewport"><!-- Favicon -->
	<link type="image/x-icon" href="<?= base_url() ?>assets/img/fav.png" rel="icon"><!-- Plugins CSS -->
	<link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/icofont.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/datatables.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/css/bootstrap-select.min.css" rel="stylesheet">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">
	<link href="<?= base_url() ?>assets/css/styleMedic.css?version=5" rel="stylesheet">
</head>
<body class="vertical-layout boxed">
<div class="app-loader main-loader">
	<div class="loader-box">
		<div class="bounceball"></div>
		<img src="<?= base_url() ?>assets/img/MediCareLogo.png" alt="logo">
	</div>
</div><!-- .main-loader -->
<div class="page-box">
	<div class="app-container"><!-- Horizontal navbar -->

		<?php
		include "sidebar.php"
		?>

		<main class="main-content">
			<div class="app-loader"><i class="icofont-spinner-alt-4 rotate"></i></div>
			<div class="main-content-wrap">
				<header class="page-header"><h1 class="page-title">Admin</h1></header>
				<div class="page-content">
					<div class="card mb-0">
						<div class="card-body">
							<div class="table-responsive" id="data">

							</div>
						</div>
					</div>
					<div class="add-action-box">
						<button class="btn btn-primary btn-lg btn-square rounded-pill" data-target="#add-admin"
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
							<li class="item"><a class="link" href="javascript:void(0)">Admind</a> <i
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
<div aria-hidden="true" class="modal fade" id="add-admin" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Add new Admin</h5></div>
			<div class="modal-body">
				<form id="add-admin-parsley">
					<input type="file" id="attach" name="profileImg" class="d-none">
					<button class="btn btn-outline-primary mb-3" type="button" onclick="choose()">Change photo<span
							class="btn-icon icofont-ui-user ml-2"></span></button>
					<div class="form-group"><input class="form-control" id="username" placeholder="Username" type="text" required></div>
					<div class="form-group"><input class="form-control" id="email" placeholder="Email" type="email" required></div>
					<div class="form-group"><input class="form-control" id="pwd" placeholder="Password" type="password" required></div>
				</form>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
					<button class="btn btn-info" type="button" id="addDis">Add Admin</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- end Add appointment modals -->
<div aria-hidden="true" class="modal fade" id="edit-admin" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Edit Admin</h5></div>
			<div class="modal-body">
				<form id="editForm">
					<div class="form-group avatar-box d-flex align-items-center"><img
							src="<?= base_url() ?>profile/profile.png" id="profile" width="100" height="100" alt=""
							class="rounded-500 mr-4">

						<input type="file" id="editattach" name="profileImg" class="d-none">
						<button class="btn btn-outline-primary" type="button" onclick="choose2()">Change photo<span
								class="btn-icon icofont-ui-user ml-2"></span></button>
					</div>
					<input type="hidden" id="aId">
					<div class="form-group"><input class="form-control" id="editUsername" placeholder="Username" type="text" required></div>
					<div class="form-group"><input class="form-control" id="editEmail" placeholder="Email" type="email" required></div>
					<div class="form-group">
						<select id="adminStatus" class="selectpicker">
							<option value="">Select</option>
							<option value="0">Active</option>
							<option value="1">Blocked</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
					<button class="btn btn-info" data-dismiss="modal" type="button" id="editDis">Edit Admin</button>
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
	let pars = $("#add-admin-parsley").parsley();
	$("#addDis").on('click', function () {
		pars.validate();
		if(pars.isValid()) {
			const username = $("#username").val();
			const email = $("#email").val();
			const pwd = $("#pwd").val();
			let profileImg = $("#attach")[0].files;
			let fd = new FormData();
			fd.append('profileImg',profileImg[0]);
			fd.append('username',username);
			fd.append('email',email);
			fd.append('pwd',pwd);

			$.ajax({
				url:'<?= base_url() ?>admin/Admin/addAdmin',
				method: 'post' ,
				data: fd ,
				contentType:false,
				processData:false,
				success: function (data) {
					fetchAdmin();
					$("#add-admin").modal('toggle');
					$("#add-admin-parsley").trigger('reset');
				}
			})
		}
	});

	fetchAdmin();
	async function fetchAdmin() {
		const response = await fetch('<?= base_url()?>admin/Admin/fetchAdminList');
		const myJson = await response.json();
		let html = '';
		html += '<table class="table" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">Admin Id</th>\n' +
			'<th scope="col">Username</th>\n' +
			'<th scope="col">Email</th>\n' +
			'<th scope="col">Join Date</th>\n' +
			'<th scope="col">Status</th>\n' +
			'<th scope="col">Actions</th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < myJson.length; i++) {

			html += '<tr>\n' +
				'<td>'+ myJson[i].aId+'</td>\n' +
				'<td>'+ myJson[i].username+'</td>\n' +
				'<td>'+ myJson[i].email+'</td>\n' +
				'<td>'+ myJson[i].joindate+'</td>\n' +
				'<td>'+ ((myJson[i].status == 0) ? '<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Blocked</span>')+'</td>\n' +
				'<td>\n' +
				'<div class="actions">\n' +
				'<button class="btn btn-info btn-sm btn-square rounded-pill edit-admin" data-aid="'+ myJson[i].aId+'" data-target="#edit-admin" data-toggle="modal"><span\n' +
				'class="btn-icon icofont-ui-edit"></span></button>\n' +
				'</div>\n' +
				'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#data").html(html);
		$("#data-table").DataTable();

		$(".edit-admin").on('click', function () {
			const aId = $(this).data("aid");
			fetchDis(aId);
		});
	}

	async function fetchDis(id) {
		const response = await fetch('<?= base_url()?>admin/Admin/fetchAdmin/'+ id);
		const myJson = await response.json();

		$("#editUsername").val(myJson.username);
		$("#aId").val(myJson.aId);
		$("#editEmail").val(myJson.email);
		$("#adminStatus>option[value=" + myJson.status + "]").prop("selected" , true);
		$('.selectpicker').selectpicker('refresh');

		$("#profile").attr('src','<?= base_url()?>profile/' + ((myJson.profileImg=='')?'profile.png':myJson.profileImg))

	}

	$("#editDis").on('click', function () {
		const aId = $("#aId").val();
		const username = $("#editUsername").val();
		const email = $("#editEmail").val();
		const status = $("#adminStatus").val();
		let profileImg = $("#editattach")[0].files;
		let fd = new FormData();
		fd.append('profileImg',profileImg[0]);
		fd.append('username',username);
		fd.append('email',email);
		fd.append('status',status);
		fd.append('aId',aId);
		$.ajax({
			url:'<?= base_url() ?>admin/Admin/editAdmin',
			method: 'post',
			data: fd,
			contentType:false,
			processData:false,
			success:function (data) {
				fetchAdmin();
			}
		})
	});

	function choose(){
		$("#attach").trigger('click');
	}
	function choose2(){
		$("#editattach").trigger('click');
	}
</script>
</body>
</html>
