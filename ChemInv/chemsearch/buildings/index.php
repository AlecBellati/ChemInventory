<?php
	require("config.php");
	include_once(CLASSES_PATH."/chemical.php");
	require_once CLASSES_PATH."/DatabaseInterface.php";
	require_once CLASSES_PATH."/Table_BuildingList.php";
	
	// Start the session and database connection
	session_start();
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	$_SESSION['dbi']->connect(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME, true);
	$_SESSION['pageTitle'] = "View all Buildings | ChemSearch";
	
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
		case "building":
			building();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		// Setup the table
		$_SESSION['table'] = new Table_BuildingList($_SESSION['dbi'], DEFAULT_TABLE_SIZE);
		
		require(TEMPLATES_PATH."/building_view.php");
	}
	
	// Handle the actions for going forward a page
	function nextPage(){
		if(!isset($_SESSION['table'])){
			load();
			return;
		}
		
		$_SESSION['table']->nextPage();
		
		require(TEMPLATES_PATH."/building_view.php");
	}
	
	// Handle the actions for going back a page
	function backPage(){
		if(!isset($_SESSION['table'])){
			load();
			return;
		}
		
		$_SESSION['table']->backPage();
		
		require(TEMPLATES_PATH."/building_view.php");
	}
	
	// Handle the actions for selecting a building
	function building(){
		// Check whether a building ID is given
		if ( !isset($_GET['buildingId']) || !$_GET['buildingId'] ) {
			load();
			return;
		}
		
		header('Location: ./rooms/?buildingId='.$_GET['buildingId']);
	}
	
?>