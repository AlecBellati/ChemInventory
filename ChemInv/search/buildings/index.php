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
		case "building":
			building();
			return;
		case "Return":
			goback();
			return;
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		// Setup the table
		$table = new Table_BuildingList($_SESSION['dbi'], DEFAULT_TABLE_SIZE);
		if (isset($_GET['campusId'])){
			$table->setCampusSearch($_GET['campusId']);
		}
		else{
			$table->setCampusSearch(null);
		}
		
		$_SESSION['table'] = $table;
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
	
	// Handle the actions for selecting a building
	function building(){
		// Check whether a building ID is given
		if ( !isset($_GET['buildingId']) || !$_GET['buildingId'] ) {
			load();
			return;
		}
		
		header('Location: ../rooms/?buildingId='.$_GET['buildingId']);
	}
	
	// Handle the actions for going back to the search page
	function goback(){
		header("Location: ../");
	}
	
?>