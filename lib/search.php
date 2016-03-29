<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 27.03.2016
 * Time: 9:09
 */

require_once('odbc_class.php');
require_once('slave_class.php');


//function get_art(){ if ($_POST["art"]==""){return $_GET["art"];} if ($_POST["art"]!=""){return $_POST["art"];} }
$by_producent = "38";
$art = "28491";
$n = 16;
session_start();
$odb = new odb;  //класс по раоте с БД
$slave = new slave; //это класс для обработки стринг
$dep = "23"; //обычно $dep это какой то пункт в меню либо навишация.

if (!$_SESSION["client"]) $_SESSION["client"] = 7973;
$client_id = $_SESSION["client"];

function getItemPrice2($item_id)
{
    session_start();
    $odb = new odb;
    $slave = new slave;
    session_start();
    $client_id = $_SESSION["client"];
    $r = $odb->query_td("select getprice(id,'$client_id') from item where id='$item_id';");
    odbc_fetch_row($r);
    $price = $slave->tomoney(odbc_result($r, 1));
    return $price;
}

function getSkladIDS()
{
    $odb = new odb;
    $r = $odb->query_td("SELECT name,value FROM globalvar where name='@ListPlaceExpr' or name='@ListPlaceKm';");
    while (odbc_fetch_row($r)) {
        $name = odbc_result($r, "name");
        $value = odbc_result($r, "value");
        if ($name == "@ListPlaceExpr") {
            $listPlaceExpr = $value;
        }
        if ($name == "@ListPlaceKm") {
            $listPlaceKm = $value;
        }
    }
    return array($listPlaceExpr, $listPlaceKm);
}

function getItemQuant($item_id)
{
    session_start();
    $odb = new odb;
    $quant = 0;
    $quant1 = 0;
    list($listPlaceExpr, $listPlaceKm) = getSkladIDS();
    $r = $odb->query_td("SELECT sum( S.quant ) AS kol FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id) WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '1' and SC.code in($listPlaceKm) GROUP BY S.SubConto_id;");
    while (odbc_fetch_row($r)) {
        $quant += odbc_result($r, "kol");
    }
    $r = $odb->query_td("SELECT sum( S.quant ) AS kol FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id) WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '2' and SC.code in($listPlaceKm) GROUP BY S.SubConto_id;");
    while (odbc_fetch_row($r)) {
        $quant_r += odbc_result($r, "kol");
        $quant -= $quant_r;
    }
    $r = $odb->query_td("SELECT sum( S.quant ) AS kol FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id) WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '4' and SC.code in($listPlaceKm) GROUP BY S.SubConto_id;");
    while (odbc_fetch_row($r)) {
        $quant_p = odbc_result($r, "kol");
    }
    if ($quant == 0) {
        $quant_res = "";
    }
    if ($quant >= 1 and $quant <= 10) {
        $quant_res = $quant;
    }
    if ($quant > 10) {
        $quant_res = ">10";
    }
    $r = $odb->query_td("SELECT sum( S.quant ) AS kol FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id) WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '1' and SC.code in($listPlaceExpr) GROUP BY S.SubConto_id;");
    while (odbc_fetch_row($r)) {
        $quant1 += odbc_result($r, "kol");
    }
    if ($quant1 == 0) {
        $quant1_res = "";
    }
    if ($quant1 >= 1 and $quant1 <= 10) {
        $quant1_res = $quant1;
    }
    if ($quant1 > 10) {
        $quant1_res = ">10";
    }
    return array($quant_res, $quant1_res, $quant_r, $quant_p);
}

function showProducentList($proda)
{
    $odb = new odb;
    $where = "";
    if ($proda != "") {
        foreach ($proda as $prod_id) {
            $where .= " or id='$prod_id' ";
        }
        if ($where != "") {
            $where = " where " . substr($where, 3);
            $r = $odb->query_td("SELECT * FROM producent $where order by name limit 0,10");
            while (odbc_fetch_row($r)) {
                $id = odbc_result($r, "id");
                $name = odbc_result($r, "name");
                $list .= "<a href='#$name' onclick='search_biproducent(\"$id\")'>$name</a> &nbsp;";
                if ($i < $n) {
                    $list .= ", ";
                }
            }
        }
    }
    return $list;
}

echo '<h1> ID клиента ' . $client_id . ' </h1><br />';
//избавляемся от лишних пробелов в искомой строке
$art = trim($art);
//приводим в нижний регистр в кодировке win-1251
$art = mb_convert_case($art, MB_CASE_LOWER, "CP1251"); //kuzya  22.05.2015
//удаляем кавычки и аппостроф и ещё раз избавляемся от пробелов
$art = str_replace(array('"', "'"), "", trim($art));
print "Артикул $art <br/>";

$query = "
        select * 
        from (select unique StripSpaces(P.code) as code,
            P.brand_id as prod_id1
            from carProductLookup L
            join carProduct P on P.id=L.product_id
            where scode=upper( StripSpaces( '$art' )) ) T
        left outer join tdBrand B on B.brand_id=T.prod_id1
        left outer join Producent P on P.id=B.prod_id
        left outer join Item I on I.scode=T.code and I.prod_id=P.id
        where I.id is not null;
        ";
$r = $odb->query_td($query);
//кол-во строк в результате поиска - определяет как будет выводится список
$n = $odb->num_rows($r);

$list = "";

//Путь к стандартному шаблону списка товаров
$form_htm = "../tpl/catalogue_items_list.htm";
//если найдено >16 строк читаем другую форму
if ($n > 16 and $by_producent != "") {
    $form_htm = RD . "../tpl/catalogue_items1_list.htm";
}
//Читаем форму из шаблона в переменную $form
$form = file_get_contents($form_htm);
//выполняем запрос
while (odbc_fetch_row($r)) {
    $style = "";
    $id = odbc_result($r, "id");
    $code = odbc_result($r, "code");
//    если длинна кода >11 символов устанавливаем меньший шрифт
    if (strlen($code) > 11) {
        $style = " style='font-size:12px;' ";
    }
//@ToDo    вот здесь надо подумать как выводить по item_id
// сейчас формируем строку табов для выбора артикула
// странно, потому что здесь надо выводить уже список товаров, но видимо если найденных артикулов багацько, то будем выводить список табов...
// в общем эту хрень наверняка надо убрать...
    $list .= "<div class='ItemsTab' onclick='location.href=\"#search=$code\"'><a href='#search=$code' $style>$code</a></div>";

// если найдено >=23 артикула то ничего не выводим
    if ($i == 24) {
        $i = $n + 1;
        $list .= "<h3 style='color:red'>Результат поиска больше выведенного списка - конкретизируйте поиск</h3>";
    }
}
//заменяем  в шаблоне переменную list
$form = str_replace("{list}", $list, $form);


//Если результат поисков больше 16 строк и выбран пр-ль , готовим вывод результата поиска с аналогами

//Если результат поисков больше 16 строк и НЕ выбран пр-ль и искали  по наименованию, готовим вывод результата
if ($n > 16 and $by_producent != "") {
    $n = 16;
}
//Результат есть и не больше 16 строк - выводим список
if (($n > 0 and $n <= 16)) {
    $kt = -1;  //непонятно
    $k = 0; //непонятно
    $i = 1; //для массива производителей $proda[$i]
    while (odbc_fetch_row($r)) {
        $prm = 0; //?
        $price1 = "";
        $i++; //i=2?  почему то начинается с 2-го элемента, видимо в 0 и 1 какие то константы???
        $icon_flag = ""; //?
        $id = odbc_result($r, "id");
        $code = odbc_result($r, "code");
        $scode = odbc_result($r, "scode"); //зачем?
        $name = odbc_result($r, "name");
        $name = wordwrap($name, 45, '&shy;', true);//перенос строки по указанному кол-ву символов
        $flag = odbc_result($r, "flag"); //для иконки
        $help = odbc_result($r, "help"); //зачем?
        $prod_id = odbc_result($r, "prod_id");
        $proda[$i] = $prod_id; //массив Производителей
//                если производитель пусто, то то сохранить в переменную $producent текущего пр-ля ??? не пойму зачем
        if ($by_producent == "") {
            $producent = $prod_id;
        }

//@todo в этом месте второй раз в этой функции происходила запись в историю поисков $this->saveArtSearch($art, $by_name, $producent);

        $price_client = getItemPrice2($id);

        $isImage = odbc_result($r, "isImage"); //Признак - есть фото
//                ссылка на фото
        $img = "<a href='javascript:showItemPhoto(\"" . strtoupper($id) . "\")'><img src='theme/images/photo_icon.png' border='0' alt='Фото' title='Фото'></a>";
        //наличие
        list($quant, $quant1, $quant_r, $quant_p) = getItemQuant($id);
        $quant_r_img = ""; //это непонятно зачем...
//                если есть наличие в резерве - делаем ссылку на то чтоб просмотреть наличие по складам
        if ($quant_r > 0) {
            $quant_r_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_reserv_icon.png' border='0' alt='Товар в резерв' title='Товар в резерв' align='middle' hspace='2'></a>";
        }
        $quant_p_img = "";
//                если есть - приход рисуем ссылку
        if ($quant_p > 0) {
            $quant_p_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_prihod_icon.png' border='0' alt='Товар в приходе' title='Товар в приходе' align='middle' hspace='2'></a>";
        }
        $add_busket = "";
        $add_busket = "<a href='javascript:show_busket_form(\"$id\")'><img src='theme/images/add_icon.png' border='0' alt='Добавить в заказ' title='Добавить в заказ'></a>";
//					if (($flag==1)|($flag==2)|($flag==5)){	$icon_flag="<img src='theme/images/best_price_icon.png' border='0' alt='СуперЦена' class='icon_button' onmouseover=\"tooltip.pop(this, '#d$id"."_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='d$id"."_tip'>$help</div></div>";	}
        if ($flag == 7) {
            $icon_flag = "<img src='theme/images/action_icon.png' border='0' alt='Акция' class='icon_button' onmouseover=\"tooltip.pop(this, '#a$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='a$id" . "_tip'>$help</div></div> onclick='showItemActionRemark(\"$id\");'>";
        }
        if (($flag == 1) | ($flag == 2) | ($flag == 5) | ($flag == 6)) {
            $icon_flag = "<img src='theme/images/best_price_icon.png' border='0' alt='СуперЦена' class='icon_button' onmouseover=\"tooltip.pop(this, '#d$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='d$id" . "_tip'>$help</div></div>";
        }

        if ($producent == $prod_id or $by_producent == $prod_id) {
            $k++;
            if ($k <= 15) {
                $list .= "<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>
						<tr align='center' id='ri$id' height='25'>
							<td>$icon_flag</td>
							<td>$code</td>
							<td align='left'><a href='javascript:showItemInfo(\"$id\");'>$name</a></td>
							<td align='right'>$price</td>
							<td align='right'>$price_client</td>
							<td>$quant_p_img $quant_r_img <a href='javascript:showItemSklad(\"$id\")'>$quant</a></td>
							<td><a href='javascript:showItemSklad(\"$id\")'>$quant1</a></td>
							<td>$img</td>
							<td><a href='javascript:showItemAnalog(\"$id\")'><img src='theme/images/analog_icon.jpg' border='0' alt='Аналоги' title='Аналоги'></a></td>
							<td>$add_busket</td>
						</tr>
						";
//                        Очень интресный участок, если не искали по наименованию, то показать список аналогов, пока что отключаю, бо тестирую техдок....
//                        if ($by_name == "" or $by_name == 0) {
//                            $list .= $this->showItemAnalogSklad($id);
//                        }
            }
        }
        if ($k == 15) {
            $i = $n + 1;
            $list .= "<tr><td colspan=10 style='color:red; font-size:16px;' height='20' align='center'>Результат поиска больше выведенного списка - конкретизируйте поиск</td></tr>";
        }
    }
}


//Пустая страница - если ничего не найдено.
if ($n == 0) {
    $list .= "
					<tr align='center' height='40' >
						<td colspan=20><h3></h3></td>
					</tr>
					<tr><td colspan=10 style='border-bottom:1px solid #58585a; font-size:2px;' height=2>&nbsp;</td></tr>";
}

$form = str_replace("{items_list}", $list, $form);

if (strlen($art) < 3) {
    $form = str_replace("{items_list}", "", $form);
}
$filter = "по TecDoc";
$form = str_replace("{art}", $art, $form);
$form = str_replace("{filter}", $filter, $form);
$form = str_replace("{kol_items}", $k, $form);
$form = str_replace("{producent_list}", showProducentList($proda), $form);

echo $form;

