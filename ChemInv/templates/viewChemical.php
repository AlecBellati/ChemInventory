<?php
	include "templates/include/header.php";
	
	$chemicalTable = new Table();
	
	$row = array("Chemical:", $results['chemical']->getChemicalName());
	$chemicalTable->addRow($row);
	$row = array("Supplier:", $results['chemical']->getSupplier());
	$chemicalTable->addRow($row);
	$row = array("Primary DGC:", $results['chemical']->getPrimaryDGC());
	$chemicalTable->addRow($row);
	$row = array("Hazardous:", $results['chemical']->isHazardous());
	$chemicalTable->addRow($row);
	$row = array("Poisonous Schedule:", $results['chemical']->getPoisonousSchedule());
	$chemicalTable->addRow($row);
	$row = array("Total amount:", $results['chemical']->getTotalAmount().$results['chemical']->getUnit());
	$chemicalTable->addRow($row);
	$row = array("Room:", $results['chemical']->getRoom());
	$chemicalTable->addRow($row);
	$row = array("Carcinogenic:", $results['chemical']->isCarcinogenic());
	$chemicalTable->addRow($row);
	$row = array("Chemical Weapon:", $results['chemical']->isChemcialWeapon());
	$chemicalTable->addRow($row);
	$row = array("CSC:", $results['chemical']->isCSC());
	$chemicalTable->addRow($row);
	$row = array("Ototoxic:", $results['chemical']->isOtotoxic());
	$chemicalTable->addRow($row);
	$row = array("Restricted Hazardous:", $results['chemical']->isRestrictedHazardous());
	$chemicalTable->addRow($row);
	
	print $chemicalTable->outputTable();
	
	include "templates/include/footer.php";
?>