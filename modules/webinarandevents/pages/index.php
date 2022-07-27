<?php
// INCLUDES
$module = 'webinarandevents'; $prefix = 'webinarandevent'; $process = 'list';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/includes/unsetSession.php');

$sql = $pdo->prepare("SELECT * FROM pagination_set_active WHERE id = 1");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);

$pagination_active = $data['pagination_active'];

$submodule = 'webinar-and-events';
unset($_SESSION['setDate']);
unset($_SESSION['setMonth']);
unset($_SESSION['docume_delete_name']);
// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission($module)) {

		// clear sessions
		include($root.'/modules/'.$module.'/functions/clear.php');

		// get module icon
		include($root.'/includes/support/get-module-icon.php');
		
		//set fields from table to search on
		$fields_arr = array('title','date_now');
		$search_placeholder = 'Title, Date Now';
		require($root.'/includes/common/set-search.php');
		require($root.'/includes/common/set-pagination.php');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo 'Webinar and Events' ?> &middot; <?php echo renderLang($sitename); ?></title>
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
					
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><i class="nav-icon far fa-image mr-3"></i><?php echo 'Webinar and Events'; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<?php 
						if(isset($_SESSION['update_webinar_events']) == 'update_webinar_events') {
							echo '<div class="alert alert-success"><h5><i class="icon fas fa-check"></i> Successfully Updated!</h5></div>';
						} else {
							if(isset($_SESSION['update_webinar_events']) == '') {}
						}
						if(isset($_SESSION['delete_success']) == 'delete_success') {
							unset($_SESSION['update_webinar_events']);
							echo '<div class="alert alert-success"><h5><i class="icon fas fa-check"></i> Successfully Deleted!</h5></div>';
						?>
						<?php } ?>
					<div class="card">
					<div class="card-header">
						<form action="/set-pagination" method="post" style="float:left;">
							<select name="pagination_active" style="float:left;width:55px;margin:0 10px 0 0;" class="form-control required">
								<?php 
									echo '<option style="background:#218838;color:#fff;"  value="'.$pagination_active.'">'.$pagination_active.'</option>';
									$sql = $pdo->prepare("SELECT * FROM pagination_set");
									$sql->execute();
									$row = $sql->fetchAll(PDO::FETCH_ASSOC);
									foreach($row as $data) {
										echo '<option value="'.$data['webinarandevents'].'">'.$data['webinarandevents'].'</option>';
									}
								?>
							</select>
							<input type="hidden" name="id" value="1">
							<input type="hidden" name="submodule" value="<?php echo $submodule; ?>">
							<button class="btn btn-success btn-md">Change Pagination </button>
						</form>
						<div class="card-tools">
							<a href="add-webinar-and-events" class="btn btn-primary btn-md"><i class="fa fa-plus mr-2"></i>Add More </a>
						</div>
					</div>
						<div class="card-body" >
							
							<?php require($root.'/includes/common/search-and-pagination.php'); ?>
							
							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table class="table table-data table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th><?php echo 'Webinar & Event Title' ?></th>
											<th><?php echo 'Webinar & Event EventImage' ?></th>
											<th><?php echo 'Webinar & Event Set Date' ?></th>
											<th><?php echo 'Webinar & Event Date Created' ?></th>
											<th><?php echo 'Status' ?></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$data_count = 0;
										$sql = $pdo->prepare("SELECT * FROM ".str_replace('-','_',$module).$where." ORDER BY id DESC LIMIT ".$sql_start.",".$numrows);
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
													echo '<td><a href="#">'.$data['title'].'</a></td>';

													// Image
													echo '<td style="width:250px;">
													<img src="/assets/uploadimages/'.$data['images'].'" style="width:100%;height:200px;" alt="'.$data['images'].'">
													</td>';

													//echo '<td><textarea>'.$data['description'].'</textarea></td>';

													// DATE SET
													echo '<td> <a href="#">';?>
													<?php
														echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';

													echo '</a></td>';
												   
													// TIME CREATED
													echo '<td><a href="#">'.$data['date_now'].'</a></td>';

												
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