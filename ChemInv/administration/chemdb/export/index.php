<?php
	require("config.php");
	require_once CLASSES_PATH."DatabaseInterface.php";
	require_once CLASSES_PATH."DatabaseExporter.php";
	
	// Start the session and database connection
	session_start();
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	$_SESSION['dbi']->connect(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME, true);
	$_SESSION['pageTitle'] = "Export Chemical Database";
	$error = NO_ERROR;
	$result = "";
	
	// Handle the user action
	$action = isset( $_POST['action'] ) ? $_POST['action'] : "";
	switch($action){
		case "":
			load();
			return;
		case "Data":
			data();
			return;
		case "Template":
			template();
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
		require(TEMPLATES_PATH."administration_export.php");
	}
	
	// Handle the actions for selecting data
	function data(){
		set_time_limit(0);
		
		$exporter = new DatabaseExporter($_SESSION['dbi']);
		$exporter->createDatabase();
		
		$_SESSION['db_filename'] = "Chemical_Database.xlsx";
		require(TEMPLATES_PATH."administration_download.php");
	}
	
	// Handle the actions for selecting template
	function template(){
		set_time_limit(0);
		
		$exporter = new DatabaseExporter($_SESSION['dbi']);
		$exporter->createTemplate();
		
		$_SESSION['db_filename'] = "Chemical_Database_Template.xlsx";
		require(TEMPLATES_PATH."administration_download.php");
	}
	
	// Handle the actions for going back to the options page
	function goback(){
		header("Location: ../");
	}
	
?>