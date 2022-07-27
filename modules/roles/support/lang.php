<?php
/*
LEGEND by (index)
0 - English
1 - Japanese
*/

// ROLES
$module_name = 'roles';

${$module_name.'_role'} = array(
	'Role',
	'役割'
);
${$module_name.'_roles'} = array(
	'Roles',
	'役割'
);
${$module_name.'_title'} = ${$module_name.'_roles'};
${$module_name.'_role_details'} = array(
	'Role Details',
	'役割の詳細'
);
${$module_name.'_roles_list'} = array(
	'Roles List',
	'役割リスト'
);
${$module_name.'_add_role'} = array(
	'Add Role',
	'役割を追加'
);
${$module_name.'_add_role_form'} = array(
	'Add Role Form',
	'役割フォームを追加'
);
${$module_name.'_edit_role'} = array(
	'Edit Role',
	'役割を編集'
);
${$module_name.'_edit_role_form'} = array(
	'Edit Role Form',
	'役割フォームの編集'
);
${$module_name.'_update_role'} = array(
	'Update Role',
	'ロールを更新'
);
${$module_name.'_delete_role'} = array(
	'Delete Role',
	'役割を削除'
);
${$module_name.'_restore_role'} = array(
	'Restore Role',
	'役割を復元'
);
${$module_name.'_view_role_details'} = array(
	'View Role Details',
	'ロールの詳細を表示'
);

// FIELDS
${$module_name.'_role_name'} = array(
	'Role Name',
	'役割名'
);
${$module_name.'_role_name_placeholder'} = array(
	'e.g. Admin, Manager, Associate, etc.',
	'例えば 管理者、マネージャー、アソシエイトなど'
);
${$module_name.'_clear_permissions'} = array(
	'Clear Permissions',
	'権限をクリア'
);

// MODALS
${$module_name.'_modal_delete_msg1'} = array(
	'Are you sure you want to delete this role?',
	'このロールを削除してもよろしいですか？'
);
${$module_name.'_modal_delete_msg2'} = array(
	'Deleting this role will remove it from the database permanently.<br>Deleting a role will affect <strong>user accounts</strong> and their <em>access</em> or <em>permissions</em> in the system.',
	'このロールを削除すると、データベースから永久に削除されます。<br>役割を削除すると、システムのユーザーアカウントとそのアクセスまたはアクセス許可に影響します。'
);

// FORM MESSAGES
${$module_name.'_role_name_required'} = array(
	'Role name is required.',
	'ロール名が必要です。'
);
${$module_name.'_role_name_exists'} = array(
	'Role name already exists. Please provide a unique role name.',
	'ロール名はすでに存在します。 一意のロール名を指定してください。'
);
${$module_name.'_permissions_required'} = array(
	'Select at least one permission.',
	'少なくとも1つの権限を選択します。'
);

// NOTIFICATIONS
${$module_name.'_role_add'} = array(
	'Role added!',
	'役割が追加されました！'
);
${$module_name.'_role_edit'} = array(
	'Role updated!',
	'役割が更新されました！'
);
${$module_name.'_role_restored'} = array(
	'Role restored.',
	'役割が復元されました。'
);
${$module_name.'_messages_role_removed'} = array(
	'Role removed successfully.',
	'ロールが正常に削除されました。'
);
${$module_name.'_messages_cannot_edit_superadmin'} = array(
	'Super Admin role cannot be edited.',
	'スーパー管理者ロールは編集できません。'
);
${$module_name.'_messages_role_deleted'} = array(
	'This role has been deleted.',
	'この役割は削除されました。'
);
${$module_name.'_role_not_found'} = array(
	'Role not found!',
	'役割が見つかりません！'
);
${$module_name.'_restore_confirmation'} = array(
	'Are you sure you want to restore this role?',
	'この役割を復元してもよろしいですか？'
);
?>