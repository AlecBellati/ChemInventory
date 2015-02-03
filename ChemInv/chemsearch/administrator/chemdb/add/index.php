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
	$_SESSION['pageTitle'] = "Chemical Database";
	$_SESSION['error'] = NO_ERROR;
	
	// Handle the user action
	$action = isset( $_POST['action'] ) ? $_POST['action'] : "";
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
		set_time_limit(0);
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES['spreadsheet']['name']);
		$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check the file type
		if($fileType != "xlsx") {
			$_SESSION['error'] = UPLOAD_WRONG_FILETYPE;
		}
		
		// Check if there is not an error
		if ($_SESSION['error'] == NO_ERROR){
			if (move_uploaded_file($_FILES['spreadsheet']['tmp_name'], $target_file)) {
				$cp = new ChemicalParser($_SESSION['dbi']);
				$cp->parseData($target_file);
			}
		}
		
		require(TEMPLATES_PATH."administrator_results.php");
	}
	
	// Handle the actions for going back to the previous page
	function goback(){
		header("Location: ../");
	}
	
?>