<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MediCare</title>
    <meta content="width=device-width,initial-scale=1" name="viewport"><!-- Favicon -->
    <link href="<?= base_url() ?>assets/img/fav2.png" rel="shortcut icon"><!-- Plugins CSS -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/icofont.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/datatables.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/bootstrap-select.min.css" rel="stylesheet">
	<!-- Daterange CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/css/daterangepicker.css">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
	<link href="<?= base_url() ?>assets/css/styleMedic.css?version=7" rel="stylesheet">
	<style>
		.medimg{
			width: 100px;
			padding: 3px;
		}
	</style>
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
                <header class="page-header">
					<h1 class="page-title">Medicine</h1>
					<button type="button" class="btn btn-primary rounded-pill" style="height: 50px;width: 50px;font-size: 16px;"  data-target="#report" data-toggle="modal"><span class="btn-icon icofont-file-alt"></button>
				</header>
                <div class="page-content">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="table-responsive" id="data">

                            </div>
                        </div>
                    </div>
                    <div class="add-action-box">
                        <button class="btn btn-primary btn-lg btn-square rounded-pill" data-target="#add-medicine"
                                data-toggle="modal"><span class="btn-icon icofont-plus"></span>
                        </button>
                        <button class="btn btn-primary btn-lg btn-square rounded-pill ml-2 tooltip2" id="cng-med" data-target="#change-medicine"
                                data-toggle="modal" data-placement="top" title="Change Medicine Name,Description,ect."><span class="btn-icon icofont-edit"></span>
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
                            <li class="item"><a class="link" href="javascript:void(0)">Medicine</a> <i
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
</div><!-- Add patients modals -->
<div aria-hidden="true" class="modal fade" id="report" role="dialog" tabindex="-1">
	<div class="modal-dialog  modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Report</h5></div>
			<form action="<?= base_url()?>pharmacist/report/medicine" method="post" target="_blank">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6 col-sm-6 offset-3">
							<div class="form-group">
								<label class="control-label">Time Period :</label>
								<div class="input-group daterange_btn">
									<button type="button" class="form-control d-flex justify-content-between" id="daterange_btn">
														<span>
														<i class="far fa-calendar-alt"></i> Choose Time Period
														</span>
										<i class="fa fa-caret-down"></i>
									</button>
									<input type="hidden" id="dp" name="time_period">
									<div class="input-group-append">
										<span class="form-control text-center" style="line-height: 25px;font-size: 20px;cursor: pointer;border-top-left-radius: 0;border-bottom-left-radius: 0" id="clear_date"><i class="fa fa-times"></i></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer d-block">
					<div class="actions justify-content-between">
						<button class="btn btn-error" data-dismiss="modal" type="button">Close</button>
						<button class="btn btn-success" type="submit">Generate</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div><!-- end Add appointment modals -->
<div aria-hidden="true" class="modal fade" id="change-medicine" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Edit Medicine</h5></div>
            <div class="modal-body">
				<form class="add-medicine-parsley" id="cngMed">
					<div class="form-group">
						<select id="editMedicine" class="form-control" required data-parsley-min="1" data-parsley-min-message="This value is required." >
							<option value="0">--Select Medicine--</option>
						</select>
					</div>
					<div class="form-group">
						<input class="form-control" id="newMedName" placeholder="Medicine Name" type="text" required >
						<input type="hidden" id="hideMedName">
						<input type="hidden" id="hideMedDesc">
						<input type="hidden" id="hideDisId" value="0">
					</div>
					<div class="form-group">
						<textarea id="newMedDesc" class="form-control" placeholder="Medicine Description" required></textarea>
					</div>

					<div class="form-group">
						<select id="changeDisId" class="form-control selectpicker" >
							<option value="0">--Select Disease--</option>
							<?php
							for ($i=0; $i< sizeof($disease);$i++)
							{
								?>
								<option value="<?= $disease[$i]['disId']?>"><?= $disease[$i]['disName']?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div id="error" class="error text-center"></div>
				</form>
            </div>
            <div class="modal-footer d-block">
                <div class="actions justify-content-between">
                    <button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-info" type="button" id="changeMed">Change</button>
                </div>
            </div>
        </div>
    </div>
</div><!-- end Add patients modals --><!-- Add patients modals -->
<div aria-hidden="true" class="modal fade" id="add-medicine" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Add new Medicine</h5></div>
            <div class="modal-body">
                <form class="add-medicine-parsley-1">
					<input type="file" name="images[]" id="attach" class="d-none" multiple accept="image/*">
					<button class="btn btn-outline-primary my-3" type="button" onclick="choose()">Upload Images</button>
					<div class="form-group"><input class="form-control" id="medName" placeholder="Medicine Name" type="text" required></div>
                    <div class="form-group">
						<textarea id="medDesc" class="form-control" placeholder="Medicine Description" required></textarea>
					</div>

					<div class="input-group form-group">
						<input class="form-control" id="dose" placeholder="Dose" type="number" required>
						<div class="input-group-append">
							<select id="doseId" class="form-control" required data-parsley-min="1" data-parsley-min-message="This value is required." >
								<option value="0">--Select Dose Unit--</option>
								<?php
								for ($i=0; $i< sizeof($dose);$i++)
								{
									?>
									<option value="<?= $dose[$i]['doseId']?>"><?= $dose[$i]['doseUnit']?></option>
									<?php
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<select id="mstId" class="form-control selectpicker"  required data-parsley-min="1" data-parsley-min-message="This value is required.">
							<option value="0">--Select Type--</option>
							<?php
							for ($i=0; $i< sizeof($mst);$i++)
							{
								?>
								<option value="<?= $mst[$i]['mstId']?>"><?= $mst[$i]['mstType']?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div class="input-group form-group">
						<input class="form-control" id="capacity" placeholder="Capacity" type="number" required>
						<div class="input-group-append">
							<select id="unit" class="form-control" required data-parsley-min="1" data-parsley-min-message="This value is required." >
								<option value="0">--Select Unit--</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<input class="form-control" id="price" placeholder="Price" type="number" required>
					</div>
					<div class="form-group">
						<select id="disId" class="form-control selectpicker" data-live-search="true">
							<option value="0">--Select Disease--</option>
							<?php
							for ($i=0; $i< sizeof($disease);$i++)
							{
								?>
								<option value="<?= $disease[$i]['disId']?>"><?= $disease[$i]['disName']?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div id="error" class="error text-center"></div>
				</form>
            </div>
            <div class="modal-footer d-block">
                <div class="actions justify-content-between">
                    <button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-info" type="button" id="addMed">Add Medicine</button>
                </div>
            </div>
        </div>
    </div>
</div><!-- end Add appointment modals -->
<div aria-hidden="true" class="modal fade" id="edit-medicine" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Edit Medicine</h5></div>
            <div class="modal-body">
                <form id="editForm">
					<div class="form-group">
						<input class="form-control" id="editMedName" placeholder="Medicine Name" type="text" required readonly>
						<input type="hidden" id="editPwmId">
					</div>
					<div class="form-group">
						<textarea id="editMedDesc" class="form-control" placeholder="Medicine Description" required readonly></textarea>
					</div>

					<div class="input-group form-group">
						<input class="form-control" id="editDose" placeholder="Dose" type="number" required>
						<div class="input-group-append">
							<select id="editDoseId" class="form-control" required data-parsley-min="1" data-parsley-min-message="This value is required." >
								<option value="0">--Select Dose Unit--</option>
								<?php
								for ($i=0; $i< sizeof($dose);$i++)
								{
									?>
									<option value="<?= $dose[$i]['doseId']?>"><?= $dose[$i]['doseUnit']?></option>
									<?php
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<select id="editMstId" class="form-control selectpicker"  required data-parsley-min="1" data-parsley-min-message="This value is required.">
							<option value="0">--Select Type--</option>
							<?php
							for ($i=0; $i< sizeof($mst);$i++)
							{
								?>
								<option value="<?= $mst[$i]['mstId']?>"><?= $mst[$i]['mstType']?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div class="input-group form-group">
						<input class="form-control" id="editCapacity" placeholder="Capacity" type="number" required>
						<div class="input-group-append">
							<select id="editUnit" class="form-control" required data-parsley-min="1" data-parsley-min-message="This value is required." >
								<option value="0">--Select Unit--</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<input class="form-control" id="editPrice" placeholder="Price" type="number" required data-parsley-type="number"  step="0.1">
					</div>
					<div class="form-group">
						<select id="editDisId" class="form-control selectpicker" disabled>
							<option value="0">--Select Disease--</option>
							<?php
							for ($i=0; $i< sizeof($disease);$i++)
							{
								?>
								<option value="<?= $disease[$i]['disId']?>"><?= $disease[$i]['disName']?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div id="editError" class="error"></div>
                </form>
            </div>
            <div class="modal-footer d-block">
                <div class="actions justify-content-between">
                    <button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
                    <button class="btn btn-info" type="button" id="editMed">Edit Medicine</button>
                </div>
            </div>
        </div>
    </div>
</div><!-- end Add appointment modals -->


<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<!--<script src="<?= base_url() ?>assets/js/jquery-migrate-1.4.1.min.js"></script>-->
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap3-typeahead.min.js"></script>
<script src="<?= base_url() ?>assets/js/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-select.min.js"></script>
<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>
<!-- Select2 JS -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- Daterange JS -->
<script src="<?= base_url() ?>assets/plugins/daterangepicker/js/moment.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/daterangepicker/js/daterangepicker.js"></script>
<script src="<?= base_url() ?>assets/js/main.js?version=3"></script>

<script>
	// $("#disId").select2();
	let pars = $(".add-medicine-parsley-1").parsley();
	$(".tooltip2").tooltip();
	$("#addMed").on('click', function () {
		pars.validate();
		if(pars.isValid()) {
			const medName = $("#medName").val();
			const medDesc = $("#medDesc").val();
			const price = $("#price").val();
			const disId = $("#disId").val();
			const msuId = $("#unit").val();
			const capacity = $("#capacity").val();
			const dose = $("#dose").val();
			const doseId = $("#doseId").val();
			const files = $("#attach")[0].files;

			let formData = new FormData();
			for(let count = 0; count<files.length; count++)
			{
				formData.append("files[]", files[count]);
			}
			formData.append('medName',medName);
			formData.append('medDesc',medDesc);
			formData.append('price',price);
			formData.append('dose',dose);
			formData.append('doseId',doseId);
			formData.append('disId',disId);
			formData.append('msuId',msuId);
			formData.append('capacity',capacity);

			$.ajax({
				url:'<?= base_url() ?>pharmacist/medicine/addMedicine',
				method: 'post' ,
				data:formData,
				contentType:false,
				processData:false,
				success: function (data) {
					if (data != ''){
						$("#error").text(data);
					} else {
						fetchMedicine();
						$("#add-medicine").modal('toggle');
						$(".add-medicine-parsley").trigger('reset');
					}
				}
			})
		}
	});

	fetchMedicine();
	async function fetchMedicine() {
		const response = await fetch('<?= base_url()?>pharmacist/medicine/fetchMedicine');
		const myJson = await response.json();
		let html = '';
		html += '<table class="table" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">Medicine Id</th>\n' +
			'<th scope="col">Medicine Name</th>\n' +
			'<th scope="col">Medicine Description</th>\n' +
			'<th scope="col">Price</th>\n' +
			'<th scope="col">Dose</th>\n' +
			'<th scope="col">Capacity</th>\n' +
			'<th scope="col">Disease Name</th>\n' +
			'<th scope="col">Images <br><small>Displays a single image</small></th>\n' +
			'<th scope="col">Actions</th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < myJson.length; i++) {
			let img = myJson[i].image.split(',');
			let imgHtml = '';
			if (img != '') {
				for (let j = 0; j < 2; j++) {
					if (j in img) {
						imgHtml += '<img src="<?= base_url()?>medicineImg/' + img[j] + '" class="medimg" />';
					}
				}
			}

			 html += '<tr>\n' +
				'<td>'+ myJson[i].medId+'</td>\n' +
				'<td>'+ myJson[i].medName+'</td>\n' +
				'<td>'+ myJson[i].medDescription+'</td>\n' +
				'<td>'+ myJson[i].price+'</td>\n' +
				'<td>'+ myJson[i].dose+'</td>\n' +
				'<td>'+ myJson[i].capacity+'</td>\n' +
				'<td>'+ myJson[i].disName+'</td>\n' +
				'<td>'+ imgHtml+'</td>\n' +
				'<td>\n' +
				'<div class="actions">\n' +
				'<button class="btn btn-info btn-sm btn-square rounded-pill edit-medicine" data-pwmid="'+ myJson[i].pwmId+'" data-target="#edit-medicine" data-toggle="modal"><span\n' +
				'class="btn-icon icofont-ui-edit"></span></button>\n' +
				'<button class="btn btn-error btn-sm btn-square rounded-pill delete-medicine" data-pwmid="'+ myJson[i].pwmId+'"><span\n' +
				'class="btn-icon icofont-ui-delete"></span></button>\n' +
				'</div>\n' +
				'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#data").html(html);
		$("#data-table").DataTable();

		$(".edit-medicine").on('click', function () {
			$("#editForm").trigger('reset');
			const pwmId = $(this).data("pwmid");
			fetchMed(pwmId);
		});

		$(".delete-medicine").on('click',function () {
			const pwmId = $(this).data("pwmid");
			deleteDis(pwmId);
		});
	}

	async function fetchMed(id) {
		const response = await fetch('<?= base_url()?>pharmacist/medicine/fetchMedicine/'+ id);
		const myJson = await response.json();

		$("#editMedName").val(myJson.medName);
		$("#editMedDesc").val(myJson.medDescription);
		$("#editPrice").val(myJson.price);
		$("#editPwmId").val(myJson.pwmId);
		$("#editDose").val(myJson.dose);
		$("#editCapacity").val(myJson.capacity);
		$("#editDisId>option[value=" + myJson.disId +"]").prop('selected',true).change();
		$("#editDoseId>option[value=" + myJson.doseId +"]").prop('selected',true).change();
		$("#editMstId>option[value=" + myJson.mstId +"]").prop('selected',true).change();
		setTimeout( function () {
			$("#editUnit>option[value=" + myJson.msuId + "]").prop('selected' , true).change();
		},500)
	}

	$("#editMed").on('click', function () {
		let pars = $("#editForm").parsley();
		pars.validate();
		if(pars.isValid()) {
			const pwmId = $("#editPwmId").val();
			const disId = $("#editDisId").val();
			const price = $("#editPrice").val();
			const dose = $("#editDose").val();
			const doseId = $("#editDoseId").val();
			const capacity = $("#editCapacity").val();
			const mstId = $("#editMstId").val();
			const msuId = $("#editUnit").val();
			$.ajax({
				url: '<?= base_url() ?>pharmacist/medicine/editMedicine' ,
				method: 'post' ,
				data: {
					disId: disId ,
					pwmId: pwmId ,
					dose: dose ,
					doseId: doseId ,
					capacity: capacity ,
					mstId: mstId ,
					msuId: msuId ,
					price: price
				} ,
				success: function (data) {
					fetchMedicine();
					$("#edit-medicine").modal('toggle');
				}
			})
		}
	});

	$(".delete-medicine").on('click',function () {
		const medId = $(this).data("pwmid");
		deleteDis(medId);
	});

	async function deleteDis(id) {
		const response = await fetch('<?= base_url()?>pharmacist/medicine/deleteMedicine/' + id);
		await fetchMedicine();
	}
	async function fetchUnit(id){
		const response = await fetch('<?= base_url()?>pharmacist/medicine/fetchUnit/' + id);
		const myJson = await response.json();
		$('#unit,#editUnit')
			.empty()
			.append($("<option></option>")
				.attr("value" , 0)
				.text("--Select Unit--"));
		$.each(myJson , function (key , value) {
			$('#unit,#editUnit')
				.append($("<option></option>")
					.attr("value" , value.msuId)
					.text(value.unit));
		});

	}

	$("#mstId,#editMstId").on('change',function () {
		const mstId = $(this).val();
		console.log(mstId);
		if (mstId != 0){
			fetchUnit(mstId);
		}  else {
			$('#unit').empty();
		}
	});
	$('#medName').typeahead({
		autoSelect:false,
		source: function(query, result)
		{
			$.ajax({
				url:"<?= base_url() ?>pharmacist/medicine/fetchMed",
				method:"POST",
				data:{query:query},
				dataType:"json",
				success:function(data)
				{
					result($.map(data, function(item){
						return item.medName;
					}));
				}
			})
		},
		afterSelect: function(item) {

			$.ajax({
				url: "<?= base_url() ?>pharmacist/medicine/fetchMed",
				method: "post",
				data: {
					item: item
				},
				success: function (res) {
					let obj = JSON.parse(res);
					$("#medDesc").val(obj[0].medDesc);
				}
			});

		}
	});

	async function fetchMedName(){
		const response = await fetch('<?= base_url()?>pharmacist/medicine/fetchMedName');
		const myJson = await response.json();
		$('#editMedicine')
			.empty()
			.append($("<option></option>")
				.attr("value" , 0)
				.text("--Select Medicine--"));
		$.each(myJson , function (key , value) {
			$('#editMedicine')
				.append($("<option></option>")
					.attr("value" , value.medId)
					.text(value.medName));
		});
		selectpicker();

	}
	function selectpicker() {
		var select = $('#editMedicine');
		if (select.length) {
			select.each(function () {
				$(this).selectpicker({
					style: '',
					styleBase: 'form-control',
					tickIcon: 'icofont-check-alt'
				});
			});
		}
	}
	$("#cng-med").on('click', function () {
		fetchMedName();
	});

	$('#editMedicine').on('change', function () {
		const medId = $(this).val();

		$.ajax({
			url: '<?= base_url()?>pharmacist/medicine/fetchMedName',
			method:'post',
			data: {
				medId:medId
			},
			success:function (data) {
				const obj = JSON.parse(data);
				$("#newMedName").val(obj.medName);
				$("#newMedDesc").val(obj.medDesc);
				$("#hideMedName").val(obj.medName);
				$("#hideMedDesc").val(obj.medDesc);
				$("#hideDisId").val(obj.disId);
				$("#changeDisId>option[value=" + obj.disId +"]").prop('selected',true).change();
			}
		})
	});
	$("#changeMed").on('click', function () {
		const medId = $("#editMedicine").val();
		const hideMedName = $("#hideMedName").val();
		const hideMedDesc = $("#hideMedDesc").val();
		const hideDisId = $("#hideDisId").val();
		const newMedName = $("#newMedName").val();
		const newMedDesc = $("#newMedDesc").val();
		const newDisId = $("#changeDisId").val();
		let msg = '';
		let cnt = 0;

		if (hideMedName != newMedName){
			msg += 'Medicine Name ';
			cnt++;
		}
		if (hideMedDesc != newMedDesc){
			msg += 'Medicine Description ';
			cnt++;
		}
		if (hideDisId != newDisId){
			msg += 'Disease ';
			cnt++;
		}

		if (cnt != 0){
			msg += 'will be updated soon.';
			alert(msg);
			$.ajax({
				url: '<?= base_url()?>pharmacist/medicine/updateMedDetails',
				method: 'post',
				data: {
					medId:medId,
					hideMedName:hideMedName,
					hideMedDesc:hideMedDesc,
					hideDisId:hideDisId,
					newMedName:newMedName,
					newMedDesc:newMedDesc,
					newDisId:newDisId
				},
				success:function (data) {
					fetchMedicine();
					$("#change-medicine").modal('toggle');
					$("#cngMed").trigger('reset');
				}
			})
		}

	});
	function choose(){
		$("#attach").trigger('click');
	}
</script>

<script>

	var dt = moment();
	var sDate = '';
	var eDate = '';
	if (dt.format('M') > 3){
		sDate =  dt.format('YYYY') + '-04-01';
		eDate =  (parseFloat(dt.format('YYYY'))+1) + '-03-31';
	} else {
		sDate =  (parseFloat(dt.format('YYYY'))-1) + '-04-01';
		eDate =  dt.format('YYYY') + '-03-31';
	}
	$('#daterange_btn').daterangepicker({
			ranges: {
				'All': [moment('01-01-2019'),moment()],
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
				'Yearly': [moment(sDate), moment(eDate)]
			},
			startDate: moment().subtract(29, 'days'),
			endDate: moment()
		},
		function (start, end) {
			$('#daterange_btn span').html(start.format('D/M/Y') + ' - ' + end.format('D/M/Y'));
			$("#dp").val(start.format('D-M-Y') + '/' + end.format('D-M-Y'));
		}
	);

	$("#clear_date").on('click',function () {
		$("#dp").val('');
		var html1='';
		html1 +='<span>';
		html1 +='<i class="far fa-calendar-alt"></i> Choose Time Period';
		html1 +='</span>';
		html1 +='<i class="fa fa-caret-down"></i>';
		$("#daterange_btn").html(html1);
	});

	$('#daterange_btn2').daterangepicker({
			ranges: {
				'All': [moment('01-01-2019'),moment()],
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
				'Yearly': [moment(sDate), moment(eDate)]
			},
			startDate: moment().subtract(29, 'days'),
			endDate: moment()
		},
		function (start, end) {
			$('#daterange_btn2 span').html(start.format('D/M/Y') + ' - ' + end.format('D/M/Y'));
			$("#dp2").val(start.format('D-M-Y') + '/' + end.format('D-M-Y'));
		}
	);

	$("#clear_date2").on('click',function () {
		$("#dp2").val('');
		var html1='';
		html1 +='<span>';
		html1 +='<i class="far fa-calendar-alt"></i> Choose Time Period';
		html1 +='</span>';
		html1 +='<i class="fa fa-caret-down"></i>';
		$("#daterange_btn2").html(html1);
	});

</script>
<?php
	include ("noti.php");
?>
</body>
</html>
