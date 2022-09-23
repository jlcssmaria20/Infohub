<?php
// INCLUDES
$page = 'dashboard';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
// check if user has existing session
if(checkSession()) {

	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Dashboard"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
	
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
					
				
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">

					<?php renderError('sys_permission_err'); ?>
					
					<div class="row">
						
						<!-- ACTIVE USERS -->
						<?php
							$sql = $pdo->prepare("SELECT user_id, user_status FROM users WHERE user_status = 0");
							$sql->execute();
							$active_users = $sql->rowCount();
							?>
							<div class="col-lg-3 col-6">
								<div class="small-box bg-primary">
									<div class="inner">
										<h3><?php echo number_format($active_users,0,'.',','); ?></h3>
										<p><?php echo "DX Info Hub Active Users"; ?></p>
									</div>
									<div class="icon">
										<i class="fa fa-users"></i>
									</div>
									<?php if(checkPermission('users')) { ?>
									<a href="/users" class="small-box-footer"><?php echo "more info"; ?> <i class="fas fa-arrow-circle-right"></i></a>
									<?php } ?>
								</div>
							</div>
							<div class="col-lg-3 col-6">
								<div class="small-box bg-info">
									<div class="inner">
										<h3>150</h3>
										<p>Upcoming Webinars</p>
									</div>
									<div class="icon">
										<i class="ion ion-bag"></i>
									</div>
									<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>

							<div class="col-lg-3 col-6">
								<div class="small-box bg-warning">
									<div class="inner">
										<h3>150</h3>
										<p>Announcements</p>
									</div>
									<div class="icon">
										<i class="ion ion-bag"></i>
									</div>
									<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>

							<div class="col-lg-3 col-6">
								<div class="small-box bg-danger">
									<div class="inner">
										<h3>150</h3>
										<p>Document Folders</p>
									</div>
									<div class="icon">
										<i class="ion ion-bag"></i>
									</div>
									<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>

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

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
	
</body>

</html>
<?php
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /login');
	
}
?>