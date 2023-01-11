<?php
/*
LEGEND by (index)
0 - English
1 - Japanese
*/

// USERS
$users_users = array(
	'Users',
	'ユーザー'
);
$users_user = array(
	'User',
	'ユーザー'
);
$users_user_profile = array(
	'User Profile',
	'ユーザープロフィール'
);
$users_users_list = array(
	'Users List',
	'ユーザー一覧'
);
$users_add_user = array(
	'Add User',
	'ユーザーを追加'
);
$users_add_user_form = array(
	'Add User Form',
	'ユーザー追加フォーム'
);
$users_edit_user = array(
	'Edit User',
	'ユーザーを修正'
);
$users_view_user = array(
	'View User',
	'ユーザーを表示'
);
$users_view_actual_time = array(
	'View Actual Time',
	'実際時間を表示'
);
$users_update_user = array(
	'Update User',
	'ユーザーを更新'
);
$users_edit_user_form = array(
	'Edit User Form',
	'ユーザー修正フォーム'
);
$users_delete_user = array(
	'Delete User',
	'ユーザーを削除'
);

$users_center_department_team_subteam = array(
	'Center/Department/Team/Subteam',
	'センター・部署・チーム・サブチーム'
);
$users_designation = array(
	'Designation',
	'指定'
);
$users_employee_id = array(
	'Employee ID',
	'社員番号'
);
$users_employee_id_placeholder = array(
	'e.g. 2000002, z2000002, etc.',
	'例： 2000002、z2000002、など'
);
$users_level = array(
	'Level',
	'レベル'
);
$users_position = array(
	'Position',
	'ポジション'
);
$users_email = array(
	'Email',
	'Eメール'
);
$users_email_placeholder = array(
	'e.g. trans.taro@trans-cosmos.co.jp',
	'例: trans.taro@trans-cosmos.co.jp'
);
$users_firstname = array(
	'First Name',
	'名'
);
$users_firstname_placeholder = array(
	'e.g. Taro',
	'例: 太郎'
);
$users_middlename = array(
	'Middle Name',
	'ミドルネーム'
);
$users_middlename_placeholder = array(
	'e.g. cosmos',
	'例： コスモス'
);
$users_lastname = array(
	'Last Name',
	'姓'
);
$users_lastname_placeholder = array(
	'e.g. trance',
	'例： トランス'
);
$users_position = array(
	'Position',
	'役職'
);
$users_gender = array(
	'Gender',
	'性別'
);
$users_mobile = array(
	'Mobile',
	''
);
$users_mobile_placeholder = array(
	'e.g. 09123456789',
	''
);
$users_nickname = array(
	'Nick Name',
	'ニックネーム'
);
$users_hiredate= array(
	'Hire Date',
	'入社日'
);
$users_enddate= array(
	'End Date',
	'退職日'
);
$users_mobile= array(
	'Mobile Number',
	''
);
$users_mobile_optional = array(
	'(Optional)',
	''
);
$users_mobile_err = array(
	'Only numbers are allowed.',
	''
);

$users_mobile_09_err = array(
	'Number should start with 09.',
	''
);
$users_nickname_placeholder = array(
	'e.g. Trataro',
	'例: トラタロー'
);
$users_last_login = array(
	'Last Login',
	'前回のログイン'
);
$users_clear_roles = array(
	'Clear Roles',
	'役割をクリア'
);
$users_export_actual_time = array(
	'Export Users Actual Time',
	'実稼働工数のエクスポート'
);
$users_mantra_in_life = array(
	'Mantra in Life',
	''
);
$users_mantra_in_life_placeholder = array(
	'Time is Gold',
	''
);
$users_mantra_in_life_required = array(
	'Mantra in Life is Required',
	''
);
$users_skills = array(
	'Skills',
	''
);
$users_skills_placeholder = array(
	'Javascript, PHP, MYSQL, GIT',
	''
);
$users_skills_required = array(
	'User Skills is Required',
	''
);

// MODALS
$users_modal_delete_msg1 = array(
	'Are you sure you want to delete',
	''
);
$users_modal_delete_msg2 = array(
	'It is discouraged to delete a record.',
	'過去の情報に影響が出るため削除は推奨しません。'
);
$users_modal_delete_msg3 = array(
	'Please consider deactivating the user account instead.',
	'代わりにユーザーアカウントを無効にすることを検討してください。'
);

// FORM MESSAGES
$users_position_id_required = array(
	'Please select a position for this user.',
	'このユーザーのポジションを選択してください。'
);
$users_subteam_id_required = array(
	'Please select a subteam for this user.',
	'このユーザのサブチームを選択してください。'
);
$users_subteam_id_invalid = array(
	'Invalid subteam selected.',
	'選んだサブチームが無効です。'
);
$users_employee_id_required = array(
	'Employee ID is required.',
	'社員番号が必要です。'
);
$users_employee_id_exists = array(
	'Employee ID already exists.',
	'社員番号がすでに存在しています。'
);
$users_nickname_required = array(
	'Nick name is required.',
	'ニックネームは入力必須項目です。'
);
$users_firstname_required = array(
	'First name is required.',
	'名前は入力必須項目です。'
);
$users_lastname_required = array(
	'Last name is required.',
	'姓は入力必須項目です。'
);
$users_hiredate_required = array(
	'Hired date is required.',
	'入社日は入力必須項目です'
);
$users_enddate_required = array(
	'End date is required.',
	'退職日入力必須項目です'
);
$users_invalid_level_selected = array(
	'Please select a valid level.',
	'有効なレベルを選択してください。'
);
$users_invalid_gender = array(
	'Please select a valid gender.',
	'有効な性別を選択してください。'
);
$users_invalid_subteam_selection = array(
	'Please select a subteam.',
	'サブチームを選択してください。'
);
$users_role_required = array(
	'Select at least one role.',
	'少なくとも1つの役割を選択してください。'
);
$users_email_alread_in_use = array(
	'Email already in use.',
	'メールアドレスが既に存在しています。'
);
$use_company_email= array(
	'Please use company email.',
	''
);
$users_user_added = array(
	'User added!',
	'ユーザーが追加されました！'
);
$users_user_updated = array(
	'User updated!',
	'ユーザー情報が更新されました!'
);
$users_messages_user_removed = array(
	'User removed successfully.',
	'ユーザーが正常に削除されました。'
);
$users_user_deleted = array(
	'This user record has been deleted.',
	'このユーザーレコードは削除されました。'
);
$users_user_not_found = array(
	'User record not found.',
	'ユーザーレコードが見つかりません。'
);

// USER PROFILE
$users_view_profile = array(
	'View Profile ',
	''
);
$users_personal = array(
	'Personal',
	'個人'
);
$users_employment = array(
	'Employment',
	'社員'
);

// TIME SHEET
$users_time_sheet = array(
	'Timesheet',
	'勤怠表'
);
$users_view_user_timesheet = array(
	'View User Timesheet',
	'勤怠表を表示'
);
$users_time_logs = array(
	'Time Logs',
	'タイムログ'
);
$users_date = array(
	'Date',
	'年月日'
);
$users_time_in = array(
	'Time In',
	'出勤'
);
$users_time_out = array(
	'Time Out',
	'退勤'
);
$users_time_rendered = array(
	'Time Rendered',
	'レンダリングされた時間'
);
$user_level = array(
	'Level',
	'レベル'
);
$user_projects = array(
	'Projects',
	'案件'
);
$user_tab_permissions = array(
	'Permissions',
	'権限'
);
$users_permissions_added = array(
	'Permission added!',
	'権限が追加されました！'
);
$users_permission_for_user = array(
	'Permission For User!',
	'ユーザーの許可！'
);
$users_permission_from_role = array(
	'Permission From Role!',
	'役割の許可！'
);
$users_permissions_removed = array(
	'Permission removed!',
	'権限が削除されました！'
);
$user_leaves = array(
	'Leaves',
	'休暇'
);
$user_statistics = array(
	'Statistics',
	'統計'
);
$user_misses = array(
	'Misses',
	'ミス'
);
$user_option= array(
	'User Option',
	'オプション'
);
$user_option_msg_1= array(
	"Reset the user account's current password to a new default password. New passowrd is sent to registered email.",
	''
);
$user_option_msg_2= array(
	'<strong>It is strongly advised to inform the user to change password immediately after logging in.</strong>',
	'ログイン後直ぐにパスワードを変更してください。'
);
$user_option_confirm= array(
	'Are you sure you want to reset the password?',
	'パスワードを本当にリセットしますか？'
);
$view_leaves_management = array(
	'View Leaves Management',
	'勤怠（休暇）管理を表示'
);
$user_set_designation = array(
	'-- Set Designation --',
	''
);

//UNLOCK ACCOUNT FEATURE

$user_unlock_account = array(
	'Remove Lockout',
	''
);

$user_unlock_confirm = array(
	'Are you sure you want to unlock this user account?',
	''
);

$user_unlock_success = array(
	'User Account Successfully Unlocked!',
	''
);

?>