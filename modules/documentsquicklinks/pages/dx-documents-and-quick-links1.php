<?php 
$module = 'documentsquicklinks'; $prefix = 'documentsquicklink'; $process = 'list';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php');

$_SESSION['dx-documents-and-quick-links-page'] = 'dx-documents-and-quick-links-page';

unset($_SESSION['dx-webinar-and-events-page']);
unset($_SESSION['dx-team-page']);
unset($_SESSION['dx-announcements']);
unset($_SESSION['dx-home-page']);
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
        <link href="/assets/css/documents.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="col-3 col-s-3 menu">
                <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-sidebar.php');  ?>
            </div>

            <section class="main-area col-s-9 d-column mb-4" >
            <div class="announcement mb-4">
                <h2 class="mb-3">DOCUMENTS & 
                    <span class="text-primary">Quick Links</span>
                </h2>
                    <ul class="list-inline mb-4">
                    <?php
                            $x = array();
                            // The list of items to be displayed on screen.
                            $sql = $pdo->prepare("SELECT * FROM documentsquicklinks");
                            $sql->execute();
                            $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                            foreach($row as $key => $data) {

                                $x = $key +1;
                                if($data['status'] != 1) {
                                    echo "<a href='/dx-documents-and-quick-links-template".$x."/".encryptID($data['id'])." class='list-inline-item''>";
                                        echo '<li class="list-dl-item">';
                                            echo '<i class="fa fa-arrow-right" id="fa" aria-hidden="true"></i>';
                                            echo $data["docu_name"];
                                        echo '</li>';
                                    echo  "</a>";
                                }
                    
                            }
                        ?>
                    </ul>
                </div>
            </section>       
            </div>
        </div>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-footer.php');  ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="assets/modal/js/lightslider.js"></script> 
    </body>
</html>
