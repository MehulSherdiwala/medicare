<div class="instant-cure d-none">
	<a href="">
		<div class="ic-icon">
			<i class="fas fa-headset fa-2x"></i>
		</div>
	</a>
</div>
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
				<li>
					<a href="<?= base_url()?>disease">Disease</a>
				</li>
				<li>
					<a href="<?= base_url()?>doctors">Doctor</a>
				</li>
				<li class="login-link">
					<a href="login">Login / Signup</a>
				</li>
			</ul>
		</div>
		<ul class="nav header-navbar-rht">

			<?php
				if (!isset($_SESSION['userType'])||$_SESSION['userType']==3)
				{
					?>
					<li class="nav-item contact-item">
						<div class="header-contact-img">
							<a href="<?= base_url() ?>appointment" class="btn btn-outline-danger">
								Book Appointment
							</a>
						</div>
					</li>
					<li class="nav-item contact-item">
						<div class="header-contact-img">
							<a href="<?= base_url() ?>shop/cart">
								<img src="<?= base_url() ?>assets/img/new-cart.png" alt="" width="30px">
								<span
									class="badge badge-danger badge-sm count"><?= ( ! isset($countCart) || $countCart == 0) ? '' : $countCart ?></span>
							</a>
						</div>
					</li>
					<?php
				}
			?>
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
						$dashboard = 'appointment/view';
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
									<img src="<?= base_url()?>profile/<?= (($_SESSION['profileImg'] == '')? 'profile.png' : $_SESSION['profileImg'])?>" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6><?= $_SESSION['username']?></h6>
									<p class="text-muted mb-0"><?= ($_SESSION['userType']=='1')? "Doctors" : (($_SESSION['userType']=='2')? "Pharmacist" : "Patient") ?></p>
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

<?php
if (!isset($_SESSION['userType'])||$_SESSION['userType']==3)
{
	?>
	<script>
		async function countCart() {
			const response = await fetch('<?= base_url()?>Shop/countCart');
			const myJson = await response.json();
			$(".count").text((myJson == 0) ? '' : myJson);
		}

		countCart();
		setInterval(function () {
			countCart()
		} , 3000);
	</script>
	<?php
}?>
