<?php

class Vartotojas extends Controller
{
	public function index(){
		$this->logged_view('vartotojas/nustatymai');
			
		
	}
	
	public function atnaujinti(){
		if($this->logged()){
			$DB = $this->model('datebase');
			$user = $this->model('user');
		
			if(isset($_POST) && !empty($_POST)){
				$args = array();
				if(isset($_POST['name_surname'])&& !empty($_POST['name_surname'])){
					$args['NAME']=test_input($_POST['name_surname']);
				}else{
					set_error('Netinkamas vardas','save_user');
				}
				
				
				if(isset($_POST['email'])&& !empty($_POST['email']) && email($_POST['email']) ){
					
					$args['EMAIL']=test_input($_POST['email']);
					
					if(isset($_POST['newpass']) && isset($_POST['newpass1']) && !empty($_POST['newpass']) && !empty($_POST['newpass1'])){
						if(isset($_POST['oldpass']) && !empty($_POST['oldpass']) && sha1($_POST['oldpass']) == $user->pass()){
							if($_POST['newpass']==$_POST['newpass1']){
								$args['PASS'] = sha1(test_input($_POST['newpass']));
							}else{
								set_error('Įvesti slaptažodžiai nesutampa','save_user');
							}
						}else{
							set_error('Įvestas netinkamas senas slaptažodis.','save_user');
						}
						
					}
					if($DB->update('fur_comp',$user->id, $args)){
							session();
							$_SESSION['user']['EMAIL'] = test_input($_POST['email']);
							$_SESSION['user']['NAME'] = test_input($_POST['name_surname']);
							set_note('Atnaujinta sėkmingai.','save_user');
						}else{
							set_error('Atnaujinti nepavyko, bandykite dar kartą.','save_user');
						}
				}else{
					set_error('Įvestas netinkamas el. paštas.','save_user');
				}
			}else{
				set_error('Nepateikta forma','save_user');
			}
		
			header('location:'.HOME.'/vartotojas/');
		
		
		}else{
			$thi->go_home();	
		}
	}
	
	public function istrinti($delete = false){
		if($delete == sha1('trink')){
			$DB = $this->model('datebase');
			$user = $this->model('user');
			if($user->delete()){
				header('location:'.HOME);
			}else{
				$this->logged_view('vartotojas/istrinti');
			}
			$DB->disconect();
		}else{
			$this->logged_view('vartotojas/istrinti');
		}
	}
	
}