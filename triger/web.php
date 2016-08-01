<?php
session_start();
if (!empty($_GET['logout'])) // если юзер решил выйти
{
    // просто разрушаем переменные
    unset($_SESSION['logged'], $_SESSION['login']);
}
// сверяем данные из формы логина с нужными логином и паролем
if (!empty($_POST['login']) and !empty($_POST['pass'])) {
    if ($_POST['login'] == 'avtolid' and $_POST['pass'] == 'y3WMtbcP8m') // это очень грубый вариант авторизации %)
    {
        // сохраняем сеансовые переменные logged = true и login с именем пользователя
        $_SESSION['logged'] = 1;
        $_SESSION['login'] = 'Avtolid';
    }
}
if (!isset($_SESSION['logged']) or empty($_SESSION['logged'])) // если в сессии не указано, что пользователь залогинен
{
    // показываем форму для ввода пароля

    ?>
    <form action="web.php" method="post">
        <input type="text" name="login"/>
        <input type="password" name="pass"/>
        <input type="submit" value="Ну давай!"/>
    </form>
    <?php
}
else
{
#<?php
error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);
define('RD', dirname(__FILE__));
require_once(RD . "/../lib/odbc_class.php");
require_once(RD . "/../lib/slave_class.php");
$odb = new odb;
$slave = new slave;
$m = 0;

//Формирование основной таблицы
$s = $odb->query_td("select max(s.code) as CODE,max(s.name) as KLIENT,nodeaddress as IP,count(*) as N  
                        from Websearch w 
                          left outer join subconto s on klient_id=s.id 
                        where tm>=date(now())  
                        group by nodeaddress order by 4 desc
                        limit 100 offset 0;");

//Рассчёт общего числа поисков
$ss = $odb->query_td("select count(*) as N  from Websearch w 
where tm>=date(now())");
$sum = odbc_result($ss, N);

//Вывод результатов
echo "<h1>WebSearch за " . date('d-m-Y') . " состоянием на <u>" . date('H:i:s') . "</u> всего поисков: <u>" . $sum . "</u></h1>";
echo 'Привет, <b>' . $_SESSION['login'] . '</b> <a href="/triger/web.php?logout=1">Выйти</a><br><br>';
?>
<form action="webdetails.php" method="post">
    <input type="text" name="ip"/>
    <input type="submit" value="Поиск"/>
</form>
<table border="1" cellpadding="1" cellspacing="1" style="width: 1000px;">

    <tbody>
    <tr>
        <td><b> Код</td>
        <td style="width: 70%"><b>Клиент</td>
        <td><b>IP-адрес</td>
        <td style="width: 100px" align="center">
            <b> Кол-во поисков</td>
    </tr>

    <?php
    //    while ($row = odbc_fetch_array($s)) {
    while (odbc_fetch_row($s)) {

        $i = odbc_result($s, 'IP');
        echo '<tr>';
        echo '		<td>' . odbc_result($s, 'CODE') . '</td>';
        echo '		<td>' . $row['KLIENT'] . '</td>';
        echo "		<td><a href='/triger/webdetails.php?ip=$i'>$i</a></td>";
        echo '		<td align="center">' . $row['N'] . '</td>';
        echo '</tr>';
//        $i = $row['IP'];
//        echo '<tr>';
//        echo '		<td>' . $row['CODE'] . '</td>';
//        echo '		<td>' . $row['KLIENT'] . '</td>';
//        echo "		<td><a href='/triger/webdetails.php?ip=$i'>$i</a></td>";
//        #echo '		<td>'.$row['IP'].'</td>';
//        echo '		<td align="center">' . $row['N'] . '</td>';
//        echo '</tr>';
    }
    }
    ?>
    </tbody>
</table>