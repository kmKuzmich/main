<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', false);
define('RD', dirname(__FILE__));
$content = null;
require_once(RD . "/lib/odbc_class.php");
$odb = new odb;
require_once(RD . "/lib/config_class.php");
require_once(RD . "/lib/slave_class.php");
$slave = new slave;
require_once(RD . "/lib/menu_class.php");
require_once(RD . "/lib/client_class.php");
$cl = new client;
require_once(RD . "/lib/shop_class.php");
$shop = new shop;
require_once(RD . "/lib/task_class.php");

$form_htm = RD . "/tpl/task_message.htm";
$form = "";
if (file_exists("$form_htm")) {
    $form = file_get_contents($form_htm);
}
$data = date("Y-m-d");
$time = date("H:i:s");
$time_end = date("H:i:s", strtotime("+15 minutes"));

$k = 0;
//Это оповещалка для клиентов отключаю!
//$r = $odb->query_td("select * from tasks where data='$data' and time_end>='$time' and time_end<='$time_end' and is_mailed=0 order by id asc;");
//while (odbc_fetch_row($r)) {
//    $k += 1;
//    $id = odbc_result($r, "id");
//    $client = odbc_result($r, "client");
//    $caption = odbc_result($r, "caption");
//    $data_end = odbc_result($r, "data_end") . " " . odbc_result($r, "time_end");
//    $email = odbc_result($r, "email");
//    $desc = odbc_result($r, "desc");
//    if ($email != "") {
//        $name = $cl->get_client_name($client);
//        $message = $form;
//        $message = str_replace("{name}", $name, $message);
//        $message = str_replace("{email}", $email, $message);
//        $message = str_replace("{caption}", $caption, $message);
//        $message = str_replace("{desc}", $desc, $message);
//        $message = str_replace("{data_end}", $data_end, $message);
//
//        include_once RD . "/mail/sendmail.class.php";
//        $Mail = new sendmail();
//        $Mail->mail_to = "$name <$email>";
//        $Mail->subject = "Уведомление zakaz.avtolider-ua.com: $caption";
//
//        $Mail->message = $message;
//        $Mail->from_name = "Avtolider";
//        $Mail->SendFromMail = "no-reply@avtolider-ua.com";
//        $Mail->Send();
//        $odb->query_td("update tasks set is_mailed=1 where id='$id';");
//    }
//}
print "k=$k";

$odb->query_lider("create variable @last_id integer ");
$odb->query_lider("insert into Local(user_id) values(-1);");
$odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY'; ");
$odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");

$data = date("Y-m-d");
$time = date("H:i:s");
//выбираем все заказы отмеченный статусом 1
$r = $odb->query_td("select oc.order_id, o.* from orders_check oc left outer join orders o on o.id=oc.order_id where oc.status=1 order by oc.order_id asc;");
$k = 0;
$m = 0;
while (odbc_fetch_row($r)) {
    $k += 1;
    $order_id = odbc_result($r, "order_id");
    $author_send = odbc_result($r, "author_send");
    $client = odbc_result($r, "author");
    $address = odbc_result($r, "address");
    $more = odbc_result($r, "more");
    $data_send = odbc_result($r, "data_send");
    $time_send = odbc_result($r, "time_send");
    $payment = odbc_result($r, "payment");
    $delivery = odbc_result($r, "delivery");
    $phoneperson = odbc_result($r, "phoneperson");
    $contactperson = odbc_result($r, "contactperson");
    $doc_id = odbc_result($r, "doc_id");
    $doc_num = odbc_result($r, "doc_num");

//для всех заказов с статусом 1 в Lider
    $r1 = $odb->query_lider("select * from doc where id='$doc_id';");
    while (odbc_fetch_row($r1)) {
        $lid_opl = odbc_result($r1, "opl");
        $lid_subconto_id = odbc_result($r1, "subconto_id");
        $lid_sum1 = odbc_result($r1, "sum1");
        $lid_sum = odbc_result($r1, "sum");
        $lid_kinddoc_id = odbc_result($r1, "kinddoc_id");
//для которых sum (отп) или sum1(розн) = пусто
        if ($lid_sum == "" or $lid_sum1 == "") {
            print "order_id=$order_id,doc_id=$doc_id; doc_num=$doc_num->($author_send,$address)<br>";
            print "doc_id=$doc_id ($lid_opl,$lid_subconto_id,$lid_sum1,$lid_sum,$lid_kinddoc_id)<br><br>";
            //подсчитать их кол-во m
            $m += 1;
            //для таких заказов перечитать строки заказов
            $r2 = $odb->query_td("select * from orders_str where order_id='$order_id';");
            $orSumm = 0;
            $j = 0;
            while (odbc_fetch_row($r2)) {
                $j++;
                if (odbc_result($r2, "quant") > 0) {
                    $or_id = odbc_result($r2, "id");
                    $or_model = odbc_result($r2, "item_id");
                    $or_code = odbc_result($r2, "code");
                    $or_caption = odbc_result($r2, "name");
                    $or_count = $slave->int_to_money(odbc_result($r2, "quant"));
                    $or_price = $slave->int_to_money(odbc_result($r2, "price"));
                    $or_summ = $slave->int_to_money(odbc_result($r2, "summ"));
                    $orSumm += $or_summ;
                    //и все эти строки скопировать в Lider
                    $odb->query_lider("insert into docrow (doc_id,id,price,price1,quant,item_id) values ('$doc_id','$j','$or_price','$or_price','$or_count','$or_model');");
                }
            }

            $orSumm = $slave->int_to_money($orSumm);
            //выбрать отдел клиента
            $r2 = $odb->query_td("select place_id from subconto where id='$client';");
            while (odbc_fetch_row($r2)) {
                $place_id = odbc_result($r2, "place_id");
            }
            //если отдел пусто установить его оптовый =23
            if ($place_id == "" or $place_id == 0) {
                $place_id = 23;
            }
            //для всех заявок с статусом 1 обновить в Lider документ, установить в нём признак оплаты=0  клиента сумма вид документа и прочую хрень
            $odb->query_lider("update doc set opl=0, subconto_id='$author_send', place_id=$place_id, klient_id=$author_send, sum='$orSumm', sum1='$orSumm', day='$date', kinddoc_id=12 where id='$doc_id';");
            //напечатать это
            print "update doc set opl=0, subconto_id=$author_send, place_id=$place_id, klient_id=$author_send, sum='$orSumm', sum1='$orSumm', day='$date', sday='$date', kinddoc_id=12 where id='$doc_id';";
//    изменить текущий статус документа на следующий
            $odb->query_lider("update docstates set n=n+1 where doc_id='$doc_id' and n=0;");
            print "update docstates set n=n+1 where doc_id='$doc_id' and n=0;";
//    установить статус 16 как текущий
            $odb->query_lider("insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_id','0',now(),'-1','16');");
            print "insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_id','0',now(),'-1','16');";
//        добавить докинфо
            $odb->query_lider("insert into docinfo (doc_id,tm,direction,remark,dremark,phone,contperson,typePay) values ('$doc_id',now(),'$address','$more','" . $shop->get_table_caption("carrier", $delivery) . "','$phoneperson','$contactperson','" . $shop->get_table_caption("typepay", $payment) . "');");
            print "insert into docinfo (doc_id,tm,direction,remark,dremark,phone,contperson,typePay) values ('$doc_id',now(),'$address','$more','" . $shop->get_table_caption("carrier", $delivery) . "','$phoneperson','$contactperson','" . $shop->get_table_caption("typepay", $payment) . "');";
//      добавить адрес доставки
            $odb->query_lider("insert into adresdeliv (subconto_id,n,adres,phone,contperson,remark,carrier_id,typepay_id) values ('$author_send',1,'$address','$phoneperson','$contactperson','$more','$delivery','$payment');");
            print "insert into adresdeliv (subconto_id,n,adres,phone,contperson,remark,carrier_id,typepay_id) values ('$author_send',1,'$address','$phoneperson','$contactperson','$more','$delivery','$payment');";
        }
//изменить статус на 0
        $odb->query_td("update orders_check set status=0 where order_id='$order_id';");
    }
}
odbc_close_all();
print "k=$k, m=$m";

?>