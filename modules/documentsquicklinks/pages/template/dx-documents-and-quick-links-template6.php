<?php 
$module = 'documentsquicklinks'; $prefix = 'documentsquicklink'; $process = 'view';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php');

$_SESSION['dx-documents-and-quick-links-page'] = 'dx-documents-and-quick-links-page';

unset($_SESSION['dx-webinar-and-events-page']);
unset($_SESSION['dx-team-page']);
unset($_SESSION['dx-announcements']);
unset($_SESSION['dx-home-page']);
$_SESSION['links'] = 'template1';
$_SESSION['links-no'] = '6';
$sql = $pdo->prepare("SELECT * FROM documentsquicklinks  WHERE id = ".$id."");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);
$_SESSION['links-no'] = $data['id'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>DX Infohub - WEBINAR & EVENTS(Download)</title>
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
                <h2 class="mb-3"><?php echo $data['docu_name']; ?></h2>
                <ul class="list-inline mb-4">
               <?php
                    // The list of items to be displayed on screen.
                    $sql = $pdo->prepare("SELECT * FROM documentstemplate WHERE docu_name ='".$data['docu_name']."'");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $data) {
                        if($data['status'] != 1) {
                            echo "<a href='/dl-template/".$data['id']."' >";
                            echo '<li class="list-dl-item">';
                                    echo '<i class="fa fa-download" id="fa" aria-hidden="true"></i>';
                                    echo $data["docu_dl"];
                            echo '</li>';
                            echo  "</a>";
                        }
             
                     }
                ?>
                            </ul>
                        </div>
                        <a href="/dx-documents-and-quick-links" class="btn btn-primary">Back</a>
                    </section>       
            </div>
        </div>

        <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-footer.php');  ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="assets/modal/js/lightslider.js"></script> 
    </body>
</html>
