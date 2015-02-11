<?php
	require("config.php");
	
	// Check if an admin is logged in
	if(!loggedIn()){
		gotoLogin();
	}
	
	// Handle the user action
	switch($action){
		case "Add a new administrator":
			add();
			return;
		case "View administrators":
			view();
			return;
		case "Change password":
			change();
			return;
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."/administration_settings.php");
	}
	
	// Handle the actions for going to the add page
	function add(){
		header("Location: ./add/");
	}
	
	// Handle the actions for going to the view page
	function view(){
		header("Location: ./view/");
	}
	// Handle the actions for going to the change page
	function change(){
		header("Location: ./change/");
	}
	
?>