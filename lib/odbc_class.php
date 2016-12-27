<?php
class odb{
    var $query = '';
    function query_lider($query){
        if (!$this->db_lider) {
            $this->connect_lider();
        }
        $this->r_lider = odbc_exec($this->db_lider, $query);
        if (odbc_error()) {
            $fp = fopen(RD . '/lib/odbc_errors/lider_error.txt', 'a+');
            fwrite($fp, "Lider-> data=" . date("Y-m-d H:i:s") . ":" . odbc_errormsg($this->db_lider) . "\r\n" . $query . "\r\n");
            fclose($fp);
        }
        return $this->r_lider;
    }
    function connect_lider($try = 0){
        $this->auth_lider_param();
        $this->db_lider = odbc_pconnect($this->source_lider, $this->username_lider, $this->password_lider);
        if (!$this->db_lider) {
            $try += 1;
            if ($try <= 10) {
                $this->connect_lider($try);
            }
        }
    }
    function auth_lider_param(){
        $this->source_lider = 'Lider';
        $this->username_lider = 'dba';
        $this->password_lider = 'sql';
    }
    function query_td($query){
        $this->connect_td();
        if (!$this->db_td) {
            $this->connect_td();
        }
        $this->r_td = odbc_exec($this->db_td, $query);
        if (odbc_error()) {
            if (substr_count(odbc_errormsg($this->db_td), "SQL0973N") == 0) {
                $fp = fopen(RD . '/lib/odbc_errors/pg_error.txt', 'a+');
                fwrite($fp, "PG-> data=" . date("Y-m-d H:i:s") . ":" . odbc_errormsg($this->db_td) . "\r\n" . $query . "\r\n");
                fclose($fp);
            }
        }

        return $this->r_td;

    }

    /**
     * @function connect_td() иниициализация соединения PG
     */
    function connect_td(){
        $this->auth_td_param();
        //* This condition checks if connection is already established, to init some additional tables such as AnalogTemp, and other variables in PostGres
        if (!$this->db_td) {
//            $this->db_td = odbc_pconnect($this->source_td, $this->username_td, $this->passwordl_td);
            $this->db_td = odbc_connect($this->source_td, $this->username_td, $this->passwordl_td);
            $this->query_init();
        }

    }
    /**
     *Инициализация обязательных таблиц для работы с базой в  PG
     */
    function query_init(){
        /**проверяем существует ли таблица - возможно соединение уже установлено, и таблицы и переменные созданы
         * встроенная функция PG = ifTableExists возвращает 't' если таблица существует иначе 'f'
         */
        /** @var вызов встроенной функции ifTableExists  возвращает 't' если таблица существует иначе 'f' $qInit */
        $qInit = "select ifTableExists('AnalogTemp');";
        $this->r_td = odbc_exec($this->db_td, $qInit);
        $this->chk_odbc_pg($qInit);
        /** @var Проверка таблицы AnalogTemp 't' если таблица существует иначе 'f'  $chk */
        $chk = odbc_result($this->r_td, 1);
//        echo $chk."хмммм <br>";
        if ((!$chk) || ($chk == 'f')) {

//            $qInit = "select Value from dba.GlobalVar where name='@ListPlace' limit 1;";
//            $this->r_td = odbc_exec($this->db_td, $qInit);
//            $this->chk_odbc_pg($qInit);
//            $listPlace = odbc_result($this->r_td, 1);
            $qInit = "
                        ------------------
                        create temporary table  AnalogTemp(
                          lev smallint null,
                          item_id integer,
                          item_id0 integer null,
                          dop smallint null
                        ) on commit preserve rows;
                        ------------------
                        set enable_seqscan = off;
                        ------------------
                        ";

//                        create temporary table placeSel
//                          as select id as place_id
//                          from Place
//                          where code in ($listPlace);
//                           ------------------
//                        ";
            odbc_exec($this->db_td, $qInit);
            $this->chk_odbc_pg($qInit);
        };
    }

    /**
     * @function chk_odbc_pg - если при выполнении последнего запроса біла ошибка запишет её в файл ошибок
     * @param $query - строка которую запишем в файл ошибок
     */
    function chk_odbc_pg($query)
    {
        if (odbc_error()) {
            $fp = fopen(RD . '/lib/odbc_errors/pg_error.txt', 'a+');
            fwrite($fp, "PG-> data=" . date("Y-m-d H:i:s") . ":" . odbc_errormsg($this->db_td) . "\r\n" . $query . "\r\n");
            fclose($fp);
        }
    }

    function auth_td_param()
    {
//        $this->source_td = 'TD';
//        $this->username_td = 'dba';
//        $this->passwordl_td = 'sql';
        $this->source_td = 'pgLider';
        $this->username_td = 'dba';
        $this->passwordl_td = 'sql';

    }

// Returns Number of Rows in Query by passing through All rows
// Realy it's not effective but is easy to use
    function num_rows($res)
    {
        $count = 0;
        while ($temp = odbc_fetch_into($res, $counter)) {
            $count++;
        }
        return $count;
    }

// Connection to PostGreSQL ODBC Driver To DB PgLider
    function auth_pg_param()
    {
        $this->source_pg = 'pgLider';
        $this->username_pg = 'dba';
        $this->passwordl_pg = 'sql';
    }

    function connect_pg()
    {
        $this->auth_pg_param();
        $this->db_pg = odbc_pconnect($this->source_pg, $this->username_pg, $this->passwordl_pg);
    }

    function query_pg($query)
    {
        $this->connect_pg();
        if (!$this->db_pg) {
            $this->connect_pg();
        }
        $this->r_pg = odbc_exec($this->db_pg, $query);
        if (odbc_error()) {
            if (substr_count(odbc_errormsg($this->db_pg), "SQL0973N") == 0) {
                $fp = fopen(RD . '/lib/odbc_errors/pg_error.txt', 'a+');
                fwrite($fp, "DB2-> data=" . date("Y-m-d H:i:s") . ":" . odbc_errormsg($this->db_pg) . "\r\n" . $query . "\r\n");
                fclose($fp);
            }
        }
        return $this->r_pg;
    }
}

?>