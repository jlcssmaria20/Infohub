<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'restore';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		$err = 0;
		// PROCESS FORM
		$id = decryptID($_GET['id']);

		// delete user from users table
		$epoch_time = time();
		$sql = $pdo->prepare("UPDATE users SET status = 0  WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
		$sql->execute();

		$_SESSION['restored_success'] = 'restored_success';
		unset($_SESSION['update_user_success']);
		header('location:/edit-user/list/'.encryptID($id).'');

}

?>