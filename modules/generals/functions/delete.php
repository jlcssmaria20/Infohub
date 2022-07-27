<?php
// INCLUDES
$module = 'generals'; $prefix = 'general'; $process = 'delete';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
		// PROCESS FORM
		$id = $_GET['id'];

		$sql = 'DELETE FROM search_tbl WHERE id = :id';
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();


		$_SESSION['delete_success'] = 'delete_success';
		unset($_SESSION['update_user_success']);

		header('location:/edit-general');

?>