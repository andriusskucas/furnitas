<?php

class Prisijungti extends Controller
{
	public function index(){
		
		$user = $this->model('user');
		
		if($user->is_logged()){
			$this->view('home/loged_index');
		}else{
			$this->view('home/index');	
		}
		
		
	}
	
	public function pamirsau(){
		$this->view('home/pamirsau');
	}
	
	public function remind_me_my_password(){
		if(isset($_POST['forgot_pass']) && 
			isset($_POST['email']) && 
			!empty($_POST['email']) && 
			email($_POST['email'])
		){
			$DB = $this->model('datebase');
			$user = $this->model('user');
			$email = test_input($_POST['email']);
			if($user->exists($email)){
				$new_pass = randomPassword();
				

				$subject = 'Naujas vartotojo slaptažodis | Furnitas.lt';
				
				$headers = "From: noreply@furnitas.lt"."\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=utf-8\r\n";
				$msg = '<!doctype html><html><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"></head>';
					
					$msg .='<body>';
					
					$msg .='<p>Jūsų naujas slaptažodis: '.$new_pass.'<br></p>';
					$msg .='<p>Prisijungę prie sistemos <a href="'.HOME.'">čia</a> galėsite pasikeisti savo slaptažodį.</p>';
					$msg .='</body>
					</html>';
					
					$uzklausa='SELECT ID FROM fur_comp WHERE EMAIL="'.$email.'"';			
					$rez=mysql_query($uzklausa) or die(mysql_error());
					$rez = mysql_fetch_array($rez);
					
					if($DB->update('fur_comp',$rez['ID'],array('PASS'=>sha1($new_pass)))){
						if(mail($email,$subject, $msg, $headers)){
							set_note('Jūsų slaptažodis atnaujintas. Jums buvo išsiųstas el. laiškas su nauju slaptažodžiu. Prisijungę prie sistemos su nauju slaptažodžiu galėsite jį pakeisti. '.$new_pass);
						}else{
							set_error('Slaptažodžio atkurti nepavyko, bandykite dar kartą.');
						}
					}else{
						set_error('Slaptažodžio atkurti nepavyko, bandykite dar kartą.');
					}
					
					
			}else{
				set_error('Vartotojas su tokiu el. paštu neegzistuoja.');	
			}
			$DB->disconect();
		}else{
			set_error('Įveskite el. pašto adresą.');
		}
		header('location:'.HOME.'/prisijungti/pamirsau/');
	}
	
	public function login(){
		$urrl = $_POST['last_url'];
		
		if(isset($_POST['login_form']) && 
			isset($_POST['username']) && 
			isset($_POST['pass']) && 
			!empty($_POST['username']) && 
			!empty($_POST['pass']) &&
			email($_POST['username'])
		){
			
			$email = test_input($_POST['username']);
			$pass = test_input($_POST['pass']);
			
			$DB = $this->model('datebase');
			$user = $this->model('user');
			if(!$user->log_in($email,$pass)){
				
				
				
				set_error('Vartotojo el. paštas arba slaptažodis netinkamas.','login');
			}else{
				if ((strpos($_POST['last_url'],'registruotis') !== false) || (strpos($_POST['last_url'],'prisijungti') !== false)) {
					$urrl = HOME;
				}
			}
			$DB->disconect();
			
			
		}else{
			set_error('Vartotojo el. paštas arba slaptažodis netinkamas.','login');
			$urrl = $_POST['last_url'];
			
		}
		
		header('location:'.$urrl);
		
	}
	
	public function logout(){
		$DB = $this->model('datebase');
		$user = $this->model('user');
		$user->log_out();
		$DB->disconect();
		header('location:'.HOME);
	}
	
}