<?php
include 'lib/order_class.php';
$order=new order;$access=new access;session_start();$slave=new slave;
$order_htm=RD."/tpl/order.htm";
if (!file_exists("$order_htm")){ $order_window="Не знайдено файл шаблону"; }
if (file_exists("$order_htm")){ $order_window = file_get_contents($order_htm);}
$content=str_replace("{work_window}", $order_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){
	$content=str_replace("{order_search_form}",$order->show_order_search_form(),$content);
	$content=str_replace("{info}", $order->show_order_list($_GET["client"],$page), $content); 
}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}
?>