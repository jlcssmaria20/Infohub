<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

 // set page
 $page = 'o-documents';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DX Infohub - WEBINAR & EVENTS</title>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
        <link href="/assets/css/documents.css" rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <div class="col-3 col-s-3 menu">
                <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
            </div>

            <section class="main-area col-s-9 d-column mb-4">
            <div class="mb-4">
                <h2 class="mb-3">
                    <span  style="color: var(--black);">Documents and Quick Links</span>
                </h2>
                    <ul class="list-inline mb-4">
                    <?php
                            $x = array();
                            // The list of items to be displayed on screen.
                            $sql = $pdo->prepare("SELECT * FROM documents");
                            $sql->execute();
                            $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                            foreach($row as $key => $data) {

                                $x = $key +1;
                                if($data['document_status'] != 2) {
                                    if($data['id'] != 0) { 
                                        echo "<a href='/dx-documents-and-quick-links-template".$x."/".encryptID($data['id'])." class='list-inline-item'>";
                                            echo '<li class="list-dl-item">';
                                                echo '<i class="fa fa-arrow-right" id="fa" aria-hidden="true"></i>';
                                                echo $data["document_name"];
                                            echo '</li>';
                                        echo  "</a>";
                                    }
                                }
                    
                            }
                        ?>
                    </ul>
                </div>
            </section>       
            </div>
        </div>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-footer.php');  ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="assets/modal/js/lightslider.js"></script> 
    </body>
</html>
