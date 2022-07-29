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
// DATABASE CONNECTION
include "env.php";
include "env-" . ENV . ".php";

$conn = 'mysql:host='.$server.';dbname='.$db.';charset=utf8';
try {
	$pdo = new PDO($conn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	echo $e->getMessage();
}

// COMMON INCLUDES
require($root.'/includes/functions.php');
require($root.'/includes/support/lang.php');
require($root.'/includes/support/permissions.php');
require($root.'/includes/support/tcapWebsite.php');

// LOAD CONFIG TEXT
if($module != 'login') {
	$filename = $root.'/modules/'.$module.'/config.txt';
	if(file_exists($filename)) { // if file exists and it should by default
		$file = fopen($filename,'r');
		while ($line = fgets($file)) {
			$line_arr = explode('=',$line);
			if(trim($line_arr[0]) == 'module_icon') { $module_icon = trim($line_arr[1]); }
		}
		fclose($file);
	} else { // if file is missing
		// echo 'ERR: CONFIG.TXT NOT FOUND!';
	}
}

// SYSTEM DEFAULT SETTINGS
$system_code = 'dxinfohub';
$sitename = array('DX INFO HUB','DX INFO HUB');
date_default_timezone_set('Asia/Manila');

// GET ALL LANGUAGES
$modules_path = scandir($root.'/modules');
foreach($modules_path as $folder) {
	if(strpos($folder,'.') > -1 || strpos($folder,'_') > -1 ) {} else {
		include($root.'/modules/login/support/lang.php');
	}
}

// CLEAR SESSION SUFFIX
$process_arr = array('add','edit');
$data_type_arr = array('val','err');

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
?>