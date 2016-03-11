<?php
class galery {
	function show_main_page_galery($gdep,$head){
		$db=new db; $slave=new slave;	list($dep_up,$dep_cur)=$slave->get_file_deps("galery");
		$form_htm=RD."/tpl/galery_main_page.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from galery where theme='$gdep' order by rand() limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){
			$id=$db->result($r,0,"id");
			$theme=$db->result($r,0,"theme");
			$caption=$db->result($r,0,"caption");
			
			$form=str_replace("{foto}","<a href='?dep=3&dep_up=$dep_up&dep_cur=$dep_cur&w=show_foto&gdep=$gdep&theme=$theme&foto=$id'><img src='thumb.php?image=galery/$id.jpg&size=300' border=0 alt='$caption' title='$caption'></a>",$form);
			$form=str_replace("{caption}",$caption,$form);
			
		}
		$form=str_replace("{top}",$head,$form);
		$form=str_replace("{foto}","",$form);
		$form=str_replace("{caption}","",$form);
		return $form;
	}
	
	function show_galery_dep(){
		$db=new db; $slave=new slave;$dep=$slave->get_dep(); list($dep_up,$dep_cur)=$slave->get_file_deps("galery");
		$form_htm=RD."/tpl/galery_dep_theme.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$block_htm=RD."/tpl/galery_block_dt.htm";
		if (!file_exists("$block_htm")){ $block="Не знайдено файл шаблону"; }
		if (file_exists("$block_htm")){ $block= file_get_contents($block_htm);}
		
				
		//      -----------------   list of fotos     ------------------------
		$r=$db->query("select * from galery_dep order by lenta,id asc;");
		$n=$db->num_rows($r);
		$list="<table align='left' border='0' cellpadding=3 cellspacing=0 id='galery'>";
		if ($n>0){$k=0;
			for ($i=1;$i<=$n;$i++){$k++;
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				if ($k==1){$list.="<tr>";}
					$list.="<td width='220'>$block</td>";
				if ($k==3){$list.="</tr>"; $k=0;}
				
				$list=str_replace("{caption}", $caption, $list);
				$list=str_replace("{data}", $data, $list);
				$list=str_replace("{foto}", "<img src='thumb.php?image=galery/dep/$id.jpg&size=160' alt='$caption' title='$caption'>", $list);
				$list=str_replace("{id}", $id, $list);
				$list=str_replace("{url}", "?dep=$dep&dep_up=$dep_up&dep_cur=$dep_cur&w=show_theme&gdep=$id", $list);
			}
		}
		$list.="</table>";
		
		$form=str_replace("{list_foto}",$list,$form);
		$form=str_replace("{foto}",$first_foto,$form);
		$form=str_replace("{caption}",$first_caption,$form);
		$form=str_replace("{data}",$first_data,$form);
			
		return $form;
	}
	
	function show_galery_theme($gdep){
		$db=new db; $slave=new slave;$dep=$slave->get_dep(); list($dep_up,$dep_cur)=$slave->get_file_deps("galery");
		$form_htm=RD."/tpl/galery_dep_theme.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$block_htm=RD."/tpl/galery_block_dt.htm";
		if (!file_exists("$block_htm")){ $block="Не знайдено файл шаблону"; }
		if (file_exists("$block_htm")){ $block= file_get_contents($block_htm);}
		
				
		//      -----------------   list of fotos     ------------------------
		$r=$db->query("select * from galery_theme where dep='$gdep' order by lenta,id asc;");
		$n=$db->num_rows($r);
		$list="<table align='left' border='0' cellpadding=3 cellspacing=0 id='galery'>";
		if ($n>0){$k=0;
			for ($i=1;$i<=$n;$i++){$k++;
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$data=$slave->data_word($db->result($r,$i-1,"data"));
				if ($k==1){$list.="<tr>";}
					$list.="<td width='220'>$block</td>";
				if ($k==3){$list.="</tr>"; $k=0;}
				
				$list=str_replace("{caption}", $caption."<br>".$data, $list);
				$list=str_replace("{data}", $data, $list);
				$list=str_replace("{foto}", "<img src='thumb.php?image=galery/theme/$id.jpg&size=160' alt='$caption' title='$caption'>", $list);
				$list=str_replace("{id}", $id, $list);
				$list=str_replace("{url}", "?dep=$dep&dep_up=$dep_up&dep_cur=$dep_cur&w=show_foto&gdep=$gdep&theme=$id", $list);
			}
		}
		$list.="</table>";
		
		$form=str_replace("{list_foto}",$list,$form);
		$form=str_replace("{foto}",$first_foto,$form);
		$form=str_replace("{caption}",$first_caption,$form);
		$form=str_replace("{data}",$first_data,$form);
			
		return $form;
	}
	
	function show_galery_foto($gdep,$theme,$foto){
		$db=new db; $slave=new slave;$dep=$slave->get_dep(); list($dep_up,$dep_cur)=$slave->get_file_deps("galery");
		$form_htm=RD."/tpl/galery_foto.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$block_htm=RD."/tpl/galery_block.htm";
		if (!file_exists("$block_htm")){ $block="Не знайдено файл шаблону"; }
		if (file_exists("$block_htm")){ $block= file_get_contents($block_htm);}
		
		//      -----------------   first foto     ------------------------
		if ($foto!=""){$where=" and id='$foto' ";}
		$r=$db->query("select * from galery where dep='$gdep' and theme='$theme' $where order by lenta,id asc limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){
			$id=$db->result($r,0,"id");
			$first_caption=$db->result($r,0,"caption");
			$first_data=$slave->data_word($db->result($r,0,"data"));
			$first_foto="<img src='thumb.php?image=galery/$id.jpg&size=800' alt='$first_caption' title='$first_caption' id='first_foto'>";
		}
		
		//      -----------------   list of fotos     ------------------------
		$r=$db->query("select * from galery where dep='$gdep' and theme='$theme' order by lenta,id asc;");
		$n=$db->num_rows($r);
		$list="<table align='center' width='98%' border='0' cellpadding=3 cellspacing=0 id='galery'>";
		if ($n>0){$k=0;
			for ($i=1;$i<=$n;$i++){$k++;
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$data=$slave->data_word($db->result($r,$i-1,"data"));
				if ($k==1){$list.="<tr>";}
					$list.="<td>$block</td>";
				if ($k==5){$list.="</tr>"; $k=0;}
				
				$list=str_replace("{caption}", $caption, $list);
				$list=str_replace("{data}", $data, $list);
				$list=str_replace("{foto}", "<img src='thumb.php?image=galery/$id.jpg&size=125' alt='$caption' title='$caption'>", $list);
				$list=str_replace("{id}", $id, $list);
			}
		}
		$list.="</table>";
		
		$form=str_replace("{list_foto}",$list,$form);
		$form=str_replace("{foto}",$first_foto,$form);
		$form=str_replace("{caption}",$first_caption,$form);
		$form=str_replace("{data}",$first_data,$form);
			
		return $form;
	}
	
	function get_foto($foto){
		$db=new db;$slave=new slave;
		$r=$db->query("select * from galery where id='$foto' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){
			$id=$db->result($r,0,"id");
			$caption=$db->result($r,0,"caption");
			$data=$slave->data_word($db->result($r,0,"data"));
			$foto="<img src='thumb.php?image=galery/$id.jpg&size=800' alt='$caption' title='$caption' id='first_foto'>";
		}			
		return $foto;
	}
	function get_dep_caption($gdep){
		$db=new db;$slave=new slave;
		$r=$db->query("select caption from galery_dep where id='$gdep' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){ return $caption=$db->result($r,0,"caption");}
		if ($n==0){ return "";}
	}
	function get_theme_caption($theme){
		$db=new db;$slave=new slave;
		$r=$db->query("select caption from galery_theme where id='$theme' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){ return $caption=$db->result($r,0,"caption");}
		if ($n==0){ return "";}
	}
}
?>
