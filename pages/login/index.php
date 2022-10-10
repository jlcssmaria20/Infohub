<?php
// INCLUDES
$page = 'login';
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
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Login"; ?></title>
	
	<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-DXDG9F8NFW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-DXDG9F8NFW');
</script>

<body class="hold-transition overflow-hidden">
	<nav class="navbar navbar-expand navbar-white navbar-light ml-0 px-4">
		
		<!-- NAV LEFT -->
		<ul class="navbar-nav">
			
			<li class="nav-item d-flex align-items-center py-2">
				<img src="/assets/images/favicon.png" alt=""class="mr-3" style="width:50px"> <h4 class="mb-0">Digital Experience Info Hub</h4>
			</li>
			
		</ul>

		<!-- NAV RIGHT -->
		<ul class="navbar-nav ml-auto">
			
			<li class="nav-item">
				<a  href="/" class="btn btn-outline-primary">
					<i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>
					Go to DX Info Hub
				</a>
			</li>
			
		</ul><!-- nav right -->
		
	</nav>
	<!-- LOGIN BOX -->
	<div class="row d-flex justify-content-center align-items-center">
		<div class="col">
			<div class="w-50 m-auto">
				<div class="card-body p-0">
					<h1 class="my-3"><?php echo renderLang($login_sign_in); ?></h1>
					<form action="/submit-login" method="post">
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
						
						<div class="row align-items-center my-4">
							<div class="col-6">
								<div class="icheck-primary">
									<input type="checkbox" id="remember_me" name="remember_me" value="1"<?php if(isset($spooder_creds)) { echo ' checked'; } ?>>
									<label for="remember_me"><?php echo renderLang($login_remember_me); ?></label>
								</div>
							</div>
							<div class="col-6 text-right">
								<a href="/o-teams" class="text-primary font-weight-bold p-0 forgot-password" style="font-size:1rem;">Forgot Password?</a>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<button type="submit" name="submit-login" class="btn btn-block text-light" style="background-color: var(--blue)"><?php echo renderLang($login_sign_in); ?></button>
							</div>
						</div>
						<hr>
						<div class="text-center">
							<span>Business Suite - DX Info Hub<br>Copyright 2021. All Rights Reserved.</span>				
						</div>
					</form>					
				</div>
			</div>

		</div>
		<div class="col">
			<div class="m-auto">
				<img src="assets/images/website.png" alt="" style="width:550px;">
			</div>
		</div>
	</div>


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