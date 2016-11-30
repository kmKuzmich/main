<?php

class slave
{
    function escape_inj($text_inp)
    {
        $text = strtolower($text_inp); // Приравниваем текст параметра к нижнему регистру
        if (
            !strpos($text, "select") && //
            !strpos($text, "union") && //
            !strpos($text, "select") && //
            !strpos($text, "order") && // Ищем вхождение слов в параметре
            !strpos($text, "where") && //
            !strpos($text, "from") //
        ) {
            return $text_inp; // Вхождений нету - возвращаем true
        } else {
            return ""; // Вхождения есть - возвращаем false
        }
    }

    var $month_id;

    function site_year()
    {
        $start = "2009";
        $cur = date("Y");
        if ($cur > $start) {
            $site_year = "$start-$cur ";
        }
        if ($cur == $start) {
            $site_year = "$start ";
        }
        return $site_year . "г";
    }

//	преобразование запятой в точку и отображение до 2-х знаков после запятой
    function tomoney($val)
    {
        if (strrpos($val, ",")) {
            $vls = explode(",", $val);
            $result = $vls[0] . "." . substr($vls[1], 0, 2);
        } else {
            $vls = explode(".", $val);
            $result = $vls[0] . "." . substr($vls[1], 0, 2);
        }
        return $result;
    }

    function meta_head()
    {
        $config = new config;
        list($cTitle, $cKeywords, $cDescription, $seo_info) = $config->get_meta_data();
        $odb = new odb;
        $dep_cur = $this->get_dep_cur();
        $dep = $this->get_dep();
        if ($dep_cur != "") {
            $r = $odb->query_td("select caption,key_words,description,seo_info from deps where id='$dep_cur' and ison='1' and visible='1' limit 1 offset 0;");
            while (odbc_fetch_row($r)) {
                $title = odbc_result($r, "caption");
                $keywords = odbc_result($r, "key_words");
                $description = odbc_result($r, "description");
                $seo_info = odbc_result($r, "seo_info");
            }
        }
        $head = array(
            'title' => "$title $cTitle",
            'keywords' => "$keywords $cKeywords",
            'description' => "$description $cDescription",
            'seo_info' => "$seo_info"
        );
        return $head;
    }

    function get_month_name($month_id, $p)
    {
        $mnths = array('m01' => "Январь", 'm02' => "Февраль", 'm03' => "Март", 'm04' => "Апрель", 'm05' => "Май", 'm06' => "Июнь", 'm07' => "Июль", 'm08' => "Август", 'm09' => "Сентябрь", 'm10' => "Октябрь", 'm11' => "Ноябрь", 'm12' => "Декабрь");
        $mnths2 = array('m01' => "Января", 'm02' => "Февраля", 'm03' => "Марта", 'm04' => "Апреля", 'm05' => "Мая", 'm06' => "Июня", 'm07' => "Июля", 'm08' => "Августа", 'm09' => "Сентября", 'm10' => "Октября", 'm11' => "Ноября", 'm12' => "Декабря");
        if (strlen($month_id) < 2) {
            $month_id = "0" . $month_id;
        }
        if ($p == "") {
            return $mnths["$month_id"];
        }
        if ($p == "2") {
            return $mnths2["$month_id"];
        }
    }

    function data_word($data)
    {
        return $this->data_word_ru($data);
    }

    function data_word_ua($data)
    {
        $mon = substr($data, 5, 2);
        $mnths = array('01' => "Січня", '02' => "Лютого", '03' => "Березня", '04' => "Квітня", '05' => "Травня", '06' => "Червня", '07' => "Липня", '08' => "Серпня", '09' => "Вересня", '10' => "Жовтня", '11' => "Листопада", '12' => "Грудня");
        if (substr($data, 8, 1) == "0") {
            $day = substr($data, 9, 1);
        }
        if (substr($data, 8, 1) != "0") {
            $day = substr($data, 8, 2);
        }
        return $day . " " . $mnths[$mon] . " " . substr($data, 0, 4) . " р.";
    }

    function data_word_ru($data)
    {
        $mon = substr($data, 5, 2);
        $mnths = array('01' => "Января", '02' => "Февраля", '03' => "Марта", '04' => "Апреля", '05' => "Мая", '06' => "Июня", '07' => "Июля", '08' => "Августа", '09' => "Сентября", '10' => "Октября", '11' => "Ноября", '12' => "Декабря");
        if (substr($data, 8, 1) == "0") {
            $day = substr($data, 9, 1);
        }
        if (substr($data, 8, 1) != "0") {
            $day = substr($data, 8, 2);
        }
        return $day . " " . $mnths[$mon] . " " . substr($data, 0, 4) . " г.";
    }

    function get_calendar($name)
    {
        return "<a href='javascript:void(0)' onclick='gfPop.fPopCalendar(document.getElementById(\"$name\"));return false;' HIDEFOCUS><img name='popcal' align='absbottom' src='js/calendar/calbtn.gif' width='34' height='22' border='0' alt=''></a><iframe width=174 height=189 name='gToday:normal:agenda.js' id='gToday:normal:agenda.js' src='js/calendar/ipopeng.htm' scrolling='no' frameborder='0' style='visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;'></iframe>";
    }

    function gen_form_serial()
    {
        $serial = mt_rand() . "" . mt_rand();
        session_start();
        $_SESSION["serial"] = $serial;
        return $serial;
    }

    function qq_main($q)
    {
        return $this->escape_inj(str_replace("''", "'", $q));
    }

    function qq($q)
    {
        $q = $this->escape_inj($q);
        $q = str_replace("'", "&rsquo;", $q);
        $q = str_replace("’", "&rsquo;", $q);
        $q = str_replace("\n", "<br>", $q);
        $q = str_replace("\"", "&quot;", $q);
        return $q;
    }

    function qqback($q)
    {
        return str_replace("&rsquo;", "'", $q);
    }

    function number_word_end($num)
    {
        $num = substr($num, -1);
        if ($lan == "ru") {
            $num = strtr($num, array("0" => "ов", "1" => "", "2" => "а", "3" => "а", "4" => "а", "5" => "ов", "6" => "ов", "7" => "ов", "8" => "ов", "9" => "ов"));
        }
        if ($lan == "en") {
            $num = strtr($num, array("0" => "", "1" => "", "2" => "", "3" => "", "4" => "", "5" => "", "6" => "", "7" => "", "8" => "", "9" => ""));
        }
        return $num;
    }

    function get_date_from()
    {
        if ($_POST["date_from"] == "") {
            return $_GET["date_from"];
        }
        if ($_POST["date_from"] != "") {
            return $_POST["date_from"];
        }
    }

    function get_date_to()
    {
        if ($_POST["date_to"] == "") {
            return $_GET["date_to"];
        }
        if ($_POST["date_to"] != "") {
            return $_POST["date_to"];
        }
    }

    function get_dep()
    {
        if ($_POST["dep"] == "") {
            return $_GET["dep"];
        }
        if ($_POST["dep"] != "") {
            return $_POST["dep"];
        }
    }

    function get_w()
    {
        if ($_POST["w"] == "") {
            return $_GET["w"];
        }
        if ($_POST["w"] != "") {
            return $_POST["w"];
        }
    }

    function get_conf()
    {
        if ($_POST["conf"] == "") {
            return $_GET["conf"];
        }
        if ($_POST["conf"] != "") {
            return $_POST["conf"];
        }
    }

    function get_dep_up()
    {
        if ($_POST["dep_up"] == "") {
            return $_GET["dep_up"];
        }
        if ($_POST["dep_up"] != "") {
            return $_POST["dep_up"];
        }
    }

    function get_dep_cur()
    {
        if ($_POST["dep_cur"] == "") {
            return $_GET["dep_cur"];
        }
        if ($_POST["dep_cur"] != "") {
            return $_POST["dep_cur"];
        }
    }

    function get_sub_menu()
    {
        if ($_POST["sub_menu"] == "") {
            return $_GET["sub_menu"];
        }
        if ($_POST["sub_menu"] != "") {
            return $_POST["sub_menu"];
        }
    }

    function get_top_id()
    {
        if ($_POST["top_id"] == "") {
            return $_GET["top_id"];
        }
        if ($_POST["top_id"] != "") {
            return $_POST["top_id"];
        }
    }

    function get_cur_id()
    {
        if ($_POST["cur_id"] == "") {
            return $_GET["cur_id"];
        }
        if ($_POST["cur_id"] != "") {
            return $_POST["cur_id"];
        }
    }

    function get_model()
    {
        if ($_POST["model"] == "") {
            return $_GET["model"];
        }
        if ($_POST["model"] != "") {
            return $_POST["model"];
        }
    }

    function get_module()
    {
        if ($_POST["module"] == "") {
            return $_GET["module"];
        }
        if ($_POST["module"] != "") {
            return $_POST["module"];
        }
    }

    function get_module_page()
    {
        if ($_POST["module_page"] == "") {
            return $_GET["module_page"];
        }
        if ($_POST["module_page"] != "") {
            return $_POST["module_page"];
        }
    }

    function get_forum_id()
    {
        if ($_POST["forum_id"] == "") {
            return $_GET["forum_id"];
        }
        if ($_POST["forum_id"] != "") {
            return $_POST["forum_id"];
        }
    }

    function get_theme_id()
    {
        if ($_POST["theme_id"] == "") {
            return $_GET["theme_id"];
        }
        if ($_POST["theme_id"] != "") {
            return $_POST["theme_id"];
        }
    }

    function get_page()
    {
        if ($_POST["page"] == "") {
            return $_GET["page"];
        }
        if ($_POST["page"] != "") {
            return $_POST["page"];
        }
    }

    function get_var()
    {
        if ($_POST["var"] == "") {
            return $_GET["var"];
        }
        if ($_POST["var"] != "") {
            return $_POST["var"];
        }
    }

    function get_link($srch, $lnk)
    {
        $lnk .= "&";
        $pos = strpos($lnk, $srch);
        $s = "";
        $srch_val = "";
        for ($i = $pos + strlen($srch) + 1; $i <= strlen($lnk); $i++) {
            $s = substr($lnk, $i, 1);
            if ($s == "&") {
                $i = strlen($lnk) + 2;
                return $srch_val;
            }
            if ($s != "&") {
                $srch_val .= $s;
            }
        }
        return $srch_val;
    }

    function get_dep_caption($dep)
    {
        $caption = "";
        if ($dep != "0") {
            $odb = new odb;
            $r = $odb->query_td("select caption from deps where id='$dep' and ison='1';");
            odbc_fetch_row($r);
            $caption = odbc_result($r, "caption");
        }
        return $caption;
    }

    function get_file_deps($file)
    {
        $odb = new odb;
        $r = $odb->query_td("select id from module_files where file='$file' and system='1';");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
            $r1 = $odb->query_td("select id,dep_up from deps where file='$id';");
            while (odbc_fetch_row($r1)) {
                $dep_cur = odbc_result($r1, "id");
                $dep_up = odbc_result($r1, "dep_up");
            }
        }
        return array($dep_up, $dep_cur);
    }

    function find_up_level($dep_cur)
    {
        $odb = new odb;
        $r = $odb->query_td("select id from main_banners where dep_cur='$dep_cur' and ison='1';");
        $n = $odb->num_rows($r);
        if ($n > 0) {
            $result = $dep_cur;
        }
        if ($n == 0) {
            $r1 = $odb->query_td("select dep_up from deps where id='$dep_cur' and ison='1';");
            while (odbc_fetch_row($r1)) {
                $dep_up = odbc_result($r1, "dep_up");
                if ($dep_up != "0") {
                    $result = $this->find_up_level($dep_up);
                }
            }
        }
        return $result;
    }

    function show_navigation($id, $nav_menu)
    {
        $odb = new odb;
        if (empty($id)) {
            $id = 5;
        }
        $r = $odb->query_td("select dep_up,caption,file from deps where id='$id';");
        $n = $odb->num_rows(($r));
        while (odbc_fetch_row($r)) {
            $dep_up = odbc_result($r, "dep_up");
            $file = odbc_result($r, "file");
            $caption = odbc_result($r, "caption");
            $menu = " &raquo; <a class='navigation' href='?dep=$file&dep_up=$dep_up&dep_cur=$id'>$caption</a>";
            $nav_menu = $menu . $nav_menu;
            $nav_menu = $this->show_navigation($dep_up, $nav_menu);
        }
        if ($n == 0) {
            $nav_menu = "&nbsp; <a class='navigation' href='?'>Главная</a>" . $nav_menu;
        }
        return $nav_menu;
    }

    function resizeimage($image, $size, $filedir, $prefix)
    {
        $prod_img = $filedir . $image;
        $prod_img_thumb = $filedir . $prefix . $image;
        if (file_exists("$prod_img")) {
            $sizes = getimagesize("$prod_img");
            $aspect_ratio = $sizes[0] / $sizes[1];
            $type = $sizes[2];
            if ($sizes[0] <= $size) {
                $new_width = $sizes[0];
                $new_height = $sizes[1];
            } else {
                $new_width = $size;
                $new_height = abs($new_width / $aspect_ratio);
            }
            $destimg = imagecreatetruecolor($new_width, $new_height);
            if ($type == 1) {
                $srcimg = ImageCreateFromGIF($prod_img);
            }
            if ($type == 2) {
                $srcimg = ImageCreateFromJPEG($prod_img);
            }
            if ($type == 3) {
                $srcimg = ImageCreateFromPNG($prod_img);
            }
            if ($type == 4) {
                $srcimg = ImageCreateFromWBMP($prod_img);
            }

            imagecopyresampled($destimg, $srcimg, 0, 0, 0, 0, $new_width, $new_height, ImageSX($srcimg), ImageSY($srcimg));
            if ($type == 1) {
                ImageGIF($destimg, $prod_img_thumb, 100);
            }
            if ($type == 2) {
                ImageJPEG($destimg, $prod_img_thumb, 100);
            }
            if ($type == 3) {
                imagecolortransparent($destimg, "");
                ImagePNG($destimg, $prod_img_thumb, 100);
            }
            if ($type == 4) {
                ImageWBMP($destimg, $prod_img_thumb, 100);
            }

            imagedestroy($destimg);
        }
        return;
    }

    function int_to_money($int)
    {
        if ($int != "Предзаказ") {
            $int = str_replace(",", ".", $int);
            if (strpos($int, ".") > 0 and strpos($int, ".") == strlen($int) - 2) {
                $int .= "0";
            }
            if (strpos($int, ".") == 0) {
                $int .= ".00";
            }
        }
        return $int;
    }

    function translit($st)
    {
        $st = strtr($st, "абвгдеёзийклмнопрстуфхъыэ_", "abvgdeeziyklmnoprstufh'iei");
        $st = strtr($st, "АБВГДЕЁЗИЙКЛМНОПРСТУФХЪЫЭ_", "ABVGDEEZIYKLMNOPRSTUFH'IEI");
        $st = strtr($st, array(
            "ж" => "zh", "ц" => "ts", "ч" => "ch", "ш" => "sh",
            "щ" => "shch", "ь" => "", "ю" => "yu", "я" => "ya",
            "Ж" => "ZH", "Ц" => "TS", "Ч" => "CH", "Ш" => "SH",
            "Щ" => "SHCH", "Ь" => "", "Ю" => "YU", "Я" => "YA",
            "ї" => "i", "Ї" => "Yi", "є" => "ye", "Є" => "Ye"
        ));
        return $st;
    }

    function translit_c($st)
    {
        $st = strtr($st, "абвгдеёзийклмнопрстуфхъыэ_", "abvgdeeziyklmnoppctufh'iei");
        $st = strtr($st, "АБВГДЕЁЗИЙКЛМНОПРСТУФХЪЫЭ_", "ABVGDEEZIYKLMNOPPCTUFH'IEI");
        $st = strtr($st, array(
            "ж" => "zh", "ц" => "ts", "ч" => "ch", "ш" => "sh",
            "щ" => "shch", "ь" => "", "ю" => "yu", "я" => "ya",
            "Ж" => "ZH", "Ц" => "TS", "Ч" => "CH", "Ш" => "SH",
            "Щ" => "SHCH", "Ь" => "", "Ю" => "YU", "Я" => "YA",
            "ї" => "i", "Ї" => "Yi", "є" => "ye", "Є" => "Ye"
        ));
        return $st;
    }

    function from_1c_data($data)
    {
        $mon = substr($data, 6, 2);
        $day = substr($data, 4, 2);
        $year = substr($data, 0, 4);
        return "$year-$mon-$day";
    }

    function show_head_tbl($caption)
    {
        return "
		<table style='width: 100%; height: auto; overflow: hidden; background-color: rgb(232, 69, 70); float: left; margin-left: 8px; margin-top: 10px; padding: 0px; background-image: url(theme/images/bg_texture.gif); background-repeat: no-repeat; background-position: right top;' cellpadding='0' cellspacing='0'>
        	<tr>
            	<td width='10' height='10' style=' width:10px;background-image: url(theme/images/tl_corn_r.gif); background-repeat: no-repeat;'></td>
                <td height='10' style='background-image: url(theme/images/top_strip_r.gif); background-repeat: repeat-x; '></td>
                <td width='10' height='10' style='background-image: url(theme/images/tr_corn_r.gif); background-repeat: no-repeat;'></td>
            </tr>
            <tr>
            	<td width='10' style=' background-image: url(theme/images/left_strip_r.gif); background-repeat: repeat-y;'></td>
                <td style='height: 30px; max-height: 30px; overflow: hidden; text-transform: uppercase; padding-bottom: 0px;'><div style='width: 100%; height: 30px; max-height: 30px; max-width: 100%; overflow: hidden; color:#FFFFFF; font:normal 18px Arial; text-transform: uppercase; padding-bottom: 0px;'>$caption</div></td>
                <td width='10' style='background-image: url(theme/images/right_strip_r.gif); background-repeat: repeat-y;'></td>
            </tr>
            <tr>
            	<td width='10' height='10' style='background-image: url(theme/images/bl_corn_r.gif); background-repeat: no-repeat;'></td>
            	<td height='10' style='background-image: url(theme/images/bottom_strip_r.gif); background-repeat: repeat-x;'></td>
                <td width='10' height='10' style='background-image: url(theme/images/br_corn_r.gif); background-repeat: no-repeat;'></td>
            </tr></table>
		";
    }

    function show_head($caption)
    {
        return "
		<table width='100%' height='45' cellpadding='0' cellspacing='0' border='0'><tr>
		<td width='46' align='left'><img src='theme/images/head_ico.png' /></td>
    	<td style='color:#ff7200; font:normal 24px Tahoma;'>$caption</td>
		</tr></table>";
    }
}

?>