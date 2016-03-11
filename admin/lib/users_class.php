<?php
class users {
	function show_users_list(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();

		$form_htm=RD."/tpl/users_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($users_up==""){$users_up=0;}
		$r=$db->query("select * from module_users order by id asc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$login=$db->result($r,$i-1,"login");
			$name=$db->result($r,$i-1,"name");
			$post=$db->result($r,$i-1,"post");

			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
		
			$operations="
			<a href='?$url&wn=edit&users_id=$id'><img src='images/edit.png' border=0 alt='Редактировать' title='Редактировать'></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Видалити користувача?')){ window.location.href='?$url&wn=delete&users_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Удалить' title='Удалить'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; <a href='?$url&wn=show_rights&users_id=$id'>$login</a></td>
				<td align='left'>&nbsp; $name</td>
				<td align='left'>&nbsp; $post</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Пользователей не найдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{users_menu}",$this->users_menu(""),$form);
		return $form;
	}
	
	function show_rights_list($users_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/users_rights_list.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select mp.caption from users_structure us inner join module_pages mp on (mp.id=us.module_file) where us.user='$users_id';");
		$n=$db->num_rows($r);$module_list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$caption=$db->result($r,$i-1,"caption");
			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			$module_list.="<tr bgcolor='#$color'><td width='20'>$i</td><td>&nbsp; $caption</td></tr>";
		}
		$r=$db->query("select deps.caption from users_structure us inner join deps on (deps.id=us.dep) where us.user='$users_id';");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$caption=$db->result($r,$i-1,"caption");
			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			$list.="<tr bgcolor='#$color'><td width='20'>$i</td><td>&nbsp; $caption</td></tr>";
		}
		$form=str_replace("{name}", $this->get_users_name($users_id), $form);
		$form=str_replace("{rights_list}", $list, $form);
		$form=str_replace("{module_list}", $module_list, $form);
		
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{users_menu}",$this->users_menu("rights"),$form);
		return $form;
	}
	
	function show_users_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/users_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{users_id}", "", $form);
		
		$form=str_replace("{name}", "", $form);
		$form=str_replace("{login}", "", $form);
		$form=str_replace("{post}", "", $form);
		$form=str_replace("{pass}", "", $form);
		
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{users_menu}","",$form);
		return $form;
	}
	
	function add_users_form(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$name=$slave->qq($_POST["name"]);
		$post=$slave->qq($_POST["post"]);
		$login=$slave->qq($_POST["login"]);
		$pass=$slave->qq($_POST["pass"]);
		
		$r=$db->query("select max(id) as mid from module_users;");
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into module_users values ('$mid','$login','$pass','$name','$post','1');");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Пользователь &quot;$login&quot; успешно создан";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку пользователей",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	function edit_users_form($users_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/users_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from module_users where id='$users_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$name=$db->result($r,0,"name");
			$post=$db->result($r,0,"post");
			$login=$db->result($r,0,"login");
			$pass=$db->result($r,0,"pass");
		}
				
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{users_id}", $users_id, $form);
		
		$form=str_replace("{name}", $name, $form);
		$form=str_replace("{login}", $login, $form);
		$form=str_replace("{post}", $post, $form);
		$form=str_replace("{pass}", $pass, $form);
		
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{users_menu}","",$form);
		return $form;
	}
	
	function save_users_form(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$users_id=$slave->qq($_POST["users_id"]);
		$name=$slave->qq($_POST["name"]);
		$post=$slave->qq($_POST["post"]);
		$login=$slave->qq($_POST["login"]);
		$pass=$slave->qq($_POST["pass"]);
		
		$db->query("update module_users set name='$name', post='$post', login='$login', pass='$pass' where id='$users_id';");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Информация пользователя &quot;$login&quot; успешно сохранена";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($users_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку пользователей",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	function delete_users_form($users_id){
		$db=new db;$mdl=new module;$url=$mdl->get_file_url();
		$db->query("delete from module_users where id='$users_id';");
		$db->query("delete from users_structure where user='$users_id';");
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Пользователь успешно удален";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($users_up,""),$form);
		$form=str_replace("{users_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку пользователей",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	
	function edit_rights_form($users_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/users_rights_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from module_users where id='$users_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$name=$db->result($r,0,"name");
			$post=$db->result($r,0,"post");
			$login=$db->result($r,0,"login");
		}
				
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{users_id}", $users_id, $form);
		
		$form=str_replace("{name}", $name, $form);
		$form=str_replace("{login}", $login, $form);
		$form=str_replace("{post}", $post, $form);
		$form=str_replace("{module_form}", $this->get_module_form($users_id), $form);
		$form=str_replace("{deps_form}", $this->get_deps_form($users_id), $form);
		
		$form=str_replace("{navigation}",$this->show_navigation(),$form);
		$form=str_replace("{users_menu}","",$form);
		return $form;
	}
	
	function save_rights_form(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$users_id=$slave->qq($_POST["users_id"]);
		
		$db->query("delete from users_structure where user='$users_id' and module='1' and module_file='1';");
		$r=$db->query("select id from deps where ison='1' order by lenta,id asc;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id");
				$dep_id=$_POST["dep$id"];
				if ($dep_id==1){
					$db->query("insert into users_structure values('','1','1','$users_id','$id');");
				}
			}
		}
		
		$db->query("delete from users_structure where user='$users_id' and module<>'1';");
		$r=$db->query("select module,id from module_pages order by id asc;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$module=$db->result($r,$i-1,"module");
				$id=$db->result($r,$i-1,"id");
				$file_id=$_POST["module$id"];
				if ($file_id==1){
					$db->query("insert into users_structure values('','$module','$id','$users_id','0');");
				}
			}
		}
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Права пользователя успешно сохранены";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($users_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку прав пользователя",$form);
		$form=str_replace("{back_url}","?$url&wn=show_rights&users_id=$users_id",$form);
		return $form;
	}
	
	function get_module_form($users_id){
		$db=new db; $slave=new slave;
		$r=$db->query("select id,caption from module_pages order by id asc;");
		$n=$db->num_rows($r);
		if ($n>0){
			$menu.="<ol>";
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id"); $checked=$this->check_module_strukture($id,$users_id);
				$caption=$db->result($r,$i-1,"caption");
				$menu.=" <li> <input type='Checkbox' name='module$id' $checked value='1'>$caption";
			}
		}
		return $menu;
	}
	
	function get_deps_form($users_id){
		$db=new db; $slave=new slave;
		$r=$db->query("select id,caption,file from deps where dep_up='0' and ison='1' order by lenta,id asc;");
		$n=$db->num_rows($r);
		if ($n>0){
			$dep_menu.="<ol>";
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id"); $checked=$this->check_users_strukture($id,$users_id);
				$caption=$db->result($r,$i-1,"caption");
				$dep_menu.=" <li> <input type='Checkbox' name='dep$id' $checked value='1'>$caption";
				$dep_menu.=$this->show_next_level_menu($id,$users_id);
			}
		}
		return $dep_menu;
	}
	
	function show_next_level_menu($dep_cur,$users_id){
		$db=new db; $slave=new slave;
		$r=$db->query("select id,caption,file from deps where dep_up='$dep_cur' and ison='1' order by lenta,id asc;");
		$n=$db->num_rows($r);
		if ($n>0){
			$next_menu="<p><ol>";
			for ($i=1;$i<=$n;$i++){
				$id=$db->result($r,$i-1,"id"); $checked=$this->check_users_strukture($id,$users_id);
				$caption=$db->result($r,$i-1,"caption");
				$next_menu.="<li> <input type='Checkbox' name='dep$id' $checked value='1'> $caption";
				$next_menu.=$this->show_next_level_menu($id,$users_id);
			}
			$next_menu.="</ol><p>";
		}
		return $next_menu;
	}
	//-----------------------------------------------
	// check user_strukture
	//-----------------------------------------------
	function check_module_strukture($module,$users_id){
		$db=new db;
		$r=$db->query("select id from users_structure where module_file='$module' and user='$users_id';");
		$n=$db->num_rows($r);
		if ($n>0){ return "checked"; }
		if ($n==0){ return ""; }
	}
	
	function check_users_strukture($dep,$users_id){
		$db=new db;
		$r=$db->query("select id from users_structure where dep='$dep' and user='$users_id';");
		$n=$db->num_rows($r);
		if ($n>0){ return "checked"; }
		if ($n==0){ return ""; }
	}
	
	function get_users_name($users_id){
		$db=new db;
		$r=$db->query("select name from module_users where id='$users_id' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n==1){ return $db->result($r,0,"name");}
		if ($n==0){ return "";}
	}
	
	function get_admin_id(){
		$db=new db;
		$r=$db->query("select id from module_users where login='admin' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n==1){ return $db->result($r,0,"id");}
		if ($n==0){ return "0";}
	}
	
	
	function add_user_rights($users_id,$dep_id){
		$db=new db;session_start();
		$admin_id=$this->get_admin_id();
		$db->query("insert into users_structure values ('','1','1','".$_SESSION["user"]."','$dep_id');");
		if ($_SESSION["user"]!=$admin_id){
			$db->query("insert into users_structure values ('','1','1','$admin_id','$dep_id');");
		}
		return;
	}
	
	function delete_users_rights($dep_id){
		$db=new db;
		$db->query("delete from users_structure where dep='$dep_id';");
		return;
	}
	
	
	function show_navigation(){
		$mdl=new module; $url=$mdl->get_file_url();
		$nav_menu="<a class='navigation' href='?$url'>Список пользователей</a>".$nav_menu;
		return $nav_menu;
	}
	
	function users_menu($wr){
		$mdl=new module; $url=$mdl->get_file_url();
		$users_menu_htm=RD."/tpl/users_menu.htm";
		if (!file_exists("$users_menu_htm")){ $users_menu="Не знайдено файл шаблону"; }
		if (file_exists("$users_menu_htm")){ $users_menu = file_get_contents($users_menu_htm);}

		if ($wr==""){
			$users_menu=str_replace("{url1}","?".$url."&wn=new",$users_menu);
			$users_menu=str_replace("{url2}","#",$users_menu);
			$users_menu=str_replace("{hidden1}","visible",$users_menu);
			$users_menu=str_replace("{hidden2}","hidden",$users_menu);
		}
		if ($wr=="rights"){
			$users_id=$_GET["users_id"];
			$users_menu=str_replace("{url1}","#",$users_menu);
			$users_menu=str_replace("{url2}","?".$url."&wn=edit_rights&users_id=$users_id",$users_menu);
			$users_menu=str_replace("{hidden1}","hidden",$users_menu);
			$users_menu=str_replace("{hidden2}","visible",$users_menu);
		}
		return $users_menu;
	}
	
}
?>
