<?php
// INCLUDES
$module = 'webinarandevents'; $prefix = 'webinarandevent'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

	// select last inserted form webinar query
	$stmt = $pdo->prepare("SELECT id, date_set FROM webinarandevents ORDER BY id DESC LIMIT 1");
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);

	// Get data from other page
	$title = $_POST['title'];
	$status = 0;
	$setDate1 = $_POST['setdate'];
	$description = $_POST['description'];
	$setDate = date('Ymd',strtotime($setDate1));
	$current_date = date('F j, Y - l - h:i a', time());
	$_SESSION['setDate'] = $setDate;


    // check table if already exist
	$sql = $pdo->prepare("SELECT title FROM `webinarandevents` WHERE title =?");
	$sql->bindParam(1, $title);
	$sql->execute();
	if( $sql->rowCount() > 0 ) { # If rows are found for query
		unset($_SESSION['add_web_event_success']);
		$_SESSION['webinareventalreadyexist'] = 'webinareventalreadyexist';
	}
	else {
		//unset session
		unset($_SESSION['webinareventalreadyexist']);
		$_SESSION['add_web_event_success'] = 'add_web_event_success';

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

			$img_count = 1;
		
				//insert to webinar query
				$sql = $pdo->prepare("INSERT INTO webinarandevents (`user_id`, `title`, `img_count`,
				`images`, `description`, `date_set`,`month_set`, `date_now`, `status`) VALUES (?,?,?,?,?,?,?,?,?)");
				$sql->bindParam(1, $_SESSION['sys_data']['id']);
				$sql->bindParam(2, $title);
				$sql->bindParam(3, $img_count);
				$sql->bindParam(4, $filename);
				$sql->bindParam(5, $description);
				$sql->bindParam(6, $setDate);
				$sql->bindParam(7, $setMonth);
				$sql->bindParam(8, $current_date);
				$sql->bindParam(9, $status);
				$sql->execute();
		
	
		 }

	
	} // else
	
	// 20220221
	// $month_set = substr($setDate != 0 ? date('F j, Y',strtotime($setDate)) : 'ー', 0, 7) == 'January')

header('location:/dx-update-count-img');
?>