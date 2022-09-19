<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('team-add')) {
	
		$err = 0;
		
		// PROCESS FORM
		
		// name
		$team_name = '';
		if(isset($_POST['team_name'])) {
			$team_name = $_POST['team_name'];
			// $team_name = htmlentities(trim($_POST['team_name']));
			// $team_name = str_replace(' ','',$team_name);
			$_SESSION['sys_team_add_name_val'] = $team_name;
			if(strlen($team_name) == 0) {
				$err++;
				$_SESSION['sys_team_add_name_err'] = renderLang($team_name_required);
			} else {
				
				// check if employee ID already exists
				$sql = $pdo->prepare("SELECT team_name, temp_del FROM teams WHERE team_name = :team_name AND temp_del=0 LIMIT 1");
				$bind_param = array(
					':team_name' => $team_name
				);
				$sql->execute($bind_param);
				if($sql->rowCount() > 0) {
					$err++;
					$_SESSION['sys_team_add_name_err'] = renderLang($team_name_exists);
				}
			}
		}
		
		
		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors
			
			// insert in table
			$sql = $pdo->prepare("INSERT INTO teams(
					id,
					team_name
				) VALUES(
					NULL,
					:team_name
				)");
			$bind_param = array(
				':team_name'   => $team_name
			);
			
			$sql->execute($bind_param);
			// $sql->debugDumpParams();

			
			
			// get ID of new team
			// $sql = $pdo->prepare("SELECT team_id, team_name FROM team WHERE team_name = :team_name LIMIT 1");
			// $bind_param = array(
			// 	':team_name'   => $team_name
			// );
			// $sql->execute($bind_param);
			// $data = $sql->fetch(PDO::FETCH_ASSOC);
			
			// record to system log
			//systemLog('team',$data['team_id'],'add','');

			$_SESSION['sys_team_suc'] = renderLang($team_added);
			header('location: /teams');
			
		} else { // error found
			
			$_SESSION['sys_team_add_err'] = renderLang($form_error);
			header('location: /add-team');
			
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