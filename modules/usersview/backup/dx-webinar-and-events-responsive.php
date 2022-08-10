<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php'); 
include_once 'includes/links.php';

unset($_SESSION['dx-team-page']);
unset($_SESSION['dx-documents-and-quick-links-page']);
unset($_SESSION['dx-announcements']);
unset($_SESSION['dx-home-page']);
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DX Infohub - WEBINAR & EVENTS</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/devicons/css/devicons.min.css" rel="stylesheet">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/assets/dxinfohub.min.css" rel="stylesheet">

    <style>
    

ul.webinar-list-item {
  overflow: hidden;
  padding: 0 ;
}
.webinar-list-item li {
  width: 64%;
  height: 276px;
  border-radius: 5px;
  overflow: hidden;
  margin: 0 6px 10px 0;
}

.webinar-list-item .dx-home-page {
  width: 32%;
  height: 100%;
  border-radius: 5px;
  overflow: hidden;
  margin: 0 6px 10px 4px;
}

.webinar-list-item li img {
  filter: brightness(.8);
  width: 100%;
  height: 80%;
  margin: 8px 0 0;
}

li.announcement {
  position: relative;
}


    </style>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto" src="/assets/images/logo-rrx.png" alt="DX Info Hub Logo">
        </span>
        <span class="d-block "> DX Info Hub</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">Home Page  
              <i class="fa fa-arrow-right" id="fa" aria-hidden="true"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">Webinars & Events</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">Documents & Quick Links</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">The Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">Announcements</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid p-0">
      <section class="infohub-section p-3 p-lg-5 d-flex d-column" >
        <div class="my-auto">
          <h1 class="mb-0">Webinar 
            <span class="text-primary"> & Events</span>
          </h1>
   
          <div class="webinar-section-content">
            <ul class="webinar-list-item">
               <?php
                    // The list of items to be displayed on screen.
                    $x = array();
                    $sql = $pdo->prepare("SELECT `date_set`, `title`, `img_count`, `images`,`description`, `status` FROM webinarandevents ORDER BY date_set ASC, id DESC");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $data) {
                        $x = $key +1;
                        if($data['status'] != 1) {
                            // jan
                            if(substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー', 0, 7) == 'January') {
                                echo '<div class="subheading mb-2 " id="webinarandevent'.$data['img_count'].'">';
                                echo  '<h2 class="subheading mb-1"> For ' .substr($data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])): 'ー', 0, 7).'</h2>';  
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












        </div>
      </section>

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for this template -->
    <script src="js/infohub.min.js"></script>
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
