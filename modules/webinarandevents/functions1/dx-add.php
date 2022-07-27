<?php
// INCLUDES
$module = 'documentsquicklinks'; $prefix = 'documentsquicklink'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');


	// Get data from other page
	$docu_name = $_POST['docu_name'];
	$date_added = date('F j, Y - l - h:i a', time());

    // check table if already exist
	$sql = $pdo->prepare("SELECT docu_name FROM `documentstemplate` WHERE docu_name =?");
	$sql->bindParam(1, $docu_name);
	$sql->execute();
	if( $sql->rowCount() > 0 ) { # If rows are found for query
		unset($_SESSION['add_document_success']);
		$_SESSION['documentalreadyexist'] = 'documentalreadyexist';
	}
	else {
		//unset session
		unset($_SESSION['documentalreadyexist']);
		$_SESSION['add_document_success'] = 'add_document_success';

		$id = $_SESSION['sys_data']['id'];
		$date_added = date('F j, Y - l - h:i a', time());
		
        for($i = 0; $i < count($_POST['docu_name']); $i++) {

			if($_FILES['filename']['name']!="") {
				$filename = $_FILES['filename']['name'][$i];
				$path   =   '../../../assets/uploadimages/'.$filename;
				move_uploaded_file($_FILES['filename']['tmp_name'][$i],$path);
			}

            $sql = 'INSERT INTO documentstemplate (user_id, docu_name, docu_dl, files,date_added) VALUES(?, ?, ?, ?, ?)';
            $statement = $pdo->prepare($sql);
			$statement->bindParam(1, $id);
			$statement->bindParam(2, $_POST['docu_name'][$i]);
			$statement->bindParam(3, $_POST['docu_dl'][$i]);
            $statement->bindParam(4, $filename);
			$statement->bindParam(5, $date_added);

			$statement->execute();
        }

			// //insert to webinar query
			// $sql = $pdo->prepare("INSERT INTO documentstemplate (`user_id`, `docu_name`, `date_added`) VALUES (?,?,?)");
			// $sql->bindParam(1, $_SESSION['sys_data']['id']);
			// $sql->bindParam(2, $docu_name);
			// $sql->bindParam(3, $date_added);
			// $sql->execute();
		
	} // else
	
    header('location:/add-documents-and-quick-link');
?>
