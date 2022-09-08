<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('role-edit')) {

		// set page
		$page = 'roles';

		// get role id
		$role_id = decryptID($_GET['id']);

		$sql = $pdo->prepare("SELECT * FROM roles WHERE role_id = :role_id LIMIT 1");
		$sql->bindParam(":role_id",$role_id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {

			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			$role_name = $data['role_name'];
			if(isset($_SESSION['sys_roles_edit_role_name_val'])) {
				$role_name = $_SESSION['sys_roles_edit_role_name_val'];
				unset($_SESSION['sys_roles_edit_role_name_val']);
			}
			$permissions = $data['permissions'];
			if(isset($_SESSION['sys_roles_edit_role_permissions_val'])) {
				$permissions = $_SESSION['sys_roles_edit_role_permissions_val'];
				unset($_SESSION['sys_roles_edit_role_permissions_val']);
			}

			// overwrite array if permission val is ALL
			if($data['permissions'] == 'all') {
				$permissions_val_arr = array();
				foreach($permissions_arr as $permissions_group) {
					foreach($permissions_group as $permission) {
						array_push($permissions_val_arr,$permission['permission_code']);
					}
				}
				$permissions = implode($permissions_val_arr,',');
			}

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo renderLang($roles_edit_role); ?></title>

<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
<link rel="stylesheet" href="/assets/css/roles.css">

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
						<h1><i class="far fa-id-badge mr-3"></i><?php echo renderLang($roles_edit_role); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php  echo $data['role_name']; ?></h1>
					</div>
				</div>
				
			</div><!-- container-fluid -->
		</section><!-- content-header -->

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				
				<?php
				renderError('sys_roles_edit_err');
				renderSuccess('sys_roles_edit_suc');
				?>
				
				<form method="post" action="/submit-edit-role">
					
					<!-- FORM ID -->
					<input type="hidden" name="role_id" value="<?php echo encryptID($role_id); ?>">
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($roles_edit_role_form); ?></h3>
							<div class="card-tools">
								<button type="button" class="btn btn-danger btn-confirm-delete mr-1" data-toggle="modal" data-target="#modal-confirm-delete"><i class="fa fa-trash mr-2"></i><?php echo renderLang($roles_delete_role); ?></button>
							</div>
						</div>
						<div class="card-body">

							<div class="row">

								<!-- ROLE NAME -->
								<div class="col-lg-3 col-md-4 col-sm-2">
									<?php
									$role_name_err = 0;
									if(isset($_SESSION['sys_roles_edit_role_name_err'])) { $role_name_err = 1; }
									?>
									<div class="form-group">
										<label for="role_name" class="mr-1<?php if($role_name_err) { echo ' text-danger'; } ?>"><?php if($role_name_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($roles_role_name); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
										<input type="text" minlength="4" class="form-control required<?php if($role_name_err) { echo ' is-invalid'; } ?>" id="role_name" name="role_name" placeholder="<?php echo renderLang($roles_role_name_placeholder); ?>" value="<?php echo $role_name; ?>" required>
										<?php if($role_name_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_roles_edit_role_name_err'].'</p>'; unset($_SESSION['sys_roles_edit_role_name_err']); } ?>
									</div>
								</div>

							</div><!-- row -->

							<hr>
							
							<!-- PERMISSIONS -->
							<?php
							$permissions_val = '';
							$permissions_val_arr = array();
							$permissions_err = 0;
							if(isset($_SESSION['sys_roles_edit_role_permissions_err'])) { $permissions_err = 1; }
							?>
							<div class="form-group">
								<h4<?php if($permissions_err) { echo ' class="text-danger"'; } ?>><?php if($permissions_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } ?><?php echo renderLang($lang_permissions); ?> <span class="right badge badge-danger ml-1" style="font-size:10px;"><?php echo renderLang($label_required); ?></span></h4>
								<input type="hidden" id="permissions" class="required" name="permissions" value="<?php echo $permissions; ?>"  required>
								<?php if($permissions_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_roles_edit_role_permissions_err'].'</p>'; unset($_SESSION['sys_roles_edit_role_permissions_err']); } ?>
							</div>
							<ul class="permissions-list">
							<?php
							// check if permission val has value
							$permissions_val = $permissions;
							if($permissions_val != '') {
								$permissions_val_arr = explode(',',$permissions_val);
							}
							foreach($permissions_arr as $permissions_group) {
								echo '<li>';
									echo '<ul class="permissions-group">';
									foreach($permissions_group as $permission) {
										$btn_design = 'btn-secondary';
										if(in_array($permission['permission_code'],$permissions_val_arr)) {
											$btn_design = 'btn-success';
										}
										if($permissions_val == 'all') {
											$btn_design = 'btn-success';
										}
										echo '<li><a href="#" class="btn '.$btn_design.' btn-sm" data-permission-code="'.$permission['permission_code'].'" title="'.renderLang($permission['permission_description']).'">'.renderLang($permission['permission_name']).'</a></li>';
									}
									echo '</ul>';
								echo '</li>';
							}
							?>
							</ul>

							<a href="#" class="btn btn-secondary mt-2 btn-clear-permissions"><i class="fa fa-times mr-2"></i><?php echo renderLang($roles_clear_permissions); ?></a>

						</div><!-- card-body -->
						<div class="card-footer text-right">
							<a href="/roles" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
							<button class="btn btn-primary"><i class="fa fa-upload mr-2"></i><?php echo renderLang($roles_update_role); ?></button>
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
			<form action="/delete-role" method="post" id="form_delete">
				<input type="hidden" name="role_id" value="<?php echo encryptID($role_id); ?>">
				<div class="modal-body">
					<p><?php echo renderLang($roles_modal_delete_msg1); ?></p>
					<p><?php echo renderLang($roles_modal_delete_msg2); ?></p>
					<hr>
					<div class="form-group is-invalid">
						<label for="modal_confirm_delete_upass"><?php echo renderLang($enter_password); ?></label>
						<input type="password" class="form-control" id="modal_confirm_delete_upass" name="upass" placeholder="<?php echo renderLang($enter_password_placeholder); ?>" required autocomplete="off">
					</div>
					<div class="modal-error alert alert-danger"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-2"></i><?php echo renderLang($modal_cancel); ?></button>
					<input type="submit" class="btn btn-danger btn-delete" value="<?php echo renderLang($modal_confirm_delete); ?>"><!--<i class="fa fa-check mr-2"></i>-->
				</div>
			</form>
		</div>
	</div>
</div><!-- modal -->

<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
<script>
	$(function() {
		
		// populate permissions
		$('.permissions-group li a').click(function(e) {
			e.preventDefault();

			$(this).toggleClass('btn-secondary').toggleClass('btn-success');

			var permissions = '';
			var permissions_arr = [];

			$('.permissions-group li a').each(function() {
				if($(this).hasClass('btn-success')) {
					permissions_arr.push($(this).attr('data-permission-code'));
				}
			});

			var permissions_val = permissions_arr.join(',');
			$('#permissions').val(permissions_val);

			// required badge toggle
			if(permissions_val == '') {
				$('h4 .badge').addClass('badge-danger').removeClass('badge-success');
			} else {
				$('h4 .badge').addClass('badge-success').removeClass('badge-danger');
			}
		});

		// clear permissions
		$('.btn-clear-permissions').click(function(e) {
			e.preventDefault();
			$('.permissions-group li a').removeClass('btn-success').addClass('btn-secondary');
			$('#permissions').val('');
			$('h4 .badge').addClass('badge-danger').removeClass('badge-success');
		});

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
					window.location.href = '/roles';
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

			$_SESSION['sys_roles_err'] = renderLang($roles_role_not_found); // "Role not found."
			header('location: /roles');

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