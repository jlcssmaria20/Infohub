<?php
// set variables
$keywords = '';
$where = '';
$var_k = '';

// set redirect link for clearing search bar

$redirect_link = $page;
if(isset($subpage)) {
	$redirect_link = $subpage;
}

// get user defined keywords if any
if(isset($_GET['k'])) {
	$keywords = trim($_GET['k']);
	$var_k = '&k='.urlencode($_GET['k']);
	if($keywords != '') {
		$keywords_arr = explode(' ',$keywords);
	}
}

$sql_temp_del = '';
if($page != 'system-log') {
	$sql_temp_del = " AND ".$page.".temp_del=0";
}

// if keywords array exists, create the WHERE clause for query
if(isset($keywords_arr)) {
	foreach($keywords_arr as $keyword) {
		$keyword = str_replace("'","''",$keyword);
		if($where == '') {
			foreach($fields_arr as $field) {
				if($where == '') {
					$where .= " WHERE ".$field." LIKE '%".$keyword."%' AND temp_del = 0";
				} else {
					$where .= " OR ".$field." LIKE '%".$keyword."%' AND temp_del = 0";
				}
			}
		} else {
			foreach($fields_arr as $field) {
				$where .= " OR ".$field." LIKE '%".$keyword."%' AND temp_del = 0";
			}
		}
	}
} else {
	if($where == '' && $page != 'system-log') {

		 $where = " WHERE temp_del=0";
	}
}
?>