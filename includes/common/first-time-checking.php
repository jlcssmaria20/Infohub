<?php
if($_SESSION['sys_account_mode'] == 'user') {
	$password_change_notif = 0;
	$security_set_notif = 0;
	$user_id_check = $_SESSION['sys_id'];
	$sql = $pdo->prepare("SELECT * FROM users_first_time_check WHERE user_id = ".$user_id_check." LIMIT 2");
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
		if($data['warning_type'] == 'password') { $password_change_notif = 1; }
		if($data['warning_type'] == 'security') { $security_set_notif = 1; }
	}
//	echo $user_id_check.' '.$password_change_notif.' '.$security_set_notif;
	if($password_change_notif || $security_set_notif) {
		$_SESSION['sys_settings_tab_selected'] = 'change-password';
	?>
	<div class="first-time-user-notifications p-3" style="padding-bottom:0 !important;">
		<?php if($password_change_notif) { ?>
		<div class="alert alert-warning">
			<h5><i class="icon fas fa-exclamation-triangle"></i> <?php echo renderLang($settings_first_time_update_account_password_msg1); ?></h5>
			<?php echo renderLang($settings_first_time_update_account_password_msg2); ?>
		</div>
		<?php } ?>
		<?php if($security_set_notif) { ?>
		<div class="alert alert-warning">
			<h5><i class="icon fas fa-exclamation-triangle"></i> <?php echo renderLang($settings_first_time_update_security_question_msg1); ?></h5>
			<?php echo renderLang($settings_first_time_update_security_question_msg2); ?>
		</div>
		<?php } ?>
	</div>
	<?php } else {
		if(isset($_SESSION['sys_settings_tab_selected'])) {
			unset($_SESSION['sys_settings_tab_selected']);
		}
	}
}
?>