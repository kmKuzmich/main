<?php
include RD.'/lib/kours_class.php';
$ks= new kours;$access=new access;session_start();$slave=new slave;
$kours_htm=RD."/tpl/kours.htm";if (file_exists("$kours_htm")){ $kours_window = file_get_contents($kours_htm);}
$content=str_replace("{work_window}", $kours_window, $content);
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="1"){
	if ($w=="new_kours"){
		if ($conf==""){ $content=str_replace("{info}", $ks->show_kours_form(), $content); }
		if ($conf=="true"){ $content=str_replace("{info}", $ks->add_kours_form(), $content); }
	}
	if ($w==""){ 
		$content=str_replace("{kours_search_form}", $ks->show_kours_search_form(), $content); 
		$content=str_replace("{info}", $ks->show_kours_list(0), $content); 
	}
}
if ($access->check_user_access($_SESSION["user"],$slave->get_cur_id())=="0" and $wn!=""){
	$content=str_replace("{info}", $access->show_access_deny($slave->get_cur_id()), $content);
}
$content=str_replace("{kours_search_form}", "", $content); 
?>