<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('webinar-events-add')) {
		include($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-cookie-current-page.php');

		// set page
		$page = 'webinarandevents';
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
	<title><?php echo $dx."Add Webinar and Events"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
	
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
							<h1><i class="fa fa-calendar mr-3"></i><?php echo renderLang($webinar_events_add); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_webinar_events_err');
					renderSuccess('sys_webinar_events_suc');
					?>
					
					<form method="post" action="/submit-add-webinar-and-events" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($webinar_events_add_form); ?></h3>
							</div>
							<div class="card-body">

								<div class="row">
									<!-- WEBINAR HOST -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_webinar_events_add_host_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="host" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_host); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<select class="form-control select2 required<?php if($err) { echo ' is-invalid'; } ?>" name="host" required>
												<?php
													$sql = $pdo->prepare("SELECT *
														FROM users WHERE user_status = 0 AND temp_del = 0 AND role_ids LIKE '%,3,%'");
													$sql->execute();
													echo '<option value="" hidden>'.renderLang($webinar_events_select_host).'</option>';
													while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
														echo '<option value="'.$data['user_employee_id'].'"';
														echo '>['.$data['user_employee_id'].'] '.$data['user_firstname'].' '.$data['user_lastname'].'</option>';
													}
												?>
											</select>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_add_host_err'].'</p>'; unset($_SESSION['sys_webinar_events_add_host_err']); } ?>
										</div>
									</div><!-- /col-->

									<!-- WEBINAR TITLE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_webinar_events_add_title_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="title" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_title); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="title" name="title" placeholder="<?php echo renderLang($webinar_events_title_placeholder); ?>"<?php if(isset($_SESSION['sys_webinar_events_add_title_val'])) { echo ' value="'.$_SESSION['sys_webinar_events_add_title_val'].'"'; } ?> required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_add_title_err'].'</p>'; unset($_SESSION['sys_webinar_events_add_title_err']); } ?>
										</div>
									</div>
									
									<!-- WEBINAR SCHEDULE DATE-->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_webinar_events_add_schedule_date_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="project_name" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_schedule_date); ?></label> <span class="right badge badge-success"><?php echo renderLang($label_required); ?></span>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
												</div>
												<input type="text" class="form-control" name="schedule_date" data-inputmask-alias="datetime" data-inputmask-inputformat="mmddyyyy" data-mask="" im-insert="false" value="<?= date('m') . '/' . date('d') . '/' . date('Y')?>">
											</div>
										</div>
										<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_add_schedule_date_err'].'</p>'; unset($_SESSION['sys_webinar_events_add_schedule_date_err']); } ?>
									</div><!-- /col-->

								</div><!-- /row-->

								<hr>
								
								<div class="row">

									<!-- WEBINAR DESCRIPTION-->
									<div class="col-lg-6 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_webinar_events_add_description_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="description" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_description); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<textarea class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" rows="3" name="description" placeholder="<?php echo renderLang($webinar_events_description_placeholder); ?>"></textarea>
										</div>
										<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_add_description_err'].'</p>'; unset($_SESSION['sys_webinar_events_add_description_err']); } ?>
									</div>

									<!-- WEBINAR IMAGES-->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_webinar_events_add_img_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="img" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_img_label); ?></label> 
											<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<div class="custom-file">
												<input type="file" class="custom-file-input required<?php if($err) { echo ' is-invalid'; } ?>" id="picture" name="picture" accept="image/*" required>
												<label for="imgs" class="custom-file-label"><?php echo renderLang($webinar_events_img_placeholder); ?></label>
												<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_add_img_err'].'</p>'; unset($_SESSION['sys_webinar_events_add_img_err']); } ?>
											</div>
										</div>
									</div><!-- /col-->
									
									<!-- WEBINAR PREVIEW-->
									<div class="col-lg-3">
										<img id="picture_display" class="img-thumbnail  mt-3 w-100" src="#" style="display: none; height:200px;">
									</div><!-- /col-->

								</div><!-- /row-->
								
							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/webinarandevents" class="btn btn-default text-dark mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-plus mr-2"></i><?php echo renderLang($webinar_events_add); ?></button>
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
	<script src="/plugins/moment/moment.min.js"></script>
	<script src="/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bs-custom-file-input -->
	<script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
	<script>
		//$('[data-mask]').inputmask();
		
		//$('#summernote').summernote()
		bsCustomFileInput.init();

		$('input[name="schedule_date"]').daterangepicker({
			singleDatePicker: true
		});

		function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#picture_display').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

		$("#picture").change(function(){
			$('#picture_display').show();
		  readURL(this);
		});
		
		$("#title").keypress(function(e){ if(e.target.value.length==50){ alert("Ooops. Character limit reached."); } });
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