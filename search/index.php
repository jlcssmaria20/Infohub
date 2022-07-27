<?php 

$_SESSION['dx-team-page'] = 'dx-team-page';
unset($_SESSION['dx-webinar-and-events-page']);
unset($_SESSION['dx-documents-and-quick-links-page']);
?>

<!DOCTYPE html>
<html>

<head>
	<title>Team - DX Info Hub</title>
	<link href="../modules/usersview/css/styles.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/search.js"></script>
	<style>
	select#multiSelectSearch {
		padding: 2px 21px;
		width: 239px;
		text-align: center;
		margin-left: 16px;
	}
	option {
    text-align: left;
}
	</style>
</head>

    <body id="page-top">
        <!-- Navigation-->
        <div class="container main">
            <?php include_once '../modules/usersview/includes/navigation.php'; ?>
            <!-- Page Content-->
            <div class="container-fluid p-0">
                <h1 class="text-red"> The Team </h1>
                <select id="multiSelectSearch"  title="Alphabetically">
					<option value=""><a href="window.location.reload()">Alphabetically</option>
					<?php
					include_once("db_connect.php");
					$sql_query = "SELECT DISTINCT team FROM search_tbl  LIMIT 10 ";
					$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
					while( $data = mysqli_fetch_assoc($resultset) ) {
						if($data['team'] != '') {
							echo '<option value="'.$data["team"].'">'.$data["team"].'</option>'; 
						} 
					}
					?>
				</select>
				<input type="hidden" name="location" id="location" />
				<div style="clear:both"></div>
               
                <section class="webinar-section">
                    <div class="webinar-section-content">
						<ul class="webinar-list-item" >	
						</ul>
					</div>
				</section>       
            </div>
        </div>

		

        <!--- MODAL POP-UP AREA --->
        <?php for ($x = 1; $x <= 100; $x++) { ?>
            <div id="myModal<?php echo $x ?>" class="modal">
                <img class="modal-content" id="img0<?php echo $x ?>">
            <div id="caption<?php echo $x ?>"></div>
                <span class="close">Close</span>
            </div>
        <?php } ?>

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
        <script src="modules/usersview/js/scripts.js"></script>
        <script src="modules/usersview/js/jquery.js"></script>
        <script src="modules/usersview/js/modal.js"></script>

        <script>
            $('.close').click(function() {
                
                var x = document.querySelectorAll("div#myModal11");
                x[0].style.setProperty("display", "none", "important");
            });

       
            $("#webinarandevent1").css("display","none")

            $("li img").on("click",function(){
                $("#sideNav").css("z-index", "0")
            });

            
        </script>
    </body>

</html>