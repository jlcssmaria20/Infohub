<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');


if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {
	
		$id = $_POST['id'];

			$uname = $_POST['uname'];
			$uname = $_POST['uname'];
			if ($_POST["upass"] === $_POST["cupass"]) {
				$upass = $_POST['upass'];
			}
			else {
				$upass = $_POST['upass'];
			}
			
			$employeeid = $_POST['employeeid'];
			$date_start = $_POST['date_start'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$gender = $_POST['gender'];
			$civil_status = $_POST['civil_status'];
			$email = $_POST['email'];
			$access_role = $_POST['roleids'];
			$date_edit =  date('F j, Y - l - h:i a', time());
			$team = $_POST['team'];
			$position = $_POST['position'];
			$skills = $_POST['skills'];
			$personal_details = $_POST['personal_details'];


			$sql = $pdo->prepare("SELECT * FROM users WHERE id = :id");
			$sql->bindParam(":id",$id);
			$sql->execute();
			$data4 = $sql->fetch(PDO::FETCH_ASSOC);

			if(empty($_FILES['filename']['tmp_name']) || !is_uploaded_file($_FILES['filename']['tmp_name'])) { 
				$filename = $data4['photo'];
			} else {
				$filename = time()."-".rand(1000, 9999).'.jpg';
				$path   =   '../../../assets/uploadimages/'.$filename;
				move_uploaded_file($_FILES['filename']['tmp_name'],$path);
			}

			$sql = 'UPDATE users SET 
			uname = :uname, 
			employeeid = :employeeid, 
			firstname=:firstname, 
			middlename=:middlename, 
			lastname=:lastname,
			gender=:gender, 
			civil_status=:civil_status, 
			email=:email,
			photo=:photo, 
			roleids=:roleids, 
			team=:team, 
			position=:position,
			skills=:skills, 
			personal_details=:personal_details, 
			date_edit=:date_edit
			WHERE id = :id';
			$stmt = $pdo->prepare($sql);
			// bind params
			$stmt->bindParam(':uname', $uname);
			$stmt->bindParam(':employeeid', $employeeid);
			$stmt->bindParam(':firstname', $firstname);
			$stmt->bindParam(':middlename', $middlename);
			$stmt->bindParam(':lastname', $lastname);
			$stmt->bindParam(':gender', $gender);
			$stmt->bindParam(':civil_status', $civil_status);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':photo', $filename);
			$stmt->bindParam(':roleids', $access_role);			
			$stmt->bindParam(':date_edit', $date_edit);
			$stmt->bindParam(':team', $team);
			$stmt->bindParam(':position', $position);
			$stmt->bindParam(':skills', $skills);			
			$stmt->bindParam(':personal_details', $personal_details);


			$stmt->bindParam(':id', $id);

			// execute the UPDATE statment
			$stmt->execute();
			

			
			$_SESSION['update_user_success'] = 'update_user_success';
			header('location:/edit-user/list/'.encryptID($id).'');


	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
	//	header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
//	header('location: /');

}

		?>