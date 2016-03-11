<?php
include RD.'/lib/articles_class.php';
include RD.'/lib/datemenu_class.php';
$articles= new articles;$menu= new menu;

$articles_htm=RD."/tpl/articles.htm";
if (!file_exists("$articles_htm")){ $articles_window="Не знайдено файл шаблону"; }
if (file_exists("$articles_htm")){ $articles_window = file_get_contents($articles_htm);}
$content=str_replace("{work_window}", $config->one_side_content($articles_window), $content);

if ($w==""){
	$content=str_replace("{articles}", $articles->show_theme_articles($theme), $content);
}
if ($w=="list_articles"){ 
	$content=str_replace("{articles}", $articles->show_articles($theme,$date), $content); 
}
if ($w=="show_articles"){ 
	$content=str_replace("{articles}", $articles->show_articles_desc($articles_id), $content); 
}
?>