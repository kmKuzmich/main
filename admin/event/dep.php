<?php

include RD.'/lib/dep_class.php';
$dep= new dep;$mdl=new module;$access=new access;session_start();$slave=new slave;

$dep_htm=RD."/tpl/dep.htm";
if (!file_exists("$dep_htm")){ $dep_window="Не знайдено файл шаблону"; }
if (file_exists("$dep_htm")){ $dep_window = file_get_contents($dep_htm);}
$content=str_replace("{work_window}", $dep_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){
	
if ($w=="new_dep"){
	if ($conf==""){
		$content=str_replace("{info}", $dep->show_dep_form($dep_up), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $dep->add_dep_form(), $content);
	}
}
if ($w=="edit_dep"){
	if ($conf==""){
		$content=str_replace("{info}", $dep->edit_dep_form($dep_up,$_GET["cur_id"]), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $dep->save_dep_form(), $content);
	}
}
if ($w=="delete_dep"){
	if ($conf=="true"){ $content=str_replace("{info}", $dep->delete_dep_form($_GET["cur_id"]), $content);}
}

}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $w!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}
//--------------------------------------------------------------------------------------------

if ($w==""){
	$content=str_replace("{info}", $dep->show_dep_list($dep_up), $content);
}
?>