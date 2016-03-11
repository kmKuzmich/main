<?php
class documents {
	function show_documents_list(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url(); $dep_up=$slave->get_dep_up();

		$form_htm=RD."/tpl/documents_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($documents_up==""){$documents_up=0;}
		$r=$db->query("select * from documents order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$nomber=$db->result($r,$i-1,"nomber");
			$doc_type=$this->get_doc_type_caption($db->result($r,$i-1,"doc_type"));
			$caption=$db->result($r,$i-1,"caption");
			$data=$slave->data_word($db->result($r,$i-1,"data"));
			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$operations="
			<a href='?$url&wn=edit&documents_id=$id'><img src='images/edit.png' border=0 alt='Редагувати' title='Редагувати '></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Видалити документ?')){ window.location.href='?$url&wn=delete&documents_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Видалити' title='Видалити'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$nomber</td>
				<td>$operations</td>
				<td>$doc_type</td>
				<td align='left'>&nbsp; <a href='?$url&wn=show&documents_id=$id'>$caption</a></td>
				<td>$data</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Документів не знайдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{documents_menu}",$this->documents_menu(""),$form);
		return $form;
	}
	
	function show_documents_desc($documents_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/documents_desc.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from documents where id='$documents_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$nomber=$slave->qqback($db->result($r,0,"nomber"));
			$desc=$db->result($r,0,"desc");
			$data=$db->result($r,0,"data");
			$doc_type=$db->result($r,0,"doc_type");
		}
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $desc, $form);
		$form=str_replace("{nomber}", $nomber, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{doc_type}", $this->get_doc_type_caption($doc_type), $form);
		$form=str_replace("{opinion}",$this->show_documents_opinion($documents_id),$form);
		
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{documents_menu}","",$form);
		return $form;
	}
	
	function show_documents_opinion($documents_id){
		$db=new db; $slave=new slave;$dep=$slave->get_dep(); list($dep_up,$dep_cur)=$slave->get_file_deps("documents");
		$mdl=new module;$url=$mdl->get_file_url();
		
		//      -----------------   list of videos     ------------------------
		$r=$db->query("select * from documents_opinion where document='$documents_id' order by id asc;");
		$n=$db->num_rows($r);
		$list="<table align='left' width='100%' border='0' cellpadding=3 cellspacing=3 id='documents'>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$name=$db->result($r,$i-1,"name");
			$desc=$db->result($r,$i-1,"desc");
			$data=$db->result($r,$i-1,"data");
			
			$del_url="if(confirm('Видалити коментар до документу?')){ window.location.href='?$url&wn=delete_documents_opinion&documents_id=$documents_id&opinion_id=$id'}";
			
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
	
	
	
	function show_documents_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/documents_form.htm";
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
		$form=str_replace("{documents_id}", "", $form);
		
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{desc}", $editor->Create(), $form);
		$form=str_replace("{nomber}", "", $form);
		$form=str_replace("{doc_type_form}", $this->get_doc_type_form(""), $form);
		$form=str_replace("{data}", date("Y-m-d"), $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		return $form;
	}
	
	function add_documents_form(){
		$db=new db; $slave=new slave;
		$caption=$slave->qq($_POST["caption"]);
		$desc=$_POST["desc"];
		$nomber=$slave->qq($_POST["nomber"]);
		$doc_type=$slave->qq($_POST["doc_type"]);
		$data=$slave->qq($_POST["data"]);
		
		$r=$db->query("select max(id) as mid from documents;");
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into documents values ('$mid','$doc_type','$nomber','$caption','$desc','$data','0');");
		
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Документ &quot;$caption&quot; успішно створено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function edit_documents_form($documents_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/documents_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from documents where id='$documents_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$nomber=$slave->qqback($db->result($r,0,"nomber"));
			$desc=$db->result($r,0,"desc");
			$data=$db->result($r,0,"data");
			$doc_type=$db->result($r,0,"doc_type");
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
		$form=str_replace("{documents_id}", $documents_id, $form);
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $editor->Create(), $form);
		$form=str_replace("{nomber}", $nomber, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{doc_type_form}", $this->get_doc_type_form($doc_type), $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		
		return $form;
	}
	
	function save_documents_form(){
		$db=new db; $slave=new slave;
		$documents_id=$slave->qq($_POST["documents_id"]);
		$caption=$slave->qq($_POST["caption"]);
		$desc=$_POST["desc"];
		$nomber=$slave->qq($_POST["nomber"]);
		$doc_type=$slave->qq($_POST["doc_type"]);
		$data=$slave->qq($_POST["data"]);
		
		$db->query("update documents set caption='$caption', data='$data', `desc`='$desc', nomber='$nomber', doc_type='$doc_type' where id='$documents_id';");
				
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Документ &quot;$caption&quot; успішно збережено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($documents_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	function delete_documents($documents_id){
		$db=new db;
		$db->query("delete from documents where id='$documents_id';");
		$db->query("delete from documents_opinion where documents='$documents_id';");
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Документ успішно видалено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation(""),$form);
		$form=str_replace("{documents_menu}","",$form);
		return $form;
	}
	
	function delete_documents_opinion($documents,$opinion_id){
		$db=new db;
		$db->query("delete from documents_opinion where id='$opinion_id';");
		$r=$db->query("select opinion from documents where id='$documents' limit 0,1");
		$n=$db->num_rows($r);
		if ($n>0){
			$op=$db->result($r,0,"opinion")-1;
			$db->query("update documents set opinion='$op' where id='$documents';");
		}
		return;
	}
	
	function show_navigation(){
		$db=new db; $mdl=new module; $url=$mdl->get_file_url();
		$nav_menu="<a class='navigation' href='?$url'>До списку документів</a>".$nav_menu;
		return $nav_menu;
	}
	
	function documents_menu($documents_up){
		$mdl=new module; $url=$mdl->get_file_url();
		$documents_menu_htm=RD."/tpl/documents_menu.htm";
		if (!file_exists("$documents_menu_htm")){ $documents_menu="Не знайдено файл шаблону"; }
		if (file_exists("$documents_menu_htm")){ $documents_menu = file_get_contents($documents_menu_htm);}
		
		$documents_menu=str_replace("{url}","?".$url."&wn=new",$documents_menu);
		return $documents_menu;
	}
	
	function get_doc_type_caption($type){
		$db=new db;
		$r=$db->query("select caption from document_type where id='$type';");
		$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"caption");}
		if ($n==0){ return "";}
	}
	function get_doc_type_form($type){
		$db=new db;$slave=new slave;
		$r=$db->query("select * from document_type order by id asc");
		$n=$db->num_rows($r);
		$frm="<select name='doc_type' size=1 style='width:100%;'>";
		for ($i=1;$i<=$n;$i++){
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			if ($id==$type){ $frm.="<option value='$id' selected>$caption</option>";}
			if ($id!=$type){ $frm.="<option value='$id'>$caption</option>";}
		}
		$frm.="</select>";
		return $frm;
	}	
}
?>
