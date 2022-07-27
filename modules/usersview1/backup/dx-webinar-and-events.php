<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php'); 
include_once 'includes/links.php';

unset($_SESSION['dx-team-page']);
unset($_SESSION['dx-documents-and-quick-links-page']);
$_SESSION['dx-webinar-and-events-page'] = 'dx-webinar-and-events-page';

    $sql = $pdo->prepare("SELECT count('title') as total FROM webinarandevents ");
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
                <h1 class="text-red"> Webinar & Events </h1>
                <section class="webinar-section">
                            <div class="webinar-section-content">
                                <ul class="webinar-list-item">
               <?php
                    // The list of items to be displayed on screen.
                    $x = array();
                    $sql = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY date_set ASC, id DESC");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $data) {

                        $x = $key +1;
             
                        if($data['status'] != 1) {
                            // jan
                            if(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'January') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 7).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            // feb
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'February') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 8).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            // march
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 5) == 'March') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 5).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            // April
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 5) == 'April') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 5).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            // May
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 3) == 'May') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 3).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 4) == 'June') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 4).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 4) == 'July') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 4).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            // August
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 6) == 'August') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 6).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            // September
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 9) == 'September') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 9).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            // October
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'October') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 7).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            // November
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'November') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 8).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
                                echo '</li>';
                            }
                            // December
                            elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'December') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 8).'</h2>';  
                                echo '</div>';
                                echo '<li>';
                                    echo '<span class="center mb-2" >';
                                        echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                    echo '</span>';  
                                    echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' >";
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
        <?php for ($x = 1; $x <= $total +1; $x++) {  ?>
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

            }    
            
          
       
        </script>
    </body>
</html>
