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
 if ( $_POST['login'] == 'amobest' and $_POST['pass'] == 'yt3WMtbcP8m' ) // ��� ����� ������ ������� ����������� %)
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
 <form action="ttn.php" method="post">
 <input type="text" name="login" /> 
 <input type="password" name="pass" /> 
 <input type="submit" value="�������!" />
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
$odb=new odb;
$odb->query_lider("create variable @last_id integer ");
$odb->query_lider("insert into Local(user_id) values(-10);");
$odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
$odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");


if ( !empty($_POST['min']) ) {
$min = $_POST['min'];
} else { 
$min = date('Y-m-d', strtotime("-30 days"));
}
if ( !empty($_POST['max']) ) {
$max = $_POST['max'];
} else { 
$max = date('Y-m-d');
}

$r=$odb->query_lider("select // ��������� ���������
d.day as DAY,
k.name as DOC,
d.num as NUM,
s.name as NAME,
d.sum as SUM,
(if d.kinddoc_id=16 then 1 else d.opl endif) as DOLG,
c.name DEL,
c.id IDDEL,
d1.sNum TTN,
di.phone PHONE,
di.contperson PERSON

from doc d left outer join doc dV on d.id1=dV.id left outer join docinfo di on di.doc_id = (if isnull(dV.kinddoc_id,0)=2 then dV.id1 else d.id1 endif)
left outer join kinddoc k on d.kinddoc_id=k.id
left outer join subconto s on d.subconto_id=s.id
left outer join carrier c on di.carrier_id=c.id
left outer join doclink dl on doc_id2=d.id
left outer join doc d1 on dl.doc_id1=d1.id
where d.kinddoc_id in (3,16)
and d.place_id=170000005
and d.opl<>3
and d.day >= date('$min')
and d.day <= date('$max')+1
order by 1 desc");

$r1=$odb->query_lider("select  // ��������� �������� �����
d.day as DAY,
k.name as DOC,
d.num as NUM,
s.name as NAME,
d.sum as SUM,
(if d.kinddoc_id=16 then 1 else d.opl endif) as DOLG,
c.name DEL,
c.id IDDEL,
d1.sNum TTN,
di.phone PHONE,
di.contperson PERSON

from doc d left outer join doc dV on d.id1=dV.id left outer join docinfo di on di.doc_id = (if isnull(dV.kinddoc_id,0)=2 then dV.id1 else d.id1 endif)
left outer join kinddoc k on d.kinddoc_id=k.id
left outer join subconto s on d.subconto_id=s.id
left outer join carrier c on di.carrier_id=c.id
left outer join doclink dl on doc_id2=d.id
left outer join doc d1 on dl.doc_id1=d1.id
where d.kinddoc_id in (2)
and d.place_id=170000005
and d.opl=0
order by 1 desc");



//����� �����������
#echo "<h3>���������� �� <u>".date('H:i:s')."</u></h3>".$min ;
echo "<h3>����� �� ���������� �� ������ � <u>".$min."</u> �� <u>" .$max."</u>. ����������� �� <u>".date('H:i:s')."</u></h3>";



/*echo '������, <b>' .$_SESSION['login'].'</b> <a href="/triger/web.php?logout=1">�����</a><br><br>';*/

?>
<html>
 <body>
  <form  action="ttn.php" method="post">
      ������� �: <input type="date" name="min" >
      ��: <input type="date" name="max">
   <input type="submit" value="������� ��������">
  </form>
 </body>
</html>

<table border="1" cellpadding="1" cellspacing="1" style="width: 100%;">

<tbody>
<tr>
			<td style="width: 7%"><b> ���� </td>
			<td style="width: 18%"><b> ��� ��������� </td>
			<td style="width: 3%"><b><center>�����</center></td>
			<td style="width: 19%"><b>������</td>
			<td style="width: 19%"><b>���������� ����</td>
			<td style="width: 4%"><b><center>�����</center></td>
			<td style="width: 5%"><b>������</td>
			<td style="width: 15%"><b>����������</td>
			<td style="width: 5%"> <b><center>���</center></td>
			<td style="width: 5%"><b><center>�������</center></td>
</tr>

<?php
while($row = odbc_fetch_array($r1))
{
$i=$row['IP'];
	echo '<tr>';
	echo '		<td>'.$row['DAY'].'</td>';
	echo '		<td>'.$row['DOC'].'</td>';
	echo '		<td align="center">'.$row['NUM'].'</td>';
	echo '		<td>'.$row['NAME'].'</td>';
	echo '		<td>'.$row['PERSON'].'</td>';
	echo '		<td align="right">'.$row['SUM'].'</td>';
	if ($row['DOLG'] == 1){
	echo '		<td>��������</td>';
	}else 
	{echo '		<td bgcolor="#ff0000">���������</td>';}
	echo '		<td>'.$row['DEL'].'</td>';
	echo '		<td>'.$row['TTN'].'</td>';
	echo '		<td>'.$row['PHONE'].'</td>';
	echo '</tr>';
}

while($row = odbc_fetch_array($r))
{
$i=$row['IP'];
	echo '<tr>';
	echo '		<td>'.$row['DAY'].'</td>';
	echo '		<td>'.$row['DOC'].'</td>';
	echo '		<td align="center">'.$row['NUM'].'</td>';
	echo '		<td>'.$row['NAME'].'</td>';
	echo '		<td>'.$row['PERSON'].'</td>';
	echo '		<td align="right">'.$row['SUM'].'</center></td>';
	if ($row['DOLG'] == 1){
	echo '		<td>��������</td>';
	}else 
	{echo '		<td bgcolor="#ff0000">����</td>';}
	echo '		<td>'.$row['DEL'].'</td>';
	if ($row['IDDEL'] == 1 and empty($row['TTN'])){
	echo '		<td bgcolor="#ff0000">>'.$row['TTN'].'</td>';
	}else
	{echo '		<td>'.$row['TTN'].'</td>';}
	echo '		<td>'.$row['PHONE'].'</td>';
	echo '</tr>';
}
}
odbc_close_all();
?>
</tbody>
</table>