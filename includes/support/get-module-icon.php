<?php
$filename = $root.'/modules/'.$module.'/config.txt';
if(file_exists($filename)) { // if file exists and it should by default
	$file = fopen($filename,'r');
	$line = fgets($file);
	$line_arr = explode('=',$line);
	if(trim($line_arr[0]) == 'module_icon') { $page_module_icon = trim($line_arr[1]); }
	fclose($file);
} else { // if file is missing
	echo 'ERR: CONFIG.TXT NOT FOUND!';
}
?>