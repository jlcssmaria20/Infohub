<?php
$permissions_arr = array(


	// TEST =========================================================================================
	// array(
	// 	array(
	// 		'permission_code' => 'test',
	// 		'permission_name' => array(
	// 			'Test List',
	// 			''
	// 		),
	// 		'permission_description' => array(
	// 			'Allow account to access test list',
	// 			''
	// 		)
	// 	),
	// 	array(
	// 		'permission_code' => 'test-add',
	// 		'permission_name' => array(
	// 			'Add Test Data',
	// 			''
	// 		),
	// 		'permission_description' => array(
	// 			'Allow account to add test data.',
	// 			''
	// 		)
	// 	),
	// 	array(
	// 		'permission_code' => 'test-edit',
	// 		'permission_name' => array(
	// 			'Edit Test Data',
	// 			''
	// 		),
	// 		'permission_description' => array(
	// 			'Allow account to update test data.',
	// 			''
	// 		)
	// 	),
	// 	array(
	// 		'permission_code' => 'test-delete',
	// 		'permission_name' => array(
	// 			'Delete Test Data',
	// 			''
	// 		),
	// 		'permission_description' => array(
	// 			'Allow account to delete test data.',
	// 			''
	// 		)
	// 	)
	// ),
		// DOCUMENTS =========================================================================================
		array(
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
				'permission_code' => 'file-add',
				'permission_name' => array(
					'Add File Data',
					''
				),
				'permission_description' => array(
					'Allow account to add file data.',
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
		),
		// ANNOUNCEMENTS =================================
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
		),
		// TEAMS =================================
		array(
			array(
				'permission_code' => 'teams',
				'permission_name' => array(
					'Team List',
					''
				),
				'permission_description' => array(
					'Allow account to access team list',
					''
				)
			),
			array(
				'permission_code' => 'team-add',
				'permission_name' => array(
					'Add New Team',
					''
				),
				'permission_description' => array(
					'Allow account to add new team.',
					''
				)
			),
			array(
				'permission_code' => 'team-edit',
				'permission_name' => array(
					'Edit Team Details',
					''
				),
				'permission_description' => array(
					'Allow account to update team details.',
					''
				)
			),
			array(
				'permission_code' => 'team-delete',
				'permission_name' => array(
					'Delete Teeam',
					''
				),
				'permission_description' => array(
					'Allow account to delete team.',
					''
				)
			)
		),

		// WEBINAR-AND-EVENTS =================================
		array(
			array(
				'permission_code' => 'webinar-and-events',
				'permission_name' => array(
					'Webinar and Events List',
					''
				),
				'permission_description' => array(
					'Allow account to access webinar and events list',
					''
				)
			),
			array(
				'permission_code' => 'webinar-events-add',
				'permission_name' => array(
					'Add Webinar and Events Data',
					''
				),
				'permission_description' => array(
					'Allow account to add webinar and events data.',
					''
				)
			),
			array(
				'permission_code' => 'webinar-events-edit',
				'permission_name' => array(
					'Edit Webinar and Events Data',
					''
				),
				'permission_description' => array(
					'Allow account to update webinar and events data.',
					''
				)
			),
			array(
				'permission_code' => 'webinar-events-delete',
				'permission_name' => array(
					'Delete Webinar and Events Data',
					''
				),
				'permission_description' => array(
					'Allow account to delete webinar and events data.',
					''
				)
			)
		),
			// ROLES =========================================================================================
		array(
			array(
				'permission_code' => 'roles',
				'permission_name' => array(
					'Roles Management',
					'???????????????'
				),
				'permission_description' => array(
					'Allow account to access roles list and view permissions.',
					'??????????????????????????????????????????????????????????????????????????????????????????'
				)
			),
			array(
			'permission_code' => 'role-add',
			'permission_name' => array(
				'Add Role',
				'???????????????'
			),
			'permission_description' => array(
				'Allow account to add role group.',
				'??????????????????????????????????????????????????????????????????'
			)
		),
		array(
			'permission_code' => 'role-edit',
			'permission_name' => array(
				'Edit Role',
				'???????????????'
			),
			'permission_description' => array(
				'Allow account to update role name and permissions.',
				'?????????????????????????????????????????????????????????????????????'
			)
		),
		array(
			'permission_code' => 'role-delete',
			'permission_name' => array(
				'Delete Role',
				'???????????????'
			),
			'permission_description' => array(
				'Allow account to delete role.',
				'???????????????????????????????????????????????????'
			)
		)
	),

	// ADMINS =========================================================================================
	array(
		array(
			'permission_code' => 'admins',
			'permission_name' => array(
				'Admins Management',
				'??????????????????'
			),
			'permission_description' => array(
				'Allow account to access admins list and view admin profile.',
				'?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????'
			)
		),
		array(
			'permission_code' => 'admin-add',
			'permission_name' => array(
				'Add Admin',
				'??????????????????'
			),
			'permission_description' => array(
				'Allow account to add admin account.',
				'?????????????????????????????????????????????????????????????????????'
			)
		),
		array(
			'permission_code' => 'admin-edit',
			'permission_name' => array(
				'Edit Admin',
				'??????????????????'
			),
			'permission_description' => array(
				'Allow account to update admin account details.',
				'??????????????????????????????????????????????????????????????????????????????'
			)
		),
		array(
			'permission_code' => 'admin-delete',
			'permission_name' => array(
				'Delete Admin',
				'??????????????????'
			),
			'permission_description' => array(
				'Allow account to delete admin account.',
				'?????????????????????????????????????????????????????????????????????'
			)
		)
	), 
	// USERS =========================================================================================
	array(
		array(
			'permission_code' => 'users',
			'permission_name' => array(
				'Users Management',
				'??????????????????'
			),
			'permission_description' => array(
				'Allow account to access users list and view user profile.',
				'????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????'
			)
		),
		array(
			'permission_code' => 'user-add',
			'permission_name' => array(
				'Add User',
				'?????????????????????'
			),
			'permission_description' => array(
				'Allow account to add user account.',
				'?????????????????????????????????????????????????????????'
			)
		),
		array(
			'permission_code' => 'user-edit',
			'permission_name' => array(
				'Edit User',
				'?????????????????????'
			),
			'permission_description' => array(
				'Allow account to update user account details.',
				'??????????????????????????????????????????????????????????????????????????????'
			)
		),
		array(
			'permission_code' => 'user-delete',
			'permission_name' => array(
				'Delete User',
				'?????????????????????'
			),
			'permission_description' => array(
				'Allow account to delete user record.',
				'???????????????????????????????????????????????????????????????'
			)
		),
		array(
			'permission_code' => 'export-users-actual-time',
			'permission_name' => array(
				'Export Users Actual Time',
				'????????????????????????????????????????????????'
			),
			'permission_description' => array(
				'Allow exporting users actual time.',
				'????????????????????????????????????????????????????????????'
			)
		),
		
	),

	// GENERAL =========================================================================================
	array(
		array(
			'permission_code' => 'general',
			'permission_name' => array(
				'General',
				''
			),
			'permission_description' => array(
				'Allow account to access general',
				''
			)
		)
	)

	// GENERAL =========================================================================================
	// array(
	// 	array(
	// 		'permission_code' => 'general',
	// 		'permission_name' => array(
	// 			'General',
	// 			''
	// 		),
	// 		'permission_description' => array(
	// 			'Allow account to view general tab',
	// 			''
	// 		)
	// 	),
	// 	array(
	// 		'permission_code' => 'general-update-account',
	// 		'permission_name' => array(
	// 			'Update Account',
	// 			''
	// 		),
	// 		'permission_description' => array(
	// 			'Allow account to update account.',
	// 			''
	// 		)
	// 	)
	// )


);

	
$permissions_count = 0;
foreach($permissions_arr as $permissions_group) {
	$permissions_count += count($permissions_group);
}
?>