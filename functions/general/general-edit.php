<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	// set page
	$page = 'general';

	$err = 0;
	$user_id = $_SESSION['sys_id'];
	unset($_SESSION['sys_general_edit_photo_err']);
	// check if ID exists
	$sql = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id LIMIT 1");
	$sql->bindParam(":user_id", $user_id);
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);
	if($sql->rowCount()) {

	// PHOTO
		$target_dir = $_SERVER["DOCUMENT_ROOT"].'/assets/images/team-images/';
		$target_file = $target_dir.basename($_FILES['photo']['name']);
		$name = $_FILES["photo"]["name"];
		$type = $_FILES["photo"]["type"];
		$size = $_FILES["photo"]["size"];
		
		// Check if file was uploaded without errors
		if(isset($_FILES["photo"])) {
			$filepath = '/assets/images/team-images/'.$name;
			$_SESSION['sys_photo'] = $filepath;
			$allowed_ext = array("jpg" => "image/jpg",
								"JPG" => "image/JPG",
								"PNG" => "image/PNG",
								"jpeg" => "image/jpeg",
								"png" => "image/png");
		  
			// Verify file extension
			$ext = pathinfo($name, PATHINFO_EXTENSION);
	  
			if (!array_key_exists($ext, $allowed_ext)) {
				$err++;
				$_SESSION['sys_general_edit_photo_err'] = "Incorrect File Type ( Choose jpg or png file type only)";
			}    
				  
			// $maxsize = 200000;
	
			// if ($size > $maxsize) {
			// 	$err++; 
			// 	$_SESSION['sys_general_edit_photo_err'] = renderLang($settings_general_update_exceeds_size);
			// }    
			if($_FILES["photo"]["error"] == 1){
				$err++; 
				$_SESSION['sys_general_edit_photo_err'] = renderLang($settings_general_update_exceeds_size);
			}
						
		}

		// if($_FILES["photo"]["error"] == 1){
		// 	$err++; 
		// 	$_SESSION['sys_general_edit_photo_err'] = renderLang($settings_general_update_exceeds_size);
		// }else{
		// 	$filepath = '/assets/images/team-images/'.$name;
		// 	$_SESSION['sys_photo'] = $filepath;
		// }
		// SKILLS
		$skills = '';
		if(isset($_POST['skills'])) {
			$skills = htmlentities(trim($_POST['skills']));
			$_SESSION['sys_general_edit_skills_val'] = $skills;
			if(strlen($skills) == 0) {
				$skills = 'NA';
			}  else {
				if(!validateNameV1($skills)) {
					$err++;
					$_SESSION['sys_general_edit_skills_err'] = "Invalid Characters!";
				}
			}
		}
		// MANTRA
		$mantra = '';
		if(isset($_POST['mantra'])) {
			$mantra = htmlentities(trim($_POST['mantra']));
			$_SESSION['sys_general_edit_mantra_val'] = $mantra;
			if(strlen($mantra) == 0) {
				$mantra = 'NA';
			}  else {
				if(!validateNameV1($mantra)) {
					$err++;
					$_SESSION['sys_general_edit_mantra_err'] = "Invalid Characters!";
				}
			}
		}
		// NICKNAME
		$nickname = '';
		if(isset($_POST['nickname'])) {
			$nickname = htmlentities(trim($_POST['nickname']));
			$nickname = ucfirst(trim($_POST['nickname']));
			$_SESSION['sys_general_edit_nickname_val'] = $nickname;
			if(strlen($nickname) == 0) {
				$err++;
				$_SESSION['sys_general_edit_nickname_err'] = "Nickname is Required";
			}  else {
				if(!validateNameV1($nickname)) {
					$err++;
					$_SESSION['sys_general_edit_nickname_err'] = "Invalid Characters!";
				}
			}
		}
		// FIRSTNAME
		$firstname = '';
		if(isset($_POST['firstname'])) {
			$firstname = htmlentities(trim($_POST['firstname']));
			$firstname = ucfirst(trim($_POST['firstname']));
			$_SESSION['sys_general_edit_firstname_val'] = $firstname;
			if(strlen($firstname) == 0) {
				$err++;
				$_SESSION['sys_general_edit_firstname_err'] = "First name is Required";
			}   else {
				if(!validateNameV1($firstname)) {
					$err++;
					$_SESSION['sys_general_edit_firstname_err'] = "Invalid Characters!";
				}
			}
		}
		// MIDDLE NAME
		$middlename = '';
		if(isset($_POST['middlename'])) {
			$middlename = htmlentities(trim($_POST['middlename']));
			$middlename = ucfirst(trim($_POST['middlename']));
			$_SESSION['sys_general_edit_middlename_val'] = $middlename;

			if(!validateNameV1($middlename)) {
				$err++;
				$_SESSION['sys_general_edit_middlename_err'] = "Invalid Characters!";
			}
		}
		// LASTNAME
		$lastname = '';
		if(isset($_POST['lastname'])) {
			$lastname = htmlentities(trim($_POST['lastname']));
			$lastname = ucfirst(trim($_POST['lastname']));
			$_SESSION['sys_general_edit_lastname_val'] = $lastname;
			if(strlen($lastname) == 0) {
				$err++;
				$_SESSION['sys_general_edit_lastname_err'] = renderLang($general_lastname_required);
			}  else {
				if(!validateNameV1($lastname)) {
					$err++;
					$_SESSION['sys_general_edit_lastname_err'] = "Invalid Characters!";
				}
			}
		}
		// MOBILE NUMBER
	
		// MOBILE
		$mobile = '';
		if(isset($_POST['mobile'])) {
			$mobile = trim($_POST['mobile']);
			if (!preg_match('/^[0-9]*$/', $mobile)) {
				$err++;
				$_SESSION['sys_general_edit_user_mobile_err'] = renderLang($users_mobile_err);
			}else{
				$_SESSION['sys_general_edit_user_mobile_val'] = $mobile;
			}
		}
			

		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors

			// check for changes
			$change_logs = array();
			if($skills != $data['user_skills']) {
				$tmp = 'user_skills::'.$data['user_skills'].'=='.$skills;
				array_push($change_logs,$tmp);
			}
			if($mantra != $data['user_mantra_in_life']) {
				$tmp = 'user_mantra_in_life::'.$data['user_mantra_in_life'].'=='.$mantra;
				array_push($change_logs,$tmp);
			}
			if($nickname != $data['user_nickname']) {
				$tmp = 'user_nickname::'.$data['user_nickname'].'=='.$nickname;
				array_push($change_logs,$tmp);
			}
			if($photo != $data['user_photo']) {
				$tmp = 'user_photo::'.$data['user_photo'].'=='.$photo;
				array_push($change_logs,$tmp);
			}
			if($firstname != $data['user_firstname']) {
				$tmp = 'user_firstname::'.$data['user_firstname'].'=='.$firstname;
				array_push($change_logs,$tmp);
			}
			if($middlename != $data['user_middlename']) {
				$tmp = 'user_middlename::'.$data['user_middlename'].'=='.$middlename;
				array_push($change_logs,$tmp);
			}
			if($lastname != $data['user_lastname']) {
				$tmp = 'user_lastname::'.$data['user_lastname'].'=='.$lastname;
				array_push($change_logs,$tmp);
			}
			if($mobile != $data['user_mobile']) {
				$tmp = 'user_mobile::'.$data['user_mobile'].'=='.$mobile;
				array_push($change_logs,$tmp);
			}
			//PHOTO NAME
			if($name != $data['user_photo']){
				$tmp = 'user_photo::'.$data['user_photo'].'=='.$name;
				array_push($change_logs,$tmp);
			}

			// check if there is are changes made
			if(count($change_logs) > 0) {
			
				$_SESSION['sys_fullname'] = $firstname.' '.$lastname;

				$photo = $name;
				if (empty($photo)) {
					$photo = $_POST['file_src'];
				}
				$inputFile  = $target_dir.$photo;

				move_uploaded_file($_FILES["photo"]["tmp_name"], $inputFile);

				$filepath = '/assets/images/team-images/'.$photo;
				$_SESSION['sys_photo'] = $filepath;

				// update account language table
				$sql = $pdo->prepare("UPDATE users SET
					user_skills 			= :user_skills,
					user_mantra_in_life 	= :user_mantra_in_life,
					user_nickname 			= :user_nickname,
					user_photo 				= :user_photo,
					user_firstname 			= :user_firstname,
					user_middlename 		= :user_middlename,
					user_lastname 			= :user_lastname,
					user_mobile 			= :user_mobile
					WHERE user_id = :user_id");
				
				$bind_param = array(
					':user_id'            	=> $user_id,
					':user_skills'   		=> $skills,
					':user_mantra_in_life'  => $mantra,
					':user_nickname'     	=> $nickname,
					':user_photo'     		=> $photo,
					':user_firstname'		=> $firstname,
					':user_middlename'		=> $middlename,
					':user_lastname'		=> $lastname,
					':user_mobile'			=> $mobile,
				);
				$sql->execute($bind_param);

				// record to system log
				// $change_log = implode(';;',$change_logs);
				// systemLog('general',$general_id,'update',$change_log);

				$_SESSION['sys_general_edit_suc'] = renderLang($account_updated);

			} else { // no changes made
				$_SESSION['sys_general_edit_err'] = renderLang($form_no_changes);
			}

		} else { // error found

			$_SESSION['sys_general_edit_err'] = renderLang($form_error);

		}

	} else {
		$_SESSION['sys_general_edit_err'] = renderLang($form_id_not_found);
	}
	
	header('location: /edit-general/'.encryptID($user_id));
	
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}
?>