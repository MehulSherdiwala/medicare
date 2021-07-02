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
                <header class="page-header"><h1 class="page-title">Disease</h1></header>
                <div class="page-content">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive" id="data">

                            </div>
                        </div>
                    </div>
                    <div class="add-action-box">
                        <button class="btn btn-primary btn-lg btn-square rounded-pill" data-target="#add-disease"
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
                            <li class="item"><a class="link" href="javascript:void(0)">Disease</a> <i
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
<div aria-hidden="true" class="modal fade" id="add-disease" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Add new Disease</h5></div>
            <div class="modal-body">
                <form id="add-disease-parsley">
                    <div class="form-group"><input class="form-control" id="disName" placeholder="Disease Name" type="text" required></div>
                    <div class="form-group">
						<textarea id="disDesc" class="form-control" placeholder="Description" required></textarea>
					</div>
					<h5 class="ml-2">Symptoms
						<button type="button" id="addsy" class="btn btn-suc btn-sm btn-square float-right" style="height: 35px">
							<span class="btn-icon icofont-plus"></span>
						</button>
					</h5>

					<div id="symptoms">
						<div class="form-group cust-group" id="sy_1">
							<textarea class="form-control syDesc" placeholder="Description" ></textarea>
							<button type="button" class="btn btn-danger btn-sm btn-square btn-remove">
								<span class="btn-icon icofont-close"></span>
							</button>
						</div>
					</div>
                </form>
            </div>
            <div class="modal-footer d-block">
                <div class="actions justify-content-between">
                    <button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-info" type="button" id="addDis">Add Disease</button>
                </div>
            </div>
        </div>
    </div>
</div><!-- end Add appointment modals -->
<div aria-hidden="true" class="modal fade" id="edit-disease" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Edit Disease</h5></div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group"><input class="form-control" id="editDisName" placeholder="Disease Name" type="text"></div>
                    <div class="form-group">
						<textarea id="editDisDesc" class="form-control" placeholder="Description"></textarea>
						<input type="hidden" id="editDisId">
					</div>
					<h5 class="ml-2">Symptoms
						<button type="button" id="editAddsy" class="btn btn-suc btn-sm btn-square float-right" style="height: 35px">
							<span class="btn-icon icofont-plus"></span>
						</button>
					</h5>

					<div id="editSymptoms">
					</div>
                </form>
            </div>
            <div class="modal-footer d-block">
                <div class="actions justify-content-between">
                    <button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-info" data-dismiss="modal" type="button" id="editDis">Edit Disease</button>
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
	let pars = $("#add-disease-parsley").parsley();
	$("#addsy").on('click', function () {
		let html = '<div class="form-group cust-group">'+
				'<textarea class="form-control syDesc" placeholder="Description" ></textarea>'+
				'<button type="button" class="btn btn-danger btn-sm btn-square btn-remove">'+
				'<span class="btn-icon icofont-close"></span>'+
				'</button>'+
			'</div>';
		$("#symptoms").append(html);

		$(".btn-remove").on('click', function () {
			const div = $(this).parent().closest('.cust-group').remove();
		});
	});
	$("#editAddsy").on('click', function () {
		let html = '<div class="form-group cust-group">'+
				'<textarea class="form-control editsyDesc" placeholder="Description" ></textarea>'+
				'<button type="button" class="btn btn-danger btn-sm btn-square btn-remove">'+
				'<span class="btn-icon icofont-close"></span>'+
				'</button>'+
			'</div>';
		$("#editSymptoms").append(html);

		$(".btn-remove").on('click', function () {
			const div = $(this).parent().closest('.cust-group').remove();
		});
	});

	$(".btn-remove").on('click', function () {
		const div = $(this).parent().closest('.cust-group').remove();
	});

	$("#addDis").on('click', function () {
		pars.validate();
		if(pars.isValid()) {
			let syDesc = [];
			$(".syDesc").each(function () {
				syDesc.push($(this).val());
			});
			const disName = $("#disName").val();
			const disDesc = $("#disDesc").val();
			$.ajax({
				url:'<?= base_url() ?>admin/Disease/addDisease',
				method: 'post' ,
				data: {
					disName: disName ,
					disDesc: disDesc ,
					syDesc: syDesc
				} ,
				success: function (data) {
					fetchDisease();
					$("#add-disease").modal('toggle');
					$("#add-disease-parsley").trigger('reset');
				}
			})
		}
	});

	fetchDisease();
	async function fetchDisease() {
		const response = await fetch('<?= base_url()?>admin/Disease/fetchDisease');
		const myJson = await response.json();
		let html = '';
		html += '<table class="table" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">Disease Id</th>\n' +
			'<th scope="col">Disease Name</th>\n' +
			'<th scope="col">Description</th>\n' +
			'<th scope="col">Symptoms</th>\n' +
			'<th scope="col">Actions</th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < myJson.length; i++) {

			 html += '<tr>\n' +
				'<td>'+ myJson[i].disId+'</td>\n' +
				'<td>'+ myJson[i].disName+'</td>\n' +
				'<td>'+ myJson[i].description+'</td>\n' +
				'<td>'+ myJson[i].syDesc+'</td>\n' +
				'<td>\n' +
				'<div class="actions">\n' +
				'<button class="btn btn-info btn-sm btn-square rounded-pill edit-disease" data-disid="'+ myJson[i].disId+'" data-target="#edit-disease" data-toggle="modal"><span\n' +
				'class="btn-icon icofont-ui-edit"></span></button>\n' +
				'<button class="btn btn-error btn-sm btn-square rounded-pill delete-disease" data-disid="'+ myJson[i].disId+'"><span\n' +
				'class="btn-icon icofont-ui-delete"></span></button>\n' +
				'</div>\n' +
				'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#data").html(html);
		$("#data-table").DataTable();

		$(".edit-disease").on('click', function () {
			$("#editForm").trigger('reset');
			$("#editSymptoms").text('');
			const disId = $(this).data("disid");
			fetchDis(disId);
		});

		$(".delete-disease").on('click',function () {
			const disId = $(this).data("disid");
			console.log((disId));
			deleteDis(disId);
		});
	}

	async function fetchDis(id) {
		const response = await fetch('<?= base_url()?>admin/Disease/fetchDisease/'+ id);
		const myJson = await response.json();

		$("#editDisName").val(myJson.disName);
		$("#editDisDesc").val(myJson.description);
		$("#editDisId").val(myJson.disId);
		const sy = myJson.syDesc;
		let html = '';
		$.each(sy,function (k,item) {
			html += '<div class="form-group cust-group">'+
				'<textarea class="form-control editsyDesc" placeholder="Description" >' + item + '</textarea>'+
				'<button type="button" class="btn btn-danger btn-sm btn-square btn-remove">'+
				'<span class="btn-icon icofont-close"></span>'+
				'</button>'+
				'</div>';
		});
		$("#editSymptoms").append(html);
		$(".btn-remove").on('click', function () {
			const div = $(this).parent().closest('.cust-group').remove();
		});
	}

	$("#editDis").on('click', function () {
		let syDesc = [];
		$(".editsyDesc").each(function () {
			syDesc.push($(this).val());
		});

		const disId = $("#editDisId").val();
		const disName = $("#editDisName").val();
		const disDesc = $("#editDisDesc").val();
		$.ajax({
			url:'<?= base_url() ?>admin/Disease/editDisease',
			method: 'post',
			data:{
				disId:disId,
				disName:disName,
				disDesc:disDesc,
				syDesc:syDesc
			},
			success:function (data) {
				fetchDisease();
			}
		})
	});

	$(".delete-disease").on('click',function () {
		const disId = $(this).data("disid");
		console.log((disId));
		deleteDis(disId);
	});

	async function deleteDis(id) {
		const response = await fetch('<?= base_url()?>admin/Disease/deleteDisease/' + id);
		// const myJson = await response.json();
		await fetchDisease();
	}
</script>
</body>
</html>
