<?php
// INCLUDES
$module = 'documentsquicklinks'; $prefix = 'documentsquicklink'; $process = 'list';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/includes/unsetSession.php');

$submodule = 'documents-quick-link';
//unset($_SESSION['add-other-exam']);
// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission($module)) {

		// clear sessions
		include($root.'/modules/'.$module.'/functions/clear.php');

		// get module icon
		include($root.'/includes/support/get-module-icon.php');
		
		//set fields from table to search on
		$fields_arr = array('docu_name');
		$search_placeholder = 'Document Name';
		require($root.'/includes/common/set-search.php');
		require($root.'/includes/common/set-pagination.php');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo 'Documents & Quick Link' ?> &middot; <?php echo renderLang($sitename); ?></title>
	
	<?php require($root.'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/modules/<?php echo $module; ?>/assets/css/style.css">
	<style>

	</style>
	
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
					<?php 
					if($_SESSION['delete_success'] == 'delete_success') {
						echo '<div class="alert alert-success"><h5><i class="icon fas fa-check"></i> Successfully Deleted!</h5></div>';
					}
					?>
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><i class="nav-icon far fa-image mr-3"></i><?php echo 'Documents & Quick Link'; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<div class="card">
					<div class="card-header">
							<h3 class="card-title">Add Documents & Quick Link</h3>
							<div class="card-tools">
								<a href="add-documents-and-quick-link" class="btn btn-primary btn-md">
									<i class="fa fa-plus mr-2"></i>
									Add More
								</a>
							</div>
						</div>
						<div class="card-body" >
							
							<?php require($root.'/includes/common/search-and-pagination.php'); ?>
							
							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table class="table table-data table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th><?php echo 'Document & Quick links' ?></th>
											<th><?php echo 'Status' ?></th>
											<th style="width: 25px;"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$data_count = 0;
										$sql = $pdo->prepare("SELECT * FROM ".str_replace('-','_',$module).$where." ORDER BY status ASC LIMIT ".$sql_start.",".$numrows);
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
												if($data['id'] != '1') {
												if($data['status'] == 2) { // disable row if data is deleted
													echo ' class="row-disabled"';
												}
												echo '>';
													// title
													echo '<td><a href="#">'.$data['docu_name'].'</a></td>';

													// STATUS
													echo '<td>';

													switch($data['status']) {
														case 0: $Events = 'Active'; break;
														case 1: $Events = 'Deleted'; break;	
													}
												
													switch($Events) {
														case 'Active': $text_class = 'success'; break;
														case 'Deleted': $text_class = 'danger'; break;
													}

													echo '<span class="text-'.$text_class.'">'.$Events.'</span>';
													echo '</td>';


													// OPTIONS
													if(checkPermission($module.'-edit')) {
														echo '<td>';
															// EDIT EVENTS
															if(decryptID($id) != 0) { // do not display if account is superadmin
																echo '<a href="/edit-'.$prefix.'/'.$process.'/'.$id.'" class="btn btn-success btn-xs"><i class="fa fa-pencil-alt"></i></a>';
															}
														echo '</td>'; // end options
													}
												echo '</tr>';
												}
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
	<script>
		$(document).ready(function(){
		

			$('.generateCode').click(function () {
				// find bb and ocitange relative to the onlyUpdate
				var onlyUpdate = $(this).closest('.onlyUpdate');
				// var bb = onlyUpdate.find('.bb').val(), codegeneratedID = onlyUpdate.find('.codegeneratedID').val();
				var id = $('.id', onlyUpdate).val();
				// alert('id: ' + id);
				if (id == '') {
					alert('empty');
				} else {
					$.ajax({
						type: 'POST',
						url: '/codeGenerate',
						data: { id: id }, // cleaner
						cache: false,
						success: function (success) {
							location.reload();

							request = $.ajax({
								url: "/timout",
								type: "post",
								data: serializedData
							});

						}
					});

				}

			});

		});
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
	header('location: /');
	
}

?>