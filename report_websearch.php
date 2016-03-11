<script type="text/javascript" src="js/task/task.js"></script>
<link rel="stylesheet" type="text/css" href="/js/calendar/tigra/tcal.css" />
<script type="text/javascript" src="/js/calendar/tigra/tcal.js"></script> 
<?php
$data_from=$_GET["data_from"];
$data_to=$_GET["data_to"];

print "<form method='get'>
<table border=0 align='center'>
	<tr>
		<td>Дата от: <input type='text' name='data_from' id='data_from' value='$data_from' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.getElementById('data_from'));return false;\"></td>
		<td>Дата до: <input type='text' name='data_to' id='data_to' value='$data_to' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.getElementById('data_to'));return false;\"></td>
		<td><input type='submit' value='Вчислить'></td>
	</tr>
</table>
</form>";

if ($data_from!=""){
	require_once ("lib/odbc_class.php");$odb=new odb;
	if ($data_to!=""){$dto=" and tm<='$data_to'";}
	$r=$odb->query_td("SELECT str,count(str) as kol FROM WEBSEARCH where tm>='$data_from' $dto group by str;");
	$list="<table border=1 align='center'>";
	while(odbc_fetch_row($r)){
		$str=odbc_result($r,"str");
		$kol=odbc_result($r,"kol");
		$list.="<tr align='left'><td>$str</td><td>$kol</td></tr>";
	}
	$list.="</table>";
	print $list;
}
?>