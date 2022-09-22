<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('general')) {
	// clear sessions from forms
		clearSessions();

		// set page
		$page = 'general';

		$account_id = $_SESSION['sys_id'];

		$sql = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id LIMIT 1");
		$sql->bindParam(":user_id",$account_id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {

		$data = $sql->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."General (Account)"; ?></title>
	
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
		<div class="content-wrapper" >
			
			<!-- CONTENT HEADER -->
			<section class="content-header">
				<div class="container-fluid">
					
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><i class="nav-icon fas fa-th" aria-hidden="true"></i><?php echo renderLang($account_details); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_account_add_err');
					renderSuccess('sys_account_suc');
					?>

					<div class="card">
						<div class="card-header">
							
							<div class="card-tools">
								<a href="/edit-general/<?php echo $account_id ?>" class="btn btn-primary btn-md"><i class="fa fa-pencil-alt mr-2"></i><?php echo renderLang($account_edit); ?></a><?php } ?>
							</div>
						</div>
						 <!-- YOUR ACCOUNT -->
						 <div class="card-body">
							<div class="row">
								<div class="col-lg-3 text-center ">
									<div class="m-3">
										<img class="profile-user-img img-fluid img-circle"
										src="<?php echo $_SESSION['sys_photo'] ?>"
										alt="User profile picture">
									</div>
									<h3 class="profile-username"><?php echo $_SESSION['sys_fullname']; ?></h3>
									<p class="text-muted"><?php echo $data['user_email'] ?></p>
									<input type="hidden" value="<?php echo $account_id; ?>">
								</div>
								<div class="col-lg-9">
									<!-- ACCOUNT DETAILS -->
									<div class="card-header pl-0">
										<h3 class="card-title"><?php echo renderLang($account_details); ?></h3>
									</div>
									<br>
									<div class="row">
										<!-- EMPLOYEE ID -->
										<div class="col-lg-3">
											<div class="form-group">
												<label for="emp id" class="mr-1">	<?php echo renderLang($account_employee_id_label); ?> </label>
												<p><?php echo $data['user_employee_id'] ?></p>
											</div>
										</div>	
									
										<!-- SKILLS -->
										<div class="col-lg-4">
											<div class="form-group">
												<label for="skills" class="mr-1">	<?php echo renderLang($account_skills_label);  ?> </label>
												<p><?php echo $data['user_skills'] ?></p>
											</div>
										</div>
										<!-- MANTRA -->
										<div class="col-lg-4">
											<div class="form-group">
												<label for="mantra" class="mr-1">	<?php echo renderLang($account_mantra_label); ?> </label>
												<p><?php echo $data['user_mantra_in_life'] ?></p>
											</div>
										</div>
									</div>
									<br>
									<!-- PERSONAL DETAILS -->
									<div class="card-header pl-0">
										<h3 class="card-title"><?php echo renderLang($account_personal_information); ?></h3>
									</div>
									<br>
									
									<div class="row">
										<!-- FIRSTNAME-->
										<div class="col-lg-4">
											<div class="form-group">
												<label for="firstname" class="mr-1">	<?php echo renderLang($account_firstname_label);  ?> </label>
												<p><?php echo $data['user_firstname'] ?></p>
											</div>
										</div>
										<!-- MIDDLE NAME -->
										<div class="col-lg-4">
											<div class="form-group">
												<label for="" class="mr-1">	<?php echo renderLang($account_middlename_label); ?> </label>
												<p><?php echo $data['user_middlename'] ?></p>
											</div>
										</div>
										<!-- LAST NAME -->
										<div class="col-lg-4">
											<div class="form-group">
												<label for="" class="mr-1">	<?php echo renderLang($account_lastname_label); ?> </label>
												<p><?php echo $data['user_lastname'] ?></p>
											</div>
										</div>
									</div>
									<div class="row">
										<!-- NICKNAME-->
										<div class="col-lg-4">
											<div class="form-group">
												<label for="nickname" class="mr-1">	<?php echo renderLang($account_nickname);  ?> </label>
												<p><?php echo $data['user_nickname'] ?></p>
											</div>
										</div>
										<!-- GENDER-->
										
										<div class="col-lg-4">
											<div class="form-group">
												<label for="gender" class="mr-1">	<?php echo renderLang($account_gender);  ?> </label>
												<?php 
													foreach($gender_arr as $gender) {
														if($data['user_gender'] == $gender[0]) {
															echo '<p>'.renderLang($gender[1]).'</p>';
														}
													}
												
												?>
											</div>
										</div>
										<!-- HIREDATE -->
										<div class="col-lg-4">
											<div class="form-group">
												<label for="hiredate" class="mr-1">	<?php echo renderLang($account_hiredate);  ?> </label>
												<?php $date = date_create($data['user_hiredate']);?>
												<p><?php echo  date_format($date, 'F j, Y'); ?></p>
											</div>
										</div>
									</div>
									<br>
									<!-- CONTACT DETAILS -->
									<div class="card-header pl-0">
										<h3 class="card-title"><?php echo renderLang($account_contact_information); ?></h3>
									</div>
									<br>
									<div class="row">
										<!-- EMAIL-->
										<div class="col-lg-4">
											<div class="form-group">
												<label for="firstname" class="mr-1"><?php echo renderLang($account_email_label);  ?> </label>
												<p><?php echo $data['user_email'] ?></p>
											</div>
										</div>
										<!-- CONTACT NUMBER -->
										<div class="col-lg-4">
											<div class="form-group">
												<label for="" class="mr-1">	<?php echo renderLang($account_mobile_label); ?> </label>
												<p><?php echo $data['user_mobile'] ?></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

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