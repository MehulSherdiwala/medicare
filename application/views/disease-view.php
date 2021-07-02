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
		.disease-sy,
		.disease-info{
			background: rgba(19, 19, 19, 0);
			padding: 20px;
			border-radius: 8px;
			transition: .5s;
			box-shadow: 0px 3px 10px 2px rgba(0, 0, 0, 0.2)
		}
		.disease-sy{
			padding: 10px;
		}
		.doctor-img{
			flex: 0 0 110px;
		}
		.doc-info-left{
			width: 100%;
			overflow: hidden;
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
				<img src="<?= base_url() ?>assets/img/medicine/dis9.png" class="img-fluid" style="height: 130px;" alt="">
			</div>
			<div class="banner-wrapper">
				<!-- Search -->
				<div class="search-box">
					<div class="form">
						<form action="<?= base_url()?>disease" method="post">
							<div class="form-group search-info">
								<input type="text" name="search" class="form-control" placeholder="Search Diseases" id="search" autocomplete="off">
							</div>
							<button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>
						</form>
					</div>
				</div>
				<!-- /Search -->
			</div>
			<div style="position: absolute;top: 0;right: 50px">
				<img src="<?= base_url() ?>assets/img/medicine/dis5.png" class="img-fluid" style="height: 125px" alt="">
			</div>
		</div>
	</section>
	<!-- /Home Banner -->


	<section class="view-medicine section-b-space">
		<div class="container">
			<div class="row">
				<div class="col col-md-4 offset-4 my-3">
					<div class="disease-info">
						<h3 class="text-center"><?= $disData['disName']?></h3>
					</div>
				</div>
				<div class="col col-md-6 offset-3">
					<h4>Description : : </h4>
				</div>
				<div class="col col-md-6 offset-3">
					<div class="disease-info">
						<p><?= $disData['description']?></p>
					</div>
				</div>
				<div class="col col-md-6 offset-3 mt-3 mb-0">
					<h4>Symptoms : : </h4>
				</div>
				<?php
					foreach ($disData['syDesc'] as $dis_datum)
					{
						?>
						<div class="col col-md-6 offset-3 mt-3">
							<div class="disease-sy">
								<p><?= $dis_datum?></p>
							</div>
						</div>
						<?php
					}
				?>

			</div>
			<br>
			<?php
				if (sizeof($docData) > 0)
				{
					?>
					<h3 class="ml-5">Doctors : :</h3>
					<?php
				}
			?>
			<div class="row ml-4">

				<?php
					foreach ($docData as $doc_datum)
					{
						?>
						<div class="col col-md-4 mt-3">
							<div class="disease-sy">
								<div class="doctor-widget">
									<div class="doc-info-left">
										<div class="doctor-img">
											<img src="<?= base_url()?>profile/<?= (($doc_datum['profileImg'] == '')? 'profile.png' : $doc_datum['profileImg'])?>" class="img-fluid" alt="User Image">
										</div>
										<div class="doc-info-cont">
											<a href="<?= base_url()?>doctor/view-profile/<?= $doc_datum['docId']?>"><h4 class="doc-name"><?= $doc_datum['username']?></h4></a>
											<p class="doc-speciality" title="<?= $doc_datum['specialization']?>"><?= $doc_datum['specialization']?></p>
											<div class="rating">
												<?php
												for ($i=1;$i<=5;$i++){
													if ($i <= $doc_datum['rating']){
														echo "<i class='fas fa-star filled'></i>";
													} else {
														echo "<i class='fas fa-star'></i>";
													}
												}
												?>
												<span class="d-inline-block average-rating">(<?= $doc_datum['cnt']?>)</span>
											</div>
											<div class="clinic-details">
												<p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?= $doc_datum['cityName']?>, <?= $doc_datum['stateName']?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				?>
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
<script src="<?= base_url() ?>assets/js/bootstrap3-typeahead.min.js"></script>

<!-- Slick JS -->
<!--<script src="--><?//= base_url() ?><!--assets/js/slick.js"></script>-->

<!-- Custom JS -->
<script src="<?= base_url() ?>assets/js/script.js"></script>

<script>
	$("#search").typeahead({
		autoSelect:false,
		source: function(query, result)
		{
			$.ajax({
				url:"<?= base_url() ?>disease/searchDis",
				method:"POST",
				data:{query:query},
				dataType:"json",
				success:function(data)
				{
					result($.map(data, function(item){
						return item.disName;
					}));
				}
			})
		}
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
