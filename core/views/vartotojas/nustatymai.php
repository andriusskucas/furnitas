<?php
	define('TITLE','Paskyros nustatymai');
	$this->view('common/loged_header');
?>

        <div id="main_content" class="column medium-10 panel dark">
         
        	<div id="projecttitle">Paskyros nustatymai</div>
            <?php
				show_errors();
				show_notes();
				show_errors('login');
				show_notes('login');
			?>
			<div class="row">
					
					<div id="cont" class="column medium-12">
						
						
						<div id="displayed_conten">
                        <?php
						
							show_errors('save_user');
							show_notes('save_user');
						?>
							<form method="post" action="<?php home(); ?>/vartotojas/atnaujinti/" name="user_settings">
								<h3>Bendroji informacija</h3>
                                <div class="row">
									<div class="column medium-3 medium-text-right">Vardas Pavardė, (Įmonės pavadinimas)</div>
									<div class="column medium-9"><input name="name_surname" type="text" value="<?php user_name(); ?>"></div>
								</div>
								<div class="row">
									<div class="column medium-3 medium-text-right">El. pašto adresas</div>
									<div class="column medium-9"><input name="email" type="text" value="<?php user_email(); ?>"></div>
								</div>
								
								<h3>Slaptažodžio keitimas</h3>
								<div class="row">
									<div class="column medium-3 medium-text-right">Esamas slaptažodis</div>
									<div class="column medium-9"><input name="oldpass" type="password"></div>
								</div>
								<div class="row">
									<div class="column medium-3 medium-text-right">naujas slaptažodis</div>
									<div class="column medium-9"><input name="newpass" type="password"></div>
								</div>
								<div class="row">
									<div class="column medium-3 medium-text-right">pakartoti naują slaptažodį</div>
									<div class="column medium-9"><input name="newpass1" type="password"></div>
								</div>
                                
                                <div class="row">
									<div class="column medium-3 medium-text-right"></div>
									<div class="column medium-9"><input name="save" type="submit" value="Išsaugoti" class="button"></div>
								</div>
								
								
							</form>
                            <h3>Paskyros panaikinimas</h3>
                            <div class="row">
									<div class="column medium-3 medium-text-right"></div>
									<div class="column medium-9"><a href="<?php home(); ?>/vartotojas/istrinti/" class="button">Panaikinti paskyrą</a></div>
                                    
								</div>
							
						</div><!--end of #displayed_conten-->
					</div><!--end of #cont-->
				</div>
			</div><!--end of #main_content-->
		</div><!--end of #row-->
<?php
	$this->view('common/footer');
?>