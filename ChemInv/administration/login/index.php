<?php
	require("config.php");
	
	// Handle the user action
	switch($action){
		case "Login":
			login();
			return;
		default:
			load();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."administration_login.php");
	}
	
	// Handle the actions for logging in
	function login(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		// Find if this user exists and the password is correct
		$query = "SELECT COUNT(*)";
		$query .= " FROM administrator";
		$query .= " WHERE UserName='".$username."'";
		$query .= " AND Password='".$password."'";
		$result = $_SESSION['dbi']->query($query);
		$size = mysql_result($result,0);
		
		if ($size != 0){
			$_SESSION['username'] = $username;
			header("Location: ../");
		}
		else {
			$error = INVALID_USERNAME;
		}
		
		require(TEMPLATES_PATH."administration_login.php");
	}
?>