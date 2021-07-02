<?php
$dpt = $_SESSION['dptId'];
?>
<div class="app-navbar horizontal" id="navbar1">
	<div class="navbar-wrap">
		<button class="no-style navbar-toggle navbar-open d-lg-none"><span></span><span></span><span></span>
		</button>
		<form class="app-search d-none d-md-block">
			<div class="form-group typeahead__container with-suffix-icon mb-0">
				<div class="typeahead__field">
					<div class="typeahead__query"><input autocomplete="off"
														 class="form-control autocomplete-control topbar-search"
														 data-source="<?= base_url() ?>assets/data/search-menu.json"
														 placeholder="Type page's title"
														 type="search">
						<div class="suffix-icon icofont-search"></div>
					</div>
				</div>
			</div>
		</form>
		<div class="app-actions">
			<div class="dropdown item">
				<button aria-expanded="false" aria-haspopup="true" class="no-style dropdown-toggle noti-cart"
						data-offset="0, 12" data-toggle="dropdown" type="button"><span
						class="icon icofont-notification"></span>
					<span class="badge badge-danger badge-sm count"></span>
				</button>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-w-280">
					<div class="menu-header"><h4 class="h5 menu-title mt-0 mb-0">Notifications</h4>
					</div>
					<ul class="list" id="noti">

					</ul>
				</div>
			</div>
			<div class="dropdown item">
				<button aria-expanded="false" aria-haspopup="true" class="no-style dropdown-toggle"
						data-offset="0, 10" data-toggle="dropdown" type="button"><span
						class="d-flex align-items-center"><img alt="" class="rounded-500 mr-1"
															   height="40"
															   src="<?= base_url() ?>profile/<?= (($_SESSION['profileImg'] == '')? 'profile.png' : $_SESSION['profileImg'])?>"
															   width="40"> <i
							class="icofont-simple-down"></i></span></button>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-w-180">
					<ul class="list">
						<li><a class="align-items-center" href="<?= base_url() ?>">
								<span class="icon icofont-ui-home"></span> Home</a></li>
						<li><a class="align-items-center" href="<?= base_url() ?>doctor/wallet">
								<span class="icon icofont-wallet"></span> Wallet</a></li>
						<li><a class="align-items-center" href="<?= base_url() ?>doctor/doctor-profile-setting">
								<span class="icon icofont-ui-user"></span> User profile</a></li>
						<li><a class="align-items-center" href="<?= base_url() ?>/login/Logout">
								<span class="icon icofont-logout"></span> Log Out</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="navbar-skeleton horizontal">
			<div class="left-part d-flex align-items-center"><span
					class="navbar-button bg animated-bg d-lg-none"></span> <span
					class="sk-logo bg animated-bg d-none d-lg-block"></span> <span
					class="search d-none d-md-block bg animated-bg"></span></div>
			<div class="right-part d-flex align-items-center">
				<div class="icon-box"><span class="icon bg animated-bg"></span> <span class="badge"></span>
				</div>
				<span class="avatar bg animated-bg"></span></div>
		</div>
	</div>
</div>
<div class="app-navbar vertical" id="navbar2">
	<div class="navbar-wrap">
		<button class="no-style navbar-toggle navbar-close icofont-close-line d-lg-none"></button>
		<div class="app-logo">
			<div class="logo-wrap"><img alt="" class="logo-img" height="33" src="<?= base_url() ?>assets/img/MediCareLogo.png"
										width="147"></div>
		</div>
		<div class="main-menu">
			<nav class="main-menu-wrap">
				<ul class="menu-ul">
					<li class="menu-item"><span class="group-title">Medicine</span></li>
					<li class="menu-item"><a class="item-link" href="<?= base_url() ?>doctor"><span
								class="link-icon icofont-thermometer-alt"></span> <span
								class="link-text">Dashboard</span></a></li>
					<li class="menu-item">
						<a class="item-link" href="<?= base_url() ?>doctor/patient">
							<span class="link-icon icofont-wheelchair"></span>
							<span class="link-text">Patient</span>
						</a>
					</li>
					<?php
					if	($dpt != 2)
					{
						?>
						<li class="menu-item">
							<a class="item-link" href="<?= base_url() ?>doctor/appointment">
								<span class="link-icon icofont-first-aid-alt"></span>
								<span class="link-text">Appointments</span>
							</a>
						</li>
						<li class="menu-item">
							<a class="item-link" href="<?= base_url() ?>doctor/checkup">
								<span class="link-icon icofont-stethoscope-alt"></span>
								<span class="link-text">Checkup Patient</span>
							</a>
						</li>
						<li class="menu-item">
							<a class="item-link" href="<?= base_url() ?>doctor/schedule">
								<span class="link-icon far fa-calendar-plus"></span>
								<span class="link-text">Schedule</span>
							</a>
						</li>
						<li class="menu-item">
							<a class="item-link" href="<?= base_url() ?>doctor/Pharmacist">
								<span class="link-icon icofont icofont-user-alt-2"></span>
								<span class="link-text">Pharmacist</span>
							</a>
						</li>
						<?php
					} else
					{
						?>
						<li class="menu-item">
							<a class="item-link" href="<?= base_url() ?>doctor/instantCure">
								<span class="link-icon icofont-stethoscope-alt"></span>
								<span class="link-text">Instant cure</span>
							</a>
						</li>
						<?php
					}
					?>
				</ul>
			</nav>
		</div>
		<div class="navbar-skeleton vertical">
			<div class="top-part">
				<div class="sk-logo bg animated-bg"></div>
				<div class="sk-menu"><span class="sk-menu-item menu-header bg-1 animated-bg"></span> <span
						class="sk-menu-item bg animated-bg w-75"></span> <span
						class="sk-menu-item bg animated-bg w-80"></span> <span
						class="sk-menu-item bg animated-bg w-50"></span> <span
						class="sk-menu-item bg animated-bg w-75"></span> <span
						class="sk-menu-item bg animated-bg w-50"></span> <span
						class="sk-menu-item bg animated-bg w-60"></span></div>
				<div class="sk-menu"><span class="sk-menu-item menu-header bg-1 animated-bg"></span> <span
						class="sk-menu-item bg animated-bg w-60"></span> <span
						class="sk-menu-item bg animated-bg w-40"></span> <span
						class="sk-menu-item bg animated-bg w-60"></span> <span
						class="sk-menu-item bg animated-bg w-40"></span> <span
						class="sk-menu-item bg animated-bg w-40"></span> <span
						class="sk-menu-item bg animated-bg w-40"></span> <span
						class="sk-menu-item bg animated-bg w-40"></span></div>
				<div class="sk-menu"><span class="sk-menu-item menu-header bg-1 animated-bg"></span> <span
						class="sk-menu-item bg animated-bg w-60"></span> <span
						class="sk-menu-item bg animated-bg w-50"></span></div>
				<div class="sk-button animated-bg w-90"></div>
			</div>
			<div class="bottom-part">
				<div class="sk-menu"><span class="sk-menu-item bg-1 animated-bg w-60"></span> <span
						class="sk-menu-item bg-1 animated-bg w-80"></span></div>
			</div>
			<div class="horizontal-menu"><span class="sk-menu-item bg animated-bg"></span> <span
					class="sk-menu-item bg animated-bg"></span> <span
					class="sk-menu-item bg animated-bg"></span> <span
					class="sk-menu-item bg animated-bg"></span> <span
					class="sk-menu-item bg animated-bg"></span> <span
					class="sk-menu-item bg animated-bg"></span></div>
		</div>
	</div>
</div>
