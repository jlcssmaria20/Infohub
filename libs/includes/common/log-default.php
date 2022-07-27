<?php
// DEFAULT LOGS

// render permissions for roles
if($field_name == 'lang_permissions') {

	$from_val_arr = explode(',',$from_val);
	foreach($from_val_arr as $i => $from_val) {
		foreach($permissions_arr as $permission_group) {
			foreach($permission_group as $permission) {
				if($permission['permission_code'] == $from_val) {
					$from_val_arr[$i] = renderLang($permission['permission_name']);
					break;
				}
			}
		}
	}
	$from_val = implode($from_val_arr,', ');
	$from_val = ucwords($from_val);

	$to_val_arr = explode(',',$to_val);
	foreach($to_val_arr as $i => $to_val) {
		foreach($permissions_arr as $permission_group) {
			foreach($permission_group as $permission) {
				if($permission['permission_code'] == $to_val) {
					$to_val_arr[$i] = renderLang($permission['permission_name']);
					break;
				}
			}
		}
	}
	$to_val = implode($to_val_arr,', ');
	$to_val = ucwords($to_val);

}

// render status
if($field_name == 'lang_status') {
	
	foreach($status_arr as $i => $status) {
		if($i == $from_val) {
			$from_val = renderLang($status);
		}
		if($i == $to_val) {
			$to_val = renderLang($status);
		}
	}

}

// put dash on blanks
if($from_val == '') { $from_val = 'ー'; }
if($to_val == '') { $to_val = 'ー'; }

// render change log
switch($_SESSION['sys_data']['language']) {
	case 0:
		echo '<em>'.renderLang(${$field_name}).'</em> from <strong>'.$from_val.'</strong> to <strong>'.$to_val.'</strong>.<br>';
		break;
	case 1:
		echo renderLang(${$field_name}).'が<strong>'.$from_val.'</strong>から<strong>'.$to_val.'</strong>に変更されました。<br>';
		break;
}
?>