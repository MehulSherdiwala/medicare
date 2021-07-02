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
                <header class="page-header"><h1 class="page-title">Commission</h1></header>
                <div class="page-content">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive" id="data">

                            </div>
                        </div>
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
                            <li class="item"><a class="link" href="javascript:void(0)">Commission</a> <i
                                    class="separator icofont-thin-right"></i></li>
                            <li class="item"><a class="link" href="javascript:void(0)">Commission Rate</a> <i
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
<div aria-hidden="true" class="modal fade" id="edit-commission" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Edit Commission</h5></div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
						<input id="hidecrId" type="hidden">
						<span class="form-control" id="crId"></span>
					</div>
                    <div class="form-group">
						<input type="number" id="rate" class="form-control" placeholder="Rate">
					</div>
					<div class="form-group">
						<span class="form-control" id="userType"></span>
					</div>
                </form>
            </div>
            <div class="modal-footer d-block">
                <div class="actions justify-content-between">
                    <button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-info" data-dismiss="modal" type="button" id="editCom">Edit Commission</button>
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

	fetchCommission();
	async function fetchCommission() {
		const response = await fetch('<?= base_url()?>admin/Commission/fetchCommission');
		const myJson = await response.json();
		let html = '';
		html += '<table class="table" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">Commission Id</th>\n' +
			'<th scope="col">Commission Rate</th>\n' +
			'<th scope="col">User Type</th>\n' +
			'<th scope="col">Actions</th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < myJson.length; i++) {

			 html += '<tr>\n' +
				'<td>'+ myJson[i].crId+'</td>\n' +
				'<td>'+ myJson[i].rate+'</td>\n' +
				'<td>'+ myJson[i].userType+'</td>\n' +
				'<td>\n' +
				'<div class="actions">\n' +
				'<button class="btn btn-info btn-sm btn-square rounded-pill edit-commission" data-crid="'+ myJson[i].crId+'" data-target="#edit-commission" data-toggle="modal"><span\n' +
				'class="btn-icon icofont-ui-edit"></span></button>\n' +
				'</div>\n' +
				'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#data").html(html);
		$("#data-table").DataTable();

		$(".edit-commission").on('click', function () {
			const crId = $(this).data("crid");
			fetchCr(crId);
		});
	}

	async function fetchCr(id) {
		const response = await fetch('<?= base_url()?>admin/Commission/fetchCommission/'+ id);
		const myJson = await response.json();

		$("#hidecrId").val(myJson[0].crId);
		$("#crId").text(myJson[0].crId);
		$("#rate").val(myJson[0].rate);
		$("#userType").text(myJson[0].userType);
	}

	$("#editCom").on('click', function () {

		const crId = $("#hidecrId").val();
		const rate = $("#rate").val();
		$.ajax({
			url:'<?= base_url() ?>admin/Commission/editCommission',
			method: 'post',
			data:{
				crId:crId,
				rate:rate
			},
			success:function () {
				fetchCommission();
			}
		})
	});

</script>
</body>
</html>
