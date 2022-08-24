
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
		$fields_arr = array('announcements_details','announcements_img');
		$search_placeholder = renderLang($announcements_title_label);
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-search.php');
		
		$sql_query = 'SELECT * FROM announcements'.$where; // set sql statement
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-pagination.php');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DX Info Hub Announcements</title>
	
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
						<div class="col-sm-6 col-12">
							<h1><i class="fa fa-users mr-3"></i><?php echo renderLang($announcements); ?></h1>
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
								<table id="table-data" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:20%"><?php echo renderLang($announcements_title_label); ?></th>
											<th><?php echo renderLang($announcements_img_label); ?></th>
											<th class="w-50"><?php echo renderLang($announcements_details_label); ?></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$data_count = 0;
										$sql = $pdo->prepare("SELECT * FROM announcements ". $where ." ORDER BY id ASC LIMIT ".$sql_start.",".$numrows);
										$sql->execute();
										while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

											$data_count++;
											$announcements_id = encryptID($data['id']);

											echo '<tr>';

												// TITLE
												echo '<td><h5>'.$data['announcements_title'].'</h5><br><br><em>'.$data['date_created'].'</em></td>';

												// IMAGE
												echo '<td><img src="assets/images/announcements/'.$data['announcements_img'].'" class=" img-thumbnail"></td>';

												// DETAILS
												echo '<td>'.$data['announcements_details'].'</td>';

												// OPTIONS
												echo '<td>';

													// EDIT ANNOUNCEMENTS
													if(checkPermission('announcements-edit')) {
														echo '<a href="/edit-announcements/'.$announcements_id.'" class="btn btn-success btn-xs" title="'.renderLang($announcements_edit).'"><i class="fas fa-pencil-alt"></i></a>';
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
	header('location: /login');
	
}
?>