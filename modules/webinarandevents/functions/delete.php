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
		$month_set = $_SESSION['month_set'];

		$img_count = 1;
		// if you want to tract delete 	
		// $epoch_time = time();
		// $sql = $pdo->prepare("UPDATE webinarandevents SET img_count = ".$img_count.", temp_del = ".$epoch_time." WHERE id = :id LIMIT 1");
		// $sql->bindParam(":id",$id);
		// $sql->execute();

		$sql = 'DELETE FROM webinarandevents WHERE id = :id';
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		$stmt = $pdo->prepare("SELECT * FROM webinarandevents WHERE month_set=:month_set");
		$stmt->bindParam(":month_set",$month_set);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		if($data['status'] == 0) {
			$stmt = $pdo->prepare("SELECT * FROM webinarandevents WHERE month_set=:month_set ORDER BY date_set ASC ");
			$stmt->bindParam(':month_set', $data['month_set'], PDO::PARAM_INT);
			$stmt->execute();
			$data1 = $stmt->fetch(PDO::FETCH_ASSOC);

			$sql = 'UPDATE webinarandevents SET img_count = :img_count WHERE month_set=:month_set';
			$img_count = 1;
			$statement = $pdo->prepare($sql);
			$statement->bindParam(':img_count', $img_count, PDO::PARAM_INT);
			$statement->bindParam(':month_set', $data1['month_set'], PDO::PARAM_INT);
			$statement->execute();

			$sql = 'UPDATE webinarandevents SET img_count = :img_count WHERE date_set=:date_set LIMIT 1';
			$img_count = 0;
			$statement = $pdo->prepare($sql);
			$statement->bindParam(':img_count', $img_count, PDO::PARAM_INT);
			$statement->bindParam(':date_set', $data1['date_set'], PDO::PARAM_INT);
			$statement->execute();

			header('location:/webinar-and-events');	
		}
	}
?>

