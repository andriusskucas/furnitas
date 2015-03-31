<?php

class Parts extends Controller{
	
	public function get_parts($pID){
			$DB=$this->model('datebase');
			$uzklausa='SELECT ID, W, H, NUM, Q FROM fur_parts WHERE PROJ_ID="'.$pID.'";';			
			$rez=mysql_query($uzklausa) or die(mysql_error());
		
			if(mysql_num_rows($rez) > 0){
				$parts = array();
				while($part =  mysql_fetch_array($rez)){
					if($part['Q']>1){
						for($i = 0 ; $i<$part['Q']; $i++){
							$parts[] = $part;
						}
					}else{
						$parts[] = $part;	
					}
					
				}
				return $parts;
			}else{
				return false;	
			}
	}
	
	public function clean($pages){
		$cleaned = array();
		$before = 0;
		$IDS = array();
		$new_part = array();
		
		$i = 0;
		foreach($pages as $parts){
			foreach($parts as $part){
				$j = array_search ($part['ID'],$IDS);
				if($j === false){
					
					
					$IDS[$i] = $part['ID'];
					$cleaned[$i]['ID'] = $part['ID'];
					$cleaned[$i]['coordinates'][0]['Y'] = $part['fit']['Y'];
					$cleaned[$i]['coordinates'][0]['X'] = $part['fit']['X'];
					$cleaned[$i]['coordinates'][0]['PG_N'] = $part['fit']['page']+1;
					$i++;
				}else{
					$a = count($cleaned[$j]['coordinates']);
					$cleaned[$j]['coordinates'][$a]['Y'] = $part['fit']['Y'];
					$cleaned[$j]['coordinates'][$a]['X'] = $part['fit']['X'];
					$cleaned[$j]['coordinates'][$a]['PG_N'] = $part['fit']['page']+1;
				}			
			}
		}
		$i = 0;
		foreach($cleaned as $part){
			
				$cleaned[$i]['coordinates'] = test_input(json_encode($part['coordinates']));
				
			$i++;
		}
		
		return $cleaned;
		
	}
		
}