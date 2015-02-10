<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once FUNCTIONS_PATH."markup_funcs.php";
	
	if (!isset($error)){
		$error = NO_ERROR;
	}
	
	if ($error == INVALID_USERNAME){
		echo "Username or password incorrect, please try again.";
		echo "<br />";
		echo "<br />";
	}
	
	
	// Form to search for a chemical
	echo '<form method="POST">';
	
	echo inputText('Username: ','username','20','');
	echo '<br />';
	echo inputPassword('Password: ','password','20','');
	echo '<br />';
	echo inputButton('action','Login');
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>