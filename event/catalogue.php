<?php
$cat = new catalogue;
$catalogue_htm = RD . "/tpl/catalogue.htm";
if (file_exists("$catalogue_htm")) {
    $catalogue_window = file_get_contents($catalogue_htm);
}
$content = str_replace("{work_window}", $catalogue_window, $content);
$top_id = $slave->get_top_id();
$cur_id = $slave->get_cur_id();
$model = $slave->get_model();

$content = str_replace("{catalogue}", $cat->show_range($top_id, $cur_id, $model), $content);
/*
if ($cur_id!=""){$content=str_replace("{navigation}", $cat->show_catalogue_navigation($cur_id,""), $content);}
if ($cur_id==""){$content=str_replace("{navigation}", $cat->show_catalogue_navigation($top_id,""), $content);}
*/
?>