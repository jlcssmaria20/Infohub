<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('admin-delete')) {

		// set page
		$page = 'admins';

		$err = 0;

		// PROCESS FORM
		$admin_id = decryptID($_POST['id']);
		
		if($admin_id != 1) {
			
			$account_id = $_SESSION['sys_id'];
			$upass = $_POST['upass'];

			// verify password
			$account_mode = $_SESSION['sys_account_mode'];
			$sql = $pdo->prepare("SELECT ".$account_mode."_id, ".$account_mode."_password FROM ".$account_mode."s WHERE ".$account_mode."_id = :".$account_mode."_id LIMIT 1");
			$sql->bindParam(":".$account_mode."_id",$account_id);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$upass_db = $data[$account_mode.'_password'];
			
			// check if passwords match
			if(password_verify($upass,$upass_db)){

				$sql = $pdo->prepare("SELECT admin_id FROM admins WHERE admin_id = :admin_id LIMIT 1");
				$sql->bindParam(":admin_id",$admin_id);
				$sql->execute();
				$data = $sql->fetch(PDO::FETCH_ASSOC);

				// check if ID exists
				if($sql->rowCount()) {

					// delete admin from admins table
					$epoch_time = time();
					$sql = $pdo->prepare("UPDATE admins SET admin_status = 2, temp_del = ".$epoch_time." WHERE admin_id = :admin_id LIMIT 1");
					$sql->bindParam(":admin_id",$admin_id);
					$sql->execute();

					// record to system log
					// systemLog('admin',$admin_id,'delete','');

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

renderConfirmDelete($err_code,'sys_admins_suc','admins_messages_admin_removed');
?>