<?php
class Render{
	
	public $num_sheats = 0;
	private $sheets = array();
	private $pid = 0;
	private $uid = 0;
	
	public function rend($blocks,$pid,$cid,$W,$H,$AK,$SAW){
		
		for($n = 0; $n < count($blocks); $n++){
		  
		  		$image = ImageCreate($W+1, $H+1);
				$white = ImageColorAllocate($image, 255, 255, 255);
				$black = ImageColorAllocate($image, 0, 0, 0);
				ImageFill($image, 0, 0, $white);
				ImageRectangle($image, 0,0,$W,$H,$black);
				ImageRectangle($image, $AK,$AK,$W-$AK,$H-$AK,$black);
				$font = dirname(__FILE__) .'\arial.ttf';
				
				for($i = 0; $i < count($blocks[$n]); $i++){
					$block = $blocks[$n][$i];
					ImageRectangle($image, $block['fit']['X']+$AK,$block['fit']['Y']+$AK,($block['fit']['X']+$AK+$block['W']),($block['fit']['Y']+$AK+$block['H']),$black);
					imagettftext($image, 16, 0, $block['fit']['X']+$AK+($block['W'])/2, $block['fit']['Y']+$AK+($block['H'])/2, $black, $font,$block['NUM'] );
					imagettftext($image, 12, 0, $block['fit']['X']+$AK+($block['W'])/2-10, $block['fit']['Y']+20+$AK, $black, $font, $block['W']);
					imagettftext($image, 12, -90, $block['fit']['X']+20+$AK, $block['fit']['Y']+($block['H'])/2, $black, $font, $block['H']);
					
					
				}
				ImagePng($image, dirname(__FILE__).'\\'.$cid.'_'.$pid.'_'.$n.".png");
				ImageDestroy($image);
			
		}
	}
	
	public function rend_from_db($blocks,$pid,$cid,$W,$H,$AK,$SAW){
		
		
		  		$images = array();
								$font = FONTS.'arial.ttf';
			foreach($blocks as $part){
				
					$cords = json_decode(html_entity_decode($part['coordinates']),true);
					foreach($cords as $cord){
						if(!isset($images[$cord['PG_N']-1])){
							$images[$cord['PG_N']-1] = ImageCreate($W+1, $H+1);
						}
						$white = ImageColorAllocate($images[$cord['PG_N']-1], 255, 255, 255);
						$black = ImageColorAllocate($images[$cord['PG_N']-1], 0, 0, 0);

						ImageFill($images[$cord['PG_N']-1], 0, 0, $white);
						ImageRectangle($images[$cord['PG_N']-1], 0,0,$W,$H,$black);
						ImageRectangle($images[$cord['PG_N']-1], $AK,$AK,$W-$AK,$H-$AK,$black);
						
						ImageRectangle($images[$cord['PG_N']-1], $cord['X']+$AK,$cord['Y']+$AK,($cord['X']+$AK+$part['W']),($cord['Y']+$AK+$part['H']),$black);
						imagettftext($images[$cord['PG_N']-1], 16, 0, $cord['X']+$AK+($part['W'])/2, $cord['Y']+$AK+($part['H'])/2, $black, $font,$part['NUM'] );
						imagettftext($images[$cord['PG_N']-1], 12, 0, $cord['X']+$AK+($part['W'])/2-10, $cord['Y']+20+$AK, $black, $font, $part['W']);
						imagettftext($images[$cord['PG_N']-1], 12, -90, $cord['X']+20+$AK, $cord['Y']+($part['H'])/2, $black, $font, $part['H']);
					}
				
			}
			$dir_name = TMP.$cid;
			
			$this->pid = $pid;
			$this->uid = $cid;
			
			if(!file_exists ($dir_name)){
				mkdir($dir_name,0777,true);	
			}
			$dir_name .= SPP.$pid;
		  	if(file_exists ($dir_name)){
				rrmdir($dir_name);	
			}	
			
			mkdir($dir_name,0777,true);
			
			foreach($images as $name => $image){
				$this->num_sheats++;
				$im_name = $cid.'_'.$pid.'_'.$name."_a.png";
				$this->sheets[] = $im_name;
				ImagePng($image, $dir_name.SPP.$im_name);
				ImageDestroy($image);
			}
			
			
				
			
		
	}
	
	public function load_images(){
		$a = 1;
		$msg = '';
				foreach($this->sheets as $sheet){
					$msg .= '<hr/>';
					$msg .= '<div class="img"><h2>Detalių išdėstymas '.$a.'/'.$this->num_sheats.'</h2>';
					$msg .= '<img src="'.HOME.SP.'tmp'.SP.$this->uid.SP.$this->pid.SP.$sheet.'"></div>';
					
					$a++;
				}
				return $msg;
			}
	
	
}