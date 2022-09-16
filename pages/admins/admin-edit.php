<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('admin-edit')) {
		include($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-cookie-current-page.php');

		// set page
		$page = 'admins';
		
		// get admin id
		$id = decryptID($_GET['id']);
		
		$sql = $pdo->prepare("SELECT * FROM admins WHERE admin_id = :admin_id LIMIT 1");
		$sql->bindParam(":admin_id",$id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {

			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			$admin_username = $data['admin_username'];
			if(isset($_SESSION['sys_admins_edit_username_val'])) {
				$admin_username = $_SESSION['sys_admins_edit_username_val'];
				unset($_SESSION['sys_admins_edit_username_val']);
			}
			$admin_firstname = $data['admin_firstname'];
			if(isset($_SESSION['sys_admins_edit_firstname_val'])) {
				$admin_firstname = $_SESSION['sys_admins_edit_firstname_val'];
				unset($_SESSION['sys_admins_edit_firstname_val']);
			}
			$admin_lastname = $data['admin_lastname'];
			if(isset($_SESSION['sys_admins_edit_lastname_val'])) {
				$admin_lastname = $_SESSION['sys_admins_edit_lastname_val'];
				unset($_SESSION['sys_admins_edit_lastname_val']);
			}
			$admin_status = $data['admin_status'];
			if(isset($_SESSION['sys_admins_edit_admin_status_val'])) {
				$admin_status = $_SESSION['sys_admins_edit_admin_status_val'];
				unset($_SESSION['sys_admins_edit_admin_status_val']);
			}
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Edit Admin"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/assets/css/admins.css">
	
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
							<h1><i class="fa fa-admin-secret mr-3"></i><?php echo renderLang($admins_edit_admin); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php  echo $data['admin_username']; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_admins_edit_err');
					renderSuccess('sys_admins_edit_suc');
					?>
					
					<form method="post" action="/submit-edit-admin">
						
						<!-- FORM ID -->
						<input type="hidden" name="id" value="<?php echo encryptID($id); ?>">
						
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($admins_edit_admin_form); ?></h3>
								<div class="card-tools">
									<button type="button" class="btn btn-danger btn-confirm-delete mr-1" data-toggle="modal" data-target="#modal-confirm-delete"><i class="fa fa-trash mr-2"></i><?php echo renderLang($admins_delete_admin); ?></button>
								</div>
							</div>
							<div class="card-body">
								
								<div class="row">

									<!-- USERNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_admins_edit_username_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="username" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($admins_username); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="4" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="username" name="username" placeholder="<?php echo renderLang($admins_username_placeholder); ?>" value="<?php echo $admin_username; ?>" required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_admins_edit_username_err'].'</p>'; unset($_SESSION['sys_admins_edit_username_err']); } ?>
										</div>
									</div>
									
									<!-- ADMIN STATUS -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_admins_edit_admin_status_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="admin_status" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($lang_status); ?></label> <span class="right badge badge-success"><?php echo renderLang($label_required); ?></span>
											<select class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="admin_status" name="admin_status" required>
												<?php
												foreach($status_arr as $status) {
													echo '<option value="'.$status[0].'"';
													if($admin_status == $status[0]) {
														echo ' selected';
													}
													echo '>'.renderLang($status[1]).'</option>';
												}
												?>
											</select>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_admins_edit_admin_status_err'].'</p>'; unset($_SESSION['sys_admins_edit_admin_status_err']); } ?>
										</div>
									</div>

								</div><!-- row -->

								<hr>

								<div class="row">

									<!-- FIRSTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$firstname_err = 0;
										if(isset($_SESSION['sys_admins_edit_firstname_err'])) { $firstname_err = 1; }
										?>
										<div class="form-group">
											<label for="firstname" class="mr-1<?php if($firstname_err) { echo ' text-danger'; } ?>"><?php if($firstname_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($admins_firstname); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($firstname_err) { echo ' is-invalid'; } ?>" id="firstname" name="firstname" placeholder="<?php echo renderLang($admins_firstname_placeholder); ?>" value="<?php echo $admin_firstname; ?>" required>
											<?php if($firstname_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_admins_edit_firstname_err'].'</p>'; unset($_SESSION['sys_admins_edit_firstname_err']); } ?>
										</div>
									</div>
									
									<!-- LASTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$lastname_err = 0;
										if(isset($_SESSION['sys_admins_edit_lastname_err'])) { $lastname_err = 1; }
										?>
										<div class="form-group">
											<label for="lastname" class="mr-1<?php if($lastname_err) { echo ' text-danger'; } ?>"><?php if($lastname_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($admins_lastname); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($lastname_err) { echo ' is-invalid'; } ?>" id="lastname" name="lastname" placeholder="<?php echo renderLang($admins_lastname_placeholder); ?>" value="<?php echo $admin_lastname; ?>" required>
											<?php if($lastname_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_admins_edit_lastname_err'].'</p>'; unset($_SESSION['sys_admins_edit_lastname_err']); } ?>
										</div>
									</div>

								</div><!-- row -->

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/admins" class="btn btn-default text-dark mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-upload mr-2"></i><?php echo renderLang($admins_update_admin); ?></button>
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
	<!-- confirm delete -->
	<div class="modal fade" id="modal-confirm-delete">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title"><?php echo renderLang($modal_delete_confirmation); ?></h4>
				</div>
				<form action="/delete-admin" method="post" id="form_delete">
					<input type="hidden" name="id" value="<?php echo encryptID($id); ?>">
					<div class="modal-body align-items-start">
						<p class="font-weight-bold">
							<?php echo renderLang($admins_modal_delete_msg1); ?><br>
							<span class="font-weight-normal text-danger"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo renderLang($admins_modal_delete_msg2); ?></span>
						</p>
						<div class="form-group is-invalid">
							<label for="modal_confirm_delete_upass"><?php echo renderLang($enter_password); ?></label>
							<input type="password" class="form-control required" id="modal_confirm_delete_upass" name="upass" placeholder="<?php echo renderLang($enter_password_placeholder); ?>" required autocomplete="off">
						</div>
						<div class="modal-error alert alert-danger"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-2"></i><?php echo renderLang($modal_cancel); ?></button>
						<input type="submit" class="btn btn-danger btn-delete" value="<?php echo renderLang($modal_confirm_delete); ?>">
<!--						<i class="fa fa-check mr-2"></i>-->
					</div>
				</form>
			</div>
		</div>
	</div><!-- modal -->

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
	<script>
		$(function() {

			// confirm delete
			var form_data;
			$('.btn-delete').click(function() {
				form_data = $('#form_delete').serialize();
				$('#modal_confirm_delete_upass').val('');
				$('#form_delete').submit();
				$('.btn-delete').prop('disabled', true);
			});
			$('#form_delete').submit(function(e) {
				e.preventDefault();
				var post_url = $(this).attr("action");
				showLoading()
				$.ajax({
					url: post_url,
					type: 'POST',
					data : form_data
				}).done(function(response){
					hideLoading()
					$('.btn-delete').prop('disabled', false);
					var response_arr = response.split(',');
					if(response_arr[0] == 1) { // val is 1
						window.location.href = '/admins';
					} else {
						$('.modal-error')
							.html(response_arr[1]) // val is error message
							.show();
					}
				});
			});
			
		});
	</script>
	
</body>

</html>
<?php
		} else { // ID not found

			$_SESSION['sys_admins_err'] = renderLang($admins_admin_not_found);
			header('location: /admins');

		}
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /');
	
}
?>