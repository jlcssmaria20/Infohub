<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if IP is valid
if(checkIP()) {

	// check if user has existing session
	if(checkSession()) {

		// check permission to access this page or function
		if(checkPermission('roles')) {

			// clear sessions from forms
			clearSessions();

			// set page
			$page = 'roles';

			// get ID
			$role_id = decryptID($_GET['id']);

			$sql = $pdo->prepare("SELECT * FROM roles WHERE role_id = :role_id LIMIT 1");
			$sql->bindParam(":role_id",$role_id);
			$sql->execute();

			// check if ID exists
			if($sql->rowCount()) {

				$_data = $sql->fetch(PDO::FETCH_ASSOC);

				// get users under role
				$sql2 = $pdo->prepare("SELECT * FROM users WHERE role_ids LIKE '%,".$role_id.",%' ORDER BY user_lastname ASC");
				$sql2->execute();
				$user_count = $sql2->rowCount();
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $_data['role_name'].' &middot; '.renderLang($roles_role); ?> &middot; <?php echo $sitename; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	
	<!-- WRAPPER -->
	<div class="wrapper">
		
		<?php
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/header.php');
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/sidebar.php');
		?>

		<!-- CONTENT -->
		<div class="content-wrapper">
			
			<!-- CONTENT HEADER -->
			<section class="content-header">
				<div class="container-fluid">
					
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><i class="far fa-id-badge mr-3"></i><?php echo renderLang($roles_role); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					if($_data['role_status'] == 2 && $_data['temp_del'] != 0) {
						$_SESSION['sys_roles_err'] = renderLang($roles_role_deleted);
					}
					renderError('sys_roles_err');
					?>
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($roles_role_details); ?></h3>
							<div class="card-tools">
								<?php renderProfileStatus($_data['role_status']); ?>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-bordered">
								<tbody>
									<tr>
										<th><?php echo renderLang($roles_role_name); ?></th>
										<td><?php echo $_data['role_name']; ?></td>
										<th><?php echo renderLang($lang_number_of_users); ?></th>
										<td><?php echo $user_count; ?></td>
									</tr>
									<tr>
										<th><?php echo renderLang($lang_permissions); ?></th>
										<td colspan="3">
											<?php
											// all permission granted
											if($_data['permissions'] == 'all') {

												echo renderLang($all_permissions);

											} else { // selected permissions granted

												// convert to role permissions array
												$role_permissions_arr = explode(',',$_data['permissions']);

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
						</div>
					</div><!-- card -->
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($users_users_list); ?></h3>
						</div>
						<div class="card-body">

							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table id="table-data" class="table table-bordered table-striped table-hover with-options">
									<thead>
										<tr>
											<th><?php echo renderLang($users_employee_id); ?></th>
											<th><?php echo renderLang($users_lastname); ?></th>
											<th><?php echo renderLang($users_firstname); ?></th>
											<th><?php echo renderLang($users_middlename); ?></th>
											<th><?php echo renderLang($lang_status); ?></th>
											<th><?php echo renderLang($users_last_login); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										while($data = $sql2->fetch(PDO::FETCH_ASSOC)) {
											
											$user_id = encryptID($data['user_id'],'users');

											echo '<tr>';

												// USER ID
											echo '<td><a href="/user/'.$user_id.'">'.$data['user_employee_id'].'</td>';

												// LAST NAME
												echo '<td>'.$data['user_lastname'].'</td>';

												// FIRST NAME
												echo '<td>'.$data['user_firstname'].'</td>';

												// MIDDLE NAME
												echo '<td>'.$data['user_middlename'].'</td>';

												// STATUS
												echo '<td>';
													foreach($status_arr as $status) {
														if($status[0] == $data['user_status']) {
															switch($data['user_status']) {
																case 0:
																	echo '<span class="text-success">'.renderLang($status[1]).'</span>';
																	break;
																case 1:
																	echo '<span class="text-warning">'.renderLang($status[1]).'</span>';
																	break;
															}
														}
													}
												echo '</td>';

												// LAST LOGIN
												echo '<td>';
													if($data['user_last_login'] > 0) {
														echo date('Ymd',$data['user_last_login']).' &middot; '.date('H:i:s',$data['user_last_login']);
													} else {
														echo '-';
													}
												echo '</td>';

											echo '</tr>';
										}
										?>
									</tbody>
								</table>
							</div><!-- table-responsive -->

						</div>
					</div><!-- card -->
					
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
			} else { // ID not found

				// !NEED TRANSLATION
				$_SESSION['sys_roles_err'] = renderLang($roles_role_not_found);
				header('location: /roles');

			}
		} else { // permission not found

			$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
			header('location: /dashboard');

		}
	} else { // no session found, redirect to login page

		$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
		header('location: /');

	}
} else { // invalid IP address

	header('location: /');

}
?>