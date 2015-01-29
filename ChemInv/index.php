<?php
	require("config.php");
	require_once CLASSES_PATH."/DatabaseInterface.php";
	require_once CLASSES_PATH."/ChemicalParser.php";
	
	// Start the session and database connection
	session_start();
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	$_SESSION['dbi']->connect(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME, true);
	$_SESSION['pageTitle'] = "Home";
	
	// Handle the user action
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	switch($action){
		case "":
			homepage();
			return;
		case "updateChemicalDatabase":
			updateChemicalDatabase();
			return;
		case "searchChemical":
			searchChemical();
			return;
	}
	
	// Handle the actions for going to the homepage
	function homepage(){
		require(TEMPLATES_PATH."/homepage.php");
	}
	
	// Handle the actions for updating the chemical database on the homepage
	function updateChemicalDatabase(){
		$_SESSION['dbi']->setupDatabase();
		$cp = new ChemicalParser($_SESSION['dbi']);
		$cp->parseData("data/ChemicalDatabase.xlsx");
		
		require(TEMPLATES_PATH."/homepage.php");
	}
	
	// Handle the actions for going to the search chemicals page
	function searchChemical(){
		header("Location: ./chemsearch/");
	}
	
?>