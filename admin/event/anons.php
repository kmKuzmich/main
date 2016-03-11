<?php

include RD.'/lib/anons_class.php';
$anons= new anons;$mdl=new module;$access=new access;session_start();$slave=new slave;
$anons_htm=RD."/tpl/anons.htm";
if (!file_exists("$anons_htm")){ $anons_window="Не знайдено файл шаблону"; }
if (file_exists("$anons_htm")){ $anons_window = file_get_contents($anons_htm);}
$content=str_replace("{work_window}", $anons_window, $content);


if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){
	
if ($wn=="new"){
	if ($conf==""){
		$content=str_replace("{info}", $anons->show_anons_form(), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $anons->add_anons_form(), $content);
	}
}
if ($wn=="edit"){
	if ($conf==""){
		$content=str_replace("{info}", $anons->edit_anons_form($anons_id), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $anons->save_anons_form(), $content);
	}
}
if ($wn=="delete"){
	$content=str_replace("{info}", $anons->delete_anons_form($anons_id), $content);
}

}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}
//--------------------------------------------------------------------------------------------

if ($wn==""){
	$content=str_replace("{info}", $anons->show_anons_list(), $content);
}
?>