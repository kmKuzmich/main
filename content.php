<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', false);
if ($_SERVER['REMOTE_ADDR'] == "78.152.169.139") {
    @ini_set('display_errors', true);
}
define('RD', dirname(__FILE__));
$content = null;

//require_once (RD."/lib/mysql_class.php");      //Для работы новостей с сайта Бестхостинга
require_once(RD . "/lib/mysql_lider_class.php");  //Для работы новостей с базы данных Lder MySQL
require_once(RD . "/lib/odbc_class.php");
require_once(RD . "/lib/config_class.php");
require_once(RD . "/lib/slave_class.php");
require_once(RD . "/lib/kours_class.php");
$slave = new slave;
if ($content == null) {
    require_once(RD . "/engine.php");
}
if ($style == "ok") {
    $style = "<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'><link rel='STYLESHEET' type='text/css' href='theme/main_style.css'>";
}
echo $style . $content;
odbc_close_all();
?>