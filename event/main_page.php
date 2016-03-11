<?php
$main_page_htm=RD."/tpl/main_page.htm";if (file_exists("$main_page_htm")){ $main_page = file_get_contents($main_page_htm);}
$content=str_replace("{work_window}", $main_page, $content);
if ($w==""){
	
	$cl=new client; $content=str_replace("{autorization}", $cl->get_client(), $content);
	$shop=new shop; $content=str_replace("{busket}", $shop->show_busket(), $content);
	//-----
	include_once 'lib/dep_class.php'; $dep=new dep;

	$news=new news; //kuz 24-09-2014
	$content=str_replace("{news}", $news->show_main_page_news(), $content); //kuz 24-09-2014
	$catalogue=new catalogue;
	$content=str_replace("{brand_list}", $catalogue->show_brand_list(), $content); //kuz 24-09-2014
//	$content=str_replace("{tecdoc_form}", $catalogue->show_mp_tecdoc(), $content); //kuz 24-09-2014
	$content=str_replace("{STO_form}", $catalogue->show_sto_form(), $content);

	include 'lib/banner_class.php'; $banner=new banner; //kuz 24-09-2014
	$content=str_replace("{big_banners}", $banner->show_big_banners(), $content); //kuz 24-09-2014
	
}
$content=str_replace("{dep_menu}", "", $content);
?>