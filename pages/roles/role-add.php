<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');


// check if user has existing session
if(checkSession()) {

	// check permission to access this page or function
	if(checkPermission('role-add')) {

		// set page
		$page = 'roles';

?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
<title><?php echo $dx."Add Role"; ?></title>

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
						<h1><i class="far fa-id-badge mr-3"></i><?php echo renderLang($roles_add_role); ?></h1>
					</div>
				</div>
				
			</div><!-- container-fluid -->
		</section><!-- content-header -->

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				
				<?php
				renderError('sys_roles_add_err');
				renderSuccess('sys_roles_add_suc');
				?>
				
				<form method="post" action="/submit-add-role">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($roles_add_role_form); ?></h3>
						</div>
						<div class="card-body">

							<div class="row">

								<!-- ROLE NAME -->
								<div class="col-lg-3 col-md-4 col-sm-2">
									<?php
									$role_name_err = 0;
									if(isset($_SESSION['sys_roles_add_role_name_err'])) { $role_name_err = 1; }
									?>
									<div class="form-group">
										<label for="role_name" class="mr-1<?php if($role_name_err) { echo ' text-danger'; } ?>"><?php if($role_name_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($roles_role_name); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
										<input type="text" minlength="4" maxlength="50" class="form-control required<?php if($role_name_err) { echo ' is-invalid'; } ?>" id="role_name" name="role_name" placeholder="<?php echo renderLang($roles_role_name_placeholder); ?>"<?php if(isset($_SESSION['sys_roles_add_role_name_val'])) { echo ' value="'.$_SESSION['sys_roles_add_role_name_val'].'"'; } ?> required>
										<?php if($role_name_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_roles_add_role_name_err'].'</p>'; unset($_SESSION['sys_roles_add_role_name_err']); } ?>
									</div>
								</div>

							</div><!-- row -->

							<hr>
							
							<!-- PERMISSIONS -->
							<?php
							$permissions_val = '';
							$permissions_val_arr = array();
							$permissions_err = 0;
							if(isset($_SESSION['sys_roles_add_role_permissions_err'])) { $permissions_err = 1; }
							?>
							<div class="form-group">
								<h4<?php if($permissions_err) { echo ' class="text-danger"'; } ?>><?php if($permissions_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } ?><?php echo renderLang($lang_permissions); ?> <span class="right badge badge-danger ml-1" style="font-size:10px;"><?php echo renderLang($label_required); ?></span></h4>
								<input type="hidden" id="permissions" class="required" name="permissions"<?php if(isset($_SESSION['sys_roles_add_role_permissions_val'])) { echo ' value="'.$_SESSION['sys_roles_add_role_permissions_val'].'"'; $permissions_val = $_SESSION['sys_roles_add_role_permissions_val']; } ?> required>
								<?php if($permissions_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_roles_add_role_permissions_err'].'</p>'; unset($_SESSION['sys_roles_add_role_permissions_err']); } ?>
							</div>
							<ul class="permissions-list">
							<?php
							if($permissions_val != '') {
								$permissions_val_arr = explode(',',$permissions_val);
							}
							foreach($permissions_arr as $permissions_group) {
								echo '<li>';
									echo '<ul class="permissions-group">';
									foreach($permissions_group as $permission) {
										$btn_design = 'btn-secondary';
										if(in_array($permission['permission_code'],$permissions_val_arr)) {
											$btn_design = 'btn-secondary';
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
							<a href="/roles" class="btn btn-default text-dark mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
							<button class="btn btn-primary"><i class="fa fa-plus mr-2"></i><?php echo renderLang($roles_add_role); ?></button>
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
		
	});
	
			
	$("#role_name").keypress(function(e){ if(e.target.value.length==50){ alert("Ooops. Character limit reached."); } })
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
	header('location: /');

}

?>