<?php

class Project extends Controller{
	
	public $ID;

	public function save($args = array()){
		$DB = $this->model('datebase');	
		$args['DATE'] = date("Y-m-d");
		$args['STATE'] = 2;
		$user = $this->model('user');
		$args['COMP_ID'] = $user->id;
		if($DB->insert('fur_projects',$args)){
			$this->ID = mysql_insert_id();
			$DB->disconect();
			return true;	
		}else{
			$DB->disconect();
			return false;
		}
		
	}
	
	
	public function update($args = array(),$ID){
		$DB = $this->model('datebase');	
		
		if($DB->update('fur_projects',$ID,$args)){
			$this->ID = mysql_insert_id();
			$DB->disconect();
			return true;	
		}else{
			$DB->disconect();
			return false;
		}
		
	}
	
	public function get_project($ID){
		$DB = $this->model('datebase');	
		$user = $this->model('user');
		$uzklausa='SELECT * FROM fur_projects WHERE ID="'.$ID.'" AND COMP_ID="'.$user->id.'"';			
		$rez=mysql_query($uzklausa) or die(mysql_error());
		
		if(mysql_num_rows($rez) > 0){
			return mysql_fetch_array($rez);
		}else{
			return false;	
		}
	}
	
	public function get_projects(){
		
		$DB = $this->model('datebase');
		$user = $this->model('user');
		$project = $this->model('project');
		$uzklausa='SELECT * FROM fur_projects WHERE COMP_ID="'.$user->id.'" ORDER BY DATE DESC';
		$rez=mysql_query($uzklausa) or die(mysql_error());
		if(mysql_num_rows($rez) > 0){
			
			$projects = array();
			while($project = mysql_fetch_array($rez)){
				$projects[] = $project;
			}
			$DB->disconect();
			return $projects;
		}else{
			$DB->disconect();
			return false;
		}
			
	}
	
	public function get_parts($Pid){
		$DB = $this->model('datebase');
		
		$uzklausa='SELECT * FROM fur_parts WHERE PROJ_ID="'.$Pid.'" ORDER BY NUM';
		$rez=mysql_query($uzklausa) or die(mysql_error());
		if(mysql_num_rows($rez) > 0){
			
			$parts = array();
			while($part = mysql_fetch_array($rez)){
				$parts[] = $part;
			}
			$DB->disconect();
			return $parts;
		}else{
			$DB->disconect();
			return false;
		}
	}
	
	public function delete($Pid){
		$DB = $this->model('datebase');
		
		$uzklausa='DELETE FROM fur_parts WHERE PROJ_ID='.$Pid.';';
	    $rezultatas=mysql_query($uzklausa) or die(mysql_error());
		if (!$rezultatas){	
			return false;
		}else{
			if($DB->delete('fur_projects',$Pid)){
				return true;
			}else{
				return false;	
			}
		}
		
		$DB->disconect();
	}
	
}
