$(function() {

	// used to check employee ID if existing
	var timer = 0;
	var timeout;
	var selectedEmployeeID = '';
	$('#user_id').keyup(function() {
		selectedEmployeeID = $(this).val();
		if(selectedEmployeeID != '') {
			timer = 0;
			clearTimeout(timeout);
			$('.user-id-message').html(checkIDmsg);
			playTimer();
		} else {
			$('.user-id-message').html('');
		}
	});
	function playTimer(employeeid) {
		timeout = setTimeout(function() {
			timer++;
			if(timer < 3) {
				playTimer();
			} else {
				timer = 0;
				clearTimeout(timeout);
				loader.load('/check-user-via-employee-id?id='+encodeURIComponent(selectedEmployeeID)+'&module='+encodeURIComponent(module));
			}
		}, 1000);
	}

});