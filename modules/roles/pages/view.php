<?php
// INCLUDES
$module = 'roles'; $prefix = 'role'; $process = 'view';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission($module)) {

		// get module icon
		include($root.'/includes/support/get-module-icon.php');

		// clear sessions
		include($root.'/modules/'.$module.'/functions/clear.php');
		
		// get ID
		$id = decryptID($_GET['id']);

		$sql = $pdo->prepare("SELECT * FROM ".$module." WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {
			
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			// get users under role
			$sql2 = $pdo->prepare("SELECT
					users.id,
					users.uname,
					users.employeeid,
					users.firstname,
					users.lastname,
					users.department_id,
					users.team_id,
					users.roleids,
					users.photo,
					users.gender,
					users.last_login,
					users.status,
					teams.code AS team_code,
					teams.name AS team_name,
					departments.code AS department_code,
					departments.name AS department_name
				FROM users
				LEFT JOIN teams ON users.team_id = teams.id
				LEFT JOIN departments ON users.department_id = departments.id
				WHERE users.roleids LIKE '%,".$id.",%' AND users.temp_del = 0
				ORDER BY users.status ASC, users.lastname ASC");
			$sql2->execute();
			$user_count = $sql2->rowCount();
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $data['role_name'].' &middot; '.renderLang(${$module.'_'.$prefix}); ?> &middot; <?php echo renderLang($sitename); ?></title>
	
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
							<h1><i class="far fa-id-badge mr-3"></i><?php echo renderLang(${$module.'_'.$prefix}); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php echo $data['role_name']; ?></h1>
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
						<div class="col-sm-6 col-md-3">
							
							<!-- MODULE DETAILS -->
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><i class="fas fa-info-circle mr-2"></i><?php echo renderLang(${$module.'_'.$prefix.'_details'}); ?></h3>
									<div class="card-tools">
										<?php renderProfileStatus($data['status']); ?>
									</div>
								</div>
								<div class="card-body">
									<table class="table table-data table-bordered">
										<tbody>
											<tr>
												<th><?php echo renderLang(${$module.'_role_name'}); ?></th>
												<td><?php echo $data['role_name']; ?></td>
											</tr>
											<tr>
												<th colspan="2"><?php echo renderLang($lang_permissions); ?></th>
											</tr>
											<tr>
												<td colspan="2">
													<?php
													// all permission granted
													if($data['permissions'] == 'all') {

														echo renderLang($all_permissions);

													} else { // selected permissions granted

														// convert to role permissions array
														$role_permissions_arr = explode(',',$data['permissions']);

														// loop permissions group list
														foreach($permissions_arr as $permission_group) {

															// reset counter to determin first permission for permission group
															$ctr = 0;

															// set DIV for division of permission group
															echo '<div class="permissions-group">';

															// loop permissions inside permission group
															foreach($permission_group as $permission) {

																// loop for role permission
																foreach($role_permissions_arr as $role_permission) {

																	// compare role code for each role permission to get role name
																	if($permission['permission_code'] == $role_permission) {

																		// check counter to print division of permission using dot
																		if($ctr > 0) {
																			echo ' &middot; ';
																		}

																		// display role name
																		echo '<span title="'.renderLang($permission['permission_description']).'">'.renderLang($permission['permission_name']).'</span>';

																		// increase counter
																		$ctr++;

																		break; // stop loop
																	}

																} // end loop for role permissions

															} // end loop for permissions inside group

															// close group permission div
															echo '</div>';

														} // end loop for group list

													} // end else
													?>
												</td>
											</tr>
										</tbody>
									</table>
									<?php if(checkPermission($module.'-edit')) { ?>
									<a href="/edit-<?php echo $prefix; ?>/view/<?php echo encryptID($id); ?>" class="btn btn-success btn-block mt-4"><i class="fa fa-pencil-alt mr-2"></i><?php echo renderLang(${$module.'_edit_'.$prefix}); ?></a>
									<?php } ?>
								</div>
							</div>
							
							<!-- USERS STATISTICS -->
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><i class="fas fa-chart-bar mr-2"></i><?php echo renderLang($users_users_statistics); ?></h3>
								</div>
								<div class="card-body">
									<table class="table table-data table-bordered table-striped">
										<tbody>
											<tr>
												<th><?php echo renderLang($lang_number_of_users); ?></th>
												<td class="total-users text-right"><?php echo renderLang($lang_computing); ?></td>
											</tr>
											<tr>
												<th><?php echo renderLang($lang_active_users); ?></th>
												<td class="active-users text-right"><?php echo renderLang($lang_computing); ?></td>
											</tr>
											<tr>
												<th><?php echo renderLang($lang_deactivated_users); ?></th>
												<td class="deactivated-users text-right"><?php echo renderLang($lang_computing); ?></td>
											</tr>
											<tr>
												<th><?php echo renderLang($lang_deleted_users); ?></th>
												<td class="deleted-users text-right"><?php echo renderLang($lang_computing); ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							
						</div><!-- col -->
						
						<div class="col-sm-6 col-md-9">

							<!-- USERS LIST -->
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><i class="fa fa-users mr-2"></i><?php echo renderLang($users_users_list); ?></h3>
									<div class="card-tools">
										<input type="text" class="form-control data-filter" placeholder="<?php echo renderLang($lang_filter); ?>">
									</div>
								</div>
								<div class="card-body">

									<!-- DATA TABLE -->
									<div class="table-responsive">
										<table class="users-list-table table table-data table-bordered table-striped table-hover with-options">
											<thead>
												<tr>
													<th></th>
													<th><?php echo renderLang($users_employeeid); ?></th>
													<th><?php echo renderLang($users_fullname); ?></th>
													<th><?php echo renderLang($users_uname); ?></th>
													<th><?php echo renderLang($users_team_id); ?></th>
													<th><?php echo renderLang($roles_roles); ?></th>
													<th><?php echo renderLang($lang_status); ?></th>
													<th><?php echo renderLang($users_last_login); ?></th>
													<?php if(checkPermission('users-edit')) { ?>
													<th style="width:30px;"></th>
													<?php } ?>
												</tr>
											</thead>
											<tbody>
												<?php
												$active_users = 0;
												$deactivated_users = 0;
												$deleted_users = 0;
												if($sql2->rowCount() > 0) {
													$ctr = 1;
													while($_data = $sql2->fetch(PDO::FETCH_ASSOC)) {

														$id = encryptID($_data['id'],'users');

														switch($_data['status']) {
															case 0: $active_users++; break;
															case 1: $deactivated_users++; break;
															case 2: $deleted_users++; break;
														}

														echo '<tr';
														if($_data['status'] == 2) { // disable row if data is deleted
															echo ' class="row-disabled"';
														}
														echo '>';

														// COUNTER
														echo '<td>'.$ctr.'</td>';
														$ctr++;

														// EMPLOYEE ID
														echo '<td>';
															if(checkPermission('users')) {
																echo '<a href="/user/'.$id.'">';
															}
															echo $_data['employeeid'];
															if(checkPermission('users')) {
																echo '</a>';
															}
														echo '</td>';

														// FULLNAME
														echo '<td>';
															if($_data['photo'] == '') {
																switch($_data['gender']) {
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
																$photo = '/modules/users/assets/images/profile/'.$_data['photo'];
															}
															echo '<img src="'.$photo.'" alt="" class="user-photo">';
															echo renderName($_data);
														echo '</td>';

														// USERNAME
														echo '<td>'.$_data['uname'].'</td>';

														// TEAM
														echo '<td>';
															if($_data['team_name'] != '') {
																echo checkPermission('teams') ? '<a href="/team/'.encryptID($_data['team_id'],'teams').'">' : '';
																echo '['.$_data['department_code'].'] ['.$_data['team_code'].'] '.$_data['team_name'];
																echo checkPermission('teams') ? '</a>' : '';
															} else {
																echo 'ー';
															}
														echo '</td>';

														// ROLES
														echo '<td>';
															$user_roles_display_arr = array();
															$user_roles_arr = explode(',',$_data['roleids']);
															foreach($user_roles_arr as $user_role) {
																if($user_role != '') {
																	$data_fn = getData($user_role,'roles');
																	array_push($user_roles_display_arr,$data_fn['role_name']);
																}
															}
															echo implode($user_roles_display_arr,', ');
														echo '</td>';

														// STATUS
														echo '<td>';
															$status_text = renderLang($status_arr[$_data['status']]);
															switch($_data['status']) {
																case 0: $text_class = 'success'; break;
																case 1: $text_class = 'warning'; break;
																case 2: $text_class = 'danger'; break;
															}
															echo '<span class="text-'.$text_class.'">'.$status_text.'</span>';
														echo '</td>';

														// LAST LOGIN
														echo '<td>';
															if($_data['last_login'] > 0) {
																echo date('Ymd',$_data['last_login']).' &middot; '.date('H:i:s',$_data['last_login']);
															} else {
																echo '-';
															}
														echo '</td>';

														// OPTIONS
														if(checkPermission($module.'-edit')) {
															echo '<td>';

															// EDIT USER
															if(decryptID($id,'users') != 1) { // do not display if account is superadmin
																echo '<a href="/edit-user/'.$process.'/'.$id.'" class="btn btn-success btn-xs" title="'.renderLang(${$module.'_edit_'.$prefix}).'"><i class="fa fa-pencil-alt"></i></a>';
															}

															echo '</td>'; // end options
														}

														echo '</tr>';
													}
												} else {
													echo '<tr><td colspan="20">'.renderLang($lang_no_data).'</td></tr>';
												}
												?>
											</tbody>
										</table>
									</div><!-- table-responsive -->

								</div>
							</div>

						</div><!-- col -->
						
					</div><!-- row -->
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($root.'/includes/common/footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($root.'/includes/common/js.php'); ?>
	<script>
		$(function() {

			$('.active-users').html('<?php echo number_format($active_users,0,'.',','); ?>');
			$('.deactivated-users').html('<?php echo number_format($deactivated_users,0,'.',','); ?>');
			$('.deleted-users').html('<?php echo number_format($deleted_users,0,'.',','); ?>');
			$('.total-users').html('<?php echo number_format($active_users+$deactivated_users+$deleted_users,0,'.',','); ?>');

			filterTable('.data-filter','.users-list-table tbody tr');

		});
	</script>
	
</body>

</html>
<?php
		} else { // ID not found

			// !NEED TRANSLATION
			$_SESSION['sys_users_err'] = renderLang($roles_role_not_found);
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