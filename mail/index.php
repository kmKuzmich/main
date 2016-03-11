<?php 
include_once "sendmail.class.php";$Mail = new sendmail();
			// Set congif
			$Mail->SendMailVia = 'smtp';  // Send via smtp server or mail function
			$Mail->mail_to = "andrey <webspektr@gmail.com>";
			$Mail->subject = "Password recovery to zakaz.avtolider-ua.com";
			$Mail->message = "Password recovery to zakaz.avtolider-ua.com";
			$Mail->from_name = "Avtolider";
			$Mail->SendFromMail = "no-reply@avtolider-ua.com";
			$Mail->Send();
?>