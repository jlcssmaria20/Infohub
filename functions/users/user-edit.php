<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('user-edit')) {
	
		$err = 0;
		$user_id = decryptID($_POST['id'], 'users');
		
		// check if ID exists
		$sql = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id LIMIT 1");
		$sql->bindParam(":user_id", $user_id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		$invalid = "Invalid Characters!";
		if($sql->rowCount()) {

			// PROCESS FORM

			// team & TEAM & DEPARTMENT & CENTER
			$team_id = 0;
			if(isset($_POST['team_id'])) {
				$team_id = strtoupper(trim($_POST['team_id']));
				if((strlen($team_id) == 0) || $team_id == 0 )  {
					$err++;
					$_SESSION['sys_users_edit_team_id_err'] = renderLang($users_team_id_required);
				} else {

					$_SESSION['sys_users_edit_team_id_val'] = $team_id;

					$sql = $pdo->prepare("SELECT id, temp_del FROM teams WHERE id = :team_id AND temp_del = 0 LIMIT 1");
					$sql->bindParam(":team_id",$team_id);
					$sql->execute();
					if(!$sql->rowCount()) {
						$err++;
						$_SESSION['sys_users_edit_team_id_err'] = renderLang($users_invalid_team_selection);
					} else {
						$_data = $sql->fetch(PDO::FETCH_ASSOC);
						$team_id = $_data['id'];
					}
				}
			}

			// EMPLOYEE ID
			$employee_id = '';
			if(isset($_POST['employee_id'])) {
				$employee_id = trim($_POST['employee_id']);
				$_SESSION['sys_users_edit_employee_id_val'] = $employee_id;
				if(strlen($employee_id) == 0) {
					$err++;
					$_SESSION['sys_users_edit_employee_id_err'] = renderLang($users_employee_id_required);
				} else {

					// check if employee ID already exists
					$sql = $pdo->prepare("SELECT user_id, user_employee_id, temp_del FROM users WHERE user_employee_id = :user_employee_id AND user_id <> :user_id AND temp_del=0 LIMIT 1");
					$bind_param = array(
						':user_id'          => $user_id,
						':user_employee_id' => $employee_id
					);
					$sql->execute($bind_param);
					if($sql->rowCount()) {
						$err++;
						$_SESSION['sys_users_edit_employee_id_err'] = renderLang($users_employee_id_exists);
					}
				}
			}
			// $checkStartingNumber = substr($mobile, 0,2);
			// strpos($checkStartingNumber, '09') === false
			// EMAIL
			$email = '';
			if(isset($_POST['email'])) {
				$email = htmlentities(strtolower(trim($_POST['email'])));

				$atCount = strpos($email,"@");
				$emailChecker = substr($email,$atCount);

				$_SESSION['sys_users_edit_email_val'] = $email;
				if(strlen($email) == 0) {
					$err++;
					$_SESSION['sys_users_edit_email_err'] = renderLang($users_email_required);
				}

				elseif (strpos($emailChecker, '@trans-cosmos.co.jp') === false) {
					$err++;
					$_SESSION['sys_users_edit_email_err'] = renderLang($use_company_email);
				}
				
				else {
					
					// check if email already in use
					$sql = $pdo->prepare("SELECT user_email, temp_del FROM users WHERE user_email = :user_email AND user_id <> :user_id AND temp_del = 0 LIMIT 1");
					$bind_param = array(
						':user_id'    => $user_id,
						':user_email' => $email
					);
					$sql->execute($bind_param);
					
					
					if($sql->rowCount()) {
						$err++;
						$_SESSION['sys_users_edit_email_err'] = renderLang($users_email_alread_in_use);
					}
				}
			}

			
			// NICKNAME
			$nickname = '';
			if(isset($_POST['nickname'])) {
				$nickname = htmlentities(ucwords(trim($_POST['nickname'])));
				$_SESSION['sys_users_edit_nickname_val'] = $nickname;
				if(strlen($nickname) == 0) {
					$err++;
					$_SESSION['sys_users_edit_nickname_err'] = renderLang($users_nickname_required);
				} else {
					if(!validateNameV1($nickname)) {
						$err++;
						$_SESSION['sys_users_edit_nickname_err'] = $invalid;
					}
				}
			}

			// FIRSTNAME
			$firstname = '';
			if(isset($_POST['firstname'])) {
				$firstname = htmlentities(ucwords(trim($_POST['firstname'])));
				$_SESSION['sys_users_edit_firstname_val'] = $firstname;
				if(strlen($firstname) == 0) {
					$err++;
					$_SESSION['sys_users_edit_firstname_err'] = renderLang($users_firstname_required);
				} else {
					if(!validateNameV1($firstname)) {
						$err++;
						$_SESSION['sys_users_edit_firstname_err'] = $invalid;
					}
				}
			}

			// MIDDLENAME
			$middlename = '';
			if(isset($_POST['middlename'])) {
				$middlename = htmlentities(ucwords(trim($_POST['middlename'])));
				$_SESSION['sys_users_edit_middlename_val'] = $middlename;
				if(!validateNameV1($middlename)) {
					$err++;
					$_SESSION['sys_users_edit_middlename_err'] = $invalid;
				}
			}

			// LASTNAME
			$lastname = '';
			if(isset($_POST['lastname'])) {
				$lastname = htmlentities(ucwords(trim($_POST['lastname'])));
				$_SESSION['sys_users_edit_lastname_val'] = $lastname;
				if(strlen($lastname) == 0) {
					$err++;
					$_SESSION['sys_users_edit_lastname_err'] = renderLang($users_lastname_required);
				} else {
					if(!validateNameV1($lastname)) {
						$err++;
						$_SESSION['sys_users_edit_lastname_err'] = $invalid;
					}
				}
			}
			
			// GENDER
			$gender =0;
			if(isset($_POST['gender'])) {
				$gender = trim($_POST['gender']);
				$_SESSION['sys_users_edit_gender_val'] = $gender;
				$gender_exists = 0;
				foreach($gender_arr as $gender_data) {
					if($gender_data[0] == $gender_exists) {
						$gender_exists = 1;
					}
				}
				if(!$gender_exists) {
					$err++;
					$_SESSION['sys_users_edit_gender_err'] = renderLang($users_invalid_gender);
				}
			}

			// MOBILE
			$user_mobile = '';
			if(isset($_POST['user_mobile'])) {
				$user_mobile = trim($_POST['user_mobile']);
				if (!preg_match('/^[0-9]*$/', $user_mobile)) {
					$err++;
					$_SESSION['sys_users_edit_user_mobile_err'] = renderLang($users_mobile_err);
				}else{
					$_SESSION['sys_users_edit_user_mobile_val'] = $user_mobile;
				}
			}
			
			// POSITION
			$position_id = 0;
			if(isset($_POST['position_id'])) {

				$position_id = ucwords(strtolower(trim($_POST['position_id'])));
				$_SESSION['sys_users_edit_position_val'] = $position_id;
				if(strlen($position_id) == 0) {
					$err++;
					$_SESSION['sys_users_edit_position_err'] = renderLang($users_position_id_required);
				} else {
					$_SESSION['sys_users_edit_position_val'] = $position_id;
				}
			}

			// ROLES
			$role_ids = ',';
			if(isset($_POST['role_ids'])) {
				$role_ids = trim($_POST['role_ids']);
				if(strlen($role_ids) == 0) {
					$err++;
					$_SESSION['sys_users_edit_roles_err'] = renderLang($users_role_required);
				} else {
					$_SESSION['sys_users_edit_roles_val'] = $role_ids;
				}
			}

			// HIRE DATE
			$user_hiredate = 0;
			if(isset($_POST['user_hiredate'])) {

				$user_hiredate = date('Ymd', strtotime($_POST['user_hiredate']));
				if(strlen($user_hiredate) == 0) {
					$err++;
					$_SESSION['sys_users_edit_hiredate_err'] = renderLang($users_hiredate_required);
				} else {
					$_SESSION['sys_users_edit_hiredate_val'] = $_POST['user_hiredate'];
				}
			}
			
			// END DATE
		/* 	$user_enddate = 0;
			if(isset($_POST['user_enddate'])) {
				$user_enddate = date('Ymd', strtotime($_POST['user_enddate']));
				if(empty($user_enddate)) {
					$user_enddate = 0;
				} else {
					$_SESSION['sys_users_edit_enddate_val'] = $_POST['user_enddate'];
				}
			}
 */
			// MANTRA IN LIFE
			$mantra_in_life = '';
			if(isset($_POST['mantra_in_life'])) {
				$mantra_in_life = $_POST['mantra_in_life'];
				$_SESSION['sys_users_edit_mantra_in_life_val'] = $mantra_in_life;
				if(strlen($mantra_in_life) == 0) {
					$mantra_in_life = 'NA';
				}  else {
					if(!validateNameV1($mantra_in_life)) {
						$err++;
						$_SESSION['sys_users_edit_mantra_in_life_err'] = "Invalid Characters!";
					}
				}
			}

			// SKILLS
			$skills = '';
			if(isset($_POST['skills'])) {
				$skills = $_POST['skills'];
				$_SESSION['sys_users_edit_skills_val'] = $skills;
				if(strlen($skills) == 0) {
					$skills = 'NA';
				}  else {
					if(!validateNameV1($skills)) {
						$err++;
						$_SESSION['sys_users_edit_skills_err'] = "Invalid Characters!";
					}
				}
			}
			
			// STATUS
			$user_status = 0;
			if(isset($_POST['user_status'])) {
				$user_status = trim($_POST['user_status']);
				$_SESSION['sys_users_edit_user_status_val'] = $user_status;
				$user_status_exists = 0;
				foreach($status_arr as $status_data) {
					if($status_data[0] == $user_status) {
						$user_status_exists = 1;
					}
				}
				if(!$user_status_exists) {
					$err++;
					$_SESSION['sys_users_edit_user_status_err'] = 'Please select a valid status.';
				}
			}

			$user_enddate = 0;
			if ($user_status == 1) {
				$date = new DateTime();
				$user_enddate  = $date->format('Ymd');
			}else{
				$user_enddate = 0;
			}

			$user_photo_is_default = 0;
			$user_photo = '';
			//check if user photo is the default photo that was set by system
			if(($data['user_photo'] == 'avatar2.png') || ($data['user_photo'] == 'avatar5.png')){
				$user_photo_is_default = 1;
			}
			// VALIDATE FOR ERRORS
			if($err == 0) { // there are no errors

				$role_ids = ','.$role_ids.',';

				// check for changes
				$change_logs = array();
				if($team_id != $data['team_id']) {
					$tmp = 'users_team_team::'.$data['team_id'].'=='.$team_id;
					array_push($change_logs,$tmp);
				}
				if($employee_id != $data['user_employee_id']) {
					$tmp = 'users_employee_id::'.$data['user_employee_id'].'=='.$employee_id;
					array_push($change_logs,$tmp);
				}
				if($email != $data['user_email']) {
					$tmp = 'users_email::'.$data['user_email'].'=='.$email;
					array_push($change_logs,$tmp);
				}
				if($gender != $data['user_gender']) {
					$tmp = 'users_gender::'.$data['user_gender'].'=='.$gender;
					array_push($change_logs,$tmp);
					if($user_photo_is_default){
						if($gender == 0){
							$user_photo = 'avatar2.png';
							$_SESSION['sys_photo'] = '/assets/images/team-images/'.$user_photo;
						} else {
							$user_photo = 'avatar5.png';
							$_SESSION['sys_photo'] = '/assets/images/team-images/'.$user_photo;
						}
					} else {
						$user_photo = $data['user_photo'];
					}			
				}
				if($position_id != $data['user_position']) {
					$tmp = 'users_position::'.$data['user_position'].'=='.$position_id;
					array_push($change_logs,$tmp);
				}
				if($nickname != $data['user_nickname']) {
					$tmp = 'users_nickname::'.$data['user_nickname'].'=='.$nickname;
					array_push($change_logs,$tmp);
				}
				if($firstname != $data['user_firstname']) {
					$tmp = 'users_firstname::'.$data['user_firstname'].'=='.$firstname;
					array_push($change_logs,$tmp);
				}
				if($middlename != $data['user_middlename']) {
					$tmp = 'users_middlename::'.$data['user_middlename'].'=='.$middlename;
					array_push($change_logs,$tmp);
				}
				if($lastname != $data['user_lastname']) {
					$tmp = 'users_lastname::'.$data['user_lastname'].'=='.$lastname;
					array_push($change_logs,$tmp);
				}
				if($user_mobile != $data['user_mobile']) {
					$tmp = 'users_mobile::'.$data['user_mobile'].'=='.$user_mobile;
					array_push($change_logs,$tmp);
				}
				if($role_ids != $data['role_ids']) {
					$tmp = 'roles_roles::'.$data['role_ids'].'=='.$role_ids;
					array_push($change_logs,$tmp);
				}
				if($user_status != $data['user_status']) {
					$tmp = 'lang_status::'.$data['user_status'].'=='.$user_status;
					array_push($change_logs,$tmp);
				}
				if($user_hiredate != $data['user_hiredate']) {
					$tmp = 'users_hiredate::'.$data['user_hiredate'].'=='.$user_hiredate;
					array_push($change_logs,$tmp);
				}
				if($user_enddate != $data['user_enddate']) {
					$tmp = 'users_enddate::'.$data['user_enddate'].'=='.$user_enddate;
					array_push($change_logs,$tmp);
				}
				if($user_mantra_in_life != $data['user_mantra_in_life']) {
					$tmp = 'users_mantra::'.$data['user_mantra_in_life'].'=='.$user_mantra_in_life;
					array_push($change_logs,$tmp);
				}
				if($user_skills != $data['user_skills']) {
					$tmp = 'users_skills::'.$data['user_skills'].'=='.$user_skills;
					array_push($change_logs,$tmp);
				}

				// check if there is are changes made
				if(count($change_logs) > 0) {
					if($user_photo_is_default){
						if($gender == 0){
							$user_photo = 'avatar2.png';
							$_SESSION['sys_photo'] = '/assets/images/team-images/'.$user_photo;
						} else {
							$user_photo = 'avatar5.png';
							$_SESSION['sys_photo'] = '/assets/images/team-images/'.$user_photo;
						}
					} else {
						$user_photo = $data['user_photo'];
					}			
					// update account language table
					$sql = $pdo->prepare("UPDATE users SET
							user_employee_id = :user_employee_id,
							user_email = :user_email,
							user_firstname = :user_firstname,
							user_middlename = :user_middlename,
							user_lastname = :user_lastname,
							user_nickname = :user_nickname,
							user_photo = :user_photo,
							user_gender = :user_gender,
							user_mobile = :user_mobile,
							user_position = :user_position,
							team_id = :team_id,
							user_hiredate = :user_hiredate,
							user_enddate = :user_enddate,
							user_mantra_in_life = :user_mantra_in_life,
							user_skills = :user_skills,
							role_ids = :role_ids,
							user_status = :user_status
						WHERE user_id = :user_id");
					$bind_param = array(
						':user_id'            => $user_id,
						':user_employee_id'   => $employee_id,
						':user_email'         => $email,
						':user_firstname'     => $firstname,
						':user_middlename'    => $middlename,
						':user_lastname'      => $lastname,
						':user_nickname'      => $nickname,
						':user_photo'         => $user_photo,
						':user_gender'        => $gender,
						':user_mobile'        => $user_mobile,
						':user_position'      => $position_id,
						':team_id'            => $team_id,
						':user_hiredate'      => $user_hiredate,
						':user_enddate'       => $user_enddate,
						':user_mantra_in_life'=> $mantra_in_life,
						':user_skills'        => $skills,
						':role_ids'           => $role_ids,
						':user_status'        => $user_status,
					);
					$sql->execute($bind_param);

					// record to system log
					// $change_log = implode(';;',$change_logs);
					// systemLog('user',$user_id,'update',$change_log);

					$_SESSION['sys_users_edit_suc'] = renderLang($users_user_updated);
					
				} else { // no changes made

					$_SESSION['sys_users_edit_err'] = renderLang($form_no_changes);

				}

			} else { // error found

				$_SESSION['sys_users_edit_err'] = renderLang($form_error);

			}

		} else {

			$_SESSION['sys_users_edit_err'] = renderLang($form_id_not_found);

		}
			
	header('Location: ' . $_SERVER['HTTP_REFERER']);
		
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}
?>