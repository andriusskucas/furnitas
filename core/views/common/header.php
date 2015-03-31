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
  <body id="front">
    
    <header id="header" class="row panel small-text-center">
    	<div class="column medium-6 large-4">
        <div id="logo"></div>
        	<h1>Furnitas</h1>
        </div>
        
        <nav id="menu" class="column medium-6 large-8 small-text-center medium-text-right">
        	<ul>
            	<li><a href="<?php home(); ?>/">Pradinis</a></li>
            	<li><a href="<?php home(); ?>/apie-mus/">Apie mus</a></li>
                <li><a href="<?php home(); ?>/registruotis/">Registruotis</a></li>
                
            </ul>
        </nav><!--end of #menu-->
    </header><!--end of #header-->