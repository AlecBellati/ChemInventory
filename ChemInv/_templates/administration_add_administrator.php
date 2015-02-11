<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once FUNCTIONS_PATH."markup_funcs.php";
	
	if(isset($error) && $error != NO_ERROR){
		if($error == USERNAME_MISSING){
			echo 'Please enter a username.';
		}
		else if($error == USERNAME_WRONGSIZE){
			echo 'Please enter a username between 8 and 20 characters.';
		}
		else if($error == USERNAME_WRONGCHAR){
			echo 'Please enter a username that contains only alphanumeric characters.';
		}
		else if($error == USERNAME_TAKEN){
			echo 'Sorry, that username is taken. Please enter another username.';
		}
		else if($error == FIRSTNAME_MISSING){
			echo 'Please enter a first name.';
		}
		else if($error == FIRSTNAME_WRONGCHAR){
			echo 'Please enter a first name that contains only alphanumeric characters.';
		}
		else if($error == LASTNAME_MISSING){
			echo 'Please enter a last name.';
		}
		else if($error == LASTNAME_WRONGCHAR){
			echo 'Please enter a last name that contains only alphanumeric characters.';
		}
		else if($error == PASSWORD_MISSING){
			echo 'Please enter a password.';
		}
		else if($error == PASSWORD_NOMATCH){
			echo 'Both passwords do not match, please re-enter your password.';
		}
		else if($error == PASSWORD_WRONGSIZE){
			echo 'Please enter a password between 8 and 20 characters.';
		}
		else if($error == PASSWORD_WRONGCHAR){
			echo 'Please enter a password that contains only alphanumeric characters.';
		}
		
		echo '<br />';
		echo '<br />';
		echo '<br />';
	}
	
	// Get the previously entered fields if applicable
	if (isset($_POST['username'])){
		$username = $_POST['username'];
	}
	else{
		$username = "";
	}
	if (isset($_POST['firstname'])){
		$firstname = $_POST['firstname'];
	}
	else{
		$firstname = "";
	}
	if (isset($_POST['lastname'])){
		$lastname = $_POST['lastname'];
	}
	else{
		$lastname = "";
	}
	
	// Form to add an administrator
	echo '<form method="POST"';
	
	echo inputText('Username','username','20',$username);
	echo '<br />';
	echo '<div id="note">Username must be between 8-20 characters and contain only alphanumeric characters.</div>';
	echo '<br />';
	echo inputText('First Name:','firstname','20',$firstname);
	echo '<br />';
	echo '<br />';
	echo inputText('Last Name:','lastname','20',$lastname);
	echo '<br />';
	echo '<br />';
	echo inputPassword('Password:','password','20','');
	echo '<br />';
	echo '<br />';
	echo inputPassword('Confirm Password:','passwordConfirm','20','');
	echo '<br />';
	echo '<div id="note">Password must be between 8-20 characters and contain only alphanumeric characters.';
	echo '<br />';
	echo '<br />';
	echo '<br />';
	echo inputButton('action','Confirm');
	echo inputButton('action','Cancel');
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>