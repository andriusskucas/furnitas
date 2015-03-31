<?php
	$project = project();
	define('TITLE','Redaguoti projektą');
	$this->view('common/loged_header');
?>

        <div id="main_content" class="column medium-10 panel dark">
         
        	<div id="projecttitle"><?php project_name(); ?></div>
            <?php
				show_errors();
				show_notes();
				show_errors('login');
				show_notes('login');
			?>
            <div class="row">
            <form method="post" id="target" action="<?php home(); ?>/projektas/atnaujinti/">
            	<div id="contentnav" class="column medium-2">
                	<ul>
                    	<li  class="column small-4 medium-12">
                        	<span>
                            	<input name="save" type="submit" class="icon" id="saveicon" value="Išsaugoti">
                                <span>Atnaujinti</span>
                            </span>
                        </li>
                        <li class="column small-4 medium-12">
                        	<div id="counticon_holder" class="<?php echo ($project['STATE']<4?'inactive':''); ?>">
                            	
                                <input name="optimize" type="submit" class="icon <?php echo ($project['STATE']<4?'inactive':''); ?>" id="counticon" value="Išdėtyti">
                                <span>Išdėtyti</span>
                            </div>
                        </li >
                        <li class="column small-4 medium-12">
                        	<a target="_blank" href="<?php home(); ?>/projektas/ataskaita/<?php echo $project['ID']; ?>/" id="downloadicon_holder" class="<?php echo ($project['STATE']<5?'inactive':''); ?>">
                            	<span class="icon <?php echo ($project['STATE']<5?'inactive':''); ?>" id="downloadicon">Parsisiųsti ataskaitą</span>
                                <span id="op">Parsisiųsti ataskaitą</span>
                            </a>
                        </li>
                        <li class="column small-4 medium-12">
                        	<a class="delete" href="<?php home(); ?>/projektas/trinti/<?php echo $project['ID']; ?>/">
                            	<span class="icon" id="deleteicon">Ištrinti</span>
                                <span>Ištrinti</span>
                            </a>
                        </li>

                    </ul>
                </div><!--end of #content_nav-->
                <div id="cont" class="column medium-10">
                	<ul id="tabs" class="tabs" data-tab>
                    	<li id="p_info_holder" class="tab-title <?php echo ($project['STATE']<2?'active':''); ?>"><a id="p_info_tab" href="#project_tab">Projekto informacija</a></li>
                        <li id="p_parts_holder" class="tab-title <?php echo ($project['STATE']>1 && $project['STATE']<5?'active':''); ?>"><a id="p_parts" href="#parts_tab">Detalių sąrašas</a></li>
                        <li id="p_all_holder" class="tab-title <?php echo ($project['STATE']<5?'inactive':''); ?><?php echo ($project['STATE']>4?'active':''); ?>"><a id="p_all" href="#final_tab">Ataskaita</a></li>
                    </ul><!--end of #tabs-->
                    <?php
						session();
						$pname = $project['NAME'];
						$MATERIAL = $project['MATERIAL'];
						$W = $project['W'];
						$H = $project['H'];
						$SAW_W = $project['SAW_W'];
						$SIDES = $project['SIDES'];
						
						$CUSTOMER = $project['CUSTOMER'];;
						
						$END_DATE = $project['END_DATE'];;
					
					?>
                    <div id="displayed_conten" class="tabs-content">
                    
                    	<div class="content <?php echo ($project['STATE']<2?'active':''); ?>" id="project_tab">
                    		<input id="project_id" name="project_id" type="hidden" value="<?php echo $project['ID']; ?>">
                            <input name="mat_id" type="hidden" value="<?php echo $project['MAT_ID']; ?>">
                            <input name="state" type="hidden" value="<?php echo $project['STATE']; ?>">
                        	<h3>Bendroji informacija</h3>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Projekto pavadinimas</div>
                                <div class="column medium-9"><input name="projectname" type="text" value="<?php echo $pname; ?>" required></div>
                            </div>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Užsakovas</div>
                                <div class="column medium-9"><input name="customer" type="text" value="<?php echo $CUSTOMER; ?>"></div>
                            </div>
                            
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Pabaigos data</div>
                                <div class="column medium-9"><input class="inputDate" id="inputDate" name="end_date" type="text" value="<?php echo $END_DATE; ?>" readonly></div>
                            </div>
                        	<h3>Plokštės informacija</h3>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Medžiagos pavadinimas</div>
                                <div id="mat_name_holder" class="column medium-9"><input id="mat_name" name="material" type="text" value="<?php echo $MATERIAL; ?>" required></div>
                            </div>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Lapo plotis</div>
                                <div class="column medium-9"><input id="mat_w" class="short" name="w" type="number" value="<?php echo $W; ?>" required><span>mm</span></div>
                            </div>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Lapo ilgis</div>
                                <div class="column medium-9"><input id="mat_h" class="short" name="h" type="number" value="<?php echo $H; ?>" required><span>mm</span></div>
                            </div>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Apipjaunami kraštai</div>
                                <div class="column medium-9"><input id="sides" class="short" name="sides" type="number" value="<?php echo $SIDES; ?>" required><span>mm</span></div>
                            </div>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Pjūklo plotis</div>
                                <div class="column medium-9"><input class="short" name="saw_w" type="number" value="<?php echo $SAW_W; ?>" required><span>mm</span></div>
                            </div>
                        	
                        </div>
                        <div class="content <?php echo ($project['STATE']>1 && $project['STATE']<5?'active':''); ?>" id="parts_tab">
                        	<table id="parts_table" width="100%" border="1" cellspacing="0" cellpadding="0">
                              <tr>
                                <td>Eil. NR.</td>
                                <td>Plotis (mm)</td>
                                <td>Ilgis (mm)</td>
                                <td>Kiekis</td>
                                <td>Kantavimas plotis</td>
                                <td>Kantavimas ilgis</td>
                                <td>Pastabos</td>
                                <td></td>
                              </tr>
                              
                              <?php
							 
							
								if($parts = parts()){
									$i = 0;
									foreach($parts as $part){
									$nr = $i+1;
										echo '<tr>
										<td><span class="eilnr">'.$nr.'</span><input class="part_id" name="parts['.$i.'][ID]" type="hidden" value="'.$part['ID'].'"><input class="part_num" name="parts['.$i.'][NUM]" type="hidden" value="'.$nr.'"></td>
										<td><input name="parts['.$i.'][W]" class="pw" type="number" value="'.$part['W'].'" size="6" min="1"></td>
										<td><input name="parts['.$i.'][H]" class="ph" type="number" value="'.$part['H'].'" size="6" min="1"></td>
										<td><input name="parts['.$i.'][Q]" type="number" value="'.$part['Q'].'" size="2" min="1"></td>
										<td><input name="parts['.$i.'][SIDES1]" type="number" value="'.$part['SIDES1'].'" min="0" max="2"></td>
										<td><input name="parts['.$i.'][SIDES2]" type="number" value="'.$part['SIDES2'].'" min="0" max="2"></td>
										<td><input name="parts['.$i.'][COMM]" type="text" value="'.$part['COMMENT'].'"></td>
										<td  class="dell"><a class="del_part button" href="'.HOME.'/projektas/trinti_detale/'.$part['ID'].'/'.$project['ID'].'/" data-num="'.$nr.'">x</a></td>
									  </tr>';
									  $i++;
									}
									
									for($j = $i+1; $j<$i+2; $j++){
										  $nr = $j-1;
										echo '<tr>
										<td><span class="eilnr">'.$j.'</span><input class="part_id" name="parts['.$nr.'][ID]" type="hidden" value=""><input class="part_num" name="parts['.$nr.'][NUM]" type="hidden" value="'.$j.'"></td>
										<td><input name="parts['.$nr.'][W]" class="pw" type="number" value="" size="6" min="1"></td>
										<td><input name="parts['.$nr.'][H]" class="ph" type="number" value="" size="6" min="1"></td>
										<td><input name="parts['.$nr.'][Q]" type="number" value="1" size="2" min="1"></td>
										<td><input name="parts['.$nr.'][SIDES1]" type="number" value="0" min="0" max="2"></td>
										<td><input name="parts['.$nr.'][SIDES2]" type="number" value="0" min="0" max="2"></td>
										<td><input name="parts['.$nr.'][COMM]" type="text"></td>
										<td class="dell"></td>
									  </tr>';}
							
								}else{
									$i = 0;
							for($j = $i+1; $j<$i+2; $j++){
										  $nr = $j-1;
										echo '<tr>
										<td><span class="eilnr">'.$j.'</span><input class="part_id" name="parts['.$nr.'][ID]" type="hidden" value=""><input name="parts['.$nr.'][NUM]" class="part_num" type="hidden" value="'.$j.'"></td>
										<td><input name="parts['.$nr.'][W]" class="pw" type="number" value="" size="6" min="1"></td>
										<td><input name="parts['.$nr.'][H]" class="ph" type="number" value="" size="6" min="1"></td>
										<td><input name="parts['.$nr.'][Q]" type="number" value="1" size="2" min="1"></td>
										<td><input name="parts['.$nr.'][SIDES1]" type="number" value="0" min="0" max="2"></td>
										<td><input name="parts['.$nr.'][SIDES2]" type="number" value="0" min="0" max="2"></td>
										<td><input name="parts['.$nr.'][COMM]" type="text"></td>
										<td class="dell"></td>
									  </tr>';}
							
								}
							?>
							  
							  
							  
							  
                              
                              
                              
                            </table>

                        </div>
                        
                        <div class="content <?php echo ($project['STATE']>4?'active':''); ?>" id="final_tab">
                        	<object id="ataskaita" type="text/html" data="<?php home(); ?>/projektas/ataskaita/<?php echo $project['ID']; ?>/true/" style="width:100%; height:100%">
                            	<p>backup content</p>
                            </object>
                        </div>
                        
                        
                    	
                    </div><!--end of #displayed_conten-->
                </div><!--end of #cont-->
                </form>
            </div>
        </div><!--end of #main_content-->
    </div><!--end of #row-->
<?php
	set_js(array('common','new_project','edit_project','parts'));
	$this->view('common/footer');
?>