<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once CLASSES_PATH."/Table_ChemicalView.php";
	
	$dbi = $_SESSION['dbi'];
	$id = $_GET['chemicalId'];
	
	// Create the table
	$chemicalTable = new Table_ChemicalView($dbi);
	$chemicalTable->setID($id);
	echo $chemicalTable->getTable();
	
	echo '<br />';
	
	include TEMPLATES_PATH."/include/footer.php";
?>