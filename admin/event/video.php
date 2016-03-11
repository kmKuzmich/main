<?php

include RD.'/lib/video_class.php';
$video= new video;$mdl=new module;$access=new access;session_start();$slave=new slave;
$video_htm=RD."/tpl/video.htm";
if (!file_exists("$video_htm")){ $video_window="Не знайдено файл шаблону"; }
if (file_exists("$video_htm")){ $video_window = file_get_contents($video_htm);}
$content=str_replace("{work_window}", $video_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

if ($wn=="new_gdep"){
	if ($conf==""){	$content=str_replace("{info}", $video->show_gdep_form(), $content);}
	if ($conf=="true"){ $gdep=$video->add_gdep_form();$wn=""; }
}
if ($wn=="edit_gdep"){
	if ($conf==""){	$content=str_replace("{info}", $video->edit_gdep_form($gdep), $content); }
	if ($conf=="true"){ $gdep=$video->save_gdep_form();$wn=""; }
}
if ($wn=="delete_gdep"){ $video->delete_gdep_form($gdep);$wn=""; }


if ($wn=="new_theme"){
	if ($conf==""){	$content=str_replace("{info}", $video->show_theme_form($gdep), $content);}
	if ($conf=="true"){ $theme=$video->add_theme_form();$wn="show_theme"; }
}
if ($wn=="edit_theme"){
	if ($conf==""){	$content=str_replace("{info}", $video->edit_theme_form($gdep,$theme), $content); }
	if ($conf=="true"){ $theme=$video->save_theme_form();$wn="show_theme"; }
}
if ($wn=="delete_theme"){ $video->delete_theme_form($theme);$wn="show_theme"; }



if ($wn=="new_video"){
	if ($conf==""){	$content=str_replace("{info}", $video->show_video_form($gdep,$theme), $content);}
	if ($conf=="true"){ $video_id=$video->add_video_form();$wn="show_video"; }
}
if ($wn=="edit_video"){
	if ($conf==""){	$content=str_replace("{info}", $video->edit_video_form($gdep,$theme,$video_id), $content); }
	if ($conf=="true"){ $video_id=$video->save_video_form();$wn="show_video"; }
}
if ($wn=="delete_video"){ $video->delete_video_form($video_id);$wn="show_video"; }

if ($wn=="delete_video_opinion"){ $video->delete_video_opinion($video_id,$opinion_id);$wn="show_video_file"; }



}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

if ($wn==""){
	$content=str_replace("{info}", $video->show_video_dep(), $content);
}
if ($wn=="show_theme"){ 
	$content=str_replace("{info}", $video->show_video_theme($gdep), $content); 
}
if ($wn=="show_video"){ 
	$content=str_replace("{info}", $video->show_video($gdep,$theme), $content); 
}
if ($wn=="show_video_file"){ 
	$content=str_replace("{info}", $video->show_video_file($gdep,$theme,$video_id), $content); 
}

$content=str_replace("{menu}", $mdl->show_dep_menu(), $content);
?>