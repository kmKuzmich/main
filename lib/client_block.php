<form method="POST" action="">
 <p>��� ������� <input type=text name="code" value=''>
<input type=submit name="but", value="������� �������" /></p>
<input type=submit name="but1", value="�������������" /> 
<input type=submit name="but2", value="��������������" /></p>

</form>


<?php
//admin_ip="192.168.0.39"
  if (($_SERVER['REMOTE_ADDR']=="192.168.0.39")|($_SERVER['REMOTE_ADDR']=="127.0.0.1"))
  {
		$odbc_class='odbc_class';
		function __autoload($odbc_class) {
			include('/odbc_class.php');
			}
		$odb = new odb;		
		$code = $_POST['code'];		
		if ($code=="") {echo "������� ��� �������";}
		else {
		$r=$odb->query_lider("select s.id,s.code,s.name,s.flag from subconto s join klient k on s.id=k.id where k.code=('$code');");
		$lid=odbc_result($r,"id");
		}
		
	if ($_POST['but'] == true){
		$code=$_POST['code'];
		$r=$odb->query_lider("select s.id,s.code,s.name,s.flag from subconto s join klient k on s.id=k.id where k.code=('$code');");
		echo ("<table border ='1'>");
		echo ("<tr><td>ID</td><td>���</td><td>������������</td><td>����</td></tr>");
		echo "<tr><td>".odbc_result($r,"id")."</td>";
		echo "<td>".odbc_result($r,"code")."</td>";
		echo "<td>".odbc_result($r,"name")."</td>";
		echo "<td>".odbc_result($r,"flag")."</td>";
		echo "</tr>";
		echo "</table >";
		}

	if ($_POST['but1'] == true){
		echo "<b>��������� ����������<br>";
		$r=$odb->query_lider("update SubConto set flag=flag|16 where id='$lid';");
		}
	
	if ($_POST['but2'] == true){
		echo "<b>������ ����������<br>";
		$r=$odb->query_lider("update SubConto set flag=flag&~16 where id='$lid';");
		}
	}
	else print "� ��� ��� �������!";
?>