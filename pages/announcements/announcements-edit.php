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
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo renderLang($announcements_edit); ?> &middot; <?php echo $sitename; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/assets/css/announcements.css">
	
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
							<h1><i class="fa fa-circle-o mr-3"></i><?php echo renderLang($announcements_edit); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php  echo $data['announcements_title']; ?></h1>
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
					
					<form method="post" action="/submit-edit-announcements/<?php echo encryptID($id) ?>">
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
											<input type="text" minlength="4" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="title" name="title" placeholder="<?php echo renderLang($announcements_title_placeholder); ?>" value="<?php echo $announcements_title; ?>" required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_edit_title_err'].'</p>'; unset($_SESSION['sys_announcements_edit_title_err']); } ?>
										</div>
									</div>
									
								</div>

								<hr>

								<div class="row">

									<!-- DETAILS -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$details_err = 0;
										if(isset($_SESSION['sys_announcements_edit_details_err'])) { $details_err = 1; }
										?>
										<div class="form-group">
											<label for="details" class="mr-1<?php if($details_err) { echo ' text-danger'; } ?>"><?php if($details_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_details_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($details_err) { echo ' is-invalid'; } ?>" id="details" name="details" placeholder="<?php echo renderLang($announcements_details_placeholder); ?>" value="<?php echo $announcements_details; ?>" required>
											<?php if($details_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_edit_details_err'].'</p>'; unset($_SESSION['sys_announcements_edit_details_err']); } ?>
										</div>
									</div>
									
									<!-- IMAGE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$img_err = 0;
										if(isset($_SESSION['sys_announcements_edit_img_err'])) { $img_err = 1; }
										?>
										<div class="form-group">
											<label for="img" class="mr-1<?php if($img_err) { echo ' text-danger'; } ?>"><?php if($img_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_img_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($img_err) { echo ' is-invalid'; } ?>" id="img" name="img" placeholder="<?php echo renderLang($announcements_img_placeholder); ?>" value="<?php echo $announcements_img; ?>" required>
											<?php if($img_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_announcements_edit_img_err'].'</p>'; unset($_SESSION['sys_announcements_edit_img_err']); } ?>
										</div>
									</div>

								</div><!-- row -->

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/announcements" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
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
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title"><?= renderLang($modal_delete_confirmation) ?></h4>
				</div>
				<form action="/submit-delete-announcements/<?php echo encryptID($id) ?>" method="post" id="form_delete">
					<input type="hidden" name="announcements_id" id="delete_announcements_id" value="4">
					<div class="modal-body">
						<p><?= renderLang($announcements_modal_delete_msg1); ?></p>
						<div class="message_delete"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-2"></i><?= renderLang($modal_cancel) ?></button>
						<button type="submit" class="btn btn-danger btn-confirm"><i class="fa fa-check mr-2"></i><?= renderLang($modal_confirm_delete) ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
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