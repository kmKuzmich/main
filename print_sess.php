<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 25.06.2016
 * Time: 10:51
 */

if ($_GET['sess_id']) {
    session_name($_GET['sess_id']);
}
session_start();
echo "Сессии <pre>";
print_r($_SESSION);
echo "</pre>";

echo "Куки <pre>";
print_r($_COOKIE);
echo "</pre>";

echo "<form action=\"" . $_SERVER["PHP_SELF"] . "\" method=\"get\">\n";
echo "Name: <input type=\"text\" name = \"sess_id\" value=\"" . strip_tags($_GET['sess_id']) . "\"/><br />\n";
echo "<input type=\"submit\" value=\"send\">\n";
echo "</form>\n";
echo "<hr>";

?>