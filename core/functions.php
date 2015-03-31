<?php

function home(){
		echo HOME;
	}
	
	function session(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}
	
	
function set_note($note,$name = false,$ajax = false){
	session();
	if($name){
		$_SESSION['notes'][$name][]=$note;
	}else{
		$_SESSION['notes']['all'][]=$note;
	}
	

}
function set_error($error, $name = false,$ajax = false){
	session();
	
	if($name){
		$_SESSION['errors'][$name][]=$error;
	}else{
		$_SESSION['errors']['all'][]=$error;
	}
}

function show_notes($name = false){
	session();
	if($name){
				if (isset($_SESSION['notes'][$name])&&!empty ($_SESSION['notes'][$name])){
					foreach($_SESSION['notes'][$name] as $note){
						echo '<p class="note">'.$note.'</p>';
					}
					unset ($_SESSION['notes'][$name]);
				}

	}else{
		if (isset($_SESSION['notes']['all'])&&!empty ($_SESSION['notes']['all'])){
			foreach($_SESSION['notes']['all'] as $note){
				if(!is_array($note)){
					echo '<p class="note">'.$note.'</p>';
				}
			}
			unset ($_SESSION['notes']['all']);
		}
	}
}

function show_errors($name = false){
	session();
	if($name){
		if (isset($_SESSION['errors'][$name])&&!empty ($_SESSION['errors'][$name])){
			foreach($_SESSION['errors'][$name] as $error){
				echo '<p class="error">'.$error.'</p>';
			}
			unset ($_SESSION['errors'][$name]);
		}
	}else{
		if (isset($_SESSION['errors']['all'])&&!empty ($_SESSION['errors']['all'])){
			foreach($_SESSION['errors']['all'] as $error){
				if(!is_array($error)){
					echo '<p class="error">'.$error.'</p>';
				}
			}
			unset ($_SESSION['errors']['all']);
		}
	}
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function val($name){
	session();
	if(isset($_SESSION['reg_form'][$name])){
		echo ' value="'.$_SESSION['reg_form'][$name].'"';
	}
}





function email($email){
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
	  return false;
	}
	return true;
}


function curPageURL() {
 $pageURL = 'http';
 
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function user_email(){
	session();
	if(isset($_SESSION['user'])){
		echo $_SESSION['user']['EMAIL'];
	}
}

function user_name(){
	session();
	if(isset($_SESSION['user'])){
		echo $_SESSION['user']['NAME'];
	}
}

/*
*
*		Projekto funkcijos
*
*/


function project_name(){
	if($GLOBALS['project_info']['NAME']){
		echo $GLOBALS['project_info']['NAME'];
	}
}

function project_id(){
	if($GLOBALS['project_info']['ID']){
		echo $GLOBALS['project_info']['ID'];
	}
}

function project(){
	if($GLOBALS['project_info']){
		return $GLOBALS['project_info'];
	}
}


function projects(){
	if(isset($GLOBALS['projects'])){
		return 	$GLOBALS['projects'];
	}else{
		return false;	
	}
}

function parts(){
	if(isset($GLOBALS['parts'])){
		return 	$GLOBALS['parts'];
	}else{
		return false;	
	}
}

function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
 }
 
 function set_js($names = array()){
	 if(!empty($names)){
		 session();
		 $_SESSION['JS'] = $names;
	 }else{
		 session();
		 $_SESSION['JS'][0] = 'common';
	 }
 }