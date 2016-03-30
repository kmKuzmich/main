<!DOCTYPE html>
<html>

<header>
    <meta charset="windows-1251">
    <title>Try to search item/article on TecDoc DB2</title>

    <script type="text/javascript">
        /*
         window.onload(
         alert("Hi there")
         );
         */

        //      document.getElementsByTagName('h2');
        //        search_biartTec(28491,38);


        function search_biartTec(art, producent) {
            document.getElementById("by_producent").value = producent;
            document.getElementById("art").value = art;
            win_close();
            search_art();
            closeHistorySearchFrom();
            window.location.hash = "#search=" + art;
        }

        /*        function search_art() {
         closeHistorySearchFrom();
         startLoading();
         var art = document.getElementById("art").value;
         if (art.length <= 2) {
         showAlertForm("Введите больше символов для поиска");
         stopLoading();
         }
         if (art.length > 2) {
         var by_code = 0;
         if (document.getElementById("by_code").checked) {
         by_code = 1;
         }
         var by_sklad = 0;
         if (document.getElementById("by_sklad").checked) {
         by_sklad = 1;
         }
         var by_name = 0;
         if (document.getElementById("by_name").checked) {
         by_name = 1;
         }
         var by_producent = document.getElementById("by_producent").value;
         document.write(by_producent);*/

        /*            JsHttpRequest.query('content.php', {
         'w': 'catalogue_art_find',
         'art': art,
         'by_code': by_code,
         'by_sklad': by_sklad,
         'by_name': by_name,
         'by_producent': by_producent
         },
         function (result, errors) {
         if (errors) {
         alert(errors);
         stopLoading()
         }
         if (result) {
         document.getElementById("range_list").innerHTML = result["content"];
         stopLoading();
         fleXenv.updateScrollBars();
         fleXenv.fleXcrollMain("flexcroll");
         }
         }, true);
         }*/

    </script>

</header>

<body>
<!--<body onload="alert('Hello!')">-->

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13.03.16
 * Time: 10:23
 * This is temporary php- script for testing function TecDoc-serach
 */
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED); @ini_set('display_errors', true);
//$_SERVER['DOCUMENT_ROOT'] - переменная указывающая на корень файловой системы
//Константа __FILE__ содержит имя текущего исполняемого файла.
define("RD", dirname(__FILE__));
//echo RD."/odbc_class.php <br>";
require_once(RD . "/odbc_class.php");
require_once(RD . "/config_class.php");
require_once(RD . "/slave_class.php");
require_once(RD . "/kours_class.php");
$slave = new slave;

include_once RD . '/shop_class.php';
$shop = new shop;
include_once RD . '/catalogue_class.php';
$cat = new catalogue;
//require_once(RD . "../js/JsHttpRequest/JsHttpRequest.php");
//$JsHttpRequest =& new JsHttpRequest("windows-1251");
//session_start();


$odb = new odb;

//Почти обычный поиск по коду
$art = "07200";

$by_producent = '';
echo "<h2> поиск по коду " . $art . "</h2>";

$art = trim($art);
$art = mb_convert_case($art, MB_CASE_LOWER, "CP1251"); //kuzya  22.05.2015

$where = "(scode LIKE '$art%') ";
$where2 = "";
if ($by_producent != "") {
    $where2 = " and prod_id=$by_producent ";
}
$exclude = " and prod_id not in (1134) and nvl( bitand(sign,2),0)=0";

$query = "select * from item where ($where) $where2 $exclude order by id asc;";

echo "Запрос поиска $query <br />";

$r = $odb->query_td($query);
$n = 0;

echo "<table border='1'>";
while (odbc_fetch_row($r)) {
    echo "<tr>";
    echo "<td>" . odbc_result($r, 1) . "</td>";
    echo "<td>" . odbc_result($r, 2) . "</td>";
    echo "<td>" . odbc_result($r, 3) . "</td>";
    echo "<td>" . odbc_result($r, 4) . "</td>";
    echo "<td>" . odbc_result($r, 5) . "</td>";
    echo "<td>" . odbc_result($r, 6) . "</td>";
    echo "<td>" . odbc_result($r, 7) . "</td>";
    echo "<td>" . odbc_result($r, 8) . "</td>";
    echo "<td>" . odbc_result($r, 'prod_id') . "</td>";
    echo "</tr>";
    $n++;
}
echo "<table>";

echo "кол-во строк в запросе " . $n . "<br />";
echo '<hr>';
//поиск по TecDoc

$art = "1k0407365e";
$art = "300 312 2104";
echo "<h2> поиск по коду " . $art . "</h2>";

// i.id,i.scode as item_code,i.name,i.prod_id as prod_id,p.name,i.pricepro,getprice(i.id),getquant(i.id)
$query = "Select *
        from (select unique StripSpaces(P.code) as code,
            P.brand_id as prod_id1
            from carProductLookup L
            join carProduct P on P.id=L.product_id
          where scode=upper( StripSpaces( '$art' )) ) T
        left outer join tdBrand B on B.brand_id=T.prod_id1
        left outer join Producent P on P.id=B.prod_id
        left outer join Item I on I.scode=T.code and I.prod_id=P.id
        where I.id is not null; ";


$r = $odb->query_td($query);
//$n=$odb->num_rows($r);
$n = 0;

echo "<table border='1'>";
while (odbc_fetch_row($r)) {
    echo "<tr>";
    echo "<td>" . odbc_result($r, 1) . "</td>";
    echo "<td>" . odbc_result($r, 2) . "</td>";
    echo "<td>" . odbc_result($r, 3) . "</td>";
    echo "<td>" . odbc_result($r, 4) . "</td>";
    echo "<td>" . odbc_result($r, 5) . "</td>";
    echo "<td>" . odbc_result($r, 6) . "</td>";
    echo "<td>" . odbc_result($r, 7) . "</td>";
    echo "<td>" . odbc_result($r, 8) . "</td>";
    echo "</tr>";
    $n++;
}
echo "<table>";

echo "кол-во строк в запросе " . $n . "<br />";
echo '<hr>';
//Дальше надо как то вывести список производителей
$r = $odb->query_td($query);
$list = "";

$form_htm = RD . "../tpl/catalogue_items_list.htm";
if (file_exists("$form_htm")) {
    $form = file_get_contents($form_htm);
}

//Если результат поисков больше 1 строк и пр-ль не выбран
if ($n > 1 and $by_producent == "") {
    $kt = -1;
    $k = 0;
    while (odbc_fetch_row($r)) {
        $prm = 0;
        $k += 1;
        $prod_id = odbc_result($r, "prod_id");
        $proda[$k] = $prod_id;
        $item_code = odbc_result($r, "item_code");
        $item_art[$k] = $item_code;
    }
//    создание массива с ключами и соотв им значений из 2-х массивов
//    таким образом создаю пару значений пр-ль + артикул
    $prod_arr = array_combine($proda, $item_art);

    //Вывод табов производителей
//    foreach ($proda as $prod_id) {
//        echo $prod_id.'=1<br />';
// };

//вывод пар ключей вариант 2 более интересный
    reset($prod_arr); //сбрасываем указатель массива
    while (current($prod_arr)) { //пока массив не закончился
        echo 'производитель = ' . key($prod_arr) . ' артикул =' . $prod_arr[key($prod_arr)] . '<br/>'; //выводим ключ массива + значение ключа массива
        next($prod_arr); //смещаем указатель
    };
//    $form=showProducentTabs($proda,$item_art);
//    echo showProducentTabs_art($prod_arr);
    if (!session_start()) session_start();
    echo $cat->catalogue_art_find('28491', '1', '', '', '38');
//        '28491',
//        '1',
//        '0',
//        '0',
//        '38');
//catalogue_art_find($art,
//      $by_code,
//      $by_sklad,
//      $by_name,
//      $by_producent)
}

function showProducentTabs_art($prod_arr)
{
    $odb = new odb;
    $where = "";
    if ($prod_arr != '') {
        reset($prod_arr);
        while (current($prod_arr)) {
            $prod_id = key($prod_arr);
            $where = "id=$prod_id";
            $query = "select * from producent where $where";
            $r = $odb->query_td($query);
            while (odbc_fetch_row($r)) {
                $id = odbc_result($r, "id");
                $name = odbc_result($r, "name");
                $list .= "<div class='ProducentTab' onclick=
                'search_biproducent_art(\"$id,$prod_arr[$prod_id]\")'>
                <a href='#$name' onclick='search_biartTec(\"$prod_arr[$prod_id],$id\")'>$name</a></div>";
            }
            next($prod_arr);
        }
        return $list;

    }

}

;


function showProducentTabs($proda, $item_art)
{
    $odb = new odb;
    $where = "";
    if ($proda != "") {
        $form_htm = RD . "../tpl/catalogue_producent_list.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        foreach ($proda as $prod_id) {
            $where .= " or id='$prod_id' ";
        }
        if ($where != "") {
            $where = " where " . substr($where, 3);
            $query = "SELECT * FROM producent $where order by name;";
            $r = $odb->query_td($query);
            while (odbc_fetch_row($r)) {
                $id = odbc_result($r, "id");
                $name = odbc_result($r, "name");
                $list .= "<div class='ProducentTab' onclick='search_biproducent(\"$id\")'><a href='#$name' onclick='search_biproducent(\"$id\")'>$name</a></div>";
            }
        }
        $form = str_replace("{list}", $list, $form);
    }
    return $form;
}

?>


</body>
</html>