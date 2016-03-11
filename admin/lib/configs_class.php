<?php
class configs {
	function show_configs(){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url(); $dep_up=$slave->get_dep_up();
		$form_htm=RD."/tpl/configs_show.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from config order by id desc limit 0,1;");
		$n=$db->num_rows($r);
		if ($n==1){
			$title=$db->result($r,0,"title");
			$key_words=$db->result($r,0,"key_words");
			$description=$db->result($r,0,"description");
			$seo_info=$db->result($r,0,"seo_info");
		}
		$form=str_replace("{url}","?$url&wn=edit",$form);
		$form=str_replace("{title}",$title,$form);
		$form=str_replace("{key_words}",$key_words,$form);
		$form=str_replace("{description}",$description,$form);
		$form=str_replace("{seo_info}",$seo_info,$form);
		return $form;
	}
	function edit_configs_form(){$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/configs_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$db->query("select * from config order by id desc limit 0,1;");
		$n=$db->num_rows($r);
		if ($n>0){
			$title=$db->result($r,0,"title");
			$key_words=$db->result($r,0,"key_words");
			$description=$db->result($r,0,"description");
			$seo_info=$db->result($r,0,"seo_info");
		}
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", $slave->get_wn(), $form);
		$form=str_replace("{title}",$title,$form);
		$form=str_replace("{key_words}",$key_words,$form);
		$form=str_replace("{description}",$description,$form);
		$form=str_replace("{seo_info}", $seo_info, $form);
		return $form;
	}
	function save_configs_form(){$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_url();
		$title=$slave->qq($_POST["title"]);$key_words=$slave->qq($_POST["key_words"]);$description=$slave->qq($_POST["description"]);$seo_info=$slave->qq($_POST["seo_info"]);
		$db->query("update config set title='$title', key_words='$key_words', description='$description', seo_info='$seo_info';");
		$form_htm=RD."/tpl/save_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Конфигурацию сайта &quot;$title&quot; успешно сохранено";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}","",$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад",$form);
		$form=str_replace("{back_url}","?$url&dep_up=$dep_up",$form);
		return $form;
	}
}
?>