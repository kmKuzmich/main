<?php

class task
{
    function show_task_calendar()
    {
        session_start();
        $form = $this->show_calendar("", "");
        return $form;
    }

    function showTaskForm($data)
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
        if (strlen($data) == 9) {
            $data = substr($data, 0, 8) . "0" . substr($data, 8, 1);
        }
        $form_htm = RD . "/tpl/task_form.htm";
        $form = "";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $task_item_htm = RD . "/tpl/task_item.htm";
        $task_item = "";
        if (file_exists("$task_item_htm")) {
            $task_item = file_get_contents($task_item_htm);
        }
        $form = str_replace("{data_word}", $slave->data_word($data), $form);
        $form = str_replace("{data}", $data, $form);
        $r = $odb->query_td("select * from tasks where client='$client' and data='$data' order by id asc;");
        $k = 0;
        while (odbc_fetch_row($r)) {
            $k += 1;
            $id = odbc_result($r, "id");
            $caption = odbc_result($r, "caption");
            $data_start = odbc_result($r, "data_start");
            $data_end = odbc_result($r, "data_end");
            $email = odbc_result($r, "email");
            $phone = odbc_result($r, "phone");
            $desc = odbc_result($r, "desc");
            $list .= "<tr valign='top'><td style='border-bottom:1px solid #d7d7d7'>$task_item</td></tr>";
            $list = str_replace("{caption}", $caption, $list);
            $list = str_replace("{desc}", $desc, $list);
            $list = str_replace("{data_start}", $data_start, $list);
            $list = str_replace("{data_end}", $data_end, $list);
            $list = str_replace("{phone}", $phone, $list);
            $list = str_replace("{email}", $email, $list);
        }
        if ($list == "") {
            $list = "<tr><td align='center'><br /><br /><h3>Список задач пуст</h3></td></tr>";
        }
        $form = str_replace("{task_list}", $list, $form);
        $form = str_replace("{client}", $client, $form);
        return $form;
    }

    function showShortTaskList($data)
    {
        session_start();
        $client = $_SESSION["client"];
        $odb = new odb;
        $slave = new slave;
        $list = "";
        if (strlen($data) == 9) {
            $data = substr($data, 0, 8) . "0" . substr($data, 8, 1);
        }
        $task_item_htm = RD . "/tpl/task_item.htm";
        $task_item = "";
        if (file_exists("$task_item_htm")) {
            $task_item = file_get_contents($task_item_htm);
        }
        $r = $odb->query_td("select * from tasks where client='$client' and data='$data' order by is_mailed asc limit 3;");
        while (odbc_fetch_row($r)) {
            $id = odbc_result($r, "id");
            $bold = "";
            $is_mailed = odbc_result($r, "is_mailed");
            if ($is_mailed == 0) {
                $bold = "font-weight:bold;";
            }
            $caption = substr(odbc_result($r, "caption"), 0, 16) . "...";
            $list .= "<div style='border-left:2px solid #1150aa; font-size:11px; $bold margin-top:3px; text-align:left; padding-left:3px; color:#1150aa;'>$caption</div>";
        }
        return $list;
    }

    function newTask($data)
    {
        session_start();
        $client = $_SESSION["client"];
        $odb = new odb;
        $slave = new slave;
        if (strlen($data) == 9) {
            $data = substr($data, 0, 8) . "0" . substr($data, 8, 1);
        }
        $form_htm = RD . "/tpl/task_item_form.htm";
        $form = "";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $form = str_replace("{data_word}", $slave->data_word($data), $form);
        $form = str_replace("{data}", $data, $form);
        $form = str_replace("{dataendTask}", "", $form);
        $form = str_replace("{timeendTask}", "", $form);
        $form = str_replace("{calendar_start}", $slave->get_calendar("dataendTask"), $form);

        return $form;
    }

    function addTask($data, $caption, $data_end, $time_end, $email, $desc)
    {
        session_start();
        $client = $_SESSION["client"];
        $odb = new odb;
        $slave = new slave;
        if (strlen($data) == 9) {
            $data = substr($data, 0, 8) . "0" . substr($data, 8, 1);
        }
        if ($client != "") {
            $caption = $slave->qq($caption);
            $desc = $slave->qq($desc);
            $odb->query_td("insert into tasks (client,caption,data,data_end,time_end,email,desc,ison) values ('$client','$caption','$data','$data_end','$time_end','$email','$desc','1');");
            $answer = "ok";
        }
        if ($client == "") {
            $answer = "Для создания задач необходимо авторизироваться!";
        }
        return $answer;
    }

    function show_calendar($m, $y)
    {
        $slave = new slave;
        $form_htm = RD . "/tpl/date_form.htm";
        $form = "";
        if (file_exists("$form_htm")) {
            $form = file_get_contents($form_htm);
        }
        $date_form = "";
        if ((!$m) || (!$y)) {
            $m = date("m", time());
            $y = date("Y", time());
        }
        if ($day == "") {
            $day = date("d", mktime(0));
        }
        /*== get what weekday the first is on ==*/
        $tmpd = getdate(mktime(0, 0, 0, $m, 1, $y));
        $month = $tmpd["month"];
        $firstwday = $tmpd["wday"];
        if ($firstwday == 0) {
            $firstwday = 6;
        }

        $lastday = $this->mk_getLastDayofMonth($m, $y);
        switch ($month) {
            case 'January':
                $month = "Январь";
                break;
            case 'February':
                $month = "Февраль";
                break;
            case 'March':
                $month = "Март";
                break;
            case 'April':
                $month = "Апрель";
                break;
            case 'May':
                $month = "Май";
                break;
            case 'June':
                $month = "Июнь";
                break;
            case 'July':
                $month = "Июль";
                break;
            case 'August':
                $month = "Август";
                break;
            case 'September':
                $month = "Сентябрь";
                break;
            case 'October':
                $month = "Октябрь";
                break;
            case 'November':
                $month = "Ноябрь";
                break;
            case 'December':
                $month = "Декабрь";
                break;
        }
        if (($m - 1) < 1) {
            $m_p = 12;
        } else {
            $m_p = $m - 1;
        }
        if (($m - 1) < 1) {
            $y_p = $y - 1;
        } else {
            $y_p = $y;
        }
        if (($m + 1) > 12) {
            $m_n = 1;
        } else {
            $m_n = $m + 1;
        }
        if (($m + 1) > 12) {
            $y_n = $y + 1;
        } else {
            $y_n = $y;
        }
        $d = 1;
        $wday = $firstwday;
        $firstweek = true;
        /*== loop through all the days of the month ==*/
        while ($d <= $lastday) {
            /*== set up blank days for first week ==*/
            if ($firstweek) {
                $date_form .= "<tr align='center'>";
                for ($i = 1; $i <= $firstwday - 1; $i++) {
                    $date_form .= "<td class='text'><font size=2>&nbsp;</font></td>";
                }
                $firstweek = false;
                $wday = $tmpd["wday"];
            }
            /*== Sunday start week with <tr> ==*/
            if ($wday == 1) {
                $date_form .= "<tr align='center' height='80'>";
            }
            /*== check for event ==*/
            if (strlen($d) == 1) {
                $dd = "0" . $d;
            } else {
                $dd = $d;
            }
            $short_task_list = $this->showShortTaskList("$y-$m-$d");
            if ($d == $day) {
                $date_form .= "<td class='calTDs' bgcolor='#faf7d7' onclick='showTaskForm(\"$y-$m-$d\");'><div class='calTDdate'>$d</div>" . $short_task_list . "</td>\n";
            }
            if ($d != $day and $wday > 0 and $wday < 6) {
                $date_form .= "<td class='calTD' onclick='showTaskForm(\"$y-$m-$d\");'><div class='calTDdate'>$d</div>" . $short_task_list . "</td>\n";
            }
            if ($d != $day and ($wday == 6 or $wday == 0)) {
                $date_form .= "<td class='calTD' onclick='showTaskForm(\"$y-$m-$d\");'><div class='calTDdate'>$d</div>" . $short_task_list . "</td>\n";
            }
            /*== Saturday end week with </tr> ==*/
            if ($wday == 6) {
                $wday = -1;
            }
            if ($wday == 0) {
                $date_form .= "</tr>";
            }
            $wday++;
//    	    $wday = $wday % 6;
            $d++;
        }
        $date_form .= "</tr>";
        $form = str_replace("{calendar}", $date_form, $form);
        $form = str_replace("{month_word}", $month, $form);
        $form = str_replace("{month}", $m, $form);
        $form = str_replace("{year}", $y, $form);
        $form = str_replace("{py}", $y_p, $form);
        $form = str_replace("{ny}", $y_n, $form);
        $form = str_replace("{pm}", $m_p, $form);
        $form = str_replace("{nm}", $m_n, $form);
        return $form;
    }

    function mk_getLastDayofMonth($mon, $year)
    {
        for ($tday = 28; $tday <= 31; $tday++) {
            $tdate = getdate(mktime(0, 0, 0, $mon, $tday, $year));
            if ($tdate["mon"] != $mon) {
                break;
            }
        }
        $tday--;
        return $tday;
    }
}

?>