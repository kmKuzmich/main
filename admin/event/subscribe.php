<?php

include RD.'/lib/subscribe_class.php';
$subscribe= new subscribe;$mdl=new module;$access=new access;session_start();$slave=new slave;
$subscribe_htm=RD."/tpl/subscribe.htm";
if (!file_exists("$subscribe_htm")){ $subscribe_window="Не знайдено файл шаблону"; }
if (file_exists("$subscribe_htm")){ $subscribe_window = file_get_contents($subscribe_htm);}
$content=str_replace("{work_window}", $subscribe_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

if ($wn=="new"){
	if ($conf==""){
		$content=str_replace("{info}", $subscribe->show_subscribe_form(), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $subscribe->add_subscribe_form(), $content);
	}
}
if ($wn=="edit"){
	if ($conf==""){
		$content=str_replace("{info}", $subscribe->edit_subscribe_form($subscribe_id), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $subscribe->save_subscribe_form(), $content);
	}
}
if ($wn=="delete"){
	$content=str_replace("{info}", $subscribe->delete_subscribe_form($subscribe_id), $content);
}

if ($wn=="send"){
	if ($conf==""){
		$content=str_replace("{info}", $subscribe->presend_subscribe_form($subscribe_id), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $subscribe->send_subscribe(), $content);
	}
}

}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

//--------------------------------------------------------------------------------------------

if ($wn==""){
	$content=str_replace("{info}", $subscribe->show_subscribe_list(), $content);
}
?>