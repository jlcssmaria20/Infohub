<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');


if(checkSession()) {


		$id = $_POST['id'];

			$uname = $_POST['uname'];
			$employeeid = $_POST['employeeid'];
			$date_start =  date('Ymd',strtotime($_POST['date_start']));

			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];

			$email = $_POST['email'];
			$access_role = $_POST['roleids'];
			$date_start	 =  date('F j, Y - l - h:i a', time());
			$team = $_POST['team'];
			$position = $_POST['position'];
			$skills = $_POST['skills'];
			$personal_details = $_POST['personal_details'];

			$sql = $pdo->prepare("SELECT * FROM users WHERE id = :id");
			$sql->bindParam(":id",$id);
			$sql->execute();
			$data4 = $sql->fetch(PDO::FETCH_ASSOC);

			// if(empty($_FILES['filename']['tmp_name']) || !is_uploaded_file($_FILES['filename']['tmp_name'])) { 
			// 	$filename = $data4['photo'];
			// } else {
			// 	$filename = time()."-".rand(1000, 9999).'.jpg';
			// 	$path   =   '../../../assets/uploadimages/'.$filename;
			// 	move_uploaded_file($_FILES['filename']['tmp_name'],$path);
			// }

			$uploads_dir = '../../../assets/uploadimages';
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["filename"]["tmp_name"];
				// basename() may prevent filesystem traversal attacks;
				$filename = basename($_FILES["filename"]["name"]);
				move_uploaded_file($tmp_name, "$uploads_dir/$filename");
			} else {
				//$tmp_name = time()."-".rand(1000, 9999).'.jpg';
				$sql = $pdo->prepare("SELECT date_set, images FROM users WHERE id = :id");
				$sql->bindParam(":id",$id);
				$sql->execute();
				$data4 = $sql->fetch(PDO::FETCH_ASSOC);

				$filename = $data4['images'];
				move_uploaded_file($filename, "$uploads_dir/$filename");

			}

			$sql = 'UPDATE users SET 
			uname = :uname, 
			employeeid = :employeeid, 
			firstname=:firstname, 
			middlename=:middlename, 
			lastname=:lastname,
			email=:email,
			photo=:photo, 
			roleids=:roleids, 
			team=:team, 
			position=:position,
			skills=:skills, 
			personal_details=:personal_details, 
			date_start=:date_start,
			date_start	=:date_start	
			WHERE id = :id';
			$stmt = $pdo->prepare($sql);
			// bind params
			$stmt->bindParam(':uname', $uname);
			$stmt->bindParam(':employeeid', $employeeid);
			$stmt->bindParam(':firstname', $firstname);
			$stmt->bindParam(':middlename', $middlename);
			$stmt->bindParam(':lastname', $lastname);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':photo', $filename);
			$stmt->bindParam(':roleids', $access_role);		
			$stmt->bindParam(':date_start', $date_start);	
			$stmt->bindParam(':date_start	', $date_start);
			$stmt->bindParam(':team', $team);
			$stmt->bindParam(':position', $position);
			$stmt->bindParam(':skills', $skills);			
			$stmt->bindParam(':personal_details', $personal_details);


			$stmt->bindParam(':id', $id);

			// execute the UPDATE statment
			$stmt->execute();
			
			
		$_SESSION['update_user_success'] = 'update_user_success';
	    header('location:/user-dashboard');



} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
//	header('location: /');

}


?>