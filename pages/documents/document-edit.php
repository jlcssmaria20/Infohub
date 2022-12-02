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
		//get files and put in session
		
		if(!isset($_SESSION['sys_document_edit_file_link_val'])) {
			$files_arr = array();
			$sql = $pdo->prepare("SELECT * FROM files WHERE document_id = :document_id ORDER BY id DESC");
			$sql->bindParam(":document_id", $id);
			$sql->execute();
			while($data_files = $sql->fetch(PDO::FETCH_ASSOC)) {	
				$tmp = array($data_files['file_linkname'],$data_files['file_link']);	
				array_push($files_arr,$tmp);
			}
			$_SESSION['sys_document_edit_file_link_val'] = $files_arr;
		}

		// //print_r($_SESSION['sys_document_edit_file_link_val']);
		// return;

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
			$document_description = $data['document_description'];
			if(isset($_SESSION['sys_document_edit_description_val'])) {
				$document_description = $_SESSION['sys_document_edit_description_val'];
				unset($_SESSION['sys_document_edit_description_val']);
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
	<link rel="icon" type="image/x-icon" href="/assets/images/favicon.png">
    <title><?php echo $dx."Edit Document"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	
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
							<h1><i class="far fa-file-alt mr-3"></i><?php echo renderLang($document_edit); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php  echo $data['document_name']; ?></h1>
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
					
					<form method="post" action="/submit-edit-document/<?php echo encryptID($id); ?>">
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
											<label for="name" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_name_label); ?></label> 
											<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="name" name="name" placeholder="<?php echo renderLang($document_name_placeholder); ?>" value="<?php echo $document_name; ?>" required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_edit_name_err'].'</p>'; unset($_SESSION['sys_document_edit_name_err']); } ?>
										</div>
									</div>
									<!-- FOLDER DESCRIPTION -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_document_edit_description_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="description" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_description_label); ?></label>  
											<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="1" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="description" name="description" placeholder="<?php echo renderLang($document_description_placeholder); ?>" value="<?php echo $document_description; ?>" required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_document_edit_description_err'].'</p>'; unset($_SESSION['sys_document_edit_description_err']); } ?>
										</div>
									</div>
									<!-- DATE CREATED -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<div class="form-group">
											<label for="date_created" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($document_date_created); ?></label> 
											<input type="text" class="form-control" id="date_created" name="date_created" value="<?php echo $data['date_created']; ?>" disabled>
										</div>
									</div>

									<div class="col-lg-3 col-md-4 col-sm-2">
										<div class="mt-3">
											<button type="button" class="mt-3 btn btn-outline-success addmore" name="add" id="add" ><i class="fas fa-plus-square mr-2"></i><?php echo renderLang($document_add_more_link); ?></button>
										</div>
									</div>
								</div>

								<hr>
								<div id="dynamic_field"></div>
								<br>
							

								<div class="" id="link_div">
									<div class="row">
										<div class="col-lg-3">
											<label for="linkname">
												<?php echo renderLang($document_linkname_label) ?>
											</label>
										</div>
										<div class="col-lg-6">
											<label for="link">
												<?php echo renderLang($document_link_label) ?>
											</label>
										</div>
										<div class="col-lg-3">
											<label for="link">
												<?php echo renderLang($document_action) ?>
											</label>
										</div>
									</div>

									<?php 
									if(count($_SESSION['sys_document_edit_file_link_val']) > 0) {
										$count= 0;
										foreach($_SESSION['sys_document_edit_file_link_val'] as $files){  
										$count++;	?>
										
										<div class="row">
											<div class="col-lg-3">
												<div class="form-group">
											
													<input type="text" class="form-control" id="linkname" name="linkname[]" value="<?php echo $files[0] ?>">
													<input type="hidden" name="id'<?php echo $count ?>" value="<?php echo $data['id']?>">
													<input type="hidden" name="folder_id" value="<?php echo $data['id']?>">
												</div>
											</div>	

											
											<div class="col-lg-6">
												<div class="form-group">
													<input type="text" class="form-control" id="link<?php echo $count ?>" name="link[]" value="<?php echo $files[1] ?>">
												</div>
											</div>
											
											<div class="col-lg-3">
												<div>
													<button type="button" onClick="copyLink(<?php echo $count ?>)" class="mr-1 btn btn-outline-primary" name="copy<?php echo $count?>"><i class="fas fa-paperclip mr-2"></i><?php echo renderLang($document_copy) ?></button>
													<a href="#" class="btn btn-outline-danger btn-remove-link"><i class="fas fa-window-close mr-2"></i><?php echo renderLang($document_delete_file) ?></a>
												</div>
											</div>
											</div>


											<?php } ?>
										<?php } ?>
								</div>
							</div>

							<div class="card-footer text-right">
								<a href="/documents" class="btn btn-default text-dark mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-upload mr-2"></i><?php echo renderLang($document_update_document); ?></button>
							</div>
						</div>
					</form>
					
				</div>
			</section>
			
		</div>

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div>

	<!-- MODALS -->
	<!-- DELETE WHOLE DOCUMENT MODAL -->
	<?php if(checkPermission('document-delete')) { ?>
		<div class="modal fade" id="delete_document_modal" data-backdrop="static" data-keyboard="false" aria-modal="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h4 class="modal-title"><?= renderLang($modal_delete_confirmation) ?></h4>
					</div>
					<form action="/submit-delete-document/<?php echo encryptID($id) ?>" method="post" id="form_delete">
						<input type="hidden" name="document_id" id="delete_document_id" value="4">
						<div class="modal-body">
							<p class="m-0"><?php echo renderLang($delete_confirmation_new)." <u><strong class='d-inline-block text-truncate' style='max-width: 230px;'> ".$document_name. "</u></strong> Document?" ?></p>
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
		function remove(row) {
			$("#row" + row).remove();
		}
		//FOR ADDING MORE INPUT FOR linkS
		$(document).ready(function() {
			var i = 1;
			$('#add').click(function() {
				if (i <= 20) {
				$('#dynamic_field').append('<div class="row" data-value="value_' + i + '" id="row' + i + '"> <div id="col" class="col-lg-3"><div class="form-group"><input type="text"  minlength="4" maxlength="50" class="form-control" id="linkname" name="linkname[]" value="" placeholder="<?php echo renderLang($document_linkname_placeholder); ?> ' + i + '" required></div></div>  <div id="col" class="col-lg-3"><div class="form-group"><input type="text" class="form-control" id="link' + i + '" name="link[]" value="" placeholder="<?php echo renderLang($document_link_upload_placeholder); ?> ' + i + '" required> </div></div><div class="col-lg-3"><a href="#" onclick="remove(' + i + ')" class="btn btn-danger btn-remove-field btn-test" title="remove"><i class="fa fa-window-close mr-0"></i></a></div> </div>')
				 
				i++;
				}
			});
			// $(document).on('click', '.btn_remove', function() {
			// 	/* var button_id = $(this).attr("id");
			// 	i--;
			// 	$('#row' + $('#dynamic_field div div div').length).remove();
			// 	if (i<=1) {
			// 	$('.btn_remove').addClass('hidden');
			// 	} */
			// 	$(this).closest('#dynamic_field .row').remove();
			// });
		
			$('.btn-remove-link').click(function(e) {
				e.preventDefault();
				$(this).closest('.row').remove();
			}); 
			
		});
		//FOR DELETING FOLDER
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
		//COPYING LINK
		function copyLink(e) {
			var copyText = document.getElementById(`link${e}`)
			copyText.select();
			copyText.setSelectionRange(0, 99999)
			document.execCommand("copy");
			navigator.clipboard.writeText(copyText.value);
		}
		$("#name").keypress(function(e){ if(e.target.value.length==50){ alert("Ooops. Character limit reached."); } });
		$("#linkname").keypress(function(e){ if(e.target.value.length==50){ alert("Ooops. Character limit reached."); } });
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