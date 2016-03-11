<?php
include RD.'/lib/video_class.php';
$video= new video;
$video_htm=RD."/tpl/video.htm";if (file_exists("$video_htm")){ $video_window = file_get_contents($video_htm);}
$content=str_replace("{work_window}", $config->one_side_content($video_window), $content);
if ($w==""){ 
	$content=str_replace("{head}", "Відеогалерея", $content);
	$content=str_replace("{video}", $video->show_video_theme(), $content); 
}
if ($w=="show_video"){ 
	$content=str_replace("{head}", $video->get_theme_caption($theme), $content);
	$content=str_replace("{video}", $video->show_video_file($theme,$video_id), $content); 
}
$content=str_replace("{navigation}", $slave->show_navigation($dep_cur,""), $content);
?>