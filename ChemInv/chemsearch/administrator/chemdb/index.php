<?php
	require("config.php");
	require_once CLASSES_PATH."DatabaseInterface.php";
	require_once CLASSES_PATH."ChemicalParser.php";
	
	// Start the session and database connection
	session_start();
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	$_SESSION['dbi']->connect(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME, true);
	$_SESSION['pageTitle'] = "Chemical Database";
	
	// Handle the user action
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	switch($action){
		case "":
			load();
			return;
		case "Clear Chemical Database":
			clearChemicalDatabase();
			return;
		case "Export Chemical Database":
			exportChemicalDatabase();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."/administrator_chemdb.php");
	}
	
	// Handle the actions for clearing the chemical database in the system
	function clearChemicalDatabase(){
		$_SESSION['dbi']->setupDatabase();
		
		load();
	}
	
	// Handle the actions for exporting the chemical database in the system
	function exportChemicalDatabase(){
		load();
	}
	
	
?>