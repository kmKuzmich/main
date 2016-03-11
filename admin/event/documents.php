<?php

include RD.'/lib/documents_class.php';
$documents= new documents;$mdl=new module;$access=new access;session_start();$slave=new slave;
$documents_htm=RD."/tpl/documents.htm";
if (!file_exists("$documents_htm")){ $documents_window="Не знайдено файл шаблону"; }
if (file_exists("$documents_htm")){ $documents_window = file_get_contents($documents_htm);}
$content=str_replace("{work_window}", $documents_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

if ($wn=="new"){
	if ($conf==""){
		$content=str_replace("{info}", $documents->show_documents_form(), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $documents->add_documents_form(), $content);
	}
}
if ($wn=="edit"){
	if ($conf==""){
		$content=str_replace("{info}", $documents->edit_documents_form($documents_id), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $documents->save_documents_form(), $content);
	}
}
if ($wn=="delete"){
	$content=str_replace("{info}", $documents->delete_documents($documents_id), $content);
}
if ($wn=="delete_documents_opinion"){
	$documents->delete_documents_opinion($documents_id,$opinion_id);$wn="show";
}


}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

//--------------------------------------------------------------------------------------------

if ($wn==""){
	$content=str_replace("{info}", $documents->show_documents_list(), $content);
}
if ($wn=="show"){
	$content=str_replace("{info}", $documents->show_documents_desc($documents_id), $content);
}
?>