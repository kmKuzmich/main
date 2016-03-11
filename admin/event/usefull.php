<?php

include RD.'/lib/usefull_class.php';
$usefull= new usefull;$mdl=new module;$access=new access;session_start();$slave=new slave;
$usefull_htm=RD."/tpl/usefull.htm";
if (!file_exists("$usefull_htm")){ $usefull_window="Не знайдено файл шаблону"; }
if (file_exists("$usefull_htm")){ $usefull_window = file_get_contents($usefull_htm);}
$content=str_replace("{work_window}", $usefull_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

if ($wn=="edit"){
	if ($conf==""){	$content=str_replace("{info}", $usefull->show_usefull_form(), $content);}
	if ($conf=="true"){	$content=str_replace("{info}", $usefull->save_usefull_form(), $content);}
}


}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0"){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

if ($wn==""){$content=str_replace("{info}", $usefull->show_usefull(), $content);}
?>