<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
		// set page
		$page = 'general';
		
		// get user id
		$id = decryptID($_GET['id'], 'users');
		
		$sql = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id LIMIT 1");
		$sql->bindParam(":user_id",$id);
		$sql->execute();

		// check if ID exists
		if($sql->rowCount()) {

			$data = $sql->fetch(PDO::FETCH_ASSOC);
			
			$team_id = $data['team_id'];
			if(isset($_SESSION['sys_users_edit_team_id_val'])) {
				$team_id = $_SESSION['sys_users_edit_team_id_val'];
				unset($_SESSION['sys_users_edit_team_id_val']);
			}

			$user_employee_id = $data['user_employee_id'];
			if(isset($_SESSION['sys_users_edit_employee_id_val'])) {
				$user_employee_id = $_SESSION['sys_users_edit_employee_id_val'];
				unset($_SESSION['sys_users_edit_employee_id_val']);
			}
			
			$user_nickname = $data['user_nickname'];
			if(isset($_SESSION['sys_users_edit_nickname_val'])) {
				$user_nickname = $_SESSION['sys_users_edit_nickname_val'];
				unset($_SESSION['sys_users_edit_nickname_val']);
			}
			
			$user_firstname = $data['user_firstname'];
			if(isset($_SESSION['sys_users_edit_firstname_val'])) {
				$user_firstname = $_SESSION['sys_users_edit_firstname_val'];
				unset($_SESSION['sys_users_edit_firstname_val']);
			}
			
			$user_middlename = $data['user_middlename'];
			if(isset($_SESSION['sys_users_edit_middlename_val'])) {
				$user_middlename = $_SESSION['sys_users_edit_middlename_val'];
				unset($_SESSION['sys_users_edit_middlename_val']);
			}
			
			$user_lastname = $data['user_lastname'];
			if(isset($_SESSION['sys_users_edit_lastname_val'])) {
				$user_lastname = $_SESSION['sys_users_edit_lastname_val'];
				unset($_SESSION['sys_users_edit_lastname_val']);
			}
			
			$user_gender = $data['user_gender'];
			if(isset($_SESSION['sys_users_edit_gender_val'])) {
				$user_gender = $_SESSION['sys_users_edit_gender_val'];
				unset($_SESSION['sys_users_edit_gender_val']);
			}
			
			$user_mobile = $data['user_mobile'];
			if(isset($_SESSION['sys_users_edit_mobile_val'])) {
				$user_mobile = $_SESSION['sys_users_edit_mobile_val'];
				unset($_SESSION['sys_users_edit_mobile_val']);
			}
			
			$user_email = $data['user_email'];
			if(isset($_SESSION['sys_users_edit_email_val'])) {
				$user_email = $_SESSION['sys_users_edit_email_val'];
				unset($_SESSION['sys_users_edit_email_val']);
			}
			
			$user_level = $data['user_level'];
			if(isset($_SESSION['sys_users_edit_level_val'])) {
				$user_level = $_SESSION['sys_users_edit_level_val'];
				unset($_SESSION['sys_users_edit_level_val']);
			}
			
			$user_position = $data['user_position'];
			if(isset($_SESSION['sys_users_edit_position_val'])) {
				$user_position = $_SESSION['sys_users_edit_position_val'];
				unset($_SESSION['sys_users_edit_position_val']);
			}
			
			$user_status = $data['user_status'];
			if(isset($_SESSION['sys_users_edit_user_status_val'])) {
				$user_status = $_SESSION['sys_users_edit_user_status_val'];
				unset($_SESSION['sys_users_edit_user_status_val']);
			}
			
			$user_hiredate = date('m/d/Y');
			if($data['user_hiredate'] == 0){
				if(isset($_SESSION['sys_users_edit_hiredate_val'])) {
					$user_hiredate = date('m/d/Y',strtotime($_SESSION['sys_users_edit_hiredate_val']));
					unset($_SESSION['sys_users_edit_hiredate_val']);
				}
			} else {
				$user_hiredate = date('m/d/Y',strtotime($data['user_hiredate']));
			}

			$user_enddate = $data['user_enddate'];
			if($user_enddate == 0){
				if(isset($_SESSION['sys_users_edit_enddate_val'])) {
					$user_enddate = date('m/d/Y', strtotime($_SESSION['sys_users_edit_enddate_val']).' +5 years');
					unset($_SESSION['sys_users_edit_enddate_val']);
				}
			} else {
				$user_enddate = date('m/d/Y',strtotime($data['user_enddate']));
			}
			
			$user_mobile = $data['user_mobile'];
			if(isset($_SESSION['sys_users_edit_user_mobile_val'])) {
				$user_mobile = $_SESSION['sys_users_edit_user_mobile_val'];
				unset($_SESSION['sys_users_edit_user_mobile_val']);
			}

			$role_ids = $data['role_ids'];
			if(isset($_SESSION['sys_users_edit_roles_val'])) {
				$role_ids = $_SESSION['sys_users_edit_roles_val'];
			}
			$roles_arr = explode(',',$data['role_ids']);
			foreach($roles_arr as $i => $role) {
				if($role == '') {
					unset($roles_arr[$i]);
				}
			}
			$roles = implode($roles_arr,',');
			$roles_val = $roles;
			unset($_SESSION['sys_users_edit_roles_val']);
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo renderLang($users_edit_user); ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="/assets/css/users.css">
	
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
						<div class="col-sm-6">
							<h1><i class="fa fa-user-secret mr-3"></i><?php echo renderLang($users_edit_user); ?> <small><i class="fa fa-chevron-right ml-2 mr-2"></i></small> <?php  echo '['.$data['user_employee_id'].']'.' '.$data['user_firstname'].' '.$data['user_lastname'];  ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_users_edit_err');
					renderSuccess('sys_users_edit_suc');
					?>
					
					<form method="post" action="/submit-edit-user">
						
						<!-- FORM ID -->
						<input type="hidden" name="id" value="<?= $_GET['id']; ?>">
						
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><?php echo renderLang($users_edit_user_form); ?></h3>
								<div class="card-tools">
									<a class="btn btn-success mr-2" href="/user/<?php echo $_GET['id']; ?>" target="_blank"><i class="fa fa-user mr-2"></i><?php echo renderLang($users_view_profile); ?></a>
									<button type="button" class="btn btn-danger btn-confirm-delete mr-1" data-toggle="modal" data-target="#modal-confirm-delete"><i class="fa fa-trash mr-2"></i><?php echo renderLang($users_delete_user); ?></button>
								</div>
							</div>
							<div class="card-body">
								
								<div class="row">
									
									<!-- USER STATUS -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_users_edit_user_status_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="user_status" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($lang_status); ?></label> <span class="right badge badge-success"><?php echo renderLang($label_required); ?></span>
											<select class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="user_status" name="user_status" required>
												<?php
												foreach($status_arr as $status) {
													echo '<option value="'.$status[0].'"';
													if($user_status == $status[0]) {
														echo ' selected';
													}
													echo '>'.renderLang($status[1]).'</option>';
												}
												?>
											</select>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_user_status_err'].'</p>'; unset($_SESSION['sys_users_edit_user_status_err']); } ?>
										</div>
									</div>
								</div>

								<div class="row">

									<!-- team -->
									<div class="col-lg-6 col-md-8 col-sm-4">
										<?php $err = isset($_SESSION['sys_users_edit_team_id_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="team_id" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_center_department_team_team); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<select class="form-control select2 required<?php if($err) { echo ' is-invalid'; } ?>" id="team_id" name="team_id" required>
												<?php
												$selected_center_id = 0;
												$center_filter = '';
												if($_SESSION['sys_account_mode'] == 'user') {
													if(isset($_SESSION['sys_center_id'])){
														$selected_center_id = $_SESSION['sys_center_id'];
													} else {
														$selected_center_id = $data['center_id'];
													}
													$center_filter = ' AND teams.center_id = '.$selected_center_id;
												}
												$select_val = $team_id;
												if($select_val == 0) {
													switch($data['center_id']) {
														case 1:
															$select_val = 51;
															break;
														case 4:
															$select_val = 46;
															break;
														case 5:
															$select_val = 55;
															break;
														case 6:
															$select_val = 53;
															break;
														case 7:
															$select_val = 45;
															break;
														case 9:
															$select_val = 49;
															break;
														case 10:
															$select_val = 50;
															break;
														case 11:
															$select_val = 52;
															break;
														case 12:
															$select_val = 54;
															break;
														case 13:
															$select_val = 47;
															break;
														case 14:
															$select_val = 48;
															break;
													}
												}
												
												$sql = $pdo->prepare("SELECT *
													FROM teams
													LEFT JOIN teams ON teams.team_id = teams.team_id
													LEFT JOIN departments ON teams.department_id = departments.department_id
													LEFT JOIN centers ON teams.center_id = centers.center_id
													WHERE teams.temp_del = 0".$center_filter."
													ORDER BY  departments.department_code ASC");
												$sql->execute();
			
												$data_teams = $sql->fetchAll(PDO::FETCH_ASSOC);
												$sql_c_c = $pdo->prepare("SELECT center_code FROM centers WHERE center_id = ".$data['center_id']."");
												$sql_c_c->execute();
												$center_code = $sql_c_c->fetch(PDO::FETCH_ASSOC)['center_code'];

												$term = $center_code;
												usort($data_teams, function ($a, $b) use ($term) {
													$t1 = preg_match("/^.*?\b($term\w*)\b.*\$/i", $a['center_code'], $matches) ? $matches[1] : '';
													$t2 = preg_match("/^.*?\b($term\w*)\b.*\$/i", $b['center_code'], $matches) ? $matches[1] : '';
													if ($t1 == '' && $t2 != '') return 1;
													if ($t1 != '' && $t2 == '') return -1;
													if ($t1 != $t2) return strcmp($t1, $t2);
													return strcmp($a['center_code'], $b['center_code']);
												});

												foreach($data_teams as $data) {
													echo '<option value="'.$data['team_id'].'"';
													if($select_val == $data['team_id']) {
														echo ' selected="selected"';
													}
													echo '>';
													if(checkAccountMode('admin')) {
														echo $data['center_code'].' - ';
													}
													echo $data['department_code'].' - '.$data['team_code'].' - '.$data['team_name'].'</option>';
//													echo '['.$data['department_id'].'] '.$data['department_code'].' - ['.$data['team_id'].'] '.$data['team_code'].' - ['.$data['team_id'].'] '.$data['team_name'].'</option>';
												}
												?>
											</select>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_team_id_err'].'</p>'; unset($_SESSION['sys_users_edit_team_id_err']); } ?>
										</div>
									</div>

									<!-- EMPLOYEE ID -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_users_edit_employee_id_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="employee_id" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_employee_id); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" minlength="4" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="employee_id" name="employee_id" placeholder="<?php echo renderLang($users_employee_id_placeholder); ?>" value="<?php echo $user_employee_id; ?>" required>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_employee_id_err'].'</p>'; unset($_SESSION['sys_users_edit_employee_id_err']); } ?>
										</div>
									</div>

								</div>

								<div class="row">

									<!-- EMAIL -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$user_email_err = 0;
										if(isset($_SESSION['sys_users_edit_email_err'])) { $user_email_err = 1; }
										?>
										<div class="form-group">
											<label for="email" class="mr-1<?php if($user_email_err) { echo ' text-danger'; } ?>"><?php if($user_email_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_email); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="email" minlength="5" class="form-control required<?php if($user_email_err) { echo ' is-invalid'; } ?>" id="email" name="email" placeholder="<?php echo renderLang($users_email_placeholder); ?>" value="<?php echo $user_email; ?>" required>
											<?php if($user_email_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_email_err'].'</p>'; unset($_SESSION['sys_users_edit_email_err']); } ?>
										</div>
									</div>

									<!-- LEVEL -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$level_err = 0;
										if(isset($_SESSION['sys_users_edit_level_err'])) { $level_err = 1; }
										?>
										<div class="form-group">
											<label for="level" class="mr-1<?php if($level_err) { echo ' text-danger'; } ?>"><?php if($level_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_level); ?></label> <span class="right badge badge-success"><?php echo renderLang($label_required); ?></span>
											<select class="form-control" name="level">
												<?php
												echo '<option value="0"';
												if($user_level == 0) {
													echo ' selected';
												}
												echo '>TBD</option>';
												for($x=1;$x<=5;$x++) {
													echo '<option value="'.$x.'"';
													if($user_level == $x) {
														echo ' selected';
													}
													echo '>'.$x.'</option>';
												}
												?>
											</select>
											<?php if($level_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_level_err'].'</p>'; unset($_SESSION['sys_users_edit_level_err']); } ?>
										</div>
									</div>
									
									<!--POSITION-->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
											$position_err = 0;
											if(isset($_SESSION['sys_users_add_position_err'])) { $position_err = 1; }
										?>
										<div class="form-group">
											<label for="position_id" class="mr-1<?php if($position_err) { echo ' text-danger'; } ?>"><?php if($position_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_position); ?></label> <span class="right badge badge-success"><?php echo renderLang($label_required); ?></span>
											<select class="form-control select2 required<?php if($err) { echo ' is-invalid'; } ?>" id="position_id" name="position_id" required>
												<?php
													$sql = $pdo->prepare("SELECT * FROM positions ORDER BY position_name ASC");
													$sql->execute();
													while($data=$sql->fetch(PDO::FETCH_ASSOC)){
														echo '<option value="'.$data['position_id'].'"';
														if($user_position == $data['position_id']){
															echo ' selected';
														}
														echo '>'.$data['position_name'].'</option>';
													}
												?>
											</select>
											<?php if($position_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_position_err'].'</p>'; unset($_SESSION['sys_users_edit_position_err']); } ?>
										</div>
									</div>

								</div><!-- row -->
								<div class="row">


									<!-- HIRE DATE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php $err = isset($_SESSION['sys_users_edit_hiredate_err']) ? 1 : 0; ?>
										<div class="form-group">
											<label for="mistake_datecode" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_hiredate); ?></label>
											<span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
												</div>

												<input type="text" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask="" im-insert="false" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="user_hiredate" name="user_hiredate" value="<?php echo $user_hiredate; ?>">

												<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_hiredate_err'].'</p>'; unset($_SESSION['sys_users_edit_hiredate_err']); } ?>
											</div>
										</div>
									</div>
									<!-- END DATE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<div class="form-group">
											<label for="user_enddate" class="mr-1"><?php echo renderLang($users_enddate); ?></label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
												</div>
												<input autocomplete="off" type="text" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask="" im-insert="false" class="form-control required" id="user_enddate" name="user_enddate" value="<?php echo $user_enddate; ?>">
											</div>
										</div>
									</div>
								</div>

								<hr>
								
								<div class="row">
									<!-- NICKNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$nickname_err = 0;
										if(isset($_SESSION['sys_users_edit_nickname_err'])) { $nickname_err = 1; }
										?>
										<div class="form-group">
											<label for="nickname" class="mr-1<?php if($nickname_err) { echo ' text-danger'; } ?>"><?php if($nickname_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_nickname); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($nickname_err) { echo ' is-invalid'; } ?>" id="nickname" name="nickname" placeholder="<?php echo renderLang($users_nickname_placeholder); ?>" value="<?php echo $user_nickname; ?>" required>
											<?php if($nickname_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_nickname_err'].'</p>'; unset($_SESSION['sys_users_edit_nickname_err']); } ?>
										</div>
									</div>
								</div>

								<div class="row">

									<!-- FIRSTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$firstname_err = 0;
										if(isset($_SESSION['sys_users_edit_firstname_err'])) { $firstname_err = 1; }
										?>
										<div class="form-group">
											<label for="firstname" class="mr-1<?php if($firstname_err) { echo ' text-danger'; } ?>"><?php if($firstname_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_firstname); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($firstname_err) { echo ' is-invalid'; } ?>" id="firstname" name="firstname" placeholder="<?php echo renderLang($users_firstname_placeholder); ?>" value="<?php echo $user_firstname; ?>" required>
											<?php if($firstname_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_firstname_err'].'</p>'; unset($_SESSION['sys_users_edit_firstname_err']); } ?>
										</div>
									</div>

									<!-- MIDDLENAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$middlename_err = 0;
										if(isset($_SESSION['sys_users_edit_middlename_err'])) { $middlename_err = 1; }
										?>
										<div class="form-group">
											<label for="middlename" class="mr-1<?php if($middlename_err) { echo ' text-danger'; } ?>"><?php if($middlename_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_middlename); ?></label>
											<input type="text" class="form-control<?php if($middlename_err) { echo ' is-invalid'; } ?>" id="middlename" name="middlename" placeholder="<?php echo renderLang($users_middlename_placeholder); ?>" value="<?php echo $user_middlename; ?>">
											<?php if($middlename_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_middlename_err'].'</p>'; unset($_SESSION['sys_users_edit_middlename_err']); } ?>
										</div>
									</div>

									<!-- LASTNAME -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$lastname_err = 0;
										if(isset($_SESSION['sys_users_edit_lastname_err'])) { $lastname_err = 1; }
										?>
										<div class="form-group">
											<label for="lastname" class="mr-1<?php if($lastname_err) { echo ' text-danger'; } ?>"><?php if($lastname_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_lastname); ?></label> <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
											<input type="text" class="form-control required<?php if($lastname_err) { echo ' is-invalid'; } ?>" id="lastname" name="lastname" placeholder="<?php echo renderLang($users_lastname_placeholder); ?>" value="<?php echo $user_lastname; ?>" required>
											<?php if($lastname_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_lastname_err'].'</p>'; unset($_SESSION['sys_users_edit_lastname_err']); } ?>
										</div>
									</div>
									
								</div>
								
								<div class="row">
									
									<!-- GENDER -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$err = 0;
										if(isset($_SESSION['sys_users_edit_gender_err'])) { $err = 1; }
										?>
										<div class="form-group">
											<label for="level" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_gender); ?></label> <span class="right badge badge-success"><?php echo renderLang($label_required); ?></span>

											<select class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="gender" name="gender" required>
												<?php
												foreach($gender_arr as $gender) {
													echo '<option value="'.$gender[0].'"';
													if($user_gender == $gender[0]) {
														echo ' selected';
													}
													echo '>'.renderLang($gender[1]).'</option>';
												}
												?>
											</select>
											<?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_gender_err'].'</p>'; unset($_SESSION['sys_users_edit_gender_err']); } ?>
										</div>
									</div>

									<!-- MOBILE -->
									<div class="col-lg-3 col-md-4 col-sm-2">
										<?php
										$mobile_err = 0;
										if(isset($_SESSION['sys_users_edit_user_mobile_err'])) { $mobile_err = 1; }
										?>
										<div class="form-group">
											<label for="user_mobile"  class="mr-1<?php if($mobile_err) { echo ' text-danger'; } ?>"><?php if($mobile_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($users_mobile); ?></label>
											<input type="text" maxlength="11" class="form-control<?php if($mobile_err) { echo ' is-invalid'; } ?>" id="user_mobile" name="user_mobile" placeholder="<?php echo renderLang($users_mobile_placeholder); ?>" value="<?php echo $user_mobile; ?>">
											<?php if($mobile_err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_users_edit_user_mobile_err'].'</p>'; unset($_SESSION['sys_users_edit_user_mobile_err']); } ?>
										</div>
									</div>

								</div><!-- row -->

								<hr>

								<!-- ROLES -->
								<?php
								$roles_val_arr = array();
								$roles_err = 0;
								if(isset($_SESSION['sys_users_edit_roles_err'])) { $roles_err = 1; }
								?>
								<div class="form-group">
									<h4<?php if($roles_err) { echo ' class="text-danger"'; } ?>><?php if($roles_err) { echo '<i class="far fa-times-circle mr-1"></i>'; } ?><?php echo renderLang($roles_roles); ?> <span class="right badge badge-danger ml-1" style="font-size:10px;"><?php echo renderLang($label_required); ?></span></h4>
									<input type="text" id="role_ids" class="required" name="role_ids" value="<?php echo $roles_val; ?>" required>
									<?php if($roles_err) { echo '<p class="text-danger mt-1">'.$_SESSION['sys_users_edit_roles_err'].'</p>'; unset($_SESSION['sys_users_edit_roles_err']); } ?>
								</div>
								<ul class="roles-list">
									<?php
									if($roles_val != '') {
										$roles_val_arr = explode(',',$roles_val);
									}
									$sql = $pdo->prepare("SELECT * FROM roles WHERE role_id<>1 AND temp_del=0 ORDER BY role_name ASC");
									$sql->execute();
									$roles_count = $sql->rowCount();
									$roles_group_count_max = floor($roles_count/4);
									$roles_group_counter = 0;
									while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
										$btn_design = 'btn-default';
										if(in_array($data['role_id'],$roles_val_arr)) {
											$btn_design = 'btn-success';
										}
										echo '<li><a href="#" class="btn '.$btn_design.' btn-sm" data-permission-code="'.$data['role_id'].'" title="'.$data['role_name'].'">'.$data['role_name'].'</a></li>';
									}
									?>
								</ul>

								<button class="btn btn-default clear mt-2 btn-clear-roles"><i class="fa fa-times mr-2"></i><?php echo renderLang($users_clear_roles); ?></button>

							</div><!-- card-body -->
							<div class="card-footer text-right">
								<a href="/users" class="btn btn-default mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
								<button class="btn btn-primary"><i class="fa fa-upload mr-2"></i><?php echo renderLang($users_update_user); ?></button>
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
	<!-- confirm delete -->
	<div class="modal fade" id="modal-confirm-delete">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-danger">
					<h4 class="modal-title"><?php echo renderLang($modal_delete_confirmation); ?></h4>
				</div>
				<form action="/delete-user" method="post" id="form_delete">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div class="modal-body">
						<p><?php echo renderLang($users_modal_delete_msg1); ?></p>
						<p><?php echo renderLang($users_modal_delete_msg2); ?></p>
						<hr>
						<div class="form-group is-invalid">
							<label for="modal_confirm_delete_upass"><?php echo renderLang($enter_password); ?></label>
							<input type="password" class="form-control required" id="modal_confirm_delete_upass" name="upass" placeholder="<?php echo renderLang($enter_password_placeholder); ?>" required autocomplete="off">
						</div>
						<div class="modal-error alert alert-danger"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times mr-2"></i><?php echo renderLang($modal_cancel); ?></button>
						<input type="submit" class="btn btn-danger btn-delete" value="<?php echo renderLang($modal_confirm_delete); ?>"><!--<i class="fa fa-check mr-2"></i>-->
					</div>
				</form>
			</div>
		</div>
	</div><!-- modal -->

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
	<script src="/plugins/select2/js/select2.full.min.js"></script>
	<script src="/plugins/moment/moment.min.js"></script>
	<script src="/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
	<script>
		$(function() {
			
			
			$('#user_enddate').daterangepicker({
				singleDatePicker: true,
				autoUpdateInput: false,
				showDropdowns: true
			});
			$('#user_enddate').on('apply.daterangepicker', function (ev, picker) {
				$(this).val(picker.startDate.format('MM/DD/YYYY'));
			});
			
			$('#user_hiredate').daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
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
				$('#role_ids').val(roles_val);

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
				$('#role_ids').val('');
				$('h4 .badge').addClass('badge-danger').removeClass('badge-success');
			});

			// confirm delete
			var form_data;
			$('.btn-delete').click(function() {
				$('.btn-delete').prop('disabled', true);
				form_data = $('#form_delete').serialize();
				$('#modal_confirm_delete_upass').val('');
				$('#form_delete').submit();
			});
			$('#form_delete').submit(function(e) {
				e.preventDefault();
				var post_url = $(this).attr("action");
				showLoading()
				$.ajax({
					url: post_url,
					type: 'POST',
					data : form_data
				}).done(function(response){
					hideLoading()
					$('.btn-delete').prop('disabled', false);
					var response_arr = response.split(',');
					if(response_arr[0] == 1) { // val is 1
						window.location.href = '/users';
					} else {
						$('.modal-error')
							.html(response_arr[1]) // val is error message
							.show();
					}
				});
			});
			
		});
	</script>
	
</body>

</html>
<?php
		} else { // ID not found

			// !NEED TRANSLATION
			$_SESSION['sys_users_err'] = renderLang($users_user_not_found);
			header('location: /users');

		}

} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /login');
	
}
?>