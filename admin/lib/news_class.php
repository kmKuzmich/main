<?php
class news {
	function show_news_list(){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();

		$form_htm=RD."/tpl/news_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($news_up==""){$news_up=0;}
		$r=$db->query("select * from news order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");

			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$operations="
			<a href='?$url&w=use&wn=edit&news_id=$id'><img src='images/edit.png' border=0 alt='Редактировать новость' title='Редактировать новость '></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Удалить новость?')){ window.location.href='?$url&w=use&wn=delete&news_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Удалить новость' title='Удалить новость'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; $caption</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Новостей не найдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation($dep_up,""),$form);
		$form=str_replace("{news_menu}",$this->news_menu(""),$form);
		return $form;
	}
	
	function show_news_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/news_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc") ;
		$editor->BasePath = "../fckeditor/";
		$editor->Lang = "ua";
		$editor->Value	= "" ;
		
		$editor_s = new FCKeditor("short_desc") ;
		$editor_s->BasePath = "../fckeditor/";
		$editor_s->Lang="ua";
		$editor_s->Value="";
		$editor_s->Height="250";

		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{news_id}", "", $form);
		
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{desc}", "", $form);
		$form=str_replace("{short_desc}", "", $form);
		$form=str_replace("{author}", "", $form);
		$form=str_replace("{news_img}", "", $form);
		$form=str_replace("{data}", "", $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		return $form;
	}
	
	function add_news_form(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		$short_desc=$slave->qq($_POST["short_desc"]);
		$author=$slave->qq($_POST["author"]);
		$data=$slave->qq($_POST["data"]);
		$subscribe=$slave->qq($_POST["subscribe"]);
		
		$r=$db->query("select max(id) as mid from news;");
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into news values ('$mid','$caption','$short_desc','$desc','$data','$author');");
		
		if ($_FILES["pic"]!=""){
			if (is_uploaded_file($_FILES["pic"]['tmp_name'])){ chmod ($_FILES["pic"]['tmp_name'], 0755);
				if (file_exists("../uploads/images/news/$mid.jpg")){ unlink("../uploads/images/news/$mid.jpg"); }
				move_uploaded_file($_FILES["pic"]['tmp_name'],"../uploads/images/news/$mid.jpg");
				if ($top==0){$slave->resizeimage("$mid.jpg","216","../uploads/images/news/","");}
				if ($top==1){$slave->resizeimage("$mid.jpg","540","../uploads/images/news/","");}
			}
		}
		
		if ($subscribe=="1"){
			$db->query("insert into subscribe values ('','$caption','$desc',CURDATE(),'1');");
		}

		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Новость &quot;$caption&quot; успешно добавленоно";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку новостей",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	function edit_news_form($news_id){	$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/news_form.htm"; $form=""; if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from news where id='$news_id';");$n=$db->num_rows($r);
		if ($n>0){
			$caption=$db->result($r,0,"caption");
			$short_desc=$db->result($r,0,"short_desc");
			$desc=$db->result($r,0,"desc");
			$data=$db->result($r,0,"data");
			$author=$db->result($r,0,"author");
		}
		
		
		
		if (file_exists("../uploads/images/news/$news_id.jpg")){$news_img="<img src='../uploads/images/news/$news_id.jpg' border=0>";}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{news_id}", $news_id, $form);
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $desc, $form);
		$form=str_replace("{short_desc}", $short_desc, $form);
		$form=str_replace("{author}", $author, $form);
		$form=str_replace("{news_img}", $news_img, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		return $form;
	}
	
	function save_news_form(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$news_id=$slave->qq($_POST["news_id"]);
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		$short_desc=$slave->qq($_POST["short_desc"]);
		$author=$slave->qq($_POST["author"]);
		$data=$slave->qq($_POST["data"]);
		$subscribe=$slave->qq($_POST["subscribe"]);
		
		$db->query("update news set caption='$caption', `desc`='$desc', `short_desc`='$short_desc', data='$data', author='$author' where id='$news_id';");
		
		if ($_FILES["pic"]!=""){
			if (is_uploaded_file($_FILES["pic"]['tmp_name'])){ chmod ($_FILES["pic"]['tmp_name'], 0755);
				if (file_exists("../uploads/images/news/$news_id.jpg")){ unlink("../uploads/images/news/$news_id.jpg"); }
				move_uploaded_file($_FILES["pic"]['tmp_name'],"../uploads/images/news/$news_id.jpg");
				if ($top==0){$slave->resizeimage("$news_id.jpg","216","../uploads/images/news/","");}
				if ($top==1){$slave->resizeimage("$news_id","540","../uploads/images/news/","");}
			}
		}
		if ($subscribe=="1"){
			$db->query("insert into subscribe values ('','$caption','$desc',CURDATE(),'1');");
		}
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Новость &quot;$caption&quot; успешно отредактировано";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($news_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку новостей",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	function delete_news_form($news_cur){
		$db=new db;$mdl=new module;$url=$mdl->get_file_url();
		$db->query("delete from news where id='$news_cur';");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Новость успешно удалено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($news_up,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку новостей",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	
	function show_navigation($id){
		$db=new db; $mdl=new module; $url=$mdl->get_file_url();
		if ($id!=""){$nav_menu="<a class='navigation' href='?$url'>К списку новостей</a>".$nav_menu;}
		return $nav_menu;
	}
	
	function news_menu($news_up){
		$mdl=new module; $url=$mdl->get_file_url();
		$news_menu_htm=RD."/tpl/news_menu.htm";
		if (!file_exists("$news_menu_htm")){ $news_menu="Не знайдено файл шаблону"; }
		if (file_exists("$news_menu_htm")){ $news_menu = file_get_contents($news_menu_htm);}
		
		$news_menu=str_replace("{url}","?".$url."&wn=new",$news_menu);
		return $news_menu;
	}
	
}
?>
