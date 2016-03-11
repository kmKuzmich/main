<?php
include 'lib/client_class.php';
$cl=new client;$access=new access;session_start();$slave=new slave;
$client_htm=RD."/tpl/clients.htm";
if (!file_exists("$client_htm")){ $client_window="Не знайдено файл шаблону"; }
if (file_exists("$client_htm")){ $client_window = file_get_contents($client_htm);}
$content=str_replace("{work_window}", $client_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){
	if ($w=="edit_client"){
		if ($conf==""){	$content=str_replace("{info}", $cl->edit_client($client_id), $content); }
		if ($conf=="true"){$content=str_replace("{info}", $cl->update_client(), $content);}
	}
	if ($w=="del_client"){ 
		if ($conf=="true"){ $content=str_replace("{info}", $cl->del_client($client_id), $content);}
	}

	if ($w==""){
		$content=str_replace("{client_search_form}", $cl->show_client_search_form(), $content); 
		$content=str_replace("{info}", $cl->show_client_list($page,$where), $content); 
	}
}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}
$content=str_replace("{client_search_form}", "", $content); 
?>