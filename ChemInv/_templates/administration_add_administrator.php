<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once FUNCTIONS_PATH."markup_funcs.php";
	
	
	// Form to search for a chemical
	echo '<form method="POST"';
	
	echo inputText('Username','username','20','');
	echo '<br />';
	echo '<div id="note">Username must be between 8-20 characters and not contain any special characters.</div>';
	echo '<br />';
	echo inputText('First Name:','firstname','20','');
	echo '<br />';
	echo '<br />';
	echo inputText('Last Name:','lastname','20','');
	echo '<br />';
	echo '<br />';
	echo inputPassword('Password:','password','20','');
	echo '<br />';
	echo '<br />';
	echo inputPassword('Confirm Password:','passwordConfirm','20','');
	echo '<br />';
	echo '<div id="note">Password must be between 8-20 characters and not contain any special characters.';
	echo '<br />';
	echo '<br />';
	echo '<br />';
	echo inputButton('action','Confirm');
	echo inputButton('action','Cancel');
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>