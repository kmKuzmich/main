<?php
class articles {
	function show_catalogue_articles($theme){$db=new db; $slave=new slave; list($dep_up,$dep_cur)=$slave->get_file_deps("articles");
		$block_htm=RD."/tpl/articles_catalogue.htm";if (file_exists("$block_htm")){ $block = file_get_contents($block_htm);}
		$r=$db->query("select * from articles order by rand() limit 0,2;");$n=$db->num_rows($r);
		if ($n>0){
			$list="<table align='center' width='100%' border='0' cellpadding=0 cellspacing=0><tr><td height='37'>".$slave->show_head_tbl($LANG["articles_by_theme"])."</td></tr>";		
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$theme=$db->result($r,$i-1,"theme");
				$caption=$db->result($r,$i-1,"caption");
				$short_desc=$db->result($r,$i-1,"short_desc");
				$data=$db->result($r,$i-1,"data");
				
				$list.="<tr valign='top'><td>$block</td></tr>";
				
				$list=str_replace("{caption}", $caption, $list);
				$list=str_replace("{short_desc}", $short_desc, $list);
				
				if (file_exists("uploads/images/articles/$id.jpg")){$list=str_replace("{pic}", "<img src='thumb.php?image=articles/$id.jpg&size=100' border='3' align='left'>", $list);	}
				if (!file_exists("uploads/images/articles/$id.jpg")){$list=str_replace("{pic}", "", $list);	}
				$list=str_replace("{url}", "?dep=6&w=show_articles&dep_up=$dep_up&dep_cur=$dep_cur&theme=$theme&articles_id=$id", $list);
			}
			$list.="
		<tr><td align='right'><a href='?dep=articles&dep_up=$dep_up&dep_cur=$dep_cur&theme=$theme'>".$LANG["articles_all"]."</a></td></tr>
		</table>";
		}
		return $list;
	}
	function show_theme_menu($theme){$db=new db; $slave=new slave; $dep=$slave->get_dep();
		$li_src="uploads/images/general/li2.jpg";
		$theme_list="<p><p><ol>";
		$r=$db->query("select * from articles_theme where dep='$dep_cur' order by id desc;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				if ($id!=$theme){$theme_list.="<a class='dep' href='?dep=$dep&dep_up=$dep_up&dep_cur=$dep_cur&theme=$id'><img src='$li_src'> $caption</a><p>";}
				if ($id==$theme){$theme_list.="<a class='dep' href='?dep=$dep&dep_up=$dep_up&dep_cur=$dep_cur&theme=$id' style='color: #4a74a8;'><img src='$li_src'>&nbsp;<b>$caption</b></a><p>";}
			}
		}
		$theme_list.="</ol><p><p>";
		return $theme_list;
	}
	function show_theme_articles(){$db=new db; $slave=new slave;
		$theme_list="<table width='100%' id='articles' border='0' cellpadding=0 cellspacing=0>";
		$dep=$slave->get_dep();
		if ($theme==""){
			$r=$db->query("select * from articles_theme order by id desc;");
			$n=$db->num_rows($r);
			if ($n>0){
				for ($i=1;$i<=$n;$i++){
					$id=$db->result($r,$i-1,"id");
					if ( $this->check_exist_articles($id) ){
						$caption=$db->result($r,$i-1,"caption");
						$theme_list.="<tr><td class='theme' colspan=2>$caption<br><br></td></tr><tr><td width='30'></td><td>".$this->show_articles($id,"4")."</td></tr>";
					}
				}
			}
		}
		$count=$_GET["count"];if ($count==""){$count=10;}
		if ($theme!=""){ $theme_list.="<tr><td>".$this->show_articles($theme,$count)."</td></tr>";}
		$theme_list.="</table>";
		return $theme_list;
	}
	function show_articles_list($theme,$articles_id){$db=new db; $slave=new slave;$dep=$slave->get_dep();list($dep_up,$dep_cur)=$slave->get_file_deps("articles");
		list($dep_up,$dep_cur)=$slave->get_file_deps("articles");
		$articles_block_htm=RD."/tpl/articles_block.htm";if (file_exists("$articles_block_htm")){ $articles_block = file_get_contents($articles_block_htm);}
		$articles_list="<h2>".$LANG["articles_interes"]."</h2><table align='center' width='98%' border='0' cellpadding=0 cellspacing=0>";
		$r=$db->query("select * from articles where theme='$theme' order by id desc;");
		$n=$db->num_rows($r);if ($count!="" and $count<=$n){$n=$count;}
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				if ($articles_id!=$id){
					$caption=$db->result($r,$i-1,"caption");
					$short_desc=$db->result($r,$i-1,"short_desc");
					$data=$db->result($r,$i-1,"data");
					
					$articles_list.="<tr valign='top'><td>$articles_block</td></tr><tr><td background='uploads/images/general/line.gif' style='background-repeat:repeat-x;' height='5'></td></tr>";
					
					$articles_list=str_replace("{caption}", $caption, $articles_list);
					$articles_list=str_replace("{short_desc}", $short_desc, $articles_list);
					$articles_list=str_replace("{data}", $slave->data_word($data), $articles_list);
					
					if (file_exists("uploads/images/articles/$id.jpg")){$articles_list=str_replace("{pic}", "<img src='thumb.php?image=articles/$id.jpg&size=100' border='3'>", $articles_list);	}
					if (!file_exists("uploads/images/articles/$id.jpg")){$articles_list=str_replace("{pic}", "", $articles_list);	}
					$articles_list=str_replace("{url}", "?dep=articles&w=show_articles&dep_up=$dep_up&dep_cur=$dep_cur&articles_id=$id", $articles_list);
				}
			}
		}
		$articles_list.="</table><br>";
		return $articles_list;
	}
	function show_articles($theme,$count){$db=new db; $slave=new slave;list($dep_up,$dep_cur)=$slave->get_file_deps("articles");
		$articles_list_htm=RD."/tpl/articles_list.htm";	if (file_exists("$articles_list_htm")){ $articles_block = file_get_contents($articles_list_htm);}
		$articles_list="<table width='100%' id='in' border='0' cellpadding=0 cellspacing=0>";
		$dep=$slave->get_dep();
		if ($count=="0"){$count="1000";}
		$r=$db->query("select * from articles where theme='$theme' order by id desc limit 0,$count;");
		$n=$db->num_rows($r);
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$short_desc=$db->result($r,$i-1,"short_desc");
			$data=$db->result($r,$i-1,"data");
			
			$articles_list.="<tr><td>$articles_block</td></tr>";
							
			$articles_list=str_replace("{caption}", $caption, $articles_list);
			$articles_list=str_replace("{short_desc}", $short_desc, $articles_list);
			$articles_list=str_replace("{data}", $slave->data_word($data), $articles_list);
			
			if (file_exists("uploads/images/articles/$id.jpg")){$articles_list=str_replace("{pic}", "<img src='thumb.php?image=articles/$id.jpg&size=100' align='left' border='0'>", $articles_list);	}
			if (!file_exists("uploads/images/articles/$id.jpg")){$articles_list=str_replace("{pic}", "", $articles_list);	}
			$articles_list=str_replace("{url}", "?dep=articles&w=show_articles&dep_up=$dep_up&dep_cur=$dep_cur&theme=$theme&articles_id=$id", $articles_list);
		}
		$theme_caption=$this->get_theme_caption($theme);
		$articles_list.="
		<tr><td align='right'><a href='?dep=$dep&dep_up=$dep_up&dep_cur=$dep_cur&theme=$theme&count=0' style='font-size:10px;'>".$LANG["articles_arc"]." \"$theme_caption\"</a></td></tr>
		</table>";
		return $articles_list;
	}
	function show_articles_desc($articles_id){$db=new db; $slave=new slave;list($dep_up,$dep_cur)=$slave->get_file_deps("articles"); $dep=$slave->get_dep();
		$articles_desc_htm=RD."/tpl/articles_desc.htm";if (file_exists("$articles_desc_htm")){ $articles_desc = file_get_contents($articles_desc_htm);}
		$r=$db->query("select * from articles where id='$articles_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$db->result($r,0,"caption");
			$desc=$db->result($r,0,"desc");
			$data=$db->result($r,0,"data");
			$author=$db->result($r,0,"author");
			$source=$db->result($r,0,"source");
			$url=$db->result($r,0,"url");
			$articles_desc=str_replace("{caption}", $caption, $articles_desc);
			$articles_desc=str_replace("{desc}", $desc, $articles_desc);
			$articles_desc=str_replace("{author}", $author, $articles_desc);
			$articles_desc=str_replace("{data}", $slave->data_word($data), $articles_desc);
			$articles_desc=str_replace("{source}", $source, $articles_desc);
			$articles_desc=str_replace("{url}", $url, $articles_desc);
			if (file_exists("uploads/images/articles/$id.jpg")){$articles_desc=str_replace("{img}", "<img src='thumb.php?image=articles/$id.jpg&size=100' align='left' border='0'>", $articles_desc);	}
			if (!file_exists("uploads/images/articles/$id.jpg")){$articles_desc=str_replace("{img}", "", $articles_desc);	}
			$articles_desc=str_replace("{opinion}",$this->show_articles_opinion($articles_id),$articles_desc);
		}
		return $articles_desc;
	}
	//-----------------
	function show_articles_opinion($article_id){$db=new db; $slave=new slave;$dep=$slave->get_dep();list($dep_up,$dep_cur)=$slave->get_file_deps("catalogue");
		$opinion_form_htm=RD."/tpl/articles_opinion_form.htm";if (file_exists("$opinion_form_htm")){ $opinion_form = file_get_contents($opinion_form_htm);}
		$opinion_block_htm=RD."/tpl/articles_opinion_block.htm";if (file_exists("$opinion_block_htm")){ $opinion_block = file_get_contents($opinion_block_htm);}
		$r=$db->query("select * from articles_opinion where article_id='$article_id' order by id asc;");
		$n=$db->num_rows($r);$opinion_list="<table border='0' width='100%'>";
		if ($n==0){$opinion_list.="<tr><th>Пока еще никто не оставил отзыв об этой статье. Вы можете быть первыми</th></tr>";}
		for ($i=1;$i<=$n;$i++){
			$name=$db->result($r,$i-1,"name");
			$desc=$db->result($r,$i-1,"desc");
			$data=$slave->data_word($db->result($r,$i-1,"data"));
			$opinion_list.="<tr><td>$opinion_block</td></tr>";
			
			$opinion_list=str_replace("{name}",$name,$opinion_list);
			$opinion_list=str_replace("{desc}",$desc,$opinion_list);
			$opinion_list=str_replace("{data}",$data,$opinion_list);
			$opinion_list=str_replace("{nomber}",$i,$opinion_list);
		}
		$opinion_list.="</table>";
		$opinion_form=str_replace("{opinion_list}",$opinion_list,$opinion_form);
		$opinion_form=str_replace("{article_id}",$article_id,$opinion_form);
		return $opinion_form;
	}
	
	function save_opinion($article_id,$name,$desc){$db=new db; $slave=new slave;
		$desc=$slave->qq($desc);
		$name=$slave->qq($name);
		$remip=$REMOTE_ADDR;
		$db->query("insert into articles_opinion values ('','$article_id','$name','$desc',CURDATE(),'$remip');");
		return $this->show_articles_opinion($article_id);
	}
	
	function show_3_articles($dep_up,$dep_cur,$header){$db=new db; $slave=new slave;$dep=$slave->get_dep();
//		list($dep_up,$dep_cur)=$slave->get_file_deps("articles");
		$articles_block_htm=RD."/tpl/articles_block.htm";if (file_exists("$articles_block_htm")){ $articles_block = file_get_contents($articles_block_htm);}
		$articles_list="<table align='center' width='98%' border='0' cellpadding=0 cellspacing=0><tr><td class='header2_page'>$header</td></tr><tr valign='top'>";
		$r=$db->query("select * from articles where dep='$dep_cur' order by id desc limit 0,3;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$theme=$db->result($r,$i-1,"theme");
				$caption=$db->result($r,$i-1,"caption");
				$short_desc=$db->result($r,$i-1,"short_desc");
				$data=$db->result($r,$i-1,"data");
					
				$articles_list.="<td width='30%'>$articles_block</td><td width='2%'></td>";
				
					
				$articles_list=str_replace("{caption}", $caption, $articles_list);
				$articles_list=str_replace("{short_desc}", $short_desc, $articles_list);
				$articles_list=str_replace("{data}", $slave->data_word($data), $articles_list);
					
				if (file_exists("uploads/images/articles/$id.jpg")){$articles_list=str_replace("{img}", "<img src='lib/create_thumb.php?image=uploads/images/articles/$id.jpg&size=150' align='left' border='0' hspace=5 vspace=5>", $articles_list);	}
				if (!file_exists("uploads/images/articles/$id.jpg")){$articles_list=str_replace("{img}", "", $articles_list);	}
				$articles_list=str_replace("{url}", "?dep=articles&w=show_articles&dep_up=$dep_up&dep_cur=$dep_cur&theme=$theme&articles_id=$id", $articles_list);
			}
		}
		$articles_list.="</tr></table><br><br>";
		return $articles_list;
	}
	
	function get_theme_caption($theme){
		$db=new db; $slave=new slave;
		$r=$db->query("select caption from articles_theme where id='$theme';");
		$n=$db->num_rows($r);
					
		if ($n==0){return "---";}
		if ($n>0){return $db->result($r,0,"caption");}
	}
	function check_exist_articles($theme){
		$db=new db;
		$r=$db->query("select count(id) as kol from articles where theme='$theme';");
		if ($db->result($r,0,"kol")>0){ return true;}
		if ($db->result($r,0,"kol")==0){ return false;}
	}

}
?>