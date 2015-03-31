<?php

class Datebase{
	protected $DB = false;
	public $errors = array();
	public $notes = array();
	public function __construct(){
		$this->DB = mysql_connect(DB_HOST, DB_USER, DB_PASS)
			or die('Neprisijungia prie duomenu bazes '.mysql_error());
 		 mysql_select_db(DB_NAME) or die (mysql_error());
 		mysql_query('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8"; ');
		
	}
	
	public function disconect(){
		mysql_close();
	}
	
	public function insert($table_name, $args,$returnid = false){
		$uzklausa='INSERT INTO '.$table_name.' (';
		foreach($args as $key => $val){
			$uzklausa .= $key.',';	
		}
		$uzklausa = substr($uzklausa,0,-1);
		$uzklausa .= ') VALUES (';
		
		foreach($args as $key => $val){
			$uzklausa .= '"'.$val.'",';
		}
		$uzklausa = substr($uzklausa,0,-1);
		$uzklausa .= ')';
		$rezultatas = mysql_query($uzklausa) or die(mysql_error());
		if (!$rezultatas){	
			return false;
		}else if($returnid){
			return mysql_insert_id();
		}else{
			return true;
		}
	}
	
	public function update($table_name,$id, $args){
		$uzklausa=	'UPDATE '.$table_name.' SET ';
		foreach($args as $key => $val){
			
			$uzklausa .= $key.'="'.$val.'",';
		}
		$uzklausa = substr($uzklausa,0,-1);
		$uzklausa .= ' WHERE ID='.$id.';';
		
		
		$rezultatas = mysql_query($uzklausa) or die('asda'.mysql_error());
		
		
								if (!$rezultatas){	
									return false;
								}else{
									return true;
								}
		
	}
	
	public function delete($table_name, $id){
		$uzklausa='DELETE FROM '.$table_name.' WHERE ID='.$id.';';
	    $rezultatas=mysql_query($uzklausa) or die(mysql_error());
		if (!$rezultatas){	
			return false;
		}else{
			return true;
		}
	}
}