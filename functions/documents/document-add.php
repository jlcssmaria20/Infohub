<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {


	// check permission to access this page or function
	if(checkPermission('document-add')) {

		$err = 0;
		
		// PROCESS FORM

		//GET USER ID
		$id = $_SESSION['sys_id'];
		//CURRENT DATE
		$current_date = date('F j, Y');

		// name
		$name = '';
		if(isset($_POST['name'])) {
			$name = htmlentities(trim($_POST['name']));
			$name = ucfirst(trim($_POST['name']));
			$_SESSION['sys_document_add_name_val'] = $name;
			if(strlen($name) == 0) {
				$err++;
				$_SESSION['sys_document_add_name_err'] = renderLang($document_name_required);
			} else {
				
				// check if name already exists
				$sql = $pdo->prepare("SELECT document_name, temp_del FROM documents WHERE document_name = :document_name AND temp_del=0 LIMIT 1");
				$bind_param = array(
					':document_name' => $name
				);
				$sql->execute($bind_param);
				if($sql->rowCount() > 0) {
					$err++;
					$_SESSION['sys_document_add_name_err'] = renderLang($document_name_exists);
				}
			}
		}
		$description = '';
		if(isset($_POST['description'])) {
			$description = htmlentities(trim($_POST['description']));
			$description = ucfirst(trim($_POST['description']));
			$_SESSION['sys_document_add_description_val'] = $description;
			if(strlen($description) == 0) {
				$err++;
				$_SESSION['sys_document_add_description_err'] = renderLang($document_description_required);
			}
		}
		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors

			// insert in database
			$sql = $pdo->prepare("INSERT INTO documents(
					id,
					`user_id`,
					document_name,
					document_description,
					date_created
				) VALUES(
					NULL,
					:user_id,
					:document_name,
					:document_description,
					:date_created
				)");
			$bind_param = array(
				':user_id'  				=> $_SESSION['sys_id'],
				':document_name'  			=> $name,
				':document_description'		=> $description,
				':date_created'				=> $current_date
			);
		
			$sql->execute($bind_param);
			// $sql->debugDumpParams();

			$_SESSION['sys_document_suc'] = renderLang($document_added);
			header('location: /documents');
			
		} else { // error found
			
			$_SESSION['sys_document_err'] = renderLang($document_name_exists);
			header('location: /documents');
			
		}
		
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}
?>