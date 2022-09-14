<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('teams')) {
	
		// clear sessions from forms
		clearSessions();

		// set page
		$page = 'teams';
		
		// set fields from table to search on
		$fields_arr = array('team_name');
		$search_placeholder = renderLang($team_name_label);
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-search.php');
		
		$sql_query = 'SELECT * FROM teams'.$where; // set sql statement
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-pagination.php');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
	<title><?php echo $dx."Teams"; ?></title>
	
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
							<h1><i class="fa fa-users mr-3"></i><?php echo renderLang($team); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_team_add_err');
					renderSuccess('sys_team_suc');
					?>
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($team_list); ?></h3>
							<div class="card-tools">
								<?php if(checkPermission('team-add')) { ?><a href="add-team" class="btn btn-primary btn-md"><i class="fa fa-plus mr-2"></i><?php echo renderLang($team_add); ?></a><?php } ?>
							</div>
						</div>
						<div class="card-body">
							
							<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/search-and-pagination.php'); ?>
							
							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table id="table-data" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th><?php echo renderLang($team_name_label); ?></th>
											<th><?php echo renderLang($team_users_label); ?></th>
											<th style="width:35px;"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$data_count = 0;
										$sql = $pdo->prepare("SELECT * FROM teams".$where." ORDER BY team_name ASC LIMIT ".$sql_start.",".$numrows);
										$sql->execute();
										while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

											$data_count++;
											$team_id = encryptID($data['id']);

											echo '<tr>';

												// TEAM Name
												echo '<td>'.$data['team_name'].'</td>';

												// NUMBER OF USERS
												echo '<td>0</td>';

												// echo '<td>';

												// // get from USERS table
												// $sql2 = $pdo->prepare("SELECT user_id, team_id, temp_del FROM users WHERE team_id = :team_id AND temp_del=0");
												// $sql2->bindParam(":team_id",$data['team_id']);
												// $sql2->execute();
												// $users_ctr = $sql2->rowCount();

												// echo number_format($users_ctr,0,'.',',');

												// echo '</td>';
												// OPTIONS
												echo '<td>';

													// EDIT team
													if(checkPermission('team-edit')) {
														echo '<a href="/edit-team/'.$team_id.'" class="btn btn-success btn-xs" title="'.renderLang($team_edit).'"><i class="fas fa-pencil-alt"></i></a>';
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