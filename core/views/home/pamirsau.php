<?php
	define('TITLE','Pamiršau slaptažodį');
	$this->view('common/header');
?>
<article id="content" class="row panel">
    	
        <section id="login_form"  class="column medium-12 light">
        <div class="row">
        
        	<div class="column medium-5">
				<?php
                show_errors();
                show_notes();
            ?>
            <p>Norėdami sugeneruoti naują slaptažodį, į žemiau esantį laukelį įveskite savo elektroninio pašto adresu su, kuriuo esate užsiregitravę šioje sistemoje.</p>
            
            <form action="<?php home(); ?>/prisijungti/remind_me_my_password/" method="post" name="forgot_pass">
                <input type="text" name="email" placeholder="El. paštas" size="14"/>
                <input type="submit" value="Gauti slaptaždį" class="button" name="forgot_pass" />
            </form>
            
            </div>
        
        </div>
        
       
        </section>
       
    </article><!--end of #content-->
<?php
	$this->view('common/footer');
?>