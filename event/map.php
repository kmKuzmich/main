<?php
include RD.'/lib/map_class.php';$map= new map;
$map_htm=RD."/tpl/map.htm";
if (!file_exists("$map_htm")){ $map_window="�� �������� ���� �������"; }
if (file_exists("$map_htm")){ $map_window = file_get_contents($map_htm);}
$content=str_replace("{work_window}", $map_window, $content);

$content=str_replace("{map_caption}", "����� �����", $content);
$content=str_replace("{map_desc}", $map->show_map(), $content);
?>