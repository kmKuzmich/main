<?php

class menu
{
    function show_top_menu($dep_cur)
    {
        session_start();
        $client = $_SESSION["client"];
        $odb = new odb;
        $slave = new slave;
        $dep_up = $this->find_dep_up($dep_cur);
        $r = $odb->query_td("select id,caption,file,link
                            from deps
                            where dep_up=0 and visible='1' and ison='1' order by lenta,id asc limit 7;");
        $m = 1;
        $menu = "";
        while (odbc_fetch_row($r)) {
            $caption = odbc_result($r, "caption");
            $id = odbc_result($r, "id");
            $file = odbc_result($r, "file");
            $url = odbc_result($r, "link");

            if ($url == "") {
                $url = "?dep=$file&dep_up=0&dep_cur=$id";
            }
            if ($id == "4" and $client == "") {
                $menu .= "";
            }
            if ($id == "4" and $client != "") {
                $menu .= "<td class='top_menu' onclick='location.href=\"$url\";'><a href='$url' class='top_menu'>$caption</a></td>";
                if ($i < $n) {
                    $menu .= "<td width='10'>|</td>";
                }
            }
            if ($id != "4") {
                $menu .= "<td class='top_menu' onclick='location.href=\"$url\";'><a href='$url' class='top_menu'>$caption</a></td>";
                if ($i < $n) {
                    $menu .= "<td width='10'>|</td>";
                }
            }
        }
        $menu .= "<td width='200'>&nbsp;</td>";
        return $menu;
    }

    function show_dep_menu($dep_up, $dep_cur)
    {
        $odb = new odb;
        $slave = new slave;
        if ($dep_up == "" and $dep_cur != "") {
            $dep_up = $dep_cur;
        }
        if ($dep_up == "" and $dep_cur == "") {
            $dep_up = 0;
        }
        $scroll_yes = $_GET["scroll"];
        $r = $odb->query_td("select id,dep_up,caption,file from deps where dep_up='$dep_up' and visible='1' and ison='1' order by lenta,id asc;");
        while (odbc_fetch_row($r)) {
            $caption = odbc_result($r, "caption");
            $dep_up = odbc_result($r, "dep_up");
            $id = odbc_result($r, "id");
            $file = odbc_result($r, "file");
            $scroll = "";
            if ($scroll_yes == "") {
                $scroll = "&scroll=minimize";
            }
            $url = "?dep=$file&dep_up=$dep_up&dep_cur=$id";

            if ($dep_up == "0") {
                if ($id == $dep_cur) {
                    $dep_menu .= "<tr height='24'><td onclick='location.href=\"$url\";'>&nbsp;<a href='$url' class='top_menu'>$caption</a</td></tr><tr><td height='6'></td></tr>";
                }
                if ($id == $dep_cur and $scroll_yes == "") {
                    $dep_menu .= "<tr><td>" . $this->show_next_level_menu($dep_cur) . "</td></tr>";
                }
            }
            if ($dep_up != "0") {
                if ($id != $dep_cur) {
                    $dep_menu .= "<a class='menu' href='$url'>$caption</a><div class='dm'></div>";
                }
                if ($id == $dep_cur) {
                    $dep_menu .= "<a class='menu_s' href='$url$scroll'>$caption</a><div class='dm'></div>";
                }
                if ($id == $dep_cur and $scroll_yes == "") {
                    $dep_menu .= $this->show_next_level_menu($dep_cur);
                }
            }
        }
        $dep_menu = $this->show_up_level_menu($dep_up, $dep_menu);
        $dep_menu = "<table width='300' border=0 cellpadding=0 cellspacing=0 class='side_menu'>" . $dep_menu . "</table>";
        return $dep_menu;
    }

    function show_up_level_menu($dep_id, $dep_menu)
    {
        $odb = new odb;
        $slave = new slave;
        $r = $odb->query_td("select dep_up from deps where id='$dep_id' and ison='1' order by lenta,id asc;");
        while (odbc_fetch_row($r)) {
            $dep_up = odbc_result($r, "dep_up");
            $r1 = $odb->query_td("select id,caption,file from deps where dep_up='$dep_up' and visible='1' and ison='1' order by lenta,id asc;");
            while (odbc_fetch_row($r1)) {
                $id = odbc_result($r1, "id");
                $caption = odbc_result($r1, "caption");
                $file = odbc_result($r1, "file");
                $url = "?dep=$file&dep_up=$dep_up&dep_cur=$id";
                if ($dep_up != "0") {
                    if ($id == $dep_id) {
                        $up_menu .= "<a class='menu_s' href='$url'>$caption</a><div class='dm'></div>";
                    }
                    if ($id != $dep_id) {
                        $up_menu .= "<a class='menu' href='$url'>$caption</a><div class='dm'></div>";
                    }
                }
                if ($dep_up == "0") {
                    if ($id == $dep_id) {
                        $up_menu .= "<tr height='24'><td onclick='location.href=\"$url\";'>&nbsp;<a href='$url' class='top_menu'>$caption</a</td></tr><tr><td height='6'></td></tr>";
                    }
                }
                if ($id == $dep_id and $dep_up != "0") {
                    $up_menu .= "<p><ol>{next_menu}</ol></p>";
                }
                if ($id == $dep_id and $dep_up == "0") {
                    $up_menu .= "<tr><td colspan=2><ol>{next_menu}</ol></td></tr>";
                }
            }
            $dep_menu = str_replace("{next_menu}", $dep_menu, $up_menu);
            $dep_menu = $this->show_up_level_menu($dep_up, $dep_menu);
        }
        return $dep_menu;
    }

    function show_next_level_menu($dep_cur)
    {
        $odb = new odb;
        $slave = new slave;
        $r = $odb->query_td("select id,caption,file from deps where dep_up='$dep_cur' and visible='1' and ison='1' order by lenta,id asc;");
        $next_menu = "<ol>";
        while (odbc_fetch_row($r)) {
            $caption = odbc_result($r, "caption");
            $id = odbc_result($r, "id");
            $file = odbc_result($r, "file");
            $next_menu .= " <a href='?dep=$file&dep_up=$dep_cur&dep_cur=$id' class='menu'>$caption</a><div class='dm'></div>";
        }
        $next_menu .= "</ol>";
        return $next_menu;
    }

    function get_dep_level($dep, $level)
    {
        $odb = new odb;
        if ($level == "") {
            $level = 0;
        }
        $r = $odb->query_td_td("select dep_up from deps where id='$dep' and ison='1' and visible='1';");
        while (odbc_fetch_row($r)) {
            $dep_up = odbc_result($r, "dep_up");
            if ($dep_up != 0) {
                $level += 1;
                $level = $this->get_dep_level($dep_up, $level);
            }
        }
        return $level;
    }

    function get_dep_up_level($dep)
    {
        $odb = new odb;
        $r = $odb->query_td("select dep_up from deps where id='$dep' and ison='1' and visible='1';");
        while (odbc_fetch_row($r)) {
            $dep_up = odbc_result($r, "dep_up");
            $level = $this->get_dep_level($dep_up, "");
            if ($level > 1) {
                list($dep_up, $dep) = $this->get_dep_up_level($dep_up);
            }
        }
        return array($dep_up, $dep);
    }

    function get_sub_dep_up_level($dep)
    {
        $odb = new odb;
        $r = $odb->query_td("select dep_up from deps where id='$dep' and ison='1' and visible='1';");
        while (odbc_fetch_row($r)) {
            $dep_up = odbc_result($r, "dep_up");
            $level = $this->get_dep_level($dep_up, "");
            if ($level >= 3) {
                list($dep_up, $dep) = $this->get_sub_dep_up_level($dep_up);
            }
        }
        return array($dep_up, $dep);
    }

    function find_dep_up($dep_cur)
    {
        $odb = new odb;
        if ($dep_cur == "") {
            $dep_cur = "0";
        }
        $r = $odb->query_td("select dep_up from deps where id='$dep_cur' and visible='1' and ison='1' limit 1;");
        while (odbc_fetch_row($r)) {
            $dep_up = odbc_result($r, "dep_up");
            if ($dep_up == 0) {
                return $dep_cur;
            }
            if ($dep_up != 0) {
                $dep_cur = $this->find_dep_up($dep_up);
            }
        }
        if ($n == 0) {
            return "0";
        }
    }
}

?>