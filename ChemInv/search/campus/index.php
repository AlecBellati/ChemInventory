<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
		case "Next":
			nextPage();
			return;
		case "Back":
			backPage();
			return;
		case "campus":
			campus();
			return;
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		// Setup the table
		$_SESSION['table'] = new Table_CampusList($_SESSION['dbi'], DEFAULT_TABLE_SIZE);
		
		require(TEMPLATES_PATH."/view.php");
	}
	
	// Handle the actions for going forward a page
	function nextPage(){
		if(!isset($_SESSION['table'])){
			load();
			return;
		}
		
		$_SESSION['table']->nextPage();
		
		require(TEMPLATES_PATH."/view.php");
	}
	
	// Handle the actions for going back a page
	function backPage(){
		if(!isset($_SESSION['table'])){
			load();
			return;
		}
		
		$_SESSION['table']->backPage();
		
		require(TEMPLATES_PATH."/view.php");
	}
	
	// Handle the actions for selecting a campus
	function campus(){
		// Check whether a campus ID is given
		if ( !isset($_GET['campusId']) || !$_GET['campusId'] ) {
			load();
			return;
		}
		
		header('Location: ../buildings/?campusId='.$_GET['campusId']);
	}
	
?>