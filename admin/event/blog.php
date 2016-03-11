<?php

include RD.'/lib/blog_class.php';
$blog= new blog;$mdl=new module;$access=new access;session_start();$slave=new slave;
$blog_htm=RD."/tpl/blog.htm";
if (!file_exists("$blog_htm")){ $blog_window="Не знайдено файл шаблону"; }
if (file_exists("$blog_htm")){ $blog_window = file_get_contents($blog_htm);}
$content=str_replace("{work_window}", $blog_window, $content);


if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){
	
if ($wn=="new_person"){
	if ($conf==""){	$content=str_replace("{info}", $blog->show_person_form(), $content);}
	if ($conf=="true"){$person=$blog->add_person();$wn="";}
}

if ($wn=="edit_person"){
	if ($conf==""){	$content=str_replace("{info}", $blog->edit_person_form($person), $content);}
	if ($conf=="true"){	$person=$blog->save_person();$wn="";}
}


if ($wn=="delete_person"){if ($conf=="true"){ $blog->delete_person($person);}$wn=""; }
if ($wn=="delete_blog"){if ($conf=="true"){ $blog->delete_blog($blog_dep);}$wn="dep_list"; }
if ($wn=="delete_theme"){if ($conf=="true"){$blog->delete_theme($theme);}$wn="theme_list";}
if ($wn=="delete_opinion"){if ($conf=="true"){ $blog->delete_opinion($opinion_id);}$wn="opinion_list";}



}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}


if ($wn==""){ $content=str_replace("{info}", $blog->show_blog_person_list(), $content); }
if ($wn=="dep_list"){ $content=str_replace("{info}", $blog->show_blog_dep_list($person), $content); }
if ($wn=="theme_list"){ $content=str_replace("{info}", $blog->show_blog_theme_list($person,$blog_dep), $content); }
if ($wn=="opinion_list"){ $content=str_replace("{info}", $blog->show_opinion_list($person,$blog_dep,$theme), $content); }


$content=str_replace("{menu}", $mdl->show_dep_menu(), $content);
?>