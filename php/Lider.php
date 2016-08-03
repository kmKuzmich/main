<?php
$start_php = date('r');
$start = microtime(true);
ini_set('max_execution_time', 300);

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@ini_set('display_errors', true);
define('RD', dirname(__FILE__));
$content = null;
$j = 0;
$e = 0;
require_once('c:/Avtolider-Shop/lib/odbc_class.php');
$odb = new odb;
$odb->query_lider("create variable @last_id integer ");
$odb->query_lider("insert into Local(user_id) values(-9);");
$odb->query_lider("SET OPTION DATE_ORDER = 'DMY';");
$odb->query_lider("SET OPTION DATE_FORMAT = 'DD-MM-YYYY';");
$odb->query_lider("SET OPTION Timestamp_format = 'DD-MM-YYYY HH:NN:SS.SSS';");

//$kk=$odb->query_lider("select @priceKoef");
//if (!$kk) $odb->query_lider("create variable @priceKoef numeric(12,2)");

$odb->query_lider("create variable @priceKoef numeric(12,2)");
$odb->query_lider("set @priceKoef=1");

$dbHost = '192.168.0.1';
$dbName = 'catalog_tecdoc_2015q1';
$dbUser = 'ssd-test-user';
$dbPass = 'g4cxPbtryf4G5GNq';

$myConnect = mysql_connect($dbHost, $dbUser, $dbPass);
mysql_select_db($dbName, $myConnect);
mysql_query("set names utf8");

$r1 = $odb->query_lider("select value from GlobalVar where name='@ListPlaceKM'");
$KM = odbc_result($r1, "value");
$r1 = $odb->query_lider("select list(id) as l_id from place where code in (" . $KM . ")");
$KM = odbc_result($r1, "l_id");

/*$r1=$odb->query_lider("select value from GlobalVar where name='@ListPlaceExpr'"); 
$Expr=odbc_result($r1,"value");
*/
$Expr = 56; // Склад ТОВ "Пежо Сітроен Україна" м.Київ
$r1 = $odb->query_lider("select list(id) as l_id from place where code in (" . $Expr . ")");
$Expr = odbc_result($r1, "l_id");
//$Expr=0; //Выполнить запрос выше, для выгрузки STOCK-складов


//select 1 подготавливаем #s - наличие
//select 2,3 подготавливаем #1 - таблица с ценами: item_id,S.group_id,price грн,  
//select 4 подготавливаем #p - это сгрупироанная #1 и отдельно колонки с ценами по группам item_id,p14,p58,p20,p30
//создаём индекс для #p(item_id) шобы было быстрише

$start_select = microtime(true);

$odb->query_lider("Select S.item_id,
        cast( sum( case when SubConto_id in (" . $KM . ") then quant end ) as numeric(12,2)) sKm,
        cast( sum( case when SubConto_id in (" . $Expr . ") then quant end ) as numeric(12,2)) sExpr into #s
from Store S Join Item I on S.item_id=I.id
where kind=1
and i.cat_id not in (50,55,126,675) // Исключить из выгрузки ( Каталоги, Реклама, Диагн. оборудование, Castrol Professional)
and i.prod_id not in (1134) // Бракованные изделия
group by S.item_id
having (isnull(sKm,0)>=1 or isnull(sExpr,0)>0)");

// Этот запрос выбирает в #1 цены и выполняется в 3раза быстрее чем следующий 33сек vs 96сек, 
// 20.04.2016 добавлена выборка из таблицы фиксированных цен PriceF

$odb->query_lider("
select I.id as item_id,
     S.group_id,
     GetPriceP(isnull(S.skid,0),isnull(S.profit,0),isnull(S.koef,0),
       I.pricePro,I.aPricePro,
        isnull( I.vpriceZak*V.kurs,I.priceZak,0),
        I.priceZakV)  as priceA,
        L.price as priceF,
       (If PriceA>isnull(PriceF,0) then PriceA else PriceF endif) as price into #1
      from #s T
        left outer join Item I on I.id=T.item_id
        left outer join Discounts as S on S.discount_id=I.discount_id
        left outer join Valuta V on V.id=I.val_id
        left outer join PriceList as L on L.item_id=I.id
        left outer join PriceListGroup as LK on LK.PriceList_id=L.PriceList_id and LK.group_id=S.group_id
		
      where S.group_id in (180)");


/* Этот запрос выбирает в #1 цены и выполняется в 3раза дольше чем предыдущий 96сек vs 33сек
$odb->query_lider("
select I.id as item_id,
     S.group_id,
	 GetPrice(item_id,null,S.group_id)  as price into #1
      from #s T
        left outer join Item I on I.id=T.item_id
        left outer join Discounts as S on S.discount_id=I.discount_id
      where S.group_id in (180)");
*/
$odb->query_lider("
Select item_id,
     cast( max(case when group_id=180 then price end) as numeric (12,2)) as p180,
     cast( max(case when group_id=61 then price end) as numeric (12,2)) as p61,
     cast( max(case when group_id=20 then price end) as numeric (12,2)) as p20,
     cast( max(case when group_id=18 then price end) as numeric (12,2)) as p18 into #p
from #1
group by item_id");

$odb->query_lider("create index p1 on #p(item_id)");

$r = $odb->query_lider("
select S.item_id,
        I.sCode sCode,
        I.code code,
        I.prod_id prod_id,
		I.name,
        P.tdid td_id,
        T.p180 price1,
        T.p61 price2,
        T.p20 price3,
        T.p18 price4,
        TD.td_id atd_id,
        TD.code asCode,
		null action,
		null aprice,
        S.sKm,
        S.sExpr
from #s S
 left outer join #p T on T.item_id=S.item_id
 left outer join Item I on I.id=S.item_id
 left outer join Producent P
 left outer join ItemTD TD on TD.item_id=S.item_id and P.tdid is null
  ");
$time_select = microtime(true) - $start_select;


/*
* Выбираем нужную таблицу для insert
*/
$row = mysql_query("select value from store_setting where name like '%active_table%'");
while ($rows = mysql_fetch_row($row)) {
    $active = $rows[0];
}
if ($active == 'store_a') {
    $load = 'store_b';
} else {
    $load = 'store_a';
}
//================================


/*
* Get all shorts names
*/
$f = mysql_query("
SELECT * FROM al_short");
while ($row = mysql_fetch_array($f, MYSQL_ASSOC)) {

    $_SHORTS[$row['short']] = array(
        'brand_id' => $row['brand_id'],
        'long' => $row['long']
    );
}
//================================


/*
* Get all action item
*/
$h = $odb->query_lider("select ai.item_id,ai.action_id,price from actionrow ar join action on id=ar.action_id
join actionitem ai on ai.action_id=id 
where status=2");
while (odbc_fetch_row($h)) {
    $_ACTION[odbc_result($h, "item_id")] = array(
        'action_id' => odbc_result($h, "action_id"),
        'price' => odbc_result($h, "price")
    );
}
//================================


/*
* Определяем флаг активной акции
*/
$f = mysql_query("SELECT special.value as code, flag.value as flag 
FROM modx_site_content as content
left join modx_site_tmplvar_contentvalues  as special on (special.tmplvarid= 31 and content.id = special.contentid )
left join modx_site_tmplvar_contentvalues as flag    on (flag.tmplvarid= 30 and content.id = flag.contentid )
left join modx_site_tmplvar_contentvalues  as start on (start.tmplvarid= 32 and content.id = start.contentid )
left join modx_site_tmplvar_contentvalues  as end on (end.tmplvarid= 33 and content.id = end.contentid )
where content.template = 25 and UNIX_TIMESTAMP(NOW())  between UNIX_TIMESTAMP( STR_TO_DATE(start.value , '%d-%m-%Y %H:%i:%s')) and UNIX_TIMESTAMP( STR_TO_DATE(end.value , '%d-%m-%Y %H:%i:%s'))");

while ($row = mysql_fetch_row($f)) {
    $special_offers[$row[0]] = $row[1];
}
//================================


/*
* Очищаем нужную таблицу 
*/
mysql_query("TRUNCATE TABLE $load");
//================================


$start_insert = microtime(true);
while (odbc_fetch_row($r)) {
    $set['item_id'] = odbc_result($r, "Item_id"); # ID LIDER
    $set['code'] = mysql_escape_string(str_replace('  ', ' ', iconv('cp1251', 'UTF-8', odbc_result($r, "code")))); # CODE LIDER
    $set['quant'] = odbc_result($r, "sKm");
    $set['quant_ext'] = odbc_result($r, "sExpr");
    $set['price'] = odbc_result($r, "price1");
    $set['price_discount1'] = odbc_result($r, "price2");
    $set['price_discount2'] = odbc_result($r, "price3");
    $set['price_discount3'] = odbc_result($r, "price4");
    $set['special_offer_flag'] = $special_offers[$_ACTION[$set['item_id']]['action_id']];
    $set['special_offer_id'] = $_ACTION[$set['item_id']]['action_id'];
    if ($set['special_offer_flag'] != 2) {
        $set['special_offer_price'] = $_ACTION[$set['item_id']]['price'];
    }
    $set['search_code'] = mysql_escape_string(str_replace('  ', ' ', iconv('cp1251', 'UTF-8', odbc_result($r, "scode"))));
    $set['cross_code'] = mysql_escape_string(str_replace('  ', ' ', iconv('cp1251', 'UTF-8', odbc_result($r, "ascode"))));
    $set['brand_id'] = odbc_result($r, "td_id");
    $set['cross_brand_id'] = odbc_result($r, "atd_id");

    /*
    * Наименование LIDER
    */
    $content = odbc_result($r, "name");
    $content = iconv(mb_detect_encoding($content, mb_detect_order(), true), "UTF-8", $content);
    $content = str_replace('.', '. ', $content);
    $content = str_replace(',', ', ', $content);
    $content = str_replace(';', '; ', $content);
    $content = str_replace('+', ' + ', $content);
    $content = mysql_escape_string(str_replace('  ', ' ', $content));
    $set['content'] = $content;

    /*
    * Позиции нет в TECDOC или она не ссылаеться на позицию из TECDOC;
    */
    if (!empty($set['cross_code']) or $set['brand_id'] == 0) {
        $Lider_search = $set['search_code'];
        $set['search_code'] = $set['cross_code'];
        $set['cross_code'] = $Lider_search;
        $set['brand_id'] = $set['cross_brand_id'];
        $set['cross_brand_id'] = odbc_result($r, "prod_id");
    }

    /*
    *   Короткий - длинный код по MAGNETI MARELLI
    */
    if (!empty($_SHORTS[$set['code']]) && $_SHORTS[$set['code']]['brand_id'] == $set['brand_id']) {
        $set['cross_code'] = $set['search_code'];
        $set['search_code'] = $_SHORTS[$set['code']]['long'];
        //echo 'Short code :'.$set['cross_code'].', long code: '.$_SHORTS[ $set['code'] ]['long'].'<br/>';
        unset($set['cross_brand_id']);
    }

    /*
    * Example INSERT
    */

    $_QUERY = "INSERT into $load  SET  " . getSetVAlues($set);
    if (!mysql_query($_QUERY)) {
        echo "Error inserting item_id: " . $set['item_id'] . "<br/>";
        $e++;//.PHP_EOL;
    } else {
        $j++;
    }

}

$time_insert = microtime(true) - $start_insert;

mysql_query("UPDATE store_setting SET value='$load', errors=$e where name like '%active_table%'"); # Указываем актуальную таблицу

if (!$myConnect) {
    die('Could not connect: ' . mysql_error());
}
mysql_close($myConnect);
odbc_close_all();
$time = microtime(true) - $start;

//printf('Время выполнения запроса %.4F сек. <br>', $time_select); 
//printf('Время записи в БД MySQL %.4F сек. <br>', $time_insert);
//printf('Скрипт выполнялся %.4F сек.', $time);

$log = file_get_contents('c:\Avtolider-Shop\triger\log.txt');
if ($e == 0) {
    $string = $start_php . ' Запрос выполнялся: ' . round($time_select, 4) . ' сек; Запись в БД MySQL: ' . round($time_insert, 4) . ' сек; Скрипт выполнялся: ' . round($time, 4) . ' сек; Количество записаных строк: ' . $j . ' в таблицу - ' . $load;
} else {
    $string = $start_php . ' Запрос выполнялся: ' . round($time_select, 4) . ' сек; Запись в БД MySQL: ' . round($time_insert, 4) . ' сек; Скрипт выполнялся: ' . round($time, 4) . ' сек; Количество записаных строк: ' . $j . ' в таблицу - ' . $load . ', ошибок записи: ' . $e;
}
$mytext = $string . "\r\n" . $log;
$fp = fopen("c:\\Avtolider-Shop\\triger\\log.txt", "w");
fwrite($fp, $mytext);
fclose($fp);

function getSetValues($params)
{
    foreach ($params as $key => $value) {
        $set[] = $key . '="' . $value . '"';
    }
    return implode(' , ', (array)$set);
}

?>