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
if (isset($_REQUEST['ip']))
{$ip = $_REQUEST['ip'];}
else
{$ip=$_POST['ip'];}
error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);
define('RD', dirname (__FILE__));

require_once (RD."/../lib/odbc_class.php");
require_once (RD."/../lib/slave_class.php");
$odb = new odb;$slave = new slave;$m=0;

$s = $odb->query_td("select 
                        s.code as CODE,
                        s.name as NAME,
                        STR as SEARCH,
                        PROD_ID AS PROD_ID,
                        Nodeaddress as IP,
                        tm as Time  
                    from websearch w 
                        left outer join subconto s on klient_id=s.id
                    where tm>=date(now())
                          and nodeaddress like ('$ip')
                    order by 6 desc
                    limit 500 offset 0;");
echo "<h1>WebSearch �� ".date('d-m-Y')." ���������� �� <u>".date('H:i:s')."</u> �� IP: ".$_POST['ip']."</h1>";
echo '������, <b>' .$_SESSION['login'].'</b> <a href="/triger/web.php?logout=1">�����</a><br><br>';
?>

<table border="1" cellpadding="1" cellspacing="1" style="width: 1000px;">

<tbody>
<tr>
			<td><b> ��� </td>
			<td style="width: 40%"><b>������</td>
			<td style="width: 15%"><b>�����</td>
	<td style="width: 5%"><b>��-��</td>
			<td><b>IP-�����</td>
			<td style="width: 100px"> <b><center>�����</center></td>
</tr>

<?php
while($row = odbc_fetch_array($s))
	while ($row = odbc_fetch_array($s))
{
	echo '<tr>';
	echo '		<td>' . $row['code'] . '</td>';
	echo '		<td>' . $row['name'] . '</td>';
	echo '		<td>' . $row['search'] . '</td>';
	echo '		<td>' . $row['prod_id'] . '</td>';
	echo '		<td>' . $row['ip'] . '</td>';
	echo '		<td>' . $row['time'] . '</td>';
	echo '</tr>';
}
}
?>
</tbody>
</table>