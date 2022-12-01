<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

 // set page
 $page = 'o-teams';

 $user_id = (isset($_GET['id']) ? $_GET['id'] : '');
 $positions_arr = getTable('positions');		
 $teams_arr = getTable('teams');	
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
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.png">
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
			<div class="announcement mb-2">
				<h2 class="mb-3"><span>Professional Bio</span></h2>
			</div>
            <?php
                // PROFILE DETAILS
                $sql = $pdo->prepare("SELECT * FROM users WHERE user_id ='".$user_id."'");
                $sql->execute();
                $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach($row as $key => $data) {
                    if($data['user_status'] != 1) {
                        ?>
                    <div class="row information mt-5">
                        <div class="col-4 text-center mx-5 shadow rounded p-5">
                        
                            <img class="profile-user-img img-fluid img-circle border mb-5" style="height:200px;width:200px;"
                            src='/assets/images/team-images/<?php echo $data['user_photo']?>' 
                            alt="User profile picture">
                            
                            
                            <p class=""><?php echo $data["user_nickname"] .'  |  '.$data["user_employee_id"]  ?> </p>
                            <h3 class="profile-username"><?php echo $data["user_firstname"].' '.$data["user_middlename"].' '.$data["user_lastname"] ?></h3>
                            
                        </div>
                        
                        <div class="col-7 mt-3">
                            <p class="text-primary font-weight-bold"><i class="fa fa-bullseye" aria-hidden="true"></i> Mantra in Life</p>
                            <p class="details mb-5">❝ <?php echo $data["user_mantra_in_life"]; ?> ❞</p>
                            
                            <p class="text-primary font-weight-bold"><i class="fa fa-code" aria-hidden="true"></i> Technical Skills</p>
                            <p class="mb-5"><?php echo $data["user_skills"]; ?></p>

                            <p class="text-primary font-weight-bold"><i class="fa fa-envelope" aria-hidden="true"></i> Email Address</p>
                            <p class="mb-5"><?php echo $data["user_email"]; ?></p>

                            <div class="row">
                                <div class="col">
                                    <p class="text-primary font-weight-bold"><i class="fa fa-users" aria-hidden="true"></i> Team</p>
                                    <?php
                                        foreach($teams_arr as $team) {
                                            if($team['id'] == $data['team_id']) {
                                                echo '<p class="">'.$team['team_name'].'</p>';
                                                break;
                                            }
                                        }
                                    ?>          
                                </div>
                                <div class="col">
                                    <p class="text-primary font-weight-bold"><i class="fa fa-sitemap" aria-hidden="true"></i> Position</p>
                                    <?php 
                                        foreach($positions_arr as $position) {
                                            if($position['position_id'] == $data["user_position"]) {
                                            echo  '<p>'.$position["position_name"].'</p>';
                                                break;
                                            }
                                        }
                                    ?>         
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-right m-5">
                        <a href="/o-teams" class="btn btn-primary">
                            <i class="fa fa-arrow-left "></i>
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
	