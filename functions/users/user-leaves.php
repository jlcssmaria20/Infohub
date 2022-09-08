<?php 
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');
// check if user has existing session
if(checkSession()) {
	

		$user_id = decryptID($_GET['id'], 'users');
		
        $sql = $pdo->prepare("
                SELECT 
					leaves.leave_id,
                    leaves.leave_charge,
					leaves.leave_type,
					leaves.datecode,
					users.user_id,
					users.user_firstname,
					users.user_lastname,
					users.user_employee_id,
					subteams.subteam_name
                FROM leaves
                LEFT JOIN users ON leaves.user_id = users.user_id
				LEFT JOIN subteams ON users.subteam_id = subteams.subteam_id
				WHERE leaves.datecode LIKE '". date('Y') . "%'
				AND users.user_id = :user_id
				AND leaves.temp_del = 0
                ORDER BY  leaves.datecode DESC, users.user_lastname DESC");
        $bind_param = array(
            ":user_id" => $_SESSION['sys_id']
        );
        $sql->execute($bind_param);
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

		
		$count = 0;
 		$curr_day = 0;
		$leave_consume = [];
        if($data) {
			echo '<h3>'. date('Y') .'</h3>';

			
			foreach($data as $item) {
				foreach($leave_types_arr as $leave) {	
					if($item['leave_type'] == $leave[0]) {
						array_push($leave_consume, array(
							$item['leave_type'] => $item['leave_charge']
						));
					}
				}
			}
			echo '<ul>';
			foreach($leave_types_arr as $leave) {
				echo '<li><span style="color: '.$leave[1].'">' .renderLang($leave[2]) .'</span> ('. array_sum(array_column($leave_consume, $leave[0])).')</li>';
			}
			echo '</ul>';
			
            foreach($data as $item) {
				
				$month = substr($item['datecode'], 0,6);
				if($curr_day != $month) {
					$curr_day = $month;
					echo '<p class="leave-group">';
					echo '<strong>'. date("F", strtotime($item['datecode'])) .'</strong>';
                }
				
                $count++;
				$leave_type = '';
				foreach($leave_types_arr as $leave) {	
					if($item['leave_type'] == $leave[0]) {
						echo '<span>'.date("M jS, Y (D)", strtotime($item['datecode'])).' <span style="color:'.$leave[1].'">'. renderLang($leave[2]) .'</span> ['. $item['leave_charge'] .']</span>'; 
						
					}
				}

				if($curr_day != $month) {
					$curr_day = $month;
					echo '</p>';
                }
            }
			echo '<br>';
        } else {
        ?>
			<p>No data to display</p>
        <?php    
        }
		if(checkPermission('leaves')) {
			echo '<p><a class="btn btn-success" href="/leaves-management">'.renderLang($view_leaves_management).'</a></p>';
		}
    
} else { // no session found, redirect to login page

    $_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
    header('location: /');

}   
    
?>