<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('test-add')) {
	
		$err = 0;
		
		// PROCESS FORM
		
		// USERNAME
		$username = '';
		if(isset($_POST['username'])) {
			$username = htmlentities(trim($_POST['username']));
			$username = str_replace(' ','',$username);
			$_SESSION['sys_test_add_username_val'] = $username;
			if(strlen($username) == 0) {
				$err++;
				$_SESSION['sys_test_add_username_err'] = renderLang($test_username_required);
			} else {
				
				// check if employee ID already exists
				$sql = $pdo->prepare("SELECT test_username, temp_del FROM test WHERE test_username = :test_username AND temp_del=0 LIMIT 1");
				$bind_param = array(
					':test_username' => $username
				);
				$sql->execute($bind_param);
				if($sql->rowCount() > 0) {
					$err++;
					$_SESSION['sys_test_add_username_err'] = renderLang($test_username_exists);
				}
			}
		}
		
		// FIRSTNAME
		$firstname = '';
		if(isset($_POST['firstname'])) {
			$firstname = ucwords(strtolower(trim($_POST['firstname'])));
			$_SESSION['sys_test_add_firstname_val'] = $firstname;
			if(strlen($firstname) == 0) {
				$err++;
				$_SESSION['sys_test_add_firstname_err'] = renderLang($test_firstname_required);
			} else {
				if(!validateNameV1($firstname)) {
					$err++;
					$_SESSION['sys_test_add_firstname_err'] = renderLang($lang_invalid_characters);
				}
			}
		}
		
		// LASTNAME
		$lastname = '';
		if(isset($_POST['lastname'])) {
			$lastname = ucwords(strtolower(trim($_POST['lastname'])));
			$_SESSION['sys_test_add_lastname_val'] = $lastname;
			if(strlen($lastname) == 0) {
				$err++;
				$_SESSION['sys_test_add_lastname_err'] = renderLang($test_lastname_required);
			} else {
				if(!validateNameV1($lastname)) {
					$err++;
					$_SESSION['sys_test_add_lastname_err'] = renderLang($lang_invalid_characters);
				}
			}
		}
		
		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors
			
			// insert in table
			$sql = $pdo->prepare("INSERT INTO test(
					id,
					test_username,
					test_firstname,
					test_lastname
				) VALUES(
					NULL,
					:test_username,
					:test_firstname,
					:test_lastname
				)");
			$bind_param = array(
				':test_username'   => $username,
				':test_firstname'  => $firstname,
				':test_lastname'   => $lastname
			);
			
			$sql->execute($bind_param);
			// $sql->debugDumpParams();

			
			
			// get ID of new test
			// $sql = $pdo->prepare("SELECT test_id, test_username FROM test WHERE test_username = :test_username LIMIT 1");
			// $bind_param = array(
			// 	':test_username'   => $username
			// );
			// $sql->execute($bind_param);
			// $data = $sql->fetch(PDO::FETCH_ASSOC);
			
			// record to system log
			//systemLog('test',$data['test_id'],'add','');

			$_SESSION['sys_test_suc'] = renderLang($test_added);
			header('location: /test');
			
		} else { // error found
			
			$_SESSION['sys_test_add_err'] = renderLang($form_error);
			header('location: /test-add');
			
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