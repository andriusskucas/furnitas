<?php

class Ajax extends Controller
{
	public function index(){
		set_error('Nepavyko');
		$this->view('home/index');
	}
	
	public function get_mat($name = ''){
		$DB = $this->model('datebase');
		$uzklausa="SELECT * FROM fur_materials WHERE NAME LIKE '$name%' ORDER BY NAME";			
		$rez=mysql_query($uzklausa) or die(mysql_error());
		if(mysql_num_rows($rez) > 0){
			$r = array();
			while($r1 = mysql_fetch_array($rez))
				$r[] = $r1;
				
			$r = json_encode($r);
			print_r($r);
		}else{
			echo 0;	
		}
	}
	
	
	public function isdestyti(){
		$project = $this->model('project');
		$pr = $project->get_project($_POST['project_id']);
					
					$parts = $this->model('parts');
					$parts = $parts->get_parts($_POST['project_id']);
					
					$sorter = $this->model('sorter');
					$parts = $sorter->sort($parts);
					
					$optimizer = $this->model('optimizer');
					$optimizer->set($pr['W'],$pr['H'],$pr['SIDES'],$pr['SAW_W']);
					
					$parts = $optimizer->fit($parts);
					
					$cleaner = $this->model('parts');
					
					
					
				
					
					$DB = $this->model('datebase');
					foreach($cleaner->clean($parts) as $part){
						
						$DB->update('fur_parts',$part['ID'],$part);
					}
					$DB->disconect();
					echo 'pavyko';
	}
	
}