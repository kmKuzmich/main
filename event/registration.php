<?php
$cl=new client;
$slave= new slave;$config=new config;
$profile_htm=RD."/tpl/registration.htm";
if (!file_exists("$profile_htm")){ $profile_window="Не знайдено файл шаблону"; }
if (file_exists("$profile_htm")){ $profile_window = file_get_contents($profile_htm);}
$content=str_replace("{work_window}", $config->one_side_content($profile_window), $content);
if ($w==""){ $content=str_replace("{form}", $cl->show_registration_form(), $content); }
if ($w=="send"){ $content=str_replace("{form}", $cl->save_client_registration(), $content); }
?>