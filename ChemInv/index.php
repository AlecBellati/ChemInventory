<?php
	require("config.php");
	include_once(CLASSES_PATH."/chemical.php");
	require_once CLASSES_PATH."/DatabaseInterface.php";
	
	// Start the session and database connection
	session_start();
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	$_SESSION['dbi']->connect(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME, true);
	
	// Handle the user action
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	switch($action){
		case "":
			homepage();
			return;
		case "searchChemical":
			searchChemical();
			return;
		case "resultsChemical":
			resultsChemical();
			return;
		case "viewChemicals":
			viewChemicals();
			return;
		case "viewBuildings":
			viewBuildings();
			return;
		case "viewRooms":
			viewRooms();
			return;
		case "room":
			room();
			return;
		case "chemical":
			chemical();
			return;
	}
	
	// Handle the actions for going to the homepage
	function homepage(){
		$_SESSION['pageTitle'] = "Home | ChemSearch";
		require(TEMPLATES_PATH."/homepage.php");
	}
	
	// Handle the actions for going to the search chemicals page
	function searchChemical(){
		$_SESSION['pageTitle'] = "Search Chemicals | ChemSearch";
		require(TEMPLATES_PATH."/searchChemical.php");
	}
	
	// Handle the actions for going to the chemical results page
	function resultsChemical(){
		// Ensure that results are retrieved
		if (isset($_POST["chemicalName"]) && isset($_POST["room"])){
			$_SESSION['chemicalName'] = $_POST["chemicalName"];
			$_SESSION['room'] = $_POST["room"];
		}
		else if (!isset($_SESSION['chemicalName']) || !isset($_SESSION['room'])){
			searchChemical();
			return;
		}
		
		// Check if the search input is valid
		if ($_SESSION['chemicalName'] == "" && $_SESSION['room'] == ""){
			$_SESSION['missingSearch'] = true;
			searchChemical();
			return;
		}
		
		// Parse any actions pertaining to button input
		if (isset($_POST["button"])){
			// Go back a page in the results
			if ($_POST["button"] == "Back"){
				$_SESSION['resultsStart'] -= $_SESSION['resultsSize'];
			}
			// Go to the next page in the results
			else if ($_POST["button"] == "Next"){
				$_SESSION['resultsStart'] += $_SESSION['resultsSize'];
			}
			// Reset the search results page if a new search has been made
			else if ($_POST["button"] != "Return"){
				$_SESSION['resultsStart'] = 0;
				$_SESSION['resultsSize'] = DEFAULT_RESULTS_SIZE;
			}
		}
		
		$_SESSION['return'] = "./?action=resultsChemical";
		$_SESSION['pageTitle'] = "Results | ChemSearch";
		require(TEMPLATES_PATH."/resultsChemical.php");
	}
	
	// Handle the actions for going to the view chemicals page
	function viewChemicals(){
		// Parse any actions pertaining to button input
		if (isset($_POST["button"])){
			// Go back a page in the results
			if ($_POST["button"] == "Back"){
				$_SESSION['resultsStart'] -= $_SESSION['resultsSize'];
			}
			// Go to the next page in the results
			else if ($_POST["button"] == "Next"){
				$_SESSION['resultsStart'] += $_SESSION['resultsSize'];
			}
			// Reset the search results page if a new search has been made
			else if ($_POST["button"] != "Return"){
				$_SESSION['resultsStart'] = 0;
				$_SESSION['resultsSize'] = DEFAULT_RESULTS_SIZE;
			}
			
		}
		
		$_SESSION['return'] = "./?action=viewChemicals";
		$_SESSION['pageTitle'] = "Chemicals | ChemSearch";
		require(TEMPLATES_PATH."/viewChemicals.php");
	}
	
	// Handle the actions for going to the view buildings page
	function viewBuildings(){
		// Parse any actions pertaining to button input
		if (isset($_POST["button"])){
			// Go back a page in the results
			if ($_POST["button"] == "Back"){
				$_SESSION['buildingsStart'] -= $_SESSION['buildingsSize'];
			}
			// Go to the next page in the results
			else if ($_POST["button"] == "Next"){
				$_SESSION['buildingsStart'] += $_SESSION['buildingsSize'];
			}
			// Reset the start of the table if it has been just opened
			else if ($_POST["button"] != "Return"){
				$_SESSION['buildingsStart'] = 0;
				$_SESSION['buildingsSize'] = DEFAULT_RESULTS_SIZE;
			}
			
		}
		
		$_SESSION['pageTitle'] = "Buildings | ChemSearch";
		require(TEMPLATES_PATH."/viewBuildings.php");
	}
	
	// Handle the actions for going to the view rooms page
	function viewRooms(){
		// Ensure that results are retrieved
		if (isset($_GET["BuildingName"])){
			$_SESSION['building'] = $_GET["BuildingName"];
		}
		else if (!isset($_SESSION['building'])){
			viewBuildings();
			return;
		}
		
		// Check if a building is given
		if ($_SESSION['building'] == ""){
			viewBuildings();
			return;
		}
		
		// Parse any actions pertaining to button input
		if (isset($_POST["button"])){
			// Go back a page in the results
			if ($_POST["button"] == "Back"){
				$_SESSION['roomsStart'] -= $_SESSION['roomsSize'];
			}
			// Go to the next page in the results
			else if ($_POST["button"] == "Next"){
				$_SESSION['roomsStart'] += $_SESSION['roomsSize'];
			}
		}
		// Reset the start of the table if it has been just opened
		else{
			$_SESSION['roomsStart'] = 0;
			$_SESSION['roomsSize'] = DEFAULT_RESULTS_SIZE;
		}
		
		$_SESSION['return'] = "./?action=viewRooms";
		$_SESSION['pageTitle'] = "Rooms | ChemSearch";
		require(TEMPLATES_PATH."/viewRooms.php");
	}
	
	// Handle the actions for going to the room page
	function room(){
		// Ensure that results are retrieved
		if (isset($_GET["roomName"])){
			$_SESSION['room'] = $_GET["roomName"];
		}
		else if (!isset($_SESSION['room'])){
			viewRooms();
			return;
		}
		
		// Check if a room is given
		if ($_SESSION['room'] == ""){
			viewRooms();
			return;
		}
		
		// Parse any actions pertaining to button input
		if (isset($_POST["button"])){
			// Go back a page in the results
			if ($_POST["button"] == "Back"){
				$_SESSION['resultsStart'] -= $_SESSION['resultsSize'];
			}
			// Go to the next page in the results
			else if ($_POST["button"] == "Next"){
				$_SESSION['resultsStart'] += $_SESSION['resultsSize'];
			}
		}
		// Reset the start of the table if it has been just opened
		else{
			$_SESSION['resultsStart'] = 0;
			$_SESSION['resultsSize'] = DEFAULT_RESULTS_SIZE;
		}
		
		$_SESSION['return'] = "./?action=room";
		$_SESSION['pageTitle'] = "Results | ChemSearch";
		require(TEMPLATES_PATH."/room.php");
	}
	
	// Handle the actions for going to a chemical page
	function chemical(){
		// Check whether a chemical ID is given
		if ( !isset($_GET['chemicalId']) || !$_GET['chemicalId'] ) {
			viewChemicals();
			return;
		}
		
		// Check there is a set return page
		if ( !isset($_SESSION['return']) || !$_SESSION['return'] ) {
			$_SESSION['return'] = "./?action=viewChemicals";
		}
		
		
		$chemical = new Chemical($_SESSION['dbi']);
		$chemical->setByID($_GET["chemicalId"]);
		$_SESSION['chemical'] = $chemical;
		$_SESSION['pageTitle'] = $_SESSION['chemical']->getChemicalName()." | ChemSearch";
		require(TEMPLATES_PATH."/chemical.php");
	}
	
?>