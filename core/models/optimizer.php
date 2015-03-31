<?php

class Optimizer{
	protected $null = NULL;
	protected $root = array(
		"W" => 0,
		"H" => 0,
		"X" => 0,
		"Y" => 0
		);
		protected $pages = array();
		protected $page = 0;
		protected $saw = 0;
		protected $allfit = false;
		
		
			
	/*public function __construct($W,$H) {
        $this->root['W'] = $W;
		$this->root['H'] = $H;
		$this->pages[] = $this->root;
		
    }*/
	
	public function set($W,$H,$AK,$SAW) {
        $this->root['W'] = $W-(2*$AK);
		$this->root['H'] = $H-(2*$AK);
		$this->pages[] = $this->root;
		$this->saw = $SAW;
		
    }
	
		
	public function fit($blocks){
		
		$node = array();
		$block = array();
		$b = array();
		$didnt_fit = 0;
		do {
			$didnt_fit = 0;
			$this->allfit = true;
			for($n = 0; $n < count($blocks); $n++){
				$block = $blocks[$n];
				
				if(!isset($blocks[$n]['fit'])){ 
					if($node = &$this->findNode($this->pages[$this->page],$block['W']+$this->saw,$block['H']+$this->saw)){
						
						$blocks[$n]['fit']=$this->splitNode($node,$block['W']+$this->saw,$block['H']+$this->saw);
						$b[$this->page][] = $blocks[$n];
						
					}else{
						
						$this->allfit = false;
						$didnt_fit++;	
					}			
				}
			}
			
			if(!$this->allfit){
				$this->page++;
				
				$this->pages[$this->page]=$this->root;
			}
			
			
			
			
		} While ($didnt_fit>0);
		
		
		return $b;
	}
	
	private function &findNode(&$rooot,$W,$h){
		
		
		if(isset($rooot['used'])){
			if((!isset($rooot['right1']['used']) && !isset($rooot['doWn1']['used'])) && $this->findNode($rooot['right'],$W,$h)){
				 return $this->findNode($rooot['right'],$W,$h);
				 
				
			}else if((!isset($rooot['right1']['used']) && !isset($rooot['doWn1']['used'])) && $this->findNode($rooot['doWn'],$W,$h)){
				 return $this->findNode($rooot['doWn'],$W,$h);
				
			}else if((!isset($rooot['right']['used']) && !isset($rooot['doWn']['used'])) && $this->findNode($rooot['right1'],$W,$h)){
				 return $this->findNode($rooot['right1'],$W,$h);
				
			}else if((!isset($rooot['right']['used']) && !isset($rooot['doWn']['used'])) && $this->findNode($rooot['doWn1'],$W,$h)){
				 return $this->findNode($rooot['doWn1'],$W,$h);
				
			}
		}else if(($W <= $rooot['W']) && ($h <= $rooot['H'])){
			return $rooot;
					
		}else{
			
			
			return $this->null;
		}
		return $this->null;
		
	}
	
	private function &splitNode(&$node,$W,$h){
			$node['used'] = true;
			$node['page'] = $this->page;
			$node['doWn'] = array(
				"X"=>$node['X'],
				'Y'=>$node['Y']+$h,
				'W'=>$node['W'],
				'H'=>$node['H']-$h);
			$node['right'] = array(
				"X"=>$node['X']+$W,
				'Y'=>$node['Y'],
				'W'=>$node['W']-$W,
				'H'=>$h);
				$node['doWn1'] = array(
				"X"=>$node['X'],
				'Y'=>$node['Y']+$h,
				'W'=>$W,
				'H'=>$node['H']-$h);
			$node['right1'] = array(
				"X"=>$node['X']+$W,
				'Y'=>$node['Y'],
				'W'=>$node['W']-$W,
				'H'=>$node['H']);
			return $node;
	}
	
	
}
