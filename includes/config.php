<?php
// start session
ini_set( 'session.cookie_httponly', 1 );
session_start();
//session_regenerate_id();

// set default language
$default_lang_idx = 0; // English
if(isset($_SESSION['sys_language'])) {
	$default_lang_idx = $_SESSION['sys_language'];
}

// for encryption
$crypt_key = '4507';

// get actual link
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

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
require($_SERVER['DOCUMENT_ROOT'].'/includes/support/array-sets.php');
require($_SERVER['DOCUMENT_ROOT'].'/includes/functions.php');
require($_SERVER['DOCUMENT_ROOT'].'/includes/support/lang.php');
require($_SERVER['DOCUMENT_ROOT'].'/includes/support/permissions.php');

// SYSTEM DEFAULT SETTINGS
$system_code = 'dxinfohub';
$sitename = array(' DX InfoHub!', '');
$sitenamee = renderLang($sitename);
date_default_timezone_set('Asia/Manila');
$system_yrmo_start = 202201;
header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: https://infohub.tcapdmwis.com/');
header('Access-Control-Allow-Methods: GET, POST');
?>