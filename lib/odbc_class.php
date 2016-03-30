<?php
class odb{
	var $query='';

	function query_lider($query)
	{
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

	function connect_lider($try=0){
		$this->auth_lider_param();
		$this->db_lider=odbc_pconnect($this->source_lider,$this->username_lider,$this->password_lider);
		if (!$this->db_lider){$try+=1;
			if ($try<=10){
				$this->connect_lider($try);
			}
		}
	}

	function auth_lider_param()
	{
		$this->source_lider = 'Lider';
		$this->username_lider = 'dba';
		$this->password_lider = 'sql';
	}

	function query_td($query){
		$this->connect_td();
		if(!$this->db_td){ $this->connect_td();}
		$this->r_td =odbc_exec($this->db_td,$query);
		if (odbc_error()){ 
			if (substr_count(odbc_errormsg($this->db_td),"SQL0973N")==0){
				$fp = fopen(RD.'/lib/odbc_errors/db2_error.txt', 'a+');
				fwrite($fp, "DB2-> data=".date("Y-m-d H:i:s").":".odbc_errormsg($this->db_td)."\r\n".$query."\r\n");
				fclose($fp);
			}
		}
		return $this->r_td;
	}

	function connect_td()
	{
		$this->auth_td_param();
		$this->db_td = odbc_pconnect($this->source_td, $this->username_td, $this->passwordl_td);
	}

	function auth_td_param()
	{
		$this->source_td = 'TD';
		$this->username_td = 'dba';
		$this->passwordl_td = 'sql';
	}

	function num_rows($res){$count=0;
	    while($temp = odbc_fetch_into($res, $counter)){ $count++; }
    	return $count;
	}
}
?>