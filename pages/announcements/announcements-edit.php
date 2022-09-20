<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('announcements-edit')) {
		include($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-cookie-current-page.php');

		// set page
		$page = 'announcements';
		
		// get announcements id
		$id = decryptID($_GET['id']);
		
		$sql = $pdo->prepare("SELECT * FROM announcements WHERE id = :announcements_id LIMIT 1");
		$sql->bindParam(":announcements_id",$id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {

			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			$announcements_title = $data['announcements_title'];
			if(isset($_SESSION['sys_announcements_edit_title_val'])) {
				$announcements_title = $_SESSION['sys_announcements_edit_title_val'];
				unset($_SESSION['sys_announcements_edit_title_val']);
			}
			$announcements_details = $data['announcements_details'];
			if(isset($_SESSION['sys_announcements_edit_details_val'])) {
				$announcements_details = $_SESSION['sys_announcements_edit_details_val'];
				unset($_SESSION['sys_announcements_edit_details_val']);
			}
			$announcements_img = $data['announcements_img'];
			if(isset($_SESSION['sys_announcements_edit_img_val'])) {
				$announcements_img = $_SESSION['sys_announcements_edit_img_val'];
				unset($_SESSION['sys_announcements_edit_img_val']);
			}
			$announcements_status = $data['announcements_status'];
			if(isset($_SESSION['sys_announcements_edit_status_val'])) {
				$announcements_status = $_SESSION['sys_announcements_edit_status_val'];
				unset($_SESSION['sys_announcements_edit_status_val']);
			}
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Edit Announcement"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<!-- for the details text area input -->
	<link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

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
						<div class="col">
							<h1><i class="fa fa-bullhorn mr-3"></i><?php echo renderLang($announcements_edit); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php  echo $data['announcements_title']; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_announcements_edit_err');
					renderSuccess('sys_announcements_edit_suc');
					?>
					
					<form method="post" action="/submit-edit-announcements/<?php echo encryptID($id) ?>" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($announcements_edit_form); ?></h3>
								<div class="card-tools">
									<button type="button" class="btn btn-danger btn-delete mr-1" data-toggle="modal" data-target="#delete_announcements_modal"><i class="fa fa-trash mr-2"></i><?php echo renderLang($announcements_delete_announcements); ?></button>
								</div>
							</div>
							<div class="card-body">
								
								<div class="row">

									<!-- TITLE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_announcements_edit_title_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="title" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_title_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="title" name="title" placeholder="<?php echo renderLang($announcements_title_placeholder); ?>" value="<?php echo $announcements_title; ?>" required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_edit_title_err'].'</p>'; unset($_SESSION['sys_announcements_edit_title_err']); } ?>
										</div>
									</div>
									<!-- DATE CREATED -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<div class="form-group">
											<label for="title" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_date_created); ?></label> 
											<input type="text" class="form-control" id="date_created" name="date_created" value="<?php echo $data['date_created']; ?>" disabled>
																					
										</div>
									</div>
									<!-- DATE EDITED -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<div class="form-group">
											<label for="date_edit" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_date_edit); ?></label> 
											<input type="text" class="form-control" id="date_edit" name="date_edit" placeholder="<?php echo renderLang($announcements_date_edit_placeholder); ?>" value="<?php echo $data['date_edit']; ?>" disabled>
										</div>
									</div>
								</div><!-- row -->

								<hr>

								<div class="row">

									<!-- DETAILS -->
									<div class="col-8">
										<?php
										$details_err = 0;
										if(isset($_SESSION['sys_announcements_edit_details_err'])) { $details_err = 1; }
										?>
										<div class="form-group">
											<label for="details" class="mr-1<?php if($details_err) { echo ' text-danger'; } ?>"><?php if($details_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_details_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											
											<textarea class="form-control required<?php if($details_err) { echo ' is-invalid'; } ?>" id="details" minlength="4" name="details" rows="10" placeholder="<?php echo renderLang($announcements_details_placeholder); ?>" required><?php echo $announcements_details; ?></textarea>
											
											<?php if($details_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_edit_details_err'].'</p>'; unset($_SESSION['sys_announcements_edit_details_err']); } ?>
										</div>
									</div>
											
									
									<!-- IMAGE -->
									<div class="col-4">
										<?php $err = isset($_SESSION['sys_announcements_edit_img_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="img" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_img_label); ?></label> 
											<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<div class="custom-file">
												<input type="file" class="custom-file-input <?php if($err) { echo ' is-invalid'; } ?>" id="img" name="img">
												<label for="img" class="custom-file-label"><?php echo $announcements_img; ?></label>
												<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_edit_img_err'].'</p>'; unset($_SESSION['sys_announcements_edit_img_err']); } ?>
												<img src="/assets/images/announcements/<?php echo $announcements_img; ?>" class="img-thumbnail  mt-3 w-100" style="height:150px;">
												<input type="hidden" name="file_src" value="<?php echo $announcements_img; ?>">
											</div>
										</div>
									</div>

								</div><!-- row -->

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/announcements" class="btn btn-default border mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-upload mr-2"></i><?php echo renderLang($announcements_update_announcements); ?></button>
							</div>
						</div><!-- card -->
					</form>
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div><!-- wrapper -->
	
	<!-- MODALS -->
	<?php if(checkPermission('announcements-delete')) { ?>
	<!-- MODAL -->
	<div class="modal fade" id="delete_announcements_modal" data-backdrop="static" data-keyboard="false" aria-modal="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title"><?= renderLang($modal_delete_confirmation) ?></h4>
				</div>
				<form action="/submit-delete-announcements/<?php echo encryptID($id) ?>" method="post" id="form_delete">
					<div class="modal-body px-5 py-4">
						<input type="hidden" name="announcements_id" id="delete_announcements_id" value="4">
						<p class="m-0"><?= renderLang($announcements_modal_delete_msg1); ?></p>
						<div class="message_delete"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default border" data-dismiss="modal"><i class="fa fa-times mr-2"></i><?= renderLang($modal_cancel) ?></button>
						<button type="submit" class="btn btn-danger btn-confirm"><i class="fa fa-check mr-2"></i><?= renderLang($modal_confirm_delete) ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
	<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/dist/js/adminlte.min.js?v=3.2.0"></script>
	<script src="/plugins/summernote/summernote-bs4.min.js"></script>
	<script src="/dist/js/demo.js"></script>
	
	<script>
		$(function() {
			<?php if(checkPermission('announcements-delete')) { ?>
			$('html').on('click', '.btn-delete', function(e) {
				var id = $(this).attr('href');
				$('#delete_announcements_id').val(id);
			});
			var form_data;
			$('#btn_delete').submit(function(e) {
				e.preventDefault();
				var post_url = $(this).attr("action");
				form_data = $('#form_delete').serialize();
				$.ajax({
					url: post_url,
					type: 'POST',
					data : form_data
				}).done(function(response){
					$('.btn-delete').prop('disabled', false);
					//TO DO
				});

			});
		<?php } ?>
		});

		// for input image
		$('#img').on('change',function(){
			//get the file name
			var img = $(this).val();
			//replace the "Choose a file" label
			$(this).next('.custom-file-label').html(img);
		});
		//for details text editor
		/* $('#details').summernote({
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

		$("#title").keypress(function(e){ if(e.target.value.length==50){ alert("Ooops. Character limit reached."); } });
	</script>
	
</body>

</html>
<?php
		} else { // ID not found

			$_SESSION['sys_announcements_err'] = renderLang($announcements_announcements_not_found);
			header('location: /announcements');

		}
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /login');
	
}
?>