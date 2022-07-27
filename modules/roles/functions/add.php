<?php
// INCLUDES
$module = 'roles'; $prefix = 'role'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {
	
		$err = 0;
		$fields = array('role_name','permissions');
		
		$required = $fields;
		$unique = array('role_name');
		
		$ucwords = array('role_name');
		$strtoupper = array();
		$strtolower = array();
		$nospace = array();
		
		$string = $fields;

		$from_array = array();
		$exclude_sql = array();
		
		// PROCESS FORM
		include('../../../includes/form/process-fields.php');
		
		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors
			
			// START ADDITIONALS
			
			// cross check count of permissions
			$permissions_val_arr = explode(',',$permissions);
			if(count($permissions_val_arr) == $permissions_count) {
				$permissions = 'all';
			}
			
			// check if filter department is added, if yes, automatically add filter team if not included
			if($permissions != 'all') {
				if(in_array('filter-department',$permissions_val_arr) && !in_array('filter-team',$permissions_val_arr)) {
					array_push($permissions_val_arr,'filter-team');
				}
			}
			
			// END ADDITIONALS
			
			// process add and redirect to list page
			include('../../../includes/form/process-add.php');

			// START ADDITIONALS
			// END ADDITIONALS

			header('location: /'.$module);
			
		} else { // error found
			
			$_SESSION['sys_'.$module.'_'.$process.'_err'] = renderLang($form_error);
			header('location: /'.$process.'-'.$prefix);
			
		}
		
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /');

}
?>