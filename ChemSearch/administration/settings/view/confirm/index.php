<?php
	require("config.php");
	
	// Check if an admin is logged in
	if(!loggedIn()){
		gotoLogin();
	}
	
	// Handle the user action
	switch($action){
		case "Confirm":
			confirm();
			return;
		case "Cancel":
			goback();
			return;
		case "Return":
			goback();
			return;
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		// Check whether a campus ID is given
		if ( !isset($_SESSION['delete']) || !$_SESSION['delete'] ) {
			goback();
			return;
		}
		
		$username = $_SESSION['delete'];
		$result = "Are you sure you wish to delete ".$username."?";
		
		require(TEMPLATES_PATH."administration_confirm.php");
	}
	
	// Handle the actions for confirming the clear
	function confirm(){
		$username = $_SESSION['delete'];
		$query = "DELETE FROM administrator WHERE UserName='".$username."'";
		$_SESSION['dbi']->query($query);
		
		if ($_SESSION['username'] == $username){
			$_SESSION['username'] = "";
		}
		
		$result = "Delete successful";
		
		require(TEMPLATES_PATH."administration_results.php");
	}
	
	// Handle the actions for going back to the options page
	function goback(){
		header("Location: ../");
	}
	
?>