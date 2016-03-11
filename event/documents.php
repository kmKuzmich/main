<?php

include RD.'/lib/documents_class.php';
$documents= new documents;$menu= new menu;
$documents_htm=RD."/tpl/documents.htm";
if (!file_exists("$documents_htm")){ $documents_window="Не знайдено файл шаблону"; }
if (file_exists("$documents_htm")){ $documents_window = file_get_contents($documents_htm);}
$content=str_replace("{work_window}", $config->one_side_content($documents_window), $content);

if ($w==""){
	$content=str_replace("{filter_form}", $documents->show_filter_form(), $content);
	$content=str_replace("{documents}", $documents->show_list(), $content);
}
$content=str_replace("{head}", "Документы", $content);
$content=str_replace("{navigation}", $slave->show_navigation($dep_up,""), $content);
?>