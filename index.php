<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
if ($_SERVER['REMOTE_ADDR']=="78.152.169.139"){@ini_set('display_errors', true);}
define('RD', dirname (__FILE__));
$content=null; 
//require_once (RD."/lib/mysql_class.php");  //Для работы новостей с сайта Бестхостинга
require_once (RD."/lib/mysql_lider_class.php"); //Для работы новостей с базы данных Lder MySQL
require_once (RD."/lib/odbc_class.php"); 
require_once (RD."/lib/config_class.php");
require_once (RD."/lib/slave_class.php");
require_once (RD."/lib/menu_class.php");
require_once (RD."/lib/kours_class.php");
require_once (RD."/lib/shop_class.php");
require_once (RD."/lib/client_class.php");
require_once (RD."/lib/catalogue_class.php");
require_once (RD."/lib/news_class.php"); //kuz 24-09-2014

if ($content==null){require_once (RD."/out.php");}
echo $content;
odbc_close_all();
?>