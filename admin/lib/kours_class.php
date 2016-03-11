<?php
class kours {
	function get_asc(){ if ($_POST["asc"]==""){return $_GET["asc"];} if ($_POST["asc"]!=""){return $_POST["asc"];} }
	function get_data(){ if ($_POST["data"]==""){return $_GET["data"];} if ($_POST["data"]!=""){return $_POST["data"];} }
	function get_cash_caption($cash){$db=new db;session_start();if ($cash==""){$cash=$_SESSION["cash"];}
		$r=$db->query("select abr from cash where id='$cash';");$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"abr");}
		if ($n==0){ return "$";}
	}
	function get_cash_form($cash){$db=new db;
		$r=$db->query("select * from cash order by id asc;");$n=$db->num_rows($r);
		$form="<select name='cash' id='cash' size=1 style='width:130px;'>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			if ($id==$cash){ $form.="<option value='$id' selected>$caption</option>";}
			if ($id!=$cash){ $form.="<option value='$id'>$caption</option>";}
		}
		$form.="</select>";
		return $form;
	}
	function get_cash_price($price,$cash){$db=new db;if ($cash==""){$cash=1;}
		$r=$db->query("select * from kours where ison='1' order by id desc limit 0,1;");$n=$db->num_rows($r);
		if ($n>0){$kours_1=$db->result($r,0,"kours_1");}
		if ($cash=="2"){$price=ceil($price*$kours_1);}
		return $price;
	}
	function get_kours(){$db=new db;
		$r=$db->query("select * from kours where ison='1' order by id desc limit 0,1;");$n=$db->num_rows($r);
		if ($n>0){$kours_1=$db->result($r,0,"kours_1");}
		return $kours_1;
	}
	function show_kours_search_form(){session_start();$db=new db;$slave=new slave;$w=$slave->get_w();$mdl=new module;
		$form_htm=RD."/tpl/kours_search_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$file=$slave->get_file();
		$pst=$_POST["pst"];
		if ($pst=="search"){
			$data=$slave->qqback($_POST["data"]);$_SESSION["data"]=$data;
			$asc=$this->get_asc();	if ($asc==""){$asc="$desc";} $_SESSION["asc"]=$asc;
			$_SESSION["ses_file"]=$file;
		}
		if ($pst==""){ $ses_file=$_SESSION["ses_file"];
			if ($ses_file==$file){
				$data=$_SESSION["data"];
				$asc=$_SESSION["asc"];	if ($asc==""){$asc="$desc";}
			}
			if ($ses_file!=$file){
				$_SESSION["data"]="";
				$_SESSION["asc"]="";
			}
		}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form = str_replace("{data}", $data, $form);
		$form = str_replace("{calendar}", $slave->get_calendar("data"), $form);
		$form = str_replace("{asc_form}", $this->get_asc_form($asc), $form);
		return $form;
	}
	function show_kours_navigation($page,$where){$db=new db;$slave=new slave;
		if ($page==""){$page=0;}if ($page!=""){if ($page<0){$page=0;}}$kp=30;
		$r=$db->query("select count(id) as kol from kours where 1 $where;");$n=$db->result($r,0,"kol");
		$k=($page)*$kp;
		if (($page)*$kp < $n and $kp<=$n){
			if (($page+1)*$kp<=$n){$np=$page+1;}
			$next_page="<a href='javascript:load_kours_list(\"$np\")'><img src='../theme/images/next.jpg' border=0></a>";
		}
		if (($page)*$kp > 0) {
			if (($page-1)*$kp>=0){$pp=$page-1;}
			$prev_page="<a href='javascript:load_kours_list(\"$pp\")'><img src='../theme/images/prev.jpg' border=0></a>";
		}
		$cur_from=$page*$kp;$cur_to=($page+1)*$kp;if ($cur_to>$n){$cur_to=$n;}
		$cur_records="Отображено записи: $cur_from - $cur_to";
		$navigation="<table><tr><td>$prev_page</td><td> $cur_records </td><td>$next_page</td></tr></table>";
		return $navigation;	
	}
	function show_kours_list($page){$db=new db; $slave=new slave;
		$form_htm=RD."/tpl/kours_list.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$data=$this->get_data();if ($data==""){$data=$_SESSION["data"];}
		$where="";
		$asc=$this->get_asc();	if ($asc==""){$asc=$_SESSION["asc"];}if ($asc==""){$asc="$desc";}
		//-----------
		if ($data!=""){$where=" and `data` LIKE '%$data%' ";}
		$kp=30;
		if ($page==""){$limit=" limit 0,$kp";}
		if ($page!=""){ if ($page<0){$page=0;} $from=$page*$kp; $limit=" limit $from,$kp";}
		$r=$db->query("select * from kours where 1 $where order by id $asc $limit;");$n=$db->num_rows($r);
		if ($n>0){$k=0;$list="";
			for ($i=1;$i<=$n;$i++){$k++;
				$id=$db->result($r,$i-1,"id");
				$kours_2=$db->result($r,$i-1,"kours_2");
				$kours_3=$db->result($r,$i-1,"kours_3");
				$data=$slave->data_word($db->result($r,$i-1,"data"));
				$tr_color="ffffff";if ($k==2){$tr_color="f5f5f5";$k=0;}
				$list.="<tr bgcolor='#$tr_color' align='center'><td>$i</td><td align='right'>$kours_2 &nbsp;</td><td align='right'>$kours_3 &nbsp;</td><td>$data</td></tr>";
			}
		}
		$form=str_replace("{kours_list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_kours_navigation($page,$where),$form);
		$form=str_replace("{menu}",$this->show_menu(),$form);
		return $form;
	}
//----------------------------------------------------------------------------------------------------------------------------
	function show_kours_form(){$db=new db; $slave=new slave; 
		$form_htm=RD."/tpl/kours_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{kours2}", "", $form);
		$form=str_replace("{kours3}", "", $form);
		$form=str_replace("{data}", $slave->data_word(date("Y-m-d")), $form);
		return $form;
	}
	function add_kours_form(){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$kours2=$slave->qq($this->str_flt($_POST["kours_2"]));$kours3=$slave->qq($this->str_flt($_POST["kours_3"]));$data=date("Y-m-d");
		$db->query("update kours set ison='0';");
		$db->query("insert into kours values ('','1','$kours2','$kours3','$data','1');");
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Новый курс успешно сохранен";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{back_caption}","Назад в журнал курсов валют",$form);
		$form=str_replace("{back_url}","?$url",$form);
		$form=str_replace("{navigation}","",$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;	
	}
	function get_asc_form($asc){$db=new db;
		if ($asc==""){ $asc=$this->get_asc(); }if ($asc==""){ $asc="desc"; }
		$frm="<select name='asc' size=1 style='width:100px;'>";
		if ($asc=="asc"){ $frm.="<option value='asc' selected>Возрастанию</option><option value='desc'>Спаданию</option>";}
		if ($asc=="desc"){ $frm.="<option value='asc'>Возрастанию</option><option value='desc' selected>Спаданию</option>";}
		$frm.="</select>";
		return $frm;
	}
	function show_menu(){$slave=new slave; $mdl=new module; $url=$mdl->get_file_url();
		$menu_htm=RD."/tpl/kours_menu.htm";if (file_exists("$menu_htm")){ $menu = file_get_contents($menu_htm);}
		$menu=str_replace("{url_kours}","?$url&w=new_kours",$menu);
		$menu=str_replace("{alt_kours}","Новий курс",$menu);
		return $menu;
	}
	function str_flt($s){return str_replace(",",".",$s);}
}
?>