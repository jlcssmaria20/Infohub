<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');


// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('role-edit')) {
		
		$page = 'roles';

		$err = 0;
		$role_id = decryptID($_POST['role_id']);

		// check if role_ID exists
		$sql = $pdo->prepare("SELECT * FROM roles WHERE role_id = :role_id LIMIT 1");
		$sql->bindParam(":role_id",$role_id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		if($sql->rowCount()) {

			// PROCESS FORM

			// ROLE NAME
			$role_name = '';
			if(isset($_POST['role_name'])) {
				$role_name = htmlentities(trim($_POST['role_name']));
				if(strlen($role_name) == 0) {
					$err++;
					$_SESSION['sys_roles_edit_role_name_err'] = renderLang($roles_role_name_required);
				} else {

					$_SESSION['sys_roles_edit_role_name_val'] = $role_name;

					// check if role name already exists
					$sql = $pdo->prepare("SELECT role_id, role_name FROM roles WHERE role_name=:role_name AND role_id<> :role_id AND temp_del=0 LIMIT 1");
					$sql->bindParam(":role_name",$role_name);
					$bind_param = array(
						':role_id'   => $role_id,
						':role_name' => $role_name
					);
					$sql->execute($bind_param);
					if($sql->rowCount()) {
						$err++;
						$_SESSION['sys_roles_edit_role_name_err'] = renderLang($roles_role_name_exists);
					}
				}
			}

			// PERMISSIONS
			$permissions = trim($_POST['permissions']);
			if(strlen($permissions) == 0) {
				$err++;
				$_SESSION['sys_roles_edit_role_permissions_err'] = renderLang($roles_permission_required);
			} else {
				$_SESSION['sys_roles_edit_role_permissions_val'] = $permissions;
			}

			// VALIDATE FOR ERRORS
			if($err == 0) { // there are no errors

				// cross check count of permissions
				$permissions_val_arr = explode(',',$permissions);
				if(count($permissions_val_arr) == $permissions_count) {
					$permissions = 'all';
				}

				// check for changes
				$change_logs = array();
				if($role_name != $data['role_name']) {
					$tmp = 'roles_role_name::'.$data['role_name'].'=='.$role_name;
					array_push($change_logs,$tmp);
				}
				if($permissions != $data['permissions']) {
					$tmp = 'lang_permissions::'.$data['permissions'].'=='.$permissions;
					array_push($change_logs,$tmp);
				}

				// check if there is are changes made
				if(count($change_logs) > 0) {

					// update account language table
					$sql = $pdo->prepare("UPDATE roles SET
							role_name = :role_name,
							permissions = :permissions
						WHERE role_id = :role_id");
					$bind_param = array(
						':role_id'     => $role_id,
						':role_name'   => $role_name,
						':permissions' => $permissions
					);
					$sql->execute($bind_param);

					// record to system log
					// $change_log = implode(';;',$change_logs);
					// systemLog('role',$role_id,'update',$change_log);

					$_SESSION['sys_roles_edit_suc'] = renderLang($roles_role_updated);

				} else { // no changes made

					$_SESSION['sys_roles_edit_err'] = renderLang($form_no_changes);

				}

			} else { // error found

				$_SESSION['sys_roles_edit_err'] = renderLang($form_error);

			}

		} else {

			$_SESSION['sys_roles_edit_err'] = renderLang($form_id_not_found);

		}

		header('location: /edit-role/'.encryptID($role_id));

	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}

?>