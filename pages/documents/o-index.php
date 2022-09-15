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
        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
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
                                echo '<li class="list-dl-item">';
                                    echo '<i class="fa fa-arrow-right" id="fa" aria-hidden="true"></i>';
                                    echo $data["document_name"];
                                    echo ' ('. $total_data_count .') ';
                                echo '</li>';
                            echo  "</a>";
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
