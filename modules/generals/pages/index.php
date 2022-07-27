<?php
// INCLUDES
$module = 'generals'; $prefix = 'general'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
require($_SERVER['DOCUMENT_ROOT'].'/includes/unsetSession.php');

// check if user has existing session
if(checkSession()) {
	// check permission to access this page or function
	if(checkPermission($module)) {
		// get module icon
		include($root.'/includes/support/get-module-icon.php');
		// set fields from table to search on
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo 'General' ?> &middot; <?php echo renderLang($sitename); ?></title>
	
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
							<h1><i class="fa fa-user mr-2"></i>General</h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">					
			
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Add For New Team</h3>
						</div>
						<section class="content-header">
							<div class="container-fluid">
								<?php 
								if(isset($_SESSION['empty_teams']) == 'empty_teams') {
								?>
								<div class="alert alert-danger"><h5><i class="icon fas fa-check"></i>Empty Team!</div>
								<?php
								}

								if(isset($_SESSION['add_team_success']) == 'add_team_success') {
								?>
									<div id="add-web-event-success" class="alert alert-success"><h5><i class="icon fas fa-check"></i>Successfully Added!</div>
								<?php
								} else {
									if(isset($_SESSION['add_team_exist_success']) == 'add_team_exist_success') {
										unset($_SESSION['cpassword']);
								?>
								<div id="error" class="alert alert-danger"><h5><i class="icon fas fa-times"></i> Account Already Exist!</h5></div>
								<?php
									}
								} if(isset($_SESSION['cpassword']) == 'cpassword') {
									unset($_SESSION['add_team_exist_success']);
									?>
										<div id="add-web-event-success" class="alert alert-warning"><h5><i class="icon fas fa-check"></i>Password Don't Match!</div>
									<?php
									}
								?>
							</div><!-- container-fluid -->
						</section><!-- content-header -->
						<div class="card-body">			
						<div class="row">
							<div class="col-lg-3 col-md-4 col-sm-2">
									<form method="post" action="/<?php echo'add-'.$prefix; ?>">
										<label class="mr-1">Team Name</label> 
										<input type="text" name="team" class="form-control" placeholder="Team Name" >
									</div>
									<div class="col-lg-1 col-md-4 col-sm-2">
										<label class="mr-1">Add button</label> 
										<input type="submit" class="form-control btn btn-primary btn-md" value="Add New Team">
									</div>
									</form>
								<div class="col-lg-1 col-md-4 col-sm-2">
									<label class="mr-1">Edit button</label> 
									<a href="/edit-general" type="submit" class="form-control btn btn-danger btn-md">Edit Team</a>
								</div>
								<div class="col-lg-2 col-md-4 col-sm-2">
									<label class="mr-1">List of teams</label> 
									<select class="form-control required" id="team">
										<?php 
											$sql = $pdo->prepare("SELECT * FROM search_tbl");
											$sql->execute();
											$row = $sql->fetchAll(PDO::FETCH_ASSOC);
											foreach($row as $data1) {
												echo '<option value="'.$data1['team'].'">'.$data1['team'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
							
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