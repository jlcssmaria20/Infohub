<?php 
// INCLUDES
$module = 'webinarandevents'; $prefix = 'webinarandevent'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// select last inserted form webinar query
$stmt = $pdo->prepare("SELECT img_count,month_set FROM webinarandevents ORDER BY id DESC ");
$stmt->execute();
$data2 = $stmt->fetch(PDO::FETCH_ASSOC);


//get the second last insterted
$varArray = array(); // take a one empty array

// Filter by month set 
$stmt = $pdo->prepare("SELECT  month_set FROM webinarandevents WHERE month_set=?");
$stmt->bindParam(1, $_SESSION['setMonth']);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($row as $rows)
{
	$stmt = $pdo->prepare("SELECT count(month_set) as month_set FROM webinarandevents WHERE month_set=? < 0");
	$stmt->bindParam(1, $_SESSION['setMonth']);
	$stmt->execute();
	$secondata = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

	array_push($secondata, $rows['month_set']);
	array_push($varArray,$row[1]);
}

$limitArray = count($varArray) - 1;

// for ($x = 0; $x <= $limitArray; $x++) {	}
$sql = $pdo->prepare("SELECT img_count, date_set FROM `webinarandevents` WHERE month_set =?");
$sql->bindParam(1, $_SESSION['setMonth']);
$sql->execute();
if( $sql->rowCount() > 0 ) { # If rows are found for query
	
	if($data2['img_count'] == 0) {
		$sql = 'UPDATE webinarandevents SET img_count = :img_count WHERE month_set=:month_set LIMIT '.$limitArray.'';
		$img_count = 1;
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':month_set', $data2['month_set'], PDO::PARAM_INT);
		$statement->bindParam(':img_count', $img_count, PDO::PARAM_INT);
		// execute the UPDATE statment
		$statement->execute();
	} else {
	}

}
	
header('location:/add-webinar-and-events');

?>