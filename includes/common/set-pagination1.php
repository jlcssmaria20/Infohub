<?php
// $numrows = $_SESSION['sys_data']['data_per_page']; // set number of rows to display

$numrows = 5;



$page_ctr = 1; // set as default page count
if(isset($_GET['p'])) { // check if pagination is clicked
	$page_ctr = $_GET['p'];
}
$sql_start = $numrows * ($page_ctr-1); // set start of LIMIT statement

// get number of users for pagination
$sql_table = str_replace('-','_',$module);
if(isset($sql_table_override)) {
	$sql_table = $sql_table_override;
}
$sql = $pdo->prepare("SELECT * FROM ".$sql_table.$where); // WHERE variable from set-search.php
$sql->execute();
$total_data_count = $sql->rowCount(); // get number of rows
$page_count = ceil($total_data_count/$numrows); // compute for number of pages
?>