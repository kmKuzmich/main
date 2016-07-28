<?php
//не нашёл применения єтого скрипта
include RD . '/lib/projects_class.php';
$projects = new projects;
$menu = new menu;
$projects_htm = RD . "/tpl/projects.htm";
if (!file_exists("$projects_htm")) {
    $projects_window = "Не знайдено файл шаблону";
}
if (file_exists("$projects_htm")) {
    $projects_window = file_get_contents($projects_htm);
}
$content = str_replace("{work_window}", $config->one_side_content($projects_window), $content);

if ($w == "") {
    $content = str_replace("{filter_form}", $projects->show_filter_form(), $content);
    $content = str_replace("{projects}", $projects->show_list(), $content);
}
if ($w == "show_projects") {
    $content = str_replace("{filter_form}", "", $content);
    $content = str_replace("{projects}", $projects->show_desc($document_id), $content);
}
$content = str_replace("{head}", "Проекти рішень та їх обговорення", $content);
$content = str_replace("{navigation}", $slave->show_navigation($dep_up, ""), $content);
?>