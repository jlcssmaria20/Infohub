<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

	$uname = $_POST['uname'];
	$employeeid = $_POST['employeeid'];
	$upass = encryptStr($employeeid);
	$date_start =  date('Ymd',strtotime($_POST['date_start']));
	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$data_per_page = 15;
	$roleids = $_POST['roleids'];
	$team = $_POST['team'];
	$position = $_POST['position'];
	$skills = $_POST['skills'];
	$personal_details = $_POST['personal_details'];



	if($_FILES['filename']['name']!="") {
		$filename = $_FILES['filename']['name'];
		$path   =   '../../../assets/uploadimages/'.$filename;
		move_uploaded_file($_FILES['filename']['tmp_name'],$path);
	}

	// check table if already exist
	$sql = $pdo->prepare("SELECT email FROM `users` WHERE email =?");
	$sql->bindParam(1, $email);
	$sql->execute();
	if( $sql->rowCount() > 0 ) { # If rows are found for query
		unset($_SESSION['add_user_success']);
		$_SESSION['add_user_exist_success'] = 'add_user_exist_success';
		header('location:/add-user');	
	}
	else {
	unset($_SESSION['add_user_exist_success']);
	$_SESSION['add_user_success'] = 'add_user_success';

	    $sql = $pdo->prepare("INSERT INTO users (`uname`, `upass`, `employeeid`, `date_start`, 
		`firstname`, `middlename`, `lastname`, `email`, 
		`mobile`, `photo`,`roleids`, `data_per_page`, `team`, `position`,`skills`, `personal_details`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$sql->bindParam(1, $uname);
			$sql->bindParam(2, $upass);
			$sql->bindParam(3, $employeeid);
			$sql->bindParam(4, $date_start);
			$sql->bindParam(5, $firstname);
			$sql->bindParam(6, $middlename);
			$sql->bindParam(7, $lastname);
			$sql->bindParam(8, $email);
			$sql->bindParam(9, $mobile);
			$sql->bindParam(10, $filename);
			$sql->bindParam(11, $roleids);
			$sql->bindParam(12, $data_per_page);
			$sql->bindParam(13, $team);
			$sql->bindParam(14, $position);
			$sql->bindParam(15, $skills);
			$sql->bindParam(16, $personal_details);
			$sql->execute();
		}
		header('location:/add-user');
?>