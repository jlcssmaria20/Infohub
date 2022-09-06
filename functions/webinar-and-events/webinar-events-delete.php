<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('webinar-events-delete')) {

		// set page
		$page = 'webinarandevents';

		// PROCESS FORM
		$id = decryptID($_GET['id']);

		// delete webinar_events from webinar_events table
		$epoch_time = time();
		$sql = $pdo->prepare("UPDATE webinarandevents SET webinar_events_status = 2, temp_del = ".$epoch_time." WHERE id = :webinar_events_id LIMIT 1");
		$sql->bindParam(":webinar_events_id",$id);
		$sql->execute();

		$err_code = 0;
		
	} else { // permission not found
		
		$err_code = 3;

	}
}
    renderConfirmDelete($err_code,'sys_webinar_events_suc','webinar_events_removed');
    header('location: /webinarandevents');
?>