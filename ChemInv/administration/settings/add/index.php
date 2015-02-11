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
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."/administration_add_administrator.php");
	}
	
	// Handle the actions for confirming the form
	function confirm(){
		/*$username = $_SESSION['delete'];
		$query = "DELETE FROM administrator WHERE UserName='".$username."'";
		$_SESSION['dbi']->query($query);
		
		if ($_SESSION['username'] == $username){
			$_SESSION['username'] = "";
		}
		*/
		$result = "Delete successful";
		
		require(TEMPLATES_PATH."administration_results.php");
	}
	
	// Handle the actions for going back to the options page
	function goback(){
		header("Location: ../");
	}
	
?>