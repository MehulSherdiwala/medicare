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

	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/css/bootstrap-datetimepicker.min.css">

	<!-- Select2 CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/plugins/select2/css/select2.min.css">

	<!-- Datatables CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/plugins/datatables/datatables.min.css">
	<!-- Main CSS -->
	<link rel="stylesheet" href="<?= base_url()?>assets/css/style.css?version=5">

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
	include ("header.php")
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
							<li class="breadcrumb-item active" aria-current="page">My Orders</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">My Orders</h2>
				</div>
			</div>
		</div>
	</div>
	<!-- /Breadcrumb -->

	<!-- Page Content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">

				<!-- Profile Sidebar -->
				<?php
				include ("sidebar.php");
				?>
				<!-- /Profile Sidebar -->

				<div class="col-md-7 col-lg-8 col-xl-9">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table datatable table-bordered table-hover table-center mb-0">
									<thead>
									<tr>
										<th>Order Id</th>
										<th>Date</th>
										<th>Total Medicine</th>
										<th>Delivery Address</th>
										<th>Total Amount</th>
										<th>Payment Method</th>
										<th>Status</th>
										<th></th>
									</tr>
									</thead>
									<tbody>
									<?php

									if (!empty($orderList))
									{
										foreach ($orderList as $order)
										{
											?>
											<tr>
												<td><?= $order['orderId'] ?></td>
												<td><?= $order['date'] ?></td>
												<td><?= $order['totalItems'] ?></td>
												<td><?= $order['daAddress'] ?></td>
												<td><?= $order['totalAmount'] ?></td>
												<td><?= $order['payMethod'] ?></td>
												<td><?= $order['status'] ?></td>
												<td>
													<button
														class="btn btn-info btn-sm btn-square rounded-pill view-order"
														data-orderid="<?= $order['orderId'] ?>"
														data-target="#view-order" data-toggle="modal">
														<i class="far fa-eye"></i></button>
												</td>
											</tr>
											<?php
										}
									}
									?>
									</tbody>
								</table>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- /Page Content -->

	<?php
	include ("footer.php")
	?>
</div>
<!-- /Main Wrapper -->
<div aria-hidden="true" class="modal fade" id="view-order" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header"><h5 class="modal-title">Order Details</h5></div>
			<div class="modal-body">
				<h4>Order Item Details</h4>
				<hr>
				<div class="row">
					<div class="col-md-12" id="items">
					</div>
				</div>
			</div>
			<div class="modal-footer d-block">
				<div class="actions justify-content-between">
					<button class="btn btn-danger" data-dismiss="modal" type="button">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- jQuery -->
<script src="<?= base_url()?>assets/js/jquery.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?= base_url()?>assets/js/popper.min.js"></script>
<script src="<?= base_url()?>assets/js/bootstrap.min.js"></script>

<!-- Select2 JS -->
<script src="<?= base_url()?>assets/plugins/select2/js/select2.min.js"></script>

<!-- Datetimepicker JS -->
<script src="<?= base_url()?>assets/js/moment.min.js"></script>
<script src="<?= base_url()?>assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Sticky Sidebar JS -->
<script src="<?= base_url()?>assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
<script src="<?= base_url()?>assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

<!-- Datatables JS -->
<script src="<?= base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables/datatables.min.js"></script>

<!-- parsley JS -->
<script src="<?= base_url()?>assets/plugins/parsley/js/parsley.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url()?>assets/js/script.js?version=3"></script>

<script>
	$(".view-order").on('click', function () {
		const orderId = $(this).data('orderid');
		orderDetails(orderId);
	});

	async function orderDetails(orderId) {
		const res = await fetch('<?= base_url()?>Shop/orderDetails/' + orderId);
		const data = await res.json();

		let html = '';
		html += '<table class="table table-bordered" id="data-table">\n' +
			'<thead>\n' +
			'<tr>\n' +
			'<th scope="col">Medicine Id</th>\n' +
			'<th scope="col">Medicine Name</th>\n' +
			'<th scope="col">Medicine Description</th>\n' +
			'<th scope="col">Quantity</th>\n' +
			'<th scope="col">Price</th>\n' +
			'<th scope="col">Dose</th>\n' +
			'<th scope="col">Capacity</th>\n' +
			'</tr>\n' +
			'</thead>\n' +
			'<tbody>';
		for (let i = 0; i < data.length; i++) {

			html += '<tr>\n' +
				'<td>'+ data[i].medId+'</td>\n' +
				'<td>'+ data[i].medName+'</td>\n' +
				'<td>'+ data[i].medDescription+'</td>\n' +
				'<td>'+ data[i].qty+'</td>\n' +
				'<td>'+ data[i].price+'</td>\n' +
				'<td>'+ data[i].dose+'</td>\n' +
				'<td>'+ data[i].capacity+'</td>\n' +
				'</tr>';
		}
		html += '</tbody></table>';
		$("#items").html(html);
	}
</script>

<script>
	$('.datatable').DataTable({
		"order": [[ 0, "desc" ]]
	});
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
