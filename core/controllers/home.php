<?php

class Home extends Controller
{
	public function index(){
		$DB = $this->model('datebase');
		$user = $this->model('user');
		
		if($user->is_logged()){
			$this->view('home/loged_index');
		}else{
			$this->view('home/index');	
		}
		
		/*$DB = $this->model('datebase');
		$DB->insert('fur_comp',array('EMAIL' => 'admin3','PASS' => 'pass'));
		$DB->delete('fur_comp',1);
		
		$DB->disconect();*/
		//
	}
	
}