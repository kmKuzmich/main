<?php

include RD.'/lib/articles_class.php';
$articles= new articles;$mdl=new module;$access=new access;session_start();$slave=new slave;
$articles_htm=RD."/tpl/articles.htm";
if (!file_exists("$articles_htm")){ $articles_window="Не знайдено файл шаблону"; }
if (file_exists("$articles_htm")){ $articles_window = file_get_contents($articles_htm);}
$content=str_replace("{work_window}", $articles_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

if ($wn=="new_theme"){
	if ($conf==""){ $content=str_replace("{info}", $articles->show_theme_form(), $content); }
	if ($conf=="true"){ $content=str_replace("{info}", $articles->add_theme_form(), $content); }
}
if ($wn=="edit_theme"){
	if ($conf==""){ $content=str_replace("{info}", $articles->edit_theme_form($theme_id), $content); }
	if ($conf=="true"){$content=str_replace("{info}", $articles->save_theme_form(), $content); }
}
if ($wn=="delete_theme"){
	if ($conf=="true"){ $content=str_replace("{info}", $articles->delete_theme_form($theme_id), $content);}
}


if ($wn=="new_articles"){
	if ($conf==""){ $content=str_replace("{info}", $articles->show_articles_form($theme_id), $content); }
	if ($conf=="true"){$content=str_replace("{info}", $articles->add_articles_form(), $content); }
}
if ($wn=="edit_articles"){
	if ($conf==""){ $content=str_replace("{info}", $articles->edit_articles_form($theme_id,$articles_id), $content); }
	if ($conf=="true"){$content=str_replace("{info}", $articles->save_articles_form(), $content); }
}
if ($wn=="delete_articles"){
	if ($conf=="true"){ $content=str_replace("{info}", $articles->delete_articles_form($theme_id,$articles_id), $content);}
}

}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

//--------------------------------------------------------------------------------------------

if ($wn==""){
	$content=str_replace("{info}", $articles->show_theme_list(), $content);
}
if ($wn=="list_articles"){
	$content=str_replace("{info}", $articles->show_articles_list($theme_id), $content);
}
?>