<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('team-edit')) {

		// set page
		$page = 'teams';
	
		$err = 0;
		$team_id = decryptID($_GET['id']);
		
		// check if ID exists
		$sql = $pdo->prepare("SELECT * FROM teams WHERE id = :team_id LIMIT 1");
		$sql->bindParam(":team_id",$team_id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		if($sql->rowCount()) {

			// PROCESS FORM

			// name
			$team_name = '';
			if(isset($_POST['team_name'])) {
				$team_name = $_POST['team_name'];
				// $team_name = htmlentities(trim($_POST['team_name']));
				// $team_name = str_replace(' ','',$team_name);
				$_SESSION['sys_team_edit_name_val'] = $team_name;
				if(strlen($team_name) == 0) {
					$err++;
					$_SESSION['sys_team_edit_name_err'] = renderLang($team_name_required);
				} else {
					
					// check if name already exists
					$sql2 = $pdo->prepare("SELECT team_name, temp_del FROM teams WHERE team_name = :team_name LIMIT 1");
					$bind_param = array(
						':team_name'   => $team_name
					);
					$sql2->execute($bind_param);
					if($sql2->rowCount()) {
						$err++;
						$_SESSION['sys_team_edit_name_err'] = renderLang($team_name_exists);
					}
				}
			}

			// STATUS
			// $team_status = 0;
			// if(isset($_POST['team_status'])) {
			// 	$team_status = trim($_POST['team_status']);
			// 	$_SESSION['sys_team_edit_status_val'] = $team_status;
			// 	$team_status_exists = 0;
			// 	foreach($status_arr as $status_data) {
			// 		if($status_data[0] == $team_status) {
			// 			$team_status_exists = 1;
			// 		}
			// 	}
			// 	if(!$team_status_exists) {
			// 		$err++;
			// 		$_SESSION['sys_team_edit_status_err'] = 'Please select a valid status.';
			// 	}
			// }

			// VALIDATE FOR ERRORS
			if($err == 0) { // there are no errors

				// check for changes
				$change_logs = array();
				if($team_name != $data['team_name']) {
					$tmp = 'team_name::'.$data['team_name'].'=='.$team_name;
					array_push($change_logs,$tmp);
				}

				// check if there is are changes made
				if(count($change_logs) > 0) {

					// update account language table
					$sql = $pdo->prepare("UPDATE teams SET
						team_name = :team_name
					    WHERE id = :team_id");
					
					$bind_param = array(
						':team_id'         => $team_id,
						':team_name'   => $team_name
					);
					$sql->execute($bind_param);
					
					// record to system log
					// $change_log = implode(';;',$change_logs);
					// systemLog('team',$team_id,'update',$change_log);

					$_SESSION['sys_team_edit_suc'] = renderLang($team_updated);

				} else { // no changes made

					$_SESSION['sys_team_edit_err'] = renderLang($form_no_changes);

				}

			} else { // error found

				$_SESSION['sys_team_edit_err'] = renderLang($form_error);

			}

		} else {

			$_SESSION['sys_team_edit_err'] = renderLang($form_id_not_found);

		}
			
		header('location: /edit-team/'.encryptID($team_id));
		
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}
?>