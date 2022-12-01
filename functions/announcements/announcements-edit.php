<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('announcements-edit')) {

		// set page
		$page = 'announcements';
	
		$err = 0;
		$announcements_id = decryptID($_GET['id']);
		
		// check if ID exists
		$sql = $pdo->prepare("SELECT * FROM announcements WHERE id = :announcements_id LIMIT 1");
		$sql->bindParam(":announcements_id",$announcements_id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		if($sql->rowCount()) {

			// PROCESS FORM

			// TITLE
			$title = '';
			if(isset($_POST['title'])) {
				$title = htmlentities(trim($_POST['title']));
				$title = ucfirst(trim($_POST['title']));

				$_SESSION['sys_announcements_edit_title_val'] = $title;
				if(strlen($title) == 0) {
					$err++;
					$_SESSION['sys_announcements_edit_title_err'] = renderLang($announcements_title_required);
				} else {
					
					// check if title already exists
					$sql2 = $pdo->prepare("SELECT id, announcements_title, temp_del FROM announcements WHERE announcements_title = :announcements_title AND id <> :announcements_id LIMIT 1");
					$bind_param = array(
						':announcements_id'      => $announcements_id,
						':announcements_title'   => $title
					);
					$sql2->execute($bind_param);
					if($sql2->rowCount()) {
						$err++;
						$_SESSION['sys_announcements_edit_title_err'] = renderLang($announcements_title_exists);
					}
				}
			}

			// DETAILS
			$details = '';
			if(isset($_POST['details'])) {
				$details = $_POST['details'];
				$_SESSION['sys_announcements_edit_details_val'] = $details;
				if(strlen($details) == 0) {
					$err++;
					$_SESSION['sys_announcements_edit_details_err'] = renderLang($announcements_details_required);
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
					$_SESSION['sys_announcements_edit_img_err'] = renderLang($settings_general_update_invalid_file_type);
				}
	
				// check file size
				if ($_FILES['img']['size'] > 2000000) {
					$err++;
					$_SESSION['sys_announcements_edit_img_err'] = renderLang($settings_general_update_exceeds_size);
				}
			}
	

			// STATUS
			$announcements_status = 0;
			if(isset($_POST['announcements_status'])) {
				$announcements_status = trim($_POST['announcements_status']);
				$_SESSION['sys_announcements_edit_status_val'] = $announcements_status;
				$announcements_status_exists = 0;
				foreach($status_arr as $status_data) {
					if($status_data[0] == $announcements_status) {
						$announcements_status_exists = 1;
					}
				}
				if(!$announcements_status_exists) {
					$err++;
					$_SESSION['sys_announcements_edit_status_err'] = 'Please select a valid status.';
				}
			}
			//CURRENT DATE
			$date_edit = date('F j, Y');

			// VALIDATE FOR ERRORS
			if($err == 0) { // there are no errors

				// check for changes
				$change_logs = array();
				if($title != $data['announcements_title']) {
					$tmp = 'announcements_title::'.$data['announcements_title'].'=='.$title;
					array_push($change_logs,$tmp);
				}
				if($details != $data['announcements_details']) {
					$tmp = 'announcements_details::'.$data['announcements_details'].'=='.$details;
					array_push($change_logs,$tmp);
				}
				if($img != $data['announcements_img']) {
					$tmp = 'announcements_img::'.$data['announcements_img'].'=='.$img;
					array_push($change_logs,$tmp);
				}
				if($announcements_status != $data['announcements_status']) {
					echo $announcements_status.' '.$data['announcements_status'];
					$tmp = 'lang_status::'.$data['announcements_status'].'=='.$announcements_status;
					array_push($change_logs,$tmp);
				}



				// check if there is are changes made
				if(count($change_logs) > 0) {
					$filename = $_FILES['img']['name'];
					$target_dir = $_SERVER["DOCUMENT_ROOT"].'/assets/images/announcements/';
					$target_file = $target_dir.basename($_FILES['img']['name']);
					$image_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					
					$img = $filename;
					if (empty($img)) {
						$img = $_POST['file_src'];
					}
					$inputFile  = $target_dir.$img;

					move_uploaded_file($_FILES["img"]["tmp_name"], $inputFile);

					$filepath = '/assets/images/announcements/'.$img;

				
					// update account language table
					$sql = $pdo->prepare("UPDATE announcements SET
						announcements_title = :announcements_title,
						announcements_details = :announcements_details,
						announcements_img = :announcements_img,
						announcements_status = :announcements_status,
						date_edit = :date_edit
					    WHERE id = :announcements_id");
					
					$bind_param = array(
						':announcements_id'         => $announcements_id,
						':announcements_title'   	=> $title,
						':announcements_details'  	=> $details,
						':announcements_img'   		=> $img,
						':announcements_status'     => $announcements_status,
						':date_edit'				=> $date_edit
					);
					$sql->execute($bind_param);

					$_SESSION['sys_img'] = $filepath;
					// record to system log
					// $change_log = implode(';;',$change_logs);
					// systemLog('announcements',$announcements_id,'update',$change_log);

					$_SESSION['sys_announcements_edit_suc'] = renderLang($announcements_updated);

				} else { // no changes made

					$_SESSION['sys_announcements_edit_err'] = renderLang($form_no_changes);

				}

			} else { // error found

				$_SESSION['sys_announcements_edit_err'] = renderLang($form_error);

			}

		} else {

			$_SESSION['sys_announcements_edit_err'] = renderLang($form_id_not_found);

		}
		
		header('location: /edit-announcements/'.encryptID($announcements_id));
		
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}
?>