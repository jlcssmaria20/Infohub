<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('webinar-events-edit')) {

		// set page
		$page = 'webinarandevents';
	
		$err = 0;
		$webinar_id = decryptID($_GET['id']);
		// check if ID exists
		$sql = $pdo->prepare("SELECT * FROM webinarandevents WHERE id = :webinar_id LIMIT 1");
		$sql->bindParam(":webinar_id",$webinar_id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		if($sql->rowCount()) {

			// PROCESS FORM
			$date_set1 = $_POST['schedule_date'];
			$date_set = date('Ymd',strtotime($date_set1));
	

			// TITLE
			$title = '';
			if(isset($_POST['title'])) {
				$title = htmlentities(trim($_POST['title']));
				$title = ucfirst(trim($_POST['title']));
				$_SESSION['sys_webinar_events_edit_title_val'] = $title;
				if(strlen($title) == 0) {
					$err++;
					$_SESSION['sys_webinar_events_edit_title_err'] = renderLang($webinar_events_title_required);
				} 
			}
			
			// DESCRIPTION
			$description = '';
			if(isset($_POST['description'])) {
				$description = $_POST['description'];
				$_SESSION['sys_webinar_events_edit_description_val'] = $description;
				if(strlen($description) == 0) {
					$err++;
					$_SESSION['sys_webinar_events_edit_description_err'] = renderLang($webinar_events_description_required);
				} 
			}

			//CURRENT DATE
			$date_edited = date('F j, Y - l - h:i a', time());

			//IMAGE
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
					$_SESSION['sys_webinar_events_edit_img_err'] = renderLang($settings_general_update_invalid_file_type);
				}
	
				// check file size
				if ($_FILES['img']['size'] > 2000000) {
					$err++;
					$_SESSION['sys_webinar_events_edit_img_err'] = renderLang($settings_general_update_exceeds_size);
				}
			}

			//HOST
			$hosts = implode(',', (array)$_POST['host']);
			
			//SPEAKERS
			$speakers = implode(',', (array)$_POST['others']);
			
			// VALIDATE FOR ERRORS
			if($err == 0) { // there are no errors

				// IMAGE
				$filename = $_FILES['img']['name'];
				$target_dir = $_SERVER["DOCUMENT_ROOT"].'/assets/images/webinar-and-events/';
				$target_file = $target_dir.basename($_FILES['img']['name']);
				$image_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
				$img = $filename;
				if (empty($img)) {
					$img = $_POST['file_src'];
				}
				$inputFile  = $target_dir.$img;

				move_uploaded_file($_FILES["img"]["tmp_name"], $inputFile);

				$filepath = '/assets/images/announcements/'.$img;

                if ($img_tmp !== "") {
					
                    //MOVE IMAGE TO WEBINAR FOLDER
                    move_uploaded_file($picture_tmp, '../../assets/images/webinar-and-events/'.$img);

                    //UPDATE WEBINAR TABLE
                    $update = $pdo->prepare("UPDATE webinarandevents SET
                        webinar_host 		= :webinar_host,
                        webinar_speaker		= :webinar_speaker,
                        webinar_title 		= :webinar_title,
                        webinar_description = :webinar_description,
                        webinar_img 		= :webinar_img,
                        date_set			= :date_set,
                        date_edited 		= :date_edited
                    WHERE id = :webinar_id");
                    
                    $bind_param = array(
                        ':webinar_id'            		=> $webinar_id,
                        ':webinar_host'  				=> $hosts,
                        ':webinar_speaker'  			=> $speakers,
                        ':webinar_title'  	    		=> $title,
                        ':webinar_description'  		=> $description,
                        ':webinar_img'   				=> $img,
                        ':date_set'						=> $date_set,
                        ':date_edited'					=> $date_edited
                    );
                    $update->execute($bind_param);
                    $_SESSION['sys_webinar_events_edit_suc'] = renderLang($webinar_events_updated);

                } else {

                    //UPDATE WEBINAR TABLE
                    $update = $pdo->prepare("UPDATE webinarandevents SET
                        webinar_host 		= :webinar_host,
                        webinar_speaker		= :webinar_speaker,
                        webinar_title 		= :webinar_title,
                        webinar_description = :webinar_description,
                        webinar_img 		= :webinar_img,
                        date_set			= :date_set,
                        date_edited 		= :date_edited
                    WHERE id = :webinar_id");
                    
                    $bind_param = array(
                        ':webinar_id'            		=> $webinar_id,
                        ':webinar_host'  				=> $host,
                        ':webinar_speaker' 				=> $speaker,
                        ':webinar_title'  	  			=> $title,
                        ':webinar_description'  		=> $description,
                        ':webinar_img'   				=> $img,
                        ':date_set'						=> $date_set,
                        ':date_edited'					=> $date_edited
                    );
                    $update->execute($bind_param);
                    $_SESSION['sys_webinar_events_edit_suc'] = renderLang($webinar_events_updated);

                }


			} else { // error found

				$_SESSION['sys_webinar_events_edit_err'] = renderLang($form_error);

			}

		} else {

			$_SESSION['sys_webinar_events_edit_err'] = renderLang($form_id_not_found);

		}
		
		header('location: /edit-webinar-and-events/'.encryptID($webinar_id));
		
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}
?>