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
	),
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
					'役割の管理'
				),
				'permission_description' => array(
					'Allow account to access roles list and view permissions.',
					'アカウントに役割一覧へのアクセスまたは許可の表示を許可する。'
				)
			),
			array(
			'permission_code' => 'role-add',
			'permission_name' => array(
				'Add Role',
				'役割を追加'
			),
			'permission_description' => array(
				'Allow account to add role group.',
				'アカウントに役割のグループの追加を許可する。'
			)
		),
		array(
			'permission_code' => 'role-edit',
			'permission_name' => array(
				'Edit Role',
				'役割を修正'
			),
			'permission_description' => array(
				'Allow account to update role name and permissions.',
				'アカウントに役割名または許可の更新を許可する。'
			)
		),
		array(
			'permission_code' => 'role-delete',
			'permission_name' => array(
				'Delete Role',
				'役割を削除'
			),
			'permission_description' => array(
				'Allow account to delete role.',
				'アカウントに役割の削除を許可する。'
			)
		)
	),

	// ADMINS =========================================================================================
	array(
		array(
			'permission_code' => 'admins',
			'permission_name' => array(
				'Admins Management',
				'管理者の管理'
			),
			'permission_description' => array(
				'Allow account to access admins list and view admin profile.',
				'アカウントに管理者一覧へのアクセスまたは管理者のプロフィールの表示を許可する。'
			)
		),
		array(
			'permission_code' => 'admin-add',
			'permission_name' => array(
				'Add Admin',
				'管理者を追加'
			),
			'permission_description' => array(
				'Allow account to add admin account.',
				'アカウントに管理者アカウントの追加を許可する。'
			)
		),
		array(
			'permission_code' => 'admin-edit',
			'permission_name' => array(
				'Edit Admin',
				'管理者を修正'
			),
			'permission_description' => array(
				'Allow account to update admin account details.',
				'アカウントに管理者アカウントの詳細の更新を許可する。'
			)
		),
		array(
			'permission_code' => 'admin-delete',
			'permission_name' => array(
				'Delete Admin',
				'管理者を削除'
			),
			'permission_description' => array(
				'Allow account to delete admin account.',
				'アカウントに管理者アカウントの削除を許可する。'
			)
		)
			), 
			// USERS =========================================================================================
	array(
		array(
			'permission_code' => 'users',
			'permission_name' => array(
				'Users Management',
				'ユーザー管理'
			),
			'permission_description' => array(
				'Allow account to access users list and view user profile.',
				'アカウントにユーザー一覧へのアクセスまたはユーザープロフィールの表示を許可する。'
			)
		),
		array(
			'permission_code' => 'user-add',
			'permission_name' => array(
				'Add User',
				'ユーザーを追加'
			),
			'permission_description' => array(
				'Allow account to add user account.',
				'アカウントにユーザーの追加を許可する。'
			)
		),
		array(
			'permission_code' => 'user-edit',
			'permission_name' => array(
				'Edit User',
				'ユーザーを修正'
			),
			'permission_description' => array(
				'Allow account to update user account details.',
				'アカウントにユーザーアカウント詳細の更新を許可する。'
			)
		),
		array(
			'permission_code' => 'user-delete',
			'permission_name' => array(
				'Delete User',
				'ユーザーを削除'
			),
			'permission_description' => array(
				'Allow account to delete user record.',
				'アカウントにユーザー記録の削除を許可する。'
			)
		),
		array(
			'permission_code' => 'export-users-actual-time',
			'permission_name' => array(
				'Export Users Actual Time',
				'ユーザーの実際時間のエクスポート'
			),
			'permission_description' => array(
				'Allow exporting users actual time.',
				'ユーザーの実工数のエクスポートを許可する'
			)
		),
		
	)


);

	
$permissions_count = 0;
foreach($permissions_arr as $permissions_group) {
	$permissions_count += count($permissions_group);
}
?>