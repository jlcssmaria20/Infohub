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
	
			//host
			$host = '';
			if(isset($_POST['host'])) {
				$host = htmlentities(trim($_POST['host']));
				$_SESSION['sys_webinar_events_edit_host_val'] = $host;
				if(strlen($host) == 0) {
					$err++;
					$_SESSION['sys_webinar_events_edit_host_err'] = renderLang($webinar_events_host_required);
				} 
			}

			// title
			$title = '';
			if(isset($_POST['title'])) {
				$title = htmlentities(trim($_POST['title']));
				$_SESSION['sys_webinar_events_edit_title_val'] = $title;
				if(strlen($title) == 0) {
					$err++;
					$_SESSION['sys_webinar_events_edit_title_err'] = renderLang($webinar_events_title_required);
				} 
			}
			
			// description
			$description = '';
			if(isset($_POST['description'])) {
				$description = htmlentities(trim($_POST['description']));
				$_SESSION['sys_webinar_events_edit_description_val'] = $description;
				if(strlen($description) == 0) {
					$err++;
					$_SESSION['sys_webinar_events_edit_description_err'] = renderLang($webinar_events_description_required);
				} 
			}

			//CURRENT DATE
			$date_edited = date('F j, Y - l - h:i a', time());

			// VALIDATE FOR ERRORS
			if($err == 0) { // there are no errors

				// IMAGE
                $picture_tmp 	= $_FILES['picture']['tmp_name'];
                $picture_name 	= $_FILES['picture']['name'];
                $picture 		= time()."_".$picture_name;
				
				$picture = $picture_name;
				if (empty($picture)) {
					$picture = $_POST['file_src'];
				}

                if ($picture_tmp !== "") {
					
                    //MOVE IMAGE TO WEBINAR FOLDER
                    move_uploaded_file($picture_tmp, '../../assets/images/webinar-and-events/'.$picture);

                    //UPDATE WEBINAR TABLE
                    $update = $pdo->prepare("UPDATE webinarandevents SET
                        webinar_host 		= :webinar_host,
                        webinar_title 		= :webinar_title,
                        webinar_description = :webinar_description,
                        webinar_img 		= :webinar_img,
                        date_set			= :date_set,
                        date_edited 		= :date_edited
                    WHERE id = :webinar_id");
                    
                    $bind_param = array(
                        ':webinar_id'            		=> $webinar_id,
                        ':webinar_host'  				=> $host,
                        ':webinar_title'  	    		=> $title,
                        ':webinar_description'  		=> $description,
                        ':webinar_img'   				=> $picture,
                        ':date_set'						=> $date_set,
                        ':date_edited'					=> $date_edited
                    );
                    $update->execute($bind_param);
                    $_SESSION['sys_webinar_events_edit_suc'] = renderLang($webinar_events_updated);

                } else {

                    //UPDATE WEBINAR TABLE
                    $update = $pdo->prepare("UPDATE webinarandevents SET
                        webinar_host 		= :webinar_host,
                        webinar_title 		= :webinar_title,
                        webinar_description = :webinar_description,
                        webinar_img 		= :webinar_img,
                        date_set			= :date_set,
                        date_edited 		= :date_edited
                    WHERE id = :webinar_id");
                    
                    $bind_param = array(
                        ':webinar_id'            		=> $webinar_id,
                        ':webinar_host'  				=> $host,
                        ':webinar_title'  	  			=> $title,
                        ':webinar_description'  		=> $description,
                        ':webinar_img'   				=> $picture,
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