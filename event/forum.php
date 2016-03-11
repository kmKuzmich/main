<?php
include 'lib/forum_class.php';
$forum=new forum;
$forum_htm=RD."/tpl/forum.htm";
if (!file_exists("$forum_htm")){ $forum_window="Не знайдено файл шаблону"; }
if (file_exists("$forum_htm")){ $forum_window = file_get_contents($forum_htm);}
$content=str_replace("{work_window}", $config->one_side_content($forum_window), $content);

$page=$slave->get_page();
$forum_id=$slave->get_forum_id();
$theme_id=$slave->get_theme_id();

//$content=str_replace("{forum_menu}", $forum->show_forum_menu($forum_id,$theme_id), $content);


if ($w=="new_theme"){
	if ($conf==""){
		$content=str_replace("{forum}", $forum->new_theme($forum_id), $content);
	}
	if ($conf=="true"){
		$forum_id=$forum->add_forum_theme();$w="theme_list";
	}
}

if ($w=="new_answer"){
	if ($conf=="true"){
		list($forum_id,$theme_id)=$forum->add_forum_answer();$w="answer_list";
	}
}


if ($w==""){ $content=str_replace("{forum}", $forum->show_forum_list(), $content); }
if ($w=="theme_list"){ 
	$content=str_replace("{forum}", $forum->show_theme_list($forum_id,$page), $content); 
	$theme_menu="<a href='?dep=$dep&dep_cur=$dep_cur&w=new_theme&forum_id=$forum_id'>Нова тема</a>";
	$content=str_replace("{menu}", $theme_menu, $content); 
}
if ($w=="answer_list"){ $content=str_replace("{forum}", $forum->show_answer_list($forum_id,$theme_id), $content); }


$content=str_replace("{forum_navigation}", $forum->show_forum_navigation($forum_id,$theme_id), $content);
$content=str_replace("{menu}", "", $content); 
?>