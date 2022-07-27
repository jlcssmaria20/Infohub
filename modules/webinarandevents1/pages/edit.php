<?php
// INCLUDES
$module = 'webinarandevents'; $prefix = 'webinarandevent';  $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission($module.'-'.$process)) {

		// get module icon
		include($root.'/includes/support/get-module-icon.php');
		
		$fields = array(
			'user_id',
			'title', 
			'images', 
			'description',
			'date_set', 
			'date_now',
			'status'		
		);
		// get id
		$id = decryptID($_GET['id']);
		
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

			$delete = $data['title'];
		
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Edit Webinar and Events &middot; <?php echo renderLang($sitename); ?></title>
	
	<?php require($root.'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/modules/<?php echo $module; ?>/assets/css/style.css">
	<link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
	<style>
	.imageThumb {
        height: 200px;
        width: 200px;
        padding: 1px;
        cursor: pointer;
    }
    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
    }
    span.pip {
        display: inline-block;
        padding: 0 2px;
        float: left;
    }
    input#files {
      
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
					
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><i class="nav-icon far fa-image mr-3"></i><?php echo 'Edit Webinar and Events'; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
				<?php
					if(isset($_SESSION['restored_success']) == 'restored_success') {
						unset($_SESSION['delete_success']);
						echo '<div class="alert alert-success"><h5><i class="icon fas fa-check"></i> Successfully Restored!</h5></div>';
					}
				?>
					
					<form method="post" action="/submit-<?php echo $process.'-'.$prefix; ?>" enctype="multipart/form-data">
						
						<!-- FORM ID -->
						<input type="hidden" name="id" value="<?php echo encryptID($id); ?>">
						<input type="hidden" name="src" value="<?php echo $_GET['src']; ?>">
						
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo 'Edit Form'; ?></h3>
								<div class="card-tools">
									<button type="submit" class="btn btn-success btn-md">
										<i class="fa fa-pencil-alt"></i>
										Update Webinar & Event
									</button>
									<?php if(checkPermission($module.'-delete') && $data['status'] != 1) { ?>
										<button type="button" class="btn btn-danger btn-confirm-delete" data-toggle="modal" data-target="#modal-confirm-delete"><i class="fa fa-trash mr-2"></i>Delete</button>
									<?php } else {
									if(checkPermission($module.'-restore')) { ?>
										<a href="/restore-webinarandevent/list/<?php echo encryptID($id)?>" class="btn btn-success btn-confirm-restore"><i class="fa fa-sync mr-2"></i>Restore Details</a>
									<?php } } ?>
								</div>
							</div>
							<div class="card-body">
								<div class="row text-left">
                                    <div class="col-lg-3">
                                        <div class="col-lg-12">
                                            <label class="mr-1">Title</label> 
                                            <input type="text" name="title" class="form-control " id="questions" name="questions" value="<?php echo $data['title']; ?>" >
                                        </div><br>
                                        <div class="col-lg-12">
                                            <label for="officeLocation" class="mr-1">Set Date</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i>
                                                    </span>
                                                </div>
												<?php $var = $data['date_set']; ?>
                                                <input type="text" class="form-control" id="date_start" name="date_set" value="<?php echo date("m/d/Y", strtotime($var) ) ?>" >
											</div>
                                        </div><br>
                                        <div class="col-lg-12">
                                            <label class="mr-1">Date Edited</label> 
                                            <input type="text" disabled class="form-control" name="date_now" value="<?php echo $data['date_now']; ?>">
                                        </div>
                                    </div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="description" class="mr-1">Details</label>
											<textarea class="wysiwyg" name="description" ><?php echo $data['description']; ?></textarea>
										</div>
									</div>
                                    <div class="col-lg-3">
                                        <label class="mr-1">Image</label> 
                                        <div class="field">
                                            <span>
												<input type="file" id="files" name="filename[]" style="width:85px;height:40px;" multiple>
											</span>
                                        </div><br><br>
										<div class="row" style="float: left;">
											<div class="field">
											
												<?php 
													if($data['images'] != '') {
															echo '<img src="/assets/uploadimages/'.$data['images'].'" style="width:250px;height: 200px;" alt="'.$data['images'].'" multiple>';
													} else { }
												?>
											</div>
										</div>
									</div>
									<br>
								</div>
                                <br>
							</div>
							
							<div class="card-footer text-right">
								
								<?php $back_url = $_GET['src'] == 'view' ? '/'.$prefix.'/'.encryptID($id) : '/'.$module; ?>
								<a href="/webinar-and-events" class="btn btn-default"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								
								
							</div><!-- card-footer -->
							
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
			
		});
	</script>
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


		if (window.File && window.FileList && window.FileReader) {
			$("#filechoices1").on("change", function(e) {
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
					"</span>").insertAfter("#filechoices1");
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

		if (window.File && window.FileList && window.FileReader) {
			$("#filechoices2").on("change", function(e) {
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
					"</span>").insertAfter("#filechoices2");
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

		if (window.File && window.FileList && window.FileReader) {
			$("#filechoices3").on("change", function(e) {
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
					"</span>").insertAfter("#filechoices3");
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

		if (window.File && window.FileList && window.FileReader) {
			$("#filechoices4").on("change", function(e) {
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
					"</span>").insertAfter("#filechoices4");
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

		if (window.File && window.FileList && window.FileReader) {
			$("#filechoices5").on("change", function(e) {
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
					"</span>").insertAfter("#filechoices5");
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
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
    <script>
        $(function() {
            $('#date_start').daterangepicker({
                singleDatePicker: true
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
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /');
	
}
?>