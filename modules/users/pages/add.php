<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$add_user_success = 'add_user_success';


// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		// get module icon
		include($root.'/includes/support/get-module-icon.php');
	
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
					if(isset($_SESSION['add_user_success']) == $add_user_success) {
					?>
						<div id="add-web-event-success" class="alert alert-success"><h5><i class="icon fas fa-check"></i>Successfully Added!</div>
					<?php
					} else {
						if(isset($_SESSION['add_user_exist_success']) == 'add_user_exist_success') {
							unset($_SESSION['cpassword']);
					?>
					<div id="error" class="alert alert-danger"><h5><i class="icon fas fa-times"></i> Account Already Exist!</h5></div>
					<?php
						}
					} if(isset($_SESSION['cpassword']) == 'cpassword') {
						unset($_SESSION['add_user_exist_success']);
						?>
							<div id="add-web-event-success" class="alert alert-warning"><h5><i class="icon fas fa-check"></i>Password Don't Match!</div>
						<?php
						}
					?>
				
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php include($root.'/includes/common/notifications-process-add.php'); ?>
					
					<form method="post" action="/submit-<?php echo $process.'-'.$prefix; ?>" enctype='multipart/form-data'>
						<div class="card">
							<div class="card-header">
							<h3 class="card-title">Add New users</h3>
						</div>

							<div class="card-body">
								<h4>Account Details</h4><hr>
								<div class="row">
								
									<!-- USERNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">User Name</label> 
                                        <input type="text" name="uname" class="form-control required" id="uname" placeholder="User Name" required="" maxlength="20">
									</div>

									<!-- EMPLOYEE ID -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Employee ID</label> 
                                        <input type="text" name="employeeid" class="form-control required" id="uname" placeholder="Emloyee ID" required="" maxlength="20">
									</div>

									<!-- DATE START -->
									<div class="col-lg-3 col-md-4 col-sm-6">
										<label for="officeLocation" class="mr-1">Date Start</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="far fa-calendar-alt"></i>
												</span>
											</div>
											<input type="datepicker" class="form-control" id="date_start" name="date_start" required>
										</div>
									</div>

								</div><!-- row -->
								<br>
								<div class="row">
									<!-- skills -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Skills</label> 
                                        <input type="text" name="skills" class="form-control required" id="skills" placeholder="Enter Skills" required="">
									</div>

									<!-- team -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Team</label> 
										<select name="team" class="form-control required" id="team">
											<?php 
											$sql = $pdo->prepare("SELECT * FROM search_tbl");
											$sql->execute();
											$row = $sql->fetchAll(PDO::FETCH_ASSOC);
											foreach($row as $data) {
												echo '<option value="'.$data['team'].'">'.$data['team'].'</option>';
											}
											?>
										</select>
									</div>

									<!-- Position -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Position</label> 
                                        <input type="text" name="position" class="form-control required" id="position" placeholder="Position" required="" maxlength="20">
									</div>
								</div>
								<br>
								<div class="row">
									<!-- Short Details -->
									<div class="col-lg-9 col-md-9 col-sm-2">
										<label class="mr-1">Short Details</label> 
                                        <input type="text" name="personal_details" class="form-control required" id="details" placeholder="Short Details" required="" >
									</div>
								</div>
								<br>
								<hr>

								<h4>Personal Details</h4>
							
								<div class="row">
									<!-- FIRSTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">First name</label> 
										<input type="text" name="firstname" class="form-control required" id="firstname" placeholder="First Name" required="" maxlength="20">
									</div>

									<!-- MIDDLENAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Middle name</label> 
                                        <input type="text" name="middlename" class="form-control " id="midlename" placeholder="Middle Name" maxlength="20">
									</div>

									<!-- LASTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Last Name</label> 
                                        <input type="text" name="lastname" class="form-control required" id="lastname" placeholder="Last Name" required="" maxlength="20">
									</div>

									<div class="col-lg-3 col-md-4 col-sm-2">
                                        <label class="mr-1">Photo</label> 
                                        <div class="field">
                                            <span>
												<input type="file" id="files" name="filename" class="dropify" required>
                                            </span>
                                        </div>
                                    </div>

								</div><!-- row -->
								<hr>

								<h4>Contact Information</h4>
								<div class="row">
									<!-- EMAIL -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Email</label> 
                                        <input type="text" name="email" class="form-control required" id="email" placeholder="Email" required="" maxlength="40">
									</div>

									<!-- MOBILE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Mobile</label> 
                                        <input type="text" name="mobile" class="form-control required" id="mobile" placeholder="Mobile" required="" maxlength="13">
									</div>

								</div><!-- row -->
								<hr>

								<div class="row">
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Roles</label> 
										<select id="" name="roleids" class="form-control required">
											<option value=",1,">Admin</option>
											<option value=",2,">User</option>
										</select>
									</div>
								</div>

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/<?php echo $module; ?>" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button type="submit" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Add User</button>
							</div>
						</div><!-- card -->
					</form>
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($root.'/includes/common/footer.php');
		
		if(isset($_SESSION['add_user_success']) == $add_user_success) { 
		?>
		<script>
			$("div#add_user_success").html();
			$("div#add_user_success").css("display","block");
		</script>
		<?php
		} else {
			if(isset($_SESSION['add_user_exist_success']) != $add_user_success) { 
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
