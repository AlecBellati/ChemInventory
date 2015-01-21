<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once CLASSES_PATH."/Table_ChemicalList.php";
	
	$table = $_SESSION['table'];
	$chemical = $_GET["chemicalName"];
	$room = $_GET["room"];
	
	// Print the table
	echo $table->getTable();
	
	// Form to scroll the results table
	echo '<br />';
	
	echo '<form method="GET">';
	
	echo inputHidden('chemicalName', $chemical);
	echo inputHidden('room', $room);
	
	if ($table->getPage() > 1){
		echo inputButton('action','Back');
	}
	if (!$table->endReached()){
		echo inputButton('action','Next');
	}
	
	echo '</form>';
	
	// Go back to the search page
	echo '<br />';
	echo '<form method="GET">';
	echo inputButton('action','Return');
	echo '</form>';
	
	include TEMPLATES_PATH."/include/footer.php";
?>