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
	);	

	
$permissions_count = 0;
foreach($permissions_arr as $permissions_group) {
	$permissions_count += count($permissions_group);
}
?>