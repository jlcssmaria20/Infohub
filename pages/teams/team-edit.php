<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('team-edit')) {
		include($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-cookie-current-page.php');

		// set page
		$page = 'teams';
		
		// get team id
		$id = decryptID($_GET['id']);
		
		$sql = $pdo->prepare("SELECT * FROM teams WHERE id = :team_id LIMIT 1");
		$sql->bindParam(":team_id",$id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {

			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			$team_name = $data['team_name'];
			if(isset($_SESSION['sys_team_edit_name_val'])) {
				$team_name = $_SESSION['sys_team_edit_name_val'];
				unset($_SESSION['sys_team_edit_name_val']);
			}
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="/assets/images/favicon.png">
	<title><?php echo $dx."Edit Team"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/assets/css/team.css">
	
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
							<h1><i class="fa fa-handshake mr-3"></i><?php echo renderLang($team_edit); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php  echo $data['team_name']; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_team_edit_err');
					renderSuccess('sys_team_edit_suc');
					?>
					
					<form method="post" action="/submit-edit-team/<?php echo encryptID($id) ?>">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($team_edit_form); ?></h3>
								<div class="card-tools">
									<button type="button" class="btn btn-danger btn-delete mr-1" data-toggle="modal" data-target="#delete_team_modal"><i class="fa fa-trash mr-2"></i><?php echo renderLang($team_delete_team); ?></button>
								</div>
							</div>
							<div class="card-body">
								
								<div class="row">

									<!-- TEAM NAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_team_edit_name_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="team_name" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($team_name_label); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="4" maxlength="30" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="team_name" name="team_name" placeholder="<?php echo renderLang($team_name_placeholder); ?>" value="<?php echo $team_name; ?>" required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_team_edit_name_err'].'</p>'; unset($_SESSION['sys_team_edit_name_err']); } ?>
										</div>
									</div>
									
									

								</div><!-- row -->

								<hr>

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/teams" class="btn btn-default text-dark mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-upload mr-2"></i><?php echo renderLang($team_update_team); ?></button>
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
	<?php if(checkPermission('team-delete')) { ?>
	<!-- MODAL -->
	<div class="modal fade" id="delete_team_modal" data-backdrop="static" data-keyboard="false" aria-modal="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title"><?= renderLang($modal_delete_confirmation) ?></h4>
				</div>
				<form action="/submit-delete-team/<?php echo encryptID($id) ?>" method="post" id="form_delete">
					<input type="hidden" name="team_id" id="delete_team_id" value="4">
					<div class="modal-body">
						<p class="m-0"><?php echo renderLang($delete_confirmation_new)." <u><strong> ".$data['team_name']. "</u></strong> Team?" ?></p></p>
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
			<?php if(checkPermission('team-delete')) { ?>
			$('html').on('click', '.btn-delete', function(e) {
				var id = $(this).attr('href');
				$('#delete_team_id').val(id);
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
		
			
		$("#team_name").keypress(function(e){ if(e.target.value.length==30){ alert("Ooops. Character limit reached."); } })
	</script>
	
</body>

</html>
<?php
		} else { // ID not found

			$_SESSION['sys_team_err'] = renderLang($team_team_not_found);
			header('location: /team');

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