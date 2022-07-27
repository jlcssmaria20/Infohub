<?php
// INCLUDES
$module = 'documentsquicklinks'; $prefix = 'documentsquicklink'; $process = 'delete';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

	// check permission to access this page or function
if(checkPermission($module.'-'.$process)) {

		$err = 0;

		// PROCESS FORM
		$id = decryptID($_POST['id']);

		$_SESSION['delete_success'] = 'delete_success';

		$sql = 'DELETE FROM documentsquicklinks WHERE id = :id';
		// prepare the statement for execution
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		unset($_SESSION['add_document_success']);
		unset($_SESSION['documentalreadyexist']);
		$_SESSION['delete_success'] = 'delete_success';


		header('location:/edit-documentsquicklink/list/'.encryptID('1').'');


		

}


?>