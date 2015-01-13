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
		case "viewChemical":
			viewChemical();
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
		if (!isset($_POST["chemicalName"]) || !isset($_POST["room"])
		|| ($_POST["chemicalName"] == "" && $_POST["room"] == "")){
			searchChemical();
			return;
		}
		
		if (isset($_POST["search"]) && $_POST["search"] == "Search"){
			$_SESSION['resultsStart'] = 0;
			$_SESSION['resultsSize'] = DEFAULT_RESULTS_SIZE;
		}
		
		$_SESSION['chemicalName'] = $_POST["chemicalName"];
		$_SESSION['room'] = $_POST["room"];
		$_SESSION['pageTitle'] = "Results | ChemSearch";
		require(TEMPLATES_PATH."/resultsChemical.php");
	}
	
	// Handle the actions for going to a chemical page
	function viewChemical(){
		if ( !isset($_GET["chemicalId"]) || !$_GET["chemicalId"] ) {
			homepage();
			return;
		}
		
		$chemical = new Chemical();
		$chemical->setByID($_GET["chemicalId"]);
		$_SESSION['chemical'] = $chemical;
		$_SESSION['pageTitle'] = $_SESSION['chemical']->getChemicalName()." | ChemSearch";
		require(TEMPLATES_PATH."/viewChemical.php");
	}
	
?>