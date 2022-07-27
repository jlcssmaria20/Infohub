<?php
// INCLUDES
$module = 'examadmins'; $prefix = 'examadmin'; $process = 'view';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission($module)) {

		// get module icon
		include($root.'/includes/support/get-module-icon.php');
	
		// clear sessions
		include($root.'/modules/'.$module.'/functions/clear.php');
		
		// get ID
		$id = decryptID($_GET['id']);

		$sql = $pdo->prepare("SELECT * FROM ".$module." WHERE id = :id LIMIT 1");
		$sql->bindParam(":id",$id);
		$sql->execute();
		// check if ID exists
		if($sql->rowCount()) {
			
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			// get current tab
			$current_tab = 'users-list';
			if(isset($_GET['tab'])) {
				$current_tab = $_GET['tab'];
			}
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="SHIFT_JIS">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php renderLang(${$module.'_'.$prefix}); ?> &middot; <?php echo renderLang($sitename); ?></title>
	
	<?php require($root.'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/modules/<?php echo $module; ?>/assets/css/style.css">
	
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
							<h1><i class="<?php echo $page_module_icon; ?> mr-3"></i><?php echo renderLang(${$module.'_'.$prefix}); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php echo '['.$data['applicantname'].'] '.$data['applicantemail']; ?></h1>
						</div>
						<div class="col-sm-6">
							<a href="/<?php echo $module; ?>" class="btn btn-default float-right"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					if($data['status'] == 2 && $data['temp_del'] != 0) {
						$_SESSION['sys_'.$module.'_err'] = renderLang(${$module.'_messages_'.$prefix.'_deleted'});
					} elseif($data['status'] == 1) {
						$_SESSION['sys_'.$module.'_war'] = renderLang(${$module.'_messages_'.$prefix.'_deactivated'});
					}
					renderError('sys_'.$module.'_err');
					// renderWarning('sys_'.$module.'_war');
					renderSuccess('sys_'.$module.'_suc');
					?>
					
					<div class="row">
					<div class="col-sm-6 col-md-4">
						<!-- Users DETAILS -->
						<div class="col-sm-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>User Details</h3>
									<div class="card-tools">
										<?php //renderProfileStatus($data['status']); ?>
									</div>
								</div>
								
								<div class="card-body">
									<table class="table table-data table-bordered">
										<tbody>
											<tr>
												<th><?php echo renderLang(${$module.'_applicantName'}); ?></th>
												<td><?php echo $data['applicantname']; ?></td>
											</tr>
											<tr>
												<th><?php echo renderLang(${$module.'_applicantEmail'}); ?></th>
												<td><?php echo $data['applicantemail']; ?></td>
											</tr>
											<tr>
												<th><?php echo renderLang(${$module.'_dateGenerated'}); ?></th>
												<td><?php echo $data['dategenerated']; ?></td>
											</tr>
											<tr>
												<th><?php echo renderLang(${$module.'_timeGenerated'}); ?></th>
												<td><?php echo $data['timegenerated']; ?></td>
											</tr>
											<tr>
												<th><?php echo renderLang(${$module.'_codeGenerated'}); ?></th>
												<td><?php echo $data['codegenereted']; ?></td>
											</tr>
											<tr>
												<th><?php echo renderLang(${$module.'_codeUsed'}); ?></th>
												<td><?php echo $data['codegeneretedstatus']; ?></td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
						</div><!-- col -->	

					<!-- RETAKE EXAM -->
					<div class="col-sm-12 col-md-12">
							<div class="card">
								<form method="post" action="../reset-limit-retake">
									<div class="card-header">
										<h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Retake Exam</h3>
										<div class="card-tools">
										<?php 
											// $sql = $pdo->prepare("SELECT * FROM exam_user_list WHERE applicant_id = :applicant_id ");
											// $sql->bindParam(":applicant_id",$data['applicant_id']);
											// $sql->execute();
											// while($retake = $sql->fetch(PDO::FETCH_ASSOC)) {
											// 	echo '<input type="hidden" name="ids[]" value="'.$retake['id'].'">';
											// }

											// $sql = $pdo->prepare("SELECT * FROM exam_user_list WHERE applicant_id = :applicant_id ");
											// $sql->bindParam(":applicant_id",$data['applicant_id']);
											// $sql->execute();
											// $retake1 = $sql->fetch(PDO::FETCH_ASSOC);
										?>
											<!-- <input type="hidden" name="id" value="<?php //echo $retake1['id'] ?>">
											<button type="submit" class="btn btn-success"><i class="fas fa-th-large mr-2"></i>Reset </button>	 -->
										</div>
									</div>
								</form>
								<div class="card-header">
									<?php 
									$sql = $pdo->prepare("SELECT * FROM exam_user_list WHERE applicant_id = :applicant_id ");
									$sql->bindParam(":applicant_id",$data['applicant_id']);
									$sql->execute();
									while($data01 = $sql->fetch(PDO::FETCH_ASSOC)) {
										if($data01['exam_status'] == 1) {
									?>
										<table class="table table-data table-bordered">
											<tbody>
												<tr>
													<form method="post" action="../exam-limit-retake">
														<tr>
															<th style="width:170px;">
																<?php echo $data01['exam_name'];?>
															</th>
															<th>
																<textarea name="remarks" placeholder="Remarks" style="width:170px;height:40px;"></textarea>
															</th>
															<th style="width:30px;">
																<input type="hidden" name="id" value="<?php echo $data01['id'] ?>">
																<button type="submit" class="btn btn-primary">Update </button>	
															</th>
														</tr>
													</form>
												</tr>
											</tbody>
										</table>
									<?php } } ?>
									</div>
									<?php 
										$sql = $pdo->prepare("SELECT * FROM exam_user_list WHERE applicant_id = :applicant_id ");
										$sql->bindParam(":applicant_id",$data['applicant_id']);
										$sql->execute();
										while($retake = $sql->fetch(PDO::FETCH_ASSOC)) {
											echo '<input type="hidden" name="ids[]" value="'.$retake['id'].'">';
										}

									?>
							
							</div>
						</div><!-- col -->

						<!-- MODULE DETAILS -->
						<div class="col-sm-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Remove Exam Access</h3>
								</div>
								
								<div class="card-body">
									<table class="table table-data table-bordered">
										<tbody>
											<tr>
											<form method="post" action="">
												<?php 
												$sql = $pdo->prepare("SELECT * FROM exam_user_list WHERE applicant_id = :applicant_id ");
												$sql->bindParam(":applicant_id",$data['applicant_id']);
												$sql->execute();
												while($data3 = $sql->fetch(PDO::FETCH_ASSOC)) {
													if($data3['limit_access'] == 0) {
													
												?>
												<tr><th>
													<?php echo $data3['exam_name'];?>
												</th>
												<th style="width:30px;">
													<a class="btn btn-primary" href="../exam-limit-update/list/<?php echo encryptID($data3['id']); ?>">Update</a>	
												</th></tr>
												<?php } } ?>
											</form>
											</tr>
										</tbody>
									</table>
								</div>

								<div class="card-header">
									<h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Add Exam Access</h3>
								</div>
								
								<div class="card-body">
									<table class="table table-data table-bordered">
										<tbody>
											<tr>
											<form method="post" action="">
											<?php 
												$sql = $pdo->prepare("SELECT * FROM exam_user_list WHERE applicant_id = :applicant_id ");
												$sql->bindParam(":applicant_id",$data['applicant_id']);
												$sql->execute();
												while($data3 = $sql->fetch(PDO::FETCH_ASSOC)) {
													if($data3['limit_access'] == 1) {
													
												?>
												<tr><th>
													<?php echo $data3['exam_name'];?>
												</th>
												<th style="width:30px;">
													<a class="btn btn-primary" href="../exam-limit-update1/list/<?php echo encryptID($data3['id']); ?>">Update</a>	
												</th></tr>
												<?php } } ?>
											</form>
											</tr>
										</tbody>
									</table>
								</div>

							</div>
						</div><!-- col -->
					</div><!-- col left -->

					<div class="col-sm-6 col-md-8">
						<!-- Exam DETAILS -->
						<div class="col-sm-12 col-md-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Exam Details</h3>
									<div class="card-tools">
										<?php //renderProfileStatus($data['status']); ?>
									</div>
								</div>
								<div class="card-body">
									<table class="table table-data table-bordered">
										<tbody>
											<tr>
												<th><?php echo renderLang(${$module.'_examName'}); ?></th>
												<th><?php echo renderLang(${$module.'_dateStart'}); ?></th>
												<th><?php echo renderLang(${$module.'_dateEnd'}); ?></th>
												<th><?php echo renderLang(${$module.'_passingScore'}); ?></th>
												<th><?php echo renderLang(${$module.'_totalScore'}); ?></th>
												<th><?php echo renderLang(${$module.'_totalPercent'}); ?></th>
												<th><?php echo renderLang(${$module.'_statusScore'}); ?></th>
											</tr>
											<?php 
										
												$sql = 'SELECT * FROM exam_total WHERE user_id = '.$data['user_id'].'';
												$stmt = $pdo->prepare($sql);
												$stmt->execute();
												$data2 = $stmt->fetchAll();
												foreach ($data2 as $examlist) {

													if($examlist['exam_total_new_retake'] == 0) {
											
												//foreach ar
											?>
											<tr>
												<td><?php echo $examlist['exam_name']; ?></td>
												<td><?php echo $examlist['date_start']; ?></td>
												<td><?php echo $examlist['date_done']; ?></td>
												<td><?php echo $examlist['passingScore']; ?></td>
												<td><?php echo '<b>'.$examlist['total_score'].'</b>'.' Out of '.'<b>'.$examlist['outof'].'</b>'; ?></td>
												<td><?php echo '<b>'.$examlist['total_percent'].'%</b>'; ?></td>
												<td style="width:25px;">
												<?php
													switch($examlist['status']) {
														case 0: $examlist = 'Failed'; break;
														case 1: $examlist = 'Passed'; break;
													}
													switch($examlist) {
														case 'Failed': $text_class = 'danger'; break;
														case 'Passed': $text_class = 'success'; break;
													}
													echo '<span class="text-'.$text_class.'">'.$examlist.'</span>';
													}
												}
												?>
												</td>
											</tr>
											
										</tbody>
									</table>
								
								</div>
							</div>
						</div><!-- col -->

						<!-- History of Applicant -->
						<div class="col-sm-12 col-md-12">
							<form method="POST" action="/other-exam">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Other Exam</h3>
										<div class="card-tools">
											<button name="" class="btn btn-success mr-1"><i class="fa fa-envelope mr-2"></i>Add Other Exam</button>
										</div>
									</div>
									<div class="card-body">
										<div id="otherExam" class="alert alert-success" style="display:none;"><h5><i class="icon fas fa-check"></i> Success!</h5>Add Other Exam successfully.</div>
										<table class="table table-data table-bordered">
										<?php 
											$sql = 'SELECT * FROM exam_total WHERE user_id = '.$data['user_id'].'';
											$stmt = $pdo->prepare($sql);
											$stmt->execute();
											$data3 = $stmt->fetch();
										?>
										<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
										<input type="hidden" name="exam_list_id" value="<?php echo $data3['exam_list_id']; ?>">
										<input type="hidden" name="application_id" value="<?php echo $data3['application_id']; ?>">
										<input type="hidden" name="user_id" value="<?php echo $data3['user_id']; ?>">
											<tbody>
												<tr>
													<th><input type="text" name="exam_name" placeholder="Type of Assessment"></th>
													<th><input type="text" name="date_start" placeholder="Exam Date Taken"></th>
													<th><input type="text" name="date_done" placeholder="Exam End"></th>
													<th><input type="text" name="total_score" placeholder="Total Score"></th>
													<th><input type="text" name="status" placeholder="Assessment Status"></th>
												</tr>
												<tr>
													<th><?php echo 'Type of Assessment'; ?></th>
													<th><?php echo 'Exam Date Taken'; ?></th>
													<th><?php echo 'Exam End'; ?></th>
													<th><?php echo 'Total Score' ?></th>
													<th><?php echo 'Assessment Status' ?></th>
												</tr>
												<?php 
													$sql = 'SELECT * FROM exam_other WHERE user_id = '.$data['user_id'].'';
													$stmt = $pdo->prepare($sql);
													$stmt->execute();
													$data2 = $stmt->fetchAll();
													foreach ($data2 as $examlist) {
												?>
												<tr>
													<td><?php echo $examlist['exam_name']; ?></td>
													<td><?php echo $examlist['date_start']; ?></td>
													<td><?php echo $examlist['date_done']; ?></td>
													<td><?php echo $examlist['total_score']; ?></td>
													<td style="width:90px;">
													<?php
														switch($examlist['status']) {
															case 0: $examlist = 'Failed'; break;
															case 1: $examlist = 'Passed'; break;
														}
														switch($examlist) {
															case 'Failed': $text_class = 'danger'; break;
															case 'Passed': $text_class = 'success'; break;
														}
														echo '<span class="text-'.$text_class.'">'.$examlist.'</span>';
													}
													?>
													</td>
												</tr>
												
											</tbody>
										</table>
									</div>
								</div>
							</form>
						</div>

						<!-- RETAKE EXAM HISTORY -->
						<div class="col-sm-12 col-md-12">
							<form method="POST" action="/other-exam">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Retake Exam</h3>
									</div>
									<div class="card-body">
										<table class="table table-data table-bordered">
											<tbody>
												<tr>
													<th><?php echo 'Exam Retake'; ?></th>
													<th><?php echo 'Date Retake'; ?></th>
													<th><?php echo 'End Retake'; ?></th>
													<th><?php echo 'Percentage ' ?></th>
													<th><?php echo 'Status' ?></th>
													<th><?php echo 'Remarks' ?></th>	
												</tr>
												<?php 
												
													$sql = 'SELECT * FROM exam_user_list LEFT JOIN exam_total ON exam_user_list.exam_list_id=exam_total.exam_list_id WHERE userTcap_id = '.$data['user_id'].' AND user_id = '.$data['user_id'].' AND retake = 1';
													$stmt = $pdo->prepare($sql);
													$stmt->execute();
													while($data02 = $stmt->fetch(PDO::FETCH_ASSOC)) {

														if($data02['exam_total_new_retake'] == 1) {
														
												?>
												<tr>
													<td><?php echo $data02['exam_name']; ?></td>
													<td><?php echo $data02['date_start']; ?></td>
													<td><?php echo $data02['date_done']; ?></td>
													<td><?php echo $data02['total_percent'].'%'; ?></td>
													<td style="width:90px;">
														<?php
														if($data02['total_percent'] != 0) {
															switch($data02['status']) {
																case 0: $status = 'Failed'; break;
																case 1: $status = 'Passed'; break;
															}
															switch($status) {
																case 'Failed': $text_class = 'danger'; break;
																case 'Passed': $text_class = 'success'; break;
															}
															echo '<span class="text-'.$text_class.'">'.$status.'</span>';
														} else {

														}
														?>
													</td>
													<td><?php echo $data02['remarks']; ?></td>
													<?php }}?>
												</tr>
												
											</tbody>
										</table>
									</div>
								</div>
							</form>
							</div>

























					</div><!-- col right -->
				</div><!-- row -->
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($root.'/includes/common/footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($root.'/includes/common/js.php'); ?>
	<script>


		$(function() {
			
			$('.active-users').html('<?php echo number_format($active_users,0,'.',','); ?>');
			$('.deactivated-users').html('<?php echo number_format($deactivated_users,0,'.',','); ?>');
			$('.deleted-users').html('<?php echo number_format($deleted_users,0,'.',','); ?>');
			$('.total-users').html('<?php echo number_format($active_users+$deactivated_users+$deleted_users,0,'.',','); ?>');
			
			$('.user-count').html('[<?php echo number_format($user_count,0,'.',','); ?>]');
			$('.pc-count').html('[<?php echo number_format($pc_count,0,'.',','); ?>]');
			$('.license-count').html('[<?php echo number_format($license_count,0,'.',','); ?>]');
			
			filterTable('.data-filter-users','.users-list-table tbody tr');
			filterTable('.data-filter-pcs','.pcs-list-table tbody tr');
			filterTable('.data-filter-licenses','.licenses-list-table tbody tr');
			
		});
	</script>
	
</body>

</html>
<?php
	if(isset($_SESSION['add-other-exam']) == 'add-other-exam') { 
?>
<script>
	$("div#otherExam").html();
	$("div#otherExam").css("display","block");
</script>
<?php
}
?>	?>
<?php
		} else { // ID not found

			// !NEED TRANSLATION
			$_SESSION['sys_users_err'] = renderLang($users_user_not_found);
			header('location: /users');
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