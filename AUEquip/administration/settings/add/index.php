<?php
	require("config.php");
	
	// Check if an admin is logged in
	if(!loggedIn() && $_SESSION['username'] != "temp"){
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
		require(TEMPLATES_PATH."/administration_add_administrator.php");
	}
	
	// Handle the actions for confirming the form
	function confirm(){
		// Check the username entered
		if(!isset($_POST['username']) || $_POST['username'] == ""){
			$error = USERNAME_MISSING;
			require(TEMPLATES_PATH."/administration_add_administrator.php");
		}
		else if(strlen($_POST['username']) < 8 || strlen($_POST['username']) > 20){
			$error = USERNAME_WRONGSIZE;
			require(TEMPLATES_PATH."/administration_add_administrator.php");
		}
		else if(!ctype_alnum($_POST['username'])){
			$error = USERNAME_WRONGCHAR;
			require(TEMPLATES_PATH."/administration_add_administrator.php");
		}
		// Check the first name entered
		else if(!isset($_POST['firstname']) || $_POST['firstname'] == ""){
			$error = FIRSTNAME_MISSING;
			require(TEMPLATES_PATH."/administration_add_administrator.php");
		}
		else if(!ctype_alnum($_POST['firstname'])){
			$error = FIRSTNAME_WRONGCHAR;
			require(TEMPLATES_PATH."/administration_add_administrator.php");
		}
		// Check the last name entered
		else if(!isset($_POST['lastname']) || $_POST['lastname'] == ""){
			$error = LASTNAME_MISSING;
			require(TEMPLATES_PATH."/administration_add_administrator.php");;
		}
		else if(!ctype_alnum($_POST['lastname'])){
			$error = LASTNAME_WRONGCHAR;
			require(TEMPLATES_PATH."/administration_add_administrator.php");;
		}
		// Check the password entered
		else if(!isset($_POST['password']) || $_POST['password'] == "" || !isset($_POST['passwordConfirm'])){
			$error = PASSWORD_MISSING;
			require(TEMPLATES_PATH."/administration_add_administrator.php");;
		}
		else if($_POST['password'] != $_POST['passwordConfirm']){
			$error = PASSWORD_NOMATCH;
			require(TEMPLATES_PATH."/administration_add_administrator.php");;
		}
		else if(strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20){
			$error = PASSWORD_WRONGSIZE;
			require(TEMPLATES_PATH."/administration_add_administrator.php");;
		}
		else if(!ctype_alnum($_POST['password'])){
			$error = PASSWORD_WRONGCHAR;
			require(TEMPLATES_PATH."/administration_add_administrator.php");;
		}
		
		else {
			$username = $_POST['username'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$password = $_POST['password'];
			
			// Check this user does not already exist
			$query = "SELECT COUNT(*) FROM administrator WHERE UserName='".$username."'";
			$result = $_SESSION['dbi']->query($query);
			if(mysql_result($result,0) > 0){
				$error = USERNAME_TAKEN;
				require(TEMPLATES_PATH."administration_add_administrator.php");
			}
			// Add the user
			else{
				$query = "INSERT INTO Administrator (UserName, Password, FirstName, LastName)";
				$query .= " VALUES('".$username."','".$password."','".$firstname."','".$lastname."')";
				$_SESSION['dbi']->query($query);
				
				$result = "Administrator successfully added.";
				require(TEMPLATES_PATH."administration_results.php");
			}
		}
	}
	
	// Handle the actions for going back to the options page
	function goback(){
		header("Location: ../");
	}
	
?>