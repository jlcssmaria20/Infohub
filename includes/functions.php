<?php
// RENDER
// render language
function renderLang($lang_arr) {
	if(isset($lang_arr[$GLOBALS['default_lang_idx']])) {
		if($lang_arr[$GLOBALS['default_lang_idx']] != '') {
			$return = $lang_arr[$GLOBALS['default_lang_idx']];
		} else {
			$return = $lang_arr[0];
		}
	} else {
		$return = $lang_arr[0];
	}
	return $return;
}
// render error message
function renderError($session) {
	if(isset($_SESSION[$session])) {
		echo '<div class="alert alert-danger"><h5><i class="icon fas fa-ban"></i> '.renderLang($GLOBALS['alert_error']).'</h5>'.$_SESSION[$session].'</div>';
		unset($_SESSION[$session]);
	}
}
// render success message
function renderSuccess($session) {
	if(isset($_SESSION[$session])) {
		echo '<div class="alert alert-success"><h5><i class="icon fas fa-check"></i> '.renderLang($GLOBALS['alert_success']).'</h5>'.$_SESSION[$session].'</div>';
		unset($_SESSION[$session]);
	}
}
// render JS messages in response on delete function
function renderConfirmDelete($err_code,$session_name,$variable_name) {
	switch($err_code) {
		case 0:
			$_SESSION[$session_name] = renderLang($GLOBALS[$variable_name]);;
			echo '1';
			break;
		case 1:
			echo '0,'.renderLang($GLOBALS['modal_session_expired']);
			break;
		case 2:
			echo '0,'.renderLang($GLOBALS['modal_invalid_password']);
			break;
		case 3:
			echo '0,'.renderLang($GLOBALS['modal_unauthorized']);
			break;
		case 4:
			echo '0,'.renderLang($GLOBALS['modal_invalid_id']);
			break;
	}
}
// render status in profile
function renderProfileStatus($status) {
	switch($status) {
		case 0:
			echo '<button class="btn btn-flat btn-success">'.renderLang($GLOBALS['lang_status_active']).'</button>';
			break;
		case 1:
			echo '<button class="btn btn-flat btn-warning">'.renderLang($GLOBALS['lang_status_deactivated']).'</button>';
			break;
		case 2:
			echo '<button class="btn btn-flat btn-danger">'.renderLang($GLOBALS['lang_status_deleted']).'</button>';
			break;
	}
}
// render date using YMD
function renderDatecode($datecode) {
	$year = $datecode[0].$datecode[1].$datecode[2].$datecode[3];
	$month = $datecode[4].$datecode[5];
	$day = $datecode[6].$datecode[7];
	$datecode = array(
		'year' => $year,
		'month' => $month,
		'day' => $day
	);
	return $datecode;
}
// render actual time with rounding off
function renderActualHours($time) {
	$hour = 0; $m = 0;
	if($time > 3600) {
		$hour = floor($time/3600);
		$excess = $time-($hour*3600);
		$minute = floor($excess/60);
	} else {
		$minute = floor($time/60);
	}
	if($minute > 54) { $hour += 1; }
	elseif($minute <= 0) { $hour += 0; }
	elseif($minute <= 6) { $hour += .1; }
	elseif($minute <= 12) { $hour += .2; }
	elseif($minute <= 18) { $hour += .3; }
	elseif($minute <= 24) { $hour += .4; }
	elseif($minute <= 30) { $hour += .5; }
	elseif($minute <= 36) { $hour += .6; }
	elseif($minute <= 42) { $hour += .7; }
	elseif($minute <= 48) { $hour += .8; }
	elseif($minute <= 54) { $hour += .9; }
	$time = $hour;
	return $time;
}
function renderActualHours2($time) {
	$hour = 0; $m = 0;
	if($time > 3600) {
		$hour = floor($time/3600);
		$excess = $time-($hour*3600);
		$minute = floor($excess/60);
	} else {
		$minute = floor($time/60);
	}
	if($minute > 54) { $hour += 1; }
	elseif($minute <= 0) { $hour += 0; }
	elseif($minute <= 1) { $hour += .01; }
	elseif($minute <= 2) { $hour += .03; }
	elseif($minute <= 3) { $hour += .05; }
	elseif($minute <= 4) { $hour += .06; }
	elseif($minute <= 5) { $hour += .08; }
	elseif($minute <= 6) { $hour += .1; }
	elseif($minute <= 7) { $hour += .11; }
	elseif($minute <= 8) { $hour += .13; }
	elseif($minute <= 9) { $hour += .15; }
	elseif($minute <= 10) { $hour += .16; }
	elseif($minute <= 11) { $hour += .18; }
	elseif($minute <= 12) { $hour += .2; }
	elseif($minute <= 13) { $hour += .21; }
	elseif($minute <= 14) { $hour += .23; }
	elseif($minute <= 15) { $hour += .25; }
	elseif($minute <= 16) { $hour += .26; }
	elseif($minute <= 17) { $hour += .28; }
	elseif($minute <= 18) { $hour += .3; }
	elseif($minute <= 19) { $hour += .31; }
	elseif($minute <= 20) { $hour += .33; }
	elseif($minute <= 21) { $hour += .35; }
	elseif($minute <= 22) { $hour += .36; }
	elseif($minute <= 23) { $hour += .38; }
	elseif($minute <= 24) { $hour += .4; }
	elseif($minute <= 25) { $hour += .41; }
	elseif($minute <= 26) { $hour += .43; }
	elseif($minute <= 27) { $hour += .45; }
	elseif($minute <= 28) { $hour += .46; }
	elseif($minute <= 29) { $hour += .48; }
	elseif($minute <= 30) { $hour += .5; }
	elseif($minute <= 36) { $hour += .6; }
	elseif($minute <= 42) { $hour += .7; }
	elseif($minute <= 48) { $hour += .8; }
	elseif($minute <= 54) { $hour += .9; }
	$time = $hour;
	return $time;
}

function strpos_similar($haystack, $needle, $offset = 0, &$results = array()) {
	$offset = strpos($haystack, $needle, $offset);
	if($offset === false) {
		return $results;
	} else {
		$results[] = $offset;
		return strpos_similar($haystack, $needle, ($offset + 1), $results);
	}
}


// process revenue or parent project
function processParentProjectRevenue($project_id) {
	
	$parent_revenue_tci = 0;
	$parent_revenue_center = 0;
	
	$sql_prj = $GLOBALS['pdo']->prepare("SELECT project_id, parent_id, parent_pattern FROM projects WHERE project_id = ".$project_id." LIMIT 1");
	$sql_prj->execute();
	$data_prj = $sql_prj->fetch(PDO::FETCH_ASSOC);
	
	if($data_prj['parent_id'] == 0 && $data_prj['parent_pattern'] != '') {
		$sql_rev = $GLOBALS['pdo']->prepare("SELECT project_id, revenue_tci, revenue_center FROM project_revenue WHERE project_id = ".$project_id." LIMIT 1");
		$sql_rev->execute();
		$data_rev = $sql_rev->fetch(PDO::FETCH_ASSOC);

		$parent_revenue_tci = $data_rev['revenue_tci'];
		$parent_revenue_center = $data_rev['revenue_center'];
		
		$sql_child = $GLOBALS['pdo']->prepare("SELECT
			projects.project_id,
			projects.parent_id,
			projects.parent_pattern,
			project_revenue.revenue_tci,
			project_revenue.revenue_center
		FROM projects
		LEFT JOIN project_revenue ON project_revenue.project_id = projects.project_id
		WHERE projects.parent_id = ".$project_id);
		$sql_child->execute();
		while($data_child = $sql_child->fetch(PDO::FETCH_ASSOC)) {
			$parent_revenue_tci -= $data_child['revenue_tci'];
			$parent_revenue_center -= $data_child['revenue_center'];
		}
	}
	
	return array(
		'revenue_tci' => $parent_revenue_tci,
		'revenue_center' => $parent_revenue_center
	);
	
}
function processParentProjectBudgetTime($project_id) {
	
	$parent_budget_time = 0;
	
	$sql_prj = $GLOBALS['pdo']->prepare("SELECT project_id, parent_id, parent_pattern FROM projects WHERE project_id = ".$project_id." LIMIT 1");
	$sql_prj->execute();
	$data_prj = $sql_prj->fetch(PDO::FETCH_ASSOC);
	
	if($data_prj['parent_id'] == 0 && $data_prj['parent_pattern'] != '') {
		$sql_rev = $GLOBALS['pdo']->prepare("SELECT project_id, project_budget_time FROM project_budget_time WHERE project_id = ".$project_id." LIMIT 1");
		$sql_rev->execute();
		$data_rev = $sql_rev->fetch(PDO::FETCH_ASSOC);

		$parent_budget_time = $data_rev['project_budget_time'];
		
		$sql_child = $GLOBALS['pdo']->prepare("SELECT
			projects.project_id,
			projects.parent_id,
			projects.parent_pattern,
			project_budget_time.project_budget_time
		FROM projects
		LEFT JOIN project_budget_time ON project_budget_time.project_id = projects.project_id
		WHERE projects.parent_id = ".$project_id);
		$sql_child->execute();
		while($data_child = $sql_child->fetch(PDO::FETCH_ASSOC)) {
			$parent_budget_time -= $data_child['project_budget_time'];
		}
	}
	
	return $parent_budget_time;
	
}

// process revenue of linked projects
function processLinkedProjectRevenueBudgetTime($link_id) {
	
	// get other linked projects
	$link_ctr = 0;
	$link_parent_project_ids = array();
	$sql_link = $GLOBALS['pdo']->prepare("SELECT project_id, link_id FROM projects WHERE link_id = '".$link_id."'");
	$sql_link->execute();
	while($data_link = $sql_link->fetch(PDO::FETCH_ASSOC)) {
		array_push($link_parent_project_ids,$data_link['project_id']);
		$link_ctr++;
	}

	// get all child projects of all linked parents
	$child_project_ids = array();
	$where_child = '';
	foreach($link_parent_project_ids as $link_parent_project_id) {
		if($where_child == '') {
			$where_child .= " WHERE parent_id = ".$link_parent_project_id;
		} else {
			$where_child .= " OR parent_id = ".$link_parent_project_id;
		}
	}
	$sql_child = $GLOBALS['pdo']->prepare("SELECT project_id, parent_id FROM projects".$where_child);
	$sql_child->execute();
	while($data_child = $sql_child->fetch(PDO::FETCH_ASSOC)) {
		array_push($child_project_ids,$data_child['project_id']);
	}
	
	if(count($child_project_ids) > 0) {
	
		// get total revenue of all child projects of all linked parents
		$total_child_projects_revenue_center = 0;
		$where_child = '';
		foreach($child_project_ids as $child_project_id) {
			if($where_child == '') {
				$where_child .= " WHERE project_id = ".$child_project_id;
			} else {
				$where_child .= " OR project_id = ".$child_project_id;
			}
		}
		$sql_child = $GLOBALS['pdo']->prepare("SELECT project_id, revenue_center FROM project_revenue".$where_child);
		$sql_child->execute();
		while($data_child = $sql_child->fetch(PDO::FETCH_ASSOC)) {
			$total_child_projects_revenue_center += $data_child['revenue_center'];
		}
		$revenue_adjustment = $total_child_projects_revenue_center/$link_ctr;

		// get total budget time of all child projects of all linked parents
		$total_child_projects_budget_time = 0;
		$sql_child = $GLOBALS['pdo']->prepare("SELECT project_id, project_budget_time FROM project_budget_time".$where_child);
		$sql_child->execute();
		while($data_child = $sql_child->fetch(PDO::FETCH_ASSOC)) {
			$total_child_projects_budget_time += $data_child['project_budget_time'];
		}
		$budget_time_adjustment = $total_child_projects_budget_time/$link_ctr;
	
	} else {
		$budget_time_adjustment = 0;
		$revenue_adjustment = 0;
	}
		
	return array(
		'budget_time' => $budget_time_adjustment,
		'revenue_center' => $revenue_adjustment
	);
}

// PROCESS
// unset a cookie
function unsetCookie($cookie_name) {
	if(isset($_COOKIE[$cookie_name])) {
		unset($_COOKIE[$cookie_name]);
		setcookie($cookie_name, null, -1, '/');
	}
}
// unset a session
function unsetSession($session) {
	if(isset($_SESSION[$session])) {
		unset($_SESSION[$session]);
	}
}
// record action to system log
function systemLog($module,$target_id,$action,$change_log) {
	$epoch_time = time();
	$account_id = $_SESSION['sys_id'];
	switch($_SESSION['sys_account_mode']) {
		case 'admin': $account_mode = 0; break;
		case 'user': $account_mode = 1; break;
	}
	$sql = $GLOBALS['pdo']->prepare("INSERT INTO system_log(
		id,
		account_id,
		account_mode,
		module,
		target_id,
		action,
		change_log,
		epoch_time
	) VALUES(
		NULL,
		".$account_id.",
		".$account_mode.",
		'".$module."',
		'".$target_id."',
		'".$action."',
		'".$change_log."',
		'".$epoch_time."'
	)");
	$sql->execute();
}
// send email function
function sendMail($to, $name, $subject, $body) {
	require '../../vendor/autoload.php';
	require_once '../../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
	
	$transport = (new Swift_SmtpTransport('smtp.office365.com', 587, 'tls'))
		->setUsername('goop.info@transcosmos.com.ph')
		->setPassword('vtdwycnrzqntldfh');

	$mailer = new Swift_Mailer($transport);

	$message = (new Swift_Message($subject))
		->setFrom(['goop.info@transcosmos.com.ph' => 'Goop!'])
		->setTo([$to => $name])
		->addPart($body, 'text/html');

	// Send the message
	$result = $mailer->send($message);

	if($result) {
		return true;
	} else {
		return false;
	}

}

// VALIDATION
// validate names
function validateNameV1($string) {
	$r = 1;
	$forbidden_characters_arr = array('!','#','$','%','^','&','*','(',')','?','>','<','_','+','=','0','1','2','3','4','5','6','7','8','9');
	for($x=0;$x<strlen($string);$x++) {
		if(in_array($string[$x],$forbidden_characters_arr)) {
			$r = 0;
		}
	}
	return $r;
}
function renderName($data) {
	$fullname = '';
	switch($_SESSION['sys_data']['language']) {
		case 0:
			$fullname = $data['lastname'].', '.$data['firstname'];
			break;
		case 1:
			$fullname = $data['lastname'].' '.$data['firstname'];
			break;
		default:
			$fullname = $data['lastname'].', '.$data['firstname'];
			break;
	}
	return $fullname;
}
// SECURITY
// check IP of user
function checkIP() {
	$curr_ip = $_SERVER['REMOTE_ADDR'];
	$sql = $GLOBALS['pdo']->prepare("SELECT * FROM ips WHERE ip_address = '".$curr_ip."' AND temp_del = 0 LIMIT 1");
	$sql->execute();
	if($sql->rowCount() == 1) {
		if(!isset($_SESSION['sys_language'])) {
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			$_SESSION['sys_language'] = $data['ip_language'];
		}
		return 1; // valid IP
	} else {
		return 1; // invalid IP, put "1" for development, "0" for live
	}
}
// check session if logged in
function checkSession() {
	$r = 0;
	if(isset($_SESSION['sys_data'])) {
		$r = 1;
	}
	return $r;
}
// check permission is valid
function checkPermission($permission) {
	$r = 0;
	if(in_array($permission,$_SESSION['sys_permissions'])) {
		$r = 1;
	}
	return $r;
}
function checkAccountMode($account_mode) {
	$r = 0;
	if($_SESSION['sys_account_mode'] == $account_mode) {
		$r = 1;
	}
	return $r;
}
// encrypt string
// function encryptStr($str) {
// 	$key = $GLOBALS['crypt_key'];
// 	$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
// 	$iv = openssl_random_pseudo_bytes($ivlen);
// 	$ciphertext_raw = openssl_encrypt($str, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
// 	$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
// 	$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
// 	return $ciphertext;
// }
// decrypt string
// function decryptStr($str) {
// 	$key = $GLOBALS['crypt_key'];
// 	$c = base64_decode($str);
// 	$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
// 	$iv = substr($c, 0, $ivlen);
// 	$hmac = substr($c, $ivlen, $sha2len=32);
// 	$ciphertext_raw = substr($c, $ivlen+$sha2len);
// 	$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
// 	$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
// 	if (hash_equals($hmac, $calcmac)) { return $original_plaintext; }
// }
$key = $GLOBALS['crypt_key'];

function encryptStr($str) {
	global $key;

	return password_hash($str, PASSWORD_DEFAULT);
}

function decryptStr($hash, $value = "") {
	global $key;

	return password_verify($value, $hash);
}
// encrypt ID
function encryptID($id,$module = '') {
	return processIDEncryption($id,'encrypt',$module);
}
// decrypt ID
function decryptID($id,$module = '') {
	return processIDEncryption($id,'decrypt',$module);
}
// process ID encryption
function processIDEncryption($id,$action,$module) {
	$charBank_arr = array('_q','i','_B','l','_a','M','f','u','_g','O','h','9','V','W','F','s','6','K','P','_b','8','_r','X','3','Y','2','N','d','q','_S','j','_L','_R','p','Z','E','5','e','x','A','_k','_I','g','_Q','_G','J','G','_j','_J','b','_c','o','_E','_p','m','1','_i','_K','_o','B','I','S','_l','_H','0','_n','Q','y','_D','a','H','n','L','_C','D','t','k','_P','R','_e','_s','_M','z','_d','c','_A','_m','w','v','_h','_N','U','_O','T','C','7','_F','r','_f','4');
	$output = '';
	if($action == 'encrypt') {
		$epoch_time = substr(time() * rand(1,100),0,10);
		$dynamic_val = '';
		$dynamic_val .= $charBank_arr[($epoch_time[0].$epoch_time[1])*1];
		$dynamic_val .= $charBank_arr[($epoch_time[2].$epoch_time[3])*1];
		$dynamic_val .= $charBank_arr[($epoch_time[4].$epoch_time[5])*1];
		$dynamic_val .= $charBank_arr[($epoch_time[6].$epoch_time[7])*1];
		$dynamic_val .= $charBank_arr[($epoch_time[8].$epoch_time[9])*1];
		$secret_key = $dynamic_val;
	} else {
		$dynamic_val = '';
		$ctr = 0;
		for($x=strlen($id)-1;$x>=0;$x--) {
			if($id[$x] != '_') {
				$ctr++;
			}
			if($ctr <= 5) {
				$dynamic_val = $id[$x].$dynamic_val;
			}
			if($ctr > 5) {
				break;
			}
		}
		$secret_key = $dynamic_val;
	}
	$encrypt_method = "AES-256-CBC";
	$key = hash('sha256',$secret_key);
	if($module == '') {
		$module = $GLOBALS['page'];
	}
	$iv = substr(hash('sha256',$module),0,16);
	if($action == 'encrypt') {
		$output = base64_encode(openssl_encrypt($id,$encrypt_method,$key,0,$iv)).$dynamic_val;
	} else {
		$id = str_replace($secret_key,'',$id);
		$output = openssl_decrypt(base64_decode($id),$encrypt_method,$key,0,$iv);
	}
	return $output;
}

// GET DATA
// get data
function getData($id,$sql_table,$prefix) {
	$sql = $GLOBALS['pdo']->prepare("SELECT * FROM ".$sql_table." WHERE ".$prefix."_id = ".$id." LIMIT 1");
	$sql->execute();
	$data = $sql->fetch(PDO::FETCH_ASSOC);
	return $data;
}
function getTable($sql_table) {
	$r = array();
	$sql = $GLOBALS['pdo']->prepare("SELECT * FROM ".$sql_table);
	$sql->execute();
	while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
		array_push($r,$data);
	}
	return $r;
}
function getStatistics($center_id,$yrmo) {
	$r = array();
	
	// get training projects
	$ex_trn_qry = "";
	for($i=0;$i<count($GLOBALS['other_activities_arr']); $i++){
		$ex_trn_qry = $ex_trn_qry." AND projects.project_code NOT LIKE '".$GLOBALS['other_activities_arr'][$i]."%' ";
	}
	
	// EMPLOYEE COUNT
	// get number of active users
	$sql = $GLOBALS['pdo']->prepare("SELECT user_status, center_id FROM users WHERE center_id =:center_id AND user_status = 0");
	$bind_param = array(
		':center_id' => $center_id
	);
	$sql->execute($bind_param);
	$r['employee_count'] = $sql->rowCount();
	
	// BUDGET TIME
	$budget_time = 0;
	$sql = $GLOBALS['pdo']->prepare("SELECT
			project_budget_time,
			project_budget_yrmo,
			parent_id,
			parent_pattern,
			center_id
		FROM project_budget_time
		LEFT JOIN projects ON project_budget_time.project_id = projects.project_id
		WHERE
			project_budget_yrmo = ".$yrmo." AND center_id = :center_id AND parent_id = 0 AND parent_pattern = 'a' AND projects.project_status<>5 OR
			project_budget_yrmo = ".$yrmo." AND center_id = :center_id AND parent_pattern = 'b' AND projects.project_status<>5 OR
			project_budget_yrmo = ".$yrmo." AND center_id = :center_id AND parent_id = 0 AND parent_pattern = '' AND projects.project_status<>5".$ex_trn_qry."
		");
	$bind_param = array(
		':center_id' => $center_id
	);
	$sql->execute($bind_param);
	if($sql->rowCount()){
		while($data_stat = $sql->fetch(PDO::FETCH_ASSOC)) {
			$budget_time += round(($data_stat['project_budget_time']/8),1);
		}
	}
	$r['budget_time'] = ($budget_time/20);
	
	// MAX CAPACITY
	$max_capacity = 0;
	$sql = $GLOBALS['pdo']->prepare("SELECT * FROM center_capacity WHERE center_id = :center_id AND yrmo = :yrmo");
	$bind_param = array(
		':center_id' => $center_id,
		':yrmo' => $yrmo
	);
	$sql->execute($bind_param);
	if($sql->rowCount()){
		$data_stat = $sql->fetch(PDO::FETCH_ASSOC);
		$max_capacity = $data_stat['capacity'];
	}
	$r['max_capacity'] = $max_capacity;
	
	// OCCUPANCY
	$occupancy_rate = $r['max_capacity'] > 0 ? ($r['budget_time']/$r['max_capacity'])*100 : 0;
	$r['occupancy_rate'] = number_format($occupancy_rate,2,'.',',');
	
	// ACTUAL TIME
	$actual_hours = 0;
	$time_rendered = 0;
	$i=0;
	$j=0;
	$time_rendered_arr = array();
	$zero_rendered_arr = array();
	$total_rendered =0;
	$sql = $GLOBALS['pdo']->prepare("SELECT *
		FROM users_project_actual
		LEFT JOIN projects ON projects.project_id = users_project_actual.project_id
		WHERE
		users_project_actual.center_id =:center_id AND
		projects.project_status<>5 AND
		datecode LIKE :yr_mo
				");
	$bind_param = array(
		':center_id' => $center_id,
		':yr_mo' => '%'.$yrmo.'%'
	);
	$sql->execute($bind_param);
	while($item = $sql->fetch(PDO::FETCH_ASSOC)){
		$old_data = 0;
		if($item['datecode']*1 < 20200727) {
			$old_data = 1;
		}
		if($old_data) {
			if($item['time_end'] == 0 && $item['time_start'] == 0) {
//				$zero_rendered_arr[$j] = $item['time_rendered'];
//				$j++;
				$time_rendered = $item['epoch_time_rendered'];
				$time_rendered_arr[$i] = $time_rendered;
				$i++;
			} else {
				$time_rendered = $item['time_end'] - $item['time_start'];
				$time_rendered_arr[$i] = $time_rendered;
				$i++;
			}
		} else {
			$sql = $GLOBALS['pdo']->prepare("SELECT ROUND((SUM(time_rendered)/8/20),2) AS sum_render_time
				FROM users_project_actual
				LEFT JOIN projects ON projects.project_id = users_project_actual.project_id
				WHERE users_project_actual.center_id =:center_id AND
				projects.project_status<>5 AND datecode LIKE :yr_mo");
			$bind_param = array(
				':center_id' => $center_id,
				':yr_mo' => '%'.$yrmo.'%'
			);
			$sql->execute($bind_param);
			if($sql->rowCount()){
				$data_stat = $sql->fetch(PDO::FETCH_ASSOC);
				$actual_hours = $data_stat['sum_render_time'];
			}
		}
	}
	if(!empty($time_rendered_arr)){
		$time_rendered = array_sum($time_rendered_arr);
		$zero_rendered = array_sum($zero_rendered_arr);
		$total_rendered = renderActualHours($time_rendered) + $zero_rendered;
		$actual_hours = round((($total_rendered)/8/20),2);
	}
	$r['actual_hours'] = $actual_hours;
	
	// PRODUCTIVITY RATE
	$productivity_rate = $max_capacity > 0 ? ($actual_hours/$max_capacity)*100 : 0;
	$r['productivity_rate'] = number_format($productivity_rate,2,'.',',');
	
	// REMAINING CAPACITY
	$remaining_capacity = $r['max_capacity'] - $r['budget_time'];
	if($remaining_capacity < 0) {
		$remaining_capacity = 0;
	}
	$r['remaining_capacity'] = $remaining_capacity;
	
	return $r;
}

// SITE WIDE FUNCTIONS
// clear sessions of forms
function clearSessions() {
	
	$process_arr = array('add','edit');
	$data_type_arr = array('val','err');
	
	// SETTINGS
	unsetSession('sys_settings_tab_selected');

	// TEST
	$module = 'test';
	$fields_arr = array('test','username','firstname','lastname','status');
	unsetSessions($module,$fields_arr,$process_arr,$data_type_arr);
	
	//DOCUMENTS
	$module = 'documents';
	$fields_arr = array('documents','name','linkname','link','status');
	unsetSessions($module,$fields_arr,$process_arr,$data_type_arr);
	
	//ANNOUNCEMENTS
	$module = 'announcements';
	$fields_arr = array('announcements','title','details','img','status');
	unsetSessions($module,$fields_arr,$process_arr,$data_type_arr);

	//TEAMS
	$module = 'team';
	$fields_arr = array('team','name');
	unsetSessions($module,$fields_arr,$process_arr,$data_type_arr);
}

// set unset all sessions in fields arr
function unsetSessions($module,$fields_arr,$process_arr,$data_type_arr) {
	foreach($fields_arr as $field) {
		foreach($process_arr as $process) {
			foreach($data_type_arr as $data_type) {
				unsetSession('sys_'.$module.'_'.$process.'_'.$field.'_'.$data_type);
			}
		}
	}
}

//functions to bypass japanese characters

function isJapanese($str) { 
	return preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u', $str);
}

function checkSecurityQuestion($pdo,$acct_type,$acct_id){
	
	$sql = $pdo->prepare("SELECT account_type,account_id FROM account_secret_question where account_type=:account_type
	and account_id=:account_id LIMIT 1");
	$bind_param = array(
		':account_type' => $acct_type,
		':account_id'   => $acct_id
	);
	$sql->execute($bind_param);
	if($sql->rowCount() > 0){
		return true;
	}else{
		return false;
	}
	
}
?>