<?php
include 'lib/blog_class.php';
$blog=new blog;
$blog_htm=RD."/tpl/blog.htm";
if (!file_exists("$blog_htm")){ $blog_window="Не знайдено файл шаблону"; }
if (file_exists("$blog_htm")){ $blog_window = file_get_contents($blog_htm);}
$content=str_replace("{work_window}", $config->one_side_content($blog_window), $content);

$blog->get_blog_user();

if ($w=="new_dep"){
	if ($conf==""){
		$content=str_replace("{blog}", $blog->show_person_blog_form($person,""), $content); 
	}
	if ($conf=="true"){
		list($person,$blog_id)=$blog->add_blog_dep();$w="person";
	}
}

if ($w=="new_theme"){
	if ($conf==""){
		$content=str_replace("{blog}", $blog->show_person_blog_form($person,$blog_id), $content); 
	}
	if ($conf=="true"){
		list($person,$blog_id,$theme_id)=$blog->add_blog_theme();
		print "$person,$blog_id,$theme_id";
		$w="person";
	}
}


if ($w==""){ 
	$content=str_replace("{blog}", $blog->show_person_list(), $content); 
}
if ($w=="person"){ 
	$content=str_replace("{blog}", $blog->show_person_blog($person,$blog_id,$theme_id), $content); 
}

?>