<?php

class Projektas extends Controller
{
	public function index(){
		
		$projects = $this->model('project');
		
		$GLOBALS['projects'] = $projects->get_projects(); 
		
		
		$this->logged_view('projektas/index');
	}
	
	public function naujas(){
		
		
		
		
		
		$this->logged_view('projektas/naujas');
	}
	
	public function redaguoti($pid = 0){
		
		
		$project = $this->model('project');
		if($pid>0){
			
			$GLOBALS['parts'] = $project->get_parts($pid);
			if($GLOBALS['project_info'] = $project->get_project($pid)){
				$this->logged_view('projektas/redaguoti');
			}
			
		}
		
	}
	
	public function atnaujinti($ajax = false,$op = false){
		
		$op = $op === 'true'? true: false;
		if(isset($_POST)){
			/*echo '<pre>';
			//print_r($_POST);
			echo '</pre>';
			return;*/
			
			$args = array();
			$count_e = 0;
			if(isset($_POST['projectname']) && !empty($_POST['projectname'])){
				
				$args['NAME'] = test_input($_POST['projectname']);
			}else{
				set_error('Įveskite projekto pavadinimą.');	
				$count_e++;
			}
			if(isset($_POST['material']) && !empty($_POST['material'])){
				
				$args['MATERIAL'] = test_input($_POST['material']);
			}else{
				set_error('Įveskite medžiagos pavadinimą.');
				$count_e++;	
			}
			if(isset($_POST['w']) && !empty($_POST['w'])){
				
				$args['W'] = test_input($_POST['w']);
			}else{
				set_error('Įveskite plokštės plotį.');
				$count_e++;	
			}
			if(isset($_POST['h']) && !empty($_POST['h'])){
				
				$args['H'] = test_input($_POST['h']);
			}else{
				set_error('Įveskite plokštės ilgį.');	
				$count_e++;
			}
			
			if(isset($_POST['sides']) && !empty($_POST['sides'])){
				
				$args['SIDES'] = test_input($_POST['sides']);
			}else{
				set_error('Įveskite apipjaunamus kraštus.');
				$count_e++;	
			}
			
			if(isset($_POST['saw_w']) && !empty($_POST['saw_w'])){
				
				$args['SAW_W'] = test_input($_POST['saw_w']);
			}else{
				set_error('Įveskite pjūvio plotį.');
				$count_e++;	
			}
			
			if(isset($_POST['customer']) && !empty($_POST['customer'])){
				
				$args['CUSTOMER'] = test_input($_POST['customer']);
			}
			if(isset($_POST['end_date']) && !empty($_POST['end_date'])){
				
				$args['END_DATE'] = test_input($_POST['end_date']);
			}
			
			
			
			$new_parts = array();
			$old_parts = array();
			$c_old = 0;
			$c_new = 0;
			
			//print_r($_POST['state']);
			if($_POST['state']>1){
				
				$all_parts = array_values($_POST['parts']);
				
				//print_r($all_parts);
				foreach($all_parts as $part){
					//print_r($part);
					if(!empty($part['ID'])){
						$old_parts[$c_old]['ID'] = test_input($part['ID']);
						$old_parts[$c_old]['PROJ_ID'] = test_input($_POST['project_id']);
						$old_parts[$c_old]['W'] = test_input($part['W']);
						$old_parts[$c_old]['H'] = test_input($part['H']);
						$old_parts[$c_old]['Q'] = test_input($part['Q']);
						$old_parts[$c_old]['COMMENT'] = test_input($part['COMM']);
						$old_parts[$c_old]['SIDES1'] = test_input($part['SIDES1']);
						$old_parts[$c_old]['SIDES2'] = test_input($part['SIDES2']);
						$old_parts[$c_old]['NUM'] = test_input($part['NUM']);
						$c_old++;
					}else{
						if(isset($part['W']) && !empty($part['W'])){
							$new_parts[$c_new]['PROJ_ID'] = test_input($_POST['project_id']);
							$new_parts[$c_new]['W'] = test_input($part['W']);
							$new_parts[$c_new]['H'] = test_input($part['H']);
							$new_parts[$c_new]['Q'] = test_input($part['Q']);
							$new_parts[$c_new]['COMMENT'] = test_input($part['COMM']);
							$new_parts[$c_new]['SIDES1'] = test_input($part['SIDES1']);
							$new_parts[$c_new]['SIDES2'] = test_input($part['SIDES2']);
							$new_parts[$c_new]['NUM'] = test_input($part['NUM']);
							$c_new++;
						}
					}
					
				}
			}else if(isset($all_parts[0]['W']) && !empty($all_parts[0]['W'])){
				foreach($all_parts as $part){
					if(isset($part['W']) && !empty($part['W'])){
						$new_parts[$c_new]['PROJ_ID'] = test_input($_POST['project_id']);
						$new_parts[$c_new]['W'] = test_input($part['W']);
						$new_parts[$c_new]['H'] = test_input($part['H']);
						$new_parts[$c_new]['Q'] = test_input($part['Q']);
						$new_parts[$c_new]['COMMENT'] = test_input($part['COMM']);
						$new_parts[$c_new]['SIDES1'] = test_input($part['SIDES1']);
						$new_parts[$c_new]['SIDES2'] = test_input($part['SIDES2']);
						$new_parts[$c_new]['NUM'] = test_input($part['NUM']);
						$c_new++;
					}
				}
			}
			
			 
			
			if($c_new>0 || $c_old>0){
				$args['STATE'] = 4;
			}else{
				$args['STATE'] = 3;
			}
			
			
			session();
			$_SESSION['project'] = $args;
			$return['pID'] = $_POST['project_id'];
			
			/*echo '<pre>';
			//print_r($_POST['parts']);
			//print_r($old_parts);
			//print_r($new_parts);
			echo '</pre>';*/
			//return;
			$g = 0;
			if(count($new_parts)>0){
				$DB = $this->model('datebase');
				foreach($new_parts as $part){
					
					$new_parts[$g]['ID'] = $DB->insert('fur_parts',$part,true);
					$g++;
				}
				$DB->disconect();
			}
			$return['parts'] = $new_parts;
			if(count($old_parts)>0){
				$DB = $this->model('datebase');
				foreach($old_parts as $part){
					
					$DB->update('fur_parts',$part['ID'],$part);
				}
				$DB->disconect();
			}
			
			
			if($count_e<1){
				
				$mat_id = $this->save_mat($args);
				
				if($mat_id){
					$args['MAT_ID'] = $mat_id;
				}else{
					
					$args1['NAME'] = $args['MATERIAL'];
					$args1['W'] = $args['W'];
					$args1['H'] = $args['H'];
					
					$DB = $this->model('datebase');	
					if($DB->insert('fur_materials',$args1)){
						$args['MAT_ID'] = mysql_insert_id();
						
					}
					$DB->disconect();
				}
				
				$project = $this->model('project');
				if($project->update($args,$_POST['project_id'])){
					if(!$ajax)
					set_note('Projektas atnaujintas.');
				
				}else{
					if(!$ajax){
						set_error('Projekto išsaugoti nepavyko.');
					}else{
						$return['error'] =  3;
					}
					
				}
				
				
				
				$return['log'][] = isset($_POST['optimize']);
				$return['log'][] = $op;
			
				if((isset($_POST['optimize']) && !empty($_POST['optimize'])) || $op){
					
					$pr = $project->get_project($_POST['project_id']);
					
					$parts = $this->model('parts');
					$parts = $parts->get_parts($_POST['project_id']);
					
					$sorter = $this->model('sorter');
					$parts = $sorter->sort($parts);
					
					$optimizer = $this->model('optimizer');
					$optimizer->set($pr['W'],$pr['H'],$pr['SIDES'],$pr['SAW_W']);
					
					$parts = $optimizer->fit($parts);
					
					$cleaner = $this->model('parts');
					
					
					
				
					
					$DB = $this->model('datebase');
					foreach($cleaner->clean($parts) as $part){
						
						$DB->update('fur_parts',$part['ID'],$part);
					}
					$DB->disconect();
					
					
					
					
					
					
					
						$args['STATE'] = 5;
					
					
					
					session();
					$_SESSION['project'] = $args;
					
					unset($args);
					$args = array();
					$args['STATE'] = 5;
					$project->update($args,$_POST['project_id']);
				}
				print_r(json_encode($return));
			
			}
		}else{
			set_error('Nepateikta forma.');	
		}
		if(!$ajax){
			header('location:'.HOME.'/projektas/redaguoti/'.$_POST['project_id'].'/');
		}
		
	}
	
	
	public function saugoti(){
		
		$url = 'naujas/';
		if(isset($_POST)){
			$args = array();
			$count_e = 0;
			if(isset($_POST['projectname']) && !empty($_POST['projectname'])){
				
				$args['NAME'] = test_input($_POST['projectname']);
			}else{
				set_error('Įveskite projekto pavadinimą.');	
				$count_e++;
			}
			if(isset($_POST['material']) && !empty($_POST['material'])){
				
				$args['MATERIAL'] = test_input($_POST['material']);
			}else{
				set_error('Įveskite medžiagos pavadinimą.');
				$count_e++;	
			}
			if(isset($_POST['w']) && !empty($_POST['w'])){
				
				$args['W'] = test_input($_POST['w']);
			}else{
				set_error('Įveskite plokštės plotį.');
				$count_e++;	
			}
			if(isset($_POST['h']) && !empty($_POST['h'])){
				
				$args['H'] = test_input($_POST['h']);
			}else{
				set_error('Įveskite plokštės ilgį.');	
				$count_e++;
			}
			
			if(isset($_POST['sides']) && !empty($_POST['sides'])){
				
				$args['SIDES'] = test_input($_POST['sides']);
			}else{
				set_error('Įveskite apipjaunamus kraštus.');
				$count_e++;	
			}
			
			if(isset($_POST['saw_w']) && !empty($_POST['saw_w'])){
				
				$args['SAW_W'] = test_input($_POST['saw_w']);
			}else{
				set_error('Įveskite pjūvio plotį.');
				$count_e++;	
			}
			
			if(isset($_POST['customer']) && !empty($_POST['customer'])){
				
				$args['CUSTOMER'] = test_input($_POST['customer']);
			}
			if(isset($_POST['end_date']) && !empty($_POST['end_date'])){
				
				$args['END_DATE'] = test_input($_POST['end_date']);
			}
			
			session();
			$_SESSION['project'] = $args;
			
			if($count_e<1){
				
				$mat_id = $this->save_mat($args);
				
				if($mat_id){
					$args['MAT_ID'] = $mat_id;
				}else{
					
					$args1['NAME'] = $args['MATERIAL'];
					$args1['W'] = $args['W'];
					$args1['H'] = $args['H'];
					
					$DB = $this->model('datebase');	
					if($DB->insert('fur_materials',$args1)){
						$args['MAT_ID'] = mysql_insert_id();
						
					}
					$DB->disconect();
				}
				
				$project = $this->model('project');
				if($project->save($args)){
					$url = 'redaguoti/'.$project->ID.'/';
					set_note('Projektas išsaugotas.');
				}else{
					set_error('Projekto išsaugoti nepavyko.');
				}
				
			}
		}else{
			set_error('Nepateikta forma.');	
		}
		
		header('location:'.HOME.'/projektas/'.$url);
	}
	
	private function save_mat($args){
		$DB = $this->model('datebase');	
		$uzklausa='SELECT ID FROM fur_materials WHERE NAME="'.$args['MATERIAL'].'" AND W="'.$args['W'].'" AND H="'.$args['H'].'"';			
		$rez=mysql_query($uzklausa) or die(mysql_error());
		if(mysql_num_rows($rez) > 0){
			$rez = mysql_fetch_array($rez);
			$DB->disconect();
			return $rez['ID'];
		}else {
			$DB->disconect();
			return false;	
		}
	}
	
	public function trinti($id = 0){
		$project = $this->model('project');
		$user = $this->model('user');
		if($id > 0){
			$userID = $project->get_project($id);
			$userID = $userID['COMP_ID'];
			if($userID == $user->id){
				if($project->delete($id)){
					set_note('Projektas ištrintas');
				}else{
					set_error('Projekto ištrinti nepavyko');
				}
			}else{
					set_error('Turite prisijungti');
				}
		}else{
					set_error('Turite prisijungti');
				}
				
		header('location:'.HOME.'/projektas/');		
		
	}
	
	public function trinti_detale($d_id = 0,$p_id = 0,$ajax = false){
		if($d_id>0 && $p_id>0){
			
			$project = $this->model('project');
			$user = $this->model('user');
			$userID = $project->get_project($p_id);
			$userID = $userID['COMP_ID'];
			if($userID == $user->id){
				$DB = $this->model('datebase');
			
				$uzklausa='DELETE FROM fur_parts WHERE PROJ_ID='.$p_id.' AND ID = '.$d_id.';';
				$rezultatas=mysql_query($uzklausa) or die(mysql_error());
				if (!$rezultatas){
					if(!$ajax)	
					set_error('Detalės ištrinti nepavyko');
				}else{
					if(!$ajax)
					set_note('Detalė ištrintas');
				}
				$DB->disconect();
			}
		
		
		}
		if(!$ajax)
		header('location:'.HOME.'/projektas/redaguoti/'.$p_id.'/');
	}
	
	
	public function ataskaita($pid,$just = false){
		
		
		$html = $this->generuotiataskaita($pid,$just);
		if($just){
			echo $html;
		}else{
			
		require_once(MODELS.'dompdf/dompdf_config.inc.php');
	  $dompdf = new DOMPDF();
	  $dompdf->load_html($html);
	  $dompdf->set_paper('a4', 'portrait');
	  $dompdf->render();
		$project = $this->model('project');
		$project = $project->get_project($pid);
	  $dompdf->stream(str_replace(' ','_',$project['NAME']).".pdf", array("Attachment" => true));
		}
	}
	
	private function generuotiataskaita($pid,$just = false){
		$project = $this->model('project');
		$render = $this->model('render');
		
		
		
		
		$parts = $project->get_parts($pid);
		$project = $project->get_project($pid);
		$render->rend_from_db($parts,$project['ID'],$project['COMP_ID'],$project['W'],$project['H'],$project['SIDES'],$project['SAW_W']);
		
		$html = '<!doctype html>
					<html>
					<head>
					<meta http-equiv="Content-Type" content="charset=utf-8" /> 
					<title>Ataskaita spausdinimui</title>
					<style>
					
					
					@page {
						margin: 2cm;
					}
					
					hr {
					  page-break-after: always;
					  border: 0;
					}
					
					body{
						font-family:Verdana, Geneva, sans-serif;	
						margin: 0cm 0 1.5cm 0;
						font-size:12px;
						background:#fff;'.($just?'padding:20px;':'').'
					}
					#right{
						text-align:right;	
					}
					#right:before {
					  content: "Puslapis " counter(page);
					}
						.header{
							margin-bottom:1cm;
							border-bottom:solid 1px #666666;	
						}
						
						table td, table th{
							padding:6px;
							text-align:left;
							
						}
						
						.content tr td{
							border-bottom:solid 1px #999999;	
						}
						h2{
							font-size:14px;	
						}
						
						
						.content{
							padding:6px;	
						}
						
						.content th{
							
							padding:6px;
							border-bottom:solid 3px #999999;
						}
						.img img{
							width:auto;
							height:auto;
							max-width:100%;
							max-height:90%;	
						}
						#footer{		
							width:100%;
							border-top:solid 1px #666666;
							padding-top:20px;
							color:#999;
							font-size:10px;
							position: fixed;
							left: 0;
							right: 0;
							bottom: 0;
							
						}
						#footer table td{
							width:50%;
						}
						
						#pages{
							text-align:right;	
						}
						
					
					
					
					</style>
					</head>
					
					<body>


	
    	
    	
        	<table class="header" width="100%">
               
                
                  <tr>
                    <td rowspan="3"><img src="'.HOME.'/img/logo2.png"></td>
                    <td >Projekto pavadinimas: '.$project['NAME'].'</td>
                    <td>Medžiaga: '.$project['MATERIAL'].'</td>
                  </tr>
                  <tr>
                    <td>Užsakovas: '.$project['CUSTOMER'].'</td>
                    <td>Lapo matmenys: '.$project['W'].' x '.$project['H'].'</td>
                  </tr>
                  <tr>
                    <td>Pabaigos data: '.$project['END_DATE'].'</td>
                    <td>Medžiagos storis: '.$project['NAME'].'</td>
                  </tr>
              
              
             </table>
              
              	<table class="content" width="100%" cellspacing="0" cellpadding="0">
                    <THEAD >
                      <tr>
                        <th width="10%" scope="col">Eil. Nr.</th>
                        <th width="20%" scope="col">Ilgis (mm)</th>
                        <th width="20%" scope="col">Plotis (mm)</th>
                        <th width="10%" scope="col">Kiekis</th>
                        <th width="10%" scope="col">Kantavimas plotis</th>
						<th width="10%" scope="col">Kantavimas ilgis</th>
                        <th scope="col">Pastabos</th>
                      </tr>
                      </THEAD>
                      <tbody>';
                      
                      
					  	foreach($parts as $part){
							$html .= "<tr>
									<td>$part[NUM]</td>
									<td>$part[W]</td>
									<td>$part[H]</td>
									<td>$part[Q]</td>
									<td>$part[SIDES1]</td>
									<td>$part[SIDES2]</td>
									<td>$part[COMMENT]</td>
								  </tr>";
						}
					  
					  
                      
                      
                      $html .= '</tbody>
								</table>';
			
			$html .= $render->load_images();
				  
				  if(!$just){
					$html .= '<table id="footer">
						<tr>
							<td>Sukurta naudojant: Furnitas.lt</td>
							<td id="pages">
							<span id="right"></span>
							</td>
						</tr>
					</table>';}
					
				  
				
				
			   
				
			
			
			
			$html .= '</body>
			</html>
			';
return $html;
	}
	
}