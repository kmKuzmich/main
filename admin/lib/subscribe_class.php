<?php
class subscribe {
	function show_subscribe_list(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();

		$form_htm=RD."/tpl/subscribe_list.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		if ($subscribe_up==""){$subscribe_up=0;}
		$r=$db->query("select * from subscribe order by id desc;");
		$n=$db->num_rows($r);$list="";$m=0;
		for ($i=1;$i<=$n;$i++){$m++;
			$id=$db->result($r,$i-1,"id");
			$caption=$db->result($r,$i-1,"caption");
			$data=$db->result($r,$i-1,"data");
			$status=$this->get_status_caption($db->result($r,$i-1,"status"));

			if ($m==1){$color="ffffff";}
			if ($m==2){$color="f5f5f5"; $m=0;}
			
			$operations="
			<a href='?$url&wn=edit&subscribe_id=$id'><img src='images/edit.png' border=0 alt='Редактировать рассылку' title='Редактировать рассылку'></a>&nbsp; 
			<a href='#' onclick=\"if(confirm('Удалить рассылку?')){ window.location.href='?$url&wn=delete&subscribe_id=$id&conf=true'}\" ><img src='images/drop.png' border=0 alt='Удалить рассылку' title='Удалить рассылку'></a>&nbsp;";

			$list.="
			<tr align='center' bgcolor='#$color'>
				<td>$i</td>
				<td>$operations</td>
				<td align='left'>&nbsp; <a href='?$url&wn=send&subscribe_id=$id'>$caption</a></td>
				<td>$data</td>
				<td>$status</td>
			</tr>";
		}
		if ($n==0){$list="<tr><td colspan=10 height='60' align='center'><h2>Рассылок не найдено</h2></td></tr>";}
		$form=str_replace("{list}",$list,$form);
		$form=str_replace("{navigation}",$this->show_navigation($dep_up,""),$form);
		$form=str_replace("{subscribe_menu}",$this->subscribe_menu(""),$form);
		return $form;
	}
	
	function show_subscribe_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/subscribe_form.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
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
		$form=str_replace("{subscribe_id}", "", $form);
		
		$form=str_replace("{caption}", "", $form);
		$form=str_replace("{desc}", $editor->Create(), $form);
		return $form;
	}
	
	function add_subscribe_form(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		
		$r=$db->query("select max(id) as mid from subscribe;");
		$mid=$db->result($r,0,"mid")+1;
		$db->query("insert into subscribe values ('$mid','$caption','$desc',CURDATE(),'1');");
		
		include 'lib/subscribe_file_upload.php'; $file_upload=new file_upload;
		$file_upload->convert_files($mid);
		
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Рассылка &quot;$caption&quot; успешно создана";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($mid),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку рассылок",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	function edit_subscribe_form($subscribe_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/subscribe_form.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from subscribe where id='$subscribe_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$db->result($r,0,"caption");
			$desc=$db->result($r,0,"desc");
		}
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc") ; $editor->BasePath = "../fckeditor/"; $editor->Lang = "ua"; $editor->Value	= $desc;
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{subscribe_id}", $subscribe_id, $form);
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $editor->Create(), $form);
		return $form;
	}
	
	function save_subscribe_form(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$subscribe_id=$slave->qq($_POST["subscribe_id"]);
		$caption=$slave->qq($_POST["caption"]);
		$desc=$slave->qq($_POST["desc"]);
		
		$db->query("update subscribe set caption='$caption', `desc`='$desc', data=CURDATE(), status='$status' where id='$subscribe_id';");
				
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Рассылка &quot;$caption&quot; успешно отредактирована";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($subscribe_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку рассылок",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	function delete_subscribe_form($subscribe_id){
		$db=new db;$mdl=new module;$url=$mdl->get_file_url();
		$db->query("delete from subscribe where id='$subscribe_id';");
		
		include 'lib/subscribe_file_upload.php'; $file_upload=new file_upload;
		$file_upload->drop_subscribe($subscribe_id);
		
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$message="Рассылку успешно удалено";
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($subscribe_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку рассылок",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}

	function presend_subscribe_form($subscribe_id){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/subscribe_presend_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$r=$db->query("select * from subscribe where id='$subscribe_id';");
		$n=$db->num_rows($r);
		if ($n>0){
			$caption=$db->result($r,0,"caption");
			$desc=$db->result($r,0,"desc");
			$data=$db->result($r,0,"data");
			$status=$this->get_status_caption($db->result($r,0,"status"));
	
			include 'lib/subscribe_file_upload.php'; $file_upload=new file_upload;
			$file_list=$file_upload->show_file_list($subscribe_id);
		}
		
		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{subscribe_id}", $subscribe_id, $form);
		
		$form=str_replace("{caption}", $caption, $form);
		$form=str_replace("{desc}", $desc, $form);
		$form=str_replace("{data}", $data, $form);
		$form=str_replace("{file_list}", $file_list, $form);
		$form=str_replace("{status}", $status, $form);
		return $form;
	}
	
	function send_subscribe(){
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		$subscribe_id=$slave->qq($_POST["subscribe_id"]);
		$all=$slave->qq($_POST["all"]);$subscribers=$slave->qq($_POST["subscribers"]);$clients=$slave->qq($_POST["clients"]);
		$r=$db->query("select * from subscribe where id='$subscribe_id';");
		$n=$db->num_rows($r);
		if ($n>0){ include_once "../lib/libmail.php";
			$caption=$db->result($r,0,"caption");
			$desc=$this->make_url_ok($db->result($r,0,"desc"));
			if ($clients=="1" or $all=="1"){
				$r=$db->query("select email from clients where sublist='1' order by id asc;");
				$n=$db->num_rows($r);
				for ($i=1;$i<=$n;$i++){
					$email=$db->result($r,$i-1,"email");
				
					$m= new Mail;
					$m->From( "robot@omega.km.ua" );
					$m->To( $email);
					$m->Subject(date("d-m-Y")." Omega.km.ua: $caption");
					$m->Body($desc);
					
					if (is_dir("../uploads/file/subscribe/$subscribe_id")) {
				    	if ($dh = opendir("../uploads/file/subscribe/$subscribe_id")) {
        					while (($file = readdir($dh)) !== false) {
								if( $file != "." and $file != ".."){
									$m->Attach("../uploads/file/subscribe/$subscribe_id/$file", "", "inline" );
								}
							}
	    			    }
		        		closedir($dh);
	    			}
					$m->Priority(1) ;
					$m->Send();
				}
				
			}
			if ($subscribers=="1" or $all=="1"){
				$r=$db->query("select email from subscribe_list order by id asc;");
				$n=$db->num_rows($r);
				for ($i=1;$i<=$n;$i++){
					$email=$db->result($r,$i-1,"email");
		
					$m= new Mail;
					$m->From( "robot@omega.km.ua" );
					$m->To( $email);
					$m->Subject(date("d-m-Y")." Omega.km.ua: $caption");
					$m->Body($desc);
				
					if (is_dir("../uploads/file/subscribe/$subscribe_id")) {
				    	if ($dh = opendir("../uploads/file/subscribe/$subscribe_id")) {
        					while (($file = readdir($dh)) !== false) {
								if( $file != "." and $file != ".."){
									$m->Attach("../uploads/file/subscribe/$subscribe_id/$file", "", "inline" );
								}
							}
	    			    }
		        		closedir($dh);
	    			}
					$m->Priority(1) ;
					$m->Send();
				}
				
			}
			$message="Рассылка успешно выполненна";
			$db->query("update subscribe set status='2' where id='$subscribe_id';");
		}
		if ($n==0){
			$message="Ошибка!. Рассылка не выполенна";
		}
		
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}",$this->show_navigation($subscribe_id),$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад к списку рассылок",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	
	function show_navigation($id){
		$db=new db; $mdl=new module; $url=$mdl->get_file_url();
		if ($id!=""){$nav_menu="<a class='navigation' href='?$url'>К списку рассылок</a>".$nav_menu;}
		return $nav_menu;
	}
	
	function subscribe_menu($subscribe_up){
		$mdl=new module; $url=$mdl->get_file_url();
		$subscribe_menu_htm=RD."/tpl/subscribe_menu.htm";if (file_exists("$subscribe_menu_htm")){ $subscribe_menu = file_get_contents($subscribe_menu_htm);}
		
		$subscribe_menu=str_replace("{url}","?".$url."&wn=new",$subscribe_menu);
		return $subscribe_menu;
	}
	
	function get_status_caption($status){
		$db=new db;
		$r=$db->query("select caption from subscribe_status where id='$status';");
		$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"caption"); }
		if ($n==0){ return "---"; }
	}
	
	function make_url_ok($cont) { 
		$main_url="http://omega.km.ua";
		$cont=str_replace('href="?', 'href="'.$main_url.'/index.php?', $cont); 
		$cont=str_replace('href="index.php?', 'href="'.$main_url.'/index.php?', $cont); 
		$cont=str_replace("href='?", "href='".$main_url."/index.php?", $cont); 
		$cont=str_replace("href='index.php?", "href='".$main_url."/index.php?", $cont); 
		
		$cont=str_replace("theme/", $main_url."/theme/", $cont); 
		$cont=str_replace('src="uploads/', 'src="'.$main_url.'/uploads/', $cont); 
		$cont=str_replace('src="/uploads/', 'src="'.$main_url.'/uploads/', $cont); 

		return $cont;
	}
}
?>