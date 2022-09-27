<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('document-edit')) {

		// set page
		$page = 'documents';
	
		$err = 0;
		$document_id = decryptID($_GET['id']);


		$links_arr = array();
		$links_arr_insert = array();

		if(isset($_POST['linkname'])) {
			if(isset($_POST['link'])) {
				foreach($_POST['linkname'] as $i => $val) {
					$with_error = 0;
					// $tmp = array();
					array_push($links_arr,$_POST['linkname'][$i].'-'.$_POST['link'][$i]);
					$tmp = array($_POST['linkname'][$i],$_POST['link'][$i]);
					array_push($links_arr_insert,$tmp);
				}
			}
		}
		$_SESSION['sys_document_edit_file_link_val'] = $links_arr_insert;
		// check if ID exists
		$sql = $pdo->prepare("SELECT * FROM documents WHERE id = :document_id LIMIT 1");
		$sql->bindParam(":document_id",$document_id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		if($sql->rowCount()) {
			
			// PROCESS FORM
			

			// FOLDER NAME
			$name = '';
			if(isset($_POST['name'])) {
				$name = htmlentities(trim($_POST['name']));
				$name = ucwords(strtolower(trim($_POST['name'])));

				$_SESSION['sys_document_edit_name_val'] = $name;
				if(strlen($name) == 0) {
					$err++;
					$_SESSION['sys_document_edit_name_err'] = renderLang($document_name_required);
				} else {
					
					// check if name already exists
					$sql2 = $pdo->prepare("SELECT id, document_name, temp_del FROM documents WHERE document_name = :document_name AND id <> :document_id AND temp_del = 0 LIMIT 1");
					$bind_param = array(
						':document_id'      => $document_id,
						':document_name'    => $name
					);
					$sql2->execute($bind_param);
					if($sql2->rowCount()) {
						$err++;
						$_SESSION['sys_document_edit_name_err'] = renderLang($document_name_exists);
					}
				}
			}

			// STATUS
			$document_status = 0;
			if(isset($_POST['document_status'])) {
				$document_status = trim($_POST['document_status']);
				$_SESSION['sys_document_edit_status_val'] = $document_status;
				$document_status_exists = 0;
				foreach($status_arr as $status_data) {
					if($status_data[0] == $document_status) {
						$document_status_exists = 1;
					}
				}
				if(!$document_status_exists) {
					$err++;
					$_SESSION['sys_document_edit_status_err'] = 'Please select a valid status.';
				}
			}

			//CURRENT DATE
			$current_date = date('F j, Y - l - h:i a', time());
            
			// VALIDATE FOR ERRORS
			if($err == 0) { // there are no errors
				// check for changes
				$change_logs = array();
				if($name != $data['document_name']) {
					$tmp = 'document_name::'.$data['document_name'].'=='.$name;
					array_push($change_logs,$tmp);
				}
				$links_arr_prev = array();
				//check changes in files table
				$sql2 = $pdo->prepare("SELECT * FROM files WHERE document_id = :document_id ORDER BY id ASC");
				$sql2->bindParam(":document_id",$document_id);
				$sql2->execute();
				if($sql2->rowCount() > 0) {
					// get previous budget time details
					while($data_files = $sql2->fetch(PDO::FETCH_ASSOC)) {
						// $tmp = array();
						array_push($links_arr_prev,$data_files['file_linkname'].'-'.$data_files['file_link']);
					}
				} 
				// print_r($links_arr_prev);
				// echo '<br>';
				// print_r($links_arr);
				// echo '<br>';
				// print_r($links_arr_insert);
				// echo '<br>';
				sort($links_arr_prev);
				sort($links_arr);
				//compare
				$toUpdate = 0;
				if(!empty($links_arr_prev)){
					if($links_arr_prev != $links_arr){
						$toUpdate = 1;
					}
				}
				
				if(empty($links_arr_prev) && (!empty($links_arr))){
					$toUpdate = 1;
				}

				if($toUpdate){
					$tmp = 'prev::'.json_encode($links_arr).'=='.json_encode($links_arr_prev);
					array_push($change_logs,$tmp);	
						// if there is a change
						$sql_delete = $pdo->prepare("DELETE FROM files WHERE document_id = $document_id");
						$sql_delete->bindParam(":document_id",$document_id);
						$sql_delete->execute($bind_param);
				

					if($sql_delete) {
						foreach($links_arr_insert as $links){

							$sql = $pdo->prepare("INSERT INTO files(
								id,
								user_id,
								document_name,
								document_id,
								file_linkname,
								file_link,
								date_created
							) VALUES(
								NULL,
								:user_id,
								:document_name,
								:document_id,
								:file_linkname,
								:file_link,
								:date_created
							)");
						$bind_param = array(
							':user_id'  				=> $_SESSION['sys_id'],
							':document_name'  			=> $name,
							':document_id'              => $document_id,
							':file_linkname'			=> $links[0],
							':file_link'				=> $links[1],
							':date_created'				=> $current_date
						); 
						$sql->execute($bind_param);
						}
					}
				}
				
			
				// check if there is are changes made
				if(count($change_logs) > 0) {
					
					// update documents table
					$sql = $pdo->prepare("UPDATE documents SET
						document_name = :document_name,
						date_edited = :date_edited
					    WHERE id = :document_id");
					
					$bind_param = array(
						':document_id'          => $document_id,
						':document_name'   	    => $name,
						':date_edited'			=> $current_date
					);
					$sql->execute($bind_param);

					// update documents table
					$sql_update_in_files_table = $pdo->prepare("UPDATE files SET
						document_name = :document_name
					    WHERE document_id = :document_id");
					
					$bind_param = array(
						':document_id'          => $document_id,
						':document_name'   	    => $name
					);
					$sql_update_in_files_table->execute($bind_param);

			
					// record to system log
					// $change_log = implode(';;',$change_logs);
					// systemLog('document',$document_id,'update',$change_log);

					$_SESSION['sys_document_edit_suc'] = renderLang($document_updated);

				} else { // no changes made

					// /* $_SESSION['sys_document_edit_err'] = renderLang($form_no_changes); 

				}

			} else { // error found

				$_SESSION['sys_document_edit_err'] = renderLang($form_error);

			}

		} else {

			$_SESSION['sys_document_edit_err'] = renderLang($form_id_not_found);

		}
		
		header('location: /edit-document/'.encryptID($document_id));
		
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
	header('location: /login');

}
?>