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
$odb = new odb;  //����� �� ����� � ��
$slave = new slave; //��� ����� ��� ��������� ������
$dep = "23"; //������ $dep ��� ����� �� ����� � ���� ���� ���������.

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

echo '<h1> ID ������� ' . $client_id . ' </h1><br />';
//����������� �� ������ �������� � ������� ������
$art = trim($art);
//�������� � ������ ������� � ��������� win-1251
$art = mb_convert_case($art, MB_CASE_LOWER, "CP1251"); //kuzya  22.05.2015
//������� ������� � ��������� � ��� ��� ����������� �� ��������
$art = str_replace(array('"', "'"), "", trim($art));
print "������� $art <br/>";

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
//���-�� ����� � ���������� ������ - ���������� ��� ����� ��������� ������
$n = $odb->num_rows($r);

$list = "";

//���� � ������������ ������� ������ �������
$form_htm = "../tpl/catalogue_items_list.htm";
//���� ������� >16 ����� ������ ������ �����
if ($n > 16 and $by_producent != "") {
    $form_htm = RD . "../tpl/catalogue_items1_list.htm";
}
//������ ����� �� ������� � ���������� $form
$form = file_get_contents($form_htm);
//��������� ������
while (odbc_fetch_row($r)) {
    $style = "";
    $id = odbc_result($r, "id");
    $code = odbc_result($r, "code");
//    ���� ������ ���� >11 �������� ������������� ������� �����
    if (strlen($code) > 11) {
        $style = " style='font-size:12px;' ";
    }
//@ToDo    ��� ����� ���� �������� ��� �������� �� item_id
// ������ ��������� ������ ����� ��� ������ ��������
// �������, ������ ��� ����� ���� �������� ��� ������ �������, �� ������ ���� ��������� ��������� ��������, �� ����� �������� ������ �����...
// � ����� ��� ����� ��������� ���� ������...
    $list .= "<div class='ItemsTab' onclick='location.href=\"#search=$code\"'><a href='#search=$code' $style>$code</a></div>";

// ���� ������� >=23 �������� �� ������ �� �������
    if ($i == 24) {
        $i = $n + 1;
        $list .= "<h3 style='color:red'>��������� ������ ������ ����������� ������ - ��������������� �����</h3>";
    }
}
//��������  � ������� ���������� list
$form = str_replace("{list}", $list, $form);


//���� ��������� ������� ������ 16 ����� � ������ ��-�� , ������� ����� ���������� ������ � ���������

//���� ��������� ������� ������ 16 ����� � �� ������ ��-�� � ������  �� ������������, ������� ����� ����������
if ($n > 16 and $by_producent != "") {
    $n = 16;
}
//��������� ���� � �� ������ 16 ����� - ������� ������
if (($n > 0 and $n <= 16)) {
    $kt = -1;  //���������
    $k = 0; //���������
    $i = 1; //��� ������� �������������� $proda[$i]
    while (odbc_fetch_row($r)) {
        $prm = 0; //?
        $price1 = "";
        $i++; //i=2?  ������ �� ���������� � 2-�� ��������, ������ � 0 � 1 ����� �� ���������???
        $icon_flag = ""; //?
        $id = odbc_result($r, "id");
        $code = odbc_result($r, "code");
        $scode = odbc_result($r, "scode"); //�����?
        $name = odbc_result($r, "name");
        $name = wordwrap($name, 45, '&shy;', true);//������� ������ �� ���������� ���-�� ��������
        $flag = odbc_result($r, "flag"); //��� ������
        $help = odbc_result($r, "help"); //�����?
        $prod_id = odbc_result($r, "prod_id");
        $proda[$i] = $prod_id; //������ ��������������
//                ���� ������������� �����, �� �� ��������� � ���������� $producent �������� ��-�� ??? �� ����� �����
        if ($by_producent == "") {
            $producent = $prod_id;
        }

//@todo � ���� ����� ������ ��� � ���� ������� ����������� ������ � ������� ������� $this->saveArtSearch($art, $by_name, $producent);

        $price_client = getItemPrice2($id);

        $isImage = odbc_result($r, "isImage"); //������� - ���� ����
//                ������ �� ����
        $img = "<a href='javascript:showItemPhoto(\"" . strtoupper($id) . "\")'><img src='theme/images/photo_icon.png' border='0' alt='����' title='����'></a>";
        //�������
        list($quant, $quant1, $quant_r, $quant_p) = getItemQuant($id);
        $quant_r_img = ""; //��� ��������� �����...
//                ���� ���� ������� � ������� - ������ ������ �� �� ���� ����������� ������� �� �������
        if ($quant_r > 0) {
            $quant_r_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_reserv_icon.png' border='0' alt='����� � ������' title='����� � ������' align='middle' hspace='2'></a>";
        }
        $quant_p_img = "";
//                ���� ���� - ������ ������ ������
        if ($quant_p > 0) {
            $quant_p_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_prihod_icon.png' border='0' alt='����� � �������' title='����� � �������' align='middle' hspace='2'></a>";
        }
        $add_busket = "";
        $add_busket = "<a href='javascript:show_busket_form(\"$id\")'><img src='theme/images/add_icon.png' border='0' alt='�������� � �����' title='�������� � �����'></a>";
//					if (($flag==1)|($flag==2)|($flag==5)){	$icon_flag="<img src='theme/images/best_price_icon.png' border='0' alt='���������' class='icon_button' onmouseover=\"tooltip.pop(this, '#d$id"."_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='d$id"."_tip'>$help</div></div>";	}
        if ($flag == 7) {
            $icon_flag = "<img src='theme/images/action_icon.png' border='0' alt='�����' class='icon_button' onmouseover=\"tooltip.pop(this, '#a$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='a$id" . "_tip'>$help</div></div> onclick='showItemActionRemark(\"$id\");'>";
        }
        if (($flag == 1) | ($flag == 2) | ($flag == 5) | ($flag == 6)) {
            $icon_flag = "<img src='theme/images/best_price_icon.png' border='0' alt='���������' class='icon_button' onmouseover=\"tooltip.pop(this, '#d$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='d$id" . "_tip'>$help</div></div>";
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
							<td><a href='javascript:showItemAnalog(\"$id\")'><img src='theme/images/analog_icon.jpg' border='0' alt='�������' title='�������'></a></td>
							<td>$add_busket</td>
						</tr>
						";
//                        ����� ��������� �������, ���� �� ������ �� ������������, �� �������� ������ ��������, ���� ��� ��������, �� �������� ������....
//                        if ($by_name == "" or $by_name == 0) {
//                            $list .= $this->showItemAnalogSklad($id);
//                        }
            }
        }
        if ($k == 15) {
            $i = $n + 1;
            $list .= "<tr><td colspan=10 style='color:red; font-size:16px;' height='20' align='center'>��������� ������ ������ ����������� ������ - ��������������� �����</td></tr>";
        }
    }
}


//������ �������� - ���� ������ �� �������.
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
$filter = "�� TecDoc";
$form = str_replace("{art}", $art, $form);
$form = str_replace("{filter}", $filter, $form);
$form = str_replace("{kol_items}", $k, $form);
$form = str_replace("{producent_list}", showProducentList($proda), $form);

echo $form;

