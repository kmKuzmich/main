<?php
include_once RD.'/lib/task_class.php';
$slave= new slave;$config=new config;$task=new task;
$task_htm=RD."/tpl/task.htm";$task_window="";if (file_exists("$task_htm")){ $task_window = file_get_contents($task_htm);}
$content=str_replace("{work_window}", $config->one_side_content($task_window,"",""), $content);

$content=str_replace("{task}", $task->show_task_calendar(), $content); 

?>