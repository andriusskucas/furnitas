<?php
	$this->view('common/header');
?>
<article id="content" class="row panel">
    	<section  class="column medium-12">
        <?php
			show_errors();
			show_notes();
		?>
        <p>Apie mus</p>
        </section>
        
    </article><!--end of #content-->
<?php
	$this->view('common/footer');
?>