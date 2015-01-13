<?php
	require("config.php");
	include_once(CLASSES_PATH."/chemical.php");
	require_once FUNCTIONS_PATH."/db_funcs.php";
	
	session_start();
	databaseConnect();
	
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
		else if (!isset($_SESSION["chemicalName"]) || !isset($_SESSION["room"])){
			searchChemical();
			return;
		}
		
		// Check if the search input is valid
		if ($_SESSION["chemicalName"] == "" && $_SESSION["room"] == ""){
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
	
	// Handle the actions for going to a chemical page
	function chemical(){
		// Check whether a chemical ID is given
		if ( !isset($_GET['chemicalId']) || !$_GET['chemicalId'] ) {
			viewChemicals();
			return;
		}
		
		// Check there is a set return page
		if ( !isset($_SESSION["return"]) || !$_SESSION['return'] ) {
			$_SESSION['return'] = "./?action=viewChemicals";
		}
		
		
		$chemical = new Chemical();
		$chemical->setByID($_GET["chemicalId"]);
		$_SESSION['chemical'] = $chemical;
		$_SESSION['pageTitle'] = $_SESSION['chemical']->getChemicalName()." | ChemSearch";
		require(TEMPLATES_PATH."/chemical.php");
	}
	
?>