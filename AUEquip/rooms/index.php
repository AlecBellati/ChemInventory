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
		case "room":
			room();
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
		$table = new Table_RoomList($_SESSION['dbi'], DEFAULT_TABLE_SIZE);
		if (isset($_GET['buildingId'])){
			$table->setBuildingSearch($_GET['buildingId']);
		}
		else{
			$table->setBuildingSearch(null);
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
	
	// Handle the actions for selecting a room
	function room(){
		// Check whether a room ID is given
		if ( !isset($_GET['roomId']) || !$_GET['roomId'] ) {
			load();
			return;
		}
		
		header('Location: '.ROOT_PATH.'equipment/?roomId='.$_GET['roomId']);
	}
	
	// Handle the actions for going back to the search page
	function goback(){
		header("Location: ../");
	}
	
?>