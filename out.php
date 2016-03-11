<?php
$db = new db;  $odb = new odb;  $slave = new slave; $config=new config;
$ww_htm=RD."/theme/work_window.htm";$content="";if (file_exists("$ww_htm")){ $content = file_get_contents($ww_htm);}
//-----

$cl=new client; list($login_form,$login_forms)=$cl->get_client(); $content=str_replace("{autorization}", $login_form, $content);
$cl=new client; $content=str_replace("{login_forms}", $login_forms, $content);
$config->ident_user();
$dep=$slave->get_dep();
$dep_ud=$slave->get_dep_up();$dep_cur=$slave->get_dep_cur();$w=$slave->get_w();

if ($dep!="" and $dep!="0"){ $fn=$config->get_module_file($dep,1);}
if ($fn!=""){
	if (file_exists("event/".$fn.".php")){ include 'event/'.$fn.'.php'; }
}
if ($fn==""){
	$fn=$config->get_module_file($dep,2);
	if (file_exists("event/".$fn.".php")){ include 'event/'.$fn.'.php'; }
	if (!file_exists("event/".$fn.".php")){ include 'event/main_page.php'; }
}
$shop=new shop; $content=str_replace("{busket}", $shop->show_busket(), $content);
$menu=new menu;
$content=str_replace("{top_menu}", $menu->show_top_menu($dep_cur), $content);
$content=str_replace("{content_side}", $menu->show_dep_menu($dep_up,$dep_cur), $content);
$cat=new catalogue; 
//$content=str_replace("{catalogue_top_menu}", $cat->show_top_menu($cur_id), $content);
//$content=str_replace("{random_model_search}", $cat->show_random_model_search(), $content);

//$content=$slave->make_url_ok($content);
$content=str_replace("{site_year}", $slave->site_year(), $content);
$tkd=$slave->meta_head();
$content=str_replace("{title}", $tkd["title"], $content);
$content=str_replace("{keywords}", $tkd["keywords"], $content);
$content=str_replace("{description}", $tkd["description"], $content); 
$content=str_replace("{seo_info}", $tkd["seo_info"], $content); 
$content=str_replace("{today}", $slave->data_word(date("Y-m-d")), $content); 
?>