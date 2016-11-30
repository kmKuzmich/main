<?php

class catalogue
{
    public $remips = array('78.152.169.139', '192.168.0.241', '192.168.0.240', '192.168.0.23', '192.168.0.22', '192.168.0.25', '192.168.0.39', '192.168.0.40', '192.168.0.41', '192.168.0.177', '192.168.0.175');

    function get_view_type()
    {
        if ($_POST["view_type"] == "") {
            return $_GET["view_type"];
        }
        if ($_POST["view_type"] != "") {
            return $_POST["view_type"];
        }
    }

    function get_order_by()
    {
        if ($_POST["order_by"] == "") {
            return $_GET["order_by"];
        }
        if ($_POST["order_by"] != "") {
            return $_POST["order_by"];
        }
    }

    function show_brand_list()
    {
        $db = new db;
        $slave = new slave;
        $dep = "23";
        $r = $db->query_lider("select * from catalogue where visible='1' order by caption_ru,id asc;");
        $n = $db->num_rows($r);
        $list = "<div style='margin-left:2px;'>";
        for ($i = 1; $i <= $n; $i++) {
            $id = $db->result($r, $i - 1, "id");
            $caption = $db->result($r, $i - 1, "caption_ru");
            $list .= "<div class='brandBg'><img src='http://www.avtolider-ua.com/thumb.php?logo=logo/$id.png&size=80&max_height=53&op=shop' alt='$caption' title='$caption' class='brandIm' onclick='showBrandInfo(\"$id\");'></div>";
        }
        $list .= "</div>";
        return $list;
    }

    function showBrandInfo($id)
    {
        $db = new db;
        $slave = new slave;
        $dep = "23";
        $form_htm = RD . "/tpl/catalogue_brand_info.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $r = $db->query_lider("select * from catalogue where id='$id' limit 1;");
        $n = $db->num_rows($r);
        if ($n == 1) {
            $id = $db->result($r, 0, "id");
            $caption = $db->result($r, 0, "caption_ru");
            $country = $db->result($r, 0, "country_ru");
            $production = $db->result($r, 0, "production_ru");
            $desc = $db->result($r, 0, "desc_ru");
            $site = $db->result($r, 0, "site");

            $form = str_replace("{caption}", $caption, $form);
            $form = str_replace("{country}", $country, $form);
            $form = str_replace("{production}", $production, $form);
            $form = str_replace("{desc}", $desc, $form);
            $form = str_replace("{site}", $site, $form);
            $form = str_replace("../uploads/images/", "/uploads/images/", $form);
            $form = str_replace("/uploads/images/", "http://www.avtolider-ua.com/uploads/images/", $form);
        }
        return $form;
    }

    function show_sto_form()
    {
        $form_htm = RD . "/tpl/catalogue_sto_form.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $form = str_replace("{sto_producent}", $this->show_sto_producent(0), $form);
        $form = str_replace("{sto_category}", $this->show_sto_category(0), $form);
        $form = str_replace("{sto_otype}", $this->show_sto_otype(0, 0), $form);
        return $form;
    }

    function show_sto_producent($producent = 0)
    {
        $odb = new odb;
        $slave = new slave;
        $menu .= "<select name='sto_producent' id='sto_producent' size=1 class='tec' onchange='loadStoCategory(this[this.selectedIndex].value);'><option value='0'> --- выберете производителя ---  </option>";
        $r = $odb->query_td("select * from sto_producent where ison='1' order by id asc");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
            $name = odbc_result($r, "name");
            if ($producent == $id) {
                $menu .= "<option value='$id' selected='selected'>$name</option>";
            }
            if ($producent != $id) {
                $menu .= "<option value='$id'>$name</option>";
            }
        }
        $menu .= "</select>";
        return $menu;
    }

    function show_sto_category($producent = 0, $category = 0)
    {
        $odb = new odb;
        $slave = new slave;
        $menu .= "<select name='sto_category' id='sto_category' size=1 class='tec' onchange='loadStoOtype(this[this.selectedIndex].value);'><option value='0'> --- выберете категорию оборудование ---  </option>";
        $r = $odb->query_td("select * from sto_category where producent='$producent' and ison='1' order by id asc");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
            $name = odbc_result($r, "name");
            if ($category == $id) {
                $menu .= "<option value='$id' selected='selected'>$name</option>";
            }
            if ($category != $id) {
                $menu .= "<option value='$id'>$name</option>";
            }
        }
        $menu .= "</select>";
        return $menu;
    }

    function show_sto_otype($category, $otype = 0)
    {
        $odb = new odb;
        $slave = new slave;
        $menu .= "<select name='sto_otype' id='sto_otype' size=1 class='tec'><option value='0'> --- выберете тип оборудование ---  </option>";
        if ($category != 0 and $category != "") {
            $r = $odb->query_td("select * from sto_otype where category='$category' and ison='1' order by id asc");
            while (odbc_fetch_row($r)) {
                $id = odbc_result($r, "id");
                $name = odbc_result($r, "name");
                if ($otype == $id) {
                    $menu .= "<option value='$id' selected='selected'>$name</option>";
                }
                if ($otype != $id) {
                    $menu .= "<option value='$id'>$name</option>";
                }
            }
        }
        $menu .= "</select>";
        return $menu;
    }

    function show_mp_tecdoc()
    {
        $form_htm = RD . "/tpl/catalogue_tecdoc_search_form.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $form = str_replace("{manufacture}", $this->show_tecdoc_manufacture(""), $form);
        $form = str_replace("{model}", $this->loadTecModelList($_GET["manufacture"], ""), $form);
        $form = str_replace("{modification}", $this->loadTecModificationList($_GET["manufacture"], $_GET["model"], ""), $form);

        return $form;
    }

    function show_tecdoc_manufacture($manuf)
    {
        $slave = new slave;
        $odb = new odb;
        if ($manuf == "") {
            $manuf = $_GET["manufacture"];
        }
        if ($manuf == "") {
            $manuf = 0;
        }
        $menu .= "<select name='manufacture' id='manufacture' size=1 class='tec' onchange='loadTecModelList(this[this.selectedIndex].value,0);'>";
        $f = fopen(RD . "/lib/tecdoc_journal/manufacture.txt", 'r');
        $data = '';
        $curData = date("Y-m-d");
        while (!feof($f)) {
            $data = fread($f, 2048);
        }
        fclose($f);
        if ($data != $curData) {
            $odb->query_td("delete from tecdoc_manufacture;");
            $f = fopen(RD . "/lib/tecdoc_journal/manufacture.txt", 'w');
            fwrite($f, $curData, strlen($curData));
            fclose($f);
        }
        $r = $odb->query_td("select * from tecdoc_manufacture;");
        $i = 0;
        while (odbc_fetch_row($r)) {
            $i += 1;
            $id = odbc_result($r, "id");
            $caption = odbc_result($r, "caption");
            if ($manuf == $id) {
                $menu .= "<option value='$id' selected='selected'>$caption</option>";
            }
            if ($manuf != $id) {
                $menu .= "<option value='$id'>$caption</option>";
            }
        }
        if ($i == 0) {
            $soap = new SoapClient(TecdocToCat, array('trace' => true,));
            try {
                $result = $soap->getVehicleManufacturers3(array(
                    'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'RU', 'carType' => 1, 'countriesCarSelection' => 'RU', 'countryGroupFlag' => false, 'evalFavor' => false,
                ));
                $result = $result->data->array;

                foreach ($result as $item) {
                    $id = $item->manuId;
                    $caption = $this->decodeLan(iconv("utf-8", "windows-1251", $item->manuName));

                    $odb->query_td("insert into tecdoc_manufacture (id,caption) values ($id,'$caption');");

                    if ($manuf == $id) {
                        $menu .= "<option value='$id' selected='selected'>$caption</option>";
                    }
                    if ($manuf != $id) {
                        $menu .= "<option value='$id'>$caption</option>";
                    }
                }

            } catch (SoapFault $e) {
            }
        }
        $menu .= "</select>";
        return $menu;
    }

    function decodeLan($caption)
    {
        $caption = str_replace("Л", "E", $caption);
        return $caption;
    }

    function loadTecModelList($manufacture, $mdl)
    {
        $slave = new slave;
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $result = $soap->getVehicleModels3(array(
                'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'RU', 'carType' => 1, 'countriesCarSelection' => 'RU', 'countryGroupFlag' => false, 'evalFavor' => false,
                'favouredList' => 1, 'manuId' => $manufacture,
            ));
            $result = $result->data->array;
            if ($mdl == "") {
                $mdl = $_GET["model"];
            }
            if ($mdl == "") {
                $mdl = 0;
            }
            $menu = "<select name='model' id='model' size=1 class='tec' onchange='loadTecModificationList($manufacture,this[this.selectedIndex].value,0);'>";
            foreach ($result as $item) {
                $id = $item->modelId;
                $caption = iconv("utf-8", "windows-1251", $item->modelname);
                $year_from = $this->tecdoc_data_split($item->yearOfConstrFrom);
                $year_to = $this->tecdoc_data_split($item->yearOfConstrTo);
                if ($mdl == $id) {
                    $menu .= "<option value='$id' selected='selected'>$caption ($year_from - $year_to)</option>";
                }
                if ($mdl != $id) {
                    $menu .= "<option value='$id'>$caption ($year_from - $year_to)</option>";
                }
            }
            $menu .= "</select>";
        } catch (SoapFault $e) {
        }
        return $menu;
    }

    function tecdoc_data_split($data)
    {
        return substr($data, 0, 4) . "/" . substr($data, 4, 2);
    }

    function loadTecModificationList($manufacture, $model, $mdf)
    {
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $result = $soap->getVehicleSimplifiedSelection3(array(
                'provider' => PROVIDER_ID,
                'modId' => $model,
                'manuId' => $manufacture,
                'linked' => false,
                'lang' => 'ru',
                'favouredList' => 0,
                'countryGroupFlag' => false,
                'countriesCarSelection' => 'ru',
                'countriesUserSetting' => 'ru',
                'carType' => 1,

            ));
            $is_empty = $result->data->empty;
            if ($is_empty == true) {
                $result = $soap->getVehicleSimplifiedSelection3(array(
                    'provider' => PROVIDER_ID,
                    'modId' => $model,
                    'manuId' => $manufacture,
                    'linked' => false,
                    'lang' => 'ru',
                    'favouredList' => 1,
                    'countryGroupFlag' => false,
                    'countriesCarSelection' => 'ru',
                    'countriesUserSetting' => 'ru',
                    'carType' => 1,));
            }
            $result = $result->data->array;
            if ($mdf == "") {
                $mdf = $_GET["modification"];
            }
            if ($mdf == "") {
                $mdf = 0;
            }
            $menu = "<select name='modification' id='modification' size=1 class='tec'>";
            foreach ($result as $item) {
                $id = $item->carDetails->carId;
                $caption = iconv("utf-8", "windows-1251", $item->carDetails->carName);
                $powerHpFrom = iconv("utf-8", "windows-1251", $item->carDetails->powerHpFrom);
                $motor = $item->motorCodes->array[0]->motorCode;
                if ($mdf == $id) {
                    $menu .= "<option value='$id' selected='selected'>$caption ($powerHpFrom л.с.) $motor</option>";
                }
                if ($mdf != $id) {
                    $menu .= "<option value='$id'>$caption ($powerHpFrom л.с.) $motor</option>";
                }
            }
            $menu .= "</select>";
        } catch (SoapFault $e) {
        }
        return $menu;
    }

    function show_range()
    {
        session_start();
        $dep = "23";
        require_once(RD . "/lib/news_class.php");
        $news = new news;
        $slave = new slave;
        $dep = $slave->get_dep();
        $w = $slave->get_w();
        $form_htm = RD . "/tpl/catalogue_range.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }


        if ($dep == 24 or $dep == 23) {
            $form = str_replace("{fast1}", "class='FastAct'", $form);
        }
        if ($dep == 32) {
            $form = str_replace("{fast2}", "class='FastAct'", $form);
        }
        if ($dep == 31) {
            $form = str_replace("{fast3}", "class='FastAct'", $form);
            $form = str_replace("{width1}", "65px;", $form);
            $form = str_replace("{width2}", "55px;", $form);
            $form = str_replace("{width3}", "1050px;", $form);
            $form = str_replace("{width4}", "1040px;", $form);

        }
        for ($i = 1; $i <= 4; $i++) {
            $form = str_replace("{fast$i}", "class='Fast'", $form);
        }
        $form = str_replace("{width1}", "315px;", $form);
        $form = str_replace("{width2}", "235px;", $form);
        $form = str_replace("{width3}", "800px;", $form);
        $form = str_replace("{width4}", "790px;", $form);

        if ($w == "maslo") {
            $form = str_replace("{range_search_form}", $this->show_maslo_search_form(), $form);
            list($maslo_range, $filters) = $this->catalogue_maslo_find($_REQUEST["category"], $_REQUEST["cols"], $_REQUEST["vals"], $_REQUEST["page"]);
            $form = str_replace("{range_list}", $maslo_range, $form);
        }

        $form = str_replace("{range_search_form}", $this->show_range_search_form(), $form);
        $w = $slave->get_w();
        $conf = $slave->get_conf();
        if ($w == "add_sto_item") {
            if ($conf == "") {
                $form = str_replace("{range_list}", $this->create_sto_item(), $form);
            }
            if ($conf == "true") {
                $form = str_replace("{range_list}", $this->add_sto_item(), $form);
            }
        }
        if ($w == "edit_sto_item") {
            if ($conf == "") {
                $form = str_replace("{range_list}", $this->edit_sto_item($_GET["id"]), $form);
            }
            if ($conf == "true") {
                $form = str_replace("{range_list}", $this->save_sto_item(), $form);
            }
        }
        if ($w == "drop_sto_item") {
            if ($conf == "true") {
                $form = str_replace("{range_list}", $this->drop_sto_item($_GET["id"]), $form);
            }
        }
        if ($w == "") {
            if (($_GET["manufacture"] == "" and $_GET["model"] == "" and $_GET["modification"] == "") and ($_GET["category"] == "")) {
                $form = str_replace("{range_list}", $this->catalogue_art_find($_POST["art"], $_POST["by_code"], $_POST["by_sklad"], $_POST["by_name"], $_POST["by_producent"]), $form);
            }
            if (($_GET["manufacture"] == "" and $_GET["model"] == "" and $_GET["modification"] == "") and ($_GET["category"] != "")) {
                $form = str_replace("{range_list}", $this->catalogue_sto_items($_POST["producent"], $_POST["category"], $_POST["otype"]), $form);
            }
            if ($_GET["manufacture"] != "" and $_GET["model"] != "" and $_GET["modification"] != "") {
                $form = str_replace("{range_list}", $this->loadTecGroupsList($_GET["manufacture"], $_GET["model"], $_GET["modification"]), $form);
            }
        }
        $form = str_replace("{bottom_side}", $news->show_range_news(), $form);
        $form = str_replace("{recomend_list}", $this->showRecomendList(""), $form);
        return $form;
    }

    function show_maslo_search_form()
    {
        $form_htm = RD . "/tpl/catalogue_maslo_search_form.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }

        $form = str_replace("{category_filter}", $this->show_maslo_category_filter(""), $form);
        $form = str_replace("{filters}", $this->show_maslo_filters("", "", "", ""), $form);
//		$form=str_replace("{search_example}",$this->getRandomItem(),$form);
//		$form=str_replace("{manufacture}",$this->show_tecdoc_manufacture($_GET["manufacture"]),$form);
//		$form=str_replace("{model}",$this->loadTecModelList($_GET["manufacture"],""),$form);
//		$form=str_replace("{modification}",$this->loadTecModificationList($_GET["manufacture"],$_GET["model"],""),$form);
//		$form=str_replace("{actionBonus}",$this->showActionBonus(),$form);
        return $form;
    }

    function show_maslo_category_filter($category)
    {
        $db = new db;
        $form = "";
        if ($category == "") {
            $category = $this->getDefaultMasloCategory();
        }
        //items_name таблица из базы MySQL отвечает за...
        $r = $db->query_lider("select * from items_name order by id asc;");
        $n = $db->num_rows($r);
        for ($i = 1; $i <= $n; $i++) {
            $file = $db->result($r, $i - 1, "file");
            $caption = $db->result($r, $i - 1, "caption");
            if ($file == $category) {
                $form .= "<a href='#maslo=$caption' onclick='setMasloCategory(\"$file\");' style='margin-left:10px; color:#000; font-weight:bold; text-decoration:none;'>$caption</a><br>";
            }
            if ($file != $category) {
                $form .= "<a href='#maslo=$caption' onclick='setMasloCategory(\"$file\");' style='margin-left:10px;'>$caption</a><br>";
            }
        }
        return $form;
    }

    /**
     * @return int|string
     *  возвращает имя file категории масел по умолчанию например t1,t2,t3,t4 и т.д. описаны в методике загрузки каталога масел.
     */
    function getDefaultMasloCategory()
    {
        $db = new db;
        $cat = 0;
        $r = $db->query_lider("select file from items_name where def='1' order by id asc limit 1;");
        $n = $db->num_rows($r);
        if ($n == 1) {
            $cat = $db->result($r, 0, "file");
        }
        return $cat;
    }

    function show_maslo_filters($category, $cols, $vals, $used_id)
    {
        $db = new db;
        $form = "";
        if ($category == "") {
            $category = $this->getDefaultMasloCategory();
        }
        $r = $db->query_lider("select * from items_param where t_name='$category' order by lenta,id asc;");
        $n = $db->num_rows($r);
        $colums = array();
        for ($i = 1; $i <= $n; $i++) {
            $col_name = $db->result($r, $i - 1, "col_name");
            array_push($colums, $col_name);
        }
        $form .= $this->show_maslo_filter_items($category, $cols, $vals, $used_id, $colums);
        return $form;
    }

    function show_maslo_filter_items($category, $cols, $vals, $used_id, $colums)
    {
        $db = new db;
        $form = "";

        if ($cols != "") {
            $checked = array();
            $cols2 = array();
            foreach ($cols as $col) {
                if ($col != "") {
                    array_push($cols2, $col);
                    foreach ($vals as $val) {
                        if ($val != "") {
                            $vval = explode("=", $val);
                            if ($val == ($col . "=" . $vval[1])) {
                                array_push($checked, $vval[1]);
                            }
                        }
                    }
                }
            }
            $cols = $cols2;
        }

        $enable = array();
        $where = "";
        $enable2 = "";
        if (is_array($used_id)) {
            foreach ($used_id as $use_id) {
                $where .= " lider_id='$use_id' or";
            }
        }
        if ($where != "") {
            $where = " and (" . substr($where, 0, -3) . ")";
        }
        foreach ($colums as $colum) {
            $r = $db->query_lider("select `$colum` from `items_$category` where 1 $where;");
            $n = $db->num_rows($r);
            for ($i = 1; $i <= $n; $i++) {
                $vl = $db->result($r, $i - 1, "$colum");
                if ((!in_array($vl, $enable)) && $vl != "") {
                    array_push($enable, $vl);
                    $enable2 .= "$vl,";
                }
            }
        }
        $r1 = $db->query_lider("select * from items_param where t_name='$category' order by lenta,id asc;");
        $n1 = $db->num_rows($r1);
        for ($j = 1; $j <= $n1; $j++) {
            $col_name = $db->result($r1, $j - 1, "col_name");
            $col_caption = $db->result($r1, $j - 1, "col_caption");
            $form .= "<div style='height:18px; margin-top:10px; text-transform:uppercase; line-height:11px;'>$col_caption:</div>";


            $cn = array();
            $r = $db->query_lider("select `$col_name` from `items_$category` group by `$col_name` order by `$col_name` asc;");
            $n = $db->num_rows($r);
            $k = 0;
            for ($i = 1; $i <= $n; $i++) {
                $value = $db->result($r, $i - 1, "$col_name");
                if ($value != "") {
                    $k += 1;
                    $cn[$k] = $value;
                }
            }
            array_multisort($cn, SORT_NUMERIC, SORT_ASC, $cn, SORT_STRING, SORT_ASC);
            for ($i = 0; $i <= $k - 1; $i++) {
                $value = $cn[$i];
                $link = " onclick='setCategoryFilter(this,\"$category\",\"$col_name\",\"$value\")'";
                $ich = "";
//                Проверяем, если массив $checked не пустой и строка активирована (checked) то назначить строке $ich значение checked
                if ((is_array($checked)) && in_array($value, $checked)) {
                    $ich = " checked";
                }
                $dis = "";
                if (!in_array($value, $enable) && (count($cols) > 1 || $j > 1)) {
                    $dis = " disabled";
                    $link = "";
                }
                $form .= "<input type='checkbox' id='fil$i" . "_$col_name' value='$value' hidden  $ich $dis $link><label for='fil$i" . "_$col_name'><span $link>$value</span></label><br>";
            }

        }
        $form .= "<div style='height:18px; margin-top:10px; text-transform:uppercase; line-height:11px;'>&nbsp;</div>";
        return $form;
    }

    function catalogue_maslo_find($category, $cols, $vals, $page)
    {
        session_start();
        $db = new db;
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        if ($category == "") {
            $category = $this->getDefaultMasloCategory();
        }
        if ($cols != "") {
            $where = "";
            foreach ($cols as $col) {
                if ($col != "") {
                    $where2 = " and (";
                    foreach ($vals as $val) {
                        if ($val != "") {
                            $vval = explode("=", $val);
                            if ($val == ($col . "=" . $vval[1])) {
                                $where2 .= " `$col` = '$vval[1]' or";
                            }
                        }
                    }
                    if ((substr($where2, -3, 3)) == " or") {
                        $where2 = substr($where2, 0, -3) . ")";
                    }
                    if ($where2 == " and (") {
                        $where2 = "";
                    }
                    $where .= $where2;
                }
            }
        }
        $form_htm = RD . "/tpl/catalogue_maslo_items_list.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        if ($where == "") {
            $where = " and 1";
        }
        list($navigation, $limit) = $this->catalogue_maslo_page_navigation($category, $where, $page);
        if ($where != "") {
            $r = $db->query_lider("select lider_id from `items_$category` where 1 $where $limit;");
            $n = $db->num_rows($r);
            $where_lider = "";
            if ($n > 0) {
                for ($i = 1; $i <= $n; $i++) {
                    $lider_id = $db->result($r, $i - 1, "lider_id");
                    $where_lider .= " id='$lider_id' or";
                }
                $where_lider = substr($where_lider, 0, -3);
            }
        }
        $form = str_replace("{navigation}", $navigation, $form);
        $exclude = " prod_id not in (1134)";
        $used_id = array();
        if ($where_lider != "") {
            $query = "select * from item where $exclude and ($where_lider);";
            $r = $odb->query_td($query);
            $list = "";
            $kt = -1;
            $k = 0;
            $i = 0;
            while (odbc_fetch_row($r)) {
                $prm = 0;
                $price1 = "";
                $i++;
                $icon_flag = "";
                $id = odbc_result($r, "id");
                //наличие
                list($quant, $quant1, $quant_r, $quant_p) = $this->getItemQuant($id);
                if ($quant != "") {
                    array_push($used_id, $id);

                    $code = odbc_result($r, "code");
                    $scode = odbc_result($r, "scode");
                    $name = odbc_result($r, "name");
                    $name = wordwrap($name, 45, '&shy;', true);
                    $flag = odbc_result($r, "flag");
                    $help = odbc_result($r, "help");

                    $prod_id = odbc_result($r, "prod_id");
                    $proda[$i] = $prod_id;
                    $valuta_id = odbc_result($r, "val_id");
                    $discount_id = odbc_result($r, "discount_id");
                    $price = $slave->tomoney(odbc_result($r, "pricePro"));
                    //Цена клиента
                    //					$price_client=$this->getItemPrice($id,$valuta_id,$price,$discount_id);
                    $price_client = $this->getItemPrice2($id);

                    $isImage = odbc_result($r, "isImage");
                    $img = "<a href='javascript:showItemPhoto(\"" . strtoupper($id) . "\")'><img src='theme/images/photo_icon.png' border='0' alt='Фото' title='Фото'></a>";

                    $quant_r_img = "";
                    if ($quant_r > 0) {
                        $quant_r_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_reserv_icon.png' border='0' alt='Товар в резерв' title='Товар в резерв' align='middle' hspace='2'></a>";
                    }
                    $quant_p_img = "";
                    if ($quant_p > 0) {
                        $quant_p_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_prihod_icon.png' border='0' alt='Товар в приходе' title='Товар в приходе' align='middle' hspace='2'></a>";
                    }
                    $add_busket = "";//if ($price>0 and $quant!=""){$add_busket="<a href='javascript:show_busket_form(\"$id\")'><img src='theme/images/add_icon.png' border='0' alt='Добавить в заказ' title='Добавить в заказ'></a>";}
                    $add_busket = "<a href='javascript:show_busket_maslo_form(\"$id\",\"$category\")'><img src='theme/images/add_icon.png' border='0' alt='Добавить в заказ' title='Добавить в заказ'></a>";
                    if ($flag == 7) {
                        $icon_flag = "<img src='theme/images/action_icon.png' border='0' alt='Акция' class='icon_button' onmouseover=\"tooltip.pop(this, '#a$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='a$id" . "_tip'>$help</div></div> onclick='showItemActionRemark(\"$id\");'>";
                    }
                    if ((($flag == 1) | ($flag == 2) | ($flag == 5) | ($flag == 6)) & ($quant > 0)) {
                        $icon_flag = "<img src='theme/images/best_price_icon.png' border='0' alt='СуперЦена' class='icon_button' onmouseover=\"tooltip.pop(this, '#d$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='d$id" . "_tip'>$help</div></div>";
                    }

                    $k++;
                    $list .= "<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>
					<tr align='center' id='ri$id' height='25'>
						<td>$icon_flag</td>
						<td>$code</td>
						<td align='left'><a href='javascript:showMasloItemInfo(\"$id\",\"$category\");'>$name</a></td>
						<td align='right'>$price</td>
						<td align='right'>$price_client</td>
						<td>$quant_p_img $quant_r_img <a href='javascript:showItemSklad(\"$id\")'>$quant</a></td>
						<td><a href='javascript:showItemSklad(\"$id\")'>$quant1</a></td>
						<td>$img</td>
						<td><a href='javascript:showItemAnalog(\"$id\")'><img src='theme/images/analog_icon.jpg' border='0' alt='Аналоги' title='Аналоги'></a></td>
						<td>$add_busket</td>
					</tr>
				";
                }
            }
        }
        if ($i == 0) {
            $list .= "
			<tr align='center' height='40' >
				<td colspan=20><h3>Уточните поиск</h3></td>
			</tr>
			<tr><td colspan=10 style='border-bottom:1px solid #58585a; font-size:2px;' height=2>&nbsp;</td></tr>";
        }
        $form = str_replace("{items_list}", $list, $form);
        return array($form, $this->show_maslo_filters($category, $cols, $vals, $used_id));
    }

    function catalogue_maslo_page_navigation($category, $where, $page)
    {
        $db = new db;
        $slave = new slave;
        $kpp = 100;
        if ($page == "") {
            $page = $_GET["page"];
            if ($page == "") {
                $page = "1";
            }
        }
        $cur_page = $page;
        $limit = " limit $kpp offset 0";
        if ($where != "") {
            $r = $db->query_lider("select count(lider_id) as kol from `items_$category` where 1 $where;");
            $kol = $db->result($r, 0, "kol");
            $kol_p = ceil($kol / $kpp);
            if ($kol_p > 1) {
                if ($kol_p <= 10) {
                    for ($i = 1; $i <= $kol_p; $i++) {
                        if ($i != $cur_page) {
                            $menu .= "<div class='navb'><a href='#mspage=$i' onClick='setCategoryFilter(\"\",\"$category\",\"\",\"\",\"$i\")'>$i</a></div>";
                        }
                        if ($i == $cur_page) {
                            $menu .= "<div class='nvds'>$i</div>";
                        }
                    }
                }
                if ($kol_p > 10) {
                    $start = $cur_page - 5;
                    $end = $cur_page + 5;
                    if ($start < 1) {
                        $end = $end - $start;
                        $start = 1;
                    }
                    if ($end > $cur_page + 5) {
                        $end = $cur_page + 5;
                    }
                    if ($end < 10) {
                        $end = 10;
                    }
                    if ($end > $kol_p) {
                        $end = $kol_p;
                    }
                    for ($i = $start; $i <= $end; $i++) {
                        if ($i != $cur_page) {
                            $menu .= "<div class='navb'><a href='#fpage=$i' onClick='setCategoryFilter(\"\",\"$category\",\"\",\"\",\"$i\")'>$i</a></div>";
                        }
                        if ($i == $cur_page) {
                            $menu .= "<div class='nvds'>$i</div>";
                        }
                    }
                }
                $menu = "<div class='navb' style='width:30px;'><a href='#mspage=all' onClick='setCategoryFilter(\"\",\"$category\",\"\",\"\",\"all\")'>Все</a></div>" . $menu;
            }
            $pg = $page;
            if ($pg == "") {
                $pg = "0";
            }
            $pg -= 1;
            if ($pg < 0) {
                $pg = 0;
            }
            $lmt = $kpp * $pg;
            if ($page == "all") {
                $limit = " limit $kol";
            }
            if ($page != "all") {
                $limit = " limit $kpp offset $lmt";
            }
        }
        return array($menu, $limit);
    }

    /**
     * @param $item_id по заданному ID артикула возвращает наличие на складе
     * @return array результат массив строк - кол на складе без резерва, кол на филиале, кол резерва, в приход
     * list($quant, $quant1, $quant_r, $quant_p) = $this->getItemQuant($id);
     * $quant1 - кол-во без резерва в ХМ, $quant1 - кол-во Exp, $quant_r - резерв, $quant_p - в приходе
     */
    function getItemQuant($item_id)
    {
        session_start();
        $odb = new odb;
        $quant = 0;
        $quant1 = 0;
        list($listPlaceExpr, $listPlaceKm) = $this->getSkladIDS();
        $listPlace = $listPlaceKm . ',' . $listPlaceExpr;

        //kind_id=1 - всё наличие с учётом резервов, без учёта ведомостей приходов
        //kind_id=2 - резерв
        //kind_id=4 - приход

        $r = $odb->query_td("
                        select 
                            (sum (case when S.kind=1 then S.quant else 0 end)) as qA,
                            (sum (case when S.kind=2 then S.quant else 0 end)) as qR,
                            (sum (case when S.kind=4 then S.quant else 0 end)) as qI,
                            (case
                                when P.code in ($listPlaceKm) then 'Km'       
                                when P.code in ($listPlaceExpr) then 'Exp'
                            end) as PlaceKind
                        from Store S join Place P on S.Subconto_id=P.id
                        where S.kind in (1,2,4) and S.item_id =$item_id
                        and P.code in ($listPlace)
                        group by PlaceKind

                 ");

        while (odbc_fetch_row($r)) {
            switch (odbc_result($r, PlaceKind)) {
                case 'Km':
                    $kmQuantAll = odbc_result($r, qA);
                    $kmQuantR = odbc_result($r, qR);
                    $kmQuantInc = odbc_result($r, qI);
                    break;
                case 'Exp':
                    $exQuantAll = odbc_result($r, qA);
                    break;
            }
        }
        $kmQuantAll = $this->quantFormat($kmQuantAll - $kmQuantR);
        $quant1_res = $this->quantFormat($exQuantAll);
        $quant_r = $this->quantFormat($kmQuantR);
        $quant_p = $this->quantFormat($kmQuantInc);

        return array($kmQuantAll, $quant1_res, $quant_r, $quant_p);
    }

    /** Преобразует числовой аргумент (кол-во) в строковой ''-пусто, от '1' до '10' или '>10'
     * для вывода кол-ва в прайсе
     * @param $q
     * @return string
     */
    function quantFormat($q)
    {
        if ($q == 0) {
            $qResult = "";
        }
        if ($q >= 1 and $q <= 10) {
            $qResult = $q;
        }
        if ($q > 10) {
            $qResult = ">10";
        }
        return $qResult;
    }

    function getItemQuantOld($item_id)
    {
        session_start();
        $odb = new odb;
        $quant = 0;
        $quant1 = 0;
        list($listPlaceExpr, $listPlaceKm) = $this->getSkladIDS();
        $r = $odb->query_td("SELECT sum( S.quant ) AS kol 
                    FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id) 
                    WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '1' and SC.code in($listPlaceKm) GROUP BY S.SubConto_id;");
        while (odbc_fetch_row($r)) {
            $quant += odbc_result($r, "kol");
        }
        $r = $odb->query_td("SELECT sum( S.quant ) AS kol
                     FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id)
                      WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '2' and SC.code in($listPlaceKm) GROUP BY S.SubConto_id;");
        while (odbc_fetch_row($r)) {
            $quant_r += odbc_result($r, "kol");
            $quant -= $quant_r;
        }
        $r = $odb->query_td("SELECT sum( S.quant ) AS kol 
                    FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id) 
                    WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '4' and SC.code in($listPlaceKm) GROUP BY S.SubConto_id;");
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
        $r = $odb->query_td("SELECT sum( S.quant ) AS kol 
                    FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id) 
                    WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '1' and SC.code in($listPlaceExpr) GROUP BY S.SubConto_id;");
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

    //$art1=strtolower(str_replace(array('_', '-', '—', '/', '.', ',', '\\',' '),"",trim($art)));

//    Возвращает перечень складов для которых показывать остаток
//    обновляет этот перечень каждый час
    function getSkladIDS()
    {
        if (isset($_REQUEST[session_name()])) session_start();
        $needUpdate = 0;
        $data_to = time() + 60 * 60;//259200;
        if (empty($_SESSION["placeData_to"]) || ($_SESSION["Data_to"] < time())) {
            $_SESSION["placeData_to"] = $data_to;
            $needUpdate = 1;
            $_SESSION["placeNeedUpdate"] = $needUpdate;
        } else {
            $_SESSION["placeNeedUpdate"] = $needUpdate;
        };

        $odb = new odb;
        if (($needUpdate == 1)) {
            $r = $odb->query_td("SELECT name,value FROM globalvar where name='@ListPlaceExpr' or name='@ListPlaceKm';");
            while (odbc_fetch_row($r)) {
                $name = odbc_result($r, "name");
                $value = odbc_result($r, "value");
                if ($name == "@ListPlaceExpr") {
                    $listPlaceExpr = $value;
                    $_SESSION["listPlaceExpr"] = $listPlaceExpr;
                }
                if ($name == "@ListPlaceKm") {
                    $listPlaceKm = $value;
                    $_SESSION["listPlaceKm"] = $listPlaceKm;
                }
            }
        } else {
            $listPlaceExpr = $_SESSION["listPlaceExpr"];
            $listPlaceKm = $_SESSION["listPlaceKm"];
        }

        return array($listPlaceExpr, $listPlaceKm);
    }

    function getItemPrice2($item_id)
    {
//        session_start();
        if (isset($_REQUEST[session_name()])) session_start();
        if (empty($_SESSION["client"])) {
            $client_id = 0; //выводить скидку=0 потому что если есть 4 гр то клиент не видит что он не авторизирован //Выводить скидку по клиенту=Фирма ЛидерСервис-Клиент группа 4
        } else {
            $client_id = $_SESSION["client"];
        }
        $odb = new odb;
        $slave = new slave;

        //id=10000001
        $r = $odb->query_td("select getprice(id,'$client_id') from item where id='$item_id';");
//        $r = $odb->query_lider("select getprice(id,'$client_id') from item where id='$item_id';");
        odbc_fetch_row($r);
        $price = $slave->tomoney(odbc_result($r, 1));
//        $price = odbc_result($r, 1);
        return $price;
    }

    function show_range_search_form()
    {
        $form_htm = RD . "/tpl/catalogue_range_search_form.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
//		$form=str_replace("{search_example}",$this->getRandomItem(),$form);
//		$form=str_replace("{manufacture}",$this->show_tecdoc_manufacture($_GET["manufacture"]),$form);
//		$form=str_replace("{model}",$this->loadTecModelList($_GET["manufacture"],""),$form);
//		$form=str_replace("{modification}",$this->loadTecModificationList($_GET["manufacture"],$_GET["model"],""),$form);
        $form = str_replace("{actionBonus}", $this->showActionBonus(), $form);
        return $form;
    }

    function showActionBonus()
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
        $form = "";
        if ($client != "" and $client > 0) {
            $curdata = date("Y-m-d");
            $form = "<h3 align='center' style='color:#000; margin:5;'>НАКОПЛЕННЫЕ БОНУСЫ</h3>";
            $r = $odb->query_td("select * from action where eday>='$curdata' and status='1' order by id asc;"); //Kuz убрал =>> and (flag is null or flag=0)
            while (odbc_fetch_row($r)) {

                $id = odbc_result($r, "id");
                $name = odbc_result($r, "name");
                $status = odbc_result($r, "status");
                $url = odbc_result($r, "url");
                $bonus = $this->getActionBonusSumm($id, $client);
//				if ($bonus>0)
                {
                    $form .= "<div style='cursor:pointer; border-bottom:1px solid #000;' onclick='showActionInfo(\"$url\")'>$name: <strong>$bonus грн</strong></div>";
                }
            }
        }
        return $form;
    }

    function getActionBonusSumm($id, $client)
    {
        if (empty($client) || $client == '' || $client == 0) {
            return;
        }
//        if (isset($_REQUEST[session_name()])) session_start();
//        if (empty($_SESSION["client"])) {
//            $client = 0; //Выводить скидку по клиенту=Фирма ЛидерСервис-Клиент группа 4
//            return;
//        }
//        else {$client = $_SESSION["client"];}
        $bonus = 0;
        $bonus1 = 0;
        $odb = new odb;
        $r = $odb->query_td("SELECT cast(sum(SUM) as numeric(12,2)) as bonus FROM ACTIONDOC where client_id='$client' and action_id='$id' and type='0';");
        while (odbc_fetch_row($r)) {
            $bonus = odbc_result($r, "bonus");
        }
        $r = $odb->query_td("SELECT cast(sum(SUM) as numeric(12,2)) as bonus FROM ACTIONDOC where client_id='$client' and action_id='$id' and type='1';");
        while (odbc_fetch_row($r)) {
            $bonus1 = odbc_result($r, "bonus");
        }
        $bonus = $bonus - $bonus1;
        return $bonus;
    }

    function create_sto_item()
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        $rem_ip = $_SERVER['REMOTE_ADDR'];
        if (in_array($rem_ip, $this->remips)) {
            $form_htm = RD . "/tpl/catalogue_sto_item_form.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
            $form = str_replace("{action}", "Добавление", $form);
            $form = str_replace("{w}", "add_sto_item", $form);
            $form = str_replace("{producent_form}", $this->show_sto_producent(0), $form);
            $form = str_replace("{category_form}", $this->show_sto_category(0), $form);
            $form = str_replace("{otype_form}", $this->show_sto_otype(0, 0), $form);
        }
        return $form;
    }

    function add_sto_item()
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        $rem_ip = $_SERVER['REMOTE_ADDR'];
        if (in_array($rem_ip, $this->remips)) {
            if (is_uploaded_file($_FILES["items_file"]['tmp_name'])) {
                chmod($_FILES["items_file"]['tmp_name'], 0755);
                move_uploaded_file($_FILES["items_file"]['tmp_name'], "uploads/file/file_sto.xls");

                $producent_a = array();
                $producent_k = 0;
                $category_a = array();
                $category_k = 0;
                $otype_a = array();
                $otype_k = 0;

                $file_path = "uploads/file/file_sto.xls";
                require_once RD . '/excel/excel_reader2.php';
                $data = new Spreadsheet_Excel_Reader($file_path, true, "CP1251");
                $rows = $data->rowcount($sheet);
                if ($rows == 0) {
                    $rows = $data->rowcount(0);
                    $sheet = 0;
                }
                if ($rows > 0) {
                    $odb->query_td("truncate table sto_producent;");
                    $odb->query_td("truncate table sto_category;");
                    $odb->query_td("truncate table sto_otype;");
                    $odb->query_td("truncate table sto_items;");
                    for ($i = 2; $i <= $rows; $i++) {
                        $producent = $slave->qq($data->val($i, 1, $sheet));
                        $category = $slave->qq($data->val($i, 2, $sheet));
                        $otype = $slave->qq($data->val($i, 3, $sheet));
                        $code = $slave->qq($data->val($i, 4, $sheet));

                        //print "$producent,$category,$otype,$code<br />";

                        if ($code != "") {
                            if (!array_key_exists($producent, $producent_a)) {
                                $producent_k += 1;
                                $producent_a[$producent] = $producent_k;
                                $odb->query_td("insert into sto_producent (id,name,ison) values('$producent_k','$producent','1');");
                                //print "insert into sto_producent (id,name,ison) values('$producent_k','$producent','1');<br />";
                                $category_a = array();
                                $otype_a = array();
                            }
                            if (!array_key_exists($category, $category_a)) {
                                $category_k += 1;
                                $category_a[$category] = $category_k;
                                $odb->query_td("insert into sto_category (id,name,ison,producent) values('$category_k','$category','1','" . $producent_a[$producent] . "');");
                                //print "insert into sto_category (id,name,ison,producent) values('$category_k','$category','1','".$producent_a[$producent]."');<br />";
                            }
                            if (!array_key_exists($otype, $otype_a)) {
                                $otype_k += 1;
                                $otype_a[$otype] = $otype_k;
                                $odb->query_td("insert into sto_otype (id,category,name,ison) values('$otype_k','" . $category_a[$category] . "','$otype','1');");
                                //print "insert into sto_otype (id,category,name,ison) values('$otype_k','".$category_a[$category]."','$otype','1');<br />";
                            }
                            $odb->query_td("insert into sto_items (code,producent,category,otype,ison) values ('$code','" . $producent_a[$producent] . "','" . $category_a[$category] . "','" . $otype_a[$otype] . "','1');");
                        }
                    }
                }
            }

            $form_htm = RD . "/tpl/save_message.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
            $form = str_replace("{message}", "Информация об оборудовании успешно добавлена", $form);
            $form = str_replace("{back_caption}", "", $form);
            $form = str_replace("{back_url}", "", $form);
        }
        return $form;
    }

    function drop_sto_item($id)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        $rem_ip = $_SERVER['REMOTE_ADDR'];
        if (in_array($rem_ip, $this->remips)) {
            $odb->query_td("update sto_items set ison='0' where id='$id';");

            $form_htm = RD . "/tpl/save_message.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
            $form = str_replace("{message}", "Информация об оборудовании успешно удалена", $form);
            $form = str_replace("{back_caption}", "", $form);
            $form = str_replace("{back_url}", "", $form);
        }
        return $form;
    }

    function catalogue_art_find($art, $by_code, $by_sklad, $by_name, $by_producent)
    {
//@todo добавить этот признак в переменную метода и в обработку скрипта
//@todo в поиске должна быть сортировка по совпадению, боле точные результаты должны быть первыми например '207 045' по HP
        $byTD = 0; //основной Признак что поиск проведён по TecDoc
        session_start();
        $odb = new odb;
        $slave = new slave;
        $clnt = new client;
        $dep = "23";
        $client_id = $_SESSION["client"];
        if ($art == "") {
            $art = $this->get_art();
        }
        if ($by_code == "") {
            $by_code = 0;
        }
        if ($by_sklad == "") {
            $by_sklad = 0;
        }
        if ($by_name == "") {
            $by_name = 0;
        }
        $form_htm = RD . "/tpl/catalogue_items_list.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        if (strlen($art) > 2 and $art != "Поиск запчастей") {
            //запоминаем первоначальный поиск чтоб потом по нему потом поискатьпо наименованию
            $artName = mb_convert_case($art, MB_CASE_LOWER, "CP1251");;
            //избавляемся от лишних пробелов в искомой строке (отключил , чуть ниже избавимся)
//            $art = trim($art);
            //приводим в нижний регистр в кодировке win-1251
            $art = mb_convert_case($art, MB_CASE_LOWER, "CP1251"); //kuzya  22.05.2015
            //избавляемся от лишних пробелов в искомой строке
            $art = trim($art);
            //удаляем кавычки и аппостроф ( и ещё раз избавляемся от пробелов нафига - отключил???)
//            $art = str_replace(array('"', "'", '.'), "", trim($art));
//            непечатаемые символы ="chr(9),chr(10),chr(13),chr(10),chr(33),chr(35),chr(38),chr(94),chr(96),chr(126)";
            $art = str_replace(array('"', "'", ';', chr(9), chr(10), chr(13), chr(10), chr(33), chr(35), chr(38), chr(94), chr(96), chr(126)), "", $art);
            //чистим для поиска по обрезаному наименованию.
            $artName = str_replace(array('"', "'", ';', chr(9), chr(10), chr(13), chr(10), chr(33), chr(35), chr(38), chr(94), chr(96), chr(126)), "", $artName);
            //удаляем спец символы, и опять переводим в нижн регистр (но уже другим способом) и сохраняем в $art1 чтоб дальше можно было искать по оригиналу и не только
            $art1 = strtolower(str_replace(array('+', '-', '_', '—', '&', '/', '.', ',', '=', '\\', ' ', '"', '\''), "", trim($art))); //'(', ')',
            //Эта текстовая переменная отвечает за то что нельзя показывать в прайсе 1134 - производитель Service и скрытые позиции в прайсе
//            $exclude = " and prod_id not in (1134) and nvl( bitand(sign,2),0)=0";
            $exclude = " and prod_id not in (1134) and COALESCE( (sign & 2),0)=0";
            //Эта переменная добавляет фильтр по производителю, если указан
            $where2 = "";
            if ($by_producent != "") {
                $where2 = " and prod_id='$by_producent' ";
                //Записываем в список "История поисков" и в WebSearch
                //print "$by_producent";
                $this->saveArtSearch($art, $by_name, $by_producent, $byTD);
            }

            $odb = new odb;

            //Если был выбран поиск по коду и не по наименованию, то нам сюда. обычно поиск по коду по умолчанию, эта опция отключена уже в прайсе, раньше там был крыжик
//                    $by_name=1;

//            if ($by_code == 0 and ($by_name == 0 or $by_name == "")) {
            if ($by_name == 0) {
                //Ищем по полям Code или sCode  по "точному" совпадению art% art1%
//                $where = "(code LIKE '$art%') or (code LIKE '$art1%') or (scode LIKE '$art%') or (scode LIKE '$art1%')";
                $where = "(scode LIKE '$art1%' or scode LIKE '$art')";
                $query = "select * from item where ($where) $where2 $exclude order by id asc;";
                $r = $odb->query_td($query);
                $n = $odb->num_rows($r);

                //Это абсолютно новый поиск по индексам по коду и по наименованию по НАЧАЛАМ СЛОВ! например не найдёт P2064 если искать 2064,
                // раньше в DB2 поиск ведётся по sName - это поле только в DB2,
                //
                if ($n == 0) {
                    $where = "";
                    $to_tsquery = "";
                    $artn = explode(" ", strtolower($art));

                    foreach ($artn as $artan) {
                        if (!empty($artan)) {
                            $to_tsquery .= "& $artan:*";
                        }
                    }

                    if (!empty($artn) | $artn != '') {
                        $where = " and  to_tsvector('english',I.Code||' '||I.name) @@ to_tsquery('";
                        $to_tsquery = substr($to_tsquery, 2);
                        $where .= $to_tsquery . "')";
                    }
//                echo $where ;
                    $query = "select * from Item I where id is not NULL $where $where2 $exclude order by id asc limit 55;";
                    $r = $odb->query_td($query);
                    $n = $odb->num_rows($r);
                }
//-------

//--------
//нафига эта переменна не пойму, вроде нигде не использвется пока что убираю
                $kol = $n;

                /*                дальше отключаю для тестов с строки 1104 по 1163

                                if ($n == 0) {
                                    //Если по точному не нашли ищем по полям Code и sCode  по  совпадению спереди кода %art% кроме sCode art1 и art2
                                    $where = "(code LIKE '%$art%') or (code LIKE '$art1%') or (scode LIKE '%$art%') or (scode LIKE '$art1%')";
                                    $query = "select * from item where ($where) $where2  $exclude order by id asc;";
                                    $r = $odb->query_td($query);
                                    $n = $odb->num_rows($r);
                                }
                                if ($n == 0) {
                                    //Если и так ничего не нашли ищем по совпадению спереди кода для всех вариантов
                                    $where = "(code LIKE '%$art%') or (code LIKE '%$art1%') or (scode LIKE '%$art%') or (scode LIKE '%$art1%')";
                                    $query = "select * from item where ($where) $where2 $where2  $exclude order by id asc;";
                                    $r = $odb->query_td($query);
                                    $n = $odb->num_rows($r);
                                }
                            }
                */
                //               если результат =0 или поиск в техдоке и не по наименованию
                if ((($n == 0) or ($n == 0) or ($byTD == 1)) and ($by_name == 0)) {
                    $query = "select
                                                  I.id as id,
                                                  I.code,
                                                  I.scode,
                                                  I.name,
                                                  I.flag,
                                                  I.help,
                                                  I.prod_id,
                                                  I.isImage
                                        from (select
                                                    DISTINCT P.code as code,
                                                    P.brand_id as prod_id1
                                              from car.ProductLookup L
                                                join car.Product P on P.id=L.product_id
                                              where scode=upper('$art1') ) T
                                        left outer join tdBrand B on B.brand_id=T.prod_id1
                                        left outer join Producent P on P.id=B.prod_id
                                        left outer join Item I on upper(I.scode)=T.code and I.prod_id=P.id
                                        where I.id is not null
                                        limit 150;
                                        ";
                    $r = $odb->query_td($query);
                    $n = $odb->num_rows($r);
                    $byTD = 1; //основной Признак что поиск проведён по TecDoc

                }
            }
            //            Если ничего не нашли по коду или был выбран поиск по наименованию пробуем искать по наименованию
            if (($n == 0) or ($by_name == 1)) {
//                echo $by_name;
                //Это абсолютно новый поиск по индексам по коду и по наименованию по НАЧАЛАМ СЛОВ! например не найдёт P2064 если искать 2064,
                // раньше в DB2 поиск ведётся по sName - это поле только в DB2,
                //
                $where = "";
                $to_tsquery = "";
                $artn = explode(" ", strtolower($artName));

                foreach ($artn as $artan) {
                    if (!empty($artan)) {
                        $to_tsquery .= "& $artan:*";
                    }
                }
                if (!empty($artn)) {
                    $where = " and to_tsvector('english',I.code||' '||I.name) @@ to_tsquery('";
                    $to_tsquery = substr($to_tsquery, 2);
                    $where .= $to_tsquery . "')";
                }
//                        echo $where ;
                $query = "select * from Item I where id is not NULL $where $where2 $exclude order by id asc limit 155;";
                $r = $odb->query_td($query);
                $n = $odb->num_rows($r);

            }

            /*
             * 
             */


            //Это поиск только по наименованию, поиск ведётся по sName - это поле только в DB2, надо уточнить чем оно отличается от обычного
            /*            if ($by_code == 0 and $by_name == 1) {
                $where = "";
                $artn = explode(" ", strtolower($artName));
                foreach ($artn as $artan) {
                    $where .= " and locate('$artan',sname)>0";
                }
                $query = "select * from item where id is not NULL $where $where2 $exclude order by id asc;";
                $r = $odb->query_td($query);
                $n = $odb->num_rows($r);
                $kol = $n;

            }*/

//нафига повторно запускать???? отключаю!
            $r = $odb->query_td($query);
            $list = "";


            //Если результат поисков больше 1 строк и пр-ль не выбран и поиск не через TecDoc, вывод таблицы произв. //исправлено 10/11/2015 раньше было $n>2
            if ($n > 1 and $by_producent == "" and $byTD <> 1) {
                $kt = -1;
                $k = 0;
                $proda_w = ""; //строка с несколькими prod_id  передаётся дальше в процедуру вывода табов
                while (odbc_fetch_row($r)) {
                    $prm = 0;
                    $k += 1;
                    $prod_id = odbc_result($r, "prod_id");
//                    $proda[$k] = $prod_id;
//                    $proda_w .= "or id= $prod_id";
                    $proda_w .= ",$prod_id";
                }
//                строка с несколькими prod_id  передаётся дальше в процедуру вывода табов
//                $proda_w .="where ".substr($proda_w, 3);
                $proda_w = "id in (" . substr($proda_w, 1) . ")";
                //Вывод табов производителей
                $form = $this->showProducentTabs($proda_w);
            }
            //Если результат поисков больше 16 строк и (выбран пр-ль или поиск по TD) и искали не по наименованию, готовим вывод результата поиска с аналогами
            if ($n > 16 and ($by_producent != "" or $byTD == 1) and ($by_name == 0 or $by_name == "")) {
                $form_htm = RD . "/tpl/catalogue_items1_list.htm";
                if (file_exists("$form_htm")) {
                    $form = file_get_contents($form_htm);
                }
                while (odbc_fetch_row($r)) {
                    $style = "";
                    $id = odbc_result($r, "id");
                    $code = odbc_result($r, "code");
                    if (strlen($code) > 11) {
                        $style = " style='font-size:12px;' ";
                    }
                    $list .= "<div class='ItemsTab' onclick='location.href=\"#search=$code\"'><a href='#search=$code' $style>$code</a></div>";
                    if ($i == 24) {
                        $i = $n + 1;
                        $list .= "<h3 style='color:red'>Результат поиска больше выведенного списка - конкретизируйте поиск</h3>";
                    }
                }
                $form = str_replace("{list}", $list, $form);
            }

            //Если результат поисков больше 16 строк и НЕ выбран пр-ль и искали  по наименованию, готовим вывод результата
            if ($n > 16 and $by_producent != "" and $by_name == 1) {
                $n = 16;
            }
            //Результат есть и не больше 16 строк - выводим список
            if (($n > 0 and $n <= 16)) {
                $kt = -1;
                $k = 0;
                $i = 1;
                while (odbc_fetch_row($r)) {
                    $prm = 0;
                    $price1 = "";
                    $i++;
                    $icon_flag = "";
                    $id = odbc_result($r, "id");
                    $code = odbc_result($r, "code");
                    $scode = odbc_result($r, "scode");
                    $name = odbc_result($r, "name");
                    $name = wordwrap($name, 45, '&shy;', true);
                    $flag = odbc_result($r, "flag");
                    $help = odbc_result($r, "help");

                    $prod_id = odbc_result($r, "prod_id");
                    $proda[$i] = $prod_id;
                    if ($by_producent == "") {
                        $producent = $prod_id;
                    }
                    //Добавлено Кузичкин 10/11/2015
                    //Если Результат поиска =1 и производитель не выбирался Записываем в список "История поисков" и в WebSearch
                    //print "$by_producent";
                    if (($n = 1) and $by_producent == "") {
                        $this->saveArtSearch($art, $by_name, $producent, $byTD);

                    }
                    $valuta_id = odbc_result($r, "val_id");
                    $discount_id = odbc_result($r, "discount_id");
                    $price = $slave->tomoney(odbc_result($r, "pricePro"));
//                    Цена клиента
//					$price_client=$this->getItemPrice($id,$valuta_id,$price,$discount_id);
                    $price_client = $this->getItemPrice2($id);

//                    $isImage = odbc_result($r, "isImage");
//                    $img = "<a href='javascript:showItemPhoto(\"" . strtoupper($id) . "\")'><img src='theme/images/photo_icon.png' border='0' alt='Фото' title='Фото'></a>";

                    $isImage = odbc_result($r, "isImage");
                    if (($isImage > 0) || (in_array($_SERVER['REMOTE_ADDR'], $this->remips))) {
                        $img = "<a href='javascript:showItemPhoto(\"" . strtoupper($id) . "\")'><img src='theme/images/photo_icon.png' border='0' alt='Фото' title='Фото'></a>";
                    } else {
                        $rem_ip = $_SERVER['REMOTE_ADDR'];
                        $img = "";
                    }

                    //наличие
                    list($quant, $quant1, $quant_r, $quant_p) = $this->getItemQuant($id);
                    $quant_r_img = "";
                    if ($quant_r > 0) {
                        $quant_r_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_reserv_icon.png' border='0' alt='Товар в резерве' title='Товар в резерве' align='middle' hspace='2'></a>";
                    }
                    $quant_p_img = "";
                    if ($quant_p > 0) {
                        $quant_p_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_prihod_icon.png' border='0' alt='Товар в приходе' title='Товар в приходе' align='middle' hspace='2'></a>";
                    }
                    $add_busket = "";//if ($price>0 and $quant!=""){$add_busket="<a href='javascript:show_busket_form(\"$id\")'><img src='theme/images/add_icon.png' border='0' alt='Добавить в заказ' title='Добавить в заказ'></a>";}
                    $add_busket = "<a href='javascript:show_busket_form(\"$id\")'><img src='theme/images/add_icon.png' border='0' alt='Добавить в заказ' title='Добавить в заказ'></a>";
//					if (($flag==1)|($flag==2)|($flag==5)){	$icon_flag="<img src='theme/images/best_price_icon.png' border='0' alt='СуперЦена' class='icon_button' onmouseover=\"tooltip.pop(this, '#d$id"."_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='d$id"."_tip'>$help</div></div>";	}
                    if ($flag == 7) {
                        $icon_flag = "<img src='theme/images/action_icon.png' border='0' alt='Акция' class='icon_button' onmouseover=\"tooltip.pop(this, '#a$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='a$id" . "_tip'>$help</div></div> onclick='showItemActionRemark(\"$id\");'>";
                    }
                    if ((($flag == 1) | ($flag == 2) | ($flag == 5) | ($flag == 6)) & ($quant > 0)) {
                        $icon_flag = "<img src='theme/images/best_price_icon.png' border='0' alt='СуперЦена' class='icon_button' onmouseover=\"tooltip.pop(this, '#d$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='d$id" . "_tip'>$help</div></div>";
                    }

                    if ($producent == $prod_id or $by_producent == $prod_id) {
                        $k++;
                        if ($k <= 15) {
//                            формирование списка позиций
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
                            if ($by_name == "" or $by_name == 0) {
                                $list .= $this->showItemAnalogSklad($id);
                            }
                        }
                    }
// Выводим сообщение клиенту о задолженности
                    $clnt->showMessageExp($client_id);

                    if ($k == 15) {
                        $i = $n + 1;
                        $list .= "<tr><td colspan=10 style='color:red; font-size:16px;' height='20' align='center'>Результат поиска больше выведенного списка - конкретизируйте поиск</td></tr>";
                    }
                }
            }
            //Устаревшее - Если результа поиска по коду и наименованию нет в Базе Ищем в TecDoc -
            /*			if ($n==0){
//				$remip=$_SERVER['REMOTE_ADDR'];	if ($remip=="78.152.169.139"){ $list.=$this->getTecdocAnalogList($art1);}
				$list.=$this->getTecdocAnalogList($art1);
			}
*/
            //Пустая страница - если ничего не найдено.
            if ($n == 0) {
                $list .= "
					<tr align='center' height='40' >
						<td colspan=20><h3></h3></td>
					</tr>
					<tr><td colspan=10 style='border-bottom:1px solid #58585a; font-size:2px;' height=2>&nbsp;</td></tr>";
            }

            $form = str_replace("{items_list}", $list, $form);
        }


        if (strlen($art) < 3) {
            $form = str_replace("{items_list}", "", $form);
        }
        $filter = "по коду";
        if ($by_name == "1") {
            $filter = "по названию";
        }
        if ($by_code == "1") {
            $filter .= " строгий поиск";
        }
        if ($by_sklad == "1") {
            $filter .= ", только наличие";
        }
        $form = str_replace("{art}", $art, $form);
        $form = str_replace("{filter}", $filter, $form);
        $form = str_replace("{kol_items}", $k, $form);
        $form = str_replace("{producent_list}", $this->showProducentList($proda), $form);
        return $form;
    }

    function get_art()
    {
        if ($_POST["art"] == "") {
            return $_GET["art"];
        }
        if ($_POST["art"] != "") {
            return $_POST["art"];
        }
    }

    function saveArtSearch($art, $by_name, $by_producent, $byTD)
    {
        //пока нет таблицы history_search и websearch тупо вываливаемся, когда появятся будем пробовать в них записывать.
        //return;

        session_start();
        $odb = new odb;
        $client = $_SESSION["client"];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $remip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $remip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $remip = $_SERVER['REMOTE_ADDR'];
        }
        if ($by_name == 1) {
            $by_code = 0;
        } else {
            $by_code = 1;
        }
        $data = date("Y-m-d H:i:s");
        $client = $client + 0;
        $by_producent = $by_producent + 0;
        $query1 = "insert into history_search (client,art,data,ip,prod_id) values ('$client','" . strtolower($art) . "','$data','$remip',$by_producent)";
        // $query1="insert into history_search (client,art,data,ip) values ('$client','$art','$data','$remip')";
        $query2 = "insert into websearch (klient_id,nodeaddress,str,iscode,prod_id) values ($client,'$remip','" . strtolower($art) . "','$by_code',$by_producent)";

        //если клиент пусто то выполнить какую то ерунду????
        if ($client == 0) {
            $er = 1;
            $search_count = $_SESSION["search_count"];
            if ($search_count == "") {
                $search_count = 1;
            }
            for ($i = $search_count; $i <= $search_count; $i++) {
                $art_ses = $_SESSION["artSearch$i"];
                $art_Prod_id = $_SESSION["artProd_id$i"];
                if (($art_ses == $art) and ($art_Prod_id == $by_producent)) {
                    $er = 0;
                }
            }
            if (($er == 1) and ($by_producent != 0)) {
                $search_count += 1;
                $_SESSION["search_count"] = $search_count;
                $_SESSION["artSearch$search_count"] = $art;
                $_SESSION["artProd_id$search_count"] = $by_producent;
                $odb->query_td($query1);
                $odb->query_td($query2);

                $this->saveToFileWS($query2);

            }
        }

        //если клиент НЕ пусто то выполнить какую то другую ерунду, которая по идее делает так шоб в историю и в вебы не дублировалась информация.
        if ($client != 0) {
            $er = 0;

            //Проверяем есть ли запись в History_Search по клиенту
            // $query="select art from history_search where client='$client' order by id desc limit 1 offset 0";
            $query = "select art,prod_id,(date(now())-date(data)) as ago from history_search where client='$client' and art='" . strtolower($art) . "' and prod_id='$by_producent' order by id desc limit 1 offset 0";  //and (days(current date)-days(data))>0
            //Это сколько дней назад был поиск  >> "and (days(current date)-days(data))=0" реализовано через if ниже $ago>0

            $r = $odb->query_td($query);
            $n = $odb->num_rows($r);
            $ago = odbc_result($r, "ago"); //Это сколько дней назад был поиск
            // print "$by_producent";

            // Если клиент НЕ искал Артикул по Данному Производителю добавить поиск в historySearch и WebSearch
            if ($n == 0) {
                $odb->query_td($query1);
                $odb->query_td($query2);

                $this->saveToFileWS($query2);

//				 print "FIND!!!! $art_ses' и '$art' </n>'";
            } else
                if ($ago > 0) {
                    $odb->query_td($query2);
                    $this->saveToFileWS($query2);


//				 print "FINDING!!!! $art_ses' и '$art' </n>'";
                }
        }
        $query_td = "insert into websearch (klient_id,nodeaddress,str,iscode,prod_id) values ($client,'$remip','$art','$by_code','9999')";
        if ($byTD == 1) {
            $odb->query_td($query_td);
            $this->saveToFileWS($query_td);
        }
    }

    function saveToFileWS($q)
    {
        $fp = fopen(RD . '/lib/odbc_errors/websearch.txt', 'a+');
        fwrite($fp, $q . ": PG-> Time =" . date("Y-m-d H:i:s") . "\r\n");
        fclose($fp);

    }

//    function showProducentTabs($proda)
//аргумент $proda заменил на $proda_w - вместо массива $proda передаю строку $where
    function showProducentTabs($proda)
    {
        $odb = new odb;
//        $where = "";
        if ($proda != "") {
            $form_htm = RD . "/tpl/catalogue_producent_list.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
//            Отключаю эту часть, потому что решил что лучше строку $where подготовить раньше, в цикле когда готовится массив $proda
//            foreach ($proda as $prod_id) {
//                $where .= " or id='$prod_id' ";
//            }
//            if ($where != "") {
//                $where = " where " . substr($where, 3);

            $where = "where " . $proda;
            $query = "SELECT * FROM producent $where order by name;";
            $r = $odb->query_td($query);
            while (odbc_fetch_row($r)) {
                $id = odbc_result($r, "id");
                $name = odbc_result($r, "name");
                $list .= "<div class='ProducentTab' onclick='search_biproducent(\"$id\")'><a href='#$name' onclick='search_biproducent(\"$id\")'>$name</a></div>";
//                }

            }
            $form = str_replace("{list}", $list, $form);
        }
        return $form;
    }

    function showItemAnalogSklad($item_id, $itemsArr = Null)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        if ($itemsArr == Null) {
            list($itemsArr, $kolItems, $dopsArr) = $this->createAnalogList($item_id, 0, 0);/*$itemsArr[0]=$item_id; list($itemsArr,$kolItems)=$this->createAnalogList($itemsArr,$itemsArr,0,0);*/
        }
        $exclude = " and prod_id not in (1134) and COALESCE( (sign & 2),0)=0";
        $where = "";
        foreach ($itemsArr as $item) {
            $where .= " id='$item' or";
        }
        if ($where != "") {
            $where = " where (" . substr($where, 0, -3) . ") $exclude";
        }
        $r = $odb->query_td("select * from item $where;");
        $kol = $n;
        $list = "";
        $flist = "";
        $i = 0;
        $kt = -1;
        while (odbc_fetch_row($r)) {
            $prm = 0;
            $price1 = "";
            $i++;
            $icon_flag = "";
            $id = odbc_result($r, "id");
            $code = odbc_result($r, "code");
            if ($id == $item_id) {
                $item_scode = $code;
            }
            if ($id != $item_id) {
                $scode = odbc_result($r, "scode");
                $name = odbc_result($r, "name");
                $name = wordwrap($name, 45, '&shy;', true);
                $flag = odbc_result($r, "flag");
                $help = odbc_result($r, "help");
                $valuta_id = odbc_result($r, "val_id");
                $discount_id = odbc_result($r, "discount_id");
                $price = $slave->tomoney(odbc_result($r, "pricePro"));

                //$price_client=$this->getItemPrice($id,$valuta_id,$price,$discount_id);
                $price_client = $this->getItemPrice2($id);
                $isImage = odbc_result($r, "isImage");
                if ($isImage > 0) {
                    $img = "<a href='javascript:showItemPhoto(\"" . strtoupper($id) . "\")'><img src='theme/images/photo_icon.png' border='0' alt='Фото' title='Фото'></a>";
                } else {
                    $img = "";
                }

                list($quant, $quant1, $quant_r, $quant_p) = $this->getItemQuant($id);
                $quant_r_img = "";
                if ($quant_r > 0) {
                    $quant_r_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_reserv_icon.png' border='0' alt='Товар в резерве' title='Товар в резерве' align='middle' hspace='2'></a>";
                }
                $quant_p_img = "";
                if ($quant_p > 0) {
                    $quant_p_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_prihod_icon.png' border='0' alt='Товар в приходе' title='Товар в приходе' align='middle' hspace='2'></a>";
                }
                if ($flag == 7) {
                    $icon_flag = "<img src='theme/images/action_icon.png' border='0' alt='Акция' class='icon_button' onmouseover=\"tooltip.pop(this, '#a$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='a$id" . "_tip'>$help</div></div> onclick='showItemActionRemark(\"$id\");'>";
                }
                if (($flag == 6) & ($quant > 0)) {
                    $icon_flag = "<img src='theme/images/best_price_icon.png' border='0' alt='СуперЦена' class='icon_button' onmouseover=\"tooltip.pop(this, '#d$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='d$id" . "_tip'>$help</div></div>";
                }
                if ($quant != "" or $quant1 != "" or $quant_r != "" or $quant_p != "") {
                    $add_busket = "<a href='javascript:show_busket_form(\"$id\")'><img src='theme/images/add_icon.png' border='0' alt='Добавить в заказ' title='Добавить в заказ'></a>";
                    $dop_icon = "";
                    if ($dopsArr[$id] == 1) {
                        $dop_icon = "<img src='/theme/images/aditional_icon.png' border=0 title='Дополнительный аналог'>";
                    }
                    if ($dop_icon == "") {
                        $flist .= "
						<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>
						<tr align='center' id='ri$id' height='25' style='background-color:#dcdcdc;color:#000;'>
							<td width='5'>$icon_flag</td>
							<td></td>
							<td><a class='desc' href='javascript:search_biart(\"$code\");' style='text-decoration:none;'>$code</a></td>
							<td align='left'>$name</td>
							<td align='right'>$price</td>
							<td align='right'>$price_client</td>
							<td>$quant_p_img $quant_r_img <a href='javascript:showItemSklad(\"$id\")'>$quant</a></td>
							<td><a href='javascript:showItemSklad(\"$id\")'>$quant1</a></td>
							<td>$img</td>
							<td>$add_busket</td>
						</tr>";
                    }
                    if ($dop_icon != "") {
                        $list .= "
						<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>
						<tr align='center' id='ri$id' height='25' style='background-color:#dcdcdc;color:#000;'>
							<td width='5'>$icon_flag</td>
							<td>$dop_icon</td>
							<td><a class='desc' href='javascript:search_biart(\"$code\");' style='text-decoration:none;'>$code</a></td>
							<td align='left'>$name</td>
							<td align='right'>$price</td>
							<td align='right'>$price_client</td>
							<td>$quant_p_img $quant_r_img <a href='javascript:showItemSklad(\"$id\")'>$quant</a></td>
							<td><a href='javascript:showItemSklad(\"$id\")'>$quant1</a></td>
							<td>$img</td>
							<td>$add_busket</td>
						</tr>";
                    }
                }
            }
        }
        $list = $flist . $list;
        if ($list != "") {
            $list = "
				<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>
				<tr><td colspan=10>
				<table width='97%' border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=10 style='font-size:2px;' height=2>&nbsp;</td></tr>
				<tr height='20'>
					<td class='leftAnalog'></td>
					<td class='Analog' width='25'></td>
					<td class='Analog' width='100' align='center'><img src='/theme/images/analoArrow.png' border=0></td>
					<td class='Analog' width='400'>Аналоги в наличии</td>
					<td class='Analog' width='60' align='right'>Цена</td>
					<td class='Analog' width='60' align='right'>Цена2</td>
					<td class='Analog' width='80' align='right'>Склад</td>
					<td class='Analog' width='80' align='right'>Экспр.</td>
					<td class='Analog'>&nbsp;</td>
					<td class='rightAnalog'></td>
				</tr>
				<tr><td colspan=10 style='border-bottom:1px solid #58585a; font-size:2px;' height=2>&nbsp;</td></tr>" . $list . "
				
				</table></td></tr><tr><td colspan=10 style='font-size:15px;' height=15>&nbsp;</td></tr>";
        }
        return $list;
    }

    function createAnalogList($item_id, $kolItems, $step)
    {
        $odb = new odb;
        $i = 0;
        $itemsArr = array();
        $dopsArr = array();
        $odb->query_td("select listanalog($item_id);");
        $r = $odb->query_td("select * from analogtemp order by lev,item_id asc;");
        while (odbc_fetch_row($r)) {
            $i += 1;
            $lev = odbc_result($r, "lev");
            $itemId = odbc_result($r, "item_id");
            $dop = odbc_result($r, "dop");
            $itemsArr[$i] = $itemId;
            $dopsArr[$itemId] = $dop;
        }
        return array($itemsArr, $i, $dopsArr);
    }


    /** @function showProducentList - выводит для выбора список производителей с ссылками на поиск по производителю
     * @param $proda - массив производителей
     * @return string - форма вывода "табов" производителей
     */
    function showProducentList($proda)
    {
        $odb = new odb;
        $where = "";
        if ($proda != "") {
//            из массива производителей $proda - создаём строку запроса типа "id=1 or id=2...."
            foreach ($proda as $prod_id) {
                $where .= " or id='$prod_id' ";
            }
            if ($where != "") {
//                обрезаем "or " в начале полученной строки списка производителей.
                $where = " where " . substr($where, 3);
//                выводим максимум 10 производителей чтоб не загромождать выбор
                $r = $odb->query_td("SELECT * FROM producent $where order by name limit 10");
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

    function catalogue_sto_items($producent = 0, $category = 0, $otype = 0)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        if ($producent == 0) {
            $producent = $_GET["producent"];
        }
        if ($category == 0) {
            $category = $_GET["category"];
        }
        if ($otype == 0) {
            $otype = $_GET["otype"];
        }
        $form_htm = RD . "/tpl/catalogue_sto_items_list.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $form = str_replace("{sto_producent}", $this->showStoProducent($producent), $form);
        $form = str_replace("{sto_category}", $this->showStoCategory($producent, $category), $form);
        $form = str_replace("{sto_otype}", $this->showStoOtype($category, $otype), $form);

        $where = "";
        if ($producent != 0) {
            $where .= " and producent='$producent'";
        }
        if ($category != 0) {
            $where .= " and category='$category'";
        }
        if ($otype != 0) {
            $where .= " and otype='$otype'";
        }

        $r = $odb->query_td("select * from sto_items where ison='1' $where order by id asc limit 20");
        $list = "";
        $i = 0;
        while (odbc_fetch_row($r)) {
            $i++;
            $id = odbc_result($r, "id");
            $code = odbc_result($r, "code");
            $item_id = $this->getItemId($code);
            list($c, $name, $price, $c, $image) = $this->getItemInfo($item_id);
            $image = str_replace(" height='150'", " width='40'", $image);
            $img = "<a href='javascript:showItemPhoto(\"" . strtoupper($item_id) . "\")'>$image</a>";
            $add_busket = "<a href='javascript:show_busket_form(\"$item_id\")'><img src='theme/images/add_icon.png' border='0' alt='Добавить в заказ' title='Добавить в заказ'></a>";
            $rem_ip = $_SERVER['REMOTE_ADDR'];
            $edit_item = "";
            $drop_item = "";
            if (in_array($rem_ip, $this->remips)) {
                $drop_item = "<a href='javascript:if(confirm(\"Удалить оборудование?\")){ window.location.href=\"?dep=23&w=drop_sto_item&conf=true&id=$id\"}'>d</a>";
            }
            $list .= "
			<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>
			<tr align='center' id='ri$id' height='25'>
				<td>$drop_item</td>
				<td><strong>$code</strong></td>
				<td align='left'><strong>$name</strong></td>
				<td align='right'>$price</td>
				<td>$img</td>
				<td>$add_busket</td>
			</tr>";

        }
        if ($i == 0) {
            $list .= "
			<tr align='center' height='40' >
				<td colspan=20><h3>Оборудование не найдено</h3></td>
			</tr>
			<tr><td colspan=10 style='border-bottom:1px solid #58585a; font-size:2px;' height=2>&nbsp;</td></tr>";
        }
        $form = str_replace("{items_list}", $list, $form);
        return $form;
    }

    function showStoProducent($producent = 0)
    {
        $odb = new odb;
        $slave = new slave;
        $menu .= "<select name='sto_producent' id='sto_producent' size=1 class='tecFilter' onchange='loadStoProducentFilter(this[this.selectedIndex].value);'><option value='0'> --- выберете производителя ---  </option>";
        $r = $odb->query_td("select * from sto_producent where ison='1' order by id asc");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
            $name = odbc_result($r, "name");
            if ($producent == $id) {
                $menu .= "<option value='$id' selected='selected'>$name</option>";
            }
            if ($producent != $id) {
                $menu .= "<option value='$id'>$name</option>";
            }
        }
        $menu .= "</select>";
        return $menu;
    }

    function showStoCategory($producent = 0, $category = 0)
    {
        $odb = new odb;
        $slave = new slave;
        $menu .= "<select name='sto_category' id='sto_category' size=1 class='tecFilter' onchange='loadStoCategoryFilter(\"$producent\",this[this.selectedIndex].value);'><option value='0'> --- выберете категорию оборудование ---  </option>";
        $r = $odb->query_td("select * from sto_category where producent='$producent' and ison='1' order by id asc");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
            $name = odbc_result($r, "name");
            if ($category == $id) {
                $menu .= "<option value='$id' selected='selected'>$name</option>";
            }
            if ($category != $id) {
                $menu .= "<option value='$id'>$name</option>";
            }
        }
        $menu .= "</select>";
        return $menu;
    }

    function showStoOtype($category = 0, $otype = 0)
    {
        $odb = new odb;
        $slave = new slave;
        $menu .= "<select name='sto_otype' id='sto_otype' size=1 class='tecFilter' onchange='loadStoOtypeFilter(\"$category\",this[this.selectedIndex].value);'><option value='0'> --- выберете тип оборудование ---  </option>";
        if ($category != 0 and $category != "") {
            $r = $odb->query_td("select * from sto_otype where category='$category' and ison='1' order by id asc");
            while (odbc_fetch_row($r)) {
                $id = odbc_result($r, "id");
                $name = odbc_result($r, "name");
                if ($otype == $id) {
                    $menu .= "<option value='$id' selected='selected'>$name</option>";
                }
                if ($otype != $id) {
                    $menu .= "<option value='$id'>$name</option>";
                }
            }
        }
        $menu .= "</select>";
        return $menu;
    }

    function getItemId($code)
    {
        $odb = new odb;
        $r = $odb->query_td("select id from item where code='$code' limit 1 offset 0;");
        $id = "";
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
        }
        return $id;
    }

    function getItemInfo($item_id)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $r = $odb->query_td("select * from item where id='$item_id' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $code = odbc_result($r, "code");
            $name = str_replace("'", "&rsquo;", odbc_result($r, "name"));
            $valuta_id = odbc_result($r, "val_id");
            $discount_id = odbc_result($r, "discount_id");
            $price = $slave->tomoney(odbc_result($r, "pricePro"));
            //$price_client=$this->getItemPrice($item_id,$valuta_id,$price,$discount_id);
            $price_client = $this->getItemPrice2($item_id);
            $image = $this->getItemPhoto($item_id, 100);
            $sklad = $this->showItemSklad($item_id);
        }
        return array($code, $name, $price_client, $sklad, $image);
    }

    function getItemPhoto($item_id, $size = 100, $height = "", $align = "center", $class = "", $stec = "1")
    {
        $odb = new odb;
        $ihgt = "";
        $form_htm = RD . "/tpl/catalogue_items_photo.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        list($caption, $code) = $this->getItemCaptionCode($item_id);
        $r = $odb->query_td("select * from itemimages where item_id='$item_id';");
        $td_ex = 10;
        $list = "";
        while (odbc_fetch_row($r)) {
            $file_name = odbc_result($r, "file_name");
            if ($height != "") {
                $ihgt = " height='$height'";
                if ($height <= 75) {
                    $height .= "&bl=1";
                }
            }
            $list = "<img src='thumb.php?image=lider/$file_name&size=$size&height=$height' border=0 align='$align' $ihgt alt='$caption' title='$caption' class='$class'>";
            $td_ex = 1;
            break;
        }
        if ($td_ex == 0 and $stec == 1) {
            $article_id = $this->getArticleId($code, $item_id);
            $soap = new SoapClient(TecdocToCat, array('trace' => true,));
            try {
                $result = $soap->getArticleDocuments(array(
                    'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                    'articleId' => $article_id,
                ));
                $result = $result->data->array;
                $caption = "";
                foreach ($result as $item) {
                    $docId = $item->docId;
                    $docFileName = $item->docFileName;
                    $fileExts = explode('.', $docFileName);
                    foreach ($fileExts as $fileExt) {
                        $ext = strtolower($fileExt);
                    }
                    $exten = array('jpg', 'png', 'gif', 'bmp');
                    if (in_array($ext, $exten)) {
                        $handle = fopen(TecdocToCatDoc . "/20122/$docId/0", "rb");
                        $docImage = stream_get_contents($handle);
                        fclose($handle);
                        $fp = fopen('uploads/images/lider/' . $item_id . '_td.jpg', 'w');
                        fwrite($fp, $docImage);
                        fclose($fp);
                        $odb->query_td("insert into itemimages (id,item_id,file_name,istd) values ((select max(id)+1 from itemimages),'$item_id','$item_id" . "_td.jpg','1');");
                        $list = "<img src='thumb.php?image=lider/$item_id" . "_td.jpg&size=100&height=$height' border=0 align='$align' $ihgt alt='$caption' title='$caption' class='$class'>";
                    }
                }
            } catch (SoapFault $e) {
            }

        }
        return $list;
    }

//поиск товара

    function getItemCaptionCode($item_id)
    {
        $odb = new odb;
        $r = $odb->query_td("select code,Name from item where id='$item_id' limit 1 offset 0;");
        $caption = "";
        $code = "";
        while (odbc_fetch_row($r)) {
            $caption = odbc_result($r, "Name");
            $code = odbc_result($r, "code");
        }
        return array($caption, $code);
    }

    function getArticleId($code, $item_id)
    {
        $odb = new odb;
        $articleId = 0;
        $r = $odb->query_td("select article_id,data from item_tecdoc where item_id='$item_id' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $articleId = odbc_result($r, "article_id");
            $articleData = odbc_result($r, "data");
        }
        if ($articleId == 0 and $code != "") {
            $code2 = substr($code, 0, 7);
            list($p, $brandNo, $p) = $this->getItemProducentTd($item_id);
            if (substr($code, 0, 2) == "BC") {
                $code = "";
            }
//правило для SIDEM
            if (substr($code, -3, 3) == "sid") {
                $code = str_replace(" sid", "", $code);
            }
//правило для ERT
            if ($brandNo == "4512" and substr($code, 0, 1) == "E") {
                $code = substr($code, 1);
            }
//правило для GATES
            if ($brandNo == "33" and substr($code, -3, 3) == "gat") {
                $code = str_replace(" gat", "", $code);
            }

            $soap = new SoapClient(TecdocToCat, array('trace' => true,));
            try {
                $result = $soap->getArticleDirectSearchAllNumbers2(array(
                    'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                    'sortType' => '0',
                    'searchExact' => 'true',
                    'numberType' => '0',
                    'genericArticleId' => '',
                    'brandno' => $brandNo,
                    'articleNumber' => $code,
                ));
                $empty = $result->data->empty;
                if (!$empty) {
                    $result = $result->data->array;
                    foreach ($result as $item) {
                        $articleId = $item->articleId;
                        $articleName = $item->articleName;
                        $brandName = $item->brandName;
                    }
                }
                if ($empty) {
                    $result = $soap->getArticleDirectSearchAllNumbers2(array(
                        'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                        'sortType' => '1',
                        'searchExact' => 'true',
                        'numberType' => '1',
                        'genericArticleId' => '',
                        'brandno' => $brandNo,
                        'articleNumber' => $code,
                    ));
                    $empty = $result->data->empty;
                    if (!$empty) {
                        $result = $result->data->array;
                        foreach ($result as $item) {
                            $articleId = $item->articleId;
                            $articleName = $item->articleName;
                            $brandName = $item->brandName;
                        }
                    }
                    if ($empty) {
                        $result = $soap->getArticleDirectSearchAllNumbers2(array(
                            'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                            'sortType' => '1',
                            'searchExact' => 'true',
                            'numberType' => '2',
                            'genericArticleId' => '',
                            'brandno' => $brandNo,
                            'articleNumber' => $code,
                        ));
                        $empty = $result->data->empty;
                        if (!$empty) {
                            $result = $result->data->array;
                            foreach ($result as $item) {
                                $articleId = $item->articleId;
                                $articleName = $item->articleName;
                                $brandName = $item->brandName;
                            }
                        }
                        if ($empty) {
                            list($p, $brandNo, $p) = $this->getItemProducentTd($item_id);
                            $result = $soap->getArticleDirectSearchAllNumbers2(array(
                                'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                                'sortType' => '1',
                                'searchExact' => 'true',
                                'numberType' => '3',
                                'genericArticleId' => '',
                                'brandno' => $brandNo,
                                'articleNumber' => $code,
                            ));
                            $empty = $result->data->empty;
                            if (!$empty) {
                                $result = $result->data->array;
                                foreach ($result as $item) {
                                    $articleId = $item->articleId;
                                    $articleName = $item->articleName;
                                    $brandName = $item->brandName;
                                }
                            }
                            if ($empty) {
                                $result = $soap->getArticleDirectSearchAllNumbers2(array(
                                    'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                                    'sortType' => '1',
                                    'searchExact' => 'true',
                                    'numberType' => '0',
                                    'genericArticleId' => '',
                                    'brandno' => $brandNo,
                                    'articleNumber' => $code2,
                                ));
                                $result = $result->data->array;
                                foreach ($result as $item) {
                                    $articleId = $item->articleId;
                                    $articleName = $item->articleName;
                                    $brandName = $item->brandName;
                                }
                            }
                        }
                    }
                }
            } catch (SoapFault $e) {
            }
            $this->addTecdocArticleId($item_id, $articleId, iconv("utf-8", "windows-1251", $articleName), iconv("utf-8", "windows-1251", $brandName), $brandNo);
        }
        return $articleId;
    }

    function getItemProducentTd($item_id)
    {
        $odb = new odb;
        $r = $odb->query_td("select prod_id from item where id='$item_id' limit 1 offset 0;");
        $prod_id = "";
        $prod_td_id = "";
        while (odbc_fetch_row($r)) {
            $prod_id = odbc_result($r, "prod_id");
            break;
        }
        $r = $odb->query_td("select tdid,name from producent where id='$prod_id' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $prod_td_id = odbc_result($r, "tdid");
            $prod_name = odbc_result($r, "name");
            break;
        }
        return array($prod_id, $prod_td_id, $prod_name);
    }

    function addTecdocArticleId($item_id, $articleId, $articleName = Null, $brandName = Null, $brandNo = 0)
    {
        $odb = new odb;
//		if ($articleId!=0){$odb->query_td("insert into item_tecdoc (item_id,article_id,data,article_name,brand_name,brand_no) values ('$item_id','$articleId','".date("Y-m-d")."','$articleName','$brandName','$brandNo');"); }
        return;
    }

    function showItemSklad($item_id)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        list($listPlaceExpr, $listPlaceKm) = $this->getSkladIDS();
        $form_htm = RD . "/tpl/catalogue_item_sklad.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $list = "";
        $r = $odb->query_td("SELECT S.SubConto_id as id, s.quant,S.kind FROM store S inner join subconto sc on (sc.id=S.SubConto_id) WHERE  S.item_id = '$item_id' and sc.code in ($listPlaceKm) AND (S.kind = '1' or S.kind = '2' or S.kind = '4') order by S.kind asc;");
        $kol = array();
        $k = 0;
        $kol[1] = 0;
        $kol[2] = 0;
        $kol[4] = 0;
        $sklad_name = "Хмельницкий";
        $prev_kind = 0;
        while (odbc_fetch_row($r)) {
            //$sklad_id=odbc_result($r,"id");list($sklad,$remark)=$this->getSkladName($sklad_id);
            $quant = (float)($slave->tomoney(odbc_result($r, "quant")));
            $kind = odbc_result($r, "kind");
            $kol[$kind] += $quant;
            if ($kind != $prev_kind) {
                $prev_kind = $kind;
                $k += 1;
            }

        }
        if ($k > 0) {
            //$color=" bgcolor='yellow'"; if ($sklad_name=="Хмельницкий"){$color="";}
            $list .= "
			<tr align='center' height='25' $color>
				<td align='left'>$sklad_name</td>";
            for ($i = 1; $i <= 3; $i++) {
                if ($i == 1) {
                    $kol[1] -= $kol[2];
                }
                if ($kol[$i] > 10) {
                    $kol[$i] = ">10";
                }
                if ($kol[$i] == "0") {
                    $kol[$i] = "";
                }
                $list .= "<td>" . $kol[$i] . "</td>";
            }
            $list .= "
			</tr><tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>";
        }
        $r = $odb->query_td("SELECT S.SubConto_id as id, s.quant,S.kind FROM store S inner join subconto sc on (sc.id=S.SubConto_id) WHERE  S.item_id = '$item_id' and sc.code in ($listPlaceExpr) AND (S.kind = '1' or S.kind = '2' or S.kind = '4') order by S.SubConto_id,S.kind asc;");

        $prev_kind = 0;
        $kol = array();
        $sklads = array();
        $prev_skald = "";
        $k = 0;
        $s = 0;
        while (odbc_fetch_row($r)) {
            $sklad_id = odbc_result($r, "id");
            list($sklad, $remark) = $this->getSkladName($sklad_id);
            $kind = odbc_result($r, "kind");
            $quant = (float)($slave->tomoney(odbc_result($r, "quant")));

            if ($sklad_id != $prev_sklad) {
                $prev_sklad = $sklad_id;
                $s += 1;
                if ($remark == "") {
                    $remark = $sklad;
                }
                $sklads[$s] = $remark;
            }
            $kol[$s][$kind] += $quant;
            if ($kind != $prev_kind) {
                $prev_kind = $kind;
                $k += 1;
            }
        }
        if ($s > 0) {
            for ($j = 1; $j <= $s; $j++) {
                $list .= "
				<tr align='center' height='25' bgcolor='yellow'>
					<td align='left'>" . $sklads[$j] . "</td>";
                for ($i = 1; $i <= 3; $i++) {
                    if ($kol[$j][$i] > 10) {
                        $kol[$j][$i] = ">10";
                    }
                    $list .= "<td>" . $kol[$j][$i] . "</td>";
                }
                $list .= "
				</tr><tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>";
            }
        }
        $form = str_replace("{list}", $list, $form);
        return $form;
    }

    function getSkladName($id)
    {
        session_start();
        $odb = new odb;
        $name = "";
        $r = $odb->query_td("SELECT Name,remark FROM subconto WHERE id = '$id' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $name = odbc_result($r, "Name");
            $remark = odbc_result($r, "Remark");
        }
        return array($name, $remark);
    }

    function loadTecGroupsList($manufacture, $model, $modification)
    {
        $slave = new slave;
        include(RD . "/lib/dhtmlgoodies_tree.class.php");
        $form_htm = RD . "/tpl/catalogue_tecdoc_groups.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $result = $soap->getLinkedChildNodesAllLinkingTarget(array(
                'provider' => PROVIDER_ID,
                'parentNodeId' => '',
                'linkingTargetType' => 'C',
                'linkingTargetId' => $modification,
                'lang' => 'ru',
                'country' => 'ru',
                'childNodes' => true,
            ));
            $result = $result->data->array;
            $tree = new dhtmlgoodies_tree();
            foreach ($result as $item) {
                $id = $item->assemblyGroupNodeId;
                $caption = iconv("utf-8", "windows-1251", $item->assemblyGroupName);
                $child = $item->hasChilds;
                $parrent = $item->parentNodeId;
                if ($parrent == "") {
                    $parrent = 0;
                }
                $tree->addToArray($id, $caption, $parrent, "#groups=$id/$model/$modification/$manufacture", "", $child, "");
            }
            $tree->writeCSS();
            $tree->writeJavascript();
            $menu = $tree->drawTree();
            $form = str_replace("{menu}", $menu, $form);
        } catch (SoapFault $e) {
        }
        $manufacture_caption = $this->get_manufacture_caption($manufacture);
        $model_caption = $this->get_tecmodel_caption($manufacture, $model);
        $modification_caption = $this->get_modification_caption($manufacture, $model, $modification);
        $form = str_replace("{navigation_caption}", $manufacture_caption . " - " . $model_caption . " - " . $modification_caption, $form);
        return $form;
    }

    function get_manufacture_caption($manufacture)
    {
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $result = $soap->getVehicleManufacturers3(array(
                'provider' => PROVIDER_ID, 'lang' => 'en', 'country' => 'RU', 'carType' => 1, 'countriesCarSelection' => 'RU', 'countryGroupFlag' => false, 'evalFavor' => false,
            ));
            $result = $result->data->array;
            $scaption = "";
            foreach ($result as $item) {
                $id = $item->manuId;
                $caption = $this->decodeLan(iconv("utf-8", "windows-1251", $item->manuName));
                if ($manufacture == $id) {
                    $scaption = $caption;
                    break;
                }
            }
        } catch (SoapFault $e) {
        }
        return $scaption;
    }

    function get_tecmodel_caption($manufacture, $model)
    {
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $result = $soap->getVehicleModels3(array(
                'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'RU', 'carType' => 1, 'countriesCarSelection' => 'RU', 'countryGroupFlag' => false, 'evalFavor' => false,
                'favouredList' => 1, 'manuId' => $manufacture,
            ));
            $result = $result->data->array;
            $caption = "";
            foreach ($result as $item) {
                $id = $item->modelId;
                if ($model == $id) {
                    $caption = iconv("utf-8", "windows-1251", $item->modelname);
                    $year_from = $this->tecdoc_data_split($item->yearOfConstrFrom);
                    $year_to = $this->tecdoc_data_split($item->yearOfConstrTo);
                    $caption = "$caption ($year_from - $year_to)";
                    break;
                }
            }
        } catch (SoapFault $e) {
        }
        return $caption;
    }

    function get_modification_caption($manufacture, $model, $modification)
    {
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $result = $soap->getVehicleSimplifiedSelection3(array(
                'provider' => PROVIDER_ID,
                'modId' => $model,
                'manuId' => $manufacture,
                'linked' => false,
                'lang' => 'ru',
                'favouredList' => 0,
                'countryGroupFlag' => false,
                'countriesCarSelection' => 'ru',
                'countriesUserSetting' => 'ru',
                'carType' => 1,

            ));
            $result = $result->data->array;
            foreach ($result as $item) {
                $id = $item->carDetails->carId;
                $caption = iconv("utf-8", "windows-1251", $item->carDetails->carName);
                $powerHpFrom = iconv("utf-8", "windows-1251", $item->carDetails->powerHpFrom);
                if ($modification == $id) {
                    $caption .= " ($powerHpFrom л.с.)";
                    break;
                }
            }
        } catch (SoapFault $e) {
        }
        return $caption;
    }

    function showRecomendList($place)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        if ($place == "") {
            $form_htm = RD . "/tpl/recomend_side.htm";
        }
        if ($place == "news") {
            $form_htm = RD . "/tpl/bottom_slide.htm";
        }
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }

        $form_htm = RD . "/tpl/recomend_item.htm";
        if (file_exists("$form_htm")) {
            $block = file_get_contents($form_htm);
        }
        $r = $odb->query_td("select * from catalogue_recomend order by id desc limit 100;");
        $list = "";
        while (odbc_fetch_row($r)) {
            $model = odbc_result($r, "model");
            $list .= "<li>$block</li>";

            list($name, $code) = $this->getItemCaptionCode($model);
            $pic = $this->getItemPhoto($model, 75, 75, "left", "newsImg", 0);
            if ($place == "") {
                $url = "javascript:search_biart('$code');";
            }
            if ($place != "") {
                $url = "?dep=23&dep_up=0&dep_cur=3#search=$code";
            }
            $list = str_replace("{code}", $code, $list);
            $list = str_replace("{pic}", $pic, $list);
            $list = str_replace("{url}", $url, $list);
            $list = str_replace("{name}", $name, $list);
        }
        $form = str_replace("{list}", $list, $form);
        $form = str_replace("{bottom_slide_caption}", "Рекомендуем", $form);
        $form = str_replace("{bottom_slide}", $list, $form);
        return $form;
    }

    function getRandomItem()
    {
        $odb = new odb;
        //$r=$odb->query_td("select code from item order by rand() limit 1 offset 0;");$code="";while(odbc_fetch_row($r)){$code=odbc_result($r,"code");}return $code;
        return "3397001543";
    }

    function getItemCaption($item_id)
    {
        $odb = new odb;
        $r = $odb->query_td("select code,Name from item where id='$item_id' limit 1 offset 0;");
        $caption = "";
        while (odbc_fetch_row($r)) {
            $caption = odbc_result($r, "code") . " " . odbc_result($r, "Name");
        }
        return $caption;
    }

    function getItemIdArray($code)
    {
        $odb = new odb;
//		foreach()
        $code = strtolower(str_replace(array('_', '-', '—', '/', '.', ',', '\\', ' '), "", trim($code)));
        $r = $odb->query_td("select id from item where code='$code' limit 1 offset 0;");
        $id = "";
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
        }
        return $id;
    }

    function dttp($val, $pre = 0)
    {
        $t = (int)($val * pow(10, $pre)) / pow(10, $pre);
        return (int)($val * pow(10, $pre)) / pow(10, $pre);
    }

    function getItemPrice($item_id, $valuta_id, $pricePro, $discount_id)
    {
        if ($valuta_id == "0" or $valuta_id == NULL) {
            $valuta_id = $this->getDefaultValuta();
        }
        $kurs = $this->getItemKurs($valuta_id);
        list($koef, $profit, $skid) = $this->getKoef($discount_id);
        $mdc = $this->getMDC($item_id, $kurs, $pricePro, $profit, $skid);
        $price = $pricePro - ($pricePro - $mdc) * $koef;
        //$price=$this->dttp($price/6, 2)*6;
        return $price;
    }

    function getDefaultValuta()
    {
        $odb = new odb;
        $r = $odb->query_td("select id from valuta where isCurrent='1' limit 1 offset 0;");
        $valuta_id = 0;
        while (odbc_fetch_row($r)) {
            $valuta_id = odbc_result($r, "id");
        }
        return $valuta_id;
    }

    function getItemKurs($valuta_id)
    {
        $odb = new odb;
        $slave = new slave;
        $r = $odb->query_td("select kurs from valuta where id='$valuta_id' limit 1 offset 0;");
        $kurs = 1;
        while (odbc_fetch_row($r)) {
            $kurs = $slave->tomoney(odbc_result($r, "kurs"));
        }
        return $kurs;
    }

    function getKoef($discount_id)
    {
        $odb = new odb;
        $slave = new slave;
        session_start();
        $group_id = $_SESSION["client_group"];
        if ($group_id == "") {
            $group_id = 13;
        }
        $koef = 0;
        $profit = 0;
        $skid = 0;
        $r = $odb->query_td("select * from discounts where discount_id='$discount_id' and group_id='$group_id' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $koef = $slave->tomoney(odbc_result($r, "koef"));
            $profit = $slave->tomoney(odbc_result($r, "profit"));
            $skid = $slave->tomoney(odbc_result($r, "skid"));
        }
        return array($koef, $profit, $skid);
    }

    function getMDC($item_id, $kurs, $pricePro, $profit, $skid)
    {
        $odb = new odb;
        $slave = new slave;
        session_start();
        $client_id = $_SESSION["client_id"];
        $r = $odb->query_td("select * from item where id='$item_id' limit 1 offset 0;");
        $mdc = 0;
        while (odbc_fetch_row($r)) {
            $vPriceZak = $slave->tomoney(odbc_result($r, "vPriceZak"));
            $PriceZakV = $slave->tomoney(odbc_result($r, "PriceZakV"));
            $aPricePro = $slave->tomoney(odbc_result($r, "aPricePro"));
            $mdc = $vPriceZak * $kurs;
            if ($mdc < $PriceZakV) {
                $mdc = $PriceZakV;
            }
            $mdc *= 1.2;
            $mdc = $mdc * (1 + $profit / 100);
            $mdc1 = $pricePro * (1 - $skid / 100);
            if ($mdc < $mdc1) {
                $mdc = $mdc1;
            }
            if ($mdc < $aPricePro) {
                $mdc = $aPricePro;
            }
        }
        /*		Рассчёт фиксированной цены, Например Exist
			if ($client_id<>"") {
			$r=$odb->query_td("select Price from PriceListKlient where id='$item_id' and klient_id='$client_id' limit 1 offset 0;");$PriceFix=0;
			while(odbc_fetch_row($r)){
				$PriceFix=$slave->tomoney(odbc_result($r,"Price"));
			}
			If ($PriceFix>$mdc) {$mdc=$PriceFix;}
		}
*/
        return $mdc;
    }

    function updateOrderItemPriceSumm($id, $item_id, $kol, $ExPrice, $exSumm)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $r = $odb->query_td("select * from item where id='$item_id' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $valuta_id = odbc_result($r, "val_id");
            $discount_id = odbc_result($r, "discount_id");
            $price = $slave->tomoney(odbc_result($r, "pricePro"));
            //$price_client=$this->getItemPrice($item_id,$valuta_id,$price,$discount_id);
            $price_client = $this->getItemPrice2($item_id);
            $summ = $kol * $price_client;
            if ($price_client != $ExPrice) {
                $summ = $kol * $price_client;
                $odb->query_td("update orders_str set price='$price_client', summ='$summ' where id='$id';");
            }
        }
        return array($price_client, $summ);
    }

    function getItemQuantKol($item_id)
    {
        session_start();
        $odb = new odb;
        $quant = 0;
        $quant1 = 0;
        list($listPlaceExpr, $listPlaceKm) = $this->getSkladIDS();
        $r = $odb->query_td("SELECT sum( S.quant ) AS kol FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id) WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '1' and SC.code in($listPlaceKm) GROUP BY S.SubConto_id;");
        while (odbc_fetch_row($r)) {
            $quant += odbc_result($r, "kol");
        }
        $r = $odb->query_td("SELECT sum( S.quant ) AS kol FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id) WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '2' and SC.code in($listPlaceKm) GROUP BY S.SubConto_id;");
        while (odbc_fetch_row($r)) {
            $quant_r += odbc_result($r, "kol");
            $quant -= $quant_r;
        }
        $r = $odb->query_td("SELECT sum( S.quant ) AS kol FROM store S inner join subconto SC on (SC.id=S.SubConto_id) inner join subcontotypes SCT on (SCT.SubConto_id=SC.id) WHERE SCT.SubContoType_id='3' and S.item_id = '$item_id' AND S.kind = '1' and SC.code in($listPlaceExpr) GROUP BY S.SubConto_id;");
        while (odbc_fetch_row($r)) {
            $quant1 += odbc_result($r, "kol");
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
        if ($quant1 == 0) {
            $quant1_res = "";
        }
        if ($quant1 >= 1 and $quant1 <= 10) {
            $quant1_res = $quant1;
        }
        if ($quant1 > 10) {
            $quant1_res = ">10";
        }
        return array($quant, $quant1, $quant_res, $quant1_res);
    }

    function detectPromotion($string, $promotion)
    {
        foreach (explode(",", $string) as $promotionToCheck) {
            if ($promotionToCheck == $promotion) {
                $promotionFound = true;
            }
        }
        return $promotionFound;
    }

    function getItemsOnSklad($item_id, $subconto_id, $kind)
    {
        session_start();
        $odb = new odb;
        $query = "SELECT sum( S.quant ) AS kol FROM store S inner join subconto SC on (SC.id=S.SubConto_id) WHERE S.item_id = '$item_id' and SC.id='$subconto_id' AND S.kind = '$kind' GROUP BY S.SubConto_id;";
        $r = $odb->query_td($query);
        $n = $odb->num_rows($r);
        $r = $odb->query_td($query);
        $kol = 0;
        if ($n == 1) {
            odbc_fetch_row($r);
            $kol = odbc_result($r, "kol");
        }
        if ($kol == 0) {
            $kol_res = "";
        }
        if ($kol >= 1 and $kol <= 10) {
            $kol_res = $kol;
        }
        if ($kol > 10) {
            $kol_res = ">10";
        }
        return $kol_res;
    }

    function file_post_contents($url, $headers = false)
    {
        $url = parse_url($url);

        if (!isset($url['port'])) {
            if ($url['scheme'] == 'http') {
                $url['port'] = 80;
            } elseif ($url['scheme'] == 'https') {
                $url['port'] = 443;
            }
        }
        $url['query'] = isset($url['query']) ? $url['query'] : '';

        $url['protocol'] = $url['scheme'] . '://';
        $eol = "\r\n";

        $headers = "POST " . $url['protocol'] . $url['host'] . $url['path'] . " HTTP/1.0" . $eol .
            "Host: " . $url['host'] . $eol .
            "Referer: " . $url['protocol'] . $url['host'] . $url['path'] . $eol .
            "Content-Type: application/x-www-form-urlencoded" . $eol .
            "Content-Length: " . strlen($url['query']) . $eol .
            $eol . $url['query'];
        $fp = fsockopen($url['host'], $url['port'], $errno, $errstr, 30);
        if ($fp) {
            fputs($fp, $headers);
            $result = '';
            $i = 0;
            while (!feof($fp)) {
                $i++;
                $data = fgets($fp, 128);
                if ($i == 4) {
                    $file_name = $data;
                }
                $result .= $data;
            }
            fclose($fp);
            $file_name = str_replace('Content-Disposition: attachment;filename="', '', $file_name);
            $file_name = substr($file_name, 0, -3);
            return $file_name;
        }
    }

    function GetArticleManuf($id, $td_manuId, $td_manuName)
    {
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $result = $soap->getArticleLinkedAllLinkingTargetManufacturer(array(
                'provider' => PROVIDER_ID, 'country' => 'ru',
                'linkingTargetType' => 'C', 'articleId' => $id
            ));
            $result = $result->data->array;
            foreach ($result as $item) {
                return $item->manuId;
            }
        } catch (SoapFault $e) {
            print $e;
        }
    }

    function showItemPhoto($item_id)
    {
        session_start();
        $client = $_SESSION["client"];
        if ($client == "" or $client == 0) {
            $form_htm = RD . "/tpl/need_auth.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
        }
        if ($client != "" and $client != 0) {
            $odb = new odb;
            $form_htm = RD . "/tpl/catalogue_items_photo.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
            list($caption, $code) = $this->getItemCaptionCode($item_id);
            $r = $odb->query_td("select * from itemimages where item_id='$item_id';");
            $td_ex = 0;
            $list = "";
            while (odbc_fetch_row($r)) {
                $file_name = odbc_result($r, "file_name");
                $istd = odbc_result($r, "istd");
                if ($istd == 1) {
                    $td_ex = 1;
                }
                $list .= "<img src='thumb.php?image=lider/$file_name&size=650&height=650' border=0 align='center' alt='$caption' title='$caption'><br />";
                if (in_array($_SERVER['REMOTE_ADDR'], $this->remips)) {
                    $list .= "<img src='theme/images/drop.png' style='cursor:pointer;' onclick='DropImg(\"$item_id\",\"$file_name\");' border=0 align='center' alt='удалить' title='удалить'><br />";
                }
            }
            $list .= "$td_ex";

//            далее поиск и автодобавление из TecDoc online отключаю $td_ex = 1
            $td_ex = 1;
            if ($td_ex == 0) {
                $article_id = $this->getArticleId($code, $item_id);
                $soap = new SoapClient(TecdocToCat, array('trace' => true,));
                try {
                    $result = $soap->getArticleDocuments(array(
                        'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                        'articleId' => $article_id,
                    ));
                    $result = $result->data->array;
                    $caption = "";
                    foreach ($result as $item) {
                        $docId = $item->docId;
                        $docFileName = $item->docFileName;
                        $fileExts = explode('.', $docFileName);
                        foreach ($fileExts as $fileExt) {
                            $ext = strtolower($fileExt);
                        }
                        $exten = array('jpg', 'png', 'gif', 'bmp');
                        if (in_array($ext, $exten)) {
                            $handle = fopen(TecdocToCatDoc . "/20122/$docId/0", "rb");
                            $docImage = stream_get_contents($handle);
                            fclose($handle);
                            $fp = fopen('uploads/images/lider/' . $item_id . '_td.jpg', 'w');
                            fwrite($fp, $docImage);
                            fclose($fp);
                            $odb->query_td("insert into itemimages (id,item_id,file_name,istd) values ((select max(id)+1 from itemimages)'$item_id','$item_id" . "_td.jpg','1');");
                            $list .= "<img src='thumb.php?image=lider/$item_id" . "_td.jpg&size=650&height=650' border=0 align='center' alt='$caption' title='$caption'><br />";
                            if (in_array($rem_ip, $this->remips)) {
                                $list .= "<img src='theme/images/drop.png' style='cursor:pointer;' onclick='DropImg(\"$item_id\",\"$item_id" . "_td.jpg\");' border=0 align='center' alt='удалить' title='удалить'>";
                            }
                        }
                    }
                } catch (SoapFault $e) {
                }

            }
            $form = str_replace("{image}", $list, $form);
            $form = str_replace("{item_caption}", $caption, $form);
            $recomend_button = "";
            $rem_ip = $_SERVER['REMOTE_ADDR'];
            $edit_item = "";
            $drop_item = "";
            if (in_array($rem_ip, $this->remips)) {
                $recomend_button = "<a href='javascript:if(confirm(\"Добавить в рекомендуемые товары?\")){ addToRecomend(\"$item_id\"); }'>Добавить в рекомендуемые</a><br /><a href='javascript:if(confirm(\"Удалить из рекомендуемых товаров?\")){ delFromRecomend(\"$item_id\"); }'>Удалить из рекомендуемых</a>";
                $addimage_module = "<iframe align='top' src='/tpl/catalogue_file_upload.php?item_id=$item_id' frameborder=0 width='100%' height=200 scrolling=Auto></iframe>";///tpl/catalogue_file_upload.htm
            }
            $form = str_replace("{items_recomend}", $recomend_button, $form);
            $form = str_replace("{items_addphoto}", $addimage_module, $form);
        }
        return $form;
    }

    function showItemActionRemark($item_id)
    {
        $odb = new odb;
        $form_htm = RD . "/tpl/catalogue_action_remark.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        list($caption, $code) = $this->getItemCaptionCode($item_id);
        $remark = $this->getItemRemark($item_id);
        $form = str_replace("{remark}", $remark, $form);
        $form = str_replace("{caption}", $caption, $form);
        $form = str_replace("{code}", $code, $form);
        return $form;
    }

    function getItemRemark($item_id)
    {
        $odb = new odb;
        $r = $odb->query_td("select help from item where id='$item_id' limit 1 offset 0;");
        $remark = "";
        while (odbc_fetch_row($r)) {
            $remark = odbc_result($r, "help");
        }
        return $remark;
    }

    function showItemInfo($item_id)
    {
        if (isset($_REQUEST[session_name()])) session_start();
        if (empty($_SESSION["client"])) {
            $client = 0; //Выводить скидку по клиенту=Фирма ЛидерСервис-Клиент группа 4
        } else {
            $client = $_SESSION["client"];
        }
//        session_start();
//        $client = $_SESSION["client"];
        if ($client == "" or $client == 0) {
            $form_htm = RD . "/tpl/need_auth.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
        }
        if ($client != "" and $client != 0) {
            $odb = new odb;
            $form_htm = RD . "/tpl/catalogue_items_info.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
            list($caption, $code) = $this->getItemCaptionCode($item_id);
            list($item_producent, $item_td_producent, $item_producent_name) = $this->getItemProducentTd($item_id);

            list($article_id, $article_name) = $this->getArticleIdName($code, $item_id);
            //запрос в TecDoc Online отлючаю
            $td = 0;
            if ($td == 1) {
                $soap = new SoapClient(TecdocToCat, array('trace' => true,));
                try {
                    $result = $soap->getAssignedArticlesByIds2Single(array(
                        'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                        'modId' => '-1', 'manuId' => '-1',
                        'linkingTargetType' => 'C', 'linkingTargetId' => '-1', 'attributs' => true,
                        'priceDate' => Null, 'info' => true, 'prices' => false,
                        'eanNumbers' => false, 'usageNumbers' => false, 'replacedByNumbers' => true, 'replacedNumbers' => true, 'mainArticles' => true, 'documents' => true,
                        'oeNumbers' => '', 'normalAustauschPrice' => true, 'immediateAttributs' => true,
                        'immediateInfo' => '', 'documentsData' => true, 'articleId' => $article_id, 'articleLinkId' => '',
                    ));
                    $result = $result->data->array[0]->articleAttributes->array;
                    $list = "";
                    $i = 0;
                    foreach ($result as $item) {
                        $i += 1;
                        $attrName = iconv("utf-8", "windows-1251", $item->attrName);
                        $attrValue = iconv("utf-8", "windows-1251", $item->attrValue);
                        $list .= "<tr>
					<td align='center'>$i</td>
					<td>$attrName</td>
					<td align='right'>$attrValue</td>
					<td></td>
				</tr>";
                    }
                } catch (SoapFault $e) {
                }
            }
            $form = str_replace("{list}", $list, $form);
            $form = str_replace("{caption}", $caption, $form);
            $form = str_replace("{articleId}", $article_id, $form);
            $form = str_replace("{articleName}", $article_name, $form);
            $form = str_replace("{code}", $code, $form);
            $form = str_replace("{item_foto}", $this->getItemPhoto($item_id, 200), $form);

        }

        return $form;
    }

    function getArticleIdName($code, $item_id)
    {
        $odb = new odb;
        $articleId = 0;
        $r = $odb->query_td("select * from item_tecdoc where item_id='$item_id' limit 1 offset 0;");
        while (odbc_fetch_row($r)) {
            $articleId = odbc_result($r, "article_id");
            $articleData = odbc_result($r, "data");
            $articleName = odbc_result($r, "article_name");
            $brandName = odbc_result($r, "brand_name");
        }
        if ($articleId == 0 and $code != "") {
            $code2 = substr($code, 0, 7);
            list($p, $brandNo, $p) = $this->getItemProducentTd($item_id);
            if (substr($code, 0, 2) == "BC") {
                $code = "";
            }
            if (substr($code, -3, 3) == "sid") {
                $code = str_replace(" sid", "", $code);
            }
//			if (substr($code,-3,3)==" st"){$code=str_replace(" st","",$code);}
            $soap = new SoapClient(TecdocToCat, array('trace' => true,));
            try {
                $result = $soap->getArticleDirectSearchAllNumbers2(array(
                    'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                    'sortType' => '1',
                    'searchExact' => 'true',
                    'numberType' => '0',
                    'genericArticleId' => '',
                    'brandno' => $brandNo,
                    'articleNumber' => $code,
                ));
                $empty = $result->data->empty;
                if (!$empty) {
                    $result = $result->data->array;
                    foreach ($result as $item) {
                        $articleId = $item->articleId;
                        $articleName = $item->articleName;
                        $brandName = $item->brandName;
                    }
                }
                if ($empty) {
                    $result = $soap->getArticleDirectSearchAllNumbers2(array(
                        'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                        'sortType' => '1',
                        'searchExact' => 'true',
                        'numberType' => '1',
                        'genericArticleId' => '',
                        'brandno' => $brandNo,
                        'articleNumber' => $code,
                    ));
                    $empty = $result->data->empty;
                    if (!$empty) {
                        $result = $result->data->array;
                        foreach ($result as $item) {
                            $articleId = $item->articleId;
                            $articleName = $item->articleName;
                            $brandName = $item->brandName;
                        }
                    }
                    if ($empty) {
                        $result = $soap->getArticleDirectSearchAllNumbers2(array(
                            'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                            'sortType' => '1',
                            'searchExact' => 'true',
                            'numberType' => '2',
                            'genericArticleId' => '',
                            'brandno' => $brandNo,
                            'articleNumber' => $code,
                        ));
                        $empty = $result->data->empty;
                        if (!$empty) {
                            $result = $result->data->array;
                            foreach ($result as $item) {
                                $articleId = $item->articleId;
                                $articleName = $item->articleName;
                                $brandName = $item->brandName;
                            }
                        }
                        if ($empty) {
                            $result = $soap->getArticleDirectSearchAllNumbers2(array(
                                'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                                'sortType' => '1',
                                'searchExact' => 'true',
                                'numberType' => '3',
                                'genericArticleId' => '',
                                'brandno' => $brandNo,
                                'articleNumber' => $code,
                            ));
                            $empty = $result->data->empty;
                            if (!$empty) {
                                $result = $result->data->array;
                                foreach ($result as $item) {
                                    $articleId = $item->articleId;
                                    $articleName = $item->articleName;
                                    $brandName = $item->brandName;
                                }
                            }
                            if ($empty) {
                                $result = $soap->getArticleDirectSearchAllNumbers2(array(
                                    'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                                    'sortType' => '1',
                                    'searchExact' => 'true',
                                    'numberType' => '0',
                                    'genericArticleId' => '',
                                    'brandno' => $brandNo,
                                    'articleNumber' => $code2,
                                ));
                                $result = $result->data->array;
                                foreach ($result as $item) {
                                    $articleId = $item->articleId;
                                    $articleName = $item->articleName;
                                    $brandName = $item->brandName;
                                }
                            }
                        }
                    }
                }
            } catch (SoapFault $e) {
            }
            $articleName = iconv("utf-8", "windows-1251", $articleName);
            $brandName = iconv("utf-8", "windows-1251", $brandName);
            $this->addTecdocArticleId($item_id, $articleId, $articleName, $brandName, $brandNo);
        }
        return array($articleId, $articleName . " " . $brandName);
    }

    function showAplicability($articleId)
    {
//        Таблица применяемости пропала, надо загружать заново, да и нужна ли она, пока что отключаю
        return " Извините, информация по данному артикулу отсутствует :( ";

        $odb = new odb;
        $list = "";
        $r = $odb->query_td("select * from tecdoc_aplicability where article_id='$articleId';");
        while (odbc_fetch_row($r)) {
            $name = odbc_result($r, "name");
            $years = odbc_result($r, "years");
            $kv = odbc_result($r, "kv");
            $ls = odbc_result($r, "ls");
            $ksm = odbc_result($r, "ksm");
            $type_s = odbc_result($r, "type_s");
            $config = odbc_result($r, "config");
            $to = odbc_result($r, "to");
            $list .= "<tr>
					<td>$name </td>
					<td>$years </td>
					<td>$kv </td>
					<td>$ls </td>
					<td>$ksm </td>
					<td>$type_s </td>
					<td>$config </td>
					<td>$to </td>
				</tr>";
        }
        if ($list != "") {
            $list = "<table border=0 width='99%' class='content' id='content'>
				<tr id='range_head2'>
					<td>Описание</td>
					<td>Год.Выпуска</td>
					<td>кВ.</td>
					<td>Л.С.</td>
					<td>куб.см.</td>
					<td>Вид сборки</td>
					<td>Конфиг</td>
					<td>То</td>
				</tr>" . $list . "</table>";
        }
        if ($list == "") {
            $soap = new SoapClient(TecdocToCat, array('trace' => true,));
            try {
                $result = $soap->getArticleLinkedAllLinkingTarget2(array(
                    'provider' => PROVIDER_ID, 'country' => 'ru', 'lang' => 'ru',
                    'linkingTargetType' => 'C', 'linkingTargetId' => '-1', 'linkingTargetManuId' => '', 'articleId' => $articleId
                ));
                $result = $result->data->array;
                $LinkId = array();
                $TargetId = array();
                $i = 0;
                foreach ($result as $item) {
                    $i += 1;
                    $LinkId[$i] = $item->articleLinkId;
                    $TargetId[$i] = $item->linkingTargetId;
                }
                if ($i > 0) {
                    for ($j = 1; $j <= $i; $j++) {
                        $result = $soap->getArticleLinkedAllLinkingTargetsByIds2Single(array(
                            'provider' => PROVIDER_ID, 'country' => 'ru', 'lang' => 'ru',
                            'linkingTargetType' => 'C', 'linkingTargetId' => $TargetId[$j], 'articleLinkId' => $LinkId[$j],
                            'immediateAttributs' => true, 'articleId' => $articleId
                        ));
                        $result = $result->data->array[0]->linkedVehicles->array;
                        foreach ($result as $item) {
                            $carDesc = iconv("utf-8", "windows-1251", $item->carDesc);
                            $constructionType = iconv("utf-8", "windows-1251", $item->constructionType);
                            $cylinderCapacity = iconv("utf-8", "windows-1251", $item->cylinderCapacity);
                            $manuDesc = iconv("utf-8", "windows-1251", $item->manuDesc);
                            $modelDesc = iconv("utf-8", "windows-1251", $item->modelDesc);
                            $powerHpFrom = $item->powerHpFrom;
                            $powerHpTo = $item->powerHpTo;
                            $powerKwFrom = $item->powerKwFrom;
                            $powerKwTo = $item->powerKwTo;
                            $yearOfConstructionFrom = $item->yearOfConstructionFrom;
                            $yearOfConstructionTo = $item->yearOfConstructionTo;
                            $axisConfiguration = iconv("utf-8", "windows-1251", $item->axisConfiguration);
                            $tonnage = $item->tonnage;

                            $odb->query_td("insert into tecdoc_aplicability (article_id,name,years,kv,ls,ksm,type_s,config,to) values ('$articleId','$manuDesc $carDesc $modelDesc ','$yearOfConstructionFrom - $yearOfConstructionTo ','$powerKwFrom/$powerKwTo ','$powerHpFrom/$powerHpTo ','$cylinderCapacity ','$constructionType ','$axisConfiguration ','$tonnage ');");

                            $list .= "<tr>
								<td>$manuDesc $carDesc $modelDesc &nbsp;</td>
								<td>$yearOfConstructionFrom - $yearOfConstructionTo &nbsp;</td>
								<td>$powerKwFrom/$powerKwTo &nbsp;</td>
								<td>$powerHpFrom/$powerHpTo &nbsp;</td>
								<td>$cylinderCapacity &nbsp;</td>
								<td>$constructionType &nbsp;</td>
								<td>$axisConfiguration &nbsp;</td>
								<td>$tonnage &nbsp;</td>
								</tr>";
                        }
                    }
                    if ($list != "") {
                        $list = "<table border=0 width='99%' class='content' id='content'><tr id='range_head2'>
								<td>Описание</td>
								<td>Год.Выпуска</td>
								<td>кВ.</td>
								<td>Л.С.</td>
								<td>куб.см.</td>
								<td>Вид сборки</td>
								<td>Конфиг</td>
								<td>То</td>
								</tr>" . $list . "</table>";
                    }
                }
            } catch (SoapFault $e) {
                print $e;
            }
        }
        return $list;
    }

    /*function createAnalogList($itemsArr,$itemsArr1,$kolItems,$step){$odb=new odb; $where="";$step+=1;
//		call LISTANALOG('$item_id');
		$odb->query_td("Call listanalog(503801);");
$r=$odb->query_td("select * from analogtemp;");
while(odbc_fetch_row($r)){ $prm=0; $price1=""; $i++;
	$lev=odbc_result($r,"lev");
	$itemId=odbc_result($r,"item_id");
	print "$lev $itemId<br />";
}
		foreach ($itemsArr1 as $item){$where.=" item_id1='$item' or  item_id2='$item' or";}  if ($where!=""){$where=" where (".substr($where,0,-3).")";} $itemsArr1=NULL;
		$r=$odb->query_td("select item_id1,item_id2 from Analog $where;");$i=0;
		while(odbc_fetch_row($r)){$i++;
			$item_id1=odbc_result($r,"item_id1");
			$item_id2=odbc_result($r,"item_id2");
			$itemsArr1[$i]=$item_id1;$i++;
			$itemsArr1[$i]=$item_id2;
			if (!in_array($item_id2,$itemsArr)){$kolItems+=1;$itemsArr[$kolItems]=$item_id2;}
			if (!in_array($item_id1,$itemsArr)){$kolItems+=1;$itemsArr[$kolItems]=$item_id1;}
		}
		if ($i>0){
			if ($step<10){list($itemsArr,$kolItems)=$this->createAnalogList($itemsArr,$itemsArr1,$kolItems,$step);}
		}

		return array($itemsArr,$kolItems);
	}*/

    function addToRecomend($item_id)
    {
        $odb = new odb;
        $answer = "";
        $r = $odb->query_td("select * from catalogue_recomend where model='$item_id';");
        $td_ex = 0;
        while (odbc_fetch_row($r)) {
            $td_ex = 1;
            $answer = "Товар УЖЕ находится в рекомендуемых!";
            break;
        }
        if ($td_ex == 0) {
            $odb->query_td("insert into catalogue_recomend (model,id) values ('$item_id',(select (max(coalesce(id,0))+1) from catalogue_recomend))");
            $answer = "Товар добавлен в рекомендуемый!";
        }
        return $answer;
    }

    function delFromRecomend($item_id)
    {
        $odb = new odb;
        $answer = "Товар не находится в рекомендуемых!";
        $r = $odb->query_td("select * from catalogue_recomend where model='$item_id';");
        $td_ex = 0;
        while (odbc_fetch_row($r)) {
            $odb->query_td("delete from catalogue_recomend where model='$item_id';");
            $answer = "Товар удален из рекомендуемого!";
            break;
        }
        return $answer;
    }

    function DropImg($item_id, $filename)
    {
        $odb = new odb;
        $answer = "Фото НЕ УДАЛЕНО!";
        $rem_ip = $_SERVER['REMOTE_ADDR'];
        if (in_array($rem_ip, $this->remips)) {
            $odb->query_td("delete from itemimages where item_id='$item_id' and file_name='$filename';");
            $answer = "Фото удалено!";
        }
        return $answer;
    }

//    Показать список аналогов Lider по коду itemCode=Item_id или массиву кодов itemsArr=Item_id

    function historySearch()
    {

        session_start();
        $odb = new odb;
        $client = $_SESSION["client"];
        $list = "<div class='HistorySearchFrom'>";
        if ($client == "") {
            $search_count = $_SESSION["search_count"];
            if ($search_count == "") {
                $search_count = 0;
            }
            for ($i = 1; $i <= $search_count; $i++) {
                $art = $_SESSION["artSearch$i"];
                $art_cap = $art;
                if (strlen($art) > 15) {
                    $art_cap = substr($art, 0, 13) . "..";
                }
                $list .= "<div><a href='#search=$art'>$art_cap</a></div>";
            }
        }
        if ($client != "") {
            $r = $odb->query_td("select art from history_search where client='$client' order by id desc limit 50 offset 0");
            while (odbc_fetch_row($r)) {
                $art = odbc_result($r, "art");
                $art_cap = $art;
                if (strlen($art) > 15) {
                    $art_cap = substr($art, 0, 13) . "..";
                }
                $list .= "<div><a href='#search=$art'>$art_cap</a></div>";
            }
        }
        $list .= "</div>";
        return $list;

    }

    function showMasloItemInfo($category, $item_id)
    {
        session_start();
        $client = $_SESSION["client"];
        /*		if ($client=="" or $client==0){
			$form_htm=RD."/tpl/need_auth.htm"; if (file_exists("$form_htm")){ $form = file_get_contents($form_htm);}
		}
		if ($client!="" and $client!=0)
		*/
        {
            $odb = new odb;
            $form_htm = RD . "/tpl/catalogue_maslo_items_info.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
            list($caption, $code) = $this->getItemCaptionCode($item_id);
            list($item_producent, $item_td_producent, $item_producent_name) = $this->getItemProducentTd($item_id);
            list($article_id, $article_name) = $this->getArticleIdName($code, $item_id);
            $form = str_replace("{list}", $list, $form);
            $form = str_replace("{caption}", $caption, $form);
            $form = str_replace("{articleId}", $article_id, $form);
            $form = str_replace("{articleName}", $this->showMasloCaption($item_id, $category), $form);
            $form = str_replace("{code}", $code, $form);
            $form = str_replace("{item_foto}", $this->getItemPhoto($item_id, 200), $form);
            $form = str_replace("{cross_maslo}", $this->showMasloCross($item_id, $category), $form);
        }
        return $form;
    }

    function showMasloCaption($lider_id, $category)
    {
        $db = new db;
        $caption = "";
        $r = $db->query_lider("select caption from `items_$category` where `lider_id`='$lider_id' limit 1 offset 0;");
        $n = $db->num_rows($r);
        if ($n == 1) {
            $caption = $db->result($r, 0, "caption");
        }
        return $caption;
    }

    function showMasloCross($lider_id, $category)
    {
        $db = new db;
        $form = "";
        $r = $db->query_lider("select lider_id from `items_$category` itm INNER JOIN (SELECT `cross_val`,displacement from `items_$category` where `lider_id`='$lider_id') as crs ON crs.cross_val=itm.cross_val where  itm.cross_val!=0 group by itm.displacement;");
        $n = $db->num_rows($r);
        for ($i = 1; $i <= $n; $i++) {
            $lid = $db->result($r, $i - 1, "lider_id");
            $displacement = $this->getMasloDisplacement($lid, $category);
            $form .= "<div class='ltrBox' onClick='showMasloItemInfo(\"$lid\",\"$category\");'>$displacement</div>";
        }
        return $form;
    }

    function getMasloDisplacement($lider_id, $category)
    {
        $db = new db;
        $displacement = "";
        $r = $db->query_lider("select displacement from `items_$category` where `lider_id`='$lider_id' limit 1 offset 0;");
        $n = $db->num_rows($r);
        if ($n == 1) {
            $displacement = $db->result($r, 0, "displacement");
        }
        return $displacement;
    }

    function showMasloCrossBusket($lider_id, $category)
    {
        $db = new db;
        $form = "";
        $r = $db->query_lider("select lider_id from `items_$category` itm INNER JOIN (SELECT `cross_val` from `items_$category` where `lider_id`='$lider_id') as crs ON crs.cross_val=itm.cross_val where itm.lider_id!='$lider_id' and itm.cross_val!=0;");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $form .= "<h3>Кросс товары</h3>";
            for ($i = 1; $i <= $n; $i++) {
                $lid = $db->result($r, $i - 1, "lider_id");
                $displacement = $this->getMasloDisplacement($lid, $category);
                $form .= "<div class='ltrBox' onClick='show_busket_maslo_form(\"$lid\",\"$category\");'>$displacement</div>";
            }
        }
        return $form;
    }

    function loadStoItemsFilter($producent = 0, $category = 0, $otype = 0)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        $form_htm = RD . "/tpl/catalogue_sto_items_list_filter.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $where = "";
        if ($producent != 0) {
            $where .= " and producent='$producent'";
        }
        if ($category != 0) {
            $where .= " and category='$category'";
        }
        if ($otype != 0) {
            $where .= " and otype='$otype'";
        }

        $r = $odb->query_td("select * from sto_items where ison='1' $where order by id asc limit 20 offset 0");
        $list = "";
        $i = 0;
        while (odbc_fetch_row($r)) {
            $i++;
            $id = odbc_result($r, "id");
            $code = odbc_result($r, "code");
            $item_id = $this->getItemId($code);
            list($c, $name, $price, $c, $image) = $this->getItemInfo($item_id);
            $image = str_replace(" height='150'", " width='40'", $image);
            $img = "<a href='javascript:showItemPhoto(\"" . strtoupper($item_id) . "\")'>$image</a>";
            $add_busket = "<a href='javascript:show_busket_form(\"$item_id\")'><img src='theme/images/add_icon.png' border='0' alt='Добавить в заказ' title='Добавить в заказ'></a>";
            $rem_ip = $_SERVER['REMOTE_ADDR'];
            $edit_item = "";
            $drop_item = "";
            if (in_array($rem_ip, $this->remips)) {
                $drop_item = "<a href='javascript:if(confirm(\"Удалить оборудование?\")){ window.location.href=\"?dep=23&w=drop_sto_item&conf=true&id=$id\"}'>d</a>";
            }
            $list .= "
			<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>
			<tr align='center' id='ri$id' height='25'>
				<td>$drop_item</td>
				<td><strong>$code</strong></td>
				<td align='left'><strong>$name</strong></td>
				<td align='right'>$price</td>
				<td>$img</td>
				<td>$add_busket</td>
			</tr>";

        }
        if ($i == 0) {
            $list .= "
			<tr align='center' height='40' >
				<td colspan=20><h3>Оборудование не найдено</h3></td>
			</tr>
			<tr><td colspan=10 style='border-bottom:1px solid #58585a; font-size:2px;' height=2>&nbsp;</td></tr>";
        }
        $form = str_replace("{items_list}", $list, $form);
        return $form;
    }

    function checkStoItemExist($code)
    {
        $odb = new odb;
        $ex = 0;
        if ($code != "") {
            $r = $odb->query_td("select * from sto_items where code='$code' limit 1 offset 0;");
            while (odbc_fetch_row($r)) {
                $ex = 1;
                break;
            }
        }
        return $ex;
    }

    function showItemAnalog($item_id)
    {
//        session_start();
        if (isset($_REQUEST[session_name()])) session_start();
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        $form_htm = RD . "/tpl/catalogue_analog_list.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        list($itemsArr, $kolItems, $dopsArr) = $this->createAnalogList($item_id, 0, 0);//$itemsArr[0]=$item_id;list($itemsArr,$kolItems)=$this->createAnalogList($itemsArr,$itemsArr,0,0);//  if ($list!=""){$where=" and (".substr($list,0,-3).")";}
        $where = "";
        foreach ($itemsArr as $item) {
            $where .= " id='$item' or";
        }
        if ($where != "") {
            $where = " where (" . substr($where, 0, -3) . ")";
        }
        $exclude = " and prod_id not in (1134) and COALESCE( (sign & 2),0)=0";
        $r = $odb->query_td("select * from item $where  $exclude order by code limit 15 offset 0;");
        $kol = $n;
        $list = "";
        $flist = "";
        $kt = -1;
        $i = 0;
        while (odbc_fetch_row($r)) {
            $prm = 0;
            $price1 = "";
            $i++;
            $id = odbc_result($r, "id");
            $code = odbc_result($r, "code");
            $scode = odbc_result($r, "scode");
            $name = odbc_result($r, "name");
            $name = wordwrap($name, 45, '&shy;', true);
            $valuta_id = odbc_result($r, "val_id");
            $discount_id = odbc_result($r, "discount_id");
            $price = $slave->tomoney(odbc_result($r, "pricePro"));
            //$price_client=$this->getItemPrice($id,$valuta_id,$price,$discount_id);
            $price_client = $this->getItemPrice2($id);
            $isImage = odbc_result($r, "isImage");
            if ($isImage > 0) {
                $img = "<a href='javascript:showItemPhoto(\"" . strtoupper($id) . "\")'><img src='theme/images/photo_icon.png' border='0' alt='Фото' title='Фото'></a>";
            } else {
                $img = "";
            }
            list($quant, $quant1, $quant_r, $quant_p) = $this->getItemQuant($id);
            $quant_r_img = "";
            if ($quant_r > 0) {
                $quant_r_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_reserv_icon.png' border='0' alt='Товар в резерв' title='Товар в резерв' align='middle' hspace='2'></a>";
            }
            $quant_p_img = "";
            if ($quant_p > 0) {
                $quant_p_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_prihod_icon.png' border='0' alt='Товар в приходе' title='Товар в приходе' align='middle' hspace='2'></a>";
            }
            $add_busket = "<a href='javascript:show_busket_form(\"$id\")'><img src='theme/images/add_icon.png' border='0' alt='Добавить в заказ' title='Добавить в заказ'></a>";
            $dop_icon = "";
            if ($dopsArr[$id] == 1) {
                $dop_icon = "<img src='/theme/images/aditional_icon.png' border=0 title='Дополнительный аналог'>";
            }
            if ($dop_icon == "") {
                $flist .= "
					<tr align='center' id='ri$id' height='25' style='color:#000;'>
						<td></td>
						<td></td>
						<td><a href='javascript:search_biart(\"$code\");'>$code</a></td>
						<td align='left'>$name</td>
						<td align='right'>$price</td>
						<td align='right'>$price_client</td>
						<td>$quant_p_img $quant_r_img <a href='javascript:showItemSklad(\"$id\")'>$quant</a></td>
						<td><a href='javascript:showItemSklad(\"$id\")'>$quant1</a></td>
						<td>$img</td>
						<td>$add_busket</td>
					</tr>
					<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>";
            }
            if ($dop_icon != "") {
                $list .= "
					<tr align='center' id='ri$id' height='25' style='color:#000;'>
						<td></td>
						<td>$dop_icon</td>
						<td><a href='javascript:search_biart(\"$code\");'>$code</a></td>
						<td align='left'>$name</td>
						<td align='right'>$price</td>
						<td align='right'>$price_client</td>
						<td>$quant_p_img $quant_r_img <a href='javascript:showItemSklad(\"$id\")'>$quant</a></td>
						<td><a href='javascript:showItemSklad(\"$id\")'>$quant1</a></td>
						<td>$img</td>
						<td>$add_busket</td>
					</tr>
					<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>";
            }
        }
        $list = $flist . $list;
//        if ($i == 1) {
//            $list .= $this->getTecdocAnalogList($code);
//        }
        if ($i == 0) {
            $list .= "
				<tr align='center' height='40' >
					<td colspan=20><h3>no result</h3></td>
				</tr>
				<tr><td colspan=11 style='border-bottom:1px solid #58585a; font-size:2px;' height=2>&nbsp;</td></tr>";
        }
        $form = str_replace("{items_list}", $list, $form);
        $filter = "по коду";
        if ($by_name == "1") {
            $filter = "по названию";
        }
        if ($by_code == "1") {
            $filter .= " строгий отбор";
        }
        if ($by_sklad == "1") {
            $filter .= ", только наличие";
        }
        list($item_caption, $item_code) = $this->getItemCaptionCode($item_id);
        $form = str_replace("{item_caption}", $item_code, $form);
        $form = str_replace("{filter}", $filter, $form);
        return $form;
    }

    function getTecdocAnalogList($itemCode)
    {
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        $itemsArr = array();
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $result = $soap->getArticleDirectSearchAllNumbers2(array(
                'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                'sortType' => '0',
                'searchExact' => 'true',
                'numberType' => '10',
                'genericArticleId' => '',
                'articleNumber' => $itemCode,
            ));
            $empty = $result->data->empty;
            if (!$empty) {
                $result = $result->data->array;
                $k = 0;
                foreach ($result as $item) {
                    $articleId = $item->articleId;
                    $articleCode = $item->articleNo;
                    $articleName = iconv("utf-8", "windows-1251", $item->articleName);
                    $brandName = $item->brandName;
                    $itemId = $this->getItemIdFind($articleCode);
                    if ($itemId != "") {
                        $k += 1;
                        $itemsArr[$k] = $itemId;
                    }
                }
            }
        } catch (SoapFault $e) {
        }
        if ($k > 0) {
            $list = $this->showItemAnalogLider($itemCode, $itemsArr);
        }
        return $list;
    }

    function getItemIdFind($code)
    {
        $odb = new odb;
        $scode = strtolower(str_replace(array('_', '-', '—', '/', '.', ',', '\\', ' '), "", trim($code)));
        $r = $odb->query_td("select id from item where code='$code' or scode LIKE '$scode' limit 1 offset 0;");
        $id = "";
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
        }
        return $id;
    }

    function showItemAnalogLider($itemCode, $itemsArr)
    {
        session_start();
        $odb = new odb;
        $slave = new slave;
        $dep = "23";
        $exclude = " and prod_id not in (1134) ";
        $where = "";
        foreach ($itemsArr as $item) {
            $where .= " id='$item' or";
        }
        if ($where != "") {
            $where = " where (" . substr($where, 0, -3) . ") $exclude";
        }
        $r = $odb->query_td("select * from item $where limit 30 offset 0;");
        $kol = $n;
        $list = "";
        $i = 0;
        $kt = -1;
        while (odbc_fetch_row($r)) {
            $prm = 0;
            $price1 = "";
            $i++;
            $icon_flag = "";
            $id = odbc_result($r, "id");
            $code = odbc_result($r, "code");
            $scode = odbc_result($r, "scode");
            $flag = odbc_result($r, "flag");
            $help = odbc_result($r, "help");
            $name = odbc_result($r, "name");
            $name = wordwrap($name, 45, '&shy;', true);
            $valuta_id = odbc_result($r, "val_id");
            $discount_id = odbc_result($r, "discount_id");
            $price = $slave->tomoney(odbc_result($r, "pricePro"));
            //$price_client=$this->getItemPrice($id,$valuta_id,$price,$discount_id);
            $price_client = $this->getItemPrice2($id, $client_id);
            $isImage = odbc_result($r, "isImage");
            $img = "<a href='javascript:showItemPhoto(\"" . strtoupper($id) . "\")'><img src='theme/images/photo_icon.png' border='0' alt='Фото' title='Фото'></a>";
            list($quant, $quant1, $quant_r, $quant_p) = $this->getItemQuant($id);
            $quant_r_img = "";
            if ($quant_r > 0) {
                $quant_r_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_reserv_icon.png' border='0' alt='Товар в резерв' title='Товар в резерв' align='middle' hspace='2'></a>";
            }
            $quant_p_img = "";
            if ($quant_p > 0) {
                $quant_p_img = "<a href='javascript:showItemSklad(\"$id\")'><img src='theme/images/sklad_prihod_icon.png' border='0' alt='Товар в приходе' title='Товар в приходе' align='middle' hspace='2'></a>";
            }
            $add_busket = "<a href='javascript:show_busket_form(\"$id\")'><img src='theme/images/add_icon.png' border='0' alt='Добавить в заказ' title='Добавить в заказ'></a>";
            if ($flag == 7) {
                $icon_flag = "<img src='theme/images/action_icon.png' border='0' alt='Акция' class='icon_button' onmouseover=\"tooltip.pop(this, '#a$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='a$id" . "_tip'>$help</div></div> onclick='showItemActionRemark(\"$id\");'>";
            }
            if (($flag == 6) & ($quant > 0)) {
                $icon_flag = "<img src='theme/images/best_price_icon.png' border='0' alt='СуперЦена' class='icon_button' onmouseover=\"tooltip.pop(this, '#d$id" . "_tip')\" onclick='showItemActionRemark(\"$id\");'><div style='display:none;'><div id='d$id" . "_tip'>$help</div></div>";
            }
            $list .= "
				<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>
				<tr align='center' id='ri$id' height='25' style='background-color:#dcdcdc;color:#000;'>
					<td width='5'>$icon_flag</td>
					<td><a class='desc' href='javascript:search_biart(\"$code\");' style='text-decoration:none;'>$code</a></td>
					<td align='left'>$name</td>
					<td align='right'>$price</td>
					<td align='right'>$price_client</td>
					<td>$quant_p_img $quant_r_img <a href='javascript:showItemSklad(\"$id\")'>$quant</a></td>
					<td><a href='javascript:showItemSklad(\"$id\")'>$quant1</a></td>
					<td>$img</td>
					<td>$add_busket</td>
				</tr>";
        }
        if ($list != "") {
            $list = "
				<tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>
				<tr><td colspan=10>
				<table width='97%' border=0 cellpadding=0 cellspacing=0>
				<tr><td colspan=10 style='font-size:2px;' height=2>&nbsp;</td></tr>
				<tr height='20'>
					<td class='leftAnalog'></td>
					<td class='Analog' width='100' align='center'><img src='/theme/images/analoArrow.png' border=0></td>
					<td class='Analog' width='400'>Аналоги TECDOC по запросу: $itemCode</td>
					<td class='Analog' width='60' align='right'>Цена</td>
					<td class='Analog' width='60' align='right'>Цена2</td>
					<td class='Analog' width='80' align='right'>Склад</td>
					<td class='Analog' width='80' align='right'>Экспр.</td>
					<td class='Analog'>&nbsp;</td>
					<td class='rightAnalog'></td>
				</tr>
				<tr><td colspan=10 style='border-bottom:1px solid #58585a; font-size:2px;' height=2>&nbsp;</td></tr>" . $list . "
				
				</table></td></tr><tr><td colspan=10 style='font-size:15px;' height=15>&nbsp;</td></tr>";
        }
        return $list;
    }

    function loadTecDetailsList($manufacture, $model, $modification, $groups, $brandNo = '')
    {
        $slave = new slave;
        if ($brandNo == '') {
            $form_htm = RD . "/tpl/catalogue_parts_brand_list.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
        }
        if ($brandNo != '') {
            $form_htm = RD . "/tpl/catalogue_parts_list.htm";
            if (file_exists("$form_htm")) {
                $form = file_get_contents($form_htm);
            }
        }
        $menu = "";
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $brandsNo = array((string)'16');
            $result = $soap->getArticleIds3(array(
                'provider' => PROVIDER_ID,
                'sort' => '1',
                'linkingTargetType' => 'C',
                'linkingTargetId' => $modification,
                'lang' => 'ru',
                'genericArticleId' => '',
                'country' => 'ru',
                'assemblyGroupNodeId' => $groups,
                'brandNo' => $brandNo,
            ));
            $result = $result->data->array;
            $prevBrand = 0;
            foreach ($result as $item) {
                $id = $item->articleId;
                $brand = iconv("utf-8", "windows-1251", $item->brandName);
                $brand_id = iconv("utf-8", "windows-1251", $item->brandNo);
                if ($prevBrand != $brand_id) {
                    $prevBrand = $brand_id;
                    if ($brandNo == "") {
                        $menu .= "<tr align='left' id='ri$id' height='25'>
						<td><a href='#groups=$groups/$model/$modification/$manufacture/$brand_id'>$brand</a></td>
						<td rowspan=2><a href='javascript:search_biart(\"$code\")'><img src='theme/images/look.jpg' border='0'></a></td>
						</tr><tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>";
                    }
                }
                if ($brandNo != "" and $brandNo == $brand_id) {
                    $code = iconv("utf-8", "windows-1251", $item->articleNo);
                    $caption = iconv("utf-8", "windows-1251", $item->genericArticleName);
                    //list($DetName,$DetRemark)=$this->getArticleIdInfo($id);
                    if ($DetName != "") {
                        $caption .= " " . $DetName;
                    }
                    $menu .= "<tr align='left' id='ri$id' height='25'>
					<td rowspan=2>$brand</td>
					<td><a href='javascript:search_biartTec(\"$code\",\"$brand_id\")'>$code</a></td>
					<td>$caption</td>
					<td rowspan=2><a href='javascript:search_biartTec(\"$code\",\"$brand_id\")'><img src='theme/images/look.jpg' border='0'></a></td>
					</tr><tr><td colspan=2>$DetRemark</td></tr><tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>";
                    $menu .= $this->showArticlePartList($id);
                }
            }
            $form = str_replace("{items_list}", $menu, $form);
        } catch (SoapFault $e) {
        }
        return $form;
    }

    function showArticlePartList($article_id)
    {
        $menu = "";
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $result = $soap->getArticlePartList2(array(
                'provider' => PROVIDER_ID, 'lang' => 'ru',
                'articleId' => $article_id,
                'country' => 'ru',
                'articleLinkId' => '',
                'axleId' => '', 'carId' => '', 'markId' => '',
                'motorId' => '', 'priceDate' => Null,

            ));
            $result = $result->data->array;
            foreach ($result as $item) {
                $code = iconv("utf-8", "windows-1251", $item->partId);
                $id = iconv("utf-8", "windows-1251", $item->partArticleId);
                $code = iconv("utf-8", "windows-1251", $item->articleNo);
                $brand = iconv("utf-8", "windows-1251", $item->brandName);
                $caption = iconv("utf-8", "windows-1251", $item->articleName);
                $caption .= " " . iconv("utf-8", "windows-1251", $item->articleAddName);
                //list($DetName,$DetRemark)=$this->getArticleIdInfo($id);
                if ($DetName != "") {
                    $caption .= " " . $DetName;
                }
                $menu .= "<tr align='left' id='ri$id' height='25' bgcolor='#dcdcdc'>
				<td rowspan=2></td>
				<td><a href='javascript:search_biart(\"$code\")'>$code</a></td>
				<td>$caption</td>
				<td rowspan=2></td>
				</tr><tr bgcolor='#dcdcdc'><td colspan=2>$DetRemark</td></tr><tr><td colspan=10 style='border-bottom:1px solid #8c8c8c; font-size:2px;' height=2>&nbsp;</td></tr>";
            }
        } catch (SoapFault $e) {
        }
        return $menu;
    }

    function getArticleIdInfo($article_id)
    {
        $soap = new SoapClient(TecdocToCat, array('trace' => true,));
        try {
            $result = $soap->getAssignedArticlesByIds2Single(array(
                'provider' => PROVIDER_ID, 'lang' => 'ru', 'country' => 'ru',
                'modId' => '-1', 'manuId' => '-1',
                'linkingTargetType' => 'C', 'linkingTargetId' => '-1', 'attributs' => true,
                'priceDate' => Null, 'info' => true, 'prices' => false,
                'eanNumbers' => false, 'usageNumbers' => false, 'replacedByNumbers' => true, 'replacedNumbers' => true, 'mainArticles' => true, 'documents' => true,
                'oeNumbers' => '', 'normalAustauschPrice' => true, 'immediateAttributs' => true,
                'immediateInfo' => '', 'documentsData' => true, 'articleId' => $article_id, 'articleLinkId' => '',
            ));
            $name = $result->data->array[0]->assignedArticle->articleAddName;
            $name = iconv("utf-8", "windows-1251", $name);
            $result = $result->data->array[0]->articleAttributes->array;
            $list = "";
            $prevAttrName = "";
            foreach ($result as $item) {
                $attrName = iconv("utf-8", "windows-1251", $item->attrShortName);
                $attrValue = iconv("utf-8", "windows-1251", $item->attrValue);
                if ($prevAttrName != $attrName) {
                    $list .= "$attrName: ";
                    $prevAttrName = $attrName;
                }
                $list .= "$attrValue / ";
            }
            if ($list != "") {
                $list = "<div style='font-size:11px'>" . $list . "</div>";
            }
            return array($name, $list);
        } catch (SoapFault $e) {
        }

    }

    function show_filter_form($top_id, $cur_id)
    {
        session_start();
        $db = new db;
        $slave = new slave;
        $dep = "23";
        $param_block_htm = RD . "/tpl/catalogue_param_block.htm";
        if (file_exists("$param_block_htm")) {
            $param_block = file_get_contents($param_block_htm);
        }
        $param_fromto_htm = RD . "/tpl/catalogue_param_fromto.htm";
        if (file_exists("$param_fromto_htm")) {
            $param_fromto = file_get_contents($param_fromto_htm);
        }

        $folder_id = $this->find_folder_params($cur_id);
        $form = "
		<link rel='stylesheet' href='js/jSlider/stylesheets/jslider.css' type='text/css'>
		<link rel='stylesheet' href='js/jSlider/stylesheets/jslider.round.css' type='text/css'>
		<link rel='stylesheet' href='js/jSlider/stylesheets/jslider.round.plastic.css' type='text/css'>
		<script type='text/javascript' src='js/jSlider/javascripts/jquery-1.4.2.js'></script>
		<script type='text/javascript' src='js/jSlider/javascripts/jquery.dependClass.js'></script>
		<script type='text/javascript' src='js/jSlider/javascripts/jquery.slider-min.js'></script>
		<table width='200' border='0' cellpadding='0' cellspacing='0'><tr height='30'><td width='5' background='theme/images/blue_rhead_l.png' style='background-repeat:no-repeat;'></td><td background='theme/images/blue_rhead.png' style='background-repeat:repeat-x; padding-left:10px;'><img src='theme/images/dots_wb.png' border='0' /> <img src='theme/images/filter.png' border=0 alt='' title='' /></td><td width='5' background='theme/images/blue_rhead_r.png' style='background-repeat:no-repeat;'></td></tr><tr><td colspan='3' background='theme/images/head_grd.png' style='background-repeat:repeat-x; background-position:top; border:1px solid #CCCCCC;  border-top:0px; background-color:#FFF;' align='left'><br />
";
        if ($cur_id != $_SESSION["cur_id"]) {
            $_SESSION["price_from"] = "";
            $_SESSION["price_to"] = "";
            $_SESSION["red_price"] = "";
            $_SESSION["sale"] = "";
            $_SESSION["best"] = "";
            $_SESSION["special_offer"] = "";
        }
        $price_from = $_SESSION["price_from"];
        $price_to = $_SESSION["price_to"];
        if ($_SESSION["red_price"] == "1") {
            $red_price_checked = "checked=\"checked\"";
        }
        if ($_SESSION["sale"] == "1") {
            $sale_checked = "checked=\"checked\"";
        }
        if ($_SESSION["best"] == "1") {
            $best_checked = "checked=\"checked\"";
        }
        if ($_SESSION["special_offer"] == "1") {
            $special_offer_checked = "checked=\"checked\"";
        }
        list($min_price, $max_price) = $this->get_min_max_price($cur_id);
        if ($price_from > $min_price) {
            $price_from = $min_price;
            $_SESSION["price_from"] = $min_price;
        }
        if ($price_to < $max_price) {
            $price_to = $max_price;
            $_SESSION["price_to"] = $max_price;
        }
        $form .= "
		<div style='margin-left:10px;'>
			<div class='Caption'>Цена, грн</div>
			<div>от <input type='text' id='price_from' value='$price_from' class='t14' style='width:70px;' onkeyup='setFilterPriceFromTo();' onchange='setFilterPriceFromTo();'> до <input type='text' id='price_to' value='$price_to' class='t14' style='width:70px;' onkeyup='setFilterPriceFromTo();' onchange='setFilterPriceFromTo();'></div><br />
			<div style='width:195px;'>
			<div class='layout-slider'><input id='SliderPrice' type='slider' name='area' value='0;$max_price' /></div>
		    <script type='text/javascript' charset='utf-8'>
				jQuery(\"#SliderPrice\").slider({ from: $min_price, to: $max_price, scale: [$min_price, '|', $max_price], limits: false, step: 1, dimension: '', skin: \"\",
				onstatechange: function(value) {
					setSliderValue('price_from','price_to',value);
				},
				callback: function(value) {
					setFilterPriceFromTo();
				}});</script>
			</div></div>
		</div><br /><br />
		<div class='ParamList' style='margin-left:10px;'><input type='checkbox' id='red_price' value='1' $red_price_checked onclick='setFilterRSBS(this.id);'> Супер цена</div>
		<div class='ParamList' style='margin-left:10px;'><input type='checkbox' id='sale' value='1' $sale_checked onclick='setFilterRSBS(this.id);'> Распродажа</div>
		<div class='ParamList' style='margin-left:10px;'><input type='checkbox' id='best' value='1' $best_checked onclick='setFilterRSBS(this.id);'> Отличная цена</div>
		<div class='ParamList' style='margin-left:10px;'><input type='checkbox' id='special_offer' value='1' $special_offer_checked onclick='setFilterRSBS(this.id);'> Специальное предложение</div><br />";
        $params = $_SESSION["params"];
        if (substr($params, -1) == "|") {
            $params = substr($params, 0, -1);
        }
        $params = explode("|", $params);
        $r = $db->query("select * from catalogue_params where cat_id='$folder_id' order by lenta,id asc;");
        $n = $db->num_rows($r);
        for ($i = 1; $i <= $n; $i++) {
            $param_id = $db->result($r, $i - 1, "id");
            $param_type = $db->result($r, $i - 1, "type");
            $param_caption = $db->result($r, $i - 1, "caption");
            if ($param_type == 1) {
                $form .= $param_block;
                $form = str_replace("{caption}", $param_caption, $form);
                $form = str_replace("{list}", $this->show_param_list($param_id, $param_type), $form);
            }
            if ($param_type == 2) {
                $checked = "";
                if (in_array($param_id, $params)) {
                    $checked = "checked='checked'";
                }
                $form .= "<div class='ParamList' style='margin-left:10px;'><input type='checkbox' id='Param$param_id' value='1' $checked onclick='setFilter(\"$param_id\",\"+\");'> $param_caption</div><br />";
            }
            if ($param_type == 3) {
                $form .= $param_fromto;
                list($FromCaption, $ToCaption) = $this->get_param_fromto($param_id);
                if (in_array($param_id, $params)) {
                    $sub_params = explode("|", $_SESSION["sub_params_from_to" . $param_id]);
                    $FromCaption = $sub_params[0];
                    $ToCaption = $sub_params[1];
                }
                $form = str_replace("{caption}", $param_caption, $form);
                $form = str_replace("{SubParamFromCaption}", $FromCaption, $form);
                $form = str_replace("{SubParamToCaption}", $ToCaption, $form);
            }
            $form = str_replace("{param_id}", $param_id, $form);
        }
        if ($cur_id != $_SESSION["cur_id"]) {
            $_SESSION["query"] = "";
        }
        $form .= "
		<div style='margin-left:10px;'>
			<div class='Caption'>Ключевые слова</div>
			<div class='ParamList'><input type='text' id='query' value='" . $_SESSION["query"] . "' class='t14' style='width:200px;' onkeyup='setFilterQuery(this.value);'></div>
		</div></div>";
        $form .= "</td></tr></table>";
        return $form;
    }

    function get_min_max_price($top_id)
    {
        $db = new db;
        session_start();
        $disc = $_SESSION["discount"];
        $kours = new kours;
        $r = $db->query("select min(price$disc) as min from catalogue where top_id='$top_id' and is_folder='2' and ison='1';");
        $min = round($kours->show_cash_price_sm($db->result($r, 0, "min")), 2);
        $r = $db->query("select max(price$disc) as max from catalogue where top_id='$top_id' and is_folder='2' and ison='1';");
        $max = round($kours->show_cash_price_sm($db->result($r, 0, "max")) + 100, 2);

        return array($min, $max);
    }

    function show_param_list($param_id, $type)
    {
        session_start();
        $db = new db;
        $folder_id = $this->find_folder_params($cur_id);
        $sub_params = $_SESSION["sub_params$param_id"];
        if (substr($sub_params, -1) == "|") {
            $sub_params = substr($sub_params, 0, -1);
        }
        $sub_params = explode("|", $sub_params);
        $r = $db->query("select * from catalogue_sub_params where param_id='$param_id' order by lenta,id asc;");
        $n = $db->num_rows($r);
        $form = "";
        for ($i = 1; $i <= $n; $i++) {
            $id = $db->result($r, $i - 1, "id");
            $caption = $db->result($r, $i - 1, "caption");
            $checked = "";
            if (in_array($id, $sub_params) == true) {
                $checked = "checked='checked'";
            }
            if ($type == 1) {
                $form .= "<div><input type='checkbox' id='SubParam$id' value='1' $checked onclick='setFilter(\"$param_id\",\"$id\");'> $caption</div>";
            }
        }
        return $form;
    }

    function get_param_fromto($param_id)
    {
        session_start();
//        объект db объявлен в классах mysql_class.php и mysql_lider_class.php это подключение к базе данных материнского сайта, копия базы хранится на сервере Lider для более быстрого и надёжного доступа
        $db = new db;
        $r = $db->query("select caption from catalogue_sub_params where param_id='$param_id' order by id asc limit 0,2;");
        $n = $db->num_rows($r);
        if ($n == 2) {
            return array($db->result($r, 0, "caption"), $db->result($r, 1, "caption"));
        }
        if ($n != 2) {
            return array("", "");
        }
    }

    function setFilter($param_id, $sub_param_id)
    {
        session_start();
        $db = new db;
        $er = 1;
        $ers = 1;
        if ($_SESSION["params"] == "") {
            $_SESSION["params"] = $param_id . "|";
        }
        $params = explode("|", $_SESSION["params"]);
        if ($params != "") {
            foreach ($params as $param) {
                if ($param == $param_id) {
                    $er = 0;
                    if ($_SESSION["sub_params" . $param_id] == "") {
                        $_SESSION["sub_params" . $param_id] = $sub_param_id . "|";
                    }
                    $sub_params = explode("|", $_SESSION["sub_params" . $param_id]);
                    if ($sub_params != "") {
                        foreach ($sub_params as $sub_param) {
                            if ($sub_param == $sub_param_id) {
                                $ers = 0;
                                break;
                            }
                        }
                        if ($ers == 1) {
                            $_SESSION["sub_params" . $param_id] .= $sub_param_id . "|";
                        }
                    }
                    break;
                }
            }
            if ($er == 1) {
                $_SESSION["params"] .= $param_id . "|";
                $_SESSION["sub_params" . $param_id] = $sub_param_id . "|";
                if ($_SESSION["sub_params" . $param_id] == "|") {
                    $_SESSION["sub_params" . $param_id] = "";
                }
            }
        }
        return "ok";
    }

    function unsetFilter($param_id, $sub_param_id)
    {
        $params = explode("|", $_SESSION["params"]);
        if ($params != "") {
            $new_params = "";
            foreach ($params as $param) {
                if ($param != $param_id) {
                    $new_params .= $param . "|";
                }
                if ($param == $param_id) {
                    $kol = 0;
                    $sub_params = $_SESSION["sub_params" . $param_id];
                    if (substr($sub_params, -1) == "|") {
                        $sub_params = substr($sub_params, 0, -1);
                    }
                    $sub_params = explode("|", $sub_params);
                    if ($sub_params != "") {
                        $new_sub_params = "";
                        foreach ($sub_params as $sub_param) {
                            if ($sub_param != $sub_param_id and $sub_param != "") {
                                $new_sub_params .= $sub_param . "|";
                                $kol++;
                            }
                        }
                        $_SESSION["sub_params" . $param_id] = str_replace("||", "|", $new_sub_params);
                        if ($kol > 0) {
                            $new_params .= $param . "|";
                        }
                        if ($_SESSION["sub_params" . $param_id] == "|" or $_SESSION["sub_params" . $param_id] == "") {
                            unset($_SESSION["sub_params" . $param_id]);
                        }
                    }
                }
            }
            $_SESSION["params"] = str_replace("||", "|", $new_params);
            if ($_SESSION["params"] == "|") {
                unset($_SESSION["params"]);
            }
        }
        return "ok";
    }

    function setFilterFromTo($param_id, $from, $to)
    {
        session_start();
        $db = new db;
        $er = 1;
        $ers = 1;
        if ($_SESSION["params"] == "") {
            $_SESSION["params"] = $param_id . "|";
        }
        $params = explode("|", $_SESSION["params"]);
        if ($params != "") {
            foreach ($params as $param) {
                if ($param == $param_id) {
                    $er = 0;
                    $_SESSION["sub_params" . $param_id] = "<>";
                    $_SESSION["sub_params_from_to" . $param_id] = $from . "|" . $to;
                    break;
                }
            }
            if ($er == 1) {
                $_SESSION["params"] .= $param_id . "|";
                $_SESSION["sub_params" . $param_id] = $from . "|" . $to;
            }
        }
        return "ok";
    }

    function setFilterPriceFromTo($cur_id, $from, $to)
    {
        session_start();
        $_SESSION["cur_id"] = $cur_id;
        $_SESSION["price_from"] = $from;
        $_SESSION["price_to"] = $to;
        return "ok";
    }

    function setFilterQuery($cur_id, $query)
    {
        session_start();
        $slave = new slave;
        $_SESSION["cur_id"] = $cur_id;
        $_SESSION["query"] = $slave->qq($query);
        return "ok";
    }

    function setFilterRSBS($cur_id, $id)
    {
        session_start();
        $_SESSION["cur_id"] = $cur_id;
        $_SESSION[$id] = "1";
        return "ok";
    }

    function unsetFilterRSBS($cur_id, $id)
    {
        session_start();
        $_SESSION["cur_id"] = $cur_id;
        $_SESSION[$id] = "";
        return "ok";
    }

    function show_model($top_id, $model)
    {
        session_start();
        $disc = $_SESSION["discount"];
        $db = new db;
        $slave = new slave;
        $kours = new kours;
        $form_htm = RD . "/tpl/model_desc.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $r = $db->query("select * from catalogue where id='$model';");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $code = $db->result($r, 0, "code");

            $caption = $db->result($r, 0, "caption");
            $price = $kours->show_cash_price($db->result($r, 0, "price$disc"));
            $price1 = "";
            if ($disc > 1) {
                $price1 = $kours->show_cash_price($db->result($r, 0, "price1")) . " розница";
            }
            $sklad = $db->result($r, 0, "sklad");
            list($sklad_cap, $sklad_color, $sklad_op) = $this->get_sklad_options($sklad);
            $delivery = $db->result($r, 0, "delivery");
        }
        $form = str_replace("{model_desc}", $this->show_model_var("1", $model), $form);
        $form = str_replace("{caption}", $caption, $form);
        $form = str_replace("{code}", $code, $form);
        $form = str_replace("{few_words}", $few_words, $form);
        $form = str_replace("{model}", $model, $form);
        $form = str_replace("{price}", $price, $form);
        $form = str_replace("{price1}", $price1, $form);
        $form = str_replace("{sklad}", "<span style='color:#$sklad_color;'>$sklad_cap</span>", $form);
        $form = str_replace("{delivery}", "<span style='color:#$sklad_color;'>$delivery</span>", $form);
        if ($sklad_op == 1) {
            $form = str_replace("{buy_url}", "javascript:show_busket_form('$model');", $form);
        }
        if ($sklad_op == 0) {
            $form = str_replace("{buy_url}", "#", $form);
            $form = str_replace("button_buy add", "button_buy disabled", $form);
            $form = str_replace("Купить", "Не доступно для заказа", $form);

        }
        $form = str_replace("{url_compare}", "javascript:add_model_compare('$model');", $form);
        list($model_img, $other_img) = $this->show_model_fotos($model);
        $form = str_replace("{model_img}", $model_img, $form);
        $form = str_replace("{other_img}", $other_img, $form);
        $form = str_replace("{model_vote}", $this->show_model_vote($model), $form);
        $form = str_replace("{model_sale}", $this->show_sale_items($top_id), $form);
        $form = str_replace("{articles}", $this->show_top_id_articles($top_id, ""), $form);
        $form = str_replace("{model_actions}", $this->show_actions($model), $form);
        $seo_info = $this->show_catalogue_seo_info($model);
        if ($seo_info != "") {
            $form = str_replace("{seo_info}", $seo_info, $form);
        }
        return $form;
    }

    function get_sklad_options($sklad)
    {
        $db = new db;
        $r = $db->query("select * from sklad where id='$sklad' limit 1 offset 0;");
        $n = $db->num_rows($r);
        if ($n == 1) {
            $caption = $db->result($r, 0, "caption");
            $color = $db->result($r, 0, "color");
            $op = $db->result($r, 0, "op");
        }
        return array($caption, $color, $op);
    }

    function show_model_fotos($model)
    {
        $db = new db;
        $slave = new slave;
        $r = $db->query("select * from catalogue_galery where cat='$model' order by main desc;");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $list = "";
            for ($i = 1; $i <= $n; $i++) {
                $id = $db->result($r, $i - 1, "id");
                $caption = $db->result($r, $i - 1, "caption");
                if (file_exists("uploads/images/catalogue/$model/$id.jpg")) {
                    $list .= "<img src='thumb.php?image=catalogue/$model/$id.jpg&size=90&height=90' border=0 alt='$caption' title='$caption' style='cursor:pointer;float:left; margin:5px;' onclick='zoomModel(\"$id\");'>";
                }
                if ($i == 1) {
                    $first = "<img src='thumb.php?image=catalogue/$model/$id.jpg&size=300&height=300' border=0 alt='$caption' title='$caption' style='cursor:pointer;' onclick='zoomModel(\"$id\");'>";
                }
            }
        }
        if ($n <= 1) {
            $list = "";
        }
        return array($first, $list);
    }

    function show_model_vote($model)
    {
        $db = new db;
        $slave = new slave;
        $vote_htm = RD . "/tpl/model_vote_form.htm";
        if (file_exists("$vote_htm")) {
            $vote_form = file_get_contents($vote_htm);
        }
        $r = $db->query("select sum(rate) as r_sum from catalogue_vote where model='$model';");
        $rate = $db->result($r, 0, "r_sum");
        $r = $db->query("select votes from catalogue where id='$model' limit 1 offset 0;");
        $n = $db->num_rows($r);
        if ($n == 1) {
            $votes = $db->result($r, 0, "votes");
        }
        if ($rate == 0) {
            $star_1 = "d";
            $star_2 = "d";
            $star_3 = "d";
            $star_4 = "d";
            $star_5 = "d";
        }
        if ($rate > 0 and $rate <= 10) {
            $star_1 = "a";
            $star_2 = "d";
            $star_3 = "d";
            $star_4 = "d";
            $star_5 = "d";
        }
        if ($rate > 10 and $rate <= 20) {
            $star_1 = "a";
            $star_2 = "a";
            $star_3 = "d";
            $star_4 = "d";
            $star_5 = "d";
        }
        if ($rate > 20 and $rate <= 30) {
            $star_1 = "a";
            $star_2 = "a";
            $star_3 = "a";
            $star_4 = "d";
            $star_5 = "d";
        }
        if ($rate > 30 and $rate <= 40) {
            $star_1 = "a";
            $star_2 = "a";
            $star_3 = "a";
            $star_4 = "a";
            $star_5 = "d";
        }
        if ($rate > 40) {
            $star_1 = "a";
            $star_2 = "a";
            $star_3 = "a";
            $star_4 = "a";
            $star_5 = "a";
        }
        $vote_form = str_replace("{model}", "$model", $vote_form);
        $vote_form = str_replace("{1}", "$star_1", $vote_form);
        $vote_form = str_replace("{2}", "$star_2", $vote_form);
        $vote_form = str_replace("{3}", "$star_3", $vote_form);
        $vote_form = str_replace("{4}", "$star_4", $vote_form);
        $vote_form = str_replace("{5}", "$star_5", $vote_form);
        $vote_form = str_replace("{votes}", $votes, $vote_form);
        $vote_form = str_replace("{end}", $slave->number_word_end($votes), $vote_form);
        return $vote_form;
    }

    function show_top_id_articles($top_id, $list)
    {
        $db = new db;
        $r = $db->query("select articles,top_id from catalogue where id='$top_id';");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $top_id = $db->result($r, 0, "top_id");
            $theme_id = $db->result($r, 0, "articles");
            if ($theme_id == 0) {
                $list = $this->show_top_id_articles($top_id, "");
            }
            if ($theme_id > 0) {
                include_once "lib/articles_class.php";
                $articles = new articles;
                $list = $articles->show_catalogue_articles($theme_id);
            }
        }
        if ($n == 0) {
            $list = "";
        }
        return $list;
    }

    function show_catalogue_seo_info($cur_id)
    {
        $db = new db;
        $r = $db->query("select seo_info from catalogue where id='$cur_id' limit 1 offset 0;");
        $n = $db->num_rows($r);
        if ($n > 0) {
            return $db->result($r, 0, "seo_info");
        }
        if ($n == 0) {
            return "";
        }
    }


//    Очень странная функция, имеет обращение к базе материнского сайта и возвращает какие то лимиты
//применение в проекте состоянием  24/07/2016 не обнаружено
    function get_limit($top_id, $cur_id, $page, $where, $where_ses)
    {
        session_start();
        $db = new db;
        $slave = new slave;
        $kpp = 15;
        if ($page == "") {
            $page = $_GET["page"];
        }
        $r = $db->query("select c.id from catalogue c inner join catalogue_model_params cmp on (c.id=cmp.cat_id) where c.ison='1' and c.is_folder='2' $where $where_ses group by cmp.cat_id;");
        $n = $db->num_rows($r);
        if ($n == 0) {
            $r = $db->query("select c.id from catalogue c where c.ison='1' and c.is_folder='2' $where $where_ses;");
            $n = $db->num_rows($r);
        }
        if ($n == 0) {
            $r = $db->query("select c.id from catalogue c where c.ison='1' and c.is_folder='2' $where;");
            $n = $db->num_rows($r);
        }
        if ($n >= 0) {
            $kol = $n;
            if ($_SESSION["where_ses"] != $where_ses) {
                $page = "";
                $_SESSION["page"] = "";
                $_SESSION["where_ses"] = $where_ses;
            };
            $pg = $page;
            if ($pg == "") {
                $pg = "0";
            }
            $pg -= 1;
            if ($pg < 0) {
                $pg = 0;
            }
            $lmt = $kpp * $pg;
            if ($page == "all") {
                $limit = " limit 0,$kol";
            }
            if ($page != "all") {
                $limit = " limit $lmt,$kpp";
            }
        }
        return $limit;
    }

    function catalogue_page_navigation($top_id, $cur_id, $page, $where, $where_ses)
    {
        $db = new db;
        $slave = new slave;
        $kpp = 15;
        if ($page == "") {
            $page = $_GET["page"];
            if ($page == "") {
                $page = "1";
            }
        }
        $cur_page = $page;
        $r = $db->query("select c.id from catalogue c inner join catalogue_model_params cmp on (c.id=cmp.cat_id) where c.ison='1' and c.is_folder='2' $where $where_ses group by cmp.cat_id;");
        $n = $db->num_rows($r);
        if ($n == 0) {
            $r = $db->query("select c.id from catalogue c where c.ison='1' and c.is_folder='2' $where $where_ses;");
            $n = $db->num_rows($r);
        }
        if ($n > 0) {
            $kol = $n;
            $kol_p = ceil($kol / $kpp);
            if ($kol_p > 1) {
                if ($kol_p <= 10) {
                    for ($i = 1; $i <= $kol_p; $i++) {
                        if ($i != $cur_page) {
                            $menu .= "<div style='width:15px; height:23px;float:left; margin-left:2px; padding-top:4px;'><a href='#page=$i' onClick='setRangePage(\"$i\")' class='navigation' align='center'>$i</a></div>";
                        }
                        if ($i == $cur_page) {
                            $menu .= "<div style='width:25px; height:23px; margin-left:6px; background:url(theme/images/navigation_s.png) no-repeat; padding-top:4px; color:#ffffff; float:left; ' align='center'>$i</div>";
                        }
                    }
                }
                if ($kol_p > 10) {
                    $start = $cur_page - 4;
                    $end = $cur_page + 4;
                    if ($start < 1) {
                        $end = $end - $start;
                        $start = 1;
                    }
                    if ($end > $cur_page + 4) {
                        $end = $cur_page + 4;
                    }
                    if ($end < 8) {
                        $end = 8;
                    }
                    if ($end > $kol_p) {
                        $end = $kol_p;
                    }
                    for ($i = $start; $i <= $end; $i++) {
                        if ($i != $cur_page) {
                            $menu .= "<div style='width:15px; height:23px;float:left;'><a href='#page=$i' onClick='setRangePage(\"$i\")' class='navigation' align='center'>$i</a></div>";
                        }
                        if ($i == $cur_page) {
                            $menu .= "<div style='width:25px; height:23px; margin-left:4px; background:url(theme/images/navigation_s.png) no-repeat; color:#ffffff; float:left;' align='center'>$i</div>";
                        }
                    }
                }
//				$menu="<a class='navigation' href='#page=all' onClick='setRangePage(\"all\")'>".$LANG["all"]."</a> | ".$menu;
                $menu = "<div style='position:relative;'><div class='navigation' style='position:absolute; left:0px; top:-3px; width:220px; height:23px;'>" . $menu . "</div></div>";
            }
        }
        return $menu;
    }

    function catalogue_page_order_form()
    {
        session_start();
        $disc = $_SESSION["discount"];
        $db = new db;
        $slave = new slave;
        $query = $_SERVER["QUERY_STRING"];
        if (stristr($query, "&filter=")) {
            $query = ereg_replace("&filter=true", "", $query);
        }
        if (stristr($query, "&order_by=")) {
            $query = ereg_replace("&order_by=([a-z0-9_.:])*", "", $query);
        }
        $qwerty = $query;
        $order_by = $_SESSION["order_by"];
        if ($order_by == "") {
            $order_by = "c.votes_desc";
        }
        $caps = array("1" => "По популярности", "2" => "По цене (сначала дешевые)", "3" => "По цене (сначала дорогие)", "4" => "По названию");
        $field = array("1" => "c.votes_desc", "2" => "c.price$disc" . "_asc", "3" => "c.price$disc" . "_desc", "4" => "c.caption_asc");
        for ($i = 1; $i <= 4; $i++) {
            if ($order_by == $field[$i]) {
                $menu .= "<option value='$field[$i]' selected='selected'>" . $caps[$i] . "</option>";
            }
            if ($order_by != $field[$i]) {
                $menu .= "<option value='$field[$i]' onclick='location.href=\"?$query&filter=true&order_by=" . $field[$i] . "\"'>" . $caps[$i] . "</option>";
            }
        }
        $menu = "<span style='font-size:12px;'><strong>Сортировать по</strong></span> <select name='order_by' size='1' style='font-size:12px;'>" . $menu . "</select>";
        return $menu;
    }

    function show_model_img($model, $file)
    {
        if ($file == "") {
            $file = $this->get_model_img($model);
        }
        return "<img src='thumb.php?image=catalogue/$model/$file&size=300' style='border:1px solid #d9d9d9;'>";
    }

    function get_model_img($model)
    {
        $db = new db;
        $r = $db->query("select * from catalogue_galery where cat='$model' order by main desc;");
        $n = $db->num_rows($r);
        $file = "nofoto.jpg";
        if ($n > 0) {
            $id = $db->result($r, 0, "id");
            if (file_exists("uploads/images/catalogue/$model/$id.jpg")) {
                $file = "$id.jpg";
            }
            if (!file_exists("uploads/images/catalogue/$model/$id.jpg")) {
                $file = "nofoto.jpg";
            }
        }
        return $file;
    }

    function get_model_image($id)
    {
        $db = new db;
        $r = $db->query("select cat from catalogue_galery where id='$id' limit 1 offset 0;");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $model = $db->result($r, 0, "cat");
            $caption = $db->result($r, 0, "caption");
            if (file_exists("uploads/images/catalogue/$model/$id.jpg")) {
                $file = "<img src='thumb.php?image=catalogue/$model/$id.jpg&size=1000' border=0 alt='$caption' title='$caption'>";
            }
            if (!file_exists("uploads/images/catalogue/$model/$id.jpg")) {
                $file = "<img src='thumb.php?image=catalogue/$model/nofoto.jpg&size=650' border=0 alt='$caption' title='$caption'>";
            }
        }
        return $file;
    }

    function show_catalogue_menu($top_id, $cur_id)
    {
        $db = new db;
        $slave = new slave;
        $dep = "23";
        $scroll_yes = $_GET["scroll"];
        if ($top_id == "" and $cur_id == "") {
            $top_id = 0;
            $cur_id = $this->get_first_cur_id();
        }
        if ($cur_id == "") {
            $cur_id = $top_id;
            $top_id = $this->get_top_id($cur_id);
        }
        $order = "id asc";
        if ($top_id == "0") {
            $order = "id asc";
        }
        $r = $db->query("select id,caption from catalogue where (top_id='$top_id' and ison='1' and is_folder='1') order by $order;");
        $n = $db->num_rows($r);
        if ($n > 0) {
            for ($i = 1; $i <= $n; $i++) {
                $id = $db->result($r, $i - 1, "id");
                $caption = $db->result($r, $i - 1, "caption");
                $scroll = "";
                if ($scroll_yes == "") {
                    $scroll = "&scroll=minimize";
                }
                $url = "?dep=$dep&top_id=$top_id&cur_id=$id";
                if ($top_id == "0") {
                    if ($id != $cur_id) {
                        $menu .= " 
					<tr height='24' align='left'><td style='width:3px; font-size:5px;'></td><td onclick='location.href=\"$url\";' style='cursor:pointer; background-repeat:repeat-x; '>&nbsp;<a href='$url' class='top_menu'>$caption</a</td><td style='width:4px'></td></tr><tr><td height='6'></td></tr>";
                    }
                    if ($id == $cur_id) {
                        $menu .= "<tr height='24' align='left'><td style='width:3px font-size:5px;' background='theme/images/mbs_l.png'></td><td background='theme/images/mbs.png' onclick='location.href=\"$url\";' style='cursor:pointer; background-repeat:repeat-x; '>&nbsp;<a href='$url' class='top_menu' style='color:#FFFFFF' style='color:#FFFFFF;'>$caption</a</td><td style='width:4px' background='theme/images/mbs_r.png'></td></tr><tr><td height='6'></td></tr>";
                    }
                    if ($id == $cur_id and $scroll_yes == "") {
                        $menu .= "<tr align='left'><td></td><td colspan=2>" . $this->show_next_level_menu($cur_id) . "</td></tr>";
                    }
                }
                if ($top_id != "0") {
                    if ($id != $cur_id) {
                        $menu .= "<img src='theme/images/li2.png'> <a class='dep' href='$url'>$caption</a><div class='dm'></div>";
                    }
                    if ($id == $cur_id) {
                        $menu .= "<img src='theme/images/li2_a.png'> <a class='dep' href='$url$scroll' style='color:#fb0100;'>$caption</a><div class='dm'></div>";
                    }
                    if ($id == $cur_id and $scroll_yes == "") {
                        $menu .= $this->show_next_level_menu($cur_id);
                    }
                }
            }
            $menu = $this->show_up_level_menu($top_id, $menu);
            $menu = "<table width='190' border=0 cellpadding=0 cellspacing=0 id='catalogue'>" . $menu . "</table>";
        }
        return $menu;
    }
    //------------------------------------------------
    //
    //------------------------------------------------

    function show_next_level_menu($cur_id)
    {
        $db = new db;
        $dep = "23";
        $r = $db->query("select id,caption from catalogue where top_id='$cur_id' and is_folder='1' and ison='1' order by id asc;");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $next_menu = "<ul>";
            for ($i = 1; $i <= $n; $i++) {
                $id = $db->result($r, $i - 1, "id");
                $caption = $db->result($r, $i - 1, "caption");
                $next_menu .= "<img src='theme/images/li2.png'><a class='dep' href='?dep=$dep&top_id=$cur_id&cur_id=$id'>$caption</a><div class='dm'></div>";
            }
            $next_menu .= "</ul>";
        }
        return $next_menu;
    }

    function show_up_level_menu($cur_id, $catalogue_menu)
    {
        $db = new db;
        $dep = "23";
        $r = $db->query("select top_id from catalogue where id='$cur_id' and ison='1' order by id asc;");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $top_id = $db->result($r, 0, "top_id");
            $top_main = "";
            $order = "id asc";
            if ($top_id == "0") {
                $order = "id asc";
            }
            $r1 = $db->query("select id,caption from catalogue where (top_id='$top_id' and is_folder='1' and ison='1') order by $order;");
            $n1 = $db->num_rows($r1);
            for ($i = 1; $i <= $n1; $i++) {
                $id = $db->result($r1, $i - 1, "id");
                $caption = $db->result($r1, $i - 1, "caption");
                $url = "?dep=$dep&top_id=$top_id&cur_id=$id";
                if ($top_id != "0") {
                    if ($id == $cur_id) {
                        $up_menu .= "<img src='theme/images/li2_a.png'> <a class='dep' href='$url'>$caption</a><div class='dm'></div>";
                    }
                    if ($id != $cur_id) {
                        $up_menu .= "<img src='theme/images/li2.png'> <a class='dep' href='$url'>$caption</a><div class='dm'></div>";
                    }
                }
                if ($top_id == "0") {
                    if ($id != $cur_id) {
                        $up_menu .= "<tr height='24' align='left'><td style='width:3px'></td><td onclick='location.href=\"$url\";' style='cursor:pointer; background-repeat:repeat-x; '>&nbsp;<a href='$url' class='top_menu'>$caption</a</td><td style='width:3px'></td></tr><tr><td height='6'></td></tr>";
                    }
                    if ($id == $cur_id) {
                        $up_menu .= "<tr height='24' align='left'><td style='width:3px' background='theme/images/mba_l.png'></td><td background='theme/images/mba.png' onclick='location.href=\"$url\";' style='cursor:pointer; background-repeat:repeat-x; '>&nbsp;<a href='$url' class='top_menu' style='color:#ffffff;'>$caption</a</td><td style='width:3px' background='theme/images/mba_r.png'></td></tr><tr><td height='6'></td></tr>";
                    }

                }
                if ($id == $cur_id and $top_id != "0") {
                    $up_menu .= "<p><ul>{next_menu}</ul></p>";
                }
                if ($id == $cur_id and $top_id == "0") {
                    $up_menu .= "<tr align='left'><td></td><td colspan=2><ul>{next_menu}</ul></td></tr>";
                }
            }
            $catalogue_menu = str_replace("{next_menu}", $catalogue_menu, $up_menu);
            $catalogue_menu = $this->show_up_level_menu($top_id, $catalogue_menu);
        }
        return $catalogue_menu;
    }

    function show_seo_tree()
    {
        $db = new db;
        $dep = "23";
        $r = $db->query("select id,short_caption,caption from catalogue where top_id='0' and ison='1' and is_folder='1' order by lenta,id asc limit 0,6;");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $tree = "";
            for ($i = 1; $i <= $n; $i++) {
                $id = $db->result($r, $i - 1, "id");
                $caption = $db->result($r, $i - 1, "short_caption");
                if ($caption == "") {
                    $caption = $db->result($r, $i - 1, "caption");
                }
                $url = "?dep=$dep&top_id=$top_id&cur_id=$id";
                $tree .= "
					<div class='seo_tree'>
						<div><a href='$url' class='seo_cap'>$caption</a></div>
						<div class='next'>" . $this->show_seo_tree_next($id) . "</div>
						<div><a href='$url' class='all'>Все товары $caption</a></div>
					</div>";
            }
        }
        return $tree;
    }

    function show_seo_tree_next($cur_id)
    {
//      объект db объявлен в классах mysql_class.php и mysql_lider_class.php это подключение к базе данных материнского сайта, копия базы хранится на сервере Lider для более быстрого и надёжного доступа
        $db = new db;
        $dep = "23";
        $r = $db->query("select id,caption,short_caption from catalogue where top_id='$cur_id' and is_folder='1' and ison='1' order by lenta,id asc limit 8;");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $nex_menu = "";
            for ($i = 1; $i <= $n; $i++) {
                $id = $db->result($r, $i - 1, "id");
                $caption = $db->result($r, $i - 1, "short_caption");
                if ($caption == "") {
                    $caption = $db->result($r, $i - 1, "caption");
                }
                $next_menu .= "<a href='?dep=$dep&top_id=$cur_id&cur_id=$id' class='ne'>$caption</a><br />";
            }
        }
        return $next_menu;
    }

    function show_model_opinion($model_id)
    {
//      объект db объявлен в классах mysql_class.php и mysql_lider_class.php это подключение к базе данных материнского сайта, копия базы хранится на сервере Lider для более быстрого и надёжного доступа
        $db = new db;
        $slave = new slave;
        $dep = "23";
        $opinion_form_htm = RD . "/tpl/opinion_form.htm";
        if (file_exists("$opinion_form_htm")) {
            $opinion_form = file_get_contents($opinion_form_htm);
        }
        $opinion_block_htm = RD . "/tpl/opinion_block.htm";
        if (file_exists("$opinion_block_htm")) {
            $opinion_block = file_get_contents($opinion_block_htm);
        }

        $navigation = $this->op_navigation($model_id, 0);
        $limit = $this->op_limit($model_id, 0);

        $r = $db->query("select * from catalogue_opinion where model='$model_id' order by id desc $limit;");
        $n = $db->num_rows($r);
        $opinion_list = "<table border='0' width='100%'>";
        if ($n == 0) {
            $opinion_list .= "<tr><th>Пока еще никто не оставил отзыв об этом товаре. Вы можете быть первыми</th></tr>";
        }
        for ($i = 1; $i <= $n; $i++) {
            $name = $db->result($r, $i - 1, "name");
            $user = $db->result($r, $i - 1, "user");
            $desc = $db->result($r, $i - 1, "desc");
            $pos = $db->result($r, $i - 1, "desc_pos");
            $neg = $db->result($r, $i - 1, "desc_neg");
            $data = $slave->data_word($db->result($r, $i - 1, "data"));
            $opinion_list .= "<tr><td style='border-bottom:2px dotted #086ff7;'>$opinion_block</td></tr>";

            $opinion_list = str_replace("{name}", $name, $opinion_list);
            $opinion_list = str_replace("{desc}", $desc, $opinion_list);
            $opinion_list = str_replace("{pos}", $pos, $opinion_list);
            $opinion_list = str_replace("{neg}", $neg, $opinion_list);
            $opinion_list = str_replace("{data}", $data, $opinion_list);
            $opinion_list = str_replace("{nomber}", $i, $opinion_list);
        }
        $opinion_list .= "<tr><td>$navigation</td></tr></table>";

        $opinion_form = str_replace("{opinion_list}", $opinion_list, $opinion_form);
        $opinion_form = str_replace("{op_id}", $model_id, $opinion_form);
        return $opinion_form;
    }

    function op_navigation($model, $page)
    {
        $db = new db;
        $kpp = 15;
        if ($page == "") {
            $page = "1";
        }
        $cur_page = $page;
        $r = $db->query("select count(id) as kol from catalogue_opinion where model='$model';");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $kol = $db->result($r, 0, "kol");
            $kol_p = ceil($kol / $kpp);
            for ($i = 1; $i <= $kol_p; $i++) {
                if ($i != $cur_page) {
                    $menu .= "<a href='javascript:load_opinion_form(\"$model\",\"$i\")' class='navigation'>$i</a>";
                }
                if ($i == $cur_page) {
                    $menu .= "<span class='' style='color:red;'>$i</span>";
                }
                if ($i < $kol_p) {
                    $menu .= " &nbsp; ";
                }
            }
            $menu = "<span style='font-size:10px;'>Страницы: </span>" . $menu;
        }
        return $menu;
    }

    function op_limit($model, $page)
    {
//      объект db объявлен в классах mysql_class.php и mysql_lider_class.php это подключение к базе данных материнского сайта, копия базы хранится на сервере Lider для более быстрого и надёжного доступа
        $db = new db;
        $kpp = 15;
        $r = $db->query("select count(id) as kol from catalogue_opinion where model='$model';");
        $n = $db->num_rows($r);
        if ($n > 0) {
            $kol = $db->result($r, 0, "kol");
            $pg = $page;
            if ($pg == "") {
                $pg = "0";
            }
            $pg -= 1;
            if ($pg < 0) {
                $pg = 0;
            }
            $lmt = $kpp * $pg;
            $limit = " limit $lmt,$kpp";
        }
        return $limit;
    }

    function load_model_opinion($model_id, $page)
    {
        $db = new db;
        $slave = new slave;
        $opinion_block_htm = RD . "/tpl/opinion_block.htm";
        if (file_exists("$opinion_block_htm")) {
            $opinion_block = file_get_contents($opinion_block_htm);
        }
        $navigation = $this->op_navigation($model_id, $page);
        $limit = $this->op_limit($model_id, $page);

        $r = $db->query("select * from catalogue_opinion where model='$model_id' order by id desc $limit;");
        $n = $db->num_rows($r);
        $list = "<table border='0' width='100%'>";
        if ($n == 0) {
            $list .= "<tr><th>Пока еще никто не оставил отзыв об этом товаре. Вы можете быть первыми</th></tr>";
        }
        for ($i = 1; $i <= $n; $i++) {
            $name = $db->result($r, $i - 1, "name");
            $user = $db->result($r, $i - 1, "user");
            $desc = $db->result($r, $i - 1, "desc");
            $pos = $db->result($r, $i - 1, "desc_pos");
            $neg = $db->result($r, $i - 1, "desc_neg");
            $data = $slave->data_word($db->result($r, $i - 1, "data"));
            $list .= "<tr><td>$opinion_block</td></tr>";

            $list = str_replace("{name}", $name, $list);
            $list = str_replace("{desc}", $desc, $list);
            $list = str_replace("{pos}", $pos, $list);
            $list = str_replace("{neg}", $neg, $list);
            $list = str_replace("{data}", $data, $list);
            $list = str_replace("{nomber}", $i, $list);
        }
        $list .= "<tr><td>$navigation</td></tr></table>";
        return $list;
    }

    function save_model_opinion($model, $name, $desc, $pos, $neg)
    {
        $db = new db;
        $slave = new slave;
        $desc = $slave->qq($desc);
        $name = $slave->qq($name);
        $pos = $slave->qq($pos);
        $neg = $slave->qq($neg);
        $remip = $REMOTE_ADDR;
        $db->query("insert into catalogue_opinion values ('','','$model','$name','$desc','$pos','$neg',CURDATE(),'$remip');");
        return "ok";
        if (mysql_error() != "") {
            return "Ошибка сохранения отзыва";
        }
    }

    function count_opinion_model($model)
    {
        $db = new db;
        $r = $db->query("select count(id) as kol from catalogue_opinion where model='$model_id' and desc_pos!='';");
        $op_pos = $db->result($r, 0, "kol");
        $r = $db->query("select count(id) as kol from catalogue_opinion where model='$model_id' and desc_neg!='';");
        $op_neg = $db->result($r, 0, "kol");
        return array($op_pos, $op_neg);
    }

    function check_folder_img($model)
    {
        if (file_exists("uploads/images/catalogue/$model.jpg")) {
            return "$model";
        }
        if (!file_exists("uploads/images/catalogue/$model.jpg")) {
            return "nofoto";
        }
    }

    function show_model_rating($model)
    {
        $db = new db;
        $slave = new slave;
        $r = $db->query("select sum(rate) as r_sum from catalogue_vote where model='$model';");
        $rate = $db->result($r, 0, "r_sum");
        $r = $db->query("select votes from catalogue where id='$model' limit 1;");
        $n = $db->num_rows($r);
        if ($n == 1) {
            $votes = $db->result($r, 0, "votes");
        }
        if ($rate == 0) {
            $rating = "0";
        }
        if ($rate > 0 and $rate <= 10) {
            $rating = "1";
        }
        if ($rate > 10 and $rate <= 20) {
            $rating = "2";
        }
        if ($rate > 20 and $rate <= 30) {
            $rating = "3";
        }
        if ($rate > 30 and $rate <= 40) {
            $rating = "4";
        }
        if ($rate > 40) {
            $rating = "5";
        }
        return "<img src='theme/images/op$rating.png' width='28' alt='" . $slave->number_word_end($votes) . "'>";
    }

    function save_model_vote($model, $rate)
    {
        $db = new db;
        $slave = new slave;
        session_start();
        $client = $_SESSION["client"];
        if ($client == "") {
            $mes = "Для того, чтобы проголосовать Вам необходимо авторизироваться";
        }
        if ($client != "") {
            $r = $db->query("select id from catalogue_vote where model='$model';");
            $n = $db->num_rows($r);
            if ($n == 1) {
                $mes = "Вы уже отдали свой голос за этот товар";
            }
            if ($n == 0) {
                $r1 = $db->query("select votes from catalogue where id='$model';");
                $n1 = $db->num_rows($r1);
                if ($n1 == "1") {
                    $votes = $db->result($r1, 0, "votes") + 1;
                    $db->query("insert into catalogue_vote values ('','$model','$client','$rate');");
                    $db->query("update catalogue set votes='$votes' where id='$model';");
                    $mes = "Спасибо! Ваш голос принят";
                }
            }
        }
        return "<div align='center' style='font-size:20px; color:#000000;'>" . $mes . "<br><br></div>";
    }

    function add_model_compare($model)
    {
        session_start();
        $form_htm = RD . "/tpl/catalogue_compare_info.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        if ($_SESSION["kolc"] == "") {
            $_SESSION["kolc"] = "0";
        }
        $kolc = $_SESSION["kolc"];
        $er = 0;
        for ($i = 1; $i <= $kolc; $i++) {
            if ($_SESSION["model$i"] == $model) {
                $er = 1;
                break;
            }
        }
        if ($er == 1) {
            $answer = "Данная модель уже находится в таблице сравнений";
        }
        if ($er == 0) {
            $_SESSION["kolc"] += 1;
            $kolc = $_SESSION["kolc"];
            $_SESSION["model$kolc"] = $model;
            $answer = "Модель успешно добавлена в таблицу сравнений";
        }
        $form = str_replace("{answer}", $answer, $form);
        return $form;
    }

    function delete_model_compare($model)
    {
        session_start();
        unset($_SESSION["model$model"]);
        unset($_SESSION["model$model"]);
        return $this->show_model_compare();
    }

    function show_model_compare()
    {
        session_start();
        $kolc = $_SESSION["kolc"];
        $disc = $_SESSION["discount"];
        $db = new db;
        $slave = new slave;
        $dep = "23";
        $kours = new kours;
        $form_htm = RD . "/tpl/catalogue_compare.htm";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $model_list_htm = RD . "/tpl/model_compare.htm";
        if (file_exists("$model_list_htm")) {
            $model_list = file_get_contents($model_list_htm);
        }
        $list = "<table border=0><tr align='left' valign='top'>";
        for ($i = 1; $i <= $kolc; $i++) {
            if ($_SESSION["model$i"] != "") {
                $r = $db->query("select * from catalogue where ison='1' and id='" . $_SESSION["model$i"] . "' limit 1;");
                $n = $db->num_rows($r);
                if ($n > 0) {
                    $prm = 0;
                    $id = $db->result($r, 0, "id");
                    $top_id = $db->result($r, 0, "top_id");
                    $caption = $db->result($r, 0, "caption");
                    $few_words = $db->result($r, 0, "few_words");
                    $price = $kours->show_cash_price($db->result($r, 0, "price$disc"));
                    $sale = $db->result($r, 0, "sale");
                    if ($sale == "1") {
                        $prm = "sale";
                    }
                    $rp = $db->result($r, 0, "red_price");
                    if ($rp != "" and $rp != "0") {
                        $prm = "rp";
                    }
                    $list .= "<td>$model_list</td><td width='3px'></td>";
                    $img_file = $this->get_model_img($id);
                    $img = "<img src='thumb.php?image=catalogue/$id/$img_file&size=150&prm=$prm'>";
                    $list = str_replace("{caption}", $caption, $list);
                    $list = str_replace("{model_del}", $i, $list);
                    $list = str_replace("{price}", $price, $list);
                    $list = str_replace("{img}", $img, $list);
                    $list = str_replace("{desc}", $few_words, $list);
                }
            }
        }
        $list .= "</tr></table>";
        $form = str_replace("{list}", $list, $form);
        return $form;
    }
}

?>