<?php
class anons {
	function show_anons_list(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url(); $dep_up=$slave->get_dep_up();

		$form_htm=RD."/tpl/anons_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($anons_up==""){$anons_up=0;}
		$r=$db->query("select * from anons order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");

			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$operations="
			<a href='?$url&wn=edit&anons_id=$id'><img src='images/edit.png' border=0 alt='Редагувати' title='Редагувати '></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Видалити анона?')){ window.location.href='?$url&wn=delete&anons_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Видалити' title='Видалити'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; $caption</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Анонсів не знайдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation($dep_up,""),$form);
		$form=str_replace("{anons_menu}",$this->anons_menu(""),$form);
		return $form;
	}
	
	function show_anons_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/anons_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc") ;
		$editor->BasePath = "../fckeditor/";
		$editor->Lang = "ua";
		$editor->Value	= "" ;
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{anons_id}", "", $form);
		
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{desc}", $editor->Create(), $form);
		$form=str_replace("{anons_img}", "", $form);
		$form=str_replace("{data}", "", $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		return $form;
	}
	
	function add_anons_form(){
		$db=new db; $slave=new slave;
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		$data=$slave->qq($_POST["data"]);
		$top=$slave->qq($_POST["top"]);if ($top==""){$top="0";}
		
		$r=$db->query("select max(id) as mid from anons;");
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into anons values ('$mid','$top','$caption','$desc','$data');");
		
		if ($_FILES["pic"]!=""){
			if (is_uploaded_file($_FILES["pic"]['tmp_name'])){ chmod ($_FILES["pic"]['tmp_name'], 0755);
				if (file_exists("../uploads/images/anons/$mid.jpg")){ unlink("../uploads/images/anons/$mid.jpg"); }
				move_uploaded_file($_FILES["pic"]['tmp_name'],"../uploads/images/anons/$mid.jpg");
				if ($top==0){$slave->resizeimage("$mid.jpg","216","../uploads/images/anons/","");}
				if ($top==1){$slave->resizeimage("$mid.jpg","540","../uploads/images/anons/","");}
			}
		}

		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Анонс &quot;$caption&quot; успішно створено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function edit_anons_form($anons_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/anons_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from anons where id='$anons_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$desc=$slave->qqback($db->result($r,0,"desc"));
			$data=$db->result($r,0,"data");
			$top=$db->result($r,0,"top");if ($top==0){$top_c="";}if ($top==1){$top_c=" checked='checked'";}
		}
		
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc") ;
		$editor->BasePath = "../fckeditor/";
		$editor->Lang = "ua";
		$editor->Value	= $desc;
		
		if (file_exists("../uploads/images/anons/$anons_id.jpg")){$anons_img="<img src='../uploads/images/anons/$anons_id.jpg' border=0>";}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{anons_id}", $anons_id, $form);
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $editor->Create(), $form);
		$form=str_replace("{anons_img}", $anons_img, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		$form=str_replace("{checked}", $top_c, $form);
		
		return $form;
	}
	
	function save_anons_form(){
		$db=new db; $slave=new slave;
		$anons_id=$slave->qq($_POST["anons_id"]);
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		$data=$slave->qq($_POST["data"]);
		$top=$slave->qq($_POST["top"]);if ($top==""){$top="0";}
		
		$db->query("update anons set caption='$caption', `desc`='$desc', data='$data', top='$top' where id='$anons_id';");
		
		if ($_FILES["pic"]!=""){
			if (is_uploaded_file($_FILES["pic"]['tmp_name'])){ chmod ($_FILES["pic"]['tmp_name'], 0755);
				if (file_exists("../uploads/images/anons/$anons_id.jpg")){ unlink("../uploads/images/anons/$anons_id.jpg"); }
				move_uploaded_file($_FILES["pic"]['tmp_name'],"../uploads/images/anons/$anons_id.jpg");
				if ($top==0){$slave->resizeimage("$anons_id.jpg","216","../uploads/images/anons/","");}
				if ($top==1){$slave->resizeimage("$anons_id","540","../uploads/images/anons/","");}
			}
		}
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Анонс &quot;$caption&quot; успішно збережено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($anons_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function delete_anons_form($anons_cur){
		$db=new db;
		$db->query("delete from anons where id='$anons_cur';");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Анонс успішно видалено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation("1"),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	
	function show_navigation($id){
		$db=new db; $mdl=new module; $url=$mdl->get_file_url();
		if ($id!=""){$nav_menu="<a class='navigation' href='?$url'>До списку анонсів</a>".$nav_menu;}
		return $nav_menu;
	}
	
	function anons_menu($anons_up){
		$mdl=new module; $url=$mdl->get_file_url();
		$anons_menu_htm=RD."/tpl/anons_menu.htm";
		if (!file_exists("$anons_menu_htm")){ $anons_menu="Не знайдено файл шаблону"; }
		if (file_exists("$anons_menu_htm")){ $anons_menu = file_get_contents($anons_menu_htm);}
		
		$anons_menu=str_replace("{url}","?".$url."&wn=new",$anons_menu);
		return $anons_menu;
	}
	
}
?>
