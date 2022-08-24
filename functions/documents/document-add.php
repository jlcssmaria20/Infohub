<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('document-add')) {
	
		$err = 0;
		
		// PROCESS FORM
		
		// FOLDER NAME
		$name = '';
		if(isset($_POST['name'])) {
			$name = htmlentities(trim($_POST['name']));
			$_SESSION['sys_document_add_name_val'] = $name;
			if(strlen($name) == 0) {
				$err++;
				$_SESSION['sys_document_add_name_err'] = renderLang($document_name_required);
			} else {
				
				// check if employee ID already exists
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
		
		// FIRSTNAME
		$firstname = '';
		if(isset($_POST['firstname'])) {
			$firstname = ucwords(strtolower(trim($_POST['firstname'])));
			$_SESSION['sys_document_add_firstname_val'] = $firstname;
			if(strlen($firstname) == 0) {
				$err++;
				$_SESSION['sys_document_add_firstname_err'] = renderLang($document_firstname_required);
			} else {
				if(!validateNameV1($firstname)) {
					$err++;
					$_SESSION['sys_document_add_firstname_err'] = renderLang($lang_invalid_characters);
				}
			}
		}
		
		// LASTNAME
		$lastname = '';
		if(isset($_POST['lastname'])) {
			$lastname = ucwords(strtolower(trim($_POST['lastname'])));
			$_SESSION['sys_document_add_lastname_val'] = $lastname;
			if(strlen($lastname) == 0) {
				$err++;
				$_SESSION['sys_document_add_lastname_err'] = renderLang($document_lastname_required);
			} else {
				if(!validateNameV1($lastname)) {
					$err++;
					$_SESSION['sys_document_add_lastname_err'] = renderLang($lang_invalid_characters);
				}
			}
		}
		
		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors
			
			// insert in table
			$sql = $pdo->prepare("INSERT INTO document(
					id,
					document_name,
					document_firstname,
					document_lastname
				) VALUES(
					NULL,
					:document_name,
					:document_firstname,
					:document_lastname
				)");
			$bind_param = array(
				':document_name'   => $name,
				':document_firstname'  => $firstname,
				':document_lastname'   => $lastname
			);
			
			$sql->execute($bind_param);
			$sql->debugDumpParams();

			
			
			// get ID of new document
			// $sql = $pdo->prepare("SELECT document_id, document_name FROM document WHERE document_name = :document_name LIMIT 1");
			// $bind_param = array(
			// 	':document_name'   => $name
			// );
			// $sql->execute($bind_param);
			// $data = $sql->fetch(PDO::FETCH_ASSOC);
			
			// record to system log
			//systemLog('document',$data['document_id'],'add','');

			$_SESSION['sys_document_suc'] = renderLang($document_added);
			header('location: /document');
			
		} else { // error found
			
			$_SESSION['sys_document_add_err'] = renderLang($form_error);
			header('location: /document-add');
			
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