<?php
include_once('../config.php');
include_once('../core/constants.php');


	header("Content-Type: text/javascript");
	function generate($models = array()){
		
		foreach($models as $model){
			
			if(file_exists(JSMODS.$model.'.js')){
				
				include(JSMODS.$model.'.js');
			}
		}
	}
	echo 'var ajax_url = "'.AJAX.'";';
	echo 'var home_url = "'.HOME.'";';
	session_start();
	if(isset($_SESSION['JS'])){
		generate($_SESSION['JS']);
	}else{
		$mods[] = 'common';
		generate($mods);
	}
	
	
