<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
// check if user has existing session
if(checkSession()) {
	

	$user_id = decryptID($_GET['id'], 'users');
	$year_i = date('Y');
	$year = 2018;

	while($year_i >= $year) {
			$sql1 = $pdo->prepare("
			SELECT count(mistake_id) as mistakes_count FROM mistakes_report
			WHERE user_id = :user_id
			AND datecode LIKE '".$year_i."%'
			");
			$bind_param = array(
				":user_id" => $user_id
			);
			$sql1->execute($bind_param);
			$mistake_data = $sql1->fetch(PDO::FETCH_ASSOC);
		
			$sql2 = $pdo->prepare("
			SELECT count(user_id) as projects_count FROM project_members
			LEFT JOIN projects ON projects.project_id = project_members.project_id
			WHERE user_id = :user_id
			AND projects.date_start LIKE '".$year_i."%'
			");
			$bind_param = array(
				":user_id" => $user_id
			);
			$sql2->execute($bind_param);
			$project_data = $sql2->fetch(PDO::FETCH_ASSOC);
	
			
			$mistakes_count = (int)$mistake_data['mistakes_count'];
			$projects_count = (int)$project_data['projects_count'];
			$wo_miss = $projects_count - $mistakes_count;
			$w_miss = $mistakes_count;
		
			
		?>
			<h3><?= $year_i ?></h3>
			<table class="table table-bordered table-hover table-striped">
				<tbody>
					<tr>
						<th>Total Projects</th>
						<td class="w130"><?= $projects_count ?></td>
					</tr>
					<tr>
						<th><span style="display:inline-block;width:25px;"></span>without Miss</th>
						<td class="w130"><?= $wo_miss ?> (<?= ($wo_miss == 0) ? 0 : @($wo_miss/$projects_count)*100 ?>%)</td>
					</tr>
					<tr>
						<th><span style="display:inline-block;width:25px;"></span>with Miss</th>
						<td class="w130"><?= $mistakes_count ?> (<?= ($mistakes_count == 0) ? 0 : @($mistakes_count/$projects_count)*100 ?>%)</td>
					</tr>
					<tr>
						<th>Overall Miss Percentage</th>
						<td class="w130"><?= ($mistakes_count == 0) ? 0 : @($mistakes_count/$projects_count)*100 ?>%</td>
					</tr>
				</tbody>
			</table>
			
		<?php
		$year_i--;
	}

    
} else { // no session found, redirect to login page

    $_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
    header('location: /login');

}   
    
?>