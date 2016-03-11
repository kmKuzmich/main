<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define("RD", dirname (__FILE__));




require_once (RD."/lib/odbc_class.php");$odb=new odb;
$odb->query_lider("create variable @val_id integer");
$odb->query_lider("create variable @base_id integer ");
$odb->query_lider("create variable @place_id integer ");
$odb->query_lider("create variable @user_id integer ");

$odb->query_lider("create variable @doc_id integer ");
$odb->query_lider("create variable isVal smallint ");
$odb->query_lider("create variable @showRemove smallint ");
$odb->query_lider("create variable @kurs double ");
$odb->query_lider("create variable ErrorMessage char(255) ");
$r=$odb->query_lider("insert into Local(user_id) values(-1);");
$r=$odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
$r=$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
$r=$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY'; ");
$r=$odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");
$odb->query_lider("create variable @last_id integer ");
$r=$odb->query_lider("insert into Local(user_id) values(-1);");
$r=$odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
$r=$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
$r=$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY'; ");
$r=$odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");
/*

$r=$odb->query_td("select * from orders where status='16' and data='2013-05-13' order by id asc;");
while(odbc_fetch_row($r)){
	$order_id=odbc_result($r,"id");
	$doc_id=odbc_result($r,"doc_id");
	$doc_num=odbc_result($r,"doc_num");
	$client=odbc_result($r,"client");
	
	$r1=$odb->query_lider("select * from doc where id='$doc_id' and num='$doc_num';");$lider_doc_id=0;
	while(odbc_fetch_row($r1)){
		$lider_doc_id=odbc_result($r1,"id");
	}
	if ($lider_doc_id!=$doc_id and $doc_id!=0){
		print "doc_id=$doc_id, $doc_num<br />";
		
		$r2=$odb->query_lider("call insertdoc(12);");odbc_fetch_row($r2);$doc_new_id=odbc_result($r2,"id");$doc_new_num=odbc_result($r2,"num");
		$odb->query_lider("insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_new_id','0',now(),'-1','18');");
		$odb->query_lider("update doc set opl=2 where id='$doc_new_id';");
		$odb->query_td("update orders set doc_id='$doc_new_id',doc_num='$doc_new_num', status='12' where id='$order_id';");
		
		print "client=$client, doc_id=$doc_new_id, doc_num=$doc_new_num<br />";

	}
}
*/
?>