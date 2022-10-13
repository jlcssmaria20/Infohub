
<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('announcements')) {
	
		// clear sessions from forms
		clearSessions();

		// set page
		$page = 'announcements';
		
		// set fields from table to search on
		$fields_arr = array('announcements_title', 'announcements_details');
		$search_placeholder = renderLang($announcements_title_label).', '. renderLang($announcements_details_label);
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-search.php');
		
		$sql_query = 'SELECT * FROM announcements'.$where; // set sql statement
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-pagination.php');
	

		$users_arr = getTable('users');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Announcements"; ?></title>
	
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
		<div class="content-wrapper" style="height:auto;">
			
			<!-- CONTENT HEADER -->
			<section class="content-header">
				<div class="container-fluid">
					
					<div class="row mb-2">
						<div class="col-sm-6 col-12">
							<h1><i class="fa fa-bullhorn mr-3"></i><?php echo renderLang($announcements); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_announcements_add_err');
					renderSuccess('sys_announcements_suc');
					?>
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($announcements_list); ?></h3>
							<div class="card-tools">
								<?php if(checkPermission('announcements-add')) { ?><a href="add-announcements" class="btn btn-primary btn-md"><i class="fa fa-plus mr-2"></i><?php echo renderLang($announcements_add); ?></a><?php } ?>
							</div>
						</div>
						<div class="card-body">
							
							<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/search-and-pagination.php'); ?>
							
							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table id="table-data" class="table table-striped table-hover">
									<thead>
										<tr class="text-dark">
											<th style="width:20%"><?php echo renderLang($image); ?></th>
											<th style="width:50%"><?php echo renderLang($announcements_title_label).' and '.renderLang($announcements_details_label); ?></th>
											<th class="text-center"style="width:20%"><?php echo renderLang($created_by); ?></th>
											<th style="width:10%"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$data_count = 0;
										$sql = $pdo->prepare("SELECT * FROM announcements ". $where ." ORDER BY id DESC LIMIT ".$sql_start.",".$numrows);
										$sql->execute();
										while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

											$data_count++;
											$announcements_id = encryptID($data['id']);

											echo '<tr>';

												// IMAGE
												echo '<td class="align-middle"><img src="assets/images/announcements/'.$data['announcements_img'].'" class=" img-thumbnail p-0"></td>';

												// TITLE
												echo '<td class="align-middle"><h4 class=" font-weight-bold">'.$data['announcements_title'].'</h4><pre  style="max-width: 400px;"  class="p-0 text-truncate"><b>'.renderLang($announcements_details_label).':</b> '.$data['announcements_details'].'</pre></td>';

												// CREATED BY
												echo '<td class="align-middle text-center">';
													foreach($users_arr as $user) {
														if($user['user_id'] == $data['user_id']) {
															echo $user['user_firstname'].' '.$user['user_lastname'];
															break;
														}
													}
												echo '<br><em class="text-secondary font-weight-bold text-sm">'.$data['date_created'] .'</em></td>';
															
												// OPTIONS
												echo '<td class="align-middle text-center">';

													// EDIT ANNOUNCEMENTS
													if(checkPermission('announcements-edit')) {
														echo '<a href="/edit-announcements/'.$announcements_id.'" class="btn btn-outline-success btn-s" title="'.renderLang($announcements_edit).'"><i class="fas fa-edit"></i> '.renderLang($edit).'</a>';
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
		
	</div>
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
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
	header('location: /login');
	
}
?>