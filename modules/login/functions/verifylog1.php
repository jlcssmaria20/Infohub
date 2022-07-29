<?php
// INCLUDES
$module = 'login';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if form was submitted properly
if(isset($_POST['submit-login'])) {
	
	// toggle for valid credentials
	$valid_credentials = 0;
	
	// get form data
	$uname = '';
	$uname = trim($_POST['uname']);
	$upass = trim($_POST['upass']);
	
	// if username is not empty
	if(strlen($uname) > 0 && strlen($upass) > 0) {
		
		// generate random string for session use
		$rand = substr(md5(microtime()),rand(0,26),20);
	
		// set session for uname
		$_SESSION['sys_login_uname'] = $uname;
		
		// check users table first
		$user_upass = '';
		$sql = $pdo->prepare("SELECT * FROM users WHERE uname = :uname AND status != 2 AND access_role = 0 LIMIT 1 ");
		$sql->bindParam(":uname",$uname);
		$sql->execute();
		$_SESSION['sys_data'] = $sql->fetch(PDO::FETCH_ASSOC);
		
		$user_upass = $_SESSION['sys_data']['upass'];
		$status = $_SESSION['sys_data']['status'];
		$photo = $_SESSION['sys_data']['photo'];
		$user_permissions = explode(',',$_SESSION['sys_data']['permissions']);
		
		// check if password is valid from user data
		if($upass != '' && $user_upass != '') {
			
			if(decryptStr($user_upass, $upass)) {

				// credential is valid
				$valid_credentials = 1;

			}

		}
		
		// check account status
		switch($status) {
			
			// ACTIVE
			case 0:
				
				// if credentials are valid, access system
				if($valid_credentials) {

					// check if remember me function is checked
					if(isset($_POST['remember_me'])) {
						// set cookie for login type (username or email) and password
						setcookie('sys_cookie_'.$system_code, $uname.'|'.$upass, time() + (86400 * 30), "/"); // set for 1 month
					} else {
						unsetCookie('sys_cookie_'.$system_code); // remove cookie if not checked
					}

					// check if there is a role set (requires at least one role per account)
					if($_SESSION['sys_data']['roleids'] != ',') {

						// set role array session
						$_SESSION['sys_permissions'] = array();

						// all permission toggle
						$all_permission = 0;

						// create where clause for multiple roles
						$roleids_arr = explode(',',$_SESSION['sys_data']['roleids']);
						$roleids_arr = implode(',',array_filter($roleids_arr));
						
						// get permissions based on roleids
						$sql = $pdo->prepare("SELECT id, permissions FROM roles WHERE id IN (".$roleids_arr.")");
						$sql->execute();
						while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
							if($data['permissions'] != 'all') {
								$permissions_arr_db = explode(',',$data['permissions']);
								$in_array = 0;
								foreach($permissions_arr_db as $permission) {
									if(!in_array($permission,$_SESSION['sys_permissions'])) {
										array_push($_SESSION['sys_permissions'],$permission);
									}
								}
							} else {
								$all_permission = 1;
							}
						}

						// get all permissions
						if($all_permission) {
							foreach($permissions_arr as $permissions_group) {
								foreach($permissions_group as $permission) {
									array_push($_SESSION['sys_permissions'],$permission['permission_code']);
								}
							}
						} else {
							foreach($user_permissions as $user_permission) {
								if(!in_array($user_permission,$_SESSION['sys_permissions'])) {
									array_push($_SESSION['sys_permissions'],$user_permission);
								}
							}
						}
						
						array_push($_SESSION['sys_permissions'],'dashboard'); // dashboard default
						array_push($_SESSION['sys_permissions'],'settings'); // settigns default

						// update last login time stamp
						$last_login = time();
						$sql = $pdo->prepare("UPDATE users SET last_login=".$last_login." WHERE id = ".$_SESSION['sys_data']['id']);
						$sql->execute();
						
						// get full name
						$_SESSION['sys_fullname'] = renderName($_SESSION['sys_data']);
						
						// get default photo
						$_SESSION['sys_data']['photo'] = $photo;
						renascitur();

						// redirect to dashboard
						header('location: /dashboard');

					} else { // else redirect to login page and display error details

						$_SESSION['sys_login_err'] = renderLang($login_msg_err_5); // "The account has no set role.<br>Please contact your web administrator."
						header('location: /admin-login');

					}

				} else { // else redirect to login page and display error details

					$_SESSION['sys_login_err'] = renderLang($login_msg_err_3); // "Invalid username or password."
					header('location: /admin-login');

				}
				
				break;

			// DEACTIVATED
			case 1:
				$_SESSION['sys_login_err'] = renderLang($login_msg_err_6); // "Account deactivated. Please contact your web administrator."
				header('location: /admin-login');
				break;
			
			// DELETED
			case 2:
				$_SESSION['sys_login_err'] = renderLang($login_msg_err_7); // "Account deleted. Please contact your web administrator."
				header('location: /admin-login');
				break;
				
		}
	
	} else { // else redirect to login page and display error details

		$_SESSION['sys_login_err'] = renderLang($login_msg_err_2); // "Please fill up the form properly."
		header('location: /admin-login');
		
	}
	
} else { // else redirect to login page and display error details
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_1); // "Please login properly."
	header('location: /admin-login');
	
}
?>