<?php

include RD.'/inc/class/test_question_class.php';
$question= new question;

//---------------------------------------------
// question_program part
//---------------------------------------------
if ($w=="new_question"){
	if ($conf==""){
		$question_menu="
		<table  class='menu_work'><tr>
		<td><a href='?dep=$dep' title='Назад'><img src='images/menu/back.png' border=0></a></td>
		</tr></table>";
		$content=str_replace("{work_window}", $question_menu.$question->new_question(), $content);
	}
	if ($conf=="true"){
		$question->add_question();
		$w="";
	}
}

if ($w=="edit_question"){
	if ($conf==""){
		$question_menu="
		<table class='menu_work'><tr>
		<td><a href='?dep=$dep' title='Назад'><img src='images/menu/back.png' border=0></a></td>
		</tr></table>";
		$content=str_replace("{work_window}", $question_menu.$question->edit_question($question_id), $content);
	}
	if ($conf=="true"){
		$question->save_question();
		$w="";
	}
}

if ($w=="del_question"){
	if ($conf=="true"){
		$question->del_question($question_id);
		$w="";
	}
}
if ($w=="res_question"){
	if ($conf=="true"){
		$question->res_question($question_id);
		$w="";
	}
}

if ($w==""){
	$slave=new slave;

	$faculty=$slave->get_faculty();
	$speshiality=$slave->get_spesh();
	$discip=$slave->get_discip();
	$modul=$slave->get_modul();

	$question_menu="
	<table  class='menu_work'><tr>
	<td><a href='?dep=$dep&w=new_question&faculty=$faculty&speshiality=$speshiality&discip=$discip&modul=$modul' title='Новий модуль'><img src='images/menu/new.png' border=0></a></td>
	<td><a href='?dep=$dep&faculty=$faculty&speshiality=$speshiality&discip=$discip&modul=$modul' title='Активні модулі'><img src='images/menu/current.png' border=0></a></td>
	<td><a href='?dep=$dep&faculty=$faculty&speshiality=$speshiality&discip=$discip&modul=$modul&op=res' title='Деактивовані модулі'><img src='images/menu/archive.png' border=0></a></td>
	</tr></table>";

	$question_info=$slave->test_question_search_form(); 
	$question_info.=$question->list_question();
	$content=str_replace("{work_window}", $question_info, $content);
	$content=str_replace("{question_menu}", $question_menu, $content);
}
?>