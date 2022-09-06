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
		
		// delete file from document table
		$sql = $pdo->prepare("DELETE FROM files WHERE id = :id");
		$sql->bindParam(":id",$id);
		$sql->execute();

		$err_code = 0;
		
	} else { // permission not found
		
		$err_code = 3;

	}
}
header('location: /edit-document/'.encryptID('1').'');
?>