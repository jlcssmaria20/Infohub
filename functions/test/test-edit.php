<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('test-edit')) {

		// set page
		$page = 'test';
	
		$err = 0;
		$test_id = decryptID($_GET['id']);
		
		// check if ID exists
		$sql = $pdo->prepare("SELECT * FROM test WHERE id = :test_id LIMIT 1");
		$sql->bindParam(":test_id",$test_id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		if($sql->rowCount()) {

			// PROCESS FORM

			// USERNAME
			$username = '';
			if(isset($_POST['username'])) {
				$username = htmlentities(trim($_POST['username']));
				$username = str_replace(' ','',$username);
				$_SESSION['sys_test_edit_username_val'] = $username;
				if(strlen($username) == 0) {
					$err++;
					$_SESSION['sys_test_edit_username_err'] = renderLang($test_username_required);
				} else {
					
					// check if username already exists
					$sql2 = $pdo->prepare("SELECT id, test_username, temp_del FROM test WHERE test_username = :test_username AND id <> :test_id LIMIT 1");
					$bind_param = array(
						':test_id'         => $test_id,
						':test_username'   => $username
					);
					$sql2->execute($bind_param);
					if($sql2->rowCount()) {
						$err++;
						$_SESSION['sys_test_edit_username_err'] = renderLang($test_username_exists);
					}
				}
			}

			// FIRSTNAME
			$firstname = '';
			if(isset($_POST['firstname'])) {
				$firstname = ucwords(strtolower(trim($_POST['firstname'])));
				$_SESSION['sys_test_edit_firstname_val'] = $firstname;
				if(strlen($firstname) == 0) {
					$err++;
					$_SESSION['sys_test_edit_firstname_err'] = renderLang($test_firstname_required);
				} else {
					if(!validateNameV1($firstname)) {
						$err++;
						$_SESSION['sys_test_edit_firstname_err'] = renderLang($lang_invalid_characters);
					}
				}
			}

			// LASTNAME
			$lastname = '';
			if(isset($_POST['lastname'])) {
				$lastname = ucwords(strtolower(trim($_POST['lastname'])));
				$_SESSION['sys_test_edit_lastname_val'] = $lastname;
				if(strlen($lastname) == 0) {
					$err++;
					$_SESSION['sys_test_edit_lastname_err'] = renderLang($test_lastname_required);
				} else {
					if(!validateNameV1($lastname)) {
						$err++;
						$_SESSION['sys_test_edit_lastname_err'] = renderLang($lang_invalid_characters);
					}
				}
			}

			// STATUS
			$test_status = 0;
			if(isset($_POST['test_status'])) {
				$test_status = trim($_POST['test_status']);
				$_SESSION['sys_test_edit_status_val'] = $test_status;
				$test_status_exists = 0;
				foreach($status_arr as $status_data) {
					if($status_data[0] == $test_status) {
						$test_status_exists = 1;
					}
				}
				if(!$test_status_exists) {
					$err++;
					$_SESSION['sys_test_edit_status_err'] = 'Please select a valid status.';
				}
			}

			// VALIDATE FOR ERRORS
			if($err == 0) { // there are no errors

				// check for changes
				$change_logs = array();
				if($username != $data['test_username']) {
					$tmp = 'test_username::'.$data['test_username'].'=='.$username;
					array_push($change_logs,$tmp);
				}
				if($firstname != $data['test_firstname']) {
					$tmp = 'test_firstname::'.$data['test_firstname'].'=='.$firstname;
					array_push($change_logs,$tmp);
				}
				if($lastname != $data['test_lastname']) {
					$tmp = 'test_lastname::'.$data['test_lastname'].'=='.$lastname;
					array_push($change_logs,$tmp);
				}
				if($test_status != $data['test_status']) {
					echo $test_status.' '.$data['test_status'];
					$tmp = 'lang_status::'.$data['test_status'].'=='.$test_status;
					array_push($change_logs,$tmp);
				}

				// check if there is are changes made
				if(count($change_logs) > 0) {

					// update account language table
					$sql = $pdo->prepare("UPDATE test SET
						test_username = :test_username,
						test_firstname = :test_firstname,
						test_lastname = :test_lastname,
						test_status = :test_status
					    WHERE id = :test_id");
					
					$bind_param = array(
						':test_id'         => $test_id,
						':test_username'   => $username,
						':test_firstname'  => $firstname,
						':test_lastname'   => $lastname,
						':test_status'     => $test_status
					);
					$sql->execute($bind_param);
					
					// record to system log
					// $change_log = implode(';;',$change_logs);
					// systemLog('test',$test_id,'update',$change_log);

					$_SESSION['sys_test_edit_suc'] = renderLang($test_updated);

				} else { // no changes made

					$_SESSION['sys_test_edit_err'] = renderLang($form_no_changes);

				}

			} else { // error found

				$_SESSION['sys_test_edit_err'] = renderLang($form_error);

			}

		} else {

			$_SESSION['sys_test_edit_err'] = renderLang($form_id_not_found);

		}
			
		header('location: /edit-test/'.encryptID($test_id));
		
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}
?>