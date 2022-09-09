<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('users')) {
	
		// clear sessions from forms
		clearSessions();

		// set page
		$page = 'users';
		
		// get ID
		$user_id = decryptID($_GET['id']);

		$sql = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id LIMIT 1");
		$sql->bindParam(":user_id",$user_id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {
			
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$user_permissions_db = explode(',',$data['permissions']);
			$user_employee_id = $data['user_employee_id'];
			$status = $data['user_status'];
			switch($_SESSION['sys_language']) {
				case 0:
					$fullname = $data['user_firstname'].' '.$data['user_lastname'];
					break;
				case 1:
					$fullname = $data['user_lastname'].' '.$data['user_firstname'];
					break;
			}

			$roles_arr = getTable('roles');
			$role_ids = explode(',',$data['role_ids']);
			
			// set role array session
			$user_permissions = array();
			
			// create where clause for multiple roles
			$roleids_arr = explode(',',$data['role_ids']);
			$roleids_arr = implode(',',array_filter($roleids_arr));

			$all_permission = 0;
			
			// get permissions based on roleids
			$sql = $pdo->prepare("SELECT role_id, permissions FROM roles WHERE role_id IN (".$roleids_arr.")");
			$sql->execute();
			while($_data = $sql->fetch(PDO::FETCH_ASSOC)) {
				if($_data['permissions'] != 'all') {
					$permissions_arr_db = explode(',',$_data['permissions']);
					$in_array = 0;
					foreach($permissions_arr_db as $permission) {
						if(!in_array($permission,$user_permissions)) {
							array_push($user_permissions,$permission);
						}
					}
				} else {
					$all_permission = 1;
				}
			}

			// get all permissions
			if($all_permission) {
				foreach($permissions_arr as $permissions_group) {
					foreach($permissions_group as $permission) {
						array_push($user_permissions,$permission['permission_code']);
					}
				}
			}

			// get photo
			if($data['user_photo'] == '') {
				if($data['user_gender'] == 0) {
					$user_photo = '/dist/img/avatar2.png';
				} else {
					$user_photo = '/dist/img/avatar5.png';
				}
			} else {
				$user_photo = '/assets/images/profile/'.$data['user_photo'];
			}
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $fullname.' &middot; '.renderLang($users_user); ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/assets/css/users.css">
	
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
							<h1>
								<i class="fa fa-user-secret mr-3"></i><?php echo renderLang($users_user); ?>
								&raquo;
								<?php echo $fullname; ?>
							</h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					if($data['user_status'] == 2 && $data['temp_del'] != 0) {
						$_SESSION['sys_users_err'] = renderLang($users_user_deleted);
					}
					renderError('sys_users_err');
					?>
					
					
					<div class="row">
						<div class="col-md-3">

							<!-- Profile Image -->
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle" src="<?php echo $user_photo; ?>" alt="User profile picture" width="100" height="100">
									</div>
									<h3 class="profile-username text-center"><?php echo $fullname; ?></h3>
									<p class="text-muted text-center">
										<?php
										$role_names_arr = array();
										foreach($roles_arr as $role) {
											if(in_array($role['role_id'],$role_ids)) {
												array_push($role_names_arr,$role['role_name']);
											}
										}
										$role_names = implode(', ',$role_names_arr);
										echo $role_names;
										?>
									</p>
									<ul class="list-group list-group-unbordered mb-3">
										<li class="list-group-item">
											<b><?php echo renderLang($centers_center); ?></b>
											<span class="float-right">
												<?php
												$center_data = getData($data['center_id'],'centers','center');
												echo '<a href="/center/'.$center_data['center_id'].'">['.$center_data['center_code'].'] '.$center_data['center_name'].'</a>';
												?>
											</span>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang($departments_department); ?></b>
											<span class="float-right">
												<?php
												$department_data = getData($data['department_id'],'departments','department');
												echo '<a href="/department/'.$department_data['department_id'].'">['.$department_data['department_code'].'] '.$department_data['department_name'].'</a>';
												?>
											</span>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang($teams_team); ?></b>
											<span class="float-right">
												<?php
												$team_data = getData($data['team_id'],'teams','team');
												echo '<a href="/team/'.$team_data['team_id'].'">['.$team_data['team_code'].'] '.$team_data['team_name'].'</a>';
												?>
											</span>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang($teams_team); ?></b>
											<span class="float-right">
												<?php
												$team_data = getData($data['team_id'],'teams','team');
												echo '<a href="/team/'.$team_data['team_id'].'">'.$team_data['team_name'].'</a>';
												?>
											</span>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang($users_position); ?></b>
											<span class="float-right">
												<?php 
												$position_data = getData($data['user_position'],'positions','position');
												echo $position_data['position_name'] 
												?>
											</span>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang($user_level); ?></b>
											<span class="float-right">
												<?php echo $data['user_level'] ?>
											</span>
										</li>
									</ul>
								</div><!-- /.card-body -->
							</div>
							<!-- /.card -->

						</div><!-- /.col -->
						
						<div class="col-md-9">
							<div class="card">
								<div class="card-header p-2">
									<ul class="nav nav-pills">
										<li class="nav-item"><a class="active nav-link" href="#projects_tab" data-toggle="tab"><?= renderLang($user_projects) ?></a></li>
										<?php if(checkPermission('role-edit')) {?>
										<li class="nav-item"><a class="nav-link" href="#permissions_tab" data-toggle="tab"><?= renderLang($user_tab_permissions) ?></a></li>
										<?php } ?>
										<li class="nav-item"><a class="nav-link" href="#leaves_tab" data-toggle="tab"><?= renderLang($user_leaves) ?></a></li>
										<?php if($_SESSION['sys_center_id'] == 1) { ?>
										<li class="nav-item"><a class="nav-link" href="#misses_tab" data-toggle="tab"><?= renderLang($user_misses) ?></a></li>
										<?php } ?>
										<?php if($_SESSION['sys_account_mode'] == 'admin') { ?>
										<li class="nav-item"><a class="nav-link" href="#option_tab" data-toggle="tab"><?= renderLang($user_option) ?></a></li>
										<?php } ?>
									</ul>
								</div><!-- /.card-header -->
								<div class="card-body">
									<div class="tab-content">
										
										<div class="active tab-pane" id="projects_tab"></div><!-- /.tab-pane -->
										
										<?php if(checkPermission('role-edit')) {?>
										<div class="tab-pane" id="permissions_tab">
											<table class="table permissions-table">
												<tbody>
													<?php
													foreach($permissions_arr as $permissions) {
														foreach($permissions as $permission) {

															$role_type = '<i class="far fa-id-badge" title="'.renderLang($users_permission_from_role).'"></i>';

															if(in_array($permission['permission_code'],$user_permissions)) {
																$bgcolor = 'bg-green';
																$icon = '<i class="far fa-circle"></i>';
															} else {
																if(in_array($permission['permission_code'],$user_permissions_db)) {
																	$bgcolor = 'bg-info';
																	$icon = '<i class="far fa-circle"></i>';
																	$role_type = '<i class="far fa-user" title="'.renderLang($users_permission_for_user).'"></i>';
																} else {
																	$bgcolor = '';
																	$icon = '<i class="fa fa-times"></i>';
																}
															}

															echo '<tr class="'.$bgcolor.'" id="'.$permission['permission_code'].'" data-permission="'.$permission['permission_code'].'">';
																echo '<td class="icon-indicator">'.$icon.'</td>';
																echo '<td>';
																	echo '<h5>'.renderLang($permission['permission_name']).'</h5>';
																	echo '<p>'.renderLang($permission['permission_description']).'</p>';
																echo '</td>';
																echo '<td class="permission-type">'.$role_type.'</td>';
															echo '</tr>';

														}
													}
													?>
												</tbody>
											</table>
										</div><!-- /.tab-pane -->
										<?php } ?>
										
										<div class="tab-pane" id="leaves_tab">
												<!-- /.card-header -->
													<div class="card-body">
														<div id="accordion">
															<!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
															<div class="card card-success">
																<div class="card-header">
																	<h4 class="card-title">
																		<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
																			<?php echo date('Y');?>
																		</a>
																	</h4>
																</div>
																<div id="collapseOne" class="panel-collapse collapse in">
																	<div class="card-body">
																		<table id="table-data" class="table table-bordered table-hover">
																			<thead>
																				<tr>
																					<th class="text-center"><?php echo renderLang($leave_date); ?></th>
																					<th class="text-center"><?php echo renderLang($lang_leave_type); ?></th>
																					<th class="text-center"><?php echo renderLang($leave_day); ?></th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$yr_now = date('Y');
																				
																				$count = 0;
																				$sql = $pdo->prepare("SELECT * FROM leaves WHERE user_id = :user_id AND datecode LIKE '".$yr_now."%' AND temp_del = 0 ORDER BY datecode DESC");
																				$sql->bindParam(":user_id",$user_id);
																				$sql->execute();
																				$data = $sql->fetchAll(PDO::FETCH_ASSOC);
																				
																				if($data) {
																					foreach($data as $item) {
																						$count++;
																						$datecode = $item['datecode'];
																						echo '<tr><td class="text-left">'.date("M jS, Y (D)", strtotime($datecode)).'</td>';
																						foreach($leave_types_arr as $type) {
																							if($type[0] == $item['leave_type']) {
																								echo '<td class="text-left"><strong>'.strtoupper(renderLang($type[2])).'</strong></td>';
																							}
																						}
																						echo '<td class="text-center">'.$item['leave_charge'].' '.strtolower(renderLang($leave_day)).'</td>';
																						echo '</tr>';
																					}
																				}else{
																					echo '<tr><td colspan="3" class="text-center"><strong>'.renderLang($lang_no_data_display).'</strong></td></tr>';
																				}
																					
																				?>
																			</tbody>
																		</table>
																			
																	</div>
																</div>
															</div>
															<div class="card card-success">
																<div class="card-header">
																	<h4 class="card-title">
																		<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
																			2019
																		</a>
																	</h4>
																</div>
															</div>
														</div>
													</div>
													<!-- /.card-body -->
											</div>
											
										<?php if($_SESSION['sys_center_id'] == 1) { ?>
										<div class="tab-pane" id="misses_tab">
											
											<table id="table-data" class="table table-bordered table-hover">
												<thead>
													<tr>
														<th class="text-center"><?php echo renderLang($mistake_management_date); ?></th>
														<th class="text-center"><?php echo renderLang($mistake_management_type); ?></th>
														<th class="text-center"><?php echo renderLang($mistakes_project_code); ?></th>
													</tr>
												</thead>
												<tbody>
													<?php
														$yr_now = date('Y');

														$count = 0;
														$sql = $pdo->prepare("SELECT * FROM mistakes_report WHERE user_id = :user_id AND datecode LIKE '".$yr_now."%' AND temp_del = 0 ORDER BY datecode DESC");
														$sql->bindParam(":user_id",$user_id);
														$sql->execute();
														$data = $sql->fetchAll(PDO::FETCH_ASSOC);

														if($data) {
															foreach($data as $item) {
																$count++;
																$datecode = $item['datecode'];
																echo '<tr><td class="text-left">'.date("M jS, Y (D)", strtotime($datecode)).'</td>';
																foreach($mistake_type_arr as $type) {
																	if($type[0] == $item['mistake_type']) {
																		
																		echo '<td class="text-left"><a href="/mistake-profile/'.encryptID($item['mistake_id'],'mistakes-report').'">'.strtoupper(renderLang($type[1])).'</a></strong></td>';
																		
																	}
																}
																$project_data = getData($item['project_id'],'projects','project');
																echo '<td class="text-center">'.$project_data['project_code'].'</td>';
																echo '</tr>';
															}
														}else{
															echo '<tr><td colspan="3" class="text-center"><strong>'.renderLang($lang_no_data_display).'</strong></td></tr>';
														}

													?>
												</tbody>
											</table>

											
										</div><!-- /.tab-pane -->
										<?php } ?>
										
										<?php if($_SESSION['sys_account_mode'] == 'admin') { ?>
										<div class="tab-pane" id="option_tab">
										
											<p class="user_option_msg1"><?php echo renderLang($user_option_msg_1)?></p>
											<p class="user_option_msg2"><?php echo renderLang($user_option_msg_2)?></p><br>
											<button class="btn btn-success btn-reset float-right"><i class="fa fa-user-lock mr-2"></i><?php echo renderLang($forgot_password_reset_password); ?></button><br><br>
											<button class="btn btn-danger btn-unlock float-right"><i class="fa fa-unlock mr-2"></i><?php echo renderLang($user_unlock_account); ?></button>

										</div>
										<?php } ?>
										
									</div>
									<!-- /.tab-content -->
								</div><!-- /.card-body -->
							</div>
							<!-- /.nav-tabs-custom -->
						</div> <!-- /.col -->
						
					</div><!-- row -->
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>

	<script>

		$(function() {

			var p = '<?php echo isset($_GET['p']) ? '&p='. urlencode($_GET['p']) : ''; ?>';
			var k = '<?php echo isset($_GET['k']) ? '&k='. urlencode($_GET['k']) : ''; ?>'
			var projects_url = '/load-user-projects?id=<?php echo $_GET['id']  ?>'+p+k;

			<?php if($_SESSION['sys_account_mode'] == 'admin') { ?>
			
			
			<?php if($status == 1.5) { ?>
				$('.btn-unlock').prop('disabled', false);
			<?php } else { ?>
				$('.btn-unlock').prop('disabled', true);
			<?php } ?>
			
			$('.btn-unlock').click(function(){

				var unlock = confirm('<?php echo renderLang($user_unlock_confirm) ?>');
				if(unlock){
					showLoading()
					loader.load('/unlock-user/<?php echo $_GET['id'];  ?>');

				}
			});
			
			$('.btn-reset').click(function(){
				
				var reset = confirm('<?php echo renderLang($user_option_confirm) ?>');
				if(reset){
					showLoading()
					loader.load('/reset-user-pass/<?php echo $_GET['id']; ?>/<?php echo $user_employee_id; ?>');

				}
			});
			<?php } ?>
			
			$('#projects_tab').load(projects_url);
			$('.nav-item a').click(function(){
				let target = $(this).attr('href');
				if(target == '#projects_tab') {
					$('#projects_tab').load(projects_url);
				} else if(target == '#statistics_tab') {
					$('#statistics_tab').load('/functions/users/user-statistics.php?id=<?php echo $_GET['id']  ?>');
				}
			});
			
			<?php if(checkPermission('role-edit')) {?>
			// toggle permission
			$('.permissions-table tr').click(function() {
				var permission_code = $(this).data('permission');
				if($(this).hasClass('bg-green')) {
					alert('This is a role permission. This can only be updated in the Role Management.');
				} else {
					if($(this).hasClass('bg-info')) {
						if(confirm('Manage user permission here. Click to toggle permission.<br>Green permissions are from roles. This cannot be updated here. Please go to Roles section.')) {
							loader.load('/update-user-permission/1/'+permission_code+'/<?php echo $_GET['id']; ?>');
						}
					} else {
						if(confirm('This is a role permission. This can only be updated in the Role Management.')) {
							loader.load('/update-user-permission/0/'+permission_code+'/<?php echo $_GET['id']; ?>');
						}
					}
				}
			});
			<?php } ?>
			
		});
	</script>
	
</body>

</html>
<?php
		} else { // ID not found

			// !NEED TRANSLATION
			$_SESSION['sys_users_err'] = renderLang($users_user_not_found);
			header('location: /users');

		}
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /login');
	
}
?>