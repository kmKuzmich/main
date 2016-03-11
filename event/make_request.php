<?php

include RD.'/lib/make_request_class.php';
$mr= new make_request;$menu= new menu;$slave= new slave;

$make_request_htm=RD."/tpl/make_request.htm";
if (!file_exists("$make_request_htm")){ $make_request_window="Не знайдено файл шаблону"; }
if (file_exists("$make_request_htm")){ $make_request_window = file_get_contents($make_request_htm);}

$content=str_replace("{work_window}", $make_request_window, $content);
if ($level>2){$content=str_replace("{sub_dep_menu}", $menu->show_sub_dep_menu($_GET["dep_cur"]), $content);}
if ($level<=2){$content=str_replace("{sub_dep_menu}", "", $content);}
$content=str_replace("{cloud_tags}", $slave->get_cloud_tags($dep_cur), $content);

if ($w==""){
	if ($conf==""){
		$content=str_replace("{make_request_desc}", $mr->show_make_request(), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{make_request_desc}", $mr->send_message(), $content);
	}
}
?>