<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		// Check whether a equipment ID is given
		if ( !isset($_GET['equipmentID']) || !$_GET['equipmentID'] ) {
			header("Location: ../");
			return;
		}
		
		require(TEMPLATES_PATH."/equipment_page.php");
	}
	
?>