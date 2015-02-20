<?php
	require("config.php");
	require_once CLASSES_PATH."DatabaseInterface.php";
	
	// Check if an admin is logged in
	if(!loggedIn()){
		gotoLogin();
	}
	
	// Handle the user action
	switch($action){
		case "updateEquipmentDatabase":
			updateEquipmentDatabase();
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
	
	// Handle the actions for heading to the equipment database settings page
	function updateEquipmentDatabase(){
		header("Location: ./equipdb/");
	}
	
	// Handle the actions for heading to the admin settings page
	function adminSettings(){
		header("Location: ./settings/");
	}
	
?>