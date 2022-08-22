<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('announcements-delete')) {

		// set page
		$page = 'announcements';

		// PROCESS FORM
		$id = decryptID($_GET['id']);

		// delete announcements from announcements table
		$epoch_time = time();
		$sql = $pdo->prepare("UPDATE announcements SET announcements_status = 2, temp_del = ".$epoch_time." WHERE id = :announcements_id LIMIT 1");
		$sql->bindParam(":announcements_id",$id);
		$sql->execute();

		$err_code = 0;
		
	} else { // permission not found
		
		$err_code = 3;

	}
}
renderConfirmDelete($err_code,'sys_announcements_suc','announcements_messages_removed');
header('location: /announcements');
?>