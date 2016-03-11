<?php
$odbc_class='odbc_class';
function __autoload($odbc_class) {
    include('/odbc_class.php');
	}
$odb = new odb;
$code=$_POST['code'];

$pic="Клиент будет разблокирован при нажатии на кнопку";


//$id=7562;
//$r=$odb->query_td("select id,code,name,flag from subconto where name like '$name';");

$r=$odb->query_lider("select s.id,s.code,s.name,s.flag from subconto s join klient k on s.id=k.id where k.code=('$code');");
//echo $odb->num_rows($r);
$lid=odbc_result($r,"id");
echo ("<table border ='1'>");
echo ("<tr><td>ID</td><td>Код</td><td>Наименование</td><td>Флаг</td></tr>");
//while(odbc_fetch_row($r)){
     echo "<tr><td>".odbc_result($r,"id")."</td>";
     echo "<td>".odbc_result($r,"code")."</td>";
     echo "<td>".odbc_result($r,"name")."</td>";
     echo "<td>".odbc_result($r,"flag")."</td>";
	 echo "</tr>";
//	 };
echo "</table >";

if ($_POST['but1'] == true){
echo "<b>Установка блокировки<br>";
$r=$odb->query_lider("update SubConto set flag=flag|16 where id='$id';");

}
if ($_POST['but2'] == true){
echo "<b>Снятие блокировки<br>";
$r=$odb->query_lider("update SubConto set flag=flag&~16 where id='$id';");
}
?>

<form action="block.php" method="post">
<input type=submit name=but, value="Назад" /></p>
</form>
