<?php
switch($data['module']) {

	case 'users':
		$_data = getData($data['target_id'],'users');
		echo '<a href="/user/'.encryptID($_data['id'],'users').'">';
		switch($_SESSION['sys_data']['language']) {
			case 0:
				echo '['.$_data['employeeid'].'] '.$_data['firstname'].' '.$_data['lastname'];
				break;
			case 1:
				echo '['.$_data['employeeid'].'] '.$_data['lastname'].' '.$_data['firstname'];
				break;
		}
		echo '</a>';
		break;

}
?>