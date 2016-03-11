<?php
class dbp{
	var $query='';
	function load_auth_param(){
		$this->host = 'odbc:TD';
		$this->username = 'dba';
		$this->password = 'sql';
	}
	function connect(){
		$this->load_auth_param();
		$this->dbp_id = new PDO($this->host, $this->username, $this->password);
	}
	function num_rows($result){
		$this->n=$result->fetch();
		return $this->n;
	}
	function query($query){
		if(!$this->dbp_id){ $this->connect();}
		$this->r = $this->dbp_id->query($query);
		return $this->r;
	}
}
?>