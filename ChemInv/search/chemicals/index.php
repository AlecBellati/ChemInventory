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
		case "chemical":
			chemical();
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
		// Setup the results table
		$table = new Table_ChemicalList($_SESSION['dbi'], DEFAULT_TABLE_SIZE);
		if (isset($_GET["chemicalName"])){
			$table->setChemicalNameSearch($_GET["chemicalName"]);
		}
		if (isset($_GET["roomName"])){
			$table->setRoomNameSearch($_GET["roomName"]);
		}
		if (isset($_GET["roomId"])){
			$table->setRoomIDSearch($_GET["roomId"]);
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
	
	// Handle the actions for going to a chemical page
	function chemical(){
		// Check whether a chemical ID is given
		if ( !isset($_GET['chemicalId']) || !$_GET['chemicalId'] ) {
			load();
			return;
		}
		
		header('Location: ./view/?chemicalId='.$_GET['chemicalId']);
	}
	
	// Handle the actions for going back to the search page
	function goback(){
		header("Location: ../");
	}
	
?>