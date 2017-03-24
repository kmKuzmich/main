<?php
$slave = new slave; $config = new config; $shop = new shop;
$frm_htm = RD . "/tpl/client_report.htm"; $frm = ""; if (file_exists("$frm_htm")) { $frm = file_get_contents($frm_htm);}

$content = str_replace("{work_window}", $config->one_side_content2($frm, "{doc_side}", ""), $content);
$content = str_replace("{doc_side}", $shop->show_doc_side(), $content);
if ($w == "") {
    $content = str_replace("{doc}", $shop->show_client_report($_REQUEST["period"]), $content);
    $content = str_replace("{doc_list}", "", $content);
}
if ($w == "show_doc") {
    $content = str_replace("{doc}", $shop->show_doc($order_id), $content);
    $content = str_replace("{doc_list}", $shop->show_short_order_docs(), $content);
}
?>