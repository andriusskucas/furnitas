<?php
	define('TITLE','Naujo vartotojo registracija');
	$this->view('common/header');
?>
<article id="content" class="row panel">
    	<section  id="reg_form" class="column medium-8 light">
        <p>Norėdami užsiregistruoti užpildykite registracijos formą:</p>
        <?php
			show_errors('reg');
			show_notes('reg');
		?>
        
            <form action="<?php home(); ?>/registruotis/naujas/" method="post" name="registration_form">
            	<input name="name_surname" type="text" placeholder="Vardas Pavardė" <?php val('name_surname'); ?>>
                <input name="username" type="text" placeholder="El. Pašto adresas"<?php val('username'); ?>>
                <input name="pass" type="password" placeholder="Slaptažodis">
                <input name="pass1" type="password" placeholder="Pakartokite slaptažodį">
                <br>
                <img id="captcha" src="<?php home(); ?><?php echo '/'.MODELS; ?>securimage/securimage_show.php" alt="CAPTCHA Image" /><br>
                <a href="#" onclick="document.getElementById('captcha').src = '<?php home(); ?><?php echo '/'.MODELS; ?>securimage/securimage_show.php?' + Math.random(); return false">[ Kitas paveikslėlis ]</a>
                <input name="cap" type="text" placeholder="Saugos kodas">
                <input name="registration_form" type="submit" class="button" value="REGISTRUOTIS">
                
            </form>
        </section>
        <section  id="login_form1" class="column medium-4 dark">
        <p>Užsiregistravęs vartotojoas? Prisijunkite:</p>
        <?php
			show_errors('login');
			show_notes('login');
		?>
        <?php
			$this->view('common/login_form');
		?>
        
        </section>
    </article><!--end of #content-->
<?php
	$this->view('common/footer');
?>