<?php
class news {
	function show_main_page_news(){$db=new db; $slave=new slave; $dep="news";list($dep_up,$dep_cur)=$slave->get_file_deps($dep);
		$news_htm=RD."/tpl/news_list_main.htm";	if (!file_exists("$news_htm")){ $form=""; }	if (file_exists("$news_htm")){ $form = file_get_contents($news_htm);}
		$r=$db->query_lider("select * from news order by data desc limit 0,20;");$n=$db->num_rows($r);
		if ($n>0){$k=0;$list="";
			for ($i=1;$i<=$n;$i++){$k++;
				if ($k==1){$list.="<li>";}
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption_ru");
				$short_desc=$db->result($r,$i-1,"short_desc_ru");
				$data=$db->result($r,$i-1,"data");
				$list.="<div class='news_form'>$form</div>"; 
				$list=str_replace("{caption}", $caption, $list);
				$list=str_replace("{short_desc}", $short_desc, $list);
				$list=str_replace("{data}", $slave->data_word($data), $list);
				$list=str_replace("{pic}", "<img src='http://www.avtolider-ua.com/thumb.php?image=news/$id.jpg&size=105' border='0'  align='right' hspace='5' vspace='5'>", $list);
				$list=str_replace("{url}", "?dep=2&w=show_news&dep_up=$dep_up&dep_cur=$dep_cur&news_id=$id", $list);
				if ($k==4){$list.="</li>";$k=0;}
			}
			if ($k>=1 and $k<=4){$list.="</li>";$k=0;}
		}
		return $list;
	}
	
	function show_range_news(){$db=new db; $slave=new slave;$dep="news"; list($dep_up,$dep_cur)=$slave->get_file_deps($dep);
		$bside_htm=RD."/tpl/bottom_slide.htm";$form="";if (file_exists("$bside_htm")){ $form = file_get_contents($bside_htm);}
		$news_htm=RD."/tpl/news_list_range.htm";$block="";if (file_exists("$news_htm")){ $block = file_get_contents($news_htm);}
		$r=$db->query_lider("select * from news order by data desc limit 0,20;");$n=$db->num_rows($r);$list="";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption_ru");
			$short_desc=$db->result($r,$i-1,"short_desc_ru");
			$data=$db->result($r,$i-1,"data");
			$list.="<li>$block</li>"; 
			$list=str_replace("{caption}", $caption, $list);
			$list=str_replace("{short_desc}", $short_desc, $list);
			$list=str_replace("{data}", $slave->data_word($data), $list);
			$list=str_replace("{pic}", "<img src='http://www.avtolider-ua.com/thumb.php?image=news/$id.jpg&size=80' class='newsImg' border='0'  align='left' hspace='5' vspace='5'>", $list);
			$list=str_replace("{url}", "?dep=$dep&w=show_news&dep_up=$dep_up&dep_cur=$dep_cur&news_id=$id", $list);
		}
		$form=str_replace("{bottom_slide_caption}","<div style='margin-left:15px; margin-top:-15px;'>&nbsp;Новости<br />Компании</div>",$form);
		$form=str_replace("{bottom_slide}",$list,$form);
		return $form;
	}
	function show_short_list($news_id){ $db=new db; $slave=new slave;$dep="news";$news_list="";	list($dep_up,$dep_cur)=$slave->get_file_deps($dep);
		$form_htm=RD."/tpl/news_list.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query_lider("select * from news where id!='$news_id' order by data desc limit 0,6;");$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption_ru");
				$short_desc=$db->result($r,$i-1,"short_desc_ru");
				$data=$db->result($r,$i-1,"data");
				$news_list.=$form;
				$news_list=str_replace("{caption}", $caption, $news_list);
				$news_list=str_replace("{short_desc}", "", $news_list);
				$news_list=str_replace("{data}", $slave->data_word($data), $news_list);
				
				$news_list=str_replace("{pic}", "<img src='http://www.avtolider-ua.com/thumb.php?image=news/$id.jpg&size=45' border='1' align='left' class='newsImg' hspace='5' vspace='5'>", $news_list);
				$news_list=str_replace("{url}", "?dep=$dep&w=show_news&dep_up=$dep_up&dep_cur=$dep_cur&news_id=$id", $news_list);
				$news_list=str_replace("class=\"dotted\"", "class=\"dotted_s\"", $news_list);
			}
		}
		$news_list.="</ol>";
		return $news_list;
	}
	function show_list($data){ $db=new db; $slave=new slave;$dep="news";list($dep_up,$dep_cur)=$slave->get_file_deps($dep);
		$form_htm=RD."/tpl/news_list.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$news_list="<table align='center' width='98%' border='0'>";
		$where="";if ($data!=""){$where=" where data='$data' ";}
		$r=$db->query_lider("select * from news $where order by data desc limit 0,50;");$n=$db->num_rows($r);
		if ($n==0){
			$news_list.="<tr><td align='center'><h3>Новостей за $data не найдено</h3></td><tr>";
			$where="";if ($data!=""){$where=" where data<='$data' ";}
			$r=$db->query_lider("select * from news $where order by data desc limit 0,50;");$n=$db->num_rows($r);
			if ($n>0){$news_list.="<tr><td><h4>Новости ранее $data</h4></td><tr>";}
		}
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption_ru");
				$short_desc=$db->result($r,$i-1,"short_desc_ru");
				$data=$db->result($r,$i-1,"data");
				$news_list.="<tr><td>$form</td><tr>";
				$news_list=str_replace("{caption}", $caption, $news_list);
				$news_list=str_replace("{short_desc}", $short_desc, $news_list);
				$news_list=str_replace("{data}", $slave->data_word($data), $news_list);
				
				$news_list=str_replace("{pic}", "<img src='http://www.avtolider-ua.com/thumb.php?image=news/$id.jpg&size=90' border='1' align='left' class='newsImg' hspace='5' vspace='5'>", $news_list);
				$news_list=str_replace("{url}", "?dep=$dep&w=show_news&dep_up=$dep_up&dep_cur=$dep_cur&news_id=$id", $news_list);
			}
		}
		$news_list.="</table>";
		return $news_list;
	}
	
	function show_desc($news_id){$db=new db; $slave=new slave;$dep="news";list($dep_up,$dep_cur)=$slave->get_file_deps($dep);
		$form_htm=RD."/tpl/news_desc.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query_lider("select * from news where id='$news_id';");$n=$db->num_rows($r);
		if ($n>0){
			$id=$db->result($r,0,"id");
			$caption=$db->result($r,0,"caption_ru");
			$desc=$db->result($r,0,"desc_ru");
			$data=$db->result($r,0,"data");
			$author=$db->result($r,0,"author_ru");
		}
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $desc, $form);
		$form=str_replace("{author}", $author, $form);
		$form=str_replace("{data}", $slave->data_word($data), $form);
		$form=str_replace("../uploads/images/","/uploads/images/",$form);
		$form=str_replace("\"/uploads/images/","\"http://www.avtolider-ua.com/uploads/images/",$form);
		$form=str_replace("'/uploads/images/","'http://www.avtolider-ua.com/uploads/images/",$form);
		$form=str_replace("../uploads/files/","/uploads/files/",$form);
		$form=str_replace("/uploads/files/","http://www.avtolider-ua.com/uploads/files/",$form);
		return $form;
	}
}
?>