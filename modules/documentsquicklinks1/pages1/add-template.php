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
	<title>Add Webinar & Event &middot; <?php echo renderLang($sitename); ?></title>
	
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
                        <h1><i class="nav-icon far fa-image mr-3"></i><?php echo 'Webinar and Events'; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->



            <?php
                $_SESSION['add-tempalate'] = 'Budget Related Forms';
            ?>


			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php include($root.'/includes/common/notifications-process-add.php'); ?>
						<div class="card">
                       
                    



<div id="wrapper">

<div id='menu_div'>

<div id="form_div">
 <form method="post" action="/dx-add" id="file_form" enctype="multipart/form-data">
  <div id="file_div">
   <div>
    <input type="hidden" name="docu_name[]" value="TEXT 01 SAMPLE">
    <input type="text" name="docu_dl[]">
    <input type="file" name="filename[]">
    <input type="button" onclick="add_file();" value="ADD MORE">
   </div>
  </div>
 

</div>

<div class="card-footer text-right">
    <a href="/documents-quick-link" class="btn btn-default"><i class="fa fa-arrow-left mr-2"></i>Back</a>
    <input type="submit" class="btn btn-primary" name="submit_file" value="Add Template">
</div>

</form>








                </div>
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
 $("#file_div").append("<div><input type='hidden' name='docu_name[]' value='TEXT 01 SAMPLE'><input type='text' name='docu_dl[]'><input type='file' name='filename[]'><input type='button' value='REMOVE' onclick=remove_file(this);></div>");
}
function remove_file(ele)
{
 $(ele).parent().remove();
}

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

