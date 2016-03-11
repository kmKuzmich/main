<?php
session_start();
$config=new config;
if ($_POST["login_promt"]=="try"){
	if ($pass=="" or $login=="") { Header("Location: ?"); exit; }
	if ($pass!="" and $login!="") {
		$db=new db; $slave=new slave;
		$r=$db->query("select id from module_users where login='$login' and pass='$pass' and ison='1' limit 0,1;");
		$n=$db->num_rows($r);
		if ($n > 0) {
			$user=$db->result($r,0,"id");
			$_SESSION["user"]=$user; $_SESSION["login"]=$login;
			Header("Location: ?"); exit;
		}
		if ($n == 0) {
			session_start();
			session_unset();
			session_destroy();
			Header("Location: ?"); exit;
		}
	}
}
if ($_POST["login_promt"]!="try"){
	$user=$_SESSION["user"];
	if ($user==""){
		session_start();
		session_unset();
		session_destroy();
		$form = file_get_contents(RD."/tpl/login_form.htm");
		$content= file_get_contents(RD.'/theme/theme.htm');
		$content=str_replace("{work_window}", $form, $content);
	}
}
if ($_GET["exit"]=="true"){
	session_start();
	session_unset();
	session_destroy();
	$form = file_get_contents(RD."/tpl/login_form.htm");
	$content= file_get_contents(RD.'/theme/theme.htm');
	$content=str_replace("{work_window}", $form, $content);
}
$content=str_replace("{title}", $config->get_title(), $content);
?>