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

		$current_date = date('F j, Y - l - h:i a', time());
		$_SESSION['date_set'] = $date_set;

		// TITLE
		$title = '';
		if(isset($_POST['title'])) {
			$title = htmlentities(trim($_POST['title']));
			$title = ucwords(strtolower(trim($_POST['title'])));
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
		$host = '';
		if(isset($_POST['host'])) {
			$host = htmlentities(trim($_POST['host']));
			$_SESSION['sys_webinar_events_add_host_val'] = $host;
			if(strlen($host) == 0) {
				$err++;
				$_SESSION['sys_webinar_events_add_host_err'] = renderLang($webinar_events_host_required);
			} 
		}
		// SPEAKER
		$speaker = '';
		if(isset($_POST['speaker'])) {
			$speaker = htmlentities(trim($_POST['speaker']));
			$_SESSION['sys_webinar_events_add_speaker_val'] = $speaker;
			if(strlen($speaker) == 0) {
				$err++;
				$_SESSION['sys_webinar_events_add_speaker_err'] = renderLang($webinar_events_speaker_required);
			}
		}

		// OTHERS
		$others = '';
		if(isset($_POST['others'])) {
			$others = htmlentities(trim($_POST['others']));
			$others = ucwords(strtolower(trim($_POST['others'])));
			$_SESSION['sys_webinar_events_add_others_val'] = $others;
			if(strlen($others) == 0) {
				$others = htmlentities(trim($_POST['speaker']));
			}
		}

		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors

            // IMAGE
            $picture_tmp 	= $_FILES['picture']['tmp_name'];
            $picture_name 	= $_FILES['picture']['name'];
            $picture 		= time()."_".$picture_name;
          
			//MOVE IMAGE TO WEBINAR FOLDER
            move_uploaded_file($picture_tmp, '../../assets/images/webinar-and-events/'.$picture);
            
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
				':webinar_host'                 => $host,
				':webinar_speaker'              => $others,
                ':webinar_title'  	    		=> $title,
                ':webinar_description'  		=> $description,
                ':webinar_img'   				=> $picture,
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