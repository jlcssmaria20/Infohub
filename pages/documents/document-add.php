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
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Add Document"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>

	<!-- for remove button -->
	<style>
		.hidden {
			display: none;
		}
	</style>
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
					
					<form method="post" action="/submit-add-document" id="file_form">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($document_add_form); ?></h3>
							</div>
							<div class="card-body">

								<div class="row">

									<!-- FOLDER NAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_documents_add_name_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="name" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_name_label); ?></label> 
											
											<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											
											<input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="name" name="name" placeholder="<?php echo renderLang($document_name_placeholder); ?>" required>
											
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_add_name_err'].'</p>'; unset($_SESSION['sys_document_add_name_err']); } ?>
										</div>
									</div>
								</div>
									
								<hr>
								<div class="" id="file_div">

									<div class="row">

										<!-- NEW FILE NAME -->
										<div class="col-lg-3">
											<?php
											$filename_err = 0;
											if(isset($_SESSION['sys_document_add_filename_err'])) { $filename_err = 1; }
											?>
											<div class="form-group">
												<label for="filename" class="mr-1<?php if($filename_err) { echo ' text-danger'; } ?>"><?php if($filename_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_filename_label); ?></label> 
												
												<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
												
												<input type="text" class="form-control required<?php if($filename_err) { echo ' is-invalid'; } ?>" id="filename" name="filename[]"  minlength="4" maxlength="50"  placeholder="<?php echo renderLang($document_filename_placeholder); ?>" required>
												
												<?php if($filename_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_add_filename_err'].'</p>'; unset($_SESSION['sys_document_add_filename_err']); } ?>
											</div>
												
										</div>
										
										<!-- FILE UPLOAD -->
										<div class="col-lg-3">
											<?php $err = isset($_SESSION['sys_announcements_add_docs_err']) ? 1 : 0; ?>
											<div class="form-group">
												<label for="docs" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_file_upload_label); ?></label> 
												<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
												<div class="custom-file">
													<input type="file" class="custom-file-input required<?php if($err) { echo ' is-invalid'; } ?>" id="docs" name="file[]" required>
													<label for="docss" class="custom-file-label"><?php echo renderLang($document_file_upload_placeholder); ?></label>
													<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_add_file_err'].'</p>'; unset($_SESSION['sys_announcements_add_file_err']); } ?>
												</div>
											</div>
										</div>
										<!-- ADD MORE FILE BUTTON -->
										<div class="col-lg-3">
											<div class="mt-3">
												<button type="button" class="btn btn-success addmore" name="add" id="add" ><i class="fas fa-plus-square mr-2"></i><?php echo renderLang($document_add_more_file); ?></button>
											</div>
										</div>
									</div>
									<div id="dynamic_field"></div>
									<button type="button" class="btn btn-danger btn_remove hidden">Remove last</button>
								</div>
							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/documents" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button type="submit" class="btn btn-primary"><i class="fa fa-plus mr-2"></i><?php echo renderLang($document_add); ?></button>
							</div>
						</div><!-- card -->
					</form>
				</div>
			</section>
		</div>

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>

    <script>
		//change label of input file
		$('#docs').on('change',function(){
			//get the file name
			var docs = $(this).val();
			//replace the "Choose a file" label
			$(this).next('.custom-file-label').html(docs);
		});

		//add more forms on click
		/* $(document).ready(function() {
			var i = 1;
			$('#add').click(function() {
				if (i <= 7) {
				$('#dynamic_field').append('<div class="row" id="row'+ i +'"><div class="col-lg-3" id="col_'+ i +'"><div class="form-group" id="form_'+ i +'"><label for="filename_'+ i +'">File Name: '+ i +'</label><input type="text" class="form-control required" id="filename_'+ i +'" name="filename[]" placeholder="File Name" required></div></div><div class="col-lg-3" id="col'+ i +'"><div class="form-group" id="form_'+ i +'"> <label for="docs_'+ i +'" class="mr-1"></label><div class="custom-file" id="custom_'+ i +'"><input type="file" class="custom-file-input required" id="docs_'+ i +'" name="file[]" required><label for="docss_'+ i +'" class="custom-file-label">Choose File '+ i +'</label></div></div>')
				i++;
				$('.btn_remove').removeClass('hidden');
				}
			});
			$(document).on('click', '.btn_remove', function() {
				var button_id = $(this).attr("id");
				i--;
				$('#row' + $('#dynamic_field div').length).remove();
				if (i<=1) {
				$('.btn_remove').addClass('hidden');
				}
			});
		}); */

		$(document).ready(function() {
			var i = 1;
			$('#add').click(function() {
				if (i <= 7) {
				$('#dynamic_field').append('<div class="row" id="row' + i + '"><label" for="filename' + i + '">File Name:</label><input type="text" id="docs' + i + '" name="filename" value="" placeholder="<?php echo renderLang($document_filename_placeholder); ?> ' + i + '"> </div>')
				/*  */
				i++;

				$('.btn_remove').removeClass('hidden');
				}
			});
			$(document).on('click', '.btn_remove', function() {
				var button_id = $(this).attr("id");
				i--;
				$('#row' + $('#dynamic_field div').length).remove();
				if (i<=1) {
				$('.btn_remove').addClass('hidden');
				}
			});
		});

		$("#name").keypress(function(e){ if(e.target.value.length==50){ alert("Ooops. Character limit reached."); } });
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