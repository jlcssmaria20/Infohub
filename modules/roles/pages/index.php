<?php
// INCLUDES
$module = 'roles'; $prefix = 'role'; $process = 'list';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission($module)) {
		
		// clear sessions
		include($root.'/modules/'.$module.'/functions/clear.php');
		
		// get module icon
		include($root.'/includes/support/get-module-icon.php');
		
		// set fields from table to search on
		$fields_arr = array($fields[1]);
		$search_placeholder = renderLang(${$module.'_role_name'});
		require($root.'/includes/common/set-search.php');
		require($root.'/includes/common/set-pagination.php');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo renderLang(${$module.'_title'}); ?> &middot; <?php echo renderLang($sitename); ?></title>
	
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
							<h1><i class="<?php echo $page_module_icon; ?> mr-3"></i><?php echo renderLang(${$module.'_title'}); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php include($root.'/includes/common/notifications-main.php'); ?>
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($roles_roles_list); ?></h3>
							<div class="card-tools">
								<?php if(checkPermission($module.'-add')) { ?><a href="/add-<?php echo $prefix; ?>" class="btn btn-primary btn-md"><i class="fa fa-plus mr-2"></i><?php echo renderLang(${$module.'_add_'.$prefix}); ?></a><?php } ?>
							</div>
						</div>
						<div class="card-body">
							
							<?php require($root.'/includes/common/search-and-pagination.php'); ?>
							
							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table class="table table-data table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th><?php echo renderLang(${$module.'_role_name'}); ?></th>
											<th><?php echo renderLang($lang_permissions); ?></th>
											<th class="text-right"><?php echo renderLang($lang_number_of_users); ?></th>
											<th><?php echo renderLang($lang_status); ?></th>
											<th style="width:30px;"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$data_count = 0;
										$sql = $pdo->prepare("SELECT * FROM ".str_replace('-','_',$module).$where." ORDER BY status ASC, role_name ASC LIMIT ".$sql_start.",".$numrows);
										$sql->execute();
										if($sql->rowCount() == 0) {
											echo '<tr><td colspan="20">';
												echo isset($_GET['k']) ? renderLang($lang_no_results_found) : renderLang($lang_no_data_display);
											echo '</td></tr>';
										} else {
											while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

												$data_count++;
												$id = encryptID($data['id']);

												echo '<tr';
												if($data['status'] == 2) { // disable row if data is deleted
													echo ' class="row-disabled"';
												}
												echo '>';

													// ROLE NAME
												echo '<td><a href="/'.$prefix.'/'.$id.'">'.$data['role_name'].'</a></td>';

													// DISPLAY PERMISSIONS
													echo '<td>';

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

													echo '</td>'; // end display permissions

													// NUMBER OF USERS
													echo '<td class="text-right">';

														// get from USERS table
														$sql2 = $pdo->prepare("SELECT id, roleids, temp_del FROM users WHERE roleids LIKE '%,".decryptID($id).",%' AND temp_del=0");
														$sql2->execute();
														$users_ctr = $sql2->rowCount();
														echo number_format($users_ctr,0,'.',',');

													echo '</td>';

													// STATUS
													echo '<td>';
														$status_text = renderLang($status_arr[$data['status']]);
														switch($data['status']) {
															case 0: $text_class = 'success'; break;
															case 1: $text_class = 'warning'; break;
															case 2: $text_class = 'danger'; break;
														}
														echo '<span class="text-'.$text_class.'">'.$status_text.'</span>';
													echo '</td>';

													// OPTIONS
													echo '<td>';

														// EDIT ROLE
														if(checkPermission($module.'-edit')) {
															if(decryptID($id) != 1) {
																echo '<a href="/edit-'.$prefix.'/'.$process.'/'.$id.'" class="btn btn-success btn-xs" title="'.renderLang(${$module.'_edit_'.$prefix}).'"><i class="fa fa-pencil-alt"></i></a>';
															}
														}

													echo '</td>'; // end options

												echo '</tr>';
											}
										}
										?>
									</tbody>
								</table>
							</div><!-- table-responsive -->
							
							<?php require($root.'/includes/common/pagination-bottom.php'); ?>
							
						</div>
					</div><!-- card -->
					
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
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /');
	
}
?>