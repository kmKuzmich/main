<?php

define('PROVIDER_ID', 20122);
define('TecdocToCat', "http://webservice-cs.tecdoc.net/pegasus-2-0/wsdl/TecdocToCat");
//define('TecdocToCat', "");
//define('TecdocToCat', "http://webservicepilot.tecdoc.net/pegasus-2-0/wsdl/TecdocToCat");
define('TecdocToCatDoc', "http://webservice-cs.tecdoc.net/pegasus-2-0/documents");


class config {
	function get_meta_data(){$odb=new odb; $slave=new slave;$title="";$key_words="";$description="";$seo_info="";
		$r=$odb->query_td("select * from config limit 0,1;");
		while(odbc_fetch_row($r)){
			$title=odbc_result($r,"title");
			$key_words=odbc_result($r,"key_words");
			$description=odbc_result($r,"description");
			$seo_info=odbc_result($r,"seo_info");
		}
		return array($title,$key_words,$description,$seo_info);
	}

	function get_module_file($file,$var){$odb=new odb;
		if ($var==1){ 
			$r=$odb->query_td("select file from module_files where id='$file';");$file="";
			while(odbc_fetch_row($r)){$file=odbc_result($r,"file");}
			return $file;
		}
		if ($var==2){ return $file;}
	}

	function one_side_content($content,$content_side,$bottom_side){ $slave=new slave; $dep=$slave->get_dep();
		$ww_htm=RD."/tpl/one_side_content.htm";if (file_exists("$ww_htm")){ $form = file_get_contents($ww_htm);}
		$form=str_replace("{content}",$content,$form);
		
		if ($dep==24 or $dep==23){  $form=str_replace("{fast1}","class='FastAct'",$form); }
		if ($dep==32){  $form=str_replace("{fast2}","class='FastAct'",$form); }
		if ($dep==31){  $form=str_replace("{fast3}","class='FastAct'",$form); }
		if ($dep==31 or $dep==1 or $dep==2 or $dep=="news"){
			$form=str_replace("{width1}","65px;",$form);
			$form=str_replace("{width2}","55px;",$form);
			$form=str_replace("{width3}","1050px;",$form);
			$form=str_replace("{width4}","1040px;",$form);
			
		}
		
		for ($i=1;$i<=4;$i++){ $form=str_replace("{fast$i}","class='Fast'",$form); }
		$form=str_replace("{width1}","315px;",$form);
		$form=str_replace("{width2}","235px;",$form);
		$form=str_replace("{width3}","800px;",$form);
		$form=str_replace("{width4}","790px;",$form);
		if ($bottom_side==""){$news=new news; $bottom_side=$news->show_range_news();}
		if ($bottom_side=="spo"){$cat=new catalogue; $bottom_side=$cat->showRecomendList("news");}
		$form=str_replace("{bottom_side}",$bottom_side,$form);
		$form=str_replace("{content_side}",$content_side,$form);
		return $form;
	}
	function ident_user(){
		$user=$_COOKIE["user"];
		if ($user==""){
			$key = "AvtoliderCnhfyybr2013"; // ключ для расшифрования
			$user = md5(date("YmdHis").$key);
			setcookie("user", $user);
		}
		return $user;
	}
}
?>