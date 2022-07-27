<?php
// render role name
if($field_name == 'roles_roles') {

	$from_val_arr = explode(',',$from_val);
	foreach($from_val_arr as $i => $from_val) {
		if($from_val == '') {
			unset($from_val_arr[$i]);
		} else {
			foreach($roles_arr as $role) {
				if($from_val == $role['id']) {
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
				if($to_val == $role['id']) {
					$to_val_arr[$i] = $role['role_name'];
					break;
				}
			}
		}
	}
	$to_val = implode($to_val_arr,', ');

}
?>