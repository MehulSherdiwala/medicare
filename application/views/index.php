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
		<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css?version=13">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="<?= base_url() ?>assets/js/html5shiv.min.js"></script>
			<script src="<?= base_url() ?>assets/js/respond.min.js"></script>
		<![endif]-->

	<style>
		.doc-img img{
			height: 150px;
			width: auto;
			margin: auto;
		}
		.ml-2{
			margin-left: .4rem!important;
		}
		@media (min-width: 768px) {
			.product-5 .col-md-3{
				max-width: 100%;
			}
		}
		h4	{
			color: #414146;
		}
		.how-it-works-section{
			display: flex;
			justify-content: space-around;
			padding-top: 18px;
			position: relative;
		}
		.how-it-works-section:before{
			content: "";
			width: 68%;
			background: #eaeaea;
			height: 2px;
			display: block;
			position: absolute;
			top: 55px;
			left: 14.5%;
		}
		@media (min-width: 992px) {
			.how-it-works-section .each-value-prop{
				flex-direction: column;
				margin-bottom: 0;
				width: 3333.33333%;
			}
			.how-it-works-section i{
				width: 60px;
				height: 60px;
				font-size: 32px;

			}
			.how-it-works-section .each-value-prop p	{
				margin-top: 24px;
			}
		}
		.how-it-works-section .each-value-prop{
			display: flex;
			align-items: center;
			margin-bottom: 38px;
			position: relative;
		}
		.how-it-works-section i{
			color: #787887;
			width: 75px;
			height: 75px;
			font-size: 30px;
			background: #f0eff4;
			border-radius: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
			border: 1px solid rgba(52, 58, 64, 0.4);
		}
		.how-it-works-section .each-value-prop p{
			font-size: 14px;
			padding-left: 12px;
			color: #757575
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
			<section class="section">
				<div class="container-fluid">
					<div class="home-slider">
						<div>
							<img src="<?= base_url() ?>assets/img/slider/slide1.png" class="img-fluid" alt="">
						</div>
						<div>
							<img src="<?= base_url() ?>assets/img/slider/slide2.png" class="img-fluid" alt="">
						</div>
						<div>
							<img src="<?= base_url() ?>assets/img/slider/slide3.png" class="img-fluid" alt="">
						</div>
						<div>
							<img src="<?= base_url() ?>assets/img/slider/slide4.png" class="img-fluid" alt="">
						</div>
					</div>
				</div>
			</section>
			<!-- /Home Banner -->

			<!-- Clinic and Specialities -->
			<section class="section section-specialities">
				<div class="container-fluid">
					<div class="section-header text-center mb-3">
						<h2>Medicines</h2>
						<p class="sub-title">India’s Leading Online Pharmacy & Healthcare Platform</p>
					</div>
					<div class="row justify-content-center ratio_square tools-grey light-layout ">
						<div class="col-md-10">
							<!-- Slider -->
							<div class="product-5 product-m no-arrow" id="medicine">
								<?= $medicine?>
							</div>
							<!-- /Slider -->

						</div>
					</div>
				</div>
			</section>

			<!-- Clinic and Specialities -->
			<section class="section section-specialities">
				<div class="container-fluid">
					<div class="section-header text-center mb-3">
						<h2>Features</h2>
					</div>
					<div class="row justify-content-center ratio_square tools-grey light-layout ">
						<div class="col-md-10">
							<div class="row">
								<div class="col-md-6">
									<p style="color: #757575;font-size: 16px;max-width: 600px;margin: 15px auto 10px;">Don’t self medicate. Talk to an expert. Consult a doctor in less than 2 minutes.</p>
								</div>
								<div class="col-md-6">
									<p style="color: #757575;font-size: 16px;max-width: 600px;margin: 15px auto 10px;">Tired of waiting in a queue? Too weak to go down and buy medicines?</p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div>
										<?php
										if (!isset($_SESSION['userType'])||$_SESSION['userType']==3)
										{
											echo '<a href="'. base_url() .'appointment" >';
										}
										?>
										<img src="<?= base_url() ?>assets/img/home1.png" class="img-fluid" alt="" style="box-shadow: 0 5px 14px rgba(0, 0, 0, 0.41)">
										<?php
										if (!isset($_SESSION['userType'])||$_SESSION['userType']==3)
										{
											echo '</a>';
										}
										?>
									</div>
								</div>
								<div class="col-md-6">
									<div>
										<img src="<?= base_url() ?>assets/img/home2.png" class="img-fluid" alt="" style="box-shadow: 0 5px 14px rgba(0, 0, 0, 0.41)">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Clinic and Specialities -->

			<!-- Popular Section -->
			<section class="section section-doctor" style="padding: 50px 0">
				<div class="container-fluid">
					<div class="section-header text-center mb-3">
						<h2>Doctors</h2>
						<p class="sub-title">Visits can last as long as an hour, and you can see or speak to your doctor as often as you need.</p>
					</div>
				   <div class="row justify-content-center ">
						<div class="col-lg-11">
							<div class="doctor-slider slider">

								<?php
								foreach ($doctor as $doc)
								{
									?>

									<!-- Doctor Widget -->
									<div class="profile-widget">
										<div class="doc-img">
											<a href="<?= base_url()?>doctor/view-profile/<?= $doc['docId']?>">
												<img class="img-fluid" alt="User Image" src="<?= base_url() ?>profile/<?= $doc['profileImg']?>">
											</a>
										</div>
										<div class="pro-content">
											<h3 class="title">
												<a href="<?= base_url()?>doctor/view-profile/<?= $doc['docId']?>"><?= $doc['username']?></a>
												<!--											<i class="fas fa-check-circle verified"></i>-->
											</h3>
											<p class="speciality"><?= $doc['specialization']?></p>
											<div class="rating">
												<?php
												for ($i=1;$i<=5;$i++){
													if ($i <= $doc['rating']){
														echo "<i class='fas fa-star filled'></i>";
													} else {
														echo "<i class='fas fa-star'></i>";
													}
												}
												?>
												<span class="d-inline-block average-rating">(<?= $doc['cnt']?>)</span>
											</div>
											<ul class="available-info">
												<li>
													<i class="fas fa-map-marker-alt"></i> <?= $doc['cityName']?>, <?= $doc['stateName']?>
												</li>
											</ul>
											<div class="row row-sm">
												<div class="col-6">
													<a href="<?= base_url()?>doctor/view-profile/<?= $doc['docId']?>" class="btn view-btn">View Profile</a>
												</div>
												<div class="col-6">
													<a href="<?= base_url()?>appointment" class="btn book-btn">Book Now</a>
												</div>
											</div>
										</div>
									</div>
									<!-- /Doctor Widget -->
									<?php
								}
								?>
							</div>
						</div>
				   </div>
				</div>
			</section>
			<!-- /Popular Section -->

		   <!-- Availabe Features -->
		   <section class="section section-features">
				<div class="container-fluid">
				   <div class="row justify-content-center ">
						<div class="col-md-9">
							<div class="section-header">
								<h2 class="mt-2 text-center">How it Works</h2>
							</div>
							<div class="how-it-works-section">
								<div class="each-value-prop"><i class="far fa-comments"></i>
									<p>Talk to a doctor online</p></div>
								<div class="each-value-prop"><i class="fas fa-bolt"></i>
									<p>Get medicines delivered to you</p></div>
								<div class="each-value-prop"><i class="far fa-smile"></i>
									<p>Follow up with the doctor for free</p></div>
							</div>
						</div>
				   </div>
				</div>
			</section>
		   <section class="section section-features">
				<div class="container-fluid">
				   <div class="row justify-content-center ">
						<div class="col-md-7">
							<div class="section-header">
								<h2 class="mt-2 text-center">What our Users say</h2>
							</div>
							<div class="quote-slider slider">
								<!-- Slider Item -->
								<div class="feature-item text-center">
									<p>"Beautiful application with elegant UI Design. I found this app very useful. Placed Order for a few medicines and recieved in just two days. Same medicine costs me +100 from local Shop. Recommended application. :-)."</p>
								</div>
								<!-- /Slider Item -->

								<!-- Slider Item -->
								<div class="feature-item text-center">
									<p>"Very useful app. It saves time and money and genuine. Keep going Practo. Thank you."</p>
								</div>
								<!-- /Slider Item -->

								<!-- Slider Item -->
								<div class="feature-item text-center">
									<p>"Most useful and saving more money on medicine."</p>
								</div>
								<!-- /Slider Item -->

								<!-- Slider Item -->
								<div class="feature-item text-center">
									<p>"Nice app for people who want to manage time for searching medicine."</p>
								</div>
								<!-- /Slider Item -->

								<!-- Slider Item -->
								<div class="feature-item text-center">
									<p>"I ordered medicine. It was delivered right time. With big discount."</p>
								</div>
								<!-- /Slider Item -->

							</div>
						</div>
				   </div>
				</div>
			</section>
			<!-- Availabe Features -->

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
		<script src="<?= base_url() ?>assets/js/script.js?version=5"></script>

		<script>

			$('.home-slider').slick({
				dots: true,
				infinite: true,
				speed: 1000,
				fade: true,
				autoplay: true,
				autoplaySpeed: 3000,
				cssEase: 'linear'
			});
			$('#medicine').slick({
				dots: true,
				infinite: true,
				slidesToShow: 4,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 2000,
			});
			$('.quote-slider').slick({
				dots: true,
				infinite: true,
				autoplay: true,
				autoplaySpeed: 3000,
				prevArrow: false,
				nextArrow: false
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
						url: '<?= base_url()?>shop/addToCart' ,
						method: 'post' ,
						data: {
							id: id ,
							qty: qty
						} ,
						success: function (data) {
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
