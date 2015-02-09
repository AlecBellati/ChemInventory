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
	$_SESSION['pageTitle'] = "Administrator";
	
	// Handle the user action
	$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	switch($action){
		case "":
			load();
			return;
		case "updateChemicalDatabase":
			updateChemicalDatabase();
			return;
		case "adminSettings":
			adminSettings();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."/administrator.php");
	}
	
	// Handle the actions for heading to the chemical database settings page
	function updateChemicalDatabase(){
		header("Location: ./chemdb/");
	}
	
	// Handle the actions for heading to the admin settings page
	function adminSettings(){
		header("Location: ./settings/");
	}
	
?>