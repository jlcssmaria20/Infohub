<?php 
$module = 'documentsquicklinks'; $prefix = 'documentsquicklink'; $process = 'list';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php');
include_once '../../usersview/includes/links.php'; 

$_SESSION['dx-documents-and-quick-links-page'] = 'dx-documents-and-quick-links-page';

unset($_SESSION['dx-webinar-and-events-page']);
unset($_SESSION['dx-team-page']);
unset($_SESSION['dx-announcements']);
unset($_SESSION['dx-home-page']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DX Infohub - Documents & Quick Links</title>
        <?php include_once '../../usersview/includes/links.php'; ?>
        <link href="/assets/css/documents.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="/assets/js/search.js"></script>
    </head>
    <body>
        <div id="page-top">
            <?php include_once '../../usersview/includes/sidebar.php'; ?>
            <div class="container-fluid p-0">
            <section class="infohub-section p-3 p-lg-5 d-flex d-column mb-4" >
                <div class="my-auto">
                    <h1 class="mb-0">Documents and  
                        <span class="text-primary">Quick Links</span>
                    </h1>
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
                                    echo "<li class='document-and-links'>";
                                    echo '<i class="fa fa-download" id="fa" aria-hidden="true"></i>';
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
        <?php include '../../usersview/includes/footer.php'; ?>
            <script src="modules/usersview/js/scripts.js"></script>
            <script src="modules/usersview/js/jquery.js"></script>
            <script src="modules/usersview/js/modal.js"></script>
        </body>
    </body>
</html>
