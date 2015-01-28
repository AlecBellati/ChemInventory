<?php
	require_once FUNCTIONS_PATH."markup_funcs.php";
	require_once CLASSES_PATH."Table_ChemicalView.php";
	
	$dbi = $_SESSION['dbi'];
	$id = $_GET['chemicalId'];
	
	// Set up the table
	$chemicalTable = new Table_ChemicalView($dbi);
	$chemicalTable->setID($id);
	
	// Set the page title
	$chemical = $chemicalTable->getChemical();
	$_SESSION['pageTitle'] = $chemical->getChemicalName()." | ChemSearch";
	
	
	// Create the page header
	// Note: this is lower in the template so the page title can be properly titled
	include TEMPLATES_PATH."include/header.php";
	
	// Create the table
	echo $chemicalTable->getTable();
	
	echo '<br />';
	
	include TEMPLATES_PATH."include/footer.php";
?>