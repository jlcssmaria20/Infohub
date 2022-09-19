<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('user-delete')) {

		$err = 0;

		// PROCESS FORM
		$user_id = $_POST['id'];
		
		if($user_id != 1) {
			
			$account_id = $_SESSION['sys_id'];
			$upass = $_POST['upass'];

			// verify password
			switch($_SESSION['sys_account_mode']) {
				case 'admin':
					$sql = $pdo->prepare("SELECT admin_id, admin_password FROM admins WHERE admin_id = :admin_id LIMIT 1");
					$sql->bindParam(":admin_id",$account_id);
					$sql->execute();
					$data = $sql->fetch(PDO::FETCH_ASSOC);
					$upass_db = $data['admin_password'];
					break;
				case 'user':
					$sql = $pdo->prepare("SELECT user_id, user_password FROM users WHERE user_id = :user_id LIMIT 1");
					$sql->bindParam(":user_id",$account_id);
					$sql->execute();
					$data = $sql->fetch(PDO::FETCH_ASSOC);
					$upass_db = $data['user_password'];
					break;
			}
			
			// check if passwords match
			if(password_verify($upass,$upass_db)){

				$sql = $pdo->prepare("SELECT user_id FROM users WHERE user_id = :user_id LIMIT 1");
				$sql->bindParam(":user_id",$user_id);
				$sql->execute();
				$data = $sql->fetch(PDO::FETCH_ASSOC);

				// check if ID exists
				if($sql->rowCount()) {

					// delete user from users table
					$epoch_time = time();
					$sql = $pdo->prepare("UPDATE users SET user_status = 2, temp_del = ".$epoch_time." WHERE user_id = :user_id LIMIT 1");
					$sql->bindParam(":user_id",$user_id);
					$sql->execute();

					// record to system log
					// systemLog('user',$user_id,'delete','');

					$err_code = 0;

				} else {

					$err_code = 4;

				}

			} else {

				$err_code = 2;

			}
			
		} else {
			
			$err_code = 4;
			
		}
		

	} else { // permission not found
		
		$err_code = 3;

	}
}

renderConfirmDelete($err_code,'sys_users_suc','users_messages_user_removed');
header('location: /users');
?>