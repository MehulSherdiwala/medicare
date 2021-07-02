
<header class="header">
	<nav class="navbar navbar-expand-lg header-nav">
		<div class="navbar-header">
			<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
			</a>
			<a href="<?= base_url()?>" class="navbar-brand logo">
				<img src="<?= base_url() ?>assets/img/MediCareLogo.png" class="img-fluid" alt="Logo">
			</a>
		</div>
		<div class="main-menu-wrapper">
			<div class="menu-header">
				<a href="<?= base_url()?>" class="menu-logo">
					<img src="<?= base_url() ?>assets/img/MediCareLogo.png" class="img-fluid" alt="Logo">
				</a>
				<a id="menu_close" class="menu-close" href="javascript:void(0);">
					<i class="fas fa-times"></i>
				</a>
			</div>
			<ul class="main-nav">
				<li>
					<a href="<?= base_url()?>">Home</a>
				</li>
				<li>
					<a href="<?= base_url()?>medicine">Medicine</a>
				</li>
<!--				<li class="has-submenu">-->
<!--					<a href="#">Doctors <i class="fas fa-chevron-down"></i></a>-->
<!--					<ul class="submenu">-->
<!--						<li><a href="doctor-dashboard.html">Doctor Dashboard</a></li>-->
<!--						<li><a href="appointments.html">Appointments</a></li>-->
<!--						<li><a href="schedule-timings.html">Schedule Timing</a></li>-->
<!--						<li><a href="my-patients.html">Patients List</a></li>-->
<!--						<li><a href="patient-profile.html">Patients Profile</a></li>-->
<!--						<li><a href="chat-doctor.html">Chat</a></li>-->
<!--						<li><a href="invoices.html">Invoices</a></li>-->
<!--						<li><a href="doctor-profile-settings.html">Profile Settings</a></li>-->
<!--						<li><a href="reviews.html">Reviews</a></li>-->
<!--						<li><a href="doctor-register.html">Doctor Register</a></li>-->
<!--					</ul>-->
<!--				</li>-->
<!--				<li class="has-submenu">-->
<!--					<a href="#">Patients <i class="fas fa-chevron-down"></i></a>-->
<!--					<ul class="submenu">-->
<!--						<li><a href="search.html">Search Doctor</a></li>-->
<!--						<li><a href="doctor-profile.html">Doctor Profile</a></li>-->
<!--						<li><a href="booking.html">Booking</a></li>-->
<!--						<li><a href="checkout.html">Checkout</a></li>-->
<!--						<li><a href="booking-success.html">Booking Success</a></li>-->
<!--						<li><a href="patient-dashboard.html">Patient Dashboard</a></li>-->
<!--						<li><a href="favourites.html">Favourites</a></li>-->
<!--						<li><a href="chat.html">Chat</a></li>-->
<!--						<li><a href="profile-settings.html">Profile Settings</a></li>-->
<!--						<li><a href="change-password.html">Change Password</a></li>-->
<!--					</ul>-->
<!--				</li>-->
<!--				<li class="has-submenu">
					<a href="#">Pages <i class="fas fa-chevron-down"></i></a>
					<ul class="submenu">
						<li><a href="voice-call.html">Voice Call</a></li>
						<li><a href="video-call.html">Video Call</a></li>
						<li><a href="search.html">Search Doctors</a></li>
						<li><a href="calendar.html">Calendar</a></li>
						<li><a href="components.html">Components</a></li>
						<li class="has-submenu">
							<a href="invoices.html">Invoices</a>
							<ul class="submenu">
								<li><a href="invoices.html">Invoices</a></li>
								<li><a href="invoice-view.html">Invoice View</a></li>
							</ul>
						</li>
						<li><a href="blank-page.html">Starter Page</a></li>
						<li><a href="login.php">Login</a></li>
						<li><a href="register.php">Register</a></li>
						<li><a href="forgot-password.html">Forgot Password</a></li>
					</ul>
				</li>
				<li class="has-submenu">
					<a href="#">Blog <i class="fas fa-chevron-down"></i></a>
					<ul class="submenu">
						<li><a href="blog-list.html">Blog List</a></li>
						<li><a href="blog-grid.html">Blog Grid</a></li>
						<li><a href="blog-details.html">Blog Details</a></li>
					</ul>
				</li>
				<li>
					<a href="admin/index.php" target="_blank">Admin</a>
				</li>-->
				<li class="login-link">
					<a href="login">Login / Signup</a>
				</li>
			</ul>
		</div>
		<ul class="nav header-navbar-rht">

			<?php
				if (!isset($_SESSION['uId']))
				{
					?>
					<li class="nav-item">
						<a class="nav-link header-login" href="<?= base_url() ?>login">login / Signup </a>
					</li>
					<?php
				} else {

					if ($_SESSION['userType'] == '2')
					{
						$profileUrl = 'pharmacist/pharmacist-profile-setting';
						$dashboard = 'pharmacist';
						$wallet = 'pharmacist/wallet';
					} elseif ($_SESSION['userType'] == '1')
					{
						$profileUrl = 'doctor/doctor-profile-setting';
						$dashboard = 'doctor';
						$wallet = 'doctor/wallet';
					} else
					{
						$profileUrl = 'patient-profile-setting';
						$dashboard = 'dashboard';
						$wallet = 'wallet';
					}

					?>

					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow logged-item">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img">
								<img class="rounded-circle" src="<?= base_url()?>profile/<?= (($_SESSION['profileImg'] == '')? 'profile.png' : $_SESSION['profileImg'])?>" width="31" alt="Darren Elder">
							</span>
							<?php
								if ($_SESSION['profile'] == 1)
								{
									?>
									<span class="circle-alert"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<?php
								}
							?>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="<?= base_url()?>assets/img/doctors/doctor-thumb-02.jpg" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6><?= $_SESSION['username']?></h6>
									<p class="text-muted mb-0"><?= ($_SESSION['userType']=='1')? "Doctor" : (($_SESSION['userType']=='2')? "Pharmacist" : "Patient") ?></p>
								</div>
							</div>
							<a class="dropdown-item" href="<?= base_url().$wallet ?>">Wallet</a>
							<a class="dropdown-item" href="<?= base_url().$dashboard ?>">Dashboard</a>

							<a class="dropdown-item" href="<?= base_url().$profileUrl ?>">Profile Settings
								<?php
								if ($_SESSION['profile'] == 1)
								{
									?>
									<span class="circle-alert"><i class="fa fa-circle" aria-hidden="true"></i></span>
									<?php
								}
								?>
							</a>
							<a class="dropdown-item" href="<?= base_url() ?>login/Logout">Logout</a>
						</div>
					</li>
					<!-- /User Menu -->
					<?php
				}
			?>
		</ul>
	</nav>
</header>
<script>
	async function countCart() {
		const response = await fetch('<?= base_url()?>Shop/countCart');
		const myJson = await response.json();
		$(".count").text((myJson == 0)? '' : myJson);
	}
	countCart();
	setInterval(function(){
		countCart()
	},3000);
</script>
