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
		),
		// document =========================================================================================
		array(
			'permission_code' => 'documents',
			'permission_name' => array(
				'Document List',
				''
			),
			'permission_description' => array(
				'Allow account to access document list',
				''
			)
		),
		array(
			'permission_code' => 'document-add',
			'permission_name' => array(
				'Add Document Data',
				''
			),
			'permission_description' => array(
				'Allow account to add document data.',
				''
			)
		),
		array(
			'permission_code' => 'document-edit',
			'permission_name' => array(
				'Edit Document Data',
				''
			),
			'permission_description' => array(
				'Allow account to update document data.',
				''
			)
		),
		array(
			'permission_code' => 'document-delete',
			'permission_name' => array(
				'Delete Document Data',
				''
			),
			'permission_description' => array(
				'Allow account to delete document data.',
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