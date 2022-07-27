<?php
// define SQL sets
foreach($fields as $field) {
	if(!in_array($field,$exclude_sql)) {
		if(!isset($set_1)) { $set_1 = ''; } $set_1 = $set_1 == '' ? $set_1 = $field : $set_1 .= ', '.$field;
		if(!isset($set_2)) { $set_2 = ''; } $set_2 = $set_2 == '' ? $set_2 = ':'.$field : $set_2 .= ', :'.$field;
	}
}

// insert to database
$sql = $pdo->prepare("INSERT INTO ".$module."(id, ".$set_1.") VALUES(NULL, ".$set_2.")");
$bind_param = array();
foreach($fields as $field) {
	if(!in_array($field,$exclude_sql)) {
		$bind_param[":".$field] = ${$field};
	}
}
$sql->execute($bind_param);

// get ID of new data by checking EOD
$sql = $pdo->prepare("SELECT id FROM ".$module." ORDER BY id DESC LIMIT 1");
$sql->execute();
$data = $sql->fetch(PDO::FETCH_ASSOC);

// record to system log
systemLog($module,$data['id'],$process,'');

// clear sessions
include($root.'/modules/'.$module.'/functions/clear.php');

$_SESSION['sys_'.$module.'_suc'] = renderLang(${$module.'_'.$prefix.'_'.$process});
?>