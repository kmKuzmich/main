<form method="POST" action="">
<input name="code" value="">
<input type="submit" value="Выбрать клиента" name="but">
</form>

<-input type=submit name=but1, value="Заблокировать" /> 
<-input type=submit name=but2, value="Разблокировать" /></p>



<?php
$odbc_class='odbc_class';
function __autoload($odbc_class) {
    include('/odbc_class.php');
	}
$odb = new odb;
$code=$_POST['code'];

$pic="Клиент будет разблокирован при нажатии на кнопку";
if ($_POST['but'] == true){

//$id=7562;
//$r=$odb->query_td("select id,code,name,flag from subconto where name like '$name';");

$r=$odb->query_lider("select s.id,s.code,s.name,s.flag from subconto s join klient k on s.id=k.id where k.code=('$code');");
//echo $odb->num_rows($r);
echo ("<table border ='1'>");
echo ("<tr><td>ID</td><td>Код</td><td>Наименование</td><td>Флаг</td></tr>");
while(odbc_fetch_row($r)){
     echo "<tr><td>".odbc_result($r,"id")."</td>";
     echo "<td>".odbc_result($r,"code")."</td>";
     echo "<td>".odbc_result($r,"name")."</td>";
     echo "<td>".odbc_result($r,"flag")."</td>";
	 echo "</tr>";
	 };
}
echo "</table >";
?>

<form method="POST" action="">
<input type="submit" value="Заблокировать клиента" name="but2">
</form>

<?php
if ($_POST['but2'] == true){
 
echo "<b>Установка блокировки<br>";
$r=$odb->query_lider("update SubConto set flag=flag|16 where id='$id';");
echo ("<table border ='1'>");
echo ("<tr><td>ID</td><td>Код</td><td>Наименование</td><td>Флаг</td></tr>");

$r=$odb->query_lider("select id,code,name,flag from subconto where id in ('$id');");
while(odbc_fetch_row($r)){
     echo "<tr><td>".odbc_result($r,"id")."</td>";
     echo "<td>".odbc_result($r,"code")."</td>";
     echo "<td>".odbc_result($r,"name")."</td>";
     echo "<td>".odbc_result($r,"flag")."</td>";
	 echo "</tr>";
	 };
echo "</table >";

echo "<b>Проверка блокировки: </b>";
$r=$odb->query_lider("select (flag&16) as flag from SubConto where id='$id' and (flag&16)=16;");
if (odbc_result($r,"flag")==16) {
     echo "Клиент заблокирован<br>";}
  else {echo "Клиент не блокирован<br>";}
}
?>  

<form method="POST" action="">
<input type="submit" value=" Разблокировать клиента" name="but3">
</form>

<?php
$pic="Клиент будет разблокирован при нажатии на кнопку";

if ($_POST['but3'] == true){

echo "<b>Снятие блокировки<br>";
$r=$odb->query_lider("update SubConto set flag=flag&~16 where id='$id';");
echo ("<table border ='1'>");
echo ("<tr><td>ID</td><td>Код</td><td>Наименование</td><td>Флаг</td></tr>");


$r=$odb->query_lider("select id,code,name,flag from subconto where id in ('$id');");
while(odbc_fetch_row($r)){
     echo "<tr><td>".odbc_result($r,"id")."</td>";
     echo "<td>".odbc_result($r,"code")."</td>";
     echo "<td>".odbc_result($r,"name")."</td>";
     echo "<td>".odbc_result($r,"flag")."</td>";
	 echo "</tr>";
	 };
echo "</table >";

echo "<b>Проверка блокировки :</b>";
$r=$odb->query_lider("select (flag&16) as flag from SubConto where id='$id' and (flag&16)=16;");
if (odbc_result($r,"flag")==16) {
     echo "Клиент заблокирован<br>";}
  else {echo "Клиент не блокирован<br>";}

}

//if ($_SERVER['REMOTE_ADDR']=="192.168.0.39")
//  {print "select id from SUBCONTO_INOUT where SUBCONTO_ID='$id' and ISON='1' and SET_LOGOUT='1'; $lid; update SUBCONTO_INOUT set ISON='0', SET_LOGOUT='0' where ID='$lid';";}
		


/*
	function checkClientLogout($id){ $odb=new odb;$logout=0;
		$r=$odb->query_td("select id from SUBCONTO_INOUT where SUBCONTO_ID='$id' and ISON='1' and SET_LOGOUT='1';");
		while(odbc_fetch_row($r)){$lid=odbc_result($r,"id"); $logout=1; $odb->query_td("delete from SUBCONTO_INOUT where ID='$lid';"); 
		session_start(); session_unset($_SESSION["client"]);session_unset($_SESSION["email"]);setcookie("AvtoliderUser", "", time()-3600);setcookie("AvtoliderUserSecure", "", time()-3600);
		if ($_SERVER['REMOTE_ADDR']=="192.168.0.39"){print "select id from SUBCONTO_INOUT where SUBCONTO_ID='$id' and ISON='1' and SET_LOGOUT='1'; $lid; update SUBCONTO_INOUT set ISON='0', SET_LOGOUT='0' where ID='$lid';";}
		}
		return $logout;
	}
*/
?>