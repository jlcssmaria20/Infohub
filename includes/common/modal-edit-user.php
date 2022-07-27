
<script>
	$(function() {
		// confirm delete
		var form_data;
		$('.bnt-edit').click(function() {
			form_data = $('#form_edit').serialize();
			$('#modal_confirm_edit_upass').val('');
			$('#form_edit').submit();
		});
	});

</script>