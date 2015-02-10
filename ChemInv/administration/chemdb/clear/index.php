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
		case "All":
			all();
			return;
		case "Chemicals":
			chemicals();
			return;
		case "Cancel":
			goback();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."administration_clear.php");
	}
	
	// Handle the actions for requesting to clear all
	function all(){
		header("Location: ./all/");
	}
	
	// Handle the actions for requesting to clear chemicals
	function chemicals(){
		header("Location: ./chemicals/");
	}
	
	// Handle the actions for going back to the options page
	function goback(){
		header("Location: ../");
	}
	
?>