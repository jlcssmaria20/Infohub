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

		// // delete user from users table
		// $epoch_time = time();
		// $sql = $pdo->prepare("UPDATE documentsquicklinks SET status = 1, temp_del = ".$epoch_time." WHERE id = :id LIMIT 1");
		// $sql->bindParam(":id",$id);
		// $sql->execute();

		$_SESSION['delete_success'] = 'delete_success';

		$sql = 'DELETE FROM documentsquicklinks WHERE id = :id';
		// prepare the statement for execution
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		unset($_SESSION['add_document_success']);
		unset($_SESSION['documentalreadyexist']);

		header('location:/edit-documentsquicklink/list/'.encryptID('1').'');


		

}


?>