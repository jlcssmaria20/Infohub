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
    <body>
        <div class="container">
            <div class="col-3 col-s-3 menu">
                <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-sidebar.php');  ?>
            </div>

            <section class="main-area col-s-9 d-column mb-4" >
            <div class="announcement mb-4">
                <h2 class="mb-3">WEBINAR & 
                    <span class="text-primary">EVENTS</span>
                </h2>
                <div class="announcement-row">
                    <ul class="list-inline mb-4">
                        <?php
                            $x = array();
                            $sql = $pdo->prepare("SELECT * FROM webinarandevents ORDER BY date_set ASC, id DESC");
                            $sql->execute();
                            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                            foreach($row as $key => $data) {
                                $x = $key +1;
                                if($data['status'] != 1) {
                                    // jan
                                    if(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'January') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'  mb-2" id="subheading'.$key.' " > For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 7).'</h3>';  
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                            echo '</a>';  
                                        echo '</li>';
                                    }

                                     // feb
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'February') {
                                        echo '<h3 class="webinarandevent'.$data['img_count'].'  mb-2" id="subheading'.$key.'"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 8).'</h3>';  
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg'>";
                                            echo '</a>';  
                                        echo '</li>';
                                    }
                                    //march
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 5) == 'March') {
                                        echo '<div class="subheading mb-2 " class="webinarandevent'.$data['img_count'].'">';
                                        echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 5).'</h2>';  
                                        echo '</div>';
                                        echo '<li class="list-inline-item">';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' ><br>  ";
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                        echo '</li>';
                                    }
                                    // April
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 5) == 'April') {
                                        echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                        echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 5).'</h2>';  
                                        echo '</div>';
                                        echo '<li class="list-inline-item">';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' ><br>  ";
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                             echo '</span>';  
                                        echo '</li>';
                                    }
                                    // May
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 3) == 'May') {
                                        echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                        echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 3).'</h2>';  
                                        echo '</div>';
                                        echo '<li class="list-inline-item">';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' ><br>  ";
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                             echo '</span>';  
                                        echo '</li>';
                                    }
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 4) == 'June') {
                                        echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                        echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 4).'</h2>';  
                                        echo '</div>';
                                        echo '<li class="list-inline-item">';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' ><br>  ";
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                        echo '</li>';
                                    }
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 4) == 'July') {
                                        echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                        echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 4).'</h2>';  
                                        echo '</div>';
                                        echo '<li class="list-inline-item">';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' ><br>  ";
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                        echo '</li>';
                                    }
                                    // August
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 6) == 'August') {
                                        echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                        echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 6).'</h2>';  
                                        echo '</div>';
                                        echo '<li class="list-inline-item">';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' ><br>  ";
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                        echo '</li>';
                                    }
                                    // September
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 9) == 'September') {
                                        echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                        echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 9).'</h2>';  
                                        echo '</div>';
                                        echo '<li class="list-inline-item">';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' ><br>  ";
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                        echo '</li>';
                                    }
                                    // October
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'October') {
                                        echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                        echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 7).'</h2>';  
                                        echo '</div>';
                                        echo '<li class="list-inline-item">';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' ><br>  ";
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                        echo '</li>';
                                    }
                                    // November
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'November') {
                                        echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                        echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 8).'</h2>';  
                                        echo '</div>';
                                        echo '<li class="list-inline-item">';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' ><br>  ";
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                             echo '</span>';  
                                        echo '</li>';
                                    }
                                    // December
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'December') {
                                        echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                        echo  '<h2> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 8).'</h2>';  
                                        echo '</div>';
                                        echo '<li class="list-inline-item">';
                                            echo "<img src='/assets/uploadimages/".$data['images']."' class='myImg' id='myImg".$x."' ><br>  ";
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
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
                <div class="modal-body">
                    <img class="modal-img">
                </div>
                <span class="close">Close</span>
            </div>
        <?php } ?>

        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-footer.php');  ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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

                $('#'+ modalTarget).show();
                $('#'+ modalTarget).find('.modal-img').attr('src', modalImg)
            });

        </script>
    </body>
</html>
