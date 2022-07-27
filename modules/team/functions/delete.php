<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'delete';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		$err = 0;

		// PROCESS FORM
		$id = decryptID($_POST['id']);
		
		if($id != 1) {
			
			$user_id = $_SESSION['sys_data']['id'];
			$upass = $_POST['upass'];

			// verify password
			$sql = $pdo->prepare("SELECT id, upass FROM users WHERE id = :user_id LIMIT 1");
			$sql->bindParam(":user_id",$user_id);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$upass_db = decryptStr($data['upass']);

			// check if passwords match
			if($upass_db == $upass) {

				$sql = $pdo->prepare("SELECT id FROM ".$module." WHERE id = :id LIMIT 1");
				$sql->bindParam(":id",$id);
				$sql->execute();
				$data = $sql->fetch(PDO::FETCH_ASSOC);

				// check if ID exists
				if($sql->rowCount()) {

					// delete user from users table
					$epoch_time = time();
					$sql = $pdo->prepare("UPDATE ".$module." SET status = 2, temp_del = ".$epoch_time." WHERE id = :id LIMIT 1");
					$sql->bindParam(":id",$id);
					$sql->execute();
					
					// START ADDITIONALS
					// END ADDITIONALS

					// record to system log
					systemLog($module,$id,$process,'');

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

renderConfirmDelete($err_code,'sys_'.$module.'_suc',$module.'_messages_'.$prefix.'_removed');
?>