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
		
		$sql = $pdo->prepare("SELECT * FROM files WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {

			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$document_id = $data['document_id'];

			// delete file from document table
			
			$sql = $pdo->prepare("DELETE FROM files WHERE id = :id LIMIT 1");
			$sql->bindParam(":id",$id);
			$sql->execute();

			header('location: /edit-document/'.encryptID($document_id).'');
		}


		$err_code = 0;
		
	} else { // permission not found
		
		$err_code = 3;

	}
}
?>