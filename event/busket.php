<?php
$shop=new shop;session_start();$client=$_SESSION["client"];$session=session_id();
$busket_htm=RD."/tpl/busket.htm";if (file_exists("$busket_htm")){ $busket_window = file_get_contents($busket_htm);}
$content=str_replace("{work_window}", $config->one_side_content($busket_window,"{doc_side}",""), $content);
$content=str_replace("{doc_side}", $shop->show_doc_side(), $content);

if ($w==""){ $content=str_replace("{busket_client}", $shop->show_busket_client(), $content); }
if ($w=="make_order"){
	if ($client=="" and $session!=""){$content=str_replace("{busket_client}", $shop->show_fast_order_form(), $content); }
	if ($client!="" and $session!=""){$content=str_replace("{busket_client}", $shop->show_order_form(), $content); }
}

if ($w=="save_order"){ $content=str_replace("{busket_client}", $shop->save_order_form(), $content); }
if ($w=="save_fast_order"){ $content=str_replace("{busket_client}", $shop->save_fast_order_form(), $content); }
require_once (RD."/lib/news_class.php");$news=new news; //kuz 24-09-2014
$content=str_replace("{news}",$news->show_range_news(),$content); //kuz 24-09-2014

?>