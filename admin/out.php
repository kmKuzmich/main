<?php

$theme_htm=RD."/theme/theme.htm";
if (!file_exists("$theme_htm")){ $content = "Не знайдено файл шаблону"; }
if (file_exists("$theme_htm")){ $content = file_get_contents($theme_htm);}
$ww_htm=RD."/tpl/window.htm";
if (!file_exists("$ww_htm")){ $ww = "Не знайдено файл шаблону"; }
if (file_exists("$ww_htm")){ $ww = file_get_contents($ww_htm);}
$content=str_replace("{work_window}", $ww, $content);


$config=new config;
$content=str_replace("{title}", $config->get_title(), $content);


$mdl=new module;
$content=str_replace("{work_menu}", $mdl->show_menu($module), $content);
$content=str_replace("{module_caption}", $mdl->get_module_caption($module), $content);

if ($file!="" and $file!="0"){ $fn=$mdl->get_module_file($file,1);}

if ($fn!=""){
	if (file_exists("event/".$fn.".php")){ include 'event/'.$fn.'.php'; }
	if (!file_exists("event/".$fn.".php")){ $content=str_replace("{work_window}", "", $content); }
}
if ($fn==""){
	$fn=$mdl->get_module_file($file,2);
	if (file_exists("event/".$fn.".php")){ include 'event/'.$fn.'.php'; }
	if (!file_exists("event/".$fn.".php")){ $content=str_replace("{work_window}", "", $content); }
}

$content=str_replace("{work_window}", "", $content);
$content=str_replace("{sub_menu}", "", $content);
?>