<?php
error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', false);
@ini_set('html_errors', false);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);
define('RD', dirname (__FILE__));
$content=null;
require_once (RD."/../lib/mysql_class.php");
require_once (RD."/lib/slave_class.php");
require_once (RD."/lib/config_class.php");
require_once (RD."/lib/module_class.php");
require_once (RD."/event/get_access.php");
if ($content==null){require_once (RD."/engine.php");}
if ($style=="ok"){$style="<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'><link rel='STYLESHEET' type='text/css' href='theme/main_style.css'>";}
echo $style.$content;
?>