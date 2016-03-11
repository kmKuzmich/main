<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define('RD', dirname (__FILE__));
$content=null;
require_once (RD."/lib/mysql_lider2_class.php");$db=new dbl;
require_once (RD."/lib/slave_class.php");$slave=new slave;




$r=$db->query_lider("select * from items_name order by id asc;");$n=$db->num_rows($r);
for ($i=1;$i<=$n;$i++){
	$id=$db->result($r,$i-1,"id");
	$caption=$db->result($r,$i-1,"caption");
	$file=$db->result($r,$i-1,"file");
	$fKol=$db->result($r,$i-1,"kol_colums");
	
	$file_path=RD."/uploads/file/$file.csv";
	/*$csv = array_map('str_getcsv', file($file_path));
//	print_r($csv);
	if ($csv!=""){$fn=0; $db->query_lider("truncate table items_$file;");
		foreach($csv as &$row){$fn+=1;
			$buf=str_getcsv($row[0],";");
			if ($fn>1 && $buf!=""){  $query="";$ffkol=0;
				foreach($buf as $prm){ $ffkol+=1; if ($ffkol<=$fKol){ 
					$prm=str_replace("'","\'",$prm);//$prm=str_replace("?","",$prm);
					if ($prm=="1207791"){print_r($buf);print "$buf<br>";print $row[0].";;;;";}
					$query.="'$prm',";
					
				}}
				for ($j=$ffkol+1;$j<=$fKol;$j++){$query.="'',";}
				$query=substr($query,0,-1);
				$db->query_lider("insert into `items_$file` values ($query);");
			}
		}	
	}
	*/
	if (file_exists($file_path)){$fn=0;
		$handle = @fopen($file_path, "r");
		if ($handle) { $db->query_lider("truncate table items_$file;");
			while (($buffer = fgets($handle, 8192)) !== false) {$fn+=1;
				$buf=str_getcsv($buffer,";");
				if ($fn>1 && $buffer!=""){  $query="";$ffkol=0;
					foreach($buf as $prm){ $ffkol+=1; if ($ffkol<=$fKol){ 
						$prm=str_replace("'","\'",$prm);//$prm=str_replace("?","",$prm);
						$query.="'$prm',";
					}}
					for ($j=$ffkol+1;$j<=$fKol;$j++){$query.="'',";}
					$query=substr($query,0,-1);
					$db->query_lider("insert into `items_$file` values ($query);");
				}
			}	
			fclose($handle);
		}
	}
	
}
print "end";

?>