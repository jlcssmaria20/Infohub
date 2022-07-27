<?php 
if($module != 'login') {
    $filename = 'tcapWebsite/pages/exam/'.$module.'/config.txt';
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


?>