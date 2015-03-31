<?php
	define('TITLE','Pradinis');
	$this->view('common/header');
?>
<article id="content" class="row panel">
    	<section id="slider" class="column medium-8 dark">
        <?php
			show_errors();
			show_notes();
		?>
        </section>
        <section id="login_form"  class="column medium-4 light">
        <?php
			show_errors('login');
			show_notes('login');
		?>
        <?php
			$this->view('common/login_form');
		?>
        <p>Naujas vartotojas?</p>
        <a href="<?php home(); ?>/registruotis/" class="button">REGISTRUOTIS</a>
        </section>
    </article><!--end of #content-->
<?php
	$this->view('common/footer');
?>