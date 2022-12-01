<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 
$total = 4;
 // set page
 $page = 'home';
 
 $users_arr = getTable('users');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
        <title><?php echo $dx."Home"; ?></title>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
    </head>

  <body id="home">
    <div class="container" style="min-height:100vh;">
        <div class="col-3 col-s-3 menu">
            <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
        </div>
        <section class="main-area col-s-9 d-column mb-5 pl-5" >
            <div class="clearfix mb-2">
                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                    <?php
                    $sql = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY date_set DESC");
                    $sql->execute();
                    $data = $sql->fetch(PDO::FETCH_ASSOC);

                    $LastID = $data['id'];
                    if($data['webinar_status'] != 2) {
                        if($data['id'] != 0) {
                        echo '<div data-thumb="/assets/images/webinar-and-events/'.$data['webinar_img'].'">';
                            echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' style='width:100%; height: 593px; '>";
                        echo '</div>';
                        }
                    }

                    // The list of items to be displayed on screen.
                    $x = array();
                    $sql = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY date_set DESC");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($row as $key => $data) {
                        $x = $key +1;
                        if($data['webinar_status'] != 2) {
                            if($data['id'] != $LastID) {
                                if($data['id'] != 0) {
                                    echo '<li data-thumb="/assets/images/webinar-and-events/'.$data['webinar_img'].'"> ';
                                        echo "<img src='/assets/images//webinar-and-events/".$data['webinar_img']."' style='margin:0; width:100%; height: 593px; '>";
                                        // echo '<div class="text">The text of slide one</div>';
                                    echo '</li>';
                                }     
                            }
                        }
                    }
                    ?>
                </ul> 
            </div>
            <a href="/o-webinar-and-events" class="btn btn-block btn-primary">See All Events</a>
        </section>
        
        <section class="main-area col-s-9 d-column mb-5 pl-5" >
            <div class="announcement mb-5">
                <h2 class="mb-5"> 
                    <span><i class="fa fa-bullhorn"></i>&nbsp; IMPORTANT ANNOUNCEMENTS</span>
                </h2>
                <div class="announcement-row">
                    <ul class="w-50">
                    <?php
                    // The list of items to be displayed on screen.
                    $x = array();
                    $sql = $pdo->prepare("SELECT * FROM announcements WHERE announcements_status = 0 ORDER BY id DESC LIMIT 4");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $data) {
                        $x = $key +1;
                        if($data['announcements_status'] != 2) {
                            if($data['id'] != 0) {
                                echo '<li class="moving-left" style="margin-top:-20px;">';
                                    echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                        echo  '<span  class="d-inline-block text-truncate" style="max-width: 300px;">' . $data['announcements_title'] .'</span>';
                                        echo '<i class="fa fa-arrow-right" id="fa" aria-hidden="true"></i>';

                                            echo '<img src="assets/images/announcements/'.$data['announcements_img'].'" class="myImg d-none">';
  
                                            echo  '<h2 data1="'.$data['announcements_title'].'"> </h2>';
                                            echo '<p data2="'.$data['date_edit'].'"> </p>';
                                            echo  '<pre style="white-space: normal;display:none;"><b>Posted by: </b>';
                                            foreach($users_arr as $user) {
                                                if($user['user_id'] == $data['user_id']) {
                                                    echo $user['user_firstname'].' '.$user['user_lastname'];
                                                    break;
                                                }
                                            }
                                            echo '<br><br><b>Description: </b><br>'.$data['announcements_details'].'</pre>';
                                    echo '</a>';
                                echo '</li>';
                            }
                        }
                    }
                    ?>
                    </ul>
                </div>
                <a href="/o-announcements" class="btn btn-primary">See All Announcements</a>
            </div>
        </section>
        
    </div>
    <!--- MODAL POP-UP AREA --->
    <?php for ($x = 1; $x <= $total +1; $x++) {  ?>
    <div id="myModal<?php echo $x ?>" class="modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title font-weight-normal">Announcement</h4>
                    <button type="button" class="closem close mt-0" data-dismiss="modal" aria-label="Close" style="font-size:3rem;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-7 text-justify">
                            <p class="modal-name text-left font-weight-bold" style="font-size:24px;"></p>
                            <p class="modal-date pl-3 text-muted font-italic"></p>
                            <pre style="white-space: pre-wrap;" class="modal-details"></pre>
                            <div id="caption<?php echo $x ?>"></div>
                        </div>
                        <div class="col-lg-5 text-right">
                            <img class="modal-img mt-5">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary closem" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <?php } ?>
    <!-- Modal Area -->
    <?php for ($x = 1; $x <= $total + 1; $x++) { ?>
        <div id="myModal<?php echo $x ?>" class="modal">
            <div class="modal-body">
                <img class="modal-img">
            </div>
            <div id="caption<?php echo $x ?>"></div>
                <span class="close">Close</span>
            </div>
        </div>
       
    <?php } ?>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-footer.php');  ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="assets/modal/js/lightslider.js"></script> 

    <script>
        // Get the modal1
        $('.js-modal').on('click', function() {
            var modalTarget = $(this).attr('data-target');
            var modalImg = $(this).find('img').attr('src'); 

            // var modalName = $(this).find('h2').attr('data1');
            // var modaldetails = $(this).find('p').attr('data2')

            $('#'+ modalTarget).show();
            $('#'+ modalTarget).find('.modal-img').attr('src', modalImg)
            // $('#'+ modalTarget).find('.modal-name').html(modalName)
            // $('#'+ modalTarget).find('.modal-details').html(modaldetails)
        });


    	$(document).ready(function() {
			$("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:5,
                slideMargin: 0,
                speed:500,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
		});


        $('.closem').click(function() {
            for (let i = 1; i < <?php echo $total + 1?>; i++) {
            $("div#myModal"+i).attr("style", "display: none !important");
            $("div#myModal"+i).css('background-color', 'rgb(0 0 0 / 90%)');
            $("body").removeClass("modal-open");
            }
        });
        
        $("div#webinarandevent1").css("display","none")
        $("li img").on("click",function(){
            $("#sideNav").css("z-index", "0");
            $("body").addClass("modal-open");
            }).on("hidden", function () {
            $("body").removeClass("modal-open");
        });

      
        for (let i = 1; i < <?php echo $total + 1?>; i++) {
            $("div#myModal"+i).css('background-color', 'rgb(0 0 0 / 90%)');
        }
      
        // Get the modal1
        $('.js-modal').on('click', function() {
            var modalTarget = $(this).attr('data-target');
            var modalImg = $(this).find('img').attr('src'); 
            var modalName = $(this).find('h2').attr('data1');
            var modalDate = $(this).find('p').attr('data2');
            var modaldetails = $(this).find('pre').html();

            $('#'+ modalTarget).show();
            $('#'+ modalTarget).find('.modal-img').attr('src', modalImg)
            $('#'+ modalTarget).find('.modal-name').html(modalName)
            $('#'+ modalTarget).find('.modal-date').html(modalDate)
            $('#'+ modalTarget).find('.modal-details').html(modaldetails)
        });

    </script>
    </body>
</html>

