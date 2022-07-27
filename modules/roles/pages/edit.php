<?php
// INCLUDES
$module = 'roles'; $prefix = 'role'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		// get module icon
		include($root.'/includes/support/get-module-icon.php');
		
		$fields = array('role_name');
		
		// get role id
		$id = decryptID($_GET['id']);
		
		if($id != 1) {
		
			$sql = $pdo->prepare("SELECT * FROM ".$module." WHERE id = :id LIMIT 1");
			$sql->bindParam(":id",$id);
			$sql->execute();

			// check if ID exists
			if($sql->rowCount()) {
				
				$data = $sql->fetch(PDO::FETCH_ASSOC);
				foreach($fields as $field) {
					if(!isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'])) {
						$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'] = $data[$field];
					}
				}
				
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo renderLang(${$module.'_'.$process.'_'.$prefix}); ?> &middot; <?php echo renderLang($sitename); ?></title>
	
	<?php require($root.'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/modules/<?php echo $module; ?>/assets/css/style.css">
	
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
	
	<!-- WRAPPER -->
	<div class="wrapper">
		
		<?php
		require($root.'/includes/common/header.php');
		require($root.'/includes/common/sidebar.php');
		?>

		<!-- CONTENT -->
		<div class="content-wrapper">
			
			<!-- CONTENT HEADER -->
			<section class="content-header">
				<div class="container-fluid">
					
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><i class="<?php echo $page_module_icon; ?> mr-3"></i><?php echo renderLang(${$module.'_'.$process.'_'.$prefix}); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php  echo $data['role_name']; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php include($root.'/includes/common/notifications-process-edit.php'); ?>
					
					<form method="post" action="/submit-<?php echo $process.'-'.$prefix; ?>">
						
						<!-- FORM ID -->
						<input type="hidden" name="id" value="<?php echo encryptID($id); ?>">
						<input type="hidden" name="src" value="<?php echo $_GET['src']; ?>">
						
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang(${$module.'_'.$process.'_'.$prefix.'_form'}); ?></h3>
								<div class="card-tools">
									<a href="/<?php echo $prefix; ?>/<?php echo encryptID($id); ?>" class="btn btn-success mr-1"><i class="<?php echo $page_module_icon; ?> mr-2"></i><?php echo renderLang(${$module.'_view_'.$prefix.'_details'}); ?></a>
									<?php if(checkPermission($module.'-delete') && $data['status'] != 2) { ?>
										<button type="button" class="btn btn-danger btn-confirm-delete" data-toggle="modal" data-target="#modal-confirm-delete"><i class="fa fa-trash mr-2"></i><?php echo renderLang(${$module.'_delete_'.$prefix}); ?></button>
									<?php } else {
									if(checkPermission($module.'-restore')) { ?>
										<button type="button" class="btn btn-success btn-confirm-restore"><i class="fa fa-sync mr-2"></i><?php echo renderLang(${$module.'_restore_'.$prefix}); ?></button>
									<?php } } ?>
								</div>
							</div>
							<div class="card-body">

								<div class="row">
									
									<!-- ROLE NAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php renderField($module,'role_name',$process,'input','','',1,2,0); ?>
									</div>

								</div><!-- row -->

								<hr>
								
								<!-- PERMISSIONS -->
								<?php
								$field = 'permissions'; $required = 1;
								if(!isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'])) { $_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'] = $data[$field]; } // check if field session exists
								// overwrite array if permission val is ALL
								if($data[$field] == 'all') {
									${$field.'_val_arr'} = array();
									foreach(${$field.'_arr'} as ${$field.'_group'}) {
										foreach(${$field.'_group'} as $permission) {
											array_push(${$field.'_val_arr'},$permission['permission_code']);
										}
									}
									$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'] = implode(${$field.'_val_arr'},',');
								}
								${$field.'_val'} = '';
								${$field.'_val_arr'} = array();
								$err = isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_err']) ? 1 : 0;
								?>
								<div class="form-group">
									<h4<?php if($err) { echo ' class="text-danger"'; } ?>><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } ?><?php echo renderLang($lang_permissions); ?> <?php if($required) { echo '<span class="right badge badge-danger ml-1" style="font-size:10px;">'.renderLang($label_required).'</span>'; } ?></h4>
									<input type="text" id="<?php echo $field; ?>" class="<?php if($required) { echo 'required'; } ?>" name="<?php echo $field; ?>"<?php if(isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'])) { echo ' value="'.$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'].'"'; ${$field.'_val'} = $_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val']; } if($required) { echo ' required'; } ?>>
									<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_err'].'</p>'; unset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_err']); } ?>
								</div>
								<ul class="permissions-list">
									<?php
									if(${$field.'_val'} != '') {
										${$field.'_val_arr'} = explode(',',${$field.'_val'});
									}
									foreach(${$field.'_arr'} as ${$field.'_group'}) {
										echo '<li>';
											echo '<ul class="permissions-group">';
										foreach(${$field.'_group'} as $permission) {
												$btn_design = 'btn-default';
												if(in_array($permission['permission_code'],${$field.'_val_arr'})) {
													$btn_design = 'btn-success';
												}
												echo '<li><a href="#" class="btn '.$btn_design.' btn-sm" data-permission-code="'.$permission['permission_code'].'" title="'.renderLang($permission['permission_description']).'">'.renderLang($permission['permission_name']).'</a></li>';
											}
											echo '</ul>';
										echo '</li>';
									}
									?>
								</ul>

								<a href="#" class="btn btn-default mt-2 btn-clear-permissions"><i class="fa fa-times mr-2"></i><?php echo renderLang($roles_clear_permissions); ?></a>

							</div><!-- card-body -->
							<div class="card-footer text-right">
								
								<?php $back_url = $_GET['src'] == 'view' ? '/'.$prefix.'/'.encryptID($id) : '/'.$module; ?>
								<a href="<?php echo $back_url; ?>" class="btn btn-default"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								
								<?php if($data['status'] != 2) { ?>
								<button class="btn btn-primary ml-2"><i class="fa fa-upload mr-2"></i><?php echo renderLang(${$module.'_update_'.$prefix}); ?></button>
								<?php } ?>
								
							</div>
						</div><!-- card -->
					</form>
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($root.'/includes/common/footer.php'); ?>
		
	</div><!-- wrapper -->
	
	<?php
	require($root.'/includes/common/js.php');
	include($root.'/includes/common/modal-delete.php');
	?>
	
	<script>
		$(function() {
			
			<?php if(checkPermission($module.'-restore')) { ?>
			$('.btn-confirm-restore').click(function() {
				if(confirm('<?php echo renderLang(${$module.'_restore_confirmation'}); ?>')) {
					window.location.href = '/restore-<?php echo $prefix; ?>/<?php echo $_GET['src']; ?>/<?php echo encryptID($id); ?>';
				}
			});
			<?php } ?>
			
			// populate permissions
			$('.permissions-group li a').click(function(e) {
				e.preventDefault();

				$(this).toggleClass('btn-default').toggleClass('btn-success');

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
				$('.permissions-group li a').removeClass('btn-success').addClass('btn-default');
				$('#permissions').val('');
				$('h4 .badge').addClass('badge-danger').removeClass('badge-success');
			});
			
		});
	</script>
	
</body>

</html>
<?php
			} else { // ID not found
				
				$_SESSION['sys_'.$module.'_err'] = renderLang(${$module.'_'.$prefix.'_not_found'});
				header('location: /'.$module);
			
			}
		} else { // unauthorized to edit super admin role
			
			$_SESSION['sys_'.$module.'_err'] = renderLang(${$module.'_messages_cannot_edit_superadmin'}); // "Super Admin role cannot be edited."
			header('location: /'.$module);

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