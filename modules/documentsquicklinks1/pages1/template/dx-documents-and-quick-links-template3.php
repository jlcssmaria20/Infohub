<?php 
$module = 'documentsquicklinks'; $prefix = 'documentsquicklink'; $process = 'view';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php');
include_once '../../../usersview/includes/links.php'; 

$_SESSION['dx-documents-and-quick-links-page'] = 'dx-documents-and-quick-links-page';

unset($_SESSION['dx-webinar-and-events-page']);
unset($_SESSION['dx-team-page']);
unset($_SESSION['dx-announcements']);
unset($_SESSION['dx-home-page']);

$id = decryptID($_GET['id']);
$sql = $pdo->prepare("SELECT * FROM documentsquicklinks  WHERE id = ".$id."");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      
        <title>DX Info Hub</title>
        <link href="/assets/usersview/css/styles.css" rel="stylesheet" />
        <style>
            section.webinar-section{
                padding: .1rem 1rem 3rem;
            }
        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <div class="container main">
            <?php include_once '../../../usersview/includes/navigation.php'; ?>
            <!-- Page Content-->
            <div class="container-fluid p-0">
                <h1 class="text-red"> <?php echo $data['docu_name']; ?></h1>
                <br>
               
                <section class="webinar-section">
                    <div class="webinar-section-content">
                        <ul class="webinar-list-item">
               <?php
                    // The list of items to be displayed on screen.
                    $sql = $pdo->prepare("SELECT * FROM documentstemplate WHERE docu_name ='".$data['docu_name']."'");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                    foreach($row as $key => $data) {
                        if($data['status'] != 1) {
                            echo "<a href='/dl-template/".$data['id']."'>";
                            echo "<li class='document-and-links'>";
                            echo $data["docu_dl"];
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

          <!-- Footer -->
          <div class="footerArea">
            <div class="footerLeft">
                <p><strong>DX Info Hub</strong>
                 powered by DX Offshore Team</p>
                <p>© transcosmos Asia Philippines 2021</p>
            </div>
            <div class="footerRight">
                <img src="modules/usersview/assets/img/dxInfo-logo-img02.png">
            </div>
        </div>

        <!-- Bootstrap core JS-->
        <!-- Core theme JS-->
        <script src="../../../modules/usersview/js/scripts.js"></script>
        <script src="../../../modules/usersview/js/jquery.js"></script>
        <script src="../../../modules/usersview/js/modal.js"></script>
    </body>
</html>
