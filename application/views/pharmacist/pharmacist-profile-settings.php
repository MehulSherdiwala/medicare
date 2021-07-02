<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MediCare</title>
	<meta name="keywords" content="MedicApp">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1"><!-- Favicon -->
	<link type="image/x-icon" href="<?= base_url() ?>assets/img/fav.png" rel="icon"><!-- Plugins CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/icofont.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/simple-line-icons.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery.typeahead.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/datatables.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/Chart.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/morris.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/leaflet.css"><!-- Theme CSS -->
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/styleMedic.css?version=4">
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
			include ("sidebar.php")
		?>

		<main class="main-content">
			<div class="app-loader"><i class="icofont-spinner-alt-4 rotate"></i></div>
			<div class="main-content-wrap">
				<header class="page-header"><h1 class="page-title">Profile Setting</h1></header>
				<div class="page-content">
					<div class="row justify-content-center">
						<div class="col col-12 col-xl-9">
							<form class="mb-4" method="post" action="<?= base_url() ?>pharmacist/pharmacist-profile-setting/updateData" data-parsley-validate enctype="multipart/form-data">
								<label>Photo</label>
								<div class="form-group avatar-box d-flex align-items-center"><img
										src="<?= base_url() ?>profile/<?= $pharmacistDetail['profileImg']?>" width="100" height="100" alt=""
										class="rounded-500 mr-4">

									<input type="file" id="attach" name="profileImg" class="d-none">
									<button class="btn btn-outline-primary" type="button" onclick="choose()">Change photo<span
											class="btn-icon icofont-ui-user ml-2"></span></button>
								</div>
								<div class="row">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Username</label>
											<input class="form-control" type="text" placeholder="Name" value="<?= $pharmacistDetail['username']?>" name="username" required>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Email Id</label>
											<input class="form-control" type="email" placeholder="Email Id" value="<?= $pharmacistDetail['email']?>" name="email" required>
											<input type="hidden" value="<?= $pharmacistDetail['email']?>" name="oldEmail">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Phone</label>
											<input class="form-control" type="number" placeholder="Phone" value="<?= $pharmacistDetail['phone']?>" name="phone" required>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Pin Code</label>
											<input class="form-control" type="number" placeholder="Pin Code" value="<?= ($pharmacistDetail['pincode'] == 0)? '' : $pharmacistDetail['pincode'] ?>" name="pincode" required>
										</div>
									</div>
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>Address</label>
											<textarea class="form-control" placeholder="Address" rows="3" name="address" required><?= $pharmacistDetail['address']?></textarea>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>State</label>
											<select id="state" class="form-control "  required data-parsley-min="1" data-parsley-min-message="This value is required.">
												<option value="0">Select</option>
												<?php
												for ($i=0; $i< sizeof($state);$i++)
												{
													?>
													<option value="<?= $state[$i]['stateId']?>"><?= $state[$i]['stateName']?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>City</label>
											<select name="city" id="city" class="form-control"  required data-parsley-min="1" data-parsley-min-message="This value is required.">
												<option value="0">Select</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>Description</label>
											<textarea class="form-control" placeholder="Description" rows="3" name="description" required><?= $pharmacistDetail['description']?></textarea>
										</div>
									</div>
								</div>
								<div class="col-12 col-sm-6 offset-3">
									<div class="form-group">
										<label>Pharmacist Type</label>
										<select id="type" class="form-control " name="type"  required data-parsley-min="1" data-parsley-min-message="This value is required.">
											<option value="0">Select</option>
											<?php
											for ($i=0; $i< sizeof($pharmacistType);$i++)
											{
												?>
												<option value="<?= $pharmacistType[$i]['dptId']?>"><?= $pharmacistType[$i]['type']?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col">
										<button type="submit" class="btn btn-success">Save changes</button>
									</div>
									<div class="col text-right">
										<button type="reset" class="btn btn-outline-danger"><span
												class="d-none d-sm-block">Reset</span> <span class="d-sm-none">Reset</span>
										</button>
									</div>
								</div>
							</form>
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
							<li class="item"><a href="javascript:void(0)" class="link">Home</a> <i
									class="separator icofont-thin-right"></i></li>
							<li class="item"><a href="javascript:void(0)" class="link">Profile</a> <i
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
<div class="modal fade" id="add-patient" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Add new patient</h5></div>
			<div class="modal-body">
				<form>
					<div class="form-group avatar-box d-flex"><img src="<?= base_url() ?>assets/content/anonymous-400.jpg" width="40"
																   height="40" alt="" class="rounded-500 mr-4">
						<button class="btn btn-outline-primary" type="button">Select image<span
								class="btn-icon icofont-ui-user ml-2"></span></button>
					</div>
					<div class="form-group"><input class="form-control" type="text" placeholder="Name"></div>
					<div class="form-group"><input class="form-control" type="number" placeholder="Number"></div>
					<div class="row">
						<div class="col-12 col-sm-6">
							<div class="form-group"><input class="form-control" type="number" placeholder="Age"></div>
						</div>
						<div class="col-12 col-sm-6">
							<div class="form-group"><select class="selectpicker" title="Gender">
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
					<button type="button" class="btn btn-error" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-info">Add patient</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- end Add patients modals --><!-- Add patients modals -->
<div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Application's settings</h5></div>
			<div class="modal-body">
				<form>
					<div class="form-group"><label>Layout</label> <select class="selectpicker" title="Layout"
																		  id="layout">
							<option value="horizontal-layout">Horizontal</option>
							<option value="vertical-layout">Vertical</option>
						</select></div>
					<div class="form-group"><label>Light/dark topbar</label>
						<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input"
																		 id="topbar"> <label
								class="custom-control-label" for="topbar"></label></div>
					</div>
					<div class="form-group"><label>Light/dark sidebar</label>
						<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input"
																		 id="sidebar"> <label
								class="custom-control-label" for="sidebar"></label></div>
					</div>
					<div class="form-group mb-0"><label>Boxed/fullwidth mode</label>
						<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input"
																		 id="boxed" checked="checked"> <label
								class="custom-control-label" for="boxed"></label></div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button id="reset-to-default" type="button" class="btn btn-error">Reset to default</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- end Add patients modals -->
<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<!--<script src="--><?//= base_url() ?><!--assets/js/jquery-migrate-1.4.1.min.js"></script>-->
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.typeahead.min.js"></script>
<script src="<?= base_url() ?>assets/js/datatables.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap-select.min.js"></script>
<!--<script src="--><?//= base_url() ?><!--assets/js/jquery.barrating.min.js"></script>-->
<!--<script src="--><?//= base_url() ?><!--assets/js/Chart.min.js"></script>-->
<!--<script src="--><?//= base_url() ?><!--assets/js/raphael-min.js"></script>-->
<!--<script src="--><?//= base_url() ?><!--assets/js/morris.min.js"></script>-->
<!--<script src="--><?//= base_url() ?><!--assets/js/echarts.min.js"></script>-->
<!--<script src="--><?//= base_url() ?><!--assets/js/echarts-gl.min.js"></script>-->
<!-- Select2 JS -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>

<script src="<?= base_url() ?>assets/js/main.js"></script>



<script>
	$(document).ready(function () {
		let stateId = <?= $pharmacistDetail['stateId']?>;
		let cityId = <?= $pharmacistDetail['cityId']?>;
		let dptId = <?= $pharmacistDetail['dptId']?>;
		$("#state, #city, #type").select2();


		$("#state>option[value=" + stateId +"]").prop('selected',true).change();
		$("#type>option[value=" + dptId +"]").prop('selected',true).change();
		if(cityId != 0){
			fetchCity(stateId);
		}

		async function fetchCity(id){
			const response = await fetch('<?= base_url()?>city/fetchCity/' + id);
			const myJson = await response.json();
			$('#city')
				.empty()
				.append($("<option></option>")
					.text("Select"));
			$.each(myJson , function (key , value) {
				$('#city')
					.append($("<option></option>")
						.attr("value" , value.cityId)
						.text(value.cityName));
			});
			if(cityId != 0) {
				$("#city>option[value=" + cityId + "]").prop("selected" , true).change();
				cityId=0;
			}

		}
		$("#state").on('change', function () {
			const id = $(this).val();
			if (id!=0) {
				fetchCity(id);
			} else {
				$('#city').empty();
			}
		});
	});

	function choose(){
		$("#attach").trigger('click');
	}
</script>

<?php
include ("noti.php");
?>
</body>
</html>
