<?php
/*
LEGEND by (index)
0 - English
1 - Japanese
*/

// USER
$module_name = 'users';

${$module_name.'_dashboard'} = array(
	'User Dashboard',
	'User Dashboard'
);

${$module_name.'_user'} = array(
	'User',
	'ユーザー'
);
${$module_name.'_users'} = array(
	'User Account',
	'ユーザー'
);
${$module_name.'_manage_users'} = array(
	'Manage Users',
	'ユーザーを管理する'
);
${$module_name.'_title'} = ${$module_name.'_users'};
${$module_name.'_user_details'} = array(
	'User Details',
	'ユーザーの詳細'
);
${$module_name.'_users_list'} = array(
	'Users List',
	'ユーザーリスト'
);
${$module_name.'_users_statistics'} = array(
	'Users Statistics',
	'ユーザー統計'
);
${$module_name.'_add_user'} = array(
	'Add User',
	'ユーザーを追加する'
);
${$module_name.'_add_user_form'} = array(
	'Add User Form',
	'ユーザーフォームを追加'
);
${$module_name.'_edit_user'} = array(
	'Edit User',
	'ユーザーを編集'
);
${$module_name.'_edit_user_form'} = array(
	'Edit User Form',
	'ユーザーフォームの編集'
);
${$module_name.'_update_user'} = array(
	'Update User',
	'ユーザーを更新'
);
${$module_name.'_delete_user'} = array(
	'Delete User',
	'ユーザーを削除'
);
${$module_name.'_restore_user'} = array(
	'Restore User',
	'ユーザーを復元'
);
${$module_name.'_view_user_profile'} = array(
	'View User Profile',
	'ユーザープロフィールを表示'
);

// FIELDS
${$module_name.'_account_details'} = array(
	'Account Details',
	'アカウント詳細'
);
${$module_name.'_uname'} = array(
	'Username',
	'ユーザー名'
);
${$module_name.'_uname_placeholder'} = array(
	'user, associate, etc.',
	'例えば 管理者、マネージャー、アソシエイトなど'
);
${$module_name.'_employeeid'} = array(
	'Employee ID',
	'従業員ID'
);
${$module_name.'_employeeid_placeholder'} = array(
	'e.g. 2150028, z2130098',
	'例えば 2150028、z2130098'
);
${$module_name.'_team_id'} = array(
	'Team',
	'チーム'
);
${$module_name.'_department_id'} = array(
	'Department',
	'部門'
);
${$module_name.'_date_start'} = array(
	'Birthday',
	''
);
${$module_name.'_date_start_placeholder'} = array(
	'',
	''
);
${$module_name.'_date_end'} = array(
	'End Date',
	'終了日'
);
${$module_name.'_date_end_placeholder'} = array(
	'',
	''
);

${$module_name.'_personal_information'} = array(
	'Personal Information',
	'個人情報'
);
${$module_name.'_firstname'} = array(
	'First Name',
	'名'
);
${$module_name.'_firstname_placeholder'} = array(
	'First Name',
	'例えば ライアン'
);
${$module_name.'_middlename'} = array(
	'Middle Name',
	'ミドルネーム'
);
${$module_name.'_middlename_placeholder'} = array(
	'Middle Name',
	'例えば ラオス'
);
${$module_name.'_lastname'} = array(
	'Last Name',
	'苗字'
);
${$module_name.'_lastname_placeholder'} = array(
	'Last Name',
	'例えば レイエス'
);
${$module_name.'_gender'} = array(
	'Gender',
	'性別'
);
${$module_name.'_civil_status'} = array(
	'Civil Status',
	'市民のステータス'
);

${$module_name.'_contact_information'} = array(
	'Contact Information',
	'連絡先'
);
${$module_name.'_email'} = array(
	'Email',
	'Eメール'
);
${$module_name.'_email_placeholder'} = array(
	'Email',
	'Email '
);
${$module_name.'_email_exists'} = array(
	'Email already exists. Please provide another email or Contact our administrator.',
	''
);
${$module_name.'_mobile'} = array(
	'Mobile',
	'モバイル'
);
${$module_name.'_mobile_placeholder'} = array(
	'096136239..',
	'例えば 09613623959'
);
${$module_name.'_fullname'} = array(
	'Fullname',
	'フルネーム'
);
${$module_name.'_last_login'} = array(
	'Last Login',
	'前回のログイン'
);
${$module_name.'_clear_roles'} = array(
	'Clear Roles',
	'明確な役割'
);
${$module_name.'_no_roles_available'} = array(
	'There are no roles available. Please create one first. ',
	'利用可能な役割はありません。 まず作成してください。'
);
${$module_name.'_no_roles_msg1'} = array(
	'Click here to add a role.',
	'ここをクリックして役割を追加します。'
);
${$module_name.'_no_roles_msg2'} = array(
	'Contact your web administrator to add new roles.',
	'新しい役割を追加するには、Web管理者に連絡してください。'
);

// MODALS
${$module_name.'_modal_delete_msg1'} = array(
	'Are you sure you want to delete this user?',
	'このユーザーを削除してもよろしいですか？'
);
${$module_name.'_modal_delete_msg2'} = array(
	'Deleting this user will remove it from the database permanently.',
	'このユーザーを削除すると、データベースから永久に削除されます。'
);

// FORM MESSAGES
${$module_name.'_uname_required'} = array(
	'Username is required.',
	'ユーザー名が必要です。'
);
${$module_name.'_uname_exists'} = array(
	'Username already exists. Please provide a unique username.',
	'ユーザー名は既に存在します。 一意のユーザー名を入力してください。'
);
${$module_name.'_employeeid_exists'} = array(
	'Employee ID already exists. Please provide a unique employee ID.',
	'従業員IDは既に存在します。 一意の従業員IDを入力してください。'
);
${$module_name.'_firstname_required'} = array(
	'First name is required.',
	'名が必要です。'
);
${$module_name.'_lastname_required'} = array(
	'Last name is required.',
	'姓が必要です。'
);
${$module_name.'_select_valid_language'} = array(
	'Please select a valid language.',
	'有効な言語を選択してください。'
);
${$module_name.'_roleids_required'} = array(
	'Select at least one role.',
	'少なくとも1つの役割を選択します。'
);

${$module_name.'_checking_employee_id'} = array(
	'Checking employee ID. Please wait.',
	'従業員IDを確認しています。 お待ちください。'
);
${$module_name.'_invalid_employee_id'} = array(
	'Invalid employee ID.',
	'従業員IDが無効です。'
);
${$module_name.'_unauthorized'} = array(
	'You are not authorized to access this function.',
	'この機能にアクセスする権限がありません。'
);
${$module_name.'_session_expired'} = array(
	'Session expired. Please re-login.',
	'セッションの有効期限が切れ。 再度ログインしてください。'
);

// NOTIFICATIONS
${$module_name.'_user_add'} = array(
	'User added!',
	'ユーザーが追加されました！'
);
${$module_name.'_user_edit'} = array(
	'User updated!',
	'ユーザーが更新しました！'
);
${$module_name.'_user_restored'} = array(
	'User restored.',
	'ユーザーが復元されました。'
);
${$module_name.'_messages_user_removed'} = array(
	'User removed successfully.',
	'ユーザーが正常に削除されました。'
);
${$module_name.'_messages_user_deactivated'} = array(
	'This user is deactivated. Contact your web administrator.',
	'このユーザーは無効になっています。 Web管理者に連絡してください。'
);
${$module_name.'_messages_user_deleted'} = array(
	'This user has been deleted.',
	'このユーザーは削除されました。'
);
${$module_name.'_messages_cannot_edit_superadmin'} = array(
	'Super Admin user cannot be edited.',
	'スーパー管理者ユーザーは編集できません。'
);
${$module_name.'_user_not_found'} = array(
	'User not found!',
	'ユーザーが見つかりません！'
);
${$module_name.'_restore_confirmation'} = array(
	'Are you sure you want to restore this user account?',
	'このユーザーアカウントを復元してもよろしいですか？'
);

// PROFILE
${$module_name.'_personal'} = array(
	'Personal',
	'個人的な'
);
${$module_name.'_employee'} = array(
	'Employee',
	'社員'
);
${$module_name.'_contact'} = array(
	'Contact',
	'連絡先'
);
${$module_name.'_activity'} = array(
	'Activity',
	'アクティビティ'
);
${$module_name.'_permissions_msg1'} = array(
	'Manage user permission here. Click to toggle permission.<br>Green permissions are from roles. This cannot be updated here. Please go to Roles section.',
	'ここでユーザー権限を管理します。 クリックして権限を切り替えます。<br>緑の権限はロールからのものです。 ここでは更新できません。 役割セクションに移動してください。'
);
${$module_name.'_permissions_msg2'} = array(
	'This is a role permission. This can only be updated in the Role Management.',
	'これはロール権限です。 これは、ロール管理でのみ更新できます。'
);
${$module_name.'_permissions_confirm1'} = array(
	'Are you sure you want to remove this permission on this user?',
	'このユーザーのこの権限を削除してもよろしいですか？'
);
${$module_name.'_permissions_confirm2'} = array(
	'Are you sure you want to give this permission on this user?',
	'このユーザーにこの権限を与えてもよろしいですか？'
);
${$module_name.'_permission_from_role'} = array(
	'Permission From Role',
	'役割からの許可'
);
${$module_name.'_permission_for_user'} = array(
	'Permission For User',
	'ユーザーの許可'
);
${$module_name.'_permissions_added'} = array(
	'Permission added!',
	'許可が追加されました！'
);
${$module_name.'_permissions_removed'} = array(
	'Permission removed.',
	'権限が削除されました。'
);
${$module_name.'_user_not_found'} = array(
	'User not found!',
	'ユーザーが見つかりません！'
);
${$module_name.'_user_options'} = array(
	'User Options',
	'ユーザーオプション'
);
${$module_name.'_reset_password'} = array(
	'Reset Password',
	'パスワードを再設定する'
);
${$module_name.'_user_options_msg1'} = array(
	'Reset the user account&#39;s current password to default value. The default value will be the user&#39;s current <strong>username</strong>.<br><strong class="text-red">It is strongly advised to inform the user to change password immediately after logging in.</strong>',
	'ユーザーアカウントの現在のパスワードをデフォルト値にリセットします。 デフォルト値は、ユーザーの現在のユーザー名です。<br><strong class="text-red">ログイン後すぐにパスワードを変更するようユーザーに通知することを強くお勧めします。</strong>'
);
${$module_name.'_user_options_msg2'} = array(
	'Change status of user. Please be advised that this will affect the user&#39;s login experience.',
	'ユーザーのステータスを変更します。 これはユーザーのログインエクスペリエンスに影響することに注意してください。'
);
${$module_name.'_user_options_msg3'} = array(
	'User account is deleted. If you wish to restore this user account, go to <strong>Edit</strong> form and <strong>Restore</strong>.',
	'ユーザーアカウントが削除されます。 このユーザーアカウントを復元する場合は、フォームの編集と復元に進みます。'
);
${$module_name.'_reset_password_confirmation'} = array(
	'Are you sure you want to reset the password for this user account?',
	'このユーザーアカウントのパスワードをリセットしてもよろしいですか？'
);
${$module_name.'_update_status_confirmation'} = array(
	'Are you sure you want to update the status for this user account? Login may be affected for this user.',
	'このユーザーアカウントのステータスを更新してもよろしいですか？ このユーザーのログインに影響がある可能性があります。'
);
${$module_name.'_user_reset_success'} = array(
	'User password reset successful. Password is returned to default.',
	'ユーザーパスワードのリセットに成功しました。 パスワードがデフォルトに戻ります。'
);
${$module_name.'_user_status_update_success'} = array(
	'User status updated!',
	'ユーザーステータスが更新されました！'
);
?>