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
		.ml-2{
			margin-left: .4rem!important;
		}
		.disease-sy:hover{
			box-shadow: 0 3px 10px 2px rgba(0, 0, 0, 0.5)
		}
		a:hover{
			color: #272b41;
		}
		.disease-sy{
			background: rgba(19, 19, 19, 0);
			padding: 10px;
			border-radius: 8px;
			transition: .5s;
			box-shadow: 0px 3px 10px 2px rgba(0, 0, 0, 0.2);
			height: 170px;
		}
		.doctor-img{
			flex: 0 0 110px;
			max-height: 150px;
		}
		.section-search{
			background: #f9f9f9 url(<?= base_url()?>assets/img/search-bg.png) no-repeat bottom center!important;
		}
		.doc-info-cont{
			overflow: hidden;
			white-space: nowrap;
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
					<h1>Doctor</h1>
				</div>

				<!-- Search -->
				<div class="search-box">
					<div class="form">
						<div class="form-group search-info">
							<input type="text" class="form-control" placeholder="Search Diseases" id="search" value="<?= $search?>" autocomplete="off">
						</div>
						<button type="button" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>
					</div>
				</div>
				<!-- /Search -->
			</div>
		</div>
	</section>
	<!-- /Home Banner -->


	<section class="ratio_square tools-grey light-layout section-b-space" style="background: #ffffff">
		<div class="container">
			<div class="row"id="medicine">
				<div class="col">
					<div class="row" id="medicine">
					</div>
				</div>
			</div>
			<div id="pagination_link" class="text-center"></div>
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
			url:"doctors/doctorPages/" + page + '/' + searchStr,
			method:"GET",
			dataType:"json",
			success:function(data)
			{
				$('#medicine').html(data.doctor);
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
