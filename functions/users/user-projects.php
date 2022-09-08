<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

	// check if user has existing session
	if(checkSession()) {

			// clear sessions from forms
			clearSessions();

			// set page
			$page = 'projects';
			
			$user_id = decryptID($_GET['id'], 'users');
			// set fields from table to search on
			$fields_arr = array('project_code','project_name');
			$search_placeholder = renderLang($projects_project_code).', '.renderLang($projects_project_name);
		
			$keywords = '';
			$where = '';
			$var_k = '';
		
			// set redirect link for clearing search bar

			$redirect_link = $page;
			if(isset($subpage)) {
				$redirect_link = $subpage;
			}

			// get user defined keywords if any
			if(isset($_GET['k'])) {
				$keywords = trim($_GET['k']);
				$var_k = '&k='.urlencode($_GET['k']);
				if($keywords != '') {
					$keywords_arr = explode(' ',$keywords);
				}
			}

			// filter center for USER account mode
			$center_filter = '';
			if(
				$_SESSION['sys_account_mode'] == 'user' && $page != 'roles' && $page != 'ips'
			) {
				$center_filter = " AND ".$page.".center_id = ".$_SESSION['sys_center_id'];
			}

			// if keywords array exists, create the WHERE clause for query
			if(isset($keywords_arr)) {
				foreach($keywords_arr as $keyword) {
					$keyword = str_replace("'","''",$keyword);
					if($where == '') {
						foreach($fields_arr as $field) {
							if($where == '') {
								$where .= " WHERE projects.".$field." LIKE '%".$keyword."%'";
							} else {
								$where .= " OR projects.".$field." LIKE '%".$keyword."%'";
							}
						}
					} else {
						foreach($fields_arr as $field) {
							$where .= " OR projects.".$field." LIKE '%".$keyword."%'";
						}
					}
				}
			} else {
				if($where == '' && $page != 'system-log') {

					 $where = " WHERE ".$page.".temp_del=0";
				}
			}
			$sql_query = "SELECT *
									FROM projects
									JOIN centers ON projects.center_id = centers.center_id
									JOIN project_members ON project_members.project_id = projects.project_id
									".$where." 
									AND project_members.user_id = :user_id
									".$center_filter." LIMIT 1"; // set sql statement
			// set number of rows to display
			$numrows = $_SESSION['sys_data_per_page'];
			$page_ctr = 1; // set as default page count
			if(isset($_GET['p'])) { // check if pagination is clicked
				$page_ctr = $_GET['p'];
			}
			$sql_start = $numrows * ($page_ctr-1); // set start of LIMIT statement
			// get number of users for pagination
			$sql= $pdo->prepare($sql_query);
			$sql->bindParam(":user_id",$user_id);
			$sql->execute();
			$total_data_count = $sql->rowCount(); // get number of rows
			$page_count = ceil($total_data_count/$numrows); // compute for number of pages
			$data_search = $sql->fetch(PDO::FETCH_ASSOC);
			
			
			renderError('sys_projects_err');
			renderSuccess('sys_projects_suc');
			?>

			<div class="card">

				<div class="card-body">

					<!-- SEARCH AND PAGINATION -->
					<div class="row search-and-pagination">
						<div class="col-sm-6 col-md-5">
							<div class="input-group input-group-md mb-3">
								<input type="text" id="search-keywords" class="form-control"<?php if($keywords != '') { echo ' value="'.$keywords.'"'; } ?> placeholder="<?php echo $search_placeholder; ?>">
								<span class="input-group-append">
									<button type="button" id="btn-search" class="btn btn-info btn-flat" title="<?php echo renderLang($btn_search); ?>"><i class="fa fa-search"></i></button>
								</span>
							</div>
						</div>
						<div class="col-sm-6 col-md-7 dataTables_wrapper dt-bootstrap4">
							<a href="/user/<?= $_GET['id'] ?>" class="btn btn-default btn-md float-left mb-3"><?php echo renderLang($btn_clear); ?></a>
							<div class="dataTables_paginate paging_simple_numbers mb-3">
								<ul class="pagination">
									<?php 
										$user_paginate_link = '/user/'.$_GET['id'];
									?>
									<li class="paginate_button page-item previous<?php if($page_ctr == 1) { echo ' disabled'; } ?>"><a href="<?php echo $user_paginate_link.'?p='.($page_ctr-1).$var_k; ?>" class="page-link" data-dt-idx="0" tabindex="0"><?php echo renderLang($btn_previous); ?></a></li>
									<?php
									$page_1 = $page_ctr-2;
									if($page_1 < 1) {
										$page_1 = 1;
									}
									if($page_count > 5) {
										if($page_1 != 1) {
											echo '<li class="paginate_button page-link more disabled"><a href="#">...</a></li>';
										}
									}
									$page_max = $page_1+4;
									if($page_max > $page_count) {
										$page_1 = $page_1 - ($page_max-$page_count);
										$page_max = $page_count;
									}
									if($page_count <= 5) {
										$page_1 = 1;
									}
									for($x=$page_1;$x<=$page_max;$x++) {
										echo '<li class="paginate_button page-item';
										if($x == $page_ctr) {
											echo ' active';
										}
										echo '"><a href="'.$user_paginate_link.'?p='.$x.$var_k.'" class="page-link" data-dt-idx="'.$x.'" tabindex="'.($x-1).'">'.$x.'</a></li>';
									}
									if($page_count > 5) {
										if($page_ctr <= $page_count-3) {
											echo '<li class="paginate_button more disabled"><a href="#" class="page-link">...</a></li>';
										}
									}
									?>
									<li class="paginate_button page-item next<?php if($page_ctr == $page_count) { echo ' disabled'; } ?>"><a href="<?php echo $user_paginate_link.'?p='.($page_ctr+1).$var_k; ?>" class="page-link" data-dt-idx="<?php echo $page_count; ?>" tabindex="0"><?php echo renderLang($btn_next); ?></a></li>
								</ul>
							</div>
						</div>
					</div>

					<!-- DATA TABLE -->
					<div class="table-responsive">
						<table id="table-data" class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th><?php echo renderLang($projects_project_code); ?></th>
									<th><?php echo renderLang($projects_project_name_jp); ?></th>
									<th><?php echo renderLang($projects_start_date); ?></th>
									<th><?php echo renderLang($projects_end_date); ?></th>
									<th><?php echo renderLang($projects_project_status); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
							if(isset($_GET['k'])) {
								
								
								$data_count = 0;
								$sql = $pdo->prepare("SELECT *
									FROM projects
									JOIN project_members ON project_members.project_id = projects.project_id
									JOIN centers ON projects.center_id = centers.center_id
									".$where."
									AND project_members.user_id = :user_id
								"	.$center_filter." LIMIT 1");
								$bind_param = array(
									':user_id'   => $user_id
								);
								$sql->execute($bind_param);
								$sql->execute();
													 
								 
							
								}else{
									$data_count = 0;
									$sql = $pdo->prepare("SELECT *
										FROM projects
										JOIN project_members ON project_members.project_id = projects.project_id
										JOIN centers ON projects.center_id = centers.center_id
										".$where."
										AND project_members.user_id = :user_id
										ORDER BY date_start DESC LIMIT ".$sql_start.",".$numrows);
									$bind_param = array(
										':user_id'   => $user_id
									);
									$sql->execute($bind_param);
									$sql->execute();
								}
									
								while($data = $sql->fetch(PDO::FETCH_ASSOC)) {

									$data_count++;
									$project_id = encryptID($data['project_id'], 'projects');
									$center_id = encryptID($data['center_id'], 'centers');

									echo '<tr>';

										// PROJECT CODE
										echo '<td><a href="/project/'.$project_id.'">'.$data['project_code'].'</a></td>';

										// PROJECT NAME
											switch($_SESSION['sys_language']) {
												case 0:
													echo '<td><a href="/project/'.$project_id.'">'.$data['project_name'].'</a></td>';
													break;
												case 1:
													echo '<td><a href="/project/'.$project_id.'">'.$data['project_name_jp'].'</a></td>';
													break;
											}
										// START DATE
										echo '<td>'.$data['date_start'].'</td>';

										// END DATE
										echo '<td>'.$data['date_end'].'</td>';

										// STATUS
										echo '<td>';
											foreach($project_status as $key => $value) {
												if($key == $data['project_status']) {
													echo '<label class="label">'.renderLang($value).'</label>';
												}
											}

										echo '</td>';

									echo '</tr>';
								}
							
								?>
							</tbody>
						</table>
					</div><!-- table-responsive -->

										<!-- BOTTOM PAGINATION -->
					<div class="row search-and-pagination">
						<div class="col-sm-6">
							<?php 


							if($total_data_count > 0) {
								$sql_start_count = $sql_start + 1;
							} else {
								$sql_start_count = 0;
							}
							switch($_SESSION['sys_language']) {
								case 0:
									echo 'Showing '.$sql_start_count.' to '.($sql_start+$data_count).' out of '.$total_data_count.' total.';
									break;
								case 1:
									echo $total_data_count.'合計のうち'.$sql_start_count.'から'.($sql_start+$data_count).'を表示しています。';
									break;
							}
							?>
						</div>
						<div class="col-sm-6 dataTables_wrapper dt-bootstrap4">
							<div class="dataTables_paginate paging_simple_numbers">
								<ul class="pagination pull-right">
									<li class="paginate_button page-item previous<?php if($page_ctr == 1) { echo ' disabled'; } ?>"><a href="<?php echo $user_paginate_link.'?p='.($page_ctr-1).$var_k; ?>" class="page-link" data-dt-idx="0" tabindex="0"><?php echo renderLang($btn_previous); ?></a></li>
									<?php
									$page_1 = (int)$page_ctr-2;
									if($page_1 < 1) {
										$page_1 = 1;
									}
									if($page_count > 5) {
										if($page_1 != 1) {
											echo '<li class="paginate_button page-link more disabled"><a href="#">...</a></li>';
										}
									}
									$page_max = $page_1+4;
									if($page_max > $page_count) {
										$page_1 = $page_1 - ($page_max-$page_count);
										$page_max = $page_count;
									}
									if($page_count <= 5) {
										$page_1 = 1;
									}
									for($x=$page_1;$x<=$page_max;$x++) {
										echo '<li class="paginate_button page-item';
										if($x == $page_ctr) {
											echo ' active';
										}
										echo '"><a href="'.$user_paginate_link.'?p='.$x.$var_k.'" class="page-link" data-dt-idx="'.$x.'" tabindex="'.($x-1).'">'.$x.'</a></li>';
									}
									if($page_count > 5) {
										if($page_ctr <= $page_count-3) {
											echo '<li class="paginate_button more disabled"><a href="#" class="page-link">...</a></li>';
										}
									}
									?>
									<li class="paginate_button page-item next<?php if($page_ctr == $page_count) { echo ' disabled'; } ?>"><a href="<?php echo $user_paginate_link.'?p='.($page_ctr+1).$var_k; ?>" class="page-link" data-dt-idx="<?php echo $page_count; ?>" tabindex="0"><?php echo renderLang($btn_next); ?></a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>
			</div><!-- card -->
			<?php

} else {

	header('location: /');

}
?>