<?php
	include TEMPLATES_PATH."/include/header.php";
	
	require_once FUNCTIONS_PATH."/markup_funcs.php";
	require_once CLASSES_PATH."/table.php";
	
	$chemicalTable = new Table();
	
	$row = array("Chemical:", $_SESSION['chemical']->getChemicalName());
	$chemicalTable->addRow($row);
	$row = array("Supplier:", $_SESSION['chemical']->getSupplier());
	$chemicalTable->addRow($row);
	$row = array("Primary DGC:", $_SESSION['chemical']->getPrimaryDGC());
	$chemicalTable->addRow($row);
	$row = array("Hazardous:", $_SESSION['chemical']->isHazardous());
	$chemicalTable->addRow($row);
	$row = array("Poisonous Schedule:", $_SESSION['chemical']->getPoisonousSchedule());
	$chemicalTable->addRow($row);
	$row = array("Total amount:", $_SESSION['chemical']->getTotalAmount().$_SESSION['chemical']->getUnit());
	$chemicalTable->addRow($row);
	$row = array("Room:", $_SESSION['chemical']->getRoom());
	$chemicalTable->addRow($row);
	$row = array("Carcinogenic:", $_SESSION['chemical']->isCarcinogenic());
	$chemicalTable->addRow($row);
	$row = array("Chemical Weapon:", $_SESSION['chemical']->isChemicalWeapon());
	$chemicalTable->addRow($row);
	$row = array("CSC:", $_SESSION['chemical']->isCSC());
	$chemicalTable->addRow($row);
	$row = array("Ototoxic:", $_SESSION['chemical']->isOtotoxic());
	$chemicalTable->addRow($row);
	$row = array("Restricted Hazardous:", $_SESSION['chemical']->isRestrictedHazardous());
	$chemicalTable->addRow($row);
	
	echo $chemicalTable->outputTable();
	
	echo '<br />';
	
	// Go back to the search list
	echo '<form method="POST" action="./?action=resultsChemical">';
	
	echo inputButton('button','Return');
	
	echo '</form>';
	
	
	include TEMPLATES_PATH."/include/footer.php";
?>