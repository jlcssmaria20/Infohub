<?php
switch($data['module']) {

	case 'referrals':
		$_data = getData($data['target_id'],'referrals');
		echo '<a href="/referral/'.encryptID($_data['id'],'referrals').'">';
			echo '['.$_data['code'].'] '.$_data['name'];
		echo '</a>';
		break;

}
?>