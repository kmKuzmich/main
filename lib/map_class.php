<?php

class map {
	function show_map(){
		$db=new db; $slave=new slave;
		$r=$db->query("select id,caption,file from deps where dep_up='0' and ison='1' and visible='1' order by lenta,id asc;");
		$n=$db->num_rows($r);
		if ($n>0){$kol=5;
			$dep_menu.="<table width='100%' border=0 id='map'>";$k=0;
			$li_src="theme/images/li2.jpg";
			for ($i=1;$i<=$n;$i++){$k++;
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$file=$db->result($r,$i-1,"file");if ($file==""){$file="page";}
				$link="<img src='$li_src'> <a class='caption' href='?dep=$file&dep_up=$dep_up&dep_cur=$id'>$caption</a><p>";
				$link.=$this->show_next_level_map($id,$file);
				if ($k==1){ $dep_menu.="<tr valign='top'><td width='20%'>$link</td>"; }
				if ($k>1 and $k<$kol){ $dep_menu.="<td width='20%'>$link</td>";}
				if ($k==$kol){ $dep_menu.="<td width='20%'>$link</td></tr><tr><td height='20px'>&nbsp;</td></tr>"; $k=0; }
			}
			if ($k<4){$dep_menu.="</tr>";}
			$dep_menu.="</table>";
		}
		return $dep_menu;
	}
	
	function show_next_level_map($dep_cur,$file){
		$db=new db; $slave=new slave;
		$r=$db->query("select id,caption,file from deps where dep_up='$dep_cur' and ison='1' and visible='1'  order by lenta,id asc;");
		$n=$db->num_rows($r);
		if ($n>0){
			$li_src="theme/images/li2.jpg";
			$next_menu="<p><p><ol>";
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$file=$db->result($r,$i-1,"file");if ($file==""){$file="page";}
				$next_menu.="<img src='$li_src'> <a class='next' href='?dep=$file&dep_up=$dep_cur&dep_cur=$id'>$caption</a><p>";
				$next_menu.=$this->show_next_level_map($id,$file);
			}
			$next_menu.="</ol><p><p>";
		}
		return $next_menu;
	}
}
?>
