<?php
// INCLUDES
$module = 'announcements'; $prefix = 'announcement'; $process = 'delete';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$err_code = 1;

	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		$err = 0;

		// PROCESS FORM
		$id = decryptID($_POST['id']);

		$_SESSION['delete_success'] = 'delete_success';

		$sql = 'DELETE FROM announcements WHERE id = :id';
		// prepare the statement for execution
		$statement = $pdo->prepare($sql);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();

		unset($_SESSION['add_document_success']);
		unset($_SESSION['documentalreadyexist']);

}
require($root.'/includes/common/js.php');
?>
<button id="myCheck" onclick="history.back()" style="display:none;">Go Back</button>
<script>
$(function(){
	$('#myCheck').trigger('click');
});
</script>	
