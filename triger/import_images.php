<?php

error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);
define('RD', dirname (__FILE__));
require_once (RD."/../lib/odbc_class.php");
require_once (RD."/../lib/slave_class.php");
$odb = new odb;$slave = new slave;$m=0;

//echo '������ �����';

echo "<H2>��������!</h2>";
echo "��� �������� ����������/����������� � Avtolider-Shop";
echo "<h3>����� ����� �������� � ����� /../uploads/images/lider/import <br>";
echo "��� ����� = ��� ������</h3>";

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
echo "<p><input type=\"checkbox\" name=\"rewrite\" value=\"1\">�������������� ���� (�� ���� ������ ��� ��������������!)</p>";
echo "<p><input type=\"submit\" value=\"��������� �����!\"></p>";
echo "</form>";



/*
<H2>��������!</h2>
��� �������� ����������/����������� � Avtolider-Shop
<h3>����� ����� �������� � ����� /../uploads/images/lider/import <br>
��� ����� = ��� ������</h3>

<form  action="import_images1.php" method="post" >
<p>������� ��� ������  <input type="number" name="prod_id"></p>
<p><input type="checkbox" name="rewrite" value="1">�������������� ���� (�� ���� ������ ��� ��������������!)</p>
<p><input type="submit" value="��������� �����!"></p>
</form>



<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>��� SELECT</title>
 </head>
 <body>  
 
  <form action="select1.php" method="post">
   <p><select size="3" multiple name="hero[]">
    <option disabled>�������� �����</option>
    <option value="���������">���������</option>
    <option selected value="�������� ����">�������� ����</option>
    <option value="��������">��������</option>
    <option value="����� ������">����� ������</option>
   </select></p>
   <p><input type="submit" value="���������"></p>
  </form>

 </body>
</html>


*/

?>