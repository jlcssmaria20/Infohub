<?php
// clear sessions
$fields = array(
	'title', 
	'images',
	'date_set',
	'date_now',
	'roles',
	'status',
);
unsetSessions($module,$fields,$process_arr,$data_type_arr);
?>