<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	echo '<form method="GET">';
	
	echo inputFile("spreadsheet");
	echo '<br />';
	echo inputButton("action","Add Chemical Database");
	echo '<br />';
	echo inputButton("action","Clear Chemical Database");
	echo '<br />';
	echo inputButton("action","Export Chemical Database");
	
	echo '</form>';
	
	
	include TEMPLATES_PATH."include/footer.php";
?>