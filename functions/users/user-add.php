<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('user-add')) {
	
		$err = 0;
		
		// PROCESS FORM

		//  TEAM 
		
		$team_id = 0;
		
		if(isset($_POST['team_id'])) {
			$team_id = strtoupper(trim($_POST['team_id']));
			if((strlen($team_id) == 0) || $team_id == 0 )  {
				$err++;
				$_SESSION['sys_users_add_team_id_err'] = renderLang($users_team_id_required);
			} else {

				$_SESSION['sys_users_add_team_id_val'] = $team_id;

				$sql = $pdo->prepare("SELECT id FROM teams WHERE id = :team_id AND temp_del = 0 LIMIT 1");
				$sql->bindParam(":team_id",$team_id);
				$sql->execute();
				if(!$sql->rowCount()) {
					$err++;
					$_SESSION['sys_users_add_team_id_err'] = renderLang($users_invalid_team_selection);
				} else {
					$data = $sql->fetch(PDO::FETCH_ASSOC);
					$team_id = $data['id'];
				}
			}
		}
		
		// EMPLOYEE ID
		$employee_id = '';
		if(isset($_POST['employee_id'])) {
			$employee_id = trim($_POST['employee_id']);
			$_SESSION['sys_users_add_employee_id_val'] = $employee_id;
			if(strlen($employee_id) == 0) {
				$err++;
				$_SESSION['sys_users_add_employee_id_err'] = renderLang($users_employee_id_required);
			} else {
				
				// check if employee ID already exists
				$sql = $pdo->prepare("SELECT user_employee_id, temp_del FROM users WHERE user_employee_id = :user_employee_id AND temp_del=0 LIMIT 1");
				$sql->bindParam(":user_employee_id",$employee_id);
				$sql->execute();
				if($sql->rowCount() > 0) {
					$err++;
					$_SESSION['sys_users_add_employee_id_err'] = renderLang($users_employee_id_exists);
				}
			}
		}
		
		// EMAIL
		$email = '';
		if(isset($_POST['email'])) {
			$email = htmlentities(strtolower(trim($_POST['email'])));
			$_SESSION['sys_users_add_email_val'] = $email;
			if(strlen($email) == 0) {
				$err++;
				$_SESSION['sys_users_add_email_err'] = renderLang($users_email_required);
			} else {

				// check if email already in use
				$sql = $pdo->prepare("SELECT user_email, temp_del FROM users WHERE user_email = :email AND temp_del = 0 LIMIT 1");
				$sql->bindParam(":email",$email);
				$sql->execute();
				if($sql->rowCount()) {
					$err++;
					$_SESSION['sys_users_add_email_err'] = renderLang($users_email_alread_in_use);
				}
			}
		}
		
		// MANTRA IN LIFE
		$mantra_in_life = '';
		if(isset($_POST['mantra_in_life'])) {
			$mantra_in_life = $_POST['mantra_in_life'];
			$_SESSION['sys_users_add_mantra_in_life_val'] = $mantra_in_life;
			if(strlen($mantra_in_life) == 0) {
				$err++;
				$_SESSION['sys_users_add_mantra_in_life_err'] = renderLang($users_mantra_in_life_required);
			}
		}

		// SKILLS
		$skills = '';
		if(isset($_POST['skills'])) {
			$skills = $_POST['skills'];
			$_SESSION['sys_users_add_skills_val'] = $skills;
			if(strlen($skills) == 0) {
				$err++;
				$_SESSION['sys_users_add_skills_err'] = renderLang($users_skills_required);
			} 
		}
		
		// NICKNAME
		$nickname = '';
		if(isset($_POST['nickname'])) {
			$nickname = htmlentities(ucwords(trim($_POST['nickname'])));
			$_SESSION['sys_users_add_nickname_val'] = $nickname;
			if(strlen($nickname) == 0) {
				$err++;
				$_SESSION['sys_users_add_nickname_err'] = renderLang($users_nickname_required);
			} else {
				if(!validateNameV1($nickname)) {
					$err++;
					$_SESSION['sys_users_add_nickname_err'] = renderLang($lang_invalid_characters);
				}
			}
		}
		
		// FIRSTNAME
		$firstname = '';
		if(isset($_POST['firstname'])) {
			$firstname = htmlentities(ucwords(trim($_POST['firstname'])));
			$_SESSION['sys_users_add_firstname_val'] = $firstname;
			if(strlen($firstname) == 0) {
				$err++;
				$_SESSION['sys_users_add_firstname_err'] = renderLang($users_firstname_required);
			} else {
				if(!validateNameV1($firstname)) {
					$err++;
					$_SESSION['sys_users_add_firstname_err'] = renderLang($lang_invalid_characters);
				}
			}
		}
		
		// MIDDLENAME
		$middlename = '';
		if(isset($_POST['middlename'])) {
			$middlename = htmlentities(ucwords(trim($_POST['middlename'])));
			$_SESSION['sys_users_add_middlename_val'] = $middlename;
			if(!validateNameV1($middlename)) {
				$err++;
				$_SESSION['sys_users_add_middleame_err'] = renderLang($lang_invalid_characters);
			}
		}
		
		// LASTNAME
		$lastname = '';
		if(isset($_POST['lastname'])) {
			$lastname = htmlentities(ucwords(trim($_POST['lastname'])));
			$_SESSION['sys_users_add_lastname_val'] = $lastname;
			if(strlen($lastname) == 0) {
				$err++;
				$_SESSION['sys_users_add_lastname_err'] = renderLang($users_lastname_required);
			} else {
				if(!validateNameV1($lastname)) {
					$err++;
					$_SESSION['sys_users_add_lastname_err'] = renderLang($lang_invalid_characters);
				}
			}
		}
		
		// GENDER
		$gender =0;
		if(isset($_POST['gender'])) {
			$gender = trim($_POST['gender']);
			$_SESSION['sys_users_add_gender_val'] = $gender;
			$gender_exists = 0;
			foreach($gender_arr as $gender_data) {
				if($gender_data[0] == $gender_exists) {
					$gender_exists = 1;
				}
			}
			if(!$gender_exists) {
				$err++;
				$_SESSION['sys_users_add_gender_err'] = renderLang($users_invalid_gender);
			}
		}
		// POSITION
		$position_id = 0;
		if(isset($_POST['position_id'])) {
		
			$position_id = ucwords(strtolower(trim($_POST['position_id'])));
			$_SESSION['sys_users_add_gender_val'] = $position_id;
			if(strlen($position_id) == 0) {
				$err++;
				$_SESSION['sys_users_add_position_err'] = renderLang($users_position_id_required);
			} else {
				$_SESSION['sys_users_add_position_val'] = $position_id;
			}
		}
		// HIRE DATE
		$user_hiredate = 0;
		if(isset($_POST['user_hiredate'])) {

			$user_hiredate = date('Ymd', strtotime($_POST['user_hiredate']));
			if(strlen($user_hiredate) == 0) {
				$err++;
				$_SESSION['sys_users_add_hiredate_err'] = renderLang($users_hiredate_required);
			} else {
				$_SESSION['sys_users_add_hiredate_val'] = $_POST['user_hiredate'];
			}
		}
		// END DATE
//		$user_enddate = 0;
//		if(isset($_POST['user_enddate'])) {
//
//			$user_enddate = date('Ymd', strtotime($_POST['user_enddate']));
//			if(strlen($user_enddate) == 0) {
//				$err++;
//				$_SESSION['sys_users_add_enddate_err'] = renderLang($users_enddate_required);
//			} else {
//				$_SESSION['sys_users_add_enddate_val'] = $_POST['user_enddate'];
//			}
//		}
		
		// MOBILE NUMBER
		$user_mobile = '';
		if(isset($_POST['user_mobile'])) {
			$user_mobile = trim($_POST['user_mobile']);
			
			if (!preg_match('/^[0-9]*$/', $user_mobile)) {
				$err++;
				$_SESSION['sys_users_add_user_mobile_err'] = renderLang($users_mobile_err);
			}else{
				$_SESSION['sys_users_add_user_mobile_val'] = $user_mobile;
			}
		}
		
		// ROLES
		$role_ids = ',';
		if(isset($_POST['role_ids'])) {
			$role_ids = trim($_POST['role_ids']);
			if(strlen($role_ids) == 0) {
				$err++;
				$_SESSION['sys_users_add_roles_err'] = renderLang($users_role_required);
			} else {
				$_SESSION['sys_users_add_roles_val'] = $role_ids;
			}
		}
		
		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors
			
			$user_password = encryptStr($employee_id);
			// $new_pass = randomPassword();
			// $user_password = encryptStr($new_pass);
			$role_ids = ','.$role_ids.',';
			if($gender == 0){
				$user_photo = 'avatar2.png';
			} else {
				$user_photo = 'avatar5.png';
			}
			
			// update account language table
			$sql = $pdo->prepare("INSERT INTO users(
					user_id,
					user_employee_id,
					user_email,
					user_password,
					user_firstname,
					user_middlename,
					user_lastname,
					user_nickname,
					user_photo,
					user_gender,
					user_position,
					role_ids,
					team_id,
					user_hiredate,
					user_enddate,
					user_mantra_in_life,
					user_skills,
					user_mobile
				) VALUES(
					NULL,
					:user_employee_id,
					:user_email,
					:user_password,
					:user_firstname,
					:user_middlename,
					:user_lastname,
					:user_nickname,
					:user_photo,
					:user_gender,
					:user_position,
					:role_ids,
					:team_id,
					:user_hiredate,
					:user_enddate,
					:user_mantra_in_life,
					:user_skills,
					:user_mobile
				)");
			$bind_param = array(
				':user_employee_id'   => $employee_id,
				':user_email'         => $email,
				':user_password'      => $user_password,
				':user_firstname'     => $firstname,
				':user_middlename'    => $middlename,
				':user_lastname'      => $lastname,
				':user_nickname'      => $nickname,
				':user_photo'         => $user_photo,
				':user_gender'        => $gender,
				':user_position'      => $position_id,
				':role_ids'           => $role_ids,
				':team_id'            => $team_id,
				':user_hiredate'      => $user_hiredate,
				':user_enddate'       => 20270101,
				':user_mantra_in_life' => $mantra_in_life,
				':user_skills'        => $skills,
				':user_mobile'        => $user_mobile
			);
			$sql->execute($bind_param);
			
			// get ID of new user
			$sql = $pdo->prepare("SELECT user_id, user_employee_id FROM users WHERE user_employee_id = :user_employee_id LIMIT 1");
			$sql->bindParam(":user_employee_id",$employee_id);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			
			$_SESSION['sys_users_suc'] = renderLang($users_user_added);
			header('location: /users');
			
		} else { // error found
			
			$_SESSION['sys_users_add_err'] = renderLang($form_error);
			header('location: /add-user');
			
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