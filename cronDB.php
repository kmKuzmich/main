<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define('RD', dirname (__FILE__));
$content=null;
require_once (RD."/lib/mysql_class.php");
$db=new db;
require_once (RD."/lib/mysql_lider2_class.php");
$dbl=new dbl;
require_once (RD."/lib/slave_class.php");$slave=new slave;


//$dbl->query_lider("delete from news;"); 
$r=$db->query_lider("select * from news order by id asc;");$n=$db->num_rows($r);
if ($n>0) $dbl->query_lider("delete from news;");
for ($i=1;$i<=$n;$i++){
	$id=$db->result($r,$i-1,"id");
	$caption_ru=$db->result($r,$i-1,"caption_ru");
	$caption_en=$db->result($r,$i-1,"caption_en");
	$short_desc_ru=$db->result($r,$i-1,"short_desc_ru");
	$short_desc_en=$db->result($r,$i-1,"short_desc_en");
	$desc_ru=$db->result($r,$i-1,"desc_ru");
	$desc_en=$db->result($r,$i-1,"desc_en");
	$data=$db->result($r,$i-1,"data");
	$author_ru=$db->result($r,$i-1,"author_ru");
	$author_en=$db->result($r,$i-1,"author_en");
	$dbl->query_lider("insert into news (`id`,`caption_ru`,`caption_en`,`short_desc_ru`,`short_desc_en`,`desc_ru`,`desc_en`,`data`,`author_ru`,`author_en`) values ('$id','$caption_ru','$caption_en','$short_desc_ru','$short_desc_en','$desc_ru','$desc_en','$data','$author_ru','$author_en');");
	
}
//$db.close();$dbl.close();
//$dbl->query_lider("delete from actions;");
$r=$db->query_lider("select * from actions where visible='1' order by id asc;");$n=$db->num_rows($r);
if ($n>0) $dbl->query_lider("delete from actions;");

for ($i=1;$i<=$n;$i++){
	$id=$db->result($r,$i-1,"id");
	$caption_ru=$db->result($r,$i-1,"caption_ru");
	$caption_en=$db->result($r,$i-1,"caption_en");
	$short_desc_ru=$db->result($r,$i-1,"short_desc_ru");
	$short_desc_en=$db->result($r,$i-1,"short_desc_en");
	$desc_ru=$db->result($r,$i-1,"desc_ru");
	$desc_en=$db->result($r,$i-1,"desc_en");
	$file=$db->result($r,$i-1,"file");
	$time=$db->result($r,$i-1,"time");
	$url=$db->result($r,$i-1,"url");
	$data_from=$db->result($r,$i-1,"data_from");
	$data_to=$db->result($r,$i-1,"data_to");
	$lenta=$db->result($r,$i-1,"lenta");
	$visible=$db->result($r,$i-1,"visible");
	$dbl->query_lider("insert into actions (`id`,`caption_ru`,`caption_en`,`short_desc_ru`,`short_desc_en`,`desc_ru`,`desc_en`,`file`,`time`,`url`,`data_from`,`data_to`,`lenta`,`visible`) values ('$id','$caption_ru','$caption_en','$short_desc_ru','$short_desc_en','$desc_ru','$desc_en','$file','$time','$url','$data_from','$data_to','$lenta','$visible');");
}


$r=$db->query_lider("select * from catalogue order by id asc;");$n=$db->num_rows($r);
if ($n>0) $dbl->query_lider("delete from catalogue;");
for ($i=1;$i<=$n;$i++){
	$id=$db->result($r,$i-1,"id");
	$caption_ru=$db->result($r,$i-1,"caption_ru");
	$caption_en=$db->result($r,$i-1,"caption_en");
	$country_ru=$db->result($r,$i-1,"country_ru");
	$country_en=$db->result($r,$i-1,"country_en");
	$production_ru=$db->result($r,$i-1,"production_ru");
	$production_en=$db->result($r,$i-1,"production_en");
	$site=$db->result($r,$i-1,"site");
	$short_desc_ru=$db->result($r,$i-1,"short_desc_ru");
	$short_desc_en=$db->result($r,$i-1,"short_desc_en");
	$desc_ru=$db->result($r,$i-1,"desc_ru");
	$desc_en=$db->result($r,$i-1,"desc_en");
	$desc_production_ru=$db->result($r,$i-1,"desc_production_ru");
	$desc_production_en=$db->result($r,$i-1,"desc_production_en");
	$lenta=$db->result($r,$i-1,"lenta");
	$visible=$db->result($r,$i-1,"visible");
	
	$dbl->query_lider("insert into catalogue (`id`,`caption_ru`,`caption_en`,`country_ru`,`country_en`,`production_ru`,`production_en`,`site`,`short_desc_ru`,`short_desc_en`,`desc_ru`,`desc_en`,`desc_production_ru`,`desc_production_en`,`lenta`,`visible`) values ('$id','$caption_ru','$caption_en','$country_ru','$country_en','$production_ru','$production_en','$site','$short_desc_ru','$short_desc_en','$desc_ru','$desc_en','$desc_production_ru','$desc_production_en','$lenta','$visible');");
	
}

?>