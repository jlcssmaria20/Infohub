<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 

    // set page
    $page = 'o-webinar-and-events';

    $sql = $pdo->prepare("SELECT count('title') as total FROM webinarandevents ");
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
	    <title><?php echo $dx."Webinar and Events"; ?></title>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
        <link href="/assets/css/announcement.css" rel="stylesheet" />
        <style>
            .modal-color {
                background-color: black;
            }
        </style>
    </head>
    <body id="webinar">
        <div class="container">
            <div class="col-3 col-s-3 menu">
                <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
            </div>

            <section class="main-area col-s-9 d-column mb-4 ml-5" >
            <div class="announcement mb-4">
                <h2 class="mb-3">
                    <span>Webinar and Events</span>
                </h2>
                <div class="announcement-row">
                    <ul class="list-inline mb-4">
                   
                        <?php
                            $x = array();
                            $sql = $pdo->prepare("SELECT * FROM webinarandevents where YEAR(date_set) >= YEAR(CURDATE()) ORDER BY date_set ASC");
                            $sql->execute();
                            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                            $counter = 0;
                                $counterfeb = 0;
                                $countermar = 0;
                                $counterapr = 0;
                                $countermay = 0;
                                $counterjun = 0;
                                $counterjul = 0;
                                $counteraug = 0;
                                $countersep = 0;
                                $counteroct = 0;
                                $counternov = 0;
                            $counterdec = 0;
                            foreach($row as $key => $data) {
                                // echo $data['date_set'];
                                $x = $key +1;
                                if($data['webinar_status'] != 2) {
                                    if($data['id'] != 0) {
                                    // jan
                                    
                                    if(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'January') {
                                        echo '<h3 style="display:none; font-size: 1.3rem;" class="for-january-class_'.$counter.'" id="subheading'.$key.' ">For January</h3>';  
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'">';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                            echo '</a>';  
                                        echo '</li>';
                                        $counter++;
                                    }
                                    
                                    // feb
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'February') {
                                        echo '<h3 style="display:none; font-size: 1.3rem;" class="for-february-class_'.$counterfeb.'" id="subheading'.$key.' ">For February</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                   echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $counterfeb++;
                                    }
                                    //march
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 5) == 'March') {
                                        echo '<h3 style="display:none; font-size: 1.3rem;" class="for-march-class_'.$countermar.'" id="subheading'.$key.' ">For March</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                  echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                     echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $countermar++;
                                    }
                                    // April
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 5) == 'April') {
                                        echo '<h3 style="display:none ; font-size: 1.3rem;" class="for-april-class_'.$counterapr.'" id="subheading'.$key.' ">For April</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                  echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                     echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $counterapr++;
                                    }
                                    // May
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 3) == 'May') {
                                        
                                        echo '<h3 style="display:none ; font-size: 1.3rem;" class="for-may-class_'.$countermay.'" id="subheading'.$key.' ">For May</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                   echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $countermay++;
                                    }
                                    // june
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 4) == 'June') {
                                        echo '<h3 style="display:none ; font-size: 1.3rem;" class="for-june-class_'.$counterjun.'" id="subheading'.$key.' ">For June</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                  echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                     echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $counterjun++;
                                    }
                                     // july
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 4) == 'July') {
                                        echo '<h3 style="display:none ; font-size: 1.3rem;" class="for-july-class_'.$counterjul.'" id="subheading'.$key.' ">For July</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                  echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                     echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $counterjul++;
                                    }
                                    // August
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 6) == 'August') {
                                        echo '<h3 style="display:none ; font-size: 1.3rem;" class="for-august-class_'.$counteraug.'" id="subheading'.$key.' ">For August</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                  echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                     echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $counteraug++;
                                    }
                                    // September
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 9) == 'September') {
                                        echo '<h3 style="display:none ; font-size: 1.3rem;" class="for-september-class_'.$countersep.'" id="subheading'.$key.' ">For September</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                  echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                     echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $countersep++;
                                    }
                                    // October
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'October') {
                                        echo '<h3 style="display:none ; font-size: 1.3rem;" class="for-october-class_'.$counteroct.'" id="subheading'.$key.' ">For October</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                  echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                     echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $counteroct++;
                                    }
                                    // November
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'November') {
                                        echo '<h3 style="display:none ; font-size: 1.3rem;" class="for-november-class_'.$counternov.'" id="subheading'.$key.' ">For November</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                  echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                     echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $counternov++;
                                    }
                                    // December
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'December') {
                                        echo '<h3 style="display:none ; font-size: 1.3rem;" class="for-december-class_'.$counterdec.'" id="subheading'.$key.' ">For December</h3>' ;
                                        echo '<li class="list-inline-item">';
                                            echo '<span class="center mt-2" >';
                                                echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
                                            echo '</span>';  
                                            echo '<a href="javascript:void(0)" class="js-modal" data-target="myModal'.$x.'" >';
                                                echo "<img src='/assets/images/webinar-and-events/".$data['webinar_img']."' class='myImg'>";
                                                echo  '<h2 data1="'.$data['webinar_title'].'"> </h2>';
                                                   echo  '<pre style="white-space: normal;display:none;">Host: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_host']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                echo ' <br>Speaker: ';
                                                foreach($users_arr as $user) {
													if($user['user_employee_id'] == $data['webinar_speaker']) {
														echo $user['user_firstname'].' '.$user['user_lastname'];
														break;
													}
												}
                                                if ($user['user_employee_id'] != $data['webinar_speaker'] ) {
													echo $data['webinar_speaker'];
												}
                                                echo ' <br>'.$data['webinar_description'].'</pre>';
                                                echo '</a>';  
                                        echo '</li>';
                                        $counterdec++;
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
        <?php for ($x = 1; $x <= $total +1; $x++) {  ?>
            <div id="myModal<?php echo $x ?>" class="modal">
                <div class="modal-body my-5">
                    <img class="modal-img mt-5" alt="Webinar and Events">
                    <div class="text-left">
                        <p class="modal-name"></p>
                        <pre style="white-space: pre-wrap;width:600px;color:white; font-size: 16px; font-family: 'Source Sans Pro', sans-serif;" class="modal-details"></pre>
                    <div id="caption<?php echo $x ?>">
                    </div>
                    <div class="text-center my-3">
                        <button class="btn btn-primary closem">Close</button>
                    </div>

                </div>
                </div>
                
            </div>
        <?php } ?>

        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-footer.php');  ?>
        <script src="assets/modal/js/lightslider.js"></script> 

        <script>
            $('.closem').click(function() {
                for (let i = 1; i < <?php echo $total + 1?>; i++) {
                $("div#myModal"+i).attr("style", "display: none !important");
                $("div#myModal"+i).css('background-color', 'rgb(0 0 0 / 90%)');
                $("body").removeClass("modal-open");
            }
            });
            for (let i = 1; i < <?php echo $total + 1?>; i++) {
                $("div#myModal"+i).css('background-color', 'rgb(0 0 0 / 90%)');
            }
            // $("h3#subheading6").attr("style", "display: block !important; width:100%;overflow:hidden;font-size:0px;");
            $(".webinarandevent1").attr("style","display:none");
            $(".for-january-class_0").show();
            $(".for-february-class_0").show();
            $(".for-march-class_0").show();
            $(".for-april-class_0").show();
            $(".for-may-class_0").show();
            $(".for-june-class_0").show();
            $(".for-july-class_0").show();
            $(".for-august-class_0").show();
            $(".for-september-class_0").show();
            $(".for-october-class_0").show();
            $(".for-november-class_0").show();
            $(".for-december-class_0").show();
            
            // Get the modal1
            $('.js-modal').on('click', function() {
            var modalTarget = $(this).attr('data-target');
            var modalImg = $(this).find('img').attr('src'); 
            var modalName = $(this).find('h2').attr('data1');
            var modaldetails = $(this).find('pre').html();

            $('#'+ modalTarget).show();
            $('#'+ modalTarget).find('.modal-img').attr('src', modalImg)
            $('#'+ modalTarget).find('.modal-name').html(modalName)
            $('#'+ modalTarget).find('.modal-details').html(modaldetails)
            });

            $("div#webinarandevent1").css("display","none")
            $("li img").on("click",function(){
                $("#sideNav").css("z-index", "0");
                $("body").addClass("modal-open");
                }).on("none", function () {
                $("body").removeClass("modal-open");
            });

        </script>
    </body>
</html>
