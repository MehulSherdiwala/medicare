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

	<!--Slick slider css-->
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/slick.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/slick-theme.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css?version=11">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?= base_url() ?>assets/js/html5shiv.min.js"></script>
		<script src="<?= base_url() ?>assets/js/respond.min.js"></script>
	<![endif]-->

	<style>
		.product-slick .lazyload{
			height: 400px!important;
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
				<img src="<?= base_url() ?>assets/img/medicine/med11.png" class="img-fluid" style="height: 127px;width: auto;margin-left: 15px;" alt="">
			</div>
			<div class="banner-wrapper">
				<!-- Search -->
				<div class="search-box">
					<form action="<?= base_url()?>medicine" method="post">
						<div class="form">
							<div class="form-group search-info">
								<input type="text" class="form-control" placeholder="Search Medicine" id="search" autocomplete="off" name="search">
							</div>
							<button type="submit" class="btn btn-primary search-btn"><i class="fas fa-search"></i> <span>Search</span></button>
						</div>
					</form>
				</div>
				<!-- /Search -->

			</div>
			<div style="position: absolute;top: 0;right: 0">
				<img src="<?= base_url() ?>assets/img/medicine/med9.png" class="img-fluid" style="width: 200px;" alt="">
			</div>
		</div>
	</section>
	<!-- /Home Banner -->


	<section class="view-medicine section-b-space pt-5">
		<div class="container" style="box-shadow: 0px 4px 10px 7px rgba(0, 0, 0, 0.23);border-radius: 10px">
				<div class="row" style="padding-top: 25px;">
					<div class="col-md-5 offset-2 img-wrapper">
						<div class="product-slick">
							<?php
							$image = explode(',',$medData['image']);
							foreach ($image as $key => $img)
							{
								?>
								<div><img src="<?= base_url()?>medicineImg/<?= (($img == '')? 'medicine2.png' : $img)?>" alt="" class="img-fluid blur-up lazyload image_zoom_cls-<?= $key?>"></div>
								<?php
							}
							?>
						</div>
						<div class="row">
							<div class="col-12 p-0">
								<div class="slider-nav">
									<?php
									foreach ($image as $key => $img)
									{
										?>
										<div><img src="<?= base_url()?>medicineImg/<?= (($img == '')? 'medicine2.png' : $img)?>" alt="" class="img-fluid blur-up lazyload"></div>
										<?php
									}
									?>
								</div>
							</div>
						</div>
<!--						<img src="--><?//= base_url()?><!--assets/img/medicine.png" class="img-fluid" alt="Medicine Image"  style="border-radius: 8px">-->
					</div>
					<div class="col-md-5 med-details">
						<h2><?= $medData['medName'].' '.$medData['dose']?></h2>
						<h6>By <a href="<?= base_url()?>pharmacist/view-profile/<?= $medData['pharId']?>"><?= $medData['pharName']?></a></h6>
						<div class="rating">
							<?php
							for ($i=1;$i<=5;$i++){
								if ($i <= $avgRate){
									echo "<i class='fas fa-star filled'></i>";
								} else {
									echo "<i class='fas fa-star'></i>";
								}
							}
							?>
							<span class="d-inline-block average-rating">(<?= $rating['count']?>)</span>
						</div>
						<h4><?= $medData['capacity']?></h4>
						<h3><i class="fas fa-rupee-sign"></i> <?= $medData['price']?></h3>
						<div>
							<form action="<?= base_url()?>shop/checkout" method="get">
								<input type="hidden" name="_" value="<?= $_GET['_']?>">
								<input type="number" id="qty" class="form-control" value="1" name="qty">
								<br>
								<button type="button" class="btn btn-danger " <?= ((!isset($_SESSION['userType'])||$_SESSION['userType']==3)? '' : 'disabled' ) ?> id="addToCart">Add to Cart</button>
								<button type="submit" class="btn btn-success " <?= ((!isset($_SESSION['userType'])||$_SESSION['userType']==3)? '' : 'disabled' ) ?>>Buy Now</button>
							</form>
						</div>
					</div>

				</div>
				<div class="row">
					<div class="offset-1 col-md-10 med-desc">
						<h2>Description</h2>
						<p><?= $medData['medDescription']?></p>
					</div>
				</div>
				<div class="row">
					<div class="offset-1 col-md-10 med-desc">
						<h2>Reviews</h2>

						<div class="widget review-listing">
							<ul class="comments-list">

								<?php
								foreach ($rating['rate'] as $rate)
								{
									?>
									<li>
										<div class="comment">
											<img class="avatar avatar-sm rounded-circle" alt="User Image" src="<?= base_url()?>profile/<?= (($rate['profileImg'] == '')? 'profile.png' : $rate['profileImg'])?>">
											<div class="comment-body w-100">
												<div class="meta-data">
													<span class="comment-author"><?= $rate['username']?></span>
													<span class="comment-date">Reviewed <?= $rate['datetime']?> ago</span>
													<div class="review-count rating">
														<?php
														for ($i=1;$i<=5;$i++){
															if ($i <= $rate['rates']){
																echo "<i class='fas fa-star filled'></i>";
															} else {
																echo "<i class='fas fa-star'></i>";
															}
														}
														?>

													</div>
												</div>
												<p class="comment-content">
													<?= $rate['description']?>
												</p>
											</div>
										</div>


									</li>
									<?php
								}
								?>
							</ul>
							<div class="all-feedback text-center">
								<a href="#" class="btn btn-primary btn-sm">
									Show all feedback <strong>(<?= $rating['count']?>)</strong>
								</a>
							</div>
						</div>

						<?php
						if ($review == 1)
						{
							?>
							<!-- Write Review -->
							<div class="write-review">
								<h4>Write a review for <strong><?= $medData['medName'].' '.$medData['dose']?></strong></h4>

								<!-- Write Review Form -->
								<form action="<?= base_url()?>medicine/medReview" method="post">
									<input type="hidden" name="medId" value="<?= $_GET['_']?>">
									<input type="hidden" name="url" id="url">
									<div class="form-group">
										<label>Review</label>
										<div class="star-rating">
											<input id="star-5" type="radio" name="rating" value="5">
											<label for="star-5" title="5 stars">
												<i class="active fa fa-star"></i>
											</label>
											<input id="star-4" type="radio" name="rating" value="4">
											<label for="star-4" title="4 stars">
												<i class="active fa fa-star"></i>
											</label>
											<input id="star-3" type="radio" name="rating" value="3">
											<label for="star-3" title="3 stars">
												<i class="active fa fa-star"></i>
											</label>
											<input id="star-2" type="radio" name="rating" value="2">
											<label for="star-2" title="2 stars">
												<i class="active fa fa-star"></i>
											</label>
											<input id="star-1" type="radio" name="rating" value="1">
											<label for="star-1" title="1 star">
												<i class="active fa fa-star"></i>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label>Your review</label>
										<textarea id="review_desc" maxlength="100" name="description"
												  class="form-control"></textarea>

										<div class="d-flex justify-content-between mt-3"><small
												class="text-muted"><span id="chars">100</span> characters
												remaining</small></div>
									</div>
									<hr>
									<div class="form-group">
										<div class="terms-accept">
											<div class="custom-checkbox">
												<input type="checkbox" id="terms_accept">
												<label for="terms_accept">I have read and accept <a href="#">Terms
														&amp; Conditions</a></label>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button type="submit" class="btn btn-primary submit-btn">Add Review
										</button>
									</div>
								</form>
								<!-- /Write Review Form -->

							</div>
							<!-- /Write Review -->
							<?php
						}
						?>

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
<script src="<?= base_url() ?>assets/js/bootstrap3-typeahead.min.js"></script>

<!-- lazyload js-->
<script src="<?= base_url()?>assets/js/lazysizes.min.js"></script>
<!-- Slick JS -->
<script src="<?= base_url() ?>assets/js/slick.js"></script>

<!-- Zoom js-->
<script src="<?= base_url()?>assets/js/jquery.elevatezoom.js"></script>
<!-- Custom JS -->
<script src="<?= base_url() ?>assets/js/script.js"></script>

<script>


	$("#search").typeahead({
		autoSelect:false,
		source: function(query, result)
		{
			$.ajax({
				url:"<?= base_url() ?>medicine/searchMed",
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
		}
	});

	$('.product-slick').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slider-nav'
	});

	$('.slider-nav').slick({
		vertical: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		asNavFor: '.product-slick',
		arrows: false,
		dots: false,
		focusOnSelect: true
	});
</script>

<?php
if (!isset($_SESSION['userType'])||$_SESSION['userType']==3)
{
	?>
	<script>

		$(document).ready(function () {
			$("#url").val(window.location.href);

			$("#addToCart").on('click' , function () {
				const qty = $("#qty").val();
				const id = '<?= $_GET['_']?>';
				// console.log(id);

				$.ajax({
					url: '<?= base_url()?>/shop/addToCart' ,
					method: 'post' ,
					data: {
						id: id ,
						qty: qty
					} ,
					success: function (data) {
						$(".count").text(data);
					}
				})

			});
		});
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
