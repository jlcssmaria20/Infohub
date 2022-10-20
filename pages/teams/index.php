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
							<h1><i class="fa fa-handshake mr-3"></i><?php echo renderLang($team); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_team_err');
					renderSuccess('sys_team_suc');
					?>
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($team_list); ?></h3>
							<div class="card-tools">
								<button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#add_team_modal">
									<i class="fa fa-plus mr-2"></i><?php echo renderLang($team_add); ?>
								</button>
								
							</div>
						</div>
						<div class="card-body">
							
							<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/search-and-pagination.php'); ?>
							
							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table id="table-data" class="table table-striped table-hover">
									<thead>
										<tr>
											<th style="width:50%"><?php echo renderLang($team_name_label); ?></th>
											<th class="text-center"><?php echo renderLang($team_users_label); ?></th>
											<th style="width:10%"></th>
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

											$count =  $pdo->prepare("SELECT * FROM `users` WHERE `team_id` = ".$data['id']);
											$count->execute();
											$total_data_count = $count->rowCount();

											echo '<tr>';

												// TEAM Name
												echo '<td>'.$data['team_name'].'</td>';

												// NUMBER OF USERS
												echo '<td class="text-center">'.$total_data_count.'</td>';

												// OPTIONS
												echo '<td class="text-center">';

													// EDIT team
													if(checkPermission('team-edit')) {
														echo '<a href="/edit-team/'.$team_id.'" class="btn btn-outline-success" title="'.renderLang($team_edit).'"><i class="fas fa-edit"></i> '. renderLang($edit) .'</a>';
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
	<?php if(checkPermission('team-add')) { ?>
		<!-- MODAL -->
		<div class="modal fade" id="add_team_modal" data-backdrop="static" data-keyboard="false" aria-modal="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header bg-primary" style="">
						<h4 class="modal-title"><?= renderLang($team_add_form) ?></h4>
					</div>
					
					<form action="/submit-add-team" method="post" id="add_form">
						<div class="modal-body">								
							<!-- TEAM NAME -->
							<div class="form-group w-100 m-0">
								<?php $err = isset($_SESSION['sys_team_add_name_err']) ? 1 : 0; ?>
								<label for="team_name" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($team_name_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
								<input type="text" minlength="4" maxlength="30" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="team_name" name="team_name" placeholder="<?php echo renderLang($team_name_placeholder); ?>"<?php if(isset($_SESSION['sys_team_add_name_val'])) { echo ' value="'.$_SESSION['sys_team_add_name_val'].'"'; } ?> required>
								<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_team_add_name_err'].'</p>'; unset($_SESSION['sys_team_add_name_err']); } ?>
							</div>
									
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-2"></i><?= renderLang($modal_cancel) ?></button>
							<button type="submit" class="btn btn-confirm btn-primary"><i class="fa fa-check mr-2"></i><?= renderLang($modal_confirm_add) ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php } ?>

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