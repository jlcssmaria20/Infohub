<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('webinar-events-edit')) {
		include($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-cookie-current-page.php');

		// set page
		$page = 'webinarandevents';
		
		// get webinar_events id
		$id = decryptID($_GET['id']);
		
		$sql = $pdo->prepare("SELECT * FROM webinarandevents WHERE id = :webinar_id LIMIT 1");
		$sql->bindParam(":webinar_id",$id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {

			$data = $sql->fetch(PDO::FETCH_ASSOC);
            
            //echo $data['webinar_events_img'];
            $webinar_img = $data['webinar_img'];

            $host = $data['webinar_host'];
			if(isset($_SESSION['sys_webinar_events_edit_host_val'])) {
				$host = $_SESSION['sys_webinar_events_edit_host_val'];
				unset($_SESSION['sys_webinar_events_edit_host_val']);
			}

            $others = $data['webinar_speaker'];
			if(isset($_SESSION['sys_webinar_events_edit_others_val'])) {
				$others = $_SESSION['sys_webinar_events_edit_others_val'];
				unset($_SESSION['sys_webinar_events_edit_others_val']);
			}
			$title = $data['webinar_title'];
			if(isset($_SESSION['sys_webinar_events_edit_title_val'])) {
				$title = $_SESSION['sys_webinar_events_edit_title_val'];
				unset($_SESSION['sys_webinar_events_edit_title_val']);
			}
			$description = $data['webinar_description'];
			if(isset($_SESSION['sys_webinar_events_edit_description_val'])) {
				$description = $_SESSION['sys_webinar_events_edit_description_val'];
				unset($_SESSION['sys_webinar_events_edit_description_val']);
			}
			$img = $data['webinar_img'];
			if(isset($_SESSION['sys_webinar_events_edit_img_val'])) {
				$img = $_SESSION['sys_webinar_events_edit_img_val'];
				unset($_SESSION['sys_webinar_events_edit_img_val']);
			}

            $schedule_date = date('m/d/Y');
			if($data['date_set'] == 0){
				if(isset($_SESSION['sys_webinar_events_edit_date_val'])) {
					$schedule_date = date('m/d/Y',strtotime($_SESSION['sys_webinar_events_edit_date_val']));
					unset($_SESSION['sys_webinar_events_edit_date_val']);
				}
			} else {
				$schedule_date = date('m/d/Y',strtotime($data['date_set']));
			}
	
			
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="/assets/images/favicon.png">
	<title><?php echo $dx."Edit Webinar and Events"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">

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
						<div class="col">
							<h1><i class="far fa-calendar-alt mr-3"></i><?php echo renderLang($webinar_events_edit); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php  echo $data['webinar_title']; ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_webinar_events_edit_err');
					renderSuccess('sys_webinar_events_edit_suc');
					?>
					
					<form method="post" action="/submit-edit-webinar-and-events/<?php echo encryptID($id) ?>" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($webinar_events_edit_form); ?></h3>
								<div class="card-tools">
									<button type="button" class="btn btn-danger btn-delete mr-1" data-toggle="modal" data-target="#delete_webinar_events_modal"><i class="fa fa-trash mr-2"></i><?php echo renderLang($webinar_events_delete); ?></button>
								</div>
							</div>
							<div class="card-body pb-5">
								<!-- DISPLAY HOST AND SPEAKERS -->
								<div class="row">
									<!-- WEBINAR HOST -->
									<div class="col-4">
										<?php
											$sql = $pdo->prepare("SELECT * FROM webinarandevents WHERE id = " .$id);
											$sql->execute();
											$i = 0;
											while($dataa = $sql->fetch(PDO::FETCH_ASSOC)) {
												$hosts = explode(',', $dataa['webinar_host']);//what will do here
												foreach($hosts as $host) {
												$i++;
												?>
												<div class="row">
													<div class="col-lg-9">
														<?php $err = isset($_SESSION['sys_webinar_events_edit_host_err']) ? 1 : 0; ?>
														<div class="form-group">
															<label for="host" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_host); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
															<select class="w-100 form-control  required" id="host" name="host[]" required>
																<?php
																	$sql = $pdo->prepare("SELECT *
																		FROM users WHERE user_status = 0 AND temp_del = 0 AND role_ids LIKE '%,3,%'");
																	$sql->execute();
																	echo '<option value="" hidden>'.renderLang($webinar_events_select_host).'</option>';
																	while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
																		echo '<option value="'.$data['user_employee_id'].'"';
																		if($host == $data['user_employee_id']){
																			echo ' selected';
																		}
																		echo '>['.$data['user_employee_id'].'] '.$data['user_firstname'].' '.$data['user_lastname'].'</option>';
																	}
																?>
															</select>
															<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_add_host_err'].'</p>'; unset($_SESSION['sys_webinar_events_add_host_err']); } ?>
														</div>
													</div>
													<?php
													if($i == 1){?>
													<!-- ADD HOST BUTTON -->
													<div class="col-lg-2">
														<div class="form-group">
															<label for="">Action</label>
															<button type="button" class="btn btn-outline-success addmorehost form-control" name="addhost" id="addhost" ><i class="fas fa-plus-square"></i></button>
														</div>
													</div>
													<?php 
													}else{
													?>
													<!-- REMOVE HOST BUTTON -->
													<div class="col-lg-2">
														<div class="form-group mt-2">
															<label for="removebutton"></label>
															<button type="button" class="btn btn-outline-danger btn-remove-host form-control" name="removehost" id="removehost" ><i class="fas fa-window-close"></i></button>
														</div>
													</div>
													<?php } ?>
												</div>
												<?php 
												
												}
											}
										?>
									</div>
									<!-- WEBINAR SPEAKER -->
									<div class="col-lg-7">
											<!-- WEBINAR SPEAKER -->
											<?php
												$sql = $pdo->prepare("SELECT * FROM webinarandevents WHERE id = " .$id);
												$sql->execute();
												$i = 0;
												while($dataa = $sql->fetch(PDO::FETCH_ASSOC)) {
													$speakers = explode(',', $dataa['webinar_speaker']);//what will do here
													foreach($speakers as $others) {
													$i++;
													?>
													<div class="row">
														<!-- WEBINAR SPEAKER-->
														<div class="col-lg-5 mx-3">
															<?php $err = isset($_SESSION['sys_webinar_events_edit_speaker_err']) ? 1 : 0; ?>
															<div class="form-group">
																<label for="speaker" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_speaker); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
																<select class="form-control select2 required<?php if($err) { echo ' is-invalid'; } ?>" id="speaker" name="speaker" onchange="yesnoCheck(this);" style="width:250px" required>
																		
																	<?php
																		$sql = $pdo->prepare("SELECT * FROM users WHERE user_status = 0 AND temp_del = 0");
																		$sql->execute();
																		echo '<option value="others"';
																		if($others == "others"){
																			echo ' selected';
																		}
																		echo '>Others</option>';
																	
																		while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
																			echo '<option value="'.$data['user_employee_id'].'" id="'.$data['user_employee_id'].'"';
																			if($others == $data['user_employee_id']){
																				echo ' selected';
																			}
																			echo '>['.$data['user_employee_id'].'] '.$data['user_firstname'].' '.$data['user_lastname'].'</option>';
																		}
																	?>
																</select>
																<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_edit_speaker_err'].'</p>'; unset($_SESSION['sys_webinar_events_edit_speaker_err']); } ?>
															</div>
														</div>

														<!-- WEBINAR SPEAKER OTHERS-->
														<div class="col-lg-5">
															<?php $err = isset($_SESSION['sys_webinar_events_edit_others_err']) ? 1 : 0; ?>
															<?php
															$sql = $pdo->prepare("SELECT user_employee_id FROM users WHERE user_employee_id = :user_employee_id LIMIT 1");
															$sql->bindParam(":user_employee_id",$others);
															$sql->execute();

															// check if ID exists
															if($sql->rowCount()) {

																$user = $sql->fetch(PDO::FETCH_ASSOC);
																?>
																	<div id="ifYes" class="form-group" style="display: none;">
																	<label for="others" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_other); ?></label> 
																	<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
																	<input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="others" name="others[]" placeholder="<?php echo renderLang($webinar_events_other); ?>" value="<?php echo $others; ?>" >
																
																<?php

															}else{?>
																<div id="ifYes" class="form-group" style="display:block;">
																<label for="others" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_other); ?></label> 
																<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
																<input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="others" name="others[]" placeholder="<?php echo renderLang($webinar_events_other); ?>" value="<?php echo $others; ?>" required>
															<?php }	?>
														
																<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_edit_others_err'].'</p>'; unset($_SESSION['sys_webinar_events_edit_others_err']); } ?>
															</div>
														</div>

														<?php
														if($i == 1){?>
														<div class="col-lg-1">
															<div class="form-group">
																<label for="">Action</label>
																<button type="button" class="btn btn-outline-success addmorespeaker form-control" name="addspeaker" id="addspeaker" ><i class="fas fa-plus-square"></i></button>
															</div>
														</div>
														<?php }else{ ?>
														<!-- REMOVE SPEAKER BUTTON -->
														<div class="col-lg-1">
															<div class="form-group mt-2">
																<label for=""></label>
																<button type="button" class="btn btn-outline-danger btn-remove-speaker form-control" name="removespeaker" id="removespeaker" ><i class="fas fa-window-close"></i></button>
															</div>
														</div>
														<?php } ?>
													</div>
													<?php
													}
												}
											?>
											
											
										</div>
									
								</div>

								<!-- ADD MORE HOST AND SPEAKER INPUTS -->
								<div class="row">
									<div class="col-lg-4 mr-3">
										<div id="host_field"></div>
									</div>
									<div class="col-lg-7">
										<div id="speaker_field"></div>
									</div>
								</div>

                                <hr>
                                <div class="row">

                                    <!-- WEBINAR TITLE -->
                                    <div class="col-lg-3">
                                        <?php $err = isset($_SESSION['sys_webinar_events_add_title_err']) ? 1 : 0; ?>
                                        <div class="form-group">
                                            <label for="title" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_title); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
                                            <input type="text" minlength="4" maxlength="100" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="title" name="title" placeholder="<?php echo renderLang($webinar_events_title_placeholder); ?>" value="<?php echo $title; ?>" required>
                                            <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_add_title_err'].'</p>'; unset($_SESSION['sys_webinar_events_add_title_err']); } ?>
                                        </div>

                                    <!-- WEBINAR SCHEDULE DATE-->
                                        <?php $err = isset($_SESSION['sys_webinar_events_add_schedule_date_err']) ? 1 : 0; ?>
                                        <div class="form-group">
                                            <label for="schedule_date" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_schedule_date); ?></label> 
											<span class="right badge badge-success"><?php echo renderLang($label_required); ?></span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control" name="schedule_date" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask="" im-insert="false" value="<?php echo $schedule_date; ?>">
                                            </div>
                                        </div>
                                        <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_add_schedule_date_err'].'</p>'; unset($_SESSION['sys_webinar_events_add_schedule_date_err']); } ?>
                                    </div>

                                    <!-- WEBINAR DESCRIPTION-->
                                    <div class="col-6">
                                        <?php $err = isset($_SESSION['sys_webinar_events_add_description_err']) ? 1 : 0; ?>
                                        <div class="form-group">
                                        	<label for="description" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($webinar_events_description); ?></label> 
											<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
                                            <textarea 
												class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" 
												minlength="4"
												maxlength=2000
												onchange="testLength(this)"
												onkeyup="testLength(this)"
												onpaste="testLength(this)" 
												rows="10" 
												name="description" 
												placeholder="<?php echo renderLang($webinar_events_description_placeholder); ?>"
											><?php echo $description; ?></textarea>
                                        </div>
                                        <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_add_description_err'].'</p>'; unset($_SESSION['sys_webinar_events_add_description_err']); } ?>
                                    </div><!-- /col-->
                    
                                    <!-- WEBINAR IMAGES-->
                                    <div class="col-3">
                                        <?php $err = isset($_SESSION['sys_webinar_events_edit_img_err']) ? 1 : 0; ?>
                                        <div class="form-group">
                                            <label for="img" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($announcements_img_label); ?></label> 
                                            <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input required<?php if($err) { echo ' is-invalid'; } ?>" id="img" name="img" accept="image/*">
                                                <label for="imgs" class="custom-file-label"><?php echo renderLang($webinar_events_img_placeholder); ?></label>
                                                <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_webinar_events_edit_img_err'].'</p>'; unset($_SESSION['sys_webinar_events_edit_img_err']); } ?>
												<input type="hidden" name="file_src" value="<?php echo $webinar_img; ?>">
												<img id="picture_display" class="img-thumbnail  mt-3 w-100" src="/assets/images/webinar-and-events/<?php echo $webinar_img; ?>" style="height:150px;">
                                            </div>
                                        </div>
                                    </div><!-- /col-->

                                </div><!-- /row-->

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/webinarandevents" class="btn btn-default text-dark mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-upload mr-2"></i><?php echo renderLang($webinar_events_update); ?></button>
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
	<?php if(checkPermission('webinar-events-delete')) { ?>
	<!-- MODAL -->
	<div class="modal fade" id="delete_webinar_events_modal" data-backdrop="static" data-keyboard="false" aria-modal="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title"><?= renderLang($modal_delete_confirmation) ?></h4>
				</div>
				<form action="/submit-delete-webinar-and-events/<?php echo encryptID($id) ?>" method="post" id="form_delete">
					<input type="hidden" name="webinar_events_id" id="delete_webinar_events_id" value="4">
					<div class="modal-body">
						<p class="m-0"><?php echo renderLang($delete_confirmation_new)." <u><strong> ".$title. "</u></strong> from webinar and events?" ?></p></p>
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
	
	<script src="/plugins/moment/moment.min.js"></script>
	<script src="/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bs-custom-file-input -->
	<script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
	<script>
		//$('[data-mask]').inputmask();
		
		//$('#summernote').summernote()
		bsCustomFileInput.init();

		var maxLength = 2000;
		function testLength(ta) {
			if(ta.value.length > maxLength) {
				ta.value = ta.value.substring(0, maxLength);
			}
		}

		$('input[name="schedule_date"]').daterangepicker({
			singleDatePicker: true
		});

		function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#picture_display').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

		$("#img").change(function(){
			$('#picture_display').show();
		  readURL(this);
		});

		$("#title").keypress(function(e){ if(e.target.value.length==100){ alert("Ooops. Character limit reached."); } });

		function yesnoCheck(that) {
			if (that.value == "others") {
				document.getElementById("ifYes").style.display = "block";
				document.getElementById("others").required = true;
			} else {
				document.getElementById("ifYes").style.display = "block";
				document.getElementById("others").required = false;
			}
		}
		

		function myFunction(element){
			document.getElementById("others").value = element.options[element.selectedIndex].id;
			if (element.value == "others") {
				document.getElementById("ifYes").style.visibility = "visible";
				document.getElementById("others").required = true;
			} else {
				document.getElementById("ifYes").style.visibility = "hidden";
				document.getElementById("others").required = false;
			}
		}
		function myFunction1(element){
			document.getElementById("others1").value = element.options[element.selectedIndex].id;
			if (element.value == "others") {
				document.getElementById("ifYes1").style.visibility = "visible";
				document.getElementById("others1").required = true;
			} else {
				document.getElementById("ifYes1").style.visibility = "hidden";
				document.getElementById("others1").required = false;
			}
		}
		function myFunction2(element){
			document.getElementById("others2").value = element.options[element.selectedIndex].id;
			if (element.value == "others") {
				document.getElementById("ifYes2").style.visibility = "visible";
				document.getElementById("others2").required = true;
			} else {
				document.getElementById("ifYes2").style.visibility = "hidden";
				document.getElementById("others2").required = false;
			}
		}
		function myFunction3(element){
			document.getElementById("others3").value = element.options[element.selectedIndex].id;
			if (element.value == "others") {
				document.getElementById("ifYes3").style.visibility = "visible";
				document.getElementById("others3").required = true;
			} else {
				document.getElementById("ifYes3").style.visibility = "hidden";
				document.getElementById("others3").required = false;
			}
		}
		
		//ADD AND REMOVE HOST 
		function removeHost(row) {
			$("#row" + row).remove();
		}
		$(document).ready(function() {
			var i = 1;
			$('#addhost').click(function() {
				if (i <= 3) {
				$('#host_field').append('<div class="row" data-value="value_' + i + '" id="row' + i + '"> <div class="col-lg-9"><div class="form-group"><select class="w-100 form-control select2 required<?php if($err) { echo ' is-invalid'; } ?>" id="host' + i + '" name="host[]"required><?php
							$sql = $pdo->prepare("SELECT *
								FROM users WHERE user_status = 0 AND temp_del = 0 AND role_ids LIKE '%,3,%'");
							$sql->execute();
							echo '<option value="" hidden>'.renderLang($webinar_events_select_host).'</option>';
							while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
								echo '<option value="'.$data['user_employee_id'].'"';
								echo '>['.$data['user_employee_id'].'] '.$data['user_firstname'].' '.$data['user_lastname'].'</option>';
							}
						?>
					</select></div></div><a href="#" onclick="removeHost(' + i + ')" class="btn btn-danger  ml-2 mb-3" title="remove"><i class="fa fa-window-close mr-0"></i></a></div>')
				 
				i++;
				
				}
			});
			$('.btn-remove-host').click(function(e) {
				e.preventDefault();
				$(this).closest('.row').remove();
			}); 
				
		});

		
		//ADD AND REMOVE SPEAKER 
		function removeSpeaker(row) {
			$("#row" + row).remove();
		}
		$(document).ready(function() {
			var i = 1;
			$('#addspeaker').click(function() {
				if (i <= 3) {
				$('#speaker_field').append('<div class="row" data-value="value_' + i + '" id="row' + i + '"><div class="col-lg-5 mr-3"><div class="form-group"><select onchange="myFunction' + i + '(this);" class="form-control select2 required<?php if($err) { echo ' is-invalid'; } ?>" id="speaker' + i + '" name="speaker[]" style="width: 250px;" onchange="yesnoCheck(this);" required><?php
					echo '<option value="others"';
					if(isset($_SESSION['sys_webinar_events_add_speaker_val'])) {
						if($_SESSION['sys_webinar_events_add_speaker_val'] == 'others') {
							echo ' selected';
						}
					}
					echo '>Others</option>';
				
					$sql = $pdo->prepare("SELECT * FROM users WHERE user_status = 0 AND temp_del = 0");
					$sql->execute();
					
					while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
						echo '<option value="'.$data['user_employee_id'].'" id="'.$data['user_employee_id'].'"';
						echo '> ['.$data['user_employee_id'].'] '.$data['user_firstname'].' '.$data['user_lastname'].'</option>';
					}
					
				?>
			</select></div></div><div class="col-lg-5"><div id="ifYes'+i+'" class="form-group" style=""><input type="text" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="others' + i + '" name="others[]" placeholder="<?php echo renderLang($webinar_events_other); ?>"<?php if(isset($_SESSION['sys_webinar_events_add_others_val'])) { echo ' value="'.$_SESSION['sys_webinar_events_add_others_val'].'"'; } ?> required ></div></div><div class="col"><a href="#" onclick="removeSpeaker(' + i + ')" class="btn btn-danger  mb-3" title="remove"><i class="fa fa-window-close mr-0"></i></a></div></div>')
				 
				i++;
				
				}
			});	
			$('.btn-remove-speaker').click(function(e) {
				e.preventDefault();
				$(this).closest('.row').remove();
			}); 
			
		});



	</script>
	
</body>

</html>
<?php
		} else { // ID not found

			$_SESSION['sys_webinar_events_err'] = renderLang($webinar_events_webinar_events_not_found);
			header('location: /webinar_events');

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