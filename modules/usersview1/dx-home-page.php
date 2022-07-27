<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php'); 

unset($_SESSION['dx-team-page']);
unset($_SESSION['dx-documents-and-quick-links-page']);
unset($_SESSION['dx-webinar-and-events-page']);
unset($_SESSION['dx-announcements']);

$_SESSION['dx-home-page'] = 'dx-home-page';
    // $sql = $pdo->prepare("SELECT SUM('id') as total FROM announcements ");
    // $sql->execute();
    // $data = $sql->fetch(PDO::FETCH_ASSOC);
    $total = 4;
    // $ecount = substr_count($total, 'E');
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
    </head>
  <body>
    <div class="container">
        <div class="col-3 col-s-3 menu">
            <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-sidebar.php');  ?>
        </div>
        <section class="main-area col-s-9 d-column mb-5" >
            <div class="clearfix">
                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                    <?php
                    $sql = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY images ");
                    $sql->execute();
                    $data = $sql->fetch(PDO::FETCH_ASSOC);

                    $LastID = $data['id'];
                    if($data['status'] != 1) {
                        if($data['id'] != 1) {
                        echo '<div data-thumb="/assets/uploadimages/'.$data['images'].'">';
                            echo "<img src='/assets/uploadimages/".$data['images']."' style='margin:0;width:100%; height:593px'>";
                        echo '</div>';
                        }
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
                                if($data['id'] != 1) {
                                    echo '<li data-thumb="/assets/uploadimages/'.$data['images'].'"> ';
                                        echo "<img src='/assets/uploadimages/".$data['images']."' style='margin:0;width:100%; height:593px'>";
                                        // echo '<div class="text">The text of slide one</div>';
                                    echo '</li>';
                                }     
                            }
                        }
                    }
                    ?>
                </ul> 
            </div>
        </section>
        
        <section class="main-area col-s-9 d-column mb-5" >
            <div class="webinar mb-4">
                <h2 class="mb-3">
                <span class="text-primary">WEBINAR &  EVENTS</span>
                </h2>
                <div class="webinar-row">
                    <?php
                        $x = array();
                        $sql = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY images DESC LIMIT 4");
                        $sql->execute();
                        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                        foreach($row as $key => $data) {
                            $x = $key +1;
                            if($data['status'] != 1) {
                                if($data['id'] != 1) {
                                    echo '<div class="list-inline-item">';
                                    echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                        echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                    echo '</a>';
                                    echo '</div>';
                                }
                            }
                        }
                    ?>
                </div>
            </div>
            <a href="/dx-webinar-and-events" class="btn btn-primary">See more events</a>
        </section>

        <section class="main-area col-s-9 d-column mb-4" >
            <div class="announcement mb-4">
                <h2 class="mb-3"> 
                    <span class="text-primary"> IMPORTANT ANNOUNCEMENTS</span>
                </h2>
                <div class="announcement-row">
                    <ul>
                    <?php
                    // The list of items to be displayed on screen.
                    $x = array();
                    $sql = $pdo->prepare("SELECT * FROM announcements ORDER BY announcment_title DESC LIMIT 4");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $data) {
                        $x = $key +1;
                        if($data['status'] != 1) {
                            if($data['id'] != 1) {
                                echo '<li >';
                                    echo '<a href="/dx-announcements" style="padding: 0 10px 0 0">';
                                        echo  $data['announcment_title'];
                                        echo '<i class="fa fa-arrow-right" id="fa" aria-hidden="true"></i>';
                                    echo '</a>';
                                echo '</li>';
                            }
                        }
                    }
                    ?>
                    </ul>
                </div>
            </div>
            <a href="/dx-announcements" class="btn btn-primary">See more announcements</a>
            
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
                thumbItem:9,
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

