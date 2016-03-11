<?php

include RD.'/lib/test_class.php';
$test= new test; $mdl=new module; $access=new access;session_start();$slave=new slave;
$test_htm=RD."/tpl/test.htm";
if (!file_exists("$test_htm")){ $test_window="Не знайдено файл шаблону"; }
if (file_exists("$test_htm")){ $test_window = file_get_contents($test_htm);}
$content=str_replace("{work_window}", $test_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){


//---------------------------------------------
// modul_program part
//---------------------------------------------
if ($wn=="new_test"){
	if ($conf==""){$content=str_replace("{info}", $test->new_test(), $content); }
	if ($conf=="true"){$content=str_replace("{info}", $test->add_test(), $content); }
}

if ($wn=="edit_test"){
	if ($conf==""){ $content=str_replace("{info}", $test->edit_test($test_id), $content ); }
	if ($conf=="true"){ $content=str_replace("{info}", $test->save_test(), $content ); }
}

if ($wn=="delete_test"){
	if ($conf=="true"){ $content=str_replace("{info}", $test->delete_test($test_id), $content ); }
}

//-----------------------------------------------
if ($wn=="new_question"){
	if ($conf==""){$content=str_replace("{info}", $test->new_question($test_id,$var), $content); }
	if ($conf=="true"){$content=str_replace("{info}", $test->add_question(), $content); }
}

if ($wn=="edit_question"){
	if ($conf==""){ $content=str_replace("{info}", $test->edit_question($test_id,$question_id,$var), $content ); }
	if ($conf=="true"){ $content=str_replace("{info}", $test->save_question(), $content ); }
}

if ($wn=="del_question"){
	if ($conf=="true"){ $content=str_replace("{info}", $test->delete_question($test_id,$question_id), $content ); }
}

}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

if ($wn==""){ $content=str_replace("{info}", $test->show_test_list(), $content); }
if ($wn=="question_list"){ $content=str_replace("{info}", $test->show_question_list($test_id), $content); }

$content=str_replace("{menu}", $mdl->show_dep_menu(), $content);
?>