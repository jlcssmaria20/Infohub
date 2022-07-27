<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'list';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/includes/unsetSession.php');


$_SESSION['dx-team-page'] = 'dx-team-page';
unset($_SESSION['dx-webinar-and-events-page']);
unset($_SESSION['dx-documents-and-quick-links-page']);
	

		// clear sessions
		include($root.'/modules/'.$module.'/functions/clear.php');

		// get module icon
		include($root.'/includes/support/get-module-icon.php');
		
	
?>
<!DOCTYPE html>
<html>

<head>
	<title>Team - DX Info Hub</title>
	<link href="modules/usersview/css/styles.css" rel="stylesheet" />
	<link href="modules/usersview/css/modal.css" rel="stylesheet" />
</head>

    <body id="page-top">
        <!-- Navigation-->
        <div class="container main">
            <?php include_once '../../usersview/includes/navigation.php'; ?>
            <!-- Page Content-->
            <div class="container-fluid p-0">
                <h1 class="text-red"> The Team </h1>
                <select class="query">
                    <option>Alphabetically</option>
                </select>
               
                <section class="webinar-section">
                    <div class="webinar-section-content">
                        <ul class="webinar-list-item">
							
               <?php
			 
                    // The list of items to be displayed on screen.
                    $sql = $pdo->prepare("SELECT * FROM users");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $data) {

                        if($data['id'] != 1) {
                         if($data['status'] == 0) {
				
                            echo "<li><a href='/dx-view-profile/".encryptID($data['id'])."'><img src='/assets/uploadimages/".$data['photo']."'> </a>";
                            echo '<div class="subheading mb-3">';
                            echo $data["firstname"].' '.$data["middlename"].' '.$data["lastname"].'<br>';
                            echo '<p style="color: #727272;
                            font-size: 1rem;">'.$data["team"].'</p>';
                            echo '</div>';
                            echo '</li>';
                         }
                        }
             
                     }
                ?>
                              </ul>
                           </div>
                        </section>       
            
            </div>
        </div>

        <!--- MODAL POP-UP AREA --->
        <?php for ($x = 1; $x <= 100; $x++) { ?>
            <div id="myModal<?php echo $x ?>" class="modal">
                <img class="modal-content" id="img0<?php echo $x ?>">
            <div id="caption<?php echo $x ?>"></div>
                <span class="close">Close</span>
            </div>
        <?php } ?>

          <!-- Footer -->
          <div class="footerArea">
            <div class="footerLeft">
                <p><strong>DX Info Hub</strong>
                 powered by DX Offshore Team</p>
                <p>© transcosmos Asia Philippines 2021</p>
            </div>
            <div class="footerRight">
                <img src="modules/usersview/assets/img/dxInfo-logo-img02.png">
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
