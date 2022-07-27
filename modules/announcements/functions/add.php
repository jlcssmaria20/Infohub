<?php
// INCLUDES
$module = 'announcements'; $prefix = 'announcement'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

	// select last inserted form webinar query
	$stmt = $pdo->prepare("SELECT id FROM announcements ORDER BY id DESC LIMIT 1");
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);


	// Get data from other page
	$announcment_title = $_POST['announcment_title'];
	$status = 0;
	$announcment_details = $_POST['announcment_details'];
	$current_date = date('F j, Y - l - h:i a', time());


    // check table if already exist
	$sql = $pdo->prepare("SELECT announcment_title FROM `announcements` WHERE announcment_title =?");
	$sql->bindParam(1, $announcment_title);
	$sql->execute();
	if( $sql->rowCount() > 0 ) { # If rows are found for query
		unset($_SESSION['add_announcement']);
		$_SESSION['announcementalreadyexist'] = 'announcementalreadyexist';
	}
	else {
		//unset session
		unset($_SESSION['announcementalreadyexist']);
		$_SESSION['add_announcement'] = 'add_announcement';

		$countfiles = count($_FILES['filename']['name']);
	
		for($i=0;$i<$countfiles;$i++) {

			$file = $_FILES['filename']['name'];
			if($_FILES['filename']['name']!="") {
				$filename = $_FILES['filename']['name'][$i];
				$path   =   '../../../assets/uploadimages/'.$filename;
				move_uploaded_file($_FILES['filename']['tmp_name'][$i],$path);
			}


			$setMonth = substr($setDate, 0, 6);

			$_SESSION['setMonth'] = $setMonth;


			$announcment_count = 0;

		
				//insert to webinar query
				$sql = $pdo->prepare("INSERT INTO announcements (`user_id`, `announcment_title`,
				`announcment_img`, `announcment_details`, `current_date`, `status`) VALUES (?,?,?,?,?,?)");
				$sql->bindParam(1, $_SESSION['sys_data']['id']);
				$sql->bindParam(2, $announcment_title);
				$sql->bindParam(3, $filename);
				$sql->bindParam(4, $announcment_details);
				$sql->bindParam(5, $current_date);
				$sql->bindParam(6, $status);
				$sql->execute();
		
	
		 }

		
	} // else
	
	header('location:/add-announce_ments');
?>
