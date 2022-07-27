<?php
// check for changes
if(!isset($change_logs)) {
	$change_logs = array();
}
foreach($fields as $field) {
	
	// compare new data to current data if it is the same
	if(isset($data[$field])) {
		if(${$field} != $data[$field]) {

			$adjust_foo = 1;
			if(count($label_adjustments_arr) > 0) {
				foreach($label_adjustments_arr as $i => $label_adjustment) {
					if($label_adjustment[0] == $field) {
						$adjust_foo = 0;
						$label = $label_adjustment[1];
						unset($label_adjustments_arr[$i]);
						break;
					}
				}
			}
			if($adjust_foo) {
				$label = $module.'_'.$field;
			}

			// create array for change details "LABEL::FROM==TO"
			$tmp = $label.'::'.$data[$field].'=='.${$field};
			array_push($change_logs,$tmp);

			$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_suc'] = 1;

		}
	}
	
}

// check if there is are changes made
if(count($change_logs) > 0) {
	
	echo $date_start;

	// define SQL sets
	foreach($fields as $field) {
		if(!in_array($field,$exclude_sql)) {
			if(!isset($set_1)) { $set_1 = ''; } $set_1 = $set_1 == '' ? $set_1 = $field.' = :'.$field : $set_1 .= ', '.$field.' = :'.$field;
		}
	}

	// update table
	$sql = $pdo->prepare("UPDATE ".$module." SET ".$set_1." WHERE id = ".$id);
	$bind_param = array();
	foreach($fields as $field) {
		if(!in_array($field,$exclude_sql)) {
			$bind_param[":".$field] = ${$field};
		}
	}
	$sql->execute($bind_param);

	// record to system log
	$change_log = implode(';;',$change_logs);
	systemLog($module,$id,$process,$change_log);

	$_SESSION['sys_'.$module.'_'.$process.'_suc'] = renderLang(${$module.'_'.$prefix.'_'.$process});

} else { // no changes made

	$_SESSION['sys_'.$module.'_'.$process.'_err'] = renderLang($form_no_changes);

}
?>