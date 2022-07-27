<?php
// INCLUDES

$module = 'announcements'; $prefix = 'announcement';  $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');


if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {
	
		$id = decryptID($_POST['id']);

			$announcment_title = $_POST['announcment_title'];
			$date_edit =  date('F j, Y - l - h:i a', time());
			$announcment_details = $_POST['announcment_details'];


			$uploads_dir = '../../../assets/uploadimages';
		
			foreach ($_FILES["filename"]["error"] as $key => $error) {
		
				if ($error == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["filename"]["tmp_name"][$key];
					// basename() may prevent filesystem traversal attacks;
					$name = basename($_FILES["filename"]["name"][$key]);
					move_uploaded_file($tmp_name, "$uploads_dir/$name");
				} else {
					//$tmp_name = time()."-".rand(1000, 9999).'.jpg';
					$sql = $pdo->prepare("SELECT announcment_img FROM announcements WHERE id = :id");
					$sql->bindParam(":id",$id);
					$sql->execute();
					$data4 = $sql->fetch(PDO::FETCH_ASSOC);

					$name = $data4['announcment_img'];

					move_uploaded_file($name, "$uploads_dir/$name");

				}
			}


			$sql = 'UPDATE announcements
			SET announcment_title = :announcment_title, announcment_img = :announcment_img, date_edit=:date_edit, announcment_details=:announcment_details
			WHERE id = :id';
			// prepare statement
			$stmt = $pdo->prepare($sql);
			// bind params
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':announcment_title', $announcment_title);
			$stmt->bindParam(':announcment_img', $name);
			$stmt->bindParam(':date_edit', $date_edit);
			$stmt->bindParam(':announcment_details', $announcment_details);

			// execute the UPDATE statment
			$stmt->execute();

			$_SESSION['update_webinar_events'] = 'update_webinar_events';
			header('location:/edit-announcement/list/'.encryptID($id).'');


	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
	//	header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
//	header('location: /');

}

		?>