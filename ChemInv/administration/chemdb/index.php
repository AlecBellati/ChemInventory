<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
		case "Add Chemical Database":
			addChemicalDatabase();
			return;
		case "Clear Chemical Database":
			clearChemicalDatabase();
			return;
		case "Export Chemical Database":
			exportChemicalDatabase();
			return;
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."/administration_chemdb.php");
	}
	
	// Handle the actions for adding the chemical database in the system
	function addChemicalDatabase(){
		header("Location: ./add/");
	}
	
	// Handle the actions for clearing the chemical database in the system
	function clearChemicalDatabase(){
		header("Location: ./clear/");
	}
	
	// Handle the actions for exporting the chemical database in the system
	function exportChemicalDatabase(){
		header("Location: ./export/");
	}
	
	
?>