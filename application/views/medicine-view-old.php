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
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css?version=9">

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
		</div>
	</section>
	<!-- /Home Banner -->


	<div class="container">
		<section class="view-medicine section-b-space pt-5">
				<div class="row">
					<div class="col-md-5 offset-2 img-wrapper">
						<img src="<?= base_url()?>assets/img/medicine.jpg" class="img-fluid" alt="Medicine Image"  style="border-radius: 8px">
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
								<button type="button" class="btn btn-danger" id="addToCart">Add to Cart</button>
								<button type="submit" class="btn btn-success">Buy Now</button>
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
		</section>
	</div>


	<!-- Footer -->
	<footer class="footer">

		<!-- Footer Top -->
		<div class="footer-top">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-3 col-md-6">

						<!-- Footer Widget -->
						<div class="footer-widget footer-about">
							<div class="footer-logo">
								<img src="<?= base_url() ?>assets/img/FooterMediCare.png" alt="logo">
							</div>
							<div class="footer-about-content">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<div class="social-icon">
									<ul>
										<li>
											<a href="#" target="_blank"><i class="fab fa-facebook-f"></i> </a>
										</li>
										<li>
											<a href="#" target="_blank"><i class="fab fa-twitter"></i> </a>
										</li>
										<li>
											<a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
										</li>
										<li>
											<a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
										</li>
										<li>
											<a href="#" target="_blank"><i class="fab fa-dribbble"></i> </a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- /Footer Widget -->

					</div>

					<div class="col-lg-3 col-md-6">

						<!-- Footer Widget -->
						<div class="footer-widget footer-menu">
							<h2 class="footer-title">For Patients</h2>
							<ul>
								<li><a href="search.html"><i class="fas fa-angle-double-right"></i> Search for Doctors</a></li>
								<li><a href="login.php"><i class="fas fa-angle-double-right"></i> Login</a></li>
								<li><a href="register.php"><i class="fas fa-angle-double-right"></i> Register</a></li>
								<li><a href="booking.html"><i class="fas fa-angle-double-right"></i> Booking</a></li>
								<li><a href="patient-dashboard.html"><i class="fas fa-angle-double-right"></i> Patient Dashboard</a></li>
							</ul>
						</div>
						<!-- /Footer Widget -->

					</div>

					<div class="col-lg-3 col-md-6">

						<!-- Footer Widget -->
						<div class="footer-widget footer-menu">
							<h2 class="footer-title">For Doctors</h2>
							<ul>
								<li><a href="appointments.html"><i class="fas fa-angle-double-right"></i> Appointments</a></li>
								<li><a href="chat.html"><i class="fas fa-angle-double-right"></i> Chat</a></li>
								<li><a href="login.php"><i class="fas fa-angle-double-right"></i> Login</a></li>
								<li><a href="doctor-register.html"><i class="fas fa-angle-double-right"></i> Register</a></li>
								<li><a href="doctor-dashboard.html"><i class="fas fa-angle-double-right"></i> Doctor Dashboard</a></li>
							</ul>
						</div>
						<!-- /Footer Widget -->

					</div>

					<div class="col-lg-3 col-md-6">

						<!-- Footer Widget -->
						<div class="footer-widget footer-contact">
							<h2 class="footer-title">Contact Us</h2>
							<div class="footer-contact-info">
								<div class="footer-address">
									<span><i class="fas fa-map-marker-alt"></i></span>
									<p> 3556  Beech Street, San Francisco,<br> California, CA 94108 </p>
								</div>
								<p>
									<i class="fas fa-phone-alt"></i>
									+1 315 369 5943
								</p>
								<p class="mb-0">
									<i class="fas fa-envelope"></i>
									doccure@example.com
								</p>
							</div>
						</div>
						<!-- /Footer Widget -->

					</div>

				</div>
			</div>
		</div>
		<!-- /Footer Top -->

		<!-- Footer Bottom -->
		<div class="footer-bottom">
			<div class="container-fluid">

				<!-- Copyright -->
				<div class="copyright">
					<div class="row">
						<div class="col-md-6 col-lg-6">
							<div class="copyright-text">
								<p class="mb-0">&copy; 2019 Doccure. All rights reserved.</p>
							</div>
						</div>
						<div class="col-md-6 col-lg-6">

							<!-- Copyright Menu -->
							<div class="copyright-menu">
								<ul class="policy-menu">
									<li><a href="term-condition.html">Terms and Conditions</a></li>
									<li><a href="privacy-policy.html">Policy</a></li>
								</ul>
							</div>
							<!-- /Copyright Menu -->

						</div>
					</div>
				</div>
				<!-- /Copyright -->

			</div>
		</div>
		<!-- /Footer Bottom -->

	</footer>
	<!-- /Footer -->

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

	$(document).ready(function () {
		$("#url").val(window.location.href);

		$("#addToCart").on('click', function () {
			const qty = $("#qty").val();
			const id = '<?= $_GET['_']?>';
			// console.log(id);

			$.ajax({
				url: '<?= base_url()?>/shop/addToCart',
				method: 'post',
				data: {
					id:id,
					qty:qty
				},
				success:function(data){
					$(".count").text(data);
				}
			})

		});
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
