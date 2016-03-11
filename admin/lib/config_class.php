<?php
class config {
	function get_title(){$db=new db;
		$r=$db->query("select title from config limit 0,1;");$n=$db->num_rows($r);
		if ($n>0){ return $db->result($r,0,"title");}
		if ($n==0){ return "Новый сайт";}
	}
}
?>