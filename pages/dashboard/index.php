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
	<link rel="stylesheet" href="assets/css/dashboard.css">
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
		<div class="content-wrapper bg-white">
			
			<!-- CONTENT HEADER -->
			<section class="content-header">
				<div class="container-fluid">
					
					<h1 class="mx-5 text-center">Welcome, <span><?php echo $_SESSION['sys_firstname']; ?> </span>!</h1>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content m-5">
				<div class="container-fluid">

					<?php renderError('sys_permission_err'); ?>
					
					<div class="row">
						
						<!-- ACTIVE USERS -->
						<div class="col-lg-4 col-4">
							<?php
								$sql = $pdo->prepare("SELECT user_id, user_status FROM users WHERE user_status = 0");
								$sql->execute();
								$active_users = $sql->rowCount();
							?>
							<div class="small-box shadow dash-cardbox user-cardbox text-light">
								<div class="inner pl-4 mb-2">
									<span class="dash-number"><?php echo number_format($active_users,0,'.',','); ?></span><br>
									<span class="dash-title"><?php echo "Active Users"; ?></span><br>
									<span class="dash-desc"><?php echo "Total number of Info Hub Users"; ?></span>
								</div>
								<div class="icon text-light">
									<i class="fa fa-users"></i>
								</div>
								<?php if(checkPermission('users')) { ?>
									<a href="/users" class="small-box-footer footer-cardbox">
									Know More <i class="fas fa-arrow-circle-right ml-2"></i>
									</a>
								<?php } ?>
							</div>
						</div>
						<!-- WEBINARS -->
						<div class="col-lg-4 col-4">
							<?php
								$sql = $pdo->prepare("SELECT id, webinar_title, webinar_status FROM webinarandevents WHERE webinar_status = 0  ORDER BY id DESC LIMIT 1 ");
								$sql->execute();
								
								while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
								
									$count =  $pdo->prepare("SELECT id, webinar_status FROM webinarandevents WHERE webinar_status = 0");
									$count->execute();
									$active_webinars = $count->rowCount();

							?>
							<div class="small-box shadow dash-cardbox webinar-cardbox">
								<div class="inner pl-4 mb-2 text-light">
									<span class="dash-number"><?php echo number_format($active_webinars,0,'.',','); ?></span><br>
									<span class="dash-title">
										<?php echo 'Upcoming Webinars' ?>
									</span><br>
									<span class="dash-desc">Title: <?php echo $data['webinar_title'] ; ?></span>
								</div>
								<div class="icon text-light">
									<i class="fas fa-calendar-alt"></i>
								</div>
								<?php if(checkPermission('webinar-and-events')) { ?>
									<a href="/webinarandevents" class="small-box-footer footer-cardbox">
									Know More <i class="fas fa-arrow-circle-right ml-2"></i>
									</a>
								<?php } }?>
							</div>
						</div>
						<!-- ANNOUNCEMENT -->
						<div class="col-lg-4 col-4">
							<?php
								$sql = $pdo->prepare("SELECT id, announcements_title, announcements_status FROM announcements WHERE announcements_status = 0  ORDER BY id DESC LIMIT 1 ");
								$sql->execute();
								
								while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
								
									$count =  $pdo->prepare("SELECT id, announcements_status FROM announcements WHERE announcements_status = 0");
									$count->execute();
									$active_announcements = $count->rowCount();

							?>
							<div class="small-box shadow dash-cardbox announcement-cardbox text-light">
								<div class="inner pl-4 mb-2">
									<span class="dash-number"><?php echo number_format($active_announcements,0,'.',','); ?></span><br>
									<span class="dash-title"><?php echo 'Announcement' ?></span><br>
									<span class="dash-desc">Title: <?php echo $data['announcements_title']; ?></span>
								</div>
								<div class="icon  text-light">
									<i class="fa fa-bullhorn"></i>
								</div>
								<?php if(checkPermission('users')) { ?>
									<a href="/announcements" class="small-box-footer footer-cardbox">
									Know More <i class="fas fa-arrow-circle-right ml-2"></i>
									</a>
								<?php } } ?>
							</div>
						</div>
						
						<!-- ACTIVE USERS -->
						<div class="col-lg-4 col-4">
							<?php
								$sql = $pdo->prepare("SELECT user_id, user_status FROM users WHERE user_status = 0");
								$sql->execute();
								$active_users = $sql->rowCount();
							?>
							<div class="small-box bg-white border border-secondary shadow dash-cardbox">
								
								<div class="inner pl-4 mb-2">
									<span class="text-primary dash-number"><?php echo number_format($active_users,0,'.',','); ?></span><br>
									<span class="text-primary dash-title"><?php echo "Active Users"; ?></span><br>
									<span class="text-secondary dash-desc"><?php echo "Total number of Info Hub Users"; ?></span>
								</div>
								<div class="icon text-dark">
									<i class="fa fa-users"></i>
								</div>
								<?php if(checkPermission('users')) { ?>
									<a href="/users" class="small-box-footer footer-cardbox">
									Know More <i class="fas fa-arrow-circle-right ml-2"></i>
									</a>
								<?php } ?>
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