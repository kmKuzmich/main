<?php

class make_request {
	function show_make_request(){
		$db=new db; $slave=new slave;
		$request_form_htm=RD."/tpl/make_request_form.htm";
		if (!file_exists("$request_form_htm")){ $request_form="�� �������� ���� �������"; }
		if (file_exists("$request_form_htm")){ $request_form = file_get_contents($request_form_htm);}
		$request_form=str_replace("{dep}", $slave->get_dep(), $request_form);
		$request_form=str_replace("{w}", $slave->get_w(), $request_form);
		$request_form=str_replace("{dep_up}", $slave->get_dep_up(), $request_form);
		$request_form=str_replace("{dep_cur}", $slave->get_dep_cur(), $request_form);
		return $request_form;
	}
	
	function send_message(){
		$fio=$_POST["fio"]; $phone=$_POST["phone"]; $catalogue_nomber=$_POST["catalogue_nomber"]; $desc=$_POST["desc"];
		$country=$_POST["country"]; $city=$_POST["city"]; $from=$_POST["from"]; 
		$x = ereg("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$",$from);
		if($x==0){ $make_request="<table width='100%' height='50%' cellpadding='0' cellspacing='0'><tr valign='top'><td align='center'><p class='Text'><br><br><br>�� �� �������� ����� ��� e-mail<br><br><a href='javascript:history.back(-1)' class='Text'>�����</a></p</td></tr></table>"; }
		else {
		if ($from=="" or $fio=="" or $phone==""){$make_request="<table width='100%' height='50%' cellpadding='0' cellspacing='0'><tr valign='top'><td align='center'><p class='Text'><br><br><br>�� �� ��������� ������������ ����<br><br><a href='javascript:history.back(-1)' class='Text'>�����</a></p></td></tr></table>"; }
		if ($from!="" and $fio!="" and $phone!=""){
			$message="
			������ �� ��������\n\n
			���������� ����������:\n
			���: $fio\n
			�������: $phone\n
			������: $country\n
			�����: $city\n
			E-mail: $from\n
			
			���������� �����: $catalogue_nomber\n
			����� ����� � ������� ��������: \n
			$desc\n";
			
			include "lib/libmail.php";
			$m= new Mail;
			$m->From( "$from" );
			$m->To( "alex@a-technika.com" );
			$m->Subject( "������ �� ��������" );
			$m->Body( "$message" );
			$m->Priority(4) ;
			$m->Send();
			$make_request="<table width='100%' height='50%' cellpadding='0' cellspacing='0'><tr valign='top'><td align='center'>
			<p><br><br><br><h1>��� ������ �� �������� �������� ������!</h1><br><br>��� ���������� �� ������ ��������� �������� � ���� ��������� ��������.</p></td></tr></table>"; 
		}
		}
		return $make_request;
	}
}
?>
