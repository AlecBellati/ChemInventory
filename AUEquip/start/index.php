<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
		case "function":
			functionSelected();
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
		require(TEMPLATES_PATH."/start.php");
	}
	
	// Handle the actions for selecting a function
	function functionSelected(){
		// Check whether a function ID is given
		if ( !isset($_GET['functionID']) || !$_GET['functionID'] ) {
			load();
			return;
		}
		
		header('Location: '.ROOT_PATH.'equipment/?functionID='.$_GET['functionID']);
	}
	
	// Handle the actions for going back to the search page
	function goback(){
		header("Location: ../");
	}
	
?>