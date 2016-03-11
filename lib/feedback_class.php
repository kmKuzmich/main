<?php
class feedback {
	function show_feedback(){ 
		$form_htm=RD."/tpl/feedback_form.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);} 	
		require_once(RD."/recaptchalib.php");
        $publickey = "6LcepdkSAAAAAIOcL-HphDNHWLGJ0e7qY3HtkDPu ";
        $form=str_replace("{recapcha}",recaptcha_get_html($publickey),$form);
		return $form;
	}
	
	function save_send_message(){$slave=new slave;
		$form_htm=RD."/tpl/feedback_error.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		require_once(RD."/recaptchalib.php"); $privatekey = "6LcepdkSAAAAABAOFjbEHh7rTcr1OqYqB7srixb-";
		$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
		if (!$resp->is_valid) {
			// What happens when the CAPTCHA was entered incorrectly
			$message="Сработала защита от спама<br><br><a href='javascript:history.back(-1)' class='Text'>Повторите попытку</a>";
	    } else {
			$name=$slave->qq($_POST["name"]);$phone=$slave->qq($_POST["phone"]);$theme=$slave->qq($_POST["theme"]);$email=$slave->qq($_POST["email"]);$desc=$slave->qq($_POST["desc"]);
		
			$x=ereg("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-z]{2,3}$",$email);
			if($x==0){ $message="Не коректно введен Е-mail адрес<br><br><a href='javascript:history.back(-1)' class='Text'>Попробуйте еще раз</a>"; }
			else {
				if ($name=="" or $phone=="" or $email=="" or $theme=="" or $desc==""){$message="Не заполнены обязательные поля!!!<br><br><a href='javascript:history.back(-1)' class='Text'>Попробуйте еще раз</a>";}
				if ($name!="" and $phone!="" and $email!="" and $theme!="" and $desc!=""){
					$mess_htm=RD."/tpl/feedback_message.htm";if (file_exists("$mess_htm")){ $mess = file_get_contents($mess_htm);}
					$mess=str_replace("{name}",$name,$mess);
					$mess=str_replace("{phone}",$phone,$mess);
					$mess=str_replace("{email}",$email,$mess);
					$mess=str_replace("{theme}",$theme,$mess);
					$mess=str_replace("{desc}",$desc,$mess);
					$mess=str_replace("{remip}",$_SERVER['REMOTE_ADDR'],$mess);
					$mess=str_replace("{data}",date("d-m-Y"),$mess);
					include RD."/lib/libmail.php";$m= new Mail;
					$m->From("$email"); $m->To("webspektr@gmail.com");
					$m->Cc("info@webspektr.com");
					$m->Subject("Запрос с сайта zakaz.avtolider-ua.com");
					$m->Body("$mess");
					$m->Priority(4);$m->Send();
					$form_htm=RD."/tpl/feedback_save.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
				}
			}
		}
		$form=str_replace("{message}",$message,$form);
		return $form;
	}
}
?>