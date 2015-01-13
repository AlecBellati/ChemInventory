<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once FUNCTIONS_PATH."/db_funcs.php";
	
	// The starting page code
	databaseConnect();
	
	// Form to search for a chemical
	print '<form method="POST" action="./?action=resultsChemical" response="resultsChemical">';
	
	print inputText('Chemical: ','chemicalName','40','');
	print '<br />';
	print inputText('Room: ','room','20','');
	print '<br />';
	print inputButton('search','Search');
	
	print '</form>';
	
	include TEMPLATES_PATH."/include/footer.php";
?>