<?php
// INCLUDES

$module = 'documentsquicklinks'; $prefix = 'documentsquicklink';  $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');


if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {
	
		$id = decryptID($_POST['id']);

			$docu_name = $_POST['docu_name'];
			$date_edit =  date('F j, Y - l - h:i a', time());

			$sql = 'UPDATE documentsquicklinks SET docu_name = :docu_name, date_edited = :date_edited WHERE id = :id';
			// prepare statement
			$stmt = $pdo->prepare($sql);
			// bind params
			$stmt->bindParam(':docu_name', $docu_name);
			$stmt->bindParam(':date_edited', $date_edit);
			$stmt->bindParam(':id', $id);
			// execute the UPDATE statment
			$stmt->execute();

			$_SESSION['update_webinar_events'] = 'update_webinar_events';
			header('location:/edit-documentsquicklink/list/'.encryptID($id).'');


	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
	//	header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
//	header('location: /');

}

		?>