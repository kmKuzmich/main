<?php

class review {
	function show_main_page_review(){$db=new db; $slave=new slave;$dep=$slave->get_dep();list($dep_up,$dep_cur)=$slave->get_file_deps("review");
		$review_block_htm=RD."/tpl/review_block.htm";if (file_exists("$review_block_htm")){ $review_block = file_get_contents($review_block_htm);}
		
		$review_list="<table align='center' width='100%' border='0' cellpadding=0 cellspacing=0>
		<tr><td height='37'>".$slave->show_head("Обзоры, тесты")."</td></tr>";
		$r=$db->query("select * from review order by id desc limit 0,10;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$short_desc=$db->result($r,$i-1,"short_desc");
				$data=$db->result($r,$i-1,"data");
				$caption=$db->result($r,$i-1,"caption");
				
				$review_list.="<td>$review_block</td>";
				if ($i<$n){$review_list.="<tr><td width='5'></td></tr>";}
				
				$review_list=str_replace("{caption}", $caption, $review_list);
				$review_list=str_replace("{short_desc}", $short_desc, $review_list);
				$review_list=str_replace("{data}", $slave->data_word($data), $review_list);
				
				if (file_exists("uploads/images/review/$id.jpg")){$review_list=str_replace("{pic}", "<img src='thumb.php?image=review/$id.jpg&size=100' border='3' align='left' hspace='2' vspace=2>", $review_list);	}
				if (!file_exists("uploads/images/review/$id.jpg")){$review_list=str_replace("{pic}", "", $review_list);	}
				$review_list=str_replace("{url}", "?dep=review&w=show_review&dep_up=$dep_up&dep_cur=$dep_cur&review_id=$id", $review_list);
			}
		}
		$review_list.="</table>";
		return $review_list;
	}
	function show_review($year){$db=new db; $slave=new slave;list($dep_up,$dep_cur)=$slave->get_file_deps("review");
		$review_list_htm=RD."/tpl/review_list.htm";if (file_exists("$review_list_htm")){ $review_block = file_get_contents($review_list_htm);}
		$review_list="<table width='100%' id='review' border='0'>";
		$dep=$slave->get_dep();
		if ($year!=""){
			$where="where data>='$year-01-01' and data<='$year-12-31'";
			//$review_list="<tr><td><h3>за $year год</h3></td></tr>";
		}
		$r=$db->query("select * from review $where order by id desc;");$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$short_desc=$db->result($r,$i-1,"short_desc");
				$data=$db->result($r,$i-1,"data");
				
				$review_list.="<tr><td>$review_block</td></tr>";
								
				$review_list=str_replace("{caption}", $caption, $review_list);
				$review_list=str_replace("{short_desc}", $short_desc, $review_list);
				$review_list=str_replace("{data}", $slave->data_word($data), $review_list);
				if (file_exists("uploads/images/review/$id.jpg")){$review_list=str_replace("{pic}", "<img src='thumb.php?image=review/$id.jpg&size=100' border='3' align='left' hspace='2' vspace=2>", $review_list);	}
				if (!file_exists("uploads/images/review/$id.jpg")){$review_list=str_replace("{pic}", "", $review_list);	}
				
				$review_list=str_replace("{url}", "?dep=review&w=show_review&dep_up=$dep_up&dep_cur=$dep_cur&review_id=$id", $review_list);
			}
		}
		$review_list.="</table>";
		return $review_list;
	}
	function show_review_desc($review_id){$db=new db; $slave=new slave;
		$review_desc_htm=RD."/tpl/review_desc.htm";if (file_exists("$review_desc_htm")){ $review_block = file_get_contents($review_desc_htm);}
		
		$dep=$slave->get_dep();
		$r=$db->query("select * from review where id='$review_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$id=$db->result($r,0,"id");
			$caption=$db->result($r,0,"caption");
			$desc=$db->result($r,0,"desc");
			$data=$db->result($r,0,"data");
			$author=$db->result($r,0,"author");
			$review_block=str_replace("{caption}", $caption, $review_block);
			$review_block=str_replace("{desc}", $desc, $review_block);
			$review_block=str_replace("{author}", $author, $review_block);
			$review_block=str_replace("{data}", $slave->data_word($data), $review_block);
			$review_block=str_replace("{img}", "<img align='left' hspace='10' vspace='10' src='thumb.php?image=review/$review_id.jpg&size=350' border='0'>", $review_block);
		}
		return $review_block;
	}
	
	function show_review_list($review_id,$dep_up,$dep_cur){
		$db=new db; $slave=new slave;$dep=$slave->get_dep();
		list($dep_up,$dep_cur)=$slave->get_file_deps("review");
		$review_block_htm=RD."/tpl/review_block.htm";if (file_exists("$review_block_htm")){ $review_block = file_get_contents($review_block_htm);}
		
		$review_list="<h3>Обзоры</h3><table align='center' width='98%' border='0' cellpadding=0 cellspacing=0>";
		$r=$db->query("select * from review order by id desc;");
		$n=$db->num_rows($r);if ($count!="" and $count<=$n){$n=$count;}
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				if ($review_id!=$id){
					$caption=$db->result($r,$i-1,"caption");
					$short_desc=$db->result($r,$i-1,"short_desc");
					$data=$db->result($r,$i-1,"data");
					
					$review_list.="<tr valign='top'><td>$review_block</td></tr><tr><td background='uploads/images/general/hr.gif' style='background-repeat:repeat-x;' height='5'></td></tr>";
					
					$review_list=str_replace("{caption}", $caption, $review_list);
					$review_list=str_replace("{short_desc}", $short_desc, $review_list);
					$review_list=str_replace("{data}", $slave->data_word($data), $review_list);
					
					if (file_exists("uploads/images/review/$id.jpg")){$review_list=str_replace("{pic}", "<img src='thumb.php?image=review/$id.jpg&size=100' border='3'>", $review_list);	}
					if (!file_exists("uploads/images/review/$id.jpg")){$review_list=str_replace("{pic}", "", $review_list);	}
					$review_list=str_replace("{url}", "?dep=review&w=show_review&dep_up=$dep_up&dep_cur=$dep_cur&review_id=$id", $review_list);
				}
			}
		}
		$review_list.="</table><br>";
		return $review_list;
	}
	
	function show_3_review($header){
		$db=new db; $slave=new slave;$dep=$slave->get_dep();
		list($dep_up,$dep_cur)=$slave->get_file_deps("review");
		$review_block_htm=RD."/tpl/review_block.htm";
		if (!file_exists("$review_block_htm")){ $review_block="Не знайдено файл шаблону"; }
		if (file_exists("$review_block_htm")){ $review_block = file_get_contents($review_block_htm);}
		
		$review_list="<table align='center' id='page' width='98%' border='0' cellpadding=0 cellspacing=0><tr><td class='header2_page'>$header</td></tr>";
		$r=$db->query("select * from review $where order by id desc limit 0,3;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				if ($review_id!=$id){
					$short_desc=$db->result($r,$i-1,"short_desc");
					$data=$db->result($r,$i-1,"data");
					
					$review_list.="<tr valign='top'><td>$review_block</td></tr>";
					
					$review_list=str_replace("{caption}", $caption, $review_list);
					$review_list=str_replace("{short_desc}", $short_desc, $review_list);
					$review_list=str_replace("{data}", $slave->data_word($data), $review_list);
					
					if (file_exists("uploads/images/review/$id.jpg")){$review_list=str_replace("{pic}", "<img src='uploads/images/review/$id.jpg&size=100' border='3'>", $review_list);	}
					if (!file_exists("uploads/images/review/$id.jpg")){$review_list=str_replace("{pic}", "", $review_list);	}
					$review_list=str_replace("{url}", "?dep=review&w=show_review&dep_up=$dep_up&dep_cur=$dep_cur&review_id=$id", $review_list);
				}
			}
		}
		$review_list.="
		</table><br><br>";
		return $review_list;
	}
	
	function review_exists($year){
		$db=new db;$data_from="$year-01-01";$data_to="$year-12-31";
		$r=$db->query("select count(id) as col from review where data>='$data_from' and data<='$data_to';");
		$col=$db->result($r,0,"col");
		if ($col==0){ return false;}
		if ($col>0){ return true;}
	}
	
	function get_first_review_year(){
		$db=new db;
		$r=$db->query("select min(data) as data from review limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){
			$data=$db->result($r,0,"data");
			$year=substr($data,0,4);
		}
		return $year;
	}
	
	function show_archive(){
		$db=new db; $slave=new slave;$dep=$slave->get_dep();$dep_up=$slave->get_dep_up();$dep_cur=$slave->get_dep_cur();
		$cur_year=date("Y");$get_year=$_GET["year"];
		$first_review_year=$this->get_first_review_year();
		for ($y=$cur_year; $y>=$first_review_year;$y--){
			if ($this->review_exists($y)){
				if ($y!=$get_year){$archive.="<a href='?dep=$dep&year=$y&dep_up=$dep_up&dep_cur=$dep_cur'>$y</a> ";}
				if ($y==$get_year){$archive.="<span class='selected'>$y</span> ";}
			}
		}
		return $archive;
	}
}
?>
