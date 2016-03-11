<?php
include RD.'/lib/review_class.php';
include RD.'/lib/datemenu_class.php';
$review= new review;$menu= new menu;$date_menu=new date_menu;

$review_htm=RD."/tpl/review.htm";
if (!file_exists("$review_htm")){ $review_window="Не знайдено файл шаблону"; }
if (file_exists("$review_htm")){ $review_window = file_get_contents($review_htm);}
$content=str_replace("{work_window}", $config->one_side_content($review_window), $content);

if ($w==""){ $content=str_replace("{review}", $review->show_review($year), $content); }
if ($w=="show_review"){ 
	$content=str_replace("{review}", $review->show_review_desc($review_id), $content);
}
?>
