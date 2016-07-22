<?php

class dep
{
    function show_dep_desc($dep)
    {
        $odb = new odb;
        $slave = new slave;
        $r = $odb->query_td("select * from deps where id='$dep' and ison='1' limit 7 offset 0;");
        odbc_longreadlen($r, 4096);
        while (odbc_fetch_row($r)) {
            $caption = odbc_result($r, "caption");
            $desc = odbc_result($r, 'desc');
            if ($desc != "") {
                while (($chunk = odbc_result($r, 'desc')) !== false) {
                    $desc .= $chunk;
                }
            }
        }
        if ($desc == "<br />" or $desc == "") {
            $r1 = $odb->query_td("select * from deps where dep_up='$dep' and ison='1' and visible='1' limit 1 offset 0;");
            while (odbc_fetch_row($r1)) {
                $id = odbc_result($r1, "id");
                $caption = odbc_result($r1, "caption");
                $desc = odbc_result($r1, "desc");
                $file = odbc_result($r1, "file");
                if ($desc == "<br />" or $desc == "" and $file == "") {
                    echo "<script>";
                    echo "  location.href=\"${_SERVER['SCRIPT_NAME']}?dep=dep&dep_up=$dep&dep_cur=$id\"";
                    echo "</script>";
                    exit();
                }
                if ($file != "") {
                    echo "<script>";
                    echo "  location.href=\"${_SERVER['SCRIPT_NAME']}?dep=$file&dep_up=$dep&dep_cur=$id\"";
                    echo "</script>";
                    exit();
                }
            }
        }
        return array($caption, $desc);
    }
}

?>