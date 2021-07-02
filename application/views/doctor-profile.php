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

	<!-- Fancybox CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/plugins/fancybox/jquery.fancybox.min.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css">

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
		include ("header.php");
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
							<li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Doctor Profile</h2>
				</div>
			</div>
		</div>
	</div>
	<!-- /Breadcrumb -->

	<!-- Page Content -->
	<div class="content">
		<div class="container">

			<!-- Doctor Widget -->
			<div class="card">
				<div class="card-body">
					<div class="doctor-widget">
						<div class="doc-info-left">
							<div class="doctor-img">
								<img src="<?= base_url()?>profile/<?= (($docData['profileImg'] == '')? 'profile.png' : $docData['profileImg'])?>" class="img-fluid" alt="User Image">
							</div>
							<div class="doc-info-cont">
								<h4 class="doc-name"><?= $docData['username']?></h4>
								<p class="doc-speciality"><?= $docData['specialization']?></p>
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
								<div class="clinic-details">
									<p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?= $stateCity['cityName']?>, <?= $stateCity['stateName']?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Doctor Widget -->

			<!-- Doctor Details Tab -->
			<div class="card">
				<div class="card-body pt-0">

					<!-- Tab Menu -->
					<nav class="user-tabs mb-4">
						<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
							<li class="nav-item">
								<a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#doc_reviews" data-toggle="tab">Reviews</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#doc_business_hours" data-toggle="tab">Business Hours</a>
							</li>
						</ul>
					</nav>
					<!-- /Tab Menu -->

					<!-- Tab Content -->
					<div class="tab-content pt-0">

						<!-- Overview Content -->
						<div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
							<div class="row">
								<div class="col-md-12 col-lg-12">

									<?php
										if (isset($clinicData) && $clinicData!='')
										{
											?>
											<!-- About Details -->
											<div class="widget about-widget">
												<h3 class="widget-title">Clinic</h3>
												<div class="doc-info-cont ml-3">
													<h4 class="doc-name"><?= $clinicData->clinicName?></h4>
													<p class="doc-speciality"><?= $clinicData->clinicDescription?></p>
													<div class="clinic-details">
														<p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?= $clinicData->clinicAddress?></p>
													</div>
												</div>
											</div>
											<hr>
											<?php
										}
									?>
									<!-- /About Details -->
									<!-- About Details -->
									<div class="widget about-widget">
										<h4 class="widget-title">About Me</h4>
										<p class="ml-3"><?= $docData['description']?></p>
									</div>
									<!-- /About Details -->
									<hr>
									<!-- About Details -->
									<div class="widget about-widget">
										<h4 class="widget-title">Doctor Address</h4>
										<p class="ml-3"><i class="fas fa-map-marker-alt"></i> <?= $docData['address']?></p>
									</div>
									<!-- /About Details -->
									<hr>
									<!-- Specializations List -->
									<div class="service-list">
										<h4>Specializations</h4>
										<ul class="clearfix ml-3">
											<?php
												$spec = explode(',',$docData['specialization']);

												foreach ($spec as $item)
												{
													?>
													<li><?= $item?></li>
													<?php
												}
											?>
										</ul>
									</div>
									<!-- /Specializations List -->

								</div>
							</div>
						</div>
						<!-- /Overview Content -->


						<!-- Reviews Content -->
						<div role="tabpanel" id="doc_reviews" class="tab-pane fade">

							<!-- Review Listing -->
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

								<!-- Show All -->
								<div class="all-feedback text-center">
									<a href="#" class="btn btn-primary btn-sm">
										Show all feedback <strong>(<?= $rating['count']?>)</strong>
									</a>
								</div>
								<!-- /Show All -->

							</div>
							<!-- /Review Listing -->

							<?php
								if ($review == 1)
								{
									?>
									<!-- Write Review -->
									<div class="write-review">
										<h4>Write a review for <strong><?= $docData['username']?></strong></h4>

										<!-- Write Review Form -->
										<form action="<?= base_url()?>viewProfile/doctorReview" method="post">
											<input type="hidden" name="docId" value="<?= $docData['docId']?>">
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
						<!-- /Reviews Content -->

						<!-- Business Hours Content -->
						<div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
							<div class="row">
								<div class="col-md-6 offset-md-3">

									<!-- Business Hours Widget -->
									<div class="widget business-widget">
										<div class="widget-content">
											<?php
												if ($docData['dptId'] == 2){
													?>
														<h4 class="text-center">Instant Cure Doctor</h4>
													<?php
												}
											?>
											<div class="listing-hours">
												<?php
												if (isset($schedule))
												{
													foreach ($schedule as $item)
													{
														?>
														<div class="listing-day">
															<div class="day my-auto"><?= $item['day'] ?></div>
															<div class="time-items">
																<span class="time"><?= $item['time'] ?></span>
															</div>
														</div>
														<?php

													}
												}
												?>
											</div>
										</div>
									</div>
									<!-- /Business Hours Widget -->

								</div>
							</div>
						</div>
						<!-- /Business Hours Content -->

					</div>
				</div>
			</div>
			<!-- /Doctor Details Tab -->

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

<!-- Fancybox JS -->
<script src="<?= base_url()?>assets/plugins/fancybox/jquery.fancybox.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url()?>assets/js/script.js"></script>

<script>
	$(document).ready(function () {
		$("#url").val(window.location.href);
	});
</script>
</body>
</html>
