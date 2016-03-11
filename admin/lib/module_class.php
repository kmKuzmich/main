<?php
class module {
	function show_menu($module){$db=new db; $slave=new slave;
		$menu_htm=RD."/tpl/module_menu.htm";if (file_exists("$menu_htm")){ $menu = file_get_contents($menu_htm);}
		
		$r=$db->query("select * from module order by id asc;");
		$n=$db->num_rows($r);$list_menu="<TD width=200 align='center'><a href='?'>Главная</a></TD>";$sub_menu="";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$file=$db->result($r,$i-1,"file");
			if ($file=="0"){$url="#";}if ($file!="0"){$url="?module=$id&file=$file";}
			
			if ($id!=$module){$list_menu.="<TD width=200 align='center' onMouseOver=\"show(this,'submenu$id')\"><a href='$url'>$caption</a></TD>";}
			if ($id==$module){$list_menu.="<TD width=200 align='center' onMouseOver=\"show(this,'submenu$id')\" bgcolor='#e7e7e7'><a href='$url'>$caption</a></TD>";}
			$sub_menu.=$this->show_sub_menu($id);
		}
		$list_menu.="<TD width=200 align='center'><a href='?exit=true'>Выход</a></TD>";
		
		$menu=str_replace("{menu_list}", $list_menu, $menu);
		$menu=str_replace("{sub_menu}", $sub_menu, $menu);
		return $menu;
	}
	function show_sub_menu($module){
		$db=new db; $slave=new slave;
		$r=$db->query("select mp.id,mp.caption,mf.file from module_pages mp inner join module_files mf on (mf.id=mp.file) where mp.module='$module' order by mp.id asc;");
		$n=$db->num_rows($r);$menu="";
		if ($n>0){
			$menu="
			<DIV ID='submenu$module' STYLE='LEFT: -1000px;OVERFLOW: hidden;POSITION: absolute;TOP: -1000px;' onMouseOut='hidemenu()' onMouseOver='cancelhide()'>
			<table cellpadding=1 cellspacing=0 BORDER=0 width=200 bgcolor='#ffffff'>";
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				$file=$db->result($r,$i-1,"file");
				if ($file=="0"){$url="#";}if ($file!="0"){$url="?module=$module&module_page=$id&file=$file";}
				$menu.="<tr><td width='100%'><a href='$url'>$caption</a></td></tr>";
			}
			$menu.="</table></DIV>";
		}
		return $menu;
	}
	function get_module_caption($module){
		$db=new db;
		$r=$db->query("select caption from module where id='$module';");
		$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"caption");}
		if ($n==0){ return "";}
	}
	function get_module_file($file,$var){
		$db=new db;
		if ($var==1){ $r=$db->query("select file from module_files where id='$file';");}
		if ($var==2){ $r=$db->query("select file from module_files where file='$file';");}
		$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"file");}
		if ($n==0){ return "";}
	}
	function get_module_file_cap($file){
		$db=new db;
		$r=$db->query("select caption from module_files where id='$file';");
		$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"caption");}
		if ($n==0){ return "";}
	}
	function show_file_form($file){
		$db=new db;
		$r=$db->query("select * from module_files where system='1' order by id asc;");
		$n=$db->num_rows($r);
		$form="<select name='dep_file' id='dep_file' size=1 style='width:400px;'>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			if ($id==$file){ $form.="<option value='$id' selected>$caption</option>";}
			if ($id!=$file){ $form.="<option value='$id'>$caption</option>";}
		}
		$form.="</form>";
		return $form;
	}
	
	function get_url(){
		$url=$_SERVER["QUERY_STRING"];
		if (stristr($url,"&dep_up=")){ $url=ereg_replace("&dep_up=([0-9])*","",$url); }
		if (stristr($url,"&dep_cur=")){ $url=ereg_replace("&dep_cur=([0-9])*","",$url); }	
		if (stristr($url,"&cur_id=")){ $url=ereg_replace("&cur_id=([0-9])*","",$url); }	
		if (stristr($url,"&w=")){ $url=ereg_replace("&w=([a-z_])*","",$url); }	
		return $url;
	}
	
	function get_file_url(){
		$url=$_SERVER["QUERY_STRING"];
		if (stristr($url,"&wn=")){ $url=ereg_replace("&wn=([a-z0-9_])*","",$url); }
		if (stristr($url,"&w=")){ $url=ereg_replace("&w=([a-z0-9_])*","",$url); }
		if (stristr($url,"&conf=")){ $url=ereg_replace("&conf=([a-z_])*","",$url); }
		if (stristr($url,"&news_id=")){ $url=ereg_replace("&news_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&articles_id=")){ $url=ereg_replace("&articles_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&review_id=")){ $url=ereg_replace("&review_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&gdep=")){ $url=ereg_replace("&gdep=([a-z0-9_])*","",$url); }
		if (stristr($url,"&theme=")){ $url=ereg_replace("&theme=([a-z0-9_])*","",$url); }
		if (stristr($url,"&theme_id=")){ $url=ereg_replace("&theme_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&forum_id=")){ $url=ereg_replace("&forum_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&answer_id=")){ $url=ereg_replace("&answer_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&person=")){ $url=ereg_replace("&person=([a-z0-9_])*","",$url); }
		if (stristr($url,"&blog_dep=")){ $url=ereg_replace("&blog_dep=([a-z0-9_])*","",$url); }
		if (stristr($url,"&opinion_id=")){ $url=ereg_replace("&opinion_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&documents_id=")){ $url=ereg_replace("&documents_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&foto_id=")){ $url=ereg_replace("&foto_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&test_id=")){ $url=ereg_replace("&test_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&var=")){ $url=ereg_replace("&var=([a-z0-9_])*","",$url); }
		if (stristr($url,"&cat_id=")){ $url=ereg_replace("&cat_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&top_id=")){ $url=ereg_replace("&top_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&type_id=")){ $url=ereg_replace("&type_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&param_id=")){ $url=ereg_replace("&param_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&model=")){ $url=ereg_replace("&model=([a-z0-9_])*","",$url); }
	
		if (stristr($url,"&client_id=")){ $url=ereg_replace("&client_id=([a-z0-9_])*","",$url); }
		if (stristr($url,"&users_id=")){ $url=ereg_replace("&users_id=([a-z0-9_])*","",$url); }
		return $url;
	}
}
?>