<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('document-delete')) {

		// set page
		$page = 'documents';

		// PROCESS FORM
		$id = decryptID($_GET['id']);

		// delete document from document table
		$epoch_time = time();
		$sql = $pdo->prepare("UPDATE documents SET document_status = 2, temp_del = ".$epoch_time." WHERE id = :document_id LIMIT 1");
		$sql->bindParam(":document_id",$id);
		$sql->execute();

		$err_code = 0;
		
	} else { // permission not found
		
		$err_code = 3;

	}
}
renderConfirmDelete($err_code,'sys_document_suc','document_messages_removed');
header('location: /documents');
?>