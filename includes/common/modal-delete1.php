<!-- MODALS -->
<!-- confirm delete -->
<div class="modal fade" id="modal-confirm-delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h4 class="modal-title"><?php echo renderLang($modal_delete_confirmation); ?></h4>
			</div>
			<form action="/delete-<?php echo 'pooling'; ?>" method="post" id="form_delete">
				<input type="hidden" name="id" value="<?php echo encryptID($id); ?>">
				<div class="modal-body">
					<p><?php echo renderLang(${'poolings_modal_delete_msg1'}); ?></p>
					<p><?php echo renderLang(${'poolings_modal_delete_msg2'}); ?></p>
					<hr>
					<div class="form-group is-invalid">
						<label for="modal_confirm_delete_upass"><?php echo renderLang($enter_password); ?></label>
						<input type="password" class="form-control required" id="modal_confirm_delete_upass" name="upass" placeholder="<?php echo renderLang($enter_password_placeholder); ?>" required>
					</div>
					<div class="modal-error alert alert-danger"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-2"></i><?php echo renderLang($modal_cancel); ?></button>
					<button type="button" class="btn btn-danger btn-delete"><i class="fa fa-check mr-2"></i><?php echo renderLang($modal_confirm_delete); ?></button>
				</div>
			</form>
		</div>
	</div>
</div><!-- modal -->
<script>
	$(function() {
		// confirm delete
		var form_data;
		$('.btn-delete').click(function() {
			form_data = $('#form_delete').serialize();
			$('#modal_confirm_delete_upass').val('');
			$('#form_delete').submit();
		});
		$('#form_delete').submit(function(e) {
			e.preventDefault();
			var post_url = $(this).attr("action");
			$.ajax({
				url: post_url,
				type: 'POST',
				data : form_data
			}).done(function(response){
				var response_arr = response.split(',');
				if(response_arr[0] == 1) { // val is 1
					window.location.href = '/<?php echo 'poolings'; ?>';
				} else {
					$('.modal-error')
						.html(response_arr[1]) // val is error message
						.show();
				}
			});
		});
	});
</script>