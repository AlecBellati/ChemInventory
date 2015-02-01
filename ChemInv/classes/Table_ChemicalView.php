<?php
	require_once CLASSES_PATH."Table.php";
	require_once CLASSES_PATH."Chemical.php";
	
	class Table_ChemicalView extends Table{
		protected $dbi;
		protected $id;
		protected $chemical;
		
		// Constructor
		function __construct($_dbi){
			$this->setup($_dbi);
		}
		
		// Set the id of the chemical viewed in the table
		public function setID($_id){
			$this->id = $_id;
			
			// Set the chemical
			$this->chemical = new Chemical($this->dbi);
			$this->chemical->setByID($this->id);
		}
		
		// Get the id of the chemical viewed in the table
		public function getID(){
			return $this->id;
		}
		
		// Get the chemical associated with this table
		public function getChemical(){
			return $this->chemical;
		}
		
		// Setup the table
		protected function setup($_dbi){
			$this->rowSetup();
			
			$this->dbi = $_dbi;
		}
		
		// Get the table
		public function getTable(){
			// Add the rows to the table
			$row = array("Chemical:", $this->chemical->getChemicalName());
			$this->addRow($row);
			$row = array("Supplier:", $this->chemical->getSupplier());
			$this->addRow($row);
			$row = array("Primary DGC:", $this->chemical->getPrimaryDGC());
			$this->addRow($row);
			$row = array("Packing Group:", $this->chemical->getPackingGroup());
			$this->addRow($row);
			$row = array("Hazardous:", $this->chemical->isHazardous());
			$this->addRow($row);
			$row = array("Poisons Schedule:", $this->chemical->getPoisonsSchedule());
			$this->addRow($row);
			$row = array("Total amount:", $this->chemical->getAmount().$this->chemical->getUnit());
			$this->addRow($row);
			$row = array("Room:", $this->chemical->getRoom());
			$this->addRow($row);
			$row = array("Building:", $this->chemical->getBuilding());
			$this->addRow($row);
			$row = array("Carcinogenic:", $this->chemical->isCarcinogenic());
			$this->addRow($row);
			$row = array("Chemical Weapon:", $this->chemical->isChemicalWeapon());
			$this->addRow($row);
			$row = array("CSC:", $this->chemical->isCSC());
			$this->addRow($row);
			$row = array("Ototoxic:", $this->chemical->isOtotoxic());
			$this->addRow($row);
			$row = array("Restricted Hazardous:", $this->chemical->isRestrictedHazardous());
			$this->addRow($row);
			
			// Return the table
			return $this->outputTable();
		}
	}
?>
