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

        <style></style>
    </head>
    <body id="documents">
        <div class="container">
            <div class="col-3 col-s-3 menu">
                <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
            </div>

            <section class="main-area col-s-9 d-column mb-4 ml-5">
                <div class="announcement mb-4">
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="mb-3">
                                Documents and Quick Links
                            </h2>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Enter Document Name or Description" class="form-control mr-2 px-2">
                        </div>
                    </div>
                  
                    <div class="announcement-row">                      
                        <ul class="list-inline mb-4" id="myUL">
                            <?php
                                $data_count = 0;
                                $sql = $pdo->prepare("SELECT * FROM documents WHERE `document_status` = 0 ORDER BY id DESC");
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
        <script>
                        
            function myFunction() {
                var input, filter, ul, li, a, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                ul = document.getElementById("myUL");
                a = ul.getElementsByTagName("a");
                for (i = 0; i < a.length; i++) {
                    li = a[i].getElementsByTagName("li")[0];
                    txtValue = li.textContent || li.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        a[i].style.display = "";
                    } else {
                        a[i].style.display = "none";
                    }
                }
            }   
        </script>
    </body>
</html>
