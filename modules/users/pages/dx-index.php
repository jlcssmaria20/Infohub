<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'list';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config1.php');
require($_SERVER['DOCUMENT_ROOT'].'/includes/unsetSession.php');

$_SESSION['dx-team-page'] = 'dx-team-page';
unset($_SESSION['dx-webinar-and-events-page']);
unset($_SESSION['dx-documents-and-quick-links-page']);
unset($_SESSION['dx-home-page']);
unset($_SESSION['dx-announcements']);

// get module icon
$sql = $pdo->prepare("SELECT `docu_name` FROM documentstemplate");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>DX Infohub - PROFILE</title>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-links.php');  ?>
    <link href="/assets/css/user.css" rel="stylesheet">
    <script src="assets/js/jquery.js"></script>
    <script src="/assets/js/search.js"></script>
</head>
<body id="team">
    <div class="container">
        <div class="col-3 col-s-3 menu">
            <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-sidebar.php');  ?>
        </div>
        <section class="main-area col-s-9 d-column mb-4" >
        <div class="announcement mb-4">
            <h2 class="mb-3">
                <span style="color: var(--black);">Meet the Team</span>
            </h2>
            <div class="announcement-row">
                <select id="multiSelectSearch"  title="All">
                    <option value=""><a href="window.location.reload()">All</option>
                    <?php
                    $sql = $pdo->prepare("SELECT DISTINCT `team` FROM search_tbl");
                    $sql->execute();
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($row as $data) {
                        if($data['team'] != '') {
                            echo '<option value="'.$data["team"].'">'.$data["team"].'</option>'; 
                        } 
                    }
                    ?>
                </select>
            </div>
            <input type="hidden" name="location" id="location" />
            <div style="clear:both"></div>
                <section class="user-section">
                    <div class="user-section-content">
                        <ul class="user-list-item">	
                        </ul>
                    </div>
                </section>       
            </div>
        </section>
    </div>
    
    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/dx-footer.php');  ?>
    <script src="assets/modal/js/lightslider.js"></script> 
</body>
</html>
