<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'list';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/includes/unsetSession.php');

$sql = $pdo->prepare("SELECT * FROM pagination_set_active WHERE id = 2");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);

$pagination_active = $data['pagination_active'];

$submodule = 'users';
unset($_SESSION['delete_success']);
// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission($module)) {

		// clear sessions
		include($root.'/modules/'.$module.'/functions/clear.php');

		// get module icon
		include($root.'/includes/support/get-module-icon.php');
		
		// set fields from table to search on
		$fields_arr = array('uname','employeeid','firstname','lastname','email');
		$search_placeholder = 'User Name ,Employee ID, Firstname, Lastname, Email';
		require($root.'/includes/common/set-search.php');
		require($root.'/includes/common/set-pagination.php');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo 'Users' ?> &middot; <?php echo renderLang($sitename); ?></title>
	
	<?php require($root.'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/modules/<?php echo $module; ?>/assets/css/style.css">
	
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
							<h1><i class="fa fa-user mr-2"></i>Users</h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php include($root.'/includes/common/notifications-main.php'); ?>
					
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
							<input type="hidden" name="id" value="2">
							<input type="hidden" name="submodule" value="<?php echo $submodule; ?>">
							<button class="btn btn-success btn-md">Change Pagination </button>
						</form>
							<div class="card-tools">
								<?php if(checkPermission($module.'-add')) { ?><a href="/add-user" class="btn btn-primary btn-md"><i class="fa fa-plus mr-2"></i>Add User</a><?php } ?>
							</div>
						</div>
						<div class="card-body">
							
							<?php require($root.'/includes/common/search-and-pagination.php'); ?>
							
							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table class="table table-data table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Full name</th>
											<th>User name</th>
											<th>Email</th>
											<th>Mobile no#</th>
											<th>Roles</th>
											<th>Status</th>
											<th>Last Login</th>
											<?php if(checkPermission($module.'-edit')) { ?>
											<th style="width:30px;"></th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php
										$data_count = 0;
										$sql = $pdo->prepare("SELECT
											id,
											uname,
											employeeid,
											firstname,
											middlename,
											lastname,
											email,
											mobile,
											photo,
											roleids,
											last_login,
											status
											FROM ".$module." ".$where." LIMIT ".$sql_start.",".$numrows);
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
												if($data['status'] == 2) { // disable row if data is deleted
													echo ' class="row-disabled"';
												}
												echo '>';


													// FULLNAME
													echo '<td>';
														$photo = '/assets/uploadimages/team-images/'.$data['photo'];
														echo '<img src="'.$photo.'" alt="" class="user-photo">';
														echo renderFullname($data);
													echo '</td>';

													// USERNAME
													echo '<td>'.$data['uname'].'</td>';

													// EMAIL
													echo '<td>';
														echo $data['email'] != '' ? $data['email'] : 'ー';
													echo '</td>';

													// MOBILE
													echo '<td>';
														if($data['mobile'] != '') {
															echo $data['mobile'];
														} else {
															echo 'ー';
														}
													echo '</td>';

													// ROLES
													echo '<td>';
														$user_roles_display_arr = array();
														$user_roles_arr = explode(',',$data['roleids']);
														foreach($user_roles_arr as $user_role) {
															if($user_role != '') {
																$_data = getData($user_role,'roles');
																array_push($user_roles_display_arr,$_data['role_name']);
															}
														}
														echo implode(",", $user_roles_display_arr);
													echo '</td>';

													// STATUS
													echo '<td>';
													switch($data['status']) {
														case 0: $Events = 'Active'; break;
														case 1: $Events = 'Deactivated'; break;	
													}
												
													switch($Events) {
														case 'Active': $text_class = 'success'; break;
														case 'Deactivated': $text_class = 'danger'; break;
													}
													echo '<span class="text-'.$text_class.'">'.$Events.'</span>';
													echo '</td>';

													// LAST LOGIN
													echo '<td class="time-lapsed-col">';
														if($data['last_login'] > 0) {
															echo renderTimeLapsed($data['last_login']);
														} else {
															echo 'ー';
														}
													echo '</td>';

													// OPTIONS
													if(checkPermission($module.'-edit')) {
														echo '<td>';

															// EDIT USER
															if(decryptID($id) != 1) { // do not display if account is superadmin
																echo '<a href="/edit-'.$prefix.'/'.$process.'/'.$id.'" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-pencil-alt"></i></a>';
															}

														echo '</td>'; // end options
													}

												echo '</tr>';
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