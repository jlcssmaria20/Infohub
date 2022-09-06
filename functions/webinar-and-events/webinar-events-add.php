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
        $schedule_date = $_POST['schedule_date'];

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
				$sql = $pdo->prepare("SELECT webinar_events_title, temp_del FROM webinarandevents WHERE webinar_events_title = :webinar_events_title AND temp_del=0 LIMIT 1");
				$bind_param = array(
					':webinar_events_title' => $title
				);
				$sql->execute($bind_param);
				if($sql->rowCount() > 0) {
					$err++;
					$_SESSION['sys_webinar_events_add_title_err'] = renderLang($announcements_title_exists);
				}
			}
		}
		
		// DETAILS
		$description = '';
		if(isset($_POST['description'])) {
			$description = htmlentities(trim($_POST['description']));
			$_SESSION['sys_webinar_events_add_description_val'] = $description;
			if(strlen($description) == 0) {
				$err++;
				$_SESSION['sys_webinar_events_add_description_err'] = renderLang($webinar_events_description_required);
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
            
            //INSERT DATA
            $insert = $pdo->prepare("INSERT INTO webinarandevents(
                `user_id`,
                webinar_events_title,
                webinar_events_description,
                webinar_events_img,
                webinar_events_schedule_date
            ) VALUES(
                :user_id,
                :webinar_events_title,
                :webinar_events_description,
                :webinar_events_img,
                :webinar_events_schedule_date
            )");

            $bind_param = array(
                ':user_id'  				    => $host,
                ':webinar_events_title'  	    => $title,
                ':webinar_events_description'  	=> $description,
                ':webinar_events_img'   		=> $picture,
                ':webinar_events_schedule_date'	=> $schedule_date
            );

            $insert->execute($bind_param);

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