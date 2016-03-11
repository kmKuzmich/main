<?php

class anons {
	function show_main_page_anons(){
		$db=new db; $slave=new slave; list($dep_up,$dep_cur)=$slave->get_file_deps("anons");
		$anons_htm=RD."/tpl/anons_short_list.htm";	if (!file_exists("$anons_htm")){ $form="Не знайдено файл шаблону"; }	if (file_exists("$anons_htm")){ $form = file_get_contents($anons_htm);}
		
		$anons_list="<table align='center' width='324' border='0'>
		<tr><td height='45'><img src='theme/images/anons.jpg' alt='Анонси і оголошення' title='Анонси і оголошення' border=0 /></td></tr>";
		
		$r=$db->query("select * from anons order by id desc limit 0,4;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$data=$db->result($r,$i-1,"data");
				
				$anons_list.="<tr><td>$form</td><tr>";
				
				$anons_list=str_replace("{caption}", $caption, $anons_list);
				$anons_list=str_replace("{short_desc}", $short_desc, $anons_list);
				$anons_list=str_replace("{data}", $slave->data_word($data), $anons_list);
				
				if (file_exists("uploads/images/anons/$id.jpg")){$anons_list=str_replace("{pic}", "<img src='thumb.php?image=anons/$id.jpg&size=180' border='1' style='border-color:#022343;'>", $anons_list);}
				if (!file_exists("uploads/images/anons/$id.jpg")){$anons_list=str_replace("{pic}", "", $anons_list);}
				$anons_list=str_replace("{url}", "?dep=8&w=show_anons&dep_up=$dep_up&dep_cur=$dep_cur&anons_id=$id", $anons_list);
			}
		}
		$anons_list.="</table>";
		return $anons_list;
	}
	function show_anons_marquee(){
		$db=new db; $slave=new slave; list($dep_up,$dep_cur)=$slave->get_file_deps("anons");
		$r=$db->query("select id,caption from anons where top='1' order by id desc;");
		$n=$db->num_rows($r);
		if ($n>0){
			$anons_list="<marquee id='anons' width='100%' height='40' scrollamount='5' scrolldelay='100'>АНОНСИ І ОГОЛОШЕННЯ: &nbsp;";
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$anons_list.="<a class='caption' href='?dep=8&w=show_anons&dep_up=$dep_up&dep_cur=$dep_cur&anons_id=$id' style='text-decoration:none; color:red;'>$caption</a>; &nbsp;";
			}
			$anons_list.="</marquee>";
		}
		return $anons_list;
	}
	function show_short_list($anons_id,$dep_up,$dep_cur){
		$db=new db; $slave=new slave;

		$li_src="uploads/images/navigation/li.gif";
		$anons_list="<ol>";	
		$dep=$slave->get_dep();
		$r=$db->query("select * from anons order by id desc limit 0,6;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				if ($id!=$anons_id){$anons_list.="<a class='dep' href='?dep=$dep&w=show_anons&dep_up=$dep_up&anons_id=$id'><img src='$li_src'><b>$caption</b></a><br>";}
			}
		}
		$anons_list.="</ol>";
		return $anons_list;
	}
	function show_list($dep_up,$dep_cur){
		$db=new db; $slave=new slave;$dep=$slave->get_dep();
		$form_htm=RD."/tpl/anons_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$anons_list="<table align='center' width='98%' border='0'>";
		$r=$db->query("select * from anons order by id desc limit 0,20;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$data=$db->result($r,$i-1,"data");
				
				$anons_list.="<tr><td>$form</td><tr>";
				
				$anons_list=str_replace("{caption}", $caption, $anons_list);
				$anons_list=str_replace("{data}", $slave->data_word($data), $anons_list);
				
				if (file_exists("uploads/images/anons/$id.jpg")){$anons_list=str_replace("{pic}", "<img src='thumb.php?image=anons/$id.jpg&size=200' border='1' style='border-color:#022343;' align=\"left\" hspace=\"4\" vspace=\"4\">", $anons_list);}
				if (!file_exists("uploads/images/anons/$id.jpg")){$anons_list=str_replace("{pic}", "", $anons_list);}
				$anons_list=str_replace("{url}", "?dep=$dep&w=show_anons&dep_up=$dep_up&dep_cur=$dep_cur&anons_id=$id", $anons_list);
			}
		}
		$anons_list.="</table>";
		return $anons_list;
	}
	function show_desc($anons_id,$dep_up,$dep_cur){
		$db=new db; $slave=new slave;
		
		$form_htm=RD."/tpl/anons_desc.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$dep=$slave->get_dep();
		$r=$db->query("select * from anons where id='$anons_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$id=$db->result($r,0,"id");
			$caption=$db->result($r,0,"caption");
			$desc=$db->result($r,0,"desc");
			$data=$db->result($r,0,"data");
		}
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $desc, $form);
		$form=str_replace("{author}", $author, $form);
		$form=str_replace("{data}", $slave->data_word($data), $form);
		if (file_exists("uploads/images/anons/$id.jpg")){$form=str_replace("{pic}", "<img src='thumb.php?image=anons/$id.jpg&size=180' border='1' style='border-color:#022343;'>", $form);}
		if (!file_exists("uploads/images/anons/$id.jpg")){$form=str_replace("{pic}", "", $form);}

		return $form;
	}
}
?>
