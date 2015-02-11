<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once FUNCTIONS_PATH."markup_funcs.php";
	
	if(isset($error) && $error != NO_ERROR){
		if($error == PASSWORD_MISSING){
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
		else if($error == WRONG_PASSWORD){
			echo 'Incorrect current password, please try again.';
		}
		
		echo '<br />';
		echo '<br />';
		echo '<br />';
	}
	
	
	// Form to change a password
	echo '<form method="POST"';
	
	echo '<div id="note">Password must be between 8-20 characters and contain only alphanumeric characters.';
	echo '<br />';
	echo '<br />';
	echo inputPassword('Old Password:','passwordOld','20','');
	echo '<br />';
	echo '<br />';
	echo inputPassword('Password:','password','20','');
	echo '<br />';
	echo '<br />';
	echo inputPassword('Confirm Password:','passwordConfirm','20','');
	echo '<br />';
	echo '<br />';
	echo '<br />';
	echo '<br />';
	echo inputButton('action','Confirm');
	echo inputButton('action','Cancel');
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>