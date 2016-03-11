<?php
include RD.'/lib/configs_class.php';$access=new access;session_start();$slave=new slave;
$configs= new configs;$mdl=new module;
$configs_htm=RD."/tpl/configs.htm";if (file_exists("$configs_htm")){ $configs_window = file_get_contents($configs_htm);}
$content=str_replace("{work_window}", $configs_window, $content);
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){
	if ($wn=="edit"){
		if ($conf==""){	$content=str_replace("{info}", $configs->edit_configs_form(), $content);}
		if ($conf=="true"){	$content=str_replace("{info}", $configs->save_configs_form(), $content);}
	}
}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0"){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}
if ($wn==""){$content=str_replace("{info}", $configs->show_configs(), $content);}
?>