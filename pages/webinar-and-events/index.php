
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
		$fields_arr = array('webinar_events_title','webinar_events_description');
		$search_placeholder = renderLang($webinar_events_title_placeholder);
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-search.php');
		
		$sql_query = 'SELECT * FROM webinarandevents'.$where; // set sql statement
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/set-pagination.php');
	
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DX Info Hub Webinar and Events</title>
	
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> -->
	
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
						<div class="col-sm-6 col-12">
							<h1><i class="fa fa-calendar mr-3"></i><?php echo renderLang($webinar_events); ?></h1>
						</div>
					</div>
					
				</div><!-- container-fluid -->
			</section><!-- content-header -->

			<!-- Main content -->
			<section class="content">
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
								<table id="table-data" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th style="width:20%"><?php echo renderLang($webinar_events_title); ?></th>
											<th><?php echo renderLang($webinar_events_img); ?></th>
											<th class="w-50"><?php echo renderLang($webinar_events_description); ?></th>
                                            <th><?php echo renderLang($webinar_events_status); ?></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
                                    <?php
										$data_count = 0;
										// $sql = $pdo->prepare("SELECT * FROM webinarandevents WHERE temp_del = 0");
                                        $sql = $pdo->prepare("SELECT * FROM webinarandevents ". $where ." ORDER BY id ASC LIMIT ".$sql_start.",".$numrows);
										$sql->execute();
										while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

											$data_count++;
											$webinar_id = encryptID($data['id']);

											echo '<tr>';

												// TITLE
												echo '<td><h5>'.$data['webinar_title'].'</h5><br><br><em>'.$data['date_created'].'</em></td>';
												// IMAGE
												echo '<td><img src="assets/images/webinar-and-events/'.$data['webinar_img'].'" class="img-thumbnail"></td>';

												// DESCRIPTION
												echo '<td>'.$data['webinar_description'].'</td>';

                                                // STATUS
												// STATUS
												echo '<td>';
												switch($data['webinar_status']) {
													case 0: $Events = 'Active'; break;
													case 1: $Events = 'Deleted'; break;	
												}
											
												switch($Events) {
													case 'Active': $text_class = 'success'; break;
													case 'Deleted': $text_class = 'danger'; break;
												}
												echo '<span class="text-'.$text_class.'">'.$Events.'</span>';
												echo '</td>';

												// OPTIONS
												echo '<td>';

													// EDIT ANNOUNCEMENTS
													if(checkPermission('webinar-events-edit')) {
														echo '<a href="/edit-webinar-and-events/'.$webinar_id.'" class="btn btn-success btn-sm" title="'.renderLang($webinar_events_edit).'"><i class="fas fa-pencil-alt"></i></a>';
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
		<!-- /.content-wrapper -->

		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div><!-- wrapper -->

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