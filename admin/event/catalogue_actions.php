<?php
include RD.'/lib/catalogue_actions_class.php'; $cat= new catalogue_actions;$access=new access;session_start();$slave=new slave;
$catalogue_actions_htm=RD."/tpl/catalogue_actions.htm";if (file_exists("$catalogue_actions_htm")){ $catalogue_actions_window = file_get_contents($catalogue_actions_htm);}
$content=str_replace("{work_window}", $catalogue_actions_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

	if ($w=="new_action"){
		if ($conf==""){	$content=str_replace("{info}", $cat->new_action_form(), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $cat->add_action_form(), $content); }
	}
	if ($w=="edit_action"){
		if ($conf==""){ $content=str_replace("{info}", $cat->edit_action_form($action_id), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $cat->save_action_form(), $content);}
	}
	if ($w=="delete_action"){
		if ($conf=="true"){ $content=str_replace("{info}", $cat->delete_action($action_id), $content); }
	}
	if ($w==""){ $content=str_replace("{info}", $cat->show_catalogue_actions_list(), $content); }
}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

?>