<?php
class access {
	function check_user_access($user,$dep){
		$db=new db; $slave=new slave;
		if ($user!=2){
			$module=$slave->get_module();
			$file=$slave->get_module_page();if ($dep==""){$dep=0;}
			$r=$db->query("select count(id) as kol from users_structure where user='$user' and module='$module' and module_file='$file' and dep='$dep';");
			$kol=$db->result($r,0,"kol");
			if ($kol>0){ $access= "1";}
			if ($kol==0){ $access= "0";}
		}
		if ($user==2){$access="1";}
		return $access;
		
	}
	
	function show_access_deny($dep){
		$db=new db; $slave=new slave;
		$r=$db->query("select caption from deps where id='$dep';");
		$n=$db->num_rows($r);
		if ($n>0){ $caption=$db->result($r,0,"caption");}
		if ($n==0){ $caption="---";}
		
		$form_htm=RD."/tpl/access_deny.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		return str_replace("{caption}",$caption,$form);
		
	}
	
}
?>