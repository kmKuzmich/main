<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title></title>
	<link rel="STYLESHEET" type="text/css" href="theme/css/style.css">
</head>
<body leftmargin=0 topmargin=0>
<table width="100%" border="0" align="center">
<tr><td><span id="desc"></span></td></tr>
</table>
<script>
document.getElementById("desc").innerHTML=window.opener.document.getElementById("desc").innerHTML;
setTimeout("window.print()",2000);
</script> 
</body>
</html>
