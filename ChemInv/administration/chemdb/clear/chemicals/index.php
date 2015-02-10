<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
		case "":
			load();
			return;
		case "Confirm":
			confirm();
			return;
		case "Cancel":
			goback();
			return;
		case "Return":
			goback();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."administration_clear_confirm.php");
	}
	
	// Handle the actions for confirming the clear
	function confirm(){
		$_SESSION['dbi']->deleteChemicals();
		
		$result = "Clear successful";
		
		require(TEMPLATES_PATH."administration_results.php");
	}
	
	// Handle the actions for going back to the options page
	function goback(){
		header("Location: ../../");
	}
	
?>