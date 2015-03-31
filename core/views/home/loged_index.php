<?php
	define('TITLE','Pradinis');
	$this->view('common/loged_header');
?>

        <div id="main_content" class="column medium-10 panel dark">
         
        	<div id="projecttitle">Pradinis | Laba diena</div>
            <?php
			show_errors();
			show_notes();
			show_errors('login');
			show_notes('login');
		?>
            <div class="row">
            	
                <div id="cont" class="column medium-12">
                	
                    
                    <div id="displayed_conten">
                    	<p>Sveiki prisijungę.<br>
                        	Dabar galite sukurti naują projektą arba atidaryti jau sukurtą.
                        </p>
                    	
                    </div><!--end of #displayed_conten-->
                </div><!--end of #cont-->
            </div>
        </div><!--end of #main_content-->
    </div><!--end of #row-->
<?php
	$this->view('common/footer');
?>