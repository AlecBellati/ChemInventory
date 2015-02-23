<?php
	require_once FUNCTIONS_PATH."markup_funcs.php";
	require_once CLASSES_PATH."Table_EquipmentView.php";
	
	$dbi = $_SESSION['dbi'];
	$id = $_GET['equipmentID'];
	
	// Set up the table
	$equipmentTable = new Table_EquipmentView($dbi);
	$equipmentTable->setID($id);
	
	// Set the page title
	$equipment = $equipmentTable->getEquipment();
	$_SESSION['pageTitle'] = htmlspecialchars_decode($equipment->getEquipmentName(),ENT_QUOTES);
	
	// Create the page header
	// Note: this is lower in the template so the page title can be properly titled
	include TEMPLATES_PATH."include/header.php";
	
	// Create the table
	echo $equipmentTable->getTable();
	
	echo '<br />';
	
	include TEMPLATES_PATH."include/footer.php";
?>