<?php

class User extends Controller{
	public $email;
	public $id;
	public $status;
	
	public function __construct(){
		if($this->is_logged()){
			$this->id = $_SESSION['user']['ID'];
			$this->email = $_SESSION['user']['EMAIL'];
			$this->status = true;
		}else{
			$this->status = false;
		}
		
	}
	
	public function log_in($email,$pass){
		$uzklausa='SELECT ID, EMAIL, NAME FROM fur_comp WHERE EMAIL="'.$email.'" AND PASS="'.sha1($pass).'"';			
		$rez=mysql_query($uzklausa) or die(mysql_error());
		
		if(mysql_num_rows($rez) > 0){
			$rez = mysql_fetch_array($rez);
			session();
			$_SESSION['user']=$rez;
			print_r($_SESSION);
			set_note('Prisijungta sėkmingai.','login');
			return true;
		}else{
			set_error('Prisijugti nepavyko. Mėginkite dar kartą.','login');	
			return false;
		}
	}
	
	public function log_out(){
		if (session_status() == PHP_SESSION_NONE) {
    			session_start();
			}
			unset($_SESSION['user']);
			set_note('Atsijungta sėkmingai.','login');
	}
	
	public function is_logged(){
		session();
			if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
				if($this->exists($_SESSION['user']['EMAIL'])){
					return true;
				}
				return false;
			}
			return false;
		
	}
	
	public function exists($email){
		$DB = $this->model('datebase');
		$uzklausa='SELECT * FROM fur_comp WHERE EMAIL="'.$email.'"';			
		$rez=mysql_query($uzklausa) or die(mysql_error());
		
		if(mysql_num_rows($rez) > 0){
			
			return true;
		}
		
		return false;
	}
	
	
	public function pass(){
		$uzklausa='SELECT PASS FROM fur_comp WHERE ID="'.$this->id.'"';			
		$rez=mysql_query($uzklausa) or die(mysql_error());
		
		if(mysql_num_rows($rez) > 0){
			$IDD = mysql_fetch_array($rez);
			return $IDD['PASS'];
			
		}
	}
	
	
	public function save_new(){
		
	}
	
	public function update($id){
		
	}
	
	public function delete(){
		if(isset($_POST['pass']) && !empty($_POST['pass']) && (sha1(test_input($_POST['pass']))==$this->pass())){
			
			$uzklausa='SELECT ID FROM fur_projects WHERE COMP_ID="'.$this->id.'"';
			$rez=mysql_query($uzklausa) or die(mysql_error());
			
			if(mysql_num_rows($rez) > 0){
				while($ID = mysql_fetch_array($rez)){
					$uzklausa='DELETE FROM fur_parts WHERE PROJ_ID='.$ID['ID'].';';
					$rezultatas=mysql_query($uzklausa) or die(mysql_error());
				}
				
				
			}
			
			$uzklausa='DELETE FROM fur_projects WHERE COMP_ID='.$this->id.';';
			$rezultatas=mysql_query($uzklausa) or die(mysql_error());
			
			$uzklausa='DELETE FROM fur_comp WHERE ID='.$this->id.';';
			$rezultatas=mysql_query($uzklausa) or die(mysql_error());
			if (!$rezultatas){	
				set_error('Istrinti nepavyko');
				return false;
			}else{
				set_note('Istrinta');
				return true;
			}
		}else{
			set_error('Netinkamas slaptažodis');	
			return false;
		}
	}
}