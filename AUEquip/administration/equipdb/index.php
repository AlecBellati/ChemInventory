<?php
	require("config.php");
	
	// Check if an admin is logged in
	if(!loggedIn()){
		gotoLogin();
	}
	
	// Handle the user action
	switch($action){
		case "add":
			addEquipmentDatabase();
			return;
		case "clear":
			clearEquipmentDatabase();
			return;
		case "export":
			exportEquipmentDatabase();
			return;
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."administration_equipdb.php");
	}
	
	// Handle the actions for adding the equipment database in the system
	function addEquipmentDatabase(){
		header("Location: ./add/");
	}
	
	// Handle the actions for clearing the equipment database in the system
	function clearEquipmentDatabase(){
		header("Location: ./clear/");
	}
	
	// Handle the actions for exporting the equipment database in the system
	function exportEquipmentDatabase(){
		header("Location: ./export/");
	}
	
?>