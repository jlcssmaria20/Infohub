<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
// check if user has existing session
if(checkSession()) {
	$page = 'dashboard';

	$users_arr = getTable('users');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."Dashboard"; ?></title>
	<link rel="stylesheet" href="assets/css/dashboard.css">
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
			<section class="content-header">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-sm-6 col-12">
							<h1><i class="fa fa-tachometer-alt mr-3"></i>Dashboard</h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->
			<!-- Main content -->
			<section class="content m-3">
				<div class="container-fluid">

					<?php renderError('sys_permission_err'); ?>
					
					<div class="row">
						
						<!-- ACTIVE USERS -->
						<div class="col-lg-4 col-4">
							<?php
								$sql = $pdo->prepare("SELECT user_id, user_status FROM users WHERE user_status = 0");
								$sql->execute();
								$active_users = $sql->rowCount();
							?>
							<div class="small-box shadow dash-cardbox user-cardbox text-light">
								<div class="inner pl-4 mb-3">
									<span class="dash-number"><?php echo number_format($active_users,0,'.',','); ?></span><br>
									<?php
									if ($active_users > 1) {
										echo '<span class="dash-title">Active Users</span><br>';
									}else{
										echo '<span class="dash-title">Active User</span><br>';
									}
									?>
									
									<span class="dash-desc"><?php echo "Total number of Info Hub Users"; ?></span>
								</div>
								<div class="icon text-light">
									<i class="fa fa-users"></i>
								</div>
								<?php if(checkPermission('users')) { ?>
									<a href="/users" class="small-box-footer footer-cardbox">
									Know More <i class="fas fa-arrow-circle-right ml-2"></i>
									</a>
								<?php } ?>
							</div>
						</div>
						<!-- WEBINARS -->
						<div class="col-lg-4 col-4">
							<?php
							$sql = $pdo->prepare("SELECT id, webinar_title, webinar_status FROM webinarandevents WHERE webinar_status = 0 ORDER BY date_set DESC LIMIT 1");
							$sql->execute();
							
							while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
							
								$count =  $pdo->prepare("SELECT id, webinar_status FROM webinarandevents WHERE webinar_status = 0 AND date_set > NOW()");
								$count->execute();
								$active_webinars = $count->rowCount();

								echo '<div class="small-box shadow dash-cardbox webinar-cardbox">
										<div class="inner pl-4 mb-2 text-light">';
								echo '<span class="dash-number">'; 
								echo number_format($active_webinars,0,'.',','); 
								echo '</span><br>';

								if ($active_webinars > 1) {
									echo '<span class="dash-title">Upcoming Webinars</span><br>';
									echo '<div class="dash-desc w-75">
									<span class="text-truncate"> ';
									echo 'Title: '. $data['webinar_title'] ;
									echo '</span>
									</div>';
								}else if ($active_webinars == 1) {
									echo '<span class="dash-title">Upcoming Webinar</span><br>';
									echo '<div class="dash-desc w-75">
									<span class="text-truncate"> ';
									echo 'Title: '. $data['webinar_title'] ;
									echo '</span>
									</div>';
								}else {
									echo '<span class="dash-title">No Upcoming Webinars</span><br>';
									echo '<div class="dash-desc w-75">
									<span class="text-truncate"> ';
									echo 'Schedule webinars or events! 🎉 ' ;
									echo '</span>
									</div>';
								}
							}?>
							
									
								</div>
								<div class="icon text-light">
									<i class="fas fa-calendar-alt"></i>
								</div>
								<?php if(checkPermission('webinar-and-events')) { ?>
									<a href="/webinarandevents" class="small-box-footer footer-cardbox">
									Know More <i class="fas fa-arrow-circle-right ml-2"></i>
									</a>
								<?php }?>
							</div>
						</div>
						<!-- ANNOUNCEMENT -->
						<div class="col-lg-4 col-4">
							<?php
								$sql = $pdo->prepare("SELECT id, announcements_title, announcements_status FROM announcements WHERE announcements_status = 0  ORDER BY id DESC LIMIT 1 ");
								$sql->execute();
								
								while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
								
									$count =  $pdo->prepare("SELECT id, announcements_status FROM announcements WHERE announcements_status = 0");
									$count->execute();
									$active_announcements = $count->rowCount();

							?>
							<div class="small-box shadow dash-cardbox announcement-cardbox text-light">
								<div class="inner pl-4 mb-2">
									<span class="dash-number"><?php echo number_format($active_announcements,0,'.',','); ?></span><br>
									<?php
									if ($active_announcements > 1) {
										echo '<span class="dash-title">Announcements</span><br>';
									}else{
										echo '<span class="dash-title">Announcement</span><br>';
									}
									?>
									<div class="dash-desc w-75">
										<span class="text-truncate">Title: <?php echo $data['announcements_title']; ?></span>
									</div>
								</div>
								<div class="icon  text-light">
									<i class="fa fa-bullhorn"></i>
								</div>
								<?php if(checkPermission('users')) { ?>
									<a href="/announcements" class="small-box-footer footer-cardbox">
									Know More <i class="fas fa-arrow-circle-right ml-2"></i>
									</a>
								<?php } } ?>
							</div>
						</div>
						
					
					</div>
					<?php 
					if($_SESSION['sys_account_mode'] == 'user') {
						$isAmbassador = 0;
						$roles_arr = explode(",", $_SESSION['sys_role_ids']);
						if (in_array(1, $roles_arr)){
							$isAmbassador = 1;
						}else if (in_array(2, $roles_arr)){
							$isAmbassador = 1;
						}else if (in_array(3, $roles_arr)){
							$isAmbassador = 1;
						}
					 ?>
					 <?php if($isAmbassador){ ?>
						<div class="row my-4 mx-1">
							<nav class="w-100">
								<div class="nav nav-tabs " id="product-tab" role="tablist">
									<a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true"><h4 class="mt-2 ml-3">Upcoming</h4> </a>
									<a class="nav-item nav-link upcoming" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false"><h4 class="mt-2  ml-3">Accomplished</h4> </a>
								</div>
							</nav>
							<div class="tab-content shadow p-3" id="nav-tabContent" style="width:73%">
								<div class="tab-pane fade show active " id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
									<h5 class="my-3">Here's a list of upcoming webinar and events assigned to you!</h5>
									<table id="table" class="table table-hover">
									
										<tbody>
											<?php
											$data_count = 0;
											$sql = $pdo->prepare("SELECT *
											FROM webinarandevents
											WHERE (FIND_IN_SET(:employee_id, webinar_host) OR FIND_IN_SET(:employee_id, webinar_speaker)) AND temp_del = 0 AND date_set > NOW()
											ORDER BY date_set ASC LIMIT 10");
											$bind_param = array(
												'employee_id' => $_SESSION['sys_employee_id']
											);
											$sql->execute($bind_param);
											if($sql->rowCount() > 0) {

												while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
													$data_count++;
												
												
													echo '<tr>';

													// WEBINAR IMAGE
													echo '<td style="width: 20%;" class="mt-3"><img src="assets/images/webinar-and-events/'.$data['webinar_img'].'" class="w-100 rounded" style="width:150px"></td>';

													// TITLE
													echo '<td class=" align-middle"><h5 class="font-weight-bold">'.$data['webinar_title'].'</h5>
													<b>'.renderLang($webinar_events_host) .':</b> ';
													
													//HOST
													$host_count_handler = 0;
													$hosts = explode(',', $data['webinar_host']);
													foreach($hosts as $host) {
														if ($host == $_SESSION['sys_employee_id']) {
														echo '<span class="badge bg-success font-weight-normal font-weight-normal">';
															foreach($users_arr as $user) {
																if($user['user_employee_id'] == $host) {
																	$hosts_count = count($hosts) - 1;
																	if ($host_count_handler == $hosts_count){
																		echo $user['user_firstname'].' '.$user['user_lastname'] .'</span> ';
																		$host_count_handler = 0;
																	} else {
																		
																		if ($host_count_handler == count($hosts)-2){
																			echo $user['user_firstname'].' '.$user['user_lastname'] .'</span> and ';
																			$host_count_handler++;
																		} else {
																			echo $user['user_firstname'].' '.$user['user_lastname'] .'</span> , ';
																			$host_count_handler++;

																		}
																	}
																}
															}
															
														
														}else{
															foreach($users_arr as $user) {
																if($user['user_employee_id'] == $host) {
																	$hosts_count = count($hosts) - 1;
																	if ($host_count_handler == $hosts_count){
																		echo $user['user_firstname'].' '.$user['user_lastname'].'</span> ';
																		$host_count_handler = 0;
																	} else {
																		if ($host_count_handler == count($hosts)-2){
																			echo $user['user_firstname'].' '.$user['user_lastname'] .'</span>  and ';
																			$host_count_handler++;
																		} else {
																			echo $user['user_firstname'].' '.$user['user_lastname'] .'</span> , ';
																			$host_count_handler++;

																		}
																	}
																}
															}
									
														}
														
													}
													
													//SPEAKER
													echo '<br><b>'.renderLang($webinar_events_speaker) .':</b> ';
													$speakers = explode(',', $data['webinar_speaker']);
													$speaker_count_handler = 0;
													$speakers_arr = count($speakers)-2;
													foreach($speakers as $speaker) {
														if ($speaker == $_SESSION['sys_employee_id']) {
														echo '<span class="badge bg-success font-weight-normal">';
															foreach($users_arr as $user) {
																if($user['user_employee_id'] == $speaker) {
																	echo $user['user_firstname'].' '.$user['user_lastname'].'</span> ';
																	$speaker_count_handler++;
																	break;
																}
															}
															if ($user['user_employee_id'] != $speaker) {
																echo $speaker;
																$speaker_count_handler++;
															}
															echo '</span>';
															if ($speaker_count_handler <= $speakers_arr) {
																echo ', ';
															} else if ($speaker_count_handler == $speakers_arr+1) {
																echo ' and ';
															}
														
														}else{
															foreach($users_arr as $user) {
																if($user['user_employee_id'] == $speaker) {
																	echo $user['user_firstname'].' '.$user['user_lastname'];
																	$speaker_count_handler++;
																	break;
																}
															}
															if ($user['user_employee_id'] != $speaker) {
																echo $speaker;
																$speaker_count_handler++;
															}
															if ($speaker_count_handler <= $speakers_arr) {
																echo ', ';
															} else if ($speaker_count_handler == $speakers_arr+1) {
																echo ' and ';
															}
														}
													}
													?>
													<?php
													echo '
													</td>';
														//WEBINAR SCHEDULE
														echo '<td style="width: 20%;"  class="align-middle text-muted font-weight-bold">';
															echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
														echo '</td>';
													echo '</tr>';
												}
											}else{
												echo 'No webinar and events assigned to you.';
											}
											?>
										</tbody>
									</table>
								</div>
								<div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
									<h5 class="my-3">Here's a list of webinar and events you've done!</h5>
									<table id="table" class="table table-hover">
									
										<tbody>
											<?php
											$data_count = 0;
											
											$sql = $pdo->prepare("SELECT *
												FROM webinarandevents
												WHERE (FIND_IN_SET(:employee_id, webinar_host) OR FIND_IN_SET(:employee_id, webinar_speaker))AND temp_del = 0 AND date_set < NOW()
												ORDER BY date_set ASC LIMIT 10");
												$bind_param = array(
													'employee_id' => $_SESSION['sys_employee_id']
												);
												$sql->execute($bind_param);
												if($sql->rowCount() > 0) {
													while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
														$data_count++;
													
														$webinar_id = encryptID($data['id']);
														echo '<tr>';

														// WEBINAR IMAGE
														echo '<td style="width: 20%;" class="mt-3"><img src="assets/images/webinar-and-events/'.$data['webinar_img'].'" class="w-100 rounded"></td>';

														// TITLE
														echo '<td class=" align-middle"><h5 class="font-weight-bold">'.$data['webinar_title'].'</h5>
														<b>'.renderLang($webinar_events_host) .':</b> ';
														
														//HOST
														$host_count_handler = 0;
														$hosts = explode(',', $data['webinar_host']);
														foreach($hosts as $host) {
															if ($host == $_SESSION['sys_employee_id']) {
															echo '<span class="badge bg-success font-weight-normal">';
																foreach($users_arr as $user) {
																	if($user['user_employee_id'] == $host) {
																		$hosts_count = count($hosts) - 1;
																		if ($host_count_handler == $hosts_count){
																			echo $user['user_firstname'].' '.$user['user_lastname'];
																			$host_count_handler = 0;
																		} else {
																			if ($host_count_handler == count($hosts)-2){
																				echo $user['user_firstname'].' '.$user['user_lastname'] .'</span> and ';
																				$host_count_handler++;
																			} else {
																				echo $user['user_firstname'].' '.$user['user_lastname'] .'</span>, ';
																				$host_count_handler++;
	
																			}
																		}
																	}
																}
															echo '</span>';
															}else{
																foreach($users_arr as $user) {
																	if($user['user_employee_id'] == $host) {
																		$hosts_count = count($hosts) - 1;
																		if ($host_count_handler == $hosts_count){
																			echo $user['user_firstname'].' '.$user['user_lastname'];
																			$host_count_handler = 0;
																		} else {
																			if ($host_count_handler == count($hosts)-2){
																				echo $user['user_firstname'].' '.$user['user_lastname'] .' and ';
																				$host_count_handler++;
																			} else {
																				echo $user['user_firstname'].' '.$user['user_lastname'] .', ';
																				$host_count_handler++;
	
																			}
																		}
																	}
																}
										
															}
														}
														
														//SPEAKER
														echo '<br><b>'.renderLang($webinar_events_speaker) .':</b> ';
														$speakers = explode(',', $data['webinar_speaker']);
														$speaker_count_handler = 0;
														$speakers_arr = count($speakers)-2;
														foreach($speakers as $speaker) {
															if ($speaker == $_SESSION['sys_employee_id']) {
															echo '<span class="badge bg-success font-weight-normal">';
																foreach($users_arr as $user) {
																	if($user['user_employee_id'] == $speaker) {
																		echo $user['user_firstname'].' '.$user['user_lastname'];
																		$speaker_count_handler++;
																		break;
																	}
																}
																echo '</span>';
																if ($user['user_employee_id'] != $speaker) {
																	echo $speaker;
																	$speaker_count_handler++;
																}
																if ($speaker_count_handler <= $speakers_arr) {
																	echo ', ';
																} else if ($speaker_count_handler == $speakers_arr+1) {
																	echo '<span class="text-dark font-weight-normal"> and </span>';
																}
															
															}else{
																foreach($users_arr as $user) {
																	if($user['user_employee_id'] == $speaker) {
																		echo $user['user_firstname'].' '.$user['user_lastname'];
																		$speaker_count_handler++;
																		break;
																	}
																}
																if ($user['user_employee_id'] != $speaker) {
																	echo $speaker;
																	$speaker_count_handler++;
																}
																if ($speaker_count_handler <= $speakers_arr) {
																	echo ', ';
																} else if ($speaker_count_handler == $speakers_arr+1) {
																	echo ' and ';
																}
															}
														}
														?>
														<?php
														echo '
														</td>';
															//WEBINAR SCHEDULE
																			
															echo '<td style="width: 20%;"  class="align-middle text-muted font-weight-bold">';
																echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
															echo '</td>';
														

													
														echo '</tr>';
													}
												}else{
													echo 'No webinar and events assigned to you.';
												}
											?>
										</tbody>
									</table>
								</div>
								
							</div>
						</div>
					<?php }  } ?>	
				</div>
			</section>
			
		</div>
		<!-- /.content-wrapper -->

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
	
</body>

</html>
<?php
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /login');
	
}
?>