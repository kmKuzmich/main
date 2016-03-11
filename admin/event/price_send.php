<?php

include RD.'/lib/price_send_class.php';
$price_send= new price_send;$mdl=new module;$access=new access;session_start();$slave=new slave;
$price_send_htm=RD."/tpl/price_send.htm";
if (!file_exists("$price_send_htm")){ $price_send_window="Не знайдено файл шаблону"; }
if (file_exists("$price_send_htm")){ $price_send_window = file_get_contents($price_send_htm);}
$content=str_replace("{work_window}", $price_send_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){


if ($wn==""){
	if ($conf==""){
		$content=str_replace("{info}", $price_send->presend_price_form(), $content);
	}
}
if ($wn=="send"){
	if ($conf=="true"){
		$content=str_replace("{info}", $price_send->send_price_send(), $content);
	}
}

}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

//--------------------------------------------------------------------------------------------
?>