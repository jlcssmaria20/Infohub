<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('documents')) {
	
		// clear sessions from forms
		clearSessions();

		// set page
		$page = 'documents';
		
		// set fields from table to search on
		$fields_arr = array('document_name');
		$search_placeholder = renderLang($document_name);
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-search.php');
		
		$sql_query = 'SELECT * FROM documents'.$where; // set sql statement
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-pagination.php');
		
		
		$users_arr = getTable('users');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Documents"; ?></title>
	<link href="/assets/css/documents.css" rel="stylesheet" />
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
							<h1><i class="fas fa-file mr-3"></i><?php echo renderLang($documents); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_document_add_err');
					renderSuccess('sys_document_suc');
					?>
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($document_list); ?></h3>
							<div class="card-tools">
								<button type="button" class="btn btn-primary btn-delete mr-1" data-toggle="modal" data-target="#add_document_modal">
									<i class="fa fa-plus mr-2"></i><?php echo renderLang($document_add_document); ?>
								</button>
							</div>
						</div>
						<div class="card-body">
							
							<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/search-and-pagination.php'); ?>
							
							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table id="table-data" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width: 20%"><?php echo renderLang($document_name_label); ?></th>
											<th style="width: 25%"><?php echo renderLang($document_date_created); ?></th>
											<th style="width: 20%"><?php echo renderLang($document_file_count); ?></th>
											<th style="width: 20%"><?php echo renderLang($created_by); ?></th>
											<th style="width: 5%"></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$data_count = 0;
											$sql = $pdo->prepare("SELECT * FROM documents ".$where." ORDER BY id ASC LIMIT ".$sql_start.",".$numrows);
											$sql->execute();
											while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

											$data_count++;
											$document_id = encryptID($data['id']);
											
												$count =  $pdo->prepare("SELECT * FROM `files` WHERE `document_id` = ".$data['id']);
												$count->execute();
												$total_data_count = $count->rowCount();
											?>
											<tr>
												<!-- FOLDER NAME -->
												<td>
													<h6><?php echo $data['document_name'] ?></h6>
												</td>

												<!-- DATE CREATED -->
												<td><?php echo $data['date_created'] ?></td>

												<!-- NUMBER OF FILES -->
												<td><?php echo $total_data_count ?></td>

												<!-- CREATED BY -->
												<td>
													<?php
													foreach($users_arr as $user) {
														if($user['user_id'] == $data['user_id']) {
															echo $user['user_firstname'].' '.$user['user_lastname'];
															break;
														}
													}
												 	?>
												</td>

												<!-- EDIT DOCUMENT -->
												<td class="text-center">
													<?php
													if(checkPermission('document-edit')) {
														echo '<a href="/edit-document/'.$document_id.'" class="btn btn-success btn-xs" title="'.renderLang($document_edit).'"><i class="fas fa-pencil-alt"></i></a>';
													}
													?>
												</td>

											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div><!-- table-responsive -->
							
							<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/pagination-bottom.php'); ?>
							
						</div>
					</div><!-- card -->
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div>

	<!-- MODALS -->
	<?php if(checkPermission('document-add')) { ?>
		<!-- MODAL -->
		<div class="modal fade" id="add_document_modal" data-backdrop="static" data-keyboard="false" aria-modal="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #FCCD2F">
						<h4 class="modal-title"><?= renderLang($modal_add_confirmation) ?></h4>
					</div>
					<form action="/submit-add-document" method="post" id="add_form">
						<div class="modal-body">
							<!-- FOLDER NAME -->
							
							<div class="form-group w-100 m-0">
								<?php $err = isset($_SESSION['sys_documents_add_name_err']) ? 1 : 0; ?>
								<label for="name" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_name_label); ?></label> 
								<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
								
								<input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="name" name="name" placeholder="<?php echo renderLang($document_name_placeholder); ?>" required>
								<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_add_name_err'].'</p>'; unset($_SESSION['sys_document_add_name_err']); } ?>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-2"></i><?= renderLang($modal_cancel) ?></button>
							<button type="submit"  style="background-color: #FCCD2F"class="btn btn-confirm text-dark"><i class="fa fa-check mr-2"></i><?= renderLang($modal_confirm_add) ?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php } ?>

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
	<script>
		$("#name").keypress(function(e){ if(e.target.value.length==50){ alert("Ooops. Character limit reached."); } });
	</script>
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