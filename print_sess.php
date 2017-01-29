<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 25.06.2016
 * Time: 10:51
 */
//$_COOKIE["PHPSESSID"] = "gmukkovk7u9d1kn69nkeksm306";
//$_GET['sess_id']="gmukkovk7u9d1kn69nkeksm306";
//Если нажата кнопоча внизу с указанием сессии, то показать
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_GET['sess_id'])) {
    session_id($_GET['sess_id']);
}
//if ($_GET['sess_id']) {
//    session_name($_GET['sess_id']);
//}

echo "Сессия : " . session_id() . " <pre>";
print_r($_SESSION);
echo "</pre>";

echo "Куки <pre>";
print_r($_COOKIE);
echo "</pre>";
//$_GET['sess_id']=session_id();
echo "<form action=\"" . $_SERVER["PHP_SELF"] . "\" method=\"get\">\n";
echo "Name: <input type=\"text     \" name = \"sess_id\" value=\"" . strip_tags($_GET['sess_id']) . "\"/><br />\n";
echo "<input type=\"submit\" value=\"send\">\n";
echo "</form>\n";
echo "<hr>";

include_once '/lib/odbc_class.php';

$odb = new odb;
$r = $odb->query_lider("select id from users where id=1;");
odbc_fetch_row($r);
$doc_id = odbc_result($r, "id");
echo $doc_id;


?>