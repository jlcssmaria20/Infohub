<?php
// INCLUDES
$module = 'roles'; $prefix = 'role'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {
	
		$err = 0;
		$fields = array('role_name','permissions');
		
		$required = array('role_name');
		$unique = array('role_name');
		
		$ucwords = array('role_name');
		$strtoupper = array();
		$strtolower = array();
		$nospace = array();
		
		$string = $fields;

		$from_array = array();
		$exclude_sql = array();
		
		$id = decryptID($_POST['id']);
		$src = $_POST['src'];
		
		// check if ID belongs to superadmin
		if($id != 1) {
		
			// check if ID exists
			$sql = $pdo->prepare("SELECT * FROM ".$module." WHERE id = ".$id." LIMIT 1");
			$sql->bindParam(":id",$id);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			if($sql->rowCount()) {

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
					
					// END ADDITIONALS
					
					// specify if label is different from field name, if not, use default
					// leave blank if there are no adjustments
					$label_adjustments_arr = array(
						array('permissions','lang_permissions')
					);

					// process edit and check for changes
					include('../../../includes/form/process-edit.php');

				} else { // error found

					$_SESSION['sys_'.$module.'_'.$process.'_err'] = renderLang($form_error);

				}

			} else {

				$_SESSION['sys_'.$module.'_'.$process.'_err'] = renderLang($form_id_not_found);

			}
			
			header('location: /'.$process.'-'.$prefix.'/'.$src.'/'.encryptID($id));
			
		} else {
			
			// !NEED TRANSLATION
			$_SESSION['sys_'.$module.'_err'] = renderLang(${$module.'_messages_cannot_edit_superadmin'});
			header('location: /'.$module);
			
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