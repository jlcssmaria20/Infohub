<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'view';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// get ID
	$id = decryptID($_GET['id']);
	
	// check permission to access this page or function
	if(checkPermission($module) || checkPermission('users-view') || $_SESSION['sys_data']['id'] == $id) {

		// get module icon
		include($root.'/includes/support/get-module-icon.php');
	
		// clear sessions
		include($root.'/modules/'.$module.'/functions/clear.php');

		$sql = $pdo->prepare("SELECT
			users.id,
			users.uname,
			users.firstname,
			users.middlename,
			users.lastname,
			users.roleids,
			users.employeeid,
			users.application_id,
			users.referral_id,
			users.date_start,
			users.date_end,
			users.permissions,
			users.photo,
			users.gender,
			users.civil_status,
			users.email,
			users.mobile,
			users.status,
			users.last_login,
			teams.code AS team_code,
			teams.name AS team_name,
			departments.code AS department_code,
			departments.name AS department_name
		FROM ".$module."
		LEFT JOIN teams ON users.referral_id = teams.id
		LEFT JOIN departments ON users.application_id = departments.id
		WHERE users.id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
		$sql->execute();
		
		// check if ID exists
		if($sql->rowCount()) {
			
			if(isset($_SESSION['sys_users_err'])) {
				unset($_SESSION['sys_users_err']);
			}
			
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$user_permissions_db = explode(',',$data['permissions']);
			
			$fullname = renderFullname($data);
			
			// set fields from table to search on
			$fields_arr = array('module','action');
			$search_placeholder = '';
			$other_filter = 'user_id = '.$id;
			$redirect_link_override = 'user/'.encryptID($id);
			require($root.'/includes/common/set-search.php');
			$sql_table_override = 'system_log';
			require($root.'/includes/common/set-pagination.php');

			$roles_arr = getTable('roles');
			
			// get current tab
			$current_tab = 'activity';
			if(isset($_GET['tab'])) {
				$current_tab = $_GET['tab'];
			}
			
			// set role array session
			$user_permissions = array();

			// all permission toggle
			$all_permission = 0;

			// create where clause for multiple roles
			$roleids_arr = explode(',',$data['roleids']);
			$roleids_arr = implode(',',array_filter($roleids_arr));

			// get permissions based on roleids
			$sql = $pdo->prepare("SELECT id, permissions FROM roles WHERE id IN (".$roleids_arr.")");
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
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="SHIFT_JIS">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $fullname.' &middot; '.renderLang($users_user); ?> &middot; <?php echo renderLang($sitename); ?></title>
	
	<?php require($root.'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/modules/<?php echo $module; ?>/assets/css/style.css">
	
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
							<h1><i class="<?php echo $page_module_icon; ?> mr-3"></i><?php echo renderLang(${$module.'_user'}); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php echo '['.$data['employeeid'].'] '.$fullname; ?></h1>
						</div>
						<div class="col-sm-6">
							<a href="/<?php echo $module; ?>" class="btn btn-default float-right"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">

					<?php
					if($data['status'] == 2 && $data['temp_del'] != 0) {
						$_SESSION['sys_'.$module.'_err'] = renderLang(${$module.'_messages_'.$prefix.'_deleted'});
					} elseif($data['status'] == 1) {
						$_SESSION['sys_'.$module.'_war'] = renderLang(${$module.'_messages_'.$prefix.'_deactivated'});
					}
					renderError('sys_'.$module.'_err');
					renderWarning('sys_'.$module.'_war');
					renderSuccess('sys_'.$module.'_suc');
					?>
					
					<div class="row">
						
						<!-- LEFT COLUMN -->
						<div class="col-md-3">

							<!-- MAIN INFO -->
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<?php
										if($data['photo'] == '') {
											switch($data['gender']) {
												case 0:
													$photo = '/dist/img/avatar5.png';
													break;
												case 1:
													$photo = '/dist/img/avatar2.png';
													break;
												default:
													$photo = '/assets/images/profile-default.png';
													break;
											}
										} else {
											$photo = '/modules/users/assets/images/profile/'.$data['photo'];
										}
										?>
										<img class="profile-user-img img-fluid img-circle" src="<?php echo $photo; ?>" alt="User profile picture">
									</div>

									<h3 class="profile-username text-center"><?php echo $fullname; ?></h3>
									<p class="text-muted text-center">
										<?php
										$user_roles_display_arr = array();
										$user_roles_arr = explode(',',$data['roleids']);
										foreach($user_roles_arr as $user_role) {
											if($user_role != '') {
												$data_fn = getData($user_role,'roles');
												array_push($user_roles_display_arr,$data_fn['role_name']);
											}
										}
										echo implode($user_roles_display_arr,', ');
										?>
									</p>

									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
											<b><?php echo renderLang($lang_status); ?></b>
											<a class="float-right"><?php echo renderLang($status_arr[$data['status']]); ?></a>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_uname'}); ?></b>
											<a class="float-right"><?php echo $data['uname']; ?></a>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_last_login'}); ?></b>
											<a class="float-right">
												<?php
												if($data['last_login'] > 0) {
													echo renderTimeLapsed($data['last_login']);
												} else {
													echo 'ー';
												}
												?>
											</a>
										</li>
									</ul>

									<?php
									if(checkPermission($module.'-edit') && $id != 1) {
										echo '<a href="/edit-'.$prefix.'/'.$process.'/'.encryptID($id).'" class="btn btn-success btn-block mt-3"><i class="fa fa-pencil-alt mr-2"></i>'.renderLang(${$module.'_edit_'.$prefix}).'</a>';
									}
									?>
									
								</div>
							</div><!--.card -->

							<!-- EMPLOYMENT DETAILS -->
							<div class="card card-default">
								<div class="card-header">
									<h3 class="card-title"><i class="fa fa-briefcase mr-2"></i><?php echo renderLang(${$module.'_employee'}); ?></h3>
								</div>
								<div class="card-body">
									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_employeeid'}); ?></b>
											<a class="float-right"><?php echo $data['employeeid']; ?></a>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang($applications_application); ?></b>
											<?php
											echo checkPermission('departments') ? '<a href="/application/'.encryptID($data['application_id'],'departments').'" class="float-right">' : '<a class="float-right">';
											echo $data['department_name'] != '' ? '[ '.$data['department_code'].' ] '.$data['department_name'] : 'ー';
											echo '</a>';
											?>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang($referrals_referral); ?></b>
											<?php
											echo checkPermission('teams') ? '<a href="/team/'.encryptID($data['referral_id'],'teams').'" class="float-right">' : '<a class="float-right">';
											echo $data['team_name'] != '' ? '[ '.$data['team_code'].' ] '.$data['team_name'] : 'ー';
											echo '</a>';
											?>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_date_start'}); ?></b>
											<a class="float-right">
												<?php echo $data['date_start'] != 0 ? date('F j, Y',strtotime($data['date_start'])) : 'ー'; ?>
											</a>
										</li>
										<?php if($data['date_end'] != 0) { ?>
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_date_start'}); ?></b>
											<a class="float-right">
												<?php echo $data['date_start'] != 0 ? date('F j, Y',strtotime($data['date_start'])) : 'ー'; ?>
											</a>
										</li>
										<?php } ?>
									</ul>
								</div>
							</div><!-- card -->

							<!-- CONTACT INFORMATION -->
							<div class="card card-default">
								<div class="card-header">
									<h3 class="card-title"><i class="fa fa-mobile-alt mr-2"></i><?php echo renderLang(${$module.'_contact'}); ?></h3>
								</div>
								<div class="card-body">
									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_email'}); ?></b>
											<a class="float-right"><?php echo $data['email']; ?></a>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_mobile'}); ?></b>
											<a class="float-right">
												<?php echo $data['mobile'] != '' ? $data['mobile'] : 'ー'; ?>
											</a>
										</li>
									</ul>
								</div>
							</div><!-- card -->
							
							<!-- PERSONAL DETAILS -->
							<div class="card card-default">
								<div class="card-header">
									<h3 class="card-title"><i class="fa fa-user mr-2"></i><?php echo renderLang(${$module.'_personal'}); ?></h3>
								</div>
								<div class="card-body">
									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_gender'}); ?></b>
											<a class="float-right"><?php echo renderLang($gender_arr[$data['gender']]); ?></a>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_civil_status'}); ?></b>
											<a class="float-right"><?php echo renderLang($civil_status_arr[$data['civil_status']]); ?></a>
										</li>
									</ul>
								</div>
							</div><!-- card -->
							
						</div>
						
						<!-- RIGHT COLUMN -->
						<div class="col-md-9">
							<div class="card">
								
								<div class="card-header p-2">
									<ul class="nav nav-pills">
										<li class="nav-item"><a class="nav-link<?php if($current_tab == 'activity') { echo ' active'; } ?>" href="#activity" data-toggle="tab"><i class="fa fa-align-left mr-2"></i><?php echo renderLang(${$module.'_activity'}); ?></a></li>
										<?php if(checkPermission($module.'-edit') && $id != 1) { ?>
										<li class="nav-item"><a class="nav-link<?php if($current_tab == 'permissions') { echo ' active'; } ?>" href="#permissions" data-toggle="tab"><i class="fa fa-user-lock mr-2"></i><?php echo renderLang($lang_permissions); ?></a></li>
										<li class="nav-item"><a class="nav-link<?php if($current_tab == 'user-options') { echo ' active'; } ?>" href="#user-options" data-toggle="tab"><i class="fa fa-user-cog mr-2"></i><?php echo renderLang(${$module.'_user_options'}); ?></a></li>
										<?php } ?>
									</ul>
								</div>
								
								<div class="card-body">
									
									<div class="tab-content">
										
										<!-- ACTIVITY -->
										<div class="tab-pane<?php if($current_tab == 'activity') { echo ' active'; } ?>" id="activity">
											
											<h4><i class="fa fa-align-left mr-3"></i><?php echo renderLang(${$module.'_activity'}); ?></h4>
											
											<?php require($root.'/includes/common/pagination-top.php'); ?>

											<div class="table-responsive">
												<table class="table table-data table-bordered table-striped table-hover system-log-table">
													<thead>
														<tr>
															<th><?php echo renderLang($system_log_module); ?></th>
															<th><?php echo renderLang($system_log_action); ?></th>
															<th><?php echo renderLang($system_log_target); ?></th>
															<th><?php echo renderLang($system_log_change_log); ?></th>
															<th><?php echo renderLang($system_log_time_stamp); ?></th>
														</tr>
													</thead>
													<tbody>
														<?php
														$data_count = 0;
														$sql = $pdo->prepare("SELECT * FROM system_log".$where." ORDER BY id DESC LIMIT ".$sql_start.",".$numrows);
														$sql->execute();

														if($sql->rowCount() == 0) {
															echo '<tr><td colspan="6">'.renderLang($lang_no_data_display).'</td></tr>';
														} else {

															while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

																$data_count++;

																echo '<tr>';

																	// MODULE
																	echo '<td>'.renderLang(${$data['module'].'_title'}).'</td>';

																	// ACTION
																	echo '<td>'.renderLang(${"system_log_".$data['action']}).'</td>';

																	// TARGET ID
																	echo '<td>';

																		// get target id for each module
																		foreach($modules_path as $folder) {
																			if(strpos($folder,'.') > -1 || strpos($folder,'_') > -1 ) {} else {
																				if(!in_array($folder,$exceptions_folder_arr)) {
																					include($root.'/modules/'.$folder.'/support/log-target.php');
																				}
																			}
																		}

																	echo '</td>';

																	// CHANGE LOG
																	echo '<td>';

																	// if ACTION is UPDATE
																	if($data['action'] == 'edit') {

																		$change_log_arr = explode(';;',$data['change_log']);
																		foreach($change_log_arr as $change_log) {

																			$item_arr = explode('::',$change_log);
																			$changes_arr = explode('==',$item_arr[1]);
																			$field_name = $item_arr[0];
																			$from_val = $changes_arr[0];
																			$to_val = $changes_arr[1];

																			// get log change for each module
																			foreach($modules_path as $folder) {
																				if(strpos($folder,'.') > -1 || strpos($folder,'_') > -1 ) {} else {
																					if(!in_array($folder,$exceptions_folder_arr)) {
																						include($root.'/modules/'.$folder.'/support/log-change.php');
																					}
																				}
																			}

																			// default logs
																			include($root.'/includes/common/log-default.php');

																		}

																	} else {
																		echo 'ー';
																	}

																	echo '</td>';

																	// TIMESTAMP
																	echo '<td>'.date('Ymd',$data['epoch_time']).' &middot; '.date('H:i:s',$data['epoch_time']).'</td>';

																echo '</tr>';
															}

														}
														?>
													</tbody>
												</table>
											</div><!-- table-responsive -->

											<?php require($root.'/includes/common/pagination-bottom.php'); ?>
											
										</div><!--.tab-pane -->

										<?php if(checkPermission($module.'-edit') && $id != 1) { ?>
										<!-- PERMISSIONS -->
										<div class="tab-pane<?php if($current_tab == 'permissions') { echo ' active'; } ?>" id="permissions">

											<h4><i class="fa fa-user-lock mr-2"></i><?php echo renderLang($lang_permissions); ?></h4>
											
											<p><?php echo renderLang(${$module_name.'_permissions_msg1'}); ?></p>

											<table class="table permissions-table">
												<tbody>
												<?php
												foreach($permissions_arr as $permissions) {
													foreach($permissions as $permission) {
														
														$role_type = '<i class="far fa-id-badge" title="'.renderLang(${$module.'_permission_from_role'}).'"></i>';
														
														if(in_array($permission['permission_code'],$user_permissions)) {
															$bgcolor = 'bg-green';
															$icon = '<i class="far fa-circle"></i>';
														} else {
															if(in_array($permission['permission_code'],$user_permissions_db)) {
																$bgcolor = 'bg-info';
																$icon = '<i class="far fa-circle"></i>';
																$role_type = '<i class="far fa-user" title="'.renderLang(${$module.'_permission_for_user'}).'"></i>';
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

										</div>
										
										<!-- USER OPTIONS -->
										<div class="tab-pane<?php if($current_tab == 'user-options') { echo ' active'; } ?>" id="user-options">

											<h4><i class="fa fa-user-cog mr-2"></i><?php echo renderLang(${$module.'_user_options'}); ?></h4>
											
											<table class="table">
												<tbody>
													<tr>
														<td>
															<p><?php echo renderLang(${$module.'_user_options_msg1'}); ?></p>
														</td>
														<td class="text-right">
															<a href="#" class="btn btn-success btn-reset-password"><i class="fa fa-user-lock mr-2"></i><?php echo renderLang(${$module.'_reset_password'}); ?></a>
														</td>
													</tr>
													<tr>
														<td>
															<p>
																<?php
																if($data['status'] != 2) {
																	echo renderLang(${$module.'_user_options_msg2'});
																} else {
																	echo renderLang(${$module.'_user_options_msg3'});
																}
																?>
															</p>
														</td>
														<td class="text-right">
															<?php
															if($data['status'] != 2) {
																echo '<select class="form-control btn-user-status">';
																foreach($status_arr as $i => $status) {
																	if($i != 2) {
																		echo '<option value="'.$i.'"';
																		if($data['status'] == $i) {
																			echo ' selected';
																		}
																		echo '>';
																			echo renderLang($status);
																		echo '</option>';
																	}
																}
																echo '</select>';
															} else {
																echo '<strong class="text-red">'.renderLang($status_arr[2]).'</strong>';
															}
															?>
														</td>
													</tr>
												</tbody>
											</table>
										
										</div>
										<?php } ?>
										
									</div><!-- /.tab-content -->
									
								</div><!-- /.card-body -->
								
							</div><!-- /.nav-tabs-custom -->
						</div>
						<!-- /.col -->
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($root.'/includes/common/footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($root.'/includes/common/js.php'); ?>
	<script>
		$(function() {
			
			<?php if(checkPermission($module.'-edit') && $id != 1) { ?>
			// toggle permission
			$('.permissions-table tr').click(function() {
				var permission_code = $(this).data('permission');
				if($(this).hasClass('bg-green')) {
					alert('<?php echo renderLang(${$module.'_permissions_msg2'}); ?>');
				} else {
					if($(this).hasClass('bg-info')) {
						if(confirm('<?php echo renderLang(${$module.'_permissions_confirm1'}); ?>')) {
							loader.load('/update-user-permission/1/'+permission_code+'/<?php echo encryptID($id,'users'); ?>');
						}
					} else {
						if(confirm('<?php echo renderLang(${$module.'_permissions_confirm2'}); ?>')) {
							loader.load('/update-user-permission/0/'+permission_code+'/<?php echo encryptID($id,'users'); ?>');
						}
					}
				}
			});
			
			// reset password confirmation
			$('.btn-reset-password').click(function() {
				if(confirm('<?php echo renderLang(${$module.'_reset_password_confirmation'}); ?>')) {
					window.location.href = '/user-reset-password/<?php echo encryptID($id); ?>';
				}
			});
			
			// user status change
			$('.btn-user-status').change(function() {
				var user_status = $(this).val();
				if(confirm('<?php echo renderLang(${$module.'_update_status_confirmation'}); ?>')) {
					window.location.href = '/user-update-status/<?php echo encryptID($id); ?>/'+user_status;
				} else {
					if(user_status == 0) {
						user_status = 1;
					} else {
						user_status = 0;
					}
				}
				$(this).val(user_status);
			});
			<?php } ?>
			
		});
	</script>
	
</body>

</html>
<?php
		} else { // ID not found
			
			$_SESSION['sys_users_err'] = renderLang($users_user_not_found);
			header('location: /users');

		}
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /');
	
}
?>