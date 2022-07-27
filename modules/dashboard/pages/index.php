<?php
// INCLUDES
$module = 'dashboard'; $prefix = 'dashboard';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
include($root.'/modules/'.$module.'/support/lang.php');

// check if user has existing session
if(checkSession()) {

	// get module icon
	include($root.'/includes/support/get-module-icon.php');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo renderLang(${$module.'_dashboard'}); ?> &middot; <?php echo renderLang($sitename); ?></title>
	
	<?php require($root.'/includes/common/links.php'); ?>
	
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
	
	<!-- WRAPPER -->
	<div class="wrapper">
		
		<?php
		require($root.'/includes/common/header.php');
		require($root.'/includes/common/sidebar.php');
		?>

		<!-- CONTENT -->
		<div class="content-wrapper">
			
			<!-- CONTENT HEADER -->
			<section class="content-header">
				<div class="container-fluid">
					
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><i class="<?php echo $module_icon; ?> mr-3"></i><?php echo renderLang(${$module.'_dashboard'}); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">

					<?php renderError('sys_permission_err'); ?>
					
					<div class="row">
						
						<!-- ACTIVE USERS -->
						<?php
						if(checkPermission('users')) {
							$sql = $pdo->prepare("SELECT id, status FROM users WHERE status = 0");
							$sql->execute();
							$active_users = $sql->rowCount();
							?>
							<div class="col-lg-3 col-6">
								<div class="small-box bg-primary">
									<div class="inner">
										<h3><?php echo number_format($active_users,0,'.',','); ?></h3>
										<p><?php echo renderLang(${$module.'_active_users'}); ?></p>
									</div>
									<div class="icon">
										<i class="fa fa-users"></i>
									</div>
									<a href="/users" class="small-box-footer"><?php echo renderLang(${$module.'_more_info'}); ?> <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
						<?php } ?>
					</div><!-- row -->
					
					<div class="row mt-2">
						
						<!-- LEFT COLUMN -->
						<div class="col-md-6">
							
							
						</div>
						
						<!-- RIGHT COLUMN -->
						<div class="col-md-6">
						</div>
						
					</div><!-- row -->
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($root.'/includes/common/footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($root.'/includes/common/js.php'); ?>
	
</body>

</html>
<?php
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /');
	
}
?>