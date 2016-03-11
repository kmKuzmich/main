<?php

class documents {	
	
	function show_list(){session_start();
		$code=$_SESSION["code"];
		$db=new db; $slave=new slave;$dep=$slave->get_dep(); list($dep_up,$dep_cur)=$slave->get_file_deps("documents");
		$form_htm=RD."/tpl/documents_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$nomber=$_SESSION["nomber"];$doc_type=$_SESSION["doc_type"];$scroll=$_SESSION["scroll"];$sort=$_SESSION["sort"];$data_from=$_SESSION["data_from"];$data_to=$_SESSION["data_to"];

		$where="";	
		//-----------
		if ($nomber!=""){$where.=" and nomber = '$nomber'";}
		if ($doc_type!="0" and $doc_type!=""){$where.=" and doc_type='$doc_type' ";}
		if ($data_from!="" and $data_to!=""){$where.=" and data>='$data_from' and data<='$data_to'";}
		
		$list="";
		$r=$db->query("select * from documents where client='$code' $where group by `nomber` order by data $sort;");
		$n=$db->num_rows($r);
		if ($n>0){$c=0;
			for ($i=1;$i<=$n;$i++){$c++;
				$id=$db->result($r,$i-1,"id");
				$nomber=$db->result($r,$i-1,"nomber");
				$summ=$db->result($r,$i-1,"summ");
				$doc_type_id=$db->result($r,$i-1,"doc_type");
				$doc_type=$this->get_doc_type_caption($doc_type_id);
				$data=$slave->data_word($db->result($r,$i-1,"data"));
				if ($nomber!="На 2010 г."){
					$trcolor="";
					if ($doc_type_id==1){$trcolor="ccccff";}
					if ($doc_type_id==2){$trcolor="99ff99";}
					if ($doc_type_id==3){$trcolor="ffff99";}
					if ($doc_type_id==4){$trcolor="99ff99";}
					if ($doc_type_id==5){$trcolor="ffcccc";}
					if ($doc_type_id==6){$trcolor="99ff99";}
				
					$list.="<tr bgcolor='#$trcolor' style='border-right:1px solid #CCC;'>
						<td></td>
						<td style='border-right:1px solid #CCC;'>$doc_type</td>
						<td align='center'style='border-right:1px solid #CCC;'> $data</td>
						<td style='border-right:1px solid #CCC;'> &nbsp; &nbsp;$nomber</td>
						<td align='right'><b>".$this->show_summ($nomber)."</b></td>
						<td></td>
					<tr>";
					if ($scroll=="1"){
						$list.="<tr><td colspan=5>".$this->show_desc($nomber)."</td></tr>";	
					}
				}
			}
		}
		$list="<tr><td colspan='5' align='right' bgcolor='#ff99cc' >Ваша задолженность, на текущий момент: <span style='font: bold 18px Tahoma'><b>".$this->get_balance()."$</span></b></td></tr>".$list;
		$form=str_replace("{list}", $list, $form);
		return $form;
	}
	function show_desc($nomber){session_start();
		$db=new db; $slave=new slave; $code=$_SESSION["code"];
		$r=$db->query("select * from documents where nomber='$nomber' and client='$code';");
		$n=$db->num_rows($r);
		$list="<table width='100%' border=0>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$catalogue=$db->result($r,$i-1,"catalogue");
			$kol=$db->result($r,$i-1,"kol");
			$summ=round($db->result($r,$i-1,"summ"),2);
			$catalogue_caption=$this->get_catalogue_caption($catalogue);
			$list.="<tr bgcolor='#ebebeb'>
	    	<td width='170' bgcolor='#FFFFFF' colspan=2 style='border-bottom:1px solid #000;'></td>
	        <td width='170'style='border-bottom:1px solid #000;'>$catalogue</td>
			<td width='300'style='border-bottom:1px solid #000;'>$catalogue_caption</td>
			<td width='70' align='right'style='border-bottom:1px solid #000;'>x $kol &nbsp;</td>
	        <td width='150' align='right'style='border-bottom:1px solid #000;'>$summ</td>
			</tr>";
		}
		$list.="</table>";
		return $list;
	}
	
	function show_summ($nomber){session_start();
		$db=new db; $slave=new slave; $code=$_SESSION["code"];
		$r=$db->query("select kol,summ from documents where nomber='$nomber' and client='$code';");
		$n=$db->num_rows($r);$summ_a=0;
		for ($i=1;$i<=$n;$i++){
			$kol=$db->result($r,$i-1,"kol");if ($kol==0){$kol=1;}
			$summ=$db->result($r,$i-1,"summ");
			$summ_a+=$summ;
		}
		return $this->int_to_money($summ_a);
	}
	 
	function get_balance(){session_start();
		$db=new db; $slave=new slave; $code=$_SESSION["code"];$balance=0;
		
		$r=$db->query("select * from documents where nomber='На 2010 г.' and client='$code' and catalogue='';");
		$n=$db->num_rows($r);
		if ($n>0){ $summ_d=$db->result($r,0,"summ"); }
		$r=$db->query("select * from documents where nomber='На 2010 г.' and client='$code' and catalogue='00000000';");
		$n=$db->num_rows($r);
		if ($n>0){ $summ_k=$db->result($r,0,"summ"); }

		if ($summ_d!=0){$balance=$summ_d;}
		if ($summ_k!=0){$balance=$summ_k;}

		$r=$db->query("select * from documents where client='$code' and nomber<>'На 2010 г.' order by id asc;");
		$n=$db->num_rows($r);

		if ($n>0){
			for ($i=1;$i<=$n;$i++){$c++;
				$summ=$db->result($r,$i-1,"summ");
				$doc_type_id=$db->result($r,$i-1,"doc_type");
				if ($doc_type_id==1){ $balance-=$summ; }
				if ($doc_type_id==2){ $balance+=$summ; }
				if ($doc_type_id==3){ $balance-=$summ; }
				if ($doc_type_id==4){ $balance+=$summ; }
				if ($doc_type_id==5){ $balance-=$summ; }
				if ($doc_type_id==6){ $balance-=$summ; }
			}
		}
		return $this->int_to_money($balance);
	}
	
	function show_filter_form(){session_start();
		$slave=new slave;$dep=$slave->get_dep(); list($dep_up,$dep_cur)=$slave->get_file_deps("documents");
		
		$form_htm=RD."/tpl/documents_filter_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$pst=$_POST["pst"];
		if ($pst=="search"){
			$doc_type=$slave->qqback($_POST["doc_type"]);$_SESSION["doc_type"]=$doc_type;
			$scroll=$slave->qqback($_POST["scroll"]);$_SESSION["scroll"]=$scroll;
			$nomber=$slave->qqback($_POST["nomber"]);$_SESSION["nomber"]=$nomber;
			$sort=$_POST["sort"];if ($sort==""){$sort="desc";}$_SESSION["sort"]=$sort;
			$data_from=$_POST["data_from_year"]."-".$_POST["data_from_month"]."-".$_POST["data_from_date"];$_SESSION["data_from"]=$data_from;
			$data_to=$_POST["data_to_year"]."-".$_POST["data_to_month"]."-".$_POST["data_to_date"];$_SESSION["data_to"]=$data_to;
		}
		if ($pst==""){
			$nomber=$_SESSION["nomber"];
			$doc_type=$_SESSION["doc_type"];
			$data_from=$_SESSION["data_from"];
			$data_to=$_SESSION["data_to"];
			$scroll=$_SESSION["scroll"];
			$sort=$_SESSION["sort"];	if ($sort==""){$sort="desc";}
		}
		if ($scroll=="1"){$checked=" checked ";}if ($scroll==""){$checked="";}
		if ($sort=="asc"){$checked1="";$checked2=" checked ";}
		if ($sort=="desc"){$checked1=" checked ";$checked2="";}
		if ($data_to==""){$data_to=date("Y-m-d");}
		if ($data_from==""){$data_from="2010-01-01";}
		
		$form=str_replace("{doc_type_form}",$this->get_doc_type_form($doc_type),$form);
		$form=str_replace("{nomber}",$nomber,$form);
		$form=str_replace("{checked}",$checked,$form);
		$form=str_replace("{data_from}",$this->get_data_form("data_from",$data_from),$form);
		$form=str_replace("{data_to}",$this->get_data_form("data_to",$data_to),$form);
		$form=str_replace("{checked1}",$checked1,$form);
		$form=str_replace("{checked2}",$checked2,$form);
		
		$form=str_replace("{dep}",$dep,$form);
		$form=str_replace("{w}",$w,$form);
		$form=str_replace("{dep_up}",$dep_up,$form);
		$form=str_replace("{dep_cur}",$dep_cur,$form);
		
		return $form;	
	}
	
	function get_catalogue_caption($code){
		$db=new db;
		$r=$db->query("select caption from catalogue where code='$code';");
		$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"caption");}
		if ($n==0){ return "&nbsp;";}
	}
	function get_doc_type_caption($type){
		$db=new db;
		$r=$db->query("select caption from document_type where id='$type';");
		$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"caption");}
		if ($n==0){ return "";}
	}
	function get_doc_type_form($type){
		$db=new db;$slave=new slave;
		$r=$db->query("select * from document_type order by id asc");
		$n=$db->num_rows($r);
		$frm="<select name='doc_type' size=1 style='width:100%;'><option value='0'>Все типы документов</option>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			if ($id==$type){ $frm.="<option value='$id' selected>$caption</option>";}
			if ($id!=$type){ $frm.="<option value='$id'>$caption</option>";}
		}
		$frm.="</select>";
		return $frm;
	}
	
	function get_data_form($name,$data){
		$slave=new slave;$cur_year=date("Y");$start_year="2010";
		$c_date=substr($data,8,2);$c_month=substr($data,5,2);$c_year=substr($data,0,4);
		$frm="<select name='$name"."_date' size=1 style='width:40px;'>";
		for ($i=1;$i<=31;$i++){
			$nom=$i;if (strlen($nom)==1){$nom="0".$nom;}
			if ($i==$c_date){ $frm.="<option value='$nom' selected>$nom</option>";}
			if ($i!=$c_date){ $frm.="<option value='$nom'>$nom</option>";}
		}
		$frm.="</select>";
		$frm.="<select name='$name"."_month' size=1 style='width:100px;'>";
		for ($i=1;$i<=12;$i++){
			$nom=$i;if (strlen($nom)==1){$nom="0".$nom;}
			if ($i==$c_month){ $frm.="<option value='$nom' selected>".$slave->get_month_name("m".$nom,"2")."</option>";}
			if ($i!=$c_month){ $frm.="<option value='$nom'>".$slave->get_month_name("m".$nom,"2")."</option>";}
		}
		$frm.="</select>";
		$frm.="<select name='$name"."_year' size=1 style='width:60px;'>";
		for ($i=$cur_year; $i>=$start_year;$i--){
			if ($i==$c_year){ $frm.="<option value='$i' selected>$i</option>";}
			if ($i!=$c_year){ $frm.="<option value='$i'>$i</option>";}
		}
		$frm.="</select>";
		return $frm;
	}
	
	//-----------------
	
	function int_to_money($int) {
		if (strpos($int,".")==strlen($int)-3){$money=$int;}
		if (strpos($int,".")==strlen($int)-2){$money=$int."0";}
		if (strpos($int,".")===false){$money=$int.".00";}
		return $money; 
	}	
}
?>