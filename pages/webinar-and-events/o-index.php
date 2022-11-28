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
				<div class="row">
					<div class="col-lg-9">
						<h2 class="mb-3">
							Webinar and Events
						</h2>
					</div>
					<div class="col-lg-3">
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search" class="form-control mr-2 px-2">
					</div>
				</div>
                <div class="announcement-row">
                    <ul class="list-inline mb-4" id="myUL">
                   
                        <?php
                            $x = array();
                            $sql = $pdo->prepare("SELECT * FROM webinarandevents where YEAR(date_set) >= YEAR(CURDATE()) ORDER BY date_set DESC");
                            $sql->execute();
                            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
							$dateHandler =0;
							
                            foreach($row as $key => $data) {
                                // echo $data['date_set'];
                                $x = $key +1;
                                if($data['webinar_status'] != 2) {
                                    if($data['id'] != 0) {
                                   
									if ($dateHandler != date('Y',strtotime($data['date_set']))){
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
									}
                                    $dateHandler = date('Y',strtotime($data['date_set']));
									 // jan
                                    if(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'January') {
                                        $data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$counter.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $counter++;
                                    }
                                    
                                    // feb
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'February') {
										$data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$counterfeb.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $counterfeb++;
                                    }
                                    //march
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 5) == 'March') {
                                        $data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$countermar.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $countermar++;
                                    }
                                    // April
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 5) == 'April') {
										$data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$counterapr.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $counterapr++;
                                    }
                                    // May
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 3) == 'May') {
										$data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$countermay.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $countermay++;
                                    }
                                    // june
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 4) == 'June') {
										$data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$counterjun.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $counterjun++;
                                    }
                                     // july
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 4) == 'July') {
										$data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$counterjul.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $counterjul++;
                                    }
                                    // August
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 6) == 'August') {
										$data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$counteraug.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $counteraug++;
                                    }
                                    // September
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 9) == 'September') {
										$data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$countersep.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $countersep++;
                                    }
                                    // October
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'October') {
										$data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$counteroct.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $counteroct++;
                                    }
                                    // November
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'November') {
										$data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$counternov.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
                                        $counternov++;
                                    }
                                    // December
                                    elseif(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 8) == 'December') {
										$data_date =  date('F j, Y',strtotime($data['date_set']));
										$data_month =  date('F',strtotime($data['date_set']));
										echo '<h3 style="display:none; font-size: 1.3rem;" class="for-'.$data_month.'-class_'.$counterdec.'" id="subheading'.$key.' ">For '.$data_month.' '.$dateHandler.'</h3>';  
										include($_SERVER['DOCUMENT_ROOT'].'/pages/webinar-and-events/content.php');  
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
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title font-weight-normal">Webinar and Event Details</h4>
                            <button type="button" class="closem close mt-0" data-dismiss="modal" aria-label="Close" style="font-size:3rem;">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-7">
                                    <p class="modal-name p-2 mb-1"></p>
									<p class="modal-date ml-2 text-muted font-weight-bold"></p>
                                    <pre style="white-space: pre-wrap;" class="modal-details"></pre>
                                    <div id="caption<?php echo $x ?>"></div>
                                </div>
                                <div class="col-lg-5 text-right">
                                    <img class="modal-img" alt="Webinar and Events">
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
        <script src="assets/modal/js/lightslider.js"></script> 

        <script>
			function myFunction() {
				var input, filter, ul, li, a, i, txtValue;
				input = document.getElementById("myInput");
				filter = input.value.toUpperCase();
				ul = document.getElementById("myUL");
				li = ul.getElementsByTagName("li");
				for (i = 0; i < li.length; i++) {
					a = li[i].getElementsByTagName("a")[0];
					txtValue = a.textContent || a.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						li[i].style.display = "";
					} else {
						li[i].style.display = "none";
					}
				}
			}
			
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
            $(".for-January-class_0").show();
            $(".for-February-class_0").show();
            $(".for-March-class_0").show();
            $(".for-April-class_0").show();
            $(".for-May-class_0").show();
            $(".for-June-class_0").show();
            $(".for-July-class_0").show();
            $(".for-August-class_0").show();
            $(".for-September-class_0").show();
            $(".for-October-class_0").show();
            $(".for-November-class_0").show();
            $(".for-December-class_0").show();
            
            // Get the modal1
            $('.js-modal').on('click', function() {
            var modalTarget = $(this).attr('data-target');
            var modalImg = $(this).find('img').attr('src'); 
            var modalName = $(this).find('h2').attr('data1');
            var modalDate = $(this).find('h4').attr('datadate');
            var modaldetails = $(this).find('pre').html();

            $('#'+ modalTarget).show();
            $('#'+ modalTarget).find('.modal-img').attr('src', modalImg)
            $('#'+ modalTarget).find('.modal-name').html(modalName)
            $('#'+ modalTarget).find('.modal-date').html(modalDate)
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
