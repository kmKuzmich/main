<?php

include RD.'/lib/projects_class.php';
$projects= new projects;$mdl=new module;$access=new access;session_start();$slave=new slave;
$projects_htm=RD."/tpl/projects.htm";
if (!file_exists("$projects_htm")){ $projects_window="Не знайдено файл шаблону"; }
if (file_exists("$projects_htm")){ $projects_window = file_get_contents($projects_htm);}
$content=str_replace("{work_window}", $projects_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

if ($wn=="new"){
	if ($conf==""){
		$content=str_replace("{info}", $projects->show_projects_form(), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $projects->add_projects_form(), $content);
	}
}
if ($wn=="edit"){
	if ($conf==""){
		$content=str_replace("{info}", $projects->edit_projects_form($projects_id), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $projects->save_projects_form(), $content);
	}
}
if ($wn=="delete"){
	$content=str_replace("{info}", $projects->delete_projects($projects_id), $content);
}
if ($wn=="delete_projects_opinion"){
	$projects->delete_projects_opinion($projects_id,$opinion_id);$wn="show";
}


}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

//--------------------------------------------------------------------------------------------

if ($wn==""){
	$content=str_replace("{info}", $projects->show_projects_list(), $content);
}
if ($wn=="show"){
	$content=str_replace("{info}", $projects->show_projects_desc($projects_id), $content);
}
$content=str_replace("{menu}", $mdl->show_dep_menu(), $content);

?>