<?php
	class Chemical{
		private $ID;
		private $chemicalName;
		private $supplier;
		private $primaryDGC;
		private $hazardous;
		private $poisonousSchedule;
		private $totalAmount;
		private $unit;
		private $room;
		private $carcinogen;
		private $chemicalWeapon;
		private $CSC;
		private $ototoxic;
		private $restrictedHazardous;
		
		// Constructor
		function __construct(){}
		
		// Get the chemical by id
		public function setByID($_id){
			$query = "SELECT * FROM chemical WHERE ID=".$_id;
			$result = mysql_query($query);
			$row = mysql_fetch_array($row, MYSQL_BOTH)
			
			$setProperties($row);
		}
		
		// Set the properties of the chemical
		public function setProperties($_data){
			if (isset($_data['ID'])) $this->ID = (int) $_data['ID']);
			if (isset($_data['ChemicalName'])) $this->chemicalName = $_data['ChemicalName']);
			if (isset($_data['Supplier'])) $this->supplier = $_data['Supplier']);
			if (isset($_data['PrimaryDGC'])) $this->primaryDGC = $_data['PrimaryDGC']);
			if (isset($_data['Hazardous'])) $this->hazardous = $_data['Hazardous']);
			if (isset($_data['PoisonousSchedule'])) $this->poisonousSchedule = $_data['PoisonousSchedule']);
			if (isset($_data['TotalAmount'])) $this->totalAmount = (int) $_data['TotalAmount']);
			if (isset($_data['Unit'])) $this->unit = $_data['Unit']);
			if (isset($_data['Room'])) $this->room = $_data['Room']);
			if (isset($_data['Carcinogen'])) $this->carcinogen = (int) $_data['Carcinogen']);
			if (isset($_data['ChemicalWeapon'])) $this->chemicalWeapon = (int) $_data['ChemicalWeapon']);
			if (isset($_data['CSC'])) $this->CSC = (int) $_data['CSC']);
			if (isset($_data['Ototoxic'])) $this->ototoxic = (int) $_data['Ototoxic']);
			if (isset($_data['RestrictedHazardous'])) $this->restrictedHazardous = (int) $_data['RestrictedHazardous']);
		}
		
		// Get the id
		public function getID(){
			return $this->ID;
		}
		
		// Get the chemical name
		public function getChemicalName(){
			return $this->chemicalName;
		}
		
		// Get the supplier
		public function getSupplier(){
			return $this->supplier;
		}
		
		// Get the primaryDGC
		public function getPrimaryDGC(){
			return $this->primaryDGC;
		}
		
		// Get hazardous indicator
		public function isHazardous(){
			return $this->hazardous;
		}
		
		// Get the poisonous schedule
		public function getPoisonousSchedule(){
			return $this->poisonousSchedule;
		}
		
		// Get the totalAmount
		public function getTotalAmount(){
			return $this->totalAmount;
		}
		
		// Get the units used
		public function getUnit(){
			return $this->unit;
		}
		
		// Get the room
		public function getRoom(){
			return $this->room;
		}
		
		// Get carcinogen indicator
		public function isCarcinogenic(){
			return $this->carcinogen;
		}
		
		// Get chemical weapon indicator
		public function isChemicalWeapon(){
			return $this->chemicalWeapon;
		}
		
		// Get CSC indicator
		public function isCSC(){
			return $this->CSC;
		}
		
		// Get ototoxic indicator
		public function isOtotoxic(){
			return $this->ototoxic;
		}
		
		// Get restricted hazardous indicator
		public function isRestrictedHazardous(){
			return $this->restrictedHazardous;
		}
		
	}
?>