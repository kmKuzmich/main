<?php

/*This is script to update Oil Catalog tables in MySQL DB news.
You must set files to path /uploads/file/
t1.xls Motor oil - Моторное масло
t2.xls Liquids and Grease - Жидкости и смазки
t3.xls Transmission Oil - Трансмиссионное масло
t4.xls Chemistry and Auto-Cosmetics - Химия и косметика
*/

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define('RD', dirname (__FILE__));
$content=null;
require_once (RD."/lib/mysql_lider2_class.php");$db=new dbl;
require_once (RD."/lib/slave_class.php");$slave=new slave;
require_once RD.'/excel/excel_reader2.php';



$r=$db->query_lider("select * from items_name  order by id asc;");$n=$db->num_rows($r);
for ($i=1;$i<=$n;$i++){
	$id=$db->result($r,$i-1,"id");
	$caption=$db->result($r,$i-1,"caption");
	$file=$db->result($r,$i-1,"file");
	$fKol=$db->result($r,$i-1,"kol_colums");
	$file_path=RD."/uploads/file/$file.xls";
	if (file_exists($file_path)){$fn=0;
		$data = new Spreadsheet_Excel_Reader($file_path,true,"CP1251");
		$rows=$data->rowcount($sheet); if ($rows==0){$rows=$data->rowcount(0); $sheet=0;}
		if ($rows>0){ $db->query_lider("truncate table items_$file;");
			for ($k=2;$k<=$rows;$k++){$fn+=1;$query="";$ffkol=0;
				for ($j=1;$j<=$fKol;$j++){$prm=$slave->qq(str_replace("'","\'",$data->val($k,$j,$sheet))); $query.="'$prm',"; }
				$query=substr($query,0,-1);
				$db->query_lider("insert into `items_$file` values ($query);");
			}	
		}
	}
	
}
print "end";
?>