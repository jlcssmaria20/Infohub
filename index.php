<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 
$total = 4;

 // set page
 $page = 'home';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DX Infohub - Home</title>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
    </head>
  <body>
    <div class="container">
        <div class="col-3 col-s-3 menu">
            <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
        </div>
        <section class="main-area col-s-9 d-column mb-5" >
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
                            echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' style='width:100%;'>";
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
                                        echo "<img src='/assets/images//webinar-and-events/".$data['webinar_img']."' style='margin:0;width:100%; height:593px'>";
                                        // echo '<div class="text">The text of slide one</div>';
                                    echo '</li>';
                                }     
                            }
                        }
                    }
                    ?>
                </ul> 
            </div>
            <a href="/webinar-and-events" class="btn btn-block" style="background-color:var(--blue);; color: #fff;">See all events</a>
        </section>
        
        <!-- <section class="main-area col-s-9 d-column mb-5" >
            <div class="webinar mb-4">
                <h2 class="mb-3">
                <span class="text-primary">WEBINAR &  EVENTS</span>
                </h2>
                <div class="webinar-row">
                    <?php
                        $x = array();
                        $sql = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY date_set DESC LIMIT 4");
                        $sql->execute();
                        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                        foreach($row as $key => $data) {
                            $x = $key +1;
                            if($data['status'] != 1) {
                                if($data['id'] != 1) {
                                    echo '<div class="list-inline-item">';
                                    echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                        echo "<img src='/assets/images/".$data['images']."' class='myImg'>";
                                    echo '</a>';
                                    echo '</div>';
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            <a href="/dx-webinar-and-events" class="btn btn-primary">See more events</a>
        </section> -->
        
        <section class="main-area col-s-9 d-column mb-5" >
            <div class="announcement mb-5">
                <h2 class="mb-3"> 
                    <span><i class="fa fa-bullhorn"></i>&nbsp;IMPORTANT ANNOUNCEMENTS</span>
                </h2>
                <div class="announcement-row">
                    <ul>
                    <?php
                    // The list of items to be displayed on screen.
                    $x = array();
                    $sql = $pdo->prepare("SELECT * FROM announcements ORDER BY id ASC LIMIT 4");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $data) {
                        $x = $key +1;
                        if($data['announcements_status'] != 2) {
                            if($data['id'] != 0) {
                                echo '<li >';
                                    echo '<a href="/o-announcements" style="padding: 0 10px 0 0">';
                                        echo  $data['announcements_title'];
                                        echo '<i class="fa fa-arrow-right" id="fa" aria-hidden="true"></i>';
                                    echo '</a>';
                                echo '</li>';
                            }
                        }
                    }
                    ?>
                    </ul>
                </div>
                <a href="/o-announcements" class="btn">See all announcements</a>
            </div>
        </section>
    </div><!-- container -->

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
    </script>
    </body>
</html>

