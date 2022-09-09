<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('user-edit')) {

		// PROCESS FORM
		$user_id = decryptID($_GET['id'],'users');
		$code = $_GET['code'];
		$mode = $_GET['mode'];

		$sql = $pdo->prepare("SELECT user_id, permissions FROM users WHERE user_id = :user_id LIMIT 1");
		$sql->bindParam(":user_id",$user_id);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_ASSOC);
		$curr_permissions = $data['permissions'];

		// check if ID exists
		if($sql->rowCount()) {

			if(!$mode) {
				$permissions = $curr_permissions.$code.',';
			} else {
				$curr_permissions_arr = explode(',',$curr_permissions);
				foreach($curr_permissions_arr as $i => $curr_permission) {
					if($curr_permission == $code) {
						unset($curr_permissions_arr[$i]);
					}
				}
				$permissions = implode(',',$curr_permissions_arr);
			}

			$sql = $pdo->prepare("UPDATE users SET permissions = :permissions WHERE user_id = :user_id");
			$bind_param = array(
				':user_id'      => $user_id,
				':permissions'  => $permissions
			);
			$sql->execute($bind_param);
			
			// START ADDITIONALS
			// END ADDITIONALS

			if(!$mode) {
				?>
				<script>
					alert('<?php echo renderLang($users_permissions_added); ?>');
					var permission = $('#<?php echo $code; ?>');
					permission.addClass('bg-info');
					permission.find('.icon-indicator i')
						.removeClass('fa').removeClass('fa-times')
						.addClass('far').addClass('fa-circle');
					permission.find('.permission-type').html('<i class="far fa-user" title="<?php echo renderLang($users_permission_for_user); ?>"></i>');
				</script>
				<?php
			} else {
				?>
				<script>
					alert('<?php echo renderLang($users_permissions_removed); ?>');
					var permission = $('#<?php echo $code; ?>');
					permission.removeClass('bg-info');
					permission.find('.icon-indicator i')
						.addClass('fa').addClass('fa-times')
						.removeClass('far').removeClass('fa-circle-alt');
					permission.find('.permission-type').html('');
				</script>
				<?php
			}

		} else {

			?>
			<script>
				alert('<?php echo renderLang($users_user_not_found); ?>');
			</script>
			<?php

		}

	} else { // permission not found

		$_SESSION['sys_permission_err'] = 'You are not authorized to access the page or function.'; // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}

} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /login');

}
?>