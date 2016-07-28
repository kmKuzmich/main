<?php
//не нашёл применения єтого скрипта
include RD . '/lib/galery_class.php';
$galery = new galery;
$galery_htm = RD . "/tpl/galery.htm";
if (!file_exists("$galery_htm")) {
    $galery_window = "Не знайдено файл шаблону1";
}
if (file_exists("$galery_htm")) {
    $galery_window = file_get_contents($galery_htm);
}
$content = str_replace("{work_window}", $config->one_side_content($galery_window), $content);

if ($w == "") {
    $content = str_replace("{head}", "Фотогалерея", $content);
    $content = str_replace("{galery}", $galery->show_galery_dep(), $content);
}
if ($w == "show_theme") {
    $content = str_replace("{head}", $galery->get_dep_caption($gdep), $content);
    $content = str_replace("{galery}", $galery->show_galery_theme($gdep), $content);
}
if ($w == "show_foto") {
    $content = str_replace("{head}", $galery->get_theme_caption($theme), $content);
    $content = str_replace("{galery}", $galery->show_galery_foto($gdep, $theme, $foto), $content);
}
$content = str_replace("{navigation}", $slave->show_navigation($dep_cur, ""), $content);
?>