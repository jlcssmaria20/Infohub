<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'profile';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// get ID
	$id = decryptID($_GET['id']);

	// get module icon
	include($root.'/includes/support/get-module-icon.php');

	// clear sessions
	include($root.'/modules/'.$module.'/functions/clear.php');

	$sql = $pdo->prepare("SELECT
		users.id,
		users.uname,
		users.firstname,
		users.middlename,
		users.lastname,
		users.roleids,
		users.employeeid,
		users.team_id,
		users.department_id,
		users.permissions,
		users.photo,
		users.gender,
		users.civil_status,
		users.email,
		users.mobile,
		users.status,
		users.last_login,
		teams.code AS team_code,
		teams.name AS team_name,
		departments.code AS department_code,
		departments.name AS department_name
	FROM ".$module."
	LEFT JOIN teams ON users.team_id = teams.id
	LEFT JOIN departments ON users.department_id = departments.id
	WHERE users.id = :id LIMIT 1");
	$sql->bindParam(":id",$id);
	$sql->execute();

	// check if ID exists
	if($sql->rowCount()) {

		if(isset($_SESSION['sys_users_err'])) {
			unset($_SESSION['sys_users_err']);
		}

		$data = $sql->fetch(PDO::FETCH_ASSOC);
		$user_permissions_db = explode(',',$data['permissions']);

		$fullname = renderName($data);

		$roles_arr = getTable('roles');

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="SHIFT_JIS">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $fullname.' &middot; '.renderLang($users_user); ?> &middot; <?php echo renderLang($sitename); ?></title>

	<?php require($root.'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/modules/<?php echo $module; ?>/assets/css/style.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">

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
							<h1><i class="<?php echo $page_module_icon; ?> mr-3"></i><?php echo $fullname; ?></h1>
						</div>
						<div class="col-sm-6">
							<a href="/<?php echo $module; ?>" class="btn btn-default float-right"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
						</div>
					</div>

				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">

					<div class="row">

						<!-- LEFT COLUMN -->
						<div class="col-md-3">

							<!-- MAIN INFO -->
							<div class="card card-primary card-outline">
								<div class="card-body box-profile">
									<div class="text-center">
										<?php
										if($data['photo'] == '') {
											switch($data['gender']) {
												case 0:
													$photo = '/dist/img/avatar5.png';
													break;
												case 1:
													$photo = '/dist/img/avatar2.png';
													break;
												default:
													$photo = '/assets/images/profile-default.png';
													break;
											}
										} else {
											$photo = '/modules/users/assets/images/profile/'.$data['photo'];
										}
										?>
										<img class="profile-user-img img-fluid img-circle" src="<?php echo $photo; ?>" alt="User profile picture">
									</div>

									<h3 class="profile-username text-center"><?php echo $fullname; ?></h3>
									<p class="text-muted text-center">
										<?php
										$user_roles_display_arr = array();
										$user_roles_arr = explode(',',$data['roleids']);
										foreach($user_roles_arr as $user_role) {
											if($user_role != '') {
												$data_fn = getData($user_role,'roles');
												array_push($user_roles_display_arr,$data_fn['role_name']);
											}
										}
										echo implode($user_roles_display_arr,', ');
										?>
									</p>

									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
											<b><?php echo renderLang($teams_team); ?></b>
											<?php
											echo checkPermission('teams') ? '<a href="/team/'.encryptID($data['team_id'],'teams').'" class="float-right">' : '<a class="float-right">';
												echo $data['team_name'] != '' ? '[ '.$data['team_code'].' ] '.$data['team_name'] : 'ー';
											echo '</a>';
											?>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang($departments_department); ?></b>
											<?php
											echo checkPermission('departments') ? '<a href="/department/'.encryptID($data['department_id'],'departments').'" class="float-right">' : '<a class="float-right">';
												echo $data['department_name'] != '' ? '[ '.$data['department_code'].' ] '.$data['department_name'] : 'ー';
											echo '</a>';
											?>
										</li>
									</ul>

								</div>
							</div><!--.card -->

							<!-- CONTACT INFORMATION -->
							<div class="card card-default">
								<div class="card-header">
									<h3 class="card-title"><i class="fa fa-mobile-alt mr-2"></i><?php echo renderLang(${$module.'_contact'}); ?></h3>
								</div>
								<div class="card-body">
									<ul class="list-group list-group-unbordered">
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_email'}); ?></b>
											<a class="float-right"><?php echo $data['email']; ?></a>
										</li>
										<li class="list-group-item">
											<b><?php echo renderLang(${$module.'_mobile'}); ?></b>
											<a class="float-right">
												<?php echo $data['mobile'] != '' ? $data['mobile'] : 'ー'; ?>
											</a>
										</li>
									</ul>
								</div>
							</div><!-- card -->

						</div>

						<!-- RIGHT COLUMN -->
						<div class="col-md-9">
							
							
							
						</div>
						<!-- /.col -->
					</div>

				</div><!-- container-fluid -->
			</section><!-- content -->

		</div>
		<!-- /.content-wrapper -->

		<?php require($root.'/includes/common/footer.php'); ?>

	</div><!-- wrapper -->

	<?php require($root.'/includes/common/js.php'); ?>
	<script>
		$(function() {

			

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