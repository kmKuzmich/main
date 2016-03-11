<?php

$main_page_htm=RD."/tpl/main_page.htm";
if (!file_exists("$main_page_htm")){ $main_page="Не знайдено файл шаблону"; }
if (file_exists("$main_page_htm")){ $main_page = file_get_contents($main_page_htm);}
$content=str_replace("{work_window}", $main_page, $content);
if ($w==""){
	include 'lib/news_class.php';
	$news=new news;
	$news_block=$news->show_main_page_news();
	$content=str_replace("{news_block}", $news_block, $content);
}
?>