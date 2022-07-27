<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php'); 

unset($_SESSION['dx-team-page']);
unset($_SESSION['dx-documents-and-quick-links-page']);
unset($_SESSION['dx-home-page']);
unset($_SESSION['dx-announcements']);
$_SESSION['dx-webinar-and-events-page'] = 'dx-webinar-and-events-page';

    $sql = $pdo->prepare("SELECT count('title') as total FROM webinarandevents ");
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
        <title>DX Infohub - WEBINAR & EVENTS</title>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-links.php');  ?>
        <link href="/assets/css/announcement.css" rel="stylesheet" />
    </head>
    <body id="webinar">
        <div class="container">
            <div class="col-3 col-s-3 menu">
                <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-sidebar.php');  ?>
            </div>

            <section class="main-area col-s-9 d-column mb-4" >
            <div class="announcement mb-4">
                <h2 class="mb-3">
                    <span class="text-primary">WEBINAR & EVENTS</span>
                </h2>
                <div class="announcement-row">
                    <ul class="list-inline mb-4">
                        <?php
                            $x = array();
                            $sql = $pdo->prepare("SELECT * FROM webinarandevents where YEAR(date_set) = YEAR(CURDATE()) ORDER BY date_set ASC");
                            $sql->execute();
                            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                            foreach($row as $key => $data) {
                                $x = $key +1;
                                if($data['status'] != 1) {
                                    if($data['id'] != 1) {
                                    // jan
                                    if(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'January') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.' " > For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 7).'</h3>';  
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="#myModal'.$x.'">';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                            echo '</a>';  
                                        echo '</li>';
                                    }
                                    // feb
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'February') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 8).'</h3>';  
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
                                    //march
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 5) == 'March') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 5).'</h3>';  
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
                                    // April
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 5) == 'April') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 5).'</h3>';  
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
                                    // May
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 3) == 'May') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 3).'</h3>'; 
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
                                    // june
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 4) == 'June') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 4).'</h3>'; 
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
                                     // july
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 4) == 'July') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 4).'</h3>';
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
                                    // August
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 6) == 'August') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 6).'</h3>';
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
                                    // September
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 9) == 'September') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 9).'</h3>';
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
                                    // October
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'October') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 7).'</h3>';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
                                    // November
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'November') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 8).'</h3>';
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
                                    // December
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'December') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 8).'</h3>';
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                                echo  '<p data1="'.$data['description'].'"> </p>';
                                                echo '</a>';  
                                        echo '</li>';
                                    }
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
        <?php echo $total; for ($x = 1; $x <= $total +1; $x++) {  ?>
            <div id="myModal<?php echo $x ?>" class="modal">
                <div class="modal-body">
                    <img class="modal-img">
                    <span class="close">Close</span>
                </div>
            </div>
        <?php } ?>

        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-footer.php');  ?>
        <script src="assets/modal/js/lightslider.js"></script> 

        <script>
            $('.close').on('click', function() {
                for (let i = 1; i < <?php echo $total + 1?>; i++) {
                    $("#myModal"+i).attr("style", "display: none !important");
                }
            });
            // $("h3#subheading6").attr("style", "display: block !important; width:100%;overflow:hidden;font-size:0px;");
            $(".webinarandevent1").attr("style","display:none");
        
            
            // Get the modal1
            $('.js-modal').on('click', function() {
                var modalTarget = $(this).attr('data-target');
                var modalImg = $(this).find('img').attr('src'); 
                var modaldetails = $(this).find('p').attr('data1')

                $('#'+ modalTarget).show();
                $('#'+ modalTarget).find('.modal-img').attr('src', modalImg)
                $('#'+ modalTarget).find('.modal-details').html(modaldetails)
            });

        </script>
    </body>
</html>
