<?php
// clear sessions
$fields = array(
	'role',
	'role_name',
	'permissions',
	'status'
);
unsetSessions($module,$fields,$process_arr,$data_type_arr);
?>