<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>MediCare</title>

	<!-- Favicons -->
	<link type="image/x-icon" href="<?= base_url() ?>assets/img/fav.png" rel="icon">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/css/bootstrap-datepicker.min.css">
	<!-- Main CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css?version=11">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?= base_url() ?>assets/js/html5shiv.min.js"></script>
		<script src="<?= base_url() ?>assets/js/respond.min.js"></script>
	<![endif]-->


</head>
<body>
<div hidden id="spinner"></div>

<!-- Main Wrapper -->
<div class="main-wrapper">

	<!-- Header -->
	<?php
	include("header.php");
	?>
	<!-- /Header -->

	<div class="breadcrumb-bar">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-12 col-12">
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Appointment</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Book Appointment</h2>
				</div>
			</div>
		</div>
	</div>

	<div class="content" style="min-height: 205px;">
		<div class="container-fluid">
			<div class="row">
				<div class="col col-md-10 offset-1">
					<div class="card">
						<div class="card-body">
							<div style="position: absolute;top: 0;left: 50px">
								<img src="<?= base_url() ?>assets/img/app1.png" class="img-fluid" style="height: 250px;width: auto;margin-left: 15px;" alt="">
							</div>
							<h2 class=" text-center">Appointment</h2>
							<!--data-parsley-validate-->
							<form action="<?= base_url() ?>appointment/pay" method="post"   id="form">
								<div class="col-md-6 offset-3 ">
									<div class="form-group">
										<label>Appointment Type</label>
										<select name="appType" id="appType" class="select2 form-control">
											<option value="2">Select</option>
											<option value="0">Clinic Appointment</option>
											<option value="1">Instant Cure Appointment</option>
										</select>
									</div>
								</div>
								<div class="col-md-4 mt-3 offset-4 text-center d-none" id="ICpriceSec">
									<div class="form-group">
										<label>Consulting Fees : </label>
										<span class="badge" style="font-size: 14px;"><i
												class="fas fa-rupee-sign"></i> 300</span>
										<input type="hidden" name="icprice" class="price" value="300" >
									</div>
								</div>
								<div id="sec" class="d-none">
									<div class="row">
										<div class="col-md-6 offset-3 mt-3 text-center" id="typeSec">
											<div class="form-group form-focus mb-0">
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" id="doctor" name="type"
														   class="custom-control-input" value="0" >
													<label class="custom-control-label" for="doctor">Doctor</label>
												</div> &nbsp;&nbsp;
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" id="clinic" name="type" value="1"
														   class="custom-control-input" checked>
													<label class="custom-control-label" for="clinic">Clinic</label>
												</div>
											</div>
										</div>
										<div class="col-md-6 offset-3" id="dropdwnSec">
											<select id="dropdwn" name="id" class="select2 form-control" style="width: 100%">
												<option value="">Select</option>
											</select>
										</div>
										<div class="col-md-8 mt-3 offset-2">
											<div id="schedule"></div>
										</div>
										<div class="col-md-8 mt-3 offset-2 d-none" id="dateSec">
											<div class="form-group">
												<label>Select Date</label>
												<input class="form-control" type="text" placeholder="Date" name="date"
													   id="date"  autocomplete="off">
											</div>
										</div>
										<div class="col-md-8 mt-3 offset-2 d-none" id="timeSec">
											<div class="form-group">
												<label>Select Time Slot</label>
												<select id="timeSlot" class="select2 form-control" name="timeSlot"
														 data-parsley-min="1"
														data-parsley-min-message="This value is required.">
													<option value="">Select</option>
												</select>
											</div>
										</div>
										<div class="col-md-8 mt-3 offset-2 d-none" id="checkSec">
											<div class="form-group">
												<button type="button" class="btn btn-info" id="check">Check
													Availability
												</button>
												<span class="float-right badge" id="appTime"
													  style="font-size: 16px;line-height: 25px;display: block;height: 38px;"></span>
											</div>
										</div>
										<div class="col-md-8 mt-3 offset-2 d-none" id="descSec">
											<div class="form-group">
												<label>Description</label>
												<input class="form-control" type="text" placeholder="Description"
													   name="desc" id="desc" >
											</div>
										</div>
										<div class="col-md-4 mt-3 offset-4 text-center d-none" id="priceSec">
											<div class="form-group">
												<label>Consulting Fees : </label>
												<span class="badge" style="font-size: 14px;"><i
														class="fas fa-rupee-sign"></i> <span id="price"></span></span>
												<input type="hidden" name="price" class="price">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4 mt-3 offset-4 text-center">
									<div class="form-group">
										<button type="submit" id="submit" class="btn btn-success" disabled>Proceed To Pay</button>
									</div>
								</div>
							</form>

							<div style="position: absolute;top: 40px;right: 0">
								<img src="<?= base_url() ?>assets/img/app2.jpg" class="img-fluid" style="width: 280px;" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<?php
	include ("footer.php")
	?>

</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- Select2 JS -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>

<script src="<?= base_url() ?>assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url() ?>assets/js/script.js"></script>

<script>
	$(document).ready(function () {
		$(".select2").select2();
		$("#date").datepicker({
			startDate: new Date(),
			autoclose: true,
			format:  "dd-mm-yyyy"
		});
		const spinner = $("#spinner");


		$("#appType").on('change', function () {
			let value = $(this).val();
			if (value == 0) {
				$("#submit").attr('disabled',false);
				$("#sec").removeClass('d-none');
				$("#ICpriceSec").addClass('d-none');
				$("#dropdwn,#date,#timeSlot,#desc").prop('required',true);
			}else if(value == 1) {
				$("#submit").attr('disabled',false);
				$("#sec").addClass('d-none');
				$("#ICpriceSec").removeClass('d-none');
				$("#dropdwn,#date,#timeSlot,#desc").prop('required',false);
				$("#form").parsley();
			} else {
				$("#submit").attr('disabled',true);
				$("#sec").addClass('d-none');
				$("#ICpriceSec").addClass('d-none');
				$("#dropdwn,#date,#timeSlot,#desc").prop('required',true);
			}
		});

		$("input[name='type']").on('change', function () {
			const type = $(this).val();
			fetchType(type);
		});
		fetchType(1);

		async function fetchType(type){
			spinner.removeAttr('hidden');
			const response = await fetch('<?= base_url()?>appointment/fetchType/' + type);
			const myJson = await response.json();
			$('#dropdwn')
				.empty()
				.append($("<option></option>")
					.text("Select"));
			$.each(myJson , function (key , value) {
				$('#dropdwn')
					.append($("<option></option>")
						.attr("value" , value.id)
						.text(value.name));
			});
			spinner.attr('hidden', '');

		}
		$("#dropdwn").on('change', function () {
			const id = $(this).val();
			if (id !== 'Select'){
				fetchSchedule(id);
				$("#dateSec,#priceSec,#descSec").removeClass("d-none");
			}
		});
		async function fetchSchedule(id){
			const type = $("input[name='type']").val();
			spinner.removeAttr('hidden');
			const response = await fetch('<?= base_url()?>appointment/fetchSchedule/' + type + '/' + id);
			const myJson = await response.json();

			let html = '';
			html += '<table class="table table-bordered" id="data-table" style="background: #ffffff">\n' +
				'<thead>\n' +
				'<tr>\n' +
				'<th scope="col">Day</th>\n' +
				'<th scope="col">Timing </th>\n' +
				'</tr>\n' +
				'</thead>\n' +
				'<tbody>';
			for (let i = 0; i < myJson.length; i++) {

				html += '<tr>\n' +
					'<td>'+ myJson[i].day +'</td>\n' +
					'<td>'+ myJson[i].time +'</td>\n' +
					'</tr>';
			}
			html += '</tbody></table>';
			$("#schedule").html(html);

			$("#price").text(myJson[0].price);
			$(".price").val(myJson[0].price);

			spinner.attr('hidden', '');

		}

		$("#date").on('change', function () {
			const date = $(this).val();
			const id = $("#dropdwn").val();
			const type = $("input[name='type']").val();
			$("#timeSec").removeClass("d-none");

			$.ajax({
				url: '<?= base_url()?>appointment/fetchTimeSlot',
				method:'post',
				data:{
					date:date,
					id:id,
					type:type
				},
				beforeSend: function () {
					spinner.removeAttr('hidden');
				},
				success:function (data) {
					let obj = JSON.parse(data);
					$('#timeSlot')
						.empty()
						.append($("<option></option>")
							.text("Select"));
					$.each(obj , function (key , value) {
						$('#timeSlot')
							.append($("<option></option>")
								.attr("value" , value.acId)
								.text(value.time));
					});
					$(".select2").select2();
				},
				complete: function () {
					spinner.attr('hidden', '');
				}
			})
		});
		$('#timeSlot').on('change', function () {
			$("#checkSec").removeClass("d-none");
			availability();
		});

		$("#check").on('click', function () {
			const date = $("#date").val();
			const id = $("#dropdwn").val();
			const timeSlot = $("#timeSlot").val();
			const type = $("input[name='type']").val();

			$.ajax({
				url: '<?= base_url() ?>appointment/checkAvailability',
				method:'post',
				data:{
					date:date,
					id:id,
					type:type,
					timeSlot:timeSlot,
				},
				success:function (data) {
					if (data == 0){
						alert('Appointment is not Available.');
						$("#appTime").text('');
						$("#availability").val(0);
					} else {
						alert('Appointment is Available.');
						$("#appTime").text(data);
						$("#availability").val(0);
					}
				}
			})
		});


		async function availability() {
			const date = $("#date").val();
			const id = $("#dropdwn").val();
			const timeSlot = $("#timeSlot").val();
			const type = $("input[name='type']").val();
			let res = false;

			await $.ajax({
				url: '<?= base_url() ?>appointment/checkAvailability',
				method:'post',
				data:{
					date:date,
					id:id,
					type:type,
					timeSlot:timeSlot,
				},
				success:function (data) {
					if (data == 0){
						$("#submit").attr('disabled',true);
					} else {
						$("#submit").attr('disabled',false);
					}
				}
			});
			return res;
		}

	});
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
