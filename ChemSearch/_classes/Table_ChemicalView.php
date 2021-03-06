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
			
			$warning = "";
			if($this->chemical->isCarcinogenic()){
				$warning .= "Carcinogenic";
			}
			if($this->chemical->isChemicalWeapon()){
				if ($warning != ""){
					$warning .= "<br />";
				}
				$warning .= "Chemical Weapon";
			}
			if($this->chemical->isCSC()){
				if ($warning != ""){
					$warning .= "<br />";
				}
				$warning .= "CSC";
			}
			if($this->chemical->isOtotoxic()){
				if ($warning != ""){
					$warning .= "<br />";
				}
				$warning .= "Ototoxic";
			}
			if($this->chemical->isRestrictedHazardous()){
				if ($warning != ""){
					$warning .= "<br />";
				}
				$warning .= "Restricted Hazardous";
			}
			
			if($warning != ""){
				$row = array("Warning:", $warning);
				$this->addRow($row);
			}
			
			// Return the table
			return $this->outputTable();
		}
		
		// Add another row to the table
		// Overwrites parent method
		public function addRow($_row){
			$color = "White";
			
			if ($this->rowsNum % 2 == 0){
				$color = "Moccasin";
			}
			
			$this->rows .= '<tr>';
			$this->rows .= '<td style="font-weight: bold; background-color: '.$color.'">'.$_row[0].'</td>';
			$this->rows .= '<td style="background-color: '.$color.'">'.$_row[1].'</td>';
			$this->rows .= '</tr>';
			
			$this->rowsNum++;
		}
	}
?>
