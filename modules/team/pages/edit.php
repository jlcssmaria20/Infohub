<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'list';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

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
	<title>Team - DX Info Hub</title>
	<link href="/assets/css/styles.css" rel="stylesheet" />
	<link href="/assets/css/modal.css" rel="stylesheet" />
</head>

<body id="page-top">
        <!-- Navigation-->
        <div class="container main">
			<?php include_once '../../usersview/includes/navigation.php'; ?>
            <!-- Page Content-->
            <div class="container-fluid p-0">
                <h1 class="text-red"> Individual Profile </h1>
               
                <section class="webinar-section">
                   <div class="webinar-section-content">
                       
               <?php
                     $sql = $pdo->prepare("SELECT `firstname`, `middlename`, `lastname`,  
                     `photo`, `skills`, `personal_details`, `team`, `position` FROM users WHERE id = $id");
                     $sql->execute();
                     $row = $sql->fetchAll(PDO::FETCH_ASSOC);
 
                     foreach($row as $data) {
                     
                        echo "<img src='/assets/uploadimages/".$data['photo']."' id='myImg'>";
                        echo '<div class="subheading mb-3">';
                        echo $data["firstname"].' '.$data["middlename"].' '.$data["lastname"];
                        echo '</div>';
                        echo '<div class="grey mb-3">';
                        echo '“'.$data["personal_details"].'”';
                        echo '</div>';
                        echo '<div class="black mb-3">';
                        echo 'Current Team: '.$data["team"].'<br>';
                        echo 'Position: '.$data["position"].'<br>';
                        echo 'Technical Skills: '.$data["skills"].'<br>';
                        echo '</div>';

                      }

                ?>
                            
                           </div>
                        </section>       
            
            </div>
        </div>

        <!--- MODAL POP-UP AREA --->
        <?php for ($x = 1; $x <= 100; $x++) { ?>
            <!-- <div id="myModal<?php //echo $x ?>" class="modal">
                <img class="modal-content" id="img0<?php //echo $x ?>">
            <div id="caption<?php //echo $x ?>"></div>
                <span class="close">Close</span>
            </div> -->
        <?php } ?>

          <!-- Footer -->
          <div class="footerArea">
            <div class="footerLeft">
                <p><strong>DX Info Hub</strong>
                 powered by DX Offshore Team</p>
                <p>© transcosmos Asia Philippines 2021</p>
            </div>
            <div class="footerRight">
                <img src="/assets/img/dxInfo-logo-img02.png">
            </div>
        </div>

        <!-- Bootstrap core JS-->
        <!-- Core theme JS-->
        <script src="modules/usersview/js/scripts.js"></script>
        <script src="modules/usersview/js/jquery.js"></script>
        <script src="modules/usersview/js/modal.js"></script>

        <script>
            $('.close').click(function() {
                var x = document.querySelectorAll("div#myModal11");
                x[0].style.setProperty("display", "none", "important");
            });

            $("#webinarandevent1").css("display","none")

            $("li img").on("click",function(){
                $("#sideNav").css("z-index", "0")
            });

            
        </script>
    </body>


</html>
<?php

} else { // ID not found
	//header('location: /dx-team');
}?>
