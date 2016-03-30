<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define("RD", dirname (__FILE__));

require_once (RD."/../lib/odbc_class.php");$odb=new odb;
/*$odb->query_lider("create variable @val_id integer");
$odb->query_lider("create variable @base_id integer ");
$odb->query_lider("create variable @place_id integer ");
$odb->query_lider("create variable @user_id integer ");
$odb->query_lider("create variable @last_id integer ");
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
$r=$odb->query_lider("insert into doc (SubConto_id,sum,sum1,nds,day,sDay,tm,user_id,KindDoc_id,Num,id1,opl,osum,place_id,oper_id,nzak_id,base_id,list_id,Remark,val_id,SubConto_id1,sNum,group_id,sumZ,vsum,quant,vosum,KindOpl_id,vsum1,sch_id,vsumZ,cuser_id,car_id,klient_id,flag)
values (13144,1145.88,1404.80,190.98,'26-07-2012','09-08-2012',now(),122,3,27518,2952559,1,1145.88,23,Null,Null,1,Null,Null,Null,13724,Null,5,868.29,Null,Null,127.32,Null,Null,Null,Null,122,Null,Null,Null);");
$r=$odb->query_lider("SELECT @last_id;");odbc_fetch_row($r);$mid=odbc_result($r,"@last_id");print "inserted_id=".$mid;*/

/*
insert into Local(user_id) values(-1);" +
" SET OPTION DATE_ORDER = 'DMY'; "+
" SET OPTION DATE_FORMAT = 'DD-MM-YYYY'; "+
" SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS'; " );
*/

$mid=odbc_result($r,"id");print "id=".$mid;
$num=odbc_result($r,"num");print "num=".$num;
print odbc_errormsg()."<br />";

//$r=$odb->query_lider("SELECT @last_id;");odbc_fetch_row($r);$mid=odbc_result($r,"@last_id");print "last2=".$mid;
$r=$odb->query_lider("SELECT ErrorMessage;");odbc_fetch_row($r);$error=odbc_result($r,"ErrorMessage");print "error=".$error;
//$r=$odb->query_lider("update doc set subconto_id='11913' where id='3333000';");
odbc_close_all();
