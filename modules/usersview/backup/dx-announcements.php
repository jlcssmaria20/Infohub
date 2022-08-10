<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php'); 
include_once 'includes/links.php';

unset($_SESSION['dx-team-page']);
unset($_SESSION['dx-documents-and-quick-links-page']);
unset($_SESSION['dx-webinar-and-events-page']);
unset($_SESSION['dx-home-page']);
$_SESSION['dx-announcements'] = 'dx-announcements';

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
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <div class="container main">
            <?php include_once 'includes/navigation.php'; ?>
            <!-- Page Content-->
            <div class="container-fluid p-0">
                <h1 class="text-red">Announcements</h1>
                <section class="webinar-section">
                    <div class="webinar-section-content">
                        <ul class="webinar-list-item">
                        <?php
                            // The list of items to be displayed on screen.
                            $x = array();
                            $sql = $pdo->prepare("SELECT * FROM announcements ORDER BY announcment_details DESC");
                            $sql->execute();
                            $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                            foreach($row as $key => $data) {

                                $x = $key +1;

                                if($data['status'] != 1) {
                                if($data['id'] != 1) {
                                    // jan
                                    echo '<li class="announcement">';
                                    echo "<img src='/assets/uploadimages/".$data['announcment_img']."' onclick='title()' class='myImg' id='myImg".$x."' >";
                                        echo '<span class="announcement mb-2" >';
                                            echo $data['announcment_title'];
                                        echo '</span>'; 
                                    echo '</li>';
                                    echo "<div id='announcement".$x."'' style='display:none;' class='myImg' >".$data['announcment_title']."</div>";
                                }
                            }
                        ?>
                        <?php
                            }
                        ?>
                        </ul>
                    </div>
                </section>       
            </div>
        </div>

        

        <!--- MODAL POP-UP AREA --->
        <?php for ($x = 1; $x <= $total +1; $x++) {  ?>
            <div id="myModal<?php echo $x ?>" class="modal">
                <img class="modal-content" id="img0<?php echo $x ?>">
            <div id="caption<?php echo $x ?>"></div>
            <div class="modal-details">
                <p class="modal-title-announcement" id="modal-title<?php echo $x ?>">1</p>
                <p class="details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                </p>
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
                var modalTitle = document.getElementById("announcement"+i);

                img.onclick = function() {
                    modal.style.display = "block";
                    modalImg.src = this.src;
                    captionText.innerHTML = this.alt;
                    modalImg.src = this.src;
                }
                function title() {
                    $("#modal-title"+i).html(modalTitle);
                }

                //$("#announcement1").trigger("select");
                    //    $('#modal-title'+i).html($('#announcement0'+i).text());

                    //     txt = $('#announcement0'+i).text();
              

                // alert(txt);
             
            }    
             
         
       
        </script>
    </body>
</html>
