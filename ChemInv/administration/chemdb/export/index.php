<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
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
		default:
			load();
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