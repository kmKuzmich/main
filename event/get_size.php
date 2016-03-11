<?
session_start();
$width=$_SESSION["width"];
if ($width==""){
	print "<script language='javascript'>
	var today = new Date();
	var the_date = new Date(\"December 31, 2023\");
	var the_cookie_date = the_date.toGMTString();
	var the_cookie = \"users_resolution=\"+ screen.width;
	var the_cookie = the_cookie + \";expires=\" + the_cookie_date;
	document.cookie=the_cookie ;
	</script>";
	$width=$HTTP_COOKIE_VARS["users_resolution"];
	if ($width==""){$width=1280;}
	$_SESSION["width"]=$width;
}
?>