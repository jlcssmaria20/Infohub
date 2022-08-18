<!-- JS -->
<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/autoheight.min.js"></script>
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="/dist/js/adminlte.min.js"></script>
<script src="/assets/js/common.js"></script>
<script>
	var loader = $('#loader');

	// set toast plugin
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});
	
	$(function() {
		
		// minimal select2 for forms
		$('.select2').select2();
		
		<?php
		// users for language change notification
		if(isset($_SESSION['sys_alert_toast_success'])) {
			?>
			Toast.fire({
				type: 'success',
				title: '<?php echo $_SESSION['sys_alert_toast_success']; ?>'
			});
			<?php
			unset($_SESSION['sys_alert_toast_success']);
		}
		?>
		
		// confirm logout
		$('#logout').click(function(e) {
			e.preventDefault();
			if(confirm('<?php echo renderLang($login_logout_confirmation)?>')){
				window.location.href = "/logout";
			}
		});
		
	});
	
	function showLoading() {
		$('.overlay, .loading').fadeIn(250);
	}
	function hideLoading() {
		$('.overlay, .loading').fadeOut(250);
	}
</script>