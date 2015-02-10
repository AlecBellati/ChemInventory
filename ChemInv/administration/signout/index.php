<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
		case "":
			load();
			return;
		case "Return":
			goback();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		if(isset($_SESSION['username'])){
			$_SESSION['username'] = "";
			$result = "Sign out successful";
		}
		
		require(TEMPLATES_PATH."administration_results.php");
	}
	
	// Handle the actions for going back to the home page
	function goback(){
		header("Location: ".ROOT_PATH."/");
	}
?>