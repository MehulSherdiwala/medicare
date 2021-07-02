<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
	<div class="profile-sidebar">
		<div class="widget-profile pro-widget-content">
			<div class="profile-info-widget">
				<a href="#" class="booking-doc-img">
					<img src="<?= base_url()?>profile/<?= (($_SESSION['profileImg'] == '')? 'profile.png' : $_SESSION['profileImg'])?>" alt="User Image">
				</a>
				<div class="profile-det-info">
					<h3><?= $_SESSION['username'] ?></h3>
				</div>
			</div>
		</div>
		<div class="dashboard-widget">
			<nav class="dashboard-menu">
				<ul>
					<li>
						<a href="<?= base_url()?>appointment/view">
							<i class="fas fa-medkit"></i>
							<span>Appointments</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url()?>checkup/record">
							<i class="fas fa-file-contract"></i>
							<span>Medical Records</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url()?>shop/orderList">
							<i class="far fa-envelope"></i>
							<span>My Order</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url()?>chat/chatList">
							<i class="fas fa-comments"></i>
							<span>Instant Cure</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url()?>patient-profile-setting">
							<i class="fas fa-user-cog"></i>
							<span>Profile Settings</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url()?>login/logout">
							<i class="fas fa-sign-out-alt"></i>
							<span>Logout</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>

	</div>
</div>
