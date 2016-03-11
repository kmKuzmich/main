<?php
$mdl=new module;$access=new access;session_start();$slave=new slave;
$s_sms_htm=RD."/tpl/s_sms.htm";
if (!file_exists("$s_sms_htm")){ $s_sms_window="Не знайдено файл шаблону"; }
if (file_exists("$s_sms_htm")){ $s_sms_window = file_get_contents($s_sms_htm);}
$content=str_replace("{work_window}", $s_sms_window, $content);
?>