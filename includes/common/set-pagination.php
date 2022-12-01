<?php
//$numrows = $_SESSION['sys_data_per_page']; // set number of rows to display
$numrows = 10;
$page_ctr = 1; // set as default page count
if(isset($_GET['p'])) { // check if pagination is clicked
	$page_ctr = $_GET['p'];
}
$sql_start = abs($numrows * ((int)$page_ctr-1)); // set start of LIMIT statement

// get number of users for pagination
$sql = $pdo->prepare($sql_query);
$sql->execute();
$total_data_count = $sql->rowCount(); // get number of rows
$page_count = ceil($total_data_count/$numrows); // compute for number of pages
?>