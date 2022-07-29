<?php
// start session
session_start();
include('support/ngaqhamohwlmey.php');
$root = $_SERVER['DOCUMENT_ROOT'];
$a = 'ngaqha'; $b = 'mohwl'; $c = 'mey';

// set default language
$default_lang_idx = 0; // English
if(isset($_SESSION['sys_data']['language'])) {
	$default_lang_idx = $_SESSION['sys_data']['language'];
}
//$default_lang_idx = 1; // Japanese

// for encryption
$crypt_key = ${$a.$b.$c};

// get actual link
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// DATABASE CONNECTION

// $server = 'localhost';
// $username = 'root'; 
// $password = '';
// $db = 'tar_db';

$server = 'localhost';
$username = 'root'; 
$password = '';
$db = 'dxinfo_db';

//$server = 'localhost'; $username = 'raiansei_corporate_user'; $password = 'IAmYourFather!'; $db = 'raiansei_corporate_db';
$conn = 'mysql:host='.$server.';dbname='.$db.';charset=utf8';
try {
	$pdo = new PDO($conn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	echo $e->getMessage();
}


// SYSTEM DEFAULT SETTINGS
$system_code = 'DX INFO HUB';
$sitename = array('DX INFO HUB','才能と保持');
date_default_timezone_set('Asia/Manila');


// ALLOWED FILES FOR UPLOAD
$allowed_upload_file_type_arr = array(
	'jpg',
	'jpeg',
	'bmp',
	'gif',
	'png',
	'odt',
	'doc',
	'docx',
	'ppt',
	'pptx',
	'xls',
	'xlsx',
	'pdf',
	'txt',
	'rtf',
	'mp4',
	'mov',
	'wmv',
	'mp3'
);


// encrypt string
// function encryptStr($str) {
// 	$key = $GLOBALS['crypt_key'];
// 	$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
// 	$iv = openssl_random_pseudo_bytes($ivlen);
// 	$ciphertext_raw = openssl_encrypt($str,$cipher,$key,$options=OPENSSL_RAW_DATA,$iv);
// 	$hmac = hash_hmac('sha256',$ciphertext_raw,$key,$as_binary=true);
// 	$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
// 	return $ciphertext;
// }
// // decrypt string
// function decryptStr($str) {
// 	$key = $GLOBALS['crypt_key'];
// 	$c = base64_decode($str);
// 	$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
// 	$iv = substr($c,0,$ivlen);
// 	$hmac = substr($c,$ivlen,$sha2len=32);
// 	$ciphertext_raw = substr($c,$ivlen+$sha2len);
// 	$original_plaintext = openssl_decrypt($ciphertext_raw,$cipher,$key,$options=OPENSSL_RAW_DATA,$iv);
// 	$calcmac = hash_hmac('sha256',$ciphertext_raw,$key,$as_binary=true);
// 	if (hash_equals($hmac,$calcmac)) { return $original_plaintext; }
// }

	
$mmodules = 'userview';
// encrypt ID
function encryptID($id,$mmodules = '') {
	return processIDEncryption($id,'encrypt',$mmodules);
}
// decrypt ID
function decryptID($id,$mmodules = '') {
	return processIDEncryption($id,'decrypt',$mmodules);
}
// process ID encryption
function processIDEncryption($id,$action,$mmodules) {
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
	if($mmodules == '') {
		$mmodules = $GLOBALS['mmodules'];
	}
	$iv = substr(hash('sha256',$mmodules),0,16);
	if($action == 'encrypt') {
		$output = base64_encode(openssl_encrypt($id,$encrypt_method,$key,0,$iv)).$dynamic_val;
	} else {
		$id = str_replace($secret_key,'',$id);
		$output = openssl_decrypt(base64_decode($id),$encrypt_method,$key,0,$iv);
	}
	return $output;
}
?>