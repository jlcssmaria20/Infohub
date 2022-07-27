<?php
// clear sessions
$fields = array(
	'uname',
	'employeeid',
	'firstname',
	'middlename',
	'lastname',
	'gender',
	'civil_status',
	'email',
	'mobile',
	'application_id',
	'referral_id',
	'date_start',
	'date_end',
	'roleids',
	'status'
);
unsetSessions($module,$fields,$process_arr,$data_type_arr);
?>