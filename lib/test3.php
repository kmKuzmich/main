<?php
define("RD", dirname(__FILE__));
include_once 'client_class.php';
$clnt = new client;
echo $clnt->showMessage("1");
//echo showMessageBox(1);

function showMessageBox($mess_id)
{
//    $odb = new odb;
    session_start();
    $client_id = $_SESSION["client"];
    echo "<script type=\"text/javascript\">alert(\"Чего то там с задолженостью у клиента $client_id\");</script>";
//    sleep(5);
    echo date('h:i:s') . RD . "\n";

//    $r = $odb->query_td("
//			select M.id,M.Day,M.header,M.body,D.Num
//				from Messages M
//					join Doc D on D.id=M.id
//					left outer join Messages as M1 on M.group_id is not null and M1.id1=M.id  and M1.client_id='$client_id'
//					left outer join DocState DS on DS.id= nvl(M1.state_id,M.state_id)
//					left outer join mess_status as mss on mss.mess_id=nvl(M.id,M1.id)  and mss.client_id='$client_id'
//				where (M.client_id='$client_id'
//						or '$client_id' in (select SubConto_id from SubContoTypes as TS where TS.SubcontoType_id=M.group_id)  )
//					and M.sDay<=current_date
//					and mss.mess_id is null
//					and nvl(M1.state_id,M.state_id)=27
//				limit 0,1;");


//    while (odbc_fetch_row($r))
//    {
//        $message = odbc_result($r, "body");
    $message = "test1";
//        $data = odbc_result($r, "day");
    $data = "test2";
//        $name = odbc_result($r, "name");
    $name = "test3";
//        $subject = "[#" . odbc_result($r, "num") . "] " . odbc_result($r, "header");
    $subject = "test4";
    $form_htm = RD . "/client_messageBox_show1.htm";

    if (file_exists("$form_htm")) {
        $form = file_get_contents($form_htm);
    }
    $form = str_replace("{id}", $mess_id, $form);
    $form = str_replace("{subject}", $subject, $form);
    $form = str_replace("{message}", $message, $form);
    $form = str_replace("{data}", $data, $form);

    return $form;

}




//$a = isset($_GET['a']) && is_numeric($_GET['a']) ? $_GET['a'] : 0;
//$b = isset($_GET['b']) && is_numeric($_GET['b']) ? $_GET['b'] : 0;

//$result = $a + $b;

// загружаем шаблон
//include('template.html');


//$a = isset($_GET['a']) && is_numeric($_GET['a']) ? $_GET['a'] : 0;
//$b = isset($_GET['b']) && is_numeric($_GET['b']) ? $_GET['b'] : 0;
//
//$result = $a + $b;
//
//// загружаем содержимое файла шаблона в строку
//$tpl = file_get_contents('template.html');
//// запускаем наш супер-мега самописный шаблонизатор и передаем в него данные из
//// php-скрипта в виде пар ключ => значение
//$tpl = super_mega_template_engine( array('result' => $result) );
//echo $tpl;


//$a = isset($_GET['a']) && is_numeric($_GET['a']) ? $_GET['a'] : 0;
//$b = isset($_GET['b']) && is_numeric($_GET['b']) ? $_GET['b'] : 0;
//
//$result = $a + $b;
//
//if ($result) {
//    $body = "<span style=\"color:blue; font-weight:bold\">Результат: $result</span>";
//} else {
//    $body = "<span style=\"color:red; font-weight:bold\">Результат равен нулю!</span>";
//}
//
//// загружаем содержимое файла шаблона в строку
//$tpl = file_get_contents('template.html');
//// меняем в шаблоне метку {body} на переменную $body
//$tpl = str_replace('{body}', $body, $tpl);
//echo $tpl;


//
//
//
//<?php
//
//echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
//echo "<html>";
//echo "<head>";
//echo "   <title>Основной шаблон HTML-страницы</title>";
//echo "</head>";
//echo "<body>";
//
//$a = isset($_GET['a']) && is_numeric($_GET['a']) ? $_GET['a'] : 0;
//echo "$a\n";
//$b = isset($_GET['b']) && is_numeric($_GET['b']) ? $_GET['b'] : 0;
//echo "$b\n";
//$result = $a + $b;
//echo $result."\n";
//
//if ($result) {
//    echo "<span style=\"color:blue; font-weight:bold\">Результат: $result</span>";
//} else {
//    echo "<span style=\"color:red; font-weight:bold\">Результат равен нулю!</span>";
//}
//
//echo "</body>";
//echo "</html>";