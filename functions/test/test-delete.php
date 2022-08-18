<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('test-delete')) {

		// set page
		$page = 'test';

		// PROCESS FORM
		$id = decryptID($_GET['id']);

		// delete test from test table
		$epoch_time = time();
		$sql = $pdo->prepare("UPDATE test SET test_status = 2, temp_del = ".$epoch_time." WHERE id = :test_id LIMIT 1");
		$sql->bindParam(":test_id",$id);
		$sql->execute();

		$err_code = 0;
		
	} else { // permission not found
		
		$err_code = 3;

	}
}
renderConfirmDelete($err_code,'sys_test_suc','test_messages_removed');
header('location: /test');
?>