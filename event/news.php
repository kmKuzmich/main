<?php
$news= new news;
$news_htm=RD."/tpl/news.htm";if (file_exists("$news_htm")){ $news_window = file_get_contents($news_htm);}
$content=str_replace("{work_window}", $config->one_side_content($news_window,"{news_side}","spo"), $content);
$content=str_replace("{work_window}", $config->one_side_content($news_window,"","spo"), $content);
$news_id=$_GET["news_id"];
$data=$_GET["data"];
if ($w==""){
	$content=str_replace("{head}", "Новости компании Автолидер", $content);
	$content=str_replace("{news}", $news->show_list($data), $content); //kuz 24-09-2014
//	$calendar=file_get_contents(RD."/tpl/calendar_form.htm");
//	$content=str_replace("{news_side}", $calendar, $content);
}
if ($w=="show_news"){
	$content=str_replace("{head}", "Новости компании Автолидер", $content);
	$content=str_replace("{news}", $news->show_desc($news_id), $content); //kuz 24-09-2014
	$content=str_replace("{news_side}", "", $content);
}

$content=str_replace("{navigation}", $slave->show_navigation($dep_cur,""), $content);
?>