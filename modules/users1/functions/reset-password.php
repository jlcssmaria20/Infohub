<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'reset';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-edit') && $id != 1) {

		// PROCESS FORM
		$id = decryptID($_GET['id']);

		$sql = $pdo->prepare("SELECT id, uname FROM ".$module." WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);

		// check if ID exists
		if($sql->rowCount()) {
			
			$upass = encryptStr($data['uname']);

			// delete user from users table
			$epoch_time = time();
			$sql = $pdo->prepare("UPDATE ".$module." SET upass = :upass WHERE id = :id LIMIT 1");
			$sql->bindParam(":upass",$upass);
			$sql->bindParam(":id",$id);
			$sql->execute();

			// START ADDITIONALS
			// END ADDITIONALS

			// record to system log
			systemLog($module,$id,$process,'');

			$_SESSION['sys_'.$module.'_suc'] = renderLang(${$module.'_user_reset_success'});

			header('location: /'.$prefix.'/'.encryptID($id).'?tab=user-options');

		} else {

			$_SESSION['sys_'.$module.'_err'] = renderLang(${$module.'_user_not_found'});
			header('location: /'.$module);

		}

	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}

} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /');

}
?>