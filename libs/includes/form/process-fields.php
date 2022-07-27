<?php
foreach($fields as $field) {

	// set initial value
	${$field} = in_array($field,$string) ? '' : 0;

	if(isset($_POST[$field])) {
		
		${$field} = trim($_POST[$field]);

		// CHECK FORMAT VALIDITY
		// check if field needs to transform to proper case (ucwords)
		if(isset($ucwords)) {
			if(in_array($field,$ucwords)) { ${$field} = ucwords(strtolower(trim($_POST[$field]))); }
		}
		// check if field needs to transform to upper case (strtoupper)
		if(isset($strtoupper)) {
			if(in_array($field,$strtoupper)) { ${$field} = strtoupper(trim($_POST[$field])); }
		}
		// check if field needs to transform to lower case (strtolower)
		if(isset($strtolower)) {
			if(in_array($field,$strtolower)) { ${$field} = strtolower(trim($_POST[$field])); }
		}
		// check if field needs to remove space
		if(isset($nospace)) {
			if(in_array($field,$nospace)) { ${$field} = str_replace(' ','',$_POST[$field]); }
		}
		if(isset($string)) {
			if(
				// insert EXCEPTION from html entities
				$module == 'tickets' && $field == 'message' ||
				$module == 'posts' && $field == 'message' 
			) {} else {
				${$field} = in_array($field,$string) ? htmlentities($_POST[$field]) : trim($_POST[$field]);
			}
		}

		// DECRYPT FIELDS WITH "_id"
		if(!in_array($field,$string)) {
			if(strpos($field,'_id') > -1) {
				${$field} = decryptID(${$field},str_replace('_id','',$field).'s');
			}
		}
		
		if(isset($from_array)) {
			if(in_array($field,$from_array)) {
				${$field} = decryptID(${$field},$field);
			}
		}
		
		// SET SESSION VALUE FOR FIELD
		$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'] = ${$field};

		// CHECK REQUIRED FIELDS
		if(isset($required)) {
			if(in_array($field,$required)) {
				if(strlen(${$field}) == 0) {
					$err++;
					$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_err'] = renderLang(${$module.'_'.$field.'_required'});
				} else {
					$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_val'] = ${$field};
				}
			}
		}

		// CHECK UNIQUE FIELDS
		if(isset($unique)) {
			if(in_array($field,$unique)) {
				switch($process) {
					case 'add':
						$sql = $pdo->prepare("SELECT ".$field." FROM ".$module." WHERE ".$field."=:".$field." LIMIT 1");
						break;
					case 'edit':
						$sql = $pdo->prepare("SELECT ".$field." FROM ".$module." WHERE ".$field."=:".$field." AND id<>".$id." LIMIT 1");
						break;
				}
				$sql->bindParam(":".$field,${$field});
				$sql->execute();
				if($sql->rowCount()) {
					$err++;
					$_SESSION['sys_'.$module.'_'.$process.'_'.$field.'_err'] = renderLang(${$module.'_'.$field.'_exists'});
				}
			}
		}

	}
}
?>