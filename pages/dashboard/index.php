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