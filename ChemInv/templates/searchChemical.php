<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	
	// Alert the user they must search if necessary
	if (isset($_SESSION['missingSearch']) && $_SESSION['missingSearch'] == true){
		$_SESSION['missingSearch'] = false;
		echo 'Please enter a chemical and room before searching<br />';
	}
	
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