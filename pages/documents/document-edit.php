<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('document-edit')) {
		include($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-cookie-current-page.php');

		// set page
		$page = 'documents';
		
		// get document id
		$id = decryptID($_GET['id']);
		
		$sql = $pdo->prepare("SELECT * FROM documents WHERE id = :documents_id LIMIT 1");
		$sql->bindParam(":documents_id",$id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {

			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			$document_name = $data['document_name'];
			if(isset($_SESSION['sys_document_edit_name_val'])) {
				$document_name = $_SESSION['sys_document_edit_name_val'];
				unset($_SESSION['sys_document_edit_name_val']);
			}
			$document_status = $data['document_status'];
			if(isset($_SESSION['sys_document_edit_status_val'])) {
				$document_status = $_SESSION['sys_document_edit_status_val'];
				unset($_SESSION['sys_document_edit_status_val']);
			}
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo renderLang($document_edit); ?> &middot; <?php echo $sitename; ?></title>
	
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
							<h1><i class="fa fa-circle-o mr-3"></i><?php echo renderLang($document_edit); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php  echo $data['document_name']; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_document_edit_err');
					renderSuccess('sys_document_edit_suc');
					?>
					
					<form method="post" action="/submit-edit-document/<?php echo encryptID($id) ?>">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($document_edit_form); ?></h3>
								<div class="card-tools">
									<button type="button" class="btn btn-danger btn-delete mr-1" data-toggle="modal" data-target="#delete_document_modal"><i class="fa fa-trash mr-2"></i><?php echo renderLang($document_delete_document); ?></button>
								</div>
							</div>
							<div class="card-body">
								
								<div class="row">

									<!-- FOLDER NAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_document_edit_name_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="name" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_name_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="4" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="name" name="name" placeholder="<?php echo renderLang($document_name_placeholder); ?>" value="<?php echo $document_name; ?>" required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_edit_name_err'].'</p>'; unset($_SESSION['sys_document_edit_name_err']); } ?>
										</div>
									</div>
									
									<!-- STATUS -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_document_edit_status_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="document_status" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($lang_status); ?></label> <span class="right badge badge-success"><?php echo renderLang($label_required); ?></span>
											<select class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="document_status" name="document_status" required>
												<?php
												foreach($status_arr as $status) {
													echo '<option value="'.$status[0].'"';
													if($document_status == $status[0]) {
														echo ' selected';
													}
													echo '>'.renderLang($status[1]).'</option>';
												}
												?>
											</select>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_edit_status_err'].'</p>'; unset($_SESSION['sys_document_edit_status_err']); } ?>
										</div>
									</div>

								</div><!-- row -->

								<hr>

								<div class="row">

									<!-- FIRSTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$firstname_err = 0;
										if(isset($_SESSION['sys_document_edit_firstname_err'])) { $firstname_err = 1; }
										?>
										<div class="form-group">
											<label for="firstname" class="mr-1<?php if($firstname_err) { echo ' text-danger'; } ?>"><?php if($firstname_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_firstname_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($firstname_err) { echo ' is-invalid'; } ?>" id="firstname" name="firstname" placeholder="<?php echo renderLang($document_firstname_placeholder); ?>" value="<?php echo $document_firstname; ?>" required>
											<?php if($firstname_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_edit_firstname_err'].'</p>'; unset($_SESSION['sys_document_edit_firstname_err']); } ?>
										</div>
									</div>
									
									<!-- LASTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$lastname_err = 0;
										if(isset($_SESSION['sys_document_edit_lastname_err'])) { $lastname_err = 1; }
										?>
										<div class="form-group">
											<label for="lastname" class="mr-1<?php if($lastname_err) { echo ' text-danger'; } ?>"><?php if($lastname_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_lastname_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($lastname_err) { echo ' is-invalid'; } ?>" id="lastname" name="lastname" placeholder="<?php echo renderLang($document_lastname_placeholder); ?>" value="<?php echo $document_lastname; ?>" required>
											<?php if($lastname_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_edit_lastname_err'].'</p>'; unset($_SESSION['sys_document_edit_lastname_err']); } ?>
										</div>
									</div>

								</div><!-- row -->

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/documents" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-upload mr-2"></i><?php echo renderLang($document_update_document); ?></button>
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
	<?php if(checkPermission('document-delete')) { ?>
	<!-- MODAL -->
	<div class="modal fade" id="delete_document_modal" data-backdrop="static" data-keyboard="false" aria-modal="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title"><?= renderLang($modal_delete_confirmation) ?></h4>
				</div>
				<form action="/submit-delete-document/<?php echo encryptID($id) ?>" method="post" id="form_delete">
					<input type="hidden" name="document_id" id="delete_document_id" value="4">
					<div class="modal-body">
						<p><?= renderLang($document_modal_delete_msg1); ?></p>
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
			<?php if(checkPermission('document-delete')) { ?>
			$('html').on('click', '.btn-delete', function(e) {
				var id = $(this).attr('href');
				$('#delete_document_id').val(id);
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

			$_SESSION['sys_document_err'] = renderLang($document_document_not_found);
			header('location: /document');

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