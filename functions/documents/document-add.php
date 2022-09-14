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
		$current_date = date('F j, Y - l - h:i a', time());

		// name
		$name = '';
		if(isset($_POST['name'])) {
			$name = htmlentities(trim($_POST['name']));
			$name = ucwords(strtolower(trim($_POST['name'])));
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
		
		// VALIDATE FOR ERRORS
		if($err == 0) { // there are no errors

			// insert in database
			$sql = $pdo->prepare("INSERT INTO documents(
					id,
					`user_id`,
					document_name,
					date_created
				) VALUES(
					NULL,
					:user_id,
					:document_name,
					:date_created
				)");
			$bind_param = array(
				':user_id'  				=> $_SESSION['sys_id'],
				':document_name'  			=> $name,
				':date_created'				=> $current_date
			);
			/* $sql1 = $pdo->prepare("INSERT INTO files(
					id,
					`user_id`,
					document_name,
					`filename`,
					`file`,
					date_created
				) VALUES(
					NULL,
					:user_id,
					:document_name,
					:`filename`,
					:`file`,
					:date_created
				)");
			$bind_param = array(
				':user_id'  				=> $_SESSION['sys_data']['id'],
				':document_name'  			=> $name,
				':filename'					=> $filename,
				':file'						=> $file,
				':date_created'				=> $current_date
			); */
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
			header('location: /documents');
			
		} else { // error found
			
			$_SESSION['sys_document_add_err'] = renderLang($form_error);
			
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