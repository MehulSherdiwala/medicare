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
							<p>We’re committed to delivering outstanding healthcare for better standards, better care, better outcomes. Physicians, Pharmacist and we are working together to help you live better.</p>
						</div>
					</div>
					<!-- /Footer Widget -->

				</div>

				<?php
					if (isset($_SESSION['userType'])){
						if ($_SESSION['userType']==3){
							$profile = 'patient-profile-setting';
						} elseif ($_SESSION['userType']==1){
							$profile = 'doctor/doctor-profile-setting';
						} elseif ($_SESSION['userType']==2){
							$profile = 'pharmacist/pharmacist-profile-setting';
						}
					} else{
						$profile = '';
					}
				?>
				<div class="col-lg-3 col-md-6 mt-4">

					<!-- Footer Widget -->
					<div class="footer-widget footer-menu">
						<ul>
							<li><a href="<?= base_url()?>login"><i class="fas fa-angle-double-right"></i> Login</a></li>
							<li><a href="<?= base_url()?>Register"><i class="fas fa-angle-double-right"></i> Register</a></li>
							<li><a href="<?= base_url()?>appointment"><i class="fas fa-angle-double-right"></i> Book Appointment</a></li>
							<li><a href="<?= base_url(). $profile?>"><i class="fas fa-angle-double-right"></i> Profile</a></li>
						</ul>
					</div>
					<!-- /Footer Widget -->

				</div>

				<div class="col-lg-3 col-md-6 mt-4">

					<!-- Footer Widget -->
					<div class="footer-widget footer-menu">
						<ul>
							<li><a href="<?= base_url()?>disease"><i class="fas fa-angle-double-right"></i> Search Disease</a></li>
							<li><a href="<?= base_url()?>medicine"><i class="fas fa-angle-double-right"></i> Search Medicine</a></li>
							<li><a href="<?= base_url()?>doctor"><i class="fas fa-angle-double-right"></i> Search Doctor</a></li>
							<li><a href="<?= base_url()?>shop/orderList"><i class="fas fa-angle-double-right"></i> Orders</a></li>
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
								<p> Udhana, Surat, Gujarat, <br> India 394210 </p>
							</div>
							<p>
								<i class="fas fa-phone-alt"></i>
								+91 981 989 5943
							</p>
							<p class="mb-0">
								<i class="fas fa-envelope"></i>
								info@medicare.sparkingstars.club
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
							<p class="mb-0">&copy; 2020 Medicare. All rights reserved.</p>
						</div>
					</div>
					<div class="col-md-6 col-lg-6">

						<!-- Copyright Menu -->
						<div class="copyright-menu">
							<ul class="policy-menu">
								<li><a href="javascript:void(0)">Terms and Conditions</a></li>
								<li><a href="javascript:void(0)">Policy</a></li>
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
