
<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {
	
	// check permission to access this page or function
	if(checkPermission('webinar-and-events')) {
	
		// clear sessions from forms
		clearSessions();

		// set page
		$page = 'webinarandevents';
		// set fields from table to search on
		$fields_arr = array('webinar_title','webinar_description','webinar_host','webinar_speaker');
		$search_placeholder = renderLang($webinar_events_title);
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-search.php');
		
		$sql_query = 'SELECT * FROM webinarandevents'.$where; // set sql statement
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-pagination.php');
	
		$users_arr = getTable('users');
		
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
	<title><?php echo $dx."Webinar and Events"; ?></title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> -->
	
</head>

<body class="hold-transition sidebar-mini layout-fixed" >
	
	<!-- WRAPPER -->
	<div class="wrapper">
		
		<?php
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-header.php');
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-sidebar.php');
		?>

		<!-- CONTENT -->
		<div class="content-wrapper" style="">
			
			<!-- CONTENT HEADER -->
			<section class="content-header">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-sm-6 col-12">
							<h1><i class="far fa-calendar-alt mr-3"></i><?php echo renderLang($webinar_events); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content pb-5">
				<div class="container-fluid">
					
					<?php
					renderError('sys_webinar_events_err');
					renderSuccess('sys_webinar_events_suc');
					?>
					
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"><?php echo renderLang($webinar_events_list); ?></h3>
							<div class="card-tools">
								<?php if(checkPermission('webinar-events-add')) { ?><a href="add-webinar-and-events" class="btn btn-primary btn-md"><i class="fa fa-plus mr-2"></i><?php echo renderLang($webinar_events_add); ?></a><?php } ?>
							</div>
						</div>
						<div class="card-body">
							
							<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/search-and-pagination.php'); ?>
							
							<!-- DATA TABLE -->
							<div class="table-responsive">
								<table id="table-data" class="table table-striped table-hover">
									<thead>
										<tr class="text-dark">
											<th style="width:20%"><?php echo renderLang($webinar_events_img); ?></th>
											<th style="width:40%"><?php echo renderLang($webinar_events_title); ?></th>
											<th class="text-center" style="width:15%"><?php echo renderLang($webinar_events_schedule_date); ?></th>
											<th class="text-center" style="width:15%"><?php echo renderLang($created_by); ?></th>
											<th style="width:10%"></th>
										</tr>
									</thead>
									<tbody>
                                    <?php
										$data_count = 0;
										// $sql = $pdo->prepare("SELECT * FROM webinarandevents WHERE temp_del = 0");

                    					$sql = $pdo->prepare("SELECT * FROM webinarandevents ". $where ." ORDER BY date_set DESC LIMIT ".$sql_start.",".$numrows);

										$sql->execute();
										while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

											$data_count++;
											$webinar_id = encryptID($data['id']);

											echo '<tr >';

												// IMAGE
												echo '<td class="align-middle"><img src="assets/images/webinar-and-events/'.$data['webinar_img'].'" class="img-thumbnail p-0"></td>';

												// TITLE
												echo '<td class=" align-middle"><h4 class="font-weight-bold">'.$data['webinar_title'].'</h4>
												<b>'.renderLang($webinar_events_host) .':</b> ';
												
												$hosts = explode(',', $data['webinar_host']);
												foreach($hosts as $host) {
													foreach($users_arr as $user) {
														if($user['user_employee_id'] == $host) {
															echo $user['user_firstname'].' '.$user['user_lastname'] .', ';
															break;
														}
													}
												}
												
																								
												
												//SPEAKER
												echo '<br><b>'.renderLang($webinar_events_speaker) .':</b> ';
												$speakers = explode(',', $data['webinar_speaker']);
												foreach($speakers as $speaker) {
													foreach($users_arr as $user) {
														if($user['user_employee_id'] == $speaker) {
															echo $user['user_firstname'].' '.$user['user_lastname'].', ';
															break;
														}
													}
													if ($user['user_employee_id'] != $speaker) {
														echo $speaker .', ';
													}
												}
												?>
												<?php
												echo '<br><pre style="max-width: 400px;"  class="p-0 text-truncate"><b>'. renderLang($webinar_events_description) .'</b>: '.$data['webinar_description'].'</pre>
												</td>';
												
												// SCHEDULE DATE
												echo '<td class="align-middle text-center">';
													echo $data['date_set'] != 0 ? date('F j, Y',strtotime($data['date_set'])) : 'ー';
													$date = new DateTime($data['date_set']);
													$now = new DateTime();
													
													if($date < $now) {
														echo '<br><span class="right badge badge-primary">Done</span>';
													}else{
														echo '<br><span class="right badge badge-warning">Upcoming</span>';
													}
												echo '</td>';
												// CREATED BY
												echo '<td class="align-middle text-center">';
													foreach($users_arr as $user) {
														if($user['user_id'] == $data['user_id']) {
															echo $user['user_firstname'].' '.$user['user_lastname'];
															break;
														}
													}
													
												echo '<br><em class="text-secondary font-weight-bold text-sm">'.$data['date_created'] .'</em></td>';
															
												// OPTIONS
												echo '<td class="align-middle text-center">';

													// EDIT WEBINAR ANG EVENTS
													if(checkPermission('webinar-events-edit')) {
														echo '<a href="/edit-webinar-and-events/'.$webinar_id.'" class="btn btn-outline-success" title="'.renderLang($webinar_events_edit).'"><i class="fas fa-edit"></i> '.renderLang($edit).'</a>';
													}

												echo '</td>'; // end options

											echo '</tr>';
										}
										?>
									</tbody>
								</table>
							</div><!-- table-responsive -->
							
							<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/pagination-bottom.php'); ?>
							
						</div>
					</div><!-- card -->
					
				</div><!-- container-fluid -->
			</section><!-- content -->
			
		</div>
		

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div>

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
    <!-- DataTables -->
    <!-- <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript">
        $(function(){

            $('#table-data').DataTable({
                "paging": true,
                "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]],
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                iDisplayLength: 25,
                "dom": "<'row'<'col-sm-1'l><'col-sm-3'f><'col-sm-8'p>><'row'<'col-sm-12'tr>><'row'<'col-sm-4'i><'col-sm-8'p>>"
            });
        });
    </script> -->
	
</body>

</html>
<?php
	} else { // permission not found

		$_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
		header('location: /dashboard');

	}
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /login');
	
}
?>