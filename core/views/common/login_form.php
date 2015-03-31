
<form action="<?php home(); ?>/prisijungti/login/" method="post" name="login_form">
				<input type="hidden" name="last_url" value="<?php echo curPageURL(); ?>">
                <input name="username" type="text" placeholder="El. Pašto adresas">
                <input name="pass" type="password" placeholder="Slaptažodis">
                <input name="login_form" type="submit" class="button" value="PRISIJUNGTI">
                 <a href="<?php home(); ?>/prisijungti/pamirsau/" class="f-14" >Pamiršote slaptažodį? Spauskite čia.</a>
            </form>
           