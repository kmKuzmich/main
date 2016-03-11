<?php

class subscribe {
	function show_subscribe_form(){
		$subscribe_form_htm=RD."/tpl/subscribe_form.htm";
		if (!file_exists("$subscribe_form_htm")){ $subscribe_form="Не знайдено файл шаблону"; }
		if (file_exists("$subscribe_form_htm")){ $subscribe_form = file_get_contents($subscribe_form_htm);}
		return $subscribe_form;
	}

	function save_subscribe($from){
		$slave=new slave;$from=$slave->qq($from);
		$x = ereg("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$",$from);
		if($x==0){ $subscribe="Вы не коректно ввели Ваш e-mail"; }
		else {
			if ($from=="" or $from=="Укажите Ваш Email"){$subscribe="Вы не заполнили поле Email"; }
			if ($from!="" and $from!="Укажите Ваш Email"){ 
				$db=new db;
				$r=$db->query("select id from subscribe_list where email='$from';");
				$n=$db->num_rows($r);
				if ($n!=0){	$subscribe="Указаный Вами Email уже подписан на раcсылку новостей"; }
				if ($n==0){
					$db->query("insert into subscribe_list value ('','$from');");
					$subscribe="Вы успешно подписались на раcсылку новостей"; 
				}
			}
		}
		return $subscribe;
	}
}
?>
