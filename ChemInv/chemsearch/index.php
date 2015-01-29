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
	$_SESSION['pageTitle'] = "Search Chemicals";
	
	// Handle the user action
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	switch($action){
		case "":
			load();
			return;
		case "search":
			search();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."/chemsearch.php");
	}
	
	// Handle the actions when the user searches
	function search(){
		// Ensure that results are retrieved
		if ((!isset($_POST['chemicalName']) || !isset($_POST['roomName']))
		||	($_POST['chemicalName'] == "" && $_POST['roomName'] == "")){
			// Head to the results page
			header("Location: ./?error=1");
			return;
		}
		
		// Head to the results page
		header("Location: ./chemicals/?chemicalName=".$_POST['chemicalName']."&roomName=".$_POST['roomName']);
	}
	
?>