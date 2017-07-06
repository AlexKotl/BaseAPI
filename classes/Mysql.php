<?php

namespace BaseAPI\Classes;

class Mysql {
	
	private $link, $script_time, $debug_mode = true;
	public $table_name;
	
	function __construct($params) {
		$this->link = mysqli_connect($params['host'], $params['user'], $params['password']) or die("Cannot connect to database $db_server:$db_user"); 
		$this->table_name = $params['database'];
		mysqli_set_charset($this->link, 'utf8');
		mysqli_select_db($this->link, $this->table_name);
	}
	
	function query($string) {
		
		$result = mysqli_query($this->link, $string); 
		
		if ($result===false) {
			return false; 
		}
		
		return $result;
	}
	
	function fetch(&$res) {
		return mysqli_fetch_array($res);
	}
	
	function get_row($string) {
		
		$res = $this->query($string, $this->link); 
		
		if ($res===false) return false;
		if (mysqli_num_rows($res)==0) return false;
		
		$row = mysqli_fetch_array($res);
		
		if (count($row)==2) {
			return $row[0];
		}
		else {
			return $row;
		}
	}
	
	function last_insert_id($table) {
		return $this->get_row("select LAST_INSERT_ID() from $table");;
	}
	

}

?>