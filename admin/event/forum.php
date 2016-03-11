<?php

include RD.'/lib/forum_class.php';
$forum= new forum;$mdl=new module;$access=new access;session_start();$slave=new slave;
$forum_htm=RD."/tpl/forum.htm";
if (!file_exists("$forum_htm")){ $forum_window="Не знайдено файл шаблону"; }
if (file_exists("$forum_htm")){ $forum_window = file_get_contents($forum_htm);}
$content=str_replace("{work_window}", $forum_window, $content);


if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){
	
if ($wn=="new_forum"){
	if ($conf==""){	$content=str_replace("{info}", $forum->show_forum_form(), $content);}
	if ($conf=="true"){$forum_id=$forum->add_forum();$wn="";}
}

if ($wn=="edit_forum"){
	if ($conf==""){	$content=str_replace("{info}", $forum->edit_forum_form($forum_id), $content);}
	if ($conf=="true"){	$forum_id=$forum->save_forum();$wn="";}
}

if ($wn=="delete_forum"){if ($conf=="true"){ $forum->delete_forum($forum_id);}$wn=""; }

if ($wn=="edit_theme"){
	if ($conf==""){	$content=str_replace("{info}", $forum->edit_theme_form($forum_id,$theme), $content);}
	if ($conf=="true"){	$forum_id=$forum->save_theme();$wn="theme_list";}
}

if ($wn=="delete_theme"){if ($conf=="true"){$forum->delete_theme($theme);}$wn="theme_list";}
if ($wn=="delete_answer"){if ($conf=="true"){ $forum->delete_answer($answer_id);}$wn="answer_list";}



}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}


if ($wn==""){ $content=str_replace("{info}", $forum->show_forum_list(), $content); }
if ($wn=="theme_list"){ $content=str_replace("{info}", $forum->show_theme_list($forum_id), $content); }
if ($wn=="answer_list"){ $content=str_replace("{info}", $forum->show_answer_list($forum_id,$theme), $content); }


$content=str_replace("{menu}", $mdl->show_dep_menu(), $content);
?>