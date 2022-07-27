<?php
// render gender
if($field_name == 'users_gender') {
	
	foreach($gender_arr as $i => $gender) {
		if($from_val == $i) {
			$from_val = renderLang($gender);
		}
		if($to_val == $i) {
			$to_val = renderLang($gender);
		}
	}

}
// render civil status
if($field_name == 'users_civil_status') {
	
	foreach($civil_status_arr as $i => $civil_status) {
		if($from_val == $i) {
			$from_val = renderLang($civil_status);
		}
		if($to_val == $i) {
			$to_val = renderLang($civil_status);
		}
	}

}
// render department / team
if($field_name == 'users_team_id') {

	if($from_val == 0) {
		$from_val = 'TBD';
	} else {
		$from_val_team_data = getData($from_val,'teams');
		$from_val = '['.$from_val_team_data['code'].'] '.$from_val_team_data['name'];
	}

	if($to_val == 0) {
		$to_val = 'TBD';
	} else {
		$to_val_team_data = getData($to_val,'teams');
		$to_val = '['.$to_val_team_data['code'].'] '.$to_val_team_data['name'];
	}

}
// render department
if($field_name == 'users_department_id') {

	if($from_val == 0) {
		$from_val = 'TBD';
	} else {
		$from_val_department_data = getData($from_val,'departments');
		$from_val = '['.$from_val_department_data['code'].'] '.$from_val_department_data['name'];
	}

	if($to_val == 0) {
		$to_val = 'TBD';
	} else {
		$to_val_department_data = getData($to_val,'departments');
		$to_val = '['.$to_val_department_data['code'].'] '.$to_val_department_data['name'];
	}

}
?>