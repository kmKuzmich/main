<?php
include RD.'/lib/search_class.php'; $search= new search;
$search_htm=RD."/tpl/search.htm";if (file_exists("$search_htm")){ $search_window = file_get_contents($search_htm);}
$content=str_replace("{work_window}", $search_window, $content);
$content=str_replace("{search_caption}", "Вы искали \"".$_GET["query"]."\"", $content);
$content=str_replace("{search_desc}", $search->show_search_result($_GET["query"]), $content);
?>