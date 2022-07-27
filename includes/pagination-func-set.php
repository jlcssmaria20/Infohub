<?php 
$module = 'announcements'; $prefix = 'announcement'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$pagination_active = $_POST['pagination_active'];
$id = $_POST['id'];
$submodule = $_POST['submodule'];
$sql = 'UPDATE pagination_set_active SET pagination_active=:pagination_active WHERE id = :id';
// prepare statement
$stmt = $pdo->prepare($sql);
// bind params
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->bindParam(':pagination_active', $pagination_active);
$stmt->execute();

header('location:/'.$submodule.'');
?>