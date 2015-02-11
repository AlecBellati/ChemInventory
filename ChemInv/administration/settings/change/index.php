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
		require(TEMPLATES_PATH."/administration_change.php");
	}
	
	// Handle the actions for confirming the form
	function confirm(){
		// Check the password entered
		if(!isset($_POST['passwordOld']) || $_POST['passwordOld'] == ""
		|| !isset($_POST['password']) || $_POST['password'] == ""
		|| !isset($_POST['passwordConfirm'])){
			$error = PASSWORD_MISSING;
			require(TEMPLATES_PATH."/administration_change.php");
		}
		else if($_POST['password'] != $_POST['passwordConfirm']){
			$error = PASSWORD_NOMATCH;
			require(TEMPLATES_PATH."/administration_change.php");
		}
		else if(strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20){
			$error = PASSWORD_WRONGSIZE;
			require(TEMPLATES_PATH."/administration_change.php");
		}
		else if(!ctype_alnum($_POST['password'])){
			$error = PASSWORD_WRONGCHAR;
			require(TEMPLATES_PATH."/administration_change.php");
		}
		
		else {
			$username = $_SESSION['username'];
			$passwordOld = $_POST['passwordOld'];
			$password = $_POST['password'];
			
			// Check if the correct old password was entered
			$query = "SELECT COUNT(*) FROM administrator WHERE UserName='".$username."' AND Password='".$passwordOld."'";
			$result = $_SESSION['dbi']->query($query);
			if(mysql_result($result,0) < 1){
				$error = WRONG_PASSWORD;
				require(TEMPLATES_PATH."administration_change.php");
			}
			// Change the password
			else{
				$query = "UPDATE Administrator SET Password='".$password."'";
				$query .= " WHERE UserName='".$username."'";
				
				$_SESSION['dbi']->query($query);
				
				$result = "Password successfully changed.";
				require(TEMPLATES_PATH."administration_results.php");
			}
		}
	}
	
	// Handle the actions for going back to the options page
	function goback(){
		header("Location: ../");
	}
	
?>