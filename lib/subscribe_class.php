<?php

class subscribe {
	function show_subscribe_form(){
		$subscribe_form_htm=RD."/tpl/subscribe_form.htm";
		if (!file_exists("$subscribe_form_htm")){ $subscribe_form="�� �������� ���� �������"; }
		if (file_exists("$subscribe_form_htm")){ $subscribe_form = file_get_contents($subscribe_form_htm);}
		return $subscribe_form;
	}

	function save_subscribe($from){
		$slave=new slave;$from=$slave->qq($from);
		$x = ereg("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$",$from);
		if($x==0){ $subscribe="�� �� �������� ����� ��� e-mail"; }
		else {
			if ($from=="" or $from=="������� ��� Email"){$subscribe="�� �� ��������� ���� Email"; }
			if ($from!="" and $from!="������� ��� Email"){ 
				$db=new db;
				$r=$db->query("select id from subscribe_list where email='$from';");
				$n=$db->num_rows($r);
				if ($n!=0){	$subscribe="�������� ���� Email ��� �������� �� ��c����� ��������"; }
				if ($n==0){
					$db->query("insert into subscribe_list value ('','$from');");
					$subscribe="�� ������� ����������� �� ��c����� ��������"; 
				}
			}
		}
		return $subscribe;
	}
}
?>
