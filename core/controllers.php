<?php

class Controller
{
	public function model($model){
		if(file_exists(MODELS.$model.'.php')){
			require_once(MODELS.$model.'.php');
			return new $model();
		}
	}
	
	public function view($view, $data = array()){
		if(file_exists(VIEWS.$view.'.php')){
			require_once(VIEWS.$view.'.php');
			
		}
	}
	
	public function logged_view($view){
		
		$DB = $this->model('datebase');
		$user = $this->model('user');
		if($user->is_logged()){
			$this->view($view);	
		}else{
			set_error('Norėdami pamatyti puslapio turinį turite prisijungti.');
			$this->view('home/index');	
			
		}
		$DB->disconect();
	}
	
	public function logged(){
		
		$DB = $this->model('datebase');
		$user = $this->model('user');
		if($user->is_logged()){
			return true;
		}else{
			return false;
			
		}
		$DB->disconect();
	}
	
	public function go_home(){
		header('location:'.HOME);
	}
}