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
	$_SESSION['pageTitle'] = "Add Chemical Database";
	$error = NO_ERROR;
	$result = "";
	
	// Handle the user action
	$action = isset( $_POST['action'] ) ? $_POST['action'] : "";
	switch($action){
		case "":
			load();
			return;
		case "Add":
			add();
			return;
		case "Cancel":
			goback();
			return;
		case "Return":
			goback();
			return;
	}
	
	// Handle the actions for arriving at the page
	function load(){
		require(TEMPLATES_PATH."administration_add.php");
	}
	
	// Handle the actions for adding the spreadsheet
	function add(){
		set_time_limit(0);
		$error = NO_ERROR;
		$target_file = TMP_PATH . basename($_FILES['spreadsheet']['name']);
		$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check the file type
		if($fileType != "xlsx") {
			$error = UPLOAD_WRONG_FILETYPE;
		}
		
		// Check if there is not an error
		if ($error == NO_ERROR){
			if (move_uploaded_file($_FILES['spreadsheet']['tmp_name'], $target_file)) {
				$cp = new ChemicalParser($_SESSION['dbi']);
				$cp->parseData($target_file);
				
				$result = "Add successful";
			}
		}
		
		require(TEMPLATES_PATH."administration_results.php");
	}
	
	// Handle the actions for going back to the previous page
	function goback(){
		header("Location: ../");
	}
	
?>