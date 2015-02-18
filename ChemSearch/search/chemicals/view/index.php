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
		// Check whether a chemical ID is given
		if ( !isset($_GET['chemicalId']) || !$_GET['chemicalId'] ) {
			header("Location: ../");
			return;
		}
		
		require(TEMPLATES_PATH."/chemical_page.php");
	}
	
?>