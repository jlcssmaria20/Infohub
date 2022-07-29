<?php
// INCLUDES
$module = 'login';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
// check if user credentials are remembered
// set default values from cookies
$cookie_login_value = '';
$cookie_login_password = '';
if(isset($_COOKIE['sys_cookie_'.$system_code])) {
	$spooder_creds = explode('|',$_COOKIE['sys_cookie_'.$system_code]);
	$cookie_login_value = $spooder_creds[0];
	$cookie_login_password = $spooder_creds[1];
}
//include "test.php";
?>
<!DOCTYPE html>
<html>

<head>
	
	<!-- META -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo renderLang($sitename); ?></title>
	
	<?php include($root.'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/modules/<?php echo $module; ?>/assets/css/style.css">
	
</head>

<body class="hold-transition login-page">
	
	<!-- LOGIN BOX -->
	<div class="login-box">
		
		<!-- LOGO -->
		<div class="login-logo">
			<a href="#">DX INFO HUB</a>
		</div><!-- login-logo -->
		
		<!-- CARD -->
		<div class="card">
			
			<!-- CARD BODY -->
			<div class="card-body login-card-body">
				<p class="login-box-msg"><?php echo renderLang($login_message_1); ?></p>		
				<form action="/login" method="post">
					<div class="input-group mb-3">
						<input type="text" id="uname" class="form-control" name="uname" placeholder="<?php echo renderLang($login_login_placeholder); ?>"<?php if($cookie_login_value != '') { echo ' value="'.$cookie_login_value.'"'; } else { if(isset($_SESSION['sys_login_uname'])) { echo ' value="'.$_SESSION['sys_login_uname'].'"'; } } ?> required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					
					<div class="input-group mb-3">
						<input type="password" id="upass" class="form-control" name="upass" placeholder="<?php echo renderLang($login_password_placeholder); ?>"<?php if($cookie_login_password != '') { echo ' value="'.$cookie_login_password.'"'; } ?> required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					
					<?php
					renderError('sys_login_err');
					renderSuccess('sys_login_suc');

					?>
					
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="remember_me" name="remember_me" value="1"<?php if(isset($spooder_creds)) { echo ' checked'; } ?>>
								<label for="remember_me"><?php echo renderLang($login_remember_me); ?></label>
							</div>
						</div>
						<div class="col-4">
							<button type="submit" name="submit-login" class="btn btn-primary btn-block btn-flat"><?php echo renderLang($login_sign_in); ?></button>
						</div>
					</div>
					
				</form>

<!--
				<p class="mb-1">
					<a href="#"><?php //echo renderLang($login_forgot_password); ?></a>
				</p>
-->
				
			</div>
			
		</div><!-- card -->
		
		<div class="login-footer">
			<p>Business Suite - DX Info Hub<br>Copyright 2021. All Rights Reserved.</p>
		</div>
		
	</div>
	<!-- /.login-box -->

	<!-- JAVASCRIPT -->
	<script src="/plugins/jquery/jquery.min.js"></script>
	<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/dist/js/adminlte.min.js"></script>
	<script>
		$(function() {
			
			// set uname focus if it is not blank, else focus on upass
			if($('#uname').val() == '') {
				$('#uname').focus();
			} else {
				$('#upass').focus();
			}

		});
	</script>

</body>

</html>