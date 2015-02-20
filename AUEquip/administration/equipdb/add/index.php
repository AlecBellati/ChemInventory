<?php
	require("config.php");
		
	// Check if an admin is logged in
	if(!loggedIn()){
		gotoLogin();
	}
	
	// Handle the user action
	switch($action){
		case "Add":
			add();
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
		require(TEMPLATES_PATH."administration_add_spreadsheet.php");
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
				$cp = new EquipmentParser($_SESSION['dbi']);
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