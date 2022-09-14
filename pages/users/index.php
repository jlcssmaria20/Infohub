<?php
// INCLUDES
$module = 'users'; 

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
	<title><?php echo $dx."User Profile"; ?></title>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
    <link href="/assets/css/user.css" rel="stylesheet">
    <script src="assets/js/jquery.js"></script>
    <script src="/assets/js/search.js"></script>
</head>
<body id="team">
    <div class="container">
        <div class="col-3 col-s-3 menu">
            <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
        </div>
        <section class="main-area col-s-9 d-column mb-4" >
        <div class="announcement mb-4">
            <h2 class="mb-3">
                <span style="color: var(--black);">Meet the Team</span>
            </h2>
            <div class="announcement-row mr-4">
                <div class="d-flex justify-content-end mr-4">
                    <input type="text" placeholder="Search" class="form-control-s rounded mr-2 px-2">
                    <select id="multiSelectSearch"  title="All" class="form-control-s rounded">
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
    
    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-footer.php');  ?>
    <script src="assets/modal/js/lightslider.js"></script> 
</body>
</html>
