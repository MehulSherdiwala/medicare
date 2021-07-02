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

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css">

	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/css/bootstrap-datepicker.min.css">
	<!-- Main CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css?version=15">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="<?= base_url() ?>assets/js/html5shiv.min.js"></script>
		<script src="<?= base_url() ?>assets/js/respond.min.js"></script>
	<![endif]-->

	<style>
		.chat-users-list{
			height: calc(100vh - 160px);
		}
	</style>

</head>
<body class="chat-page">
<div hidden id="spinner"></div>

<!-- Main Wrapper -->
<div class="main-wrapper">

	<!-- Header -->
	<?php
	include("header.php");
	?>
	<!-- /Header -->

	<!-- Page Content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="chat-window">

						<!-- Chat Left -->
						<div class="chat-cont-left">
							<div class="chat-header">
								<span>Appointment List</span>
							</div>
							<div class="chat-users-list">
								<div class="chat-scroll" id="queue">
									<a href="javascript:void(0);" class="media active">
										<div class="media-img-wrap">
											<div class="avatar">
												<img src="<?= base_url()?>assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" class="avatar-img rounded-circle">
											</div>
										</div>
										<div class="media-body">
											<div>
												<div class="user-name">Dr. Ruby Perrin</div>
												<div class="user-last-chat">11:20 AM</div>
											</div>
											<div>
												<div class="last-chat-time block"></div>
											</div>
										</div>

									</a>
								</div>
							</div>
						</div>
						<!-- /Chat Left -->

						<!-- Chat Right -->
						<div class="chat-cont-right">
							<input type="hidden" name="appId" id="appId" value="1">
							<div class="chat-header">
								<a id="back_user_list" href="javascript:void(0)" class="back-user-list">
									<i class="material-icons">chevron_left</i>
								</a>
								<div class="media">
									<div class="media-img-wrap">
										<div class="avatar">
											<img src="<?= base_url()?>profile/profile.png" alt="User Image" class="avatar-img rounded-circle" id="profile">
										</div>
									</div>
									<div class="media-body">
										<div class="user-name" id="username"></div>
									</div>
								</div>
							</div>
							<div class="chat-body">
								<div class="chat-scroll">
									<ul class="list-unstyled position-relative" id="msg">

									</ul>
								</div>
							</div>
							<div class="chat-footer" style="height: 67px">
							</div>
						</div>
						<!-- /Chat Right -->

					</div>
				</div>
			</div>
			<!-- /Row -->

		</div>

	</div>
	<!-- /Page Content -->
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/js/jquery.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?= base_url() ?>assets/js/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- Select2 JS -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>

<script src="<?= base_url() ?>assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>

<!-- parsley JS -->
<script src="<?= base_url() ?>assets/plugins/parsley/js/parsley.min.js"></script>

<!-- Slick JS -->
<!--<script src="--><?//= base_url() ?><!--assets/js/slick.js"></script>-->

<!-- Custom JS -->
<script src="<?= base_url() ?>assets/js/script.js"></script>

<script>

	chatList();
	async function chatList() {
		const res = await fetch('<?= base_url()?>chat/list');
		const data = await res.json();

		let html = '';
		for (let i = 0; i < data.length; i++) {
			html += '<a href="javascript:void(0);" class="media" data-appid="'+ data[i].icappId +'">\n' +
				'<div class="media-img-wrap">\n' +
				'<div class="avatar">\n' +
				'<img src="<?= base_url()?>profile/' + ((data[i].profileImg=='')?'profile.png':data[i].profileImg) + '" alt="User Image" class="avatar-img rounded-circle">\n' +
				'</div>\n' +
				'</div>\n' +
				'<div class="media-body">\n' +
				'<div>\n' +
				'<div class="user-name">'+ data[i].username +'</div>\n' +
				'<div class="user-last-chat">'+ data[i].datetime +'</div>\n' +
				'</div>\n' +
				'<div>\n' +
				'<div class="last-chat-time block"></div>\n' +
				'</div>\n' +
				'</div>\n' +
				'\n' +
				'</a>';
		}

		$("#queue").html(html);

		$(".media").on('click', function () {
			let appId = $(this).data('appid');
			$("#username").text($(this).find('.user-name').text());
			$("#profile").attr('src',$(this).find('.avatar-img').attr('src'));
			getChat(appId);
		});
	}

	// getChat();
	async function getChat(appId) {
		const res = await fetch('<?= base_url()?>chat/get_chat/' + appId);
		const data = await res.json();

		let html = '';
		for (let i = 0; i < data.length; i++) {
			html += getHtml(data[i]);
		}

		$("#msg").html(html);
		$(".chat-scroll").animate({scrollTop: $('#msg').prop("scrollHeight")} , 0);

	}

	function getHtml(data){
		let html = '';
		if (data.sender == 0){
			if ("msg" in data){
				html +=
					'<li class="media sent">' +
					'<div class="media-body">' +
					'<div class="msg-box">' +
					'<div>' +
					'<p>' + data.msg + '</p>' +
					'<ul class="chat-msg-info">' +
					'<li>' +
					'<div class="chat-time">' +
					'<span>' + data.timestamp + '</span>' +
					'</div>' +
					'</li>' +
					'</ul>' +
					'</div>' +
					'</div>' +
					'</div>' +
					'</li>';
			} else {
				if (data.ext == 1){
					html +=
						'<li class="media sent">' +
						'<div class="media-body">' +
						'<div class="msg-box">' +
						'<div>' +
						'<p><a href="<?= base_url()?>chat-attach/' + data.src + '" class="mr-2" target="_blank">' + data.src + ' </a><i class="fas fa-external-link-alt"></i></p>' +
						'<ul class="chat-msg-info">' +
						'<li>' +
						'<div class="chat-time">' +
						'<span>' + data.timestamp + '</span>' +
						'</div>' +
						'</li>' +
						'</ul>' +
						'</div>' +
						'</div>' +
						'</div>' +
						'</li>';
				} else if(data.ext == 2){
					html +=
						'<li class="media sent">' +
						'<div class="media-body">' +
						'<div class="msg-box">' +
						'<div>' +
						'<div class="chat-msg-attachments">\n' +
						'<div class="chat-attachment">\n' +
						'<img src="<?= base_url()?>chat-attach/' + data.src + '" alt="Attachment">\n' +
						'<div class="chat-attach-download d-flex justify-content-between">' +
						'<a href="<?= base_url()?>chat-attach/' + data.src + '" download="<?= base_url()?>chat-attach/' + data.src + '" >\n' +
						'<i class="fas fa-download"></i>\n' +
						'</a>\n' +
						'<a href="<?= base_url()?>chat-attach/' + data.src + '" target="_blank"><i class="fas fa-external-link-alt"></i></a>' +
						'</div>' +
						'</div>\n' +
						'</div>' +
						'<ul class="chat-msg-info">' +
						'<li>' +
						'<div class="chat-time">' +
						'<span>' + data.timestamp + '</span>' +
						'</div>' +
						'</li>' +
						'</ul>' +
						'</div>' +
						'</div>' +
						'</div>' +
						'</li>';
				}
			}
		} else {
			if ("msg" in data){
				html +=
					'<li class="media received">' +
					'<div class="media-body">' +
					'<div class="msg-box">' +
					'<div>' +
					'<p>' + data.msg + '</p>' +
					'<ul class="chat-msg-info">' +
					'<li>' +
					'<div class="chat-time">' +
					'<span>' + data.timestamp + '</span>' +
					'</div>' +
					'</li>' +
					'</ul>' +
					'</div>' +
					'</div>' +
					'</div>' +
					'</li>';
			} else {
				if (data.ext == 1){
					html +=
						'<li class="media received">' +
						'<div class="media-body">' +
						'<div class="msg-box">' +
						'<div>' +
						'<p><a href="<?= base_url()?>chat-attach/' + data.src + '" class="mr-2" target="_blank">' + data.src + ' </a><i class="fas fa-external-link-alt"></i></p>' +
						'<ul class="chat-msg-info">' +
						'<li>' +
						'<div class="chat-time">' +
						'<span>' + data.timestamp + '</span>' +
						'</div>' +
						'</li>' +
						'</ul>' +
						'</div>' +
						'</div>' +
						'</div>' +
						'</li>';
				} else if(data.ext == 2){
					html +=
						'<li class="media received">' +
						'<div class="media-body">' +
						'<div class="msg-box">' +
						'<div>' +
						'<div class="chat-msg-attachments">\n' +
						'<div class="chat-attachment">\n' +
						'<img src="<?= base_url()?>chat-attach/' + data.src + '" alt="Attachment">\n' +
						'<div class="chat-attach-download d-flex justify-content-between">' +
						'<a href="<?= base_url()?>chat-attach/' + data.src + '" download="<?= base_url()?>chat-attach/' + data.src + '" >\n' +
						'<i class="fas fa-download"></i>\n' +
						'</a>\n' +
						'<a href="<?= base_url()?>chat-attach/' + data.src + '" target="_blank"><i class="fas fa-external-link-alt"></i></a>' +
						'</div>' +
						'</div>\n' +
						'</div>' +
						'<ul class="chat-msg-info">' +
						'<li>' +
						'<div class="chat-time">' +
						'<span>' + data.timestamp + '</span>' +
						'</div>' +
						'</li>' +
						'</ul>' +
						'</div>' +
						'</div>' +
						'</div>' +
						'</li>';
				}
			}
		}

		return html;

	}

</script>

</body>

</html>
