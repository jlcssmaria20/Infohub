<?php
// INCLUDES
$module = 'documentsquicklinks'; $prefix = 'documentsquicklink'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

	// Get data from other page\
	$ids = $_POST['id'];
	$date_added = date('F j, Y - l - h:i a', time());

	print_r($_POST['docu_dl']);



	///////////////////////////////////////
		$id = $_SESSION['sys_data']['id'];
		$date_added = date('F j, Y - l - h:i a', time());

		$sql = $pdo->prepare("SELECT * FROM documentsquicklinks WHERE id LIKE :id ");
		$sql->bindParam(':id', $ids);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
			for($i = 0; $i < count($_POST['docu_dl']); $i++) {
	
				if($_FILES['filename']['name']!="") {
					$filename = $_FILES['filename']['name'][$i];
					$path   =   '../../../assets/uploadimages/'.$filename;
					move_uploaded_file($_FILES['filename']['tmp_name'][$i],$path);
				}
	
				$sql = 'INSERT INTO documentstemplate (`user_id`, docu_name, docu_id, docu_dl, files,date_added) VALUES(?, ?, ?, ?, ?, ?)';
				$statement = $pdo->prepare($sql);
				$statement->bindParam(1, $id);
				$statement->bindParam(2, $data['docu_name']);
				$statement->bindParam(3, $ids);
				$statement->bindParam(4, $_POST['docu_dl'][$i]);
				$statement->bindParam(5, $filename);
				$statement->bindParam(6, $date_added);
				$statement->execute();
			}
	

 require($root.'/includes/common/js.php');
 ?>
<button id="myCheck" onclick="history.back()">Go Back</button>
<script>
$(function(){
    $('#myCheck').trigger('click');
});
</script>