<?php
$cl=new client;

if ($w==""){
	$content=str_replace("{work_window}", $cl->show_pass_forgot_form(), $content);
}
if ($w=="send"){
	$content=str_replace("{work_window}", $cl->send_pass_forgot(), $content);
}

?>