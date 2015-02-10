<?php
	// Check if a user is logged in
	function loggedIn(){
		if (isset($_SESSION['username']) && $_SESSION['username'] != ""){
			return true;
		}
		return false;
	}
	
	// Go to the login page
	function gotoLogin(){
		header("Location: ".ROOT_PATH."administration/login/");
	}
	
?>