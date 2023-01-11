<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

// check if user has existing session
if(checkSession()) {
	// check permission to access this page or function
	if(checkPermission('role-delete')) {
		
		$page = 'roles';

		$err = 0;

		// PROCESS FORM
		$role_id = decryptID($_GET['id']);

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
				
				$sql = $pdo->prepare("SELECT role_id FROM roles WHERE role_id = :role_id LIMIT 1");
				$sql->bindParam(":role_id",$role_id);
				$sql->execute();
				$data = $sql->fetch(PDO::FETCH_ASSOC);

				// check if ID exists
				if($sql->rowCount()) {

					// delete role from roles table
					$epoch_time = time();
					$sql = $pdo->prepare("UPDATE roles SET role_status = 2, temp_del = ".$epoch_time." WHERE role_id = :role_id LIMIT 1");
					$sql->bindParam(":role_id",$role_id);
					$sql->execute();

					// update roles in users table
					$sql_update = $pdo->prepare("SELECT user_id, role_ids FROM users WHERE role_ids LIKE '%, :role_id ,%'");
					$sql_update->bindParam(":role_id", $role_id);
					$sql_update->execute();
					
					while($data = $sql_update->fetch(PDO::FETCH_ASSOC)) {

						// get current row ID
						$data_id = $data['user_id'];

						// update roles, remove role ID, replace with comma
						$role_ids = $data['role_ids'];
						$role_ids = str_replace(','.$id.',',',',$role_ids);

						// update this row
						$sql2 = $pdo->prepare("UPDATE users SET role_ids = :role_ids WHERE user_id = :user_id LIMIT 1");
						$bind_param = array(
							':role_ids' => $roles,
							':user_id' => $role_ids
						);
						$sql2->execute($bind_param);
					}

					// record to system log
					// systemLog('role',$role_id,'delete','');
					echo "utet";
					$err_code = 0;

				} else {

					$err_code = 4;

				}

			} else {

				$err_code = 2;

			}


		} else { // permission not found

			$err_code = 3;

		}
}

renderConfirmDelete($err_code, 'sys_roles_suc', 'roles_messages_role_removed');
// header('location: /roles');
?>