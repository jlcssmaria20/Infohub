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
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Add Announcement"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>

	<link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
	<!-- for the details text area input -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	
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
							<h1><i class="fa fa-bullhorn mr-3"></i><?php echo renderLang($announcements_add); ?></h1>
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
					
					<form method="post" action="/submit-add-announcements" enctype="multipart/form-data">
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
											<input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="title" name="title" placeholder="<?php echo renderLang($announcements_title_placeholder); ?>"<?php if(isset($_SESSION['sys_announcements_add_title_val'])) { echo ' value="'.$_SESSION['sys_announcements_add_title_val'].'"'; } ?> required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_add_title_err'].'</p>'; unset($_SESSION['sys_announcements_add_title_err']); } ?>
										</div>
									</div>

								</div>
									
								<hr>
								
								<div class="row">

									<!-- DETAILS -->
									<div class="col-8">
										<?php
										$details_err = 0;
										if(isset($_SESSION['sys_announcements_add_details_err'])) { $details_err = 1; }
										?>
										<div class="form-group">
											<label for="details" class="mr-1<?php if($details_err) { echo ' text-danger'; } ?>"><?php if($details_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_details_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>

											<textarea class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" rows="10" id="details" placeholder="<?php echo renderLang($announcements_details_placeholder) ?>" minlength="4" name="details" required></textarea>
											
											<?php if($details_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_add_details_err'].'</p>'; unset($_SESSION['sys_announcements_add_details_err']); } ?>
										</div>
									</div>
									
									<!-- IMAGE -->
									<div class="col-4">
										<?php $err = isset($_SESSION['sys_announcements_add_img_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="img" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_img_label); ?></label> 
											<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<div class="custom-file">
												<input type="file" class="custom-file-input required<?php if($err) { echo ' is-invalid'; } ?>" id="img" name="img" required>
												<label for="imgs" class="custom-file-label">Choose Image</label>
												<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_add_img_err'].'</p>'; unset($_SESSION['sys_announcements_add_img_err']); } ?>
												<img id="picture_display" class="img-thumbnail  mt-3 w-100" src="#" style="display: none; height:150px;">
												
											</div>
										</div>
									</div>
								</div>
							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/announcements" class="btn btn-default border mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
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
	

	<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/dist/js/adminlte.min.js?v=3.2.0"></script>
	<script src="/plugins/summernote/summernote-bs4.min.js"></script>
	<script src="/dist/js/demo.js"></script>

	<!-- Summernote -->
	<script>
		//for image input
		$('#img').on('change',function(){
		//get the file name
		var img = $(this).val();
		//replace the "Choose a file" label
		$(this).next('.custom-file-label').html(img);
		});
		//for details text editor
		/* $('#details').summernote({
			placeholder: 'This announcement is about...',
			tabsize: 2,
			height: 100,
			toolbar: [
				// [groupName, [list of button]]
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough', 'superscript', 'subscript']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol']],
				['height', ['height']]
			]
		}); */

		function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#picture_display').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

		$("#img").change(function(){
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