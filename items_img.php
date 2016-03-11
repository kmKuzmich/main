<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define("RD", dirname (__FILE__));
require_once (RD."/lib/odbc_class.php");$odb=new odb;



$handle=fopen("http://webservicepilot.tecdoc.net/pegasus-2-0/documents/20122/2188352/0", "rb");
$docImage=stream_get_contents($handle);
fclose($handle);
$fp = fopen('uploads/images/lider/2188352_td.jpg', 'w');
fwrite($fp, $docImage);
fclose($fp);
print "<img src='uploads/images/lider/2188352_td.jpg'>";


/*

$r=$odb->query_td("select * from item order by id asc;");
while(odbc_fetch_row($r)){
	$id=odbc_result($r,"id");
	if (file_exists("lider_images/$id.jpg")){ $odb->query_td("insert into itemimages (item_id,file_name,istd) values ('$id','$id.jpg','0');"); print "$id.jpg<br />"; }
	if (file_exists("lider_images/$id"."-1.jpg")){ $odb->query_td("insert into itemimages (item_id,file_name,istd) values ('$id','$id"."-1.jpg','0');"); print "$id-1.jpg<br />"; }
	if (file_exists("lider_images/$id"."-2.jpg")){ $odb->query_td("insert into itemimages (item_id,file_name,istd) values ('$id','$id"."-2.jpg','0');"); print "$id-2.jpg<br />"; }
}
*/
?>