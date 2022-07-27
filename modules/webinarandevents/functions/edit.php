<?php
// INCLUDES

$module = 'webinarandevents'; $prefix = 'webinarandevent';  $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');


if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {
	
		$id = decryptID($_POST['id']);

			$title = $_POST['title'];
			$date_set =  date('Ymd',strtotime($_POST['date_set']));
			$current_date =  date('F j, Y - l - h:i a', time());
			$description = $_POST['description'];
			$uploads_dir = '../../../assets/uploadimages';
		
			foreach ($_FILES["filename"]["error"] as $key => $error) {
		
				if ($error == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["filename"]["tmp_name"][$key];
					// basename() may prevent filesystem traversal attacks;
					$name = basename($_FILES["filename"]["name"][$key]);
					move_uploaded_file($tmp_name, "$uploads_dir/$name");
				} else {
					//$tmp_name = time()."-".rand(1000, 9999).'.jpg';
					$sql = $pdo->prepare("SELECT date_set, images FROM webinarandevents WHERE id = :id");
					$sql->bindParam(":id",$id);
					$sql->execute();
					$data4 = $sql->fetch(PDO::FETCH_ASSOC);
					$name = $data4['images'];
					move_uploaded_file($name, "$uploads_dir/$name");
				}
			}
			$sql = 'UPDATE webinarandevents
			SET title = :title, images = :images, date_set=:date_set, date_now=:date_now, description=:description
			WHERE id = :id';
			// prepare statement
			$stmt = $pdo->prepare($sql);
			// bind params
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':images', $name);
			$stmt->bindParam(':date_set', $date_set);
			$stmt->bindParam(':date_now', $current_date);
			$stmt->bindParam(':description', $description);
			$stmt->execute();

			$stmt = $pdo->prepare("SELECT * FROM webinarandevents WHERE id=:id ");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			$month_set = $data['month_set'];

			$sql = 'UPDATE webinarandevents SET img_count = :img_count WHERE month_set=:month_set ';
			$img_count = 1;
			$statement = $pdo->prepare($sql);
			$statement->bindParam(':img_count', $img_count, PDO::PARAM_INT);
			$statement->bindParam(':month_set', $month_set, PDO::PARAM_INT);
			$statement->execute();


			$stmt = $pdo->prepare("SELECT * FROM webinarandevents WHERE month_set=:month_set ORDER BY date_set ASC ");
			$stmt->bindParam(':month_set', $month_set, PDO::PARAM_INT);
			$stmt->execute();
			$data = $stmt->fetch(PDO::FETCH_ASSOC);


			$sql = 'UPDATE webinarandevents SET img_count = :img_count WHERE date_set=:date_set ORDER BY date_set ASC LIMIT 1';
			$img_count = 0;
			$statement = $pdo->prepare($sql);
			$statement->bindParam(':img_count', $img_count, PDO::PARAM_INT);
			$statement->bindParam(':date_set', $data['date_set'], PDO::PARAM_INT);
			$statement->execute();
			

		
		$_SESSION['update_webinar_events'] = 'update_webinar_events';
		header('location:/edit-webinarandevent/list/'.encryptID($id).'');


	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
	//	header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
//	header('location: /');

}

		?>