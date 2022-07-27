<?php
// INCLUDES

$module = 'documentsquicklinks'; $prefix = 'documentsquicklink';  $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		$id = decryptID($_POST['id']);
		$docu_name = $_POST['docu_name'];
		$date_edit =  date('F j, Y - l - h:i a', time());
		$uploads_dir = '../../../assets/uploadimages';
		$error = $_FILES["filename"]["error"];
		$x = 0;
		$countfiles = count($_FILES['filename']['name']);
			for($i=0;$i<$countfiles;$i++) {
			$x++;
			
				$docu_id =  $_POST['id'.$x];
				$name = basename($_FILES["filename"]["name"][$i]);
				$sql = $pdo->prepare("SELECT * FROM `documentstemplate` WHERE files =?");
				$sql->bindParam(1, $name);
				$sql->execute();
				if( $sql->rowCount() > 0 ) { # If rows are found for query
					$sql = $pdo->prepare("SELECT * FROM documentstemplate WHERE files = :files");
					$sql->bindParam(":files",$name);
					$sql->execute();
					$data4 = $sql->fetch(PDO::FETCH_ASSOC);
					$name = $data4['files'];
					move_uploaded_file($name, "$uploads_dir/$name");
				} else {
				
					if($name != '') {
						$docu_dl =  $_POST['docu_dl'.$x];
						$docu_id =  $_POST['id'.$x];

						$tmp_name = $_FILES["filename"]["tmp_name"][$i];
						$name = basename($_FILES["filename"]["name"][$i]);
						move_uploaded_file($tmp_name, "$uploads_dir/$name");

						$sql = 'UPDATE documentstemplate SET docu_dl=:docu_dl, files=:files WHERE id =:id';
						$stmt = $pdo->prepare($sql);
						$stmt->bindParam(':files', $name);
						$stmt->bindParam(':docu_dl', $docu_dl);
						$stmt->bindParam(':id', $docu_id);
						$stmt->execute();
					}
				}
			
			}

			

			$sql = 'UPDATE documentsquicklinks SET docu_name=:docu_name  WHERE id =:id';
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':docu_name', $docu_name);
			$stmt->bindParam(':id', $id);
			$stmt->execute();

			$sql = 'UPDATE documentstemplate SET docu_name=:docu_name  WHERE docu_id =:docu_id';
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':docu_name', $docu_name);
			$stmt->bindParam(':docu_id', $id);
			$stmt->execute();


			$_SESSION['update_webinar_events'] = 'update_webinar_events';
			$_SESSION['update_success'] = 'update_success'; 
			header('location:/edit-documentsquicklink/list/'.encryptID($id).'');

	} else { // permission not found
		$_SESSION['sys_permission_err'] = renderLang($permission_message_1);
	//	header('location: /dashboard');

	}
} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4);
//	header('location: /');

}

		?>