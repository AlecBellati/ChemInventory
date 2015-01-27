<?php
	require_once CLASSES_PATH."/Table.php";
	require_once CLASSES_PATH."/Chemical.php";
	
	class Table_ChemicalView extends Table{
		protected $dbi;
		protected $id;
		
		// Constructor
		function __construct($_dbi){
			$this->setup($_dbi);
		}
		
		// Set the id of the chemical viewed in the table
		public function setID($_id){
			$this->id = $_id;
		}
		
		// Get the id of the chemical viewed in the table
		public function getID(){
			return $this->id;
		}
		
		// Setup the table
		protected function setup($_dbi){
			$this->rowSetup();
			
			$this->dbi = $_dbi;
		}
		
		// Get the table
		public function getTable(){
			// Get the chemical
			$chemical = new Chemical($this->dbi);
			$chemical->setByID($this->id);
			
			// Add the rows to the table
			$row = array("Chemical:", $chemical->getChemicalName());
			$this->addRow($row);
			$row = array("Supplier:", $chemical->getSupplier());
			$this->addRow($row);
			$row = array("Primary DGC:", $chemical->getPrimaryDGC());
			$this->addRow($row);
			$row = array("Packing Group:", $chemical->getPackingGroup());
			$this->addRow($row);
			$row = array("Hazardous:", $chemical->isHazardous());
			$this->addRow($row);
			$row = array("Poisonous Schedule:", $chemical->getPoisonousSchedule());
			$this->addRow($row);
			$row = array("Total amount:", $chemical->getTotalAmount().$chemical->getUnit());
			$this->addRow($row);
			$row = array("Room:", $chemical->getRoom());
			$this->addRow($row);
			$row = array("Building:", $chemical->getBuilding());
			$this->addRow($row);
			$row = array("Carcinogenic:", $chemical->isCarcinogenic());
			$this->addRow($row);
			$row = array("Chemical Weapon:", $chemical->isChemicalWeapon());
			$this->addRow($row);
			$row = array("CSC:", $chemical->isCSC());
			$this->addRow($row);
			$row = array("Ototoxic:", $chemical->isOtotoxic());
			$this->addRow($row);
			$row = array("Restricted Hazardous:", $chemical->isRestrictedHazardous());
			$this->addRow($row);
			
			// Return the table
			return $this->outputTable();
		}
	}
?>
