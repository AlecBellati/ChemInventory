<?php
	require("config.php");
	
	// Check if an admin is logged in
	if(!loggedIn()){
		gotoLogin();
	}
	
	// Handle the user action
	switch($action){
		case "Confirm":
			confirm();
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
		$result = "Are you sure you wish to clear the database?";
		
		require(TEMPLATES_PATH."administration_confirm.php");
	}
	
	// Handle the actions for confirming the clear
	function confirm(){
		$_SESSION['dbi']->clearAll();
		
		$result = "Clear successful";
		
		require(TEMPLATES_PATH."administration_results.php");
	}
	
	// Handle the actions for going back to the options page
	function goback(){
		header("Location: ../../");
	}
	
?>