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
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/styleMedic.css?version=8">
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
							<form class="mb-4" method="post" action="<?= base_url() ?>doctor/doctor-profile-setting/updateData" data-parsley-validate enctype="multipart/form-data">
								<label>Photo</label>
								<div class="form-group avatar-box d-flex align-items-center">
									<img
										src="<?= base_url() ?>profile/<?= $doctorDetail['profileImg']?>" width="100" height="100" alt=""
										class="rounded-500 mr-4">
									<input type="file" id="attach" name="profileImg" class="d-none">
									<button class="btn btn-outline-primary" type="button" onclick="choose()">Change photo<span
											class="btn-icon icofont-ui-user ml-2"></span></button>

									<div class="col-2 offset-6">
										<button class="btn btn-outline-primary" type="button" data-target="#clinic" data-toggle="modal" id="modelButton">
											Clinic
										</button>
									</div>
								</div>
								<div class="row">
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Username</label>
											<input class="form-control" type="text" placeholder="Name" value="<?= $doctorDetail['username']?>" name="username" required>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Email Id</label>
											<input class="form-control" type="email" placeholder="Email Id" value="<?= $doctorDetail['email']?>" name="email" required>
											<input type="hidden" value="<?= $doctorDetail['email']?>" name="oldEmail">
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Phone</label>
											<input class="form-control" type="number" placeholder="Phone" value="<?= $doctorDetail['phone']?>" name="phone" required>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Gender</label>
											<select id="gender" class="form-control selectpicker" name="gender"  required data-parsley-min="1" data-parsley-min-message="This value is required.">
												<option value="0">Select</option>
												<option value="1">Male</option>
												<option value="2">Female</option>
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Doctor Type</label>
											<select id="type" class="form-control " name="type"  required data-parsley-min="1" data-parsley-min-message="This value is required.">
												<option value="0">Select</option>
												<?php
												for ($i=0; $i< sizeof($doctorType);$i++)
												{
													?>
													<option value="<?= $doctorType[$i]['dptId']?>"><?= $doctorType[$i]['type']?></option>
													<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-12 col-sm-6">
										<div class="form-group">
											<label>Pin Code</label>
											<input class="form-control" type="number" placeholder="Pin Code" value="<?= ($doctorDetail['pincode'] == 0)? '' : $doctorDetail['pincode'] ?>" name="pincode" required>
										</div>
									</div>
									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>Address</label>
											<textarea class="form-control" placeholder="Address" rows="3" name="address" required><?= $doctorDetail['address']?></textarea>
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
											<textarea class="form-control" placeholder="Description" rows="3" name="description" required><?= $doctorDetail['description']?></textarea>
										</div>
									</div>
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label>Estimated Time duration for Patient</label>
											<input class="form-control" type="number" placeholder="Estimated Time in Min." value="<?= $doctorDetail['estimatedTime'] ?>" name="estimatedTime" required>
										</div>
									</div>
									<div class="col-12 col-sm-6 ">
										<div class="form-group">
											<label>Price</label>
											<input class="form-control" type="number" placeholder="Price" value="<?= $doctorDetail['price'] ?>" name="price" required>
										</div>
									</div>
									<div class="col-12 col-sm-12">
										<div class="form-group ">
											<label>Specialization </label>
											<input class="input-tags form-control" type="text" data-role="tagsinput" placeholder="Enter Specialization" name="specialization" value="<?= $doctorDetail['specialization'] ?>" id="specialist" required>
											<small class="form-text text-muted">Note : Type & Press  enter to add new specialization</small>
										</div>
									</div>

									<div class="col-12 col-sm-12">
										<div class="form-group">
											<label>Experience</label>
											<textarea class="form-control" placeholder="Experience" rows="3" name="experience" required><?= $doctorDetail['experience']?></textarea>
										</div>
									</div>
								</div>
								<hr>
								<h4>Qualification
									<button type="button" id="addqf" class="btn btn-suc btn-sm btn-square float-right" style="height: 35px">
										<span class="btn-icon icofont-plus"></span>
									</button>
								</h4>
								<table class="table">
									<thead>
										<tr>
											<th>Degree</th>
											<th>University</th>
											<th>Passing Year</th>
											<th></th>
										</tr>
									</thead>
									<tbody id="qualification">
									<?php
										if (sizeof($doctorDetail['qualification']) > 0){
											foreach ($doctorDetail['qualification'] as $qf)
											{
												?>
												<tr class="qfItem">
													<td><input type="text" name="degree[]" placeholder="Degree" required
															   class="form-control" value="<?= $qf['degree']?>"></td>
													<td><input type="text" name="university[]" placeholder="University" required
															   class="form-control" value="<?= $qf['university']?>"></td>
													<td><input type="text" name="year[]" placeholder="Passing Year" required
															   class="form-control" value="<?= $qf['year']?>"></td>
													<td>
														<button type="button"
																class="btn btn-danger btn-sm btn-square btn-remove">
															<span class="btn-icon icofont-close"></span>
														</button>
													</td>
												</tr>
												<?php
											}
										} else
										{
											?>
											<tr class="qfItem">
												<td><input type="text" name="degree[]" placeholder="Degree" required
														   class="form-control"></td>
												<td><input type="text" name="university[]" placeholder="University" required
														   class="form-control"></td>
												<td><input type="text" name="year[]" placeholder="Passing Year" required
														   class="form-control"></td>
												<td>
													<button type="button"
															class="btn btn-danger btn-sm btn-square btn-remove">
														<span class="btn-icon icofont-close"></span>
													</button>
												</td>
											</tr>
											<?php
										}
									?>
									</tbody>
								</table>
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
							<li class="item"><a href="javascript:void(0)" class="link">Doctor</a> <i
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
</div>
<div aria-hidden="true" class="modal fade" id="clinic" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Clinic Details</h5></div>
			<div class="modal-body">
				<form id="clinicForm">
					<div class="form-group">
						<input class="form-control" id="clinicName" placeholder="Clinic Name" type="text" required>
					</div>
					<div class="form-group">
						<textarea id="clinicDescription" class="form-control" placeholder="Clinic Description" required></textarea>
					</div>
					<div class="form-group">
						<textarea id="clinicAddress" class="form-control" placeholder="Clinic Address" required></textarea>
					</div>
					<div class="form-group">
						<input class="form-control" id="clinicPincode" placeholder="Pin code" type="number" required>
					</div>
					<div class="row">
						<div class="col-12 col-sm-6">
							<div class="form-group">
								<label>State</label>
								<select id="state2" class="form-control selectpicker"  data-live-search="true" required data-parsley-min="1" data-parsley-min-message="This value is required.">
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
								<select name="city" id="city2" class="form-control selectpicker"  data-live-search="true" required data-parsley-min="1" data-parsley-min-message="This value is required.">
									<option value="0">Select</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-error" data-dismiss="modal" type="button">Cancel</button>
					<button class="btn btn-info" type="button" id="saveClinic">Save Details</button>
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
<!-- Select2 JS -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- Bootstrap Tagsinput JS -->
<script src="<?= base_url() ?>assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js"></script>
<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>

<script src="<?= base_url() ?>assets/js/main.js"></script>

<script>
	$(document).ready(function () {
		let stateId = <?= $doctorDetail['stateId']?>;
		let cityId = <?= $doctorDetail['cityId']?>;
		let dptId = <?= $doctorDetail['dptId']?>;
		let gender = <?= $doctorDetail['gender']?>;
		$("#state, #city, #type").select2();

		let pars = $("#clinicForm").parsley();


		$("#state>option[value=" + stateId +"]").prop('selected',true).change();
		$("#type>option[value=" + dptId +"]").prop('selected',true).change();
		$("#gender>option[value=" + gender +"]").prop('selected',true).change();
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
		async function fetchCity2(id,cityId=0){
			const response = await fetch('<?= base_url()?>city/fetchCity/' + id);
			const myJson = await response.json();
			$('#city2')
				.empty()
				.append($("<option></option>")
					.text("Select"));
			$.each(myJson , function (key , value) {
				$('#city2')
					.append($("<option></option>")
						.attr("value" , value.cityId)
						.text(value.cityName));
			});
			if(cityId != 0) {
				$("#city2>option[value=" + cityId + "]").prop("selected" , true).change();
				cityId=0;
			}
			$('.selectpicker').selectpicker('refresh');

		}
		$("#state2").on('change', function () {
			const id = $(this).val();
			if (id!=0) {
				fetchCity2(id);
			} else {
				$('#city2').empty();
			}
		});
		$("#state").on('change', function () {
			const id = $(this).val();
			if (id!=0) {
				fetchCity(id);
			} else {
				$('#city').empty();
			}
		});

		$("#addqf").on('click', function () {
			let html = '<tr class="qfItem">\n' +
				'<td><input type="text" name="degree[]" placeholder="Degree" class="form-control" required></td>\n' +
				'<td><input type="text" name="university[]" placeholder="University" class="form-control" required></td>\n' +
				'<td><input type="text" name="year[]" placeholder="Passing Year" class="form-control" required></td>\n' +
				'<td>\n' +
				'<button type="button" class="btn btn-danger btn-sm btn-square btn-remove">\n' +
				'<span class="btn-icon icofont-close"></span>\n' +
				'</button>\n' +
				'</td>\n' +
				'</tr>';
			$("#qualification").append(html);

			$(".btn-remove").on('click', function () {
				$(this).parent().closest('.qfItem').remove();
			});
		});

		$(".btn-remove").on('click', function () {
			$(this).parent().closest('.qfItem').remove();
		});
		$("#saveClinic").on('click', function () {
			pars.validate();
			if (pars.isValid()) {
				const clinicName = $("#clinicName").val();
				const clinicDescription = $("#clinicDescription").val();
				const clinicAddress = $("#clinicAddress").val();
				const clinicPincode = $("#clinicPincode").val();
				const cityId = $("#city2").val();

				$.ajax({
					url: '<?= base_url()?>doctor/doctor-profile-setting/updateClinic' ,
					method: 'post' ,
					data: {
						clinicName: clinicName ,
						clinicAddress: clinicAddress ,
						clinicDescription: clinicDescription ,
						clinicPincode: clinicPincode ,
						cityId: cityId ,
					},
					success:function (data) {
						$("#clinic").modal('toggle');
						$("#clinicForm").trigger('reset');
					}
				})
			}
		});

		$("#modelButton").on('click', function () {

			$.ajax({
				url: '<?= base_url()?>doctor/doctor-profile-setting/fetchClinic' ,
				method: 'post' ,
				success:function (data) {
					console.log(data);
					if(data != '' || data != 0){
						let obj = JSON.parse(data);
						$("#clinicName").val(obj.clinicName);
						$("#clinicDescription").val(obj.clinicDescription);
						$("#clinicAddress").val(obj.clinicAddress);
						$("#clinicPincode").val(obj.clinicPincode);
						// $("#city2").val(obj.cityId);

						$("#state2>option[value=" + obj.stateId +"]").prop('selected',true);
						fetchCity2(obj.stateId,obj.cityId);
					}
				}
			})
		})

	});
	function choose(){
		$("#attach").trigger('click');
	}

</script>

</body>
</html>
