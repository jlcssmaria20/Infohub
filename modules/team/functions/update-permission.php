<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission($module.'-edit') && $id != 1) {

		// PROCESS FORM
		$id = decryptID($_GET['id']);
		$code = $_GET['code'];
		$mode = $_GET['mode'];

		$sql = $pdo->prepare("SELECT id, permissions FROM ".$module." WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
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
			
			$sql = $pdo->prepare("UPDATE users SET permissions = :permissions WHERE id = :id");
			$sql->bindParam(":id",$id);
			$sql->bindParam(":permissions",$permissions);
			$sql->execute();

			// START ADDITIONALS
			// END ADDITIONALS

			$change_logs = array();
			$tmp = 'lang_permissions::'.$curr_permissions.'=='.$permissions;
			array_push($change_logs,$tmp);

			// record to system log
			$change_log = implode(';;',$change_logs);
			systemLog($module,$id,$process,$change_log);

			if(!$mode) {
				?>
				<script>
					alert('<?php echo renderLang(${$module.'_permissions_added'}); ?>');
					var permission = $('#<?php echo $code; ?>');
					permission.addClass('bg-info');
					permission.find('.icon-indicator i')
						.removeClass('fa').removeClass('fa-times')
						.addClass('far').addClass('fa-circle');
					permission.find('.permission-type').html('<i class="far fa-user" title="<?php echo renderLang(${$module.'_permission_for_user'}); ?>"></i>');
				</script>
				<?php
			} else {
				?>
				<script>
					alert('<?php echo renderLang(${$module.'_permissions_removed'}); ?>');
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
				alert('<?php echo renderLang(${$module.'_user_not_found'}); ?>');
			</script>
			<?php

		}

	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}

} else { // no session found, redirect to login page

	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /');

}
?>