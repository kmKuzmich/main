<?php

include RD.'/lib/users_class.php';
$users= new users;$mdl=new module;$access=new access;session_start();$slave=new slave;
$users_htm=RD."/tpl/users.htm";
if (!file_exists("$users_htm")){ $users_window="Не знайдено файл шаблону"; }
if (file_exists("$users_htm")){ $users_window = file_get_contents($users_htm);}
$content=str_replace("{work_window}", $users_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

if ($wn=="new"){
	if ($conf==""){ $content=str_replace("{info}", $users->show_users_form(), $content); }
	if ($conf=="true"){ $content=str_replace("{info}", $users->add_users_form(), $content); }
}
if ($wn=="edit"){
	if ($conf==""){ $content=str_replace("{info}", $users->edit_users_form($_GET["users_id"]), $content); }
	if ($conf=="true"){ $content=str_replace("{info}", $users->save_users_form(), $content); }
}
if ($wn=="delete"){ $content=str_replace("{info}", $users->delete_users_form($_GET["users_id"]), $content); }


if ($wn=="edit_rights"){
	if ($conf==""){ $content=str_replace("{info}", $users->edit_rights_form($_GET["users_id"]), $content); }
	if ($conf=="true"){ $content=str_replace("{info}", $users->save_rights_form(), $content); }
}


}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0"){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

//--------------------------------------------------------------------------------------------

if ($wn==""){ $content=str_replace("{info}", $users->show_users_list(), $content); }
if ($wn=="show_rights"){ $content=str_replace("{info}", $users->show_rights_list($_GET["users_id"]), $content); }
?>