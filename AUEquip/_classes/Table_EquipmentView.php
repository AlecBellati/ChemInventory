<?php
	require_once CLASSES_PATH."Table.php";
	require_once CLASSES_PATH."Equipment.php";
	
	class Table_EquipmentView extends Table{
		protected $dbi;
		protected $id;
		protected $equipment;
		
		// Constructor
		function __construct($_dbi){
			$this->setup($_dbi);
		}
		
		// Set the id of the equipment viewed in the table
		public function setID($_id){
			$this->id = $_id;
			
			// Set the chemical
			$this->equipment = new Equipment($this->dbi);
			$this->equipment->setByID($this->id);
		}
		
		// Get the id of the equipment viewed in the table
		public function getID(){
			return $this->id;
		}
		
		// Get the equipment associated with this table
		public function getEquipment(){
			return $this->equipment;
		}
		
		// Setup the table
		protected function setup($_dbi){
			$this->rowSetup();
			
			$this->dbi = $_dbi;
		}
		
		// Get the table
		public function getTable(){
			// Add the rows to the table
			$row = array("Equipment:", $this->equipment->getEquipmentName());
			$this->addRow($row);
			$row = array("Function:", $this->equipment->getFunctionName());
			$this->addRow($row);
			$row = array("What it does:", $this->equipment->getWhatItDoes());
			$this->addRow($row);
			$row = array("What sample is needed:", $this->equipment->getWhatSample());
			$this->addRow($row);
			$row = array("What information is given:", $this->equipment->getWhatInformation());
			$this->addRow($row);
			$location = $this->equipment->getRoomName();
			$location .= " " . $this->equipment->getBuildingName();
			$location .= "<br />" . $this->equipment->getCampusName();
			$location .= "<br />" . "The University of Adelaide";
			$row = array("Location:", $location);
			$this->addRow($row);
			$contact = $this->equipment->getContactName();
			$contact .= "<br />" . $this->equipment->getContactEmail();
			$contact .= "<br />" . $this->equipment->getContactNumber();
			$row = array("Contact:", $contact);
			$this->addRow($row);
			$row = array("Usage Fee:", $this->equipment->getUsageFee());
			$this->addRow($row);
			
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
