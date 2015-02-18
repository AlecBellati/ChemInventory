<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
		default:
			homepage();
			return;
	}
	
	// Handle the actions for going to the homepage
	function homepage(){
		require(TEMPLATES_PATH."/homepage.php");
	}
	
?>