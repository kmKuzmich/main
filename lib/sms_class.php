<?php 
error_reporting(E_ERROR);
@ini_set('display_errors', false);
@ini_set('html_errors', false);
@ini_set('error_reporting', E_ERROR);
class sms{
function correct_nomber($phone){
	$phone=str_replace("+", "", $phone);
	$phone=str_replace(" ", "", $phone);
	$phone=str_replace("-", "", $phone);
	$phone=str_replace("(", "", $phone);
	$phone=str_replace(")", "", $phone);
	if (strlen($phone)>=10 and strlen($phone)<13){
		if (strlen($phone)==10){$phone="+38".$phone;}
		if (strlen($phone)==11){$phone="+3".$phone;}
		if (strlen($phone)==13){ return $phone; }
	}
	if (strlen($phone)==13){ return $phone; }
}
function send_sms($sign,$nomber,$message){
	$data="login=avtolider&pass=cXhNOTtv&nomber=$nomber&sign=$sign&link=&send_var=0&message=$message";
	$out = "POST /http_api.php HTTP/1.1\n"; 
	$out .= "Host: sms-sender.km.ua\n"; 
	$out .= "Referer: sms-sender.km.ua/\n"; 
	$out .= "User-Agent: Mozilla\n"; 
	$out .= "Content-Type: application/x-www-form-urlencoded\n"; 

	$out .= "Content-Length: ".strlen($data)."\n\n"; 
	$out .= $data."\n\n"; 
	$fp = fsockopen("sms-sender.km.ua", 81, $errno, $errstr, 10);
	fputs($fp, $out); 
	while($gets=fgets($fp,2048)) {
		if (stristr($gets,"sms-sender-answer=")){ 
			$answers=explode(";;;",$gets);$answer=ereg_replace("sms-sender-answer=","",$answers[1]);
			$answer;
		}
	}
	fclose($fp);
	return $answer;
}
}
?> 