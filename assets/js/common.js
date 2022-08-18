$(function() {
	
	// validate required with minimum length
	$('input.required, select.required').on('keyup change',function() {
		checkRequired($(this));
		var minlength = 1;
		if($(this).attr('minlength') != undefined) {
			minlength = $(this).attr('minlength');
		}
		if($(this).val().length >= minlength) {
			$(this).closest('.form-group').find('.error-message').hide();
			$(this).closest('.form-group').find('label').removeClass('text-danger');
			$(this).closest('.form-group').find('label i').remove();
		}
	});
	$('input.required, select.required').each(function() {
		checkRequired($(this));
	});
	$('input').on('keyup change',function() {
		$(this).removeClass('is-valid').removeClass('is-invalid');
	});
	
	// modal confirm delete
	$('.btn-confirm-delete').click(function() {
		$('#modal_confirm_delete_upass').html('');
		$('.modal-error').html('').hide();
	});
	
	// run search
	$('body').on('keyup', '#search-keywords', function(e) {
		if(e.which == 13) {
			$('#btn-search').click();
		}
	});
	$('body').on('click', '#btn-search', function(e) {
		e.preventDefault();
		var keywords = $('#search-keywords').val();
		var currUrl = $(location).attr("href");
		var currUrl_arr = currUrl.split('?');
		var newUrl = '';
		if(typeof(getUrlParameter('p')) != 'undefined') {
			newUrl = currUrl_arr[0]+'?p='+getUrlParameter('p');
		}
		if(keywords != '') {
			newUrl = currUrl_arr[0]+'?p=1&k='+encodeURIComponent(keywords);
		} else {
			newUrl = currUrl_arr[0]+'?p=1';
		}
		window.location.href = newUrl;
	});
	
});

function checkRequired(obj) {
	var minlength = 1;
	if(obj.attr('minlength') != undefined) {
		minlength = obj.attr('minlength');
	}
	if(obj.val().length >= minlength) {
		obj.closest('.form-group').find('.badge').addClass('badge-success').removeClass('badge-danger');
	} else {
		obj.closest('.form-group').find('.badge').addClass('badge-danger').removeClass('badge-success');
	}
}

var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = window.location.search.substring(1),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;
	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		}
	}
};