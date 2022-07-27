<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'delete';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		$err = 0;

		// PROCESS FORM
		$id = decryptID($_POST['id']);

		// delete user from users table
		$epoch_time = time();
		$sql = $pdo->prepare("UPDATE users SET status = 1, temp_del = ".$epoch_time." WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
		$sql->execute();


		$_SESSION['delete_success'] = 'delete_success';

		header('location:/edit-user/list/'.encryptID($id).'');

}
?>
`