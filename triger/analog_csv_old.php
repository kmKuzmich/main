<?php

//This is what I use to turn off pretty much anything that could cause unwanted output buffering and turn on implicit flush:
//Disable this part for comand line
/*@apache_setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('implicit_flush', 1);
 for ($i = 0; $i < ob_get_level(); $i++) { ob_end_flush(); }
  ob_implicit_flush(1);
*/

//Выгрузка аналогов ver.2 2015/10/04 (prev.ver.1 2015/09/25)
//Изменён сервер АМО
//Добавлена подмена активной таблицы, с бэкапом предыдущей
//Добавлена проверка если аналогов меньше 2,4млн то генерировать ошибку и не проводить подмену.

$beg=0; //если =1 то выполнить выгрузку иначе выйти из скрипта.
if ($beg){

$start_php=date('r');
$start = microtime(true);
ini_set('max_execution_time', 13000);

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define('RD', dirname (__FILE__));
require_once ('c:/Avtolider-Shop/lib/odbc_class.php');
$odb1=new odb;
$odb1->query_lider("create variable @last_id integer ");
$odb1->query_lider("insert into Local(user_id) values(-9);");
$odb1->query_lider("SET OPTION DATE_ORDER = 'DMY';");
$odb1->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
$odb1->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");

//Сервер АМО
$dbHost='192.168.0.1';
$dbName='catalog_tecdoc_2015q1';
$dbUser='ssd-test-user';
$dbPass='g4cxPbtryf4G5GNq';
$myConnect = mysql_connect($dbHost,$dbUser,$dbPass); 
mysql_select_db($dbName,$myConnect);
mysql_query("set names utf8");
mysql_query("TRUNCATE al_analog");

/*mysql_query("DROP TABLE IF EXISTS al_analog");
mysql_query("	
	CREATE TABLE IF NOT EXISTS `al_analog` (
	`item_id` INT(11) DEFAULT NULL,
	`cross_item_id` INT(11) DEFAULT NULL,
	KEY `cross_idx` (`item_id`),
	KEY `item_id` (`cross_item_id`)
	) ENGINE=INNODB DEFAULT CHARSET=utf8
");*/


$r0=$odb1->query_lider("select p.id,p.name,count(*) as rs from Producent p join item i on i.prod_id=p.id join store s on i.id=s.item_id where s.kind=1  
and i.prod_id in (999,1084) 
group by p.id,p.name order by 1");
 
$total_rows=0; $e=0; $index=0;
while (odbc_fetch_row($r0)) {
$file_prods[$index][1]=odbc_result($r0,"id");
$file_prods[$index][2]=odbc_result($r0,"rs");
$file_prods[$index][3]=odbc_result($r0,"name");
$index++;
};

odbc_close_all();
mysql_close($myConnect);

for ($index = 0; $index < count($file_prods); $index++) {

$odb=new odb;
$odb->query_lider("create variable @last_id integer ");
$odb->query_lider("insert into Local(user_id) values(-9);");
$odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
$odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");

$myConnect = mysql_connect($dbHost,$dbUser,$dbPass); 
mysql_select_db($dbName,$myConnect);
mysql_query("set names utf8");


$prod_id=$file_prods[$index][1];

$start_select = microtime(true);

$odb->query_lider("select
    cast(null as smallint) as lev,
    cast(null as integer) as item_id1,
    cast(null as integer) as item_id2 into #a
where item_id1 is not null");

$odb->query_lider("
for cur as curs cursor for 
   select number() as n,
              id 
  from Item
  where prod_id=".$prod_id."
 do
  call ListAnalog(id);
  insert into #a(lev,item_id1,item_id2)
    select T1.lev,T.item_id, T1.item_id
   from AnalogTemp T,
        AnalogTemp T1
  where T.lev=0
   and T1.lev>0
   and T1.dop=0;
//   if n>10 then  return;  end if;
end for 
");

$time_select = microtime(true) - $start_select;
echo '<br> Выгрузка аналогов по бренду '.$file_prods[$index][1].'='.$file_prods[$index][3].' выполнялась: ' .round($time_select,4).' сек; ' ;
        
$r1=$odb->query_lider("select * from #a");


$start_insert = microtime(true);
$j=0;
while (odbc_fetch_row($r1)) {
            $item_id1=odbc_result($r1,"item_id1") ;
            $item_id2=odbc_result($r1,"item_id2") ;
            $sql = ("insert into al_analog (item_id,cross_item_id) values('$item_id1','$item_id2');");

            if ( !mysql_query($sql) ) {
			echo "Error inserting item_id: ".$item_id1."<br/>"; $e++;//.PHP_EOL; 
			} else {
			$j++;
			}
}
$time_insert = microtime(true) - $start_insert;

//echo ' Запись в БД MySQL: ' .round($time_insert,4). ' сек '.$j.' записей ';


$string = date('r').' Выгрузка аналогов по бренду '.$file_prods[$index][1].'='.$file_prods[$index][3].' выполнялась: ' .round($time_select,4). ' сек; Запись в БД MySQL: ' .round($time_insert,4). ' сек; Чтения и запись выполнялись: ' .round($time_select+$time_insert,4). ' сек; Количество записаных строк: ' .$j. ' в таблицу - al_analog';
$log_string=$string."\r\n".$log_string;

if(! $myConnect )
{
  die('Could not connect: '.mysql_error());
}
$total_rows+=$j;
odbc_close_all();
mysql_close($myConnect);
};

$myConnect = mysql_connect($dbHost,$dbUser,$dbPass); 
mysql_select_db($dbName,$myConnect);
mysql_query("set names utf8");

//Если аналогов больше 2,4млн подставить в новую базу, иначе ОШИБКА!
if ($total_rows>'2400000') {
$sql_Rename="DROP TABLE al_crossing3";
if ( !mysql_query($sql_Rename) ) {
	$mytext=$mytext."Error while dropping "."<br>\n\r"; //.PHP_EOL;
	echo $mytext;
	$e++;} else {$mytext=$mytext."Drop SUCSESS!";}
$sql_Rename="RENAME TABLE al_crossing TO al_crossing3,al_analog TO al_crossing";
if ( !mysql_query($sql_Rename) ) {
		$mytext=$mytext."Error While Rename : ".PHP_EOL."<br>\r\n"; $e++;//.PHP_EOL; 
		echo  $mytext;//.PHP_EOL; 
	} else { 
		$mytext=$mytext."Rename Sucsess !<br>\r\n";
		}
mysql_close($myConnect);
} else{
$e++;
$mytext=$mytext."Ошибка:".$e." ВНИМАНИЕ! АКТИВНАЯ ТАБЛИЦЫ АНАЛОГОВ НЕ ИЗМЕНЕНА! ПОТОМУ ЧТО аналогов ".$total_rows." меньше 2,4млн. Дальнейшую подмену таблиц проведи вручную\n\r";
}
$mytext=$mytext.date('r')." Работа закончена за ".round(microtime(true)-$start)." сек ! база ".$odb->source_lider.". Всего строк :".$total_rows.". ОШИБОК во время загрузки :".$e."\r\n";
//echo "<hr>".$mytext."<br>";
}
else {
	$mytext=date('r')."  Выгрузка не проводилась - отключено в скрипте \r\n";
	echo "<hr><br>".$mytext."<br>";
	};
	
$last=file_get_contents('c:\Avtolider-Shop\triger\analog_log.txt');
$fp=fopen("c:\\Avtolider-Shop\\triger\\analog_log.txt",'w');
$head = "======== ".$start_php." ========= Общее время выполнения: ".round(microtime(true)-$start,4)." сек ============================================================================================================ " .date('r'). " ========================== \r\n";
$log  = $head. "\r\n" .$log_string. "\r\n" .$last;
fwrite($fp, $log);
fclose($fp);
?>