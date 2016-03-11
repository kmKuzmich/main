<?php
class client {
	function get_asc(){ if ($_POST["asc"]==""){return $_GET["asc"];} if ($_POST["asc"]!=""){return $_POST["asc"];} }
	function get_sort(){ if ($_POST["sort"]==""){return $_GET["sort"];} if ($_POST["sort"]!=""){return $_POST["sort"];} }
	function get_discount(){ if ($_POST["discount"]==""){return $_GET["discount"];} if ($_POST["discount"]!=""){return $_POST["discount"];} }
	function get_name(){ if ($_POST["name"]==""){return $_GET["name"];} if ($_POST["name"]!=""){return $_POST["name"];} }
	function get_email(){ if ($_POST["email"]==""){return $_GET["email"];} if ($_POST["email"]!=""){return $_POST["email"];} }
	function get_discount_caption($discount){$db=new db;
		$r=$db->query("select caption from discount where id='$discount';");$n=$db->num_rows($r);
		$discount="";if ($n==1) {$discount=$db->result($r,0,"caption");	}
		return $discount;
	}
	function show_client_search_form(){session_start();	$db=new db;$slave=new slave;$w=$slave->get_w();$mdl=new module;
		$form_htm=RD."/tpl/client_search_form.htm";
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$file=$slave->get_file();
		$pst=$_POST["pst"];
		if ($pst=="search"){
			$email=$slave->qqback($_POST["email"]);$_SESSION["email"]=$email;
			$name=$slave->qqback($_POST["name"]);$_SESSION["name"]=$name;
			$discount=$_POST["discount"];$_SESSION["discount"]=$discount;
			$asc=$this->get_asc();	if ($asc==""){$asc="$desc";} $_SESSION["asc"]=$asc;
			$sort=$this->get_sort();if ($sort==""){$sort="id";}$_SESSION["sort"]=$sort;
			$_SESSION["ses_file"]=$file;
		}
		if ($pst==""){ $ses_file=$_SESSION["ses_file"];
			if ($ses_file==$file){
				$email=$_SESSION["email"];
				$name=$_SESSION["name"];
				$discount=$_SESSION["discount"];
				$asc=$_SESSION["asc"];	if ($asc==""){$asc="$desc";}
				$sort=$_SESSION["sort"];	if ($sort==""){$sort="id";}
			}
			if ($ses_file!=$file){
				$_SESSION["email"]="";
				$_SESSION["name"]="";
				$_SESSION["discount"]="";
				$_SESSION["asc"]="";
				$_SESSION["sort"]="";
			}
		}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form = str_replace("{email}", $email, $form);
		$form = str_replace("{name}", $name, $form);
		$form = str_replace("{discount_form}", $this->get_discount_form($discount), $form);
		$form = str_replace("{sort_form}", $this->get_orders_sort_form($sort), $form);
		$form = str_replace("{asc_form}", $this->get_asc_form($asc), $form);
		return $form;
	}
	function show_client_navigation($page,$where){$db=new db;$slave=new slave;
		if ($page==""){$page=0;}
		if ($page!=""){if ($page<0){$page=0;}}
		$kp=50;
		$r=$db->query("select count(id) as kol from clients where ison='1' $where;");$n=$db->result($r,0,"kol");
		$k=($page)*$kp;
		if (($page)*$kp < $n and $kp<=$n){
			if (($page+1)*$kp<=$n){$np=$page+1;}
			$next_page="<a href='javascript:load_client_list(\"$np\")'><img src='../theme/images/next.jpg' border=0></a>";
		}
		if (($page)*$kp > 0) {
			if (($page-1)*$kp>=0){$pp=$page-1;}
			$prev_page="<a href='javascript:load_client_list(\"$pp\")'><img src='../theme/images/prev.jpg' border=0></a>";
		}
		$cur_from=$page*$kp;$cur_to=($page+1)*$kp;if ($cur_to>$n){$cur_to=$n;}
		$cur_records="Отображено записи: $cur_from - $cur_to";
		$navigation="<table><tr><td>$prev_page</td><td> $cur_records </td><td>$next_page</td></tr></table>";
		return $navigation;	
	}
	function show_client_list($page){$db=new db;$slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$form_htm=RD."/tpl/client_list.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$name=$this->get_name();if ($name==""){$name=$_SESSION["name"];}
		$discount=$this->get_discount();if ($discount==""){$discount=$_SESSION["discount"];}
		$email=$this->get_email();if ($email==""){$email=$_SESSION["email"];}
		$where="";
		//sort field
		$asc=$this->get_asc();	if ($asc==""){$asc=$_SESSION["asc"];}if ($asc==""){$asc="$desc";}
		$sort=$this->get_sort(); if ($sort==""){$sort=$_SESSION["sort"];} if ($sort==""){$sort="id";}
		//-----------
		if ($name!=""){$where.=" and `name` LIKE '%$name%' ";}
		if ($email!=""){$where.=" and `email` LIKE '%$email%' ";}
		if ($discount!="" and $discount!="0"){$where.=" and `discount` = '$discount'";}
		$kp=50;
		if ($page==""){$limit=" limit 0,$kp";}
		if ($page!=""){ if ($page<0){$page=0;} $from=$page*$kp; $limit=" limit $from,$kp";}
		$r=$db->query("SELECT * FROM clients where ison='1' $where order by $sort $asc $limit;");$n=$db->num_rows($r);$list="";$k=0;
		for ($i=1;$i<=$n;$i++){$k++;
			$id=$db->result($r,$i-1,"id");
			$name=$db->result($r,$i-1,"name");
			$city=$db->result($r,$i-1,"city");
			$address=$db->result($r,$i-1,"address");
			$email=$db->result($r,$i-1,"email");
			$discount=$this->get_discount_caption($db->result($r,$i-1,"discount"));
			if ($k==1){$tr_color="ffffff";}if ($k==2){$tr_color="f5f5f5";$k=0;}
			$list.="
				<tr bgcolor='#$tr_color'>
					<th><a href='?$url&w=edit_client&client_id=$id'><img border=0 src='images/edit.png'></a></th>
					<th><a href='#' onclick='if (confirm(\"Удалить клиента?\")){ location.href=\"?$url&w=del_client&conf=true&client_id=$id\"; }'><img border=0 src='images/drop.png'></a></th>
					<th>$i</th>
					<td> &nbsp; <a href='javascript:show_client(\"$id\");'>$name</a></td>
					<td>&nbsp;$email</td>
					<td>&nbsp;$city&nbsp;$address</td>
					<td align='center'>$discount</td>
				</tr>";
		}
		$form=str_replace("{clients_list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_client_navigation($page,$where),$form);
		return $form;
	}
	function show_client($client){$db=new db;$slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$reg_htm=RD."/tpl/client_show.htm";if (file_exists("$reg_htm")){ $reg_form = file_get_contents($reg_htm);}
		$r=$db->query("select * from clients where id='$client' limit 0,1;");$n=$db->num_rows($r);
		if ($n==1){
			$pass=$db->result($r,0,"pass");
			$email=$db->result($r,0,"email");
			$name=$db->result($r,0,"name");
			$city=$db->result($r,0,"city");
			$address=$db->result($r,0,"address");
			$phone=$db->result($r,0,"phone");
			$discount=$this->get_discount_caption($db->result($r,0,"discount"));
		}
		$reg_form=str_replace("{pass}",$pass,$reg_form);
		$reg_form=str_replace("{name}",$name,$reg_form);
		$reg_form=str_replace("{city}",$city,$reg_form);
		$reg_form=str_replace("{address}",$address,$reg_form);
		$reg_form=str_replace("{phone}",$phone,$reg_form);
		$reg_form=str_replace("{email}",$email,$reg_form);
		$reg_form=str_replace("{client}",$client,$reg_form);
		$reg_form=str_replace("{discount}",$discount,$reg_form);
		$reg_form=str_replace("{url}",$url,$reg_form);
		return $reg_form;
	}
	function edit_client($client_id){$db=new db;$slave=new slave;$w=$slave->get_w();
		$form_htm=RD."/tpl/client_form.htm";if (file_exists("$form_htm")){$form = file_get_contents($form_htm);}
		$r=$db->query("select * from clients where id='$client_id' limit 0,1;");$n=$db->num_rows($r);
		if ($n>0){
			$pass=$db->result($r,0,"pass");
			$email=$db->result($r,0,"email");
			$name=$db->result($r,0,"name");
			$city=$db->result($r,0,"city");
			$address=$db->result($r,0,"address");
			$phone=$db->result($r,0,"phone");
		}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form = str_replace("{client_id}", $client_id, $form);
		$form = str_replace("{pass}", $pass, $form);
		$form = str_replace("{name}", $name, $form);
		$form = str_replace("{email}", $email, $form);
		$form = str_replace("{city}", $city, $form);
		$form = str_replace("{address}", $address, $form);
		$form = str_replace("{phone}", $phone, $form);
		return $form;
    }
	function update_client(){$db=new db;$slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$client_id=$_POST["client_id"];$name=$slave->qq($_POST["name"]);$email=$slave->qq($_POST["email"]);$address=$slave->qq($_POST["address"]);$city=$slave->qq($_POST["city"]);$phone=$slave->qq($_POST["phone"]);$pass=$slave->qq($_POST["pass"]);
		$db->query("update clients set pass='$pass', name='$name', email='$email', address='$address', city='$city', phone='$phone' where id='$client_id';");
		$db->close();
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Информация о клиенте &quot;$name ($login)&quot; успешно сохранена";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","Назад в журнал покупетелей",$form);
		$form=str_replace("{back_url}","?$url",$form);
		$form=str_replace("{navigation}","",$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
    }
	function del_client($client_id){$db=new db;$mdl=new module;$url=$mdl->get_file_url();
		$db->query("update clients set ison='0' where id='$client_id';");$db->close();
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Клиент успешно удален";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","Назад в журнал покупателей",$form);
		$form=str_replace("{back_url}","?$url",$form);
		$form=str_replace("{navigation}","",$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
    }
	function show_client_discount($client_id){$db=new db;
		$form_htm=RD."/tpl/client_discount_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select discount from clients where id='$client_id';");
		$n=$db->num_rows($r);
		if ($n==1){ $discount=$db->result($r,0,"discount");}
		$form = str_replace("{client_discount_id}", $client_id, $form);
		$form = str_replace("{discount_form}", $this->get_discount_form($discount), $form);
		return $form;
	}
	function save_client_discount($client_id,$discount){$db=new db;
		if ($client_id!="" and $discount!=""){ $db->query("update clients set discount='$discount' where id='$client_id';");	$mes="Скидка успешно применена"; }
		if ($client_id=="" or $discount==""){ $mes="Ошибка изменения скидки"; }
		return $mes;
	}
	//---------------------
	function get_client_name($client){$db=new db;
		$r=$db->query("select name from clients where id='$client' limit 0,1;");$n=$db->num_rows($r);
		if ($n==1) {return $db->result($r,0,"name");}
		if ($n==0) {return "";}
	}
	function get_client_email($client){$db=new db;
		$r=$db->query("select email from clients where id='$client' limit 0,1;");$n=$db->num_rows($r);
		if ($n==1) {return $db->result($r,0,"email");}
		if ($n==0) {return "";}
	}
	function get_order_form_data($client){$db=new db;
		$r=$db->query("select name,email,phone,address from clients where id='$client' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n==1) {
			$name=$db->result($r,0,"name");
			$email=$db->result($r,0,"email");
			$phone=$db->result($r,0,"phone");
			$address=$db->result($r,0,"address");
			return array($name,$email,$phone,$address);
		}
		if ($n==0) {return array("","","","");}
	}
	function get_discount_form($discount){$db=new db;$slave=new slave;
		$dep=$slave->get_dep(); $w=$slave->get_w();
		if ($discount==""){ $discount=$this->get_discount(); }
		$r=$db->query("select * from discount order by id asc");$n=$db->num_rows($r);
		$frm="<select name='discount' size=1 style='width:100px;'><option value='0'> ------  </option>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			if ($id==$discount){ $frm.="<option value='$id' selected>$caption</option>";}
			if ($id!=$discount){ $frm.="<option value='$id'>$caption</option>";}
		}
		$frm.="</select>";
		return $frm;
	}	
	function get_orders_sort_form($sort){$db=new db;if ($sort==""){ $sort=$this->get_sort(); }
		$r=$db->query("select * from sort_fields where p='2' order by id asc");$n=$db->num_rows($r);
		$frm="<select name='sort' size=1 style='width:150px;'>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"field");
			$caption=$db->result($r,$i-1,"caption");
			if ($id==$sort){ $frm.="<option value='$id' selected>$caption</option>";}
			if ($id!=$sort){ $frm.="<option value='$id'>$caption</option>";}
		}
		$frm.="</select>";
		return $frm;
	}
	function get_asc_form($asc){$db=new db;
		if ($asc==""){ $asc=$this->get_asc(); }
		if ($asc==""){ $asc="desc"; }
		$frm="<select name='asc' size=1 style='width:100px;'>";
		if ($asc=="asc"){ $frm.="<option value='asc' selected>Возрастанию</option><option value='desc'>Спаданию</option>";}
		if ($asc=="desc"){ $frm.="<option value='asc'>Возрастанию</option><option value='desc' selected>Спаданию</option>";}
		$frm.="</select>";
		return $frm;
	}	
	function show_client_window($page){$db=new db;$slave=new slave;$dep=$slave->get_dep();
		$client_window_htm=RD."/tpl/client_window.htm";if (file_exists("$client_window_htm")){$client_window = file_get_contents($client_window_htm);}
		$kp=25;
		if ($page==""){$limit=" limit 0,$kp";}
		if ($page!=""){ if ($page<0){$page=0;} $from=$page*$kp; $limit=" limit $from,$kp";}
		$list_client="
		<table width='100%' border=0>
			<tr bgcolor='#ebebeb' height='40'>
				<th width='1%'>№</th>
				<th>Имя</th>
				<th width='10%'>E-Mail</th>
				<th width='10%'>Адресс</th>
				<th width='10%'>Телефон</th>
			</tr>";
		$r=$db->query("select * from clients  where ison='1' order by name asc $limit;");
		$n=$db->num_rows($r);
		if ($n==0){$list_client.="<tr><td colspan=10 align='center'>Клиенты отсутствуют</td></tr>";}
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$name=$db->result($r,$i-1,"name");
				$email=$db->result($r,$i-1,"email");
				$address=$db->result($r,$i-1,"city")." ".$db->result($r,$i-1,"address");
				$phone=$db->result($r,$i-1,"phone");
				$ison=$db->result($r,$i-1,"ison");
				$list_client.="
				<tr align='center' height='20px;'>
					<th>$id</th>
					<td align='left'>&nbsp;&nbsp;<a href='javascript:select_client(\"$id\",\"$name\");'>$name</a></td>
					<td>$email</td>
					<td>$address</td>
					<td>$phone</td>
				</tr>";
			}
		}
		$list_client.="</table>";
		$client_window = str_replace("{list_of_client}", $list_client, $client_window);
		$client_window = str_replace("{navigation}", $this->show_client_navigation($page,""), $client_window);
		return $client_window;
    }
	function load_client_search($asearch){$db=new db;$slave=new slave;$where="";
		if ($asearch!=""){$where=" and name LIKE '%$asearch%'";}
		$r=$db->query("select * from clients  where ison='1' $where order by name asc limit 0,25;");$n=$db->num_rows($r);
		$list_client="
		<table width='100%' border=0>
			<tr bgcolor='#ebebeb' height='40'>
				<th width='1%'>№</th>
				<th>Имя</th>
				<th width='10%'>E-Mail</th>
				<th width='10%'>Адресс</th>
				<th width='10%'>Телефон</th>
			</tr>";
		if ($n==0){$list_client.="<tr><td colspan=10 align='center'>Клієнти відсутні</td></tr>";}
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$name=$db->result($r,$i-1,"name");
				$email=$db->result($r,$i-1,"email");
				$address=$db->result($r,$i-1,"city")." ".$db->result($r,$i-1,"address");
				$phone=$db->result($r,$i-1,"phone");
				$ison=$db->result($r,$i-1,"ison");
				$list_client.="
				<tr align='center' height='20px;'>
					<th>$id</th>
					<td align='left'>&nbsp;&nbsp;<a href='javascript:select_client(\"$id\",\"$name\");'>$name</a></td>
					<td>$email</td>
					<td>$address</td>
					<td>$phone</td>
				</tr>";
			}
		}
		return $list_client."</table>";
    }
}
?>