<?php

class client
{
    function get_login_form()
    {
        if ($_POST["login_form"] == "") {
            return $_GET["login_form"];
        }
        if ($_POST["login_form"] != "") {
            return $_POST["login_form"];
        }
    }

    function show_login_form()
    {
        $form_htm = RD . "/tpl/login_form.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $forms_htm = RD . "/tpl/login_forms.htm";
        if (file_exists("$forms_htm")) {
            $forms = file_get_contents($forms_htm);
        }
        return array($form, $forms);
    }

    function show_client_form()
    {
        $odb = new odb;
        session_start();
        $nearSumm = 0;
        $nearData = "";
//        if empty($_SESSION["client"])
        $client_id = $_SESSION["client"];
        $discount = $_SESSION["discount"];
        $is_logout = $this->checkClientLogout($client_id);
        if ($is_logout == 1) {
            list($form, $forms) = $this->show_login_form();
        }
        if ($is_logout == 0) {
            $form_htm = RD . "/tpl/client_form.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
            $r = $odb->query_td("select * from SUBCONTO where ID='$client_id' limit 1 offset 0;");
            $sDolg = "";
            while (odbc_fetch_row($r)) {
                $code = odbc_result($r, "CODE");
                $name = substr(odbc_result($r, "NAME"), 0, 40);
//                list($saldo, $nearSumm, $kredit, $days) = $this->getClientKredit($client_id);
                list($nearData, $nearSumm, $saldo) = $this->getSubcontoNearDataSumNew($client_id);
                if ($saldo == "") {
                    $saldo = 0;
                }
//                list($nearData1, $sDolgN, $nearSumm) = $this->getSubcontoNearDataSum($client_id); //$nearData1 потому что рассчитывается непраивльно
//для обновления убери коментарий с ст.56 поставь на ст.54
                list($nearData, $nearSumm, $saldo) = $this->getSubcontoNearDataSumNew($client_id);
            }
//			Если есть просрочка $nearDara < today, вывести красным цветом сумму просрочки $sDolgW
            $sDolgW = "";
//            для обновления сними комент с стр 61-64, установи на 65-66
            if ((($nearData != "")) & ($nearData < date('Y-m-d'))) {
                $sDolgW = "<span style='color:red; cursor:pointer;font-weight:bold;' onclick='location.href=\"?dep=32&dep_up=4&dep_cur=14\";'>
	               Просрочено " . $nearSumm . "грн.</span><br />";
            }
//            if ($sDolgN > 0 and $sDolgN != "") {
//                $sDolgW = "<span style='color:red; cursor:pointer;font-weight:bold;' onclick='location.href=\"?dep=32&dep_up=4&dep_cur=14\";'>
//	               Просрочено " . $nearSumm . "грн.</span><br />";
//            } //$sDolgN
//			if ($nearSumm > 0 and $nearSumm != "") {
//				$sDolgW = "<span style='color:red; cursor:pointer;font-weight:bold;' onclick='location.href=\"?dep=32&dep_up=4&dep_cur=14\";'>
//	               Просрочено " . $nearSumm . "грн.</span><br />";
//			}
            $form = str_replace("{client_name}", $name, $form);
            $form = str_replace("{code}", $code, $form);
            $form = str_replace("{sDolg}", $sDolgW, $form);
//			$form = str_replace("{kredit}", $kredit, $form);
//			$form = str_replace("{days}", $days, $form);
//			$form = str_replace("{saldo}", $saldo, $form);
            $form = str_replace("{saldo}", $saldo, $form);
            $form = str_replace("{nearSumm}", $nearSumm, $form);
            $form = str_replace("{nearData}", $nearData, $form);
//			$form=str_replace("{nearData}", "", $form);
        }
        return $form;
    }

    function generateRandomString($length = 64)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    function createFastSubcontoAuth($client_id)
    {
        $odb = new odb;
        $flink = $this->generateRandomString(64);
        $odb->query_td("insert into SUBCONTO_FASTLINK (id,subconto_id,flink,ison) values ((select max(id)+1 from SUBCONTO_FASTLINK),$client_id,'$flink',1);");
        return $flink;
    }

    function getFastSubcontoAuth($client_id)
    {
        $odb = new odb;
        $flink = "";
        $client_id = htmlspecialchars(trim($client_id), ENT_QUOTES);
        $r = $odb->query_td("select * from SUBCONTO_FASTLINK where subconto_id='$client_id' and ison=1 limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $flink = odbc_result($r, "flink");
        }
        if ($flink == "") {
            $flink = $this->createFastSubcontoAuth($client_id);
        }
        return $flink;
    }

    function fastSubcontoAuth($client_id, $flink)
    {
        $odb = new odb;
        $answer = "";
        $client_id = htmlspecialchars(trim($client_id), ENT_QUOTES);
        $flink = htmlspecialchars(trim($flink), ENT_QUOTES);
        $r = $odb->query_td("select * from SUBCONTO_FASTLINK where subconto_id='$client_id' and flink='$flink' and ison=1 limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            session_start();
            $id = odbc_result($r, "id");
            $_SESSION["client"] = $client_id;
            $_SESSION["client_group"] = $this->getSubContoType($client_id);
            $answer = "ok";
        }
        return $answer;
    }

    function getClientMessages()
    {
        $odb = new odb;
        $ex = 0;
        session_start();
        $client_id = $_SESSION["client"];
        //добавил в запрос   "and mss.client_id='$client_id'" - чтоб правильно выбирало из mess_status
        /*
                    $r=$odb->query_td("
                    select M.id,M.Day,M.header,M.body,DS.name
                    from
                        Messages as M
                        left outer join DocState DS on DS.id=M.state_id
                        left outer join mess_status as mss on mss.mess_id=M.id and mss.client_id='$client_id'
                        where
                            sDay<=current_date
                            and (M.client_id='$client_id'
                                or ('$client_id' in (select SubConto_id from SubContoTypes as TS where TS.SubcontoType_id=M.group_id)
                                and not exists(select M1.id  from Messages as M1 where M1.id1=M.id and M1.client_id='$client_id')))
                            and mss.mess_id is null
                            and M.state_id =27
                        limit 1 offset 0;
                            ");
        */
        $needUpdateM = 0;
        if ($needUpdateM == 1) {
            $r = $odb->query_td("
                select M.id,M.Day,M.header,M.body,D.Num
                    from Messages M
                        join Doc D on D.id=M.id
                        left outer join Messages as M1 on M.group_id is not null and M1.id1=M.id  and M1.client_id='$client_id'
                        left outer join DocState DS on DS.id= nvl(M1.state_id,M.state_id)
                        left outer join mess_status as mss on mss.mess_id=nvl(M.id,M1.id) and mss.client_id='$client_id'				 					
                    where (M.client_id='$client_id'
                            or '$client_id' in (select SubConto_id from SubContoTypes as TS where TS.SubcontoType_id=M.group_id)  )				
                        and M.sDay<=current_date 
                        and mss.mess_id is null
                        and nvl(M1.state_id,M.state_id)=27
                    limit 1 offset 0;");

            while (odbc_fetch_row($r)) {
                $ex = 1;
                $id = odbc_result($r, "id");
                $message = "[#" . odbc_result($r, "num") . "] " . odbc_result($r, "header");
                $data = odbc_result($r, "day");
                $form_htm = RD . "/tpl/client_messageBox_form.htm";
                if (file_exists("$form_htm")) {
                    $form = file_get_contents($form_htm);
                }
                $form = str_replace("{id}", $id, $form);
                $form = str_replace("{message}", $message, $form);
                $form = str_replace("{data}", $data, $form);

            }
        }
        return array($ex, $form);
    }

    function showMessageBox($mess_id)
    {
        $odb = new odb;
        session_start();
        $client_id = $_SESSION["client"];
//		$r=$odb->query_td("select M.id,M.Day,M.header,M.body,DS.name from Messages as M left outer join DocState DS on DS.id=M.state_id where M.id='$mess_id' and sDay<=current_date and (M.client_id='$client_id' or ('$client_id' in (select SubConto_id from SubContoTypes as TS where TS.SubcontoType_id=M.group_id) and not exists(select M1.id  from Messages as M1 where M1.id1=M.id and M1.client_id='$client_id'))) limit 1 offset 0;");

        $r = $odb->query_td("
			select M.id,M.Day,M.header,M.body,D.Num 
				from Messages M
					join Doc D on D.id=M.id
					left outer join Messages as M1 on M.group_id is not null and M1.id1=M.id  and M1.client_id='$client_id'
					left outer join DocState DS on DS.id= nvl(M1.state_id,M.state_id)
					left outer join mess_status as mss on mss.mess_id=nvl(M.id,M1.id)  and mss.client_id='$client_id'				 										
				where (M.client_id='$client_id'
						or '$client_id' in (select SubConto_id from SubContoTypes as TS where TS.SubcontoType_id=M.group_id)  )				
					and M.sDay<=current_date 
					and mss.mess_id is null
					and nvl(M1.state_id,M.state_id)=27
				limit 1 offset 0;");


        while (odbc_fetch_row($r)) {
            $message = odbc_result($r, "body");
            $data = odbc_result($r, "day");
            $name = odbc_result($r, "name");
            $subject = "[#" . odbc_result($r, "num") . "] " . odbc_result($r, "header");
            $form_htm = RD . "/tpl/client_messageBox_show.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
            $form = str_replace("{id}", $mess_id, $form);
            $form = str_replace("{subject}", $subject, $form);
            $form = str_replace("{message}", $message, $form);
            $form = str_replace("{data}", $data, $form);
        }
        return $form;
    }

//Функция проверяет когда показывалось сообщение Об оплате и если больше чем $p секунд назад то показать сообщение.
    function showMessageExp()
    {
        if (isset($_REQUEST[session_name()])) session_start();
//        session_start();
        if (empty($_SESSION["client"])) {
            setcookie("ShowTime", '', -3600);
            return;
        }
        $client = $_SESSION["client"];
        $expireDays = 0;
        $show = 0;
        $p = 180 * 60; //в секундах
        $data_to = time() + $p;
        setcookie("Period", $p, $data_to);
        list($nearData, $nearSumm, $Dolg) = $this->getSubcontoNearDataSumNew($client);//5551//12515//14882
//        echo "дата $nearData сумм б $nearSumm сумма $Dolg";
//если куки уже не существует и есть долг - разрешить показывать сообщение и установить время когда был показ
        if (((empty($_COOKIE["ShowTime"])) || (time() > $_COOKIE["ShowTime"] + $p)) & ($nearSumm > 0)) {
            $show = 1;
            setcookie("ShowTime", time(), $data_to);
//            echo $show;
        };
        $expireDays = ((strtotime($nearData) - strtotime(date('Y-m-d'))) / 3600 / 24);
//        echo(date('Y-m-d') . " просрочено " . $expireDays . " дней с " . ($nearData));
        if ($expireDays <= 0) {
//            $mess = "<span style='font-size: 18;color: red;font-weight: bold;'>Пора платить! $nearData сумма " . $nearSumm . "</span><br /> повторное напоминание будет через $p секунд";
            $mess = "<span class='messExp'> Пора платить! $nearData сумма " . $nearSumm . "</span><br /> повторное напоминание будет через $p секунд";
        };
        switch ($expireDays) {
            case (1) :
                $mess = "<span class='messExp1'>Нагадуємо, завтра $nearData настає дата оплати. <br /> Будемо дуже вдячні за вчасний платіж на суму $nearSumm грн.</span> <br />Якщо ви вже здійснили оплату, то незабаорм ця інформація підтвердиться";
//        це другий можливий варіант повідомлення
//        $mess = "<span class='messExp'>Завтра закінчується відтермінування за товарним кредитом. <br /> Ми чекаємо від Вас платіж на суму $nearSumm грн </span>>";
                break;
            case (0) :
                $mess = "<span class='messExp0'>Нагадуємо, сьогодні настала дата оплати за товарний кредит. На завтра Борг становитиме $nearSumm грн,<br />ми чекаємо від Вас платіж на цю суму.</span> <br />Якщо ви вже здійснили оплату, то незабаорм ця інформація підтвердиться, у іншому випадку Вам краще зв'язатись з нашим менеджером для перевірки інформації";
                break;
            default :
                if ($expireDays < 0)
                    $mess = " <span class='messExp'> Ваш  борг на завтра складатиме $nearSumm <br /> Прохання погасити його, інакше ми будемо вимушені призупинити Вам відправку товару. <br /> Дякуємо за співпрацю! </span><br />Зауважте що дата сплати $nearData. Якщо ви вже здійснили оплату, то незабаорм ця інформація підтвердиться, у іншому випадку Вам краще зв'язатись з нашим менеджером для перевірки інформації";
                else $mess = "";
//        це другий можливий варіант повідомлення
//                $mess = "<span class='messExp' > У вас є прострочена заборгованність на суму $nearSumm грн .<br /> Прохання погасити її, інакше ми будемо вимушені призупинити Вам відправку товару . <br /> Дякуємо за співпрацю! </span > ";
        }
        if ($mess == "") {
            $show = 0;
        };
//        для включения обновлений закоментируй $show=0
//        $show = 1;
        setcookie("show", $show, $data_to);
        setcookie("expireDays", $expireDays, $data_to);
        setcookie("Message", $mess, $data_to);
        return array($mess, $show);
    }

    function setMessageStatus($mess_id, $status_id)
    {
        $odb = new odb;
        session_start();
        $client_id = $_SESSION["client"];
        $odb->query_lider("create variable @last_id integer ");
        $odb->query_lider("insert into Local(user_id) values(-1);");
        $odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
        $odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
        $odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");
        $odb->query_lider("call setDocState($mess_id, $status_id, $client_id);");
        /*		$r = $odb->query_lider("call setDocState($mess_id, $status_id, $client_id);"); //Если сообщение было группе то будет newId иначе Null;
                odbc_fetch_row($r);$mess_id1=odbc_result($r,1);
                print 'NEW id='.$mess_id1;
                if (!$mess_id1) {$mess_id=$mess_id;
        }
         else {
        $mess_id = $mess_id1;
    }  //если сообщение не для группы то NewId будет нуль тогда mess_id не менять
        //		оказалось что это всё равно не работает, потому что NewId ещё не существует в DB2 и сообщение продолжает отображаться, чтоб побороть эту проблему в таблицу mess_status загружаю MESS_ID главного сообщения
        */
//		print 'NEW id='.
        $mess_id . ' KLIENT =' . $client_id;
        $odb->query_td("insert into mess_status(mess_id, client_id) values('$mess_id', $client_id);");
        return 1;
    }

    function setMessageAnswer($mess_id, $answer)
    {
        $odb = new odb;
        $odbA = new odb;
        session_start();
        $client_id = $_SESSION["client"];

        $odb->query_lider("call setDocState($mess_id, 29, $client_id);");
        $odb->query_td("insert into mess_status(mess_id, client_id) values('$mess_id', $client_id);");

        $odbA->query_lider("create variable @last_id integer ");
        $odbA->query_lider("insert into Local(user_id) values(-1);");
        $odbA->query_lider("SET OPTION DATE_ORDER = 'DMY';");
        $odbA->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
        $odbA->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");
        $data_lider = date('d-m-Y');

        $r = $odbA->query_lider("call addMessage('$data_lider', '$data_lider', '$answer', '$answer', '$client_id', null, null, '$mess_id');"); //select newId;
        odbc_fetch_row($r);
        $mess_id1 = odbc_result($r, 1);
        //print 'newid ='.$mess_id1;
        $odbA->query_lider("call setDocState($mess_id1, 29, $client_id);");
        $odb->query_td("insert into mess_status(mess_id, client_id) values('$mess_id1', $client_id);");
        return 1;
    }

    function getClientSaldo($id)
    {
        $odb = new odb;
        $slave = new slave;
        $saldo = 0;
        $r = $odb->query_td("select SUM,OSUM from DOC where SUBCONTO_ID = '$id' and KINDDOC_ID = '27' and OPL = '0' order by SDAY;");
        while (odbc_fetch_row($r)) {
            $sum = odbc_result($r, "SUM");
            $osum = odbc_result($r, "OSUM");
            if ($osum != "") {
                $osum = $slave->tomoney($sum) - $slave->tomoney($osum);
            }
            if ($osum == "") {
                $osum = $slave->tomoney($sum);
            }
            $saldo += $osum;
        }
        return $saldo;
    }

    function getSubContoType($id)
    {
        $odb = new odb;
        $type = 1;
        $r = $odb->query_td("select * from SUBCONTOTYPES where SUBCONTO_ID = '$id';");
        while (odbc_fetch_row($r)) {
            $type = odbc_result($r, "subcontotype_id");
        }
        return $type;
    }

    function checkClientLogout($id)
    {
        $odb = new odb;
        $logout = 0;
//Проверка Блокирования по таблице SUBCONTO_INOUT 
//		$r=$odb->query_td("select id from SUBCONTO_INOUT where SUBCONTO_ID = '$id' and ISON = '1' and SET_LOGOUT = '1';");
//Проверка Блокирования в lider по полю subconto.flag=16
        $r = $odb->query_lider("select id,(flag & 16) as flag from SubConto where id = '$id' and (flag & 16) = 16;");
        while (odbc_fetch_row($r)) {
            $lid = odbc_result($r, "id");
            $logout = 1;
//Снятие Блокирования по таблице SUBCONTO_INOUT 
//			$odb->query_td("delete from SUBCONTO_INOUT where ID = '$lid';"); 
//Снятие Блокирования в lider по полю subconto.flag=16
            $odb->query_lider("update SubConto set flag = flag & ~16 where id = '$lid';");
            session_start();
            session_unset($_SESSION["client"]);
            session_unset($_SESSION["email"]);
            setcookie("AvtoliderUser", "", time() - 3600);
            setcookie("AvtoliderUserSecure", "", time() - 3600);
//if ($_SERVER['REMOTE_ADDR']=="192.168.0.39") {print "select id from SUBCONTO_INOUT where SUBCONTO_ID = '$id' and ISON = '1' and SET_LOGOUT = '1'; $lid; update SUBCONTO_INOUT set ISON = '0', SET_LOGOUT = '0' where ID = '$lid';";}
        }
        return $logout;
    }

    function check_client($email, $pass)
    {
        $slave = new slave;
        $odb = new odb;
        $answer = "";
        $email = $slave->qq(strtolower($email));
        $pass = $slave->qq($pass);
        if ($pass != "" and $email != "") {
            setcookie("AvtoliderUser", "", time() - 3600);
            setcookie("AvtoliderUserSecure", "", time() - 3600);
            $r = $odb->query_td("select * from SUBCONTO where lower(EMAIL) = lower('$email') and PWD = '$pass' limit 1 offset 0;");
            while (odbc_fetch_row($r)) {
                session_start();
                $_SESSION["client_user"] = 0;
                $_SESSION["email"] = $email;
                $_SESSION["client"] = odbc_result($r, "ID");
                $_SESSION["client_group"] = $this->getSubContoType(odbc_result($r, "ID"));
                $answer = "ok";
                $data_to = time() + 259200;
                $key = $this->generateRandomString(64);
                setcookie("AvtoliderUser", $_SESSION["client"], $data_to);
                setcookie("AvtoliderUserSecure", $key, $data_to);
                $odb->query_td("insert into SUBCONTO_COOKIES(subconto_id, cookie, data_to) values('" . $_SESSION["client"] . "', '$key', '$data_to');");
//                list($saldo, $sDolg, $kredit, $days) = $this->getClientKredit($_SESSION["client"]);
                list ($nearData, $sDolg, $Dolg) = $this->getSubcontoNearDataSumNew($_SESSION["client"]);
                if ($sDolg == 0 or $sDolg == "") {
                    $answer = "ok";
                }
                if ($sDolg > 0) {
//                    $answer = "dolg";
                    $answer = "ok"; //так я Отключил переход в список документов - долгов уж очень он тормозит.
                }
            }
            if ($answer == "") {
                $r1 = $odb->query_td("select SUBCONTO_ID,NAME from SUBCONTO_USERS where lower(EMAIL) = lower('$email') and PWD = '$pass' and ISON = '1' limit 1 offset 0;");
                while (odbc_fetch_row($r1)) {
                    session_start();
                    $_SESSION["email"] = $email;
                    $_SESSION["client"] = odbc_result($r1, "SUBCONTO_ID");
                    $_SESSION["client_group"] = $this->getSubContoType(odbc_result($r1, "SUBCONTO_ID"));
                    $_SESSION["client_user"] = odbc_result($r1, "SUBCONTO_ID");
                    $n = $n1;
//                    list($saldo, $sDolg, $kredit, $days) = $this->getClientKredit($_SESSION["client"]);
                    list ($nearData, $sDolg, $Dolg) = $this->getSubcontoNearDataSumNew($_SESSION["client"]);
                    if ($sDolg == 0 or $sDolg == "") {
                        $answer = "ok";
                    }
                    if ($sDolg > 0) {
//                        $answer = "dolg";
                        $answer = "ok"; //так я Отключил переход в список документов - долгов уж очень он тормозит.
                    }
                    $data_to = time() + 259200;
                    $key = $this->generateRandomString(64);
                    setcookie("AvtoliderUser", $_SESSION["client"], $data_to);
                    setcookie("AvtoliderUserSecure", $key, $data_to);
                }
            }
            if ($answer == "") {
                session_start();
                session_unset($_SESSION["client"]);
                session_unset($_SESSION["client_user"]);
                session_unset($_SESSION["email"]);
                setcookie("AvtoliderUser", "", time() - 3600);
                setcookie("AvtoliderUserSecure", "", time() - 3600);
                $answer = "Неверные E - mail или пароль!";
            }
        }
        if ($pass == "" or $email == "") {
            $answer = "Не заполнены поля E - mail или пароль!";
        }
        return $answer;
    }

    function get_cookie_client_info($id)
    {
        $slave = new slave;
        $odb = new odb;
        if ($id != "") {
            $r = $odb->query_td("select * from SUBCONTO where id = '$id' limit 1 offset 0;");
            while (odbc_fetch_row($r)) {
                session_start();
                $_SESSION["client_user"] = 0;
                $_SESSION["email"] = $email;
                $_SESSION["client"] = odbc_result($r, "ID");
                $_SESSION["client_group"] = $this->getSubContoType(odbc_result($r, "ID"));
//                list($saldo, $sDolg, $kredit, $days) = $this->getClientKredit($_SESSION["client"]);
//                list ($nearData,$sDolg,$Dolg) = $this->getSubcontoNearDataSumNew($_SESSION["client"]);
            }
            if ($answer == "") {
                $r1 = $odb->query_td("select SUBCONTO_ID,NAME from SUBCONTO_USERS where SUBCONTO_ID = '$id' and ISON = '1' limit 1 offset 0;");
                while (odbc_fetch_row($r1)) {
                    session_start();
                    $_SESSION["email"] = $email;
                    $_SESSION["client"] = odbc_result($r1, "SUBCONTO_ID");
                    $_SESSION["client_group"] = $this->getSubContoType(odbc_result($r1, "SUBCONTO_ID"));
                    $_SESSION["client_user"] = odbc_result($r1, "SUBCONTO_ID");
                    $n = $n1;
//                    list($saldo, $sDolg, $kredit, $days) = $this->getClientKredit($_SESSION["client"]);
                    list ($nearData, $sDolg, $Dolg) = $this->getSubcontoNearDataSumNew($_SESSION["client"]);
                }
            }
        }
        return;
    }

    function check_cookie_client()
    {
        $slave = new slave;
        $odb = new odb;
        $client_id = "";
        $subcont_id = "";
        $data_to = "";
        //setcookie("AvtoliderUser", "", time()-3600);setcookie("AvtoliderUserSecure", "", time()-3600);
        $cookie_user = $_COOKIE["AvtoliderUser"];
        $cookie_key = $_COOKIE["AvtoliderUserSecure"];
        if (($cookie_user != "") and ($cookie_key != "")) {
            $is_logout = $this->checkClientLogout($cookie_user);
            if ($is_logout == 0) {
                $r = $odb->query_td("select * from subconto_cookies where subconto_id = '$cookie_user' and cookie = '$cookie_key';");
                while (odbc_fetch_row($r)) {
                    $data_to = odbc_result($r, "data_to");
                    $odb->query_td("delete from SUBCONTO_COOKIES where cookie = '$cookie_key' and subconto_id = '$cookie_user';");
                    if ($data_to < time()) {
                        $subconto_id = "";
                        setcookie("AvtoliderUser", "", time() - 3600);
                        setcookie("AvtoliderUserSecure", "", time() - 3600);
                    } else {
                        $client_id = $cookie_user;
                        $data_to = time() + 259200;
                        $key = $this->generateRandomString(64);
                        setcookie("AvtoliderUser", $client_id, $data_to);
                        setcookie("AvtoliderUserSecure", $key, $data_to);
                        $odb->query_td("insert into SUBCONTO_COOKIES(subconto_id, cookie, data_to) values('" . $client_id . "', '$key', '$data_to');");
                        $this->get_cookie_client_info($client_id);
                    }
                }
            }
        }
        return $client_id;
    }

    function outAcount()
    {
        session_start();
        session_unset($_SESSION["client"]);
        session_unset($_SESSION["email"]);
        setcookie("AvtoliderUser", "", time() - 3600);
        setcookie("AvtoliderUserSecure", "", time() - 3600);
        return "ok";
    }

    function out_Acount()
    {
        session_start();
        session_unset($_SESSION["client"]);
        session_unset($_SESSION["email"]);
        setcookie("AvtoliderUser", "", time() - 3600);
        setcookie("AvtoliderUserSecure", "", time() - 3600);
        return "ok";
    }

    function get_client()
    {
        session_start();
        $client_id = $_SESSION["client"];
        if ($client_id == "") {
            $client_id = $this->check_cookie_client();
        }
        if ($client_id != "") {
            $form = $this->show_client_form();
        }
        if ($client_id == "") {
            list($form, $forms) = $this->show_login_form();
        }
        return array($form, $forms);
    }

    function sendAcountInfo($email)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $answer = "";
        $email = strtolower($email);
        $r = $odb->query_td("select id,Name,pwd from SUBCONTO where email = '$email' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
            $Name = odbc_result($r, "Name");
            $pass = odbc_result($r, "pwd");
            $message_htm = RD . " / tpl / message_pass_forgot . htm";
            if (file_exists("$message_htm")) {
                $message = file_get_contents($message_htm);
            }
            $message = str_replace("{
        pass}", $pass, $message);
            $message = str_replace("{
        email}", $email, $message);
            $message = str_replace("{
        name}", $Name, $message);
            $message = str_replace("{
        client_id}", $id, $message);
            $message = str_replace("{
        flink}", $this->getFastSubcontoAuth($id), $message);
            $message = str_replace("{
        remip}", $_SERVER['REMOTE_ADDR'], $message);

            include_once RD . " / mail / sendmail .class.php";
            $Mail = new sendmail();
            $Mail->mail_to = "$Name < $email>";
            $Mail->subject = "Password recovery to zakaz . avtolider - ua . com";
            $Mail->message = $message;
            $Mail->from_name = "Avtolider";
            $Mail->SendFromMail = "no - reply@avtolider - ua . com";
            $Mail->Send();

            $answer = "ok";
        }
        if ($answer == "") {
            $answer = "Введенный адрес электронной почты не существует в системе";
        }
        return $answer;
    }

    function showStateForm($id, $pls)
    {
        $odb = new odb;
        if ($pls == "1") {
            $name = "RegState_form";
            $function = "showCityForm(this[this . selectedIndex] . value);";
        }
        if ($pls == "2") {
            $name = "state_form";
            $function = "showCityOrderForm(this[this . selectedIndex] . value);";
        }
        $form = " <select id = '$name' name = '$name' onchange = '$function' style = 'width:400px;' > 
                   <option value = '#' > --- </option> ";
        $r = $odb->query_td("select * from REGION_NEW order by id asc;");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "ID");
            $caption = odbc_result($r, "NAME");
            $form .= " <option value = '$id' > $caption</option> ";
        }
        $form .= "</select> ";
        return $form;
    }

    function showCityForm($state)
    {
        $odb = new odb;
        $form = "<select id = 'RegCity_form' name = 'RegCity_form' onchange = 'checkNewCity(this[this.selectedIndex].value);' style = 'width:400px;' > ";
        $r = $odb->query_td("select * from CITY_NEW where REGION_ID = '$state' order by NAME,ID asc;");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "ID");
            $caption = odbc_result($r, "NAME");
            $form .= " <option value = '$id' > $caption</option> ";
        }
        $form .= "<option value = '0' > --Новый населенный пункт--</option>";
        $form .= "</select> ";
        return $form;
    }

    function showCityOrderForm($state)
    {
        $odb = new odb;
        $form = "<select id = 'city_form' name = 'city_form' onchange = 'checkNewOrderCity(this[this.selectedIndex].value);' style = 'width:400px;' > ";
        $r = $odb->query_td("select * from CITY_NEW where REGION_ID = '$state' order by NAME,ID asc;");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "ID");
            $caption = odbc_result($r, "NAME");
            $form .= " <option value = '$id' > $caption</option> ";
        }
        $form .= "<option value = '0' > --Новый населенный пункт--</option> ";
        $form .= "</select> ";
        return $form;
    }

    function showActivityForm($sid)
    {
        $odb = new odb;
        $form = "<select id = 'RegActivity_form' name = 'RegActivity_form' style = 'width:400px;' > ";
        $r = $odb->query_td("select * from SUBCONTO_ACTIVITY order by id asc;");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
            $caption = odbc_result($r, "NAME");
            if ($id == $sid) {
                $form .= " <option value = '$id' selected = 'selected' > $caption</option > ";
            }
            if ($id != $sid) {
                $form .= "<option value = '$id' > $caption</option > ";
            }
        }
        $form .= "</select> ";
        return $form;
    }

    function saveClientRegistration($recaptcha_challenge_field, $recaptcha_response_field, $email, $name, $state, $city, $new_city, $address, $phone, $activity)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        require_once(RD . "/recaptchalib.php");
        $privatekey = "6LcepdkSAAAAABAOFjbEHh7rTcr1OqYqB7srixb - ";
        $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $recaptcha_challenge_field, $recaptcha_response_field);
        $res = 1;
//        if (!$resp->is_valid) {
        if ($res = 0) {
            // What happens when the CAPTCHA was entered incorrectly
            $err = 1;
            $answer = "Сработала защита от спама";
        } else {
            // Your code here to handle a successful verification

            $pass = $slave->qq($pass);
            $email = $slave->qq(strtolower($email));
            $name = $slave->qq($name);
            $city = $slave->qq($city);
            $new_city = $slave->qq($new_city);
            $address = $slave->qq($address);
            $phone = $slave->qq($phone);
            if ($new_city != "") {
                $city = $this->add_new_city($state, $new_city);
            }
            if ($email == "" or $name == "" or $city == "" or $address == "" or $phone == "") {
                $err = 1;
                $answer = "Не заполнены обязательные поля!!!";
            }
            if ($email != "" and $name != "" and $city != "" and $address != "" and $phone != "") {
                $remip = $_SERVER['REMOTE_ADDR'];
                $r = $odb->query_td("SELECT subconto.id FROM SUBCONTO inner join SUBCONTO_USERS on (subconto.id = subconto_users.SubConto_id) where subconto.email = '$email' or subconto_users.email = '$email' limit 1 offset 0;");
                $n = $odb->num_rows($r);
                if ($n > 0) {
                    $err = 1;
                    $answer = "Указаный вами EMAIL уже зарегистрирован в нашем интернет - магазине!!!";
                }
                if ($n == 0) {

                    include(RD . '/lib/pwd.gen.php');
                    $pwgen = new PWGen();
                    $pass = $pwgen->generate();
                    $date = date("Y - m - d");
                    $r = $odb->query_lider("SELECT max(id) as mid FROM subconto;");
                    odbc_fetch_row($r);
                    $mid = odbc_result($r, "mid") + 1;
                    $r = $odb->query_lider("SELECT max(code) as code FROM subconto;");
                    odbc_fetch_row($r);
                    $code = odbc_result($r, "code") + 1;
                    $state_name = $this->get_table_caption("region_new", $state);
                    $city_name = $this->get_table_caption("city_new", $city);
                    $odb->query_lider("INSERT INTO subconto(id, code, Name, email, pwd, country_id, region_id, city_id, Adres, phone, Remark, base_id, dateAdd, flag, place_id) VALUES('$mid', '$code', '$name', '$email', '$pass', '1', '100', '100', '$address', '$phone', '" . $this->get_table_caption("subconto_activity", $activity) . ", $state_name, $city_name', '1', '$date', '128', 23);"); //kuz 25-09-2014 // kuz 4-05-2015 flag=128 Это отметка онлайн(128)
                    $odb->query_lider("INSERT INTO subcontotypes(subconto_id, subcontotype_id) VALUES('$mid', '1');");
                    $odb->query_lider("INSERT INTO subcontotypes(subconto_id, subcontotype_id) VALUES('$mid', '13');");

                    $message_htm = RD . " / tpl / message_registration . htm";
                    if (file_exists("$message_htm")) {
                        $message = file_get_contents($message_htm);
                    }
                    $message = str_replace("{
        pass}", $pass, $message);
                    $message = str_replace("{
        email}", $email, $message);
                    $message = str_replace("{
        client_name}", $name, $message);
                    $message = str_replace("{
        state}", $this->get_table_caption("REGION_NEW", $state), $message);
                    $message = str_replace("{
        city}", $this->get_table_caption("CITY_NEW", $city), $message);
                    $message = str_replace("{
        address}", $address, $message);
                    $message = str_replace("{
        phone}", $phone, $message);
                    $message = str_replace("{
        activity}", $this->get_table_caption("SUBCONTO_ACTIVITY", $activity), $message);
                    $message = str_replace("{
        remip}", $remip, $message);
                    $message = str_replace("{
        flink}", $this->getFastSubcontoAuth($mid), $message);
                    $message = str_replace("{
        client_id}", $mid, $message);

                    include_once RD . "/mail/sendmail.class.php";
                    $Mail = new sendmail();
                    $Mail->mail_to = "$name < $email>";
                    $Mail->subject = "Zakaz . avtolider - ua . com: Client registration";
                    $Mail->message = $message;
                    $Mail->from_name = "Avtolider";
                    $Mail->SendFromMail = "no - reply@avtolider - ua . com";
                    $Mail->Send();
                    $err = 0;
                    $answer = "Вы успешно зарегистрировались";
                }
            }
        }
        return array($err, $answer);
    }

    function create_noreg_client($activity, $name, $email, $phone, $state, $city, $new_city, $address_sent)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $email = strtolower($email);
        if ($new_city != "") {
            $city = $this->add_new_city($state, $new_city);
        }
        include_once(RD . '/lib/pwd.gen.php');
        $pwgen = new PWGen();
        $pass = $pwgen->generate();
        $date = date("Y - m - d");
        $r = $odb->query_lider("SELECT max(id) as mid FROM subconto;");
        odbc_fetch_row($r);
        $mid = odbc_result($r, "mid") + 1;
        $r = $odb->query_lider("SELECT max(code) as code FROM subconto;");
        odbc_fetch_row($r);
        $code = odbc_result($r, "code") + 1;
        $state_name = $this->get_table_caption("region_new", $state);
        $city_name = $this->get_table_caption("city_new", $city);
        $odb->query_lider("INSERT INTO subconto(id, code, Name, email, pwd, country_id, region_id, city_id, Adres, phone, Remark, base_id, dateAdd, flag, place_id) VALUES('$mid', '$code', '$name', '$email', '$pass', '1', '100', '100', '$address', '$phone', '" . $this->get_table_caption("subconto_activity", $activity) . ", $state_name, $city_name', '1', '$date', '128', 23);");
        $odb->query_lider("INSERT INTO subcontotypes(subconto_id, subcontotype_id) VALUES('$mid', '1');");
        $odb->query_lider("INSERT INTO subcontotypes(subconto_id, subcontotype_id) VALUES('$mid', '13');");


        $message_htm = RD . " / tpl / message_registration . htm";
        if (file_exists("$message_htm")) {
            $message = file_get_contents($message_htm);
        }
        $message = str_replace("{
        pass}", $pass, $message);
        $message = str_replace("{
        email}", $email, $message);
        $message = str_replace("{
        client_name}", $name, $message);
        $message = str_replace("{
        state}", $this->get_table_caption("REGION_NEW", $state), $message);
        $message = str_replace("{
        city}", $this->get_table_caption("CITY_NEW", $city), $message);
        $message = str_replace("{
        address}", $address, $message);
        $message = str_replace("{
        phone}", $phone, $message);
        $message = str_replace("{
        activity}", $this->get_table_caption("SUBCONTO_ACTIVITY", $activity), $message);
        $message = str_replace("{
        remip}", $_SERVER['REMOTE_ADDR'], $message);
        $message = str_replace("{
        flink}", $this->getFastSubcontoAuth($mid), $message);
        $message = str_replace("{
        client_id}", $mid, $message);

        include_once RD . " / mail / sendmail .class.php";
        $Mail = new sendmail();
        $Mail->mail_to = "$name < $email>";
        $Mail->subject = "Zakaz . avtolider - ua . com: Client registration";
        $Mail->message = $message;
        $Mail->from_name = "Avtolider";
        $Mail->SendFromMail = "no - reply@avtolider - ua . com";
        $Mail->Send();
        return $mid;
    }

    function add_new_city($state, $caption)
    {
        $odb = new odb;
        if ($state != "" and $state != 0 and $caption != "") {
            $r = $odb->query_td("SELECT max(id) as mid FROM CITY_NEW;");
            odbc_fetch_row($r);
            $mid = odbc_result($r, "mid") + 1;
            $odb->query_td("insert into CITY_NEW (ID,NAME,REGION_ID) values('$mid', '$caption', '$state');");
            return $mid;
        }
    }

    function get_client_status()
    {
        $client_id = $_SESSION["client"];
        if ($client == "") {
            return "1";
        }
        if ($client != "") {
            return "2";
        }
    }

    function get_client_name($client_id)
    {
        $odb = new odb;
        $name = "";
        if ($client_id != 0) {
            $r = $odb->query_td("select Name from subconto where id = '$client_id' limit 1 offset 0;");
            while (odbc_fetch_row($r)) {
                $name = odbc_result($r, "Name");
            }
        }
//        $name = substr($name,0,40);
        return $name;
    }

    function get_client_user_name($client_id)
    {
        $odb = new odb;
        $name = "Гость";
        if ($client_id != 0) {
            $r = $odb->query_td("select Name from subconto_users where id = '$client_id' limit 1 offset 0;");
            while (odbc_fetch_row($r)) {
                $name = odbc_result($r, "Name");
            }
        }
        return $name;
    }

    function get_client_login($client_id)
    {
        $odb = new odb;
        $email = "Anonymouse";
        $r = $odb->query_td("select email from subconto where id = '$client_id' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $email = odbc_result($r, "email");
        }
        return $email;
    }

    function checkClientEmail($email)
    {
        $odb = new odb;
        $email = strtolower($email);
        $r = $odb->query_td("select email from subconto where email = '$email' limit 1 offset 0;");
        $n = $odb->num_rows($r);
        if ($n > 0) {
            return array(1, " <span style = 'color:red;'> Email принадлежит другому пользователю </span>");
        }
        if ($n == 0) {
//            $r1 = $odb->query_td("select email from lider_subconto_users where email = '$email' limit 1 offset 0;");
//            $n1 = $odb->num_rows($r1);
            if ($n > 0) {
                return array(1, " <span style = 'color:red;'> Email принадлежит другому пользователю </span>");
            }
            if ($n == 0) {
                return array(0, "<span style = 'color:green;'> Доступен для регистрации </span>");
            }
        }
    }

    function get_order_form_data($client_id)
    {
        $odb = new odb;
        $r = $odb->query_td("select code,Name,email,phone,Adres from subconto where id = '$client_id' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $code = odbc_result($r, "code");
            $name = odbc_result($r, "Name");
            $email = odbc_result($r, "email");
            $phone = odbc_result($r, "phone");
            $address = odbc_result($r, "Adres");
            list($cont_person, $phone_person, $address_person, $typepay, $carrier, $remark) = $this->getAdresDeliv($client_id);
            return array($code, $name, $email, $phone, $address, $cont_person, $phone_person, $address_person, $typepay, $carrier, $remark);
        }
        if ($n == 0) {
            return array("", "", "", "", "", "", "");
        }
    }

    function getAdresDeliv($client_id)
    {
        $odb = new odb;
        //Выбираем активный (первый) адрес доставки в списке адресов доставки по клиенту
        $r = $odb->query_td("select * from adresdeliv where subconto_id = '$client_id' and n = '1' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $contperson = odbc_result($r, "contperson");
            $phone = odbc_result($r, "phone");
            $address = odbc_result($r, "adres");
            $typepay = odbc_result($r, "typepay_id");
            $carrier = odbc_result($r, "carrier_id");
            $remark = odbc_result($r, "remark");
            return array($contperson, $phone, $address, $typepay, $carrier, $remark);
        }
        if ($n == 0) {
            return array("", "", "", "", "");
        }
    }

    function get_table_caption($tname, $id)
    {
        $odb = new odb;
        if ($file == 0) {
            $file = 1;
        }
        $name = "";
        $r = $odb->query_td("select NAME from $tname where id = '$id' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $name = odbc_result($r, "NAME");
        }
        return $name;
    }

//Эта функция определяет ближайшую дату, сумму и общий долг и записывает их в сессию.
    function getSubcontoNearDataSumNew($client)
    {
        if (isset($_REQUEST[session_name()])) session_start();
//        session_start();
        $needUpdate = 0;
//        устанавливаем период обновления долгов для сессии в секундах
//        $p = 10; //1 * 15 * 60;
//        время существования куки для update
        $data_to = time() + 15 * 60;//259200;
//        если кука NeedUpdate не существует - то обновить данные заново
        if (empty($_SESSION["Data_to"]) || ($_SESSION["Data_to"] < time())) {
            $_SESSION["Data_to"] = $data_to;
            $needUpdate = 1;
            $_SESSION["needUpdate"] = $needUpdate;
            $_SESSION["nearData"] = '';
            $_SESSION["nearDolg"] = 0;
            $_SESSION["Dolg"] = 0;
        } else {
            $_SESSION["needUpdate"] = $needUpdate;
        };

//        if (empty($_COOKIE["needUpdate"])) {
//            $needUpdate = 1;
//			setcookie("needUpdate", $needUpdate, $data_to);
//        };
//отключаю  - пока в PG нет функций GetDolg и GetDolgDate
//        $needUpdate = 1;
        if (($needUpdate == 1)) {
            $odb = new odb;
            $slave = new slave;
            $nearData = "";
            $Dolg = 0;
            $nearDolg = 0;
            $r = $odb->query_td("
                        SELECT s1.sday, s1.cDT,
                            CASE WHEN(s1.sday < s1.cDT) 
                            THEN GetDolg(s1.id, DATE(s1.cDT) ) ELSE 
                            GetDolg(s1.id, DATE(s1.ssday) ) END AS os,
                            GetDolg(s1.id, DATE(s1.scDT) ) as dolg,
                            s1.K_Code
                        FROM(select K.id,
                                date(now())+1 AS cDT,
                                date(now()) + interval '1 year' AS scDT,
                                GetDolgDate(K . id) AS sday,
                                date(GetDolgDate(K.id)) + interval '1 day' AS ssday,
                                k.code AS K_Code
                            FROM klient K
                            WHERE K.id = $client) as s1	
              		  ");
//SELECT s1.sday, s1.cDT,
//                                    CASE WHEN(s1.sday < s1.cDT) THEN GetDolg(s1.id, s1.cDT) ELSE GetDolg(s1.id, s1.ssday) END AS os,
//                                    GetDolg(s1.id, s1.scDT) as dolg,
//                                    s1.K_Code
//                                 FROM(select K.id,
//                                     date(CURRENT_DATE + interval '1 day') AS cDT,
//                                     date(CURRENT_DATE + interval '1 year' ) AS scDT,
//                                     GetDolgDate(K . id) AS sday,
//                                     date (GetDolgDate(K . id) + interval '1 day') AS ssday,
//                                     k.code AS K_Code
//                                     FROM klient K
//                                      WHERE K.id = '$client') as s1
//              		  \");
            while (odbc_fetch_row($r)) {
                //Дата ближайшего платежа
                $nearData = odbc_result($r, sday);
                //Сумма ближайшей оплаты по дате, если просрочка - то сумма просрочки на сегодня
                $nearDolg = odbc_result($r, os);
                //Полная задолженность по клиенту
                $Dolg = odbc_result($r, dolg);
                $kCode = odbc_result($r, K_Code);
            }
            $_SESSION["nearData"] = $nearData;
//            setcookie("nearData", $nearData, $data_to);
            $_SESSION["nearDolg"] = $nearDolg;
//            setcookie("nearDolg", $nearDolg, $data_to);
            $_SESSION["Dolg"] = $Dolg;
//            setcookie("Dolg", $Dolg, $data_to);
            $_SESSION["kCode"] = $kCode;
//            setcookie("kCode", $kCode, $data_to);
            $_SESSION["LastUpdateTime"] = time();
//            setcookie("LastUpdateTime", time(), $data_to);
//            echo "дата".$nearData." сума б ".$nearDolg."сума о".$Dolg;
        } else {
            $nearData = $_SESSION["nearData"];
//            $nearData = $_COOKIE["nearData"];
            $nearDolg = $_SESSION["nearDolg"];
//            $nearDolg = $_COOKIE["nearDolg"];
            $Dolg = $_SESSION["Dolg"];
//            $Dolg = $_COOKIE["Dolg"];
        }
//        $_SESSION["NeedUpdate"] = $needUpdate;
        return array($nearData, $nearDolg, $Dolg);
    }

//Методы следующие за этой меткой предлагаются к исключению, они должны быть заменены getSubcontoNearDataSumNew
//           !!!ДИНОЗАВРЫ!!!!!

    function getClientKredit($id)
    {
//        Отключаю функцию за ненадобностью, нужно  использовать новую getSubcontoNearDataSumNew
        return;
        $odb = new odb;
        $r = $odb->query_td("
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
                             case when D.sDay < date(now()) and DP.Property_id=3
                                 then D.sum-nvl(D.osum,0)
                                when DP.Property_id is null then  -D.osum end
                             end) as numeric(12,2)) as sDolg,
                   cast(sum(case when nvl(D.val_id,980)=978 then
                             case when D.sDay <= date(now()) and DP.Property_id=3
                               then D.vsum-nvl(D.vosum,0)
                             when DP.Property_id is null then -D.vosum end
                            end) as numeric(12,2)) as sDolgE
          from DocOpen O
              left outer join Doc D on D.id=O.doc_id
              left outer join KindDocProperty DP on D.KindDoc_id=DP.KindDoc_id and DP.Property_id=3
        where O.SubConto_id='$id'
	    ) S
    	where S.id='$id';");

        odbc_fetch_row($r);
        $kredit = odbc_result($r, "sumkr");
        $days = odbc_result($r, "tmkr");
        $saldo = odbc_result($r, "sd");
        $sDolg = odbc_result($r, "sDolg");
        return array($saldo, $sDolg, $kredit, $days);
    }


    function getSubcontoNearDataSum($client)
    {
//        Отключаю функцию за ненадобностью, нужно  использовать новую getSubcontoNearDataSumNew
        return;
        $odb = new odb;
        $slave = new slave;
        $r = $odb->query_td("
		select *
	     from (select KD.Name \"docName\",
	    	D.Num \"num\",
    		to_char(D.Day,'dd-mm-yyyy') \"day\",
			case when D.sDay < date(now()) then 'style=\"color:red\"' else '' end as \"clr\",
			case when D.kinddoc_id not in (3,27,20,28) then 
				nvl(to_char(D.sDay,'dd-mm-yyyy'),'') 
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
		 order by \"sday\",\"num\";");
        $nearData = "";
        $nearSumm = 0;
        $k = 0;
        $i = 0;
        $sDolgN = 0;
        while (odbc_fetch_row($r)) {
            $k += 1;
            $i += 1;
            $day = odbc_result($r, "day");
            $kinddoc_id = odbc_result($r, "kinddoc_id");
            $sday = odbc_result($r, "sday");
            $os = $slave->tomoney(odbc_result($r, "os"));
            if ((date("Ymd", strtotime($sday)) <= date("Ymd", mktime(0, 0, 0, date("m"), date("d") + 3, date("Y"))))
//			and (($kinddoc_id==27)||($kinddoc_id==3))
//			and ($os>0)
            ) {
                $nearSumm += $os;
                $nearData = date("d-m-Y");
            }
            if ((date("Ymd", strtotime($sday)) <= date("Ymd", mktime(0, 0, 0, date("m"), date("d"), date("Y"))))
//			and ($os>0)
            ) {
                $sDolgN += $os;
            }
        }
        $sDolgN = round($sDolgN, 2);
        if ($sDolgN < 0) {
            $sDolgN = 0;
        }
        $nearSumm = $slave->int_to_money($nearSumm);
        return array($nearData, $nearSumm, $sDolgN);
    }
}

?>