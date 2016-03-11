<?php
class page {
	function show_dep_desc($dep_up,$dep_cur){
		$db=new db; $slave=new slave;
		$dep_show_htm=RD."/tpl/dep_show.htm";
		if (!file_exists("$dep_show_htm")){ $page_show="Не знайдено файл шаблону"; }
		if (file_exists("$dep_show_htm")){ $page_show = file_get_contents($dep_show_htm);}
		
		$dep=$slave->get_dep();
		$r=$db->query("select * from deps where id='$dep_cur';");
		$n=$db->num_rows($r);
		if ($n==0){return "page not found 404";}
		if ($n>0){
			$caption=$db->result($r,0,"caption");
			$desc=$db->result($r,0,"desc");
			$key_words=$db->result($r,0,"key_words");
			$description=$db->result($r,0,"description");
			$file=$db->result($r,0,"file");
			$lenta=$db->result($r,0,"lenta");
			$hot_line=$db->result($r,0,"hot_line");
			$visible=$db->result($r,0,"visible");
		}
		
		$page_show=str_replace("{caption}", $caption, $page_show);
		$page_show=str_replace("{desc}", $desc, $page_show);
		$page_show=str_replace("{description}", $description, $page_show);
		$page_show=str_replace("{key_words}", $key_words, $page_show);
		$page_show=str_replace("{file}", $file, $page_show);
		$page_show=str_replace("{lenta}", $lenta, $page_show);
		if ($visible=="0"){$page_show=str_replace("{visible}", "Ні", $page_show);}if ($visible=="1"){$page_show=str_replace("{visible}", " Так", $page_show);}
		if ($hot_line=="0"){$page_show=str_replace("{hot_line}", "Ні", $page_show);}if ($hot_line=="1"){$page_show=str_replace("{hot_line}", " Так", $page_show);}
		$edit_url="window.location.href='?dep=$dep&w=edit_dep&dep_up=$dep_up&dep_cur=$dep_cur'";
		$del_url="if(confirm('Удалить страницу?')){ window.location.href='?dep=$dep&w=delete_dep&dep_up=$dep_up&dep_cur=$dep_cur'}";
		$page_show=str_replace("{edit_url}", $edit_url, $page_show);
		$page_show=str_replace("{del_url}",  $del_url, $page_show); 
		return $page_show;
	}
	function show_dep_form($dep_up){
		$db=new db; $slave=new slave;
		$dep_form_htm=RD."/tpl/dep_form.htm";
		if (!file_exists("$dep_form_htm")){ $page_form="Не знайдено файл шаблону"; }
		if (file_exists("$dep_form_htm")){ $page_form = file_get_contents($dep_form_htm);}
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc") ;
		$editor->BasePath = "../fckeditor/";
		$editor->Lang = "ua";
		$editor->Value	= "" ;

		
		$page_form=str_replace("{dep}", $slave->get_dep(), $page_form);
		$page_form=str_replace("{w}", $slave->get_w(), $page_form);
		$page_form=str_replace("{dep_up}", $dep_up, $page_form);
		
		$page_form=str_replace("{caption}", "", $page_form);
		$page_form=str_replace("{desc}", $editor->Create(), $page_form);
		$page_form=str_replace("{description}", "", $page_form);
		$page_form=str_replace("{key_words}", "", $page_form);
		$page_form=str_replace("{file}", "", $page_form);
		$page_form=str_replace("{lenta}", "99999", $page_form);
		
		$page_form=str_replace("{selected_yes}", "checked", $page_form);
		$page_form=str_replace("{selected_no}", "", $page_form);
		$page_form=str_replace("{hot_line_yes}", "", $page_form);
		$page_form=str_replace("{hot_line_no}", "checked", $page_form);
		return $page_form;
	}
	
	function add_dep_form(){
		$db=new db; $slave=new slave;
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		$description=$slave->qq($_POST["description"]);
		$key_words=$slave->qq($_POST["key_words"]);
		$file=$slave->qq($_POST["file"]);
		$lenta=$slave->qq($_POST["lenta"]);
		$dep_up=$slave->qq($_POST["dep_up"]);
		$visible=$slave->qq($_POST["visible"]);
		$hot_line=$slave->qq($_POST["hot_line"]);
		
		$r=$db->query("select max(id) as mid from deps;");	
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into deps values ('$mid','$dep_up','$caption','$desc','$key_words','$description','$file','$lenta','$hot_line','$visible','1');");
		return $mid;	
	}
	function edit_dep_form($dep_up,$dep_cur){
		$db=new db; $slave=new slave;
		$dep_form_htm=RD."/tpl/dep_form.htm";
		if (!file_exists("$dep_form_htm")){ $page_form="Не знайдено файл шаблону"; }
		if (file_exists("$dep_form_htm")){ $page_form = file_get_contents($dep_form_htm);}
		
		$r=$db->query("select * from deps where id='$dep_cur';");
		$n=$db->num_rows($r);
		if ($n==0){$page_form="Страница не найдена";}
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$desc=$slave->qqback($db->result($r,0,"desc"));
			$description=$slave->qqback($db->result($r,0,"description"));
			$key_words=$slave->qqback($db->result($r,0,"key_words"));
			$file=$slave->qqback($db->result($r,0,"file"));
			$lenta=$slave->qqback($db->result($r,0,"lenta"));
			$dep_up=$slave->qqback($db->result($r,0,"dep_up"));
			$visible=$slave->qqback($db->result($r,0,"visible"));
			$hot_line=$slave->qqback($db->result($r,0,"hot_line"));
		}
		
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc") ;
		$editor->BasePath = "../fckeditor/";
		$editor->Lang = "ua";
		$editor->Value	= "$desc" ;
		
		$page_form=str_replace("{dep}", $slave->get_dep(), $page_form);
		$page_form=str_replace("{w}", $slave->get_w(), $page_form);
		$page_form=str_replace("{dep_up}", $dep_up, $page_form);
		$page_form=str_replace("{dep_cur}", $dep_cur, $page_form);
		
		$page_form=str_replace("{caption}", $caption, $page_form);
		$page_form=str_replace("{desc}", $editor->Create(), $page_form);
		$page_form=str_replace("{description}", $description, $page_form);
		$page_form=str_replace("{key_words}", $key_words, $page_form);
		$page_form=str_replace("{file}", $file, $page_form);
		$page_form=str_replace("{lenta}", $lenta, $page_form);
		
		if ($visible=="0"){$page_form=str_replace("{selected_yes}", "", $page_form);$page_form=str_replace("{selected_no}", "checked", $page_form);}
		if ($visible=="1"){$page_form=str_replace("{selected_no}", "", $page_form);$page_form=str_replace("{selected_yes}", "checked", $page_form);}
		if ($hot_line=="0"){$page_form=str_replace("{hot_line_yes}", "", $page_form);$page_form=str_replace("{hot_line_no}", "checked", $page_form);}
		if ($hot_line=="1"){$page_form=str_replace("{hot_line_no}", "", $page_form);$page_form=str_replace("{hot_line_yes}", "checked", $page_form);}
		return $page_form;
	}
	
	function save_dep_form(){
		$db=new db; $slave=new slave;
		$dep_up=$slave->qq($_POST["dep_up"]);
		$dep_cur=$slave->qq($_POST["dep_cur"]);
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		$description=$slave->qq($_POST["description"]);
		$key_words=$slave->qq($_POST["key_words"]);
		$file=$slave->qq($_POST["file"]);
		$lenta=$slave->qq($_POST["lenta"]);
		$visible=$slave->qq($_POST["visible"]);
		$hot_line=$slave->qq($_POST["hot_line"]);
		
		$db->query("update deps set caption='$caption', `desc`='$desc', description='$description', key_words='$key_words', file='$file', lenta='$lenta', visible='$visible', hot_line='$hot_line' where id='$dep_cur';");
		return $dep_cur;
	}
	function delete_dep_form($dep_cur){
		$db=new db;
		$db->query("delete from deps where id='$dep_cur';");
		return;
	}
	
}
?>
