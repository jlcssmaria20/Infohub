<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if($_SESSION['sys_data']['id'] == 1) {
		
		// clear tickets table
		$sql = $pdo->prepare("TRUNCATE TABLE tickets");
		$sql->execute();
		
		// clear tickets timeline
		$sql = $pdo->prepare("TRUNCATE TABLE ticket_timeline");
		$sql->execute();
		
		// delete ticket logs in system
		$sql = $pdo->prepare("DELETE FROM system_log WHERE module='tickets'");
		$sql->execute();
		
		// delete all files inside comments
		$files = glob('../../modules/tickets/assets/images/comments/*');
		foreach($files as $file){
			if(is_file($file))
				unlink($file);
		}
		
		// delete all files inside tickets
		$files = glob('../../modules/tickets/assets/images/tickets/*');
		foreach($files as $file){
			if(is_file($file))
				unlink($file);
		}
		
		?>
		<script>
			alert('Tickets reset successful!');
			location.reload();
		</script>
		<?php
		
	} else { // permission not found
		?>
		<script>
			alert('Not authorized!');
		</script>
		<?php
	}
} else { // no session found
	?>
	<script>
		alert('Session expired. Please re-login.');
	</script>
	<?php
}
?>
