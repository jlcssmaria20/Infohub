<?php
// INCLUDES
$page = 'dashboard';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
// check if user has existing session
if(checkSession()) {

	$users_arr = getTable('users');

	
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
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content m-3">
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
								<div class="inner pl-4 mb-3">
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
								$sql = $pdo->prepare("SELECT id, webinar_title, webinar_status FROM webinarandevents WHERE webinar_status = 0 AND date_set > NOW() ORDER BY date_set ASC LIMIT 1");
								$sql->execute();
								
								while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
								
									$count =  $pdo->prepare("SELECT id, webinar_status FROM webinarandevents WHERE webinar_status = 0 AND date_set > NOW()");
									$count->execute();
									$active_webinars = $count->rowCount();

							?>
							<div class="small-box shadow dash-cardbox webinar-cardbox">
								<div class="inner pl-4 mb-2 text-light">
									<span class="dash-number"><?php echo number_format($active_webinars,0,'.',','); ?></span><br>
									<span class="dash-title">
										<?php echo 'Upcoming Webinar' ?>
									</span><br>
									<div class="dash-desc w-75">
										<span class="text-truncate">Title: <?php echo $data['webinar_title'] ; ?></span>
									</div>
									
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
									<div class="dash-desc w-75">
										<span class="text-truncate">Title: <?php echo $data['announcements_title']; ?></span>
									</div>
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
						
					
					</div><!-- row -->
					<?php 
					if($_SESSION['sys_account_mode'] == 'user') {
						$isAmbassador = 0;
						$roles_arr = explode(",", $_SESSION['sys_role_ids']);
						if (in_array(2, $roles_arr)){
							$isAmbassador = 1;
						}
					 ?>
					 <?php if($isAmbassador){ ?>
						<div class="row mt-3">

							<div class="col-sm-6">

								<div class="card">
									<div class="card-header">
										<h3 class="card-title">[Ambassador] Assigned Webinar and Events List </h3>
									</div>
									<div class="card-body">

										<div class="table-responsive">
											<table id="table-data" class="table table-bordered table-striped table-hover">
												<thead>
													<tr>
														<th class="text-center" style="width: 200px;">Title</th>
														<th class="text-center">Speaker</th>
														<th class="text-center">Date</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$data_count = 0;
													$sql = $pdo->prepare("SELECT *
														FROM webinarandevents
														WHERE webinar_host = :employee_id AND temp_del = 0
														ORDER BY date_set DESC");
														$bind_param = array(
															'employee_id' => $_SESSION['sys_employee_id']
														);
														$sql->execute($bind_param);
													
													while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
														$data_count++;
													
													
														echo '<tr>';

															// WEBINAR TITLE
															echo '<td>'.$data['webinar_title'].'</td>';

															// WEBINAR SPEAKER
															foreach($users_arr as $user) {
																if($user['user_employee_id'] == $data['webinar_speaker']) {
																	echo '<td>'.$user['user_firstname'].' '.$user['user_lastname'].'</td>';
																	break;
																}
															}

															//WEBINAR SCHEDULE
																			
															echo '<td>';
																echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
															echo '</td>';
														

													
														echo '</tr>';
													}
													?>
												</tbody>
											</table>
										</div><!-- table-responsive -->
									</div>
								</div><!-- card -->
								
							</div>
							
						</div><!-- row -->
					<?php } ?>	
				<?php } ?>	
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