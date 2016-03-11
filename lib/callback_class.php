<?php
class callback {
	function show_banner(){
		return "
		<table width='270' cellpadding='3' cellspacing='3' border='0' background='theme/images/callback_bg.jpg' height='70'>
        	<tr>
            	<td>
                	<a href='?dep=callback' style='color:#ffffff; font:normal 24px Arial, Helvetica, sans-serif;'>Обратный звонок</a><br>
                    <span style='color:#fefefe; font:normal 11px Arial, Helvetica, sans-serif;'>Не смогли дозвониться? <br />Закажите бесплатный звонок продавца</span><br />
                </td>
            </tr>
        </table>";
	}
	function show_callback(){
		$callback_form_htm=RD."/tpl/callback_form.htm";	if (file_exists("$callback_form_htm")){ $callback_form = file_get_contents($callback_form_htm);}
		return $callback_form;
	}
	function send_message(){
		$name=$_POST["name"]; $time_call=$_POST["time_call"];$phone=$_POST["phone"]; $desc=$_POST["desc"]; 
		if ($name=="" or $time_call=="" or $phone=="" or $desc==""){$callback="<table width='100%' height='50%' cellpadding='0' cellspacing='0'><tr valign='top'><td align='center'><p class='Text'><br><br><br>Вы не заполнили обоязательные поля<br><br><a href='javascript:history.back(-1)' class='Text'>Вернуться</a></p></td></tr></table>"; }
		if ($name!="" and $time_call!="" and $phone!="" and $desc!=""){
			$form_htm=RD."/tpl/callback_message.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
			$form=str_replace("{name}",$name,$form);
			$form=str_replace("{phone}",$phone,$form);
			$form=str_replace("{time_call}",$time_call,$form);
			$form=str_replace("{desc}",$desc,$form);
			include "lib/libmail.php";
			$m= new Mail;
			$m->From( "no-reply@omega.km.ua" );
			$m->To( "order@omega.km.ua" );
			$m->Subject( "Заказ обратного звонка" );
			$m->Body( "$form" );
			$m->Priority(4) ;
			$m->Send();
			$callback="<table width='100%' height='100%' cellpadding='0' cellspacing='0'><tr valign='top'><td align='center'><p><br>Спасибо! Мы перезвоним Вам в указаное врема.</p></td></tr></table>"; 
		}
		return $callback;
	}
}
?>