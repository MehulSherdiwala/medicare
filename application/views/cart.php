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

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css?version=10">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?= base_url() ?>assets/js/html5shiv.min.js"></script>
		<script src="<?= base_url() ?>assets/js/respond.min.js"></script>
	<![endif]-->

	<style>
		a.disabled {
			pointer-events: none;
			cursor: default;
		}
	</style>
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
					<h1>Cart</h1>
				</div>

			</div>
		</div>
	</section>

	<section class="view-medicine section-b-space pt-5">
		<div class="container">
			<div class="row">
				<table class="table table-striped table-bordered" id="cartItem">

					<?= $cartItem?>
<!--					</tbody>-->
				</table>

			</div>
			<div class="row">
				<div class="col">
					<a href="<?= base_url()?>medicine" class="btn btn-danger">Continue Shopping</a>
				</div>
				<div class="col text-right">
					<a  href="<?= base_url()?>shop/checkout/cart" class="btn btn-danger <?= ($countCart == 0) ? 'disabled' : '' ?>" id="checkout" >Checkout</a>
				</div>
			</div>
		</div>
	</section>


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

<!-- Slick JS -->
<!--<script src="--><?//= base_url() ?><!--assets/js/slick.js"></script>-->

<!-- Custom JS -->
<script src="<?= base_url() ?>assets/js/script.js"></script>

<script>
	$(document).ready(function () {
		async function removeItem(pwmId,id){
			await $.ajax({
				url: '<?= base_url()?>/shop/removeCart',
				method: 'post',

				data: {
					id:id,
					pwmId:pwmId
				},
				success:function(data){
					$("#cartItem").html(data);
				}
			});
			$(".remove_cart").on('click', function () {
				const pwmId = $(this).data('pwmid');
				const id = $(this).attr('id');
				removeItem(pwmId,id)
			});
		}
		$(".remove_cart").on('click', function () {
			const pwmId = $(this).data('pwmid');
			const id = $(this).attr('id');
			removeItem(pwmId,id)
		});
		$(".qty").on('change', function () {
			const id = $(this).data('rowid');
			const pwmId = $(this).data('pwmid');
			const qty = $(this).val();

			updateCart(pwmId,id,qty)

		});
	});
	async function updateCart(pwmId,id,qty){
		await $.ajax({
			url: '<?= base_url()?>/shop/updateCart',
			method: 'post',
			data: {
				id:id,
				pwmId:pwmId,
				qty:qty,
			},
			success:function(data){
				$("#cartItem").html(data);
			}
		});
		$(".qty").on('change', function () {
			const id = $(this).data('rowid');
			const pwmId = $(this).data('pwmid');
			const qty = $(this).val();

			updateCart(pwmId,id,qty)

		});
	}
	$(".qty").on('change', function () {
		const id = $(this).data('rowid');
		const pwmId = $(this).data('pwmid');
		const qty = $(this).val();

		updateCart(pwmId,id,qty)

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
