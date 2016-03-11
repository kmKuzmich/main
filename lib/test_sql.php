<?php
//phpinfo();
		$hostl = 'avtolider-ua.com';
		$dbnamel = 'avtolid_new';
		$usernamel = 'avtolid';
		$passwordl = 'avtolider2015';

$dbl_id = @mysql_connect($hostl, $usernamel, $passwordl);
		@mysql_select_db($dbnamel, $dbl_id);
		mysql_query ("set character_set_client='cp1251'");
		mysql_query ("set character_set_results='cp1251'");
		mysql_query ("set collation_connection='cp1251_general_ci'");

$query="select * from news order by id asc;";
		
$r = mysql_query($query, $dbl_id);
$n=$db->num_rows($r);
for ($i=1;$i<=$n;$i++){
	$id=$db->result($r,$i-1,"id");
	$caption_ru=$db->result($r,$i-1,"caption_ru");
	$caption_en=$db->result($r,$i-1,"caption_en");
	$short_desc_ru=$db->result($r,$i-1,"short_desc_ru");
	$short_desc_en=$db->result($r,$i-1,"short_desc_en");
	$desc_ru=$db->result($r,$i-1,"desc_ru");
	$desc_en=$db->result($r,$i-1,"desc_en");
	$data=$db->result($r,$i-1,"data");
	$author_ru=$db->result($r,$i-1,"author_ru");
	$author_en=$db->result($r,$i-1,"author_en");
	echo $id;
	
}


/*
	echo "1) " . dirname("/etc/passwd") . '<br>'; // 1) /etc
	echo "2) " . dirname("/etc/") . '<br>'; // 2) / (или \ на Windows)
	echo "3) " . dirname(".")."<br>"; // 3) .
    $df_c = disk_free_space("C:");
	echo "Свободное место ". $df_c/1024/1024 ." Gb<br>";

	include "../index.php";
	//include "odbc_class.php";
	
    $dc=$_SERVER['DOCUMENT_ROOT'];
	echo $dc;

   $odb=new odb;
   $ex=0;
   session_start();
   $client_id=$_SESSION["client"];
   $r=$odb->query_td("select m.short_message,m.id,m.data from messages m inner join message_box mb on m.id=mb.message_id where mb.client_id='$client_id' and m.ison='1' and mb.ison=1 and mb.status_id=1 limit 0,1;");
		while(odbc_fetch_row($r)){
		$ex=1;
			$id=odbc_result($r,"id");
			$message=odbc_result($r,"short_message");
			$data=odbc_result($r,"data");
			$form_htm=RD."/tpl/client_messageBox_form.htm";
			if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
			$form=str_replace("{id}", $id, $form);
			$form=str_replace("{message}", $message, $form);
			$form=str_replace("{data}", $data, $form);
		}
//		return array($ex,$form);
//	}

*/
?>