<?php
$db=new db; session_start(); $client=$_SESSION["client"];$discount=$_SESSION["discount"];
//print "client=".$client.";discount=".$discount;
if ($client!="" and $discount!=""){ $price='../price/price'.$discount.'.rar'; $price_cap='price/price'.$discount.'.rar';}
if ($client=="" or $discount=="" or $discount=="1" ){ $price='../price/price1.rar';$price_cap='omega.rar'; }
header("Content-Disposition: inline; filename=$price_cap");
header("Content-type: download/file");
header("Content-length: ".filesize($price));
readfile($price);
?>