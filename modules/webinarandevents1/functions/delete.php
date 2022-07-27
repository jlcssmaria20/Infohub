<?php
// INCLUDES
$module = 'webinarandevents'; $prefix = 'webinarandevent'; $process = 'delete';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

unset($_SESSION['update_webinar_events']);
$_SESSION['delete_success'] = 'delete_success';
	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		// PROCESS FORM
		$id = decryptID($_POST['id']);

		//delete user from users table

		$sql = 'DELETE FROM webinarandevents WHERE id = :id';
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		$epoch_time = time();
		$sql = $pdo->prepare("UPDATE webinarandevents SET status = 1, temp_del = ".$epoch_time." WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
		$sql->execute();

		$stmt = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY id DESC ");
		$stmt->execute();
		$data2 = $stmt->fetch(PDO::FETCH_ASSOC);

		if($data2['status'] == 0) {
			$stmt = $pdo->prepare("SELECT * FROM webinarandevents WHERE status = 0 ORDER BY date_set ASC ");
			$stmt->execute();
			$data3 = $stmt->fetch(PDO::FETCH_ASSOC);

			$sql = 'UPDATE webinarandevents SET img_count = :img_count WHERE date_set=:date_set LIMIT 1';
			$img_count = 0;
			$statement = $pdo->prepare($sql);
			$statement->bindParam(':img_count', $img_count, PDO::PARAM_INT);
			$statement->bindParam(':date_set', $data3['date_set'], PDO::PARAM_INT);
			$statement->execute();

			header('location:/webinar-and-events');	
			
		}
	}
?>

