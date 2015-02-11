<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	echo '<form method="GET">';
	
	echo inputButton("action","Add a new administrator");
	echo '<br />';
	echo inputButton("action","View administrators");
	echo '<br />';
	echo inputButton("action","Change password");
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>