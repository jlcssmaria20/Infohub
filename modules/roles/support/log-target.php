<?php
switch($data['module']) {

	case 'roles':
		$_data = getData($data['target_id'],'roles');
		echo '<a href="/role/'.$_data['id'].'">'.$_data['role_name'].'</a>';
		break;
		
}
?>