<?php
	define('TITLE','Atidaryti projektą');
	$this->view('common/loged_header');
?>

        <div id="main_content" class="column medium-10 panel dark">
         
        	<div id="projecttitle">Atidaryti projektą</div>
            <?php
				show_errors();
				show_notes();
				show_errors('login');
				show_notes('login');
			?>
            <div class="row">
            
            	
                <div id="cont" class="column medium-12">
                	
                    <div id="pr_table_head" class="row">
                    	<div class="tb_col column small-5 medium-6">Pavadinimas</div>
                        <div class="tb_col column small-4 medium-2">Sukūrimo data</div>
                         <div class="column small-3"></div>
                    </div>
                    <div id="displayed_conten">
                    		
                            
                            <?php
							
								if($projects = projects()){
									foreach($projects as $project){
							?>
                        	<div class="list_project row">
                            	<div class="tb_col column small-5 medium-6"><a href="<?php home(); ?>/projektas/redaguoti/<?php echo $project['ID']; ?>/"><?php echo $project['NAME']; ?></a></div>
                                <div class="tb_col column small-4 medium-2"><?php echo $project['DATE']; ?></div>
                                <div class="column small-3 text-right"><a class="button" href="<?php home(); ?>/projektas/redaguoti/<?php echo $project['ID']; ?>/">Atidaryti</a><a class="button delete" href="<?php home(); ?>/projektas/trinti/<?php echo $project['ID']; ?>/">Trinti   </a></div>
                            </div>
                            
                            <?php
									}
							
								}else{
							?>
                            <div class="error">Projektų sarašas tuščias.</div>
                            
                            
                            <?php
							
								}
							?>
                        
                    	
                    </div><!--end of #displayed_conten-->
                </div><!--end of #cont-->
               
            </div>
        </div><!--end of #main_content-->
    </div><!--end of #row-->
<?php
	$this->view('common/footer');
?>