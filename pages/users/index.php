<?php
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php'); 
    // INCLUDES
    $module = 'users'; 

    //set page
    $page = 'o-teams';

    // set fields from table to search on
    $fields_arr = array('user_firstname','user_lastname');
    $search_placeholder = renderLang($test_firstname_label).', '.renderLang($test_lastname_label);
    require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-search.php');
    
    $sql_query = 'SELECT * FROM users'.$where; // set sql statement
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
	<title><?php echo $dx."Teams"; ?></title>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php');  ?>
    <link href="/assets/css/user.css" rel="stylesheet">
    
</head>
<body id="team">
    <div class="container">
        <div class="col-3 col-s-3 menu">
            <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-sidebar.php');  ?>
        </div>
        <section class="main-area col-s-9 d-column mb-4" >
        <div class="announcement mb-4">
            <h2 class="mb-3">
                <span>Meet the Team</span>
            </h2>
            
            <div class="announcement-row">
                <div class="d-flex justify-content-end">
                    <!-- SEARCH -->
                    <div class="mr-3">
                        <input type="text" id="mySearch" onkeyup="myFunction()" placeholder="Search" class="form-control rounded mr-2 px-2 ">
                    </div>

                    <!-- FILTER BY TEAM -->
                    <div class="">
                        <select id="multiSelectSearch" name="multiSelectSearch" title="All" class="form-control rounded">
                            <option value=""><a href="window.location.reload()">All</option>
                            <?php
                            $sql = $pdo->prepare("SELECT * FROM teams");
                            $sql->execute();
                            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                            foreach($row as $data) {
                                if($data['team_status'] != '2') {
                                    echo '<option value="'.$data["id"].'">'.$data["team_name"].'</option>'; 
                                } 
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="location" id="location" />
            <div style="clear:both"></div>
                <section class="user-section">
                    <div class="user-section-content">
                        <ul class="user-list-item" id="myMenu">
                           
                        </ul>
                    </div>
                </section>       
            </div>
        </section>
    </div>
    
    <?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/parent-footer.php');  ?>
    <script src="assets/modal/js/lightslider.js"></script>
    <script>
        $(document).ready(function() {
            listRecords();
            $('#multiSelectSearch').change(function() {
                $('#location').val($('#multiSelectSearch').val());
                var searchQuery = $('#location').val();
                listRecords(searchQuery);
            });
        });
        function listRecords(searchQuery='') {
            $.ajax({
                url : '/live_search',
                type : 'POST',
                // contentType: "application/json",//note the contentType defintion
                // dataType: "json",
                data:"query="+searchQuery,
                success : function (result) {
                //console.log(result);
                $('ul.user-list-item').html(result);
                },
                error : function () {
                console.log ('error');
                }
            });
        };
        function myFunction() {
            // Declare variables
            var input, filter, ul, li, a, i;
            input = document.getElementById("mySearch");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myMenu");
            li = ul.getElementsByTagName("li");

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
                } else {
                li[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
