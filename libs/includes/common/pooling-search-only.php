<?php
// set variables
$keywords = '';
$where = '';
$var_k = '';

// set redirect link for clearing search bar
$redirect_link = 'applications';
if(isset($subpage)) {
	$redirect_link = $subpage;
}
if(isset($redirect_link_override)) {
	$redirect_link = $redirect_link_override;
}

// get user defined keywords if any
if(isset($_GET['k'])) {
	$keywords = trim($_GET['k']);
	$var_k = '&k='.urlencode($_GET['k']);
}
if($keywords != '') {
	$keywords_arr = explode(' ',$keywords);
}

$user_filter = '';
if(!checkPermission('tickets-manage')) {
	$user_filter = ' AND tickets.user_id = '.$_SESSION['sys_data']['id'];
}

// if keywords array exists, create the WHERE clause for query
if(isset($keywords_arr)) {

	// if there is filter override
	if(!isset($other_filter)) {
		$other_filter = '';
	} else {
		$other_filter = ' AND '.$other_filter;
	}
	
	foreach($keywords_arr as $keyword) {
		$keyword = str_replace("'","''",$keyword);
		if($where == '') {
			foreach($fields_arr as $field) {
				if($where == '') {
					$where .= " WHERE ".'applications'.".".$field." LIKE '%".$keyword."%'".$user_filter.$other_filter;
				} else {
					$where .= " OR ".'applications'.".".$field." LIKE '%".$keyword."%'".$user_filter.$other_filter;
				}
			}
		} else {
			foreach($fields_arr as $field) {
				$where .= " OR ".'applications'.".".$field." LIKE '%".$keyword."%'".$user_filter.$other_filter;
			}
		}
	}
} else {
	
	if(isset($other_filter)) {
		$where = " WHERE ".$other_filter;
	} else {
		
		// remove superadmin in the list
		if('applications' == 'users' && $process == 'list') {
			if($_SESSION['sys_data']['id'] != 1) {
				$where = " WHERE users.id <> 1";
			}
		}
		
	}
	
}
?>