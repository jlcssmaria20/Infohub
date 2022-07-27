<?php
if($data['status'] == 2 && $data['temp_del'] != 0) {
	$_SESSION['sys_'.$module.'_'.$process.'_err'] = renderLang(${$module.'_messages_'.$prefix.'_deleted'});
} elseif($data['status'] == 1) {
	$_SESSION['sys_'.$module.'_'.$process.'_war'] = renderLang(${$module.'_messages_'.$prefix.'_deactivated'});
}
renderError('sys_'.$module.'_'.$process.'_err');
// renderWarning('sys_'.$module.'_'.$process.'_war');
renderSuccess('sys_'.$module.'_'.$process.'_suc');
?>