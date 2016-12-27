<!DOCTYPE html>
    <HTML>
    <HEAD>
        <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="TEXT/HTML"; CHARSET="UTF-8">
        <TITLE> Тестовое подключение к PostGreSQL</TITLE>

        <style>

        </style>
    <HEAD>
<?php

/**
 * Created by PhpStorm.
 * User: Kuzichkin
 * Date: 21.02.16
 * Time: 17:39
 */
//phpinfo();

function print_ln($str1){
    echo $str1;
    echo'<br />';
};

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define("RD", dirname (__FILE__));
require_once (RD."/odbc_class.php");

echo RD."/odbc_errors/pg_error.txt",$fp;
$fp = fopen("odbc_errors/pg_error.txt", 'a+');
fwrite($fp,"PG-> data=".date("Y-m-d H:i:s")." : ".pg_last_error($this->db_pg)."\r\n".$escaped_query."\r\n");
fclose($fp);


//Opening connection

/*$db_pg = pg_connect("host=localhost dbname=Sales user=dba password=sql") or die('Could not connect: '.pg_last_error($db_pg));

//Check connection

if (!$db_pg) {
    print_ln("Соединение не установлено! закругляемся");
    exit;
}*/


print_ln("Соединение установлено! ".$db_pg);
$pg = new odb;

//$result = pg_query($db_pg,'select p.name,count(*) from item i JOIN producent p on i.prod_id=p.id  GROUP by p.name'); //where i.prod_id in (1,939)
$result = $pg->query_pg('select p.name,count(*) from item i JOIN producent p on i.prod_id=p.id where i.prod_id1 <100 GROUP by p.name'); //where i.prod_id in (1,939)

while ($row = pg_fetch_row($result)) {
    print_ln( "по $row[0] строк в прайсе всего ;$row[1]");
}
//pg_close($db_pg);

?>

<HTML>
