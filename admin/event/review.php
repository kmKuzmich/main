<?php

include RD.'/lib/review_class.php';
$review= new review;$mdl=new module;$access=new access;session_start();$slave=new slave;
$review_htm=RD."/tpl/review.htm";
if (!file_exists("$review_htm")){ $review_window="Не знайдено файл шаблону"; }
if (file_exists("$review_htm")){ $review_window = file_get_contents($review_htm);}
$content=str_replace("{work_window}", $review_window, $content);

if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){

if ($wn=="new"){
	if ($conf==""){
		$content=str_replace("{info}", $review->show_review_form(), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $review->add_review_form(), $content);
	}
}
if ($wn=="edit"){
	if ($conf==""){
		$content=str_replace("{info}", $review->edit_review_form($review_id), $content);
	}
	if ($conf=="true"){
		$content=str_replace("{info}", $review->save_review_form(), $content);
	}
}
if ($wn=="delete"){
	$content=str_replace("{info}", $review->delete_review_form($review_id), $content);
}


}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}

//--------------------------------------------------------------------------------------------

if ($wn==""){
	$content=str_replace("{info}", $review->show_review_list(), $content);
}
?>