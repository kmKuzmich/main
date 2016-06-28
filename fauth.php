<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define("RD", dirname(__FILE__));
$signup = htmlspecialchars(trim($_REQUEST["signup"]));
$client_id = htmlspecialchars(trim($_REQUEST["id"]));
$code = htmlspecialchars(trim($_REQUEST["code"]));

if ($signup == "auth_account" and $client_id != "" and $code != "") {
    require_once(RD . "/lib/odbc_class.php");
    $odb = new odb;
    require_once(RD . "/lib/client_class.php");
    $cl = new client;
    $ans = $cl->fastSubcontoAuth($client_id, $code);
    if ($ans == "ok") {
        ?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
        <html>
        <head>
            <script language="JavaScript1.1" type="text/javascript">
                <!--
                location.replace("http://www.zakaz.avtolider-ua.com/");
                //-->
            </script>
            <noscript>
                <meta http-equiv="Refresh" content="0; URL=http://www.zakaz.avtolider-ua.com/">
            </noscript>
        </head>
        <body><a href="http://www.zakaz.avtolider-ua.com/">Загрузка ...</a></body>
        </html>
        <?
    }
    if ($ans != "ok") {
        ?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
        <html>
        <head>
            <script language="JavaScript1.1" type="text/javascript">
                <!--
                location.replace("http://www.zakaz.avtolider-ua.com/");
                //-->
            </script>
            <noscript>
                <meta http-equiv="Refresh" content="0; URL=http://www.zakaz.avtolider-ua.com/">
            </noscript>
        </head>
        <body><a href="http://www.zakaz.avtolider-ua.com/">Ой ведь незадача! ;)</a></body>
        </html>
        <?
    }
}

?>