<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
		case "All":
			all();
			return;
		case "Chemicals":
			chemicals();
			return;
		case "Cancel":
			goback();
			return;
		default:
			load();
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