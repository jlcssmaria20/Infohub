<?php 
$module = 'documentsquicklinks'; $prefix = 'documentsquicklink'; $process = 'add';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

include($root.'/includes/support/get-module-icon.php');

$documentalreadyexist = 'documentalreadyexist';
$add_document_success = 'add_document_success';

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Add Documents & Quick Link &middot; <?php echo renderLang($sitename); ?></title>
	
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
					<div id="documentalreadyexist" style="display:none;" class="alert alert-warning"><h5><i class="icon fas fa-check"></i>Name of Form Already Exist!</div>
					<?php 
					if(isset($_SESSION['add_document_success']) == 'add_document_success') {
					?>
						<div id="add-web-event-success" style="display:none;" class="alert alert-success"><h5><i class="icon fas fa-check"></i>Successfully Added!</div>
					<?php
					} else {
					?>
					<div id="error" style="display:none;" class="alert alert-danger"><h5><i class="icon fas fa-times"></i> ERROR!</h5></div>
					<?php
					}
					?>
					<div class="row mb-2">
						<div class="col-sm-6">
                        <h1><i class="nav-icon far fa-image mr-3"></i><?php echo 'Add Documents & Quick Link'; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php include($root.'/includes/common/notifications-process-add.php'); ?>

					<form method="post" action="/add-documents-quick-link" id="file_form" enctype="multipart/form-data">
						<div class="card">
                            <div class="card-header">
							    <h3 class="card-title">Add Documents and Quick Links </h3>
							    <div class="card-tools">
								</div>
						    </div>

							<div class="card-body">
								<div class="row text-left">
                                        <div class="col-lg-3">
                                            <label class="mr-1">Name of Form</label> 
                                            <input type="text" name="docu_name" class="form-control required" id="questions" name="questions" placeholder="Name of Form" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="mr-1">Date Add</label> 
                                            <input type="text" disabled class="form-control" value="<?php echo date('F j, Y - l - h:i a', time()); ?>">
                                        </div>
									<br>
								</div>
                                <br>
							<div id="wrapper">
								<div id='menu_div'>
									<div id="form_div">
										<div id="file_div">
											<div class="row text-left">
												<div class="col-lg-3">
													<input type="text" name="docu_dl[]" class="form-control required"  placeholder="Download Name">
												</div>
												<div class="col-lg-3">
													<input type="file" name="filename[]" class="form-control required">
												</div>
												<div class="col-lg-3">
													<input type="button" onclick="add_file();" value="ADD MORE" class="btn btn-success btn-md">
												</div>
											</div>
											<br>
										</div>
									</div>
								</div>
							</div>
								<div class="card-footer text-right">
									<button type="submit" name="submit_file" class="btn btn-primary btn-md">
										<i class="fa fa-plus mr-2"></i>
										Add Documents and Quick Links
                                    </button>
									<a href="/documents-quick-link" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								</div>
							</div>
						</div><!-- card -->
					</form>
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php 
		require($root.'/includes/common/footer.php'); 
		
		?>
		
	</div><!-- wrapper -->

	<?php require($root.'/includes/common/js.php'); 
	if(isset($_SESSION['documentalreadyexist']) == $documentalreadyexist) { 
	?>
	<script>
		$("div#documentalreadyexist").html();
		$("div#documentalreadyexist").css("display","block");
	</script>
	<?php
	}
	if(isset($_SESSION['add_document_success']) == $add_document_success) { 
	?>
	<script>
		$("div#add-web-event-success").html();
		$("div#add-web-event-success").css("display","block");
	</script>
	<?php
	} else {
		if(isset($_SESSION['add_document_success']) != '') { 
	?>
	<script>
		$("div#error").html();
		$("div#error").css("display","block");
	</script>
	<?php
	}}
	?>


    <script>
	function add_file()
	{
	$("#file_div").append("<div class='row text-left' ><div class='col-lg-3'><input type='text' name='docu_dl[]' class='form-control'  placeholder='Download Name'></div><div class='col-lg-3'><input type='file' name='filename[]' class='form-control'></div><div class='col-lg-3'><input type='button' value='REMOVE' class='btn btn-danger btn-md' onclick='remove_file(this);'></div></div><br>");
	}
	function remove_file(ele) {
		$(ele).parent().remove();
	}	
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

