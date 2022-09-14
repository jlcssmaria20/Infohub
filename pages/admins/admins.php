<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('admins')) {
		include($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-cookie-current-page.php');
		
		// clear sessions from forms
		clearSessions();

		// set page
		$page = 'admins';
		
		// set fields from table to search on
		$fields_arr = array('admin_firstname','admin_lastname');
		$search_placeholder = renderLang($admins_firstname).', '.renderLang($admins_lastname);
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-search.php');
		
		$sql_query = 'SELECT * FROM admins'.$where; // set sql statement
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-pagination.php');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Admins"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	
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
							<h1><i class="fa fa-admins mr-3"></i><?php echo renderLang($admins_admins); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_admins_err');
					renderSuccess('sys_admins_suc');
					?>
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($admins_admins_list); ?></h3>
							<div class="card-tools">
								<?php if(checkPermission('admin-add')) { ?><a href="/add-admin" class="btn btn-primary btn-md"><i class="fa fa-plus mr-2"></i><?php echo renderLang($admins_add_admin); ?></a><?php } ?>
							</div>
						</div>
						<div class="card-body">
							
							<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/search-and-pagination.php'); ?>
							
							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table id="table-data" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th><?php echo renderLang($admins_username); ?></th>
											<th><?php echo renderLang($admins_lastname); ?></th>
											<th><?php echo renderLang($admins_firstname); ?></th>
											<th><?php echo renderLang($lang_status); ?></th>
											<th><?php echo renderLang($admins_last_login); ?></th>
											<th style="width:35px;"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$data_count = 0;
										$sql = $pdo->prepare("SELECT * FROM admins".$where." AND admin_id != 1 ORDER BY admin_lastname ASC LIMIT ".$sql_start.",".$numrows);
										$sql->execute();
										while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

											$data_count++;
											$admin_id = encryptID($data['admin_id']);

											echo '<tr>';

												// USERNAME
												echo '<td>'.$data['admin_username'].'</td>';

												// LASTNAME
												echo '<td>'.$data['admin_lastname'].'</td>';

												// FIRSTNAME
												echo '<td>'.$data['admin_firstname'].'</td>';

												// STATUS
												echo '<td>';
													foreach($status_arr as $status) {
														if($status[0] == $data['admin_status']) {
															switch($data['admin_status']) {
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
													if($data['admin_last_login'] > 0) {
														echo date('Ymd',$data['admin_last_login']).' &middot; '.date('H:i:s',$data['admin_last_login']);
													} else {
														echo '-';
													}
												echo '</td>';

												// OPTIONS
												echo '<td>';

													// EDIT admin
													if(checkPermission('admin-edit')) {
														echo '<a href="/edit-admin/'.$admin_id.'" class="btn btn-success btn-xs" title="'.renderLang($admins_edit_admin).'"><i class="fas fa-pencil-alt"></i></a>';
													}

												echo '</td>'; // end options

											echo '</tr>';
										}
										?>
									</tbody>
								</table>
							</div><!-- table-responsive -->
							
							<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/pagination-bottom.php'); ?>
							
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
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /');
	
}
?>