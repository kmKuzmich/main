<?php
class client {
	function get_login_form(){ if ($_POST["login_form"]==""){return $_GET["login_form"];} if ($_POST["login_form"]!=""){return $_POST["login_form"];} }
	function show_login_form(){	
		$form_htm=RD."/tpl/login_form.htm";	if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$forms_htm=RD."/tpl/login_forms.htm";	if (file_exists("$forms_htm")){ $forms = file_get_contents($forms_htm);}
		return array($form,$forms); 
	}

	function show_client_form(){ $odb=new odb;session_start(); $client_id=$_SESSION["client"]; $discount=$_SESSION["discount"];
		$form_htm=RD."/tpl/client_form.htm";if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		$r=$odb->query_td("select * from SUBCONTO where ID='$client_id' limit 0,1;");$sDolg="";
		while(odbc_fetch_row($r)){
			$code=odbc_result($r,"CODE");
			$name=odbc_result($r,"NAME");
			list($saldo,$sDolg,$kredit,$days)=$this->getClientKredit($client_id);
			if ($saldo==""){$saldo=0;}
			list($nearData,$nearSumm,$sDolgN)=$this->fetSubcontoNearDataSum($client_id);
		}$sDolgW="";
		if ($sDolgN>0 and $sDolgN!=""){$sDolgW="<span style='color:red; cursor:pointer;font-weight:bold;' onclick='location.href=\"?dep=32&dep_up=4&dep_cur=14\";'>
		               Просрочено ".$sDolgN."грн.</span><br />";}

		$form=str_replace("{client_name}", $name, $form);
		$form=str_replace("{code}", $code, $form);
		$form=str_replace("{sDolg}", $sDolgW, $form);
		$form=str_replace("{kredit}", $kredit, $form);
		$form=str_replace("{days}", $days, $form);
		$form=str_replace("{saldo}", $saldo, $form);
		$form=str_replace("{nearSumm}", $nearSumm, $form);
		$form=str_replace("{nearData}", $nearData, $form);
		return $form;
	}
	function generateRandomString($length = 64) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$randomString = '';
	    for ($i = 0; $i < $length; $i++) {
    	    $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
    	return $randomString;
	}
	function createFastSubcontoAuth($client_id){$odb=new odb;
		$flink=$this->generateRandomString(64);
		$odb->query_td("insert into SUBCONTO_FASTLINK (subconto_id,flink,ison) values ($client_id,'$flink',1);");
		return $flink;
	}
	function getFastSubcontoAuth($client_id){$odb=new odb;$flink=""; $client_id=htmlspecialchars(trim($client_id), ENT_QUOTES);
		$r=$odb->query_td("select * from SUBCONTO_FASTLINK where subconto_id='$client_id' and ison=1 limit 0,1;");
		while(odbc_fetch_row($r)){ $flink=odbc_result($r,"flink"); }
		if ($flink==""){$flink=$this->createFastSubcontoAuth($client_id);}
		return $flink;
	}
	function fastSubcontoAuth($client_id,$flink){$odb=new odb;$answer=""; $client_id=htmlspecialchars(trim($client_id), ENT_QUOTES);$flink=htmlspecialchars(trim($flink), ENT_QUOTES);
		$r=$odb->query_td("select * from SUBCONTO_FASTLINK where subconto_id='$client_id' and flink='$flink' and ison=1 limit 0,1;");
		while(odbc_fetch_row($r)){session_start();
			$id=odbc_result($r,"id");$_SESSION["client"]=$client_id; $_SESSION["client_group"]=$this->getSubContoType($client_id);$answer="ok"; 
		}
		return $answer;
	}
	function getClientKredit($id){ $odb=new odb;
		$r=$odb->query_td("
		select sd as \"sd\",
		    sdE as \"sdE\",
		    sDolg as \"sDolg\",
		    sDolgE as \"sDolgE\",
		    nvl(K.sumKr,0) \"sumKr\",
		    nvl(K.tmKr,0) \"tmKr\"
		from SubConto S left outer join SubContoKred K on S.id=K.SubConto_id,
        ( select
                cast(sum(case when nvl(D.val_id,980)=980 then
                        case when DP.Property_id=3
                            then D.sum-nvl(D.osum,0)
                        else -D.osum end
                        end) as numeric(12,2)) as sd,
                cast(sum( case when nvl(D.val_id,980)=978 then
                            case when DP.Property_id=3
                                    then D.vsum-nvl(D.vosum,0)
                                    else -D.vosum end
                        end) as numeric(12,2)) as sdE,

                cast(sum(case when  nvl(D.val_id,980)=980 then
                            case when D.sDay < current date    and DP.Property_id=3
                                then D.sum-nvl(D.osum,0)
                            when DP.Property_id is null then  -D.osum end
                            end) as numeric(12,2)) as sDolg,
                cast(sum(case when nvl(D.val_id,980)=978 then
                            case when D.sDay  < current date and DP.Property_id=3
                            then D.vsum-nvl(D.vosum,0)
                            when DP.Property_id is null then -D.vosum end
                        end) as numeric(12,2)) as sDolgE
        from DocOpen O
            left outer join Doc D on D.id=O.doc_id
            left outer join KindDocProperty DP on D.KindDoc_id=DP.KindDoc_id and DP.Property_id=3
        where O.SubConto_id='$id'
	    ) S
    	where S.id='$id';");
		odbc_fetch_row($r);$kredit=odbc_result($r,"sumkr");$days=odbc_result($r,"tmkr");$saldo=odbc_result($r,"sd");$sDolg=odbc_result($r,"sDolg");
		return array($saldo,$sDolg,$kredit,$days);
	}
	function getClientSaldo($id){ $odb=new odb; $slave=new slave;$saldo=0;
		$r=$odb->query_td("select SUM,OSUM from DOC where SUBCONTO_ID='$id' and KINDDOC_ID='27' and OPL='0' order by SDAY;"); 
		while(odbc_fetch_row($r)){$sum=odbc_result($r,"SUM"); $osum=odbc_result($r,"OSUM");if ($osum!=""){$osum=$slave->tomoney($sum)-$slave->tomoney($osum);}if ($osum==""){$osum=$slave->tomoney($sum);} $saldo+=$osum;}
		return $saldo;
	}
	function getSubContoType($id){ $odb=new odb;$type=1;
		$r=$odb->query_td("select * from SUBCONTOTYPES where SUBCONTO_ID='$id';");
		while(odbc_fetch_row($r)){$type=odbc_result($r,"subcontotype_id");}
		return $type;
	}
	function check_client($email,$pass){ $slave=new slave; $odb=new odb; $answer="";
		$email=$slave->qq(strtolower($email));$pass=$slave->qq($pass);
		if ($pass!="" and $email!="") { setcookie("AvtoliderUser", "", time()-3600);setcookie("AvtoliderUserSecure", "", time()-3600);
			$r=$odb->query_td("select * from SUBCONTO where lcase(EMAIL)=lcase('$email') and PWD='$pass' limit 0,1;");
			while(odbc_fetch_row($r)){session_start(); $_SESSION["client_user"]=0;$_SESSION["email"]=$email;$_SESSION["client"]=odbc_result($r,"ID"); $_SESSION["client_group"]=$this->getSubContoType(odbc_result($r,"ID"));$answer="ok"; $data_to=time()+259200;$key=$this->generateRandomString(64);
				setcookie("AvtoliderUser", $_SESSION["client"], $data_to);
				setcookie("AvtoliderUserSecure", $key, $data_to);
				$odb->query_td("insert into SUBCONTO_COOKIES (subconto_id,cookie,data_to) values('".$_SESSION["client"]."','$key','$data_to');");
				list($saldo,$sDolg,$kredit,$days)=$this->getClientKredit($_SESSION["client"]);
				if ($sDolg==0 or $sDolg==""){ $answer="ok"; }
				if ($sDolg>0){ $answer="dolg"; }
			}
			if ($answer=="") {
				$r1=$odb->query_td("select SUBCONTO_ID,NAME from SUBCONTO_USERS where lcase(EMAIL)=lcase('$email') and PWD='$pass' and ISON='1' limit 0,1;");
				while(odbc_fetch_row($r1)){session_start(); $_SESSION["email"]=$email; $_SESSION["client"]=odbc_result($r1,"SUBCONTO_ID"); $_SESSION["client_group"]=$this->getSubContoType(odbc_result($r1,"SUBCONTO_ID")); $_SESSION["client_user"]=odbc_result($r1,"SUBCONTO_ID"); $n=$n1;
				list($saldo,$sDolg,$kredit,$days)=$this->getClientKredit($_SESSION["client"]);
				if ($sDolg==0 or $sDolg==""){ $answer="ok"; }
				if ($sDolg>0){ $answer="dolg"; }
				$data_to=time()+259200;$key=$this->generateRandomString(64);
				setcookie("AvtoliderUser", $_SESSION["client"], $data_to);
				setcookie("AvtoliderUserSecure", $key, $data_to);
				}
			}
			if ($answer==""){ session_start();session_unset($_SESSION["client"]);session_unset($_SESSION["client_user"]);session_unset($_SESSION["email"]);setcookie("AvtoliderUser", "", time()-3600);setcookie("AvtoliderUserSecure", "", time()-3600);$answer="Неверные E-mail или пароль!";}
		}
		if ($pass=="" or $email=="") { $answer="Не заполнены поля E-mail или пароль!"; }
		return $answer;
	}
	function get_cookie_client_info($id){ $slave=new slave; $odb=new odb;
		if ($id!=""){
			$r=$odb->query_td("select * from SUBCONTO where id='$id' limit 0,1;");
			while(odbc_fetch_row($r)){session_start(); $_SESSION["client_user"]=0;$_SESSION["email"]=$email;$_SESSION["client"]=odbc_result($r,"ID"); $_SESSION["client_group"]=$this->getSubContoType(odbc_result($r,"ID"));
				list($saldo,$sDolg,$kredit,$days)=$this->getClientKredit($_SESSION["client"]);
			}
			if ($answer=="") {
				$r1=$odb->query_td("select SUBCONTO_ID,NAME from SUBCONTO_USERS where SUBCONTO_ID='$id' and ISON='1' limit 0,1;");
				while(odbc_fetch_row($r1)){session_start(); $_SESSION["email"]=$email; $_SESSION["client"]=odbc_result($r1,"SUBCONTO_ID"); $_SESSION["client_group"]=$this->getSubContoType(odbc_result($r1,"SUBCONTO_ID")); $_SESSION["client_user"]=odbc_result($r1,"SUBCONTO_ID"); $n=$n1;
					list($saldo,$sDolg,$kredit,$days)=$this->getClientKredit($_SESSION["client"]);
				}
			}
		}
		return;
	}
	function check_cookie_client(){ $slave=new slave; $odb=new odb; $client_id="";$subcont_id="";$data_to="";
		//setcookie("AvtoliderUser", "", time()-3600);setcookie("AvtoliderUserSecure", "", time()-3600);
		$cookie_user=$_COOKIE["AvtoliderUser"];$cookie_key=$_COOKIE["AvtoliderUserSecure"];
		if (($cookie_user!="") and ($cookie_key!="")) {
			$r=$odb->query_td("select * from subconto_cookies where subconto_id='$cookie_user' and cookie='$cookie_key';");
			while(odbc_fetch_row($r)){
				$data_to=odbc_result($r,"data_to");	$odb->query_td("delete from SUBCONTO_COOKIES where cookie='$cookie_key' and subconto_id='$cookie_user';");
				if ($data_to<time()){	$subconto_id=""; setcookie("AvtoliderUser", "", time()-3600);setcookie("AvtoliderUserSecure", "", time()-3600);}
				else{
					$client_id=$cookie_user;
					$data_to=time()+259200;$key=$this->generateRandomString(64);
					setcookie("AvtoliderUser", $client_id, $data_to);
					setcookie("AvtoliderUserSecure", $key, $data_to);
					$odb->query_td("insert into SUBCONTO_COOKIES (subconto_id,cookie,data_to) values('".$client_id."','$key','$data_to');");
					$this->get_cookie_client_info($client_id);
				}
			}
		}
		return $client_id;
	}
	function outAcount(){session_start(); session_unset($_SESSION["client"]);session_unset($_SESSION["email"]);setcookie("AvtoliderUser", "", time()-3600);setcookie("AvtoliderUserSecure", "", time()-3600);return "ok";}
	function out_Acount(){session_start();session_unset($_SESSION["client"]);session_unset($_SESSION["email"]);setcookie("AvtoliderUser", "", time()-3600);setcookie("AvtoliderUserSecure", "", time()-3600);return "ok";}
	
	function get_client(){session_start(); $client_id=$_SESSION["client"];
		if ($client_id==""){ $client_id=$this->check_cookie_client(); }
		if ($client_id==""){ list($form,$forms)=$this->show_login_form(); }
		if ($client_id!=""){ $form=$this->show_client_form(); }
		return array($form,$forms);
	}
	
	function sendAcountInfo($email){ session_start();$odb=new odb;$slave=new slave; $answer="";$email=strtolower($email);
		$r=$odb->query_td("select id,Name,pwd from SUBCONTO where email='$email' limit 0,1;");
		while(odbc_fetch_row($r)){
			$id=odbc_result($r,"id");
			$Name=odbc_result($r,"Name");
			$pass=odbc_result($r,"pwd");
			$message_htm=RD."/tpl/message_pass_forgot.htm";if (file_exists("$message_htm")){ $message = file_get_contents($message_htm);}
			$message=str_replace("{pass}", $pass, $message);
			$message=str_replace("{email}", $email, $message);
			$message=str_replace("{name}", $Name, $message);
			$message=str_replace("{client_id}", $id, $message);
			$message=str_replace("{flink}", $this->getFastSubcontoAuth($id), $message);
			$message=str_replace("{remip}", $_SERVER['REMOTE_ADDR'], $message);
			
			include_once RD."/mail/sendmail.class.php";$Mail = new sendmail();
			$Mail->mail_to = "$Name <$email>";
			$Mail->subject = "Password recovery to zakaz.avtolider-ua.com";
			$Mail->message = $message;
			$Mail->from_name = "Avtolider";
			$Mail->SendFromMail = "no-reply@avtolider-ua.com";
			$Mail->Send();

			$answer="ok";
		}
		if ($answer=="") { $answer="Введенный адрес электронной почты не существует в системе"; }
		return $answer;
	}
	function showStateForm($id,$pls){$odb=new odb;
		if ($pls=="1"){$name="RegState_form";$function="showCityForm(this[this.selectedIndex].value);";}if ($pls=="2"){$name="state_form";$function="showCityOrderForm(this[this.selectedIndex].value);";}
		$form="<select id='$name' name='$name' onchange='$function' style='width:400px;'><option value='#'> --- </option>";
		$r=$odb->query_td("select * from REGION_NEW order by id asc;");
		while(odbc_fetch_row($r)){
			$id=odbc_result($r,"ID");
			$caption=odbc_result($r,"NAME");
			$form.="<option value='$id'>$caption</option>";
		}
		$form.="</select>";
		return $form;
	}
	function showCityForm($state){$odb=new odb;$form="<select id='RegCity_form' name='RegCity_form' onchange='checkNewCity(this[this.selectedIndex].value);' style='width:400px;'>";
		$r=$odb->query_td("select * from CITY_NEW where REGION_ID='$state' order by NAME,ID asc;");
		while(odbc_fetch_row($r)){
			$id=odbc_result($r,"ID");
			$caption=odbc_result($r,"NAME");
			$form.="<option value='$id'>$caption</option>";
		}
		$form.="<option value='0'>-- Новый населенный пункт --</option>";
		$form.="</select>";
		return $form;
	}
	function showCityOrderForm($state){$odb=new odb;$form="<select id='city_form' name='city_form' onchange='checkNewOrderCity(this[this.selectedIndex].value);' style='width:400px;'>";
		$r=$odb->query_td("select * from CITY_NEW where REGION_ID='$state' order by NAME,ID asc;");
		while(odbc_fetch_row($r)){
			$id=odbc_result($r,"ID");
			$caption=odbc_result($r,"NAME");
			$form.="<option value='$id'>$caption</option>";
		}
		$form.="<option value='0'>-- Новый населенный пункт --</option>";
		$form.="</select>";
		return $form;
	}
	function showActivityForm($sid){$odb=new odb;$form="<select id='RegActivity_form' name='RegActivity_form' style='width:400px;'>";
		$r=$odb->query_td("select * from SUBCONTO_ACTIVITY order by id asc;");
		while(odbc_fetch_row($r)){
			$id=odbc_result($r,"id");
			$caption=odbc_result($r,"NAME");
			if ($id==$sid){$form.="<option value='$id' selected='selected'>$caption</option>";}
			if ($id!=$sid){$form.="<option value='$id'>$caption</option>";}
		}
		$form.="</select>";
		return $form;
	}
	function saveClientRegistration($recaptcha_challenge_field,$recaptcha_response_field,$email,$name,$state,$city,$new_city,$address,$phone,$activity){session_start();$odb=new odb;$slave=new slave;
		require_once(RD."/recaptchalib.php"); $privatekey = "6LcepdkSAAAAABAOFjbEHh7rTcr1OqYqB7srixb-";
		$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $recaptcha_challenge_field, $recaptcha_response_field);
		if (!$resp->is_valid) {
			// What happens when the CAPTCHA was entered incorrectly
			$err=1;$answer="Сработала защита от спама";
	    } else {
		    // Your code here to handle a successful verification
	
		$pass=$slave->qq($pass);$email=$slave->qq(strtolower($email));$name=$slave->qq($name);$city=$slave->qq($city);$new_city=$slave->qq($new_city);$address=$slave->qq($address);$phone=$slave->qq($phone);
		if ($new_city!=""){$city=$this->add_new_city($state,$new_city);}
		if ($email=="" or $name=="" or $city=="" or $address=="" or $phone==""){ $err=1; $answer="Не заполнены обязательные поля!!!"; }
		if ($email!="" and $name!="" and $city!="" and $address!="" and $phone!=""){$remip=$_SERVER['REMOTE_ADDR'];
			$r=$odb->query_td("SELECT subconto.id FROM SUBCONTO inner join SUBCONTO_USERS on (subconto.id=subconto_users.SubConto_id) where subconto.email='$email' or subconto_users.email='$email' limit 0,1;");$n=$odb->num_rows($r);
			if ($n>0){ $err=1;$answer="Указаный вами EMAIL уже зарегистрирован в нашем интернет-магазине!!!"; }
			if ($n==0){
				
				include(RD.'/lib/pwd.gen.php'); $pwgen = new PWGen(); $pass = $pwgen->generate();$date=date("Y-m-d");
				$r=$odb->query_lider("SELECT max(id) as mid FROM subconto;");odbc_fetch_row($r);$mid=odbc_result($r,"mid")+1;
				$r=$odb->query_lider("SELECT max(code) as code FROM subconto;");odbc_fetch_row($r);$code=odbc_result($r,"code")+1;
				$state_name=$this->get_table_caption("region_new",$state);
				$city_name=$this->get_table_caption("city_new",$city);
				$odb->query_lider("INSERT INTO subconto (id,code,Name,email,pwd,country_id,region_id,city_id,Adres,phone,Remark,base_id,dateAdd,flag) VALUES ('$mid','$code', '$name','$email','$pass','1','100','100','$address','$phone','".$this->get_table_caption("subconto_activity",$activity).", $state_name, $city_name','1','$date','1');");
				$odb->query_lider("INSERT INTO subcontotypes (subconto_id,subcontotype_id) VALUES ('$mid', '1');");
				$odb->query_lider("INSERT INTO subcontotypes (subconto_id,subcontotype_id) VALUES ('$mid', '13');");
				
				$message_htm=RD."/tpl/message_registration.htm";if (file_exists("$message_htm")){ $message = file_get_contents($message_htm);}
				$message=str_replace("{pass}", $pass, $message);
				$message=str_replace("{email}", $email, $message);
				$message=str_replace("{client_name}", $name, $message);
				$message=str_replace("{state}", $this->get_table_caption("REGION_NEW",$state), $message);
				$message=str_replace("{city}", $this->get_table_caption("CITY_NEW",$city), $message);
				$message=str_replace("{address}", $address, $message);
				$message=str_replace("{phone}", $phone, $message);
				$message=str_replace("{activity}", $this->get_table_caption("SUBCONTO_ACTIVITY",$activity), $message);
				$message=str_replace("{remip}", $remip, $message);
				$message=str_replace("{flink}", $this->getFastSubcontoAuth($mid), $message);
				$message=str_replace("{client_id}", $mid, $message);
				
				include_once RD."/mail/sendmail.class.php";$Mail = new sendmail();
				$Mail->mail_to = "$name <$email>";
				$Mail->subject = "Zakaz.avtolider-ua.com: Client registration";
				$Mail->message = $message;
				$Mail->from_name = "Avtolider";
				$Mail->SendFromMail = "no-reply@avtolider-ua.com";
				$Mail->Send();
				$err=0; $answer="Вы успешно зарегистрировались";
			}
		}
		}
		return array($err,$answer);
	}
	function create_noreg_client($activity,$name,$email,$phone,$state,$city,$new_city,$address_sent){session_start();$odb=new odb;$slave=new slave; $email=strtolower($email);
		if ($new_city!=""){$city=$this->add_new_city($state,$new_city);}
		include_once(RD.'/lib/pwd.gen.php'); $pwgen = new PWGen(); $pass = $pwgen->generate();$date=date("Y-m-d");
		$r=$odb->query_lider("SELECT max(id) as mid FROM subconto;");odbc_fetch_row($r);$mid=odbc_result($r,"mid")+1;
		$r=$odb->query_lider("SELECT max(code) as code FROM subconto;");odbc_fetch_row($r);$code=odbc_result($r,"code")+1;
		$state_name=$this->get_table_caption("region_new",$state);
		$city_name=$this->get_table_caption("city_new",$city);
		$odb->query_lider("INSERT INTO subconto (id,code,Name,email,pwd,country_id,region_id,city_id,Adres,phone,Remark,base_id,dateAdd,flag) VALUES ('$mid','$code', '$name','$email','$pass','1','100','100','$address','$phone','".$this->get_table_caption("subconto_activity",$activity).", $state_name, $city_name','1','$date','1');");
		$odb->query_lider("INSERT INTO subcontotypes (subconto_id,subcontotype_id) VALUES ('$mid', '1');");
		$odb->query_lider("INSERT INTO subcontotypes (subconto_id,subcontotype_id) VALUES ('$mid', '13');");
		
		
		$message_htm=RD."/tpl/message_registration.htm";if (file_exists("$message_htm")){ $message = file_get_contents($message_htm);}
		$message=str_replace("{pass}", $pass, $message);
		$message=str_replace("{email}", $email, $message);
		$message=str_replace("{client_name}", $name, $message);
		$message=str_replace("{state}", $this->get_table_caption("REGION_NEW",$state), $message);
		$message=str_replace("{city}", $this->get_table_caption("CITY_NEW",$city), $message);
		$message=str_replace("{address}", $address, $message);
		$message=str_replace("{phone}", $phone, $message);
		$message=str_replace("{activity}", $this->get_table_caption("SUBCONTO_ACTIVITY",$activity), $message);
		$message=str_replace("{remip}", $_SERVER['REMOTE_ADDR'], $message);
		$message=str_replace("{flink}", $this->getFastSubcontoAuth($mid), $message);
		$message=str_replace("{client_id}", $mid, $message);
					
		include_once RD."/mail/sendmail.class.php";$Mail = new sendmail();
		$Mail->mail_to = "$name <$email>";
		$Mail->subject = "Zakaz.avtolider-ua.com: Client registration";
		$Mail->message = $message;
		$Mail->from_name = "Avtolider";
		$Mail->SendFromMail = "no-reply@avtolider-ua.com";
		$Mail->Send();
		return $mid;
	}
	function add_new_city($state,$caption){$odb=new odb;
		if ($state!="" and $state!=0 and $caption!=""){
			$r=$odb->query_td("SELECT max(id) as mid FROM CITY_NEW;");odbc_fetch_row($r);$mid=odbc_result($r,"mid")+1;
			$odb->query_td("insert into `CITY_NEW` (ID,NAME,REGION_ID) values ('$mid','$caption','$state');");
			return $mid;
		}
	}
	function get_client_status(){
		$client_id=$_SESSION["client"];
		if ($client==""){return "1";}
		if ($client!=""){return "2";}
	}
	function get_client_name($client_id){	$odb=new odb;$name="";
		if ($client_id!=0){
			$r=$odb->query_td("select Name from subconto where id='$client_id' limit 0,1;");
			while(odbc_fetch_row($r)){ $name=odbc_result($r,"Name");}
		}
		return $name;
	}
	function get_client_user_name($client_id){	$odb=new odb;$name="Гость";
		if ($client_id!=0){
			$r=$odb->query_td("select Name from subconto_users where id='$client_id' limit 0,1;");
			while(odbc_fetch_row($r)){$name=odbc_result($r,"Name");}
		}
		return $name;
	}
	function get_client_login($client_id){$odb=new odb;$email="Anonymouse";
		$r=$odb->query_td("select email from subconto where id='$client_id' limit 0,1;");
		while(odbc_fetch_row($r)){$email=odbc_result($r,"email"); }
		return $email;
	}
	function checkClientEmail($email){$odb=new odb;$email=strtolower($email);
		$r=$odb->query_td("select email from subconto where email='$email' limit 0,1;");$n=$odb->num_rows($r);
		if ($n>0) { return array(1,"<span style='color:red;'>Email принадлежит другому пользователю</span>"); }
		if ($n==0) {
			$r1=$odb->query_td("select email from lider_subconto_users where email='$email' limit 0,1;");$n1=$odb->num_rows($r1);
			if ($n>0) { return array(1,"<span style='color:red;'>Email принадлежит другому пользователю</span>"); }
			if ($n==0) {
				return array(0,"<span style='color:green;'>Доступен для регистрации</span>");
			}
		}
	}
	function get_order_form_data($client_id){$odb=new odb;
		$r=$odb->query_td("select code,Name,email,phone,Adres from subconto where id='$client_id' limit 0,1;");
		while(odbc_fetch_row($r)){
			$code=odbc_result($r,"code");
			$name=odbc_result($r,"Name");
			$email=odbc_result($r,"email");
			$phone=odbc_result($r,"phone");
			$address=odbc_result($r,"Adres");
			list($cont_person,$phone_person,$address_person,$typepay,$carrier,$remark)=$this->getAdresDeliv($client_id);
			return array($code,$name,$email,$phone,$address,$cont_person,$phone_person,$address_person,$typepay,$carrier,$remark);
		}
		if ($n==0) {return array("","","","","","","");}
	}
	function getAdresDeliv($client_id){$odb=new odb;
		$r=$odb->query_td("select * from adresdeliv where subconto_id='$client_id' and n='1' limit 0,1;");
		while(odbc_fetch_row($r)){
			$contperson=odbc_result($r,"contperson");
			$phone=odbc_result($r,"phone");
			$address=odbc_result($r,"adres");
			$typepay=odbc_result($r,"typepay_id");
			$carrier=odbc_result($r,"carrier_id");
			$remark=odbc_result($r,"remark");
			return array($contperson,$phone,$address,$typepay,$carrier,$remark);
		}
		if ($n==0) {return array("","","","","");}
	}
	function get_table_caption($tname,$id){ $odb=new odb; if ($file==0){$file=1;}$name="";
		$r=$odb->query_td("select NAME from $tname where id='$id' limit 0,1;");
		while(odbc_fetch_row($r)){$name=odbc_result($r,"NAME");}
		return $name;
	}
	function fetSubcontoNearDataSum($client){$odb=new odb;$slave=new slave;
		$r=$odb->query_td("
		select *
	     from (select KD.Name \"docName\",
	    	D.Num \"num\",
    		to_char(D.Day,'dd-mm-yyyy') \"day\",
			case when D.sDay < current date then 'style=\"color:red\"' else '' end as \"clr\",
			case when D.kinddoc_id in (61) then 
				nvl(to_char(Null,'dd-mm-yyyy'),'') 
				else nvl(to_char(D.sDay,'dd-mm-yyyy'),'') end as \"sday\",
		   cast(case
        	when nvl(D.val_id,0)!=978 then
	           case when D.KindDoc_id in (3,27,20,28) then D.sum
    	           else -D.sum end
        	end as numeric(12,2)) as \"s\",
		   cast(case
        	  when nvl(D.val_id,0)!=978 then
            case when D.KindDoc_id in (3,27,20,28) then D.sum-nvl(D.osum,0)
            else -D.osum end
        end as numeric(12,2)) as \"os\",
		  cast(case when nvl(D.val_id,0)=978 then
           case when D.KindDoc_id in (3,27,20,28) then D.vsum
           else -D.vsum
           end
        end as numeric(12,2)) as \"vs\",
		   cast(case
         when nvl(D.val_id,0)=978 then
          case when D.KindDoc_id in (3,27,20,28) then D.vsum-nvl(D.vosum,0)
          else -D.vosum
          end
         end as numeric(12,2)) as \"vos\",
	    D.id \"doc_id\",
		D.kinddoc_id \"kinddoc_id\",
		D.SubConto_id
	 from DocOpen O
        left outer join Doc D on D.id=O.doc_id
        join KindDoc KD on KD.id=D.KindDoc_id
		  where O.SubConto_id='$client')
		  where \"os\"!=0 or \"vos\"!=0
		 order by \"sday\",\"num\";");$nearData="";$nearSumm=0;$k=0;$i=0;$sDolgN=0;
		while(odbc_fetch_row($r)){$k+=1;$i+=1;
			$day=odbc_result($r,"day");
			$kinddoc_id=odbc_result($r,"kinddoc_id");
			$sday=odbc_result($r,"sday");
			$os=$slave->tomoney(odbc_result($r,"os"));
			if ((date("Ymd",strtotime($sday))<=date("Ymd",mktime(0,0,0,date("m"),date("d")+3,date("Y")))) and (($kinddoc_id==27)||($kinddoc_id==3)) and ($os>0)){$nearSumm+=$os;$nearData=date("d-m-Y");}
			if ((date("Ymd",strtotime($sday))<=date("Ymd",mktime(0,0,0,date("m"),date("d"),date("Y")))) and ($os>0)){$sDolgN+=$os;}
			
		}$sDolgN=round($sDolgN,2);
		if ($sDolgN<0){$sDolgN=0;}
		$nearSumm=$slave->int_to_money($nearSumm);
		return array($nearData,$nearSumm,$sDolgN);
	}
}
?>