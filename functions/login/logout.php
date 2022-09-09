<?php
// VERIFY LOG
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

session_destroy();
session_start();

// !NEED TRANSLATION
$_SESSION['sys_login_suc'] = renderLang($login_logout_successfully);
	
header('location: /login');
?>