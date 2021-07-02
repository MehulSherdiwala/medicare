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
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css?version=12">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
			<script src="<?= base_url() ?>assets/js/html5shiv.min.js"></script>
			<script src="<?= base_url() ?>assets/js/respond.min.js"></script>
		<![endif]-->

	<style>
		.ml-2{
			margin-left: .4rem!important;
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
			<div style="position: absolute;top: 0;left: 50px">
				<img src="<?= base_url() ?>assets/img/medicine/med11.png" class="img-fluid" style="height: 170px;width: auto;margin-left: 15px;" alt="">
			</div>
			<div class="banner-wrapper">
				<div class="banner-header text-center">
					<h1>Medicines</h1>
				</div>

				<!-- Search -->
				<div class="search-box">
					<div class="form">
						<div class="form-group search-info">
							<input type="text" class="form-control" placeholder="Search Medicine" id="search" value="<?= $search?>" autocomplete="off">
						</div>
						<button type="button" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>
					</div>
				</div>
				<!-- /Search -->
			</div>
			<div style="position: absolute;top: 0;right: 0">
				<img src="<?= base_url() ?>assets/img/medicine/med9.png" class="img-fluid" style="width: 240px;height: 183px" alt="">
			</div>
		</div>
	</section>
	<!-- /Home Banner -->


	<section class="ratio_square tools-grey light-layout section-b-space" style="background: #ffffff">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="product-5 product-m no-arrow" id="medicine">
					</div>
						<div id="pagination_link" class="text-center"></div>
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
<script src="<?= base_url() ?>assets/js/slick.js"></script>

<!-- Custom JS -->
<script src="<?= base_url() ?>assets/js/script.js?version=4"></script>

<script>

	let searchStr = '<?= $search?>';
	$("#search").keyup( function () {
		searchStr = $(this).val();
		load_medicine_data(1,searchStr);
	});
	function load_medicine_data(page,searchStr)
	{
		$.ajax({
			url:"<?php echo base_url(); ?>medicine/medicinePages/"+page + "/" + searchStr,
			method:"GET",
			dataType:"json",
			success:function(data)
			{
				$('#medicine').html(data.medicine);
				$('#pagination_link').html(data.pagination_link);
				$('[data-toggle="tooltip"]').tooltip();
			}
		});
	}

	load_medicine_data(1,searchStr);

	$(document).on("click", ".pagination li a", function(event){
		event.preventDefault();
		var page = $(this).data("ci-pagination-page");
		load_medicine_data(page,searchStr);
	});


</script>

<?php
if (!isset($_SESSION['userType'])||$_SESSION['userType']==3)
{
	?>
	<script>
		function addToCart(id) {
			const qty = 1;

			$.ajax({
				url: '<?= base_url()?>shop/addToCart',
				method: 'post',
				data: {
					id:id,
					qty:qty
				},
				success:function(data){
					$(".count").text(data);
					alert('Item Added to Cart');
				}
			})

		}
		checkApp();

		async function checkApp() {
			const res = await fetch('<?= base_url()?>appointment/checkIC');
			const data = await res.json();

			if (data > 0) {
				$(".instant-cure").removeClass("d-none");
				$(".instant-cure a").attr('href' , '<?= base_url()?>chat/' + data);
			}
		}
	</script>
	<?php
}
?>
</body>

</html>
