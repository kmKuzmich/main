<?php
class usefull {
	function show_usefull(){
		$slave=new slave;$mdl=new module;$url=$mdl->get_file_url();
		
		$form_htm=RD."/tpl/usefull_show.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$cont_htm=RD."/../tpl/usefull.htm";
		if (!file_exists("$cont_htm")){ $cont="Не знайдено інформації"; }
		if (file_exists("$cont_htm")){ $cont = file_get_contents($cont_htm);}
		
		
		$form=str_replace("{cont}",$cont,$form);
		$form=str_replace("{url}","?$url&wn=edit",$form);
		return $form;
	}
	
	function show_usefull_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/usefull_form.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$cont_htm=RD."/../tpl/usefull.htm";
		if (!file_exists("$cont_htm")){ $cont="Не знайдено інформації"; }
		if (file_exists("$cont_htm")){ $cont = file_get_contents($cont_htm);}
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc") ;
		$editor->BasePath = "../fckeditor/";
		$editor->Lang = "ua";
		$editor->Value	= "$cont" ;

		
		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		
		$form=str_replace("{desc}", $editor->Create(), $form);
		
		return $form;
	}
	
	function save_usefull_form(){$mdl=new module;$url=$mdl->get_file_url();
		$desc=str_replace('\\',"",$_POST["desc"]);
		$fd = fopen (RD."/../tpl/usefull.htm", "w");
		fwrite ($fd,$desc);
		fclose ($fd);
		
		$form_htm=RD."/tpl/save_message.htm";
		if (!file_exists("$form_htm")){ $form="Не знайдено файл шаблону"; }
		if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$message="Информацию о партнерах сохранено";
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}","",$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;	
	}	
}
?>
