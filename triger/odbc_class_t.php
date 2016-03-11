<?php
class odb{
	var $query='';
	function auth_lider_param(){
/*		$driver='{Sybase SQL Anywhere 5.0}';
		$server='Lider';
		$database='Lider1';
		$this->source_lider = "Driver=$driver;Server=$server;Database=$database";  //Это попытка подключится к локальной базе Lider1, не получилось, подключается всё время к сетевой базе Lider, видимо это на уровне драйвера... либо есть ещё какие то настройки... 
*/		$this->source_lider = 'Lider1'; //После того как попробовал подключать имя драйвера (предыдущие строки Driver;Server;Dabase) начало подключаться к базе Lider1 - при этом  запуск локального сервера производится автоматически от имени System и например csview доступа к этой базе не имеет. базу Lider1 можно остановить только прибитием процессы dbeng50.exe в диспетчере!
		$this->username_lider = 'dba';
		$this->password_lider = 'sql';
	}
	function auth_td_param(){
		$this->source_td = 'TD';
		$this->username_td = 'dba';
		$this->passwordl_td = 'sql';
	}
	function connect_lider($try=0){
		$this->auth_lider_param();
		$this->db_lider=odbc_pconnect($this->source_lider,$this->username_lider,$this->password_lider);
//		$this->db_lider=odbc_connect($this->source_lider,$this->username_lider,$this->password_lider);
		if (!$this->db_lider){$try+=1;
			if ($try<=10){
				$this->connect_lider($try);
			}
		}
	}
	function connect_td(){
		$this->auth_td_param();
		$this->db_td=odbc_pconnect($this->source_td,$this->username_td,$this->passwordl_td);
	}
	function query_lider($query){
		if(!$this->db_lider){ $this->connect_lider();}
		$this->r_lider =odbc_exec($this->db_lider,$query);
		if (odbc_error()){ 
			$fp = fopen('C:/Avtolider-Shop/lib/odbc_errors/lider1_error.txt', 'a+');
			fwrite($fp, "Lider-> data=".date("Y-m-d H:i:s").":source_lider".$this->source_lider." ".odbc_errormsg($this->db_lider)."\r\n".$query."\r\n");
			fclose($fp);
		}
		return $this->r_lider;
	}
	function query_td($query){
		if(!$this->db_td){ $this->connect_td();}
		$this->r_td =odbc_exec($this->db_td,$query);
		if (odbc_error()){ 
			if (substr_count(odbc_errormsg($this->db_td),"SQL0973N")==0){
				$fp = fopen('C:/Avtolider-Shop/lib/odbc_errors/db2_error.txt', 'a+');
				fwrite($fp, "DB2-> data=".date("Y-m-d H:i:s").": ".odbc_errormsg($this->db_td)."\r\n".$query."\r\n");
				fclose($fp);
			}
		}
		return $this->r_td;
	}
	function num_rows($res){$count=0;
	    while($temp = odbc_fetch_into($res, $counter)){ $count++; }
    	return $count;
	}
}
?>