<?php
$db = new db;$slave = new slave;
include 'lib/order_class.php';$order=new order;
include_once 'lib/catalogue_class.php';$cat=new catalogue;
include_once 'lib/catalogue_actions_class.php';$cat_actions=new catalogue_actions;
include 'lib/client_class.php';$cl=new client;
include 'lib/kours_class.php';$kr=new kours;

require_once ("../js/JsHttpRequest/JsHttpRequest.php");$JsHttpRequest =& new JsHttpRequest("windows-1251");

session_start();
$dep=$slave->get_dep();

if ($_REQUEST["w"]=="showPriceForm"){ $GLOBALS['_RESULT'] = array("content"=>$cat->get_price_list($_REQUEST["provider"]));}

if ($_REQUEST["w"]=="show_catalogue_form"){ $GLOBALS['_RESULT'] = array("content"=>$cat_actions->show_catalogue_list($_REQUEST["top_id"]));}
if ($_REQUEST["w"]=="get_catalogue_caption"){ $GLOBALS['_RESULT'] = array("content"=>$cat_actions->get_table_caption("catalogue",$_REQUEST["model"]));}
if ($_REQUEST["w"]=="show_items_form"){ $GLOBALS['_RESULT'] = array("content"=>$cat_actions->show_items_list($_REQUEST["place"],$_REQUEST["top_id"]));}
if ($_REQUEST["w"]=="get_catalogue_caption_price"){ list($caption,$price)=$cat_actions->get_catalogue_caption_price($_REQUEST["model"]);$GLOBALS['_RESULT'] = array("item"=>$caption,"price"=>$price);}

if ($w=="show_order_list"){$content=$order->show_order_list("",$page);}
if ($w=="show_order"){$content=$order->show_order($order_id);}
if ($w=="delete_order"){$content=$order->delete_order($order_id);}
if ($w=="show_order_status"){$content=$order->show_order_status($order_id);}
if ($w=="save_order_status"){$content=$order->save_order_status($order_id,$_GET["status"]);}
if ($w=="show_kurier_form"){$content=$order->show_kurier_form($order_id);}
if ($w=="save_order_kurier"){$content=$order->save_order_kurier($order_id,$_GET["id"],$_GET["kurier"],$_GET["ttn"],$_GET["price"],$_GET["message"]);}
if ($w=="send_order_kurier_sms"){$content=$order->send_order_kurier_sms($order_id,$_GET["message"]);}


if ($w=="show_kours_list"){$content=$kr->show_kours_list($page);}
if ($w=="show_client_list"){$content=$cl->show_client_list($page);}
if ($w=="show_client"){$content=$cl->show_client($client_id);}
if ($w=="show_client_discount"){$content=$cl->show_client_discount($client_id);}
if ($w=="save_client_discount"){$content=$cl->save_client_discount($client_id,$_GET["discount"]);}

if ($w=="arch_model"){$content=$cat->arch_model($model);}

//--------------------------------------------------------------------------------------------------------------

if ($w=="new_client"){
	if ($conf==""){$content=$cl->new_client();}
	if ($conf=="true"){$content=$cl->save_client();}
}
?>