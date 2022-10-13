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
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
        <title><?php echo $dx."Documents and Links"; ?></title>
        <link href="/assets/css/documents.css" rel="stylesheet" />
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
    </head>
    <body id="documents">
        <div class="container">
            <div class="col-3 col-s-3 menu">
                <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
            </div>

            <section class="main-area col-s-9 d-column mb-4 ml-5">
                <div class="announcement mb-4">
                    <h2 class="mb-3">
                        <span  style="color: var(--black);">Documents and Quick Links</span>
                    </h2>
                    <div class="announcement-row">

                        <ul class="list-inline mb-4">
                            <?php
                                $data_count = 0;
                                $sql = $pdo->prepare("SELECT * FROM documents WHERE `document_status` = 0 ORDER BY id ASC");
                                $sql->execute();
                                while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

                                $data_count++;
                                $document_id = encryptID($data['id']);
                                
                                $count =  $pdo->prepare("SELECT * FROM `files` WHERE `document_id` = ".$data['id']);
                                $count->execute();
                                $total_data_count = $count->rowCount();
                            
                                echo "<a href='/document-files/".$data["id"]."'>";
                                    echo '<li class="list-dl-item p-3 moving-left">';
                                        echo '<i class="fa fa-arrow-right" style="padding: 11px 30px;" id="fa" aria-hidden="true"></i>';
                                        echo '<h5 class="font-weight-bold text-dark m-0">'.$data["document_name"];
                                        echo ' ('. $total_data_count .') </h5>';
                                        echo '<span class="text-secondary" style="font-size:1rem;">'.$data["document_description"] .'</span>';
                                    echo '</li>';
                                echo  "</a>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </section>       
            </div>
        </div>
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-footer.php');  ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="assets/modal/js/lightslider.js"></script> 
    </body>
</html>
