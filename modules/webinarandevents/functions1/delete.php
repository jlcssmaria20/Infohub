<?php
// INCLUDES
$module = 'webinarandevents'; $prefix = 'webinarandevent'; $process = 'delete';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

unset($_SESSION['update_webinar_events']);
$err_code = 1;

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		$err = 0;
		// PROCESS FORM
		$id = decryptID($_POST['id']);

		// // delete user from users table
		// $epoch_time = time();
		// $sql = $pdo->prepare("UPDATE webinarandevents SET status = 1, temp_del = ".$epoch_time." WHERE id = :id LIMIT 1");
		// $sql->bindParam(":id",$id);
		// $sql->execute();

		// construct the delete statement
		$sql = 'DELETE FROM webinarandevents WHERE id = :id';
		// prepare the statement for execution
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();


		$_SESSION['delete_success'] = 'delete_success';

		header('location:/edit-webinarandevent/list/'.encryptID('1').'');

}
?>
