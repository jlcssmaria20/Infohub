<?php
// INCLUDES
$module = 'users'; $prefix = 'user'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
$update_user_success = 'update_user_success';


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
		'email',	
		'mobile',
		'photo',
		'status',
		'temp_del',
		'access_role',
	);
	// get id
	$id = $_SESSION['sys_data']['id'];
		
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
	<title><?php echo $module.' Dashboard'; ?> &middot; <?php echo renderLang($sitename); ?></title>
	
	<?php require($root.'/includes/common/links.php'); ?>
	<style>
		@media (min-width: 992px) {
			.sidebar-mini.sidebar-collapse 
			.content-wrapper, 
			.sidebar-mini.sidebar-collapse .main-footer, 
			.sidebar-mini.sidebar-collapse .main-header
			 {
			margin-left: 0 !important; 
		}
	}

	</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
	
	<!-- WRAPPER -->
	<div class="wrapper">
		
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	
	<!-- NAV LEFT -->
	<ul class="navbar-nav">
		
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
		
		<!-- <?php if($_SESSION['sys_data']['id'] == 1) { ?>
		<li class="nav-item">
			<a class="btn btn-default btn-reset-system mr-2" href="#" title=""><i class="fa fa-desktop mr-2"></i>System Reset</a>
		</li>
		<li class="nav-item">
			<a class="btn btn-default btn-reset-users mr-2" href="#" title=""><i class="fa fa-user mr-2"></i>Reset Users</a>
		</li>
		<?php } ?> -->
		<li class="nav-item">
			<p class="server-date"><i class="far fa-calendar-alt mr-2"></i><?php echo renderLang($header_server_date); ?> <?php echo date('F j, Y - l', time()); ?></p>
		</li>
		
	</ul><!-- nav left -->

	<!-- NAV RIGHT -->
	<ul class="navbar-nav ml-auto">
	
		<!-- SETTINGS -->
		<li class="nav-item">
			<a class="nav-link btn-logout" href="/dx-signout" title="<?php echo renderLang($lang_logout); ?>">
				<i class="fa fa-sign-out-alt"></i>
			</a>
		</li>
		
	</ul><!-- nav right -->
	
</nav>
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
						echo '<div class="alert alert-success"><h5><i class="icon fas fa-check"></i> Successfully Deleted!</h5></div>';
					}
					if(isset($_SESSION['restored_success']) == 'restored_success') {
						unset($_SESSION['delete_success']);
						echo '<div class="alert alert-success"><h5><i class="icon fas fa-check"></i> Successfully Restored!</h5></div>';
					}
					?>
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php //include($root.'/includes/common/notifications-process-add.php'); ?>
					
					<form method="post" action="/submit-dx-edit-user" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Update User</h3>
								<div class="card-tools">
								<?php if(checkPermission($module.'-delete') && $data['status'] != 1) { ?>
										<button type="button" class="btn btn-danger btn-confirm-delete" data-toggle="modal" data-target="#modal-confirm-delete"><i class="fa fa-trash mr-2"></i>Remove Details</button>
									<?php } else {
									if(checkPermission($module.'-restore')) { ?>
										<a href="/restore-user/list/<?php echo encryptID($id)?>" class="btn btn-success btn-confirm-restore"><i class="fa fa-sync mr-2"></i>Restore Details</a>
									<?php } } ?>
								</div>
							</div>
							<div class="card-body">
								<h4>Account Details</h4><hr>
								<div class="row">
								
									<!-- USERNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">User Name</label> 
                                        <input type="text" name="uname" value="<?php echo $data['uname'] ?>" class="form-control required" id="uname" placeholder="User Name" required="">
									</div>

									<!-- EMPLOYEE ID -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Employee ID</label> 
                                        <input type="text" name="employeeid" value="<?php echo $data['employeeid'] ?>" class="form-control required" id="uname" placeholder="First Name" required="">
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

									<!-- team -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Team</label> 
                                        <input type="text" name="team" value="<?php echo $data['team']; ?>" class="form-control required" id="team" placeholder="Team" required="">
									</div>

									<!-- Position -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Position</label> 
                                        <input type="text" name="position" value="<?php echo $data['position']; ?>" class="form-control required" id="position" placeholder="Position" required="">
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
										<input type="text" name="firstname" value="<?php echo $data['firstname'] ?>" class="form-control required" id="firstname" placeholder="First Name" required="">
									</div>

									<!-- MIDDLENAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Middle name</label> 
                                        <input type="text" name="middlename" value="<?php echo $data['middlename'] ?>" class="form-control required" id="midlename" placeholder="Middle Name" required="">
									</div>

									<!-- LASTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Last Name</label> 
                                        <input type="text" name="lastname" value="<?php echo $data['lastname']; ?>" class="form-control required" id="lastname" placeholder="Last Name" required="">
									</div>		

								</div><!-- row -->
								
								<br>
								<div class="row">
									<div class="col-lg-12">
                                        <label class="mr-1">Image</label> 
                                        <div class="field">
                                            <span>
											<input type="hidden" name="id" value="<?php echo $id ?>">
											<input type="file" id="files" name="filename" style="width:200px;height:40px;" >
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
                                        <input type="text" name="email" value="<?php echo $data['email']; ?>" class="form-control required" id="email" placeholder="Email" required="">
									</div>

									<!-- MOBILE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<label class="mr-1">Mobile</label> 
                                        <input type="text" name="mobile" value="<?php echo $data['mobile']; ?>" class="form-control required" id="mobile" placeholder="Mobile" required="">
									</div>

								</div><!-- row -->
								<hr>

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<button type="submit" class="btn btn-primary"><i class="fa fa-pencil mr-2"></i>Update Account</button>
							</div>
						</div><!-- card -->
					</form>
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
	<div class="float-right d-none d-sm-block">
		<b>Version</b> 1.0.0
	</div>
	<strong><?php echo renderLang($sitename); ?> by <a href="#">BPO Dev's </a></strong>for a better web ©2020-12-20.
</footer>
	
	
	</div><!-- wrapper -->

	<?php require($root.'/includes/common/js.php'); ?>
	<script src="/plugins/moment/moment.min.js"></script>
	<script src="/plugins/daterangepicker/daterangepicker.js"></script>
	
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
			alert("Your browser doesn't support to File API");
		}

	

	}); // end ready

	<?php if(isset($_SESSION['update_user_success']) == $update_user_success) { ?>
			$("div#update_user_success").html();
			$("div#update_user_success").css("display","block");
	<?php } else {
			if(isset($_SESSION['add_user_exist_success']) != $update_user_success) { ?>
			$("div#error").html();
			$("div#error").css("display","block");
	<?php }} ?>
	
    </script>
	
</body>

</html>
<?php 
	} else { // ID not found

		$_SESSION['sys_'.$module.'_err'] = renderLang(${$module.'_'.$prefix.'_not_found'});
		header('location: /'.$module);

	}
	
?>