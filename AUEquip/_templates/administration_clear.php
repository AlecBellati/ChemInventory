<?php
	include TEMPLATES_PATH."include/header.php";
	
	require_once(FUNCTIONS_PATH."markup_funcs.php");
	
	echo "Do you wish the clear the entire database or just the equipment?";
	
	echo '<br />';
	echo '<br />';
	
	echo '<form method="POST">';
	
	echo inputButton("action","All");
	echo ' ';
	echo inputButton("action","Equipment");
	echo ' ';
	echo inputButton("action","Cancel");
	
	echo '</form>';
	
	include TEMPLATES_PATH."include/footer.php";
?>