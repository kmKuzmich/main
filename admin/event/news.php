<?php

include RD.'/lib/news_class.php';
$news= new news;$mdl=new module;$access=new access;session_start();$slave=new slave;
$news_htm=RD."/tpl/news.htm"; $news_window=""; if (file_exists("$news_htm")){ $news_window = file_get_contents($news_htm);}
$content=str_replace("{work_window}", $news_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){
if ($wn=="new"){
	if ($conf==""){
		$content=str_replace("{info}", $news->show_news_form(), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $news->add_news_form(), $content);
	}
}
if ($wn=="edit"){
	if ($conf==""){
		print "ok";
		$content=str_replace("{info}", $news->edit_news_form($news_id), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $news->save_news_form(), $content);
	}
}
if ($wn=="delete"){
	$content=str_replace("{info}", $news->delete_news_form($news_id), $content);
}


}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

//--------------------------------------------------------------------------------------------

if ($wn==""){
	$content=str_replace("{info}", $news->show_news_list(), $content);
}
?>