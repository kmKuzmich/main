<?php

include RD.'/lib/galery_class.php';
$galery= new galery;$mdl=new module;$access=new access;session_start();$slave=new slave;
$galery_htm=RD."/tpl/galery.htm";
if (!file_exists("$galery_htm")){ $galery_window="Не знайдено файл шаблону"; }
if (file_exists("$galery_htm")){ $galery_window = file_get_contents($galery_htm);}
$content=str_replace("{work_window}", $galery_window, $content);


if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){
	
if ($wn=="new_gdep"){
	if ($conf==""){	$content=str_replace("{info}", $galery->show_gdep_form(), $content);}
	if ($conf=="true"){ $gdep=$galery->add_gdep_form();$wn=""; }
}
if ($wn=="edit_gdep"){
	if ($conf==""){	$content=str_replace("{info}", $galery->edit_gdep_form($gdep), $content); }
	if ($conf=="true"){ $gdep=$galery->save_gdep_form();$wn=""; }
}
if ($wn=="delete_gdep"){ $galery->delete_gdep_form($gdep);$wn=""; }


if ($wn=="new_theme"){
	if ($conf==""){	$content=str_replace("{info}", $galery->show_theme_form($gdep), $content);}
	if ($conf=="true"){ $theme=$galery->add_theme_form();$wn="show_theme"; }
}
if ($wn=="edit_theme"){
	if ($conf==""){	$content=str_replace("{info}", $galery->edit_theme_form($gdep,$theme), $content); }
	if ($conf=="true"){ $theme=$galery->save_theme_form();$wn="show_theme"; }
}
if ($wn=="delete_theme"){ $galery->delete_theme_form($theme);$wn="show_theme"; }



if ($wn=="new_foto"){
	if ($conf==""){	$content=str_replace("{info}", $galery->show_foto_form($gdep,$theme), $content);}
	if ($conf=="true"){ $foto_id=$galery->add_foto_form();$wn="show_galery"; }
}
if ($wn=="edit_foto"){
	if ($conf==""){	$content=str_replace("{info}", $galery->edit_foto_form($gdep,$theme,$foto_id), $content); }
	if ($conf=="true"){ $foto_id=$galery->save_foto_form();$wn="show_galery"; }
}
if ($wn=="delete_foto"){ $galery->delete_foto_form($foto_id);$wn="show_galery"; }



}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}


if ($wn==""){
	$content=str_replace("{info}", $galery->show_galery_dep(), $content);
}
if ($wn=="show_theme"){ 
	$content=str_replace("{info}", $galery->show_galery_theme($gdep), $content); 
}
if ($wn=="show_galery"){ 
	$content=str_replace("{info}", $galery->show_galery($gdep,$theme), $content); 
}

$content=str_replace("{menu}", $mdl->show_dep_menu(), $content);
?>