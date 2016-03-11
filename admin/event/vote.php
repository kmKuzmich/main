<?php

include RD.'/lib/vote_class.php';
$vote= new vote;$mdl=new module;$access=new access;session_start();$slave=new slave;
$vote_htm=RD."/tpl/vote.htm";
if (!file_exists("$vote_htm")){ $vote_window="Не знайдено файл шаблону"; }
if (file_exists("$vote_htm")){ $vote_window = file_get_contents($vote_htm);}
$content=str_replace("{work_window}", $vote_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

if ($wn=="new"){
	if ($conf==""){ $content=str_replace("{info}", $vote->show_vote_form(), $content); }
	if ($conf=="true"){ $content=str_replace("{info}", $vote->add_vote_form(), $content); }
}
if ($wn=="edit"){
	if ($conf==""){ $content=str_replace("{info}", $vote->edit_vote_form($_GET["vote_id"]), $content); }
	if ($conf=="true"){ $content=str_replace("{info}", $vote->save_vote_form(), $content); }
}
if ($wn=="delete"){ $content=str_replace("{info}", $vote->delete_vote_form($_GET["vote_id"]), $content); }
//--------------------------------------------------------------------------------------------


}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}


if ($wn==""){ $content=str_replace("{info}", $vote->show_vote_list(), $content); }
if ($wn=="show"){ $content=str_replace("{info}", $vote->show_vote_desc($_GET["vote_id"]), $content); }
?>