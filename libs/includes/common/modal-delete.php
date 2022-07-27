<!-- MODALS -->
<!-- confirm delete -->
<div class="modal fade" id="modal-confirm-delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h4 class="modal-title"><?php echo renderLang($modal_delete_confirmation); ?></h4>
			</div>
			<!-- id="form_delete" -->
			<form method="post"  action="/delete-<?php echo $prefix; ?>" >
				<input type="hidden" name="id" value="<?php echo encryptID($id); ?>">
				<div class="modal-body">
					<h2>Are you sure you want to delete this query?</h2>
					<br>
					<button type="submit" class="btn btn-danger btn-delete"><i class="fa fa-check mr-2"></i><?php echo renderLang($modal_confirm_delete); ?></button>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-2"></i><?php echo renderLang($modal_cancel); ?></button>
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
					window.location.href = '/<?php echo $module; ?>';
				} else {
					$('.modal-error')
						.html(response_arr[1]) // val is error message
						.show();
				}
			});
		});
	});
</script>