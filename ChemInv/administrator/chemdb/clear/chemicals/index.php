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
	$_SESSION['pageTitle'] = "Clear Chemical Database";
	$error = NO_ERROR;
	$result = "";
	
	// Handle the user action
	$action = isset( $_POST['action'] ) ? $_POST['action'] : "";
	switch($action){
		case "":
			load();
			return;
		case "Confirm":
			confirm();
			return;
		case "Cancel":
			goback();
			return;
		case "Return":
			goback();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."administrator_clear_confirm.php");
	}
	
	// Handle the actions for confirming the clear
	function confirm(){
		$_SESSION['dbi']->deleteChemicals();
		
		$result = "Clear successful";
		
		require(TEMPLATES_PATH."administrator_results.php");
	}
	
	// Handle the actions for going back to the options page
	function goback(){
		header("Location: ../../");
	}
	
?>