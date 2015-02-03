<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	echo '<form method="POST" action="add/" enctype="multipart/form-data">';
	
	echo inputFile("spreadsheet");
	echo '<br />';
	echo inputButton("submit","Add Chemical Database");
	echo '<br />';
	
	echo '</form>';
	echo '<form method="GET">';
	
	echo inputButton("action","Clear Chemical Database");
	echo '<br />';
	echo inputButton("action","Export Chemical Database");
	
	echo '</form>';
	
	
	include TEMPLATES_PATH."include/footer.php";
?>