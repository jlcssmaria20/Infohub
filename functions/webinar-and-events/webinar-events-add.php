<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {


	// check permission to access this page or function
	if(checkPermission('webinar-events-add')) {

		$err = 0;
		
		// PROCESS FORM

        //USER ID
        $host = $_POST['host'];
        $date_set1 = $_POST['schedule_date'];
		$date_set = date('Ymd',strtotime($date_set1));

		$current_date = date('F j, Y');
		$_SESSION['date_set'] = $date_set;

		// TITLE
		$title = '';
		if(isset($_POST['title'])) {
			$title = htmlentities(trim($_POST['title']));
			$title = ucfirst(trim($_POST['title']));
			$_SESSION['sys_webinar_events_add_title_val'] = $title;
			if(strlen($title) == 0) {
				$err++;
				$_SESSION['sys_webinar_events_add_title_err'] = renderLang($webinar_events_title_required);
			} else {
				
				// check if title already exists
				$sql = $pdo->prepare("SELECT webinar_title, temp_del FROM webinarandevents WHERE webinar_title = :webinar_title AND temp_del=0 LIMIT 1");
				$bind_param = array(
					':webinar_title' => $title
				);
				$sql->execute($bind_param);
				if($sql->rowCount() > 0) {
					$err++;
					$_SESSION['sys_webinar_events_add_title_err'] = renderLang($announcements_title_exists);
				}
			}
		}
		
		// DESCRIPTION
		$description = '';
		if(isset($_POST['description'])) {
			$description = $_POST['description'];
			$_SESSION['sys_webinar_events_add_description_val'] = $description;
			if(strlen($description) == 0) {
				$err++;
				$_SESSION['sys_webinar_events_add_description_err'] = renderLang($webinar_events_description_required);
			} 
		}
		// HOST
		/* $host = '';
		if(isset($_POST['host'])) {
			$host = htmlentities(trim($_POST['host']));
			$_SESSION['sys_webinar_events_add_host_val'] = $host;
			if(strlen($host) == 0) {
				$err++;
				$_SESSION['sys_webinar_events_add_host_err'] = renderLang($webinar_events_host_required);
			} 
		} */
/* 
		// SPEAKER
		$speaker = '';
		if(isset($_POST['speaker'])) {
			$speaker = htmlentities(trim($_POST['speaker']));
			$speaker = implode(',', (array)$_POST['speaker']);
			if(strlen($speaker) == "others") {
				$speaker = implode(',', (array)$_POST['others']);
			}
		}
 */
		// OTHERS

		$speakers = implode(',', (array)$_POST['others']);
		//HOST
		$hosts = implode(',', (array)$_POST['host']);
			
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
				$_SESSION['sys_webinar_events_add_img_err'] = renderLang($settings_general_update_invalid_file_type);
			}

			// check file size
			if ($_FILES['img']['size'] > 2000000) {
				$err++;
				$_SESSION['sys_webinar_events_add_img_err'] = renderLang($settings_general_update_exceeds_size);
			}
		}
		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors

            // IMAGE
            $filename = $_FILES['img']['name'];
			$target_dir = $_SERVER["DOCUMENT_ROOT"].'/assets/images/webinar-and-events/';
			$target_file = $target_dir.basename($_FILES['img']['name']);
			$image_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$img = $filename;
			$inputFile  = $target_dir.$img;
			move_uploaded_file($_FILES["img"]["tmp_name"], $inputFile);
			$filepath = '/assets/images/announcements/'.$img;

            
			$month_set = substr($date_set, 0, 6);

			$_SESSION['month_set'] = $month_set;
			
			
				$sql = $pdo->prepare("INSERT INTO webinarandevents(
					id,
					`user_id`,
					webinar_host,
					webinar_speaker,
					webinar_title,
					webinar_description,
					webinar_img,
					date_set,
					month_set,
					date_created

				) VALUES(
					NULL,
					:user_id,
					:webinar_host,
					:webinar_speaker,
					:webinar_title,
					:webinar_description,
					:webinar_img,
					:date_set,
					:month_set,
					:date_created
				)");
				$bind_param = array(
					':user_id'  				    => $_SESSION['sys_id'],
					':webinar_host'                 => $hosts,
					':webinar_speaker'              => $speakers,
					':webinar_title'  	    		=> $title,
					':webinar_description'  		=> $description,
					':webinar_img'   				=> $img,
					':date_set'						=> $date_set,
					':month_set'					=> $month_set,
					':date_created'					=> $current_date
				);

				$sql->execute($bind_param);
			

			$_SESSION['sys_webinar_events_suc'] = renderLang($webinar_events_added);
			header('location: /webinarandevents');
			
		} else { // error found
			
			$_SESSION['sys_webinar_events_add_err'] = renderLang($form_error);
			header('location: /add-webinar-and-events');
			
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