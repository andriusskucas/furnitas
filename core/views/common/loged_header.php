<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php 
	
	if(defined('TITLE')){
		echo '<title>'.TITLE.' | Furnitas</title>';	
	}else{
		echo '<title>Furnitas</title>';
	}?>
    <link rel="stylesheet" href="<?php home(); ?>/css/app.css" />
   
      
    <script src="<?php home(); ?>/js/vendor/modernizr.js"></script>
    
  </head>
  <body>
    
    <div class="row">
    	<div id="side_header_wrap" class="column medium-2 text-left">
        	<div id="side_header" class="panel text-center">
            	<div id="logo_container">
            		<div id="logo2"></div>
                </div>
                <nav id="sidenav">
                	<ul>
                    	<li class="column small-4 medium-12">
                        	<a href="<?php home(); ?>/projektas/naujas/">
                            	<span class="icon" id="newproject">Sukurti projektą</span>
                                <span>Sukurti projektą</span>
                            </a>
                        </li>
                        <li class="column small-4 medium-12">
                        	<a href="<?php home(); ?>/projektas/">
                            	<span class="icon" id="openproject">Atidaryti projektą</span>
                                <span>Atidaryti projektą</span>
                            </a>
                        </li>
                    
                    	<li class="column small-4 medium-12">
                        	<a href="<?php home(); ?>/vartotojas/">
                            	<span class="icon" id="settingsicon">Paskyros nustatymai</span>
                                <span>Paskyros nustatymai</span>
                            </a></li>
                    </ul>
                    <div id="logoff">
                    	<a href="<?php home(); ?>/prisijungti/logout/">Atsijungti<span id="logofficon">a</span></a>
                    </div>
                			
                </nav><!--end of #footnav-->
            </div><!--end of #side_header-->
        </div><!--side_header_wrap-->