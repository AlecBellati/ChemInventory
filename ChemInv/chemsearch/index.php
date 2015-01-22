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
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."/chemsearch.php");
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
		// Head to the chemicals page
		header("Location: ./chemicals/");
	}
	
	// Handle the actions for going to the view buildings page
	function viewBuildings(){
		// Head to the buildings page
		header("Location: ./buildings/");
	}
	
?>