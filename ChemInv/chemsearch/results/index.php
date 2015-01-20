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
	$_SESSION['pageTitle'] = "Results | ChemSearch";
	
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
		case "Return":
			searchChemical();
			return;
		case "chemical":
			chemical();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		// Ensure that results are retrieved
		if (!isset($_GET["chemicalName"]) || !isset($_GET["room"])){
			header("Location: ../?error=1");
			return;
		}
		
		// Setup the results table size
		$_SESSION['tablePage'] = 1;
		
		require(TEMPLATES_PATH."/chemical_results.php");
	}
	
	// Handle the actions for going forward a page
	function nextPage(){
		if(isset($_SESSION['tablePage'])){
			$_SESSION['tablePage']++;
		}
		else{
			$_SESSION['tablePage'] = 1;
		}
		
		require(TEMPLATES_PATH."/chemical_results.php");
	}
	
	// Handle the actions for going back a page
	function backPage(){
		if(isset($_SESSION['tablePage'])){
			$_SESSION['tablePage']--;
		}
		else{
			$_SESSION['tablePage'] = 1;
		}
		
		require(TEMPLATES_PATH."/chemical_results.php");
	}
	
	// Handle the actions for going to the search chemicals page
	function searchChemical(){
		header("Location: ../");
	}
	
	// Handle the actions for going to a chemical page
	function chemical(){
		// Check whether a chemical ID is given
		if ( !isset($_GET['chemicalId']) || !$_GET['chemicalId'] ) {
			load();
			return;
		}
		
		header('Location: ../chemical/?chemicalId='.$_GET['chemicalId']);
	}
	
?>