<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

 // set page
 $page = 'o-teams';

 $user_id = (isset($_GET['id']) ? $_GET['id'] : '');
		
 $sql = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id LIMIT 1");
 $sql->bindParam(":user_id",$user_id);
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
    <title>DX Infohub - Professional Bio</title>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
    <link href="/assets/css/profile.css" rel="stylesheet">
    <link href="/assets/css/announcement.css" rel="stylesheet"/>
</head>

<body id="profile">
	<div class="container">
        <div class="col-3 col-s-3 menu">
            <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
        </div>
        <section class="main-area col-s-9 d-column mb-4">
			<div class="announcement mb-4">
				<h2 class="mb-3"  style="color:var(--blue);" >
					<span>Professional Bio</span>
				</h2>
			</div>
            <?php
                // PROFILE DETAILS
                $sql = $pdo->prepare("SELECT * FROM users WHERE user_id ='".$user_id."'");
                $sql->execute();
                $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach($row as $key => $data) {
                    if($data['user_status'] != 1) {
                        ?>
                            <img src='/assets/images/team-images/<?php echo $data['user_photo']?>' class='myImg'>
                            <p class="name mt-3"><b><?php echo $data["user_firstname"].' '.$data["user_middlename"].' '.$data["user_lastname"] ?></b></p>
                            <p class="details"><?php echo $data["user_mantra_in_life"]; ?></p>
                            <div class="details">
                                <p><b>Position: </b><?php echo $data["user_position"]; ?></p>				
                                <p><b>Technical Skill: </b><?php echo $data["user_skills"]; ?></p>
                                <?php 
                                $sql = $pdo->prepare("SELECT team_name FROM teams WHERE id ='". $data['team_id']."'");
                                $sql->execute();
                                $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                                foreach($row as $data) {
                                    echo '<p><b>Current Team: </b>'.$data["team_name"].'</p>'; 
                                }
                                ?>
                            </div>
                            
                            <div class="text-right">
                                <a href="/o-teams" class="btn btn-primary text-right">
                                    <i class="fa fa-arrow-left mr-2"></i>
                                    <?php echo renderLang($btn_back); ?>
                                </a>
                            </div>
                    <?php } 
                } 
            ?>
        </section>
    </div>            

    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-footer.php');  ?>
    <script src="assets/modal/js/lightslider.js"></script> 
</body>
</html>

<?php
} else { // ID not found
	header('location: /o-teams');
}
?>
	