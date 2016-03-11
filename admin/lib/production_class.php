<?php

class production {
	function show_production($dep1,$dep2,$dep3){
		$db=new db; $slave=new slave; $lan="ua";
		$production_list_htm=RD."/tpl/production_list.htm";
		if (!file_exists("$production_list_htm")){ $production_list="Не знайдено файл шаблону1"; }
		if (file_exists("$production_list_htm")){ $production_list = file_get_contents($production_list_htm);}
		$dep=$slave->get_dep();
		$r=$db->query("select * from production order by caption_ua asc;");
		$n=$db->num_rows($r);
		if ($n>0){	$p_list="";
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption_$lan");
				$size=$db->result($r,$i-1,"size_$lan");
				$edin=$db->result($r,$i-1,"edin_$lan");
				$r1=$db->result($r,$i-1,"r1");
				$r2=$db->result($r,$i-1,"r2");
				$r3=$db->result($r,$i-1,"r3");
				$vedin=$db->result($r,$i-1,"vedin");
				$porez=$db->result($r,$i-1,"porez");
				$optf1=$db->result($r,$i-1,"optf1");
				$optc1=$db->result($r,$i-1,"optc1");
				$optf2=$db->result($r,$i-1,"optf2");
				$optc2=$db->result($r,$i-1,"optc2");
				
				$p_list.="<tr bgcolor='#C5D2F1'>
					<td><a href='?dep=$dep&w=edit_production&production_id=$id'><img src='images/edit.png' border=0></a></td>
					<td><a href='#' onclick='if (confirm(\"Видалити найменування?\")){ location.href=\"?dep=$dep&w=delete_production&conf=true&production_id=$id\"; }'><img src='images/drop.png' border=0></a></td>
					<td>$caption</td><td>$size</td><td>$edin</td><td>$r1</td><td>$r2</td><td>$r3</td>
					<td>$vedin</td><td>$porez</td><td>$optf1</td><td>$optc1</td><td>$optf2</td><td>$optc2</td>
				</tr>";
			}
		}
		$production_list=str_replace("{production_list}", $p_list, $production_list);
		$production_list=str_replace("{navigation}", $navigation, $production_list);
		return $production_list;
	}
	
//----------------------------------------------------------------------------------------------------------------------------

function show_production_form($dep1,$dep2,$dep3){
		$db=new db; $slave=new slave; 
		$production_form_htm=RD."/tpl/production_form.htm";
		if (!file_exists("$production_form_htm")){ $production_form="Не знайдено файл шаблону"; }
		if (file_exists("$production_form_htm")){ $production_form = file_get_contents($production_form_htm);}
		
		$production_form=str_replace("{w_cap}", "Нове найменування", $production_form);
		$production_form=str_replace("{dep}", $slave->get_dep(), $production_form);
		$production_form=str_replace("{w}", $slave->get_w(), $production_form);
		$production_form=str_replace("{production_id}", $production_id, $production_form);
				
		$production_form=str_replace("{dep1}", $slave->get_dep1(), $production_form);
		$production_form=str_replace("{dep2}", $slave->get_dep2(), $production_form);
		$production_form=str_replace("{dep3}", $slave->get_dep3(), $production_form);
		
		$production_form=str_replace("{caption_ua}", $caption_ua, $production_form);
		$production_form=str_replace("{caption_ru}", $caption_ru, $production_form);
		$production_form=str_replace("{caption_en}", $caption_en, $production_form);
		$production_form=str_replace("{edin_ua}", $edin_ua, $production_form);$production_form=str_replace("{edin_ru}", $edin_ru, $production_form);$production_form=str_replace("{edin_en}", $edin_en, $production_form);
		$production_form=str_replace("{size_ua}", $size_ua, $production_form);$production_form=str_replace("{size_ru}", $size_ru, $production_form);$production_form=str_replace("{size_en}", $size_en, $production_form);
		$production_form=str_replace("{r1}", $r1, $production_form);$production_form=str_replace("{r2}", $r2, $production_form);$production_form=str_replace("{r3}", $r3, $production_form);
		$production_form=str_replace("{vedin}", $vedin, $production_form);$production_form=str_replace("{porez}", $porez, $production_form);
		$production_form=str_replace("{optf1}", $optf1, $production_form);$production_form=str_replace("{optf2}", $optf2, $production_form);
		$production_form=str_replace("{optc1}", $optc1, $production_form);$production_form=str_replace("{optc2}", $optc2, $production_form);
		return $production_form;
	}
	
	function add_production_form(){
		$db=new db; $slave=new slave;
		
		$caption_ua=$slave->qq($_POST["caption_ua"]);$caption_ru=$slave->qq($_POST["caption_ru"]);$caption_en=$slave->qq($_POST["caption_en"]);
		$edin_ua=$slave->qq($_POST["edin_ua"]);$edin_ru=$slave->qq($_POST["edin_ru"]);$edin_en=$slave->qq($_POST["edin_en"]);
		$size_ua=$slave->qq($_POST["size_ua"]);$size_ru=$slave->qq($_POST["size_ru"]);$size_en=$slave->qq($_POST["size_en"]);
		$r1=$slave->qq($_POST["r1"]);$r2=$slave->qq($_POST["r2"]);$r3=$slave->qq($_POST["r3"]);
		$vedin=$slave->qq($_POST["vedin"]);$porez=$slave->qq($_POST["porez"]);$optf1=$slave->qq($_POST["optf1"]);$optf2=$slave->qq($_POST["optf2"]);
		$optc1=$slave->qq($_POST["optc1"]);$optc2=$slave->qq($_POST["optc2"]);
				
		$r=$db->query("select max(id) as mid from production;");	
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into production values ('$mid','$caption_ru','$caption_ua','$caption_en','$size_ru','$size_ua','$size_en','$edin_ru','$edin_ua','$edin_en',
					'$r1','$r2','$r3','$vedin','$porez','$optf1','$optc1','$optf2','$optc2');");
		return $mid;	
	}
	function edit_production_form($production_id,$dep1,$dep2,$dep3){
		$db=new db; $slave=new slave;
		$production_form_htm=RD."/tpl/production_form.htm";
		if (!file_exists("$production_form_htm")){ $production_form="Не знайдено файл шаблону"; }
		if (file_exists("$production_form_htm")){ $production_form = file_get_contents($production_form_htm);}
		
		$r=$db->query("select * from production where id='$production_id';");
		$n=$db->num_rows($r);
		if ($n==0){$production_form="Страница не найдена";}
		if ($n>0){

			$caption_ua=$slave->qqback($db->result($r,0,"caption_ua"));$caption_ru=$slave->qqback($db->result($r,0,"caption_ru"));$caption_en=$slave->qqback($db->result($r,0,"caption_en"));
			$edin_ua=$slave->qqback($db->result($r,0,"edin_ua"));$edin_ru=$slave->qqback($db->result($r,0,"edin_ru"));$edin_en=$slave->qqback($db->result($r,0,"edin_en"));
			$size_ua=$slave->qqback($db->result($r,0,"size_ua"));$size_ru=$slave->qqback($db->result($r,0,"size_ru"));$size_en=$slave->qqback($db->result($r,0,"size_en"));
			$r1=$slave->qqback($db->result($r,0,"r1"));$r2=$slave->qqback($db->result($r,0,"r2"));$r3=$slave->qqback($db->result($r,0,"r3"));
			$vedin=$slave->qqback($db->result($r,0,"vedin"));$porez=$slave->qqback($db->result($r,0,"porez"));
			$optf1=$slave->qqback($db->result($r,0,"optf1"));$optf2=$slave->qqback($db->result($r,0,"optf2"));
			$optc1=$slave->qqback($db->result($r,0,"optc1"));$optc2=$slave->qqback($db->result($r,0,"optc2"));
		}
		
		$production_form=str_replace("{w_cap}", "Редагувати найменування", $production_form);
		$production_form=str_replace("{dep}", $slave->get_dep(), $production_form);
		$production_form=str_replace("{w}", $slave->get_w(), $production_form);
		$production_form=str_replace("{production_id}", $production_id, $production_form);
				
		$production_form=str_replace("{dep1}", $slave->get_dep1(), $production_form);
		$production_form=str_replace("{dep2}", $slave->get_dep2(), $production_form);
		$production_form=str_replace("{dep3}", $slave->get_dep3(), $production_form);
		
		$production_form=str_replace("{caption_ua}", $caption_ua, $production_form);
		$production_form=str_replace("{caption_ru}", $caption_ru, $production_form);
		$production_form=str_replace("{caption_en}", $caption_en, $production_form);
		$production_form=str_replace("{edin_ua}", $edin_ua, $production_form);$production_form=str_replace("{edin_ru}", $edin_ru, $production_form);$production_form=str_replace("{edin_en}", $edin_en, $production_form);
		$production_form=str_replace("{size_ua}", $size_ua, $production_form);$production_form=str_replace("{size_ru}", $size_ru, $production_form);$production_form=str_replace("{size_en}", $size_en, $production_form);
		$production_form=str_replace("{r1}", $r1, $production_form);$production_form=str_replace("{r2}", $r2, $production_form);$production_form=str_replace("{r3}", $r3, $production_form);
		$production_form=str_replace("{vedin}", $vedin, $production_form);$production_form=str_replace("{porez}", $porez, $production_form);
		$production_form=str_replace("{optf1}", $optf1, $production_form);$production_form=str_replace("{optf2}", $optf2, $production_form);
		$production_form=str_replace("{optc1}", $optc1, $production_form);$production_form=str_replace("{optc2}", $optc2, $production_form);
		return $production_form;
		
	}
	
	function save_production_form(){
		$db=new db; $slave=new slave;
		$production_id=$_POST["production_id"];
		$caption_ua=$slave->qq($_POST["caption_ua"]);$caption_ru=$slave->qq($_POST["caption_ru"]);$caption_en=$slave->qq($_POST["caption_en"]);
		$edin_ua=$slave->qq($_POST["edin_ua"]);$edin_ru=$slave->qq($_POST["edin_ru"]);$edin_en=$slave->qq($_POST["edin_en"]);
		$size_ua=$slave->qq($_POST["size_ua"]);$size_ru=$slave->qq($_POST["size_ru"]);$size_en=$slave->qq($_POST["size_en"]);
		$r1=$slave->qq($_POST["r1"]);$r2=$slave->qq($_POST["r2"]);$r3=$slave->qq($_POST["r3"]);
		$vedin=$slave->qq($_POST["vedin"]);$porez=$slave->qq($_POST["porez"]);$optf1=$slave->qq($_POST["optf1"]);$optf2=$slave->qq($_POST["optf2"]);
		$optc1=$slave->qq($_POST["optc1"]);$optc2=$slave->qq($_POST["optc2"]);
		
		$db->query("update production set caption_ua='$caption_ua', caption_ru='$caption_ru', caption_en='$caption_en', 
										  size_ua='$size_ua', size_ru='$size_ru', size_en='$size_en',
										  edin_ua='$edin_ua', edin_ru='$edin_ru', edin_en='$edin_en',
										  r1='$r1', r2='$r2', r3='$r3', vedin='$vedin', porez='$porez',
										  optf1='$optf1', optf2='$optf2',optc1='$optc1', optc2='$optc2'
										   where id='$production_id';");
		return $production_id;
	}
	function delete_production_form($production_id){
		$db=new db;
		$db->query("delete from production where id='$production_id';");
		return;
	}
}
?>
