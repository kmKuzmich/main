<?php
class forum {
	function show_forum_list(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();list($dep_up,$dep_cur)=$slave->get_file_deps("forum");

		$form_htm=RD."/tpl/forum_dep_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from forum_dep order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$count_theme=$this->count_theme($id);
			$count_answer=$this->count_forum_answer($id);
			$last_answer=$this->get_forum_last_answer($id);

			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$operations="
			<a href='?$url&wn=edit_forum&forum_id=$id'><img src='images/edit.png' border=0 alt='Редагувати' title='Редагувати '></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Видалити форум?')){ window.location.href='?$url&wn=delete_forum&forum_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Видалити' title='Видалити'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; <a href='?$url&wn=theme_list&forum_id=$id'>$caption</a></td>
				<td>$count_theme</td>
				<td>$count_answer</td>
				<td>$last_answer</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Форуму не знайдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation("forum_list",$forum_id,$theme),$form);
		$form=str_replace("{forum_menu}",$this->forum_menu(),$form);
		return $form;
	}
	
	function show_theme_list($forum_id){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url(); list($dep_up,$dep_cur)=$slave->get_file_deps("forum");

		$form_htm=RD."/tpl/forum_theme_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from forum_theme where dep='$forum_id' and ison='1' order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$name=$db->result($r,$i-1,"name");
			$count_answer=$this->count_theme_answer($id);
			$last_answer=$this->get_theme_last_answer($id);

			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$operations="
			<a href='?$url&wn=edit_theme&forum_id=$forum_id&theme=$id'><img src='images/edit.png' border=0 alt='Редагувати' title='Редагувати '></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Видалити тему?')){ window.location.href='?$url&wn=delete_theme&forum_id=$forum_id&theme=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Видалити' title='Видалити'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; <a href='?$url&wn=answer_list&forum_id=$forum_id&theme=$id'>$caption</a></td>
				<td>$name</td>
				<td>$count_answer</td>
				<td>$last_answer</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Тем форуму не знайдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation("theme_list",$forum_id,$theme),$form);
		$form=str_replace("{forum_menu}","",$form);
		return $form;
	}
	function show_answer_list($forum_id,$theme){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url(); list($dep_up,$dep_cur)=$slave->get_file_deps("forum");

		$form_htm=RD."/tpl/forum_answer_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from forum_theme where id='$theme' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n==1){ 
			$id=$db->result($r,0,"id");
			$caption=$db->result($r,0,"caption");
			$desc=$db->result($r,0,"desc");
			$data=$slave->data_word($db->result($r,0,"data"));
			$name=$db->result($r,0,"name");
		}
		
		$form=str_replace("{name}", $name, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{theme}", $caption, $form);
		$form=str_replace("{desc}", $desc, $form);
		
		
		$r=$db->query("select * from forum_answer where theme='$theme' order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$answer=$db->result($r,$i-1,"answer");
			$name=$db->result($r,$i-1,"name");
			$data=$db->result($r,$i-1,"data");

			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$list.="
			<tr bgcolor='$color' align='left'>
					<td>
					<input type='button' value='Видалити' onclick=\"if(confirm('Видалити коментар теми форуму?')){ window.location.href='?$url&wn=delete_answer&forum_id=$forum_id&theme=$theme&answer_id=$id&conf=true'}\"><br />
					<b>$name</b><br>$data</td>
					<td>$answer</td>
				</tr>";
			
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Коментарів не знайдено</h2></td></tr>";}
		$form=str_replace("{answer_list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation("answer_list",$forum_id,$theme),$form);
		$form=str_replace("{forum_menu}","",$form);
		return $form;
	}
	
	function show_forum_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/forum_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{forum_id}", "", $form);
		
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{desc}", "", $form);
		$form=str_replace("{navigation}",$this->show_navigation("forum_list",$forum_id,$theme),$form);
		$form=str_replace("{forum_menu}","",$form);
		return $form;
	}
	
	function add_forum(){
		$db=new db; $slave=new slave;
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		
		$r=$db->query("select max(id) as mid from forum_dep;");
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into forum_dep values ('$mid','$caption','$desc','1');");
		
		return $mid;
	}
	function edit_forum_form($forum_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/forum_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from forum_dep where id='$forum_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$desc=$slave->qqback($db->result($r,0,"desc"));
		}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{forum_id}", $forum_id, $form);
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $desc, $form);
		$form=str_replace("{navigation}",$this->show_navigation("forum_list",$forum_id,$theme),$form);
		$form=str_replace("{forum_menu}","",$form);
		return $form;
	}
	
	function save_forum(){
		$db=new db; $slave=new slave;
		$forum_id=$slave->qq($_POST["forum_id"]);
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		$db->query("update forum_dep set caption='$caption', `desc`='$desc' where id='$forum_id';");

		return $forum_id;
	}
	
	function edit_theme_form($forum_id,$theme){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/forum_theme_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from forum_theme where id='$theme';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$slave->qqback($db->result($r,0,"caption"));
			$desc=$slave->qqback($db->result($r,0,"desc"));
			$name=$slave->qqback($db->result($r,0,"name"));
			$data=$slave->qqback($db->result($r,0,"data"));
		}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{forum_id}", $forum_id, $form);
		$form=str_replace("{theme}", $theme, $form);
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $desc, $form);
		$form=str_replace("{name}", $name, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{calendar}", $slave->get_calendar("data"), $form);
		$form=str_replace("{navigation}",$this->show_navigation("theme_list",$forum_id,$theme),$form);
		$form=str_replace("{forum_menu}","",$form);
		return $form;
	}
	
	function save_theme(){
		$db=new db; $slave=new slave;
		$forum_id=$slave->qq($_POST["forum_id"]);$theme=$slave->qq($_POST["theme"]);
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		$name=$slave->qq($_POST["name"]);
		$data=$slave->qq($_POST["data"]);
		$db->query("update forum_theme set caption='$caption', name='$name', data='$data', `desc`='$desc' where id='$theme';");
		return $forum_id;
	}
	
	function delete_forum($forum_id){
		$db=new db;
		$db->query("delete from forum_dep where id='$forum_id';");
		$db->query("delete from forum_theme where dep='$forum_id';");
		$db->query("delete from forum_answer where dep='$forum_id';");
		return;
	}
	function delete_theme($theme){
		$db=new db;
		$db->query("delete from forum_theme where id='$theme';");
		$db->query("delete from forum_answer where theme='$theme';");
		return;
	}
	function delete_answer($answer){
		$db=new db;
		$db->query("delete from forum_answer where id='$answer';");
		return;
	}
	
	function count_theme($forum_id){
		$db=new db; 
		$r=$db->query("select count(id) as kol from forum_theme where dep='$forum_id';");
		return $db->result($r,0,"kol");
	}
	function count_forum_answer($forum_id){
		$db=new db; 
		$r=$db->query("select count(id) as kol from forum_answer where dep='$forum_id';");
		return $db->result($r,0,"kol");
	}
	function count_theme_answer($theme_id){
		$db=new db; 
		$r=$db->query("select count(id) as kol from forum_answer where theme='$theme_id';");
		return $db->result($r,0,"kol");
	}
	function get_forum_last_answer($forum_id){
		$db=new db; 
		$r=$db->query("select data from forum_answer where dep='$forum_id' order by id desc limit 0,1;");
		$n=$db->num_rows($r);
		if ($n==1){ return $db->result($r,0,"data"); }
		if ($n==0){ return ""; }
	}
	function get_theme_last_answer($theme_id){
		$db=new db; 
		$r=$db->query("select data from forum_answer where theme='$theme_id' order by id desc limit 0,1;");
		$n=$db->num_rows($r);
		if ($n==1){ return $db->result($r,0,"data"); }
		if ($n==0){ return ""; }
	}
	function get_forum_caption($forum_id){
		$db=new db; 
		$r=$db->query("select caption from forum_dep where id='$forum_id' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n==1){ return $db->result($r,0,"caption"); }
		if ($n==0){ return ""; }
	}
	function get_theme_caption($theme){
		$db=new db; 
		$r=$db->query("select caption from forum_theme where id='$theme' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n==1){ return $db->result($r,0,"caption"); }
		if ($n==0){ return ""; }
	}
	
	function show_navigation($wn,$forum_id,$theme){
		$db=new db; $mdl=new module; $url=$mdl->get_file_url();
		if ($wn=="forum_list"){ 
			$menu.="<a class='navigation' href='?$url'>Всі форуми</a>";
		}
		if ($wn=="theme_list"){ 
			$menu.="<a class='navigation' href='?$url'>Всі форуми</a> | <a class='navigation' href='?$url&wn=theme_list&forum_id=$forum_id'>".$this->get_forum_caption($forum_id)."</a>";
		}
		if ($wn=="answer_list"){ 
			$menu.="<a class='navigation' href='?$url'>Всі форуми</a> | <a class='navigation' href='?$url&wn=theme_list&forum_id=$forum_id'>".$this->get_forum_caption($forum_id)."</a> | <a class='navigation' href='?$url&wn=answer_list&forum_id=$forum_id&theme=$theme'>". $this->get_theme_caption($theme)."</a>";
		}
		return $menu;
	}
	
	function forum_menu(){
		$mdl=new module; $url=$mdl->get_file_url();
		$forum_menu_htm=RD."/tpl/forum_menu.htm";
		if (!file_exists("$forum_menu_htm")){ $forum_menu="Не знайдено файл шаблону"; }
		if (file_exists("$forum_menu_htm")){ $forum_menu = file_get_contents($forum_menu_htm);}
		
		$forum_menu=str_replace("{url}","?".$url."&wn=new_forum",$forum_menu);
		$forum_menu=str_replace("{alt}","Новий форум",$forum_menu);
		return $forum_menu;
	}
	
}
?>
