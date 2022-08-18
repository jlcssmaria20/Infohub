<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('announcements-add')) {
		include($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-cookie-current-page.php');

		// set page
		$page = 'announcements';
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DX Info Hub | Add Announcement</title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/assets/css/announcement.css">
	
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
							<h1><i class="fa fa-circle-o mr-3"></i><?php echo renderLang($announcement_add); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_announcements_add_err');
					renderSuccess('sys_announcements_add_suc');
					?>
					
					<form method="post" action="/submit-add-announcements">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($announcements_add_form); ?></h3>
							</div>
							<div class="card-body">

								<div class="row">

									<!-- TITLE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_announcements_add_title_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="title" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_title_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="4" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="title" name="title" placeholder="<?php echo renderLang($announcements_title_placeholder); ?>"<?php if(isset($_SESSION['sys_announcements_add_title_val'])) { echo ' value="'.$_SESSION['sys_announcements_add_title_val'].'"'; } ?> required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_add_title_err'].'</p>'; unset($_SESSION['sys_announcements_add_title_err']); } ?>
										</div>
									</div>
									
								</div>
									
								<hr>
								
								<div class="row">

									<!-- DETAILS -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$details_err = 0;
										if(isset($_SESSION['sys_announcements_add_details_err'])) { $details_err = 1; }
										?>
										<div class="form-group">
											<label for="details" class="mr-1<?php if($details_err) { echo ' text-danger'; } ?>"><?php if($details_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_details_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($details_err) { echo ' is-invalid'; } ?>" id="details" name="details" placeholder="<?php echo renderLang($announcements_details_placeholder); ?>"<?php if(isset($_SESSION['sys_announcements_add_details_val'])) { echo ' value="'.$_SESSION['sys_announcements_add_details_val'].'"'; } ?> required>
											<?php if($details_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_add_details_err'].'</p>'; unset($_SESSION['sys_announcements_add_details_err']); } ?>
										</div>
									</div>

									<!-- IMAGE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$img_err = 0;
										if(isset($_SESSION['sys_announcements_add_img_err'])) { $img_err = 1; }
										?>
										<div class="form-group">
											<label for="img" class="mr-1<?php if($img_err) { echo ' text-danger'; } ?>"><?php if($img_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_img_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($img_err) { echo ' is-invalid'; } ?>" id="img" name="img" placeholder="<?php echo renderLang($announcements_img_placeholder); ?>"<?php if(isset($_SESSION['sys_announcements_add_img_val'])) { echo ' value="'.$_SESSION['sys_announcements_add_img_val'].'"'; } ?> required>
											<?php if($img_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_add_img_err'].'</p>'; unset($_SESSION['sys_announcements_add_img_err']); } ?>
										</div>
									</div>

								</div><!-- row -->
								
							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/announcements" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-plus mr-2"></i><?php echo renderLang($announcements_add); ?></button>
							</div>
						</div><!-- card -->
					</form>
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
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
	header('location: /login');
	
}
?>