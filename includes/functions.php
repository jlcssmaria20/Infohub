<?php
// INCLUDES
include('support/array-sets.php');

// RENDER
// render language
function renderLang($lang_arr,$function = '') {
	if(isset($lang_arr[$GLOBALS['default_lang_idx']])) {
		if($lang_arr[$GLOBALS['default_lang_idx']] != '') {
			$return = $lang_arr[$GLOBALS['default_lang_idx']];
		} else {
			$return = $lang_arr[0];
		}
	} else {
		$return = $lang_arr[0];
	}
	if($function != '' && $GLOBALS['default_lang_idx'] == 0) {
		switch($function) {
			case 'ucwords': $return = ucwords($return); break;
			case 'strtoupper': $return = strtoupper($return); break;
			case 'strtolower': $return = strtolower($return); break;
			default: $return = ucwords($return); break;
		}
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
// render warning message
function renderWarning($session) {
	if(isset($_SESSION[$session])) {
		echo '<div class="alert alert-warning"><h5><i class="icon fas fa-exclamation-triangle"></i> '.renderLang($GLOBALS['alert_warning']).'</h5>'.$_SESSION[$session].'</div>';
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
			echo '<button class="btn btn-flat btn-sm btn-success">'.renderLang($GLOBALS['lang_status_active']).'</button>';
			break;
		case 1:
			echo '<button class="btn btn-flat btn-sm btn-warning">'.renderLang($GLOBALS['lang_status_deactivated']).'</button>';
			break;
		case 2:
			echo '<button class="btn btn-flat btn-sm btn-danger">'.renderLang($GLOBALS['lang_status_deleted']).'</button>';
			break;
	}
}
// render form field
function renderField($module,$field,$process,$type,$category,$data,$req,$min,$max) {
	$suc = isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_suc']) ? 1 : 0; // check error toggle
	$err = isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_err']) ? 1 : 0; // check error toggle
	echo '<div class="form-group">';
		echo '<label for="'.$field.'" class="mr-1';
			if($err) { echo ' text-danger'; } // for error
		echo '">';
			if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } // for error
	
			// label text
			switch($field) {
				case 'status':
					echo renderLang($GLOBALS{'lang_status'});
					break;
				default:
					echo renderLang($GLOBALS{$module.'_'.$field});
					break;
			}
	
		echo '</label>';
		if($req) {
			echo ' <span class="right badge badge-danger">'.renderLang($GLOBALS['label_required']).'</span>';
		}
	
		if($category == 'datepicker') {
			echo '<div class="input-group">';
				echo '<div class="input-group-prepend">';
					echo '<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>';
				echo '</div>';
		}
	
		switch($type) {
				
			// INPUT FIELD
			case 'input':
				if($category == '') {
					$input_type = 'text';
				} else {
					$input_type = $category;
				}
				if($input_type != 'file') {
					echo '<input type="'.$input_type.'"';
					
						// attributes
						echo $min > 0 ? ' minlength="'.$min.'"' : '';
						echo $max > 0 ? ' maxlength="'.$max.'"' : '';
						echo $data != '' ? ' step="'.$data.'"' : '';
					
						// class
						echo 'class="form-control';
						echo $req ? ' required' : '';
						echo $err ? ' is-invalid' : '';
						echo '"';
					
						echo ' id="'.$field.'" name="'.$field.'" placeholder="'.renderLang($GLOBALS{$module.'_'.$field.'_placeholder'}).'"';
						echo isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val']) ? ' value="'.$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'].'"' : '';
						echo $req ? ' required' : '';
					echo '>';
				} else {
					echo '<input type="file" multiple="multiple" class="';
					if($err) { echo ' is-invalid'; }
					echo '" id="'.$field.'" name="'.$field.'[]"';
					if(isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'])) {
						echo ' value="'.$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'].'"';
					}
					echo '>';
				}
				break;
				
			// SELECT DROPDOWN
			case 'select':
				
				echo '<select class="form-control';
					if($req) { echo ' required'; }
					if($err) { echo ' is-invalid'; }
					if($category == 'query') {
						$select_type = ' select2';
						if(isset($data['option-type'])) {
							switch($data['option-type']) {
								case 0: $select_type = ''; break;
								case 1: $select_type = ' select2'; break;
								default: $select_type = ' select2'; break;
							}
						}
						echo $select_type;
					}
					echo '" id="'.$field.'" name="'.$field.'"';
					if($req) { echo ' required'; }
				echo '>';

				switch($category) {
					
					// data from array
					case 'array':
						foreach($data as $i => $val) {
							if($val[0] != 'Deleted') { // for status only
								echo '<option value="'.encryptID($i,$field).'"';
								if(isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'])) {
									if($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'] == $i) {
										echo ' selected';
									}
								}
								echo '>'.renderLang($val).'</option>';
							}
						}
						break;
						
					// data from database
					case 'query':
						$key = $data['key'];
						$query = $data['query'];
						$option_value = $data['option-value'];
						$option_text_arr = explode(' ',$data['option-text']);
						
						if(!$req) { echo '<option value="'.encryptID('0',$key).'">TBD</option>'; }
						
						$sql = $GLOBALS['pdo']->prepare($query);
						$sql->execute();
						while($data_fn = $sql->fetch(PDO::FETCH_ASSOC)) {
							echo '<option value="'.encryptID($data_fn[$option_value],$key).'"';
							if(isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'])) {
								if($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'] == $data_fn[$option_value]) {
									echo ' selected';
								}
							}
							echo '>';
							$text_display = '';
							foreach($option_text_arr as $option_text) {
								if(isset($data_fn[$option_text])) {
									$text_display .= $data_fn[$option_text].' ';
								} else {
									$text_display .= $option_text.' ';
								}
							}
							$text_display = str_replace('[ ','[',$text_display);
							$text_display = str_replace(' ]',']',$text_display);
							
							// START ADDITIONALS
							$text_display = str_replace('[code] ','',$text_display);
							// END ADDITIONALS
							
							echo $text_display;
							echo '</option>';
						}
						break;
						
				}
				
				echo '</select>';
				break;
				
			// WYSIWYG
			case 'wysiwyg':
				echo '<textarea class="wysiwyg';
					if($req) { echo ' required'; }
					if($err) { echo ' is-invalid'; }
					echo '" id="'.$field.'" name="'.$field.'"';
					if($req) { echo ' required'; }
				echo '>';
					if(isset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'])) {
						echo $_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'];
					}
				echo '</textarea>';
				break;
		}
	
		if($category == 'datepicker') {
			echo '</div>';
		}
	
		// set link to module list
		switch($type) {
			case 'select':
				switch($category) {
					case 'query':
						switch($_SESSION['sys_data']['language']) {
							case 0: $link_text = strtoupper($data['option-link-text']); break;
							case 1: $link_text = $data['option-link-text']; break;
							default: $link_text = strtoupper($data['option-link-text']); break;
						}
						if(checkPermission($data['key'])) {
							echo '<a href="/'.$data['key'].'" class="btn btn-xs btn-default float-right mt-1" data-src="render"><i class="'.$data['option-link-icon'].' mr-2"></i>'.$link_text.'</a>';
						}
						break;
				}
				break;
		}
		
		// render field message
		if($err) {
			echo '<p class="text-danger mt-1">'.$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_err'].'</p>';
			unset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_err']);
		}
		if($suc) {
			echo '<p class="text-green mt-1">'.renderLang($GLOBALS['lang_field_updated']).'</p>';
			unset($_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_suc']);
		}
	echo '</div>';
}
// render name
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
function renderFullname($data) {
	$fullname = '';
	switch($_SESSION['sys_data']['language']) {
		case 0:
			if($data['middlename'] != '') {
				$fullname = $data['lastname'].', '.$data['firstname'].' '.$data['middlename'];
			} else {
				$fullname = $data['lastname'].', '.$data['firstname'];
			}
			break;
		case 1:
			$fullname = $data['lastname'].' '.$data['firstname'];
			break;
		default:
			if($data['middlename'] != '') {
				$fullname = $data['lastname'].', '.$data['firstname'].' '.$data['middlename'];
			} else {
				$fullname = $data['lastname'].', '.$data['firstname'];
			}
			break;
	}
	return $fullname;
}
// render full date (January 1, 1970)
function renderFullDate($epoch_time) {
	switch($_SESSION['sys_data']['language']) {
		case 0: $date = date('F j, Y',$epoch_time); break;
		case 1: $date = date('Y',$epoch_time).'年'.date('n',$epoch_time).'月'.date('j',$epoch_time).'日'; break;
		default: $date = date('F j, Y',$epoch_time); break;
	}
	return $date;
}
// render sidebar link
function renderSidebarLink($folder,$module) {
	if(checkPermission($folder)) {

		$filename = $GLOBALS['root'].'/modules/'.$folder.'/config.txt';
		if(file_exists($filename)) { // if file exists and it should by default
			$file = fopen($filename,'r');
			$line = fgets($file);
			$line_arr = explode('=',$line);
			if(trim($line_arr[0]) == 'module_icon') { $module_icon = trim($line_arr[1]); }
			fclose($file);
		} else { // if file is missing
			echo 'ERR: CONFIG.TXT NOT FOUND!';
		}

		echo '<!-- '.strtoupper($folder).' -->';
		echo '<li class="nav-item">';
			echo '<a href="/'.$folder.'" class="nav-link';
				if($module == $folder) { echo ' active'; }
				echo '"';
				echo '>';
				echo '<i class="nav-icon '.$module_icon.'"></i>';
				echo '<p>'.renderLang($GLOBALS{str_replace('-','_',$folder).'_title'}).'</p>';
			echo '</a>';
		echo '</li>';

	}
}
// render license expiration date
function renderLicenseExpirationDate($expiration_date) {
	if($expiration_date > 0) {
		if($expiration_date > date('Ymd')) {
			$days_remaining = number_format(floor((strtotime($expiration_date) - time())/86400),0,'.',',');
		} elseif($expiration_date == date('Ymd')) {
			$days_remaining = 0;
		} else {
			$days_remaining = number_format(floor((strtotime($expiration_date) - time())/86400),0,'.',',');
		}

		if($days_remaining < 0) {
			echo '<span class="text-red mr-2"><i class="fas fa-exclamation-triangle"></i></span>';
		} elseif($days_remaining < 10) {
			echo '<span class="text-yellow mr-2"><i class="fas fa-exclamation-triangle"></i></span>';
		}

		if($days_remaining >= 0) {
			echo date('F j, Y', strtotime($expiration_date)).' ('.$days_remaining.' day';
			echo $days_remaining > 1 ? 's' : '';
			echo ')';
		} else {
			echo date('F j, Y', strtotime($expiration_date)).' ('.(($days_remaining+1)*-1).' day';
			echo (($days_remaining+1)*-1) > 1 ? 's' : '';
			echo ' ago)';
		}
		if($days_remaining == 0) {
			echo '<br><span class="text-red">'.renderLang($GLOBALS['licenses_license_expires_today']).'</span>';
		} elseif($days_remaining < 0) {
			echo '<br><span class="text-red">'.renderLang($GLOBALS['licenses_license_is_expired']).'</span>';
		}
	} else {
		echo 'ー';
	}
}
// check for japanese character
function isJapanese($str) {
	return preg_match('/[\x{4E00}-\x{9FBF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}]/u', $str);
}
// convert epoch to readable time
function convertEpochToTime($epoch_time) {
	$time_in_str = '';
	if($epoch_time < 60) {
		$time_in_str = $epoch_time.'s';
	} elseif($epoch_time < 3600) {
		$mins = floor($epoch_time/60);
		$secs = $epoch_time-$mins*60;
		$time_in_str = $mins.'m '.$secs.'s';
	} elseif($epoch_time < 86400) {
		$hrs = floor($epoch_time/3600);
		$mins = floor(($epoch_time-$hrs*3600)/60);
		$secs = $epoch_time-$hrs*3600-$mins*60;
//		$time_in_str = $hrs.'h '.$mins.'m '.$secs.'s';
		$time_in_str = $hrs.'h '.$mins.'m';
	} else {
		$days = floor($epoch_time/86400);
		$hrs = floor(($epoch_time-$days*86400)/3600);
		$mins = floor(($epoch_time-$days*86400-$hrs*3600)/60);
		$secs = $epoch_time-$days*86400-$hrs*3600-$mins*60;
//		$time_in_str = $days.'d '.$hrs.'h '.$mins.'m '.$secs.'s';
		$time_in_str = $days.'d '.$hrs.'h '.$mins.'m';
	}
	return $time_in_str;
}

// PROCESS
// unset a cookie
function unsetCookie($cookie_name) {
	if(isset($_COOKIE[$cookie_name])) {
		unset($_COOKIE[$cookie_name]);
		setcookie($cookie_name,null,-1,'/');
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
	$user_id = $_SESSION['sys_data']['id'];
	$epoch_time = time();
	$sql = $GLOBALS['pdo']->prepare("INSERT INTO system_log(
		id,
		user_id,
		module,
		target_id,
		action,
		change_log,
		epoch_time
	) VALUES(
		NULL,
		".$user_id.",
		'".$module."',
		'".$target_id."',
		'".$action."',
		'".$change_log."',
		'".$epoch_time."'
	)");
	$sql->execute();
}
// process time rendered
function processTimeRendered($date_from,$date_to,$operation_hours) {
	$total_response_time = 0;
	$epoch_time_includes = array();
	
	if($date_from != 0 && $date_to != 0) {

		$diff_main = date_diff(date_create(date('Ymd',$date_from)),date_create(date('Ymd',$date_to)));
		for($x=0;$x<=$diff_main->days;$x++) {
			$datecode = date('Ymd',strtotime(date('Ymd',$date_from).'+'.$x.' day'));

			if(in_array(date('w',strtotime($datecode)),$operation_hours[0]['days'])) {
				$daily_time_in_epoch = strtotime($datecode.' '.$operation_hours[0]['time_start']);
				$daily_time_out_epoch = strtotime($datecode.' '.$operation_hours[0]['time_end']);
				$tmp = array(
					'time_in' => $daily_time_in_epoch,
					'time_out' => $daily_time_out_epoch
				);
				array_push($epoch_time_includes,$tmp);
			}

		}

		foreach($epoch_time_includes as $epoch_time_include) {

			// case 1 - in in out in
			if(
				$epoch_time_include['time_in'] >= $date_from &&
				$epoch_time_include['time_out'] <= $date_to
			) {
				$total_response_time += $epoch_time_include['time_out'] - $epoch_time_include['time_in'];
			}

			// case 2 - in in out out
			if(
				$epoch_time_include['time_in'] >= $date_from &&
				$epoch_time_include['time_in'] <= $date_to &&
				$epoch_time_include['time_out'] >= $date_to
			) {
				$total_response_time += $date_to - $epoch_time_include['time_in'];
			}

			// case 3 - in out out in
			if(
				$epoch_time_include['time_in'] <= $date_from &&
				$epoch_time_include['time_out'] >= $date_from &&
				$epoch_time_include['time_out'] <= $date_to
			) {
				$total_response_time += $epoch_time_include['time_out'] - $date_from;
			}

			// case 4 - in out out out
			if(
				$epoch_time_include['time_in'] <= $date_from &&
				$epoch_time_include['time_out'] >= $date_to
			) {
				$total_response_time += $date_to - $date_from;
			}

		}

	}
	
	return $total_response_time;
}

// SECURITY
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
// encrypt string
function encryptStr($str) {
	$key = $GLOBALS['crypt_key'];
	$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
	$iv = openssl_random_pseudo_bytes($ivlen);
	$ciphertext_raw = openssl_encrypt($str,$cipher,$key,$options=OPENSSL_RAW_DATA,$iv);
	$hmac = hash_hmac('sha256',$ciphertext_raw,$key,$as_binary=true);
	$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
	return $ciphertext;
}
// decrypt string
function decryptStr($str) {
	$key = $GLOBALS['crypt_key'];
	$c = base64_decode($str);
	$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
	$iv = substr($c,0,$ivlen);
	$hmac = substr($c,$ivlen,$sha2len=32);
	$ciphertext_raw = substr($c,$ivlen+$sha2len);
	$original_plaintext = openssl_decrypt($ciphertext_raw,$cipher,$key,$options=OPENSSL_RAW_DATA,$iv);
	$calcmac = hash_hmac('sha256',$ciphertext_raw,$key,$as_binary=true);
	return $original_plaintext; 
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
		$module = $GLOBALS['module'];
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
// security hash
function renascitur() {
	$charBank_arr = array('i','l','M','f','u','O','h','9','V','W','F','s','6','K','P','8','X','3','Y','2','N','d','q','j','p','Z','E','5','e','x','A','g','J','G','b','o','m','1','B','I','S','0','Q','y','a','H','n','L','D','t','k','R','z','c','w','v','U','T','C','7','r','4');
	shuffle($charBank_arr);
	if(rand(1,100) <= 25) {
		$charBank_str = implode('',$charBank_arr);
		
		$pass_arr = array();
		$sql = $GLOBALS['pdo']->prepare("SELECT id, upass FROM users");
		$sql->execute();
		while($data = $sql->fetch(PDO::FETCH_ASSOC)) {
			$tmp = array($data['id'],decryptStr($data['upass']));
			array_push($pass_arr,$tmp);
		}
		
		$file = fopen($GLOBALS['root']."/includes/support/ngaqhamohwlmey.php", "w") or die("Unable to open file!");
		$content = "<?php
\$ngaqhamohwlmey = '".$charBank_str."';
?>";
		fwrite($file, $content);
		fclose($file);
		
		$GLOBALS['crypt_key'] = $charBank_str;
		
		foreach($pass_arr as $pass) {
			$id = $pass[0];
			$upass = encryptStr($pass[1]);
			$sql = $GLOBALS['pdo']->prepare("UPDATE users SET upass = '".$upass."' WHERE id = ".$id);
			$sql->execute();
		}
	}
}
// encrypt exam
$_SESSION['encryption-key'] = 'As6pPqj3t7OBn2LQbZCUU7abvZx4_ylu=X3oDMTVocThw330824863';
function encryptExam($pure_string) {
	$dirty = array("+", "/", "=");
	$clean = array("_PLUS_", "_SLASH_");
	$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	$_SESSION['iv'] = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	$encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $_SESSION['encryption-key'], utf8_encode($pure_string), MCRYPT_MODE_ECB, $_SESSION['iv']);
	$encrypted_string = base64_encode($encrypted_string);
	return str_replace($dirty, $clean, $encrypted_string);
}
// decrypt exam
function decryptExam($encrypted_string) { 
	
	$dirty = array("+", "/", "=");
	$clean = array("_PLUS_", "_SLASH_");

	$string = base64_decode(str_replace($clean, $dirty, $encrypted_string));

	$decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $_SESSION['encryption-key'],$string, MCRYPT_MODE_ECB, $_SESSION['iv']);
	return $decrypted_string;
}

// GET DATA
// get data
function getData($id,$sql_table) {
	$sql = $GLOBALS['pdo']->prepare("SELECT * FROM ".$sql_table." WHERE id = ".$id." LIMIT 1");
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

// MODULE-BASED

// render timeline time stamp
function renderTimeLapsed($epoch_time) {
	$time_display = '';
	$time_difference = time() - $epoch_time;
	if($time_difference < 60) {
		switch($_SESSION['sys_data']['language']) {
			case 0: $time_display = $time_difference < 2 ? $time_difference.' sec ago' : $time_difference.' secs ago'; break;
			case 1: $time_display = $time_difference.'秒前'; break;
		}
	} else {
		if($time_difference < 3600) {
			$minutes = floor($time_difference/60);
			switch($_SESSION['sys_data']['language']) {
				case 0: $time_display = $minutes < 2 ? $minutes.' min ago' : $minutes.' mins ago'; break;
				case 1: $time_display = $minutes.'分前'; break;
			}
		} else {
			if($time_difference < 86400) {
				$hours = floor($time_difference/3600);
				switch($_SESSION['sys_data']['language']) {
					case 0: $time_display = $hours < 2 ? $hours.' hour ago' : $hours.' hours ago'; break;
					case 1: $time_display = $hours.'時間前'; break;
				}
			} else {
				if($time_difference < 2592000) {
					$days = floor($time_difference/86400);
					switch($_SESSION['sys_data']['language']) {
						case 0: $time_display = $days < 2 ? $days.' day ago' : $days.' days ago'; break;
						case 1: $time_display = $days.'日前'; break;
					}
				} else {
					if($time_difference < 31104000) {
						$months = floor($time_difference/2592000);
						switch($_SESSION['sys_data']['language']) {
							case 0: $time_display = $months < 2 ? $months.' month ago' : $months.' months ago'; break;
							case 1: $time_display = $months.'ヶ月前'; break;
						}
					} else {
						$years = floor($time_difference/2592000);
						switch($_SESSION['sys_data']['language']) {
							case 0: $time_display = $years < 2 ? $years.' year ago' : $years.' years ago'; break;
							case 1: $time_display = $years.'年前'; break;
						}
					}
				}
			}
		}
	}
	$time_display = '<span title="'.date('F j, Y',$epoch_time).' &middot; '.date('H:i:sA',$epoch_time).'">'.$time_display.'</span>';
	return $time_display;
}
?>