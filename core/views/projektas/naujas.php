<?php
	define('TITLE','Naujas projektas*');
	$this->view('common/loged_header');
?>

        <div id="main_content" class="column medium-10 panel dark">
         
        	<div id="projecttitle">Naujas projektas*</div>
            <?php
				show_errors();
				show_notes();
				show_errors('login');
				show_notes('login');
			?>
            <div class="row">
            <form method="post" action="<?php home(); ?>/projektas/saugoti/">
            	<div id="contentnav" class="column medium-2">
                	<ul>
                    	<li  class="column small-4 medium-12">
                        	<span>
                            	<input type="submit" class="icon" id="saveicon" value="Išsaugoti">
                                <span>Išsaugoti</span>
                            </span>
                        </li>
                        

                    </ul>
                </div><!--end of #content_nav-->
                <div id="cont" class="column medium-10">
                	<ul id="tabs">
                    	<li class="active"><a href="#">Projekto informacija</a></li>
                        <li class="inactive"><a href="#">Detalių sąrašas</a></li>
                        <li class="inactive"><a href="#">Ataskaita</a></li>
                    </ul><!--end of #tabs-->
                    <?php
						session();
						$pname = (isset($_SESSION['project']['NAME'])?$_SESSION['project']['NAME']:'');
						$MATERIAL = (isset($_SESSION['project']['MATERIAL'])?$_SESSION['project']['MATERIAL']:'');
						$W = (isset($_SESSION['project']['W'])?$_SESSION['project']['W']:'');
						$H = (isset($_SESSION['project']['H'])?$_SESSION['project']['H']:'');
						$SAW_W = (isset($_SESSION['project']['SAW_W'])?$_SESSION['project']['SAW_W']:'');
						$SIDES = (isset($_SESSION['project']['SIDES'])?$_SESSION['project']['SIDES']:'');
						
						$CUSTOMER = (isset($_SESSION['project']['CUSTOMER'])?$_SESSION['project']['CUSTOMER']:'');
						
						$END_DATE = (isset($_SESSION['project']['END_DATE'])?$_SESSION['project']['END_DATE']:'2015-02-22');
					
					?>
                    <div id="displayed_conten">
                    		<input name="project_id" type="hidden" value="">
                            <input name="mat_id" type="hidden" value="">
                            <input name="state" type="hidden" value="">
                        	<h3>Bendroji informacija</h3>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Projekto pavadinimas</div>
                                <div class="column medium-9"><input name="projectname" type="text" value="<?php echo $pname; ?>"></div>
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
                                <div id="mat_name_holder" class="column medium-9"><input id="mat_name" name="material" type="text" value="<?php echo $MATERIAL; ?>"></div>
                            </div>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Lapo plotis</div>
                                <div class="column medium-9"><input id="mat_w" class="short" name="w" type="number" value="<?php echo $W; ?>"><span>mm</span></div>
                            </div>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Lapo ilgis</div>
                                <div class="column medium-9"><input id="mat_h" class="short" name="h" type="number" value="<?php echo $H; ?>"><span>mm</span></div>
                            </div>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Apipjaunami kraštai</div>
                                <div class="column medium-9"><input class="short" name="sides" type="number" value="<?php echo $SIDES; ?>"><span>mm</span></div>
                            </div>
                            <div class="row">
                            	<div class="column medium-3 medium-text-right">Pjūklo plotis</div>
                                <div class="column medium-9"><input id="pplotis" class="short" name="saw_w" type="number" value="<?php echo $SAW_W; ?>"><span>mm</span></div>
                            </div>
                        	
                        
                    	
                    </div><!--end of #displayed_conten-->
                </div><!--end of #cont-->
                </form>
            </div>
        </div><!--end of #main_content-->
    </div><!--end of #row-->
<?php
	set_js(array('common','new_project'));
	$this->view('common/footer');
?>