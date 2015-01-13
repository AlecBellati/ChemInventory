<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once FUNCTIONS_PATH."/db_funcs.php";
	
	// The starting page code
	databaseConnect();
	
	// Form to search for a chemical
	echo '<form method="POST" action="./?action=resultsChemical">';
	
	echo inputText('Chemical: ','chemicalName','40','');
	echo '<br />';
	echo inputText('Room: ','room','20','');
	echo '<br />';
	echo inputButton('button','Search');
	
	echo '</form>';
	
	// Go back to the homepage
	echo '<br />';
	echo '<form method="POST" action="./?action=viewChemicals">';
	
	echo inputButton('button','View all chemicals');
	
	echo '</form>';
	
	// Go back to the homepage
	echo '<br />';
	echo '<form method="POST" action="./">';
	
	echo inputButton('button','Return');
	
	echo '</form>';
	
	include TEMPLATES_PATH."/include/footer.php";
?>