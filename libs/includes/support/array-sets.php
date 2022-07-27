<?php
// language array
$language_arr = array(
	array(0,'English'),
	array(1,'日本語')
);

// status array
$status_arr = array(
	array(
		'Active',
		'アクティブ'
	),
	array(
		'Deactivated',
		'無効化'
	),
	array(
		'Deleted',
		'削除しました'
	)
);



// // civil status array
// $sql = $pdo->prepare("SELECT * FROM app_civil_status_arr");
// $sql->execute();
// $data = $sql->fetchAll(PDO::FETCH_ASSOC);
// $civil_status_arr = [];
// foreach($data as $value) {
// 	$civil_status_arr[] = [$value['civil_statusArr']];
// }


// gender array
$gender_arr = array(
	array(
		'Male',
		'男性'
	),
	array(
		'Female',
		'女性'
	)
);



$applicant_position_arr = array(
	array(
		'Option 01',
		''
	),
	array(
		'Option 02',
		''
	),
	array(
		'Option 03',
		''
	),
	array(
		'Option 04',
		''
	)
);

$applicant_pooling_arr = array(
	array(
		'Option 01',
		''
	),
	array(
		'Option 02',
		''
	),
	array(
		'Option 03',
		''
	),
	array(
		'Option 04',
		''
	)
);

$pooling_arr = array(
	array(
		'Pooling',
		''
	),
	array(
		'Pending',
		''
	),
	array(
		'Rejected',
		''
	),
	array(
		'Job Offer',
		''
	),array(
		'For Exam',
		''
	),
	array(
		'Initial Interview',
		''
	),
	array(
		'Final Interview',
		''
	),
	array(
		'For Screening',
		''
	),
	array(
		'Account Interview',
		''
	),
	array(
		'Hired',
		''
	),
	
);

$assessment_arr = array(
	array(
		'Pending',
		''
	),
	array(
		'For Screening',
		''
	),
	array(
		'For Assessment',
		''
	),
	array(
		'For Initial Interview',
		''
	),
	array(
		'For Final Interview',
		''
	)
);

$applicantType_arr = array(
	array(
		'Voice (Inbound)',
		''
	),
	array(
		'Voice (Outbound)',
		''
	),
	array(
		'Non-Voice (Email)',
		''
	),
	array(
		'Non-Voice (Chat)',
		''
	),
	array(
		'Blended (Voice and Non-Voice)',
		''
	)
);


$work_on_site_arr = array(
	array(
		'Yes',
		''
	),
	array(
		'No',
		''
	)
);

$wfh_arr = array(
	array(
		'Yes',
		''
	),
	array(
		'No',
		''
	)
);

$work_onshiftings_ched_arr = array(
	array(
		'Yes',
		''
	),
	array(
		'No',
		''
	)
);

$fraud1_arr = array(
	array(
		'Yes',
		''
	),
	array(
		'No',
		''
	)
);

$fraud2_arr = array(
	array(
		'Yes',
		''
	),
	array(
		'No',
		''
	)
);

$fraud3_arr = array(
	array(
		'Yes',
		''
	),
	array(
		'No',
		''
	)
);


// Exam Timer Level
$examTime = array(
	array(
		'20 Minutes',
		''
	),
	array(
		'30 Minutes',
		''
	),
	array(
		'40 Minutes',
		''
	),
	array(
		'50 Minutes',
		''
	),

	array(
		'1 Hour',
		''
	),
	array(
		'1 Hour and 10 Minutes',
		''
	),
	array(
		'1 Hour and 20 Minutes',
		''
	),
	array(
		'1 Hour and 30 Minutes',
		''
	),
	array(
		'1 Hour and 40 Minutes',
		''
	),
	array(
		'1 Hour and 50 Minutes',
		''
	),
	array(
		'1 Hour and 55 Minutes',
		''
	),
	array(
		'2 Hours',
		''
	),
);

// Exam Question Level
$examTime = array(
	array(
		'10',
		''
	),
	array(
		'20',
		''
	),
	array(
		'30',
		''
	),
	array(
		'35',
		''
	),

	array(
		'40',
		''
	),
	array(
		'50',
		''
	),
	array(
		'60',
		''
	),
	array(
		'65',
		''
	),
	array(
		'70',
		''
	),
	array(
		'80',
		''
	),
	array(
		'90',
		''
	),
	array(
		'100',
		''
	),
);

// excepted modules in system log
$exceptions_folder_arr = array(
	'dashboard',
	'newsfeed',
	'login',
	'system-log'
);

// timeline color coding
$timeline_color_codes_arr = array(
	'#f7f7ff',
	'#fffff7',
	'#fff7f7'
);

// security questions array
$security_questions_arr = array(
	array(
		'What is your favorite book?',
		'あなたの好きな本は何ですか？'
	),
	array(
		'What is the name of the road you grew up on?',
		'あなたが育った道の名前は？'
	),
	array(
		'What is your mother&#39;s maiden name?',
		'あなたの母親の旧姓は何ですか？'
	),
	array(
		'What was the name of your first pet?',
		'あなたが最初に飼ったペットの名前は？'
	),
	array(
		'What was the first company that you worked for?',
		'あなたが最初に働いた会社は何でしたか？'
	),
	array(
		'Where did you meet your spouse?',
		'どこであなたの伴侶と出会ったのですか？'
	),
	array(
		'Where did you go to high college?',
		'どこの高校に行きましたか？'
	),
	array(
		'What is your favorite food?',
		'好きな食べ物は何ですか？'
	),
	array(
		'What city were you born in?',
		'どこの町で生まれたの？'
	),
	array(
		'Where is your favorite place to vacation?',
		'休暇にお気に入りの場所はどこですか？'
	)
);
?>