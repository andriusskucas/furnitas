<?php
	$this->view('common/header');
?>
<article id="content" class="row panel">
    	<section id="slider" class="column medium-8">
        <?php
			show_errors();
			show_notes();
		?>
        </section>
        <section id="login_form"  class="column medium-4">
        
        <p>Naujas vartotojas?</p>
        <a href="<?php home(); ?>/prisijungti/logout/" class="button">Atsijungti</a>
        </section>
    </article><!--end of #content-->
<?php
	$this->view('common/footer');
?>