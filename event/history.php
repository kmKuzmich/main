<?php
$slave= new slave;$config=new config;$shop=new shop;
$order_htm=RD."/tpl/history.htm";$order_window="";if (file_exists("$order_htm")){ $order_window = file_get_contents($order_htm);}
$content=str_replace("{work_window}", $config->one_side_content($order_window,"{doc_side}",""), $content);
$content=str_replace("{doc_side}", $shop->show_doc_side(), $content); 
if ($w==""){
	$content=str_replace("{order}", $shop->show_order_history($page), $content); 
	$content=str_replace("{order_list}", "", $content); 
}
if ($w=="show_order"){
	$content=str_replace("{order}", $shop->show_order($_GET["order_id"]), $content); 
	$content=str_replace("{order_list}", $shop->show_short_order_list(), $content); 
}
?>