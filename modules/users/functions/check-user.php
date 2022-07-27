<?php
// INCLUDES
$module = 'users';
if(isset($_GET['module'])) {
	$module = $_GET['module'];
}
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-add') || checkPermission($module.'-edit')) {

		$employee_id = $_GET['id'];
		
		$sql = $pdo->prepare("SELECT employeeid, firstname, lastname FROM users WHERE employeeid = '".$employee_id."' LIMIT 1");
		$sql->bindParam(":employee_id",$employee_id);
		$sql->execute();
		if($sql->rowCount() > 0) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			?>
			<script>
				$(function() {
					$('.user-id-message').html('<span class="text-green"><i class="fas fa-check-circle mr-1"></i><?php echo renderName($data); ?></span>');
				});
			</script>
			<?php
		} else { // error found
			?>
			<script>
				$(function() {
					$('.user-id-message').html('<span class="text-red"><i class="fas fa-exclamation-circle mr-1"></i><?php echo renderLang($users_invalid_employee_id); ?></span>');
				});
			</script>
			<?php
		}

	} else { // permission not found
		?>
		<script>
			$(function() {
				$('.user-id-message').html('<span class="text-red"><i class="fas fa-exclamation-circle mr-1"></i><?php echo renderLang($users_unauthorized); ?></span>');
			});
		</script>
		<?php
	}
} else { // no session found, redirect to login page
	?>
	<script>
		$(function() {
			$('.user-id-message').html('<span class="text-red"><i class="fas fa-exclamation-circle mr-1"></i><?php echo renderLang($users_session_expired); ?></span>');
		});
	</script>
	<?php
}
?>