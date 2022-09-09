
<?php

// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('user-edit')) {

		// PROCESS FORM
		$user_id = decryptID($_GET['id'],'users');

		$sql = $pdo->prepare("UPDATE users SET user_status = 0, user_log_attempts = 0, lockout_timestamp = NULL WHERE user_id = :user_id LIMIT 1");
		$bind_param = array(
		':user_id' => $user_id
		);
		$sql->execute($bind_param);
		if($sql){ ?>
			<script>alert('<?php echo renderLang($user_unlock_success); ?>');</script>

		<?php } else { ?>

			<script>alert('<?php echo renderLang($users_user_not_found); ?>');</script>
<?php } 	
	} else { // permission not found

		$_SESSION['sys_permission_err'] = 'You are not authorized to access the page or function.'; // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}

} else { // no session found, redirect to login page

$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
header('location: /login');

}

?>