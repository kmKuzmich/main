<?php
session_start();
if ( !empty($_GET['logout']) ) // ���� ���� ����� �����
{
 // ������ ��������� ����������
 unset($_SESSION['logged'], $_SESSION['login']);
}
// ������� ������ �� ����� ������ � ������� ������� � �������
if ( !empty($_POST['login']) and !empty($_POST['pass']) )
{
 if ( $_POST['login'] == 'avtolid' and $_POST['pass'] == 'y3WMtbcP8m' ) // ��� ����� ������ ������� ����������� %)
 {
 // ��������� ��������� ���������� logged = true � login � ������ ������������
 $_SESSION['logged'] = 1;
 $_SESSION['login'] = 'Avtolid';
 }
}
if ( !isset($_SESSION['logged']) or empty($_SESSION['logged']) ) // ���� � ������ �� �������, ��� ������������ ���������
{
 // ���������� ����� ��� ����� ������
 
 ?>
 <form action="web.php" method="post">
 <input type="text" name="login" /> 
 <input type="password" name="pass" /> 
 <input type="submit" value="�� �����!" />
 </form>
 <?php
}
else
{
#<?php
error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);
define('RD', dirname (__FILE__));
require_once (RD."/../lib/odbc_class.php");
require_once (RD."/../lib/slave_class.php");
$odb = new odb;$slave = new slave;$m=0;

//������������ �������� �������
$s=$odb->query_td("select max(s.code) as CODE,max(s.name) as KLIENT,nodeaddress as IP,count(*) as N  from Websearch w 
left outer join subconto s on klient_id=s.id 
where tm>=trunc(sysdate,'dd-mm-yyyy') 
group by nodeaddress order by 4 desc
limit 0,100;");

//������� ������ ����� �������
$ss=$odb->query_td("select count(*) as N  from Websearch w 
where tm>=trunc(sysdate,'dd-mm-yyyy')");
$sum=odbc_result($ss,N);

//����� �����������
echo "<h1>WebSearch �� ".date('d-m-Y')." ���������� �� <u>".date('H:i:s')."</u> ����� �������: <u>".$sum."</u></h1>";
echo '������, <b>' .$_SESSION['login'].'</b> <a href="/triger/web.php?logout=1">�����</a><br><br>';
?>
		<form action="webdetails.php" method="post">
			<input type="text" name="ip" /> 
			<input type="submit" value="�����" />
		</form>
<table border="1" cellpadding="1" cellspacing="1" style="width: 1000px;">

<tbody>
<tr>
			<td><b> ��� </td>
			<td style="width: 70%"><b>������</td>
			<td><b>IP-�����</td>
			<td style="width: 100px"> <b><center>���-�� �������</center></td>
</tr>

<?php
while($row = odbc_fetch_array($s))
{
$i=$row['IP'];
	echo '<tr>';
	echo '		<td>'.$row['CODE'].'</td>';
	echo '		<td>'.$row['KLIENT'].'</td>';
	echo "		<td><a href='/triger/webdetails.php?ip=$i'>$i</a></td>";
	#echo '		<td>'.$row['IP'].'</td>';
	echo '		<td><center>'.$row['N'].'</center></td>';
	echo '</tr>';
}
}
?>
</tbody>
</table>