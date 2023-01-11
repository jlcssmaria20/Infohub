<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('admin-add')) {
	
		$err = 0;
		$invalid = "Invalid Characters!";
		// PROCESS FORM
		
		// USERNAME
		$username = '';
		if(isset($_POST['username'])) {
			$username = htmlentities(trim($_POST['username']));
			$username = str_replace(' ','',$username);
			$_SESSION['sys_admins_add_username_val'] = $username;
			if(strlen($username) == 0) {
				$err++;
				$_SESSION['sys_admins_add_username_err'] = renderLang($admins_username_required);
			} else {
				
				// check if employee ID already exists
				$sql = $pdo->prepare("SELECT admin_username, temp_del FROM admins WHERE admin_username = :admin_username AND temp_del=0 LIMIT 1");
				$bind_param = array(
					':admin_username' => $username
				);
				$sql->execute($bind_param);
				if($sql->rowCount() > 0) {
					$err++;
					$_SESSION['sys_admins_add_username_err'] = renderLang($admins_username_exists);
				}
			}
		}
		
		// FIRSTNAME
		$firstname = '';
		if(isset($_POST['firstname'])) {
			$firstname = ucwords(strtolower(trim($_POST['firstname'])));
			$_SESSION['sys_admins_add_firstname_val'] = $firstname;
			if(strlen($firstname) == 0) {
				$err++;
				$_SESSION['sys_admins_add_firstname_err'] = renderLang($admins_firstname_required);
			} else {
				if(!validateNameV1($firstname)) {
					$err++;
					$_SESSION['sys_admins_add_firstname_err'] = $invalid;
				}
			}
		}
		
		// LASTNAME
		$lastname = '';
		if(isset($_POST['lastname'])) {
			$lastname = ucwords(strtolower(trim($_POST['lastname'])));
			$_SESSION['sys_admins_add_lastname_val'] = $lastname;
			if(strlen($lastname) == 0) {
				$err++;
				$_SESSION['sys_admins_add_lastname_err'] = renderLang($admins_lastname_required);
			} else {
				if(!validateNameV1($lastname)) {
					$err++;
					$_SESSION['sys_admins_add_lastname_err'] =  $invalid;
				}
			}
		}
		
		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors
			
			$admin_password = encryptStr($username);
			
			// update account language table
			$sql = $pdo->prepare("INSERT INTO admins(
					admin_id,
					admin_username,
					admin_password,
					admin_firstname,
					admin_lastname
				) VALUES(
					NULL,
					:admin_username,
					:admin_password,
					:admin_firstname,
					:admin_lastname
				)");
			$bind_param = array(
				':admin_username'   => $username,
				':admin_password'   => $admin_password,
				':admin_firstname'  => $firstname,
				':admin_lastname'   => $lastname
			);
			$sql->execute($bind_param);
			
			
			// get ID of new admin
			$sql = $pdo->prepare("SELECT admin_id, admin_username FROM admins WHERE admin_username = :admin_username LIMIT 1");
			$bind_param = array(
				':admin_username'   => $username
			);
			$sql->execute($bind_param);
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			// record to system log
			// systemLog('admin',$data['admin_id'],'add','');

			$_SESSION['sys_admins_suc'] = renderLang($admins_admin_added);
			header('location: /admins');
			
		} else { // error found
			
			$_SESSION['sys_admins_add_err'] = renderLang($form_error);
			header('location: /add-admin');
			
		}
		
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}
?>