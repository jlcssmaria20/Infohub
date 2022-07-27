<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php'); 
include_once 'includes/links.php';

unset($_SESSION['dx-team-page']);
unset($_SESSION['dx-documents-and-quick-links-page']);
unset($_SESSION['dx-webinar-and-events-page']);
unset($_SESSION['dx-announcements']);

$_SESSION['dx-home-page'] = 'dx-home-page';
    $sql = $pdo->prepare("SELECT count('announcment_title') as total FROM announcements ");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);
    $total = $data['total'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DX Info Hub</title>
        <link href="modules/usersview/css/styles.css" rel="stylesheet" />
        <link href="modules/usersview/css/modal.css" rel="stylesheet" />
        <link href="modules/usersview/slider/css/style.css" rel="stylesheet" >
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <div class="container main">
            <?php include_once 'includes/navigation.php'; ?>
            <!-- Page Content-->
            <div class="container-fluid">
                <section class="webinar-section">
                   <div class="webinar-section-content">
                   <div class="sliders" id="sliders">
                   <!-- <div class="slider active"><img src='/assets/uploadimages/dx4.jpg' style='margin:0;width:100%; height:60%;'></div> -->
                    <?php
                        $sql = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY images ");
                        $sql->execute();
                        $data = $sql->fetch(PDO::FETCH_ASSOC);

                        $LastID = $data['id'];
                        if($data['status'] != 1) {
                            echo '<div class="slider active">';
                                echo "<img src='/assets/uploadimages/".$data['images']."' style='margin:0;width:100%; height:60%;'>";
                                // echo '<div class="text">The text of slide one</div>';
                            echo '</div>';
                        }

                    // The list of items to be displayed on screen.
                    $x = array();
                    $sql = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY images ");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($row as $key => $data) {
                        $x = $key +1;
                        if($data['status'] != 1) {
                            if($data['id'] != $LastID) {
                            echo '<div class="slider">';
                                echo "<img src='/assets/uploadimages/".$data['images']."' style='margin:0;width:100%; height:60%;'>";
                                // echo '<div class="text">The text of slide one</div>';
                            echo '</div>';
                            }
                        }
                    }
                    ?>

                </div>
                    </div>
                </section>       

            </div>

            <div class="container-fluid">
                <h1 class="text-red" style="padding: 2px 17px;">WEBINAR & EVENTS</h1>
                <section class="webinar-section">
                            <div class="webinar-section-content">
                                <ul class="webinar-list-item">
                        <?php
                                // The list of items to be displayed on screen.
                                $x = array();
                                $sql = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY images DESC LIMIT 3");
                                $sql->execute();
                                $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                                foreach($row as $key => $data) {

                                    $x = $key +1;

                                    if($data['status'] != 1) {
                                        // jan
                                        echo '<li class="dx-home-page" >';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' style='margin:0;height:100%;'>";
                                            echo '<span class="announcement mb-2" >';
                                            echo '</span>'; 
                                        echo '</li>';
                                    }
                                }
                            ?>
                              </ul>
                              <a href="/dx-webinar-and-events" class="bnt bnt-events">See more events</a>
                           </div>
                        </section>       
            </div>

                <h1 class="text-red" style="padding: 2px 17px;">Important Announcements</h1>
               
                <section class="webinar-section">
                    <div class="webinar-section-content">
                    <ul class="webinar-list-item">
                        <?php
                                // The list of items to be displayed on screen.
                                $x = array();
                                $sql = $pdo->prepare("SELECT * FROM announcements ORDER BY announcment_title DESC LIMIT 5");
                                $sql->execute();
                                $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                                foreach($row as $key => $data) {
                                    $x = $key +1;
                                    if($data['status'] != 1) {
                                        // jan
                                        echo '<li class="dx-home-page">';
                                            echo  $data['announcment_title'];
                                        echo '</li>';
                                    }
                                }
                            ?>
                    </ul>
                    <a href="/dx-announcements" class="bnt bnt-events">See more announcements</a>
                    </div>
                </section>       
            
        </div>

        

        <!--- MODAL POP-UP AREA --->
        <?php for ($x = 1; $x <= $total +1; $x++) {  ?>
            <div id="myModal<?php echo $x ?>" class="modal">
                <img class="modal-content" id="img0<?php echo $x ?>">
            <div id="caption<?php echo $x ?>"></div>
         
            <div class="modal-details">
                <p class="modal-title-announcement" id="output<?php echo $x ?>"></p>
                <span class="close announcement">Close</span>
            </div>
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
        <script src="modules/usersview/slider/js/slider.js"></script>
        <script src="modules/usersview/slider/scirpt.js"></script>

        <script>

         

            // var txt = $('.announcement span').text();
            // alert(txt);



          
            $('.close').click(function() {
                for (let i = 1; i < <?php echo $total + 1?>; i++) {
                $("div#myModal"+i).attr("style", "display: none !important");
                }
            });
            
            $("div#webinarandevent1").css("display","none")
            $("li img").on("click",function(){
                $("#sideNav").css("z-index", "0")
            });

            // Get the modal1
            for (let i = 1; i < <?php echo $total +1; ?>; i++) {
            var modal = document.getElementById("myModal"+i);

                // Get the image and insert it inside the modal - use its "alt" text as a caption
                var img = document.getElementById("myImg"+i);
                var modalImg = document.getElementById("img0"+i);
                var captionText = document.getElementById("caption"+i);
                img.onclick = function() {
                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;
                }
              
               $('#output'+i).html($('#announcement0'+i).text());
                // txt = $('#announcement0'+i).text();
                // alert(modalImg);
             
            }    
             
         
       
        </script>
    </body>
</html>
