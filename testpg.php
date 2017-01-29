<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 20.07.2016
 * Time: 15:52
 * This script tests PG
 *
 */

/*
 * Function Println Prints arguments and makes EndOfLine by adding <br/>
 */

define('RD', dirname (__FILE__));

function println($str)
{
    echo $str . "<br />";
}

include_once 'lib/odbc_class.php';
$odb = new odb;

//$where = "prod_id in (1100,1)";
//$q = "select count(*) from item where $where ";
//
//$r = $odb->query_td($q);
//println("Total quant of $where is " . odbc_result($r,1));
//

//***try to search article art1

$by_producent="";
$exclude = " and prod_id not in (1134) and COALESCE( (sign & 2),0)=0";
$where2 = "";
if ($by_producent != "") {
    $where2 = " and prod_id='$by_producent' ";
}

$art1='d200e';
//$where = "(code LIKE '$art%') or (code LIKE '$art1%') or (scode LIKE '$art%') or (scode LIKE '$art1%')";
$where = "(code LIKE '$art1%') or (scode LIKE '$art1%')";

$q = "select *,getQuant(id) as q from item where $where $where2 $exclude order by id asc;";
$r = $odb->query_td($q);
//$n = $odbo->num_rows($r);
$id=0;
while (odbc_fetch_row($r)) {
    $id=odbc_result($r,id);
    $code=odbc_result($r,code);
    $prod_id=odbc_result($r,prod_id);
    $quant=odbc_result($r,q);
    println("id= $id Код=<b> $code </b> Пр-ль= $prod_id  кол >> $quant");
}

$r = $odb->query_td("select * from config");
odbc_fetch_row($r);
println("config id ".odbc_result($r,1));

odbc_close($odb->db_td);

//echo odbc_errormsg($odb->db_td);

//$r = $odb->query_td("select count(*) from DocStates");
//println("Total quant of DocStates is " . odbc_result($r, 1));
//
//$lider_table = explode(',', "DOC");//,DocInfo,DocStates,DocState,DOCROW,DocOpen,SUBCONTO,SUBCONTOTYPES,ITEMIMAGES,ITEM,ACTIONITEM,CARRIER,TYPEPAY");
//
//foreach ($lider_table as $value){
//    $r = $odb->query_td("select count(*) from $value");
//    println("Total quant of $value is " . odbc_result($r, 1));
//
//}




////кол-во производителей
//$q = "select
///*
//            I.code,
//            I.name,
//*/
//            P.id as Pid, 
//            P.name as PName, 
//            P.description descr 
//    from 
///*    Item I join*/ 
//    Producent P 
//    --on I.prod_id=P.id
//    
//    where id in (88)
//    /*
//    order by 1
//    limit 100
//    */
//    ";
//
////    group by id,name,desc";
//
//$r = $odb->query_td($q);
//while (odbc_fetch_row($r)) {
//    /*    $code = odbc_result($r, code);
//        $name = odbc_result($r, name);
//    */
//    $id = odbc_result($r, Pid);
//    $prod = odbc_result($r, PName);
//    $prod_desc = odbc_result($r, descr);
////    println($code . " " . $name . " " . $id . " " . $prod . " " . $prod_desc);
//    println($id . " " . $prod . " " . $prod_desc);
//
//};
//


/*
$dom = new domDocument;
$dom->loadXML('<books><book><title>Great American 
Novel</title></book></books>');
if (!$dom) {
    echo 'Error while parsing the document';
    exit;
}

$s = simplexml_import_dom($dom);

echo $s->book[0]->title; // Great American Novel

*/


/*
$r=$odb->query_td("select * from region_new order by id asc");
while (odbc_fetch_row($r)){
    $id=odbc_result($r,id);
    $region=odbc_result($r,name);
    println($id." ".$region);
}*/


/*
function auth_pg_param()
{
    $this->source_pg = 'PgLider';
    $this->username_pg = 'dba';
    $this->passwordl_pg = 'sql';
}

function connect_pg()
{
    $this->auth_pg_param();
    $this->db_pg = odbc_pconnect($this->source_pg, $this->username_pg, $this->passwordl_pg);
}

function num_rows($res)
{
    $count = 0;
    while ($temp = odbc_fetch_into($res, $counter)) {
        $count++;
    }
    return $count;
}

function query_pg($query)
{
    $this->connect_pg();
    if (!$this->db_pg) {
        $this->connect_pg();
    }
    $this->r_pg = odbc_exec($this->db_pg, $query);
    if (odbc_error()) {
        if (substr_count(odbc_errormsg($this->db_pg), "SQL0973N") == 0) {
            $fp = fopen(RD . '/lib/odbc_errors/pg_error.txt', 'a+');
            fwrite($fp, "DB2-> data=" . date("Y-m-d H:i:s") . ":" . odbc_errormsg($this->db_pg) . "\r\n" . $query . "\r\n");
            fclose($fp);
        }
    }
    return $this->r_pg;
}*/