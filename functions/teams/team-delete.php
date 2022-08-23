<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('team-delete')) {

		// set page
		$page = 'teams';

		// PROCESS FORM
		$id = decryptID($_GET['id']);

		// delete team from team table
		$epoch_time = time();
		$sql = $pdo->prepare("UPDATE teams SET team_status = 2, temp_del = ".$epoch_time." WHERE id = :team_id LIMIT 1");
		$sql->bindParam(":team_id",$id);
		$sql->execute();

		$err_code = 0;
		
	} else { // permission not found
		
		$err_code = 3;

	}
}
renderConfirmDelete($err_code,'sys_team_suc','team_messages_removed');
header('location: /teams');
?>