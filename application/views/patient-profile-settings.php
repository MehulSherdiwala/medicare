<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<title>MediCare</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link type="image/x-icon" href="<?= base_url() ?>assets/img/fav.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?= base_url()?>assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="<?= base_url()?>assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="<?= base_url()?>assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="<?= base_url()?>assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="<?= base_url()?>assets/plugins/select2/css/select2.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css?version=5">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="<?= base_url()?>assets/js/html5shiv.min.js"></script>
			<script src="<?= base_url()?>assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			<?php
				include ("header.php")
			?>
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Profile Settings</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
					
						<!-- Profile Sidebar -->

						<?php
						include ("sidebar.php");
						?>
						<!-- /Profile Sidebar -->
						
						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
								<div class="card-body">
									
									<!-- Profile Settings Form -->
									<form action="<?= base_url() ?>patient-profile-setting/updateData" method="post" data-parsley-validate enctype="multipart/form-data">
										<div class="row form-row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															<img src="<?= base_url()?>profile/<?= $patientDetail['profileImg']?>" alt="">
														</div>
														<div class="upload-img">
															<div class="change-photo-btn">
																<span><i class="fa fa-upload"></i> Upload Photo</span>
																<input type="file" class="upload" name="profileImg">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>First Name</label>
													<input type="text" class="form-control" value="<?= $patientDetail['username']?>" name="username" required>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Email ID</label>
													<input type="email" class="form-control" value="<?= $patientDetail['email']?>" name="email" required>
													<input type="hidden" name="oldEmail" value="<?= $patientDetail['email']?>">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Date of Birth</label>
													<div class="cal-icon">
														<input type="text" class="form-control datetimepicker" name="dob" value="<?= (($patientDetail['dob']=='01-01-1970') ? '' : $patientDetail['dob'])?>" required>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Mobile</label>
													<input type="text" value="<?= $patientDetail['phone']?>" class="form-control" name="phone" required>
												</div>
											</div>
											<div class="col-12 col-md-8">
												<div class="form-group">
													<label>Description</label>
													<textarea name="description" class="form-control"><?= $patientDetail['description']?></textarea>
												</div>
											</div>
											<div class="col-12 col-md-4">
												<div class="form-group">
													<label>Gender</label>
													<select name="gender" id="gender" class="form-control" required data-parsley-select="0">
														<option value="0">Select</option>
														<option value="1">Male</option>
														<option value="2">Female</option>
													</select>
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
												<label>Address</label>
													<textarea name="address" class="form-control" required><?= $patientDetail['address']?></textarea>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>State</label>
													<select id="state" class="form-control"  required data-parsley-select="0">
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
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>City</label>
													<select name="city" id="city" class="form-control"  required data-parsley-select="0">
														<option value="0">Select</option>
													</select>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Pin Code</label>
													<input type="text" class="form-control" value="<?= ($patientDetail['pincode']==0) ? '' : $patientDetail['pincode']?>" name="pincode" required>
												</div>
											</div>
										</div>
										<div class="submit-section">
											<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
										</div>
									</form>
									<!-- /Profile Settings Form -->
									
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>		
			<!-- /Page Content -->

			<?php
			include ("footer.php")
			?>
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="<?= base_url()?>assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="<?= base_url()?>assets/js/popper.min.js"></script>
		<script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="<?= base_url()?>assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="<?= base_url()?>assets/js/moment.min.js"></script>
		<script src="<?= base_url()?>assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="<?= base_url()?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="<?= base_url()?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		<!-- parsley JS -->
        <script src="<?= base_url()?>assets/plugins/parsley/js/parsley.min.js"></script>

		<!-- Custom JS -->
		<script src="<?= base_url()?>assets/js/script.js?version=3"></script>

		<script>
			$(document).ready(function () {
				let stateId = <?= $patientDetail['stateId']?>;
				let cityId = <?= $patientDetail['cityId']?>;
				let gender = <?= $patientDetail['gender']?>;
				$("#state, #city").select2();


				$("#state>option[value=" + stateId +"]").prop('selected',true).change();
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
				$("#state").on('change', function () {
					const id = $(this).val();
					if (id!=0) {
						fetchCity(id);
					} else {
						$('#city').empty();
					}
				});
			})
		</script>
		<script>

			checkApp();
			async function checkApp() {
				const res = await fetch('<?= base_url()?>appointment/checkIC');
				const data = await res.json();

				if (data > 0){
					$(".instant-cure").removeClass("d-none");
					$(".instant-cure a").attr('href', '<?= base_url()?>chat/'+ data);
				}
			}
		</script>

	</body>

</html>
