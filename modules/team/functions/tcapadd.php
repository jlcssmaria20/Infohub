<?php
// INCLUDES
$module = 'users'; $prefix = 'tcapuser'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

		$err = 0;
		$fields = array(
			'uname',
			'upass',
			'firstname',
			'middlename',
			'lastname',
			'email',
			'mobile',
			'roleids',
			'date_start'
		);
		
		$required = array(
			'uname',
			'upass',
			'firstname',
			'middlename',
			'lastname',
			'email',
			'mobile',
			'roleids',
			'date_start'
		);
		$unique = array('email', 'uname');
		
		// set format
		$ucwords = array('firstname','middlename','lastname');
		$strtoupper = array();
		$strtolower = array();
		$nospace = array('uname', 'email');
		
		// set default value as blank, 0 if not a string
		$string = array(
			'uname',
			'upass',
			'firstname',
			'middlename',
			'lastname',
			'email',
			'mobile',
			'roleids'
		);

		// indicate fields used from array set for encryption
		//$from_array = array('gender','civil_status');
		
		// exclude field from SQL statement
		$exclude_sql = array();
		
		// PROCESS FIELDS
		include('../../../includes/form/process-fields.php');
		
		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors
			$_SESSION['sys_data']['id'] = 2;
			// START ADDITIONALS
			
			// format date start
			$date_start = date('Ymd',strtotime($date_start));
			
			// encrypt default password
			$upass = encryptStr($uname);
			// send password in email
			require($_SERVER['DOCUMENT_ROOT'].'/tcapWebsite/pages/mailer/mailerFunction.php');

			// decrypt role ids

			$roleids = ','.'2';
			
			// END ADDITIONALS

			// process add and redirect to list page
			include('../../../includes/form/process-add.php');


			
			// START ADDITIONALS
			// END ADDITIONALS

			header('location: /tcap-login-form');
			
		} else { // error found
			
			$_SESSION['sys_'.$module.'_'.$process.'_err'] = renderLang($form_error);
			header('location: /registration-form');
			
		}
		
?>
