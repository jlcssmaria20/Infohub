<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('admin-add')) {
		include($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-cookie-current-page.php');

		// set page
		$page = 'admins';
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Add Admin"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/assets/css/admins.css">
	
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	
	<!-- WRAPPER -->
	<div class="wrapper">
		
		<?php
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-header.php');
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-sidebar.php');
		?>

		<!-- CONTENT -->
		<div class="content-wrapper">
			
			<!-- CONTENT HEADER -->
			<section class="content-header">
				<div class="container-fluid">
					
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><i class="fa fa-admin-secret mr-3"></i><?php echo renderLang($admins_add_admin); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_admins_add_err');
					renderSuccess('sys_admins_add_suc');
					?>
					
					<form method="post" action="/submit-add-admin">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($admins_add_admin_form); ?></h3>
							</div>
							<div class="card-body">

								<div class="row">

									<!-- USERNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_admins_add_username_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="username" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($admins_username); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="4" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="username" name="username" placeholder="<?php echo renderLang($admins_username_placeholder); ?>"<?php if(isset($_SESSION['sys_admins_add_username_val'])) { echo ' value="'.$_SESSION['sys_admins_add_username_val'].'"'; } ?> required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_admins_add_username_err'].'</p>'; unset($_SESSION['sys_admins_add_username_err']); } ?>
										</div>
									</div>
									
								</div>
									
								<hr>
								
								<div class="row">

									<!-- FIRSTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$firstname_err = 0;
										if(isset($_SESSION['sys_admins_add_firstname_err'])) { $firstname_err = 1; }
										?>
										<div class="form-group">
											<label for="firstname" class="mr-1<?php if($firstname_err) { echo ' text-danger'; } ?>"><?php if($firstname_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($admins_firstname); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($firstname_err) { echo ' is-invalid'; } ?>" id="firstname" name="firstname" placeholder="<?php echo renderLang($admins_firstname_placeholder); ?>"<?php if(isset($_SESSION['sys_admins_add_firstname_val'])) { echo ' value="'.$_SESSION['sys_admins_add_firstname_val'].'"'; } ?> required>
											<?php if($firstname_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_admins_add_firstname_err'].'</p>'; unset($_SESSION['sys_admins_add_firstname_err']); } ?>
										</div>
									</div>

									<!-- LASTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$lastname_err = 0;
										if(isset($_SESSION['sys_admins_add_lastname_err'])) { $lastname_err = 1; }
										?>
										<div class="form-group">
											<label for="lastname" class="mr-1<?php if($lastname_err) { echo ' text-danger'; } ?>"><?php if($lastname_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($admins_lastname); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($lastname_err) { echo ' is-invalid'; } ?>" id="lastname" name="lastname" placeholder="<?php echo renderLang($admins_lastname_placeholder); ?>"<?php if(isset($_SESSION['sys_admins_add_lastname_val'])) { echo ' value="'.$_SESSION['sys_admins_add_lastname_val'].'"'; } ?> required>
											<?php if($lastname_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_admins_add_lastname_err'].'</p>'; unset($_SESSION['sys_admins_add_lastname_err']); } ?>
										</div>
									</div>

								</div><!-- row -->
								
							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/admins" class="btn btn-default text-dark mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-plus mr-2"></i><?php echo renderLang($admins_add_admin); ?></button>
							</div>
						</div><!-- card -->
					</form>
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
	<script>
		$(function() {
			
			
			
		});
	</script>
	
</body>

</html>
<?php
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /');
	
}
?>