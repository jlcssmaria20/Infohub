<?php
// VERIFY LOG
$module = 'login';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

session_start();

$_SESSION['sys_login_suc'] = renderLang($login_logout_successfully);
header('location: /login');
?>