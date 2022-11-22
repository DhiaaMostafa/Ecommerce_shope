<?php

	include 'connect.php';
	$tpl 	= 'includes/templates/'; 
	$func	= 'includes/functions/'; 

	// Include The Important Files
	include $func . 'functions.php';
	include $func . 'functionitems.php';
	include $tpl . 'header.php';
	if (!isset($noNavbar)) { include $tpl . 'navbar.php'; }
	

	