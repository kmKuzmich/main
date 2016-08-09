<?php
//Ётот скрипт
//1) рассылает напоминани€ клиентам из календар€ клиента (отключено)
//2) копирует за€вки клиентов отмеченные статусом =1 (не отправлена) в Lider doc docrow

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
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

$fp = fopen(RD . '/lib/odbc_errors/lider_insert.txt', 'a+');
$cStart = microtime(true);
$start = date("Y-m-d H:i:s");
fwrite($fp, "Begin cron task at : " . $start . "\r\n");
echo "Begin cron task at : \" . $start   write to  " . RD . "/lib/odbc_errors/lider_import.txt<br>";

$form_htm = RD . "/tpl/task_message.htm";
$form = "";
if (file_exists("$form_htm")) {
    $form = file_get_contents($form_htm);
}
$data = date("Y-m-d");
$time = date("H:i:s");
$time_end = date("H:i:s", strtotime("+15 minutes"));

$k = 0;
//Ёто оповещалка дл€ клиентов отключаю!
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
//        $Mail->subject = "”ведомление zakaz.avtolider-ua.com: $caption";
//
//        $Mail->message = $message;
//        $Mail->from_name = "Avtolider";
//        $Mail->SendFromMail = "no-reply@avtolider-ua.com";
//        $Mail->Send();
//        $odb->query_td("update tasks set is_mailed=1 where id='$id';");
//    }
//}
//print "k=$k";

$odb->query_lider("create variable @last_id integer ");
$odb->query_lider("insert into Local(user_id) values(-1);");
$odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY'; ");
$odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");

$data = date("Y-m-d");
$time = date("H:i:s");
//выбираем все заказы отмеченный статусом 1
$r = $odb->query_td("select oc.order_id, k.id as client_id, to_char(o.data_send,'DD-MM-YYYY') as DataLider, o.* from orders_check oc left outer join orders o on o.id=oc.order_id left outer join klient k on k.code=o.client  where oc.status=1 order by oc.order_id asc;");
$k = 0;
$m = 0;
while (odbc_fetch_row($r)) {
    $k += 1;
    $order_id = odbc_result($r, "order_id");
    $author_send = odbc_result($r, "author_send");
    $client = odbc_result($r, "client");
    $client_id = odbc_result($r, "client_id");
    $address = odbc_result($r, "address");
    $more = odbc_result($r, "more");
    $data_send = odbc_result($r, "data_send");
    $dataLider = odbc_result($r, "DataLider");
    $time_send = odbc_result($r, "time_send");
    $payment = odbc_result($r, "payment");
    $delivery = odbc_result($r, "delivery");
    $phoneperson = odbc_result($r, "phoneperson");
    $contactperson = odbc_result($r, "contactperson");
    $doc_id = odbc_result($r, "doc_id");
    $doc_num = odbc_result($r, "doc_num");
    echo $doc_id . "</br>";

    fwrite($fp, "\r\n ---------------\r\nƒл€ за€вки $doc_num order_id $order_id с doc_id=$doc_id с статусом =1 \r\n");

//дл€ всех заказов с статусом 1 в orders_check в Lider
    $r1 = $odb->query_lider("select * from doc where id='$doc_id';");
    $n = $odb->num_rows($r1);
    if (empty($n) or $n == '' or $n == 0) {
        $odb->query_lider("insert into doc (id,tm,kinddoc_id,num,opl,subconto_id) values($doc_id,'$dataLider',12,$doc_num,0,$client);");
//        echo $doc_id;
        $r1 = $odb->query_lider("select * from doc where id='$doc_id';");
        fwrite($fp, "ƒобавил doc.id в Lider \r\n");
    };
    $r1 = $odb->query_lider("select * from doc where id='$doc_id';");
//    если нет строк товара, то обновить строки товара
    $rr = $odb->query_lider("select * from docrow where doc_id='$doc_id';");
    $n = $odb->num_rows($rr);
    if (empty($n) or $n == '' or $n == 0) {
        $needUpdate = 1;
    } else {
        $needUpdate = 0;
    };
//    if (!odbc_fetch_row($r1)) {echo  "нихера не пон€л!<br>";}
//else {
//    fwrite($fp, "≈сть в Lider с doc.id $doc_id дл€ клиента с кодом $client \r\n");
//    };
    fwrite($fp, "≈сть в Lider с doc.id $doc_id дл€ клиента с кодом $client \r\n");
    while (odbc_fetch_row($r1) & $needUpdate) {
        $lid_opl = odbc_result($r1, "opl");
        $lid_subconto_id = odbc_result($r1, "subconto_id");
        $lid_sum1 = odbc_result($r1, "sum1");
        $lid_sum = odbc_result($r1, "sum");
        $lid_kinddoc_id = odbc_result($r1, "kinddoc_id");
//        echo $lid_sum." и ".$lid_sum1." и ".$doc_num;
        fwrite($fp, "с суммой $lid_sum и розницей $lid_sum1 \r\n");
        //дл€ которых sum (отп) или sum1(розн) = пусто
        //    fwrite($fp, "ƒобавил doc.id в Lider\r\n");
        if ($lid_sum == "" or $lid_sum1 == "" or $needUpdate) {
//            print "order_id=$order_id,doc_id=$doc_id; doc_num=$doc_num->($author_send,$address)<br>";
//            print "doc_id=$doc_id ($lid_opl,$lid_subconto_id,$lid_sum1,$lid_sum,$lid_kinddoc_id)<br><br>";
            //подсчитать их кол-во m
            $m += 1;
            //дл€ таких заказов перечитать строки заказов
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
                    fwrite($fp, "\r\n вставил в Lider insert into docrow (doc_id,id,price,price1,quant,item_id) values ('$doc_id','$j','$or_price','$or_price','$or_count','$or_model') \r\n");
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
            //дл€ всех за€вок с статусом 1 обновить в Lider документ, установить в нЄм признак оплаты=0  клиента сумма вид документа и прочую хрень
//            $odb->query_lider("update doc set opl=0, subconto_id='$author_send', place_id=$place_id, klient_id=$author_send, sum='$orSumm', sum1='$orSumm', day='$date', kinddoc_id=12 where id='$doc_id';");
            $odb->query_lider("update doc set opl=0, subconto_id='$client', place_id=$place_id, klient_id=$author_send, sum='$orSumm', sum1='$orSumm', day='$dataLider', kinddoc_id=12 where id='$doc_id';");
//запись в лог
            fwrite($fp, "\r\n обновл€ю Lider.doc \r\n
             update doc set opl=0, subconto_id='$client', place_id=$place_id, klient_id=$client, sum='$orSumm', sum1='$orSumm', day='$dataLider', kinddoc_id=12 where id='$doc_id'\r\n");
            //напечатать это
//            print "update doc set opl=0, subconto_id=$author_send, place_id=$place_id, klient_id=$author_send, sum='$orSumm', sum1='$orSumm', day='$date', sday='$date', kinddoc_id=12 where id='$doc_id';";
//    изменить текущий статус документа на следующий
//            $odb->query_lider("update docstates set n=n+1 where doc_id='$doc_id' and n=0;");
            $odb->query_lider("update docstates set n=n+1 where doc_id='$doc_id';");
            fwrite($fp, "\r\n »нкремент счЄтчика состо€ний документа Lider.doc \r\n
            update docstates set n=n+1 where doc_id='$doc_id'
            \r\n");

//            print "update docstates set n=n+1 where doc_id='$doc_id' and n=0;";
//    установить статус 16 как текущий
            $odb->query_lider("insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_id','0',now(),'-1','16');");
//            print "insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_id','0',now(),'-1','16');";
//        добавить докинфо

            fwrite($fp, "\r\n обновл€ю состо€ние документа 16-выданна€ web-за€вка Lider.DocStates \r\n
            insert into docstates (doc_id,n,tm,user_id,state_id) values ('$doc_id','0',now(),'-1','16')
            \r\n");
//            если docinfo нет то добавить иначе ничего
            $ra = ($odb->query_lider("select * from docinfo where doc_id=$doc_id"));
            $n = $odb->num_rows($ra);
            if (empty($n) or $n == '' or $n == 0) {
                $odb->query_lider("insert into docinfo (doc_id,tm,direction,remark,dremark,phone,contperson,typePay) values ('$doc_id',now(),'$address','$more','
" . $shop->get_table_caption("carrier", $delivery) . "','$phoneperson','$contactperson','" . $shop->get_table_caption("typepay", $payment) . "');");

                fwrite($fp, "\r\n обновл€ю Lider.DocInfo \r\n
            insert into docinfo (doc_id,tm,direction,remark,dremark,phone,contperson,typePay) values ('$doc_id',now(),'$address','$more','\" . $shop->get_table_caption(\"carrier\", $delivery) . \"','$phoneperson','$contactperson','\" . $shop->get_table_caption(\"typepay\", $payment)
            \r\n");
            }

//            print "insert into docinfo (doc_id,tm,direction,remark,dremark,phone,contperson,typePay) values ('$doc_id',now(),'$address','$more','" . $shop->get_table_caption("carrier", $delivery) . "','$phoneperson','$contactperson','" . $shop->get_table_caption("typepay", $payment) . "');";
//      добавить адрес доставки
//            если адресов с текущим нет то добавить адрес.
            $ra = $odb->query_lider("select max(n) from adresdeliv where subconto_id=$client and adres='$address'");
            $n = $odb->num_rows($ra);
            if (empty($n) or $n = 0 or $n = '') {
                $odb->query_lider("insert into adresdeliv (subconto_id,n,adres,phone,contperson,remark,carrier_id,typepay_id) values ('$client',(select max(n)+1 from adresdeliv where subconto_id=$client),'$address','$phoneperson','$contactperson','$more','$delivery','$payment');");
                fwrite($fp, "\r\n новый адрес добавл€ю јдрес доставки Lider.AdresDeliv\r\n
            insert into adresdeliv (subconto_id,n,adres,phone,contperson,remark,carrier_id,typepay_id) values ('$author_send',1,'$address','$phoneperson','$contactperson','$more','$delivery','$payment')
            \r\n");
            }
//            print "insert into adresdeliv (subconto_id,n,adres,phone,contperson,remark,carrier_id,typepay_id) values ('$author_send',1,'$address','$phoneperson','$contactperson','$more','$delivery','$payment');";
//изменить статус на 0
//            $odb->query_td("update orders_check set status=0 where order_id='$order_id';");
////    echo "$order_id <br/>";
    } else {
            echo "не обновл€ю адрес в Lider<br>";
        }
    }
    $odb->query_td("update orders_check oc set status=0 where oc.order_id='$order_id' and (select max(r.id) from orders o join docrow r on o.doc_id=r.doc_id where o.id=oc.order_id) is not null ;");
    echo "updated order_id $order_id <br>";
    $stat = odbc_result($odb->query_td("select status from orders_check where order_id = $order_id limit 1"), 1);
    fwrite($fp, "\r\n обновл€ю order check если добавлено в docrow на статус $stat \r\n
update orders_check oc set status=0 where oc.order_id='$order_id' and (select max(r.id) from orders o join docrow r on o.doc_id=r.doc_id where o.id=oc.order_id) is not null  \r\n");

}
odbc_close_all();
//print "k=$k, m=$m";
$cEnd = microtime(true);
$duration = round($cEnd - $cStart, 4);
$end = date("Y-m-d H:i:s");
fwrite($fp, "\r\n 
----
End cron task at : " . $end . " Duration : $duration sec\r\n 
\r\n
==================================================================
\r\n");
echo "<br>End cron task at : \" . $end  writed to  " . RD . "/lib/odbc_errors/lider_import.txt    Duration : $duration sec <br>";


fclose($fp);

?>