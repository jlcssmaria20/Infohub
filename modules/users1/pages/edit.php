<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$update_user_success = 'update_user_success';

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		// get module icon
		include($root.'/includes/support/get-module-icon.php');

				
		$fields = array(
			'uname',
			'upass', 
			'employeeid', 
			'date_start',
			'firstname',
			'middlename',
			'lastname',
			'gender', 
			'civil_status',	
			'email',	
			'mobile',
			'photo',
			'status',
			'temp_del',
			'access_role',
		);
		// get id
		$id = decryptID($_GET['id']);
		
		$sql = $pdo->prepare("SELECT * FROM ".$module." WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {

			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$delete = $data['firstname'].' '.$data['lastname'];
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
	<title><?php echo 'Add users' ?> &middot; <?php echo renderLang($sitename); ?></title>
	
	<?php require($root.'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="/modules/<?php echo $module; ?>/assets/css/style.css">
	<style>
	img.imageThumb {
		width: 218px;
	}
	input#files {
		width: 83px;
		float: left;
	}
	</style>
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
					<?php 
					if(isset($_SESSION['update_user_success'])) {
					?>
						<div id="add-web-event-success" class="alert alert-success"><h5><i class="icon fas fa-check"></i>Successfully Updated!</div>
					<?php
					} else {
						if(isset($_SESSION['add_user_exist_success']) == 'add_user_exist_success') {
					?>
					<div id="error" class="alert alert-danger"><h5><i class="icon fas fa-times"></i> Error Update!</h5></div>
					<?php
						}
					}
					if(isset($_SESSION['delete_success']) == 'delete_success') {
						unset($_SESSION['restored_success']);
						echo '<div class="alert alert-success"><h5><i class="icon fas fa-check"></i> Successfully Deactivated!</h5></div>';
					}
					if(isset($_SESSION['restored_success']) == 'restored_success') {
						unset($_SESSION['delete_success']);
						echo '<div class="alert alert-success"><h5><i class="icon fas fa-check"></i> Successfully Reactivated!</h5></div>';
					}
					?>
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php //include($root.'/includes/common/notifications-process-add.php'); ?>
					
					<form method="post" action="/submit-edit-user" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Update User</h3>
								<div class="card-tools">
								<?php if(checkPermission($module.'-delete') && $data['status'] != 1) { ?>
										<button type="button" class="btn btn-danger btn-confirm-delete" data-toggle="modal" data-target="#modal-confirm-delete"><i class="fa fa-recycle mr-2"></i>Deactivate</button>
									<?php } else {
									if(checkPermission($module.'-restore')) { ?>
										<a href="/restore-user/list/<?php echo encryptID($id)?>" class="btn btn-success btn-confirm-restore"><i class="fa fa-sync mr-2"></i>Reactivate <?php echo $data['firstname'].' '.$data['lastname']; ?></a>
									<?php } } ?>
								</div>
							</div>
							<div class="card-body">
								<h4>Account Details</h4><hr>
								<div class="row">
								
									<!-- USERNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">User Name</label> 
                                        <input type="text" name="uname" value="<?php echo $data['uname'] ?>" class="form-control required" id="uname" placeholder="User Name" required="" maxlength="20">
									</div>

									<!-- EMPLOYEE ID -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Employee ID</label> 
                                        <input type="text" name="employeeid" value="<?php echo $data['employeeid'] ?>" class="form-control required" id="uname" placeholder="Employee ID" required="" maxlength="20">
									</div>

										<!-- DATE START -->
										<div class="col-lg-3 col-md-4 col-sm-6">
										<label for="officeLocation" class="mr-1">Date Start</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="far fa-calendar-alt"></i>
												</span>
											</div>
											<?php $var = $data['date_start'];?>
                                            <input type="text" class="form-control" id="date_start" name="date_start" value="<?php echo date("m/d/Y", strtotime($var) ) ?>" >
										</div>
									</div>

								</div><!-- row -->
								<br>
								<div class="row">
									<!-- skills -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Skills</label> 
                                        <input type="text" name="skills" value="<?php echo $data['skills']; ?>" class="form-control required" id="skills" placeholder="Enter Skills" required="">
									</div>


									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Team</label> 
										<select name="team" class="form-control required" id="team">
											<?php 
											echo '<option value="'.$data['team'].'">'.$data['team'].'</option>';
											$sql = $pdo->prepare("SELECT * FROM search_tbl");
											$sql->execute();
											$row = $sql->fetchAll(PDO::FETCH_ASSOC);
											foreach($row as $data1) {
												echo '<option value="'.$data1['team'].'">'.$data1['team'].'</option>';
											}
											?>
										</select>
									</div>

									<!-- Position -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Position</label> 
                                        <input type="text" name="position" value="<?php echo $data['position']; ?>" class="form-control required" id="position" placeholder="Position" required="" maxlength="20">
									</div>
								</div>
								<br>
								<div class="row">
									<!-- Short Details -->
									<div class="col-lg-9 col-md-9 col-sm-2">
										<label class="mr-1">Short Details</label> 
                                        <input type="text" name="personal_details" value="<?php echo $data['personal_details']; ?>" class="form-control required" id="details" placeholder="Short Details" required="">
									</div>
								</div>
								<br>
								<hr>

								<h4>Personal Details</h4>
							
								<div class="row">
									<!-- FIRSTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">First name</label> 
										<input type="text" name="firstname" value="<?php echo $data['firstname'] ?>" class="form-control required" id="firstname" placeholder="First Name" required="" maxlength="20">
									</div>

									<!-- MIDDLENAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Middle name</label> 
                                        <input type="text" name="middlename" value="<?php echo $data['middlename'] ?>" class="form-control" id="midlename" placeholder="Middle Name" maxlength="20">
									</div>

									<!-- LASTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Last Name</label> 
                                        <input type="text" name="lastname" value="<?php echo $data['lastname'] ?>" class="form-control required" id="lastname" placeholder="Last Name" required="" maxlength="20">
									</div>		

								</div><!-- row -->
								
								<br>
								<div class="row">
									<div class="col-lg-12">
                                        <label class="mr-1">Image</label> 
                                        <div class="field">
                                            <span>
											<input type="hidden" name="id" value="<?php echo $id ?>">
											<input type="file" id="files" name="filename" style="width:85px;height:40px;" >
											</span>
                                        </div>
										<div class="row">
											<div class="field" >
												<?php 
													if($data['photo'] != '') {
															echo '<img src="/assets/uploadimages/'.$data['photo'].'" style="float:right;width:250px;height: 200px;" alt="'.$data['photo'].'">';
													} else { }
												?>
											</div>
										</div>
									</div>

								</div><!-- row -->

								<hr>

								<h4>Contact Information</h4>
								<div class="row">
									<!-- EMAIL -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Email</label> 
                                        <input type="text" name="email" value="<?php echo $data['email']; ?>" class="form-control required" id="email" placeholder="Email" required=""  maxlength="40">
									</div>

									<!-- MOBILE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Mobile</label> 
                                        <input type="text" name="mobile" value="<?php echo $data['mobile']; ?>" class="form-control required" id="mobile" placeholder="Mobile" required="" maxlength="13">
									</div>

								</div><!-- row -->
								<hr>

								<div class="row">
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Role</label> 
										<select id="" name="roleids" class="form-control required">
										<option value="<?php echo $data['roleids']; ?>">
												<?php 
												switch($data['roleids']) {
													case $data['roleids'] == ',1,':
														echo 'Admin';
														break;
													  case $data['roleids'] == ',2,':
														echo 'User';
														break;
													  default:
												}
												?>
											</option>
											<option value=",1,">Admin</option>
											<option value=",2,">User</option>
										</select>
									</div>
								</div>

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/<?php echo $module; ?>" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modal-confirm-edit"><i class="fa fa-recycle mr-2"></i>Update User</button>
							</div>
							<div class="modal fade" id="modal-confirm-edit">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header bg-warning">
										<h4 class="modal-title"><?php echo 'Update Confirmation'; ?></h4>
									</div>
										<input type="hidden" name="id" value="<?php echo encryptID($id); ?>">
										<div class="modal-body">
											<h2>Do you really want to update <?php echo $delete; ?>?</h2>
											<br>
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Update User</button>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-2"></i><?php echo renderLang($modal_cancel); ?></button>
										</div>
								</div>
							</div>
						</div><!-- modal -->
						</div><!-- card -->
					</form>
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($root.'/includes/common/footer.php');
			include($root.'/includes/common/modal-delete-user.php');
		
		if(isset($_SESSION['update_user_success']) == $update_user_success) { 
		?>
		<script>
			$("div#update_user_success").html();
			$("div#update_user_success").css("display","block");
		</script>
		<?php
		} else {
			if(isset($_SESSION['add_user_exist_success']) != $update_user_success) { 
		?>
		<script>
			$("div#error").html();
			$("div#error").css("display","block");
		</script>
		<?php
		}}
		?>




		
		
	</div><!-- wrapper -->

	<?php require($root.'/includes/common/js.php'); ?>
	<script src="/plugins/moment/moment.min.js"></script>
	<script src="/plugins/daterangepicker/daterangepicker.js"></script>
	
	<script>
		$(function() {
			
			$('#date_start').daterangepicker({
				singleDatePicker: true
			});
			
			// populate roles
			$('.roles-list li a').click(function(e) {
				e.preventDefault();
				
				$(this).toggleClass('btn-default').toggleClass('btn-success');
				
				var roles = '';
				var roles_arr = [];
				
				$('.roles-list li a').each(function() {
					if($(this).hasClass('btn-success')) {
						roles_arr.push($(this).attr('data-permission-code'));
					}
				});
				
				var roles_val = roles_arr.join(',');
				$('#roleids').val(roles_val);
				
				// required badge toggle
				if(roles_val == '') {
					$('h4 .badge').addClass('badge-danger').removeClass('badge-success');
				} else {
					$('h4 .badge').addClass('badge-success').removeClass('badge-danger');
				}
			});
			
			// clear roles
			$('.btn-clear-roles').click(function(e) {
				e.preventDefault();
				$('.roles-list li a').removeClass('btn-success').addClass('btn-default');
				$('#roleids').val('');
				$('h4 .badge').addClass('badge-danger').removeClass('badge-success');
			});
			
		});
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
    <script>
	$(document).ready(function() {
		if (window.File && window.FileList && window.FileReader) {
			$("#files").on("change", function(e) {
			var files = e.target.files,
				filesLength = files.length;
			for (var i = 0; i < filesLength; i++) {
				var f = files[i]
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
				var file = e.target;
				$("<span class=\"pip\">" +
					"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
					"<br/><span class=\"remove\">Remove image</span>" +
					"</span>").insertAfter("#files");
				$(".remove").click(function(){
					$(this).parent(".pip").remove();
				});
				});
				fileReader.readAsDataURL(f);
			}
			});
		} else {
			alert("Your browser doesn't support to File API")
		}

	}); // end ready

    </script>
	<?php 
	} else { // ID not found

		$_SESSION['sys_'.$module.'_err'] = renderLang(${$module.'_'.$prefix.'_not_found'});
		header('location: /'.$module);

	}?>
