<?php
// INCLUDES
$module = 'generals'; $prefix = 'general'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$team = $_POST['team'];


if(empty($team)) {
	unset($_SESSION['add_team_success']);
	unset($_SESSION['add_team_exist_success']);
	$_SESSION['empty_teams'] = 'empty_teams';
	header('location:/generals');
} else {


	// check table if already exist
	$sql = $pdo->prepare("SELECT team FROM `search_tbl` WHERE team =?");
	$sql->bindParam(1, $team);
	$sql->execute();
	if( $sql->rowCount() > 0 ) { # If rows are found for query
		unset($_SESSION['add_team_success']);
		unset($_SESSION['empty_teams']);
		$_SESSION['add_team_exist_success'] = 'add_team_exist_success';
		header('location:/generals');	
	}
	else {
		unset($_SESSION['add_team_exist_success']);
		unset($_SESSION['empty_teams']);
		$_SESSION['add_team_success'] = 'add_team_success';

	    $sql = $pdo->prepare("INSERT INTO `search_tbl` (`team`) VALUES (?)");
			$sql->bindParam(1, $team);
			$sql->execute();
		}
		header('location:/generals');
}
?>