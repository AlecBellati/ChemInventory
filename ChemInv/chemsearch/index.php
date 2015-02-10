<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
		case "search":
			search();
			return;
		case "":
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."/chemsearch.php");
	}
	
	// Handle the actions when the user searches
	function search(){
		// Ensure that results are retrieved
		if ((!isset($_POST['chemicalName']) || !isset($_POST['roomName']))
		||	($_POST['chemicalName'] == "" && $_POST['roomName'] == "")){
			// Head to the results page
			header("Location: ./?error=1");
			return;
		}
		
		// Encode the searches to use html special chars
		$chemicalName = htmlspecialchars_decode($_POST['chemicalName'],ENT_QUOTES);
		$roomName = htmlspecialchars_decode($_POST['roomName'],ENT_QUOTES);
		
		// Head to the results page
		header("Location: ./chemicals/?chemicalName=".$chemicalName."&roomName=".$roomName);
	}
	
?>