<?php

class Registruotis extends Controller
{
	public function index(){
		$this->view('registration/index');
	}
	
	public function naujas(){
		if(isset($_POST) && $_POST['registration_form'] == 'REGISTRUOTIS'){
			session();
			
			$_SESSION['reg_form']['name_surname']=test_input($_POST['name_surname']);
			$_SESSION['reg_form']['username']=test_input($_POST['username']);
			
			if(!isset($_POST['name_surname']) || empty($_POST['name_surname'])){
				set_error('Nurodykite savo vardą ir pavardę.','reg');
			}
			
			if(!isset($_POST['username']) || empty($_POST['username']) || !email($_POST['username'])){
				set_error('Nurodykite Galimą el. pašto adresą.','reg');
			}else{
				$DB = $this->model('datebase');
				$user = $this->model('user');
				if($user->exists(test_input($_POST['username']))){
					set_error('Vartotojas su tokiu el. pašto adresu jau yra.','reg');
				}
				$DB->disconect();
			}
			
			if(!isset($_POST['pass']) || empty($_POST['pass']) || !isset($_POST['pass1']) || empty($_POST['pass1']) || $_POST['pass'] != $_POST['pass1']){
				set_error('Įveskite sutampančius slaptažodžius.','reg');
			}
			
			
			require_once(MODELS.'securimage/securimage.php');
			$securimage = new Securimage();
							if ($securimage->check($_POST['cap']) == false) {
							  set_error('Neteisingai įvedėte saugos kodą.','reg');
							}
							
							
							if(count($_SESSION['errors']['reg'])<1){
								$DB = $this->model('datebase');
								$DB->insert('fur_comp',array('NAME'=>test_input($_POST['name_surname']),'EMAIL' => test_input($_POST['username']),'PASS' => sha1(test_input($_POST['pass']))));
								$DB->disconect();
								set_note('Naujas vartotojas užregistruotas sėkmingai. Dabar galite prisijungti.','reg');
								unset($_SESSION['reg_form']);
							}
			header('location:'.HOME.'/registruotis/');
			
		}
	}
	
}