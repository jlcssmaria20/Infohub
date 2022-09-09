<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');


// check if user has existing session
if(checkSession()) {


	$teams_arr = getTable('teams');
	
	$data_count = 0;
	$sql = $pdo->prepare("SELECT * FROM users  ORDER BY user_status ASC, user_lastname ASC LIMIT 200");
	$bind_param = array(
		':center_id' => $center_id
	);
	$sql->execute($bind_param);

	while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

		$data_count++;
		$user_id = encryptID($data['user_id'], 'users');

		echo '<tr>';

		// EMPLOYEE ID
		echo '<td><a href="/user/'.$user_id.'">'.$data['user_employee_id'].'</a></td>';

		// LASTNAME
		echo '<td><a href="/user/'.$user_id.'">'.$data['user_lastname'].'</a></td>';

		// FIRSTNAME
		echo '<td><a href="/user/'.$user_id.'">'.$data['user_firstname'].'</a></td>';

		// USER NAME
		echo '<td>'.$data['user_email'].'</a></td>';

		// DESIGNATION
		echo '<td>';
		foreach($teams_arr as $team) {
			if($team['team_id'] == $data['team_id']) {
				echo ' - '.$team['team_name'];
				break;
			}
		}
		echo '</td>';

		// ROLES
		echo '<td>';
		$user_roles_display_arr = array();
		$user_roles_arr = explode(',',$data['role_ids']);
		foreach($user_roles_arr as $user_role) {
			if($user_role != '') {
				$_data = getData($user_role,'roles','role');
				array_push($user_roles_display_arr,$_data['role_name']);
			}
		}
		echo implode($user_roles_display_arr,', ');
		echo '</td>';

		// STATUS
		echo '<td>';
		foreach($status_arr as $status) {
			if($status[0] == $data['user_status']) {
				switch($data['user_status']) {
					case 0:
						echo '<span class="text-success">'.renderLang($status[1]).'</span>';
						break;
					case 1:
						echo '<span class="text-warning">'.renderLang($status[1]).'</span>';
						break;
					case 1.5:
						echo '<span class="text-danger">'.renderLang($status[1]).'</span>';
						break;
					case 2:
						echo '<span class="text-danger">'.renderLang($status[1]).'</span>';
						break;
				}
			}
		}
		echo '</td>';

		// LAST LOGIN
		echo '<td>';
		if($data['user_last_login'] > 0) {
			echo date('Ymd',$data['user_last_login']).' &middot; '.date('H:i:s',$data['user_last_login']);
		} else {
			echo '-';
		}
		echo '</td>';

		// OPTIONS
		echo '<td class="data-options">';

		// EDIT USER
		echo '<a href="/user/'.$user_id.'" class="btn btn-primary btn-xs" title="'.renderLang($users_view_user).'" style="padding: 1.5px 7px;" target="_blank"><i class="fa fa-info" aria-hidden="true"></i></a>';

		if(checkPermission('user-edit')) {
			echo '<a href="/edit-user/'.$user_id.'" class="btn btn-success btn-xs" title="'.renderLang($users_edit_user).'" target="_blank"><i class="fa fa-pencil-alt"></i></a>';
		}

		if(checkPermission('actual-time-records-others')) {
			echo '<a href="/actual-time-record/'.$user_id.'" class="btn btn-warning btn-xs" title="'.renderLang($users_view_actual_time).'" target="_blank"><i class="fa fa-clock"></i></a>';
		}

		echo '</td>'; // end options

		echo '</tr>';
	}

	} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /login');

	}

?>