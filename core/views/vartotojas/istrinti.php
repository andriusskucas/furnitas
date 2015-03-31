<?php
	define('TITLE','Ištrinti paskyrą?');
	$this->view('common/loged_header');
?>

        <div id="main_content" class="column medium-10 panel dark">
         
        	<div id="projecttitle"><?php echo TITLE; ?></div>
            <?php
				show_errors();
				show_notes();
				show_errors('login');
				show_notes('login');
			?>
			<div class="row">
					
					<div id="cont" class="column medium-12">
						
						
						<div id="displayed_conten">
                        
							<form method="post" action="<?php home(); ?>/vartotojas/istrinti/<?php echo sha1('trink'); ?>/" name="user_settings">
								
								
								<h3>Ar ištrinti paskyrą?</h3>
                                
                                
								<div class="row">
									<div class="column medium-3 medium-text-right"></div>
									<div class="column medium-9"><p>Norėdami ištrinti paskyrą įveskite savo paskyros slaptažodį.</p></div>
								</div>
								<div class="row">
									<div class="column medium-3 medium-text-right">Slaptažodis</div>
									<div class="column medium-9"><input name="pass" type="password"></div>
								</div>
                                
                                <div class="row">
									<div class="column medium-3 medium-text-right"></div>
									<div class="column medium-9"><input name="delete" type="submit" value="Ištrinti paskyrą" class="button"></div>
								</div>
								
								
							</form>
                            
							
						</div><!--end of #displayed_conten-->
					</div><!--end of #cont-->
				</div>
			</div><!--end of #main_content-->
		</div><!--end of #row-->
<?php
	$this->view('common/footer');
?>