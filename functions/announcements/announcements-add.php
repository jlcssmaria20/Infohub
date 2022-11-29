<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {


	// check permission to access this page or function
	if(checkPermission('announcements-add')) {

		$err = 0;
		
		// PROCESS FORM

		// TITLE
		$title = '';
		if(isset($_POST['title'])) {
			$title = htmlentities(trim($_POST['title']));
			$title = ucfirst(trim($_POST['title']));
			$_SESSION['sys_announcements_add_title_val'] = $title;
			if(strlen($title) == 0) {
				$err++;
				$_SESSION['sys_announcements_add_title_err'] = renderLang($announcements_title_required);
			} else {
				
				// check if title already exists
				$sql = $pdo->prepare("SELECT announcements_title, temp_del FROM announcements WHERE announcements_title = :announcements_title AND temp_del=0 LIMIT 1");
				$bind_param = array(
					':announcements_title' => $title
				);
				$sql->execute($bind_param);
				if($sql->rowCount() > 0) {
					$err++;
					$_SESSION['sys_announcements_add_title_err'] = renderLang($announcements_title_exists);
				}
			}
		}
		
		// DETAILS
		$details = '';
		if(isset($_POST['details'])) {
			$details = $_POST['details'];
			$_SESSION['sys_announcements_add_details_val'] = $details;
			if(strlen($details) == 0) {
				$err++;
				$_SESSION['sys_announcements_add_details_err'] = renderLang($announcements_details_required);
			} 
		}
		
		// IMAGE
		$target_file = '';
		if($_FILES["img"]['name'] != '') {
			$file_info = getimagesize($_FILES['img']['tmp_name']);

			if($file_info !== false) {} else {
				$err++;
				if(
					$image_extension != "jpg" &&
					$image_extension != "png" &&
					$image_extension != "jpeg" &&
					$image_extension != "gif"
				) {
					$err++;
				}
				$_SESSION['sys_announcements_add_img_err'] = renderLang($settings_general_update_invalid_file_type);
			}

			// check file size
			if ($_FILES['img']['size'] > 2000000) {
				$err++;
				$_SESSION['sys_announcements_add_img_err'] = renderLang($settings_general_update_exceeds_size);
			}
		}
		//CURRENT DATE
		$current_date = date('F j, Y');

		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors

			//redirect images to the announcement folder in assets/images
			$filename = $_FILES['img']['name'];
			$target_dir = $_SERVER["DOCUMENT_ROOT"].'/assets/images/announcements/';
			$target_file = $target_dir.basename($_FILES['img']['name']);
			$image_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$img = $filename;
			$inputFile  = $target_dir.$img;
			move_uploaded_file($_FILES["img"]["tmp_name"], $inputFile);
			$filepath = '/assets/images/announcements/'.$img;

			//CURRENT DATE
			$date_edit = date('F j, Y - l - h:i a', time());

			// insert in database
			$sql = $pdo->prepare("INSERT INTO announcements(
					id,
					`user_id`,
					announcements_title,
					announcements_details,
					announcements_img,
					date_edit,
					date_created
				) VALUES(
					NULL,
					:user_id,
					:announcements_title,
					:announcements_details,
					:announcements_img,
					:date_edit,
					:date_created
				)");
			$bind_param = array(
				':user_id'  				=> $_SESSION['sys_id'],
				':announcements_title'  	=> $title,
				':announcements_details'  	=> $details,
				':announcements_img'   		=> $img,
				':date_edit'   		        => $date_edit,
				':date_created'				=> $current_date
			);
			
			$sql->execute($bind_param);
			// $sql->debugDumpParams();

			$_SESSION['sys_img'] = $filepath;
			
			// get ID of new announcements
			// $sql = $pdo->prepare("SELECT announcements_id, announcements_title FROM announcements WHERE announcements_title = :announcements_title LIMIT 1");
			// $bind_param = array(
			// 	':announcements_title'   => $title
			// );
			// $sql->execute($bind_param);
			// $data = $sql->fetch(PDO::FETCH_ASSOC);
			
			// record to system log
			//systemLog('announcements',$data['announcements_id'],'add','');

			$_SESSION['sys_announcements_suc'] = renderLang($announcements_added);
			header('location: /announcements');
			
		} else { // error found
			
			$_SESSION['sys_announcements_add_err'] = renderLang($form_error);
			header('location: /add-announcements');
			
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