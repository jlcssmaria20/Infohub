<?php

// INCLUDES
$module = 'documentsquicklinks'; $prefix = 'documentsquicklink'; $process = 'delete';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');


		// PROCESS FORM
		$id = decryptID($_GET['id']);


		// $_SESSION['delete_success'] = 'delete_success';

		$sql = 'DELETE FROM documentstemplate WHERE id = :id';
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		// unset($_SESSION['add_document_success']);
		// unset($_SESSION['documentalreadyexist']);

		//header('location:/edit-documentsquicklink/list/'.encryptID('1').'');


 require($root.'/includes/common/js.php');
 ?>
<button id="myCheck" onclick="history.back()">Go Back</button>
<script>
$(function(){
    $('#myCheck').trigger('click');
});
</script>