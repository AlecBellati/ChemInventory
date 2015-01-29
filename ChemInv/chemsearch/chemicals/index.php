<?php
	require("config.php");
	require_once CLASSES_PATH."DatabaseInterface.php";
	require_once CLASSES_PATH."Table_ChemicalList.php";
	
	// Start the session and database connection
	session_start();
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	$_SESSION['dbi']->connect(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME, true);
	$_SESSION['pageTitle'] = "Chemicals";
	
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
		case "chemical":
			chemical();
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
	
?>