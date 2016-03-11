<?php

class menu {

	function show_dep_menu($dep_up,$dep_cur){
		$db=new db; $slave=new slave;
		$r=$db->query("select id,caption,file from deps where dep_up='$dep_up' and ison='1' order by id asc;");
		$n=$db->num_rows($r);
		if ($n==0){}
		if ($n>0){
			$dep_menu=$this->show_up_level_menu($dep_up);
			$li_src="<img src='theme/images/pg.gif' border=0>";
			$dep_menu.="<ul id='dep_menu'>";
			for ($i=1;$i<=$n;$i++){
				$caption=$db->result($r,$i-1,"caption");
				$id=$db->result($r,$i-1,"id");
				$file=$db->result($r,$i-1,"file");
				if ($file==""){
					if ($id!=$dep_cur){$dep_menu.="<a href='?dep=page&dep_up=$dep_up&dep_cur=$id'>$li_src<b>$caption</b></a><br>";}
					if ($id==$dep_cur){$dep_menu.="<a href='?dep=page&dep_up=$dep_up&dep_cur=$id'>$li_src<b>$caption</b></a><br>";}
				}
				if ($file!=""){
					if ($id!=$dep_cur){$dep_menu.="<a href='?dep=$file&dep_up=$dep_up&dep_cur=$id'>$li_src<b>$caption</b></a><br>";}
					if ($id==$dep_cur){$dep_menu.="<a href='?dep=$file&dep_up=$dep_up&dep_cur=$id'>$li_src<b>$caption</b></a><br>";}
				}
				if ($id==$dep_cur){ $dep_menu.=$this->show_next_level_menu($dep_cur); }
			}
			$dep_menu.="<br><a href='?dep=page&w=new_dep&dep_up=$dep_up'><img src='theme/images/pg.gif' border=0>Новая страница</a><br>";
			$dep_menu.="</ul>";
		}
		return $dep_menu;
	}
	
	function show_up_level_menu($dep_id){
		$db=new db; $slave=new slave;
		$r=$db->query("select dep_up,caption,file from deps where id='$dep_id' and ison='1';");
		$n=$db->num_rows($r);
		if ($n==0){$next_menu.="<br><a href='?dep=page&w=new_dep&dep_up=$dep_id'><img src='theme/images/pg.gif' border=0>Нова сторінка</a><br>";}
		if ($n>0){
			$li_src="<img src='theme/images/pg.gif' border=0>";
			$caption=$db->result($r,0,"caption");
			$dep_up=$db->result($r,0,"dep_up");
			$file=$db->result($r,0,"file");
			if ($file==""){ $up_menu="<ol><a href='?dep=page&dep_up=$dep_up&dep_cur=$dep_id'>$li_src<b>$caption</b></a></ul>"; }
			if ($file!=""){$up_menu="<ol><a href='?dep=$file&dep_up=$dep_up&dep_cur=$dep_id'>$li_src<b>$caption</b></a></ul>"; }

			if ($id==$dep_cur){ $up_menu=$this->show_up_level_menu($dep_up).$up_menu;}
		}
		return $up_menu;
	}
	
	function show_next_level_menu($dep_cur){
		$db=new db; $slave=new slave;
		$r=$db->query("select id,caption,file from deps where dep_up='$dep_cur' and ison='1' order by id asc;");
		$n=$db->num_rows($r);
		if ($n==0){$next_menu.="<br><a href='?dep=page&w=new_dep&dep_up=$dep_cur'><img src='theme/images/pg.gif' border=0>Нова сторінка</a><br>";}
		if ($n>0){
			$li_src="<img src='theme/images/pg.gif' border=0>";
			$next_menu="<ol>";
			for ($i=1;$i<=$n;$i++){
				$caption=$db->result($r,$i-1,"caption");
				$id=$db->result($r,$i-1,"id");
				$file=$db->result($r,$i-1,"file");
				if ($file==""){
					if ($id!=$dep_cur){$next_menu.="<a href='?dep=page&dep_up=$dep_cur&dep_cur=$id'>$li_src<b>$caption</b></a><br>";}
					if ($id==$dep_cur){$next_menu.="<a href='?dep=page&dep_up=$dep_cur&dep_cur=$id'>$li_src<b>$caption</b></a><br>";}
				}
				if ($file!=""){
					if ($id!=$dep_cur){$next_menu.="<a href='?dep=$file&dep_up=$dep_cur&dep_cur=$id'>$li_src<b>$caption</b></a><br>";}
					if ($id==$dep_cur){$next_menu.="<a href='?dep=$file&dep_up=$dep_cur&dep_cur=$id'>$li_src<b>$caption</b></a><br>";}
				}
				if ($id==$dep_cur){$next_menu=$this->show_next_level_menu($id);}
			}
			$next_menu.="<br><a href='?dep=page&w=new_dep&dep_up=$dep_cur'><img src='theme/images/pg.gif' border=0>Нова сторінка</a><br>";
			$next_menu.="</ul>";
		}
		return $next_menu;
	}
}

?>
