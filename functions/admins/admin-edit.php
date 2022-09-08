<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('admin-edit')) {

		// set page
		$page = 'admins';
	
		$err = 0;
		$admin_id = decryptID($_POST['id']);
		
		// check if ID exists
		$sql = $pdo->prepare("SELECT * FROM admins WHERE admin_id = :admin_id LIMIT 1");
		$sql->bindParam(":admin_id",$admin_id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		if($sql->rowCount()) {

			// PROCESS FORM

			// USERNAME
			$username = '';
			if(isset($_POST['username'])) {
				$username = htmlentities(trim($_POST['username']));
				$username = str_replace(' ','',$username);
				$_SESSION['sys_admins_edit_username_val'] = $username;
				if(strlen($username) == 0) {
					$err++;
					$_SESSION['sys_admins_edit_username_err'] = renderLang($admins_username_required);
				} else {
					
					// check if username already exists
					$sql2 = $pdo->prepare("SELECT admin_id, admin_username, temp_del FROM admins WHERE admin_username = :admin_username AND admin_id <> :admin_id LIMIT 1");
					$bind_param = array(
						':admin_id'         => $admin_id,
						':admin_username'   => $username
					);
					$sql2->execute($bind_param);
					if($sql2->rowCount()) {
						$err++;
						$_SESSION['sys_admins_edit_username_err'] = renderLang($admins_username_exists);
					}
				}
			}

			// FIRSTNAME
			$firstname = '';
			if(isset($_POST['firstname'])) {
				$firstname = ucwords(strtolower(trim($_POST['firstname'])));
				$_SESSION['sys_admins_edit_firstname_val'] = $firstname;
				if(strlen($firstname) == 0) {
					$err++;
					$_SESSION['sys_admins_edit_firstname_err'] = renderLang($admins_firstname_required);
				} else {
					if(!validateNameV1($firstname)) {
						$err++;
						$_SESSION['sys_admins_edit_firstname_err'] = renderLang($lang_invalid_characters);
					}
				}
			}

			// LASTNAME
			$lastname = '';
			if(isset($_POST['lastname'])) {
				$lastname = ucwords(strtolower(trim($_POST['lastname'])));
				$_SESSION['sys_admins_edit_lastname_val'] = $lastname;
				if(strlen($lastname) == 0) {
					$err++;
					$_SESSION['sys_admins_edit_lastname_err'] = renderLang($admins_lastname_required);
				} else {
					if(!validateNameV1($lastname)) {
						$err++;
						$_SESSION['sys_admins_edit_lastname_err'] = renderLang($lang_invalid_characters);
					}
				}
			}

			// STATUS
			$admin_status = 0;
			if(isset($_POST['admin_status'])) {
				$admin_status = trim($_POST['admin_status']);
				$_SESSION['sys_admins_edit_admin_status_val'] = $admin_status;
				$admin_status_exists = 0;
				foreach($status_arr as $status_data) {
					if($status_data[0] == $admin_status) {
						$admin_status_exists = 1;
					}
				}
				if(!$admin_status_exists) {
					$err++;
					$_SESSION['sys_admins_edit_admin_status_err'] = 'Please select a valid status.';
				}
			}

			// VALIDATE FOR ERRORS
			if($err == 0) { // there are no errors

				$role_ids = ','.$role_ids.',';

				// check for changes
				$change_logs = array();
				if($username != $data['admin_username']) {
					$tmp = 'admins_username::'.$data['admin_username'].'=='.$username;
					array_push($change_logs,$tmp);
				}
				if($firstname != $data['admin_firstname']) {
					$tmp = 'admins_firstname::'.$data['admin_firstname'].'=='.$firstname;
					array_push($change_logs,$tmp);
				}
				if($lastname != $data['admin_lastname']) {
					$tmp = 'admins_lastname::'.$data['admin_lastname'].'=='.$lastname;
					array_push($change_logs,$tmp);
				}
				if($admin_status != $data['admin_status']) {
					echo $admin_status.' '.$data['admin_status'];
					$tmp = 'lang_status::'.$data['admin_status'].'=='.$admin_status;
					array_push($change_logs,$tmp);
				}

				// check if there is are changes made
				if(count($change_logs) > 0) {

					// update account language table
					$sql = $pdo->prepare("UPDATE admins SET
						admin_username = :admin_username,
						admin_firstname = :admin_firstname,
						admin_lastname = :admin_lastname,
						admin_status = :admin_status
					    WHERE admin_id = :admin_id");
					
					$bind_param = array(
						':admin_id'         => $admin_id,
						':admin_username'   => $username,
						':admin_firstname'  => $firstname,
						':admin_lastname'   => $lastname,
						':admin_status'     => $admin_status
					);
					$sql->execute($bind_param);
					
					// record to system log
					// $change_log = implode(';;',$change_logs);
					// systemLog('admin',$admin_id,'update',$change_log);

					$_SESSION['sys_admins_edit_suc'] = renderLang($admins_admin_updated);

				} else { // no changes made

					$_SESSION['sys_admins_edit_err'] = renderLang($form_no_changes);

				}

			} else { // error found

				$_SESSION['sys_admins_edit_err'] = renderLang($form_error);

			}

		} else {

			$_SESSION['sys_admins_edit_err'] = renderLang($form_id_not_found);

		}
			
		header('location: /edit-admin/'.encryptID($admin_id));
		
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}
?>