<?php
$change_log_arr = explode(';;',$data['change_log']);

foreach($change_log_arr as $change_log) {

	$item_arr = explode('::',$change_log);
	$changes_arr = explode('==',$item_arr[1]);
	$field_name = $item_arr[0];
	$from_val = $changes_arr[0];
	$to_val = $changes_arr[1];
	
	// Upload payment codes
	if($field_name == 'payment_codes' || $field_name == 'payment_codes_sync') {
		if($from_val == 0) {
			$from_val = 'Old';
		}
		if($to_val == 0) {
			$to_val = 'New';
		}
	}
	
	// render approve invoice
	if($field_name == 'project_invoice_cancel_status') {
		if($from_val == 1) {
			$from_val = 'Approved';
		}
		if($to_val == 0) {
			$to_val = 'Unapprove';
		}
	}
	
	if($field_name == 'project_invoice_approved_status') {
		if($from_val == 0) {
			$from_val = 'Unapprove';
		}
		if($to_val == 1) {
			$to_val = 'Approved';
		}
	}
    
	
	// render leaves
	if($field_name == 'leaves_leave') {
		foreach($leave_types_arr as $val) {
			if($from_val == $val[0]) {
				$from_val = renderLang($val[2]);
			}
			if($to_val == $val[0]) {
				$to_val = renderLang($val[2]);
			}
		}
	}
	
	// render holidays from center
	if($field_name == 'holidays_holiday') {
		foreach($holiday_types_arr as $val) {
			if($from_val == $val[0]) {
				$from_val = renderLang($val[1]);
			}
			if($to_val == $val[0]) {
				$to_val = renderLang($val[1]);
			}
		}
	}
    // render mistake type from mistake report
    if($field_name == 'mistakes_mistake_type') {
        foreach($mistake_type_arr as $val) {
            if($from_val == $val[0]) {
                $from_val = renderLang($val[1]);
            }
            if($to_val == $val[0]) {
                $to_val = renderLang($val[1]);
            }
        }
    }
    // render member from mistake report
    if($field_name == 'mistakes_user_id') {
        $user_data = getData($from_val,'users','user');
        if($from_val == $user_data['user_id']) {
            $from_val = $user_data['user_lastname'] .',' .$user_data['user_firstname'];
        }
        $user_data = getData($to_val,'users','user');
        if($to_val == $user_data['user_id']) {
            $to_val =  $user_data['user_lastname'] .',' .$user_data['user_firstname'];
        }
    }
    // render bridge director from mistake report
    if($field_name == 'mistakes_bd_id') {
        $bd_data = getData($from_val,'users','user');
        if($from_val == $bd_data['user_id']) {
            $from_val = $bd_data['user_lastname'] .',' .$bd_data['user_firstname'];
        }
        $bd_data = getData($to_val,'users','user');
        if($to_val == $bd_data['user_id']) {
            $to_val =  $bd_data['user_lastname'] .',' .$bd_data['user_firstname'];
        }
    }
    // render center name from mistake report
    if($field_name == 'mistakes_center_id') {
        $center_data = getData($from_val,'centers','center');
        if($from_val == $center_data['center_id']) {
            $from_val = $center_data['center_name'];
        }
        $center_data = getData($to_val,'centers','center');
        if($to_val == $center_data['center_id']) {
            $to_val = $center_data['center_name'];
        }

    }
    // render report status from mistake report
    if($field_name == 'mistakes_report_status') {
        foreach($mistake_status_arr as $val) {
            if($from_val == $val[0]) {
                $from_val = renderLang($val[1]);
            }
            if($to_val == $val[0]) {
                $to_val = renderLang($val[1]);
            }
        }
    }
    // render project code from mistake report
    if($field_name == 'mistakes_project_code') {
        $project_data = getData($from_val,'projects','project');
        
        if($from_val == $project_data['project_id']) {
            $from_val = $project_data['project_code'];
        }
        $project_data = getData($to_val,'projects','project');
        if($to_val == $project_data['project_id']) {
            $to_val =  $project_data['project_code'];
        }
        
    }


	// render status of project
	if($field_name == 'projects_status') {
		foreach($project_status_arr as $val) {
			if($from_val == $val[0]) {
				$from_val = renderLang($val[1]);
			}
			if($to_val==$val[0]) {
				$to_val = renderLang($val[1]);
			}
		}
	}
	
	// render permissions for roles
	if($field_name == 'lang_permissions') {

		$from_val_arr = explode(',',$from_val);
		$to_val_arr = explode(',',$to_val);
		foreach($from_val_arr as $i => $from_val) {
			foreach($permissions_arr as $permission_group) {
				foreach($permission_group as $permission) {
					if($permission['permission_code'] == $from_val) {
						$from_val_arr[$i] = renderLang($permission['permission_name']);
						break;
					}
					if($permission['permission_code'] == $to_val) {
						$to_val_arr[$i] = renderLang($permission['permission_name']);
						break;
					}
				}
			}
		}
		$from_val = implode($from_val_arr,', ');
		$to_val = implode($to_val_arr,', ');

	}

	// render role name
	if($field_name == 'roles_roles') {

		$from_val_arr = explode(',',$from_val);
		foreach($from_val_arr as $i => $from_val) {
			if($from_val == '') {
				unset($from_val_arr[$i]);
			} else {
				foreach($roles_arr as $role) {
					if($from_val == $role['role_id']) {
						$from_val_arr[$i] = $role['role_name'];
						break;
					}
				}
			}
		}
		$from_val = implode($from_val_arr,', ');

		$to_val_arr = explode(',',$to_val);
		foreach($to_val_arr as $i => $to_val) {
			if($to_val == '') {
				unset($to_val_arr[$i]);
			} else {
				foreach($roles_arr as $role) {
					if($to_val == $role['role_id']) {
						$to_val_arr[$i] = $role['role_name'];
						break;
					}
				}
			}
		}
		$to_val = implode($to_val_arr,', ');

	}

	// render center name
	if($field_name == 'centers_center') {

		$from_val_arr = explode(',',$from_val);
		foreach($from_val_arr as $i => $from_val) {
			if($from_val == '') {
				unset($from_val_arr[$i]);
			} else {
				foreach($centers_arr as $center) {
					if($from_val == $center['center_id']) {
						switch($_SESSION['sys_language']) {
							case 0: $from_val_arr[$i] = $center['center_name']; break;
							case 1: $from_val_arr[$i] = $center['center_name_jp']; break;
							default: $from_val_arr[$i] = $center['center_name']; break;
						}
						break;
					}
				}
			}
		}
		$from_val = implode($from_val_arr,', ');

		$to_val_arr = explode(',',$to_val);
		foreach($to_val_arr as $i => $to_val) {
			if($to_val == '') {
				unset($to_val_arr[$i]);
			} else {
				foreach($centers_arr as $center) {
					if($to_val == $center['center_id']) {
						switch($_SESSION['sys_language']) {
							case 0: $to_val_arr[$i] = $center['center_name']; break;
							case 1: $to_val_arr[$i] = $center['center_name_jp']; break;
							default: $to_val_arr[$i] = $center['center_name']; break;
						}
						break;
					}
				}
			}
		}
		$to_val = implode($to_val_arr,', ');

	}

	// department name
	if($field_name == 'departments_department') {

		if($from_val == 0) {
			$from_val = 'TBD';
		} else {
			foreach($departments_arr as $department) {
				if($from_val == $department['department_id']) {
					$from_val = $department['department_name'];
					break;
				}
			}
		}

		if($to_val == 0) {
			$to_val = 'TBD';
		} else {
			foreach($departments_arr as $department) {
				if($to_val == $department['department_id']) {
					$to_val = $department['department_name'];
					break;
				}
			}
		}

	}

	// center/department
	if($field_name == 'teams_center_department') {

		if($from_val == 0) {
			$from_val = 'TBD';
		} else {
			$department_data = getData($from_val,'departments','department');
			$center_data = getData($department_data['center_id'],'centers','center');
			$from_val = '['.$center_data['center_code'].'] '.$department_data['department_name'];
		}

		if($to_val == 0) {
			$to_val = 'TBD';
		} else {
			$department_data = getData($to_val,'departments','department');
			$center_data = getData($department_data['center_id'],'centers','center');
			$to_val = '['.$center_data['center_code'].'] '.$department_data['department_name'];
		}

	}

	// center/department/team
	if($field_name == 'subteams_center_department_team') {

		if($from_val == 0) {
			$from_val = 'TBD';
		} else {
			$team_data = getData($from_val,'teams','team');
			$department_data = getData($team_data['department_id'],'departments','department');
			$center_data = getData($team_data['center_id'],'centers','center');
			$from_val = '['.$center_data['center_code'].'] '.$department_data['department_code'].' - '.$team_data['team_name'];
		}

		if($to_val == 0) {
			$to_val = 'TBD';
		} else {
			$team_data = getData($to_val,'teams','team');
			$department_data = getData($team_data['department_id'],'departments','department');
			$center_data = getData($team_data['center_id'],'centers','center');
			$to_val = '['.$center_data['center_code'].'] '.$department_data['department_code'].' - '.$team_data['team_name'];
		}

	}

	// render position name from users
	if($field_name == 'users_position') {
		$position_data = getData($from_val,'positions','position');

		if($from_val == $position_data['position_id']) {
			$from_val = $position_data['position_name'];
		}
		$position_data = getData($to_val,'positions','position');
		if($to_val == $position_data['position_id']) {
			$to_val =  $position_data['position_name'];
		}

	}

	// center/department/team
	if($field_name == 'users_center_department_team_subteam') {

		if($from_val == 0) {
			$from_val = 'TBD';
		} else {
			$subteam_data = getData($from_val,'subteams','subteam');
			$team_data = getData($subteam_data['team_id'],'teams','team');
			$department_data = getData($team_data['department_id'],'departments','department');
			$center_data = getData($team_data['center_id'],'centers','center');
			$from_val = '['.$center_data['center_code'].'] '.$department_data['department_code'].' - '.$team_data['team_code'].' - '.$subteam_data['subteam_name'];
		}

		if($to_val == 0) {
			$to_val = 'TBD';
		} else {
			$subteam_data = getData($to_val,'subteams','subteam');
			$team_data = getData($subteam_data['team_id'],'teams','team');
			$department_data = getData($team_data['department_id'],'departments','department');
			$center_data = getData($team_data['center_id'],'centers','center');
			$to_val = '['.$center_data['center_code'].'] '.$department_data['department_code'].' - '.$team_data['team_code'].' - '.$subteam_data['subteam_name'];
		}

	}
    
	// render ip language
	if($field_name == 'ips_language') {

		foreach($language_arr as $language) {
			if($language[0] == $from_val) {
				$from_val = $language[1];
				break;
			}
		}

		foreach($language_arr as $language) {
			if($language[0] == $to_val) {
				$to_val = $language[1];
				break;
			}
		}

	}
    
	//render holiday types
	if($field_name == 'ips_language') {

		foreach($language_arr as $language) {
			if($language[0] == $from_val) {
				$from_val = $language[1];
				break;
			}
		}

		foreach($language_arr as $language) {
			if($language[0] == $to_val) {
				$to_val = $language[1];
				break;
			}
		}

	}

	// render status
	if($field_name == 'lang_status') {

		foreach($status_arr as $status) {
			if($status[0] == $from_val) {
				$from_val = renderLang($status[1]);
				break;
			}
		}

		foreach($status_arr as $status) {
			if($status[0] == $to_val) {
				$to_val = renderLang($status[1]);
				break;
			}
		}

	}

	// render gender
	if($field_name == 'user_gender') {

		foreach($gender_arr as $gender) {
			if($gender[0] == $from_val) {
				$from_val = renderLang($gender[1]);
				break;
			}
		}

		foreach($gender_arr as $gender) {
			if($gender[0] == $to_val) { 
				$to_val = renderLang($gender[1]);
				break;
			}
		}

	}
	

	// render system log message
	switch($_SESSION['sys_language']) {
		case 0:
			if($field_name == 'project_grade'){
				
				$to_val_arr = explode(',',$to_val);
				$value = $to_val_arr[0];
				$graded_by = $to_val_arr[1];
				$graded_user = $to_val_arr[2];
				
				$data1 = getData($graded_by,'users','user');
				$data2 = getData($graded_user,'users','user');
				
				$graded_by_name = $data1['user_firstname'];
				$graded_user_name = $data2['user_firstname'];
				
		
				$message = $graded_by_name. " Updated the <em>Project Grade</em> of ".$graded_user_name." from <strong>".$from_val."</strong> to <strong>".$value."</strong>";
				echo $message;
				
				} else if($field_name == 'projects_members') {
				// render project members
				if(!empty($from_val)){
					$from_val_arr = explode(',',$from_val);
					$remove_mess = 'Removed ';
					foreach($from_val_arr as $i => $from){
						$i++;
						$user_data = getData($from,'users','user');
						$from_val = $user_data['user_lastname'] .' , ' .$user_data['user_firstname'];
						$remove_mess .='<strong> ('.$i.' ) '.$from_val.' </strong>';
					}
					echo $remove_mess .=' from <em>Project Members</em>';
				}
				echo '<br>';
				if(!empty($to_val)){
					$to_val_arr = explode(',',$to_val);
					$added_mess = 'Added  ';
					foreach($to_val_arr as $i => $to){
						$user_data = getData($to,'users','user');
						$to_val = $user_data['user_lastname'] .' , ' .$user_data['user_firstname'];
						$added_mess .= '<strong>'.$to_val.' </strong>';
					}
					echo $added_mess .= ' to <em>Project Members</em>';
				}
			}else{
				echo '<em>'.renderLang(${$field_name}).'</em> from <strong>'.$from_val.'</strong> to <strong>'.$to_val.'</strong><br>';
			}
			break;
		case 1:
			echo renderLang(${$field_name}).'が<strong>'.$from_val.'</strong>から<strong>'.$to_val.'</strong>に変更されました。<br>';
			break;
	}
}
?>