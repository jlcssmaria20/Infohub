<?php
$module = 'search_tbl'; $prefix = 'search_tb'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

	$id = $_POST['id'];
	$team = $_POST['team'];
	$sql = 'UPDATE search_tbl SET 
	team = :team WHERE id = :id';
	$stmt = $pdo->prepare($sql);
	// bind params
	$stmt->bindParam(':team', $team);
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	
$_SESSION['update_user_success'] = 'update_user_success';
unset($_SESSION['delete_success']);
unset($_SESSION['restored_success']);
header('location:/edit-general');



?>