<?php
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 

if($_POST["query"]) {
	$searchData = explode(",", $_POST["query"]);
	$searchValues = "'" . implode("', '", $searchData) . "'";
	$queryQuery = "SELECT * FROM users
		WHERE team_id IN (".$searchValues.") ORDER BY user_lastname ASC" ;
} else {
	$queryQuery = "SELECT *
	FROM users ORDER BY user_lastname ASC";
}
// LIST OF USERS.
$sql = $pdo->prepare($queryQuery);
$sql->execute();
$row = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $key => $data) {
	$id = $data['team_id'];
	if($id != '0') {
		if($data['user_status'] == '0') {

			echo "<li class='list-inline-item text-center'><a href='/o-user-profile/".$data['user_id']."'>
			<img src='/assets/images/team-images/".$data['user_photo']."'>";
			echo '<div class="subheading mb-3 mt-2">';
			echo '<span class="d-inline-block text-truncate" style="max-width: 180px;">'.$data["user_firstname"].' '.$data["user_lastname"].'</span><br>';
				
			$sql = $pdo->prepare("SELECT team_name FROM teams WHERE id ='". $data['team_id']."'");
			$sql->execute();
			$row = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach($row as $data) {
				echo '<b class="d-inline-block text-truncate" style="max-width: 150px;">'.$data["team_name"].'</b>'; 
			}
			echo '</div> </a>';
			echo '</li>';
		}
	}

}
?>