<?php
// render referral head
if($field_name == 'referrals_referral_head') {
	
	if($from_val == 0) {
		$from_val = 'TBD';
	} else {
		$from_val_data = getData($from_val,'users');
		$from_val = renderName($from_val_data);
	}
	
	if($to_val == 0) {
		$to_val = 'TBD';
	} else {
		$to_val_data = getData($to_val,'users');
		$to_val = renderName($to_val_data);
	}

}

?>