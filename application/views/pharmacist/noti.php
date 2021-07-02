<script>
	$(document).ready(function(){
		$('.count').html('');

		function load_unseen_notification(view = '')
		{
			$.ajax({
				url:"<?= base_url()?>pharmacist/noti",
				method:"POST",
				data:{view:view},
				dataType:"json",
				success:function(data)
				{
					// $('#noti').html(data.res);
					$('#noti').html(data.notification);
					if(data.unseen_notification > 0)
					{
						$('.count').html(data.unseen_notification);
					}
				}
			});
		}

		load_unseen_notification();

		$(document).on('click', '.noti-cart', function(){
			$('.count').html('');
			load_unseen_notification('yes');
		});

		setInterval(function(){
			load_unseen_notification();
		}, 5000);

	});
</script>
