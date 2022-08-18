<?php
$permissions_arr = array(


	// TEST =========================================================================================
	array(
		array(
			'permission_code' => 'test',
			'permission_name' => array(
				'Test List',
				''
			),
			'permission_description' => array(
				'Allow account to access test list',
				''
			)
		),
		array(
			'permission_code' => 'test-add',
			'permission_name' => array(
				'Add Test Data',
				''
			),
			'permission_description' => array(
				'Allow account to add test data.',
				''
			)
		),
		array(
			'permission_code' => 'test-edit',
			'permission_name' => array(
				'Edit Test Data',
				''
			),
			'permission_description' => array(
				'Allow account to update test data.',
				''
			)
		),
		array(
			'permission_code' => 'test-delete',
			'permission_name' => array(
				'Delete Test Data',
				''
			),
			'permission_description' => array(
				'Allow account to delete test data.',
				''
			)
		)
	)
	
	// ANNOUNCEMENTS =========================================================================================
	array(
		array(
			'permission_code' => 'announcements',
			'permission_name' => array(
				'Announcement List',
				''
			),
			'permission_description' => array(
				'Allow account to access announcement list',
				''
			)
		),
		array(
			'permission_code' => 'announcements-add',
			'permission_name' => array(
				'Add Announcement Data',
				''
			),
			'permission_description' => array(
				'Allow account to add announcement data.',
				''
			)
		),
		array(
			'permission_code' => 'announcements-edit',
			'permission_name' => array(
				'Edit Announcement Data',
				''
			),
			'permission_description' => array(
				'Allow account to update announcement data.',
				''
			)
		),
		array(
			'permission_code' => 'announcements-delete',
			'permission_name' => array(
				'Delete Announcement Data',
				''
			),
			'permission_description' => array(
				'Allow account to delete announcement data.',
				''
			)
		)


	)
);	

	
$permissions_count = 0;
foreach($permissions_arr as $permissions_group) {
	$permissions_count += count($permissions_group);
}
?>