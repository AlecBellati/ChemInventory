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
		case "equipment":
			equipment();
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
		$table = new Table_EquipmentList($_SESSION['dbi'], DEFAULT_TABLE_SIZE);
		if (isset($_GET['roomID'])){
			$table->setRoomSearch($_GET['roomID']);
		}
		else{
			$table->setRoomSearch(null);
		}
		if (isset($_GET['functionID'])){
			$table->setFunctionSearch($_GET['functionID']);
		}
		else{
			$table->setFunctionSearch(null);
		}
		if (isset($_GET['equipmentName'])){
			$table->setEquipmentSearch($_GET['equipmentName']);
		}
		else{
			$table->setEquipmentSearch("");
		}
		
		$_SESSION['table'] = $table;
		require(TEMPLATES_PATH."view.php");
	}
	
	// Handle the actions for going forward a page
	function nextPage(){
		if(!isset($_SESSION['table'])){
			load();
			return;
		}
		
		$_SESSION['table']->nextPage();
		
		require(TEMPLATES_PATH."view.php");
	}
	
	// Handle the actions for going back a page
	function backPage(){
		if(!isset($_SESSION['table'])){
			load();
			return;
		}
		
		$_SESSION['table']->backPage();
		
		require(TEMPLATES_PATH."view.php");
	}
	
	// Handle the actions for selecting an equipment
	function equipment(){
		// Check whether a room ID is given
		if ( !isset($_GET['equipmentID']) || !$_GET['equipmentID'] ) {
			load();
			return;
		}
		
		header('Location: view/?equipmentID='.$_GET['equipmentID']);
	}
	
	// Handle the actions for going back to the search page
	function goback(){
		header("Location: ../");
	}
	
?>