<!-- JS -->
<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/select2/js/select2.full.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/dist/js/adminlte.min.js"></script>
<script src="/assets/js/common.js"></script>
<script>
	var loader = $('#loader');
	$(function() {
		
		// set toast plugin
		const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		
		// minimal select2 for forms
		$('.select2').select2();
		
		// wysiwyg
		$('.wysiwyg').summernote({
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'underline', 'clear']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['insert', ['picture']],
				['fontsize', ['fontsize']]
			]
		});
		
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
		
		$('.btn-logout').click(function(e) {
			e.preventDefault();
			if(confirm('<?php echo renderLang($login_logout_confirm); ?>')) {
				window.location.href = '/logout';
			}
		});
		
	});
	
	function showLoading() {
		$('.overlay, .loading').fadeIn(250);
	}
	function hideLoading() {
		$('.overlay, .loading').fadeOut(250);
	}
	
	function filterTable(field,target) {
		$(field).on('keyup', function() {
			var value = $(this).val().toLowerCase();
			$(target).filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	}
</script>

<?php if($_SESSION['sys_data']['id'] == 1) { ?>
<script>
	$(function() {

		$('.btn-reset-tickets').click(function(e) {
			e.preventDefault();
			if(confirm('PROCEED WITH CAUTION. This will delete data from database PERMANENTLY. Are you sure you want to reset tickets?')) {
				loader.load('/reset-tickets');
			}
		});

		$('.btn-reset-users').click(function(e) {
			e.preventDefault();
			if(confirm('PROCEED WITH CAUTION. This will delete data from database PERMANENTLY. This will also remove TICKETS and POSTS tables as they are connected with users. Are you sure you want to reset users?')) {
				loader.load('/reset-users');
			}
		});

		$('.btn-reset-system').click(function(e) {
			e.preventDefault();
			if(confirm('Are you sure you want to perform a SYSTEM RESET?')) {
				loader.load('/reset-system');
			}
		});

	});
</script>
<?php } ?>