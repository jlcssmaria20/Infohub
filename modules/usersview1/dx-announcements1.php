<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php'); 

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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DX Infohub - Home</title>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-links.php');  ?>
        <link href="/assets/css/announcement.css" rel="stylesheet" />
    </head>
  <body>
    <div class="container">
        <div class="col-3 col-s-3 menu">
            <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-sidebar.php');  ?>
        </div>

       <section class="main-area col-s-9 d-column mb-4" >
            <div class="announcement mb-4">
                <h2 class="mb-3">IMPORTANT 
                    <span class="text-primary">ANNOUNCEMENTS</span>
                </h2>
                <div class="announcement-row">
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
    
                                echo '<li class="list-inline-item">';
                                    echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                        echo "<img src='/assets/uploadimages/".$data['announcment_img']."' class='myImg'>";
                                            echo '<br><span class="center mt-2" >';
                                                echo $data['announcment_title'];
                                            echo '</span>'; 
                                            echo  '<h2 data1="'.$data['announcment_title'].'"> </h2>';
                                            echo  '<p data2="'.$data['announcment_details'].'"> </p>';
                                    echo '</a>';
                                echo '</li>';
                               
                            
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
            <div class="modal-body">
                <img class="modal-img">
                <p class="modal-name"></p>
                <p class="modal-details"></p>
            </div>
            <div id="caption<?php echo $x ?>"></div>
                <span class="close">Close</span>
            </div>
            </div>
        <?php } ?>

        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-footer.php');  ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="assets/modal/js/lightslider.js"></script> 

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
            $('.js-modal').on('click', function() {
                var modalTarget = $(this).attr('data-target');
                var modalImg = $(this).find('img').attr('src'); 
                var modalName = $(this).find('h2').attr('data1');
                var modaldetails = $(this).find('p').attr('data2')


                $('#'+ modalTarget).show();
                $('#'+ modalTarget).find('.modal-img').attr('src', modalImg)
                $('#'+ modalTarget).find('.modal-name').html(modalName)
                $('#'+ modalTarget).find('.modal-details').html(modaldetails)
            });


        </script>
    </body>
</html>
