<?php
class slave {
	var $month_id;

	function get_month_name($month_id){
		$mnths = array ( 'm01' => "Січень", 'm02' => "Лютий", 'm03' => "Березень", 'm04' => "Квітень", 'm05' => "Травень", 'm06' => "Червень", 'm07' => "Липень", 'm08' => "Серпень", 'm09' => "Вересень",	'm10' => "Жовтень",	'm11' => "Листопад",'m12' => "Грудень");
		if (strlen($month_id)<2){$month_id="0".$month_id;}
		return $mnths["m$month_id"];
	}
	function data_word($data){
		return $this->data_word_ru($data);
	}
	function data_word_ua($data){
		$mon=substr($data,5,2);
		$mnths = array ( '01' => "Січня", '02' => "Лютого", '03' => "Березня", '04' => "Квітня", '05' => "Травня", '06' => "Червня", '07' => "Липня", '08' => "Серпня", '09' => "Вересня",	'10' => "Жовтня",	'11' => "Листопада",'12' => "Грудня");
		if (substr($data,8,1)=="0"){$day=substr($data,9,1);}
		if (substr($data,8,1)!="0"){$day=substr($data,8,2);}
		return $day." ".$mnths[$mon]." ".substr($data,0,4)." р.";
	}
	function data_word_ru($data){
		$mon=substr($data,5,2);
		$mnths = array ( '01' => "Января", '02' => "Февраля", '03' => "Марта", '04' => "Апреля", '05' => "Мая", '06' => "Июня", '07' => "Июля", '08' => "Августа", '09' => "Сентября",	'10' => "Октября",	'11' => "Ноября",'12' => "Декабря");
		if (substr($data,8,1)=="0"){$day=substr($data,9,1);}
		if (substr($data,8,1)!="0"){$day=substr($data,8,2);}
		return $day." ".$mnths[$mon]." ".substr($data,0,4)." г.";
	}
	function get_calendar($name){
		return "<a href='javascript:void(0)' onclick='gfPop.fPopCalendar(document.getElementById(\"$name\"));return false;' HIDEFOCUS><img name='popcal' align='absbottom' src='js/calendar/calbtn.gif' width='34' height='22' border='0' alt=''></a>
				<iframe width=174 height=189 name='gToday:normal:agenda.js' id='gToday:normal:agenda.js' src='js/calendar/ipopeng.htm' scrolling='no' frameborder='0' style='visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;'></iframe>";
	}
	function qq($q){ 
		$q=str_replace("''", "'", $q);
		$q=str_replace("''", "'", $q);
		$q=str_replace("'", "&rsquo;", $q);
		return $q; 
	}
	function qqback($q) { 
		$q=str_replace("&rsquo;", "'", $q);
		return $q; 
	}
	function qqback_in($q) { 
		$q=str_replace("&rsquo;", "'", $q);
		$q=str_replace("\"", htmlentities("\""), $q);
		return $q; 
	}
	function translit($st) {
		$st=strtr($st,"абвгдеёзийклмнопрстуфхъыэ_", "abvgdeeziyklmnoprstufh'iei");
		$st=strtr($st,"АБВГДЕЁЗИЙКЛМНОПРСТУФХЪЫЭ_", "ABVGDEEZIYKLMNOPRSTUFH'IEI");
		$st=strtr($st, array(
			"ж"=>"zh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", 
			"щ"=>"shch","ь"=>"", "ю"=>"yu", "я"=>"ya",
			"Ж"=>"ZH", "Ц"=>"TS", "Ч"=>"CH", "Ш"=>"SH", 
			"Щ"=>"SHCH","Ь"=>"", "Ю"=>"YU", "Я"=>"YA",
			"ї"=>"i", "Ї"=>"Yi", "є"=>"ye", "Є"=>"Ye"
		));
		return $st;
	}
	function int_to_money($int){
		if ($int!="Предзаказ"){
			$int=str_replace(",",".",$int);
			if (strpos($int,".")>0 and strpos($int,".")==strlen($int)-2){$int.="0";}
			if (strpos($int,".")==0){$int.=".00";}
		}
		return $int;
	}
	function get_date_from(){ if ($_POST["date_from"]==""){return $_GET["date_from"];} if ($_POST["date_from"]!=""){return $_POST["date_from"];} }
	function get_date_to(){ if ($_POST["date_to"]==""){return $_GET["date_to"];} if ($_POST["date_to"]!=""){return $_POST["date_to"];} }
	
	function get_dep(){ if ($_POST["dep"]==""){return $_GET["dep"];} if ($_POST["dep"]!=""){return $_POST["dep"];} }
	function get_dep_up(){ if ($_POST["dep_up"]==""){return $_GET["dep_up"];} if ($_POST["dep_up"]!=""){return $_POST["dep_up"];} }
	function get_dep_cur(){ if ($_POST["dep_cur"]==""){return $_GET["dep_cur"];} if ($_POST["dep_cur"]!=""){return $_POST["dep_cur"];} }
	function get_cur_id(){ if ($_POST["cur_id"]==""){return $_GET["cur_id"];} if ($_POST["cur_id"]!=""){return $_POST["cur_id"];} }
	function get_w(){ if ($_POST["w"]==""){return $_GET["w"];} if ($_POST["w"]!=""){return $_POST["w"];} }
	function get_wn(){ if ($_POST["wn"]==""){return $_GET["wn"];} if ($_POST["wn"]!=""){return $_POST["wn"];} }

	function get_file(){ if ($_POST["file"]==""){return $_GET["file"];} if ($_POST["file"]!=""){return $_POST["file"];} }
	function get_module(){ if ($_POST["module"]==""){return $_GET["module"];} if ($_POST["module"]!=""){return $_POST["module"];} }
	function get_module_page(){ if ($_POST["module_page"]==""){return $_GET["module_page"];} if ($_POST["module_page"]!=""){return $_POST["module_page"];} }
	
	function get_var(){ if ($_POST["var"]==""){return $_GET["var"];} if ($_POST["var"]!=""){return $_POST["var"];} }
	function get_link($srch,$lnk){ 
		$lnk.="&";
		$pos=strpos($lnk,$srch);
		$s="";$srch_val="";
		for ($i=$pos+strlen($srch)+1;$i<=strlen($lnk);$i++){
			$s=substr($lnk,$i,1);
			if ($s=="&"){ $i=strlen($lnk)+2; return $srch_val; }
			if ($s!="&"){ $srch_val.=$s;}
		}
		return $srch_val;
	}
	
	function resizeimage($image,$size,$filedir,$prefix){
		$prod_img=$filedir.$image;
		$prod_img_thumb=$filedir.$prefix.$image;
		if (file_exists("$prod_img")) {
			$sizes = getimagesize("$prod_img");
			$aspect_ratio = $sizes[0]/$sizes[1]; 
			$type=$sizes[2];
			if ($sizes[0] <= $size){
				$new_width = $sizes[0];
				$new_height = $sizes[1];
			}else{
				$new_width = $size;
				$new_height = abs($new_width/$aspect_ratio);
			}
			$destimg=imagecreatetruecolor($new_width,$new_height);

			if ($type==1){	$srcimg=ImageCreateFromGIF($prod_img); }
			if ($type==2){	$srcimg=ImageCreateFromJPEG($prod_img); }
			if ($type==3){	$srcimg=ImageCreateFromPNG($prod_img); }
			if ($type==4){	$srcimg=ImageCreateFromWBMP($prod_img); }

			imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg));
			if ($type==1){ ImageGIF($destimg,$prod_img_thumb,100);  }
			if ($type==2){	ImageJPEG($destimg,$prod_img_thumb,100); }
			if ($type==3){	imagecolortransparent($destimg, "");ImagePNG($destimg,$prod_img_thumb,100); }
			if ($type==4){	ImageWBMP($destimg,$prod_img_thumb,100); }
			
			imagedestroy($destimg);
		}
		return;
	}
	function get_file_deps($file){
		$db=new db;
		$r=$db->query("select id from module_files where file='$file';");
		$n=$db->num_rows($r);
		if ($n>0){
			$id=$db->result($r,0,"id");
			$r1=$db->query("select id,dep_up from deps where file='$id';");
			$n1=$db->num_rows($r1);
			if ($n1>0){ $dep_cur=$db->result($r1,0,"id");$dep_up=$db->result($r1,0,"dep_up");}
		}
		return array($dep_up,$dep_cur);
	}
}
?>