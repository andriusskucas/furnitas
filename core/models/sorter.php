<?php
class Sorter{
	
	public function sort($blocks){
		
		
		for($i=0; $i<count($blocks);$i++){
			$si = $i;
			
			for($j=$i+1; $j<count($blocks);$j++){
				
				/*$area = $blocks[$j]['H']*$blocks[$j]['W'];
				$area2 = $blocks[$si]['H']*$blocks[$si]['W'];
				if($area>$area2){
					$si = $j;
				}*/
				
				if($blocks[$j]['H']>$blocks[$si]['H']){
					$si = $j;
				}
			}
			$temp = $blocks[$i];
			$blocks[$i] = $blocks[$si];
			$blocks[$si] = $temp;
			
			
		}
		
		return $blocks;
	}

}