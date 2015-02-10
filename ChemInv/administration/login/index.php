<?php
	require("config.php");
	require_once CLASSES_PATH."DatabaseInterface.php";
	require_once CLASSES_PATH."ChemicalParser.php";
	
	// Start the session and database connection
	session_start();
	if (!isset($_SESSION['dbi'])){
		$_SESSION['dbi'] = new DatabaseInterface();
	}
	$_SESSION['dbi']->connect(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME, true);
	$_SESSION['pageTitle'] = "Administrator Login";
	$error = NO_ERROR;
	
	// Handle the user action
	$action = isset( $_POST['action'] ) ? $_POST['action'] : "";
	switch($action){
		case "":
			load();
			return;
		case "Login":
			login();
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