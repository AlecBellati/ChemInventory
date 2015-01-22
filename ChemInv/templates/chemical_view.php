<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once CLASSES_PATH."/Table_ChemicalList.php";
	
	$table = $_SESSION['table'];
	
	// Print the table
	echo $table->getTable();
	
	// Form to scroll the table
	echo '<br />';
	
	echo '<form method="GET">';
	
	if ($table->getPage() > 1){
		echo inputButton('action','Back');
	}
	if (!$table->endReached()){
		echo inputButton('action','Next');
	}
	
	echo '</form>';
	
	include TEMPLATES_PATH."/include/footer.php";
?>