<?php
//не нашёл применения єтого скрипта
include RD . '/lib/anons_class.php';
$anons = new anons;
$anons_htm = RD . "/tpl/anons.htm";
if (!file_exists("$anons_htm")) {
    $anons_window = "Не знайдено файл шаблону";
}
if (file_exists("$anons_htm")) {
    $anons_window = file_get_contents($anons_htm);
}
$content = str_replace("{work_window}", $config->one_side_content($anons_window), $content);

if ($w == "") {
    $content = str_replace("{head}", "Анонси і оголошення", $content);
    $content = str_replace("{anons}", $anons->show_list($dep_up, $dep_cur), $content);
    $content = str_replace("{anons_list}", "", $content);
}
if ($w == "show_anons") {
    $content = str_replace("{head}", "", $content);
    $content = str_replace("{anons}", $anons->show_desc($anons_id, $dep_up, $dep_cur), $content);
}

$content = str_replace("{navigation}", $slave->show_navigation($dep_cur, ""), $content);
?>