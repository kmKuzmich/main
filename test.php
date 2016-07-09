<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define("RD", dirname (__FILE__));
require_once (RD."/lib/odbc_class.php");
$odb=new odb;

$r = $odb->query_td("select oc.order_id, o.* from orders_check oc left outer join orders o on o.id=oc.order_id where oc.status in (0,1) and o.id in (4540,5234) order by oc.order_id asc;");
$k = 0;
$m = 0;
while (odbc_fetch_row($r)) {
	$k += 1;
	$order_id = odbc_result($r, "order_id");

//	$order_id = 2075;
	$odb->query_td("update orders_check set status=0 where order_id='$order_id';");
	print($order_id);

}
/*
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define("RD", dirname (__FILE__));
require_once (RD."/lib/odbc_class.php");$odb=new odb;

//$odb->query_td("Call listanalog(503801);");
$r=$odb->query_td("select * from messages");
while(odbc_fetch_row($r)){ $prm=0; $price1=""; $i++;
	$mID=odbc_result($r,"id"); 		
	$Mess=odbc_result($r,"message"); 
	$mDat=odbc_result($r,"DATA"); 
	$mDatStart=odbc_result($r,DATA_Start); 
	$mOn=odbc_result($r,ISON); 
	$sMess=odbc_result($r,"short_message"); 
	print "$mId  | $Mess | $mDat |  $mSatStart | $mOn  |   $sMess <br />";
}

/*
$odb->query_td("Call listanalog(503801);");
$r=$odb->query_td("select AT.*,I.Code as ItemCode,I.Name as ItemName from analogtemp AT join item I on AT.item_id=I.id;");
while(odbc_fetch_row($r)){ $prm=0; $price1=""; $i++;
	$lev=odbc_result($r,"lev"); 
	$itemId=odbc_result($r,"item_id");
	$itemCode=odbc_result($r,"ItemCode");
	$itemName=odbc_result($r,"ItemName");
	print "$lev | $itemId     |    $itemCode    |    $itemName<br />";
}
*/

/*
$art1="АКБ";
$art2=mb_convert_case($art1, MB_CASE_LOWER ); //, "CP1251"
echo $art1." = = ".$art2."<br>";

function getItemPrice2($item_id,$client_id){
		$odb=new odb;
		//$r=$odb->query_td("select getprice($item_id,$client_id) as price");
		$r=$odb->query_td("select getprice(id,'$client_id') as price from item where id='$item_id';");
		odbc_fetch_row($r);
		$price=odbc_result($r,"price");
		print $price;
		return $price;
	}
	
$price_client=getItemPrice2(87781,3318); //$id,$client_id
echo "Цена =".$price_client;
echo "<br>Программное обеспечение сервера ".$_ENV['SERVER_SOFTWARE'];
echo "<br>Имя файла сценария в файловой системе сервера (физический путь) ".$_ENV["SCRIPT_FILENAME"];
echo "<br>Имя  ".$_server["USER"];
// Пример использования getenv()
$ip = getenv('user');
echo "<br>Имя  ".$ip;
// можно еще воспользоваться суперглобальной переменной ($_SERVER or $_ENV)
$ip = "<br>Имя  ".$_SERVER['HTTP_ACCEPT'];
echo $ip;
print "<br>".date('r')."<br>";

//$client_id=$_SESSION["client_id"];*/
?>
