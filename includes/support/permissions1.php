<?php
$permissions_arr = array(



	// REFERRAL =========================================================================================
	array(
		array(
			'permission_code' => 'referrals',
			'permission_name' => array(
				'Referrals Management',
				'チーム管理'
			),
			'permission_description' => array(
				'Allow account to access referrals list.',
				'アカウントにチームリストへのアクセスを許可します。'
			)
		),
		array(
			'permission_code' => 'referrals-add',
			'permission_name' => array(
				'Add Referral',
				'チームを追加'
			),
			'permission_description' => array(
				'Allow account to referral.',
				'チームにアカウントを許可します。'
			)
		),
		array(
			'permission_code' => 'referrals-edit',
			'permission_name' => array(
				'Edit Referral',
				'チームを編集'
			),
			'permission_description' => array(
				'Allow account to update referral details.',
				'アカウントがチームの詳細を更新できるようにします。'
			)
		),
		array(
			'permission_code' => 'referrals-delete',
			'permission_name' => array(
				'Delete Referral',
				'チームを削除'
			),
			'permission_description' => array(
				'Allow account to delete referral.',
				'アカウントにチームの削除を許可します。'
			)
		),
		array(
			'permission_code' => 'referrals-restore',
			'permission_name' => array(
				'Restore Referral',
				'チームを復元'
			),
			'permission_description' => array(
				'Allow account to restore deleted referral.',
				'削除されたチームの復元をアカウントに許可します。'
			)
		)
	),

	// EXAM ADMIN =========================================================================================
	array(
		array(
			'permission_code' => 'examadmins',
			'permission_name' => array(
				'Admin Exam Management',
				''
			),
			'permission_description' => array(
				'Allow account to access examadmins list.',
				''
			)
		),
		array(
			'permission_code' => 'examadmins-add',
			'permission_name' => array(
				'Add Admin Exam',
				''
			),
			'permission_description' => array(
				'Allow account to examadmin.',
				''
			)
		),
		array(
			'permission_code' => 'examadmins-edit',
			'permission_name' => array(
				'Edit Admin Exam',
				''
			),
			'permission_description' => array(
				'Allow account to update examadmin details.',
				''
			)
		),
		array(
			'permission_code' => 'examadmins-delete',
			'permission_name' => array(
				'Delete Admin Exam',
				''
			),
			'permission_description' => array(
				'Allow account to delete examadmin.',
				''
			)
		),
		array(
			'permission_code' => 'examadmins-restore',
			'permission_name' => array(
				'Restore Admin Exam',
				''
			),
			'permission_description' => array(
				'Allow account to restore deleted examadmin.',
				''
			)
		)
	),


	// EXAM LIST =========================================================================================
	array(
		array(
			'permission_code' => 'examlists',
			'permission_name' => array(
				'Exam List Management',
				''
			),
			'permission_description' => array(
				'Allow account to access examadmins list.',
				''
			)
		),
		array(
			'permission_code' => 'examlists-add',
			'permission_name' => array(
				'Add Exam list',
				''
			),
			'permission_description' => array(
				'Allow account to exam list.',
				''
			)
		),
		array(
			'permission_code' => 'examlists-edit',
			'permission_name' => array(
				'Edit Exam list',
				''
			),
			'permission_description' => array(
				'Allow account to update exam list details.',
				''
			)
		),
		array(
			'permission_code' => 'examlists-delete',
			'permission_name' => array(
				'Delete Exam List',
				''
			),
			'permission_description' => array(
				'Allow account to delete exam list.',
				''
			)
		),
		array(
			'permission_code' => 'examlists-restore',
			'permission_name' => array(
				'Restore Exam list',
				''
			),
			'permission_description' => array(
				'Allow account to restore deleted examadmin.',
				''
			)
		)
	),
	

	// APPLICATION FORMS =========================================================================================
	array(
		array(
			'permission_code' => 'applications',
			'permission_name' => array(
				'application forms Management',
				''
			),
			'permission_description' => array(
				'Allow account to access application forms list.',
				''
			)
		),
		array(
			'permission_code' => 'applications-add',
			'permission_name' => array(
				'Add application',
				''
			),
			'permission_description' => array(
				'Allow account to application.',
				''
			)
		),
		array(
			'permission_code' => 'applications-edit',
			'permission_name' => array(
				'Edit application',
				''
			),
			'permission_description' => array(
				'Allow account to update application form details.',
				''
			)
		),
		array(
			'permission_code' => 'applications-delete',
			'permission_name' => array(
				'Delete application',
				''
			),
			'permission_description' => array(
				'Allow account to delete application form.',
				''
			)
		),
		array(
			'permission_code' => 'applications-restore',
			'permission_name' => array(
				'Restore application',
				''
			),
			'permission_description' => array(
				'Allow account to restore deleted applicationForm.',
				''
			)
		)
	),

	// POOLINGS =========================================================================================
	array(
		array(
			'permission_code' => 'poolings',
			'permission_name' => array(
				'poolings Management',
				''
			),
			'permission_description' => array(
				'Allow account to access poolings list.',
				''
			)
		),
		array(
			'permission_code' => 'poolings-add',
			'permission_name' => array(
				'Add Pooling',
				''
			),
			'permission_description' => array(
				'Allow account to pooling.',
				''
			)
		),
		array(
			'permission_code' => 'poolings-edit',
			'permission_name' => array(
				'Edit Pooling',
				''
			),
			'permission_description' => array(
				'Allow account to update pooling details.',
				''
			)
		),
		array(
			'permission_code' => 'poolings-delete',
			'permission_name' => array(
				'Delete Pooling',
				''
			),
			'permission_description' => array(
				'Allow account to delete pooling.',
				''
			)
		),
		array(
			'permission_code' => 'poolings-restore',
			'permission_name' => array(
				'Restore Pooling',
				''
			),
			'permission_description' => array(
				'Allow account to restore deleted pooling.',
				''
			)
		)
	),

		// applicantsPositionS =========================================================================================
		array(
			array(
				'permission_code' => 'applicantsPositions',
				'permission_name' => array(
					'applicantsPositions Management',
					''
				),
				'permission_description' => array(
					'Allow account to access applicantsPositions list.',
					''
				)
			),
			array(
				'permission_code' => 'applicantsPositions-add',
				'permission_name' => array(
					'Add applicantsPosition',
					''
				),
				'permission_description' => array(
					'Allow account to applicantsPosition.',
					''
				)
			),
			array(
				'permission_code' => 'applicantsPositions-edit',
				'permission_name' => array(
					'Edit applicantsPosition',
					''
				),
				'permission_description' => array(
					'Allow account to update applicantsPosition details.',
					''
				)
			),
			array(
				'permission_code' => 'applicantsPositions-delete',
				'permission_name' => array(
					'Delete applicantsPosition',
					''
				),
				'permission_description' => array(
					'Allow account to delete applicantsPosition.',
					''
				)
			),
			array(
				'permission_code' => 'applicantsPositions-restore',
				'permission_name' => array(
					'Restore applicantsPosition',
					''
				),
				'permission_description' => array(
					'Allow account to restore deleted applicantsPosition.',
					''
				)
			)
		),

	
	// JOB POSTING =========================================================================================
	array(
		array(
			'permission_code' => 'jobpostings',
			'permission_name' => array(
				'Job Posting Management',
				'チーム管理'
			),
			'permission_description' => array(
				'Allow account to access Job Posting list.',
				'アカウントにチームリストへのアクセスを許可します。'
			)
		),
		array(
			'permission_code' => 'jobpostings-add',
			'permission_name' => array(
				'Add Job Posting',
				'チームを追加'
			),
			'permission_description' => array(
				'Allow account to Job Posting.',
				'チームにアカウントを許可します。'
			)
		),
		array(
			'permission_code' => 'jobpostings-edit',
			'permission_name' => array(
				'Edit Job Posting',
				'チームを編集'
			),
			'permission_description' => array(
				'Allow account to update Job Posting details.',
				'アカウントがチームの詳細を更新できるようにします。'
			)
		),
		array(
			'permission_code' => 'jobpostings-delete',
			'permission_name' => array(
				'Delete Job Posting',
				'チームを削除'
			),
			'permission_description' => array(
				'Allow account to delete Job Posting.',
				'アカウントにチームの削除を許可します。'
			)
		),
		array(
			'permission_code' => 'jobpostings-restore',
			'permission_name' => array(
				'Restore Job Posting',
				'チームを復元'
			),
			'permission_description' => array(
				'Allow account to restore deleted Job Posting.',
				'削除されたチームの復元をアカウントに許可します。'
			)
		)
	),







// EXAM! =========================================================================================
array(
	array(
		'permission_code' => 'exams',
		'permission_name' => array(
			'Exams Lists Management',
			'チーム管理'
		),
		'permission_description' => array(
			'Allow account to access Exams Lists list.',
			'アカウントにチームリストへのアクセスを許可します。'
		)
	),
	array(
		'permission_code' => 'exams-edit',
		'permission_name' => array(
			'Edit Exams Lists',
			'チームを編集'
		),
		'permission_description' => array(
			'Allow account to update Exams Lists details.',
			'アカウントがチームの詳細を更新できるようにします。'
		)
	),

),






































































































	// NEWSFEED =========================================================================================
	array(
		array(
			'permission_code' => 'newsfeed',
			'permission_name' => array(
				'Newsfeed',
				'ニュースフィード'
			),
			'permission_description' => array(
				'Allow account to access newsfeed.',
				'アカウントにニュースフィードへのアクセスを許可します。'
			)
		)
	),

	// POSTS =========================================================================================
	array(
		array(
			'permission_code' => 'posts',
			'permission_name' => array(
				'Posts Management',
				'投稿管理'
			),
			'permission_description' => array(
				'Allow account to access posts list and view post details.',
				'アカウントに投稿リストへのアクセスと投稿の詳細の表示を許可します。'
			)
		),
		array(
			'permission_code' => 'posts-add',
			'permission_name' => array(
				'Create Post',
				'投稿を作成'
			),
			'permission_description' => array(
				'Allow account to create post.',
				'アカウントに投稿の作成を許可します。'
			)
		),
		array(
			'permission_code' => 'posts-edit',
			'permission_name' => array(
				'Update Post',
				'投稿を更新'
			),
			'permission_description' => array(
				'Allow account to update post details.',
				'アカウントが投稿の詳細を更新できるようにします。'
			)
		),
		array(
			'permission_code' => 'posts-delete',
			'permission_name' => array(
				'Delete Post',
				'投稿を削除'
			),
			'permission_description' => array(
				'Allow account to delete post.',
				'アカウントに投稿の削除を許可します。'
			)
		),
		array(
			'permission_code' => 'posts-like',
			'permission_name' => array(
				'Like Post',
				'投稿に「いいね！」する'
			),
			'permission_description' => array(
				'Allow account to like a post.',
				'「いいね！」を付けることを許可します。'
			)
		),
		array(
			'permission_code' => 'posts-accept',
			'permission_name' => array(
				'Accept Post',
				'投稿を受け入れる'
			),
			'permission_description' => array(
				'Allow account to accept post.',
				'アカウントが投稿を受け入れることを許可します。'
			)
		),
		array(
			'permission_code' => 'posts-comment',
			'permission_name' => array(
				'Comment on Post',
				'投稿へのコメント'
			),
			'permission_description' => array(
				'Allow account to post comments on a post.',
				'アカウントが投稿にコメントを投稿できるようにします。'
			)
		)
	),

	// TICKETS =========================================================================================
	array(
		array(
			'permission_code' => 'tickets',
			'permission_name' => array(
				'Tickets Management',
				'チケット管理'
			),
			'permission_description' => array(
				'Allow account to access tickets list and view ticket details.',
				'アカウントにチケットリストへのアクセスとチケットの詳細の表示を許可します。'
			)
		),
		array(
			'permission_code' => 'tickets-add',
			'permission_name' => array(
				'Add Ticket',
				'チケットを追加'
			),
			'permission_description' => array(
				'Allow account to add ticket.',
				'アカウントにチケットの追加を許可します。'
			)
		),
		array(
			'permission_code' => 'tickets-edit',
			'permission_name' => array(
				'Edit Ticket',
				'チケットを編集'
			),
			'permission_description' => array(
				'Allow account to update ticket details.',
				'アカウントがチケットの詳細を更新できるようにします。'
			)
		),
		array(
			'permission_code' => 'tickets-delete',
			'permission_name' => array(
				'Delete Ticket',
				'チケットを削除'
			),
			'permission_description' => array(
				'Allow account to delete ticket.',
				'アカウントにチケットの削除を許可します。'
			)
		),
		array(
			'permission_code' => 'tickets-update-status',
			'permission_name' => array(
				'Update Ticket Status',
				'チケットステータスの更新'
			),
			'permission_description' => array(
				'Allow account to update ticket status.',
				'アカウントがチケットのステータスを更新できるようにします。'
			)
		),
		array(
			'permission_code' => 'tickets-accept',
			'permission_name' => array(
				'Accept Ticket',
				'チケットを受け入れる'
			),
			'permission_description' => array(
				'Allow account to accept ticket.',
				'アカウントにチケットの受け入れを許可します。'
			)
		),
		array(
			'permission_code' => 'tickets-comment',
			'permission_name' => array(
				'Comment on Ticket',
				'チケットへのコメント'
			),
			'permission_description' => array(
				'Allow account to post comments on a ticket.',
				'アカウントがチケットにコメントを投稿できるようにします。'
			)
		),
		array(
			'permission_code' => 'tickets-manage-tags',
			'permission_name' => array(
				'Manage Tags for Tickets',
				'チケットのタグを管理する'
			),
			'permission_description' => array(
				'Allow account to manage tags on a ticket.',
				'アカウントがチケットのタグを管理できるようにします。'
			)
		),
		array(
			'permission_code' => 'tickets-manage',
			'permission_name' => array(
				'Manage Tickets',
				'チケットを管理する'
			),
			'permission_description' => array(
				'Allow account to manage tickets. User can see other tickets.',
				'アカウントにチケットの管理を許可します。 ユーザーは他のチケットを見ることができます。'
			)
		),
		array(
			'permission_code' => 'tickets-report',
			'permission_name' => array(
				'Tickets Report',
				'チケットレポート'
			),
			'permission_description' => array(
				'Allow account to view ticket reports including related functions.',
				'アカウントが関連機能を含むチケットレポートを表示できるようにします。'
			)
		)
	),

	// PCS =========================================================================================
	array(
		array(
			'permission_code' => 'pcs',
			'permission_name' => array(
				'PC Management',
				'PC管理'
			),
			'permission_description' => array(
				'Allow account to access PC list.',
				'アカウントにPCリストへのアクセスを許可します。'
			)
		),
		array(
			'permission_code' => 'pcs-add',
			'permission_name' => array(
				'Add PC',
				'PCを追加'
			),
			'permission_description' => array(
				'Allow account to add a PC.',
				'PCの追加をアカウントに許可します。'
			)
		),
		array(
			'permission_code' => 'pcs-edit',
			'permission_name' => array(
				'Edit PC',
				'PCを編集'
			),
			'permission_description' => array(
				'Allow account to update PC details.',
				'PCの詳細の更新をアカウントに許可します。'
			)
		),
		array(
			'permission_code' => 'pcs-delete',
			'permission_name' => array(
				'Delete PC',
				'PCを削除'
			),
			'permission_description' => array(
				'Allow account to remove a PC.',
				'PCの削除をアカウントに許可します。'
			)
		),
		array(
			'permission_code' => 'pcs-restore',
			'permission_name' => array(
				'Restore PC',
				'PCを復元'
			),
			'permission_description' => array(
				'Allow account to restore removed PC.',
				'削除されたPCの復元をアカウントに許可します。'
			)
		)
	),

	// LICENSES =========================================================================================
	array(
		array(
			'permission_code' => 'licenses',
			'permission_name' => array(
				'License Management',
				'ライセンス管理'
			),
			'permission_description' => array(
				'Allow account to access license list.',
				'アカウントにライセンスリストへのアクセスを許可します。'
			)
		),
		array(
			'permission_code' => 'licenses-add',
			'permission_name' => array(
				'Add License',
				'ライセンスを追加'
			),
			'permission_description' => array(
				'Allow account to add a license.',
				'アカウントにライセンスの追加を許可します。'
			)
		),
		array(
			'permission_code' => 'licenses-edit',
			'permission_name' => array(
				'Edit License',
				'ライセンスを編集'
			),
			'permission_description' => array(
				'Allow account to update license details.',
				'アカウントがライセンスの詳細を更新できるようにします。'
			)
		),
		array(
			'permission_code' => 'licenses-delete',
			'permission_name' => array(
				'Delete License',
				'ライセンスを削除'
			),
			'permission_description' => array(
				'Allow account to remove license.',
				'アカウントにライセンスの削除を許可します。'
			)
		),
		array(
			'permission_code' => 'licenses-restore',
			'permission_name' => array(
				'Restore License',
				'ライセンスを復元'
			),
			'permission_description' => array(
				'Allow account to restore removed license.',
				'削除されたライセンスの復元をアカウントに許可します。'
			)
		),
		array(
			'permission_code' => 'dashboard-licenses-expiration',
			'permission_name' => array(
				'License Expiration',
				'ライセンスの有効期限'
			),
			'permission_description' => array(
				'Display expiration date of licenses of department in Dashboard.',
				'ダッシュボードに部門のライセンスの有効期限を表示します。'
			)
		)
	),

	// DEPARTMENTS =========================================================================================
	array(
		array(
			'permission_code' => 'departments',
			'permission_name' => array(
				'Departments Management',
				'部門管理'
			),
			'permission_description' => array(
				'Allow account to access departments list.',
				'アカウントに部門リストへのアクセスを許可します。'
			)
		),
		array(
			'permission_code' => 'departments-add',
			'permission_name' => array(
				'Add Department',
				'部門を追加'
			),
			'permission_description' => array(
				'Allow account to department.',
				'部門へのアカウントを許可します。'
			)
		),
		array(
			'permission_code' => 'departments-edit',
			'permission_name' => array(
				'Edit Department',
				'部門を編集'
			),
			'permission_description' => array(
				'Allow account to update department details.',
				'アカウントが部門の詳細を更新できるようにします。'
			)
		),
		array(
			'permission_code' => 'departments-delete',
			'permission_name' => array(
				'Delete Department',
				'部門を削除'
			),
			'permission_description' => array(
				'Allow account to delete department.',
				'アカウントに部門の削除を許可します。'
			)
		),
		array(
			'permission_code' => 'departments-restore',
			'permission_name' => array(
				'Restore Department',
				'復元部門'
			),
			'permission_description' => array(
				'Allow account to restore deleted department.',
				'削除された部門の復元をアカウントに許可します。'
			)
		)
	),

	
	// APPLICANTS =========================================================================================
	array(
		array(
			'permission_code' => 'applicants',
			'permission_name' => array(
				'Applicants Management',
				'応募者管理'
			),
			'permission_description' => array(
				'Allow account to access applicants list and view applicant profile.',
				'アカウントが申請者リストにアクセスし、申請者プロファイルを表示できるようにします。'
			)
		),
		array(
			'permission_code' => 'applicants-add',
			'permission_name' => array(
				'Add Applicant',
				'申請者を追加'
			),
			'permission_description' => array(
				'Allow account to add applicant account.',
				'アカウントが申請者アカウントを追加できるようにします。'
			)
		),
		array(
			'permission_code' => 'applicants-edit',
			'permission_name' => array(
				'Edit Applicant',
				'応募者を編集'
			),
			'permission_description' => array(
				'Allow account to update applicant account details.',
				'アカウントが申請者アカウントの詳細を更新できるようにします。'
			)
		),
		array(
			'permission_code' => 'applicants-delete',
			'permission_name' => array(
				'Delete Applicant',
				'応募者を削除'
			),
			'permission_description' => array(
				'Allow account to delete applicant account.',
				'アカウントが申請者アカウントを削除することを許可します。'
			)
		),
		array(
			'permission_code' => 'applicants-restore',
			'permission_name' => array(
				'Restore Applicant',
				'申請者を復元'
			),
			'permission_description' => array(
				'Allow account to restore deleted applicant account.',
				'アカウントが削除された申請者アカウントを復元できるようにします。'
			)
		),
		array(
			'permission_code' => 'applicants-view',
			'permission_name' => array(
				'View Applicant',
				'応募者を表示'
			),
			'permission_description' => array(
				'Allow account to view applicant profile.',
				'アカウントが申請者プロファイルを表示できるようにします。'
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
				'アカウントにユーザーリストへのアクセスとユーザープロファイルの表示を許可します。'
			)
		),
		array(
			'permission_code' => 'users-add',
			'permission_name' => array(
				'Add User',
				'ユーザーを追加する'
			),
			'permission_description' => array(
				'Allow account to add user account.',
				'アカウントにユーザーアカウントの追加を許可します。'
			)
		),
		array(
			'permission_code' => 'users-edit',
			'permission_name' => array(
				'Edit User',
				'ユーザーを編集'
			),
			'permission_description' => array(
				'Allow account to update user account details.',
				'アカウントがユーザーアカウントの詳細を更新できるようにします。'
			)
		),
		array(
			'permission_code' => 'users-delete',
			'permission_name' => array(
				'Delete User',
				'ユーザーを削除'
			),
			'permission_description' => array(
				'Allow account to delete user account.',
				'アカウントにユーザーアカウントの削除を許可します。'
			)
		),
		array(
			'permission_code' => 'users-restore',
			'permission_name' => array(
				'Restore User',
				'ユーザーを復元'
			),
			'permission_description' => array(
				'Allow account to restore deleted user account.',
				'削除されたユーザーアカウントの復元をアカウントに許可します。'
			)
		),
		array(
			'permission_code' => 'users-view',
			'permission_name' => array(
				'View User',
				'ユーザーを復元'
			),
			'permission_description' => array(
				'Allow account to view user account profile.',
				'アカウントにユーザーアカウントプロファイルの表示を許可します。'
			)
		)
	),

	// ROLES =========================================================================================
	array(
		array(
			'permission_code' => 'roles',
			'permission_name' => array(
				'Roles Management',
				'ロール管理'
			),
			'permission_description' => array(
				'Allow account to access roles list and view permissions.',
				'アカウントに役割リストへのアクセスと許可の表示を許可します。'
			)
		),
		array(
			'permission_code' => 'roles-add',
			'permission_name' => array(
				'Add Role',
				'役割を追加'
			),
			'permission_description' => array(
				'Allow account to add role group.',
				'アカウントに役割グループの追加を許可します。'
			)
		),
		array(
			'permission_code' => 'roles-edit',
			'permission_name' => array(
				'Edit Role',
				'役割を編集'
			),
			'permission_description' => array(
				'Allow account to update role name and permissions.',
				'アカウントがロール名と権限を更新できるようにします。'
			)
		),
		array(
			'permission_code' => 'roles-delete',
			'permission_name' => array(
				'Delete Role',
				'役割を削除'
			),
			'permission_description' => array(
				'Allow account to delete role.',
				'アカウントに役割の削除を許可します。'
			)
		),
		array(
			'permission_code' => 'roles-restore',
			'permission_name' => array(
				'Restore Role',
				'役割を復元'
			),
			'permission_description' => array(
				'Allow account to restore deleted role.',
				'アカウントが削除されたロールを復元することを許可します。'
			)
		)
	),

	// SYSTEM =========================================================================================
	array(
		array(
			'permission_code' => 'system-log',
			'permission_name' => array(
				'System Log',
				'システムログ'
			),
			'permission_description' => array(
				'Allow account to access system log.',
				'アカウントにシステムログへのアクセスを許可します。'
			)
		)
	),

	

);
$permissions_count = 0;
foreach($permissions_arr as $permissions_group) {
	$permissions_count += count($permissions_group);
}
?>