<?php

class shop
{
    public $remips = array('78.152.169.139', '192.168.0.241', '192.168.0.240', '192.168.0.23', '192.168.0.22', '192.168.0.39', '192.168.0.41', '192.168.0.40', '192.168.0.177', '192.168.0.175');

    function showOrderComment($order_id)
    {
        $form_htm = RD . "/tpl/order_comment_form.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        list($doc_num, $d, $d, $doc_more_client) = $this->getOrderHeader($order_id);


        $form = str_replace("{more}", $doc_more_client, $form);
        $form = str_replace("{doc_num}", $doc_num, $form);
        $form = str_replace("{order_id}", $order_id, $form);
        return $form;
    }

    function saveOrderComment($order_id, $more)
    {
        $odb = new odb;
        session_start();
        $slave = new slave;
        $more = $slave->qq($more);
        $odb->query_td("update orders set more_client='$more' where id='$order_id';");
        $answer = "ok";
        return $answer;
    }

    function showActionInfoByItem($item_id)
    {
//        session_start();
//        $client = $_SESSION["client"];
        if (isset($_REQUEST[session_name()])) session_start();
        if (empty($_SESSION["client"])) {
            $client = 0;
        } else {
            $client = $_SESSION["client"];
        }
        $er = 1;
        $odb = new odb;
        $list = "";
        $k = 0;
        include_once RD . '/lib/catalogue_class.php';
        $cat = new catalogue;
        $r = $odb->query_td("SELECT a.id,a.name,a.url FROM ACTIONITEM ai inner join action a on(a.id=ai.action_id) where ai.item_id='$item_id' and a.status='1';");
        while (odbc_fetch_row($r)) {
            $k += 1;
            if ($k == 1) {
                $form_htm = RD . "/tpl/busket_action_info.htm";
                if (file_exists("$form_htm")) {
                    $form = file_get_contents($form_htm);
                }
            }
            $action_id = odbc_result($r, "id");
            $action_name = odbc_result($r, "name");
            $action_url = odbc_result($r, "url");
            $bonus = $cat->getActionBonusSumm($action_id, $client);
            if ($bonus > 0) {
                $bonus = "Бонусов накоплено: <strong>$bonus грн</strong>";
            }
            $list .= "<tr><td><a href='#ActionInfo=$action_id' onclick='showActionInfo(\"$action_url\")'>$action_name</a></td><td><a href='#ActionInfo=$action_id' onclick='showActionInfo(\"$action_url\")'>$bonus</a></td></tr>";
        }
        $form = str_replace("{action_list}", $list, $form);
        return $form;
    }

    function showActionInfo($url)
    {
        $db = new db;
        $slave = new slave;
        $s = explode("=", $url);
        $type = $s[0];
        $id = $s[1];
        if ($type == "action_id") {
            $form_htm = RD . "/tpl/news_desc1.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
            $r = $db->query_lider("select * from actions where id='$id';");
            $n = $db->num_rows($r);
            if ($n > 0) {
                $id = $db->result($r, 0, "id");
                $caption = $db->result($r, 0, "caption_ru");
                $desc = $db->result($r, 0, "desc_ru");
            }
            $form = str_replace("{caption}", $caption, $form);
            $form = str_replace("{desc}", $desc, $form);
            $form = str_replace("{author}", $author, $form);
            $form = str_replace("{data}", $slave->data_word($data), $form);
            $form = str_replace("../uploads/images/", "/uploads/images/", $form);
            $form = str_replace("\"/uploads/images/", "\"http://www.avtolider-ua.com/uploads/images/", $form);
            $form = str_replace("'/uploads/images/", "'http://www.avtolider-ua.com/uploads/images/", $form);
            $form = str_replace("../uploads/files/", "/uploads/files/", $form);
            $form = str_replace("/uploads/files/", "http://www.avtolider-ua.com/uploads/files/", $form);
        }
        if ($type == "news_id") {
            $dep = "news";
            list($dep_up, $dep_cur) = $slave->get_file_deps($dep);
            $form_htm = RD . "/tpl/news_desc1.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
            $r = $db->query_lider("select * from news where id='$id';");
            $n = $db->num_rows($r);
            if ($n > 0) {
                $id = $db->result($r, 0, "id");
                $caption = $db->result($r, 0, "caption_ru");
                $desc = $db->result($r, 0, "desc_ru");
                $data = $db->result($r, 0, "data");
                $author = $db->result($r, 0, "author_ru");
            }
            $form = str_replace("{caption}", $caption, $form);
            $form = str_replace("{desc}", $desc, $form);
            $form = str_replace("{author}", $author, $form);
            $form = str_replace("{data}", $slave->data_word($data), $form);
            $form = str_replace("../uploads/images/", "/uploads/images/", $form);
            $form = str_replace("\"/uploads/images/", "\"http://www.avtolider-ua.com/uploads/images/", $form);
            $form = str_replace("'/uploads/images/", "'http://www.avtolider-ua.com/uploads/images/", $form);
            $form = str_replace("../uploads/files/", "/uploads/files/", $form);
            $form = str_replace("/uploads/files/", "http://www.avtolider-ua.com/uploads/files/", $form);
        }
        return $form;
    }

    function show_busket_maslo_form($category, $model)
    {
        include_once RD . '/lib/catalogue_class.php';
        session_start();
        $er = 1;
        $odb = new odb;
        $slave = new slave;
        $cat = new catalogue;
        if ($_SESSION["client"] == "") {
            $busket_form_htm = RD . "/tpl/need_auth_maslo.htm";
            if (file_exists("$busket_form_htm")) {
                $busket_form = file_get_contents($busket_form_htm);
            }
        }
        if ($_SESSION["client"] != "") {
            $busket_form_htm = RD . "/tpl/busket_maslo_form.htm";
            if (file_exists("$busket_form_htm")) {
                $busket_form = file_get_contents($busket_form_htm);
            }
            list($code, $name, $price, $sklad, $image) = $cat->getItemInfo($model);
            $kol = $this->getOrderModelKol('', $model);
            if ($kol == 0) {
                $kol = 1;
            }
            $summ = $kol * $price;
            $busket_form = str_replace("{model}", $model, $busket_form);
            $busket_form = str_replace("{model_price}", $price, $busket_form);
            $busket_form = str_replace("{model_kol}", $kol, $busket_form);
            $busket_form = str_replace("{summ}", $summ, $busket_form);
            $busket_form = str_replace("{code}", $code, $busket_form);
            $busket_form = str_replace("{caption}", wordwrap($name, 45, '&shy;', true), $busket_form);
            $busket_form = str_replace("{price}", $price, $busket_form);
            $busket_form = str_replace("{image}", $image, $busket_form);
            $busket_form = str_replace("{sklad}", $sklad, $busket_form);
            $busket_form = str_replace("{cash}", "грн", $busket_form);
            $busket_form = str_replace("{orders_list}", $this->show_orders_active_list(0), $busket_form);
            if ($_SESSION["client"] == "") {
                $busket_form = str_replace("{hidden}", " style='visibility:hidden;'", $busket_form);
            }
            if ($_SESSION["client"] != "") {
                $busket_form = str_replace("{hidden}", "", $busket_form);
            }
            $busket_form = str_replace("{action_info}", $this->showActionInfoByItem($model), $busket_form);
            $busket_form = str_replace("{cross_maslo}", $cat->showMasloCrossBusket($model, $category), $busket_form);
        }
        return $busket_form;
    }

    function show_busket_form($model)
    {
        include_once RD . '/lib/catalogue_class.php';
        session_start();
        $er = 1;
        $odb = new odb;
        $slave = new slave;
        $cat = new catalogue;
        $busket_form_htm = RD . "/tpl/busket_form.htm";
        if (file_exists("$busket_form_htm")) {
            $busket_form = file_get_contents($busket_form_htm);
        }
        list($code, $name, $price, $sklad, $image) = $cat->getItemInfo($model);
        $kol = $this->getOrderModelKol('', $model);
        if ($kol == 0) {
            $kol = 1;
        }
        $summ = $kol * $price;
        $busket_form = str_replace("{model}", $model, $busket_form);
        $busket_form = str_replace("{model_price}", $price, $busket_form);
        $busket_form = str_replace("{model_kol}", $kol, $busket_form);
        $busket_form = str_replace("{summ}", $summ, $busket_form);
        $busket_form = str_replace("{code}", $code, $busket_form);
        $busket_form = str_replace("{caption}", wordwrap($name, 45, '&shy;', true), $busket_form);
        $busket_form = str_replace("{price}", $price, $busket_form);
        $busket_form = str_replace("{image}", $image, $busket_form);
        $busket_form = str_replace("{sklad}", $sklad, $busket_form);
        $busket_form = str_replace("{cash}", "грн", $busket_form);
        $busket_form = str_replace("{orders_list}", $this->show_orders_active_list(0), $busket_form);
        if ($_SESSION["client"] == "") {
            $busket_form = str_replace("{hidden}", " style='visibility:hidden;'", $busket_form);
        }
        if ($_SESSION["client"] != "") {
            $busket_form = str_replace("{hidden}", "", $busket_form);
        }
        $busket_form = str_replace("{action_info}", $this->showActionInfoByItem($model), $busket_form);
        return $busket_form;
    }

    function getOrderModelKol($order_id, $item_id)
    {
        $odb = new odb;
        $slave = new slave;
        if ($order_id == "") {
            $order_id = $this->getOrderActiveId();
        }
        $r = $odb->query_td("select quant from orders_str where order_id='$order_id' and item_id='$item_id' limit 1;");
        $kol = 0;
        while (odbc_fetch_row($r)) {
            $kol = $slave->tomoney(odbc_result($r, "quant"));
        }
        return $kol;
    }

    function PlusOneActiveOrder()
    {
        $odb = new odb;
        $slave = new slave;
//        session_start();
//        $client = $_SESSION["client"];

        if (isset($_REQUEST[session_name()])) session_start();
        if (empty($_SESSION["client"])) {
            $client = 0;
            $client_user = 0;
        } else {
            $client = $_SESSION["client"];
            $client_user = $_SESSION["client_user"];
        }

        if ($client == "") {
            $session = session_id();
        }

        $odb->query_lider("create variable @last_id integer ");
        $odb->query_lider("insert into Local(user_id) values(-1);");
        $odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
        $odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
        $odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY'; ");
        $odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");
        $r = $odb->query_lider("call insertdoc(12);");
        odbc_fetch_row($r);
        $doc_id = odbc_result($r, "id");
        $doc_num = odbc_result($r, "num");
        if ($doc_id == "" or $doc_num == "") {
            $this->PlusOneActiveOrder();
        }
        if ($doc_id != "" && $doc_num != "") {
            $odb->query_lider("insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_id','0',now(),'-1','18');");
            $odb->query_lider("update doc set opl=2 where id='$doc_id';");
            $r1 = $odb->query_td("select max(id) as mid from orders;");
            odbc_fetch_row($r1);
            $id = odbc_result($r1, "mid") + 1;
            $date = date("Y-m-d");
            $time = date("H:i:s");
            if ($client == "") {
                $client = 0;
            }
            if ($client_user == "") {
                $client_user = 0;
            }
            $odb->query_td("insert into orders (id,session_id,client,union_client,author,author_user,author_send,data,times,status,doc_id,doc_num) values ('$id','$session',$client,0,$client,$client_user,$client,'$date','$time','12','$doc_id','$doc_num');");
            $answer = "ok";
        }
        return $id;
    }

    function getOrderActiveId()
    {
        $odb = new odb;
        $slave = new slave;
//        session_start();
//        $client = $_SESSION["client"];

        if (isset($_REQUEST[session_name()])) session_start();
        if (empty($_SESSION["client"])) {
            $client = "";
        } else {
            $client = $_SESSION["client"];
        }

        $session = session_id();

        if ($client != "") {
            $where = " or client='$client' ";
        }
        $r = $odb->query_td("select id from orders where (session_id='$session' $where) and status='12' order by id asc limit 1;");
        $id = 0;
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
        }
        return $id;
    }

    function show_orders_active_list($st = 1)
    {
        $odb = new odb;
        $slave = new slave;
        session_start();
        $client = $_SESSION["client"];
        $client_user = $_SESSION["client_user"];
        $session = session_id();
        if ($client != "") {
            $where = " or client='$client' ";
        }
        $list = "<select id='OrderActiveId' class='OrderActiveId'>";
        $query = "select id,doc_id,doc_num from orders where (session_id='$session' $where) and status='12' order by id asc limit 3;";
        $r = $odb->query_td($query);
        $n = $odb->num_rows($r);
        if ($n == 0) {
            $odb->query_lider("create variable @last_id integer ");
            $odb->query_lider("insert into Local(user_id) values(-1);");
            $odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
            $odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
            $odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY'; ");
            $odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");
            $r = $odb->query_lider("call insertdoc(12);");
            odbc_fetch_row($r);
            $doc_id = odbc_result($r, "id");
            $doc_num = odbc_result($r, "num");
            if ($doc_id == "" or $doc_num == "") {
                $this->show_orders_active_list($st);
            }
            if ($doc_id != "" && $doc_num != "") {
                $odb->query_lider("insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_id','0',now(),'-1','18');");
                $odb->query_lider("update doc set opl=2 where id='$doc_id';");
//                $r1 = $odb->query_td("select max(id) as mid from orders;");
//                odbc_fetch_row($r1);
//                $id = odbc_result($r1, "mid") + 1;
                $date = date("Y-m-d");
                $time = date("H:i:s");
                if ($client == "") {
                    $client = 0;
                }
                if ($client_user == "") {
                    $client_user = 0;
                }
//                $odb->query_td("insert into orders (id,session_id,client,union_client,author,author_user,author_send,data,times,status,doc_id,doc_num) values ('$id','$session',$client,0,$client,$client_user,$client,'$date','$time','12','$doc_id','$doc_num');");
                $odb->query_td("insert into orders (id,session_id,client,union_client,author,author_user,author_send,data,times,status,doc_id,doc_num) 
                                  values ((select max(id)+1 from orders),'$session',$client,0,$client,$client_user,$client,'$date','$time','12','$doc_id','$doc_num');");
                $list .= "<option value='$id'>$doc_num</option>";
            }
        }
        if ($n > 0) {
            $i = 0;
            $r = $odb->query_td($query);
            while (odbc_fetch_row($r)) {
                $selected = "";
                $i++;
                $id = odbc_result($r, "id");
                if ($st == 1 and $i == $n) {
                    $selected = "selected=\"selected\"";
                }
                $num = odbc_result($r, "doc_num");
                $list .= "<option value='$id' $selected>$num</option>";
            }
        }
        $list .= "</select>";
        return $list;
    }

    function SaveModelBusket($order_id, $item_id, $kol, $price)
    {
        $odb = new odb;
        $slave = new slave;
        $cat = new catalogue;
        session_start();
        $summ = round($kol * $price, 2);
        if (empty($order_id)) {
//            echo "Внутрення ошибка не указан ORDER_ID обратитесь к менеджеру! <br>";
//            return;
            $order_id = $this->getOrderActiveId();

        };

//        $query = "select max(id) as maxId from orders_str;";
//        $r = $odb->query_td($query);
//        $maxId = odbc_result($r, "maxId") + 1;

        $query = "select id from orders_str where item_id='$item_id' and order_id='$order_id' limit 1;";
        $r = $odb->query_td($query);
        $n = $odb->num_rows($r);
        if ($n == 0) {
            list($code, $name, $p, $p, $p) = $cat->getItemInfo($item_id);
//            $odb->query_td("insert into orders_str (id,order_id,item_id,code,name,quant,price,summ) values ('$maxId','$order_id','$item_id','$code','$name','$kol','$price','$summ');");
            $odb->query_td("insert into orders_str (id,order_id,item_id,code,name,quant,price,summ) values ((select max(id)+1 as maxId from orders_str),'$order_id','$item_id','$code','$name','$kol','$price','$summ');");
        }
        if ($n > 0) {
            $r = $odb->query_td($query);
            odbc_fetch_row($r);
            $id = odbc_result($r, id);
//            if empty($id) {};
            $odb->query_td("update orders_str set quant='$kol', price='$price', summ='$summ' where id='$id';");
        }
        return;
    }

    function show_busket()
    {
        session_start();
        $client = $_SESSION["client"];
        $login = $_SESSION["login"];
        $summ = 0;
        $count_s = 0;
        $odb = new odb;
        $cat = new catalogue;
        $slave = new slave;
        $form_htm = RD . "/tpl/busket_small_form.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $session = session_id();
        if ($client != "") {
            $where = " or client='$client' ";
        }
        $r = $odb->query_td("select id from orders where status='12' and (session_id='$session' $where) order by id desc;");
//        $r = $odb->query_td("select id from orders where status=12 and client='$client' order by id desc limit 3 offset 0;");
//        $n = $odb->num_rows($r);
        $i = 0;
//        if ($n != 0) {
        while (odbc_fetch_row($r)) {
            $i++;
            $order_id = odbc_result($r, "id");
            $r1 = $odb->query_td("select SUM(summ) as summ from orders_str where order_id='$order_id';");
            odbc_fetch_row($r1);
            $sum = round(odbc_result($r1, "summ"), 2) + 0;
            $summ += $sum;
        }
//        } else {
//            $summ = 0;
//        };
        $busket_link = "location.href='?dep=busket';";
        if ($i == 1) {
            $busket_link = "showOrderStr('$order_id');";
        }
        $summ = $slave->int_to_money($summ);
        $form = str_replace("{summ}", $summ, $form);
        $form = str_replace("{status}", "$i шт", $form);
        $form = str_replace("{busket_link}", $busket_link, $form);

        return $form;
    }

    function show_list_busket_form($model)
    {
        $busket_form_htm = RD . "/tpl/busket_list_form.htm";
        if (file_exists("$busket_form_htm")) {
            $busket_form = file_get_contents($busket_form_htm);
        }
        $busket_form = str_replace("{model}", $model, $busket_form);
        return $busket_form;
    }

    function save_busket_form($model, $count)
    {
        $odb = new odb;
        $slave = new slave;
        session_start();
        $client = $_SESSION["client"];
        if ($client == "") {
            $session = session_id();
        }
        if ($count != "" and $count > 0) {

            $position_count = $_SESSION["position_count"];
            if ($position_count == "") {
                $position_count = 0;
            }
            $position_count += 1;
            $_SESSION["position_count"] = $position_count;
            $_SESSION["model$position_count"] = $model;
            $_SESSION["count$position_count"] = $count;
            $busket_form_htm = RD . "/tpl/busket_save_form.htm";
            if (file_exists("$busket_form_htm")) {
                $busket_form = file_get_contents($busket_form_htm);
            }
            $busket_form = str_replace("{count}", $count, $busket_form);
            $busket_form = str_replace("{model}", $model, $busket_form);
            return $busket_form;
        }
        if ($count == "" or $count <= 0) {
            return "Неверно указано количество";
        }
    }

    function updateBusketModelCount($or_id, $kol)
    {
        session_start();
        $odb = new odb;
        if ($or_id != "") {
            $er = 0;
            $r = $odb->query_td("select quant,price from orders_str where id='$or_id' limit 1;");
            while (odbc_fetch_row($r)) {
                $count = odbc_result($r, "quant");
                $price = odbc_result($r, "price");
                if ($kol >= 0) {
                    $summ = $kol * $price;
                    $odb->query_td("update orders_str set quant='$kol',summ='$summ' where id='$or_id';");
                }
            }
        }
        return $er;
    }

//    Удаление строки заявки
    function dropModel($or_id)
//    function dropModel($item_id)
    {
        $odb = new odb;
        if ($or_id != "") {
            $odb->query_td("delete from orders_str where id='$or_id';");
        }
        return;
    }

//    Псевдо-Удаление Скрытие активной заявки - перевод её в статус =17 - скрытые заявки
    function dropOrder($order_id)
    {
        $odb = new odb;
        if ($order_id != "") {
            $odb->query_td("update orders set status=17 where order_id='$order_id' and status=12;");
        }
        return;
    }

    function show_busket_client()
    {
        session_start();
        include_once RD . '/lib/catalogue_class.php';
        $odb = new odb;
        $slave = new slave;
        $cat = new catalogue;
        $cl = new client;
        $client = $_SESSION["client"];
        $session = session_id();
        $where = "session_id='$session'";
        if ($client != "") {
            $where = " client='$client' ";
        }
        $form_htm = RD . "/tpl/busket_client_form.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $block_htm = RD . "/tpl/busket_client.htm";
        if (file_exists("$block_htm")) {
            $block = file_get_contents($block_htm);
        }
        if ($client != "") {
            $r1 = $odb->query_td("select * from orders where status='12' and session_id='$session' limit 3;");
            $n1 = $odb->num_rows($r1);
            if ($n1 > 0) {
                $odb->query_td("update orders set client='$client' where session_id='$session';");
            }
        }
        $r = $odb->query_td("select * from orders where status='12' and ($where) order by id desc  limit 3;");
        $n = $odb->num_rows($r);
        $r = $odb->query_td("select * from orders where status='12' and ($where) order by id desc  limit 3;");
        $list = "";
        $need_reg_mes = "";
        $i = 0;
        while (odbc_fetch_row($r)) {
            $i += 1;
            $order_id = odbc_result($r, "id");
            $order_num = odbc_result($r, "doc_num");
            $order_data = $slave->data_word(odbc_result($r, "data"));
            $order_author = odbc_result($r, "author");
            $order_author_name = $cl->get_client_name($order_author);
            $order_author_user = odbc_result($r, "author_user");
            if ($order_author_user != 0) {
                $order_author_name = $cl->get_client_name($order_author_user);
            }
//            $order_status = $this->get_status_caption(odbc_result($r, "status"));
            $order_more_client = odbc_result($r, "more_client");
            $order_sum = $this->getOrderSumm($order_id);
            $list .= "
			<tr class='cont' align='center' onclick='showOrderStr(\"$order_id\");' style='cursor:pointer;'>
				<td>Акт.заявка</td>
				<td>$order_data</td>
				<td><strong>$order_num</strong></td>
				<td align='right'><strong>$order_sum</strong> &nbsp;</td>
				<td align='left'>$order_more_client</td>
				<td><img src='/theme/images/arrowEnter.png' id='arrow" . $order_id . "' border=0 alt='Структура заказа' title='Структура заказа' style='cursor:pointer;' onclick='showOrderStr(\"$order_id\");'></td>
			</tr><tr><td colspan=6 class='border_bot_dot'>&nbsp;</td></tr>";
            if ($n == 1) {
                $block = $this->showOrderStr($order_id);
                $block = str_replace("{hid_style}", " style='display:none;'", $block);
                $list .= "<tr><td colspan=6 class='border_bot_dot'>$block</td></tr>";
            }
        }
        if ($list == "") {
            $list = "
			<tr>
				<td colspan=7 align='center'><h3>Активных WEB-заявок не создано</h3></td>
			</tr>
			<tr align='left'>
				<td colspan=7><strong>Для оформления заявки, предварительно, добавьте товар в корзину заказов воспользовавшись поиском товара по номеру, названию или при помощи каталога TecDoc.</strong></td>
			</tr>";
            $need_reg_mes_htm = RD . "/tpl/need_reg_mes.htm";
            if (file_exists("$need_reg_mes_htm")) {
                $need_reg_mes = file_get_contents($need_reg_mes_htm);
            }
        }
        $form = str_replace("{need_to_register}", $need_reg_mes, $form);
        $form = str_replace("{order_list}", $list, $form);
        return $form;
    }

    function getOrderHeader($order_id)
    {
        $odb = new odb;
        $slave = new slave;
        $cl = new client;
        $r = $odb->query_td("select * from orders where id='$order_id' limit 1;");
        while (odbc_fetch_row($r)) {
            $order_num = odbc_result($r, "doc_num");
            $order_data = $slave->data_word(odbc_result($r, "data"));
            $order_author = odbc_result($r, "author");
            $order_author_name = $cl->get_client_name($order_author);
            $order_author_user = odbc_result($r, "author_user");
            if ($order_author_user != 0) {
                $order_author_name = $cl->get_client_name($order_author_user);
            }
            $order_more_client = odbc_result($r, "more_client");
        }
        return array($order_num, $order_data, $order_author_name, $order_more_client);
    }

    function getOrderSumm($order_id)
    {
        $odb = new odb;
        $r = $odb->query_td("select sum(summ) as summ from orders_str where order_id='$order_id';");
        odbc_fetch_row($r);
        $or_summ = odbc_result($r, "summ");
        return $or_summ;
    }

    function showOrderStr($order_id)
    {
        $odb = new odb;
        $slave = new slave;
        session_start();
        $client = $_SESSION["client"];
        $j = 0;
        $cat = new catalogue;
        $form_htm = RD . "/tpl/busket_client.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }

        $r = $odb->query_td("select * from orders_str where order_id='$order_id';");
        $list = "";
        $orSumm = 0;
        while (odbc_fetch_row($r)) {
            $or_id = odbc_result($r, "id");
            $or_model = odbc_result($r, "item_id");
            $or_code = odbc_result($r, "code");
            $or_caption = odbc_result($r, "name");
            $or_count = (float)$slave->tomoney(odbc_result($r, "quant"));
            $or_price = $slave->tomoney(odbc_result($r, "price"));
            $or_summ = $slave->tomoney(odbc_result($r, "summ"));

            list($or_price, $or_summ) = $cat->updateOrderItemPriceSumm($or_id, $or_model, $or_count, $or_price, $or_summ);
            list($quant, $quant1, $quant_res, $quant1_res) = $cat->getItemQuantKol($or_model);
            $color = "";
            if ($or_count > $quant) {
                $color = " bgcolor='yellow'";
            }
            $orSumm += $or_summ;
            $list .= "
				<tr align='center' height='35' class='t14' $color>
					<td><a href='javascript:drop_busket_position(\"$or_id\",\"$order_id\")'><img src='theme/images/drop_basket.gif' border=0 alt='Удалить' title='Удалить'></a></td>
					<td align='left'>&nbsp;&nbsp;<a href='?dep=23&dep_up=0&dep_cur=3#search=$or_code'>$or_code</a></td>
					<td align='left'>&nbsp;&nbsp;$or_caption</td>
					<td align='right'> <img src='theme/images/minus.png' border=0 alt='-1' title='-1' style='cursor:pointer;' onclick='minusOneBusket(\"$order_id\",\"$or_id\");' />  &nbsp; <span id='count" . $or_id . "'>$or_count</span> &nbsp; <img src='theme/images/plus.png' border=0 alt='+1' title='+1' style='cursor:pointer;' onclick='plusOneBusket(\"$order_id\",\"$or_id\");' /></td>
					<td align='right'>$quant_res</td>
					<td align='right'>$quant1_res</td>
					<td align='right'><input type='hidden' id='price" . $or_id . "' value='$or_price'>" . $slave->int_to_money($or_price) . "</td>
					<td align='right'><input type='hidden' id='summ" . $or_id . "' value='$or_summ'><span id='summ_caption$or_id'>" . $slave->int_to_money($or_summ) . "</span></td>
				</tr>
				<tr><td colspan='8' bgcolor='#282828' height='1'></td></tr>";
        }
        $list .= $block;
        if ($list == "") {
            $list .= "
				<tr align='center' height='35' class='t14' $color>
					<td colspan=8 align='center'><h3>Заявка пустая</h3></td>
				</tr>
				<tr><td colspan='8' bgcolor='#282828' height='1'></td></tr>";
        }
        $form = str_replace("{summ}", $orSumm, $form);
        $form = str_replace("{order_str_list}", $list, $form);
        $form = str_replace("{order_id}", $order_id, $form);
        list($doc_num, $doc_data, $d, $doc_more_client) = $this->getOrderHeader($order_id);
        $form = str_replace("{data}", $doc_data, $form);
        $form = str_replace("{doc_num}", $doc_num, $form);
        $form = str_replace("{more_client}", $doc_more_client, $form);

        return $form;
    }

    function show_delivery_form($delivery)
    {
        $odb = new odb;
        $slave = new slave;
        //$r=$odb->query_td("select * from carrier order by id asc;");$form="";$data=date("Y-m-d");
        $r = $odb->query_td("select * from carrier order by id asc;");
        $form = "";
        $data = date("Y-m-d");
        $form = "<select name='delivery' id='delivery' size=1 style='width:400px' class='tec' onchange='setDeliveryTime(this[this.selectedIndex].value);'>";
        $i = 0;
        while (odbc_fetch_row($r)) {
            $checked = "";
            $id = odbc_result($r, "id");
            $name = odbc_result($r, "name");
            $tm = odbc_result($r, "tm");
            $curtime = date("H:i:s");
            if ($curtime > $tm) {
                $data = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') + 1, date('Y'))) . " " . substr($tm, 0, 5);
            }
            if ($id == $delivery) {
                $form .= "<option value='$id;;$data' selected='selected'>$name</option>";
            }
            if ($id != $delivery) {
                $form .= "<option value='$id;;$data'>$name</option>";
            }
        }
        $form .= "</select>";
        return $form;
    }

    function show_payment_form($payment = 0)
    {
        $odb = new odb;
        $slave = new slave;
        $r = $odb->query_td("select id,name from typepay order by id asc;");
        $form = "";
        $form = "<select name='payment' id='payment' size=1 style='width:400px' class='tec'>";
        $i = 0;
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
            $name = odbc_result($r, "Name");
            if ($id == $payment) {
                $form .= "<option value='$id' selected='selected'>$name</option>";
            }
            if ($id != $payment) {
                $form .= "<option value='$id'>$name</option>";
            }
        }
        $form .= "</select>";
        return $form;
    }

    function show_client_union_form($client)
    {
        $odb = new odb;
        $slave = new slave;
        $cl = new client;
        $r = $odb->query_lider("select kl.union_id, ls.Name from klientunion kl inner join  subconto ls on (ls.id=kl.union_id) where kl.klient_id='$client' order by kl.union_id asc;");
        $form = "<select name='klientunion' id='klientunion' size=1 style='width:400px' class='tec'>";
        $i = 0;
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "union_id");
            $name = odbc_result($r, "Name");
            $form .= "<option value='$id'>$name</option>";
        }
        if ($i == 0) {
            list($q, $name, $q, $q, $q) = $cl->get_order_form_data($client);
            $form .= "<option value='$client'>$name</option>";
        }
        $form .= "</select>";
        return $form;
    }

    function checkExpressQuant($order_id)
    {
        $odb = new odb;
        $slave = new slave;
        $cat = new catalogue;
        $r = $odb->query_td("select * from orders_str where order_id='$order_id';");
        $message = "";
        while (odbc_fetch_row($r)) {
            $item_id = odbc_result($r, "item_id");
            $or_count = (float)$slave->tomoney(odbc_result($r, "quant"));
            list($quant, $quant1, $quant_res, $quant1_res) = $cat->getItemQuantKol($item_id);
            if ($or_count > $quant) {
                $message = "Внимание!\nВ заявке есть позиции (отмеченные желтым цветом), которые будут заказны индивидуально под Вас с Экспрес-склада.\nВозврат таких запчастей невозможен.\n\nВы подтверждаете заказ?";
                break;
            }
        }
        return $message;
    }

    function show_order_form()
    {
        $odb = new odb;
        session_start();
        $client = $_SESSION["client"];
        include_once RD . '/lib/client_class.php';
        $slave = new slave;
        $cl = new client;
        $order_id = $_GET["order_id"];
        $r = $odb->query_td("select * from orders_str where order_id='$order_id';");
        $er = 1;
        while (odbc_fetch_row($r)) {
            $or_id = odbc_result($r, "id");
            $er = 0;
            break;
        }
        if ($er == 1) {
            $order_form_htm = RD . "/tpl/order_empty_form.htm";
            if (file_exists("$order_form_htm")) {
                $order_form = file_get_contents($order_form_htm);
            }
        }
        if ($er == 0) {
            $order_form_htm = RD . "/tpl/order_form.htm";
            if (file_exists("$order_form_htm")) {
                $order_form = file_get_contents($order_form_htm);
            }
            list($code, $name, $email, $phone, $address, $contperson, $phone_person, $address_person, $typepay, $carrier, $remark) = $cl->get_order_form_data($client);
            if ($phone_person == "") {
                $phone_person = $phone;
            }
            if ($address_person == "") {
                $address_person = $address;
            }
            $order_form = str_replace("{dep}", $slave->get_dep(), $order_form);
            $order_form = str_replace("{w}", "save_order", $order_form);
            $order_form = str_replace("{serial}", $slave->gen_form_serial(), $order_form);
            $order_form = str_replace("{order_id}", $order_id, $order_form);
            $order_form = str_replace("{client_name}", $name, $order_form);
            $order_form = str_replace("{contactPerson}", $contperson, $order_form);
            $order_form = str_replace("{code}", $code, $order_form);
            $order_form = str_replace("{client_form}", $this->show_client_union_form($client), $order_form);
            $order_form = str_replace("{email}", $email, $order_form);
            $order_form = str_replace("{phone}", $phone_person, $order_form);
            $order_form = str_replace("{delivery}", "", $order_form);
            $order_form = str_replace("{more}", $remark, $order_form);
            $order_form = str_replace("{address_sent}", $address_person, $order_form);
            $order_form = str_replace("{payment_form}", $this->show_payment_form($typepay), $order_form);
            $order_form = str_replace("{delivery_form}", $this->show_delivery_form($carrier), $order_form);
            $order_form = str_replace("{expressMessage}", $this->checkExpressQuant($order_id), $order_form);
        }
        return $order_form;
    }

    function show_payment_comment($comment)
    {
        $odb = new odb;
        $r = $odb->query_td("select \"desc\" from payment where id='$comment' limit 1;");
        $desc = "";
        while (odbc_fetch_row($r)) {
            $desc = "<br /><hr>" . odbc_result($r, "desc") . "<hr><br />";
        }
        return $desc;
    }

    function save_order_form()
    {
        session_start();
        $remip = $_SERVER['REMOTE_ADDR'];
        $slave = new slave;
        $kours = new kours;
        if ($_SESSION["serial"] != $_POST["serial"]) {
            $order_message_htm = RD . "/tpl/message_error.htm";
            if (file_exists("$order_message_htm")) {
                $order_message = file_get_contents($order_message_htm);
            }
            $message = "<table align='center'><tr><td style='color:red;' align='center'>Попытка повторного сохранения заказа, или время сессии истекло!!!</td></tr></table>
			<script language='JavaScript'>setTimeout(\"location.href='?';\",20000);</script>";
            $order_message = str_replace("{message}", $message, $order_message);
            $order_message = str_replace("{caption}", "Ошибка", $order_message);
        }
        if ($_SESSION["serial"] == $_POST["serial"]) {
            $_SESSION["serial"] = "";
            include_once RD . '/lib/num2str_class.php';
            include_once RD . '/lib/client_class.php';
            include_once RD . '/lib/catalogue_class.php';
            $odb = new odb;
            $slave = new slave;
            $cl = new client;
            $cat = new catalogue;
            $order_message_htm = RD . "/tpl/order_saving_message.htm";
            if (file_exists("$order_message_htm")) {
                $order_message = file_get_contents($order_message_htm);
            }
            $order_id = $slave->qq($_POST["order_id"]);
            $klientunion = $_POST["klientunion"];
            $contactPerson = $slave->qq($_POST["contactPerson"]);
            $phonePerson = $slave->qq($_POST["phone"]);
            $client = $_SESSION["client"];
            $payment = $slave->qq($_POST["payment"]);
            $delivery = $slave->qq($_POST["delivery"]);
            $more = $slave->qq($_POST["more"]);
            $address_sent = $slave->qq($_POST["address_sent"]);
            list($code, $name, $email, $phone, $address) = $cl->get_order_form_data($client);
            $deliver = explode(";;", $delivery);
            $delivery = $deliver[0];
            if ($phonePerson == "") {
                $phonePerson = $phone;
            }

            $date = date("Y-m-d");
            $time = date("H:i:s");
            if ($more == "") {
                $more = " ";
            }
            $r = $odb->query_td("update orders set author_send='$client', union_client='$client', address='$address_sent', more='$more', data_send='$date', time_send='$time', remip='$remip', payment='$payment', delivery='$delivery', status='16', phoneperson='$phonePerson', contactperson='$contactPerson' where id='$order_id';");
//            $odb->query_td("insert into orders_check (order_id,data) values ('$order_id','$date');");
            $odb->query_td("insert into orders_check (order_id,status,data) values ('$order_id',1,date(now()));");

            $r = $odb->query_td("select * from orders where id='$order_id';");
            while (odbc_fetch_row($r)) {
                $doc_id = odbc_result($r, "doc_id");
                $doc_num = odbc_result($r, "doc_num");
            }

            $odb->query_lider("create variable @last_id integer ");
            $odb->query_lider("insert into Local(user_id) values(-1);");
            $odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
            $odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
            $odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");

            $r1 = $odb->query_td("select * from orders_str where order_id='$order_id';");
            $olist = "";
            $orSumm = 0;
            $j = 0;
            while (odbc_fetch_row($r1)) {
                $j++;
                if (odbc_result($r1, "quant") > 0) {
                    $or_id = odbc_result($r1, "id");
                    $or_model = odbc_result($r1, "item_id");
                    $or_code = odbc_result($r1, "code");
                    $or_caption = odbc_result($r1, "name");
                    $or_count = $slave->int_to_money(odbc_result($r1, "quant"));
                    $or_price = $slave->int_to_money(odbc_result($r1, "price"));
                    $or_summ = $slave->int_to_money(odbc_result($r1, "summ"));
                    $orSumm += $or_summ;
                    $olist .= "
					<tr align='center' height='35' class='t14'>
						<td align='left'>&nbsp;&nbsp;$j</td>
						<td align='left'>&nbsp;&nbsp;$or_code</td>
						<td align='left'>&nbsp;&nbsp;$or_caption</td>
						<td align='right'> $or_count</td>
						<td align='right'>$or_price</td>
						<td align='right'>$or_summ</td>
					</tr>
					<tr><td colspan='8' bgcolor='#282828' class='dotted' height='1'></td></tr>";
                    $odb->query_lider("insert into docrow (doc_id,id,price,price1,quant,item_id) values ('$doc_id','$j','$or_price','$or_price','$or_count','$or_model');");
                    $errMsg = '';
                    $errMsg = odbc_errormsg($odb->db_lider);
                    $errMsgCln = '';
                    if (!empty($errMsg) or $errMsg != '') {
                        $errMsgCln = " Извините :( во время отправки заявки произошла внутрення ошибка сайта <br>
                        <span style='color:red;'>$errMsg,<br></span>
                        <h2>сайт будет отправлять Вашу заявку автоматически через каждые 5 минут, но Вам надо убедиться в размещении заявки, иначе товар может быть не отправлен!</h2>
                        обратитесь пожалуйста в тех.поддержку  +3 8 067 383 33 58 <br>
                        или к менеджерам +3 8 067 383 11 01";
                    }
                }
            }
            $orSumm = $slave->int_to_money($orSumm);
            $r = $odb->query_td("select place_id from subconto where id='$client';");
            while (odbc_fetch_row($r)) {
                $place_id = odbc_result($r, "place_id");
            }
            if ($place_id == "" or $place_id == 0) {
                $place_id = 23;
            }
            $odb->query_lider("update doc set opl=0, subconto_id=$client, place_id=$place_id, klient_id=$client, sum='$orSumm', sum1='$orSumm', day='$date', sday='$date', kinddoc_id=12 where id='$doc_id';");
            $odb->query_lider("update docstates set n=n+1 where doc_id='$doc_id';");
            $odb->query_lider("insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_id','0',now(),'-1','16');");
//			$odb->query_lider("insert into docinfo (doc_id,tm,direction,remark,dremark,phone,contperson,typePay) values ('$doc_id',now(),'$address_sent','$more','".$this->get_table_caption("carrier",$delivery)."','$phonePerson','$contactPerson','".$this->get_table_caption("typepay",$payment)."');");

            $odb->query_lider("insert into docinfo (doc_id,tm,direction,remark,dremark,carrier_id,phone,contperson,typePay) values ('$doc_id',now(),'$address_sent','$more','" . $this->get_table_caption("carrier", $delivery) . "','$delivery','$phonePerson','$contactPerson','" . $this->get_table_caption("typepay", $payment) . "');");

            $order_message = str_replace("{busket}", $olist, $order_message);
            $order_message = str_replace("{summ}", $slave->int_to_money($orSumm), $order_message);
            $order_message = str_replace("{order_id}", $doc_num, $order_message);
            $order_message = str_replace("{code}", $code, $order_message);
            $order_message = str_replace("{client_name}", $name, $order_message);
            $order_message = str_replace("{contactPerson}", $contactPerson, $order_message);
            $order_message = str_replace("{email}", $email, $order_message);
            $order_message = str_replace("{delivery}", $this->get_table_caption("carrier", $delivery), $order_message);
            $order_message = str_replace("{payment}", $this->get_table_caption("typepay", $payment), $order_message);
            $order_message = str_replace("{phone}", $phonePerson, $order_message);
            $order_message = str_replace("{address_sent}", $address_sent, $order_message);
            $order_message = str_replace("{data_time}", $slave->data_word(date("Y-m-d")) . " " . date("H:i:s"), $order_message);
            $order_message = str_replace("{remip}", $remip, $order_message);
            $order_message = str_replace("{status}", $this->get_status_caption(1), $order_message);
            $order_message = str_replace("{more}", $more, $order_message);
            $order_message = str_replace("{client_union}", $cl->get_client_name($klientunion), $order_message);
            if ($_SESSION["client_user"] == 0) {
                $author_send = $name;
            }
            if ($_SESSION["client_user"] != 0) {
                $author_send = $cl->get_client_user_name($_SESSION["client_user"]);
            }
            $order_message = str_replace("{author_send}", $author_send, $order_message);

            include_once RD . "/mail/sendmail.class.php";
            $Mail = new sendmail();
            $Mail->mail_to = "$name <$email>";
            $Mail->subject = "New order: $doc_num (zakaz.avtolider-ua.com)";
            $Mail->message = $order_message;
            $Mail->from_name = "Avtolider";
            $Mail->SendFromMail = "no-reply@avtolider-ua.com";
            $Mail->Send();

            $order_message_htm = RD . "/tpl/order_message.htm";
            if (file_exists("$order_message_htm")) {
                $order_message = file_get_contents($order_message_htm);
            }
            $order_message = str_replace("{errMsg}", $errMsgCln, $order_message);
            $order_message = str_replace("{order_id}", $doc_num, $order_message);

            include_once RD . '/lib/sms_class.php';
            $sms = new sms;
//			$answer=$sms->send_sms("Avtolider","+380637717337","WEB-заявка №$doc_num на сайте avtolider.km.ua");

            list($c, $c, $c, $c, $c, $SContPerson, $SPhonePerson, $SAddressPerson, $STypePay, $SCarrier, $SRemark) = $cl->get_order_form_data($client);
//эта часть сохраняет инфо о доставке   - отключаю, всё равно не работает, да и не понадобилось - 
            if ($SAddressPerson == "" or $SAddressPerson != $address_sent) {
                $r = $odb->query_lider("select isnull( (select max(n) from adresdeliv where subconto_id='$client'),0);");
                $nA = odbc_result($r, 1) + 1;
                $odb->query_lider("update adresdeliv set n=$nA where subconto_id='$client' and n=1");
                $odb->query_lider("insert into adresdeliv (subconto_id,n,adres,phone,contperson,remark,carrier_id,typepay_id) values ('$client'$nA,'$address_sent','$phonePerson','$contactPerson','$more','$delivery','$payment');");
            }
        }
        return $order_message;
    }

    function show_fast_order_form()
    {
        $odb = new odb;
        session_start();
        $client = $_SESSION["client"];
        $order_id = $_GET["order_id"];
        $r = $odb->query_td("select * from orders_str where order_id='$order_id';");
        $er = 1;
        while (odbc_fetch_row($r)) {
            $or_id = odbc_result($r, "id");
            $er = 0;
            break;
        }
        if ($er == 1) {
            $order_form_htm = RD . "/tpl/order_empty_form.htm";
            if (file_exists("$order_form_htm")) {
                $order_form = file_get_contents($order_form_htm);
            }
        }
        if ($er == 0) {
            include_once RD . '/lib/client_class.php';
            $slave = new slave;
            $cl = new client;
            $order_form_htm = RD . "/tpl/order_fast_form.htm";
            if (file_exists("$order_form_htm")) {
                $order_form = file_get_contents($order_form_htm);
            }
            $order_form = str_replace("{dep}", $slave->get_dep(), $order_form);
            $order_form = str_replace("{w}", "save_fast_order", $order_form);
            $order_form = str_replace("{serial}", $slave->gen_form_serial(), $order_form);
            $order_form = str_replace("{order_id}", $order_id, $order_form);
            $order_form = str_replace("{activity_form}", $cl->showActivityForm(3), $order_form);
            $order_form = str_replace("{state_form}", $cl->showStateForm(0, 2), $order_form);

            $order_form = str_replace("{client_name}", "", $order_form);
            $order_form = str_replace("{code}", "", $order_form);
            $order_form = str_replace("{email}", "", $order_form);
            $order_form = str_replace("{phone}", "380", $order_form);
            $order_form = str_replace("{delivery}", "", $order_form);
            $order_form = str_replace("{address_sent}", "", $order_form);
            $order_form = str_replace("{payment_form}", $this->show_payment_form(), $order_form);
            $order_form = str_replace("{delivery_form}", $this->show_delivery_form(0), $order_form);
            $order_form = str_replace("{expressMessage}", $this->checkExpressQuant($order_id), $order_form);
        }
        return $order_form;
    }

    function save_fast_order_form()
    {
        session_start();
        $remip = $_SERVER['REMOTE_ADDR'];
        $slave = new slave;
        $kours = new kours;
        if ($_SESSION["serial"] != $_POST["serial"]) {
            $order_message_htm = RD . "/tpl/message_error.htm";
            if (file_exists("$order_message_htm")) {
                $order_message = file_get_contents($order_message_htm);
            }
            $message = "<table align='center'><tr><td style='color:red;' align='center'>Попытка повторного сохранения заказа, или время сессии истекло!!!</td></tr></table>
			<script language='JavaScript'>setTimeout(\"location.href='?';\",20000);</script>";
            $order_message = str_replace("{message}", $message, $order_message);
            $order_message = str_replace("{caption}", "Ошибка", $order_message);
        }
        if ($_SESSION["serial"] == $_POST["serial"]) {
            $_SESSION["serial"] = "";
            include_once RD . '/lib/num2str_class.php';
            include_once RD . '/lib/client_class.php';
            include_once RD . '/lib/catalogue_class.php';
            $odb = new odb;
            $cl = new client;
            $cat = new catalogue;
            $order_message_htm = RD . "/tpl/order_saving_message.htm";
            if (file_exists("$order_message_htm")) {
                $order_message = file_get_contents($order_message_htm);
            }
            $order_id = $slave->qq($_POST["order_id"]);
            $klientunion = 0;
            $email = $_POST["email"];
            $name = $_POST["name"];
            $phone = $_POST["phone"];
            $state = $slave->qq($_POST["state_form"]);
            $city = $slave->qq($_POST["city_form"]);
            $new_city = $slave->qq($_POST["new_ordercity"]);
            $activity = $slave->qq($_POST["RegActivity_form"]);
            $payment = $slave->qq($_POST["payment"]);
            $delivery = $slave->qq($_POST["delivery"]);
            $more = $slave->qq($_POST["more"]);
            $address_sent = $slave->qq($_POST["address_sent"]);
            $deliver = explode(";;", $delivery);
            $delivery = $deliver[0];
            if ($more == "") {
                $more = " ";
            }
            $odb->query_lider("create variable @last_id integer ");
            $odb->query_lider("insert into Local(user_id) values(-1);");
            $odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
            $odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
            $odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY'; ");
            $odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");

            $client = $cl->create_noreg_client($activity, $name, $email, $phone, $state, $city, $new_city, $address_sent);
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $odb->query_td("update orders set client='$client', author_send='$client', union_client='$client', address='$address_sent', more='$more', data_send='$date', time_send='$time', remip='$remip', payment='$payment', delivery='$delivery', status='16' where id='$order_id';");

            $r = $odb->query_td("select * from orders where id='$order_id';");
            while (odbc_fetch_row($r)) {
                $doc_id = odbc_result($r, "doc_id");
                $doc_num = odbc_result($r, "doc_num");
            }

            $r1 = $odb->query_td("select * from orders_str where order_id='$order_id';");
            $olist = "";
            $orSumm = 0;
            $j = 0;
            while (odbc_fetch_row($r1)) {
                $j++;
                if (odbc_result($r1, "quant") > 0) {
                    $or_id = odbc_result($r1, "id");
                    $or_item_id = odbc_result($r1, "item_id");
                    $or_code = odbc_result($r1, "code");
                    $or_caption = odbc_result($r1, "name");
                    $or_count = $slave->int_to_money(odbc_result($r1, "quant"));
                    $or_price = $slave->int_to_money(odbc_result($r1, "price"));
                    $or_summ = $slave->int_to_money(odbc_result($r1, "summ"));
                    $orSumm += $or_summ;
                    $olist .= "
					<tr align='center' height='35' class='t14'>
						<td align='left'>&nbsp;&nbsp;$j</td>
						<td align='left'>&nbsp;&nbsp;$or_code</td>
						<td align='left'>&nbsp;&nbsp;$or_caption</td>
						<td align='right'> $or_count</td>
						<td align='right'>$or_price</td>
						<td align='right'>$or_summ</td>
					</tr>
					<tr><td colspan='8' bgcolor='#282828' class='dotted' height='1'></td></tr>";
                    $odb->query_lider("insert into docrow (doc_id,id,price,price1,quant,item_id) values ('$doc_id','$j','$or_price','$or_price','$or_count','$or_item_id');");
                    $errMsg = '';
                    $errMsg = odbc_errormsg($odb->db_lider);
                    $errMsgCln = '';
                    if (!empty($errMsg) or $errMsg != '') {
                        $errMsgCln = " Извините :( но во время отправки заявки произошла внутрення ошибка сайта <br>
                        <span style='color:red;'> $errMsg,</span><br>
                        сайт будет отправлять Вашу заявку автоматически через каждые 5 минут,<br> 
                        но Вам надо убедиться в правильном размещении заявки, иначе товар может быть не отправлен!<br>
                        обратитесь пожалуйста к админам +3 8 067 383 33 58 или менеджерам +3 8 067 383 11 01";
                    }
                }
            }

            $orSumm = $slave->int_to_money($orSumm);
//			$odb->query_td("update doc set subconto_id='$client', klient_id='$client', sum='$orSumm', sum1='$orSumm', sday='$date', kinddoc_id='12' where id='$doc_id';");
            $odb->query_lider("update doc set opl=0, subconto_id='$client', place_id='23', klient_id='$client', sum='$orSumm', sum1='$orSumm', sday='$date', kinddoc_id='12' where id='$doc_id';");

//			$odb->query_td("update docstates set n=n+1 where doc_id='$doc_id' and n=0;"); 
            $odb->query_lider("update docstates set n=n+1 where doc_id='$doc_id' and n=0;");

//			$odb->query_td("insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_id','0',now(),'-1','16');"); 
            $odb->query_lider("insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_id','0',now(),'-1','16');");

//			$odb->query_td("insert into docinfo (doc_id,tm,direction,remark,dremark,phone,contperson,typePay) values ('$doc_id',now(),'$address_sent','$more','".$this->get_table_caption("carrier",$delivery)."','$phone','$contactPerson','".$this->get_table_caption("typepay",$payment)."');"); 
//			$odb->query_lider("insert into docinfo (doc_id,tm,direction,remark,dremark,carrier_id,phone,contperson,typePay) values ('$doc_id',now(),'$address_sent','$more','".$this->get_table_caption("carrier",$delivery)."','$phone','$contactPerson','".$this->get_table_caption("typepay",$payment)."');");
            $odb->query_lider("insert into docinfo (doc_id,tm,direction,remark,dremark,carrier_id,phone,contperson,typePay) values ('$doc_id',now(),'$address_sent','$more','" . $this->get_table_caption("carrier", $delivery) . "','$delivery','$phonePerson','$contactPerson','" . $this->get_table_caption("typepay", $payment) . "');");

            $r = $odb->query_lider("select isnull( (select max(n) from adresdeliv where subconto_id='$client'),0);");
            $nA = odbc_result($r, 1) + 1;
            $odb->query_lider("update adresdeliv set n=$nA where subconto_id='$client' and n=1");
            $odb->query_lider("insert into adresdeliv (subconto_id,n,adres,phone,contperson,remark,carrier_id,typepay_id) values ('$client',1,'$address_sent','$phonePerson','$contactPerson','$more','$delivery','$payment');");

            $order_message = str_replace("{busket}", $olist, $order_message);
            $order_message = str_replace("{summ}", $slave->int_to_money($orSumm), $order_message);
            $order_message = str_replace("{order_id}", $doc_num, $order_message);
            $order_message = str_replace("{code}", $code, $order_message);
            $order_message = str_replace("{client_name}", $name, $order_message);
            $order_message = str_replace("{contactPerson}", $name, $order_message);
            $order_message = str_replace("{email}", $email, $order_message);
            $order_message = str_replace("{delivery}", $this->get_table_caption("carrier", $delivery), $order_message);
            $order_message = str_replace("{payment}", $this->get_table_caption("typepay", $payment), $order_message);
            $order_message = str_replace("{phone}", $phone, $order_message);
            $order_message = str_replace("{address_sent}", $address_sent, $order_message);
            $order_message = str_replace("{data_time}", $slave->data_word(date("Y-m-d")) . " " . date("H:i:s"), $order_message);
            $order_message = str_replace("{remip}", $remip, $order_message);
            $order_message = str_replace("{status}", $this->get_status_caption(1), $order_message);
            $order_message = str_replace("{more}", $more, $order_message);
            $order_message = str_replace("{client_union}", $cl->get_client_name($client), $order_message);
            if ($_SESSION["client_user"] == 0) {
                $author_send = $name;
            }
            if ($_SESSION["client_user"] != 0) {
                $author_send = $cl->get_client_user_name($_SESSION["client_user"]);
            }
            $order_message = str_replace("{author_send}", $author_send, $order_message);


            include_once RD . "/mail/sendmail.class.php";
            $Mail = new sendmail();
            $Mail->mail_to = "$name <$email>";
            $Mail->subject = "New order: $doc_num (zakaz.avtolider-ua.com)";
            $Mail->message = $order_message;
            $Mail->from_name = "Avtolider";
            $Mail->SendFromMail = "no-reply@avtolider-ua.com";
            $Mail->Send();

            $order_message_htm = RD . "/tpl/order_message.htm";
            if (file_exists("$order_message_htm")) {
                $order_message = file_get_contents($order_message_htm);
            }
            $order_message = str_replace("{errMsg}", $errMsgCln, $order_message);
            $order_message = str_replace("{order_id}", $doc_num, $order_message);

            include_once RD . '/lib/sms_class.php';
            $sms = new sms;
            //	$answer=$sms->send_sms("Avtolider","+380637717337","WEB-заявка №$doc_num на сайте avtolider.km.ua");
        }

        return $order_message;
    }
    //----------------------------------------------
    // order history
    //----------------------------------------------
    function show_order_history($page)
    {
//        session_start();
//        $client = $_SESSION["client"];
        if (isset($_REQUEST[session_name()])) session_start();
        if (empty($_SESSION["client"])) {
            $client = 0; //Выводить скидку по клиенту=Фирма ЛидерСервис-Клиент группа 4
        } else {
            $client = $_SESSION["client"];
        }

        $odb = new odb;
        $slave = new slave;
        $dep = $slave->get_dep();
        list($dep_up, $dep_cur) = $slave->get_file_deps("history");
        $order_list_htm = RD . "/tpl/order_list.htm";
        if (file_exists("$order_list_htm")) {
            $order_list = file_get_contents($order_list_htm);
        }
        $kp = 9;
        $limit = " limit $kp";
        if ($page != "") {
            if ($page < 0) {
                $page = 0;
            }
            $from = $page * $kp;
//            $limit = " limit $from,$kp";
            $limit = " limit $kp offset $from";
        }
        $list = "";
        $r = $odb->query_td("
                        select date(D.Day) as day, 
                            D.Num num, 
                            cast(D.sum as numeric(12,2)) sum,
                            COALESCE(D.Remark,'') remark,
                            COALESCE(DS.Name,'') state,
                            D.id doc_id,
                            COALESCE(DI.remark,'') dremark,
                            COALESCE(DI.DIRECTION,'') napr
                          from Doc D
                            left outer join DocStates DSS on D.id=DSS.doc_id and DSS.n=0
                            left outer join DocState DS on DS.id=DSS.state_id
                            left outer join DocInfo DI on DI.doc_id=D.id
                           where D.SubConto_id='$client'
                             and D.KindDoc_id=12
                           order by day desc,D.Num desc
                           limit 20;
		            ");
        $j = 0;
        while (odbc_fetch_row($r)) {
            $j++;
            $doc_id = odbc_result($r, "doc_id");
            $doc_num = odbc_result($r, "num");
            $data = odbc_result($r, "day");
            $sum = odbc_result($r, "sum");
            $remark = odbc_result($r, "remark");
            $dremark = odbc_result($r, "dremark");
            if ($dremark != "") {
                $dremark = ", " . $dremark;
            }
            $direction = odbc_result($r, "napr");
            if ($direction != "") {
                $direction = ", " . $direction;
            }
            $state = odbc_result($r, "state");
            $show_button = "<img src='/theme/images/arrowEnter.png' id='arrow" . $doc_id . "' border=0 alt='Структура заказа' title='Структура заказа' style='cursor:pointer;' onclick='showDocOrder(\"$doc_id\");'>";
            $per = $this->getDocPersent($doc_id);
            $userRemark = $this->getDocUserRemark($doc_id);
            $list .= "
				<tr class='cont' align='center' onclick='showDocOrder(\"$doc_id\");' style='cursor:pointer;'>
					<td align='center'>$state</td>
					<td>$data</td>
					<td><strong>$doc_num</strong></td>
					<td align='right'><strong>$sum</strong>&nbsp;</td>
					<td align='right'><strong>$per%</strong>&nbsp;</td>
					<td align='left'>&nbsp;$userRemark</td>
					<!--<td align='left'>&nbsp;$remark $dremark $direction</td>-->
					<td>$show_button</td>
				</tr>
				<tr><td colspan=6 class='border_bot_dot'>&nbsp;</td></tr>";
        }
        if ($client != 0 and $client != "" and $j == 0) {
            $list = "
			<tr class='cont' align='center'>
				<td colspan='6' align='center'> Заявок не найдено! <br /><br /><br /></td>
			</tr>
			<tr><td colspan=6 style='border-top:1px dotted #CCC;'>&nbsp;</td></tr>";
        }
        if ($client == 0 or $client == "") {
            $list = "
			<tr class='cont' align='center'>
				<td colspan='6' align='center'>Для просмотра истории WEB заявок необходимо авторизироваться<br /><br /><br /></td>
			</tr>
			<tr><td colspan=6 style='border-top:1px dotted #CCC;'>&nbsp;</td></tr>";
        }
        $order_list = str_replace("{order_list}", $list, $order_list);
        return $order_list;
    }

    function getDocPersent($doc_id)
    {
        session_start();
        $client = $_SESSION["client"];
        $odb = new odb;
        $slave = new slave;
        $r = $odb->query_td("select cast(quant as numeric(12,2)) \"quant\",cast(quant1 as numeric(12,2)) \"quant1\" from docrow where doc_id='$doc_id' order by id asc;");
        $sum = 0;
        $sum1 = 0;
        while (odbc_fetch_row($r)) {
            $quant = $slave->tomoney(odbc_result($r, "quant"));
            $quant1 = $slave->tomoney(odbc_result($r, "quant1"));
            if ($quant1 == "") {
                $quant1 = $quant;
            }
            $sum += $quant;
            $sum1 += $quant1;
        }
        $persent = 0;
        if ($sum > 0) {
            $persent = ceil($sum1 * 100 / $sum);
        }
        return $persent;
    }

    function getDocUserRemark($doc_id)
    {
        $odb = new odb;
        $r = $odb->query_td("select more_client from orders where doc_id='$doc_id' limit 1;");
        $remark = "";
        while (odbc_fetch_row($r)) {
            $remark = odbc_result($r, "more_client");
        }
        return $remark;
    }

    function get_doc_header($doc_id)
    {
        session_start();
        $client = $_SESSION["client"];
        include_once RD . '/lib/client_class.php';
        $odb = new odb;
        $slave = new slave;
        $cl = new client;
        $r = $odb->query_td("select 
			D.num \"num\",
			to_char(D.Day,'dd-mm-yyyy') \"day\",
			D.subconto_id,
			COALESCE(D.klient_id,D.subconto_id) \"klient_id\",
			DI.Remark \"remark\",
			DI.DRemark \"dremark\",
			DI.phone \"phone\",
			DI.contperson \"contperson\",
			DI.typepay \"typepay\"
		from doc D
		
		left outer join DocInfo DI on D.id=DI.doc_id
		
		where D.id='$doc_id' limit 1;");
        while (odbc_fetch_row($r)) {
            $subconto_id = odbc_result($r, "subconto_id");
            $client_id = odbc_result($r, "klient_id");
            $data = odbc_result($r, "day");
            $doc_num = odbc_result($r, "num");
            $contperson = odbc_result($r, "contperson");
            $remark = odbc_result($r, "remark");
            $dremark = odbc_result($r, "dremark");
            $phone = odbc_result($r, "phone");
            $typepay = odbc_result($r, "typepay");

            $klient_send = $cl->get_client_name(odbc_result($r, "klient_id"));
            list($code, $name, $email, $a, $a) = $cl->get_order_form_data($subconto_id);
        }
        return array($doc_num, $code . " " . $name, $klient_send, $email, $phone, $remark, $dremark, $contperson, $data, $typepay);
    }

    function showDocOrder($doc_id)
    {
        $odb = new odb;
        $slave = new slave;
        session_start();
        $client = $_SESSION["client"];
        $j = 0;
        $cat = new catalogue;
        $order_show_htm = RD . "/tpl/order_history.htm";
        if (file_exists("$order_show_htm")) {
            $order_show = file_get_contents($order_show_htm);
        }
        $r = $odb->query_td("select item_id,cast(price as numeric(12,2)) \"price\",cast(price1 as numeric(12,2)) \"price1\",cast(quant as numeric(12,2)) \"quant\",cast(quant1 as numeric(12,2)) \"quant1\" from docrow where doc_id='$doc_id' order by id asc;");
        $list = "";
        while (odbc_fetch_row($r)) {
            $j++;
            $price = $slave->tomoney(odbc_result($r, "price"));
            $price1 = $slave->tomoney(odbc_result($r, "price1"));
            $quant = $slave->tomoney(odbc_result($r, "quant"));
            $quant1 = $slave->tomoney(odbc_result($r, "quant1"));
            if ($quant1 == "") {
                $quant1 = $quant;
            }
            $item_id = odbc_result($r, "item_id");
            list($code, $name) = $cat->getItemInfo($item_id);
            $sum = $quant1 * $price;
            $summ += $sum;
            $sum = $slave->int_to_money($sum);
            $list .= "
				<tr align='center' class='cont'>
					<td>$j</td>
					<td align='left'>&nbsp;$code</td>
					<td align='left'>&nbsp;&nbsp;$name</td>
					<td align='right'>$quant</td>
					<td align='right'>$price</td>
					<td align='right'>$quant1</td>
					<td align='right'>$sum</td>
				</tr>
				<tr><td colspan=8 class='border_bot_dot'>&nbsp;</td></tr>";
        }
        $order_show = str_replace("{busket}", $list, $order_show);
        $order_show = str_replace("{summ}", $slave->int_to_money($summ), $order_show);
        list($doc_num, $name, $client_union, $email, $phone, $remark, $dremark, $contperson, $data, $typepay) = $this->get_doc_header($doc_id);

        $order_show = str_replace("{client_name}", $name, $order_show);
        $order_show = str_replace("{client_union}", $client_union, $order_show);
        $order_show = str_replace("{contactPerson}", $contactPerson, $order_show);
        $order_show = str_replace("{email}", $email, $order_show);
        $order_show = str_replace("{phone}", $phone, $order_show);
        $order_show = str_replace("{payment}", $typepay, $order_show);
        $order_show = str_replace("{delivery}", $dremark, $order_show);
        $order_show = str_replace("{more}", $remark, $order_show);
        $order_show = str_replace("{data}", $data, $order_show);
        $order_show = str_replace("{order_id}", $doc_num, $order_show);
        if ($j == 0) {
            $order_show_htm = RD . "/tpl/message_error.htm";
            if (file_exists("$order_show_htm")) {
                $order_show = file_get_contents($order_show_htm);
            }
            $order_show = str_replace("{caption}", "Ошибка", $order_show);
            $order_show = str_replace("{message}", "Доступ запрещен", $order_show);
        }
        return $order_show;
    }

    function get_status_caption($status)
    {
        $odb = new odb;
        $name = "";
        $r = $odb->query_td("select name from docstate where id='$status';");
        while (odbc_fetch_row($r)) {
            $name = odbc_result($r, "name");
        }
        return $name;
    }

    function get_payment_caption($payment)
    {
        $odb = new odb;
        $name = "";
        $r = $odb->query_td("select name from payment where id='$payment';");
        while (odbc_fetch_row($r)) {
            $name = odbc_result($r, "name");
        }
        return $name;
    }

    //функция возвращает поле название name из таблицы $tname которое соответствует $id
    function get_table_caption($tname, $id)
    {
        $odb = new odb;
        $name = "";
        $r = $odb->query_td("select name from $tname where id='$id';");
        while (odbc_fetch_row($r)) {
            $name = odbc_result($r, "name");
        }
        return $name;
    }

    function show_doc_side()
    {
        $odb = new odb;
        $form_htm = RD . "/tpl/doc_side_form.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        return $form;
    }
    //-------------------------------------------------
    //           DOCS
    //-------------------------------------------------
//    Эта процедура показует ДОЛГИ и АВАНСЫ - документы для оплаты вызывается из docs.php
    function show_order_docs($page)
    {
//        session_start();
//        $client = $_SESSION["client"];
        if (isset($_REQUEST[session_name()])) session_start();
        if (empty($_SESSION["client"])) {
            $client = 10000001; //Выводить скидку по клиенту=Фирма ЛидерСервис-Клиент группа 4
        } else {
            $client = $_SESSION["client"];
        }

        $odb = new odb;
        $slave = new slave;
        $cat = new catalogue;
        $dep = $slave->get_dep();
        list($dep_up, $dep_cur) = $slave->get_file_deps("doc");
        $doc_list_htm = RD . "/tpl/doc_list.htm";
        if (file_exists("$doc_list_htm")) {
            $doc_list = file_get_contents($doc_list_htm);
        }
        $form_htm = RD . "/tpl/doc_client_form.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $block_htm = RD . "/tpl/doc_client.htm";
        if (file_exists("$block_htm")) {
            $block = file_get_contents($block_htm);
        }
        $r = $odb->query_td("
                select *
                 from (select KD.Name as docName,
                    D.Num as num,
                    date(D.Day) as day,
                    case when D.sDay < date(now()) then 'style=\"color:red\" ' else '' end as clr,
                    case when D.kinddoc_id in (61) then date(null) else date(coalesce(D.sDay,null)) end as sday,
                cast(case
                    when coalesce(D.val_id,0)!=978 then
                        case when D.KindDoc_id in (3,27,20,28) then D.sum
                    else -D.sum end
                    end as numeric(12,2)) as s,
                   cast(case
                      when coalesce(D.val_id,0)!=978 then
                    case when D.KindDoc_id in (3,27,20,28) then D.sum-coalesce(D.osum,0)
                    else -D.osum end
                end as numeric(12,2)) as os,
                  cast(case when coalesce(D.val_id,0)=978 then
                   case when D.KindDoc_id in (3,27,20,28) then D.vsum
                   else -D.vsum
                   end
                end as numeric(12,2)) as vs,
                   cast(case
                 when coalesce(D.val_id,0)=978 then
                  case when D.KindDoc_id in (3,27,20,28) then D.vsum-coalesce(D.vosum,0)
                  else -D.vosum
                  end
                 end as numeric(12,2)) as vos,
                D.id doc_id,
                D.flag doc_flag,
                D.SubConto_id
             from DocOpen O
                left outer join Doc D on D.id=O.doc_id
                join KindDoc KD on KD.id=D.KindDoc_id
                  where O.SubConto_id='$client') as s1
                  where os!=0 or vos!=0
                 order by s1.sday,s1.num;
        ");
        $list = "";
        $need_reg_mes = "";
        $k = 0;
        $i = 0;
        $summ = 0;
        $ost_summ = 0;
        while (odbc_fetch_row($r)) {
            $k += 1;
            $i += 1;
            $doc_id = odbc_result($r, "doc_id");
            $doc_flag = odbc_result($r, "doc_flag");
            $doc_name = odbc_result($r, "docName");
            $num = odbc_result($r, "num");
            $day = odbc_result($r, "day");
            $clr = odbc_result($r, "clr");
            $sday = odbc_result($r, "sday");
            $style = "";
            if (date("Ymd", strtotime($sday)) <= date("Ymd")) {
                $style = " style='color:#ff0000; font-weight:bold;'";
            }
            $s = $slave->tomoney(odbc_result($r, "s"));
            $os = $slave->tomoney(odbc_result($r, "os"));
            $vs = $slave->tomoney(odbc_result($r, "vs"));
            $vos = $slave->tomoney(odbc_result($r, "vos"));

            $summ += $s;
            $ost_summ += floatval($os);
            $doc_show = "<img src='/theme/images/arrowDown.png' id='arrow" . $doc_id . "' class='arrowDown' border=0 alt='Структура документа' title='Структура документа' style='cursor:pointer;' onclick='showDocStr(\"$doc_id\");'>";

            if ($i > 1) {
                $list .= "<tr><td colspan=8 style='height:1px; font-size:3px;border-bottom:1px solid #676766;'>&nbsp;</td></tr>";
            }
            $color = "#f0f5fb";
            if ($k == 2) {
                $color = "#ffffff";
                $k = 0;
            }
            $list .= "
			<tr align='left' id='row" . $doc_id . "' bgcolor='$color'>
				<td>&nbsp;&nbsp;$i</td>
				<td align='center'>$num</td>
				<td>&nbsp; $doc_name</td>
				<td align='center'>" . $day . "</td>
				<td align='center' $style>" . $sday . "</td>
				<td align='right'>$s</td>
				<td align='right'>$os</td>
				<td align='center'>$doc_show</td>
			</tr><tr><td colspan=7>";

            $r1 = $odb->query_td("select dr.*, i.code as item_code, i.name as item_name from docrow dr inner join item i on (i.id=dr.item_id) where dr.doc_id='$doc_id';");
            $drlist = "";
            $j = 0;
            while (odbc_fetch_row($r1)) {
                $j++;
                $doc_item_id = odbc_result($r1, "item_id");
                $doc_price = $slave->tomoney(odbc_result($r1, "price"));
                $doc_quant = $slave->tomoney(odbc_result($r1, "quant"));
                $item_code = odbc_result($r1, "item_code");
                $item_name = odbc_result($r1, "item_name");
                if ($doc_flag == 1) {
                    $doc_price = "0.00";
                    list($p, $p, $doc_price, $p, $p) = $cat->getItemInfo($doc_item_id);
                }

                $drlist .= "
				<tr align='center' height='35' class='t14'>
					<td align='left'>&nbsp;&nbsp;$j</td>
					<td align='left'>&nbsp;&nbsp;$item_code</td>
					<td align='left'>&nbsp;&nbsp;$item_name</td>
					<td align='right'>$doc_quant</td>
					<td align='right'>$doc_price</td>
				</tr>
				<tr><td colspan='8' bgcolor='#282828' height='1'></td></tr>";
            }
            $list .= $block;

            $list = str_replace("{docrow_list}", $drlist, $list);
            $list = str_replace("{doc_id}", $doc_id, $list);

            $list .= "</td></tr>";
        }
        if ($list == "") {
            $list = "
			<tr align='left'>
				<td colspan=7 align='center'><h3>Документы оплаты не создано</h3></td>
			</tr>";
        }
        $form = str_replace("{doc_list}", $list, $form);
        $form = str_replace("{summ}", $slave->tomoney($summ), $form);
        $form = str_replace("{ost_summ}", round($ost_summ, 2), $form);
        return $form;
    }
}

?>