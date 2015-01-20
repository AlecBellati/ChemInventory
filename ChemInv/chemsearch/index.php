<?php
	require("config.php");
	include_once(CLASSES_PATH."/chemical.php");
	require_once CLASSES_PATH."/DatabaseInterface.php";
	require_once CLASSES_PATH."/ChemicalParser.php";
	
	// Start the session and database connection
	session_start();
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	$_SESSION['dbi']->connect(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME, true);
	$_SESSION['pageTitle'] = "Search Chemicals | ChemSearch";
	
	// Handle the user action
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	switch($action){
		case "":
			load();
			return;
		case "search":
			search();
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
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."/chemical_search.php");
	}
	
	// Handle the actions when the user searches
	function search(){
		// Ensure that results are retrieved
		if ((!isset($_POST['chemicalName']) || !isset($_POST['room']))
		||	($_POST['chemicalName'] == "" && $_POST['room'] == "")){
			// Head to the results page
			header("Location: ./?error=1");
			return;
		}
		
		// Head to the results page
		header("Location: ./results/?chemicalName=".$_POST['chemicalName']."&room=".$_POST['room']);
	}
	
	// Handle the actions for going to the view chemicals page
	function viewChemicals(){
		// Head to the results page
		header("Location: ./chemicals/");
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
	
?>