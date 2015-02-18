<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once FUNCTIONS_PATH."markup_funcs.php";
	
	// Alert the user they must search if necessary
	if (isset($_GET['error']) && $_GET['error'] == 1){
		echo 'Please enter a equipment or room before searching<br />';
	}
	
	// Form to search for a chemical
	echo '<form method="POST" action="./?action=search">';
	
	echo inputText('Equipment: ','equipmentName','40','');
	echo '<br />';
	echo inputText('Room: ','roomName','20','');
	echo '<br />';
	echo inputButton('button','Search');
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>