<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$uname = '';
$upass = '';
$user_permissions_arr = array();

// check if form was submitted properly
if(isset($_POST['submit-login'])) {

	$uname = trim($_POST['uname']);
	$upass = trim($_POST['upass']);

	if(!empty($uname) && !empty($upass)){
		// set session for uname
		$_SESSION['sys_login_uname'] = $uname;

		// check users table first $admin_password = '';
		$sql = $pdo->prepare("SELECT * FROM admins WHERE admin_username = :admin_username LIMIT 1");
		$sql->bindParam(":admin_username",$uname);
		$sql->execute();

		$isInside = false;
		while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
			
			$admin_log_attempts = $data['admin_log_attempts'];
			$admin_password = $data['admin_password'];
			$admin_id = $data['admin_id'];
			$lockout_timestamp = $data['lockout_timestamp'];
			$_SESSION['sys_id'] = $data['admin_id'];
			$_SESSION['sys_firstname'] = $data['admin_firstname'];
			$_SESSION['sys_lastname'] = $data['admin_lastname'];
			$_SESSION['sys_fullname'] = $data['admin_firstname'].' '.$data['admin_lastname'];
			$_SESSION['sys_photo'] = 'default.png';
			$_SESSION['sys_account_mode'] = 'admin';
			$status = $data['admin_status'];
			
			$_SESSION['is_locked'] = false;
			$isInside = true;
			//setcookie('sys__language', $GLOBALS['language'], time() + (86400 * 30), "/");
		}

		//$_SESSION['sys_center_id'] = 1;


		if($isInside){
			//
			if(password_verify($upass, $admin_password)) {
			
			  //getStatus($pdo,$status,$permissions_arr,$lockout_timestamp,"admin",$admin_id);
			  getStatus($pdo,$status,$permissions_arr,$lockout_timestamp,"admin",$admin_id);
				
			} else {
				
				$attempts = checkAttempts($pdo,$uname);

				if($attempts >= 5){
						
					if($lockout_timestamp == NULL){
						
						$time_lock = date('Y-m-d H:i:s', strtotime('+1 hour'));
						$sql = $pdo->prepare("UPDATE admins SET admin_status = 1.5, lockout_timestamp = '$time_lock' WHERE admin_username = :admin_username");
						$sql->bindParam(":admin_username",$uname);
						$sql->execute();
						
					}
					
					$_SESSION['sys_login_err'] = renderLang($login_msg_err_8); // "Account is locked."
					$_SESSION['is_locked'] = true;
					goToPage(false);

				} else {
					
					//$_SESSION['sys_login_err'] = $attempts.' '.renderLang($login_msg_err_attempts);//2 out of 5 attempts.<br> Invalid email or password!."
					$_SESSION['sys_login_err'] = renderLang($login_msg_err_3);
					$_SESSION['is_locked'] = false;
					goToPage(false);
					
				}

			}
			
		} else {


			$user_password = '';
			$sql = $pdo->prepare("SELECT * FROM users WHERE user_email = :user_email LIMIT 1");
			$sql->bindParam(":user_email",$uname);
			$sql->execute();
			while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
				$user_log_attempts = $data['user_log_attempts'];
				$user_password = $data['user_password'];
				$user_id = $data['user_id'];
				$lockout_timestamp = $data['lockout_timestamp'];
				$_SESSION['sys_id'] = $data['user_id'];
				$_SESSION['sys_firstname'] = $data['user_firstname'];
				$_SESSION['sys_lastname'] = $data['user_lastname'];
				$_SESSION['sys_fullname'] = $data['user_firstname'].' '.$data['user_lastname'];
				if($data['user_photo'] == '') {
					if($data['user_gender'] == 0) {
						$_SESSION['sys_photo'] = '/assets/images/team-images/avatar2.png';
					} else {
						$_SESSION['sys_photo'] = '/assets/images/team-images/avatar5.png';
					}
				} else {
					$_SESSION['sys_photo'] = '/assets/images/team-images/'.$data['user_photo'];
				}
				$_SESSION['sys_center_id'] = $data['center_id'];
				$_SESSION['sys_role_ids'] = $data['role_ids']; 
				$_SESSION['sys_language'] = $data['language'];
				$GLOBALS['language'] = $data['language'];
				$_SESSION['sys_data_per_page'] = $data['data_per_page'];
				$_SESSION['sys_account_mode'] = 'user';
				$status = $data['user_status'];
				$GLOBALS['user_permissions_arr'] = array_filter(explode(',',$data['permissions']));
				$_SESSION['is_locked'] = false;
				//setcookie('sys_goop_language', $GLOBALS['language'], time() + (86400 * 30), "/");
			}
			
			if(password_verify($upass, $user_password)){
				//goToPage(true);
				getStatus($pdo,0,$permissions_arr,$lockout_timestamp,"user",$user_id);
			}else{
				$attempts = checkAttempts($pdo,$uname);

				if($attempts >= 5){

					if($lockout_timestamp == NULL){
						
						$time_lock = date('Y-m-d H:i:s', strtotime('+1 hour'));
						$sql = $pdo->prepare("UPDATE users SET user_status = 1.5, lockout_timestamp = '$time_lock' WHERE user_email = :user_email");
						$sql->bindParam(":user_email",$uname);
						$sql->execute();

					}
					$_SESSION['sys_login_err'] = renderLang($login_msg_err_8); // "Account is locked due to multiple failed log-in.<br>Please wait for one hour login again"
					$_SESSION['is_locked'] = true;
					goToPage(false);
					
					
				}else{
					$_SESSION['sys_login_err'] = renderLang($login_msg_err_3);
					//$_SESSION['sys_login_err'] = $attempts.' '.renderLang($login_msg_err_attempts); //2 out of 5 attempts.<br> Invalid email or password!."
					$_SESSION['is_locked'] = false;
					goToPage(false);
				}
			}


		}

	}
}


function getStatus($pdo,$status,$permissions_arr,$lockedTime,$isAdmin,$id){

	if($status == 0){//ACTIVE
		
		//updateAttemptsAndStatus($pdo,$_SESSION['sys_id'],$_SESSION['sys_account_mode']);
		
		// if(isset($_POST['remember_me'])) {
		// 	// set cookie for login type (username or email) and password
		// 	setcookie('sys_goop', $GLOBALS['uname'].'|'.$GLOBALS['upass'], time() + (86400 * 30), "/"); // set for 1 month
		// } else {
		// 	unsetCookie('sys_goop'); // remove cookie if not checked
		// }

		// set epoch time for last login
		$last_login = time();

		switch($isAdmin) {
			
			case 'admin':
				
				// set role array session
				$_SESSION['sys_permissions'] = array();

				// get all permissions
				foreach($permissions_arr as $permissions_group) {
					foreach($permissions_group as $permission) {
						array_push($_SESSION['sys_permissions'],$permission['permission_code']);
					}
				}

				// update last login
				$sql = $pdo->prepare("UPDATE admins SET admin_last_login=".$last_login." WHERE admin_id= :admin_id");
				$sql->bindParam(":admin_id",$id);
				$sql->execute();
				
//				$checkAdmin = checkSecurityQuestion($pdo,'admin',$id);
//				if($checkAdmin){
					goToPage(true);
					
//				}else{
//					header('location: /settings');
//				}	
				
				break;

			case 'user':
				
				// check if there is a role set (requires at least one role per account)
				if($_SESSION['sys_role_ids'] != ',') {

					// set role array session
					$_SESSION['sys_permissions'] = array();

					// all permission toggle
					$all_permission = 0;

					// create where clause for multiple roles
					$where = '';
					
					$role_ids_arr = explode(',',$_SESSION['sys_role_ids']);
					foreach($role_ids_arr as $role_id) {
						if($role_id != '') { // removes the beginning and end blanks from array
							if($where == '') {
								$where = ' WHERE role_id='.$role_id;
							} else {
								$where .= ' OR role_id='.$role_id;
							}
						}
					}
					
					// get permissions based on role_ids
					$sql = $pdo->prepare("SELECT role_id, permissions FROM roles".$where);
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

					// add permissions from account
					if(count($GLOBALS['user_permissions_arr']) > 0) {
						foreach($GLOBALS['user_permissions_arr'] as $permission) {
							if(!in_array($permission,$_SESSION['sys_permissions'])) {
								array_push($_SESSION['sys_permissions'],$permission);
							}
						}
					}

					// get all permissions
					if($all_permission) {
						foreach($permissions_arr as $permissions_group) {
							foreach($permissions_group as $permission) {
								array_push($_SESSION['sys_permissions'],$permission['permission_code']);
							}
						}
					}

					// update last login
					$sql = $pdo->prepare("UPDATE users SET user_last_login=".$last_login." WHERE user_id= :user_id");
					$sql->bindParam(":user_id",$id);
					$sql->execute();
					
//					$checkUser= checkSecurityQuestion($pdo,'user',$id);
//					if($checkUser){
							goToPage(true);
//						}else{
//							header('location: /settings');
//						}
				} else { // else redirect to login page and display error details
					global $login_msg_err_5;
					$_SESSION['sys_login_err'] = renderLang($login_msg_err_5); // "The account has no set role.<br>Please contact your web administrator."
					goToPage(false);

				}

				break;
		}

	}
	else if($status==1){// DEACTIVATED

		global $login_msg_err_6;
		$_SESSION['sys_login_err'] = renderLang($login_msg_err_6); // "Account deactivated. Please contact your web administrator."
		goToPage(false);


	// }else if($status==1.5){// LOCKED

	// 	//$currentDateTime = getServerTime($pdo);
	// 	$currentDateTime = date('Y-m-d H:i:s');
	// 	if(strtotime($currentDateTime) >= strtotime($lockedTime)){
			
	// 		updateAttemptsAndStatus($pdo,$_SESSION['sys_id'],$_SESSION['sys_account_mode']);
	// 		getStatus($pdo,0,$permissions_arr,$lockedTime,$isAdmin,$id);
	// 	}else{

	// 		global $login_msg_err_8;
	// 		$_SESSION['sys_login_err'] = renderLang($login_msg_err_8); // "Account is locked due to multiple failed log-in.<br>Please wait for one hour login again"
	// 		//$_SESSION['sys_login_err'] = "current time: ".$currentDateTime."<br>locked time: ".$lockedTime;
	// 		goToPage(false);
	// 	}


	}else if ($status==2){// DELETED

		global $login_msg_err_7;
		$_SESSION['sys_login_err'] = renderLang($login_msg_err_7); // "Account deleted. Please contact your web administrator."
		goToPage(false);

	}else{

		global $login_msg_err_3;
		$_SESSION['sys_login_err'] = renderLang($login_msg_err_3); // "Invalid email or password."
		goToPage(false);

	}
	//echo $_SESSION['sys_login_err'];
}

function goToPage($value){
	if($value){
		header('location: /dashboard');
	}else{
		unset($_SESSION['sys_id']);
		header('location: /login');
	}
}

function getServerTime($pdo){
	$sql = $pdo->prepare("Select NOW() as curTime");
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){
		$formattedTime = date('Y-m-d H:i:s', strtotime($data['curTime']));
		return $formattedTime;
		//return $data['curTime'];
	}
	//to test, comment the above code and uncomment the return code below, and also copy the lockout_timestamp in database
	//return "2020-05-19 15:08:20";
}

function checkAttempts($pdo,$username){

	$sql = $pdo->prepare("SELECT admin_log_attempts FROM admins WHERE admin_username = :admin_username ");
	$sql->bindParam(":admin_username",$username);
	$sql->execute();
	$isInside = false;
	$currentAttempts = 0;
	while($data = $sql->fetch(PDO::FETCH_ASSOC)){

		$currentAttempts = $data['admin_log_attempts']; 
		$isInside = true;
	}
	if($isInside){


		$newAttempt = $currentAttempts + 1;

		if($newAttempt > 5){
			$newAttempt = 5;
		}

		$sql = $pdo->prepare("UPDATE admins SET admin_log_attempts = :attempts WHERE admin_username = :admin_username");
		$bind_param = array(
			':admin_username' => $username,
			':attempts'       => $newAttempt
		);
		$sql->execute($bind_param);

		return $newAttempt;

	}else{

		$sql = $pdo->prepare("SELECT user_log_attempts FROM users WHERE user_email = :user_email ");
		$sql->bindParam(":user_email",$username);
		$sql->execute();

		while($data = $sql->fetch(PDO::FETCH_ASSOC)){

			$currentAttempts = $data['user_log_attempts'];

		}

		$newAttempt = $currentAttempts + 1;

		if($newAttempt > 5){
			$newAttempt = 5;
		}

		$sql_attempts = $pdo->prepare("UPDATE users SET user_log_attempts = :attempts WHERE user_email = :user_email");
		$bind_param = array(
			':user_email'     => $username,
			':attempts'       => $newAttempt
		);
		$sql_attempts->execute($bind_param);

		return $newAttempt;
	}

}

function updateAttemptsAndStatus($pdo,$account_id,$account){
	$sql = $pdo->prepare("UPDATE ".$account."s SET ".$account."_status = 0, ".$account."_log_attempts = 0, lockout_timestamp = NULL WHERE ".$account."_id = :".$account."_id");
	$sql->bindParam(":".$account."_id",$account_id);
	$sql->execute();
}