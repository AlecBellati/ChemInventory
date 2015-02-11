<?php
	require("config.php");
	
	// Check if an admin is logged in
	if(!loggedIn()){
		gotoLogin();
	}
	
	// Handle the user action
	switch($action){
		case "Next":
			nextPage();
			return;
		case "Back":
			backPage();
			return;
		case "delete":
			delete();
			return;
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		// Setup the table
		$_SESSION['table'] = new Table_AdministratorList($_SESSION['dbi'], DEFAULT_TABLE_SIZE);
		
		require(TEMPLATES_PATH."/view.php");
	}
	
	// Handle the actions for going forward a page
	function nextPage(){
		if(!isset($_SESSION['table'])){
			load();
			return;
		}
		
		$_SESSION['table']->nextPage();
		
		require(TEMPLATES_PATH."/view.php");
	}
	
	// Handle the actions for going back a page
	function backPage(){
		if(!isset($_SESSION['table'])){
			load();
			return;
		}
		
		$_SESSION['table']->backPage();
		
		require(TEMPLATES_PATH."/view.php");
	}
	
	// Handle the actions for deleting a user
	function delete(){
		// Check whether a campus ID is given
		if ( !isset($_GET['username']) || !$_GET['username'] ) {
			load();
			return;
		}
		
		$_SESSION['delete'] = $_GET['username'];
		
		header("Location: ./confirm/");
	}
	
?>