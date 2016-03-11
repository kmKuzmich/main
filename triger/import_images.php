<?php

error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);
define('RD', dirname (__FILE__));
require_once (RD."/../lib/odbc_class.php");
require_once (RD."/../lib/slave_class.php");
$odb = new odb;$slave = new slave;$m=0;

//echo 'Выбери бренд';

echo "<H2>Внимание!</h2>";
echo "для загрузки фотографий/изображений в Avtolider-Shop";
echo "<h3>файлы нужно положить в папку /../uploads/images/lider/import <br>";
echo "Имя файла = код товара</h3>";

$r=$odb->query_td("select id, name from producent order by 2");

echo "<form  action=\"import_images1.php\" method=\"post\" >";
echo "<select name=\"prod_id\">";
echo "<option selected value=1> BOSCH - 1</option>";
while(odbc_fetch_row($r)){
	$id=odbc_result($r,"id");
	$name=odbc_result($r,"name");
	echo "<option value = '$id'> $name - $id </option>";
	}
echo "</select>";
echo "<p><input type=\"checkbox\" name=\"rewrite\" value=\"1\">Перезаписывать фото (не надо лишний раз перезаписывать!)</p>";
echo "<p><input type=\"submit\" value=\"Загрузить фотки!\"></p>";
echo "</form>";



/*
<H2>Внимание!</h2>
для загрузки фотографий/изображений в Avtolider-Shop
<h3>файлы нужно положить в папку /../uploads/images/lider/import <br>
Имя файла = код товара</h3>

<form  action="import_images1.php" method="post" >
<p>Введите код бренда  <input type="number" name="prod_id"></p>
<p><input type="checkbox" name="rewrite" value="1">Перезаписывать фото (не надо лишний раз перезаписывать!)</p>
<p><input type="submit" value="Загрузить фотки!"></p>
</form>



<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>Тег SELECT</title>
 </head>
 <body>  
 
  <form action="select1.php" method="post">
   <p><select size="3" multiple name="hero[]">
    <option disabled>Выберите героя</option>
    <option value="Чебурашка">Чебурашка</option>
    <option selected value="Крокодил Гена">Крокодил Гена</option>
    <option value="Шапокляк">Шапокляк</option>
    <option value="Крыса Лариса">Крыса Лариса</option>
   </select></p>
   <p><input type="submit" value="Отправить"></p>
  </form>

 </body>
</html>


*/

?>