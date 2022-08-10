<?php
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php');


if($_POST["query"]) {
	$searchData = explode(",", $_POST["query"]);
	$searchValues = "'" . implode("', '", $searchData) . "'";
	$queryQuery = "SELECT * FROM users
		WHERE team IN (".$searchValues.") ORDER BY lastname ASC" ;
} else {
	$queryQuery = "SELECT *
	FROM users ORDER BY lastname ASC";
}

$sql = $pdo->prepare($queryQuery);
$sql->execute();
$row = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $data) {
	if($data['id'] != '1') {
		if($data['status'] != '1') {
			echo '<li class="list-inline-item">';
				echo '<a href="/dx-view-profile/'.encryptID($data['id']).'"><img src="/assets/uploadimages/team-images/'.$data['photo'].'"></a><br>';
					echo '<b>'.$data["firstname"].' '.$data["lastname"].'</b><br>';
					echo '<b>'.$data["team"].'</b>';
			echo '</li>';
		}
	}
}
?>
