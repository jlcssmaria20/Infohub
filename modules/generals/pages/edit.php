<?php
// INCLUDES
$module = 'generals'; $prefix = 'general'; $process = 'edit';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

unset($_SESSION['add_team_success']);
$update_user_success = 'update_user_success';

		// get module icon
		include($root.'/includes/support/get-module-icon.php');

				
		$fields = array(
			'user_id',
			'teams', 
			'stats'
		);
	
			
	
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
					
					
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Update Teams</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<!-- USERNAME -->
									<!-- <div class="col-lg-3 col-md-4 col-sm-2"> -->
										<?php 
											$sql = $pdo->prepare("SELECT * FROM search_tbl");
											$sql->execute();
											$row = $sql->fetchAll(PDO::FETCH_ASSOC);
											foreach($row as $data) {
												echo '<form style="width: 45%; margin-right:50px;" method="post" action="/submit-edit-team" enctype="multipart/form-data">';
													echo '<input type="hidden" name="id" value="'.$data['id'].'">';
													echo '<input style="float:left; width: 82%; margin: 10px;" type="text" name="team" value="'.$data['team'].'" class="form-control required"><br>';
													echo '<a href="javascript:void(0)" class="js-modal btn btn-danger" data-target="myModal" style="float:right; margin-top: -9px; margin-left:10px;" ><i class="fa fa-trash mr-2"></i>';
													echo '<p style="position: absolute;" data1="'.$data['id'].'"> </p>';
													echo '<h4 style="position: absolute;" data="'.$data['team'].'"> </h4>';
													echo '</a>';
													echo '<button style="float:right; margin-top: -9px;" type="submit" class="btn btn-primary"><i class="nav-icon fas fa-edit mr-2"></i></button>';
													
												echo '</form>';
											}
										?>
<!--                                        
									</div> -->
								</div><!-- row -->
							</div><!-- card-body -->

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/<?php echo $module; ?>" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
							
							</div>
						</div><!-- card -->
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->


	<div id="myModal" class="modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title"><?php echo renderLang($modal_delete_confirmation); ?></h4>
				</div>
				<!-- id="form_delete" -->
				<form method="post" >
					<div class="modal-body">
						<h2 >Are you sure you want to delete <b class="modal-name"></b> ?</h2>
						<br>
						<button type="submit" id="submit-delete" class="btn btn-danger btn-delete"><i class="fa fa-check mr-2"></i><?php echo renderLang($modal_confirm_delete); ?></button>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" id="close"><i class="fa fa-times mr-2"></i><?php echo renderLang($modal_cancel); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div><!-- modal -->
		<script src="/assets/js/jquery.js"></script>
		<?php require($root.'/includes/common/footer.php');
		
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

?>
    <script>
	// Get the modal1
	$('.js-modal').on('click', function() {
		var modalTarget = $(this).attr('data-target');
		var modalname = $(this).find('h4').attr('data');
		var modalIDs = $(this).find('p').attr('data1');

		$('#'+ modalTarget).show();
		$('#'+ modalTarget).find('.modal-name').html(modalname)
		$('#'+ modalTarget).find('.modal-id').html(modalIDs)

		$("#submit-delete").click(function () {
			location.href = 'delete-general/'+ modalIDs +'';
			return false;
		});


	});

	$('#close').on('click', function() {
		$("#myModal").attr("style", "display: none !important");
	});

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
