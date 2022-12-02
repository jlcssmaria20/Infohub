<?php
// language array
$language_arr = array(
	array(0,'English'),
	array(1,'日本語')
);

// yes/no array
$lang_yesno_arr = array(
	array('No','不可'),
	array('Yes','可能')
);

$months_arr = array(
	array(0,
		array(
			'Apr',
			'4月'
		)
	),
	array(1,
		array(
			'May',
			'5月'
		)
	),
	array(2,
		array(
			'June',
			'6月'
		)
	),
	array(3,
		array(
			'July',
			'7月'
		)
	),
	array(4,
		array(
			'Aug',
			'8月'
		)
	),
	array(5,
		array(
			'Sep',
			'9月'
		)
	),
	array(6,
		array(
			'Oct',
			'10月'
		)
	),
	array(7,
		array(
			'Nov',
			'11月'
		)
	),
	array(8,
		array(
			'Dec',
			'12月'
		)
	),
	array(9,
		array(
			'Jan',
			'1月'
		)
	),
	array(10,
		array(
			'Feb',
			'2月'
		)
	),
	array(11,
		array(
			'March',
			'3月'
		)
	),
);

// gender array
$gender_arr = array(
	array(
		0,
		array(
			'Female',
			'女性'
		)
	),
	array(
		1,
		array(
			'Male',
			'男性'
		)
	)
);

// status array
$status_arr = array(
	array(0,
		array(
			'Active',
			'アクティブ'
		)
	),
	array(1,
		array(
			'Deactivated',
			'無効化'
		)
	),
);
//$start = $month = strtotime('2018-10-01');
$months_temp = array();
$start = $month = strtotime('2017-01-01');
$end =  strtotime('+12 months',time());
while($month < $end)
{
	$yrmo_ctr = date('Ym', $month);
    $month = strtotime("+1 month", $month);
	array_push($months_temp,$yrmo_ctr); 
}
$config_months_select_arr = array_reverse($months_temp);
?>