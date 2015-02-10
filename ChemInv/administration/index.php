<?php
	require("config.php");
	require_once CLASSES_PATH."DatabaseInterface.php";
	
	// Handle the user action
	switch($action){
		case "updateChemicalDatabase":
			updateChemicalDatabase();
			return;
		case "adminSettings":
			adminSettings();
			return;
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."/administration.php");
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