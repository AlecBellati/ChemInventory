<?php
	require("config.php");
	require_once CLASSES_PATH."DatabaseInterface.php";
	require_once CLASSES_PATH."Table_RoomList.php";
	
	// Start the session and database connection
	session_start();
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	$_SESSION['dbi']->connect(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME, true);
	$_SESSION['pageTitle'] = "Rooms";
	
	// Handle the user action
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	switch($action){
		case "":
			load();
			return;
		case "Next":
			nextPage();
			return;
		case "Back":
			backPage();
			return;
		case "room":
			room();
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
		
		header('Location: ../chemicals/?roomId='.$_GET['roomId']);
	}
	
?>