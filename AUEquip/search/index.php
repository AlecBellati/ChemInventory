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
		require(TEMPLATES_PATH."/search.php");
	}
	
	// Handle the actions when the user searches
	function search(){
		// Ensure that results are retrieved
		if ((!isset($_POST['equipmentName']) || !isset($_POST['roomName']))
		||	($_POST['equipmentName'] == "" && $_POST['roomName'] == "")){
			// Head to the results page
			header("Location: ./?error=1");
			return;
		}
		
		// Encode the searches to use html special chars
		$equipmentName = htmlspecialchars_decode($_POST['equipmentName'],ENT_QUOTES);
		$roomName = htmlspecialchars_decode($_POST['roomName'],ENT_QUOTES);
		
		// Head to the results page
		header("Location: ".ROOT_PATH."equipment/?equipmentName=".$equipmentName."&roomName=".$roomName);
	}
	
?>