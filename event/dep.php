<?php
include RD.'/lib/dep_class.php';
$dep= new dep;$slave= new slave;$config=new config;
$dep_htm=RD."/tpl/dep.htm"; $dep_window="";if (file_exists("$dep_htm")){ $dep_window = file_get_contents($dep_htm);}

$news=new news; $bottom_side=$news->show_range_news(); //kuz 24-09-2014
$content=str_replace("{work_window}", $config->one_side_content($dep_window,"",$bottom_side), $content);
list($dep_caption,$dep_desc)=$dep->show_dep_desc($dep_cur);
$content=str_replace("{dep_caption}", $dep_caption, $content);
$content=str_replace("{dep_desc}", $dep_desc, $content);
$content=str_replace("{navigation}", $slave->show_navigation($dep_up,""), $content);
?>