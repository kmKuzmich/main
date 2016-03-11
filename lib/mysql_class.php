<?php
class db{
	var $query='';
	function load_auth_lider_param(){
		$this->hostl = 'avtolider-ua.com';
		$this->dbnamel = 'avtolid_new';
		$this->usernamel = 'avtolid_site';
		$this->passwordl = 'Edit2007';		
//		$this->passwordl = 'Ckeditor789';
	}
	function connect_lider(){
		$this->load_auth_lider_param();
		$this->dbl_id = @mysql_connect($this->hostl, $this->usernamel, $this->passwordl);
		@mysql_select_db($this->dbnamel, $this->dbl_id);
		mysql_query ("set character_set_client='cp1251'");
		mysql_query ("set character_set_results='cp1251'");
		mysql_query ("set collation_connection='cp1251_general_ci'");
	}
	
	function close(){
		@mysql_close($this->db_id);
	}
	function num_rows($result){
		$this->n=mysql_numrows($result);
		return $this->n;
	}
	function query_lider($query){
		if(!$this->dbl_id){ $this->connect_lider();}
		$this->rl = mysql_query($query, $this->dbl_id);
		if (mysql_error()!=""){ print mysql_error()."<br>query=".$query;}
		return $this->rl;
	}
	function result($result,$number,$field_name) {
		return mysql_result($result,$number,"$field_name");
   	}
}
?>