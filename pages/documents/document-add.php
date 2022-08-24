<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('document-add')) {
		include($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-cookie-current-page.php');

		// set page
		$page = 'documents';
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DX Info Hub | Add document</title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/assets/css/document.css">
	
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
							<h1><i class="fa fa-circle-o mr-3"></i><?php echo renderLang($document_add); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_document_add_err');
					renderSuccess('sys_document_add_suc');
					?>
					
					<form method="post" action="/submit-add-document">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($document_add_form); ?></h3>
							</div>
							<div class="card-body">

								<div class="row">

									<!-- FOLDER NAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_document_add_name_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="name" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_name_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="4" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="name" name="name" placeholder="<?php echo renderLang($document_name_placeholder); ?>"<?php if(isset($_SESSION['sys_document_add_name_val'])) { echo ' value="'.$_SESSION['sys_document_add_name_val'].'"'; } ?> required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_add_name_err'].'</p>'; unset($_SESSION['sys_document_add_name_err']); } ?>
										</div>
									</div>
								</div>
									
								<hr>
								
								<div class="row">

									<!-- NEW FILE NAME -->
									<div class="col">
										<?php
										$firstname_err = 0;
										if(isset($_SESSION['sys_document_add_firstname_err'])) { $firstname_err = 1; }
										?>
										<div class="form-group">
											<label for="firstname" class="mr-1<?php if($firstname_err) { echo ' text-danger'; } ?>"><?php if($firstname_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_file_name_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($firstname_err) { echo ' is-invalid'; } ?>" id="firstname" name="firstname" placeholder="<?php echo renderLang($document_file_name_placeholder); ?>"<?php if(isset($_SESSION['sys_document_add_firstname_val'])) { echo ' value="'.$_SESSION['sys_document_add_firstname_val'].'"'; } ?> required>
											<?php if($firstname_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_add_firstname_err'].'</p>'; unset($_SESSION['sys_document_add_firstname_err']); } ?>
										</div>
									</div>

									<!-- FILE UPLOAD -->
									<div class="col">
										<?php
										$filename_err = 0;
										if(isset($_SESSION['sys_document_add_filename_err'])) { $filename_err = 1; }
										?>
										<div class="form-group">
											<label for="filename" class="mr-1<?php if($filename_err) { echo ' text-danger'; } ?>"><?php if($filename_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_file_upload_label); ?></label> 
                                            
                                            <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
                                            
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                <input type="file" class="custom-file-input required<?php if($filename_err) { echo ' is-invalid'; } ?>" id="filename" name="filename" placeholder="<?php echo renderLang($document_filename_placeholder); ?>"<?php if(isset($_SESSION['sys_document_add_filename_val'])) { echo ' value="'.$_SESSION['sys_document_add_filename_val'].'"'; } ?> required>
                                            </div>
                                            
                                            <?php if($filename_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_add_filename_err'].'</p>'; unset($_SESSION['sys_document_add_filename_err']); } ?>
										</div>
									</div>

									<!-- ADD MORE FILE BUTTON -->
                                    <div class="col">
                                        <div class="mt-3">
                                            <a href="/documents" class="btn btn-success "><i class="fas fa-plus-square mr-2"></i><?php echo renderLang($document_add_more_file); ?></a>
                                        </div>
                                    </div>
								</div><!-- row -->
								
							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/documents" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-plus mr-2"></i><?php echo renderLang($document_add); ?></button>
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