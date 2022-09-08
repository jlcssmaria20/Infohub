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
		
		// get ID
		$admin_id = decryptID($_GET['id']);

		$sql = $pdo->prepare("SELECT * FROM admins WHERE admin_id = :admin_id LIMIT 1");
		$sql->bindParam(":admin_id",$admin_id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {
			
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			switch($_SESSION['sys_language']) {
				case 0:
					$fullname = $data['admin_firstname'].' '.$data['admin_lastname'];
					break;
				case 1:
					$fullname = $data['admin_lastname'].' '.$data['admin_firstname'];
					break;
			}
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $fullname.' &middot; '.renderLang($admins_admin); ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/assets/css/admins.css">
	
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
							<h1>
								<i class="fa fa-admin-secret mr-3"></i><?php echo renderLang($admins_admin); ?>
								&raquo;
								<?php echo $fullname; ?>
							</h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					if($data['admin_status'] == 2 && $data['temp_del'] != 0) {
						$_SESSION['sys_admins_err'] = renderLang($admins_messages_admin_deleted);
					}
					renderError('sys_admins_err');
					?>
					
					<div class="row">
						<div class="col-md-3">

							<!-- Profile Image -->
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<img class="profile-user-img img-fluid img-circle" src="<?php echo $_SESSION['sys_photo']; ?>" alt="admin profile picture">
									</div>
									<h3 class="profile-adminname text-center"><?php echo $fullname; ?></h3>
									<p class="text-muted text-center"><?php echo renderLang($admins_admin); ?></p>
								</div><!-- /.card-body -->
							</div>
							<!-- /.card -->

						</div><!-- /.col -->
						
						<div class="col-12">
							<div class="card">
								<div class="card-header p-2">
									<h3 class="cart-title"><?php echo renderLang($system_log_title); ?></h3>
								</div><!-- /.card-header -->
								<div class="card-body">
									<div class="tab-content">
										
										<div class="table-responsive">
											<table id="table-data" class="table table-bordered table-striped table-hover">
												<thead>
													<tr>
														<th style="width:130px;"><?php echo renderLang($system_log_time_stamp); ?></th>
														<th style="width:150px;"><?php echo renderLang($system_log_user); ?></th>
														<th style="width:100px;"><?php echo renderLang($system_log_module); ?></th>
														<th style="width:100px;"><?php echo renderLang($system_log_action); ?></th>
														<th style="width:200px;"><?php echo renderLang($system_log_target); ?></th>
														<th><?php echo renderLang($system_log_change_log); ?></th>
													</tr>
												</thead>
												<tbody>
													<?php
													$sql = $pdo->prepare("SELECT * FROM system_log WHERE account_id = ".$admin_id." ORDER BY id DESC LIMIT 1000");
													$sql->execute();

													while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

														echo '<tr>';

														// TIMESTAMP
														echo '<td>'.date('Ymd',$data['epoch_time']).' &middot; '.date('H:i:s',$data['epoch_time']).'</td>';

														// USER ID
														echo '<td>';

														switch($data['account_mode']) {
															case 0:
																$prefix = 'admin';
																$_data = getData($data['account_id'],'admins',$prefix);
																break;
															case 1:
																$prefix = 'user';
																$_data = getData($data['account_id'],'users',$prefix);
																echo '<a href="/'.$prefix.'/'.$_data[$prefix.'_id'].'">';
																break;
														}
														switch($_SESSION['sys_language']) {
															case 0:
																echo $_data[$prefix.'_firstname'].' '.$_data[$prefix.'_lastname'];
																break;
															case 1:
																echo $_data[$prefix.'_lastname'].' '.$_data[$prefix.'_firstname'];
																break;
														}
														switch($data['account_mode']) {
															case 1:
																echo '</a>';
																break;
														}

														echo '</td>';

														// MODULE
														echo '<td>'.renderLang(${"module_".$data['module']}).'</td>';

														// ACTION
														echo '<td>'.renderLang(${"system_log_".$data['action']}).'</td>';

														// TARGET ID
														echo '<td>';
														include('../../includes/common/system-log-target-id.php');
														echo '</td>';

														// CHANGE LOG
														echo '<td>';

														// if ACTION is UPDATE
														if($data['action'] == 'update') {
															include('../../includes/common/system-log-change-log.php');
														} else {
															echo '-';
														}

														echo '</td>';

														echo '</tr>';
													}

													?>
												</tbody>
											</table>
										</div><!-- table-responsive -->
										
									</div>
									<!-- /.tab-content -->
								</div><!-- /.card-body -->
							</div>
							<!-- /.nav-tabs-custom -->
						</div> <!-- /.col -->
						
					</div><!-- row -->
					
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
	<script type="text/javascript">

		$(function(){

			$("#table-data").DataTable({
				"order" : [[0,"desc"]],
				"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
				"columnDefs": [
					{ "orderable": false, "targets": 5 }
				],
				"dom": "<'row'<'col-sm-1'l><'col-sm-3'f><'col-sm-8'p>><'row'<'col-sm-12'tr>><'row'<'col-sm-4'i><'col-sm-8'p>>"
			});

		});
	</script>
	
</body>

</html>
<?php
		} else { // ID not found

			// !NEED TRANSLATION
			$_SESSION['sys_admins_err'] = renderLang($admins_admin_not_found);
			header('location: /admins');

		}
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /');
	
}
?>