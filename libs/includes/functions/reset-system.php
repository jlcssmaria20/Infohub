<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if($_SESSION['sys_data']['id'] == 1) {

		// clear tickets table
		$sql = $pdo->prepare("TRUNCATE TABLE users");
		$sql->execute();

		// insert super admin account
		// important to reinsert to get and reserve the "1" id
		$upass = encryptStr('1234');
		$sql = $pdo->prepare("INSERT INTO users(
			id,
			uname,
			upass,
			employeeid,
			firstname,
			lastname,
			roleids
		) VALUES(
			NULL,
			'superadmin',
			'".$upass."',
			'10001',
			'Super',
			'Admin',
			',1,'
		)");
		$sql->execute();

		// clear roles
		$sql = $pdo->prepare("TRUNCATE TABLE roles");
		$sql->execute();

		// insert super admin role
		// important to reinsert to get and reserve the "1" id
		$upass = encryptStr('1234');
		$sql = $pdo->prepare("INSERT INTO roles(
			id,
			role_name,
			permissions
		) VALUES(
			NULL,
			'Super Admin',
			'all'
		)");
		$sql->execute();

		// clear pcs
		$sql = $pdo->prepare("TRUNCATE TABLE pcs");
		$sql->execute();

		// clear licenses
		$sql = $pdo->prepare("TRUNCATE TABLE licenses");
		$sql->execute();

		// clear pc licenses
		$sql = $pdo->prepare("TRUNCATE TABLE pc_licenses");
		$sql->execute();

		// clear teams
		$sql = $pdo->prepare("TRUNCATE TABLE teams");
		$sql->execute();

		// clear departments
		$sql = $pdo->prepare("TRUNCATE TABLE departments");
		$sql->execute();

		// clear system log
		$sql = $pdo->prepare("TRUNCATE TABLE system_log");
		$sql->execute();

		// clear tickets table
		$sql = $pdo->prepare("TRUNCATE TABLE tickets");
		$sql->execute();

		// clear tickets timeline
		$sql = $pdo->prepare("TRUNCATE TABLE ticket_timeline");
		$sql->execute();

		// delete all files inside profile
		$files = glob('../../modules/users/assets/images/profile/*');
		foreach($files as $file){
			if(is_file($file))
				unlink($file);
		}

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
			alert('Users reset successful!');
			window.location.href = '/';
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
