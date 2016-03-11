<?php

include RD.'/inc/class/test_result_class.php';
$result= new result;

if ($w==""){
	$slave=new slave;
	$faculty=$slave->get_faculty(); $speshiality=$slave->get_spesh(); $group=$slave->get_group(); $discip=$slave->get_discip();
	$result_menu="
	<table class='menu_work'><tr>
	<td><a href='?dep=$dep&w=blank_1&faculty=$faculty&speshiality=$speshiality&group=$group&discip=$discip' title='Бланк \"Модулі\"'><img src='images/menu/test_green.png' border=0></a></td>
	<td><a href='?dep=$dep&w=blank_2&faculty=$faculty&speshiality=$speshiality&group=$group&discip=$discip' title='Бланк \"Модулі\", \"Підсумковий контроль\"'><img src='images/menu/test_yellow.png' border=0></a></td>
	<td><a href='?dep=$dep&w=blank_3&faculty=$faculty&speshiality=$speshiality&group=$group&discip=$discip' title='Бланк \"Підсумковий контроль\"'><img src='images/menu/test_red.png' border=0></a></td>
	</tr></table>";
	$result_info=$slave->test_result_search_form(); 
	$result_info.=$result->list_result();
	$content=str_replace("{work_window}", $result_info, $content);
	$content=str_replace("{result_menu}", $result_menu, $content);
}

if ($w=="blank_1"){
	$slave=new slave;
	$faculty=$slave->get_faculty(); $speshiality=$slave->get_spesh(); $group=$slave->get_group(); $discip=$slave->get_discip();
	$result_menu="
	<table class='menu_work'><tr>
	<td><a href='?dep=$dep&faculty=$faculty&speshiality=$speshiality&group=$group&discip=$discip' title='Назад'><img src='images/menu/back.png' border=0></a></td>
	<td><a href='#' onclick='openPrintWin();' title='Друк'><img src='images/menu/print.png' border=0></a></td>
	</tr></table>";
	$result_info.=$result->blank("1",$faculty,$speshiality,$group,$discip);
	$content=str_replace("{work_window}", $result_info, $content);
	$content=str_replace("{result_menu}", $result_menu, $content);
}
if ($w=="blank_2"){
	$slave=new slave;
	$faculty=$slave->get_faculty(); $speshiality=$slave->get_spesh(); $group=$slave->get_group(); $discip=$slave->get_discip();
	$result_menu="
	<table class='menu_work'><tr>
	<td><a href='?dep=$dep&faculty=$faculty&speshiality=$speshiality&group=$group&discip=$discip' title='Назад'><img src='images/menu/back.png' border=0></a></td>
	<td><a href='#' onclick='openPrintWin();' title='Друк'><img src='images/menu/print.png' border=0></a></td>	</tr></table>";
	$result_info.=$result->blank("2",$faculty,$speshiality,$group,$discip);
	$content=str_replace("{work_window}", $result_info, $content);
	$content=str_replace("{result_menu}", $result_menu, $content);
}
if ($w=="blank_3"){
	$slave=new slave;
	$faculty=$slave->get_faculty(); $speshiality=$slave->get_spesh(); $group=$slave->get_group(); $discip=$slave->get_discip();
	$result_menu="
	<table class='menu_work'><tr>
	<td><a href='?dep=$dep&faculty=$faculty&speshiality=$speshiality&group=$group&discip=$discip' title='Назад'><img src='images/menu/back.png' border=0></a></td>
	<td><a href='#' onclick='openPrintWin();' title='Друк'><img src='images/menu/print.png' border=0></a></td>	</tr></table>";
	$result_info.=$result->blank("3",$faculty,$speshiality,$group,$discip);
	$content=str_replace("{work_window}", $result_info, $content);
	$content=str_replace("{result_menu}", $result_menu, $content);
}
?> 