<?php
class price_send {
	function presend_price_form(){
		$db=new db; $slave=new slave;$mdl=new module;
		$form_htm=RD."/tpl/presend_price_form.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$data=$slave->data_word(date("Y-m-d"));
		$message = file_get_contents(RD."/tpl/price_send_message.htm");
		$message=str_replace("{data}",$data,$message);
		
		include("../fckeditor/fckeditor.php") ;
		$editor = new FCKeditor("desc") ; $editor->BasePath = "../fckeditor/"; $editor->Lang = "ua"; $editor->Value	= $message;

		$form=str_replace("{module}", $slave->get_module(), $form);
		$form=str_replace("{module_page}", $slave->get_module_page(), $form);
		$form=str_replace("{file}", $slave->get_file(), $form);
		$form=str_replace("{w}", $slave->get_w(), $form);
		$form=str_replace("{dep_up}", $slave->get_dep_up(), $form);
		$form=str_replace("{dep_cur}", $slave->get_dep_cur(), $form);
		$form=str_replace("{wn}", "send", $form);
		$form=str_replace("{desc_form}", $editor->Create(), $form);
		$form=str_replace("{data}", date("Y-m-d"), $form);
		$form=str_replace("{file_list}", $this->show_file_list(), $form);
		return $form;
	}
	
	function send_price_send(){
		include_once "../lib/libmail.php";
		$db=new db; $slave=new slave;$mdl=new module;$url=$mdl->get_file_url();

		$message=$this->make_url_ok($_POST["desc"]);

		$r=$db->query("select email,discount from clients where sublist='1' order by id asc;");
		$n=$db->num_rows($r);
		if ($n>0){
			for ($i=1;$i<=$n;$i++){
				$email=$db->result($r,$i-1,"email");
				$discount=$db->result($r,$i-1,"discount");
				
				$m= new Mail;
				$m->From( "robot@omega.km.ua" );
				$m->To( $email);
				$m->Subject( 'Price компьютерный центр "ОМЕГА" www.omega.km.ua: '.$data);
				$m->Body( $message);
				$m->Attach("../../price/price$discount.rar", "", "inline" );
				$m->Priority(1) ;
				$m->Send();
			}
			$message="Рассылка успешно выполненна";
		}
		if ($n==0){
			$message="Ошибка!. Рассылка не выполенна";
		}
		
		$form_htm=RD."/tpl/save_message.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		
		$form=str_replace("{message}",$message,$form);
		$form=str_replace("{navigation}","",$form);
		$form=str_replace("{dep_menu}","",$form);
		$form=str_replace("{back_caption}","Назад",$form);
		$form=str_replace("{back_url}","?$url",$form);
		return $form;
	}
	
	function show_file_list(){
		$form="
		<table width='400' border=1>";
		if (is_dir("../../price")) {
		    if ($dh = opendir("../../price")) {
        		while (($file = readdir($dh)) !== false) {
					if( $file != "." and $file != ".."){
						$size=filesize("../../price/$file");
						$data=date("Y-m-d H:i:s", filectime("../../price/$file"));
						$form.="
							<tr align='center'>
								<td align='left'>&nbsp;<strong>$file</strong></td>
								<td align='right' width='150'>&nbsp; <strong>$data</strong></td>
								<td align='right' width='150'>&nbsp; <strong>$size bytes</strong></td>
							</tr>";
					}
		        }
        		closedir($dh);
    		}
		}
		$form.="</table>";
		return $form;
	}
	function make_url_ok($cont) { 
		$main_url="http://omega.km.ua";
		$cont=str_replace('\\"', '"', $cont);
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