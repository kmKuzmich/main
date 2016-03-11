<?php
class dep {
	function show_dep_list($dep_up){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_url();$urlop=$url;		if ($dep_up==""){$dep_up=0;}
		if (stristr($urlop,"&file=")){ $urlop=ereg_replace("&file=([0-9])*","",$urlop); }
		$form_htm=RD."/tpl/dep_list.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from deps where dep_up='$dep_up' order by lenta,id asc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id"); $next_level=$this->exist_next_level($id);
			$caption=$db->result($r,$i-1,"caption");
			$file=$db->result($r,$i-1,"file");$file_cap=$mdl->get_module_file_cap($file);
			$lenta=$db->result($r,$i-1,"lenta");
			$visible=$db->result($r,$i-1,"visible");

			if ($next_level==1){$caption="<a href='?$url&dep_up=$id'>$caption</a>";}
			if ($next_level==0){$caption="$caption";}
			$color="ffffff";if ($m==2){$color="f5f5f5"; $m=0;}
			
			$operations="
			<a href='?$url&dep_up=$dep_up&w=edit_dep&cur_id=$id'><img src='images/edit.png' border=0 alt='Редактировать' title='Редактировать'></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Удалить раздел?')){ window.location.href='?$url&dep_up=$dep_up&w=delete_dep&cur_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Удалить' title='Удалить'></a>&nbsp;";
			$use="";
			if ($file!="1"){$use="<a href='?$urlop&dep_up=$dep_up&w=use&file=$file&cur_id=$id'><img src='images/use.png' border=0 alt='Просмотр раздела' title='Просмотр раздела'></a>";}
			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$lenta</td>
				<td>$operations</td>
				<td>$use</td>
				<td align='left'>&nbsp; <a href='?$url&dep_up=$id'>$caption</a></td>
				<td>$file_cap</td>
				<td>$visible</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>В этом разделе страниц не найдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation($dep_up,""),$form);
		$form=str_replace("{dep_menu}",$this->dep_menu($dep_up),$form);
		return $form;
	}
	
	function show_dep_form($dep_up){$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/dep_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $dep_up, $form);
		
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{desc}", "", $form);
		$form=str_replace("{seo_info}", "", $form);
		$form=str_replace("{description}", "", $form);
		$form=str_replace("{key_words}", "", $form);
		
		$form=str_replace("{file_form}", $mdl->show_file_form("1"), $form);
		$form=str_replace("{lenta}", "99999", $form);
		
		$form=str_replace("{selected_yes}", "checked", $form);
		$form=str_replace("{selected_no}", "", $form);
		
		$form=str_replace("{navigation}",$this->show_navigation($dep_up,""),$form);
		$form=str_replace("{dep_menu}","",$form);

		return $form;
	}
	
	function add_dep_form(){session_start();
		$db=new db; $slave=new slave; include_once 'lib/users_class.php';  $users=new users;$mdl=new module;$url=$mdl->get_url();
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		$description=$slave->qq($_POST["description"]);
		$seo_info=$slave->qq($_POST["seo_info"]);
		$key_words=$slave->qq($_POST["key_words"]);
		$file=$slave->qq($_POST["dep_file"]); $lenta=$slave->qq($_POST["lenta"]); $dep_up=$slave->qq($_POST["dep_up"]); $visible=$slave->qq($_POST["visible"]);
		
		$r=$db->query("select max(id) as mid from deps;");$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into deps values ('$mid','$dep_up','$caption','$desc','$key_words','$description','$seo_info','$file','$lenta','$visible','1');");
		$users->add_user_rights($_SESSION["user"],$mid);
		
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Раздел &quot;$caption&quot; успешно создан";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($dep_up,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку разделов",$form);
		$form=str_replace("{back_url}","?$url&dep_up=$dep_up",$form);
		return $form;	
	}
	function edit_dep_form($dep_up,$cur_id){$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/dep_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from deps where id='$cur_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$desc=$slave->qqback($db->result($r,0,"desc"));
			$description=$slave->qqback($db->result($r,0,"description"));
			$key_words=$slave->qqback($db->result($r,0,"key_words"));
			$seo_info=$slave->qqback($db->result($r,0,"seo_info"));
			$file=$slave->qqback($db->result($r,0,"file"));
			$lenta=$slave->qqback($db->result($r,0,"lenta"));
			$dep_up=$slave->qqback($db->result($r,0,"dep_up"));
			$visible=$slave->qqback($db->result($r,0,"visible"));
		}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $dep_up, $form);
		$form=str_replace("{cur_id}", $cur_id, $form);
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $desc, $form);
		$form=str_replace("{seo_info}", $seo_info, $form);
		$form=str_replace("{description}", $description, $form);
		$form=str_replace("{key_words}", $key_words, $form);
		$form=str_replace("{file_form}", $mdl->show_file_form($file), $form);
		$form=str_replace("{lenta}", $lenta, $form);
		
		if ($visible=="0"){$form=str_replace("{selected_yes}", "", $form);$form=str_replace("{selected_no}", "checked", $form);}
		if ($visible=="1"){$form=str_replace("{selected_no}", "", $form);$form=str_replace("{selected_yes}", "checked", $form);}
		$form=str_replace("{navigation}",$this->show_navigation($dep_up,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		return $form;
	}
	
	function save_dep_form(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_url();
		$dep_up=$slave->qq($_POST["dep_up"]);$cur_id=$slave->qq($_POST["cur_id"]);
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		$description=$slave->qq($_POST["description"]);
		$seo_info=$slave->qq($_POST["seo_info"]);
		$key_words=$slave->qq($_POST["key_words"]);
		$file=$slave->qq($_POST["dep_file"]);$lenta=$slave->qq($_POST["lenta"]); $visible=$slave->qq($_POST["visible"]);
		
		$db->query("update deps set caption='$caption', `desc`='$desc', description='$description', seo_info='$seo_info', key_words='$key_words', file='$file', lenta='$lenta', visible='$visible' where id='$cur_id';");
		
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Раздел &quot;$caption&quot; успешно сохранен";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($dep_up,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку разделов",$form);
		$form=str_replace("{back_url}","?$url&dep_up=$dep_up",$form);
		return $form;
	}
	function delete_dep_form($dep_cur){
		$db=new db;include_once 'lib/users_class.php';  $users=new users;$mdl=new module;$url=$mdl->get_url();
		$db->query("delete from deps where id='$dep_cur';");
		$users->delete_users_rights($dep_cur);
		
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Раздел успешно удален";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($dep_up,""),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку разделов",$form);
		$form=str_replace("{back_url}","?$url&dep_up=$dep_up",$form);
		return $form;
	}
	
	function show_navigation($id,$nav_menu){
		$db=new db; $mdl=new module; $url=$mdl->get_url();
		$r=$db->query("select dep_up,caption from deps where id='$id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$dep_up=$db->result($r,0,"dep_up");
			$caption=$db->result($r,0,"caption");
			$menu="-><a class='navigation' href='?$url&dep_up=$id'>$caption</a>";
			$nav_menu=$menu.$nav_menu;
			$nav_menu=$this->show_navigation($dep_up,$nav_menu);
		}
		if ($n==0){$nav_menu="<a class='navigation' href='?$url&dep_up=$dep_up'>Разделы</a>".$nav_menu;}
		return $nav_menu;
	}
	
	function exist_next_level($id){$db=new db;
		$r=$db->query("select count(id) as col from deps where dep_up='$id';");
		$n=$db->result($r,0,"col");	if ($n>0){ return "1";}	if ($n==0){ return "0";}
	}
	
	function dep_menu($dep_up){$mdl=new module; $url=$mdl->get_url();
		$dep_menu_htm=RD."/tpl/dep_menu.htm";if (file_exists("$dep_menu_htm")){ $dep_menu = file_get_contents($dep_menu_htm);}
		$dep_menu=str_replace("{url}","?".$url."&dep_up=$dep_up&w=new_dep",$dep_menu);
		return $dep_menu;
	}
}
?>