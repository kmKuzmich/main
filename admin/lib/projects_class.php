<?php
class projects {
	function show_projects_list(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url(); $dep_up=$slave->get_dep_up();

		$form_htm=RD."/tpl/projects_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($projects_up==""){$projects_up=0;}
		$r=$db->query("select * from projects order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$nomber=$db->result($r,$i-1,"nomber");
			$caption=$db->result($r,$i-1,"caption");
			$data=$slave->data_word($db->result($r,$i-1,"data"));
			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$operations="
			<a href='?$url&wn=edit&projects_id=$id'><img src='images/edit.png' border=0 alt='Редагувати' title='Редагувати '></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Видалити проект?')){ window.location.href='?$url&wn=delete&projects_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Видалити' title='Видалити'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$nomber</td>
				<td>$operations</td>
				<td align='left'>&nbsp; <a href='?$url&wn=show&projects_id=$id'>$caption</a></td>
				<td>$data</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Проектів не знайдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{projects_menu}",$this->projects_menu(""),$form);
		return $form;
	}
	
	function show_projects_desc($projects_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/projects_desc.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from projects where id='$projects_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$nomber=$slave->qqback($db->result($r,0,"nomber"));
			$desc=$db->result($r,0,"desc");
			$data=$db->result($r,0,"data");
		}
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $desc, $form);
		$form=str_replace("{nomber}", $nomber, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{opinion}",$this->show_projects_opinion($projects_id),$form);
		
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{projects_menu}","",$form);
		return $form;
	}
	
	function show_projects_opinion($projects_id){
		$db=new db; $slave=new slave;$dep=$slave->get_dep(); list($dep_up,$dep_cur)=$slave->get_file_deps("projects");
		$mdl=new module;$url=$mdl->get_file_url();
		
		//      -----------------   list of videos     ------------------------
		$r=$db->query("select * from projects_opinion where document='$projects_id' order by id asc;");
		$n=$db->num_rows($r);
		$list="<table align='left' width='100%' border='0' cellpadding=3 cellspacing=3 id='projects'>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$name=$db->result($r,$i-1,"name");
			$desc=$db->result($r,$i-1,"desc");
			$data=$db->result($r,$i-1,"data");
			
			$del_url="if(confirm('Видалити коментар до проекту?')){ window.location.href='?$url&wn=delete_projects_opinion&projects_id=$projects_id&opinion_id=$id'}";
			
			$list.="<tr valign='top' bgcolor='#e5e5e5'>
				<td width='10'>$i</td>
				<td width='30'><input type='button' value='Видалити' onclick=\"$del_url\"></td>
				<td width='150'>$name<br>$data</td>
				<td>$desc</td>
				</tr>";
		}
		$list.="</table>";
		
		
		return $list;
	}
	
	
	
	function show_projects_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/projects_form.htm";
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
		$form=str_replace("{projects_id}", "", $form);
		
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{desc}", $editor->Create(), $form);
		$form=str_replace("{nomber}", "", $form);
		$form=str_replace("{data}", date("Y-m-d"), $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		return $form;
	}
	
	function add_projects_form(){
		$db=new db; $slave=new slave;
		$caption=$slave->qq($_POST["caption"]);
		$desc=$_POST["desc"];
		$nomber=$slave->qq($_POST["nomber"]);
		$data=$slave->qq($_POST["data"]);
		
		$r=$db->query("select max(id) as mid from projects;");
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into projects values ('$mid','$nomber','$caption','$desc','$data','0');");
		
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Проект &quot;$caption&quot; успішно створено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function edit_projects_form($projects_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/projects_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from projects where id='$projects_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$nomber=$slave->qqback($db->result($r,0,"nomber"));
			$desc=$db->result($r,0,"desc");
			$data=$db->result($r,0,"data");
		}
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc") ;
		$editor->BasePath = "../fckeditor/";
		$editor->Lang = "ua";
		$editor->Value	= $desc;
				
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{projects_id}", $projects_id, $form);
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $editor->Create(), $form);
		$form=str_replace("{nomber}", $nomber, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		
		return $form;
	}
	
	function save_projects_form(){
		$db=new db; $slave=new slave;
		$projects_id=$slave->qq($_POST["projects_id"]);
		$caption=$slave->qq($_POST["caption"]);
		$desc=$_POST["desc"];
		$nomber=$slave->qq($_POST["nomber"]);
		$data=$slave->qq($_POST["data"]);
		
		$db->query("update projects set caption='$caption', data='$data', `desc`='$desc', nomber='$nomber' where id='$projects_id';");
				
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Проект &quot;$caption&quot; успішно збережено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($projects_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function delete_projects($projects_id){
		$db=new db;
		$db->query("delete from projects where id='$projects_id';");
		$db->query("delete from projects_opinion where project='$projects_id';");
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Проект успішно видалено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation(""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	
	function delete_projects_opinion($projects,$opinion_id){
		$db=new db;
		$db->query("delete from projects_opinion where id='$opinion_id';");
		$r=$db->query("select opinion from projects where id='$projects' limit 0,1");
		$n=$db->num_rows($r);
		if ($n>0){
			$op=$db->result($r,0,"opinion")-1;
			$db->query("update projects set opinion='$op' where id='$projects';");
		}
		return;
	}
	
	function show_navigation(){
		$db=new db; $mdl=new module; $url=$mdl->get_file_url();
		$nav_menu="<a class='navigation' href='?$url'>До списку проектів</a>".$nav_menu;
		return $nav_menu;
	}
	
	function projects_menu($projects_up){
		$mdl=new module; $url=$mdl->get_file_url();
		$projects_menu_htm=RD."/tpl/projects_menu.htm";
		if (!file_exists("$projects_menu_htm")){ $projects_menu="Не знайдено файл шаблону"; }
		if (file_exists("$projects_menu_htm")){ $projects_menu = file_get_contents($projects_menu_htm);}
		
		$projects_menu=str_replace("{url}","?".$url."&wn=new",$projects_menu);
		return $projects_menu;
	}
	
}
?>
