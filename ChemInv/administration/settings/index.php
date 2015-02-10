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
		require(TEMPLATES_PATH."/administration_settings.php");
	}
	
?>