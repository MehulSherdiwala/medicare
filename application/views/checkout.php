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

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">

	<link href="<?= base_url()?>assets/plugins/step-wizard/css/style.css?version=3" rel="stylesheet" />
	<!-- Main CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css?version=16">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?= base_url() ?>assets/js/html5shiv.min.js"></script>
		<script src="<?= base_url() ?>assets/js/respond.min.js"></script>
	<![endif]-->

</head>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">

	<!-- Header -->
	<?php
	include("header.php");
	?>
	<!-- /Header -->

	<!-- Home Banner -->
	<section class="section section-search search-medicine">
		<div class="container-fluid">
			<div class="banner-wrapper">
				<div class="banner-header text-center">
					<h1>Checkout</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="view-medicine section-b-space pt-5">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="wizard-form" align="center">
	<!--					<div class="wizard-header">-->
	<!--						<h3>Form Wizard</h3>-->
	<!--						<p>Nostrud exercitation commodo consequat.</p>-->
	<!--					</div>-->
						<form class="form-register" action="<?= base_url()?>wallet/paymentGateway" id="form" method="post">
							<div id="form-total">
								<!-- SECTION 2 -->
								<h2>Delivery Address</h2>
								<section>
									<div align="left" class="sec" >
										<div id="addList">
											<?php
											foreach ($address as $key=>$add)
											{
												?>
											<div class="custom-control custom-radio  p-3">
													<input type="radio" class="custom-control-input" id="i<?= $key?>" name="address" required value="<?= $add['daId']?>">
												<label class="custom-control-label" for="i<?= $key?>">
													<b class="text-capitalize"><?=
														$add['name'].'  '.$add['phone']
														?></b>
													<br>
													<?=
													$add['address'].' - '.$add['pincode']
													?>
												</label>
											</div>
											<?php
											}
											?>
										</div>
										<hr>
										<div class="text-right">
											<button type="button" class="btn btn-outline-danger" data-target="#add-address" data-toggle="modal">+ Add New Address</button>
										</div>
									</div>
								</section>
								<!-- SECTION 3 -->
								<h2>Order Summery</h2>
								<section>
									<div class="sec" id="items">
										<?php
										if (isset($items))
										{
											?>
											<input type="hidden" name="type" value="cart">
											<?php
											foreach ($items as $medData)
											{
												?>
												<div class="row">
													<div class="col-md-5 offset-1 img-wrapper">
														<img src="<?= base_url() ?>medicineImg/<?= explode(',',$medData['image'])[0] ?>"
															 class="img-fluid" alt="">
													</div>
													<div class="col-md-5 med-details text-left">
														<h3><?= $medData['medName'] . ' ' . $medData['dose'] ?></h3>
														<h6>By <?= $medData['pharName'] ?></h6>
														<h4><?= $medData['capacity'] ?></h4>
														<h3><i class="fas fa-rupee-sign"></i> <?= $medData['price'] ?>
														</h3>
														<div>
															<input type="number" class="form-control qty float-left"
																   data-rowid="<?= $medData['rowid'] ?>"
																   data-pwmid="<?= $medData['pwmId'] ?>"
																   value="<?= $medData['qty'] ?>">
															<button type="button" id="<?= $medData['rowid'] ?>"
																	data-pwmid="<?= $medData['pwmId'] ?>"
																	class="remove_cart btn btn-danger btn-sm"
																	style="margin-left: 25px; margin-top: 10px;"><i
																	class="far fa-trash-alt"></i></button>
														</div>
													</div>

												</div>
												<br>
												<?php
											}
										} elseif (isset($medicine))
										{
											?>
											<div class="row">
												<div class="col-md-5 offset-1 img-wrapper">
													<img src="<?= base_url() ?>medicineImg/<?= explode(',',$medicine['image'])[0] ?>"
														 class="img-fluid" alt="">
												</div>
												<div class="col-md-5 med-details text-left">
													<h3><?= $medicine['medName'] . ' ' . $medicine['dose'] ?></h3>
													<h6>By <?= $medicine['pharName'] ?></h6>
													<h4><?= $medicine['capacity'] ?></h4>
													<h3><i class="fas fa-rupee-sign"></i> <?= $medicine['price'] ?>
													</h3>
													<div>
														<input type="number" class="form-control float-left"
															   value="<?= $medicine['qty'] ?>" id="qty" name="qty">
														<input type="hidden" name="pwmId" value="<?= $medicine['pwmId'] ?>">
														<input type="hidden" name="type" value="direct">
														<input type="hidden" id="price" name="price" value="<?= $medicine['price'] ?>">
													</div>
												</div>

											</div>
											<br>
											<?php
										}
										?>
									</div>
								</section>
								<!-- SECTION 4 -->
								<h2>Payment Options</h2>
								<section>
									<div class="sec" align="left">

										<?php
											if($balance > 0)
											{
												if (isset($medicine))
												{
													if ($balance > ($medicine['qty'] * $medicine['price']))
													{
														?>
														<div id="walOpt">
															<div class="custom-control custom-radio p-3">
																<input type="radio" class="custom-control-input"
																	   id="wallet"
																	   name="payOption" required value="wallet">
																<label class="custom-control-label" for="wallet">
																	Pay from Wallet
																	<br>
																	<i class="fas fa-rupee-sign"></i> <?= $balance ?>
																</label>
															</div>
														</div>
														<?php
													} else
													{
														?>
														<div id="walOpt">
															<div class="custom-control custom-checkbox p-3">
																<input type="checkbox" class="custom-control-input"
																	   id="wallet"
																	   name="payWallet" value="wallet">
																<label class="custom-control-label" for="wallet">
																	Pay from Wallet
																	<br>
																	<i class="fas fa-rupee-sign"></i> <?= $balance ?>
																</label>
															</div>
														</div>
														<?php
													}
												} else{
													?>
													<div id="walOpt">
													</div>
													<?php
												}
											}
										?>
										<div class="custom-control custom-radio p-3">
												<input type="radio" class="custom-control-input" id="card" name="payOption" required value="card">
											<label class="custom-control-label" for="card">
												Credit / Debit Card
											</label>
										</div>
										<div class="custom-control custom-radio p-3">
												<input type="radio" class="custom-control-input"id="nb" name="payOption" required value="Net Banking">
											<label class="custom-control-label" for="nb">
												Net Banking
											</label>
										</div>
										<div class="custom-control custom-radio p-3">
												<input type="radio" class="custom-control-input" id="cod" name="payOption" required value="COD">
											<label class="custom-control-label" for="cod">
												Cash on Delivery
											</label>
										</div>
									</div>
									<input type="submit" value="Submit" id="finish" style="display: none">
<!--									<input type="hidden" name="totalAmount" value="--><?//= (isset($medicine))? $medicine['qty']*$medicine['price'] : '' ?><!--" id="totalAmount">-->
									<input type="hidden" name="wallet" value="<?= $balance?>" >
									<input type="hidden" name="totalAmount" value="<?= (isset($medicine))? $medicine['qty']*$medicine['price'] : '' ?>" id="totalAmt">
								</section>
							</div>

						</form>
					</div>
				</div>

				<div class="col-md-4" style="margin-top: 60px;">
					<h2>Price Details</h2>
					<hr>
					<div id="price">
						<table class="table no-border table-striped">
							<tr>
								<td>Price (1 item)</td>
								<td><i class="fas fa-rupee-sign"></i> <span class="amount"><?= (isset($medicine))? $medicine['qty']*$medicine['price'] : '' ?></span></td>
							</tr
							<tr>
								<td>Delivery Charges</td>
								<td>Free</td>
							</tr>
							<tr>
								<td><b>Total Payable</b></td>
								<td><i class="fas fa-rupee-sign"></i> <span class="amount"><?= (isset($medicine))? $medicine['qty']*$medicine['price'] : '' ?></span>
								</td>
							</tr>

						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div aria-hidden="true" class="modal fade" id="add-address" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header"><h5 class="modal-title">Add Address</h5></div>
				<div class="modal-body">
					<form class="add-address-parsley" id="cngMed">
						<div class="form-group">
							<input class="form-control" id="daName" placeholder="Name" type="text" required >
						</div>
						<div class="form-group">
							<input class="form-control" id="daPhone" placeholder="Mobile No" type="number" required >
						</div>
						<div class="form-group">
							<input type="number" class="form-control" id="daPincode" placeholder="Pincode" required>
						</div>
						<div class="form-group">
							<textarea id="daAddress" class="form-control" placeholder="Address" required></textarea>
						</div>

						<div class="form-group">
							<select id="state" class="form-control selectpicker" >
								<option value="0">--Select State--</option>
								<?php
								foreach ($state as $item)
								{
									echo '<option value="'. $item['stateId'].'">'. $item['stateName'].'</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<select name="city" id="city" class="form-control"  required data-parsley-select="0">
								<option value="0">--Select City--</option>
							</select>
						</div>
						<div id="error" class="error text-center"></div>
					</form>
				</div>
				<div class="modal-footer d-block">
					<div class="actions justify-content-between text-right">
						<button class="btn btn-danger" data-dismiss="modal" type="button">Cancel</button>
						&nbsp;&nbsp;
						<button class="btn btn-success" type="button" id="addAdd">Add</button>
					</div>
				</div>
			</div>
		</div>
	</div><!-- end Add patients modals --><!-- Add patients modals -->


</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>

<!-- Slick JS -->
<!--<script src="--><?//= base_url() ?><!--assets/js/slick.js"></script>-->

<!--  Plugin for the Wizard -->
<script src="<?= base_url()?>assets/plugins/step-wizard/js/jquery.steps.js" type="text/javascript"></script>
<script src="<?= base_url()?>assets/plugins/step-wizard/js/main.js?version=5" type="text/javascript"></script>

<!-- parsley JS -->
<script src="<?= base_url()?>assets/plugins/parsley/js/parsley.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url() ?>assets/js/script.js"></script>

<script>
	$(document).ready(function () {

		let pars = $(".add-address-parsley").parsley();
		$("#form").parsley();

		$("#addAdd").on('click', function () {
			pars.validate();

			if (pars.isValid()){
				const daName = $("#daName").val();
				const daPhone = $("#daPhone").val();
				const daPincode = $("#daPincode").val();
				const daAddress = $("#daAddress").val();
				const city = $("#city").val();

				$.ajax({
					url: '<?= base_url()?>shop/addAddress',
					method:'post',
					data: {
						daName:daName,
						daPhone:daPhone,
						daPincode:daPincode,
						daAddress:daAddress,
						city:city,
					},
					success:function (data) {
						console.log(data);
						$("#addList").append(data);
						$("#add-address").modal('toggle');
					}
				})
			}

		});

		async function fetchCity(id){
			const response = await fetch('<?= base_url()?>city/fetchCity/' + id);
			const myJson = await response.json();
			$('#city')
				.empty()
				.append($("<option></option>")
					.text("--Select City--"));
			$.each(myJson , function (key , value) {
				$('#city')
					.append($("<option></option>")
						.attr("value" , value.cityId)
						.text(value.cityName));
			});

		}
		$("#state").on('change', function () {
			const id = $(this).val();
			if (id!=0) {
				fetchCity(id);
			} else {
				$('#city').empty();
			}
		});

		<?php if (isset($items)){
		?>
		async function removeItem(pwmId , id) {
			await $.ajax({
				url: '<?= base_url()?>/shop/removeCart/1' ,
				method: 'post' ,

				data: {
					id: id ,
					pwmId: pwmId
				} ,
				success: function (data) {
					$("#items").html(data);
					fetchPrice();
				}
			});
			$(".remove_cart").on('click' , function () {
				const pwmId = $(this).data('pwmid');
				const id = $(this).attr('id');
				removeItem(pwmId , id)
			});
		}

		$(".remove_cart").on('click' , function () {
			const pwmId = $(this).data('pwmid');
			const id = $(this).attr('id');
			removeItem(pwmId , id)
		});
		$(".qty").on('change' , function () {
			const id = $(this).data('rowid');
			const pwmId = $(this).data('pwmid');
			const qty = $(this).val();

			updateCart(pwmId , id , qty)

		});

		async function updateCart(pwmId , id , qty) {
			await $.ajax({
				url: '<?= base_url()?>/shop/updateCart/1' ,
				method: 'post' ,
				data: {
					id: id ,
					pwmId: pwmId ,
					qty: qty ,
				} ,
				success: function (data) {
					$("#items").html(data);
					fetchPrice();
				}
			});
			$(".qty").on('change' , function () {
				const id = $(this).data('rowid');
				const pwmId = $(this).data('pwmid');
				const qty = $(this).val();

				updateCart(pwmId , id , qty)

			});
		}

		fetchPrice();

		async function fetchPrice() {
			await $.ajax({
				url: '<?= base_url()?>/shop/priceDetails' ,
				method: 'post' ,
				dataType: 'json',
				success: function (data) {
					$("#price").html(data['html']);
					$("#totalAmt").val(data['total']).change();
				}
			});
		}

		$(".qty").on('change' , function () {
			const id = $(this).data('rowid');
			const pwmId = $(this).data('pwmid');
			const qty = $(this).val();

			updateCart(pwmId , id , qty)

		});

		<?php
		} elseif (isset($medicine)){
			?>
				$("#qty").on('change', function () {
					const qty = $(this).val();
					const price = $("#price").val();

					$(".amount, #totalAmount").text(qty*price);
					$("#totalAmt").val(qty*price).change();
				});
			<?php
		}
		?>
		let balance = <?= $balance?>;

		if (balance > 0) {
			$("#totalAmt").on('change' , function () {
				let amount = $(this).val();
				if (balance > amount){
					let html = '<div class="custom-control custom-radio p-3">\n' +
						'<input type="radio" class="custom-control-input" id="wallet"\n' +
						'name="payOption" required value="wallet">\n' +
						'<label class="custom-control-label" for="wallet">\n' +
						'Pay from Wallet\n' +
						'<br>\n' +
						'<i class="fas fa-rupee-sign"></i> ' + balance +
						'</label>\n' +
						'</div>';
					$("#walOpt").html(html);
				} else {

					let html = '<div class="custom-control custom-checkbox p-3">\n' +
						'<input type="checkbox" class="custom-control-input" id="wallet"\n' +
						'name="payWallet" value="wallet">\n' +
						'<label class="custom-control-label" for="wallet">\n' +
						'Pay from Wallet\n' +
						'<br>\n' +
						'<i class="fas fa-rupee-sign"></i> ' + balance +
						'</label>\n' +
						'</div>';
					$("#walOpt").html(html);
				}
			});
		}
		});
</script>

</body>

</html>
