<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'view';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php');
require($_SERVER['DOCUMENT_ROOT'].'/includes/unsetSession.php');

		$fields = array(
			`employeeid`, 
			`date_start`, 
			`date_edit`, 
			`firstname`, 
			`middlename`, 
			`lastname`, 
			`email`, 
			`mobile`, 
			`photo`, 
			`status`, 
			`skills`, 
			`personal_details`, 
			`team`, 
			`position`
		);
		// get id
		$id = decryptID($_GET['id']);
		
		$sql = $pdo->prepare("SELECT * FROM ".$module." WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {
		$data = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DX Infohub - PROFILE ACCOUNTS</title>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-links.php');  ?>
    <link href="/assets/css/profile.css" rel="stylesheet">
    <link href="/assets/css/announcement.css" rel="stylesheet"/>
</head>

<body>
	<div class="container">
        <div class="col-3 col-s-3 menu">
            <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-sidebar.php');  ?>
        </div>
        <section class="main-area col-s-9 d-column mb-4" >
			<div class="announcement mb-4">
				<h2 class="mb-3">
					<span class="text-primary">PROFILE ACCOUNT</span>
				</h2>
			</div>
		<!-- echo '<i class="fa fa-download" id="fa" aria-hidden="true"></i>'; -->
		<?php
			// The list of items to be displayed on screen.
			$sql = $pdo->prepare("SELECT * FROM users WHERE id ='".$id."'");
			$sql->execute();
			$row = $sql->fetchAll(PDO::FETCH_ASSOC);

			foreach($row as $key => $data) {
				if($data['status'] != 1) {
					echo "<img src='/assets/uploadimages/".$data['photo']."' class='myImg'>";
					echo '<div class="profile-rigt">';
						echo '<p class="name"><b>'.$data["firstname"].' '.$data["lastname"].'</b></p>';
						echo '<p class="details"> "'.$data["personal_details"].'" </p>';
						echo '<div class="details">';
							echo '<p>Position: '.$data["position"].'</p>';
							echo '<p>Current Team: '.$data["team"].'</p>';
							echo '<p>Technical SKill: '.$data["skills"].'</p>';
							
						echo '</div>';
					echo '</div>';
				
				}
		
				}
		?>
		</section>
		<a href="/dx-team" class="btn btn-primary">Back</a>
		</div>            

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-footer.php');  ?>
		<script src="assets/modal/js/lightslider.js"></script> 
    </body>
</html>

<?php
} else { // ID not found
	header('location: /dx-team');
}?>
	