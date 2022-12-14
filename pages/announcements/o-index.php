<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 

    // set page
    $page = 'o-announcements';

    $sql = $pdo->prepare("SELECT count('announcment_title') as total FROM announcements ");
    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_ASSOC);
    $total = $data['total'];

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
        <title><?php echo $dx."Announcements"; ?></title>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
        <link href="/assets/css/announcement.css" rel="stylesheet" />
    </head>
  <body id="announcement">
    <div class="container">
        <div class="col-3 col-s-3 menu">
            <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
        </div>

       <section class="main-area col-s-9 d-column mb-4 ml-5" >
            <div class="announcement mb-4">
                <h2 class="mb-3"> 
                    <span >Important Announcements</span>
                </h2>
                <div class="announcements-row">
                    <ul class="list-inline mb-4 d-flex flex-wrap">
                        <?php
                        // The list of items to be displayed on screen.
                        $x = array();
                        $sql = $pdo->prepare("SELECT * FROM announcements WHERE temp_del = 0 ORDER BY id DESC ");
                        $sql->execute();
                        $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                        foreach($row as $key => $data) {

                            $x = $key +1;
                            if($data['announcements_status'] != 2) {
                                if($data['id'] != 0) {
        
                                    echo '<li class="list-inline-item">';
                                        echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                            echo '<img src="assets/images/announcements/'.$data['announcements_img'].'" class="myImg">';
                                                echo '<br><span class="d-inline-block text-truncate" style="max-width: 200px;" >';
                                                    echo $data['announcements_title'];
                                                echo '</span>'; 
                                                echo  '<h2 data1="'.$data['announcements_title'].'"> </h2>';
                                                echo '<p data2="'.$data['date_edit'].'"> </p>';
                                                echo  '<br><pre style="white-space: normal;display:none;"><b>Posted by: </b>';
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
                            ?>
                        
                        <?php }
                        ?>
                    </ul>
                </div>
            
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
                            <p class="modal-name pl-2 text-left"></p>
                            <span class="modal-date pl-2 text-muted font-italic"></span>
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

    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-footer.php');  ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="assets/modal/js/lightslider.js"></script> 

    <script>
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

