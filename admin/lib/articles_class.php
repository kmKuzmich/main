<?php

class articles {
	function show_theme_list(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$form_htm=RD."/tpl/articles_theme_list.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($news_up==""){$news_up=0;}
		$r=$db->query("select * from articles_theme order by caption asc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");

			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$operations="
			<a href='?$url&wn=edit_theme&theme_id=$id'><img src='images/edit.png' border=0 alt='Редактировать тему' title='Редактировать тему'></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Удалить тему?')){ window.location.href='?$url&wn=delete_theme&theme_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Удалить тему' title='Удалить тему'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; <a href='?$url&wn=list_articles&theme_id=$id'>$caption</a></td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Тем статей не найдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation(""),$form);
		$form=str_replace("{articles_menu}",$this->articles_menu(""),$form);
		return $form;
	}
	
	function show_arttheme_form($art_id){
		$db=new db;
		$r=$db->query("select * from articles_theme order by id asc;");
		$n=$db->num_rows($r);
		$form="<select size=1 name='articles'>";
		for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$caption=$db->result($r,$i-1,"caption");
				if ($art_id==$id){ $form.="<option value='$id' selected>$caption</option>";}
				if ($art_id!=$id){ $form.="<option value='$id'>$caption</option>";}
		}
		$form.="</select>";;
		return $form;
	}
//----------------------------------------------------------------------------------------------------------------------------

	function show_theme_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/articles_theme_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{theme_id}", $theme_id, $form);
		
		$form=str_replace("{wcap}", "Новая тема статьи", $form);
		$form=str_replace("{caption}", "", $form);
		return $form;
	}
	
	function add_theme_form(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$caption=$slave->qq($_POST["caption"]);
				
		$r=$db->query("select max(id) as mid from articles_theme;");	
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into articles_theme values ('$mid','$caption');");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Тему статьи &quot;$caption&quot; успешно добавлено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку тем",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;	
	}
	function edit_theme_form($theme_id){
		$db=new db; $slave=new slave;
		$form_htm=RD."/tpl/articles_theme_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from articles_theme where id='$theme_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
		}

		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{theme_id}", $theme_id, $form);
		
		$form=str_replace("{wcap}", "Редактировать тему статьи", $form);
		$form=str_replace("{caption}", $caption, $form);
		return $form;
	}
	
	function save_theme_form(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$theme_id=$_POST["theme_id"]; $caption=$slave->qq($_POST["caption"]);
		
		$db->query("update articles_theme set caption='$caption' where id='$theme_id';");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Тему статьи &quot;$caption&quot; успешно сохранено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку тем",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	function delete_theme_form($theme_id){
		$db=new db;$mdl=new module;$url=$mdl->get_file_url();
		$db->query("delete from articles_theme where id='$theme_id';");
		$db->query("delete from articles where theme='$theme_id';");

		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Тему и статьи успешно удалено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку тем",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	
	
	function get_theme_caption($theme){
		$db=new db; $slave=new slave;
		$r=$db->query("select caption from articles_theme where id='$theme';");
		$n=$db->num_rows($r);
					
		if ($n==0){return "---";}
		if ($n>0){return $db->result($r,0,"caption");}
	}
	
	//###################################################################################
	function show_articles_list($theme_id){
		$db=new db; $slave=new slave;$mdl=new module;$url_m=$mdl->get_file_url();
		$form_htm=RD."/tpl/articles_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($news_up==""){$news_up=0;}
		$r=$db->query("select * from articles where theme='$theme_id' order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$data=$db->result($r,$i-1,"data");
			$cource=$db->result($r,$i-1,"source");
			$url=$db->result($r,$i-1,"url");
			$author=$db->result($r,$i-1,"author");

			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$operations="
			<a href='?$url_m&wn=edit_articles&theme_id=$theme_id&articles_id=$id'><img src='images/edit.png' border=0 alt='Редактировать статью' title='Редактировать статью'></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Удалить статью?')){ window.location.href='?$url_m&wn=delete_articles&theme_id=$theme_id&articles_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Удалить статью' title='Удалить статью'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; $caption</td>
				<td align='center'>$data</td>
				<td>$author</td>
				<td>$url</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Статей не найдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation($theme_id),$form);
		$form=str_replace("{articles_menu}",$this->articles_menu($theme_id),$form);
		return $form;
	}	
	
//----------------------------------------------------------------------------------------------------------------------------

function show_articles_form($theme_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/articles_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc_form") ;
		$editor->BasePath = "../fckeditor/";
		$editor->Lang = "ru";
		$editor->Value	= "" ;
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{theme_id}", $theme_id, $form);
		$form=str_replace("{articles_id}", $articles_id, $form);
		
		$form=str_replace("{wcap}", "Новая статья", $form);
		$form=str_replace("{theme_caption}", $this->get_theme_caption($theme_id), $form);
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{short_desc}", $short_desc, $form);
		$form=str_replace("{desc_form}", $editor->Create(), $form);
		$form=str_replace("{author}", $author, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{source}", $source, $form);
		$form=str_replace("{url}", $url, $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		return $form;
	}
	
	function add_articles_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		
		$theme_id=$slave->qq($_POST["theme_id"]);
		$caption=$slave->qq($_POST["caption"]);$short_desc=$slave->qq($_POST["short_desc"]);$desc_form=$slave->qq($_POST["desc_form"]);
		$author=$slave->qq($_POST["author"]);$data=$slave->qq($_POST["data"]);$source=$slave->qq($_POST["source"]);$url=$slave->qq($_POST["url"]);
				
		$r=$db->query("select max(id) as mid from articles;");	
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into articles values ('$mid','$theme_id','$caption','$short_desc','$desc_form','$author','$source','$url','$data');");
		
		if ($_FILES["pic"]!=""){
			if (is_uploaded_file($_FILES["pic"]['tmp_name'])){ chmod ($_FILES["pic"]['tmp_name'], 0755);
				if (file_exists("../uploads/images/articles/$mid.jpg")){ unlink("../uploads/images/articles/$mid.jpg"); }
				move_uploaded_file($_FILES["pic"]['tmp_name'],"../uploads/images/articles/$mid.jpg");
				$slave->resizeimage("$mid.jpg","205","../uploads/images/articles/","");
			}
		}
		$url=$mdl->get_file_url();
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Статью &quot;$caption&quot; успешно добавлено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку статей",$form);
		$form=str_replace("{back_url}","?$url&wn=list_articles&theme_id=$theme_id",$form);
		return $form;
	}
	function edit_articles_form($theme_id,$articles_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/articles_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from articles where id='$articles_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$short_desc=$slave->qqback($db->result($r,0,"short_desc"));
			$desc=$slave->qqback($db->result($r,0,"desc"));
			$author=$slave->qqback($db->result($r,0,"author"));
			$data=$db->result($r,0,"data");
			$source=$db->result($r,0,"source");
			$url=$db->result($r,0,"url");
		}
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc_form") ;
		$editor->BasePath = "../fckeditor/";
		$editor->Lang = "ru";
		$editor->Value	= $desc ;
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{theme_id}", $theme_id, $form);
		$form=str_replace("{articles_id}", $articles_id, $form);
		
		$form=str_replace("{wcap}", "Редактировать статью", $form);
		$form=str_replace("{theme_caption}", $this->get_theme_caption($theme_id), $form);
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{short_desc}", $short_desc, $form);
		$form=str_replace("{desc_form}", $editor->Create(), $form);
		$form=str_replace("{author}", $author, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{source}", $source, $form);
		$form=str_replace("{url}", $url, $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		return $form;
	}
	
	function save_articles_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$theme_id=$_POST["theme_id"];$articles_id=$_POST["articles_id"];
		$caption=$slave->qq($_POST["caption"]); $short_desc=$slave->qq($_POST["short_desc"]); $desc_form=$slave->qq($_POST["desc_form"]);
		$author=$slave->qq($_POST["author"]); $data=$slave->qq($_POST["data"]);$source=$slave->qq($_POST["source"]);$url=$slave->qq($_POST["url"]);
		
		$db->query("update articles set theme='$theme_id', caption='$caption', short_desc='$short_desc', `desc`='$desc_form', author='$author', data='$data', source='$source', url='$url' where id='$articles_id';");
		if ($_FILES["pic"]!=""){
			if (is_uploaded_file($_FILES["pic"]['tmp_name'])){ chmod ($_FILES["pic"]['tmp_name'], 0755);
				if (file_exists("../uploads/images/articles/$articles_id.jpg")){ unlink("../uploads/images/articles/$articles_id.jpg"); }
				move_uploaded_file($_FILES["pic"]['tmp_name'],"../uploads/images/articles/$articles_id.jpg");
				$slave->resizeimage("$articles_id.jpg","205","../uploads/images/articles/","");
			}
		}
		$url=$mdl->get_file_url();
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Статью &quot;$caption&quot; успешно отредактировано";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку статей",$form);
		$form=str_replace("{back_url}","?$url&wn=list_articles&theme_id=$theme_id",$form);
		return $form;
	}
	function delete_articles_form($theme_id,$articles_id){
		$db=new db;$mdl=new module;$url=$mdl->get_file_url();
		$db->query("delete from articles where id='$articles_id';");
		if (file_exists("../uploads/images/articles/$articles_id.jpg")){ unlink("../uploads/images/articles/$articles_id.jpg"); }
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Статью &quot;$caption&quot; успешно удалено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку статей",$form);
		$form=str_replace("{back_url}","?$url&wn=list_articles&theme_id=$theme_id",$form);
		return $form;
	}
	
	function show_navigation($theme){
		$db=new db; $mdl=new module; $url=$mdl->get_file_url();
		if ($theme==""){$nav_menu="<a class='navigation' href='?$url'>К списку тем</a>".$nav_menu;}
		if ($theme!=""){$nav_menu="<a class='navigation' href='?$url'>К списку тем</a> | <a class='navigation' href='?$url&wn=list_articles&theme_id=$theme'>К списку статей</a>".$nav_menu;}
		return $nav_menu;
	}
	
	function articles_menu($theme){
		$mdl=new module; $url=$mdl->get_file_url();
		$news_menu_htm=RD."/tpl/news_menu.htm";
		if (!file_exists("$news_menu_htm")){ $news_menu="Не знайдено файл шаблону"; }
		if (file_exists("$news_menu_htm")){ $news_menu = file_get_contents($news_menu_htm);}
		if ($theme==""){ $news_menu=str_replace("{url}","?".$url."&wn=new_theme",$news_menu); }
		if ($theme!=""){ $news_menu=str_replace("{url}","?".$url."&wn=new_articles&theme_id=$theme",$news_menu); }
		return $news_menu;
	}
	
}
?>
