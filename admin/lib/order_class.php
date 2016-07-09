<?php
class order {
	function get_payment(){ if ($_POST["payment"]==""){return $_GET["payment"];} if ($_POST["payment"]!=""){return $_POST["payment"];} }
	function get_asc(){ if ($_POST["asc"]==""){return $_GET["asc"];} if ($_POST["asc"]!=""){return $_POST["asc"];} }
	function get_sort(){ if ($_POST["sort"]==""){return $_GET["sort"];} if ($_POST["sort"]!=""){return $_POST["sort"];} }
	function get_status(){ if ($_POST["status"]==""){return $_GET["status"];} if ($_POST["status"]!=""){return $_POST["status"];} }
	function get_name(){ if ($_POST["name"]==""){return $_GET["name"];} if ($_POST["name"]!=""){return $_POST["name"];} }
	function get_data(){ if ($_POST["data"]==""){return $_GET["data"];} if ($_POST["data"]!=""){return $_POST["data"];} }
	function get_ord_id(){ if ($_POST["ord_id"]==""){return $_GET["ord_id"];} if ($_POST["ord_id"]!=""){return $_POST["ord_id"];} }
	function show_order_search_form(){session_start();$db=new db;$slave=new slave;$w=$slave->get_w();$mdl=new module;
		$form_htm=RD."/tpl/order_search_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$file=$slave->get_file();
		$pst=$_POST["pst"];
		if ($pst=="search"){
			$ord_id=$slave->qqback($_POST["ord_id"]);$_SESSION["ord_id"]=$ord_id;
			$data=$slave->qqback($_POST["data"]);$_SESSION["data"]=$data;
			$name=$slave->qqback($_POST["name"]);$_SESSION["name"]=$name;
			$payment=$slave->qqback($_POST["payment"]);$_SESSION["payment"]=$payment;
			$status=$this->get_status();$_SESSION["status"]=$status;
			$asc=$this->get_asc();	if ($asc==""){$asc="$desc";} $_SESSION["asc"]=$asc;
			$sort=$this->get_sort();if ($sort==""){$sort="id";}$_SESSION["sort"]=$sort;
			$_SESSION["ses_file"]=$file;
		}
		if ($pst==""){ $ses_file=$_SESSION["ses_file"];
			if ($ses_file==$file){
				$ord_id=$_SESSION["ord_id"];
				$data=$_SESSION["data"];
				$name=$_SESSION["name"];
				$payment=$_SESSION["payment"];
				$asc=$_SESSION["asc"];	if ($asc==""){$asc="$desc";}
				$sort=$_SESSION["sort"];	if ($sort==""){$sort="id";}
				$status=$_SESSION["status"];
			}
			if ($ses_file!=$file){
				$_SESSION["ord_id"]="";
				$_SESSION["data"]="";
				$_SESSION["name"]="";
				$_SESSION["payment"]="";
				$_SESSION["asc"]="";
				$_SESSION["sort"]="";
				$_SESSION["status"]="";
			}
		}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form = str_replace("{w}", $w, $form);
		$form = str_replace("{ord_id}", $ord_id, $form);
		$form = str_replace("{data}", $data, $form);
		$form = str_replace("{name}", $name, $form);
		$form = str_replace("{payment_form}", $this->get_payment_form($payment), $form);
		$form = str_replace("{status_form}", $this->get_status_form($status), $form);
		$form = str_replace("{sort_form}", $this->get_orders_sort_form($sort), $form);
		$form = str_replace("{asc_form}", $this->get_asc_form($asc), $form);
		$form = str_replace("{calendar}", $slave->get_calendar("data"), $form);
		return $form;
	}

	function show_order_navigation($page, $where)
	{
		$db = new db;
		$slave = new slave;
		if ($page == "") {
			$page = 0;
		}
		if ($page != "") {
			if ($page < 0) {
				$page = 0;
			}
		}
		$kp = 50;
		$r = $db->query("select count(o.id) as kol from orders o inner join clients cl on (cl.id=o.client) 
						inner join status st on (st.id=o.status) 
						inner join payment pm on (pm.id=o.payment) $where;");
		$n = $db->result($r, 0, "kol");
		$k = ($page) * $kp;
		if (($page) * $kp < $n and $kp <= $n) {
			if (($page + 1) * $kp <= $n) {
				$np = $page + 1;
			}
			$next_page = "<a href='javascript:load_order_list(\"$np\")'><img src='../theme/images/next.jpg' border=0></a>";
		}
		if (($page) * $kp > 0) {
			if (($page - 1) * $kp >= 0) {
				$pp = $page - 1;
			}
			$prev_page = "<a href='javascript:load_order_list(\"$pp\")'><img src='../theme/images/prev.jpg' border=0></a>";
		}
		$cur_from = $page * $kp;
		$cur_to = ($page + 1) * $kp;
		if ($cur_to > $n) {
			$cur_to = $n;
		}
		$cur_records = "Отображено записи: $cur_from - $cur_to";
		$navigation = "<table><tr><td>$prev_page</td><td> $cur_records </td><td>$next_page</td></tr></table>";
		return $navigation;
	}

	function show_order_list($client, $page)
	{
		session_start();
		$db = new db;
		$slave = new slave;
		$dep = $slave->get_dep();
		list($dep_up, $dep_cur) = $slave->get_file_deps("order");
		include_once 'lib/client_class.php';
		$cl = new client;
		$form_htm = RD . "/tpl/order_list.htm";
		if (file_exists("$form_htm")) {
			$form = file_get_contents($form_htm);
		}
		$status = $this->get_status();
		if ($status == "") {
			$status = $_SESSION["status"];
		}
		$name = $this->get_name();
		if ($name == "") {
			$name = $_SESSION["name"];
		}
		$ord_id = $this->get_ord_id();
		if ($ord_id == "") {
			$ord_id = $_SESSION["ord_id"];
		}
		$payment = $this->get_payment();
		if ($payment == "") {
			$payment = $_SESSION["payment"];
		}
		$data = $this->get_data();
		if ($data == "") {
			$data = $_SESSION["data"];
		}
		$where = "";
		//sort field
		$asc = $this->get_asc();
		if ($asc == "") {
			$asc = $_SESSION["asc"];
		}
		if ($asc == "") {
			$asc = "$desc";
		}
		$sort = $this->get_sort();
		if ($sort == "") {
			$sort = $_SESSION["sort"];
		}
		if ($sort == "") {
			$sort = "id";
		}
		//-----------
		if ($ord_id != "") {
			$where .= " o.id = '$ord_id'";
		}
		if ($name != "" and $where != "") {
			$where .= " and cl.name LIKE '%$name%' ";
		}
		if ($name != "" and $where == "") {
			$where .= " cl.name LIKE '%$name%' ";
		}
		if ($data != "" and $where != "") {
			$where .= " and o.data>='$data_from' and o.data<='$data_to'";
		}
		if ($data != "" and $where == "") {
			$where .= " o.data>='$data_from' and o.data<='$data_to'";
		}
		if ($status != "0" and $where != "") {
			$where .= " and o.status='$status'";
		}
		if ($status != "0" and $where == "") {
			$where .= " o.status = '$status'";
		}
		if ($payment != "0" and $where != "") {
			$where .= " and o.payment='$payment'";
		}
		if ($payment != "0" and $where == "") {
			$where .= " o.payment = '$payment'";
		}
		if ($where != "") {
			$where = " where " . $where;
		}
		if ($client != "") {
			$where = "where client='$client' ";
		}
		$kp = 50;
		if ($page == "") {
			$limit = " limit 0,$kp";
		}
		if ($page != "") {
			if ($page < 0) {
				$page = 0;
			}
			$from = $page * $kp;
			$limit = " limit $from,$kp";
		}
		$r = $db->query("select o.id, o.data, o.time, o.address, o.remip, cl.name, o.payment, st.caption as status_cap, st.color as color from orders o 
					  	inner join clients cl on (cl.id=o.client) 
						inner join status st on (st.id=o.status) 
						$where order by o.$sort $asc $limit;");
		$n = $db->num_rows($r);
		$list = "";
		$k = 0;
		for ($i = 1; $i <= $n; $i++) {
			$k++;
			$id = $db->result($r, $i - 1, "id");
			$client = $db->result($r, $i - 1, "name");
			$address = $db->result($r, $i - 1, "address");
			$data = $slave->data_word($db->result($r, $i - 1, "data"));
			$time = $db->result($r, $i - 1, "time");
			$remip = $db->result($r, $i - 1, "remip");
			$payment = $this->get_payment_caption($db->result($r, $i - 1, "payment"));
			$status = $db->result($r, $i - 1, "status_cap");
			$color = $db->result($r, $i - 1, "color");
			if ($k == 1) {
				$tr_color = "ffffff";
			}
			if ($k == 2) {
				$tr_color = "f5f5f5";
				$k = 0;
			}
			$list .= "
				<tr bgcolor='#$tr_color'>
					<th width=15>$id</th>
					<td width=300>&nbsp; <a href='javascript:show_order(\"$id\");'>$client</a></td>
					<th>$data, $time</th>
					<td>&nbsp;$address</td>
					<td>&nbsp;$payment</td>
					<td align='center'>$remip</td>
					<td bgcolor='#$color'>&nbsp;$status</td>
				</tr>";
		}
		$form = str_replace("{order_list}", $list, $form);
		$form = str_replace("{navigation}", $this->show_order_navigation($page, $where), $form);
		return $form;
	}
	function get_order_header($order_id){include_once RD.'/lib/client_class.php';$db=new db;$slave=new slave;$cl=new client;
		$r=$db->query("select * from orders where id='$order_id' order by id desc limit 0,1;");$n=$db->num_rows($r);
		if($n==1){
			$address=$db->result($r,0,"address");
			$client=$db->result($r,0,"client");
			$more=$db->result($r,0,"more");
			$data=$db->result($r,0,"data");
			$time=$db->result($r,0,"time");
			$cash=$db->result($r,0,"cash");
			$remip=$db->result($r,0,"remip");
			$payment=$db->result($r,0,"payment");
			$status=$db->result($r,0,"status");
			list($name,$email,$phone,$address)=$cl->get_order_form_data($client);
		}
		return array($name,$email,$phone,$address,$more,$data,$time,$remip,$cash,$payment,$status);
	}
	function show_order($order_id){$db=new db;$slave=new slave;$dep=$slave->get_dep();
		$order_show_htm=RD."/tpl/order_desc.htm";if (file_exists("$order_show_htm")){ $order_show = file_get_contents($order_show_htm);}
		$r=$db->query("select * from orders_str where `order`='$order_id' order by id asc;");$n=$db->num_rows($r);$list="";
		for ($i=1;$i<=$n;$i++){
			$code=$db->result($r,$i-1,"code");
			$caption=$db->result($r,$i-1,"caption");
			$count=$db->result($r,$i-1,"count");
			$price=$db->result($r,$i-1,"price");
			$sum=$count*$price;$summ+=$sum;
			$list.="
				<tr align='center'>
					<td>$i</td>
					<td>$code</td>
					<td align='left'>&nbsp;&nbsp;$caption</td>
					<td>$count</td>
					<td align='right'>$price</td>
					<td align='right'>$sum</td>
				</tr>";
		}
		$order_show=str_replace("{busket}",$list,$order_show);
		$order_show=str_replace("{summ}", $summ, $order_show);
		list($name,$email,$phone,$mob,$address,$more,$data,$time,$remip,$cash,$payment,$status)=$this->get_order_header($order_id);
		$order_show=str_replace("{client_name}", $name, $order_show);
		$order_show=str_replace("{email}", $email, $order_show);
		$order_show=str_replace("{phone}", $phone, $order_show);
		$order_show=str_replace("{mob}", $mob, $order_show);
		$order_show=str_replace("{order_id}", $order_id, $order_show);
		$order_show=str_replace("{payment}", $this->get_payment_caption($payment), $order_show);
		$order_show=str_replace("{status}", $this->get_status_caption($status), $order_show);
		$order_show=str_replace("{cash}", $this->get_cash_caption($cash), $order_show);
		$order_show=str_replace("{csh}", $this->get_csh_caption($cash), $order_show);
		$order_show=str_replace("{more}", $more, $order_show);
		$order_show=str_replace("{data_time}", $slave->data_word(date("Y-m-d"))." ".time("h:m:s"), $order_show);
		$order_show=str_replace("{remip}", $remip, $order_show);
		$order_show=str_replace("{address_sent}", $address, $order_show);
		return $order_show;
	}
	function delete_order($order_id){$db=new db;
		if ($order_id!=""){
			$db->query("delete from orders where id='$order_id';");
			$db->query("delete from orders_str where `order`='$order_id';");
			$mes="Заказ успешно удален";
		}
		if ($order_id==""){	$mes="Ошибка удаления"; }
		return $mes;
	}
	function show_order_status($order_id){$db=new db;
		$form_htm=RD."/tpl/order_status_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select `status` from orders where id='$order_id';");$n=$db->num_rows($r);
		if ($n==1){ $status=$db->result($r,0,"status");}
		$form = str_replace("{order_status_id}", $order_id, $form);
		$form = str_replace("{status_form}", $this->get_status_form($status), $form);
		return $form;
	}
	function save_order_status($order_id,$status){$db=new db;
		if ($order_id!="" and $status!=""){ $db->query("update orders set status='$status' where id='$order_id';");	$mes="Статус успешно изменен"; }
		if ($order_id=="" or $status==""){ $mes="Ошибка изменения статуса"; }
		return $mes;
	}
	function show_kurier_form($order_id){$db=new db;
		$form_htm=RD."/tpl/order_kurier_form.htm";$form=""; if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from orders_kurier where order_id='$order_id' limit 0,1;"); $n=$db->num_rows($r);
		if ($n==1){
			$id=$db->result($r,0,"id");
			$kurier=$db->result($r,0,"kurier");
			$ttn=$db->result($r,0,"ttn");
			$price=$db->result($r,0,"price");
			$message=$db->result($r,0,"message");
		}if ($message==""){$message="Заказ отправлен.\n";}
		$form = str_replace("{order_id}", $order_id, $form);
		$form = str_replace("{kurier_id}", $id, $form);
		$form = str_replace("{kurier_kurier}", $kurier, $form);
		$form = str_replace("{kurier_ttn}", $ttn, $form);
		$form = str_replace("{kurier_price}", $price, $form);
		$form = str_replace("{kurier_message}", $message, $form);
		return $form;
	}
	
	function save_order_kurier($order_id,$id,$kurier,$ttn,$price,$message){$db=new db;
		if ($order_id!=""){ 
			if ($id!=""){ $db->query("update orders_kurier set kurier='$kurier',ttn='$ttn',price='$price',message='$message' where id='$id';");	$mes="Курьерская информация успешно изменена"; }
			if ($id==""){ $db->query("insert into orders_kurier (`order_id`,`kurier`,`ttn`,`price`,`message`) values ('$order_id','$kurier','$ttn','$price','$message');");	$mes="Курьерская информация успешно добавлена"; }
		}
		if ($order_id==""){ $mes="Ошибка изменения статуса"; }
		return $mes;
	}
	function send_order_kurier_sms($order_id,$message){$db=new db;
		if ($order_id!=""){ 
			list($s,$s,$phone,$s,$s,$s,$s,$s,$s,$s,$s,$s)=$this->get_order_header($order_id);
			include_once RD.'/../lib/sms_class.php';$sms=new sms;
			$answer=$sms->send_sms("Radiotochka",$phone,$message);
			$mes="Сообщение отправлено. Ответ:".$answer;
		}
		if ($order_id==""){ $mes="Ошибка изменения статуса"; }
		return $mes;
	}
	//------------------------------------------------------------
	function get_status_form($status){$db=new db;$slave=new slave;$dep=$slave->get_dep(); $w=$slave->get_w();
		$r=$db->query("select * from status order by id asc");$n=$db->num_rows($r);
		$frm="<select name='status' id='status' size=1 style='width:200px;'><option value='0'>----</option>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			if ($id==$status){ $frm.="<option value='$id' selected>$caption</option>";}
			if ($id!=$status){ $frm.="<option value='$id'>$caption</option>";}
		}
		$frm.="</select>";
		return $frm;
	}	
	function get_payment_form($payment){$db=new db;$slave=new slave;$dep=$slave->get_dep(); $w=$slave->get_w();
		if ($payment==""){ $payment=$this->get_payment(); }
		$r=$db->query("select * from payment order by id asc");$n=$db->num_rows($r);
		$frm="<select name='payment' size=1 style='width:200px;'><option value='0'> ------  </option>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			if ($id==$payment){ $frm.="<option value='$id' selected>$caption</option>";}
			if ($id!=$payment){ $frm.="<option value='$id'>$caption</option>";}
		}
		$frm.="</select>";
		return $frm;
	}	
	function get_orders_sort_form($sort){$db=new db;$slave=new slave;if ($sort==""){ $sort=$this->get_sort(); }
		$r=$db->query("select * from sort_fields where p='1' order by id asc");$n=$db->num_rows($r);
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
	function get_asc_form($asc){$db=new db;$slave=new slave;
		if ($asc==""){ $asc=$this->get_asc(); }
		if ($asc==""){ $asc="desc"; }
		$frm="<select name='asc' size=1 style='width:100px;'>";
		if ($asc=="asc"){ $frm.="<option value='asc' selected>Возрастанию</option><option value='desc'>Спаданию</option>";}
		if ($asc=="desc"){ $frm.="<option value='asc'>Возрастанию</option><option value='desc' selected>Спаданию</option>";}
		$frm.="</select>";
		return $frm;
	}
	function get_status_caption($status){$db=new db;
		$r=$db->query("select caption from status where id='$status';");$n=$db->num_rows($r);
		if ($n==1){	return $db->result($r,0,"caption");}
		if ($n==0){	return "";}
	}	
	function get_payment_caption($payment){$db=new db;
		$r=$db->query("select caption from payment where id='$payment';");$n=$db->num_rows($r);
		if ($n==1){	return $db->result($r,0,"caption");}
		if ($n==0){	return "";}
	}	
	function get_cash_caption($cash){$db=new db;
		$r=$db->query("select caption from cash where id='$cash';");$n=$db->num_rows($r);
		if ($n==1){	return $db->result($r,0,"caption");}
		if ($n==0){	return "";}
	}
	function get_csh_caption($cash){$db=new db;
		$r=$db->query("select abr from cash where id='$cash';");$n=$db->num_rows($r);
		if ($n==1){	return $db->result($r,0,"abr");}
		if ($n==0){	return "";}
	}
}
?>