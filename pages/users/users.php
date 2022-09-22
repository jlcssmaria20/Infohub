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
		if($_SESSION['sys_account_mode'] == 'admin') { 
		
		// set fields from table to search on
			$fields_arr = array('user_email','user_firstname','user_lastname');
			$search_placeholder = renderLang($users_email).', '.renderLang($users_firstname).', '.renderLang($users_lastname);
			require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-search.php');

			$sql_query = 'SELECT * FROM users'.$where ; // set sql statement
			require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-pagination.php');
		}
		

		$teams_arr = getTable('teams');
			
		
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
	<title><?php echo $dx."Users"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
							<h1><i class="fa fa-users mr-3"></i><?php echo renderLang($users_users); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_users_err');
					renderSuccess('sys_users_suc');
					?>
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($users_users_list); ?></h3>
							<div class="card-tools col-md-6">
								<div class="text-right">
				
									<?php if(checkPermission('user-add')) { ?>
									<div class="text-right">
										<a href="/add-user" class="btn btn-primary btn-md"><i class="fa fa-plus mr-2"></i><?php echo renderLang($users_add_user); ?></a>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="card-body">
								<!-- DATA TABLE -->
								<div class="table-responsive">
									<table id="table-data" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th><?php echo renderLang($users_employee_id); ?></th>
												<th><?php echo renderLang($users_lastname); ?></th>
												<th><?php echo renderLang($users_firstname); ?></th>
												<th><?php echo renderLang($users_email); ?></th>
												<th><?php echo renderLang($users_designation); ?></th>
												<th><?php echo renderLang($roles_roles); ?></th>
												<th><?php echo renderLang($lang_status); ?></th>
												<th><?php echo renderLang($users_last_login); ?></th>
												<th style="width:40px;"></th>
											</tr>
										</thead>
										<tbody>
											<?php
											$data_count = 0;
											$sql = $pdo->prepare("SELECT * FROM users".$where." ORDER BY user_status ASC, user_lastname ASC");
											$sql->execute();
											while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

												$data_count++;
												$user_id = encryptID($data['user_id'], 'users');

												echo '<tr>';

													// EMPLOYEE ID
													echo '<td>'.$data['user_employee_id'].'</td>';

													// LASTNAME
													echo '<td>'.$data['user_lastname'].'</td>';

													// FIRSTNAME
													echo '<td>'.$data['user_firstname'].'</td>';

													// USER NAME
													echo '<td>'.$data['user_email'].'</a></td>';

													// DESIGNATION
													echo '<td>';
														foreach($teams_arr as $team) {
															if($team['id'] == $data['team_id']) {
																echo ' - '.$team['team_name'];
																break;
															}
														}
													echo '</td>';

													// ROLES
													echo '<td>';
														$user_roles_display_arr = array();
														$user_roles_arr = explode(',',$data['role_ids']);
														foreach($user_roles_arr as $user_role) {
															if($user_role != '') {
																$_data = getData($user_role,'roles','role');
																array_push($user_roles_display_arr,$_data['role_name']);
															}
														}
														echo implode($user_roles_display_arr,', ');
													echo '</td>';

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
																	case 1.5:
																		echo '<span class="text-danger">'.renderLang($status[1]).'</span>';
																		break;
																	case 2:
																		echo '<span class="text-danger">'.renderLang($status[1]).'</span>';
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

													// OPTIONS
													echo '<td class="data-options">';

														// EDIT USER
													// echo '<a href="#" class="btn btn-primary btn-xs" title="'.renderLang($users_view_user).'" style="padding: 1.5px 7px;" target="_blank"><i class="fas fa-info" aria-hidden="true"></i></a>';

													if(checkPermission('user-edit')) {
														echo '<a href="/edit-user/'.$user_id.'" class="btn btn-success btn-xs" title="'.renderLang($users_edit_user).'" ><i class="fas fa-pencil-alt"></i></a>';
													}

													echo '</td>'; // end options

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
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	
</body>
	<script type="text/javascript">

		$(function(){
			/*showLoading();*/
			
			<?php if($_SESSION['sys_account_mode'] != 'admin') { ?>
			
				//showLoading();
				$(".users-list").load('/functions/users/user-load.php');
			
			<?php } ?>
			
			$("#table-data").DataTable({
		  		"order" : [[1,"asc"]],
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				"columnDefs": [
					{ "orderable": false, "targets": 8 }	
				],
				"dom": "<'row'<'col-sm-1'l><'col-sm-3'f><'col-sm-8'p>><'row'<'col-sm-12'tr>><'row'<'col-sm-3'i><'col-sm-9'p>>",
			});
		});
	</script>
</html>
<?php
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /login');
	
}
?>