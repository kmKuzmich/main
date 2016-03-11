<?php
class kours { 
	function set_cash($cash){$db=new db;session_start();
		if ($_SESSION["cash"]!=$cash and $cash!=""){$_SESSION["cash"]=$cash;}
		if ($_SESSION["cash"]=="" and $cash==""){$cash=2;$_SESSION["cash"]=$cash;} $curcash=$_SESSION["cash"];
		$r=$db->query("select * from kours where ison='1' order by id desc limit 0,1;");$n=$db->num_rows($r);
		if ($n==1){ $kours=$db->result($r,0,"kours_$curcash"); }
		$_SESSION["kours"]=$kours;
		$_SESSION["abr"]=$this->get_cash_abr($curcash);
		return;
	}
	function show_cash_form(){ $db=new db;	session_start(); $cash=$_SESSION["cash"]; if ($cash==""){ $cash="2"; } $slave=new slave; 
		$query=$_SERVER["QUERY_STRING"]; if (stristr($query,"&cash=")){ $query=ereg_replace("&cash=([0-9])*","",$query); }
		$r=$db->query("select * from cash where ison='1' order by id asc;");$n=$db->num_rows($r);
		$form="<select name='cash' size=1 style='width:90px; color:#f90000; background-color:#000000; border:0px' onchange='location.href=\"?$query&cash=\"+this[this.selectedIndex].value'>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			if ($id==$cash){ $form.="<option value='$id' selected>$caption</option>";}
			if ($id!=$cash){ $form.="<option value='$id'>$caption</option>";}
		}
		$form.="</select>";
		return $form;
	}
	function show_cash_price($price){$db=new db; session_start(); $cash=$_SESSION["cash"];$kours=$_SESSION["kours"];$abr=$_SESSION["abr"];if ($abr==""){$this->get_cash_abr($cash);}
		if ($price>0){ $price=round(($price*$kours),0);$price.=" <span class='cash'>$abr</span>"; }
		if ($price<=0){$price="<span class='t12_red'>-</span>";}
		return $price;
	}
	function show_cash_price_sm($price){$db=new db; session_start(); $cash=$_SESSION["cash"];$kours=$_SESSION["kours"];$abr=$_SESSION["abr"];if ($abr==""){$this->get_cash_abr($cash);}
		if ($price>0){ $price=round(($price*$kours),0); }
		if ($price<=0){$price="-";}
		return $price;
	}
	function show_cash_order_form(){$db=new db;	session_start();$cash=$_SESSION["cash"]; $slave=new slave; 
		$r=$db->query("select * from cash order by id asc;");$n=$db->num_rows($r);
		$form="<select name='cash' size=1 style='width:250px;'>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			
			if ($id==$cash){ $form.="<option value='$id' selected>$caption</option>";}
			if ($id!=$cash){ $form.="<option value='$id'>$caption</option>";}
		}
		$form.="</select>";
		return $form;
	}
	function get_cash_caption($cash){ $db=new db;session_start(); if ($cash==""){$cash=$_SESSION["cash"];}
		$r=$db->query("select caption from cash where id='$cash' limit 0,1;");$n=$db->num_rows($r);
		if ($n==1){ return $db->result($r,0,"caption");}
		if ($n==0){ return "";}
	}
	function get_cash_abr($cash){ $db=new db;session_start(); if ($cash==""){$cash=$_SESSION["cash"];}
		$r=$db->query("select abr from cash where id='$cash' limit 0,1;");$n=$db->num_rows($r);
		if ($n==1){ return $db->result($r,0,"abr");}
		if ($n==0){ return "";}
	}
}
?>