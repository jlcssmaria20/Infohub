<?php
// RENDER
// render language

$dx = "DX Info Hub ".'&middot; ';
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
			$_SESSION[$session_name] = renderLang($GLOBALS[$variable_name]);
			if(($session_name == 'sys_users_suc') || ($session_name == 'sys_roles_suc')){
				echo '1';
			}
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

function strpos_similar($haystack, $needle, $offset = 0, &$results = array()) {
	$offset = strpos($haystack, $needle, $offset);
	if($offset === false) {
		return $results;
	} else {
		$results[] = $offset;
		return strpos_similar($haystack, $needle, ($offset + 1), $results);
	}
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
// function systemLog($module,$target_id,$action,$change_log) {
// 	$epoch_time = time();
// 	$account_id = $_SESSION['sys_id'];
// 	switch($_SESSION['sys_account_mode']) {
// 		case 'admin': $account_mode = 0; break;
// 		case 'user': $account_mode = 1; break;
// 	}
// 	$sql = $GLOBALS['pdo']->prepare("INSERT INTO system_log(
// 		id,
// 		account_id,
// 		account_mode,
// 		module,
// 		target_id,
// 		action,
// 		change_log,
// 		epoch_time
// 	) VALUES(
// 		NULL,
// 		".$account_id.",
// 		".$account_mode.",
// 		'".$module."',
// 		'".$target_id."',
// 		'".$action."',
// 		'".$change_log."',
// 		'".$epoch_time."'
// 	)");
// 	$sql->execute();
// }
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
// function checkIP() {
// 	$curr_ip = $_SERVER['REMOTE_ADDR'];
// 	$sql = $GLOBALS['pdo']->prepare("SELECT * FROM ips WHERE ip_address = '".$curr_ip."' AND temp_del = 0 LIMIT 1");
// 	$sql->execute();
// 	if($sql->rowCount() == 1) {
// 		if(!isset($_SESSION['sys_language'])) {
// 			$data = $sql->fetch(PDO::FETCH_ASSOC);
// 			$_SESSION['sys_language'] = $data['ip_language'];
// 		}
// 		return 1; // valid IP
// 	} else {
// 		return 1; // invalid IP, put "1" for development, "0" for live
// 	}
// }
// check session if logged in
function checkSession() {
	$r = 0;
	if(isset($_SESSION['sys_id'])) {
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
	$fields_arr = array('documents','name','file_link','linkname','link','status');
	unsetSessions($module,$fields_arr,$process_arr,$data_type_arr);
	
	//ANNOUNCEMENTS
	$module = 'announcements';
	$fields_arr = array('announcements','title','details','img','status');
	unsetSessions($module,$fields_arr,$process_arr,$data_type_arr);

	//TEAMS
	$module = 'team';
	$fields_arr = array('team','name');
	unsetSessions($module,$fields_arr,$process_arr,$data_type_arr);

	//ANNOUNCEMENTS
	$module = 'webinar_events';
	$fields_arr = array('webinar_events','host','title', 'speaker', 'others', 'user_id','description','img','status', 'schedule_date');
	unsetSessions($module,$fields_arr,$process_arr,$data_type_arr);

	// ADMINS
	$module = 'admins';
	$fields_arr = array('admin','username','firstname','lastname','admin_status');
	unsetSessions($module,$fields_arr,$process_arr,$data_type_arr);
	
	// ROLES
	$module = 'roles';
	$fields_arr = array('role','role_name','role_permissions');
	unsetSessions($module,$fields_arr,$process_arr,$data_type_arr);

	// USERS
	$module = 'users';
	$fields_arr = array(
		'user',
		'team_id',
		'employee_id',
		'email',
		'level',
		'gender',
		'status',
		'firstname',
		'middlename',
		'lastname',
		'nickname',
		'photo',
		'position',
		'roles',
		'hiredate',
		'enddate',
		'mantra_in_life',
		'skills',
		'user_status',
		'user_mobile'
	);
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