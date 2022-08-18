<?php

switch($data['module']) {

	case 'project':
		$_data = getData($data['target_id'],'projects','project');
		echo '<a href="/project/'.encryptID($_data['project_id'],'projects').'">';
		switch($_SESSION['sys_language']) {
			case 0:
				echo $_data['project_name'];
				break;
			case 1:
				echo $_data['project_name_jp'];
				break;
		}
		echo '</a>';
		break;

	case 'user':
		$_data = getData($data['target_id'],'users','user');
		echo '<a href="/user/'.encryptID($_data['user_id'],'users').'">';
		switch($_SESSION['sys_language']) {
			case 0:
				echo '['.$_data['user_employee_id'].'] '.$_data['user_firstname'].' '.$_data['user_lastname'];
				break;
			case 1:
				echo '['.$_data['user_employee_id'].'] '.$_data['user_lastname'].' '.$_data['user_firstname'];
				break;
		}
		echo '</a>';
		break;

	case 'admin':
		$_data = getData($data['target_id'],'admins','admin');
		echo '<a href="/admin/'.$_data['admin_id'].'">';
		switch($_SESSION['sys_language']) {
			case 0:
				echo '['.$_data['admin_username'].'] '.$_data['admin_firstname'].' '.$_data['admin_lastname'];
				break;
			case 1:
				echo '['.$_data['admin_username'].'] '.$_data['admin_lastname'].' '.$_data['admin_firstname'];
				break;
		}
		echo '</a>';
		break;

	case 'center':
		$_data = getData($data['target_id'],'centers','center');
		echo '<a href="/center/'.$_data['center_id'].'">';
		switch($_SESSION['sys_language']) {
			case 0:
				if($_data['center_name'] != '') {
					echo $_data['center_name'];
				} else {
					echo $_data['center_name_jp'];
				}
				break;
			case 1:
				if($_data['center_name_jp'] != '') {
					echo $_data['center_name_jp'];
				} else {
					echo $_data['center_name'];
				}
				break;
		}
		echo '</a>';
		break;

	case 'department':
		$_data = getData($data['target_id'],'departments','department');
		echo '<a href="/department/'.$_data['department_id'].'">['.$_data['department_code'].'] '.$_data['department_name'].'</a>';
		break;

	case 'team':
		$_data = getData($data['target_id'],'teams','team');
		echo '<a href="/team/'.$_data['team_id'].'">['.$_data['team_code'].'] '.$_data['team_name'].'</a>';
		break;

	case 'subteam':
		$_data = getData($data['target_id'],'subteams','subteam');
		echo '<a href="/subteam/'.$_data['subteam_id'].'">'.$_data['subteam_name'].'</a>';
		break;

	case 'role':
		$_data = getData($data['target_id'],'roles','role');
		echo '<a href="/role/'.$_data['role_id'].'">'.$_data['role_name'].'</a>';
		break;

	case 'ip':
		$_data = getData($data['target_id'],'ips','ip');
		echo '<span title="'.$_data['ip_remarks'].'">'.$_data['ip_address'].'</span>';
		break;
        
    case 'holiday':
		$_data = getData($data['target_id'],'center_holidays','holiday');
        foreach($holiday_types_arr as $holiday_arr) {
            if($_data['holiday_type'] == $holiday_arr[0]){
                echo '<a href="/center/'.encryptID($_data['holiday_id'],'centers').'">'.renderLang($holiday_arr[1]).'</a>';
            }
		}
		break;
        
    case 'mistake':
        $_data = getData($data['target_id'],'mistakes_report','mistake');
        foreach($mistake_type_arr as $mistake_type) {
            if($_data['mistake_type'] == $mistake_type[0]){
                echo '<a href="/mistake-report/'.encryptID($_data['mistake_id'],'mistakes-report').'">'.renderLang($mistake_type[1]).'</a>';
            }
        }
        break;
        
	case 'leave':
		// For optimization;
		$_leave = getData($data['target_id'],'leaves','leave');
		$_user = getData($_leave['user_id'],'users','user');
		foreach($leave_types_arr as  $item) {
			if($item[0] == $_leave['leave_type']) {
				echo '<span title="'.renderLang($item[1]).'"><a href="/leaves">'.strtoupper($item[0]).'['.$_leave['leave_charge'].'] '. $_user['user_firstname'] .', '. $_user['user_lastname']. '</a></span>';
			}
		} 
		break;
		
	case 'invoice':
		// For optimization
		$_revenue = getData($data['target_id'],'project_revenue','revenue');
		if(!empty($_revenue)) {
			
			$_project = getData($_revenue['project_id'], 'projects', 'project');
			$_user = getData($_revenue['approved_by'], 'users', 'user');
			echo '<a href="/project/'.encryptID($_project['project_id'],'projects').'">'.$_project['project_code'].' </a>['.$_revenue['revenue_yrmo'].'] ['.$_user['user_firstname'].' '. $_user['user_lastname'] .']';
		} else {
			echo 'Porject revenue deleted!';
		}
		
		break;

}
?>