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
	$_SESSION['pageTitle'] = "Administrator Signout";
	$error = NO_ERROR;
	
	// Handle the user action
	$action = isset( $_POST['action'] ) ? $_POST['action'] : "";
	switch($action){
		case "":
			load();
			return;
		case "Return":
			goback();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		if(isset($_SESSION['username'])){
			$_SESSION['username'] = "";
			$result = "Sign out successful";
		}
		
		require(TEMPLATES_PATH."administration_results.php");
	}
	
	// Handle the actions for going back to the home page
	function goback(){
		header("Location: ".ROOT_PATH."/");
	}
?>