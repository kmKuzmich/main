<?php
error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', false);
@ini_set('html_errors', false);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);
define('RD', dirname (__FILE__));
require_once ("lib/mysql_class.php");
require_once ("lib/slave_class.php");
$db = new db;$slave = new slave;
/*if (file_exists("import_data/Analog.txt")){
	$fp = fopen ("import_data/Analog.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_analog;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$data=explode(",",$line);$k++;
		$item_id1=$data[0];$item_id2=$data[1];$dop=$data[2];
		$db->query("insert into lider_analog (`item_id1`,`item_id2`,`dop`) values ('$item_id1','$item_id2','$dop');");
	}
	fclose ($fp);
	print "ok analog: $k;<br>";
}
if (file_exists("import_data/Cat.txt")){
	$fp = fopen ("import_data/Cat.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_category;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$data=explode(",",$line);$k++;
		$id=$data[0];$name=str_replace("'","",$data[1]);
		$db->query("insert into lider_category (`id`,`name`) values ('$id','$name');");
	}
	fclose ($fp);
	print "ok category: $k;<br>";
}
if (file_exists("import_data/Mod.txt")){
	$fp = fopen ("import_data/Mod.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_models;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$data=explode(",",$line);$k++;
		$id=$data[0];$name=str_replace("'","",$data[1]);
		$db->query("insert into lider_models (`id`,`name`) values ('$id','$name');");
	}
	fclose ($fp);
	print "ok models: $k;<br>";
}
if (file_exists("import_data/Prod.txt")){
	$fp = fopen ("import_data/Prod.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_producent;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$data=explode(",",$line);$k++;
		$id=$data[0];$name=str_replace("'","",$data[1]);
		$db->query("insert into lider_producent (`id`,`name`) values ('$id','$name');");
	}
	fclose ($fp);
	print "ok producent: $k;<br>";
}
if (file_exists("import_data/Unit.txt")){
	$fp = fopen ("import_data/Unit.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_unit;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$data=explode(",",$line);$k++;
		$id=$data[0];$name=str_replace("'","",$data[1]);$prec=$data[2];
		$db->query("insert into lider_unit (`id`,`name`,`prec`) values ('$id','$name','$prec');");
	}
	fclose ($fp);
	print "ok unit: $k;<br>";
}
if (file_exists("import_data/Item_all.txt")){
	$fp = fopen ("import_data/Item_all.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_items;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$line=substr($line,1,-3);
		$data=explode("','",$line);$k++;
		//   '74387','OPTIMAL. NISSAN Подшипник передн. SUNNY,MITSUBISHI (38*65*17)','23','18','92','1','42.8300','0-016 opti','978','101.4000','','','','','2','','','','3.4821','8.4500','','0016opti','','ПІДШИПНИК СТУПИЦІ','8482109000','20'
		
		$db->query("insert into lider_items (`id`,`Name`,`cat_id`,`model_id`,`prod_id`,`unit_id`,`PriceZak`,`code`,`val_id`,`PricePro`,`help`,`aPricePro`,`minQuant`,`dateAdd`,`sign`,`flag`,`PriceZakV`,`Remark`,`vPriceZak`,`vPricePro`,`skid_id`,`scode`,`isImage`,`NameUA`,`uktzed`,`discount_id`) values ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".$data[13]."','".$data[14]."','".$data[15]."','".$data[16]."','".$data[17]."','".$data[18]."','".$data[19]."','".$data[20]."','".$data[21]."','".$data[22]."','".$data[23]."','".$data[24]."','".$data[25]."');");
	}
	fclose ($fp);
	print "ok items: $k;<br>";
}
if (file_exists("import_data/Store.txt")){
	$fp = fopen ("import_data/Store.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_store;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$line=substr($line,1,-3);
		$data=explode("','",$line);$k++;
		//   '525695','1','2880896','31.0865','','4','7','3.00'
		
		$db->query("insert into lider_store (`item_id`,`kind`,`inc_id`,`PriceZak`,`vPriceZak`,`n`,`SubConto_id`,`quant`) values ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."');");
	}
	fclose ($fp);
	print "ok store: $k;<br>";
}
if (file_exists("import_data/Discounts.txt")){
	$fp = fopen ("import_data/Discounts.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_discounts;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$line=substr($line,1,-3);
		$data=explode("','",$line);$k++;
		//   '525695','1','2880896','31.0865','','4','7','3.00'
		
		$db->query("insert into lider_discounts (`discount_id`,`group_id`,`skid`,`profit`,`koef`) values ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."');");
	}
	fclose ($fp);
	print "ok discounts: $k;<br>";
}
if (file_exists("import_data/Valuta.txt")){
	$fp = fopen ("import_data/Valuta.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_valuta;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$line=substr($line,1,-3);
		$data=explode("','",$line);$k++;
		//   '840','доллары','9.00000000','USD','1',''
		
		$db->query("insert into lider_valuta (`id`,`name`,`kurs`,`uname`,`isCurrent`,`kursBN`) values ('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."');");
	}
	fclose ($fp);
	print "ok valuta: $k;<br>";
}
if (file_exists("import_data/SubContoTypes.txt")){
	$fp = fopen ("import_data/SubContoTypes.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_subcontotypes;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$line=substr($line,1,-3);
		$data=explode("','",$line);$k++;
		//   '840','доллары','9.00000000','USD','1',''
		
		$db->query("insert into lider_subcontotypes (`SubConto_id`,`SubContoType_id`) values ('".$data[0]."','".$data[1]."');");
	}
	fclose ($fp);
	print "ok SubContoTypes: $k;<br>";
}

if (file_exists("import_data/SubConto.txt")){
	$fp = fopen ("import_data/SubConto.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;
	$db->query("delete from lider_subconto;");
	while (!feof($fp)) {
		$line_str=fgets($fp,4096);
		$line_str=substr($line_str,1,-3);
		if (substr($line_str,-1)!="'"){$line.=$line_str; }
		if (substr($line_str,-1)=="'"){
			$line.=$line_str;
			$data=explode("','",$line);$k++;
			$query="insert into lider_subconto values (";
			for ($i=1;$i<=40;$i++){$query.="'".str_replace("'","\'",trim(trim($data[$i-1],"\t")))."'"; if ($i<40){$query.=", ";}}
			$query.=");";
			$db->query($query);
			$line="";
		}
	}
	fclose ($fp);
	print "ok SubConto: $k;<br>";
}
if (file_exists("import_data/globalvar.txt")){
	$fp = fopen ("import_data/globalvar.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;$m=6;
	$db->query("delete from lider_globalvar;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$line=substr($line,1,-3);
		$data=explode("','",$line);$k++;
		//   '840','доллары','9.00000000','USD','1',''
		$query="insert into lider_globalvar values (";
		for ($i=1;$i<=$m;$i++){$query.="'".str_replace("'","\'",$data[$i-1])."'"; if ($i<$m){$query.=", ";}}
		$query.=");";
		$db->query($query);
	}
	fclose ($fp);
	print "ok globalvar: $k;<br>";
}
if (file_exists("import_data/SubContoKred.txt")){
	$fp = fopen ("import_data/SubContoKred.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;$m=3;
	$db->query("delete from lider_subconto_kred;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$line=substr($line,1,-3);
		$data=explode("','",$line);$k++;
		//   '840','доллары','9.00000000','USD','1',''
		$query="insert into lider_subconto_kred values (";
		for ($i=1;$i<=$m;$i++){$query.="'".str_replace("'","\'",$data[$i-1])."'"; if ($i<$m){$query.=", ";}}
		$query.=");";
		$db->query($query);
	}
	fclose ($fp);
	print "ok lider_subconto_kred: $k;<br>";
}
if (file_exists("import_data/KlientUnion.txt")){
	$fp = fopen ("import_data/KlientUnion.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;$m=2;
	$db->query("delete from  klientunion;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		$line=substr($line,1,-3);
		$data=explode("	",$line);$k++;
		//   '840','доллары','9.00000000','USD','1',''
		$query="insert into klientunion values (";
		for ($i=1;$i<=$m;$i++){$query.="'".str_replace("'","\'",$data[$i-1])."'"; if ($i<$m){$query.=", ";}}
		$query.=");";
		$db->query($query);
	}
	fclose ($fp);
	print "ok klientunion: $k;<br>";
}
*/
if (file_exists("import_data/kinddoc_id.txt")){
	$fp = fopen ("import_data/kinddoc_id.txt","r");
	if (!$fp){ echo 'Can\'t open file!'; return; }
	$k=0;$m=5;
	$db->query("delete from lider_kinddoc_id;");
	while (!feof($fp)) {
		$line=fgets($fp,4096);
		//$line=substr($line,1,-3);
		$data=explode("\t",$line);$k++;
		//   '840','доллары','9.00000000','USD','1',''
		$query="insert into lider_kinddoc_id values (";
		for ($i=1;$i<=$m;$i++){$query.="'".str_replace("'","\'",$data[$i-1])."'"; if ($i<$m){$query.=", ";}}
		$query.=");";
		$db->query($query);
	}
	fclose ($fp);
	print "ok kinddoc_id: $k;<br>";
}
?>