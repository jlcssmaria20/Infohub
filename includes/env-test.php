<?php

$server = 'localhost';
$username = 'dxcti'; 
$password = 'Password1234567890_';
$db = 'tcap_infohub';

define("SERVER", $server);
define("USERNAME", $username);
define("PASSWORD", $password);
define("DB", $db);

shell_exec("ssh -fNg -L 3307:$server:3306 dxtci@10.16.24.163");