<?php

include RD.'/lib/callback_class.php';
$callback= new callback;$menu= new menu;$slave=new slave;

$callback_htm=RD."/tpl/callback.htm";
if (!file_exists("$callback_htm")){ $callback_window="�� �������� ���� �������"; }
if (file_exists("$callback_htm")){ $callback_window = file_get_contents($callback_htm);}
$content=str_replace("{work_window}", $config->one_side_content($callback_window), $content);
if ($w==""){
	if ($conf==""){
		$fb=$callback->show_callback();
	}
	if ($conf=="true"){
		$fb=$callback->send_message();
	}
	$content=str_replace("{callback_caption}", "����� ��������� ������", $content);
	$content=str_replace("{callback_desc}", $fb, $content);
}
?>